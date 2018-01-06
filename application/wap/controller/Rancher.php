<?php
/**
 * @Author: Marte
 * @Date:   2017-12-26 18:01:28
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-06 14:04:56
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Db;
use think\Exception;
use think\Session;
use app\common\model\Order as O;
use app\common\model\Commodity as C;
use app\common\model\Record as R;
use app\common\model\Conversion as CO;//兑换表
class Rancher extends Yang
{
    use \app\admin\traits\controller\Controller;
    public function index()
    {
        $this->money($this->id);
        $he = 0;//已返还的总利润
        $dlirun = 0;//未返还的利润
        $sp_count = 0;//羊只的总和
        $fulfill = 0;////已完成的羊
        $nofulfill = 0;//未完成羊
        $principal = 0;//已收本金
        $count = 0;//购买期数 产生多少笔订单
        $money = 0;//交易总金额
        $dprincipal = 0;//未完成本金
        $row = O::where(['user_id'=>$this->id])->field('sum(sp_count) as sp_count,sum(order_price) as order_price,sum(zexpect) as zexpect,sp_id,status,nexpect,which,sp_price')->group('sp_id')->order('create_time desc')->select();
        foreach ($row as $k => $v) {
            $com = C::where(['id'=>$v['sp_id']])->find();
            $row[$k]['over_time'] = $com['over_time'];
            $row[$k]['begin_time'] = $com['begin_time'];
            $row[$k]['name'] = $com['name'];
            $row[$k]['classify'] = $com['classify'];
            $row[$k]['com_number'] = $com['com_number'];
            $row[$k]['rate'] = $com['rate'];

            $count+=1;
            $sp_count += $v['sp_count'];//羊只的总和
            $money+=$v['order_price'];
            $row[$k]['sky'] = ceil(($com['over_time']-time())/86400);
            if ($v['status']==1) {
                $fulfill += $v['sp_count'];//已完成的羊
                $principal += $v['order_price'];//已收本金
                $he += $v['zexpect'];//查询已返还的总利润
            }else{
                $nofulfill += $v['sp_count'];//未完成的羊
                $dprincipal +=$v['order_price'];
                $yifanh = $v['zexpect'] / $v['nexpect'] * $v['which'];
                $he += $yifanh;//查询已返还的总利润
                $dl = $v['zexpect'] - $yifanh;
                $dlirun += $dl;
            }

            if (time()<$com['deal_time']) {
                $row[$k]['caigou'] = 1;
                $row[$k]['sky'] = ceil(($com['deal_time']-time())/86400);
            }
        }
        $arr['return_price'] = $he;
        $arr["dprincipal"] = $dprincipal;
        $arr["principal"] = $principal;
        $arr["count"] = $count;
        $arr["money"] = $money;
        $arr["fulfill"] = $fulfill;
        $arr["nofulfill"] = $nofulfill;
        $arr["sp_count"] = $sp_count;
        $arr['dlirun'] = $dlirun;
        $arr['dshou'] = $dlirun + $dprincipal;//未返还金额

        $this->assign('arr',$arr);
        $this->assign('row',$row);

        return $this->fetch();
    }
    /*
     *牧场详细信息
     */
    public function rainfo()
    {
        $sp_id = input('sp_id');//商品id
        $order = O::where(['user_id'=>$this->id,'sp_id'=>$sp_id])->field('sum(sp_count) as sp_count,sum(order_price) as order_price,sum(zexpect) as zexpect,sp_id,status,nexpect,which,sp_price')->group('sp_id')->find();
        $com = C::where(['id'=>$sp_id])->find();
        $zongjin = $order['order_price'] + $order['zexpect'];//资金总额
        $arr = ['code'=>-200,'data'=>'','msg'=>''];

        if ($this->request->isAjax()) {
            $data = $this->request->post();
            $order_price = $com['convert'] * $data['number'];//订单总额
            if ($data['pay_pass']=='') {
                $arr['msg'] = '请输入支付密码';
                return json($arr);
            }
            if (time()>$com['convert_time']) {
                $arr['msg']='兑换时间已结束!';
                return json($arr);
            }
            if ($data['number']>$order['sp_count']) {
                $arr['msg'] = '兑换数量超出';
                return json($arr);
            }
            $number = CO::where(['user_id'=>$this->id,'sp_id'=>$sp_id])->sum('number');
            $shengyu = $order['sp_count'] - $number - $data['number'];
            if ($shengyu < 0) {
                $arr['msg'] = '可兑换数量不足';
                return json($arr);
            }
            if ($data['number']<1) {
                $arr['msg'] = '兑换数量不可小于1';
                return json($arr);
            }
                $conversion['user_id']=$this->id;
                $conversion['sp_id']=$sp_id;
                $conversion['number']=$data['number'];
                $conversion['status']=0;
                $conversion['create_time']=time();
                $conversion['deliver_status']=0;
                $conversion['order_price']=$order_price;
                $conversion['price']=$com['convert'];
                //CO::insert($conversion);
            Db::startTrans();
            try{
                //扣除用户余额
                $user = Db::table('tp_user')->where(['id'=>$this->id])->find();
                $pay_pass = md5($data['pay_pass']);
                if ($user['pay_pass']!=$pay_pass) {
                    $arr['msg']='您输入的支付密码不正确';
                    //return json($arr);
                    throw new \think\Exception();
                }
                $balance = $user['balance'] - $order_price;
                if ($balance < 0) {
                    $arr['msg'] = '您的余额不足!请充值!';
                    throw new \think\Exception();
                }
                $arr['msg'] = '订单创建失败balance';
                Db::table('tp_user')->where(['id'=>$this->id])->update(['balance' => $balance]);
                $arr['msg'] = '订单创建失败conversion';
                CO::insert($conversion);

                $detail['user_id']=$this->id;
                $detail['or']=3;
                $detail['money']=$order_price;
                $detail['comment']='兑换羊只';
                $detail['status']=0;
                $detail['create_time']=time();
                $detail['accomplish_time']=time();
                $arr['msg'] = '添加详细信息失败';
                Db::table('tp_detail')->insert($detail);
                Session::set('user.balance',$balance);
                // 提交事务
                Db::commit();
            } catch (\think\Exception $e) {
                // 回滚事务
                Db::rollback();
                return json($arr);
            }
            $arr['msg'] = '订单创建成功';
            $arr['code'] = 1;
            return json($arr);

        }else{
            $conversion = CO::where(['user_id'=>$this->id,'sp_id'=>$sp_id])->field('number,order_price')->select();
            $yimai = 0;
            $yihua = 0;
            foreach ($conversion as $k => $v) {
                $yimai += $v['number'];
                $yihua += $v['order_price'];
            }
            if ($order['status']==1) {
                if (time()>$com['convert_time']) {
                    $order['status'] = 2;
                }else{
                    $com['convert_time'] = $com['convert_time'] - time();
                }
            }
            $sheng = $order['sp_count'] - $yimai;
            $this->assign('conversion',$conversion);
            $this->assign('sheng',$sheng);
            $this->assign('yimai',$yimai);
            $this->assign('yihua',$yihua);
            $this->assign('com',$com);
            $this->assign('order',$order);
            $this->assign('zongjin',$zongjin);
            return $this->fetch();
        }

    }
}
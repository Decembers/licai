<?php
/**
 * @Author: Marte
 * @Date:   2017-12-12 17:12:51
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-02-10 17:46:05
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Session;
use think\Db;
use app\common\model\Order as O;
use app\common\model\Commodity as C;
use app\common\model\User as U;
use app\common\model\Detail as D;
use app\common\model\Referrer as R;
use app\common\model\UserPacket as UP;

class Order extends Yang
{
    use \app\admin\traits\controller\Controller;

    public function info()
    {
        $controller = 'Order';

        if ($this->request->isAjax()) {
            $arr = ['code'=>-200,'data'=>'','msg'=>''];
            $data = $this->request->post();
            $sp_id = $data['sp_id'];//商品id
            $comm = C::where(['id'=>$sp_id])->find();//查询商品信息
            $restriction = $comm['restrict'];
            $num = $data['number'];//用户购买数量
            $user_id = Session::get('user.id');

            if (!isset($user_id)) {
                $arr['msg']='请登陆后购买!';
                return json_encode($arr);
            }
            if ($comm['classify'] == 3) {
                if ($data['vip6']!=$comm['vip6']) {
                    $arr['msg']='您输入的vip邀请码不正确';
                    return json_encode($arr);
                }
            }
            if ($comm['down_time']<time()) {
                $arr['msg']='购买时间已结束!';
                return json_encode($arr);
            }

            $order_price =  $num*$comm['price'];
            $row['number'] = date('YmdHis') . rand(10000000,99999999);
            $row['user_id'] = $user_id;
            $row['sp_id'] = $sp_id;
            $row['order_price'] = $order_price;
            $row['sp_price'] = $comm['price'];
            $row['sp_count'] = $num;
            $row['status'] = 0;
            $row['sfpay'] = 1;
            $row['isdelete'] = 0;
            $row['create_time'] = time();
            $row['update_time'] = time();
            $row['packet'] = 0;


            if ($num>$restriction) {
                $arr['msg'] = '购买数量超出'.$restriction.'个限购数';
                return json_encode($arr);
            };
            if ($num<1) {
                $arr['msg'] = '购买数量不可小于1';
                return json_encode($arr);
            }
            //每个用户限购的数量 查询用户购买数量为这个商品id的购买记录
            $sp_count = O::where(['user_id'=>$user_id,'sp_id'=>$sp_id])->sum('sp_count');
            $z_count = $sp_count+$num;
            $y_count = $restriction - $sp_count;
            if ($z_count>$restriction) {
                $arr['msg'] = '您已购买过'.$sp_count.'个,最多还可购买'.$y_count.'个';
                return json_encode($arr);
            }

            Db::startTrans();
            try{
                //扣除用户余额
                $user = Db::table('tp_user')->where(['id'=>$user_id])->find();
                if ($user['mobile']=='') {
                    $arr['msg']='请先在设置中绑定手机号码';
                    throw new \think\Exception();
                }
                if ($user['authentication']==1) {
                    $arr['msg']='请等待实名认证成功后购买';
                    throw new \think\Exception();
                }elseif($user['authentication']==0){
                    $arr['msg']='请实名认证后购买';
                    throw new \think\Exception();
                }
                if ($user['pay_pass']=='') {
                    $arr['msg']='请先设置支付密码!';
                    throw new \think\Exception();
                }
                if ($data['pay_pass']=='') {
                    $arr['msg']='请输入支付密码!';
                    throw new \think\Exception();
                }
                $pay_pass = md5($data['pay_pass']);
                if ($user['pay_pass']!=$pay_pass) {
                    $arr['msg']='您输入的支付密码不正确';
                    throw new \think\Exception();
                }
                //红包
                $balance = $user['balance'] - $row['order_price'];
                $balanceinfo = $row['order_price'];
                        // $arr['msg']=$data['packet'];
                        // throw new \think\Exception();
                $packet = '';
                if (!empty($data['packet'])) {
                    $packet = UP::where(['id'=>$data['packet'],'number'=>['>',0]])->find();
                    if (!isset($packet)) {
                        $arr['msg']='红包非法';
                        throw new \think\Exception();
                    }
                    if ($order_price<$packet['full']) {
                        $arr['msg']='购买金额须满'.$packet['full'].'元才可使用红包!';
                        throw new \think\Exception();
                    }
                    $balanceinfo = $row['order_price'] - $packet['money'];
                    $row['packet'] = $packet['money'];
                    $balance = $balance + $packet['money'];
                    $arr['msg'] ='红包减失败';
                    if ($packet['number']<2) {
                        UP::where(['id'=>$data['packet']])->delete();
                    }else{
                        UP::where(['id'=>$data['packet']])->dec('number',1)->update();
                    }
                }

                if ($balance < 0) {
                    $arr['msg'] = '您的余额不足!请充值!';
                    throw new \think\Exception();
                }
                Db::table('tp_user')->where(['id'=>$user_id])->update(['balance' => $balance]);
                $arr['msg'] = '订单创建失败';

                $zexpect = $num * $comm['price'] * ($comm['return_price']/100) / 360 * $comm['rate'];//应返还的总利润
                $row['zexpect'] = substr(sprintf("%.3f",$zexpect),0,-1); //到期返还不会出问题 按月返还可能会出现问题
                $row['nexpect'] = $comm['nexpect'];//返还几期

                $comms = Db::table('tp_commodity')->where(['id'=>$sp_id])->lock(true)->find();
                $numbers = $comms['number'] - $num;
                if ($numbers < 0) {
                    $arr['msg'] = '商品数量不足';
                    throw new \think\Exception();
                }
                $orderss = Db::table('tp_order')->where(['user_id'=>$this->id,'sp_id'=>$sp_id])->find();
                $rate = DB::table('tp_referrer_rate')->find();

                if (isset($orderss)) {

                    //同一个羊群不能使用多次红包限制
                    // if ($orderss['packet']!=0 && $data['packet']!=0) {
                    //     $arr['msg']='您已经使用过红包';
                    //     throw new \think\Exception();
                    // }

                    $update['order_price'] = $orderss['order_price']+$order_price;
                    $update['sp_count'] = $orderss['sp_count']+$num;
                    $update['zexpect'] = substr(sprintf("%.3f",$update['order_price']*($comm['return_price']/100) / 360 * $comm['rate']),0,-1);

                    if (!empty($data['packet'])) {
                        $update['packet'] = $packet['money'];
                    }
                    $ara = Db::table('tp_order')
                    ->where(['user_id'=>$this->id,'sp_id'=>$sp_id])
                    ->update($update);


                    if ($user['referrer']!=0) {
                        $referrer = R::where(['user_id'=>$user['referrer'],'buser_id'=>$user['id'],'order_id'=>$orderss['id']])->find();
                        $money = substr(sprintf("%.3f",$update['order_price']*$rate['rate']),0,-1);
                        R::where(['user_id'=>$user['referrer'],'buser_id'=>$user['id'],'order_id'=>$orderss['id']])
                        ->update(['money'=>$money]);
                        $innn = $money - $referrer['money'];
                        U::where(['id'=>$user['referrer']])->inc('balance',$innn)->update();
                    }

                }else{
                    $ara = Db::table('tp_order')->insert($row);
                    if ($user['referrer']!=0) {
                        $order_id = Db::name('tp_order')->getLastInsID();
                        $ref['user_id']=$user['referrer'];
                        $ref['buser_id']=$user['id'];
                        $ref['order_id']=$order_id;
                        $ref['money']=substr(sprintf("%.3f",$order_price*$rate['rate']),0,-1);
                        $ref['create_time']=time();
                        R::insert($ref);
                        U::where(['id'=>$user['referrer']])->inc('balance',$ref['money'])->update();
                    }
                }

                Db::table('tp_commodity')->where(['id'=>$sp_id])->update(['number' => $numbers]);

                $detail['user_id']=$this->id;
                $detail['or']=3;
                $detail['money']=$balanceinfo;
                $detail['comment']='购买鹅只';
                $detail['status']=1;
                $detail['create_time']=time();
                $detail['accomplish_time']=time();
                $arr['msg'] = '添加详细信息失败';
                Db::table('tp_detail')->insert($detail);

                //给推荐人
                $detail['user_id']=$user['referrer'];
                $detail['or']=4;
                $detail['money']=$row['order_price']*$rate['rate'];
                $detail['comment']='推荐赏金';
                $detail['status']=1;
                $detail['create_time']=time();
                $detail['accomplish_time']=time();
                Db::table('tp_detail')->insert($detail);

                //修改赏金排序
                U::where(['id'=>$user['id']])->update(['invite_time'=>time()]);

                // 提交事务
                Db::commit();
            } catch (\think\Exception $e) {
                // 回滚事务
                Db::rollback();
                return json_encode($arr);
            }
            $arr['msg'] = '订单创建成功';
            $arr['code'] = 0;
            return json_encode($arr);

        } else {

            $id = input('id');
            $arr = C::where(['id'=>$id])->find();
            $arr['profit'] = substr(sprintf("%.3f",$arr['expect'] * $arr['nexpect']),0,-1);//养殖利润
            $arr['jsprofit'] = $arr['expect'] * $arr['nexpect'];//养殖利润
            $this->assign('arr',$arr);
            $user = U::where(['id'=>$this->id])->find();
            $packet = UP::where(['user_id'=>$this->id])->select();
            $this->assign('balance',$user['balance']);
            $this->assign('packet',$packet);
            if ($arr['classify']==1) {
                //常规羊群
                 if (time() < $arr['preselle_time']) {
                    //预售中 计算还剩多少时间开始购买
                    $time = $arr['preselle_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('cgys');
                 }elseif(time() < $arr['down_time']){
                    //购买 计算还剩多少购买时间
                    $time = $arr['down_time']-time();
                    $this->assign('time',$time);

                    if ($arr['number']<=0) {
                        return $this->fetch('cgsx');
                    }
                    return $this->fetch('cggm');
                 }else{
                    return $this->fetch('cgsx');
                 }

            }elseif ($arr['classify']==2){
                //辅助羊群
                 if (time() < $arr['preselle_time']) {
                    //预售中
                    $time = $arr['preselle_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('fzys');
                 }elseif(time() < $arr['down_time']){
                    //购买
                    $time = $arr['down_time']-time();
                    $this->assign('time',$time);
                    if ($arr['number']<=0) {
                        return $this->fetch('fzsx');
                    }
                    return $this->fetch('fzgm');
                 }else{
                    return $this->fetch('fzsx');
                 }

            }else{
                //vip羊群
                 if (time() < $arr['preselle_time']) {
                    //预售中
                    $time = $arr['preselle_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('vipys');
                 }elseif(time() < $arr['down_time']){
                    //购买
                    $time = $arr['down_time']-time();
                    $this->assign('time',$time);
                    if ($arr['number']<=0) {
                        return $this->fetch('vipsx');
                    }
                    return $this->fetch('vipgm');
                 }else{
                    return $this->fetch('vipsx');
                 }
            }


        }
    }
    /*
     *查询商品的剩余数量
     */
    public function number()
    {
         if ($this->request->isAjax()) {
            $data = $this->request->post();
            $sp_id = $data['id'];//商品id
            $comm = C::where(['id'=>$sp_id])->find();
            $arr['number'] = $comm['number'];
            return json_encode($arr);
         }
    }

    /*
     *商品购买详情
     */
    public function infolist()
    {
        $id = input('id');
        $arr = O::where(['sp_id'=>$id])->field('user_id,create_time,sp_count')->order('sp_count desc')->select();
        $comm = C::where(['id'=>$id])->find();
        $row = [];
        $ke = 0;
        if (!empty($arr)) {
            foreach ($arr as $k => $v) {
                $user = U::where(['id'=>$v['user_id']])->find();
                $row[$k]['name'] = $user['name'];
                $row[$k]['create_time'] = $arr[$k]['create_time'];
                $row[$k]['sp_count'] = $arr[$k]['sp_count'];
                $ke = $k;
            }
        }
        $ke = $ke+1;
        if (time()>$comm['down_time']&&$comm['number']!=0) {
            if ($comm['number']>3) {
                $ar = [66,67,68];
                $a1 = $comm['number']%3;
                $a2 = $comm['number'] - $a1;
                $a3 = $a2/3;
                for ($i=0; $i < 3 ; $i++) {
                    $ke = $ke + $i;
                    $user = U::where(['id'=>$ar[$i]])->find();
                    $row[$ke]['name'] = $user['name'];
                    $row[$ke]['create_time'] = $comm['down_time'] - 100*$ke;
                    $row[$ke]['sp_count'] = $a3;
                    if ($i==2) {
                         $row[$ke]['sp_count'] = $a3+$a1;
                    }
                }
            }else{
                $user = U::where(['id'=>66])->find();
                $row[$ke]['name'] = $user['name'];
                $row[$ke]['create_time'] = $comm['down_time'] - 100;
                $row[$ke]['sp_count'] = $comm['number'];
            }
        }

        $this -> assign('row',$row);
        return $this -> fetch();
    }

    public function suanfa()
    {
        if ($this->request->isAjax()) {
            $num = input('num');
            $sp_id = input('sp_id');
            $com = C::where(['id'=>$sp_id])->find();
        }
    }

    public function xieyi()
    {
        return $this -> fetch();
    }
}

<?php
/**
 * @Author: Marte
 * @Date:   2017-12-27 09:41:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-08 17:55:09
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Ress;
use app\common\model\User;
use app\common\model\AdminUser;
use app\common\model\Shopping;
use app\common\model\Supermarket as S;
use app\common\model\SupermarketOrder;
use think\Session;
use think\Db;
class Supermarket extends Yang
{
    public function index()
    {
        $supermarket = S::where(['user_id'=>6])->select();
        $shopping['num'] = Shopping::where('user_id',$this->id)->sum('num');
        $shopping['price'] = Shopping::where('user_id',$this->id)->sum('price');
        //var_dump($shopping);die;
        $this->assign('shopping',$shopping);
        $this->assign('supermarket',$supermarket);
        return $this->fetch();
    }
    public function shopping()
    {
        if ($this->request->isAjax()) {
            $data = input();
            $data['user_id'] = $this->id;
            $data['sp_id'] = (int)$data['sp_id'];
            $supermarket = S::where('id',$data['sp_id'])->find();
            $data['sj_id'] = $supermarket['user_id'];
            $shopping = Shopping::where($data)->find();
            $data['price'] = $supermarket['price'];
            if (!empty($shopping)) {
                Shopping::where('id', $shopping['id'])->setInc('num',1);
                Shopping::where('id', $shopping['id'])->setInc('price',$supermarket['price']);
            }else{
                Shopping::insert($data);
            }

        }
    }
    //购物车删除一个商品
    public function shoppingde()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            $shopping = Shopping::where('id', $id)->delete();
        }
    }
    //购物车减
    public function shoppingj()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            $shopping = Shopping::where('id', $id)->find();
            $supermarket = S::where('id', $shopping['sp_id'])->find();

            Shopping::where('id', $id)->setDec('num',1);
            Shopping::where('id', $id)->setDec('price',$supermarket['price']);
        }
    }
    //购物车加指定数量商品
    public function shoppingjanum()
    {
        if ($this->request->isAjax()) {
            $num = input('num');
            $data['sp_id'] = input('sp_id');
            $data['user_id'] = $this->id;
            $supermarket = S::where('id',$data['sp_id'])->find();
            $data['sj_id'] = $supermarket['user_id'];
            $shopping = Shopping::where($data)->find();
            $data['price'] = $supermarket['price'];
            if (!empty($shopping)) {
                Shopping::where('id', $shopping['id'])->setInc('num',$num);
                Shopping::where('id', $shopping['id'])->setInc('price',$supermarket['price']*$num);
            }else{
                $data['num'] = $num;
                Shopping::insert($data);
            }

        }
    }
    //购物车加
    public function shoppingja()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            $shopping = Shopping::where('id', $id)->find();
            $supermarket = S::where('id', $shopping['sp_id'])->find();

            Shopping::where('id', $id)->setInc('num',1);
            Shopping::where('id', $id)->setInc('price',$supermarket['price']);
        }
    }
    //结算购物车
    public function shoppingorder()
    {
        if ($this->request->isAjax()) {
            $data = input('order');
            $ress_id = input('ress_id');
            $data = explode(",",$data);
            $arr = ['code'=>-200,'data'=>'','msg'=>''];


            //生成订单,每个商品生成一笔订单
            Db::startTrans();
            try{

            foreach ($data as $key => $value) {

                $shopping = Shopping::where('id', $data[$key])->find();
                $supermarket = S::where('id', $shopping['sp_id'])->find();
                $order_price = $supermarket['price']*$shopping['num'];

                $user = User::where('id', $this->id)->find();
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
                if ($user['balance'] < $order_price) {
                    $arr['msg'] = '您的余额不足!请充值!';
                    throw new \think\Exception();
                }
                if ($shopping['num'] > $supermarket['number']) {
                    $arr['msg'] = '商品数量不足'.$key;
                    throw new \think\Exception();
                }

                $arr['msg'] = '减去购买的数量失败'.$key;
                S::where('id', $shopping['sp_id'])->setDec('number',$shopping['num']);//减去购买的数量

                $arr['msg'] = '生成订单失败'.$key;
                $order['number'] = time().rand(100000,999999);
                $order['sj_id'] = $supermarket['user_id'];
                $order['sp_id'] = $supermarket['id'];
                $order['user_id'] = $this->id;
                $order['sp_name'] = $supermarket['name'];
                $order['price'] = $supermarket['price'];
                $order['quantity'] = $shopping['num'];
                $order['order_price'] = $order_price;
                $order['status'] = 1;
                $order['ress_id'] = $ress_id;
                $order['create_time'] = time();
                SupermarketOrder::insert($order);//生成订单

                $arr['msg'] = '扣除用户余额失败'.$key;
                User::where('id',$this->id)->setDec('balance',$order_price);//扣除用户余额

                $arr['msg'] = '增加商户余额失败'.$key;
                AdminUser::where('id',$supermarket['user_id'])->setInc('money',$order_price);//增加商户余额

                $detail['user_id']=$this->id;
                $detail['or']=3;
                $detail['money']=$order_price;
                $detail['comment']='超市购物';
                $detail['status']=1;
                $detail['create_time']=time();
                $detail['accomplish_time']=time();
                $arr['msg'] = '添加详细信息失败'.$key;
                Db::table('tp_detail')->insert($detail);//添加详细信息

                $shopping = Shopping::where('id', $data[$key])->delete();//删除购物车商品

            }
                $arr['msg'] = '订单创建成功';
                $arr['code'] = 1;
                Db::commit();
            } catch (\think\Exception $e) {
                Db::rollback();
                return json($arr);
            }
            return json($arr);
        }
    }
    public function lists()
    {
        return $this->fetch();
    }
    public function info()
    {
        $id = input('id');
        $supermarket = S::where('id', $id)->find();
        $user = User::where('id',$this->id)->find();

        $this->assign('supermarket',$supermarket);
        $this->assign('user',$user);
        return $this->fetch();
    }
    public function dingdan()
    {
        $is = input('is');

        $oupermarketorder = SupermarketOrder::where(['user_id'=>$this->id])->order('create_time desc')->select();
        foreach ($oupermarketorder as $key => $value) {
            $supermarket = S::where('id',$value['sp_id'])->find();
            $oupermarketorder[$key]['image'] = $supermarket['image'];
            $adminuser = AdminUser::where(['id'=>$supermarket['user_id']])->find();
            $oupermarketorder[$key]['sj_name'] = $adminuser['realname'];
        }

        $this->assign('is',$is);
        $this->assign('oupermarketorder',$oupermarketorder);
        return $this->fetch();
    }
    public function dingdaninfo()
    {
        $id = input('id');
        $oupermarketorder = SupermarketOrder::where(['id'=>$id])->find();
        $supermarket = S::where('id', $oupermarketorder['sp_id'])->find();
        $ress = Ress::where(['id'=>$oupermarketorder['ress_id']])->find();
        $adminuser = AdminUser::where(['id'=>$oupermarketorder['sj_id']])->find();

        $this->assign('oupermarketorder',$oupermarketorder);
        $this->assign('supermarket',$supermarket);
        $this->assign('ress',$ress);
        $this->assign('adminuser',$adminuser);

        return $this->fetch();
    }
    //取消订单
    public function dededingdan()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            $remark = input('remark');
            SupermarketOrder::where(['id'=>$id])->update(['status' => 4,'remark'=>$remark]);
        }
    }
    //确认完成
    public function quedingdan()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            SupermarketOrder::where(['id'=>$id])->update(['status' => 3]);
        }
    }
    public function gouwuche()
    {
        $shopping = Shopping::where('user_id',$this->id)->select();
        foreach ($shopping as $key => $value) {
            $supermarket = S::where('id',$value['sp_id'])->find();
            $shopping[$key]['sp_name'] = $supermarket['name'];
            $shopping[$key]['sp_img'] = $supermarket['image'];
            $shopping[$key]['sp_price'] = $supermarket['price'];
        }
        $ress = Ress::where(['user_id'=>$this->id])->select();
        $defult = Ress::where(['user_id'=>$this->id,'is_default'=>1])->find();

        $this->assign('ress',$ress);
        $this->assign('defult',$defult);
        $this->assign('shopping',$shopping);

        return $this->fetch();
    }
    public function pay()
    {
        return $this->fetch();
    }
}
<?php
/**
 * @Author: Marte
 * @Date:   2017-12-27 09:41:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-12 15:49:13
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Ress;
use app\common\model\User;
use app\common\model\Detail;
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
            $arr['msg'] = '删除成功';
            $arr['code'] = 1;
            return json($arr);
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
            $order = [];
            $order_price = 0;//订单总金额
            //生成订单,每个商品生成一笔订单
            Db::startTrans();
            try{

                foreach ($data as $key => $value) {

                    $shopping = Shopping::where('id', $data[$key])->find();
                    $supermarket = S::where('id', $shopping['sp_id'])->find();
                    $order_price += $shopping['num']*$supermarket['price'];

                    $order['sj_id'] = $supermarket['user_id'];
                    $order['sp_id'][$key]=$shopping['sp_id'];
                    $order['sp_name'][$key]=$supermarket['name'];
                    $order['sp_img'][$key]=$supermarket['image'];
                    $order['price'][$key]=$supermarket['price'];
                    $order['quantity'][$key]=$shopping['num'];

                    Shopping::where('id', $data[$key])->delete();//删除购物车商品
                    S::where('id', $shopping['sp_id'])->setDec('number',$shopping['num']);//减去购买的数量
                }

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



                $arr['msg'] = '生成订单失败';
                $order['number'] = time().rand(100000,999999);
                $order['user_id']=$this->id;
                $order['sp_id']=json_encode($order['sp_id']);
                $order['sp_name']=json_encode($order['sp_name']);
                $order['sp_img']=json_encode($order['sp_img']);
                $order['price']=json_encode($order['price']);
                $order['quantity']=json_encode($order['quantity']);

                $order['order_price'] = $order_price;
                $order['status'] = 1;
                $order['ress_id'] = $ress_id;
                $order['create_time'] = time();
                SupermarketOrder::insert($order);//生成订单

                $arr['msg'] = '扣除用户余额失败';
                User::where('id',$this->id)->setDec('balance',$order_price);//扣除用户余额

                $arr['msg'] = '增加商户余额失败';
                AdminUser::where('id',$supermarket['user_id'])->setInc('money',$order_price);//增加商户余额

                $detail['user_id']=$this->id;
                $detail['or']=3;
                $detail['money']=$order_price;
                $detail['comment']='超市购物';
                $detail['status']=1;
                $detail['create_time']=time();
                $detail['accomplish_time']=time();
                $arr['msg'] = '添加详细信息失败';
                Db::table('tp_detail')->insert($detail);//添加详细信息

                //给推荐人分成
                if ($user['referrer']!=0) {
                    $rate = DB::table('tp_referrer_rate')->find();
                    $order_price = substr(sprintf("%.3f",$order_price * $rate['rate']),0,-1);
                    User::where('id',$user['referrer'])->setInc('balance',$order_price);//扣除用户余额

                    $detail['user_id']=$user['referrer'];
                    $detail['or']=4;
                    $detail['money']=$order_price;
                    $detail['comment']='推荐返利';
                    $detail['status']=1;
                    $detail['create_time']=time();
                    $detail['accomplish_time']=time();
                    Db::table('tp_detail')->insert($detail);//添加详细信息
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
        $shopping['num'] = Shopping::where('user_id',$this->id)->sum('num');
        $shopping['price'] = Shopping::where('user_id',$this->id)->sum('price');

        $this->assign('shopping',$shopping);
        $this->assign('supermarket',$supermarket);
        $this->assign('user',$user);
        return $this->fetch();
    }

    public function infoorder()
    {
        if ($this->request->isAjax()) {
            $sp_id = input("sp_id");
            $number = input("number");
            $order = [];
            $order_price = 0;//订单总金额

            Db::startTrans();
            try{

                $data = Shopping::select();
                foreach ($data as $key => $value) {
                    if ($value['sp_id']==$sp_id) {
                        $number = $number+$value['num'];
                        Shopping::where('id', $value['id'])->delete();//删除购物车商品
                        continue;
                    }

                    $supermarket = S::where('id', $value['sp_id'])->find();//查询商品信息
                    $order_price += $value['num']*$supermarket['price'];//计算金额

                    $order['sj_id'] = $supermarket['user_id'];//商户id
                    $order['sp_id'][]=$value['sp_id'];//商品id
                    $order['sp_name'][]=$supermarket['name'];//商品名称
                    $order['sp_img'][]=$supermarket['image'];
                    $order['price'][]=$supermarket['price'];
                    $order['quantity'][]=$value['num'];

                    Shopping::where('id', $value['id'])->delete();//删除购物车商品
                    S::where('id', $value['sp_id'])->setDec('number',$value['num']);//减去购买的数量
                }

                $supermarket = S::where('id',$sp_id)->find();
                $order_price = $supermarket['price']*$number+$order_price;
                $ress_id = Ress::where(['user_id'=>$this->id,'is_default'=>0])->find();
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

                $arr['msg'] = '减去购买的数量失败';
                S::where('id',$sp_id)->setDec('number',$number);//减去购买的数量

                $arr['msg'] = '生成订单失败';
                $order['number'] = time().rand(100000,999999);
                $order['user_id'] = $this->id;


                $order['sp_id'][] = $supermarket['id'];
                $order['sp_name'][] = $supermarket['name'];
                $order['sp_img'][] = $supermarket['image'];
                $order['price'][] = $supermarket['price'];
                $order['quantity'][] = $number;

                $order['sp_id'] = json_encode($order['sp_id']);
                $order['sp_name'] = json_encode($order['sp_name']);
                $order['sp_img'] = json_encode($order['sp_img']);
                $order['price'] = json_encode($order['price']);
                $order['quantity'] = json_encode($order['quantity']);

                $order['order_price'] = $order_price;
                $order['status'] = 1;
                $order['ress_id'] = $ress_id['id'];
                $order['create_time'] = time();


                SupermarketOrder::insert($order);//生成订单

                $arr['msg'] = '扣除用户余额失败';
                User::where('id',$this->id)->setDec('balance',$order_price);//扣除用户余额

                $arr['msg'] = '增加商户余额失败';
                AdminUser::where('id',$supermarket['user_id'])->setInc('money',$order_price);//增加商户余额

                $detail['user_id']=$this->id;
                $detail['or']=3;
                $detail['money']=$order_price;
                $detail['comment']='超市购物';
                $detail['status']=1;
                $detail['create_time']=time();
                $detail['accomplish_time']=time();
                $arr['msg'] = '添加详细信息失败';
                Db::table('tp_detail')->insert($detail);//添加详细信息


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

    public function dingdan()
    {
        $is = input('is');

        $oupermarketorder = SupermarketOrder::where(['user_id'=>$this->id])->order('create_time desc')->select();
        foreach ($oupermarketorder as $key => $value) {
            $oupermarketorder[$key]['image'] = json_decode($value['sp_img'],true);
            $oupermarketorder[$key]['quantity'] = count(json_decode($value['quantity'],true));

            $adminuser = AdminUser::where(['id'=>$value['sj_id']])->find();

            $oupermarketorder[$key]['sj_name'] = $adminuser['realname'];
            $oupermarketorder[$key]['sj_mobile'] = $adminuser['mobile'];
        }
        //dump($oupermarketorder[0]);die;
        $this->assign('is',$is);
        $this->assign('oupermarketorder',$oupermarketorder);
        return $this->fetch();
    }
    public function dingdaninfo()
    {
        $id = input('id');
        $oupermarketorder = SupermarketOrder::where(['id'=>$id])->find();
        $oupermarketorder['sp_img'] = json_decode($oupermarketorder['sp_img'],true);
        $oupermarketorder['sp_name'] = json_decode($oupermarketorder['sp_name'],true);
        $oupermarketorder['price'] = json_decode($oupermarketorder['price'],true);
        $oupermarketorder['quantity'] = json_decode($oupermarketorder['quantity'],true);
        $oupermarketorder['arr_n'] = count($oupermarketorder['quantity']);//数组数量

        $ress = Ress::where(['id'=>$oupermarketorder['ress_id']])->find();
        $adminuser = AdminUser::where(['id'=>$oupermarketorder['sj_id']])->find();

        $this->assign('oupermarketorder',$oupermarketorder);
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
            $SupermarketOrder = SupermarketOrder::where(['id'=>$id])->find();
            SupermarketOrder::where(['id'=>$id])->update(['status' => 4,'remark'=>$remark]);
            User::where('id',$this->id)->setInc('balance', $SupermarketOrder['order_price']);
            $detail['user_id']=$this->id;
            $detail['or']=5;
            $detail['money']=$SupermarketOrder['order_price'];
            $detail['comment']='退款';
            $detail['status']=1;
            $detail['create_time']=time();
            $detail['accomplish_time']=time();
            Detail::insert($detail);//添加详细信息
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
        $user = User::where('id',$this->id)->find();
        $shopping = Shopping::where('user_id',$this->id)->select();
        foreach ($shopping as $key => $value) {
            $supermarket = S::where('id',$value['sp_id'])->find();
            $shopping[$key]['sp_name'] = $supermarket['name'];
            $shopping[$key]['sp_img'] = $supermarket['image'];
            $shopping[$key]['sp_price'] = $supermarket['price'];
        }
        $ress = Ress::where(['user_id'=>$this->id,'status'=>1])->select();
        $defult = Ress::where(['user_id'=>$this->id,'is_default'=>1,'status'=>1])->find();

        $this->assign('ress',$ress);
        $this->assign('defult',$defult);
        $this->assign('shopping',$shopping);
        $this->assign('user',$user);

        return $this->fetch();
    }
    public function pay()
    {
        return $this->fetch();
    }
}
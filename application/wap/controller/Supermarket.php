<?php
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
use app\common\printer\Printer;

class Supermarket extends Yang
{
    public function index()
    {

        //获取城市id
        $city = 1;
        $citys['city_name'] = '郑州';
        $ip = $_SERVER["REMOTE_ADDR"];
        $url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        $ip=json_decode(file_get_contents($url));
        if((string)$ip->code=='0'){
            $data = (array)$ip->data;
            $citys = Db::table('tp_city')->where(['city_name'=>$data['city']])->find();
            if (!empty($citys)) {
                $city = $citys['id'];
            }else{
                $citys['city_name'] = '郑州';
            }
        }
        //根据城市id获取小区信息
        $adminuser = AdminUser::where(['city'=>$city])->select();

        $user_id = $adminuser[0]['id'];//默认显示商家id
        $supermarket = S::where(['user_id'=>$user_id])->select();
        $shopping['num'] = Shopping::where(['sj_id'=>$user_id,'user_id'=>$this->id])->sum('num');
        $shopping['price'] = Shopping::where(['sj_id'=>$user_id,'user_id'=>$this->id])->sum('price');
        $this->assign('shopping',$shopping);
        //dump($shopping);die;
        $this->assign('adminuser',$adminuser);
        $this->assign('city_name',$citys['city_name']);
        $this->assign('supermarket',$supermarket);
        return $this->fetch();
    }

    //ajax获取店铺 商品,购物车信息,
    public function dianpu()
    {
        if ($this->request->isAjax()) {
            $user_id = input('user_id');
            $supermarket = S::where(['user_id'=>$user_id])->select();
            $shopping['num'] = Shopping::where(['user_id'=>$this->id,'sj_id'=>$user_id])->sum('num');
            $shopping['price'] = Shopping::where(['user_id'=>$this->id,'sj_id'=>$user_id])->sum('price');
            $arr['supermarket'] = $supermarket;
            $arr['shopping'] = $shopping;
            return json($arr);
        }
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
    //商品减
    public function supermarketj()
    {
        if ($this->request->isAjax()) {
            $id = input('sp_id');//商品id
            $Shopping = Shopping::where(['user_id'=>$this->id,'sp_id'=>$id])->find();
            $supermarket = S::where(['id'=>$Shopping['sp_id']])->find();

            if (isset($Shopping)) {
                if ($Shopping['num']>1) {
                    Shopping::where('id',$Shopping['id'])->setDec('num',1);
                    Shopping::where('id',$Shopping['id'])->setDec('price',$supermarket['price']);
                }else{
                    Shopping::where('id',$Shopping['id'])->delete();
                }
            }
        }
    }
    //商品加
    public function supermarketja()
    {
        if ($this->request->isAjax()) {
            $id = input('sp_id');//商品id
            $Shopping = Shopping::where(['user_id'=>$this->id,'sp_id'=>$id])->find();
            $supermarket = S::where(['id'=>$id])->find();

            if (isset($Shopping)) {

                Shopping::where('id',$Shopping['id'])->setInc('num',1);
                Shopping::where('id',$Shopping['id'])->setInc('price',$supermarket['price']);

            }else{

                $shopping['user_id'] = $this->id;
                $shopping['sj_id'] = $supermarket['user_id'];
                $shopping['sp_id'] = $id;
                $shopping['num'] = 1;
                $shopping['price'] = $supermarket['price'];
                Shopping::insert($shopping);

            }
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
            $is_wx = input('is_wx');
            $data = explode(",",$data);
            $arr = ['code'=>-200,'data'=>'参数错误,请刷新重试!','msg'=>''];
            $order = [];
            $order_price = 0;//订单总金额

            $orderInfo = '<CB>趣味农场</CB><BR>名称　　　　　 单价  数量 金额<BR>';
            // $orderInfo = '<CB>趣味农场</CB><BR>';
            // $orderInfo .= '名称　　　　　 单价  数量 金额<BR>';
            // $orderInfo .= '--------------------------------<BR>';

            //生成订单,每个商品生成一笔订单
            Db::startTrans();
            try{

                foreach ($data as $key => $value) {

                    $shopping = Shopping::where('id', $data[$key])->find();
                    $supermarket = S::where('id', $shopping['sp_id'])->find();
                    $order_price += $shopping['num']*$supermarket['price'];

                    $order_price_p = $shopping['num']*$supermarket['price'];


                    $orderInfo .= $supermarket['name'];
                    $len = strlen($supermarket['name']);
                    if ($len<19) {
                        $stri = '';
                        $len = 19 - $len;
                        for ($i=0; $i < $len; $i++) {
                            $stri.=' ';
                        }
                        $orderInfo .= $stri;
                    }

                    $orderInfo .= $supermarket['price'].'  '.$shopping['num'].'   '.$order_price_p.'.00<BR>';

                    $order['sj_id'] = $supermarket['user_id'];
                    $order['sp_id'][$key]=$shopping['sp_id'];
                    $order['sp_name'][$key]=$supermarket['name'];
                    $order['sp_img'][$key]=$supermarket['image'];
                    $order['price'][$key]=$supermarket['price'];
                    $order['quantity'][$key]=$shopping['num'];


                    Shopping::where('id', $data[$key])->delete();//删除购物车商品
                    S::where('id', $shopping['sp_id'])->setDec('number',$shopping['num']);//减去购买的数量
                }

                $ress = Ress::where('id',$ress_id)->find();
                $orderInfo .= '--------------------------------<BR>';
                $orderInfo .= '合计：'.$order_price.'元<BR>';
                $orderInfo .= '送货地点：'.$ress['address'].'<BR>';
                $orderInfo .= '联系电话：'.$ress['mobile'].'<BR>';
                $orderInfo .= '下单时间：'.date("Y-m-d H:i:s",time()) .'<BR>';
                $orderInfo .= '<QR>http://nongchang.yingjisong.com</QR>';//把二维码字符串用标签套上即可自动生成二维码

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
                if ($is_wx==0) {
                    $detail['comment']='超市购物-余额支付';
                }else{
                    $detail['comment']='超市购物-微信充值';
                }
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
                    $detail['comment']='推荐赏金-超市购物';
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

            //调用打印机

            $adminUser = AdminUser::where('id',$order['sj_id'])->find();

            if (!empty($adminUser['printer_user']) && !empty($adminUser['printer_ukey']) && !empty($adminUser['number'])) {
                $printer = new Printer;
                $printer->wp_print($adminUser['printer_user'],$adminUser['printer_ukey'],$adminUser['number'],$orderInfo);
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
        $s_num = Shopping::where(['user_id'=>$this->id,'sp_id'=>$id])->find();
        $shopping['s_num'] = $s_num['num'];

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
        $user_id = input('user_id');
        $adminuser = AdminUser::where('id',$user_id)->find();

        $user = User::where('id',$this->id)->find();
        $shopping = Shopping::where(['sj_id'=>$user_id,'user_id'=>$this->id])->select();
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
        $this->assign('adminuser',$adminuser);
        $this->assign('user',$user);

        return $this->fetch();
    }
    public function pay()
    {
        return $this->fetch();
    }
}
<?php
/**
 * @Author: Marte
 * @Date:   2017-12-22 09:35:57
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-12 10:45:50
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Session;
use think\Cookie;
use think\Db;
use app\common\model\User as U;
use app\common\model\Detail as D;
use app\common\model\Order as O;
use app\common\model\Commodity as C;
use app\common\model\UserPacket as UP;
use app\common\model\Packet as P;
use app\common\model\Ress as R;
use app\common\model\Bank as B;
use app\common\model\Identity as I;
use app\common\model\Help as H;
use app\common\model\Withdraw as W;
use \app\common\getuser\Getuser;
class Member extends Yang
{
    use \app\admin\traits\controller\Controller;

    public function index()
    {
        $this->money($this->id);

        $id = Session::get('user.id');
        $name = Session::get('user.name');
        $user = U::where(['id'=>$this->id])->find();
        $balance = $user['balance'];
        $authentication = $user['authentication'];
        if ($authentication==1) {
            $authti = '已认证';
        }else{
            $authti = '未认证';
        }
        $this->assign('name',$name);
        $this->assign('balance',$balance);
        $this->assign('authti',$authti);
        return $this->fetch();
    }
    /*
     *签到
     */
    public function qiandao()
    {
        $arr = ['code'=>1,'data'=>'','msg'=>''];
        $user = U::where(['id'=>$this->id])->find();
        $id = Session::get('user.id');
        $integral = $user['integral']+20;
        U::where(['id'=>$this->id])->update(['integral'=>$integral]);
        return json_encode($arr);
    }
    /*
     *账户明细
     */
    public function userinfo()
    {
        $arr = D::where(['user_id'=>$this->id])->order('create_time desc')->select();
        $user = U::where(['id'=>$this->id])->find();
        $this->assign('arr',$arr);
        $this->assign('balance',$user['balance']);
        return $this->fetch();
    }
    /*
     *充值
     */
    public function pay()
    {
        if ($this->request->isAjax()) {

        }else{
            return $this->fetch();
        }
    }
    public function paylog()
    {
        $arr = D::where(['user_id'=>$this->id,'or'=>1])->order('create_time desc')->select();
        $money = D::where(['user_id'=>$this->id,'or'=>1,'status'=>1])->sum('money');
        $this->assign('arr',$arr);
        $this->assign('money',$money);
        return $this->fetch();
    }
    public function paygz()
    {
        return $this->fetch();
    }
    /*
     *提现
     */
    public function withdraw()
    {
        $authentication = Session::get('user.authentication');
        $this->assign('authentication',$authentication);
        $arr = B::where(['user_id'=>$this->id])->order('create_time desc')->select();
        foreach ($arr as $k => $v) {
            $arr[$k]['cardnum'] = substr($v['cardnum'],-4);
        }
        $this->assign('arr',$arr);
        return $this->fetch();
    }
    public function addwithdraw()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'添加银行卡失败'];
        if ($this->request->isAjax()) {
             $data = input();
             $data['user_id'] = $this->id;
             $data['create_time'] = time();
             $add = B::insert($data);
             if ($add) {
                $arr['code'] = 1;
                $arr['msg'] = '添加银行卡成功';
                return json_encode($arr);
             }else{
                return json_encode($arr);
             }
        }else{
            return $this->fetch();
        }
    }
    public function tiwithdraw()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'提现失败'];
        $user = U::where(['id'=>$this->id])->find();
        $kbalance=intval($user['balance']);
        if ($this->request->isAjax()) {
             $money = input('money');
             $bank_id = input('bank_id');
             if ($money>$kbalance) {
                  $arr['msg'] = '提现金额大于可提现金额';
                  return json_encode($arr);
             }
             if ($user['mobile']=='') {
                 $arr['msg']='请先在设置中绑定手机号码';
                 return json_encode($arr);
             }
             if($user['authentication']==0){
                 $arr['msg']='请实名认证后提现';
                 return json_encode($arr);
             }
             if($user['authentication']==1){
                $arr['msg']='请等待实名认证成功后提现';
                 return json_encode($arr);
             }
             $data['user_id'] = $this->id;
             $data['money'] = $money;
             $data['bank_id'] = $bank_id;
             $data['create_time'] = time();
             $data['update_time'] = time();

            $arr['msg'] = '提现申请失败!';
            $add = W::insert($data);

            $row['user_id'] = $this->id;
            $row['or'] = 2;
            $row['money'] =$money;
            $row['comment'] = '提现';
            $row['status'] = 0;
            $row['create_time'] = time();
            $row['withdraw_id'] = $bank_id;
            $row['accomplish_time'] = 0;
             D::insert($row);

            $balance = $user['balance'] - $money;
            $id = $this->id;
            $full = U::where(['id'=> $id])->update(['balance' => $balance]);
            if ($full === false) {
                $arr['code'] = -200;
                $arr['msg'] = '提现申请失败!';
                return json_encode($arr);
            }
            Session::set('user.balance',$balance);
            $arr['code'] = 1;
            $arr['msg'] = '提现申请成功';
            return json_encode($arr);
        }else{
            $id = input('id');
            $arr = B::where(['id'=>$id])->find();
            $arr['cardnum'] = substr($arr['cardnum'],-4);
            $arr['kbalance'] = $kbalance;
            $arr['balance'] = $user['balance'];
            $this->assign('arr',$arr);
            return $this->fetch();
        }
    }
    public function withdrawlog()
    {
        $arr = W::where(['user_id'=>$this->id])->order('create_time desc')->select();
        $money = W::where(['user_id'=>$this->id])->sum('money');
        $this->assign('arr',$arr);
        $this->assign('money',$money);
        return $this->fetch();
    }
    //合同
    public function contract()
    {
        $zong = 0;
        $jin = 0;
        $yidaoqi = 0;
        $arr = O::where(['user_id'=>$this->id])->order('create_time desc')->select();
        foreach ($arr as $k => $v) {
            $com = C::where(['id'=>$v['sp_id']])->find();
            $arr[$k]['name'] = $com['name'];
            $zong += 1;
            if ($v['status']==1) {
                $yidaoqi += 1;
            }else{
                $jin += 1;
            }
        }
        $shu['zong']=$zong;
        $shu['jin']=$jin;
        $shu['yidaoqi']=$yidaoqi;
        $this->assign('arr',$arr);
        $this->assign('shu',$shu);
        return $this->fetch();
    }
    //合同详情
    public function contractinfo()
    {
        $order_id = input('order_id');
        $hetong['zongshu'] = 0;
        $hetong['zongjia'] = 0;
        $hetong['create_time'] = 0;
        $sp_id = 0;
        $order = O::where(['id'=>$order_id])->order('create_time desc')->select();
        foreach ($order as $k => $v) {
            $hetong['zongshu'] = $v['sp_count'];
            $hetong['zongjia'] = $v['order_price'];
            $hetong['create_time'] = $v['create_time'];
            $sp_id = $v['sp_id'];
        }
        $com = C::where(['id'=>$sp_id])->find();

        $identity = I::where(['user_id'=>$this->id])->find();
        $hetong['username'] = $identity['name'];
        $hetong['name'] = $com['name'];
        $hetong['price'] = $com['price'];
        $hetong['kashitime'] = $com['begin_time'];
        $hetong['jieshutime'] = $com['over_time'];
        $hetong['qianyuetime'] = $com['over_time'];
        $this->assign('hetong',$hetong);
        return $this->fetch();
    }

    //邀请
    public function invite()
    {
        return $this->fetch();
    }
    public function invitehb()
    {
        return $this->fetch();
    }
    public function tggz()
    {
        return $this->fetch();
    }
    public function wdhy()
    {
        return $this->fetch();
    }
    public function tghb()
    {
        return $this->fetch();
    }
    public function shopplog()
    {
        $arr = O::where(['user_id'=>$this->id])->select();
        foreach ($arr as $k => $v) {
            $com = C::where(['id'=>$v['id']])->find();
            $arr[$k]['name'] = $com['name'];
        }
        $this->assign('arr',$arr);
        return $this->fetch();
    }
    /*
     *现金红包
     */
    public function packet()
    {
        $arr = UP::where(['user_id'=>$this->id])->select();
        $this->assign('arr',$arr);
        return $this->fetch();
    }
    public function dhpacket()
    {
        if ($this->request->isAjax()) {
            $pid = input('id');
            $user = U::where(['id'=>$this->id])->find();
            $integral = $user['integral'];
            $pp = P::where(['id'=>$pid])->find();
            if ($pp['integral']>$integral) {
                $arr = ['code'=>-200,'data'=>'','msg'=>'积分不足!'];
                return json_encode($arr);
            }
            $ye = $integral - $pp['integral'];
            $result = U::where(['id'=>$this->id])->update(['integral' => $ye]);
            if ($result!==false) {
                 $up = UP::where(['user_id'=>$this->id,'money'=>$pp['money'],'remark'=>$pp['remark']])->find();
                 if (isset($up)) {
                     $number = $up['number'] + $pp['number'];
                     UP::where(['user_id'=>$this->id])->update(['number' => $number]);
                 }else{
                    $data = ['user_id'=>$this->id,'number'=>$pp['number'],'money'=>$pp['money'],'remark'=>$pp['remark']];
                     UP::insert($data);;
                 }
                 $arr = ['code'=>1,'data'=>'','msg'=>'兑换成功'];
                 return json_encode($arr);
            }else{
                $arr = ['code'=>-200,'data'=>'','msg'=>'兑换失败'];
                 return json_encode($arr);
            }

        }else{
            $arr = P::select();
            $this->assign('arr',$arr);
            return $this->fetch();
        }
    }
    /*
     *收获地址
     */
    public function listress()
    {
        $code = input('code');
         if ($this->request->isAjax()) {
            $id = input('id');
            $arr = ['code'=>-200,'data'=>'','msg'=>'设置默认地址失败'];
            Db::startTrans();
            try{
                R::where(['user_id'=>$this->id])->update(['is_default'=>0]);
                R::where(['id'=>$id,'user_id'=>$this->id])->update(['is_default'=>1]);
                // 提交事务
                Db::commit();
            } catch (\think\Exception $e) {
                // 回滚事务
                Db::rollback();
                return json_encode($arr);
            }
            $arr['code'] = 1;
            $arr['msg'] = '设置成功';
            return json_encode($arr);
         }else{

        /***************微信获取收获地址代码**************************************************/
            // $getuser = new Getuser;
            // $wxpay = new Wxpay;
            // if ($code) {

            //     $access_token = $getuser->gettoken($code);//取得token
            //     if ($access_token===false) {
            //         echo 'token参数错误';
            //     }else{
            //         //echo $access_token;die;
            //         $editAddress = $wxpay->getaddress($access_token);
            //         //$editAddress = json_decode($editAddress);
            //         $this->assign('editAddress',$editAddress);
            //         $arr = R::where(['user_id'=>$this->id])->select();
            //         $this->assign('arr',$arr);
            //         return $this->fetch();
            //     }
            // }else{
            //     $url = $getuser->geturl(1);//传入参数 改变返回code地址
            //     $this->redirect($url);echo $url;die;
            // }
        /**************************************************微信获取收获地址代码****************/


            $arr = R::where(['user_id'=>$this->id])->select();
            $this->assign('arr',$arr);
            return $this->fetch();
        }
    }
    public function address()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'添加地址失败'];
        if ($this->request->isAjax()) {
             $data = input();
             if ($data['is_default']==1) {
                 R::where(['user_id'=>$this->id])->update(['is_default'=>0]);
             }
             $data['user_id'] = $this->id;
             $data['create_time'] = time();
             $add = R::insert($data);
             if ($add) {
                $arr['code'] = 1;
                $arr['msg'] = '地址添加成功';
                return json_encode($arr);
             }else{
                return json_encode($arr);
             }
        }else{
            return $this->fetch();
        }

    }
    public function editress()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'修改地址失败'];
        if ($this->request->isAjax()) {
             $data = input();
             if ($data['is_default']==1) {
                 R::where(['user_id'=>$this->id])->update(['is_default'=>0]);
             }

             $add = R::update($data);
             if ($add !==false) {
                $arr['code'] = 1;
                $arr['msg'] = '修改地址成功';
                return json_encode($arr);
             }else{
                return json_encode($arr);
             }
        }else{
            $id = input('id');
            $ress = R::where(['id'=>$id])->find();
            $this->assign('ress',$ress);
            return $this->fetch();
        }

    }
    /*
     *设置
     */
    public function setting()
    {
        $user = U::where(['id'=>$this->id])->find();
        $authentication = $user['authentication'];
        $mobile = $user['mobile'];
        $user = Session::get('user');
        if ($authentication == 1) {
            $au = I::where(['user_id'=>$this->id])->find();
            if ($au['status'] == 1) {
                U::where(['id'=>$this->id])->update(['authentication'=>2]);
                Session::set('user.authentication',2);
                $authentication = 2;
            }
        }

        $this->assign('authentication',$authentication);
        $this->assign('mobile',$mobile);
        return $this->fetch();
    }
    /*
     *银行卡
     */
    public function listbank()
    {
            $arr = B::where(['user_id'=>$this->id])->select();
            $this->assign('arr',$arr);
            return $this->fetch();
    }
    public function addbank()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'添加地址失败'];
        if ($this->request->isAjax()) {
             $data = input();
             $add = B::insert($data);
             if ($add) {
                $arr['code'] = 1;
                $arr['msg'] = '地址添加成功';
                return json_encode($arr);
             }else{
                return json_encode($arr);
             }
        }else{
            return $this->fetch();
        }
    }
    /*
     *身份认证
     */
    public function identity()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'身份认证提交失败'];
        if ($this->request->isAjax()) {
             $data = input();
             $data['user_id'] = $this->id;
             $data['create_time'] = time();
             $data['update_time'] = time();
             $iden = I::where(['identity_card'=>$data['identity_card']])->find();
             $user = U::where(['id'=>$this->id])->find();
             if ($user['mobile']=='') {
                 $arr['msg'] = '请先在设置中绑定手机号码!';
                 return json_encode($arr);
             }
             if (isset($iden)) {
                 $arr['msg'] = '身份证号码已被绑定!';
                 return json_encode($arr);
             }
             $add = I::insert($data);
             if ($add) {
                U::where(['id'=>$this->id])->update(['authentication'=>1]);
                Session::set('user.authentication',1);
                $arr['code'] = 1;
                $arr['msg'] = '身份认证提交成功';
                return json_encode($arr);
             }else{
                return json_encode($arr);
             }
        }else{
            return $this->fetch();
        }
    }
    /*
     *帮助
     */
    public function help()
    {
        $help = H::select();
        $this -> assign('help',$help);
        return $this->fetch();
    }
    public function helpinfo()
    {
        $id = input('id');
        $help = H::where(['id'=>$id])->find();
        $this -> assign('help',$help);
        return $this->fetch();
    }
}
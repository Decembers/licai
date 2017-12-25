<?php
/**
 * @Author: Marte
 * @Date:   2017-12-22 09:35:57
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-25 16:29:25
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Session;
use app\common\model\User as U;
use app\common\model\Detail as D;
use app\common\model\Order as O;
use app\common\model\Commodity as C;
use app\common\model\UserPacket as UP;
use app\common\model\Packet as P;
use app\common\model\Ress as R;
use app\common\model\Bank as B;
use app\common\model\Identity as I;

class Member extends Yang
{
    public function index()
    {
        $id = Session::get('user.id');
        $name = Session::get('user.name');
        $balance = Session::get('user.balance');
        $authentication = Session::get('user.authentication');
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
     *账户明细
     */
    public function userinfo()
    {
        $arr = D::where(['user_id'=>$this->id])->select();
        $balance = Session::get('user.balance');
        $this->assign('arr',$arr);
        $this->assign('balance',$balance);
        return $this->fetch();
    }
    /*
     *充值
     */
    public function pay()
    {
        return $this->fetch();
    }
    public function paylog()
    {
        $arr = D::where(['user_id'=>$this->id,'or'=>1])->select();
        $money = D::where(['user_id'=>$this->id,'or'=>1])->sum('money');
        $this->assign('arr',$arr);
        $this->assign('money',$money);
        return $this->fetch();
    }
    /*
     *提现
     */
    public function withdraw()
    {
        $authentication = Session::get('user.authentication');
        $this->assign('authentication',$authentication);
        return $this->fetch();
    }
    public function withdrawlog()
    {
        $arr = D::where(['user_id'=>$this->id,'or'=>2])->select();
        $money = D::where(['user_id'=>$this->id,'or'=>2])->sum('money');
        $this->assign('arr',$arr);
        $this->assign('money',$money);
        return $this->fetch();
    }
    //合同
    public function contract()
    {
        $arr = O::where(['user_id'=>$this->id])->select();
        $this->assign('arr',$arr);
        //var_dump($arr);die;
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
        $arr = R::where(['user_id'=>$this->id])->select();
        $this->assign('arr',$arr);
        return $this->fetch();
    }
    public function address()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'添加地址失败'];
        if ($this->request->isAjax()) {
             $data = input();
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
    /*
     *设置
     */
    public function setting()
    {
        $authentication = Session::get('user.authentication');
        $this->assign('authentication',$authentication);
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
             $add = I::insert($data);
             if ($add) {
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
        return $this->fetch();
    }
    public function helpinfo()
    {
        return $this->fetch();
    }
}
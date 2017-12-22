<?php
/**
 * @Author: Marte
 * @Date:   2017-12-22 09:35:57
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-22 16:50:33
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Session;
use app\common\model\User as U;

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
    public function userinfo()
    {
        return $this->fetch();
    }
    public function pay()
    {
        return $this->fetch();
    }
    public function paylog()
    {
        return $this->fetch();
    }
    public function withdraw()
    {
        return $this->fetch();
    }
    public function withdrawlog()
    {
        return $this->fetch();
    }
    //合同
    public function contract()
    {
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
    public function packet()
    {
        return $this->fetch();
    }
    public function dhpacket()
    {
        return $this->fetch();
    }
    public function address()
    {
        return $this->fetch();
    }
    public function setting()
    {
        return $this->fetch();
    }
    public function help()
    {
        return $this->fetch();
    }
    public function helpinfo()
    {
        return $this->fetch();
    }
}
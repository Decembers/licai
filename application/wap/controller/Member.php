<?php
/**
 * @Author: Marte
 * @Date:   2017-12-22 09:35:57
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-22 10:09:41
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

    /*
     *羊群列表
     */
    public function orlist()
    {
        $this->assign('vipy',$vipy);

        return $this->fetch();
    }

}
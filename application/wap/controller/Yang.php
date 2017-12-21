<?php
/**
 * @Author: Marte
 * @Date:   2017-12-21 13:43:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-21 17:52:36
 */
namespace app\wap\controller;
use think\Controller;
use think\Session;
use think\Cookie;


class yang extends Controller
{
    protected $arr = ['Index/index','Login/login','Login/nopassword','Login/checkreg','Login/checkindex','Login/reg','Login/admin'];
    public function __construct()
    {
        parent::__construct();
        $request=  \think\Request::instance();
        $con = $request->controller();
        $act = $request->action();
        $url = $con.'/'.$act;
        if (!in_array($url,$this->arr)) {
            $suser = Session::get('user');
            if (!isset($suser)) {
                    $cuser = Cookie::get('name');
                if (!isset($cuser)) {
                    $this->redirect('wap/login/login');
                }else{
                    $user = Cookie::get('name');
                    $arr = unserialize($user);
                    Session::set('user',$arr);
                }
            }
        }

    }
}
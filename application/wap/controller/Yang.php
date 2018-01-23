<?php
/**
 * @Author: Marte
 * @Date:   2017-12-21 13:43:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-22 16:26:53
 */
namespace app\wap\controller;
use think\Controller;
use think\Session;
use think\Cookie;
use app\common\model\User as U;

class yang extends Controller
{
    protected $arr = ['Index/index','Login/login','Login/wxlogin','Login/nopassword','Login/checkreg','Login/checkindex','Login/reg','Login/admin','Login/getaccess_token','Login/codemsg','Wxpay/weixinjsapnotify'];
    public $id = null;
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
                    $cuser = Cookie::get('user_id');
                if (!isset($cuser)) {
                    $this->redirect('wap/login/login');
                }else{
                    $user = U::where(['id'=>$cuser])->find();
                    Session::set('user',$user);
                    $this->id =Session::get('user.id');
                }
            }else{
                $this->id =Session::get('user.id');
            }
        }

    }
}
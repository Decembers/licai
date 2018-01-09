<?php
/**
 * @Author: Marte
 * @Date:   2017-12-21 13:43:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-09 10:15:09
 */
namespace app\wap\controller;
use think\Controller;
use think\Session;
use think\Cookie;
use app\common\model\User as U;

class yang extends Controller
{
    protected $arr = ['Index/index','Login/login','Login/nopassword','Login/checkreg','Login/checkindex','Login/reg','Login/admin','Login/getaccess_token','Login/codemsg','Wxpay/weixinjsapnotify'];
    public $id = null;
    //define("URLL","http://nongchang.yingjisong.com"); //跳转地址域名
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
                    $user_id = Cookie::get('user_id');
                    $user = U::where(['id'=>$user_id])->find();
                    Session::set('user',$user);
                }
            }else{
                $this->id =Session::get('user.id');
            }
        }

    }
}
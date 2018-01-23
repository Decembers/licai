<?php
/**
 * @Author: Marte
 * @Date:   2017-12-21 13:43:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-23 10:50:42
 */
namespace app\wap\controller;
use think\Controller;
use think\Session;
use think\Cookie;
use app\common\model\User as U;

class yang extends Controller
{
    protected $arr = ['Index/index','Login/login','Login/wxlogin','Login/nopassword','Login/has','Login/checkreg','Login/checkindex','Login/reg','Login/admin','Login/getaccess_token','Login/codemsg','Wxpay/weixinjsapnotify'];
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
                //未登录
                    $cuser = Cookie::get('user_id');
                if (!isset($cuser)) {
                    //无cookie
                    $this->redirect('wap/login/login');
                }else{
                    //有cookie
                    $user = U::where(['id'=>$cuser])->find();
                    $user_login = rand('10000000','99999999');
                    U::where(['id'=>$cuser])->update(['user_login'=>$user_login]);
                    $user['user_login'] = $user_login;
                    Session::set('user',$user);
                    $this->id =Session::get('user.id');
                }
            }else{
                //用户已登陆 有session 验证session中的user_login 是否跟数据表中的一致
                $this->id =Session::get('user.id');
                $user_login = Session::get('user.user_login');
                $user = U::where(['id'=>$this->id])->find();
                if ($user_login!=$user['user_login']) {
                    $this->redirect('wap/login/has');
                }
            }
        }

    }
}
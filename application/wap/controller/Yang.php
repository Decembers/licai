<?php
namespace app\wap\controller;
use think\Controller;
use think\Session;
use think\Cookie;
use app\common\model\User as U;

class yang extends Controller
{
    protected $arr = ['Index/index','Login/login','Login/wxlogin','Login/nopassword','Login/has','Login/checkreg','Login/checkindex','Login/reg','Login/admin','Login/getaccess_token','Login/codemsg','Wxpay/weixinjsapnotify','Discover/index','Index/zhidao','Index/orlist','Video/index','Index/baozhang','Login/has','Index/gonggao','Index/gonggaoin','Index/introduce','Discover/info','Supermarket/index','Supermarket/dianpu','Supermarket/info','Order/info','Order/infolist','Order/number','Order/xieyi','Today/index'];
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
                    if ($url=='Member/invite') {
                        if (!empty(input('friends'))) {
                            Cookie::set('referrer',input('friends'));
                        }
                        $this->redirect('wap/Index/index');
                    }
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
                if ($url=='Member/invite') {
                    if (input('friends')!=$this->id) {
                        $this->redirect('wap/Index/index');
                    }
                }

            }
        }else{
            $user_id = Session::get('user.id');
            if (isset($user_id)) {
                $this->id =Session::get('user.id');
            }
        }
    }
}
<?php
/**
 * @Author: Marte
 * @Date:   2017-12-08 10:07:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-19 16:47:18
 */
namespace app\wap\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use app\common\model\User;
/**
* 会员管理
*/
class Login extends Controller
{

    public function login()
    {
        return  $this->fetch();
    }

    //登录验证
    public function checkindex()
    {
        if ($this->request->isAjax() && $this->request->isPost())
        {
            $mobile=input('post.mobile');
            $password=input('post.password');
            $arr = input('post.');
            $arr['password'] = md5($password);

        if (!$mobile) {
            return json(['code'=>1, 'msg'=>'手机号不能为空']);
        }
        if (!$password) {
            return json(['code'=>1, 'msg'=>'密码不能为空']);
        }
        if (!checkMobile($mobile)) {
            return json(['code'=>1, 'msg'=>'手机号格式不正确']);
        }
        $res = User::where($arr)->find();

        if (is_array($res)) {

            $url = Url::build('index/index');
            return json(['code'=>200, 'msg'=>'登录成功','url'=>$url]);
        } else {
            return json(['code'=>1, 'msg'=>'帐号或密码错误']);
        }
            return json(['code'=>1, 'msg'=>'登录失败']);

        }else{
            return json(['code'=>1, 'msg'=>'非法请求']);
        }
    }

    public function reg()
    {
        return $this->fetch();
    }

    /**
     * 用户注册操作 tml 20170920
     */
    public function checkreg()
    {
        if ($this->request->isAjax() && $this->request->isPost())
        {
            $add       = input('post.');
            $mobile    = input('post.mobile');
            $name    = input('post.name');
            //$code      = input('post.code');
            $user_type  =input('post.user_type');
            $password  = input('post.password');


            if (!$mobile) {
                return json(['code'=>1, 'msg'=>'手机号不能为空']);
            }
            if (!checkMobile($mobile)) {
                return json(['code'=>1, 'msg'=>'手机号格式不正确']);
            }
            $user = User::where(['mobile'=>$mobile])->find();
            if ($user) {
                return json(['code'=>1, 'msg'=>'手机号已存在']);
            }
            //$scode = empty($_SESSION['code'][$mobile]['code']) ? '' : $_SESSION['code'][$mobile]['code'];
            //$stime = empty($_SESSION['code'][$mobile]['time']) ? 0 : $_SESSION['code'][$mobile]['time'];
            //if (!$scode || $scode != $messcode) {
            //   echo json_encode(array('code'=>-200,'msg'=>'短信验证码错误'));exit;
            //}
            // if ($scode && $scode == $messcode) {
            //     if (time() > ($stime + 5*60)) {
            //         echo json_encode(array('code'=>-200,'msg'=>'短信验证码已失效'));exit;
            //     }
            // }
            if (!$password) {
                return json(['code'=>1, 'msg'=>'密码不能为空']);
            }
            if (strlen($password) > 20 || strlen($password) < 6) {
                return json(['code'=>1, 'msg'=>'密码长度需在6~20位之间']);
            }

            $add['createt_time']=time();
            $add['status']=1;
            $add['login_time']=time();
            $add['password']=md5($password);
            $res = User::insert($add);
            if ($res!==false) {
                return json(['code'=>200, 'msg'=>'注册成功,即将跳转到登录页']);
            }
            return json(['code'=>1, 'msg'=>'注册失败']);

        }else{
            return json(['code'=>1, 'msg'=>'非法请求']);
        }
    }

    public function nopassword()
    {
          if ($this->request->isAjax() && $this->request->isPost())
                {
                $mobile=input('post.mobile');
                $password=input('post.password');
                $arr = input('post.');
                $arr['password'] = md5($password);
                //$code      = input('post.code');手机验证码

                if (!$mobile) {
                    return json(['code'=>1, 'msg'=>'手机号不能为空']);
                }
                if (!$password) {
                    return json(['code'=>1, 'msg'=>'密码不能为空']);
                }
                if (!checkMobile($mobile)) {
                    return json(['code'=>1, 'msg'=>'手机号格式不正确']);
                }

                //$scode = empty($_SESSION['code'][$mobile]['code']) ? '' : $_SESSION['code'][$mobile]['code'];
                //$stime = empty($_SESSION['code'][$mobile]['time']) ? 0 : $_SESSION['code'][$mobile]['time'];
                //if (!$scode || $scode != $messcode) {
                //   echo json_encode(array('code'=>-200,'msg'=>'短信验证码错误'));exit;
                //}
                // if ($scode && $scode == $messcode) {
                //     if (time() > ($stime + 5*60)) {
                //         echo json_encode(array('code'=>-200,'msg'=>'短信验证码已失效'));exit;
                //     }
                // }



                $res = User::where(['mobile'=>$mobile])->find();

                if (is_array($res)) {

                    $url = Url::build('login/login');
                    $ress = User::where(['mobile'=>$mobile])->save($arr);
                    return json(['code'=>200, 'msg'=>'重置密码成功,请登录','url'=>$url]);
                } else {
                    return json(['code'=>1, 'msg'=>'手机号码不存在']);
                }

                return json(['code'=>1, 'msg'=>'重置密码失败']);

                }else{
                    return json(['code'=>1, 'msg'=>'非法请求']);
                }
    }

    /*
     * 测试用登录
     */
    public function admin()
    {
       $arr = User::where(['id'=>33])->find();
       Session::set('user',$arr);
       echo 'ok';
    }
    public function noadmin()
    {
       Session::delete('user');
       echo 'ok';
    }
}

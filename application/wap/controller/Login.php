<?php
/**
 * @Author: Marte
 * @Date:   2017-12-08 10:07:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-27 14:27:45
 */
namespace app\wap\controller;
use think\Controller;
use think\Request;
use think\Db;
use think\Session;
use think\Cookie;
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
            //return json($arr);

        if (!$mobile) {
            return json(['code'=>1, 'msg'=>'手机号不能为空']);
        }
        if (!$password) {
            return json(['code'=>1, 'msg'=>'密码不能为空']);
        }
        if (!checkMobile($mobile)) {
            return json(['code'=>1, 'msg'=>'手机号格式不正确']);
        }
        $res = User::where(['mobile'=>$arr['mobile']])->find();

        if (isset($res)) {
            if ($res['password']==$arr['password']) {
                //存cookie
                unset($res['password']);
                unset($res['pay_pass']);
                unset($res['isdelete']);
                Session::set('user',$res);
                $user = serialize($res);
                Cookie::set('user',$user,2592000);
                return json(['code'=>200, 'msg'=>'登录成功']);
            }else{
                return json(['code'=>1, 'msg'=>'密码错误']);
            }
        } else {
            return json(['code'=>1, 'msg'=>'用户名不存在']);
        }
            return json(['code'=>1, 'msg'=>'登录失败']);

        }else{
            return json(['code'=>1, 'msg'=>'非法请求']);
        }
    }
    /**
     * 用户注册操作 tml 20170920
     */
    public function checkreg()
    {
        if ($this->request->isAjax() && $this->request->isPost())
        {
            $mobile    = input('post.mobile');
            $password  = input('post.password');
            $name    = input('post.name');
            $code      = input('post.code');//验证码
            $referer  =input('post.referer');

            $row['mobile']=input('post.mobile');
            $row['password']=input('post.password');
            $row['name']=input('post.name');
            $row['referrer']=input('post.referrer');



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

            $row['create_time']=time();
            $row['status']=1;
            $row['login_time']=time();
            $row['password']=md5($password);
            $res = User::insert($row);
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
                $mobile=Session::get('user.mobile');
                $password=input('post.password');
                $arr['mobile']= $mobile;
                $arr['password'] = md5($password);
                $code      = input('post.code');

                if (!$password) {
                    return json(['code'=>1, 'msg'=>'密码不能为空']);
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

                if (isset($res)) {

                    $ress = User::where(['mobile'=>$mobile])->update($arr);
                    return json(['code'=>200, 'msg'=>'重置密码成功']);
                }

                return json(['code'=>1, 'msg'=>'重置密码失败']);

                }else{
                    return $this->fetch();
                }
    }

    /*
     *修改支付密码
     */
    public function nopay(){
        if ($this->request->isAjax() && $this->request->isPost()){
                $mobile=Session::get('user.mobile');
                $pay_pass=input('post.pay_pass');
                $arr['mobile']= $mobile;
                $arr['pay_pass'] = md5($pay_pass);
                $code      = input('post.code');
                if (!$pay_pass) {
                    return json(['code'=>1, 'msg'=>'支付密码不能为空']);
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

                if (isset($res)) {

                    $ress = User::where(['mobile'=>$mobile])->update($arr);
                    return json(['code'=>200, 'msg'=>'重置支付密码成功,请登录']);
                }

                return json(['code'=>1, 'msg'=>'重置支付密码失败']);
        }else{
            return $this->fetch();
        }
    }

/*
 *修改手机号码
 */
    public function nomobile(){
        if ($this->request->isAjax() && $this->request->isPost()){
                $mobile=input('post.mobile');
                $mobilex=input('post.mobilex');
                $arr['mobile']= input('post.mobilex');//新手机号
                $code      = input('post.code');
                $id = Session::get('user.id');

                if (!$mobile) {
                    return json(['code'=>1, 'msg'=>'老手机号不能为空']);
                }
                if (!$mobilex) {
                    return json(['code'=>1, 'msg'=>'新手机号不能为空']);
                }
                if (!checkMobile($mobile)) {
                    return json(['code'=>1, 'msg'=>'手机号格式不正确']);
                }
                if (!checkMobile($mobilex)) {
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

                if (isset($res)) {
                    if ($res['id']!=$id) {
                        return json(['code'=>1, 'msg'=>'非法请求']);
                    }
                    $ress = User::where(['mobile'=>$mobile])->update($arr);
                    if ($ress===false) {
                        return json(['code'=>1, 'msg'=>'重置手机号码失败']);
                    }else{
                        //删除session cookie 写入新session cookie
                        $user = User::where(['mobile'=>$mobile])->find();
                        Session::set('user',$user);
                        $userc = serialize($user);
                        Cookie::set('user',$userc,2592000);
                        return json(['code'=>200, 'msg'=>'重置手机号码成功']);
                    }

                } else {
                    return json(['code'=>1, 'msg'=>'手机号码不存在']);
                }

                return json(['code'=>1, 'msg'=>'重置手机号码失败']);
        }else{
            return $this->fetch();
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
       Cookie::delete('user');
       $this->redirect('Index/index');
    }
}

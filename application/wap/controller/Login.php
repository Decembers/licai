<?php
/**
 * @Author: Marte
 * @Date:   2017-12-08 10:07:44
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-02-03 11:37:07
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Request;
use think\Db;
use think\Session;
use think\Cookie;
use app\common\model\User;
use app\common\getuser\Getuser;

/**
* 会员管理
*/
class Login extends Yang
{
    use \app\admin\traits\controller\Controller;
    public function login()
    {
            $id = 0;
            if (!empty(input('friends'))) {
                $id = input('friends');
            }
            $this->assign('friends',$id);
            return  $this->fetch();
    }

    public function wxlogin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            //在微信内打开
            $getuser = new Getuser;
            if (input('referrer')) {
                echo input('referrer');die;
                Session::set('referrer',input('referrer'));
            }
            $url = $getuser->geturl();
            $this->redirect($url);
        }else{
            //不在微信内
            echo '请在微信内使用微信登录';
        }
    }

    public function getaccess_token()
    {
        $code = input('code');
        if (isset($code)) {
            $getuser = new Getuser;
            $result = $getuser->getaccess_token($code);
            //echo $result;die;
            //是否成功 成功跳转
            if ($result) {
                if (Session::get('user.mobile') == '') {
                    return $this->fetch('phone');
                }
                if (Session::get('user.authentication') == 0) {
                    return $this->fetch('identity');
                }
                $this->redirect(url('index/index'));
            }else{
                echo "微信获取失败,请从新登录!";
            }
        }else{
            echo "微信获取失败,请从新登录!";
        }
    }

    //登录验证
    public function checkindex()
    {
        if ($this->request->isAjax() && $this->request->isPost())
        {
            $mobile=input('post.mobile');
            $code=input('post.code');
            $referrer=input('post.referrer');
            $arr = input('post.');

        if (!$mobile) {
            return json(['code'=>1, 'msg'=>'手机号不能为空']);
        }
        if (!checkMobile($mobile)) {
            return json(['code'=>1, 'msg'=>'手机号格式不正确']);
        }
        if ($code == '') {
            return json(['code'=>1, 'msg'=>'短信验证码不能为空']);
        }
        if ($code != Session::get($mobile)) {
            return json(['code'=>1, 'msg'=>'短信验证码错误']);
        }
        $times=Session::get($code);
        if (time() > ($times+5*60)) {
            Session::delete($times);
            return json(['code'=>1, 'msg'=>'短信验证码已失效']);
        }

        $res = User::where(['mobile'=>$mobile])->find();
        if (isset($res)) {
                //存cookie
                Session::delete($mobile);
                Session::delete($times);
                $user_login = rand('10000000','99999999');
                User::where(['mobile'=>$mobile])->update(['user_login'=>$user_login]);
                $res['user_login'] = $user_login;
                Session::set('user',$res);
                Cookie::set('user_id',$res['id'],2592000);
                $url = url("index/index");
                if ($res['authentication'] == 0) {
                    $url = url("login/identity");
                }
                return json(['code'=>200, 'msg'=>'登录成功','url'=>$url]);

        } else {

            $row['mobile']=$mobile;
            $row['name'] = '农场主';
            $row['create_time']=time();
            $row['status']=1;
            $row['login_time']=time();
            $row['integral']=1000;
            $row['referrer']=$referrer;
            $res = User::insert($row);
            if ($res!==false) {
                Session::delete($mobile);
                Session::delete($times);
                $res = User::where(['mobile'=>$mobile])->find();
                $user_login = rand('10000000','99999999');
                User::where(['mobile'=>$mobile])->update(['user_login'=>$user_login]);
                $res['user_login'] = $user_login;
                Session::set('user',$res);
                Cookie::set('user_id',$res['id'],2592000);
                $url = url("login/identity");
                return json(['code'=>200, 'msg'=>'登录成功','url'=>$url]);
            }
            return json(['code'=>1, 'msg'=>'登录失败']);
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
            //$password  = input('post.password');
            $name    = input('post.name');
            $code      = input('post.code');//验证码
            $referer  =input('post.referer');

            $row['mobile']=input('post.mobile');
            //$row['password']=input('post.password');
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
            if ($code != Session::get($mobile)) {
                return json(['code'=>1, 'msg'=>'短信验证码错误']);
            }
            $times=Session::get($code);
            if (time() > ($times+5*60)) {
                Session::delete($times);
                return json(['code'=>1, 'msg'=>'短信验证码已失效']);
            }
            // if (!$password) {
            //     return json(['code'=>1, 'msg'=>'密码不能为空']);
            // }
            // if (strlen($password) > 20 || strlen($password) < 6) {
            //     return json(['code'=>1, 'msg'=>'密码长度需在6~20位之间']);
            // }

            $row['create_time']=time();
            $row['status']=1;
            $row['login_time']=time();
            $row['integral']=1000;
            $res = User::insert($row);
            if ($res!==false) {
                Session::delete($mobile);
                Session::delete($times);
                $res = User::where(['mobile'=>$mobile])->find();
                $user_login = rand('10000000','99999999');
                User::where(['mobile'=>$mobile])->update(['user_login'=>$user_login]);
                $res['user_login'] = $user_login;
                Session::set('user',$res);
                Cookie::set('user_id',$res['id'],2592000);
                return json(['code'=>200, 'msg'=>'注册成功']);
            }
            return json(['code'=>1, 'msg'=>'注册失败']);

        }else{
            return json(['code'=>1, 'msg'=>'非法请求']);
        }
    }
    /*
     * 发送验证码
     */
    public function codemsg()
    {
        if ($this->request->isAjax() && $this->request->isPost()){
            $mobile = input('mobile');
            $model = input('model');
            if ($mobile==''||$model=='') {
                return json(['code'=>1, 'msg'=>'数据丢失']);
            }
            if (!checkMobile($mobile)) {
                return json(['code'=>1, 'msg'=>'手机号格式不正确']);
            }
            $result = $this->message($mobile,$model);
            if ($result) {
                return json(['code'=>200, 'msg'=>'发送成功']);
            }
            return json(['code'=>1, 'msg'=>'发送失败']);
        }
        return json(['code'=>1, 'msg'=>'非法请求']);
    }

    /*
     * 修改密码
     */
    public function nopassword()
    {
          if ($this->request->isAjax() && $this->request->isPost())
                {
                $mobile=Session::get('user.mobile');
                if (!isset($mobile)) {
                    $mobile = input('post.mobile');
                }
                $password=input('post.password');
                $arr['mobile']= $mobile;
                $arr['password'] = md5($password);
                $code      = input('post.code');

                if (!$password) {
                    return json(['code'=>1, 'msg'=>'密码不能为空']);
                }
                if (!$mobile) {
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
                }else{
                    return json(['code'=>1, 'msg'=>'用户不存在']);
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
             $user = User::where(['id'=>$this->id])->find();
                 if ($user['mobile']=='') {
                     $arr['msg'] = '请先在设置中绑定手机号码!';
                     return json_encode($arr);
                 }
                $mobile=Session::get('user.mobile');
                $pay_pass=input('post.pay_pass');
                $code      = input('post.code');
                $times=Session::get($code);
                $arr['mobile']= $mobile;
                $arr['pay_pass'] = md5($pay_pass);

                if (!$pay_pass) {
                    return json(['code'=>1, 'msg'=>'支付密码不能为空']);
                }
                if (strlen($pay_pass) != 6) {
                    return json(['code'=>1, 'msg'=>'支付密码长度为六位']);
                }
                if (empty(input('post.shibie'))) {
                    if ($code == '') {
                        return json(['code'=>1, 'msg'=>'短信验证码不能为空']);
                    }
                    if ($code != Session::get($mobile)) {
                        return json(['code'=>1, 'msg'=>'短信验证码错误']);
                    }
                    if (time() > ($times+5*60)) {
                        Session::delete($times);
                        return json(['code'=>1, 'msg'=>'短信验证码已失效']);
                    }
                }
                $res = User::where(['mobile'=>$mobile])->find();
                if (isset($res)) {
                    Session::delete($mobile);
                    Session::delete($times);
                    $ress = User::where(['mobile'=>$mobile])->update($arr);
                    Session::set('user.pay_pass',$arr['pay_pass']);
                    return json(['code'=>200, 'msg'=>'支付密码设置成功']);
                }

                return json(['code'=>1, 'msg'=>'支付密码设置失败']);
        }else{

            return $this->fetch();
        }
    }

/*
 *修改手机号码
 */
    public function nomobile(){
        if ($this->request->isAjax() && $this->request->isPost()){

                $user = User::where(['id'=>$this->id])->find();
                if ($user['mobile']=='') {
                     $arr['msg'] = '请先在设置中绑定手机号码!';
                     return json_encode($arr);
                }

                $mobile=Session::get('user.mobile');
                $mobilex=input('post.mobilex');
                $arr['mobile']= $mobilex;//新手机号
                $code      = input('post.code');
                $user = User::where(['mobile'=>$mobilex])->find();
                if (isset($user)) {
                    return json(['code'=>1, 'msg'=>'新手机号已被绑定']);
                }
                if (!$mobilex) {
                    return json(['code'=>1, 'msg'=>'新手机号不能为空']);
                }
                if (!checkMobile($mobilex)) {
                    return json(['code'=>1, 'msg'=>'手机号格式不正确']);
                }
                if ($code != Session::get($mobile)) {
                    return json(['code'=>1, 'msg'=>'短信验证码错误']);
                }
                $times=Session::get($code);
                if (time() > ($times+5*60)) {
                    Session::delete($times);
                    return json(['code'=>1, 'msg'=>'短信验证码已失效']);
                }

                $ress = User::where(['id'=>$this->id])->update($arr);

                if ($ress===false) {
                    return json(['code'=>1, 'msg'=>'重置手机号码失败']);
                }else{
                    Session::delete($mobile);
                    Session::delete($times);
                    Session::set('user.mobile',$mobilex);
                    return json(['code'=>200, 'msg'=>'重置手机号码成功']);
                }
                return json(['code'=>1, 'msg'=>'重置手机号码失败']);
        }else{
            return $this->fetch();
        }
    }

    /*
     * 绑定手机号码
     */
    public function mobile()
    {
        if ($this->request->isAjax() && $this->request->isPost()){
                $mobile=input('post.mobile');
                $code      = input('post.code');
                $arr['mobile']= $mobile;

                if (!$mobile) {
                    return json(['code'=>1, 'msg'=>'支付密码不能为空']);
                }
                if ($code != Session::get($mobile)) {
                    return json(['code'=>1, 'msg'=>'短信验证码错误']);
                }
                $times=Session::get($code);
                if (time() > ($times+5*60)) {
                    Session::delete($times);
                    return json(['code'=>1, 'msg'=>'短信验证码已失效']);
                }
                Session::delete($mobile);
                Session::delete($times);
                $user = User::where(['mobile'=>$mobile])->find();
                if (isset($user)) {
                    if (!empty($user['openid'])) {
                        return json(['code'=>1, 'msg'=>'手机号码已被绑定']);
                    }else{
                        $err = ['code'=>200, 'msg'=>'绑定手机号码成功'];
                        Db::startTrans();
                        try{
                            $err = ['code'=>1, 'msg'=>'绑定手机号码失败111'];
                            $wxuser = User::where(['id'=>$this->id])->find();
                            $upda['openid'] = $wxuser['openid'];
                            $upda['image'] = $wxuser['image'];
                            $upda['name'] = $wxuser['name'];
                            $upda['user_login'] = $wxuser['user_login'];
                            $result = User::where(['mobile'=>$mobile])->update($upda);
                            if ($result!==false) {
                                db('user')->delete($this->id);
                                $user = User::where(['mobile'=>$mobile])->find();
                                Session::set('user',$user);
                                Cookie::set('user_id',$user['id']);
                                $err = ['code'=>200, 'msg'=>'绑定手机号码成功'];
                            }
                            Db::commit();
                        } catch (\Exception $e) {
                            // 回滚事务
                            Db::rollback();
                        }
                        return json($err);
                    }
                }else{
                    $ress = User::where(['id'=>$this->id])->update($arr);
                    if ($ress!==false) {
                        Session::set('user.mobile',$mobile);
                        return json(['code'=>200, 'msg'=>'绑定手机号码成功']);
                    }
                    return json(['code'=>1, 'msg'=>'绑定手机号码失败']);
                }

        }else{
            return $this->fetch();
        }
    }
    /*
     * 绑定手机号码
     */
    public function phone()
    {
        $user = User::where(['id'=>$this->id])->find();
        if (!empty($user['mobile'])) {
           $this->redirect('index/index');
        }
        return $this->fetch();
    }
    /*
     * 设置支付密码
     */
    public function pay()
    {
        $user = User::where(['id'=>$this->id])->find();
        if (!empty($user['pay_pass'])) {
           $this->redirect('index/index');
        }
       return $this->fetch();
    }
    /*
     * 单点登录
     */
    public function has()
    {
       Session::delete('user');
       Cookie::delete('user_id');
       return $this->fetch();
    }
    /*
     * 退出
     */
    public function noadmin()
    {
       Session::delete('user');
       Cookie::delete('user_id');
       $this->redirect('Index/index');
    }
    /*
     * 身份验证 验证程序在Member/identity
     */
    public function identity()
    {
        $user = User::where(['id'=>$this->id])->find();
        if ($user['authentication']!=0) {
           $this->redirect('index/index');
        }
        return $this->fetch();
    }
    /*
     * 测试用登录
     */
    public function admin()
    {
       $arr = User::where(['id'=>94])->find();
       Session::set('user',$arr);
       Cookie::set('user_id',94);
       echo 'ok';
    }

}

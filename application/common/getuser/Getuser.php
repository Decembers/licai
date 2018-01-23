<?php
/**
 * @Author: Marte
 * @Date:   2018-01-07 13:49:50
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-22 19:04:18
 */
namespace  app\common\getuser;
use think\Session;
use think\Cookie;
use app\common\model\User;
/**
* 微信授权获取用户信息
*/
class Getuser
{

    public $appid = '';
    public $redirect_uri = '';
    public $scope = '';
    public $state = '';
    public $secret = '';//  公众号的appsecret

    function __construct()
    {
    $this->appid = 'wx3dc1191b24a06e74';
    $this->redirect_uri = urlencode(URLL.url('login/getaccess_token'));
    $this->scope = 'snsapi_userinfo';
    $this->state = 'succeed';
    $this->secret = 'c44186b3f39d8205890824d8144ff4ff';
    }
    /*
     * 请求授权地址
     */
    public function geturl($url=0)
    {
            if ($url!=0) {
                $this->redirect_uri = urlencode(URLL.url('member/listress'));
                $this->scope = 'snsapi_base';
            }
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$this->redirect_uri.'&response_type=code&scope='.$this->scope.'&state='.$this->state.'#wechat_redirect';
            return $url;
    }
    /*
     * 网页授权access_token地址
     */
    public function getaccess_token($code)
    {
          $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->secret."&code=".$code."&grant_type=authorization_code";
          $date = $this->curlget($url);
            if ($date) {
                if (isset($date['access_token'])) {
                    $userinfo = $this->getuserinfo($date['access_token'],$date['openid']);
                    return $userinfo;
                }
            }
           return false;
    }
    /*
     * 网页授权获取access_token
     */
    public function gettoken($code)
    {
          $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->secret."&code=".$code."&grant_type=authorization_code";
          $date = $this->curlget($url);
            if ($date) {
                if (isset($date['access_token'])) {
                    return $date['access_token'];
                }
            }
           return false;
    }
    /*
     * 获取用户信息
     */
    public function getuserinfo($access_token,$openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $userinfo = $this->curlget($url);
        if ($userinfo) {
            if (isset($userinfo['openid'])) {
                //将用户信息写入数据库 如果注册过查询出数据存入session
                $user = User::where(['openid'=>$userinfo['openid']])->find();
                if (isset($user)) {
                    Session::set('user',$user);
                    Cookie::set('user_id',$user['id'],2592000);
                    return true;
                }else{
                    $arr['openid'] = $userinfo['openid'];
                    $arr['name'] = $userinfo['nickname'];
                    $arr['image'] = $userinfo['headimgurl'];
                    $arr['create_time'] = time();
                    $arr['integral'] = 1000;
                    $arr['user_type'] = 1;
                    $arr['status'] = 1;
                    $arr['login_time'] = time();
                    $arr['isdelete'] = 0;
                    $arr['authentication'] = 0;
                    User::insert($arr);
                    $userx = User::where(['openid'=>$userinfo['openid']])->find();

                    $user_login = rand('10000000','99999999');
                    User::where(['mobile'=>$mobile])->update(['user_login'=>$user_login]);
                    $userx['user_login'] = $user_login;

                    Session::set('user',$userx);
                    Cookie::set('user_id',$userx['id'],2592000);
                    return true;
                }
            }
        }
        return false;
    }

    public function curlget($url)
    {
            file_put_contents("test.txt", $url);
            //初始化curl
            $ch = curl_init($url);
            //设置超时
            curl_setopt($ch, CURLOPT_TIMEOUT,30);
            curl_setopt($ch, CURLOPT_HEADER,FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
            //运行curl，结果以jason形式返回
            $res = curl_exec($ch);
            curl_close($ch);
            file_put_contents("test.txt", $res);
         //　　//打印获得的数据
             $data=json_decode($res,true);
             return $data;
    }
}
<?php

$randStr = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
$rand = substr($randStr,0,6);
$_SESSION["mbvfcode"]=$rand;
$url='http://117.78.52.216:9003';//系统接口地址
$content=urlencode("【超宝验证】您的验证码是:".$rand.",5分钟后过期，请您及时验证!");
$username="13613820359";//用户名
$password="ODIwMzU5";//密码百度BASE64加密后密文
$url=$url."/servlet/UserServiceAPI?method=sendSMS&extenno=&isLongSms=0&username=".$username."&password=".$password."&smstype=0&mobile=18137511351&content=".$content;
echo $url;
$html = file_get_contents($url);
echo $html;
if(!strpos($html,"success")){
  echo "发送成功";
}
header("content-type:text/html; charset=GBK");
?>
<?php

$randStr = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
$rand = substr($randStr,0,6);
$_SESSION["mbvfcode"]=$rand;
$url='http://117.78.52.216:9003';//ϵͳ�ӿڵ�ַ
$content=urlencode("��������֤��������֤����:".$rand.",5���Ӻ���ڣ�������ʱ��֤!");
$username="13613820359";//�û���
$password="ODIwMzU5";//����ٶ�BASE64���ܺ�����
$url=$url."/servlet/UserServiceAPI?method=sendSMS&extenno=&isLongSms=0&username=".$username."&password=".$password."&smstype=0&mobile=18137511351&content=".$content;
echo $url;
$html = file_get_contents($url);
echo $html;
if(!strpos($html,"success")){
  echo "���ͳɹ�";
}
header("content-type:text/html; charset=GBK");
?>
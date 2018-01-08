<?php
/**
* 	配置账号信息
*/
class WxPayConf_pub {
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
/*	const APPID = 'wx98b830ce6f159bc0';
	//受理商ID，身份标识 
	const MCHID = '1487075802';
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = 'a91351d1bd37d09babc163d4ad0ba544';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = '22b36eb8146bb90a9d36ed33d62c0efd';*/


	const APPID = 'wx3dc1191b24a06e74';
	const MCHID = '1282191401';
	const KEY = '2eef374f423bdce7a80a2f8cc541d310';
	const APPSECRET = 'c44186b3f39d8205890824d8144ff4ff';
	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面 
	//const JS_API_CALL_URL = '';
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = './cert/apiclient_cert.pem';
	const SSLKEY_PATH = './cert/apiclient_key.pem';
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = 'http://cdz.ytaoh.com/index.php/Notify/weixinjsapnotify';
	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}	
?>
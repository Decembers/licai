<?php
namespace  app\common\Printer;
use think\Loader;

/**
* 打印方法
*/
class Printer
{
		// $orderInfo = '<CB>趣味农场</CB><BR>';
		// $orderInfo .= '名称　　　　　 单价  数量 金额<BR>';
		// $orderInfo .= '--------------------------------<BR>';
		// $orderInfo .= '散养大白鹅     60.0  15  900.00<BR>';
		// $orderInfo .= '店铺鹅群　     55.0  20  1100.00<BR>';
		// $orderInfo .= '备注：加辣<BR>';
		// $orderInfo .= '--------------------------------<BR>';
		// $orderInfo .= '合计：xx.0元<BR>';
		// $orderInfo .= '送货地点：广州市南沙区xx路xx号<BR>';
		// $orderInfo .= '联系电话：13888888888888<BR>';
		// $orderInfo .= '订餐时间：2014-08-08 08:08:08<BR>';
		// $orderInfo .= '<QR>http://nongchang.yingjisong.com</QR>';//把二维码字符串用标签套上即可自动生成二维码

    function __construct()
    {
		// define('USER', 'php_programmer@163.com');	//*必填*：飞鹅云后台注册账号
		// define('UKEY', 'cyTKkjD6Hqswc5n7');	//*必填*: 飞鹅云注册账号后生成的UKEY
		// define('SN', '815001150');	    //*必填*：打印机编号，必须要在管理后台里添加打印机或调用API接口添加之后，才能调用API

		//以下参数不需要修改
		define('IP','api.feieyun.cn');			//接口IP或域名
		define('PORT',80);						//接口IP端口
		define('PATH','/Api/Open/');		//接口路径
		define('STIME', time());			    //公共参数，请求时间
    }


// function addprinter($snlist){
// 	header("Content-type: text/html; charset=utf-8");
// 	Loader::import('Printer.HttpClient', EXTEND_PATH);
// 		$content = array(
// 			'user'=>USER,
// 			'stime'=>STIME,
// 			'sig'=>SIG,
// 			'apiname'=>'Open_printerAddlist',

// 		    'printerContent'=>$snlist
// 		);

// 	$client = new \HttpClient(IP,PORT);
// 	if(!$client->post(PATH,$content)){
// 		echo 'error';
// 	}
// 	else{
// 		echo $client->getContent();
// 	}

// }


/*
 *  方法1
	拼凑订单内容时可参考如下格式
	根据打印纸张的宽度，自行调整内容的格式，可参考下面的样例格式
*/
function wp_print($user,$ukey,$printer_sn,$orderInfo){
	header("Content-type: text/html; charset=utf-8");
	Loader::import('Printer.HttpClient', EXTEND_PATH);
		$sig = sha1($user.$ukey.STIME);   //公共参数，请求公钥

		$content = array(
			'user'=>$user,
			'stime'=>STIME,
			'sig'=>$sig,
			'apiname'=>'Open_printMsg',

			'sn'=>$printer_sn,
			'content'=>$orderInfo,
		    'times'=>1//打印次数
		);

	$client = new \HttpClient(IP,PORT);
	if(!$client->post(PATH,$content)){
		return 'error';
	}
	else{
		//服务器返回的JSON字符串，建议要当做日志记录起来
		return $client->getContent();
	}

}


/*
 *  方法2
	根据订单索引,去查询订单是否打印成功,订单索引由方法1返回
*/
// function queryOrderState($index){
// 	header("Content-type: text/html; charset=utf-8");
// 	Loader::import('Printer.HttpClient', EXTEND_PATH);

// 		$msgInfo = array(
// 			'user'=>USER,
// 			'stime'=>STIME,
// 			'sig'=>SIG,
// 			'apiname'=>'Open_queryOrderState',

// 			'orderid'=>$index
// 		);

// 	$client = new \HttpClient(IP,PORT);
// 	if(!$client->post(PATH,$msgInfo)){
// 		echo 'error';
// 	}
// 	else{
// 		$result = $client->getContent();
// 		echo $result;
// 	}

// }




/*
 *  方法3
	查询指定打印机某天的订单详情
*/
// function queryOrderInfoByDate($printer_sn,$date){
// 	header("Content-type: text/html; charset=utf-8");
// 	Loader::import('Printer.HttpClient', EXTEND_PATH);

// 		$msgInfo = array(
// 			'user'=>USER,
// 			'stime'=>STIME,
// 			'sig'=>SIG,
// 			'apiname'=>'Open_queryOrderInfoByDate',

// 	        'sn'=>$printer_sn,
// 			'date'=>$date
// 		);

// 	$client = new \HttpClient(IP,PORT);
// 	if(!$client->post(PATH,$msgInfo)){
// 		echo 'error';
// 	}
// 	else{
// 		$result = $client->getContent();
// 		echo $result;
// 	}

// }



/*
 *  方法4
	查询打印机的状态
*/
// function queryPrinterStatus($printer_sn){
// 	header("Content-type: text/html; charset=utf-8");
// 	Loader::import('Printer.HttpClient', EXTEND_PATH);

// 	    $msgInfo = array(
// 	    	'user'=>USER,
// 			'stime'=>STIME,
// 			'sig'=>SIG,
// 			'apiname'=>'Open_queryPrinterStatus',

// 	        'sn'=>$printer_sn
// 		);

// 	$client = new \HttpClient(IP,PORT);
// 	if(!$client->post(PATH,$msgInfo)){
// 		echo 'error';
// 	}
// 	else{
// 		$result = $client->getContent();
// 		echo $result;
// 	}
// }

}

//===========添加打印机接口（支持批量）=============
		//***接口返回值说明***
		//正确例子：{"msg":"ok","ret":0,"data":{"ok":["sn#key#remark#carnum","316500011#abcdefgh#快餐前台"],"no":["316500012#abcdefgh#快餐前台#13688889999  （错误：识别码不正确）"]},"serverExecutedTime":3}
		//错误：{"msg":"参数错误 : 该帐号未注册.","ret":-2,"data":null,"serverExecutedTime":37}

		//打开注释可测试
		//提示：打印机编号(必填) # 打印机识别码(必填) # 备注名称(选填) # 流量卡号码(选填)，多台打印机请换行（\n）添加新打印机信息，每次最多100行(台)。
		//$snlist = "sn1#key1#remark1#carnum1\nsn2#key2#remark2#carnum2";
		//addprinter($snlist);






//==================方法1.打印订单==================
		//***接口返回值说明***
		//正确例子：{"msg":"ok","ret":0,"data":"316500004_20160823165104_1853029628","serverExecutedTime":6}
		//错误：{"msg":"错误信息.","ret":非零错误码,"data":null,"serverExecutedTime":5}


		//标签说明：
		//单标签:
		//"<BR>"为换行,"<CUT>"为切刀指令(主动切纸,仅限切刀打印机使用才有效果)
		//"<LOGO>"为打印LOGO指令(前提是预先在机器内置LOGO图片),"<PLUGIN>"为钱箱或者外置音响指令
		//成对标签：
		//"<CB></CB>"为居中放大一倍,"<B></B>"为放大一倍,"<C></C>"为居中,<L></L>字体变高一倍
		//<W></W>字体变宽一倍,"<QR></QR>"为二维码,"<BOLD></BOLD>"为字体加粗,"<RIGHT></RIGHT>"为右对齐
	    //拼凑订单内容时可参考如下格式
		//根据打印纸张的宽度，自行调整内容的格式，可参考下面的样例格式


?>

<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\GitHub\licai./application/wap\view\member\userinfo.html";i:1514167719;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<!--<title>我的</title>-->
		<title>趣味农场</title>
		<link rel="stylesheet" type="text/css" href="__WAP__/bootstrap-3.3.7/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/style.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/spirit.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<script src="__WAP__/js/jQuery v2.1.1.js"></script>
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer-background.css"/>
		<style type="text/css">


			.integrel_balance {
				width: 95%;
				margin: 0.5rem auto;
				background: linear-gradient(to right, #33b3cc, #6fd6ea);
				border-radius: 0.5rem;
				color: #fff;
			}

			.integrel_balance h5 {
				font-size: 3rem;
				line-height: 5rem;
				text-align: center;
				margin: 0;

			}

			.integrel_balance p {
				font-size: 1.5rem;
				line-height: 3rem;
				text-align: center;
			}

			.wrapper ul,
			.wrapper ul li {
				width: 100%;
				overflow: auto;
			}

			.wrapper ul li {
				background-color: white;
				color: #a9a9a9;
				font-size: 1rem;
				box-sizing: border-box;
				padding: 1rem 1.5rem;
			}
			.wrapper ul li>div>div:nth-child(1){
				line-height: 3rem;
			}
			.wrapper ul li>div>div:nth-child(2){
				line-height: 2rem;
			}
			.chtx {
				font-size: 2rem;
			}
			.fw_right div{
				text-align: right;
				font-size: 1.4rem;
			}
			.fw_left div:nth-child(2){
				font-size: 1.4rem;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<!--<span class="icon"></span><span>返回</span>-->
				</div>
				<h3>账户余额</h3>
				<a href="###"></a>
			</div>
			<div class="integrel_balance">
				<h5>￥<?php echo $balance; ?></h5>
				<p>账户余额</p>
			</div>

			<ul>
			<?php if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<li>
					<div class="fw_left fl">
						<div class="chtx a1"><?php echo $vo['money']; ?>元</div>
						<div>操作金额</div>
					</div>
					<div class="fw_right fr">
						<div ><?php echo $vo['comment']; ?></div>
						<div><?php echo (date("y-m-d h:i:s",$vo['create_time'])) ? date("y-m-d h:i:s",$vo['create_time']) :  ''; ?></div>
					</div>
				</li>
			<?php endforeach; endif; else: echo "" ;endif; ?>
			</ul>

		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">

		</script>
	</body>

</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"E:\GitHub\licai./application/wap\view\member\paylog.html";i:1514256476;}*/ ?>
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
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer-background.css"/>
		<script src="__WAP__/js/jQuery v2.1.1.js"></script>

		<style type="text/css">

			.Money_Log,
			.total_transaction {
				width: 100%;
			}

			.total_transaction {
				line-height: 4rem;
				box-sizing: border-box;
				padding: 0 1rem;
				display: flex;
				background-color: white;
				margin-top: 2px;
			}

		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>充值记录</h3>
				<a href="###"></a>
			</div>
			<ul class="Money_Log invest">
				<p class="total_transaction a9 white">
					充值总额：<span class="a1">￥<?php if($money): ?>
					<?php echo $money; else: ?>
					0.00
					<?php endif; ?></span>
				</p>
				<!-- 如果没有记录，充值总额为0，显示以下-->
				<!--<div class="no_record"></div>-->
				<!-- 没有记录结束-->
				<div class="no_record"></div>
			</ul>

		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>

	</body>

</html>
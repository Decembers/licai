<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\GitHub\licai./application/wap\view\member\invitehb.html";i:1513914039;}*/ ?>
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
				padding: 1rem 2rem;
				margin-top: 1px;
			}

			.wrapper ul li>div>div:nth-child(1) {
				line-height: 3rem;
			}
			.wrapper ul li>div>div:nth-child(2) {
				line-height: 2rem;
			}
			.wrapper ul li>div>div.chtx {
				font-size: 2rem;
			}
			.wrapper ul li>div>div {
				font-size: 1.3rem;
			}
			.fw_right div {
				text-align: right;
			}

			.look_over {
				position: fixed;
				bottom: 0;
				left: 0;
				width: 100%;
				height: 3.5rem;
				line-height: 3.5rem;
				border-top: 1px solid #ededed;
				background: #fff;
				text-align: center;
				font-size: 2rem;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<!--<span class="icon"></span><span>返回</span>-->
				</div>
				<h3>我的回报</h3>
				<a href="<?php echo url('member/tggz'); ?>">推广规则</a>
			</div>

			<ul>
				<li>
					<div class="fw_left fl">
						<div class="chtx a1">0.00元</div>
						<div>代收回报</div>
					</div>
					<div class="fw_right fr">
						<div>0人</div>
						<div>
							<a href="<?php echo url('member/wdhy'); ?>">我的好友</a>
						</div>
					</div>
				</li>
			</ul>
			<div class="comm_list invest" id="friendList">
				<!-- 这里是页面内容区 -->
				<div class="no_record"></div>
			</div>
			<div class="look_over">
				<a href="<?php echo url('member/tghb'); ?>" style="    color: #3db4cc;">查看已收推广回报</a>
			</div>

		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		</script>
	</body>

</html>
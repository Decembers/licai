<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"E:\GitHub\licai./application/wap\view\member\packet.html";i:1513915151;}*/ ?>
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
				width: 95%;
				margin: 0  auto;
			}

			.wrapper ul li {
				background-color: white;
				color: #a9a9a9;
				font-size: 1rem;
				box-sizing: border-box;
				padding: 1rem 2rem;
				margin-top: 1px;
				overflow: hidden;
				border-radius:1rem ;
				margin-top: 0.5rem;
			}

			.wrapper ul li>div>div:nth-child(1) {
				line-height: 2.5rem;
			}
			.wrapper ul li>div>div:nth-child(2) {
				line-height: 1.5rem;
			}
			.wrapper ul li>div>div {
				display: flex;
			}

			.chtx {
				font-size: 1.8rem;
			}

			.fw_right div {
				text-align: right;
				display: flex;
				font-size: 1.3rem;
			}

			.fw_left div:nth-child(2) {
				font-size: 1.3rem;
			}

			.redPackets_0 {
				width: 3.1rem;
				height: 3.5rem;
				margin-right: 1rem;
				margin-top: 0.5rem;
				background: url(__WAP__/img/hongbao.jpg) no-repeat;
				background-size: cover;
			}

			.ri {
				color: black;
			}

			.ri span:nth-child(2) {
				font-size: 2.5rem;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<!--<span class="icon"></span><span>返回</span>-->
				</div>
				<h3>我的红包</h3>
				<a href="<?php echo url('member/dhpacket'); ?>">兑换红包</a>
			</div>

			<ul>
				<li>
					<div class="redPackets_0 fl">

					</div>
					<div class="fw_left fl">
						<div class="chtx a1">注册红包</div>
						<div class="exlimit">
							<span class="name">有效期至:</span>无限 </div>
					</div>
					<div class="fw_right fr">
						<div class="ri"><span>￥</span><span>10</span></div>
						<div>剩余：20个</div>
					</div>

				</li>
			</ul>

		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
		</script>
	</body>

</html>
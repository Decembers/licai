<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"E:\GitHub\licai./application/wap\view\member\setting.html";i:1514255654;}*/ ?>
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
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer-background.css" />
		<style type="text/css">
			.content {
				width: 94%;
				margin-left: 3%;
				margin-top: 0;
			}

			.contract div.icon {
				background: url(__WAP__/img/iconlist_02.png) no-repeat 2px 5px;
				background-size: 2.1rem;
			}

			.invitation div.icon {
				background: url(__WAP__/img/iconlist_02.png) no-repeat 2px 12.8%;
				background-size: 2.1rem;
			}

			.dingdan div.icon {
				background: url(__WAP__/img/iconlist_02.png) no-repeat 2px 26%;
				background-size: 2.1rem;
			}

			.voucher div.icon {
				background: url(__WAP__/img/iconlist_02.png) no-repeat 2px 38%;
				background-size: 2.1rem;
			}

			.big-button {
				background: linear-gradient(to right, #f7f2f2, #fff) !important;
				color: black;
			}

			.uc_c_middle li,
			.uc_c_bottom li {
				padding: 0 1rem;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>设置</h3>
				<!--<a href="###">交易统计</a>-->
			</div>
			<div class="content bgCo native-scroll">
				<!-- 这里是页面内容区 -->

				<div class="uc_c_middle fillet" style="margin-top: 1rem;">
					<ul>
						<!-- 我的合同-->
						<li class="contract">
							<a href="##">
								<div class="icon fl"></div>
								<p class="fl">身份认证</p>
								<?php if($authentication == 2): ?>
									<span class="fr">已认证</span>
								<?php elseif($authentication == 1): ?>
									<span class="fr">认证中</span>
								<?php else: ?>
									<a href="<?php echo url('member/identity'); ?>"><span class="entered fr"></span></a>
								<?php endif; ?>

							</a>
						</li>
						<!-- 我的邀请-->
						<li class="invitation">
							<a href="<?php echo url('login/nopassword'); ?>">
								<div class="icon fl"></div>
								<p class="fl">修改登录密码</p>
								<span class="entered fr"></span>
							</a>
						</li>

						<li class="dingdan">
							<a href="<?php echo url('login/nopay'); ?>">
								<div class="icon fl"></div>
								<p class="fl">设置支付密码</p>
								<span class="entered fr"></span>
							</a>
						</li>

						<li class="voucher">
							<a href="<?php echo url('login/nomobile'); ?>">
								<div class="icon fl"></div>
								<p class="fl">修改手机号码</p>
								<span class="entered fr"></span>
							</a>
						</li>

					</ul>

				</div>
				<button class="big-button press" onclick="window.location='index.html'">退出当前账号</button>

			</div>

		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			/*footer 当前页选中状态*/
		</script>
	</body>

</html>
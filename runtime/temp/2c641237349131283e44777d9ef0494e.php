<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:55:"E:\GitHub\licai./application/wap\view\member\index.html";i:1513932843;}*/ ?>
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
			.content{
				width: 95%;
				margin: 0 auto;
			}
		</style>
	</head>

	<body>
		<div class="wrapper" >
			<div class="content bgCo native-scroll">
				<!-- 这里是页面内容区 -->
				<div class="uc_center">
					<div class="uc_c_top">
						<div class="uc_c_top_conten clearfix">
							<div class="uc_img_bor_small fl">
								<img src="__WAP__/img/touxiang.png" id="picDisplay">
								<form id="uploadForm" enctype="multipart/form-data" method="post" action="">
									<!-- <input type="file" name="imageFile" id="imageFile"/> -->
								</form>
							</div>
							<div class="fl">
								<div class="user_name"><?php echo $name; ?></div>
								<div class="authened"><?php echo $authti; ?></div>
							</div>
							<div class="integral fr">
								<a class="sign_success">签到赚积分</a>
								<span class="increase">+20</span>
								<a href="#">
									我的积分
								</a>
							</div>
						</div>
					</div>
				</div>
				<p class="authen_tip a9 clearfix"><span class="fl">身份认证后才可购买羊只、提现哦。</span><span class="fr">（设置-身份认证）</span></p>
				<div class="account fillet">
					<p class="detailed">
						<a href="<?php echo url('member/userinfo'); ?>" class="m_co">账户明细
						</a>
					</p>
					<p class="account-balance">
					<?php if($balance): ?>
					￥<?php echo $balance; else: ?>
					￥0.00
					<?php endif; ?>
					</p>
					<p class="acc-bal a9">账户余额</p>
					<div class="money_operation">
						<ul>
							<li class="incharge">
								<a href="<?php echo url('member/pay'); ?>">
									<div class="icon fl"></div>
									<p class="a1 fl">充值</p>
								</a>
							</li>
							<li class="carry">
								<a href="<?php echo url('member/withdraw'); ?>">
									<div class="icon fl"></div>
									<p class="a1 fl">提现</p>
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="uc_c_middle fillet">
					<ul>
						<!-- 我的合同-->
						<li class="contract">
							<a href="<?php echo url('member/contract'); ?>">
								<div class="icon fl"></div>
								<p class="fl">我的合同</p>
								<span class="entered fr"></span>
							</a>
						</li>
						<!-- 我的邀请-->
						<li class="invitation">
							<a href="<?php echo url('member/invite'); ?>">
								<div class="icon fl"></div>
								<p class="fl">我的邀请</p>
								<span class="entered fr"></span>
							</a>
						</li>

						<li class="dingdan">
							<a href="<?php echo url('member/shopplog'); ?>">
								<div class="icon fl"></div>
								<p class="fl">购物清单</p>
								<span class="entered fr"></span>
							</a>
						</li>

						<li class="voucher">
							<a href="<?php echo url('member/packet'); ?>">
								<div class="icon fl"></div>
								<p class="fl">现金红包</p>
								<span class="entered fr"></span>
							</a>
						</li>
						<!-- 设置地址-->
						<li class="address">
							<a href="<?php echo url('member/address'); ?>">
								<div class="icon fl"></div>
								<p class="fl">收货地址</p>
								<span class="entered fr"></span>
							</a>
						</li>
						<li class="integral">
							<a href="#">
								<div class="icon fl"></div>
								<p class="fl">积分兑换</p>
								<span class="entered fr"></span>
							</a>
						</li>
					</ul>
				</div>
				<div class="uc_c_bottom fillet">
					<ul>
						<li class="setting">
							<a href="<?php echo url('member/setting'); ?>">
								<div class="icon fl"></div>
								<p class="fl">设置</p>
								<span class="entered fr"></span>
							</a>
						</li>
						<li class="help">
							<a href="<?php echo url('member/help'); ?>">
								<div class="icon fl"></div>
								<p class="fl">帮助</p>
								<span class="entered fr"></span>
							</a>
						</li>
					</ul>
				</div>
				<p class="official_record a9" style="text-align:center">© 2016 内蒙古蒙蓝科技有限公司 All rights reserved <br>蒙ICP备15002147号-2</p>
			</div>
			<div class="footer" style="z-index: 99;">
				<a href="<?php echo url('index/index'); ?>">
					<span class="icons "></span>
					<p>牧场</p>
				</a>
				<a href="index2.html">
					<span class="icons"></span>
					<p>超市</p>
				</a>
				<a href="index3.html">
					<span class="icons"></span>
					<p>发现</p>
				</a>
				<a href="<?php echo url('member/index'); ?>">
					<span class="icons"></span>
					<p>我的</p>
				</a>
			</div>
		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			/*footer 当前页选中状态*/
			$(".footer a:nth-child(4) .icons").css("background", "url(__WAP__/img/iconlist_05.png) no-repeat center 53%");
			$(".footer a:nth-child(4) .icons").css("background-size", "3rem");
			$(".sign_success").click(function() {
				$(this).text("已签到");
				$(this).css("opacity", "0.5")
				$(".overtop").css("display", "block");
				$(".overtop").css("opacity", "1");
				setTimeout(function() {
					$(".overtop").css("opacity", "0");
				}, 2000);
			})


		</script>
	</body>

</html>
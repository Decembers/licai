<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\GitHub\licai./application/wap\view\member\pay.html";i:1513910833;}*/ ?>
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
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer-background.css" />
		<script src="__WAP__/js/jQuery v2.1.1.js"></script>

		<style type="text/css">
			.top,
			.bottom,
			.bottom li {
				width: 100%;
				margin: 1rem 0;
			}

			.top {
				display: flex;
				justify-content: space-around;
				box-sizing: border-box;
				padding: 0 5%;
			}

			.top li {
				width: 45%;
				height: 3.5rem;
				line-height: 3.5rem;
				text-align: center;
				font-size: 1.7rem;
				border-radius: 1.8rem;
				color: #3db4cc;
				border: 1px solid #3db4cc;
				background: #f0f0f3;
			}

			.top li.active {
				color: #fff;
				background: linear-gradient(to right, #3db4cc, #6fd6ea);
				border: 0;
			}

			.bottom li>div {
				width: 90%;
				margin: 1rem auto;
			}

			.figure,
			.pay_detail {
				background-color: white;
				height: 5rem;
				position: relative;
				border-radius: 0.8rem;
			}

			.figure span {
				position: absolute;
				top: 0;
				left: 0;
				line-height: 5rem;
				width: 4rem;
				text-align: center;
				font-size: 3rem;
			}

			.figure input {
				width: 100%;
				height: 100%;
				line-height: 5rem;
				box-sizing: border-box;
				padding-left: 4rem;
				font-size: 1.8rem;
			}

			.figure_text .fl1,
			.pay_detail {
				display: flex;
				position: relative;
			}

			.inline_pay_img_show {
				height: 3rem;
				width: 3rem;
				margin: 1rem;
			}

			.inline_pay_name {
				line-height: 5rem;
				font-size: 1.8rem;
			}

			.img_ri {
				width: 2rem;
				height: 2rem;
				position: absolute;
				top: 1.5rem;
				right: 1rem;
			}

			.figure_text {
				color: #a9a9a9;
			}

			.big-a {
				color: #3db4cc;
				text-align: center;
				font-size: 1.5rem;
			}

			.pay_detail1 {
				padding: 0.1rem 1.75rem 1rem 1.75rem;
				color: #fff;
				background: linear-gradient(to right, #3db4cc, #6fd6ea);
				border-radius: 0.4rem;
			}

			.pay_detail1 h5,
			.pay_detail1 ul,
			.pay_detail1 ul li {
				width: 100%;
			}

			.pay_detail1 h5 {
				text-align: center;
				line-height: 3rem;
				font-size: 2rem;
			}

			.pay_detail1 ul li {
				overflow: hidden;
			}

			.pay_detail1 ul li p {
				float: left;
				font-size: 1.5rem;
			}

			.pay_detail1 ul li p:nth-child(1) {
				width: 25%;
			}

			.pay_detail1 ul li p:nth-child(2) {
				width: 75%;
			}

			.a_ophen {
				display: block;
				width: 90%;
				margin: 0 auto;
				border: 1px solid #ededed;
				border-radius: 0.4rem;
				padding: 1.1rem 1.5rem;
				background: #fff;
				margin-top: 0.4rem;
				overflow: hidden;
			}

			.portrait {
				width: 4rem;
				height: 4rem;
				background: url(__WAP__/img/kefu.jpg) no-repeat center center;
				background-size: 3.6rem;
				margin-right: 1rem;
			}

			.telephone {
				font-size: 1.5rem;
				color: #3db4cc;
				line-height: 2.5rem;
			}

			.work_time {
				font-size: 1.2rem;
				color: #a9a9a9;
				line-height: 1.5rem;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>充值</h3>
				<a href="<?php echo url('member/paylog'); ?>">充值记录</a>
			</div>
			<ul class="top">
				<li class="active">线上充值</li>
				<li>对公转账</li>
			</ul>

			<ul class="bottom">
				<li>
					<div class="figure">
						<span>￥</span>
						<input id="money1" type="number" placeholder="请输入充值金额">
					</div>
					<div class="figure_text">
						<div id="purchase" class="fl1">充值金额可购常规羊：<i id="num-sheep">0</i>只</div>
					</div>

					<div class="pay_detail clearfix">

						<div class="inline_pay_img_show">
							<img src="__WAP__/img/57c78add65bf8.jpg" height="100%" width="100%">
						</div>

						<div class="inline_pay_name">
							支付宝手机WAP支付 </div><img class="img_ri" src="__WAP__/img/dui.png" />
					</div>
					<div class="figure_text">
						温馨提示：当您的充值用途不是购买财富牧场的羊只时，7个自然日内我们不支持提现，7个自然日之后您申请提现时我们将收取0.6%的手续费哦∩_∩。
					</div>
					<button class="big-button press" id="big-button">朕要充值</button>
					<a href="index4-recharge-2.html" class="big-a">充值、提现规则</a>

				</li>
				<li style="display: none;">
					<div class="pay_detail1">
						<h5>兴业银行</h5>

						<ul>
							<li>
								<p>收款人：</p>
								<p>内蒙古蒙蓝科技有限公司</p>
							</li>
							<li>
								<p>开户行：</p>
								<p>兴业银行股份有限公司呼和浩特新华支行</p>
							</li>
							<li>
								<p>账&nbsp;&nbsp;户：</p>
								<p>592040100100116830</p>
							</li>
							<li>
								<p>时&nbsp;&nbsp;间：</p>
								<p>周一至周五 8:30 - 17:30</p>
							</li>
						</ul>

					</div>

					<div class="figure_text">
						为确保充值顺利，请您联系客服，并用网银（或到银行柜台）转账到该账户，我们会尽快进行确认。
					</div>
					<a href="#" class="a_ophen">
						<div class="portrait fl"></div>
						<div class="cstn fl">
							<p class="telephone">客服电话：400-800-8344</p>
							<p class="work_time">周一至周五 8:30 - 17:30</p>
						</div>
					</a>

				</li>
			</ul>

		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(".top li").click(function() {
				tt = $(".top li").index($(this));
				$(".top li").removeClass("active");
				$(this).addClass("active");
				$(".bottom>li").css("display", "none");
				if(tt == 0) {
					$(".bottom>li:nth-child(1)").css("display", "block");
				} else if(tt == 1) {
					$(".bottom>li:nth-child(2)").css("display", "block");
				}
			})
			$("#money1").bind('input', function() {
				var st = ($(this).val() / 780).toFixed(0);
				$("#num-sheep").text(st);
			});
		</script>
	</body>

</html>
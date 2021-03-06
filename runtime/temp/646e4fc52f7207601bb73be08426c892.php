<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\GitHub\licai./application/wap\view\member\contract.html";i:1513911734;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<!--<title>购买羊只</title>-->
		<title>趣味农场</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<!--<link rel="stylesheet" type="text/css" href="__WAP__/css/style.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/spirit.css" />-->
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/shop.css" />
		<script src="__WAP__/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer-background.css" />
		<style type="text/css">
			.content {
				width: 95%;
				margin: 0 auto;
				margin-top: 0.5rem;
			}
			/*我的羊只 */

			.mysheep {
				width: 100%;
				background: url(__WAP__/img/my_sheep.jpg);
				-moz-background-size: 100% 100%;
				background-size: 100% 100%;
				background-size: cover;
				text-align: center;
				color: #fff;
				font-size: 0.7rem;
				margin-bottom: 0.5rem;
			}
			/*我的羊只 数量 */

			.mysheep h5 {
				color: #fff;
				font-size: 3.3rem;
				line-height: 2.9rem;
				margin: 1rem 0;
			}
			/*我的羊只 */

			.my_sheep {
				font-size: 0.9rem;
			}
			/*成长*/

			.grow {
				line-height: 2.3rem;
				font-size: 0.9rem;
				display: flex;
				justify-content: center;
			}

			.ing {
				margin-right: 0.7rem;
			}

			.no_sheep {
				width: 10rem;
				height: 11rem;
				margin: 3.5rem auto 0 auto;
				background: url(__WAP__/img/no_record.png) no-repeat center center;
				background-size: 100% 100%;
			}
			/*交易弹窗 黑色背景*/

			#goodcover {
				display: none;
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: black;
				z-index: 1001;
				-moz-opacity: 0.65;
				opacity: 0.65;
			}
			/*交易弹窗 开始*/

			#exchange_appli {
				width: 17rem;
				height: auto;
				position: absolute;
				top: 50%;
				left: 50%;
				margin-left: -8.5rem;
				margin-top: -8.5rem;
				z-index: 1002;
				background-color: #fff;
				border-radius: 0.4rem;
				display: none;
				-webkit-animation: bounceIn 0.3s;
				-ms-animation: bounceIn 0.3s;
				animation: bounceIn 0.3s;
			}
			/*交易弹窗 上*/

			.total_top {
				height: 9rem;
				background: linear-gradient(to right, #41d1a1, #6de3a4);
				color: #fff;
				text-align: center;
				border-radius: 0.4rem 0.4rem 0 0;
			}
			/*交易统计*/

			.collect_total {
				height: 6rem;
			}

			.total_top .thirty_six {
				font-size: 1.1rem;
				padding: 0.5rem 0;
			}

			.total_top h6 {
				font-size: 1.6rem;
				line-height: 1.6rem;
				font-weight: normal;
				margin: 0;
			}

			.twenty_six {
				font-size: 0.9rem;
			}
			/*本金 回报*/

			.collect {
				height: 3rem;
				border-top: 1px solid rgba(255, 255, 255, 0.3);
				font-size: 0.65rem;
				padding-top: 0.2rem;
				display: flex;
			}

			.collect div.fl {
				width: 50%;
				margin: 0 auto;
				font-size: 0.9rem;
			}

			.collect div.fl div:nth-child(2) {
				font-size: 0.8rem;
			}

			.collect .integer {
				font-size: 1.1rem;
			}
			/*交易弹窗 下*/

			.total_bottom {
				padding: 0 1.5rem;
			}

			.total_bottom li {
				height: 2rem;
				line-height: 2rem;
				border-bottom: 1px solid #ededed;
				display: flex;
				justify-content: space-between;
				font-size: 0.95rem;
			}

			.total_bottom li span:nth-child(2) {
				font-size: 1rem;
			}

			.total_bottom li span {
				width: auto;
			}
			/*交易弹窗 关闭按钮*/

			.close {
				position: absolute;
				top: 100%;
				left: 50%;
				width: 2.5rem;
				height: 4.2rem;
				margin-left: -1.25rem;
				background: url(__WAP__/img/iconlist_01.png) center 100% no-repeat;
				background-size: cover;
			}

			#closebtn {
				display: block;
				width: 1.75rem;
				height: 1.75rem;
				margin-top: 1.125rem;
				border-radius: 50%;
			}
			/*交易弹窗 结束*/
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>我的合同</h3>
				<!--<a href="###">交易统计</a>-->
			</div>
			<div class="content infinite-scroll bgCo native-scroll" data-distance="0" now_page="1">
				<!-- 这里是页面内容区 -->
				<input type="hidden" id="response_code" value="1">
				<div class="fillet mysheep">
					<h5>0</h5>
					<p class="my_sheep">我的合同（期）</p>
					<p class="grow">
						<span class="ing">进行中：0</span>
						<span>已到期：0</span>
					</p>
				</div>
				<!--我的牧场-->
				<div class="uc_invest-box" all_page="0">
					<!-- 如果没有羊，则显示-->
					<!--<div class="no_sheep"></div>-->
					<!-- 没有羊结束-->
					<div class="no_sheep"></div>
					<button class="big-button press" style="display: none;" onclick="window.location='index1-navs2.html'">朕去买羊</button>
				</div>
				<!-- 交易统计弹出框成功弹出-->
				<div id="goodcover"></div>
				<div id="exchange_appli" style="display: none;">
					<div class="total_top">
						<div class="collect_total">
							<p class="thirty_six">交易统计</p>
							<h6>0.00</h6>
							<p class="twenty_six">待收金额(元)</p>
						</div>
						<div class="collect">
							<div class="fl">
								<div class="integer">0.00</div>
								<div>待收本金（元）</div>
							</div>
							<div class="fl">
								<div class="integer">0.00</div>
								<div>待收回报（元）</div>
							</div>
						</div>
					</div>
					<div class="total_bottom a9">
						<ul>
							<li><span class="fl">交易总额</span><span class="fr">￥0.00</span></li>
							<li><span class="fl">购买期数</span><span class="fr">0</span></li>
							<li><span class="fl">已收本金</span><span class="fr">￥0.00</span></li>
							<li><span class="fl">已收回报</span><span class="fr">￥0.00</span></li>

						</ul>
					</div>
					<!-- 关闭按钮-->
					<div class="close">
						<a href="#" id="closebtn"></a>
					</div>
				</div>
				<!-- 加载提示符 -->
				<div class="infinite-scroll-preloader" style="display: none;">
					<div class="preloader">
					</div>
				</div>
			</div>
			<div id="goodcover"></div>
			<div id="exchange_appli">
				<div class="total_top">
					<div class="collect_total">
						<p class="thirty_six">交易统计</p>
						<h6>0.00</h6>
						<p class="twenty_six">待收金额(元)</p>
					</div>
					<div class="collect">
						<div class="fl">
							<div class="integer">0.00</div>
							<div>待收本金（元）</div>
						</div>
						<div class="fl">
							<div class="integer">0.00</div>
							<div>待收回报（元）</div>
						</div>
					</div>
				</div>
				<div class="total_bottom a9">
					<ul>
						<li><span class="fl">交易总额</span><span class="fr">￥0.00</span></li>
						<li><span class="fl">购买期数</span><span class="fr">0</span></li>
						<li><span class="fl">已收本金</span><span class="fr">￥0.00</span></li>
						<li><span class="fl">已收回报</span><span class="fr">￥0.00</span></li>

					</ul>
				</div>
				<!-- 关闭按钮-->
				<div class="close">
					<a href="#" id="closebtn"></a>
				</div>
			</div>

		</div>
		<div class="background">

		</div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(".mysheep").height(($(".mysheep").width() / 710 * 298) + "px");
			$("button").focus(function() {
				this.blur()
			});
			/*点击切换*/

			$(".header a").click(function() {
				$("#goodcover").css("display", "block");
				$("#exchange_appli").css("display", "block");
			})
			$("#closebtn").click(function() {
				$("#goodcover").css("display", "none");
				$("#exchange_appli").css("display", "none");
			})
		</script>
	</body>

</html>
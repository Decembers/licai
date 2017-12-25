<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\GitHub\licai./application/wap\view\member\withdraw.html";i:1514169266;}*/ ?>
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
			.bank_queue {
				width: 95%;
				margin: 0 auto;
			}

			.no_record {
				width: 11rem;
				height: 12rem;
				margin: 7.5rem auto 0 auto;
				background: url(__WAP__/img/no_bank.png) no-repeat center center;
				background-size: 100% 100%;
			}

			.big-button {
				position: fixed;
				left: 50%;
				bottom: 3.75rem;
				margin-left: -42.5vw;
			}

			.bank_bg {
				width: 95%;
				margin: 1rem auto;
				box-sizing: border-box;
				padding-left: 1rem;
				padding-right: 1rem;
				background-color: white;
			}

			.bank_bg ul,
			.bank_bg ul li {
				width: 100%;
			}

			.bank_bg ul li {
				display: flex;
				height: 4.5rem;
				line-height: 4.5rem;
				border-top: 1px solid #ededed;
				position: relative;
			}

			.bank_bg ul li:nth-child(1) {
				border: none;
			}

			.bank_bg ul li>span {
				/*width: 6rem;*/
				line-height: 4.5rem;
				position: absolute;
				top: 0;
				left: 0;
			}

			.bank_bg ul li>div {
				width: 100%;
				box-sizing: border-box;
				padding-left: 6rem;
			}

			.bank_bg ul li>div input {
				width: 100%;
				height: 3rem;
				line-height: 3rem;
				margin-top: 0.8rem;
				font-size: 1.5rem;
			}

			.region_select div {
				display: flex;
			}

			.region_select div select {
				width: 33%;
				height: 2rem;
				margin-top: 1.5rem;
				color: gray;
			}

			.this_bank {
				color: gray;
			}

			.bank_list {
				position: relative;
			}

			.entered {
				transform: rotate(90deg);
				position: absolute;
				top: 0;
				right: 1rem;
			}

			#red_select_list1 {
				width: 100%;
				height: 100vh;
				position: fixed;
				top: 120vh;
				left: 0;
				z-index: 1200;
				background-color: #F0F0F3;
				transition: top 0.3s;
				overflow: auto;
			}

			#red_select_list1 .red_seclet {
				width: 100%;
				height: 100%;
				overflow: scroll;
			}

			#red_select_list1 li {
				height: 3rem;
				line-height: 3rem;
				padding: 0 15px;
				width: 100%;
			}

			#closeList {
				background: #3db4cc;
				color: #fff;
			}

			#red_select_list1 li span {
				font-size: 1.5rem;
			}

			#red_select_list1 li input {
				opacity: 0;
			}

			.close-popup {
				border-bottom: 1px solid #ededed;
				border-radius: 0;
				position: relative;
				background: #fff;
			}
			/*红包关闭*/
			/*红包 样式*/

			.default_red span {
				font-size: 0.9rem;
			}

			.clearfix {
				display: flex;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>提现</h3>
				<a href="<?php echo url('member/withdrawlog'); ?>">提现记录</a>
			</div>
			<div class="bank_queue">
				<!-- 如果没有银行卡，则以下显示-->
				<!--
			<p class="auTip a9">您只有身份认证（请到“设置”中进行认证）后才可添加银行卡，提现哦。若您已认证，请直接添加银行卡∩_∩。</p>
			<div class="no_record"></div>
			-->
				<!-- 结束-->
				<p class="auTip a9" style="margin-top: 1rem;">您只有身份认证（请到“设置”中进行认证）后才可添加银行卡，提现哦。若您已认证，请直接添加银行卡∩_∩。</p>
				<div class="no_record"></div>
			</div>
			<div class="bank_bg white fillet">
				<ul>
					<li class="dl">
						<span class="name">持 卡 人</span>
						<div class="info">
							<input type="text" value="" placeholder="请输入持卡人姓名">
						</div>
					</li>
					<li class="dl">
						<span class="name">卡号</span>
						<div class="info">
							<input id="bankcard" type="text" placeholder="请输入卡号">
						</div>
					</li>
					<li class="dl region_select">
						<span class="name">所在地</span>
						<div>
							<select id="s_province" name="s_province">
								<option value="省份">省份</option>

							</select>
							<select id="s_city" name="s_city">
								<option value="地级市">地级市</option>
							</select>
							<select id="s_county" name="s_county">
								<option value="市、县级市">市、县级市</option>
							</select>
							<script class="resources library" src="__WAP__/js/area.js" type="text/javascript"></script>

							<script type="text/javascript">
								_init_area();
							</script>
						</div>

					</li>
					<li class="dl">
						<span class="name">选择银行</span>
						<div class=" bank_list open-popup">
							<p class="this_bank">请查看银行列表</p>
							<span class="entered fr"></span>
						</div>
					</li>
					<li class="dl">
						<span class="name">开户支行</span>
						<div class="info">
							<input id="bankzone" type="text" placeholder="请输入开户行">
						</div>
					</li>
					<li class="dl">
						<span class="name">账户类型</span>
						<div class=" clearfix">
							<input type="hidden" id="bank_val" name="bank_val" value="1">
							<span class="card_type f_l a9">借记卡</span>
							<span class="no_type f_r">不支持信用卡</span>
						</div>
					</li>
				</ul>
			</div>
			<?php if($authentication == 1): ?>
			<button id="add" class="big-button press">添加银行卡</button>
			<?php else: ?>
			<button id="" class="big-button press" style="background:#ccc">添加银行卡</button>
			<?php endif; ?>
			<div id="red_select_list1">

				<ul class="red_seclet white">
					<li class="closeList" id="closeList"><span class="">关闭</span></li>

					<li class="close-popup">
						<span class="bankName">中国工商银行</span>
						<input type="radio" value="1">
					</li>
					<li class="close-popup">
						<span class="bankName">中国农业银行</span>
						<input type="radio" value="2">
					</li>
					<li class="close-popup">
						<span class="bankName">中国建设银行</span>
						<input type="radio" value="3">
					</li>
					<li class="close-popup">
						<span class="bankName">招商银行</span>
						<input type="radio" value="4">
					</li>
					<li class="close-popup">
						<span class="bankName">中国光大银行</span>
						<input type="radio" value="5">
					</li>
					<li class="close-popup">
						<span class="bankName">中国邮政储蓄银行</span>
						<input type="radio" value="6">
					</li>
					<li class="close-popup">
						<span class="bankName">兴业银行</span>
						<input type="radio" value="7">
					</li>
					<li class="close-popup">
						<span class="bankName">苏格兰皇家银行</span>
						<input type="radio" value="36">
					</li>
					<li class="close-popup">
						<span class="bankName">交通银行</span>
						<input type="radio" value="9">
					</li>
					<li class="close-popup">
						<span class="bankName">深圳发展银行</span>
						<input type="radio" value="16">
					</li>
					<li class="close-popup">
						<span class="bankName">上海浦东发展银行</span>
						<input type="radio" value="12">
					</li>
					<li class="close-popup">
						<span class="bankName">中国银行</span>
						<input type="radio" value="8">
					</li>
					<li class="close-popup">
						<span class="bankName">中信银行</span>
						<input type="radio" value="10">
					</li>
					<li class="close-popup">
						<span class="bankName">华夏银行</span>
						<input type="radio" value="11">
					</li>
					<li class="close-popup">
						<span class="bankName">城市信用社</span>
						<input type="radio" value="13">
					</li>
					<li class="close-popup">
						<span class="bankName">恒丰银行</span>
						<input type="radio" value="14">
					</li>
					<li class="close-popup">
						<span class="bankName">广东发展银行</span>
						<input type="radio" value="15">
					</li>
					<li class="close-popup">
						<span class="bankName">中国民生银行</span>
						<input type="radio" value="17">
					</li>
					<li class="close-popup">
						<span class="bankName">中国农业发展银行</span>
						<input type="radio" value="18">
					</li>
					<li class="close-popup">
						<span class="bankName">农村商业银行</span>
						<input type="radio" value="19">
					</li>
					<li class="close-popup">
						<span class="bankName">农村信用社</span>
						<input type="radio" value="20">
					</li>
					<li class="close-popup">
						<span class="bankName">城市商业银行</span>
						<input type="radio" value="21">
					</li>
					<li class="close-popup">
						<span class="bankName">农村合作银行</span>
						<input type="radio" value="22">
					</li>
					<li class="close-popup">
						<span class="bankName">浙商银行</span>
						<input type="radio" value="23">
					</li>
					<li class="close-popup">
						<span class="bankName">上海农商银行</span>
						<input type="radio" value="24">
					</li>
					<li class="close-popup">
						<span class="bankName">中国进出口银行</span>
						<input type="radio" value="25">
					</li>
					<li class="close-popup">
						<span class="bankName">渤海银行</span>
						<input type="radio" value="26">
					</li>
					<li class="close-popup">
						<span class="bankName">国家开发银行</span>

					</li>
					<li class="close-popup">
						<span class="bankName">村镇银行</span>
						<input type="radio" value="28">
					</li>
					<li class="close-popup">
						<span class="bankName">徽商银行股份有限公司</span>
						<input type="radio" value="29">
					</li>
					<li class="close-popup">
						<span class="bankName">南洋商业银行</span>
						<input type="radio" value="30">
					</li>
					<li class="close-popup">
						<span class="bankName">韩亚银行</span>
						<input type="radio" value="31">
					</li>
					<li class="close-popup">
						<span class="bankName">花旗银行</span>
						<input type="radio" value="32">
					</li>
					<li class="close-popup">
						<span class="bankName">渣打银行</span>
						<input type="radio" value="33">
					</li>
					<li class="close-popup">
						<span class="bankName">华一银行</span>
						<input type="radio" value="34">
					</li>
					<li class="close-popup">
						<span class="bankName">东亚银行</span>
						<input type="radio" value="35">
					</li>
				</ul>
			</div>
		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			//			$(".big-button").css("margin-left","-"+$(".big-button").width()/2+"px")
			$(".bank_bg").css("display", "none");
			$(".dl div select").focus(function() {
				$(this).css("color", "black");
			})
			$("#add").click(function() {
				if($(this).text() == "添加银行卡") {
					$(".bank_queue").css("display", "none");
					$(".bank_bg").css("display", "block");
					$(".header h3 ").text("添加银行卡");
					$(".header a").css("display", "none");
					$(".header div").css("display", "none");
					$(this).text("确认添加");
				} else if($(this).text() == "确认添加") {

				}
			})
			/*红包选择 弹出*/
			$(".bank_list").click(function() {
				$("#red_select_list1").css("top", "0");
				$(this).css("color", "black");
			})
			/*选择红包 或关闭*/
			$("#red_select_list1 ul li").click(function() {
				var tt = $("#red_select_list1 ul li").index($(this));
				if(tt == 0) {
					$("#red_select_list1").css("top", "100vh");
				} else {
					$("#red_select_list1").css("top", "100vh");
					var s1 = $(this).children().text();
					$(".bank_list p").text(s1);
					$(".bank_list p").css("color", "black");
				}
			})
		</script>
	</body>

</html>
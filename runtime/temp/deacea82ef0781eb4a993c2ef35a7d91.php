<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\GitHub\licai./application/wap\view\order\fzys.html";i:1513827921;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>趣味农场</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/shop.css" />
		<script src="__WAP__/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<style type="text/css">
			/*开抢按钮 首行背景 颜色*/
			.detail1,
			.big-button {
				background: linear-gradient(to right, #51d2a7, #51d1a1);
			}

			.detail3 .row6>p,
			.detail3 .row6>div>a,
			.overtop1 p:nth-child(2) {
				color: #51d2a7;
			}

			.row6>div>div {
				border: 1px solid #51d2a7;
				background-color: #51d2a7;
				box-sizing: border-box;
			}
			/*商铺辅助羊群说明*/
			a.found {
				color: #51d2a7;
				font-size: 0.75rem;
			}
			/*时间*/
			.timer-simple-seconds {
				font-size: 0.8rem;
			}

			.day,
			.hour,
			.minute,
			.second {
				font-size: 0.8rem;
			}

			#timer {
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
				<h3>项目详情</h3>
				<a href="####" style="opacity: 0;">交易统计</a>
			</div>
			<!---->
			<div class="detail">
				<div class="detail1">
					<div class="detail1_top">
						<div>
							<p>羊单价(元)</p>
							<p><span><?php echo $arr['price']; ?>.</span><span class="em">00</span></p>
						</div>
						<div>
							<p>剩余羊只（只）</p>
							<p><?php echo $arr['number']; ?></p>
						</div>
					</div>
					<div class="detail1_bottom">
						<p><span><?php echo $arr['number']; ?></span><span class="em">只苏尼特羊</span></p>
						<p><span><?php echo $arr['rate']; ?></span><span class="em">天联养周期</span></p>
						<p><span><?php echo $arr['return_price']; ?></span><span class="em"><em>%</em>年联养回报</span></p>
					</div>
				</div>
				<div class="detail2">
					<p><?php echo $arr['name']; ?></p>
					<p><span>项目编号</span><span class="em"><?php echo $arr['com_number']; ?></span></p>
					<p><span>开放时间</span><span id="timer" class="timer-simple-seconds" timer="<?php echo $time; ?>">
							<span class="day">0</span>天<span class="hour">0</span>时<span class="minute">0</span>分<span class="second">0</span>秒
						</span>
					</p>
				</div>
				<div class="detail3">
					<div class="row">
						<p>资金余额</p>
						<p><span class="em">￥</span><span class="em" style="font-size: 0.8rem;"><?php echo session('user.balance'); ?></span></p>
					</div>
					<div class="row">
						<p><span>购养数量</span><span>可手动输入</span></p>
						<p>
							<span id="subtract">-</span>
							<input type="tel" name="" id="number" value="1" />
							<span id="plus">+</span>
						</p>
					</div>
					<div class="row" style="display: none;">
						<p><span>使用红包</span><span>超出不返还</span></p>
						<p>
							<span>请选择红包</span><span class="icon"></span>
						</p>
					</div>
					<div class="row">
						<p>支付密码</p>
						<p>
							<input type="tel" name="" id="max6" placeholder="请输入支付密码" maxlength="6" />
						</p>
					</div>
					<div class="row">

						<p><span>共</span><span class="em" id="numbers">1</span><span>只羊:   </span><span class="em">￥</span><span class="em" id="qian">780.00</span>
							<span style="font-size: 0.6rem;margin-left: 2px;">（</span><span style=" font-size: 0.6rem;">养殖利润:</span><span class="em" style="font-size: 0.6rem;     color: #a9a9a9;">￥</span><span class="em" id="profit" style="font-size: 0.7rem;    color: #a9a9a9;">39.00</span><span class="em"></span><span style="font-size: 0.6rem;">）</span>
						</p>
					</div>
					<div class="row row6">
						<div>
							<!--<input type="checkbox" name="" id="" value="" checked="checked" />-->
							<div class="">
								<span>√</span>
							</div>
							<!--<div class="pretty info">
								<input type="checkbox">
								<label><i class="mdi mdi-check"></i></label>
							</div>-->
							<span>朕已阅读并同意</span>
							<a href="index1-shop-protocol2.html">《财富牧场服务协议》</a>
						</div>
						<p style="font-size: 0.8rem;" onclick="window.location='<?php echo url("Order/infolist",["id"=>$arr['id']]); ?>'">交易详情</p>
					</div>
				</div>
				<div class="detail4">

				</div>
			</div>
			<button class="big-button press" id="big-button"><span class="icon"></span><span>10点开抢</span></button>
			<a href="#" class="found m_co sh_au-ex" style="">商铺辅助羊群说明</a>
			<div id="goodcover"></div>
			<!-- 商铺辅助羊群群说明-->
			<div id="code" style="display: none;">
				<h6 class="shop_title">商铺辅助羊群说明</h6>
				<p class="shop_explain">各位亲爱的牧主大大的羊只出栏后，蒙高丽亚公司代购牧主们的羊只，但从屠宰场到实体店再到消费者，一个整体的产销流程需要35天左右，所以我们增加了蒙高丽亚商铺辅助羊群。常规羊群出栏后，牧主未兑换羊肉的羊只由下一任辅助牧主接收，直到羊只真正流入终端，辅助牧主也会得到相应的回报。</p>
				<!-- 关闭按钮-->
				<div class="close">
					<a href="#" id="closebt"></a>
				</div>
			</div>
			<!-- 选择红包-->
			<!--<div id="red_select_list" class="popup popup-about">
				<ul class="red_seclet white">
					<li class="closeList"><span class="close-popup">关闭</span></li>
				</ul>
			</div>-->
			<!--<div class="packet">
				<ul class="red_seclet white">
					<li class="closeList"><span class="close-popup">关闭</span></li>
				</ul>

			</div>-->
		</div>
		<div class="background">

		</div>
		<p class="overtop">超出剩余数量</p>
		<div class="overtop1">
			<p class="overtop_text"></p>
			<p>确定</p>
		</div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script src="__WAP__/js/time.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			/*买养 按钮禁用*/
			$("#big-button").attr({
				"disabled": "disabled"
			});
			/*阅读并同意的按钮*/
			var r6 = 0;
			$(".row6>div>div").click(function() {
				var st = $("button[id^='big-button']").attr("disabled");
				if(st == "disabled") {
					/*alert("已禁用");*/
				} else {
					/*alert("没有禁用");*/
					$(this).toggleClass("dui");
					r6 = r6 + 1;
					var r6s = r6 % 2;
					if(r6s == 1) {
						$("#big-button").css("background", "linear-gradient(to right, #b7b5b4, #b7b5b4)");
						$("#big-button").attr({"disabled": "disabled"});
					} else {
						$("#big-button").removeAttr("disabled");
						$("#big-button").css("background", "linear-gradient(to right, #3db4cc, #3db4cc)");
					}
				}

			})
			/*羊数量 - */
			$("#subtract").click(function() {
				var num = parseInt($("#number").val());
				if($("#number").val() == "") {
					num = 0;
					$("#number").val("1");
					bian();
				}
				if(num > 1) {
					$("#number").val(num - 1);
					bian();
				}
			})
			/*羊数量 + */
			$("#plus").click(function() {
				var num = parseInt($("#number").val());
				if($("#number").val() == "") {
					num = 0;
				}
				/*获取羊数量 剩余*/
				var zui = parseInt($(".detail1_top div:nth-child(2) p:nth-child(2)").text());
				if(num >= zui) {
					$("#number").val(zui);
					bian();
					overtop();
				} else {
					$("#number").val(num + 1);
					bian();
				}

			})
			/*羊数量输入时时变更*/
			$("#number").bind('input', function() {
				if($(this).val() < 0) {
					$(this).val("0");
				}
				/*获取羊数量 剩余*/
				var zui = parseInt($(".detail1_top div:nth-child(2) p:nth-child(2)").text());
				if($(this).val() >= zui) {
					overtop();
					$(this).val(zui);
				}
				bian();
			})
			/*羊数量超出 剩余 提升*/
			function overtop() {
				$(".detail").after($("body>p.overtop").clone(true));
				var ss1 = $(".wrapper .overtop");
				ss1.css("display", "block");
				ss1.css("opacity", "1");
				setTimeout(function() {
					ss1.css("opacity", "0");
					ss1.remove();
				}, 1000);
			}

			function bian() {
				/*羊只数量 输出*/
				if($("#number").val() == "") {
					$("#numbers").text(0);
				} else {
					$("#numbers").text(Math.abs($("#number").val()));
				}
				tofix($("#qian"), 780.00); /*羊总价*/
				tofix($("#profit"), 39.00); /*羊利润*/
			}
			/* 总价 利润 输出*/
			function tofix(st, fs) {
				var zong = $("#number").val() * fs;
				var zo = zong.toString();
				var one = zong % 1;
				var one2 = zong % 0.1;
				if(one == 0) {
					st.text(zo + ".00");
				} else {
					if(one2 == 0) {
						st.text(zo + "0");
					} else {
						st.text(zong.toFixed(2));
					}
				}
			}
			/*$(".detail3 .row:nth-child(3) p:nth-child(2)").click(function() {
				$(".packet").css("top", "0vh");
				$("#red_select_list").css("display","block");
			})
			$(".packet .red_seclet .closeList .close-popup").click(function() {
				$(".packet").css("top", "100vh");
			})*/
			/*商铺辅助羊群说明*/
			$("a.found").click(function() {
				$("#goodcover").css("display", "block");
				$("#code").css("display", "block");
			})
			/*商铺辅助羊群说明 关闭*/
			$(".close").click(function() {
				$("#goodcover").css("display", "none");
				$("#code").css("display", "none");
			})
			/*卖完 状态切换*/
			/*$(".detail4").click(function() {
				$(".detail4").css("display", "none");
				$(".detail3").css("display", "block");
			})*/

			/*买羊按钮点击*/
			$("#big-button").click(function() {
				$("#goodcover").css("display", "block");
				$(".overtop1").css("display", "block");
				if($("#max6").val() == "") {
					$(".overtop1 .overtop_text").text("请输入支付密码");
				} else if($("#max6").val().length !== 6) {
					$(".overtop1 .overtop_text").text("支付密码错误");
				} else if($("#max6").val().length == 6) {
					$(".overtop1 .overtop_text").text("余额不足");
				}
			})
			/* 弹窗提示的确定*/
			$(".overtop1 p:nth-child(2)").click(function() {
				$("#goodcover").css("display", "none");
				$(".overtop1").css("display", "none");
			})
			/* 弹窗提示的背景*/
			$("#goodcover").click(function() {
				$("#goodcover").css("display", "none");
				$(".overtop1").css("display", "none");
				$("#code").css("display", "none");
			})
		</script>

	</body>

</html>
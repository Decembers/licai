<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:53:"E:\GitHub\licai./application/wap\view\order\fzsx.html";i:1513828307;}*/ ?>
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
			.detail3 .row6>div>a ,.overtop1 p:nth-child(2){
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
							<p>0</p>
						</div>
					</div>
					<div class="detail1_bottom">
						<p><span><?php echo $arr['numbers']; ?></span><span class="em">只苏尼特羊</span></p>
						<p><span><?php echo $arr['rate']; ?></span><span class="em">天联养周期</span></p>
						<p><span><?php echo $arr['return_price']; ?></span><span class="em"><em>%</em>年联养回报</span></p>
					</div>
				</div>
				<div class="detail2">
					<p><?php echo $arr['name']; ?></p>
					<p><span>项目编号</span><span class="em"><?php echo $arr['com_number']; ?></span></p>
					<p><span>开放时间</span><span id="" class="em">售羲</span>
				</div>
				<div class="detail3" style="display: none;">
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
							<span style="font-size: 0.6rem;margin-left: 2px;">（</span><span style=" font-size: 0.6rem;">养殖利润:</span><span class="em" style="font-size: 0.6rem;     color: #a9a9a9;">￥</span><span class="em" id="profit" style="font-size: 0.7rem;    color: #a9a9a9;">10.75</span><span class="em"></span><span style="font-size: 0.6rem;">）</span>
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
							<a href="index1-shop-protocol.html">《财富牧场服务协议》</a>
						</div>
						<p style="font-size: 0.8rem;" onclick="window.location='<?php echo url("Order/infolist",["id"=>$arr['id']]); ?>'">交易详情</p>
					</div>
				</div>
				<div class="detail4">

				</div>
			</div>
			<button class="big-button press" id="big-button">交易详情</button>
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
		<script type="text/javascript">
			$(".detail4").css("display","block");
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
			$("#plus").click(function() {
				var num = parseInt($("#number").val());
				if($("#number").val() == "") {
					num = 0;
				}
				var zui = parseInt($(".detail1_top div:nth-child(2) p:nth-child(2)").text());
				if(num >= zui) {
					$("#number").val(zui);

					bian();
				} else {
					$("#number").val(num + 1);
					bian();
				}

			})
			$("#number").bind('input', function() {
				if($(this).val() < 0) {
					$(this).val("0");
				}
				var zui = parseInt($(".detail1_top div:nth-child(2) p:nth-child(2)").text());
				if($(this).val() >= zui) {
					overtop();
					$(this).val(zui);

				}
				bian();
			})

			function overtop() {
				$(".detail").after($("body>p.overtop").clone(true));
				var ss = $(".wrapper .overtop").length;
				var ss1 = $(".wrapper .overtop");
				$(".wrapper .overtop").css("display", "block");
				$(".wrapper .overtop").css("opacity", "1");
				/*for(var i = 0; i < ss + 1; i++) {*/
					setTimeout(function() {
						ss1.css("opacity", "0");
						/*$(".wrapper .overtop:nth-child(" + i + ")").css("opacity", "0");
						$(".wrapper .overtop:nth-child(" + i + ")").remove();*/
						 ss1.remove();
					}, 1000);
			/*	}*/
				/*if($(".wrapper .overtop").length > 0) {
					setTimeout(function() {

						$(".wrapper .overtop").remove();
					}, 2000);
				}*/

				/*$(".detail").after($("body>p.overtop").clone(true));
				var ss = $(".wrapper .overtop").length;
				$(".wrapper .overtop").css("display", "block");
				$(".wrapper .overtop").css("opacity", "1");
				for(var i = 0; i < ss + 1; i++) {

					setTimeout(function() {
						$(".wrapper .overtop:nth-child(" + i + ")").css("opacity", "0");
						$(".wrapper .overtop:nth-child(" + i + ")").remove();
					}, 500);
				}
				setTimeout(function() {
						if($(".wrapper .overtop").length > 0) {
							for(var s = 0; s < $(".wrapper .overtop").length; s++) {
								$(".wrapper .overtop:nth-child(" + s + ")").remove();
							}
						}
						}, 1500)*/

				/*	setTimeout(function() {
								$(".wrapper .overtop:nth-child("+i+")").remove();
							}, 1000);*/
				/*setTimeout(function() {
					$(".wrapper .overtop:nth-child("+ss+")").css("opacity", "0");
				}, 100);

				setTimeout(function() {
					$(".wrapper .overtop:nth-child("+ss+")").css("opacity", "1");
					$(".wrapper .overtop:nth-child("+ss+")").remove();
				}, 500);*/
				/* $(".detail").after($("body>p.overtop").clone(true));
				 var ss = $(".wrapper .overtop").length;

				$(".wrapper .overtop:nth-child("+ss+")").css("display", "block");
				$(".wrapper .overtop:nth-child("+ss+")").css("opacity", "1");

				setTimeout(function() {
					$(".wrapper .overtop:nth-child("+ss+")").css("opacity", "0");
				}, 100);

				setTimeout(function() {
					$(".wrapper .overtop:nth-child("+ss+")").css("opacity", "1");
					$(".wrapper .overtop:nth-child("+ss+")").remove();
				}, 500);*/
			}

			function bian() {
				if($("#number").val() == "") {
					$("#numbers").text(0);
				} else {
					$("#numbers").text($("#number").val());
				}
				var zong = $("#number").val() * 780;
				var zo = zong.toString();
				var profit1 = $("#number").val() * 10.75;
				var profits = profit1.toString();
				/*alert(zong+1+" "+zo+"."+1)*/
				var one = zong % 1;
				var one2 = zong % 0.1;
				if(one == 0) {
					$("#qian").text(zo + ".00");
				} else {
					if(one2 == 0) {
						$("#qian").text(zo + "0");
					} else {
						$("#qian").text(zong.toFix(2));
					}
				}
				var ones = profit1 % 1;
				var ones2 = profit1 % 0.5;
				if(ones == 0) {
					/*alert('0')*/
					$("#profit").text(profits + ".00");
				} else {
					if(ones2 == 0) {
						/*alert(".0")*/
						$("#profit").text(profits + "0");
					} else {
						/*alert(".00")*/
						$("#profit").text(profits);
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

			$("a.found").click(function() {
				$("#goodcover").css("display", "block");
				$("#code").css("display", "block");
			})
			$(".close").click(function() {
				$("#goodcover").css("display", "none");
				$("#code").css("display", "none");
			})
			$(".detail4").click(function() {
				$(".detail4").css("display", "none");
				$(".detail3").css("display", "block");
			})
			var r6 = 0;
			$(".row6>div>div").click(function() {
				$(this).toggleClass("dui");
				r6 = r6 + 1;
				var r6s = r6 % 2;
				if(r6s == 1) {
					$("#big-button").css("background", "linear-gradient(to right,#b7b5b4,#b7b5b4)");
					$("#big-button").attr({
						"disabled": "disabled"
					});
				} else {
					$("#big-button").removeAttr("disabled");
					$("#big-button").css("background", " linear-gradient(to right, #51d2a7, #51d1a1)");
				}
			})

			$("#big-button").click(function(){
				/*$("#goodcover").css("display", "block");
				$(".overtop1").css("display","block");
				if($("#max6").val()==""){
					$(".overtop1 .overtop_text").text("请输入支付密码");
				}else if($("#max6").val().length !== 6){

					$(".overtop1 .overtop_text").text("支付密码错误");
				}else if($("#max6").val().length == 6){
					$(".overtop1 .overtop_text").text("还未开始");
				}*/
				window.location.href = '<?php echo url("Order/infolist",["id"=>$arr['id']]); ?>';
			})
			$(".overtop1 p:nth-child(2)").click(function(){
				$("#goodcover").css("display", "none");
				$(".overtop1").css("display","none");
			})
			$("#goodcover").click(function(){
				$("#goodcover").css("display", "none");
				$(".overtop1").css("display","none");
				$("#code").css("display", "none");
			})
		</script>
	</body>

</html>
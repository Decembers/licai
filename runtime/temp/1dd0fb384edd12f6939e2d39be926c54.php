<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"E:\GitHub\licai./application/wap\view\member\listress.html";i:1514258954;}*/ ?>
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
			/*我的羊只 */

			.mysheep {
				width: 100%;
				/*height: 7.45rem;*/
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
				font-size: 24px;
				line-height: 2.9rem;
				margin: 1rem 0;
			}
			/*我的羊只 */

			.my_sheep {
				font-size: 14px;
			}
			/*成长*/

			.grow {
				line-height: 2.3rem;
				font-size: 14px;
				display: flex;
				justify-content: center;
			}

			.ing {
				margin-right: 0.7rem;
			}

			.no_sheep {
				width: 12rem;
				height: 13rem;
				margin: 7.5rem auto 5rem auto;
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

			.big-button {
				display: block;
			}

			.uc_invest-box ul,
			.bank_bg {
				/* display: none; */
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
			.bank_bg ul li,
			.uc_invest-box ul {
				width: 100%;
			}

			.uc_invest-box ul li {
				width: 95%;
				margin: 0.5rem auto;
				background-color: white;
			}

			.bank_bg ul li {
				display: flex;
				height: 3.5rem;
				line-height: 3.5rem;
				border-top: 1px solid #ededed;
				position: relative;
			}

			.bank_bg ul li:nth-child(1) {
				border: none;
			}

			.bank_bg ul li>span {
				line-height: 3.5rem;
				position: absolute;
				top: 0;
				left: 0;
			}

			.bank_bg ul li>div {
				width: 100%;
				box-sizing: border-box;
				padding-left: 5rem;
			}

			.bank_bg ul li>div input {
				width: 100%;
				height: 2rem;
				line-height: 2rem;
				font-size: 15px;
				font-size: 1rem;
			}

			.bank_bg ul li>div textarea {
				width: 100%;
				line-height: 2rem;
				height: 2rem;
				font-size: 15px;
				font-size: 1.1rem;
			}

			.region_select div {
				display: flex;
			}

			.region_select div select {
				width: 33%;
				height: 2rem;
				font-size: 15px;
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

			#label {
				width: 4rem;
				height: 2rem;
				box-sizing: border-box;
				position: relative;
				float: right;
				margin-top: 0.5rem;
				border-radius: 1rem;
				overflow: hidden;
				/*box-shadow: 1px 1px 0px 1px rgba(0, 0, 0, 0.18);*/
			}

			#label div {
				width: 8rem;
				height: 2rem;
				display: flex;
				margin-left: -4rem;
				transition: margin-left 0.5s;
				box-sizing: border-box;
			}

			#label div span {
				width: 4rem;
				height: 2rem;
				background-color: #34B2E5;
				border-radius: 1rem;
				box-shadow: 1px 1px 0px 1px rgba(0, 0, 0, 0.18);
				text-align: left;
				line-height: 2rem;
				box-sizing: border-box;
				padding: 0 0.5rem;
			}

			#label div span:nth-child(2) {
				background-color: gray;
				text-align: right;
			}

			#label p {
				position: absolute;
				top: 0;
				left: 0;
				width: 2rem;
				height: 2rem;
				border-radius: 1rem;
				box-sizing: border-box;
				border: 1px solid white;
				background-color: white;
				box-shadow: 0 1px 1px 1px rgba(28, 57, 81, 0.18);
				transition: left 0.5s;
			}
			/*uc_invest-box ul*/

			.uc_invest-box ul li {
				border-radius: 0.5rem;
				padding: 0.5rem;
				box-sizing: border-box;
			}

			.uc_invest-box ul li p {
				width: 100%;
				line-height: 2rem;
				display: flex;
				justify-content: space-between;
			}

			.uc_invest-box ul li .lip2 {
				color: gray;
				border-bottom: 1px solid #ededed;
				position: relative;
			}

			.uc_invest-box ul li .lip2 span {
				width: 100%;
				white-space: nowrap;
				text-overflow: ellipsis;
				overflow: hidden;
			}

			.uc_invest-box ul li .lip3 span:nth-child(2) {
				color: #3db4cc;
			}

			.sz {
				display: flex;
				position: absolute;
				top: 0;
				right: 0;
				opacity: 0;
			}

			.lip1 span,
			.lip3 span {
				width: 50%;
				white-space: nowrap;
				text-overflow: ellipsis;
				overflow: hidden;
			}

			.lip1 span:nth-child(2),
			.lip3 span:nth-child(2) {
				text-align: right;
			}

			.lip2 span {
				width: 100%;
				white-space: nowrap;
				text-overflow: ellipsis;
				overflow: hidden;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>收货地址</h3>
				<!--<a href="###">交易统计</a>-->
			</div>
			<div class="content infinite-scroll bgCo native-scroll" data-distance="0" now_page="1">
				<!-- 这里是页面内容区 -->
				<input type="hidden" id="response_code" value="1">
				<!--我的牧场-->
				<div class="uc_invest-box" all_page="0" ajaxurl="/wap/member.php?ctl=uc_invest&amp;status=2">
					<!-- 如果没有羊，则显示-->
					<!--<div class="no_sheep"></div>-->
					<!-- 没有羊结束-->
					<?php if($arr): ?>
						<ul >
						<?php if(is_array($arr) || $arr instanceof \think\Collection || $arr instanceof \think\Paginator): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
						<li class="lis">
							<p class="lip1"><span><?php echo $vo['name']; ?></span><span><?php echo $vo['mobile']; ?></span></p>
							<p class="lip2"><span class="dz"><?php echo $vo['address']; ?></span><span class="sz"><i class="sz1"><?php echo $vo['province_name']; ?></i><i class="sz2"><?php echo $vo['city_name']; ?></i><i class="sz3"><?php echo $vo['district_name']; ?></i></span></p>
							<p class="lip3"><span class="youbian"><?php echo $vo['postcode']; ?></span><span class="labels" onclick="shemr(<?php echo $vo['id']; ?>)">设为默认</span></p>
						</li>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					<?php else: ?>
						<div class="no_sheep"></div>
					<?php endif; ?>
				</div>
				<button class="big-button press">添加收货地址</button>
				<!-- 交易统计弹出框成功弹出-->

				<!-- 加载提示符 -->
				<div class="nas" style="display: none;">
					<ul>
						<li class="lis">
							<p class="lip1"><span></span><span></span></p>
							<p class="lip2"><span class="dz"></span><span class="sz"><i class="sz1"></i><i class="sz2"></i><i class="sz3"></i></span></p>
							<p class="lip3"><span class="youbian"></span><span class="labels"></span></p>
						</li>
					</ul>
				</div>
				<div class="infinite-scroll-preloader" style="display: none;">
					<div class="preloader">
					</div>
				</div>
			</div>
			<div id="goodcover"></div>

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
			$(".dl div select").focus(function() {
				$(this).css("color", "black");
			})
			var label = 0;
			$('#label').click(function() {
				label = label + 1;
				lable1();
			})
			$(".uc_invest-box ul li .lip3 .labels").click(function() {
				if($(this).text() == "已设为默认") {
					label = 1;
					var ts = $(".uc_invest-box ul li").index($(this).parent().parent());
					alert(ts);
					zuan1();
					lable1();
					moren(ts);
				}
			})
			$(".big-button").click(function() {
				if($(this).text() == "添加收货地址") {
					/*label = 0;
					lable1();
					zuan1();*/
					window.location.href="<?php echo url('member/address'); ?>";
				} else if($(this).text() == "朕填好了") {
					/*kong();*/
				}
			});

			function shemr(id) {
				$.ajax({
                    type : "POST",  //提交方式
                    url : "<?php echo url('member/listress'); ?>",//路径
                    data : {
                        "id" : id,
                    },
                    dataType : "json",//数据，这里使用的是Json格式进行传输
                    success : function(result) {
                    	//alert("请输入用111户名")
						var aa = JSON.parse(result);
						if (aa.code==1) {
							$(".overtop").text(aa.msg);
							overtop();
							setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
							window.location='<?php echo url("member/listress");; ?>';
							},1000);
						}else{
							$(".overtop").text(aa.msg);
							overtop();
						}
                    },
                    error : function (){
                    	$(".overtop").text('请刷新页面重试');
						overtop();
                }
				});
			}

			function zuan1() {
				$(".uc_invest-box").css("display", "none");
				$(".bank_bg").css("display", "block");
				$(".big-button").text("朕填好了");
				$(".header h3").text("收货信息");
			}
			/*按钮 点击切换*/
			function lable1() {
				var la = label % 2;
				if(la == 1) {
					$("#label p").css("left", "2rem");
					$("#label div").css("margin-left", "0rem");
				} else {
					label = 0;
					$("#label p").css("left", "0rem");
					$("#label div").css("margin-left", "-4rem");
				}
			}
			/*朕填好了 点击 判断*/
			function kong() {
				if($("#names").val() == "") {
					alert("请输入收货人姓名")
				} else {
					if($("#bankcard").val() == "") {
						alert("请输入电话号码")
					} else {
						if($("#address").val() == "") {
							alert("请输入详细地址")
						} else {
							if($("#bankzone").val() == "") {
								alert("请输入邮政编码")
							} else {
								if($("#s_province  option:selected").text() == "省份") {
									alert("请选择所在地")
								} else {
									if($("#s_city  option:selected").text() == "城市") {
										alert("请选择所在地")
									} else {
										if($("#s_county option:selected").text() == "城区") {
											alert("请选择所在地")
										} else {
											huoqu();
											hui();
										}
									}
								}
							}
						}
					}
				}
			}
			/* 填写完成 后  判断      lis 是否复制*/
			function huoqu() {
				var liss = $(".uc_invest-box ul li").length;
				if($(".uc_invest-box ul li:nth-child(" + liss + ") .lip1 span:nth-child(1)").text() == "") {
					xieru(liss);
				} else {
					$(".uc_invest-box ul li:nth-child(" + liss + ")").after($(".nas ul .lis").clone(true));
					xieru($(".uc_invest-box ul li").length);
				}
			}
			/* 把填写的内容 写入 复制 区域*/
			function xieru(len) {
				var mo = "";
				if(label == 1) {
					mo = "已设为默认";
				} else {
					mo = "";
				}
				$(".uc_invest-box ul li:nth-child(" + len + ") .lip1 span:nth-child(1)").text($("#names").val());
				$(".uc_invest-box ul li:nth-child(" + len + ") .lip1 span:nth-child(2)").text($("#bankcard").val());
				$(".uc_invest-box ul li:nth-child(" + len + ") .lip2 span:nth-child(1)").text($("#address").val());
				$(".uc_invest-box ul li:nth-child(" + len + ") .lip2 .sz .sz1").text($("#s_province  option:selected").text());
				$(".uc_invest-box ul li:nth-child(" + len + ") .lip2 .sz .sz2").text($("#s_city  option:selected").text());
				$(".uc_invest-box ul li:nth-child(" + len + ") .lip2 .sz .sz3").text($("#s_county option:selected").text());
				$(".uc_invest-box ul li:nth-child(" + len + ") .lip3 span:nth-child(1)").text($("#bankzone").val());
				$(".uc_invest-box ul li:nth-child(" + len + ") .lip3 span:nth-child(2)").text(mo);

				val();
			}
			/* 填写区域清空*/
			function val() {
				$(".bank_bg ul li div input").val("");
				$(".bank_bg ul li div textarea").val("");
				$("#s_province  option:selected").text("省份");
				$("#s_city  option:selected").text("城市");
				$("#s_county option:selected").text("城区");
			}
			/*转换*/
			function hui() {
				$(".uc_invest-box").css("display", "block");
				$(".uc_invest-box .no_sheep").css("display", "none");
				$(".uc_invest-box ul").css("display", "block");
				$(".bank_bg").css("display", "none");
				$(".big-button").text("添加收货地址");
				$(".header h3").text("收货地址");
			}
			/*默认点击*/
			function moren(ts) {
				ts = ts + 1;
				$("#names").val($(".uc_invest-box ul li:nth-child(" + ts + ") .lip1 span:nth-child(1)").text());
				$("#bankcard").val($(".uc_invest-box ul li:nth-child(" + ts + ") .lip1 span:nth-child(2)").text());
				$("#address").val($(".uc_invest-box ul li:nth-child(" + ts + ") .lip2 span:nth-child(1)").text());
				$("#s_province option:selected").text($(".uc_invest-box ul li:nth-child(" + ts + ") .lip2 .sz .sz1").text());
				$("#s_city option:selected").text($(".uc_invest-box ul li:nth-child(" + ts + ") .lip2 .sz .sz2").text());
				$("#s_county option:selected").text($(".uc_invest-box ul li:nth-child(" + ts + ") .lip2 .sz .sz3").text());
				$("#bankzone").val($(".uc_invest-box ul li:nth-child(" + ts + ") .lip3 span:nth-child(1)").text());

				/*$(".uc_invest-box ul li:nth-child(" + ts + ") .lip1 span:nth-child(1)").text($("#names").val());
				$(".uc_invest-box ul li:nth-child(" + ts + ") .lip1 span:nth-child(2)").text($("#bankcard").val());
				$(".uc_invest-box ul li:nth-child(" + ts + ") .lip2 span:nth-child(1)").text($("#address").val());
				$(".uc_invest-box ul li:nth-child(" + ts + ") .lip2 .sz .sz1").text($("#s_province  option:selected").text());
				$(".uc_invest-box ul li:nth-child(" + ts + ") .lip2 .sz .sz2").text($("#s_city  option:selected").text());
				$(".uc_invest-box ul li:nth-child(" + ts + ") .lip2 .sz .sz3").text($("#s_county option:selected").text());
				$(".uc_invest-box ul li:nth-child(" + ts + ") .lip3 span:nth-child(1)").text($("#bankzone").val());*/
			}
		</script>
	</body>

</html>
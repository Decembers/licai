<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"E:\GitHub\licai./application/wap\view\login\nomobile.html";i:1513930888;}*/ ?>
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

			.fillet {
				box-sizing: border-box;
				padding: 0 1rem;
				margin: 0.5rem 0;
			}

			.fillet ul li {
				margin:0 1rem;
				padding: 1rem 0;
				border-top: 1px solid #e5e5e5;
			}
			.fillet ul li:nth-child(1){
				border: none;
			}

			.form_modify {
				position: relative;
				margin: 0 auto;
			}

			.form_modify .number {
				background-position: left 55.5%;
			}

			.form_modify .code {
				background-position: left 67.5%;
			}

			.form_modify .upwd,
			.form_modify .more {
				background-position: left 40%;
			}

			.form_modify span {
				position: absolute;
				top: 1rem;
				left: 0.5rem;
				display: inline-block;
				width: 2rem;
				height: 3rem;
				background: url(__WAP__/img/iconlist_01.png) no-repeat;
				background-size: cover;
			}

			.form_modify .ver_code,
			.count_down {
				position: absolute;
				right: 0;
				top: 1rem;
				width: 8rem;
				height: 3rem;
				line-height: 3rem;
				border-radius: 1.5rem;
				font-size: 1.3rem;
				color: #fff;
				padding: 0;
				border-bottom: 0;
				background-color: #5ac3d8;
				box-sizing: border-box;
			}
			.count_down{
				background-color: rgba(0,0,0,0.6);
			}
			.form_modify input {
				width: 100%;
				height: 3rem;
				line-height: 3rem;
				padding-left: 3rem;
				box-sizing: border-box;

			}

			.changed,
			.pay-changed {
				display: block;
				width: 80%;
				height: 4rem;
				line-height: 4rem;
				border-radius: 2rem;
				font-size: 2rem;
				color: #fff;
				border: 0;
				background: linear-gradient(to right, #3db4cc, #6fd6ea);
				margin-left: 10%;
				margin-top: 3rem;
				text-align: center;
			}
		</style>
	</head>

	<body>
		<div class="wrapper">
			<div class="header">
				<div class="">
					<span class="icon"></span><span>返回</span>
				</div>
				<h3>修改手机号码</h3>
				<!--<a href="###">交易统计</a>-->
			</div>
			<div class="content bgCo native-scroll">
				<!-- 这里是页面内容区 -->

				<div class="register_login bgCo" id="mb_re_pwd">
					<div class="modify_login fillet">
						<ul>
							<li class="form_modify">
								<span class="number"></span>
								<input type="text" id="dl_mobile" name="dl_mobile" value="1101110110" placeholder="请输入手机号" maxlength="11">
							</li>
							<li class="form_modify">
								<span class="number"></span>
								<input type="text" id="dl_mobile1" name="dl_mobile" value="" placeholder="请输入新手机号" maxlength="11">
							</li>
							<li class="form_modify">
								<span class="code"></span>
								<input type="text" id="dl_mobile_code" name="dl_mobile_code" placeholder="请输入验证码" maxlength="6">
								<div class="count_down">60s</div>
								<input type="button" class="ver_code" value="验证码" id="dl_getcode">
							</li>

						</ul>
					</div>
					<input type="submit" value="保存" class="changed confirm" name="dl-submit" id="dl-submit">
				</div>

			</div>

		</div>
		<p class="overtop">签到成功</p>
		<div class="background"></div>
		<script src="__WAP__/js/header.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			/*footer 当前页选中状态*/
			$(".changed").click(function() {
				if($("#dl_mobile").val() == "") {
					alert("请输入手机号")
				} else {
					if($("#dl_mobile1").val() == "") {
						alert("请输入新手机号")
					} else {
						if($("#dl_mobile_code").val() == "") {
							alert("请输入验证码")
						} else {
								var mobilex=$("#dl_mobile1").val();
								var mobile = $("#dl_mobile").val();
								var code = $("#dl_mobile_code").val();
								$.ajax({
				                    type : "POST",  //提交方式
				                    url : "<?php echo url('Login/nomobile'); ?>",//路径
				                    data : {
				                        "mobile" : mobile,
				                        "mobilex" : mobilex,
				                        "code" : code,
				                    },
				                    dataType : "json",//数据，这里使用的是Json格式进行传输
				                    success : function(result) {
										if (result.code==1) {
											alert(result.msg);
										}else{
											alert(result.msg);
											// setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
											// window.location='<?php echo url("Login/login");; ?>';
											// },1000);
										}
				                    },
				                    error : function (){
				                    	alert('请刷新页面重试')
				                }
								});
						}
					}
				}
			})

			$('#dl_getcode').click(function() {
				if($("#dl_mobile1").val() == "") {
					alert("请输入新手机号")
				} else {
					if($("#dl_mobile1").val().length == 11) {
						$(".count_down").css("display", "block");
						$(".count_down").css("z-index", "10");
						$(".count_down").css("text-align", "center");
						$("p.overtop").text("验证码已发送，请注意查收");
						overtop();
						var s = 10;
						var j = setInterval(function() {
							s = s - 1;
							$(".count_down").html(s + "秒");
							if(s == 0) {
								$(".count_down").css("display", "none");
								$('#dl_getcode').val("请重新获取");
								clearInterval(j);
								$(".count_down").text("60秒");
							}
						}, 1000)
					} else {
						alert("请重新输入新手机号")
					}
				}
			})
			function overtop() {
				$(".content").after($("body>p.overtop").clone(true));
				var ss1 = $(".wrapper .overtop");
				ss1.css("display", "block");
				ss1.css("opacity", "1");
				setTimeout(function() {
					ss1.css("opacity", "0");
					ss1.remove();
				}, 1000);
			}
		</script>
	</body>

</html>
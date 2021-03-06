<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"E:\GitHub\licai./application/wap\view\login\login.html";i:1514190027;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>趣味农场</title>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no, width=device-width">
		<link rel="stylesheet" type="text/css" href="__WAP__/bootstrap-3.3.7/dist/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/header.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/style.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/spirit.css" />
		<link rel="stylesheet" type="text/css" href="__WAP__/css/media_quer.css" />
		<script src="__WAP__/js/jQuery v2.1.1.js"></script>
		<style type="text/css">
			.titleBig {
				width: 100%;
				text-align: center;
				color: #1a1a1f;
				font-size: 1.5rem;
				padding-top: 1rem;
			}

			.logo {
				display: block;
				width: 10rem;
				height: 3rem;
				margin: 1rem auto 0.425rem auto;
				background: url(http://www.caifumuchang.com/wap/tpl/fanwe/images/logo.jpg) no-repeat center center;
				background-size: cover;
			}

			.main {
				width: 100%;
				height: auto;
				margin: 0 auto;
			}

			.grassland {
				width: 100%;
				height: 10rem;
				background: url(http://www.caifumuchang.com/wap/tpl/fanwe/images/grassland.jpg) no-repeat;
				background-size: cover;
				position: fixed;
				bottom: 0;
			}

			h3 {
				font-family: "å¾®è½¯é›…é»‘";
				font-size: 2rem;
				color: #5ac3d8;
				text-align: center;
				font-weight: normal;
				margin: 0;
				padding: 0;
			}

			.container01,
			.container02,
			.container03 {
				padding: 0 3rem;
				width: 90%;
				box-sizing: border-box;
				margin: 2rem auto;
			}

			.form_group,
			.form_modify {
				position: relative;
				height: 4rem;
				margin: 0.75rem auto 0 auto;
				border-radius: 1.5rem;
			}

			.form_group .user,
			.form_modify .number {
				background-position: center 56%;
			}

			.form_group .upwd,
			.form_modify .upwd,
			.form_modify .more {
				background-position: center 40%;
			}

			.form_modify .user,
			.form_modify .groom {
				background-position: left 28%;
			}

			.form_modify .code {
				background-position: left 67.5%;
			}

			.user,
			.upwd,
			.number,
			.more,
			.user,
			.code,
			.groom {
				position: absolute;
				top: 1rem;
				left: 1rem;
				display: inline-block;
				width: 1.6rem;
				height: 2rem;
				background: url(__WAP__/img/iconlist_01.png) no-repeat;
				background-size: cover;
			}

			.delect,
			.display {
				position: absolute;
				top: 1rem;
				right: 0.5rem;
				width: 2rem;
				height: 2rem;
				background: url(__WAP__/img/iconlist_01.png) no-repeat;
				background-size: 2rem;
			}

			.display {
				background-position: 3px 18.5%;
			}

			.delect {
				background-position: 4px 9.5%;
			}

			.forgeted {
				margin-top: 1rem;
			}

			.forgeted a {
				color: #3db4cc !important;
			}

			.form_group input,
			.form_modify input {
				width: 100%;
				height: 4rem;
				border: 1px solid #ededed;
				border-radius: 3rem;
				padding-left: 3rem;
				box-sizing: border-box;
				font-size: 1.4rem;
				transition: border 0.2s, box-shadow 0.2s;
			}

			#getcode,
			.count_down,
			#getcode1,
			.count_down1 {
				position: absolute;
				right: 0.5rem;
				top: 1rem;
				width: 5rem;
				height: 2rem;
				line-height: 2rem;
				border-radius: 0.875rem;
				font-size: 0.8rem;
				color: #fff;
				padding: 0;
				border-bottom: 0;
				background-color: #5ac3d8;
				box-sizing: border-box;
				text-align: center;
			}

			.count_down,.count_down1 {
				display: none;
			}

			.register {
				color: #ffffff;
				font-size: 1rem;
				border: 0;
				background: linear-gradient(to right, #3db4cc, #6fd6ea);
			}

			.btns {
				display: inline-block;
				border: 1px solid #5ac3d8;
				width: 8rem;
				height: 3rem;
				line-height: 3rem;
				border-radius: 2rem;
				margin-top: 1rem;
				box-sizing: border-box;
				text-align: center;
			}

			.container02,
			.container03 {
				display: none;
			}

			#signup-submit,#signup-submit1{
				display: block;
				width: 90%;
				height: 3rem;
				line-height: 3rem;
				border-radius: 1.5rem;
				font-size: 1.5rem;
				color: #fff;
				border: 0;
				background: linear-gradient(to right, #3db4cc, #6fd6ea);
				text-align: center;
				margin: 0.5rem auto 0 auto;
			}

			.den {
				display: block;
				width: 100%;
				text-align: center;
				color: #5ac3d8 !important;
				margin-top: 1rem;
			}
		</style>
	</head>

	<body>
		<div class="wrapper" style="padding-bottom: 1px;">
			<div class="titleBig">请您登录</div>
			<div class="main">
				<div class="logo"></div>
				<h3>草原上的交易专家</h3>
				<div class="container01">
					<div class="form_group ">
						<span class="user"></span>
						<span class="delect"></span>
						<input type="text" name="mobile" id="email" placeholder="请输入用户名/手机号" maxlength="11">
					</div>
					<div class="form_group ">
						<span class="upwd"></span>
						<span class="display"></span>
						<input type="password" name="password" id="pwd" placeholder="请输入密码" maxlength="10">
					</div>
					<div class="forgeted clearfix">
						<a href="#" class="fl m_co" id="wang">忘记密码?</a>
						<a href="index1.html" class="fr m_co">随便逛逛</a>
					</div>
					<div class="clearfix">
						<div class="fl btns register">注册</div>
						<div class="fr btns " id="login">登录</div>
					</div>
				</div>
				<div class="container02">
					<div class="form_modify">
						<span class="user"></span>
						<span class="delect"></span>
						<input type="text" id="user_name" name="user_name" placeholder="请输入用户名">
					</div>
					<div class="form_modify">
						<span class="upwd"></span>
						<span class="delect"></span>
						<input type="password" id="user_pwd" name="user_pwd" placeholder="请输入密码(6-18位)" maxlength="18">
					</div>
					<div class="form_modify">
						<span class="more"></span>
						<span class="delect"></span>
						<input type="password" id="user_pwd_confirm" name="user_pwd_confirm" placeholder="请再次输入密码" maxlength="18">
					</div>
					<div class="form_modify">
						<span class="number"></span>
						<span class="delect"></span>
						<input type="tel" id="phone" name="phone" placeholder="请输入您的手机号" maxlength="11" >
					</div>
					<div class="form_modify">
						<span class="code"></span>
						<input type="button" class="ver_code" id="getcode" value="验证码">
						<div class="count_down">60s</div>
						<input type="text" id="mobile_code" name="mobile_code" placeholder="请输入验证码">
					</div>
					<div class="form_modify">
						<span class="groom"></span>
						<span class="delect"></span>
						<input type="text" id="referer" name="referer" value="" placeholder="推荐人手机号(选填)">
					</div>
					<input type="submit" value="注册" name="commit" id="signup-submit">
					<a href="###" class="den">返回登录</a>
				</div>
				<div class="container03">
					<div class="form_modify">
						<span class="number"></span>
						<span class="delect"></span>
						<input type="number" id="phone1" name="phone" placeholder="请输入您的手机号" maxlength="11">
					</div>
					<div class="form_modify">
						<span class="code"></span>
						<input type="button" class="ver_code" id="getcode1" value="验证码">
						<div class="count_down1">60s</div>
						<input type="text" id="mobile_code1" name="mobile_code" placeholder="请输入验证码">
					</div>
					<div class="form_modify">
						<span class="upwd"></span>
						<span class="delect"></span>
						<input type="password" id="user_pwd1" name="user_pwd" placeholder="请输入密码(6-18位)">
					</div>
					<div class="form_modify">
						<span class="more"></span>
						<span class="delect"></span>
						<input type="password" id="user_pwd_confirm1" name="user_pwd_confirm" placeholder="请再次输入密码">
					</div>

					<input type="submit" value="朕改好了" name="commit" id="signup-submit1">
					<a href="###" class="den">返回登录</a>
				</div>
			</div>
			<div class="grassland"></div>

		</div>

		<div class="background"></div>
		<p class="overtop">超出剩余数量</p>
		<script type="text/javascript">
			/*非空*/

			/*失去焦点判断*/
			function yanZheng(tag, reg) {
				tag.onblur = function() {
					if(reg.test(this.value)) {} else {
						if(this.value == "") {
							$(".overtop").text("请输入用户名/手机号")
							overtop();
						} else {
							$(".overtop").text("用户名/手机号错误，请重新输入")
							overtop();
						}
					}
				}
			}

			function overtop() {
				$(".main").after($("body>p.overtop").clone(true));
				var ss1 = $(".wrapper .overtop");
				ss1.css("display", "block");
				ss1.css("opacity", "1");
				setTimeout(function() {
					ss1.css("opacity", "0");
					ss1.remove();
				}, 1000);
			}
			/*密码：必须且只含有数字和字母，6-10位。  /^[a-zA-Z0-9]{6,10}$/*/
			function yanZheng1(tag, reg) {
				tag.onblur = function() {
					if(reg.test(this.value)) {} else {
						if(this.value == "") {
							$(".overtop").text("请输入密码")
							overtop();
						} else {
							$(".overtop").text("密码错误，请重新输入")
							overtop();
						}
					}
				};
			}

			function yan1(tag, reg) {
				if(reg.test(tag.value)) {
					yan(pwd, /^[a-zA-Z0-9]{6,10}$/);
				} else {
					if(tag.value == "") {
						$(".overtop").text("请输入用户名/手机号")
						overtop();
					} else {
						$(".overtop").text("用户名/手机号错误，请重新输入")
						overtop();
					}
				}
			}

			function yan(tag, reg) {
				if(reg.test(tag.value)) {
					var mobile=$("#email").val();
					var password=$("#pwd").val();
					$.ajax({
	                    type : "POST",  //提交方式
	                    url : "<?php echo url('Login/checkindex'); ?>",//路径
	                    data : {
	                        "mobile" : mobile,
	                        "password" : password,
	                    },
	                    dataType : "json",//数据，这里使用的是Json格式进行传输
	                    success : function(result) {
	                    	//alert("请输入用111户名")
							//var aa = JSON.parse(result);
							if (result.code==1) {
								$(".overtop").text(result.msg);
								overtop();
							}else{
								$(".overtop").text(result.msg);
								overtop();
								setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
								window.location='<?php echo url("index/index");; ?>';
								},1000);
							}
	                    },
	                    error : function (){
	                    	$(".overtop").text('请刷新页面重试');
							overtop();
	                }
					});
				} else {
					if(tag.value == "") {
						$(".overtop").text("请输入密码")
						overtop();
					} else {
						$(".overtop").text("密码错误，请重新输入")
						overtop();
					}
				}
			}

			var ema = document.getElementById("email");
			var pwd = document.getElementById("pwd");
			yanZheng(ema, /^[1][3,4,5,7,8][0-9]{9}$/);
			yanZheng1(pwd, /^[a-zA-Z0-9]{6,10}$/);
			$(".clearfix div").click(function() {
				if($(this).text() == "登录") {
					yan1(ema, /^[1][3,4,5,7,8][0-9]{9}$/);
				} else if($(this).text() == "注册") {
					$(".grassland").css("display", "none");
					$(".container03").css("display", "none");
					$(".container01").css("display", "none");
					$(".container02").css("display", "block");
				}
			})
			$("#wang").click(function() {
				$(".titleBig").text("忘记密码");
				$(".container03").css("display", "block");
				$(".container01").css("display", "none");
				$(".container02").css("display", "none");
			})
			/*input 清空*/
			$(".delect").click(function() {
				$(this).css("display", "none");
				$(this).next().val("");
			})



			/*注册*/
			$("#signup-submit").click(function() {
				if($("#user_name").val() == "") {
					alert("请输入用户名")
				} else {
					if($("#user_pwd").val() == "") {
						alert("请输入密码")
					} else {
						if($("#user_pwd_confirm").val() == "") {
							alert("请再次输入密码")
						} else {
							if($("#user_pwd_confirm").val() == $("#user_pwd").val()) {
								if($("#phone").val() == "") {
									alert("请输入您的手机号")
								} else {
									if($("#mobile_code").val() == "") {
										alert("请输入验证码")
									} else {


										var name=$("#user_name").val();
										var password=$("#user_pwd").val();
										var mobile = $("#phone").val();
										var code = $("#mobile_code").val();
										var referer= $("#referer").val();
										$.ajax({
						                    type : "POST",  //提交方式
						                    url : "<?php echo url('Login/checkreg'); ?>",//路径
						                    data : {
						                        "mobile" : mobile,
						                        "password" : password,
						                        "name" : name,
						                        "code" : code,
						                        "referrer" : referer
						                    },
						                    dataType : "json",//数据，这里使用的是Json格式进行传输
						                    success : function(result) {
												if (result.code==1) {
													$(".overtop").text(result.msg);
													overtop();
												}else{
													$(".overtop").text(result.msg);
													overtop();
													setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
													window.location='<?php echo url("Login/login");; ?>';
													},1000);
												}
						                    },
						                    error : function (){
						                    	$(".overtop").text('请刷新页面重试');
												overtop();
						                }
										});
									}
								}
							} else {
								alert("两次密码需一致")
							}
						}
					}
				}
			})
			$('#getcode').click(function() {
				if($("#phone").val() == "") {
					alert("请输入手机号")
				} else {
					if($("#phone").val().length == 11) {
						$(".count_down").css("display", "block");
						$(".count_down").css("z-index", "10");
						$(".count_down").css("text-align", "center");
						var s = 60;
						var j = setInterval(function() {
							s = s - 1;
							$(".count_down").html(s + "秒");
							if(s == 0) {
								$(".count_down").css("display", "none");
								clearInterval(j);
							}
						}, 1000)
					} else {
						alert("请重新输入新手机号")
					}
				}
			})

			/*
			 *修改密码
			 */
			$("#signup-submit1").click(function() {
				if($("#phone1").val() == "") {
					alert("请输入您的手机号")
				} else {
					if($("#mobile_code1").val() == "") {
						alert("请输入验证码")
					} else {
						if($("#mobile_code1").val() == "") {
							alert("请输入密码")
						} else {
								if($("#user_pwd_confirm1").val() == $("#user_pwd1").val()) {

										var password=$("#user_pwd1").val();
										var mobile = $("#phone1").val();
										var code = $("#mobile_code1").val();
										$.ajax({
						                    type : "POST",  //提交方式
						                    url : "<?php echo url('Login/nopassword'); ?>",//路径
						                    data : {
						                        "mobile" : mobile,
						                        "password" : password,
						                        "code" : code,
						                    },
						                    dataType : "json",//数据，这里使用的是Json格式进行传输
						                    success : function(result) {
												if (result.code==1) {
													$(".overtop").text(result.msg);
													overtop();
												}else{
													$(".overtop").text(result.msg);
													overtop();
													setTimeout(function(){  //使用  setTimeout（）方法设定定时2000毫秒
													window.location='<?php echo url("Login/login");; ?>';
													},1000);
												}
						                    },
						                    error : function (){
						                    	$(".overtop").text('请刷新页面重试');
												overtop();
						                }
										});

								} else {
									alert("请再次输入密码错误")
								}
							}
					}

				}
			})
			$('#getcode1').click(function() {
				if($("#phone1").val() == "") {
					alert("请输入手机号")
				} else {
					if($("#phone1").val().length == 11) {
						$(".count_down1").css("display", "block");
						$(".count_down1").css("z-index", "10");
						$(".count_down1").css("text-align", "center");
						var s = 60;
						var j = setInterval(function() {
							s = s - 1;
							$(".count_down1").html(s + "秒");
							if(s == 0) {
								$(".count_down1").css("display", "none");
								clearInterval(j);
							}
						}, 1000)
					} else {
						alert("请重新输入新手机号")
					}
				}
			})


			$(".den").click(function(){
				$(".titleBig").text("请您登录");
				$(".container03").css("display", "none");
				$(".container01").css("display", "block");
				$(".container02").css("display", "none");
				$(".grassland").css("display","block");
			})
		</script>
	</body>

</html>
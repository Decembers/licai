<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"D:\server\licai./application/wap\view\login\login.html";i:1513051105;}*/ ?>
﻿<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=2.0, user-scalable=0,minimum-scale=0.5">
    <link rel="shortcut icon" href="/favicon.ico">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<div id='wx_pic' style='margin:0 auto;display:none;'>
		<img src='__WAP__/picture/webwxgetmsgimg.jpg' />
	</div>

    <link rel="stylesheet" type="text/css" href="__WAP__/css/5955cf2b44bc646d364b593ac43d7bfc.css" />
    <script type='text/javascript' src='__WAP__/js/zepto.min.js' charset='utf-8'></script>
    <script type='text/javascript' src='__WAP__/js/fastclick.js' charset='utf-8'></script>
	<link rel="stylesheet" type="text/css" href="__WAP__/css/font-awesome.min.css" />
</head>
<body>
<div class="page" id='login'>
	<!-- 财富牧场-->
	<h1 class="title">财富牧场</h1>	<div class="content register_login_content">
				<!-- 这里是页面内容区 -->
		<div class="register_login">
			<div class="titleBig">请您登录</div>
			<!-- 主体内容-->
			<div class="main">
				<div class="logo"></div>
				<h3>草原上的交易专家</h3>
				<div class="container01">
					<div class="form_group ">
						<span class="user"></span>
						<span class="delect"></span>
						<input type="text" id="email" placeholder="请输入手机号"/>
					</div>
					<div class="form_group ">
						<span class="upwd"></span>
						<span class="display"></span>
						<input type="password" id="pwd" placeholder="请输入密码"/>
					</div>
					<div class="forgeted clearfix">
						<a href="#" class="fl m_co" onclick="RouterURL('/wap/index.php?ctl=forget_pwd','#forget_pwd',2)">忘记密码?</a>
						<a href="#" class="fr m_co" onclick="RouterURL('/wap/index.php?ctl=init','#init',2)">随便逛逛</a>
					</div>
					<div class="clearfix">
						<div class="fl btns bg register" onclick="RouterURL('/wap/index.php?ctl=register','#register',2)">注册</div>
						<div class="fr btns ui-button_login">登录</div>
					</div>
				</div>


			</div>
			<!--底部图-->
			<div class="grassland"></div>
		</div>
				</div>
</div>
<script type="text/javascript" src="__WAP__/js/239af4d6f98927908f3e3a40753f100a.js"></script>
</body>
</html>


<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:54:"D:\server\licai./application/index\view\login\reg.html";i:1512782415;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="__ROOT__/favicon.ico" >
    <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__LIB__/html5.js"></script>
    <script type="text/javascript" src="__LIB__/respond.min.js"></script>
    <script type="text/javascript" src="__LIB__/PIE_IE678.js"></script>
    <![endif]-->
    <link href="__ADMIN__/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
    <link href="__ADMIN__/h-ui.admin/css/H-ui.login.css" rel="stylesheet" type="text/css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="__LIB__/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <title>注册</title>
    <meta name="keywords" content="<?php echo \think\Config::get('site.keywords'); ?>">
    <meta name="description" content="<?php echo \think\Config::get('site.keywords'); ?>">
</head>
<body>
<div class="header">
    <h1></h1>
</div>
<div class="loginWraper">
    <div id="loginform" class="loginBox">
        <form class="form form-horizontal"  method="post" id="form" onsubmit="return false;">
            <div class="row cl">
                <label class="form-label col-xs-3 col-ms-3" style="line-height: 36px;font-size: 20px;">账户类型</label>
                <div class="formControls col-xs-6 col-ms-6">
                    个人用户:<input type="radio" name="user_type" value="1" checked="checked" >
                    企业用户:<input type="radio" name="user_type" value="2">
                </div>
                <div class="col-xs-3 col-ms-3"></div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3 col-ms-3" style="line-height: 36px;font-size: 20px;">用户昵称</label>
                <div class="formControls col-xs-6 col-ms-6">
                    <input name="name" type="text" placeholder="帐号" class="input-text size-L" datatype="*" nullmsg="请填写帐号" id="name">
                </div>
                <div class="col-xs-3 col-ms-3"></div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3 col-ms-3" style="line-height: 36px;font-size: 20px;">手机号码</label>
                <div class="formControls col-xs-6 col-ms-6">
                    <input name="account" type="text" placeholder="帐号" class="input-text size-L" datatype="*" nullmsg="请填写帐号" id="txt_mobile">
                </div>
                <div class="col-xs-3 col-ms-3"></div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-6 col-ms-6 col-xs-offset-3 col-ms-offset-3">
                    <input name="captcha" class="input-text size-L" type="text" placeholder="验证码" style="width:100px;min-width: auto" datatype="*" nullmsg="请填写验证码" id="yanzhengma">
                    <img id="captcha" src="<?php echo captcha_src(); ?>" alt="验证码" title="点击刷新验证码" style="cursor:pointer;width: 150px;height: 40px">

                </div>
                <div class="col-xs-3 col-ms-3"></div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3 col-ms-3" style="line-height: 40px;font-size: 20px;">短信验证码</label>
                <div class="formControls col-xs-6 col-ms-6">
                    <input name="text" type="password" placeholder="密码" class="input-text size-L" datatype="*" nullmsg="请填写密码" id="code">
                </div>
                <div class="col-xs-3 col-ms-3"></div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3 col-ms-3" style="line-height: 40px;font-size: 20px;">密码</label>
                <div class="formControls col-xs-6 col-ms-6">
                    <input name="password" type="password" placeholder="密码" class="input-text size-L" datatype="*" nullmsg="请填写密码" id="txt_password">
                </div>
                <div class="col-xs-3 col-ms-3"></div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3 col-ms-3" style="line-height: 40px;font-size: 20px;">确认密码</label>
                <div class="formControls col-xs-6 col-ms-6">
                    <input name="password" type="password" placeholder="密码" class="input-text size-L" datatype="*" nullmsg="请填写密码" id="txt_password2">
                </div>
                <div class="col-xs-3 col-ms-3"></div>
            </div>
            <div class="row cl">
                <label class="form-label col-xs-3 col-ms-3" style="line-height: 40px;font-size: 20px;">推荐人</label>
                <div class="formControls col-xs-6 col-ms-6">
                    <input name="password" type="password" placeholder="密码" class="input-text size-L" datatype="*" nullmsg="请填写密码" id="referrer">
                </div>
                <div class="col-xs-3 col-ms-3"></div>
            </div>
            <div class="row cl">
                <div class="formControls col-xs-6 col-xs-offset-3">
                    <input name="" type="submit" class="btn btn-success radius size-L mr-20" value="&nbsp;登&nbsp;&nbsp;&nbsp;&nbsp;录&nbsp;" id="btn_login">
                </div>
            </div>
        </form>
    </div>
</div>
<div class="footer">Copyright yuan1994 by <?php echo \think\Config::get('site.name'); ?> <?php echo \think\Config::get('site.version'); ?></div>
<script type="text/javascript" src="__ADMIN__/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__ADMIN__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__ADMIN__/lib/Validform/5.3.2/Validform.min.js"></script>
<script>
    $(function () {
        $("#captcha").click(function () {
            $(this).attr("src","<?php echo captcha_src(); ?>?t="+new Date().getTime())
        });
    })


    $(function(){
        $("#btn_login").click(function(){
            var user_type= $.trim($("input[name=user_type]:checked").val());
            var name = $.trim($("#name").val());
            var mobile   = $.trim($("#txt_mobile").val());
            var code     =  $.trim($("#code").val());
            var password = $.trim($("#txt_password").val());
            var password2= $.trim($("#txt_password2").val());
            var referrer = $.trim($("#referrer").val());
        if (mobile == undefined || mobile == "") {
          layer.msg("请输入手机号");
          return false;
        }
        // if (code == undefined || code == "") {
        //  layer.msg("请输入短信验证码");
        //  return false;
        // }
        if (password == undefined || password == "") {
          layer.msg("请输入密码");
          return false;
        }
        if (password.length < 6 || password.length > 20) {
          layer.msg("密码需要6~20位");
          return false;
        }
        if(password!=password2){
          layer.msg("两次密码输入不一致，请重新输入");
        return false;
        }
        $.ajax({
           url: "<?php echo url('login/checkreg'); ?>",
            dataType: "json",
            type: "POST",
            data: {mobile:mobile,name:name,password:password,user_type:user_type,referrer:referrer},
            success: function(data){

                if(data.code==200){
                  layer.msg("恭喜您，注册成功！2秒后跳转至登录页面...");
                  setTimeout(function(){
                    location.href = "<?php echo url('index/index'); ?>";
                  },2000);
                }else{
                    layer.msg(data.msg);
                    return false;
                }
            },
            error:function(){
                alert('error');
            }
        });
      });
    });
</script>
</body>
</html>
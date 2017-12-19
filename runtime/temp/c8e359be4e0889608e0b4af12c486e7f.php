<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"D:\server\licai./application/index\view\login\index.html";i:1512719450;}*/ ?>
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
    <title>登录</title>
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
                <label class="form-label col-xs-3 col-ms-3" style="line-height: 36px;font-size: 20px;">帐号</label>
                <div class="formControls col-xs-6 col-ms-6">
                    <input name="account" type="text" placeholder="帐号" class="input-text size-L" datatype="*" nullmsg="请填写帐号" id="txt_mobile">
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
<!-- <script>
    $(function () {
        $("#form").Validform({
            tiptype:2,
            ajaxPost:true,
            showAllError:true,
            callback:function(ret){
                if (ret.code){
                    if (ret.msg == '验证码错误!'){
                        $("#captcha").click();
                        $("[name='captcha']").val('');
                        layer.msg(ret.msg);
                    } else {
                        layer.alert(ret.msg);
                    }
                } else {
                    layer.msg("登录成功！");
                    location.href = '<?php echo \think\Request::instance()->get('callback')?: \think\Url::build("Login/index"); ?>';
                }
            }
        });
    })
</script> -->

<script>
    $(function(){
        $("#btn_login").click(function(){
            var mobile = $.trim($("#txt_mobile").val());
            var password = $.trim($("#txt_password").val());
            if (mobile == undefined || mobile == "") {
                layer.msg("请输入手机号");
                return false;
            }
            if (password == undefined || password == "") {
                layer.msg("请输入密码");
                return false;
            }
            if (password.length < 6 || password.length > 20) {
                layer.msg("密码需要6~20位");
                return false;
            }
            $.post("<?php echo url('index/login/checkindex'); ?>",{mobile:mobile,password:password},function(res){
                if (res.code == 200) {
                    layer.msg("登录成功！2秒后跳转...");
                    setTimeout(function(){
                        location.href = res.url;
                    },2000);
                } else {
                    layer.msg(res.msg);
                    return false;
                }
            },"json");
        });
    });
</script>
</body>
</html>
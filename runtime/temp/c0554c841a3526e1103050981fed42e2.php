<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:55:"D:\server\licai./application/admin\view\demo\layer.html";i:1488899632;s:58:"D:\server\licai./application/admin\view\template\base.html";i:1488899632;s:69:"D:\server\licai./application/admin\view\template\javascript_vars.html";i:1488899632;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <title><?php echo \think\Config::get('site.title'); ?></title>
    <link rel="Bookmark" href="__ROOT__/favicon.ico" >
    <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__LIB__/html5.js"></script>
    <script type="text/javascript" src="__LIB__/respond.min.js"></script>
    <script type="text/javascript" src="__LIB__/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui/css/H-ui.min.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/H-ui.admin.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/Hui-iconfont/1.0.7/iconfont.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/skin/default/skin.css" id="skin"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/app.css"/>
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css"/>
    
    <!--[if IE 6]>
    <script type="text/javascript" src="__LIB__/DD_belatedPNG_0.0.8a-min.js"></script>
    <script>DD_belatedPNG.fix('*');</script>
    <![endif]-->
    <!--定义JavaScript常量-->
<script>
    window.THINK_ROOT = '<?php echo \think\Request::instance()->root(); ?>';
    window.THINK_MODULE = '<?php echo \think\Url::build("/" . \think\Request::instance()->module(), "", false); ?>';
    window.THINK_CONTROLLER = '<?php echo \think\Url::build("___", "", false); ?>'.replace('/___', '');
</script>
</head>
<body>

<nav class="breadcrumb">
    <div id="nav-title"></div>
    <a class="btn btn-success radius r btn-refresh" style="line-height:1.6em;margin-top:3px" href="javascript:;" title="刷新"><i class="Hui-iconfont"></i></a>
</nav>


<div class="page-container">
    <button class="btn btn-success" onclick="layer_open('默认弹层', '<?php echo \think\Url::build('layer'); ?>')">默认弹层</button>
    <div class="mt-20 markdown">
```
layer_open('默认弹层', '<?php echo \think\Url::build('layer'); ?>'); //默认弹层宽高都为80%
```
    </div>
    <button class="btn btn-success" onclick="layer_open('全屏弹层', '<?php echo \think\Url::build('layer'); ?>', {w:'100%',h:'100%'})">全屏弹层</button>
    <div class="mt-20 markdown">
```
layer_open('全屏弹层', '<?php echo \think\Url::build('layer'); ?>', {w:'100%',h:'100%'}); //全屏弹层宽高都为100%
```
    </div>
    <button class="btn btn-success" onclick="layer_open('带警告的弹层', '<?php echo \think\Url::build('layer'); ?>', {confirm:true})">带警告的弹层</button>
    <div class="mt-20 markdown">
```
layer_open('带警告的弹层', '<?php echo \think\Url::build('layer'); ?>', {confirm:true}); //弹层关闭前会有警告提醒
```
    </div>
    <button class="btn btn-success" onclick="layer_open('带回调的弹层', '<?php echo \think\Url::build('layer'); ?>', {fn:function() {layer.alert('我是回调，会在弹层结束后触发')}})">带警告的弹层</button>
    <div class="mt-20 markdown">
```
layer_open('带回调的弹层', '<?php echo \think\Url::build('layer'); ?>', {fn:function() {layer.alert('我是回调，会在弹层结束后触发')}}); //回调会在弹层结束后触发
```
    </div>
    <button class="btn btn-success" onclick="layer_open('使用HTML内联弹层',$('#tpl').html(),{type:1})">使用HTML内联弹层</button>
    <div class="mt-20 markdown">
```
layer_open('使用HTML内联弹层',$('#tpl').html(),{type:1}); //使用HTML内联弹层，可以把HTML定义在script标签里，把type定义为text/html
<script type="text/html" id="tpl">
    <p>我是HTML</p>
    <p>信不信由你</p>
    <p>反正我是信了</p>
</script>
```
    </div>
    <div>
        以上弹层的参数都可以组合使用
    </div>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>

<script type="text/javascript" src="__LIB__/showdown/1.4.2/showdown.min.js"></script>
<script>
    $(function () {
        var converter = new showdown.Converter();
        $(".markdown").each(function () {
            $(this).html(converter.makeHtml($(this).html()))
        });
    })
</script>
<script type="text/html" id="tpl">
    <p>我是HTML</p>
    <p>信不信由你</p>
    <p>反正我是信了</p>
</script>

</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:62:"D:\server\licai./application/admin\view\admin_role\access.html";i:1488899632;s:58:"D:\server\licai./application/admin\view\template\base.html";i:1488899632;s:69:"D:\server\licai./application/admin\view\template\javascript_vars.html";i:1488899632;}*/ ?>
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


<div class="page-container">
        <div class="pt-5 pr-5 pos-f" style="right: 20px;top: 20px;">
            <button type="button" class="btn btn-primary radius save">&nbsp;&nbsp;保存&nbsp;&nbsp;</button>
            <button type="button" class="ml-20 btn btn-default radius" onclick="layer_close()">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
        </div>
    <div id="tree"></div>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>

<link rel="stylesheet" href="__LIB__/wdTree/css/tree.css">
<script type="text/javascript" src="__LIB__/wdTree/jquery.tree.js"></script>
<script>
    $(function () {
        $("#tree").treeview({
            showcheck: true,
            cbiconpath:'__LIB__/wdTree/css/images/icons/',
            data:<?php echo $tree; ?>,
            theme:'bbit-tree-lines',
        });

        $(".save").click(function () {
            var node = $("#tree").getCheckedNodes();
            ajax_req('<?php echo \think\Request::instance()->baseUrl(); ?>',{id:'<?php echo \think\Request::instance()->param('id'); ?>','node_id':node},undefined,undefined,true);
        });
    })
</script>

</body>
</html>
<?php if (!defined('THINK_PATH')) exit(); /*a:6:{s:60:"D:\server\licai./application/admin\view\login_log\index.html";i:1488899632;s:58:"D:\server\licai./application/admin\view\template\base.html";i:1488899632;s:69:"D:\server\licai./application/admin\view\template\javascript_vars.html";i:1488899632;s:59:"D:\server\licai./application/admin\view\login_log\form.html";i:1488899632;s:57:"D:\server\licai./application/admin\view\login_log\th.html";i:1488899632;s:57:"D:\server\licai./application/admin\view\login_log\td.html";i:1488899632;}*/ ?>
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
    <form class="mb-20" method="get" action="<?php echo \think\Request::instance()->baseUrl(); ?>">
    <input type="text" class="input-text" style="width:80px" placeholder="用户ID" name="uid" value="<?php echo \think\Request::instance()->param('uid'); ?>">
    <input type="text" class="input-text" style="width:150px" placeholder="用户帐号" name="account" value="<?php echo \think\Request::instance()->param('account'); ?>">
    <input type="text" class="input-text" style="width:150px" placeholder="用户姓名" name="name" value="<?php echo \think\Request::instance()->param('name'); ?>">
    <input type="text" class="input-text" style="width:200px" placeholder="登录IP" name="login_ip" value="<?php echo \think\Request::instance()->param('login_ip'); ?>">
    <input type="text" class="input-text" style="width:150px" placeholder="登录地点" name="login_location" value="<?php echo \think\Request::instance()->param('login_location'); ?>">
    <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
</form>
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
        </span>
        <span class="r pt-5 pr-5">
            共有数据 ：<strong><?php echo $count; ?></strong> 条
        </span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg mt-20">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" value="" name=""></th>
<th width=""><?php echo sort_by('用户ID','uid'); ?></th>
<th width=""><?php echo sort_by('用户帐号','account'); ?></th>
<th width="">用户姓名</th>
<th width="">登录IP</th>
<th width="">登录地点</th>
<th width="">浏览器</th>
<th width="">操作系统</th>
<th width="">登录时间</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><input type="checkbox" name="id[]" value="<?php echo $vo['id']; ?>"></td>
<td><?php echo high_light($vo['uid'],\think\Request::instance()->param('uid')); ?></td>
<td><?php echo high_light($vo['user']['account'],\think\Request::instance()->param('account')); ?></td>
<td><?php echo high_light($vo['user']['realname'],\think\Request::instance()->param('name')); ?></td>
<td><?php echo $vo['login_ip']; ?></td>
<td><?php echo high_light($vo['login_location'],\think\Request::instance()->param('login_location')); ?></td>
<td><?php echo $vo['login_browser']; ?></td>
<td><?php echo $vo['login_os']; ?></td>
<td><?php echo $vo['login_time']; ?></td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="page-bootstrap"><?php echo $page; ?></div>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>

</body>
</html>
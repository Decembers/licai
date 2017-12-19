<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"D:\server\licai./application/admin\view\admin_node\index.html";i:1488899632;s:58:"D:\server\licai./application/admin\view\template\base.html";i:1488899632;s:69:"D:\server\licai./application/admin\view\template\javascript_vars.html";i:1488899632;}*/ ?>
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
    
<link rel="stylesheet" href="__LIB__/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">
<link rel="stylesheet" href="__LIB__/contextmenu/jquery.contextmenu.css" type="text/css">
<style type="text/css">
    div#rMenu {
        position: absolute;
        visibility: hidden;
        top: 0;
        background-color: #555;
        text-align: left;
        padding: 2px;
    }

    div#rMenu ul li {
        margin: 1px 0;
        padding: 0 5px;
        cursor: pointer;
        list-style: none outside none;
        background-color: #DFDFDF;
    }
</style>

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


<div class="pos-f tp-page-aside">
    <div class="panel panel-primary tp-panel tp-panel-module">
        <div class="panel-header">模块</div>
        <div class="panel-body tp-box-list">
            <ul id="module-list">
                <?php if(is_array($modules) || $modules instanceof \think\Collection || $modules instanceof \think\Paginator): if( count($modules)==0 ) : echo "" ;else: foreach($modules as $key=>$module): ?>
                    <li data-module-id="<?php echo $module['id']; ?>"><a href="javascript:;" class="list-select"><?php echo $module['title']; ?>（<?php echo $module['name']; ?>）</a></li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>

    <div class="panel panel-primary tp-panel tp-panel-group">
        <div class="panel-header">分组</div>
        <div class="panel-body tp-box-list">
            <ul id="group-list">
                <li data-group-id="0"><a href="javascript:;" class="list-select"><i class="Hui-iconfont"></i> 未分组</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="tp-page-main">
    <div class="page-container">
        <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
            <?php if (\Rbac::AccessCheck('add', 'AdminNode', 'admin')) : ?>
            <a class="btn btn-primary radius J_add" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加</a>
            <?php endif; if (\Rbac::AccessCheck('forbid', 'AdminNode', 'admin')) : ?>
            <a href="javascript:;" onclick="treeOpAll('<?php echo \think\Url::build('forbid'); ?>', '禁用')"
               class="btn btn-warning radius ml-5"><i class="Hui-iconfont">&#xe631;</i> 禁用</a>
            <?php endif; if (\Rbac::AccessCheck('resume', 'AdminNode', 'admin')) : ?>
            <a href="javascript:;" onclick="treeOpAll('<?php echo \think\Url::build('resume'); ?>', '恢复')"
               class="btn btn-success radius ml-5"><i class="Hui-iconfont">&#xe615;</i> 恢复</a>
            <?php endif; if (\Rbac::AccessCheck('delete', 'AdminNode', 'admin')) : ?>
            <a href="javascript:;" onclick="treeOpAll('<?php echo \think\Url::build('delete'); ?>', '删除')"
               class="btn btn-danger radius ml-5"><i class="Hui-iconfont">&#xe6e2;</i> 删除</a>
            <?php endif; if (\Rbac::AccessCheck('recyclebin')) : ?><a href="javascript:;" onclick="open_window('回收站','<?php echo \think\Url::build('recyclebin', []); ?>')" class="btn btn-secondary radius mr-5"><i class="Hui-iconfont">&#xe6b9;</i> 回收站</a><?php endif; if (\Rbac::AccessCheck('load', 'AdminNode', 'admin')) : ?>
            <a href="javascript:;" class="btn btn-primary radius J_load"><i class="Hui-iconfont">&#xe645;</i> 批量导入</a>
            <?php endif; ?>
        </span>
        </div>
        <div class="zTreeDemoBackground left">
            <ul id="tree" class="ztree"></ul>
        </div>
    </div>
</div>

<div id="rMenu">
    <ul>
        <li class="J_add" onclick="hideRMenu();">添加节点</li>
        <li onclick="hideRMenu();onEditName('tree', zTree.getSelectedNodes()[0]);">编辑节点</li>
        <li onclick="hideRMenu();onRemove('tree', zTree.getSelectedNodes()[0]);">删除节点</li>
        <li onclick="checkTreeNode(true);">选中节点</li>
        <li onclick="checkTreeNode(false);">取消选择</li>
    </ul>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>

<script type="text/javascript" src="__LIB__/zTree/js/jquery.ztree.all.js"></script>
<script type="text/javascript" src="__LIB__/contextmenu/jquery.contextmenu.js"></script>
<script type="text/javascript">
// 当前链接
var THINK_CURRENT = THINK_CONTROLLER + '/<?php echo \think\Request::instance()->action(); ?>';
</script>
<script type="text/javascript" src="__STATIC__/js/admin_node.js"></script>

</body>
</html>
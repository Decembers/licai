<?php if (!defined('THINK_PATH')) exit(); /*a:7:{s:66:"D:\server\licai./application/admin\view\admin_node\recyclebin.html";i:1488899632;s:64:"D:\server\licai./application/admin\view\template\recyclebin.html";i:1488899632;s:58:"D:\server\licai./application/admin\view\template\base.html";i:1488899632;s:69:"D:\server\licai./application/admin\view\template\javascript_vars.html";i:1488899632;s:60:"D:\server\licai./application/admin\view\admin_node\form.html";i:1488899632;s:58:"D:\server\licai./application/admin\view\admin_node\th.html";i:1488899632;s:58:"D:\server\licai./application/admin\view\admin_node\td.html";i:1488899632;}*/ ?>
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
    <form class="mb-20" method="get" action="<?php echo \think\Url::build(\think\Request::instance()->action()); ?>">
    <div class="select-box" style="width:250px">
        <select name="group_id" class="select">
            <option value="">分组不限</option>
            <option value="0">未分组</option>
            <?php if(is_array($group_list) || $group_list instanceof \think\Collection || $group_list instanceof \think\Paginator): if( count($group_list)==0 ) : echo "" ;else: foreach($group_list as $key=>$group): ?>
                <option value="<?php echo $group['id']; ?>"><?php echo $group['name']; ?></option>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </select>
    </div>
    <input type="text" class="input-text" style="width:250px" placeholder="标题" name="title" value="<?php echo \think\Request::instance()->param('title'); ?>">
    <input type="text" class="input-text" style="width:250px" placeholder="名称" name="name" value="<?php echo \think\Request::instance()->param('name'); ?>">
    <input type="hidden" name="pid" value="<?php echo \think\Request::instance()->param('pid'); ?>">
    <button type="submit" class="btn btn-success" id="" name=""><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
</form>
    <div class="cl pd-5 bg-1 bk-gray">
        <span class="l">
            <?php if (\Rbac::AccessCheck('recycle')) : ?><a class="btn btn-success radius mr-5" href="javascript:;" onclick="recycle_all('<?php echo \think\Url::build('recycle', []); ?>')"><i class="Hui-iconfont">&#xe610;</i> 还原</a><?php endif; if (\Rbac::AccessCheck('deleteforever')) : ?><a href="javascript:;" onclick="del_forever_all('<?php echo \think\Url::build('deleteforever', []); ?>')" class="btn btn-danger radius mr-5"><i class="Hui-iconfont">&#xe6e2;</i> 彻底删除</a><?php endif; if (\Rbac::AccessCheck('clear')) : ?><a href="javascript:;" onclick="clear_recyclebin('<?php echo \think\Url::build('clear', []); ?>')" class="btn btn-danger radius mr-5"><i class="Hui-iconfont">&#xe6e2;</i> 清空回收站</a><?php endif; ?>
        </span>
        <span class="r pt-5 pr-5">
            共有数据 ：<strong><?php echo $count; ?></strong> 条
        </span>
    </div>
    <table class="table table-border table-bordered table-hover table-bg mt-20">
        <thead>
        <tr class="text-c">
            <th width="25"><input type="checkbox" value="" name=""></th>
<th width="50"><?php echo sort_by('ID','id'); ?></th>
<th width="80">分组</th>
<th width="80"><?php echo sort_by('标题','title'); ?></th>
<th width="100"><?php echo sort_by('名称','name'); ?></th>
<th width="100">节点类型</th>
<th width="60"><?php echo sort_by('排序','sort'); ?></th>
<th width="80">状态</th>
            <th width="70">操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr class="text-c">
            <td><input type="checkbox" name="id[]" value="<?php echo $vo['id']; ?>"></td>
<td><?php echo $vo['id']; ?></td>
<td>
    <?php if(($vo['group_id'] == 0) OR (!isset($group_list[$vo['group_id']]['name']))): ?>
        未分组
    <?php else: ?>
        <?php echo $group_list[$vo['group_id']]['name']; endif; ?>
</td>
<td><?php echo high_light($vo['title'],\think\Request::instance()->param('title')); ?></td>
<td><?php echo high_light($vo['name'],\think\Request::instance()->param('name')); ?></td>
<td><?php echo !empty($vo['type'])?'控制器':'<span class="c-red">方法</span>'; ?></td>
<td><?php echo $vo['sort']; ?></td>
<td><?php echo get_status($vo['status']); ?></td>
            <td class="f-14">
                <?php if (\Rbac::AccessCheck('recycle')) : ?> <a href="javascript:;" onclick="recycle(this,'<?php echo $vo['id']; ?>','<?php echo \think\Url::build('recycle', []); ?>')" class="label label-success radius ml-5">还原</a><?php endif; if (\Rbac::AccessCheck('deleteforever')) : ?> <a href="javascript:;" onclick="del_forever(this,'<?php echo $vo['id']; ?>','<?php echo \think\Url::build('deleteforever', []); ?>')" class="label label-danger radius ml-5">彻底删除</a><?php endif; ?>
            </td>
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

<script>
    $(function () {
        $("[name='group_id']").find("[value='<?php echo \think\Request::instance()->param('group_id'); ?>']").attr("selected",true);
    })
</script>

</body>
</html>
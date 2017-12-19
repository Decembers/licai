<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:56:"E:\GitHub\licai./application/admin\view\index\index.html";i:1488899632;s:69:"E:\GitHub\licai./application/admin\view\template\javascript_vars.html";i:1488899632;s:62:"E:\GitHub\licai./application/admin\view\template\nav_left.html";i:1488899632;s:62:"E:\GitHub\licai./application/admin\view\template\nav_menu.html";i:1488899632;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title><?php echo \think\Config::get('site.title'); ?></title>
    <meta name="keywords" content="<?php echo \think\Config::get('site.keywords'); ?>">
    <meta name="description" content="<?php echo \think\Config::get('site.keywords'); ?>">
    <link rel="Bookmark" href="__ROOT__/favicon.ico" >
    <link rel="Shortcut Icon" href="__ROOT__/favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="__LIB__/html5.js"></script>
    <script type="text/javascript" src="__LIB__/respond.min.js"></script>
    <script type="text/javascript" src="__LIB__/PIE_IE678.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="__LIB__/Hui-iconfont/1.0.7/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="__LIB__/icheck/icheck.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/style.css" />
    <link rel="stylesheet" type="text/css" href="__STATIC__/css/app.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="__LIB__/DD_belatedPNG_0.0.8a-min.js" ></script>
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
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="<?php echo \think\Url::build('/admin'); ?>"><?php echo \think\Config::get('site.name'); ?></a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="<?php echo \think\Url::build('/admin'); ?>">tp</a> <span class="logo navbar-slogan f-l mr-10 hidden-xs"><?php echo \think\Config::get('site.version'); ?></span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav class="nav navbar-nav">
    <ul class="cl">
        <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
            <ul class="dropDown-menu menu radius box-shadow">
                <li><a href="javascript:;" onclick="layer_open('回调测试', '<?php echo \think\Url::build('welcome'); ?>', {fn:function() {layer.msg('我是回调，弹层加载完成后触发')}});"><i class="Hui-iconfont">&#xe616;</i> 自己随意</a></li>
                <li><a href="javascript:;" onclick="full_page('关窗警告测试', '<?php echo \think\Url::build('welcome'); ?>', {confirm:true});"><i class="Hui-iconfont">&#xe613;</i> 添加菜单</a></li>
                <li><a href="javascript:;"><i class="Hui-iconfont">&#xe620;</i> 如果不需要</a></li>
                <li><a href="javascript:;"><i class="Hui-iconfont">&#xe60d;</i> 可以注释掉</a></li>
            </ul>
        </li>
    </ul>
</nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li><?php echo \think\Session::get('realname'); ?></li>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo \think\Session::get('real_name'); ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onclick="layer_open('个人信息', '<?php echo \think\Url::build('Pub/profile'); ?>')">个人信息</a></li>
                            <li><a href="javascript:;" onclick="layer_open('个人信息', '<?php echo \think\Url::build('Pub/password'); ?>')">修改密码</a></li>
                            <li><a href="javascript:;" onclick="logout()">退出</a></li>
                        </ul>
                    </li>
                    <li id="Hui-msg"> <a href="javascript:;" onclick="layer.msg('这个功能自己做')" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="绿色">橙色</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<aside class="Hui-aside">
    <input runat="server" id="divScrollValue" type="hidden" value="" />
    <div class="menu_dropdown bk_2">
        <?php if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?>
    <dl>
        <dt><i class="Hui-iconfont"><?php echo (htmlspecialchars_decode($group['icon']) !== ''?htmlspecialchars_decode($group['icon']):'&#xe616;'); ?></i> <?php echo $group['name']; ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd>
            <ul>
                <?php if(is_array($menu[$group['id']]) || $menu[$group['id']] instanceof \think\Collection || $menu[$group['id']] instanceof \think\Paginator): $i = 0; $__LIST__ = $menu[$group['id']];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($i % 2 );++$i;?>
                    <?php echo \think\Loader::action('Index/menu', ['list' => $item], 'widget'); endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </dd>
    </dl>
<?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:;" onClick="displaynavbar(this)"></a></div>
<section class="Hui-article-box">
    <div id="Hui-tabNav" class="Hui-tabNav hidden-xs">
        <div class="Hui-tabNav-wp">
            <ul id="min_title_list" class="acrossTab cl">
                <li class="active"><span title="我的桌面" data-href="welcome.html">我的桌面</span><em></em></li>
            </ul>
        </div>
        <div class="Hui-tabNav-more btn-group"><a id="js-tabNav-prev" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d4;</i></a><a id="js-tabNav-next" class="btn radius btn-default size-S" href="javascript:;"><i class="Hui-iconfont">&#xe6d7;</i></a></div>
    </div>
    <div id="iframe_box" class="Hui-article">
        <div class="show_iframe">
            <div style="display:none" class="loading"></div>
            <iframe scrolling="yes" frameborder="0" src="<?php echo \think\Url::build('welcome'); ?>"></iframe>
        </div>
    </div>
</section>
<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script>
    function logout() {
        layer.confirm('您确定要退出登录？',{title:'登出提醒'},function (index) {
            location.href = '<?php echo \think\Url::build("Pub/logout"); ?>'
        })
    }
</script>
</body>
</html>
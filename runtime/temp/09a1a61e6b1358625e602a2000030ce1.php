<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:61:"E:\GitHub\licai./application/admin\view\commodity\comadd.html";i:1513650005;s:58:"E:\GitHub\licai./application/admin\view\template\base.html";i:1488899632;s:69:"E:\GitHub\licai./application/admin\view\template\javascript_vars.html";i:1488899632;}*/ ?>
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


<link href="__ADMIN__/datetime/css/date.css" rel="stylesheet" type="text/css" />
<div class="page-container">
    <form class="form form-horizontal" id="form" method="post" action="<?php echo \think\Request::instance()->baseUrl(); ?>">
        <input type="hidden" name="id" value="<?php echo isset($vo['id']) ? $vo['id'] :  ''; ?>">
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品名称：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="商品名称" name="name" value="<?php echo isset($vo['name']) ? $vo['name'] :  ''; ?>"  datatype="*" nullmsg="请填写商品名称">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品图片：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" name="image" value="<?php echo isset($vo['image']) ? $vo['image'] :  ''; ?>" class="input-text" id="upload" placeholder="请点击后面的上传按钮" datatype="*" nullmsg="请填写图片url" style="width: 70%">
                <button type="button" class="btn btn-primary radius" onclick="layer_open('文件上传','<?php echo \think\Url::build('Upload/index', ['id' => 'upload']); ?>')">上传</button>
                <a onclick="$(this).attr('href', $('#upload').val())" type="button" class="btn btn-success radius" data-lightbox="preview">预览</a>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品单价：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="商品单价" name="price" value="<?php echo isset($vo['price']) ? $vo['price'] :  ''; ?>"  datatype="*" nullmsg="请填写商品单价">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品数量：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="商品数量" name="number" value="<?php echo isset($vo['number']) ? $vo['number'] :  ''; ?>"  datatype="*" nullmsg="请填写商品数量">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>限购数量：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="限购数量" name="restrict" value="<?php echo isset($vo['restrict']) ? $vo['restrict'] :  ''; ?>"  datatype="*" nullmsg="请填写商品数量">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>养殖周期：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="养殖周期" name="rate" value="<?php echo isset($vo['rate']) ? $vo['rate'] :  ''; ?>"  datatype="*" nullmsg="请填写养殖周期">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品利率：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="商品利率 % " name="return_price" value="<?php echo isset($vo['return_price']) ? $vo['return_price'] :  ''; ?>"  datatype="*" nullmsg="请填写商品利率">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品购买开始时间：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div class="demo">
                    <div class="lie"><input name="preselle_time" id="startTime" class="kbtn" /></div>
                </div>
                <div id="datePlugin"></div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品结束购买时间：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div class="demo">
                    <div class="lie"><input name="down_time" id="endTime" class="kbtn" /></div>
                </div>
                <div id="datePlugin"></div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品准备时间：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div class="demo">
                    <div class="lie"><input name="deal_time" id="zbTime" class="kbtn" /></div>
                </div>
                <div id="datePlugin"></div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">商品分类：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
                <div class="radio-box">
                    <input type="radio" name="return_mode" id="status-1" value="1" checked>
                    <label for="status-1">按月返还</label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="return_mode" id="status-0" value="2">
                    <label for="status-0">按期返还</label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">商品分类：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
                <div class="radio-box">
                    <input type="radio" name="classify" id="status-1" value="1" checked>
                    <label for="status-1">常规分类</label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="classify" id="status-0" value="2">
                    <label for="status-0">辅助分类</label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="classify" id="status-0" value="3">
                    <label for="status-0">vip分类</label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">商品状态：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
                <div class="radio-box">
                    <input type="radio" name="status" id="status-1" value="1" checked>
                    <label for="status-1">上架</label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="status" id="status-0" value="0">
                    <label for="status-0">下架</label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>商品详情：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <!-- 加载编辑器的容器 -->
                <script id="container" name="content" type="text/plain">
                    <?php echo isset($vo['content']) ? $vo['content'] :  ''; ?>
                </script>
        <script type="text/javascript" src="__LIB__/showdown/1.4.2/showdown.min.js"></script>
        <script>window.UEDITOR_HOME_URL = '__ADMIN__/ueditor/'</script>
        <script type="text/javascript" charset="utf-8" src="__ADMIN__/ueditor/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="__ADMIN__/ueditor/ueditor.all.js"> </script>
        <script type="text/javascript" charset="utf-8" src="__ADMIN__/ueditor/lang/zh-cn/zh-cn.js"></script>
                <script type="text/javascript">
                    var ue = UE.getEditor('container');

                </script>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>

        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <button type="submit" class="btn btn-primary radius">&nbsp;&nbsp;提交&nbsp;&nbsp;</button>
                <button type="button" class="btn btn-default radius ml-20" onClick="layer_close();">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
            </div>
        </div>
    </form>
    <div id="markdown" class="mt-20"></div>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>

<link rel="stylesheet" href="__LIB__/lightbox2/css/lightbox.min.css">
<script src="__LIB__/lightbox2/js/lightbox.min.js"></script>
<script type="text/javascript" src="__LIB__/Validform/5.3.2/Validform.min.js"></script>
<script>
    $(function () {


        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form").Validform({
            tiptype: 2,
            ajaxPost: true,
            showAllError: true,
            callback: function (ret){
                if (ret.code==0) {
                  layer.msg(ret.msg);
                  setTimeout(function(){
                    ajax_progress(ret);
                },1000);
                }else{
                    ajax_progress(ret);
                }
            }
        });
    })
</script>
<script type="text/javascript" src="__ADMIN__/datetime/js/date.js" ></script>
<script type="text/javascript">
$(function(){
    $('#startTime').date({theme:"datetime"});
    $('#endTime').date({theme:"datetime"});
    $('#zbTime').date({theme:"datetime"});
});
</script>

</body>
</html>
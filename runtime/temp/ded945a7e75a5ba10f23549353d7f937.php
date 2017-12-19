<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:68:"D:\server\licai./application/admin\view\one\two\three\four\edit.html";i:1488899632;s:58:"D:\server\licai./application/admin\view\template\base.html";i:1488899632;s:69:"D:\server\licai./application/admin\view\template\javascript_vars.html";i:1488899632;}*/ ?>
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
    <form class="form form-horizontal" id="form" method="post" action="<?php echo \think\Request::instance()->baseUrl(); ?>">
        <input type="hidden" name="id" value="<?php echo isset($vo['id']) ? $vo['id'] :  ''; ?>">
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>字段一：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="字段一" name="field1" value="<?php echo isset($vo['field1']) ? $vo['field1'] :  ''; ?>"  datatype="*" nullmsg="请填写字段一">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">选填：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="选填" name="option" value="<?php echo isset($vo['option']) ? $vo['option'] :  ''; ?>" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">下拉框：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <div class="select-box">
                    <select name="select" class="select">
                        <option value="1">选项一</option>
                        <option value="2">选项二</option>
                        <option value="3">选项三</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">单选：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
                <?php if(is_array(\think\Config::get('conf.sex')) || \think\Config::get('conf.sex') instanceof \think\Collection || \think\Config::get('conf.sex') instanceof \think\Paginator): if( count(\think\Config::get('conf.sex'))==0 ) : echo "" ;else: foreach(\think\Config::get('conf.sex') as $k=>$v): ?>
                <div class="radio-box">
                    <input type="radio" name="radio" id="radio-<?php echo $k; ?>" value="<?php echo $k; ?>">
                    <label for="radio-<?php echo $k; ?>"><?php echo $v; ?></label>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">复选框：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
                <div class="radio-box">
                    <input type="checkbox" name="checkbox[]" id="checkbox-1" value="1">
                    <label for="checkbox-1">选项一</label>
                </div>
                <div class="radio-box">
                    <input type="checkbox" name="checkbox[]" id="checkbox-2" value="2">
                    <label for="checkbox-2">选项二</label>
                </div>
                <div class="radio-box">
                    <input type="checkbox" name="checkbox[]" id="checkbox-3" value="3">
                    <label for="checkbox-3">选项三</label>
                </div>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">密码：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="password" class="input-text" placeholder="密码" name="password" value="<?php echo isset($vo['password']) ? $vo['password'] :  ''; ?>" >
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3">文本域：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <textarea class="textarea" placeholder="" name="textarea" onKeyUp="textarealength(this, 100)"><?php echo isset($vo['textarea']) ? $vo['textarea'] :  ''; ?></textarea>
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>日期：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text Wdate" placeholder="日期" name="date" value="<?php echo isset($vo['date']) ? $vo['date'] :  ''; ?>"  onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})"   datatype="*" nullmsg="请选择日期">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>手机号：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="手机号" name="mobile" value="<?php echo isset($vo['mobile']) ? $vo['mobile'] :  ''; ?>"  datatype="/^1[34578]\d{9}$/" nullmsg="请填写手机号" errormsg="手机号格式错误">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>邮箱：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="text" class="input-text" placeholder="邮箱" name="email" value="<?php echo isset($vo['email']) ? $vo['email'] :  ''; ?>"  datatype="e" nullmsg="请填写邮箱" errormsg="邮箱格式错误">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>排序：</label>
            <div class="formControls col-xs-6 col-sm-6">
                <input type="number" class="input-text" placeholder="排序" name="sort" value="<?php echo isset($vo['sort']) ? $vo['sort'] :  '50'; ?>"  datatype="*" nullmsg="请填写排序">
            </div>
            <div class="col-xs-3 col-sm-3"></div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-3 col-sm-3"><span class="c-red">*</span>状态：</label>
            <div class="formControls col-xs-6 col-sm-6 skin-minimal">
                <div class="radio-box">
                    <input type="radio" name="status" id="status-1" value="1" datatype="*" nullmsg="请选择状态">
                    <label for="status-1">启用</label>
                </div>
                <div class="radio-box">
                    <input type="radio" name="status" id="status-0" value="0" datatype="*" nullmsg="请选择状态">
                    <label for="status-0">禁用</label>
                </div>
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
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>

<script type="text/javascript" src="__LIB__/Validform/5.3.2/Validform.min.js"></script>
<script type="text/javascript" src="__LIB__/My97DatePicker/WdatePicker.js"></script>
<script>
    $(function () {
        $("[name='radio'][value='<?php echo isset($vo['radio']) ? $vo['radio'] :  '1'; ?>']").attr("checked", true);
        var checks = ''.split(",");
        if (checks.length > 0){
            for (var i in checks){
                $("[name='checkbox[]'][value='"+checks[i]+"']").attr("checked", true);
            }
        }
        $("[name='status'][value='<?php echo isset($vo['status']) ? $vo['status'] :  '1'; ?>']").attr("checked", true);
        $("[name='select']").find("[value='<?php echo isset($vo['select']) ? $vo['select'] :  ''; ?>']").attr("selected", true);

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
                ajax_progress(ret);
            }
        });
    })
</script>

</body>
</html>
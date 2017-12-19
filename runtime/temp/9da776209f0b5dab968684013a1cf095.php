<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"E:\GitHub\licai./application/admin\view\upload\index.html";i:1488899632;s:58:"E:\GitHub\licai./application/admin\view\template\base.html";i:1488899632;s:69:"E:\GitHub\licai./application/admin\view\template\javascript_vars.html";i:1488899632;}*/ ?>
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
    
<link rel="stylesheet" href="__LIB__/lightbox2/css/lightbox.min.css">

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
    <input type="hidden" id="callbackId" value="<?php echo \think\Request::instance()->param('id'); ?>">
    <div id="tab_upload" class="HuiTab">
        <div class="tabBar cl">
            <span>本地上传</span>
            <span>网络图片</span>
            <span>历史图片</span>
        </div>
        <div class="tabCon">
            <div>
                <div id="drag" class="mt-30" title="将文件拖拽到此处上传">
                    <label for="fileupload" title="点击上传">
                        <img src="__STATIC__/images/upload99.png" style="height: 100px;width: 100px;margin: 20px" alt="">
                    </label>
                </div>
                <input id="fileupload" type="file" name="file" data-url="<?php echo \think\Url::build('upload'); ?>">
            </div>
        </div>
        <div class="tabCon">
            <div class="form form-horizontal mt-30">
                <div class="formControls" id="net-image">
                    <input type="text" class="input-text radius" id="remote-input" style="width: 60%">
                    <button class="btn btn-secondary radius ml-10" type="button" id="crawl-btn">抓取</button>
                    <button class="btn btn-primary radius ml-10" type="button" id="remote-btn">确定</button>
                </div>
            </div>
        </div>
        <div class="tabCon">
            <div class="photo-list mt-30"></div>
            <div class="photo-page" id="photo-page"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="__LIB__/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="__LIB__/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script>
<script type="text/javascript" src="__STATIC__/js/app.js"></script>
<script type="text/javascript" src="__LIB__/icheck/jquery.icheck.min.js"></script>

<script src="__LIB__/laypage/1.3/laypage.js"></script>
<!--<script src="__LIB__/tpUpload/tpUpload.js"></script>-->
<script src="__LIB__/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
<script src="__LIB__/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
<script src="__LIB__/jQuery-File-Upload/js/jquery.fileupload.js"></script>
<script src="__LIB__/lightbox2/js/lightbox.min.js"></script>
<script>

    /*
     // uploadify 上传，需要可以自己使用
     $("#file-input").uploadify({
     'fileObjName' : 'file',
     'buttonText' : '选择文件',
     'buttonCursor' : 'pointer',
     'multi' : false,
     'fileSizeLimit' : '5MB',
     'fileTypeExts' : '*.gif; *.jpg; *.png',
     'swf'      : '__LIB__/uploadify/uploadify.swf',
     'uploader' : '<?php echo \think\Url::build("upload"); ?>',
     'onUploadError' : function (file, errorCode, errorMsg, errorString) {
     layer.alert('文件'+file.name+'上传失败：'+errorString);
     },
     'onUploadSuccess' : function (file, ret, response) {
     console.log(arguments);
     },
     'onFallback' : function () {
     layer.alert('您的浏览器不支持Flash文件上传');
     }
     });*/
    $(function () {
        var callbackId = $("#callbackId").val();
        // Tab 切换
        $.tpTab("#tab_upload .tabBar span", "#tab_upload .tabCon", "current", "click", "0", function (index, tabCon, tabBar) {
            if (index == 2 && tabCon.eq(index).find('.photo-list').html() == '') {
                getListImage({p:p,'count':'1'});
            }
        }, function (i) {

        });
        //
        $('#fileupload').fileupload({
            dataType: 'json',
            dropZone: $('#drag'),
            start: function () {
                layer_msg = layer.msg('正在上传中…', {time: 100000000});
            },
            progressall: function (e, data) {
                $('.layui-layer-msg .layui-layer-content').html('已上传' + (data.loaded / data.total * 100).toFixed(2) + '%');
            },
            done: function (e, data) {
                layer.close(layer_msg);
                callback(callbackId,data.result.data.name);
            }
        });
        $('#drag').bind('drop dragover', function (e) {
            e.preventDefault();
        }).on('dragenter', function (e) {
            $(this).addClass('dragenter');
        }).on('drop', function (e) {
            $(this).removeClass('dragenter');
        }).on('dragleave', function (e) {
            $(this).removeClass('dragenter');
        });;
        // 文件上传
        /*$("#file-input").tpUpload({
            url: '<?php echo \think\Url::build("upload"); ?>',
            data: {a: 'a'},
            drag: '#drag',
            start: function () {
                layer_msg = layer.msg('正在上传中…', {time: 100000000});
            },
            progress: function (loaded, total, file) {
                $('.layui-layer-msg .layui-layer-content').html('已上传' + (loaded / total * 100).toFixed(2) + '%');
            },
            success: function (ret) {
                callback(callbackId,ret.data[0]);
            },
            error: function (ret) {
                layer.alert(ret);
            },
            end: function () {
                layer.close(layer_msg);
            }
        });*/

        // 远程图片抓取
        $("#net-image").on('click', '#crawl-btn', function () {
            var remote_input = $("#remote-input");
            if (!remote_input.val()) {
                layer.alert('请输入远程图片的链接');
                return ;
            }
            ajax_req('<?php echo \think\Url::build("remote"); ?>', {'url':remote_input.val()},function (ret) {
                remote_input.val(ret.data.url);
            }, undefined, true);
        }).on('click', '#remote-btn', function () {
            var url = $("#remote-input").val();
            callback(callbackId,url);
        });

        // 已上传图片列表
        // 初始化
        var p = location.hash.replace('#!p=', '') || 1;
        var pages = 0;
        $(".photo-list").on("click", '.photo-list-select', function () {
            callback(callbackId, $(this).parent().prev().attr('data-src'))
        });

        function getListImage(param) {
            $.post('<?php echo \think\Url::build("listImage"); ?>', param, function (ret) {
                if (ret.code) {
                    layer.alert(ret.msg);
                } else {
                    if(typeof ret.data.count != "undefined" && ret.data.count > 0) {
                        pages = Math.ceil(ret.data.count/10);
                    }

                    // 数据组装
                    var html = '';
                    for(var i in ret.data.list) {
                        var current = ret.data.list[i];
                        html += '<div class="photo-list-item">'
                                + '<img src="'+current.name+'" data-src="'+current.name+'" class="photo-sub" alt="'+current.original+'" title="'+current.original+'">'
                                + '<div class="photo-mask">'
                                + '<a class="photo-list-btn photo-list-preview radius" href="'+current.name+'" data-lightbox="preview" data-title="'+current.original+'">预览</a>'
                                + '<a class="photo-list-btn photo-list-select radius ml-10" href="javascript:;">选择</a>'
                                + '</div>'
                                + '</div>';
                    }
                    $(".photo-list").html(html);
                    //显示分页
                    laypage({
                        cont: 'photo-page', //容器。值支持id名、原生dom对象，jquery对象。【如该容器为】：<div id="page1"></div>
                        pages: pages, //通过后台拿到的总页数
                        curr:  param.p, //当前页
                        hash: 'p',
                        jump: function (obj, first) { //触发分页后的回调
                            if (!first) { //点击跳页触发函数自身，并传递当前页：obj.curr
                                getListImage({'p':obj.curr});
                            }
                        }
                    });
                }
            });
        }
    });

    /**
     * 数据回调
     * @param id
     * @param value
     */
    function callback(id,value) {
        if (window.parent.frames.length == 0){
            layer.alert('请在弹层中打开此页');
        } else {
            parent.document.getElementById(id).value = value;
            layer_close();
        }
    }

</script>

</body>
</html>
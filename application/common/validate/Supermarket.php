<?php
namespace app\common\validate;

use think\Validate;

class Supermarket extends Validate
{
    protected $rule = [
        "name|商品名称" => "require",
        "price|商品单价" => "require",
        "content|商品简介" => "require",
        "image|商品图片" => "require",
        "content_img|商品介绍图片" => "require",
        "number|商品数量" => "require",
        "status|商品状态" => "require",
    ];
}

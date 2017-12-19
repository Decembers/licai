<?php
namespace app\common\validate;

use think\Validate;

class Commodity extends Validate
{
    protected $rule = [
        "name|商品名称" => "require",
        "image|商品图片" => "require",
        "price|商品单价" => "require",
        "rate|养殖周期" => "require",
        "content|商品详情" => "require",
        "number|商品数量" => "require",
    ];
}

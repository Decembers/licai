<?php
namespace app\common\validate;

use think\Validate;

class Notice extends Validate
{
    protected $rule = [
        "title|公告标题" => "require",
        "image|公告图片" => "require",
        "content|公告内容" => "require",
    ];
}

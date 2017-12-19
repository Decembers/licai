<?php
namespace app\common\validate;

use think\Validate;

class Barner extends Validate
{
    protected $rule = [
        "img|图片" => "require",
    ];
}

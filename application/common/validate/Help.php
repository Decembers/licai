<?php
namespace app\common\validate;

use think\Validate;

class Help extends Validate
{
    protected $rule = [
        "title|帮助标题" => "require",
        "content|帮助内容" => "require",
    ];
}

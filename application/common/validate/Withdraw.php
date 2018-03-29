<?php
namespace app\common\validate;

use think\Validate;

class Withdraw extends Validate
{
    protected $rule = [
        "money|提现金额" => "require",
        "username|姓名" => "require",
        "mobile|手机号码" => "require",
        "bank_name|银行名称" => "require",
        "bank_card|银行卡号" => "require",
    ];
}

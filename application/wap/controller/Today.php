<?php
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Db;

class Today extends Yang
{

    public $code = 'eWFuZ3lhbmc1NDU0OQ';

    /*
     * @ 每日统计
     */
    public function index()
    {
        echo 'start';
        $data = input('code');
        if ($data == $this->code) {
            $arr['register'] = Db::name("User")->whereTime('create_time', 'today')->count();//今天注册人数
            $arr['order'] = Db::name("Order")->whereTime('create_time', 'today')->count();//今天订单数量
            $arr['sp_count'] = Db::name("Order")->whereTime('create_time', 'today')->sum('sp_count');//今天卖出羊数量
            $arr['consume'] = Db::name("Order")->whereTime('create_time', 'today')->sum('order_price');//今天卖出羊总金额 消费金额
            $arr['pay'] = Db::name("Detail")->where(['or'=>1,'status'=>1])->whereTime('create_time', 'today')->sum('money');//充值金额
            $arr['create_time'] = time();

            $arr['consume'] = $arr['consume']?$arr['consume']:0;
            $arr['pay'] = $arr['pay']?$arr['pay']:0;
            $arr['sp_count'] = $arr['sp_count']?$arr['sp_count']:0;//今天卖出羊数量

            Db::name("Synthesize")->insert($arr);
            echo 'succeed';
        }else{
            echo 'unsuccessful--密钥错误';
        }
    }
}
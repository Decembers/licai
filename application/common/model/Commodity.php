<?php
namespace app\common\model;

use think\Model;

class Commodity extends Model
{
    // 指定表名,不含前缀
    protected $name = 'commodity';
    // 开启自动写入时间戳字段
    //protected $autoWriteTimestamp = 'int';
    //自定义初始化

    public function index($where)
    {
        $obj = new commodity;
        $arr = $obj->where($where)->order('classify')->field('id,com_number,name,price,rate,return_price,number,classify,numbers,deal_time')->select();
        $row=[];
        foreach ($arr as $k => $v) {
            if (time() > $v['deal_time']) {
                $obj -> where(['id'=> $v['id']])->update(['isdelete'=>1]);
            }else{
                $row[$k] = $v;
            }
        }
        return $row;
    }
}

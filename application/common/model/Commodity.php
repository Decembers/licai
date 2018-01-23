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
    use \app\admin\traits\controller\Controller;

    public function index($where)
    {
        $obj = new commodity;
        $arr = $obj
        ->where($where)
        ->order('classify')
        ->field('id,com_number,name,price,rate,return_price,number,classify,numbers,deal_time,down_time')
        ->select();
        $row=[];
        foreach ($arr as $k => $v) {
            if (time() > $v['down_time'] || $v['number']<=0) {
                $obj-> where(['id'=> $v['id']])->update(['isdelete'=>1]);
                $sp_id = $this->allocation($v['classify']);
                if ($sp_id!=0) {
                    $com = $obj->where(['id'=>$sp_id])->find();
                    $row[$k]=$com;
                }
            }else{
                $row[$k] = $v;
            }
        }
        return $row;
    }

    public function orlist($where)
    {
        $obj = new commodity;
        $arr = $obj->where($where)->order('isdelete,preselle_time desc')->field('id,com_number,name,price,rate,return_price,number,classify,numbers,deal_time,isdelete')->select();
        return $arr;
    }
}

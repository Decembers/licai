<?php
namespace app\wap\controller;
use think\Controller;
use app\common\model\Commodity as C;

class Index extends Controller
{
    public function index()
    {
        $where['isdelete'] = 0;
        $where['status'] = 1;
        $arr = C::where($where)->order('classify')->field('id,com_number,name,price,rate,return_price,number,classify')->select();
        //var_dump($arr);die;
        $this->assign('arr',$arr);
        return $this->fetch();
    }

    public function create(){
        //查询最后一个商品
    }

}

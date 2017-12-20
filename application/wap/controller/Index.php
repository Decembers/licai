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
        $cc = new C;
        $row = $cc->index($where);
        $this->assign('row',$row);
        return $this->fetch();
    }

    /*
     *羊群列表
     */
    public function orlist()
    {
        return $this->fetch();
    }

}

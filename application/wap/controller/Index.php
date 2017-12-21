<?php
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Commodity as C;

class Index extends Yang
{
    public function index()
    {
        $where['status'] = 1;
        $where['isdelete'] = 0;
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
        $where['status'] = 1;
        $where['classify'] = 1;
        $cc = new C;
        //常规羊群
        $cgy = $cc->orlist($where);
        $this->assign('cgy',$cgy);
        //辅助羊群
        $where['classify'] = 2;
        $fzy = $cc->orlist($where);
        $this->assign('fzy',$fzy);
        //vip羊群
        $where['classify'] = 3;
        $vipy = $cc->orlist($where);
        $this->assign('vipy',$vipy);

        return $this->fetch();
    }

}

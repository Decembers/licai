<?php
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Commodity as C;
use app\common\model\Notice as N;

class Index extends Yang
{
    use \app\admin\traits\controller\Controller;
    public function index()
    {
        $where['status'] = 1;
        $where['isdelete'] = 0;
        $where['automation'] = 0;
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
        $where['automation'] = 0;
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
    public function introduce()
    {
        return $this->fetch();
    }

    public function zhidao()
    {
        return $this->fetch();
    }
    /*
     *公告
     */
    public function gonggao()
    {
        $notice = N::order('create_time desc')->select();
        $this->assign('notice',$notice);
        return $this->fetch();
    }
    public function gonggaoin()
    {
        $id = input('id');
        $notice = N::where(['id'=>$id])->find();
        $this->assign('notice',$notice);
        return $this->fetch();
    }

    public function baozhang()
    {
        return $this->fetch();
    }
}

<?php
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Commodity as C;
use app\common\model\Activity;

class Discover extends Yang
{
    public function index()
    {
        $activity = Activity::where(['status'=>1])->select();
        $this->assign('activity',$activity);
        return $this->fetch();
    }
    public function info()
    {
        $id = input('id');
        $activity = Activity::where(['id'=>$id])->find();
        $this->assign('activity',$activity);
        return $this->fetch();
    }
}
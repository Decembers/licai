<?php
/**
 * @Author: Marte
 * @Date:   2017-12-27 09:41:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-14 10:56:14
 */
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
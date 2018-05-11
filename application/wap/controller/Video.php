<?php
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Commodity as C;

class Video extends Yang
{
    public function index()
    {
        return $this->fetch();
    }
}
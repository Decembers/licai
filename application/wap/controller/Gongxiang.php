<?php
namespace app\wap\controller;
use app\wap\controller\Yang;
use think\Db;
use think\Session;

//共享农场宣传
class Gongxiang extends Yang
{
    public function index()
    {
            return  $this->fetch();
    }
    public function banner()
    {
            return  $this->fetch();
    }
}
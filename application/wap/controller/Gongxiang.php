<?php
/**
 * @Author: Marte
 * @Date:   2018-04-16 11:18:16
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-16 11:21:27
 */
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
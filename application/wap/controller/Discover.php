<?php
/**
 * @Author: Marte
 * @Date:   2017-12-27 09:41:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-27 11:02:46
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Commodity as C;

class Discover extends Yang
{
    public function index()
    {
        return $this->fetch();
    }
    public function info1()
    {
        return $this->fetch();
    }
    public function info2()
    {
        return $this->fetch();
    }
    public function info3()
    {
        return $this->fetch();
    }
}
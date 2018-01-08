<?php
/**
 * @Author: Marte
 * @Date:   2017-12-27 09:41:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-07 12:41:09
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Commodity as C;

class Supermarket extends Yang
{
    public function index()
    {
        return $this->fetch();
    }
    public function lists()
    {
        return $this->fetch();
    }
    public function info()
    {
        return $this->fetch();
    }
    public function dingdan()
    {
        return $this->fetch();
    }
    public function dingdaninfo()
    {
        return $this->fetch();
    }
    public function gouwuche()
    {
        return $this->fetch();
    }
    public function pay()
    {
        return $this->fetch();
    }
}
<?php
/**
 * @Author: Marte
 * @Date:   2017-12-27 09:41:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-27 10:37:47
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
}
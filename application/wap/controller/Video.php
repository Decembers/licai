<?php
/**
 * @Author: Marte
 * @Date:   2017-12-27 09:41:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-27 09:50:16
 */
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
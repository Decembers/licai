<?php
/**
 * @Author: Marte
 * @Date:   2017-12-27 09:41:47
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-03-29 18:51:06
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Shopping;
use app\common\model\Supermarket as S;
use think\Session;

class Supermarket extends Yang
{
    public function index()
    {
        $supermarket = S::select();
        $shopping['num'] = Shopping::where('user_id',$this->id)->sum('num');
        $shopping['price'] = Shopping::where('user_id',$this->id)->sum('price');
        //var_dump($shopping);die;
        $this->assign('shopping',$shopping);
        $this->assign('supermarket',$supermarket);
        return $this->fetch();
    }
    public function shopping()
    {
        if ($this->request->isAjax()) {
            $data = input();
            $data['user_id'] = $this->id;
            $data['sp_id'] = (int)$data['sp_id'];
            $supermarket = S::where('id',$data['sp_id'])->find();
            $data['sj_id'] = $supermarket['user_id'];
            $shopping = Shopping::where($data)->find();
            $data['price'] = $supermarket['price'];
            if (!empty($shopping)) {
                Shopping::where('id', $shopping['id'])->setInc('num',1);
                Shopping::where('id', $shopping['id'])->setInc('price',$supermarket['price']);
            }else{
                Shopping::insert($data);
            }

        }
    }
    //购物车减
    public function shoppingj()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            $shopping = Shopping::where('id', $id)->find();
            $supermarket = S::where('id', $shopping['sp_id'])->find();

            Shopping::where('id', $id)->setDec('num',1);
            Shopping::where('id', $id)->setDec('price',$supermarket['price']);
        }
    }
    //购物车加
    public function shoppingja()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            $shopping = Shopping::where('id', $id)->find();
            $supermarket = S::where('id', $shopping['sp_id'])->find();

            Shopping::where('id', $id)->setInc('num',1);
            Shopping::where('id', $id)->setInc('price',$supermarket['price']);
        }
    }
    //储存购物信息
    public function shoppingorder()
    {
        if ($this->request->isAjax()) {
            $data = input();
            return json($data);
            var_dump($data);die;
            // $data['user_id'] = $this->id;
            // $data['sp_id'] = (int)$data['sp_id'];
            // $supermarket = S::where('id',$data['sp_id'])->find();
            // $data['sj_id'] = $supermarket['user_id'];
            // $shopping = Shopping::where($data)->find();
            // $data['price'] = $supermarket['price'];
            // if (!empty($shopping)) {
            //     Shopping::where('id', $shopping['id'])->setInc('num',1);
            //     Shopping::where('id', $shopping['id'])->setInc('price',$supermarket['price']);
            // }else{
            //     Shopping::insert($data);
            // }

        }
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
        $is = input('is');
        $this->assign('is',$is);
        return $this->fetch();
    }
    public function dingdaninfo()
    {
        return $this->fetch();
    }
    public function gouwuche()
    {
        $shopping = Shopping::where('user_id',$this->id)->select();
        foreach ($shopping as $key => $value) {
            $supermarket = S::where('id',$value['sp_id'])->find();
            $shopping[$key]['sp_name'] = $supermarket['name'];
            $shopping[$key]['sp_img'] = $supermarket['image'];
            $shopping[$key]['sp_price'] = $supermarket['price'];
        }
        $this->assign('shopping',$shopping);

        return $this->fetch();
    }
    public function pay()
    {
        return $this->fetch();
    }
}
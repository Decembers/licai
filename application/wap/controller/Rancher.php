<?php
/**
 * @Author: Marte
 * @Date:   2017-12-26 18:01:28
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-01-05 10:30:05
 */
namespace app\wap\controller;
use app\wap\controller\Yang;
use app\common\model\Order as O;
use app\common\model\Commodity as C;
use app\common\model\Record as R;
class Rancher extends Yang
{
    public function index()
    {
        $he = 0;//已返还的总利润
        $dlirun = 0;//未返还的利润
        $sp_count = 0;//羊只的总和
        $fulfill = 0;////已完成的羊
        $nofulfill = 0;//未完成羊
        $principal = 0;//已收本金
        $count = 0;//购买期数 产生多少笔订单
        $money = 0;//交易总金额
        $dprincipal = 0;//未完成本金
        $row = O::where(['user_id'=>$this->id])->order('create_time desc')->select();
        foreach ($row as $k => $v) {
            $com = C::where(['id'=>$v['sp_id']])->find();
            $row[$k]['over_time'] = $com['over_time'];
            $row[$k]['begin_time'] = $com['begin_time'];
            $row[$k]['name'] = $com['name'];
            $row[$k]['classify'] = $com['classify'];
            $row[$k]['com_number'] = $com['com_number'];
            $row[$k]['rate'] = $com['rate'];
            $count+=1;
            $sp_count += $v['sp_count'];//羊只的总和
            $money+=$v['order_price'];
            $row[$k]['sky'] = ceil(($com['over_time']-time())/86400);
            if ($v['status']==1) {
                $fulfill += $v['sp_count'];//已完成的羊
                $principal += $v['order_price'];//已收本金
                $he += $v['zexpect'];//查询已返还的总利润
            }else{
                $nofulfill += $v['sp_count'];//未完成的羊
                $dprincipal +=$v['order_price'];
                $yifanh = $v['zexpect'] / $v['nexpect'] * $v['which'];
                $he += $yifanh;//查询已返还的总利润
                $dl = $v['zexpect'] - $yifanh;
                $dlirun += $dl;
            }

        }
        $arr['return_price'] = $he==0 ? 0.00 : $he;
        $arr["dprincipal"] = $dprincipal==0 ? 0.00 : $dprincipal;
        $arr["principal"] = $principal==0 ? 0.00 : $principal;
        $arr["count"] = $count;
        $arr["money"] = $money==0 ? 0.00 : $money;
        $arr["fulfill"] = $fulfill;
        $arr["nofulfill"] = $nofulfill;
        $arr["sp_count"] = $sp_count;
        $arr['dlirun'] = $dlirun==0 ? 0.00 : $he;
        $arr['dshou'] = $dlirun + $dprincipal;//未返还金额

        $this->assign('arr',$arr);
        $this->assign('row',$row);

        return $this->fetch();
    }
}
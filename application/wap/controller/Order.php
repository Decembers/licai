<?php
/**
 * @Author: Marte
 * @Date:   2017-12-12 17:12:51
 * @Last Modified by:   Marte
 * @Last Modified time: 2017-12-19 11:17:37
 */
namespace app\wap\controller;
use think\Controller;
use think\Session;
use app\common\model\Order as O;
use app\common\model\Commodity as C;

class Order extends Controller
{
    use \app\admin\traits\controller\Controller;

    public function info()
    {
        $controller = 'Order';

        if ($this->request->isAjax()) {

            $data = $this->request->post();
            $sp_id = $data['sp_id'];//商品id
            $comm = C::where(['id'=>$sp_id])->find();//查询商品的限购数量
            $restriction = $comm['restrict'];
            $num = $data['number'];//用户购买数量

            if ($num>$restriction) {
                $arr = ['code'=>-200,'data'=>'','msg'=>'购买数量超出'.$restriction.'个限购数'];
                return ajax_return_adv_error($arr);
            };
            //每个用户限购的数量 查询用户购买数量为这个商品id的购买记录
            $sp_count = O::where(['sp_id'=>$sp_id])->sum('sp_count');
            $z_count = $sp_count+$num;
            $y_count = $restriction - $sp_count;
            if ($z_count>$restriction) {
                $arr = ['code'=>-200,'data'=>'','msg'=>'您已购买过'.$sp_count.'个,最多还可购买'.$y_count.'个'];
                return ajax_return_adv_error($arr);
            }

            $pay_pass = md5($data['pay_pass']);
            if (Session::get('user.pay_pass')!=$pay_pass) {
                $arr = ['code'=>-200,'data'=>'','msg'=>'您输入的支付密码不正确'];
                return ajax_return_adv_error($arr);
            }


            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }

            // 写入数据
            if (
                class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
                || class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
            ) {
                //使用模型写入，可以在模型中定义更高级的操作
                $model = new $modelClass();
                $ret = $model->isUpdate(false)->save($data);
            } else {
                // 简单的直接使用db写入
                Db::startTrans();
                try {
                    $model = Db::name($this->parseTable($controller));
                    $ret = $model->insert($data);
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();

                    return ajax_return_adv_error($e->getMessage());
                }
            }

            return ajax_return_adv('添加成功');

        } else {

            $id = input('id');
            $arr = C::where(['id'=>$id])->find();
            // if ($arr['status_time']==4) {
            //     //已完成 用户以往的商品
            // }elseif($arr['status_time']==3){
            //     //准备中 用户以往的商品
            //     if (time()>$arr['deal_time']) {
            //         C::where(['id'=>$id])->save(['status_time'=>4]);
            //     }
            // }elseif($arr['status_time']==2){
            //     if (time()>$arr['deal_time']) {
            //         C::where(['id'=>$id])->save(['status_time'=>4]);
            //     }elseif(time()>$arr['down_time']){
            //         C::where(['id'=>$id])->save(['status_time'=>3]);
            //     }
            // }elseif($arr['status_time']==1){
            //     if (time()>$arr['deal_time']) {
            //         C::where(['id'=>$id])->save(['status_time'=>4]);
            //     }elseif(time()>$arr['down_time']){
            //         C::where(['id'=>$id])->save(['status_time'=>3]);
            //     }elseif(time()>$arr['preselle_time']){
            //         C::where(['id'=>$id])->save(['status_time'=>2]);
            //     }
            // }
            // $arr = C::where(['id'=>$id])->find();
            //var_dump($arr);die;
            $this->assign('arr',$arr);

            if ($arr['classify']==1) {
                //常规羊群
                 if (time() < $arr['preselle_time']) {
                    //预售中 计算还剩多少时间开始购买
                    $time = $arr['preselle_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('cgys');
                 }elseif(time() < $arr['down_time']){
                    //购买 计算还剩多少购买时间
                    $time = $arr['down_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('cggm');
                 }else{
                    return $this->fetch('cgsx');
                 }

            }elseif ($arr['classify']==2){
                //辅助羊群
                 if (time() < $arr['preselle_time']) {
                    //预售中
                    $time = $arr['preselle_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('fzys');
                 }elseif(time() < $arr['down_time']){
                    //购买
                    $time = $arr['down_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('fzgm');
                 }else{
                    return $this->fetch('fzsx');
                 }

            }else{
                //vip羊群
                 if (time() < $arr['preselle_time']) {
                    //预售中
                    $time = $arr['preselle_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('vipys');
                 }elseif(time() < $arr['down_time']){
                    //购买
                    $time = $arr['down_time']-time();
                    $this->assign('time',$time);
                    return $this->fetch('vipgm');
                 }else{
                    return $this->fetch('vipsx');
                 }
            }


        }
    }
}

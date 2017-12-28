<?php
/**
 * tpAdmin [a web admin based ThinkPHP5]
 *
 * @author    yuan1994 <tianpian0805@gmail.com>
 * @link      http://tpadmin.yuan1994.com/
 * @copyright 2016 yuan1994 all rights reserved.
 * @license   http://www.apache.org/licenses/LICENSE-2.0
 */

namespace app\admin\traits\controller;

use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;

trait Controller
{
    /**
     * 首页
     * @return mixed
     */
    public function index()
    {

        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete]);

        // 特殊过滤器，后缀是方法名的
        $actionFilter = 'filter' . $this->request->action();
        if (method_exists($this, $actionFilter)) {
            $this->$actionFilter($map);
        }

        // 自定义过滤器
        if (method_exists($this, 'filter')) {
            $this->filter($map);
        }

        $this->datalist($model, $map);

        return $this->view->fetch();
    }

    /**
     * 回收站
     * @return mixed
     */
    public function recycleBin()
    {
        $this::$isdelete = 1;

        return $this->index();
    }

    /**
     * 添加
     * @return mixed
     */
    public function add()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 插入
            $data = $this->request->except(['id']);

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
            // 添加
            return $this->view->fetch(isset($this->template) ? $this->template : 'edit');
        }
    }

    /**
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            //return json($_POST);
            // 更新
            $data = $this->request->post();
            if (isset($data['content'])) {
                $content = $_POST['content'];
                $data['content'] = $content;
                $data['preselle_time'] = strtotime($data['preselle_time']);
                $data['down_time'] = strtotime($data['down_time']);
                $data['deal_time'] = strtotime($data['deal_time']);
                $data['begin_time'] = $data['deal_time'];
            }
            if (!$data['id']) {
                return ajax_return_adv_error("缺少参数ID");
            }

            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }

            // 更新数据
            if (
                class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $this->parseCamelCase($controller)))
                || class_exists($modelClass = Loader::parseClass(Config::get('app.model_path'), 'model', $controller))
            ) {
                // 使用模型更新，可以在模型中定义更高级的操作
                $model = new $modelClass();
                $ret = $model->isUpdate(true)->save($data, ['id' => $data['id']]);
            } else {
                // 简单的直接使用db更新
                Db::startTrans();
                try {
                    $model = Db::name($this->parseTable($controller));
                    $ret = $model->where('id', $data['id'])->update($data);
                    // 提交事务
                    Db::commit();
                } catch (\Exception $e) {
                    // 回滚事务
                    Db::rollback();

                    return ajax_return_adv_error($e->getMessage());
                }
            }

            return ajax_return_adv("编辑成功");
        } else {
            // 编辑
            $id = $this->request->param('id');
            if (!$id) {
                throw new HttpException(404, "缺少参数ID");
            }
            $vo = $this->getModel($controller)->find($id);
            if (!$vo) {
                throw new HttpException(404, '该记录不存在');
            }

                $this->view->assign("vo", $vo);


            return $this->view->fetch();
        }
    }

    /**
     * 默认删除操作
     */
    public function delete()
    {
        return $this->updateField($this->fieldIsDelete, 1, "移动到回收站成功");
    }

    /**
     * 从回收站恢复
     */
    public function recycle()
    {
        return $this->updateField($this->fieldIsDelete, 0, "恢复成功");
    }

    /**
     * 默认禁用操作
     */
    public function forbid()
    {
        return $this->updateField($this->fieldStatus, 0, "禁用成功");
    }


    /**
     * 默认恢复操作
     */
    public function resume()
    {
        return $this->updateField($this->fieldStatus, 1, "恢复成功");
    }


    /**
     * 永久删除
     */
    public function deleteForever()
    {
        $model = $this->getModel();
        $pk = $model->getPk();
        $ids = $this->request->param($pk);
        $where[$pk] = ["in", $ids];
        if (false === $model->where($where)->delete()) {
            return ajax_return_adv_error($model->getError());
        }

        return ajax_return_adv("删除成功");
    }

    /**
     * 清空回收站
     */
    public function clear()
    {
        $model = $this->getModel();
        $where[$this->fieldIsDelete] = 1;
        if (false === $model->where($where)->delete()) {
            return ajax_return_adv_error($model->getError());
        }

        return ajax_return_adv("清空回收站成功");
    }

    /**
     * 保存排序
     */
    public function saveOrder()
    {
        $param = $this->request->param();
        if (!isset($param['sort'])) {
            return ajax_return_adv_error('缺少参数');
        }

        $model = $this->getModel();
        foreach ($param['sort'] as $id => $sort) {
            $model->where('id', $id)->update(['sort' => $sort]);
        }

        return ajax_return_adv('保存排序成功', '');
    }

    /**
     *更新用户购买的商品利润
     *根据用户id,查询用户订单,根据订单里商品id查询查询商品信息,查询到年化率,本金,利润返还方式,根据订单付款时间,算出是否应该返还利润 返还多少 返还几个月利润
     *更新用户余额和已返还利润
     *生成一条用户金额记录信息
     *用户进入 个人中心,查看余额,付款页面 调用
     *$id 用户id
     */
    protected function money($id)
    {
        $order = new app\common\model\Order;
        $commodity = new app\common\model\Commodity;
        $orders = $order->where(['user_id'=>$id,'sfpay'=>1,'status'=>0])->select();//查询出 已付款,未完成的订单信息
        foreach ($orders as $k => $v) {
            $sp_id = $v['id'];//商品id
            $commoditys = $commodity -> where(['id'=>$sp_id]) -> find();//商品信息
            if (time()>$commoditys['begin_time']) {
                continue;
            }
            $return_mode = $commoditys['return_mode'];

            //判断是否牧民买羊准备时间结束
            // if ($commoditys['status_time']==3) {
            //     //准备中
            //     if (time()>$v['deal_time']) {
            //         $commodity->where(['id'=>$sp_id])->save(['status_time'=>4]);
            //     }
            //     continue;
            // }elseif($commoditys['status_time']==2){
            //     if (time()>$commoditys['deal_time']) {
            //         $commodity->where(['id'=>$sp_id])->save(['status_time'=>4]);
            //     }elseif(time()>$commoditys['down_time']){
            //         $commodity->where(['id'=>$sp_id])->save(['status_time'=>3]);
            //         continue;
            //     }
            // }elseif($commoditys['status_time']==1){
            //     if (time()>$commoditys['deal_time']) {
            //         $commodity->where(['id'=>$sp_id])->save(['status_time'=>4]);
            //     }elseif(time()>$commoditys['down_time']){
            //         $commodity->where(['id'=>$sp_id])->save(['status_time'=>3]);
            //         continue;
            //     }elseif(time()>$commoditys['preselle_time']){
            //         $commodity->where(['id'=>$sp_id])->save(['status_time'=>2]);
            //         continue;
            //     }
            // }

            $record = new app\common\model\Record;
            if ($return_mode==1) {
                    //按月返还
                    $sulite = $record ->where(['order_id'=>$v['id']]) ->select();
                    //是否返还过
                    if (isset($sulite)) {
                        //返过利
                        $records = $record->where(['order_id'=>$v['id']])->max('return_user_time');//最后一次返还利润的时间
                    }else{
                        //没有返过利
                        $records = $commoditys['begin_time'];//当前时间减去最后一次返利时间
                    }
                    $atime = time() - $records;//当前时间减去最后一次返利时间
                    $month = intval($atime/2592000);//获得返还几个月的利润

                    $zprice = intval($commoditys['rate']/30);//总共返还几次利润

                    $yprice = count($sulite); //已返还几次利润

                    $sprice = $zprice-$yprice;//还可以返还几次

                    if ($month>$sprice) {

                        $month = $sprice;

                    }elseif($month<$sprice){

                        //没有返还完
                        for ($i=1; $i < $month; $i++) {
                            //返还利润表数据
                            $row['order_id'] = $v['id'];
                            $row['ruturn_time'] = time();

                            $return_price = $commoditys['return_price']/100;//计算年回报率
                            //计算每期返还金额
                            $return_prices = $v['price'] * $v['number']*$return_price/12;
                            $return_prices = sprintf("%.2f",substr(sprintf("%.3f", $return_prices), 0, -2));//保留两位小数 不四舍五入

                            $row['return_price'] = $return_prices;
                            $row['return_user_time'] = $records+($i*2592000);//用最后一次返利时间 + 现在返利的次数 * 一个月的时间
                            $row['is_principal'] = 2;
                            $yprices = $yprice + $i;
                            $row['remark'] = '第'.$yprices.'次返利';
                            $row['next'] = (int)$yprices;
                        }
                    }

                    //需全部返还 包括本金
                    for ($i=1; $i < $month; $i++) {
                        //返还利润表数据
                        $row['order_id'] = $v['id'];
                        $row['ruturn_time'] = time();
                        $yprices = $yprice + $i;//第多少次返利
                            //计算每期返还金额
                        $return_price = $commoditys['return_price']/100;//计算年回报率
                        $return_prices = $v['price'] * $v['number'] * $return_price/12;
                        $return_prices = sprintf("%.2f",substr(sprintf("%.3f", $return_prices), 0, -2));//保留两位小数 不四舍五入


                        if ($zprice == $yprices) {
                            //最后一次
                            $return_prices = $v['price'] * $v['number'] + $return_prices;
                            $row['return_price'] = $return_prices;
                            $row['is_principal'] = 1;

                            $or = ['status'=>1];
                            //修改order表状态 可能修改不成功
                            $order->where(['order_id'=>$v['id']])->save($or);

                        }else{
                            $row['return_price'] = $return_prices;
                            $row['is_principal'] = 2;
                        }
                        $row['return_user_time'] = $records+($i*2592000);
                        $row['remark'] = '第'.$yprices.'次返利';
                        $row['next'] = (int)$yprices;
                    }

            }else{
                //按期返还
                $rate_time = $commoditys['rate'] * 86400 + $commoditys['begin_time'];//返还的时间
                if (time() >= $rate_time) {
                    //返还全部金额
                    $year = intval($commoditys['rate']/30);
                    $return_price = $commoditys['return_price']/100;//计算年回报率
                    $return_prices = $v['price'] * $v['number'] * $return_price/12 * $year;
                    $return_prices = sprintf("%.2f",substr(sprintf("%.3f", $return_prices), 0, -2));//保留两位小数 不四舍五入

                    $row = [];//返还利润表数据
                    $row['order_id'] = $v['id'];
                    $row['ruturn_time'] = time();
                    $row['return_price'] = $v['price'] * $v['number'] + $return_prices;
                    $row['return_user_time'] = $rate_time;
                    $row['is_principal'] = 1;
                    $row['remark'] = '第1次返利';
                    $row['next'] = 1;

                    $or = ['status'=>1];
                    //修改order表状态 可能修改不成功
                    $order->where(['order_id'=>$v['id']])->save($or);
                }
            }
        }
    }
}

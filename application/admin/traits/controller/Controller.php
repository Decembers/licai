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
use think\Session;
use app\common\model\Order;
use app\common\model\Commodity;
use app\common\model\Record;
use app\common\model\User;

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
            // if (isset($data['content'])) {
            //     $content = $_POST['content'];
            //     $data['content'] = $content;
            //     $data['preselle_time'] = strtotime($data['preselle_time']);
            //     $data['down_time'] = strtotime($data['down_time']);
            //     $data['deal_time'] = strtotime($data['deal_time']);
            //     $data['begin_time'] = $data['deal_time'];
            // }
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
     */
    protected function money($id)
    {
        $order = new Order;
        $commodity = new Commodity;
        $record = new Record;
        $user = new User;
        $testtime = time();//+7776000
        $orders = $order->where(['user_id'=>$id,'sfpay'=>1,'status'=>0])->select();//查询出 已付款,未完成的订单信息
        foreach ($orders as $k => $v) {
            $sp_id = $v['sp_id'];//商品id
            $commoditys = $commodity -> where(['id'=>$sp_id]) -> find();//商品信息
            if ($commoditys['begin_time']>$testtime) {
                continue;
            }
            $return_mode = $commoditys['return_mode'];
            if ($return_mode==1) {
                //按月返还
                $ktime = $commoditys['begin_time'] + $v['which']*2592000;
                $shen = $testtime - $ktime;
                $chi = intval($shen/2592000);//返还的次数
                if ($chi == 0) {
                     //未到返利时间
                     continue;
                }

                $sheng = $v['nexpect'] - $v['which'];//还可以返还几次
                if ($chi>=$sheng) {
                    //包括最后一次返还
                    //需全部返还 包括本金
                    for ($i=1; $i <= $sheng; $i++) {
                        $diji = $v['which'] + $i;
                        $balance = Session::get('user.balance');//余额
                        //返还利润表数据
                        $row['order_id'] = $v['id'];
                        $row['user_id'] = $id;
                        $row['ruturn_time'] = time();
                        $return_price = $commoditys['expect']*$v['sp_count'];//每期利润
                        $row['return_price'] = $return_price;
                        $rate_time = $commoditys['begin_time'] + $diji*2592000;
                        $row['return_user_time'] = $rate_time;
                        $row['is_principal'] = 2;
                        $row['remark'] = $commoditys['name'].'返利完成';
                        $row['next'] = $diji;

                        $balances = $balance + $return_price;
                        $or = [];
                        if ($i==$sheng) {
                            $return_prices = $return_price + $v['order_price'] + $balance;
                            $row['return_price'] = $return_price + $v['order_price'];
                            $balances = $return_prices;

                            $row['is_principal'] = 1;
                            $or['status'] = 1;
                        }

                        $record->insert($row);

                        $or['which'] = $diji;
                        //修改order表状态 可能修改不成功
                        $order->where(['id'=>$v['id']])->update($or);
                        //给用户增加余额
                        $user->where(['id'=>$id])->update(['balance'=>$balances]);
                        Session::set('user.balance',$balances);
                    }

                }else{
                    //不包括最后一次返还
                    for ($i=1; $i <= $chi; $i++) {
                        $diji = $v['which'] + $i;
                        $balance = Session::get('user.balance');//余额
                        //返还利润表数据
                        $row['order_id'] = $v['id'];
                        $row['user_id'] = $id;
                        $row['ruturn_time'] = time();
                        $return_price = $commoditys['expect']*$v['sp_count'];//每期利润
                        $row['return_price'] = $return_price;
                        $rate_time = $commoditys['begin_time'] + $diji*2592000;
                        $row['return_user_time'] = $rate_time;
                        $row['is_principal'] = 2;
                        $row['remark'] = $commoditys['name'].'返利完成';
                        $row['next'] = $diji;
                        $record->insert($row);

                        $or = ['which'=>$diji];
                        //修改order表状态 可能修改不成功
                        $order->where(['id'=>$v['id']])->update($or);
                        //给用户增加余额
                        $balances = $balance + $return_price;
                        $user->where(['id'=>$id])->update(['balance'=>$balances]);
                        Session::set('user.balance',$balances);
                    }
                }
            }else{
                //按期返还
                $rate_time = $commoditys['rate'] * 86400 + $commoditys['begin_time'];//返还的时间
                if ($testtime >= $rate_time) {
                    //返还全部金额
                    $balance = Session::get('user.balance');//余额
                    //返还利润表数据
                    $row['order_id'] = $v['id'];
                    $row['user_id'] = $id;
                    $row['ruturn_time'] = time();
                    $return_price = $v['zexpect'] + $v['order_price'];//每期利润
                    $row['return_price'] = $return_price;
                    $row['return_user_time'] = $rate_time;
                    $row['is_principal'] = 1;
                    $row['remark'] = $commoditys['name'].'返利完成';
                    $row['next'] = 1;
                    $record->insert($row);

                    $or = ['status'=>1,'which'=>1];
                    //修改order表状态 可能修改不成功
                    $order->where(['id'=>$v['id']])->update($or);
                    //给用户增加余额
                    $balances = $balance + $return_price;
                    $user->where(['id'=>$id])->update(['balance'=>$balances]);
                    Session::set('user.balance',$balances);
                }
            }
        }
    }
    /*
     *自动发标 生成一个新标
     *$classify参数 1.常规分类 2.辅助分类 3.vip分类
     *根据参数查询不同分类的模版 生成对应标
     */
    public function allocation($classify)
    {
        date_default_timezone_set('PRC');
        $arr = [];
        $com = Commodity::where(['automation'=>1,'classify'=>$classify])->find();
        if (isset($com)) {
            $time = date('ymd', time());
            $today = strtotime(date("Y-m-d"),time()); //获得当日凌晨的时间戳
            $preselle_time = $today + $com['preselle_time']*3600;
            if ($classify==3) {
                $arr['vip6'] = rand(100000,999999);//vip邀请码
            }
            $zong = 0;
            $qishu = 0;
            $yer = $com['rate']/30;
            if ($com['return_mode'] == 1) {
                $zong = $com['return_price']/100 * $com['price'] / 12;
                $qishu = $yer;
            }else{
                $zong = $com['return_price']/100 * $com['price'] / 12 * $yer;
                $qishu = 1;
            }
            $zong = substr(sprintf("%.3f",$zong),0,-1);//保留两位小数 不四舍五入

            $arr['com_number'] = 'YAN'.date("Ymd").rand(1000,9999);//订单编号

            $arr['name'] = $com['name'].$time;
            $arr['image'] = $com['image'];
            $arr['price'] = $com['price'];
            $arr['rate'] = $com['rate'];
            $arr['content'] = $com['content'];
            $arr['return_price'] = $com['return_price'];
            $arr['return_mode'] = $com['return_mode'];
            $arr['convert'] = $com['convert'];
            $arr['number'] = $com['number'];
            $arr['numbers'] = $com['numbers'];
            $arr['classify'] = $com['classify'];
            $arr['restrict'] = $com['restrict'];

            $arr['update_time'] = time();
            $arr['create_time'] = time();
            $arr['status'] = 1;
            $arr['isdelete'] = 0;
            $arr['preselle_time'] = $preselle_time;//开始购买时间
            $arr['down_time'] = $preselle_time + $com['down_time'];//购买结束时间
            $arr['deal_time'] = $preselle_time + $com['down_time']+$com['deal_time'];//准备结束时间
            $arr['begin_time'] = $arr['deal_time'];//正式开始时间
            $arr['over_time'] = $arr['deal_time']+$com['rate']*86400;//预计结束时间
            $arr['convert_time'] = $arr['over_time'] + $com['convert_time'];//兑换结束时间
            $arr['expect'] = $zong;
            $arr['nexpect'] = $qishu;
            unset($com['id']);
            Commodity::insert($arr);
            $sp_id = Commodity::getLastInsID();
            return $sp_id;
        }
        return 0;
    }

    /*
     * 短信公共方法 根据不同model使用不同的模版
     * mobile 手机号码
     * model 1登录 2注册 3忘记密码修改密码 4修改支付密码 5修改手机号码
     */
    public function message($mobile,$model)
    {
        $cons = '';
        $randStr = str_shuffle('1234567890');
        $rand = substr($randStr,0,6);

        if ($model==1) {
            $cons = "【趣味农场】您正在登录,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==2){
            $cons = "【趣味农场】您正在注册,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==3){
            $cons = "【趣味农场】您正在绑定手机号码,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==4){
            $cons = "【趣味农场】您正在修改支付密码,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==5){
            $cons = "【趣味农场】您正在修改手机号码,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }

        Session::set($mobile,$rand);
        Session::set($rand,time());
        $url='http://117.78.52.216:9003';//系统接口地址
        $conss = iconv('UTF-8', 'gbk', $cons);
        $content=urlencode($conss);
        $username="13613820359";//用户名
        $password="ODIwMzU5";//密码百度BASE64加密后密文
        $url=$url."/servlet/UserServiceAPI?method=sendSMS&extenno=&isLongSms=0&username=".$username."&password=".$password."&smstype=0&mobile=".$mobile."&content=".$content;
        $data = $this->concurl($url);
        return $data;
    }
    /*
     * 发送get请求
     */
    public function concurl($url)
    {
            //初始化curl
            $ch = curl_init($url);
            //设置超时
            curl_setopt($ch, CURLOPT_TIMEOUT,30);
            curl_setopt($ch, CURLOPT_HEADER,FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
            //运行curl，结果以jason形式返回
            $res = curl_exec($ch);
            curl_close($ch);
         //　　//打印获得的数据
             //$data=json_decode($res,true);
             return $res;
    }
}

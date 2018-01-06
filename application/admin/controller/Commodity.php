<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use app\common\model\Order as O;
use app\common\model\User as U;
use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;

class Commodity extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("id")) {
            $map['id'] = ["like", "%" . $this->request->param("id") . "%"];
        }
        if ($this->request->param("name")) {
            $map['name'] = ["like", "%" . $this->request->param("name") . "%"];
        }
    }

    public function info(){
        $sp_id = $this->request->param("id");
        $orders = O::where(['sp_id'=>$sp_id])->select();
        $arr = [];
        foreach ($orders as $k => $v) {
            $user = U::where(['id'=>$v['user_id']])->find();
            $arr[$k]['id'] = $user['id'];
            $arr[$k]['name'] = $user['name'];
            $arr[$k]['number'] = $v['sp_count'];
            $arr[$k]['time'] = $v['create_time'];
        }
        $this ->view->assign('list',$arr);
        return $this ->view-> fetch();
    }

    /**
     *添加 yangyang 自定义
     * @return mixed
     */
    public function comadd()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 插入
            $data = $this->request->except(['id']);
            $zong = $data['return_price']/100 * $data['price'] / 12;
            $zong = substr(sprintf("%.3f",$zong),0,-1);//保留两位小数 不四舍五入
            $time = date('ymd', time());
            $name = $data['name'].$time;

            $data['name'] = $name;
            $content = $_POST['content'];
            $data['content'] = $content;
            $data['com_number'] = 'YAN'.date("Ymd").'1000';//订单编号
            $data['preselle_time'] = strtotime($data['preselle_time']);
            $data['down_time'] = strtotime($data['down_time']);
            $data['deal_time'] = strtotime($data['deal_time']);
            $data['begin_time'] = $data['deal_time'];
            $data['over_time']=$data['begin_time'] + 86400 * $data['rate'];
            $data['convert_time']=$data['over_time'] + 86400 * $data['convert_time'];
            $data['numbers'] = $data['number'];
            $data['expect'] = $zong; //每只羊每期应返还利润

            $yer = $data['rate']/30;
            if ($data['return_mode'] == 1) {
                $data['nexpect'] = $yer;
            }else{
                $data['nexpect'] = 1;//按期返还
                $data['expect'] = substr(sprintf("%.3f",$data['return_price']/100 * $data['price'] / 12 * $yer),0,-1); //按期返还利润
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

             $data['create_time']=time();
             $data['update_time']=time();
             $data['isdelete']=0;

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
            return $this->view->fetch();
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
            // 更新
            $data = $this->request->post();
            $zong = $data['return_price']/100 * $data['price'] / 12;
            $zong = substr(sprintf("%.3f",$zong),0,-1);;//保留两位小数 不四舍五入

            $content = $_POST['content'];
            $data['content'] = $content;
            $data['preselle_time'] = strtotime($data['preselle_time']);
            $data['down_time'] = strtotime($data['down_time']);
            $data['deal_time'] = strtotime($data['deal_time']);
            $data['begin_time'] = $data['deal_time'];
            $data['over_time']= $data['deal_time'] + 86400*$data['rate'];
            $data['convert_time']=$data['over_time'] + 86400 * $data['convert_time'];

            $yer = $data['rate']/30;
            if ($data['return_mode'] == 1) {
                $data['nexpect'] = $yer;
            }else{
                $data['nexpect'] = 1;//按期返还
                $data['expect'] = substr(sprintf("%.3f",$data['return_price']/100 * $data['price'] / 12 * $yer),0,-1); //按期返还利润
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
            $vo['convert_time'] = ($vo['convert_time'] - $vo['over_time'])/86400;
                $this->view->assign("vo", $vo);


            return $this->view->fetch();
        }
    }
}
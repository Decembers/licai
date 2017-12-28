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
            $zong = sprintf("%.2f",substr(sprintf("%.3f", $zong), 0, -2));//保留两位小数 不四舍五入
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
            $data['numbers'] = $data['number'];
            $data['expect'] = $zong; //每只羊每期应返还利润
            if ($data['return_mode'] == 1) {
                $yer = $data['rate']/30;
                $data['nexpect'] = $yer;
            }else{
                $data['nexpect'] = 1;//按期返还
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

}
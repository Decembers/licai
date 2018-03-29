<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;
use think\Session;

class Supermarket extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("name")) {
            $map['name'] = ["like", "%" . $this->request->param("name") . "%"];
        }
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
            $data['user_id'] = Session::get('auth_id');
            $data['numbers'] = $data['number'];
            $data['create_time'] = time();
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
     * 首页
     * @return mixed
     */
    public function index()
    {

        $model = $this->getModel();

        if (Session::get('auth_id')==1) {
            // 列表过滤器，生成查询Map对象
            $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete]);
        }else{
            // 列表过滤器，生成查询Map对象
            $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete,'user_id'=>Session::get('auth_id')]);
        }

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
        if (Session::get('auth_id')==1) {
            return $this->view->fetch();
        }else{
            return $this->view->fetch("supermarket_index");
        }
    }

    /**
     * 首页
     * @return mixed
     */
    public function index_one()
    {
        $id = input('id');
        $model = $this->getModel();

        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete,'id'=>$id]);

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

}

<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;
use think\Session;
class SupermarketOrder extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected static $isdelete = false;

    protected function filter(&$map)
    {
        if ($this->request->param("number")) {
            $map['number'] = ["like", "%" . $this->request->param("number") . "%"];
        }
    }

    /**
     * 首页
     * @return mixed
     */
    public function index()
    {

        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        if (Session::get('auth_id')==1) {
            // 列表过滤器，生成查询Map对象
            $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete]);
        }else{
            // 列表过滤器，生成查询Map对象
            $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete,'sj_id'=>Session::get('auth_id')]);
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

        return $this->view->fetch();
    }

    /**
     * 首页
     * @return mixed
     */
    public function index_info()
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

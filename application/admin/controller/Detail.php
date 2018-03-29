<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;
use app\common\model\User;
use app\common\model\Detail AS D;

class Detail extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected function filter(&$map)
    {
        if ($this->request->param("user_id")) {
            $map['user_id'] = ["like", "%" . $this->request->param("user_id") . "%"];
        }
        if ($this->request->param("name")) {
            $map['name'] = ["like", "%" . $this->request->param("name") . "%"];
        }
        if ($this->request->param("or")) {
            $map['or'] = ["like", "%" . $this->request->param("or") . "%"];
        }
    }
    /**
     * 充值详情
     * @return mixed
     */
    public function recharge()
    {

        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete,'or'=>1]);

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
     * 购买详情
     * @return mixed
     */
    public function purchase()
    {

        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete,'or'=>3]);

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
     * 提现详情
     * @return mixed
     */
    public function withdraw()
    {

        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete,'or'=>2]);

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
     * 提现管理
     * @return mixed
     */
    public function adminwithdraw()
    {

        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete,'or'=>2]);

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
     * 编辑
     * @return mixed
     */
    public function edit()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 更新
            $data = $this->request->post();

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

            $withdraw = "";
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
            if ($data['status'] == 2) {
                $withdraw = $model->where('id', $data['id'])->find();
                $money = $withdraw['money'] + $withdraw['charge'];
                User::where(['id'=>$withdraw['user_id']])->setInc('balance',$money);
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

}

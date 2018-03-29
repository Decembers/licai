<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;
use think\Session;
use app\common\model\AdminUser;

class Withdraw extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected static $isdelete = false;

    /**
     * 首页
     * @return mixed
     */
    public function record()
    {

        $model = $this->getModel();

        // 列表过滤器，生成查询Map对象
        $map = $this->search($model, [$this->fieldIsDelete => $this::$isdelete,'user_id'=>Session::get('auth_id')]);

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
     * 添加
     * @return mixed
     */
    public function add()
    {
        $controller = $this->request->controller();

        if ($this->request->isAjax()) {
            // 插入
            $data = $this->request->except(['id']);
            if ($data['money'] < 100) {
                $arr = ['code'=>1,'data'=>'','msg'=>'提现金额至少100元!'];
                return json($arr);
            }
            $data['user_id'] = Session::get('auth_id');
            $data['create_time'] = time();

            // 验证
            if (class_exists($validateClass = Loader::parseClass(Config::get('app.validate_path'), 'validate', $controller))) {
                $validate = new $validateClass();
                if (!$validate->check($data)) {
                    return ajax_return_adv_error($validate->getError());
                }
            }

            // 写入数据
            Db::startTrans();
            try{
                $rate = 2;
                $money = substr(sprintf("%.3f",$data['money']*($rate/100)),0,-1);
                $data['charge'] = $money;
                $adminuser = Db::table('tp_admin_user')->where('id',Session::get('auth_id'))->find();
                $money = $data['money']+$money;
                if ($money > $adminuser['money']) {
                    $arr = ['code'=>1,'data'=>'','msg'=>'提现金额超出可提现金额'];
                    return json($arr);
                }
                Db::table('tp_admin_user')->where('id',Session::get('auth_id'))->setDec('money',$money);
                //使用模型写入，可以在模型中定义更高级的操作
                $model = Db::name($this->parseTable($controller));
                $ret = $model->insert($data);

                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
                return ajax_return_adv_error($e->getMessage());
            }

            return ajax_return_adv('添加成功');
        } else {
            // 添加
            return $this->view->fetch(isset($this->template) ? $this->template : 'add');
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

            if ($data['status'] == 2) {
                $withdraw = $model->where('id', $data['id'])->find();
                $money = $withdraw['money'] + $withdraw['charge'];
                AdminUser::where(['id'=>$withdraw['user_id']])->setInc('money',$money);
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

    public function test()
    {
        var_dump(Session::get());
    }

}

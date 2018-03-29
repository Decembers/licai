<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Db;
use think\Loader;
use think\exception\HttpException;
use think\Config;
class Order extends Controller
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
    public function info()
    {
        $id = input('id');
        $user = Db::table('tp_user')->where('id',$id)->select();
        $detail = Db::table('tp_detail')->where('user_id',$id)->order('id desc')->select();
        $this->view->assign('user',$user);
        $this->view->assign('detail',$detail);

        return $this->view->fetch();
    }
}
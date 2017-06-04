<?php
namespace app\admin\controller;

use think\Controller;
use think\Model;

class AdminAuth extends Controller
{
    public function _initialize()
    {
        $request = request();
        $not_check = array('admin/login', 'admin/logout', 'admin/login_action');
        if (in_array($request->module() . '/' . $request->action(), $not_check) || $request->module() != 'admin') {
            return true;
        }

        if (!session('uid')) {
            $this->error('没有登录，请先登录网页', '/admin/login');
        }
    }

}
<?php
namespace app\admin\controller;
use app\admin\model\User;
use think\Controller;

class IndexController extends AdminAuth{

    public function login()
    {
        $this->view->engine->layout(false);
        return view();
    }

    public function index()
    {
        return $this->fetch();

    }
    public function login_action(){
        $check_array = input('post.');
        $check_array['pwd'] = md5($check_array['pwd']);
        $user = new User;
        if($user =  $user->where($check_array)->find()){
            session('uid',$user->id);
            session('username',$user->username);
            session('pwd',$user->pwd);
            return $this->success('登陆成功','/admin');
        }else{
            $this->error('账号或密码错误','/admin/login');
        }
    }

    public function logout(){
        session(null);
        return $this->success('成功登出','/admin/login');
    }
}
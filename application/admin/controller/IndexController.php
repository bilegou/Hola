<?php
namespace app\admin\controller;
use app\admin\model\User;
use think\Controller;

class IndexController extends AdminAuth{
    public function login_action(){
        $check_array = ('username'== input('post.username')&& 'pwd'==input('post.pwd'));

        $user = new User;
        if($user->where($check_array)->find()){
            session('uid',$user->id);
            session('username',$user->username);
            session('pwd',$user->pwd);
            return $this->success('登陆成功','/admin');
        }else{
            $this->error('账号或密码错误','');
        }
    }

    public function logout(){
        session(null);
        return $this->success('成功登出','/admin/logout');
    }
}
<?php
namespace app\admin\controller;

use app\admin\model\User;
use think\Image;
use think\Request;
use think\Validate;

class AdministratorController extends AdminAuth
{
    private $data = array(
        'module_name' => '管理员',
        'module_url'  => '/admin/administrator/',
        'module_slug' => 'administrator',
        'upload_path' => UPLOAD_PATH,
        'upload_url'  => '/public/uploads/',
    );

    //显示主页、新增用户
    public function index()
    {
        $user = new User();
        $list = $user->where('status', '>=', 0)->order('id', 'ASC')->paginate();
        $this->assign('data', $this->data);
        $this->assign('list', $list);

        $this->data['edit_field'] = [
            'username' => array('type' => 'text', 'label' => '用户名'),
            'nickname' => array('type' => 'text', 'label' => '昵称'),
            'pwd' => array('type' => 'password', 'label' => '密码', 'notes' => '更新管理员资料默认不填写则不修改密码','create'=>''),
            'avatar' => array('type' => 'file', 'label' => '管理员头像','id'=>''),
            'status' => array('type' => 'radio', 'label' => '状态', 'default' => array(-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'),'create'=>''),
        ];
        //默认值设置
        $item['status'] = '正常';//定义默认status状态
        $this->assign('item', $item);
        $this->assign('data', $this->data);
        $this->assign('list',$list);
        return $this->fetch();

    }

    //新增用户方法
    public function add()
    {
        $data = input('post.');
        $user = new User();
        $rule = [
            'username|用户名' => 'require|min:5|unique:user',//unique属性需要表名
            'pwd'=>'require|min:5',
            'nickname'=>'require|min:2',
        ];
        $validate = new Validate($rule);
        $result =  $validate->check($data);
        if(!$result){
           return $validate->getError();
        }

            $data['avatar'] = $this->upload();
            if(!$data['avatar']){
                unset($data['avatar']);
            }
            $data['pwd'] = md5($data['pwd']);
            $user->save($data);
            return $this->success('注册成功');

    }

    //读取管理员信息
    public function read($id=''){

        $user = new User();
        $this->data['edit_field'] = [
            'username' => array('type' => 'text', 'label' => '用户名'),
            'nickname' => array('type' => 'text', 'label' => '昵称'),
            'pwd' => array('type' => 'password', 'label' => '密码', 'notes' => '更新管理员资料默认不填写则不修改密码'),
            'avatar' => array('type' => 'file', 'label' => '管理员头像','id'=>''),
            'status' => array('type' => 'radio', 'label' => '状态', 'default' => array(-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'),'create'=>''),
        ];
        //默认值设置
        $item = $user->get($id);
        $item['status'] = '正常';//定义默认status状态
        $this->assign('item', $item);
        $this->assign('data', $this->data);
        return $this->fetch();
    }

    //修改管理员信息方法
    public function update($id){
        $user  = new User();
        $data = input('post.');
        $rule = [
            'username|用户名' => 'require|alphaDash|min:5|unique:user,username,'.$id.',id',  //排除主键值id
            'nickname'=>'require|min:2',
        ];

        $validate = new Validate($rule);

        $result =  $validate->check($data);
        if(!$result){
            return  $validate->getError();
        }

        $data['avatar'] = $this->upload();
        if(!$data['avatar']){
            unset($data['avatar']);
        }
        if(!$data['pwd']==''){
            $data['pwd'] = md5($data['pwd']);
        }else{
            unset($data['pwd']);
        }

        $data['id'] = $id;
        if($user->update($data)){
            return $this->success('修改成功','/admin/administrator');
        }else{
            return $this->error();
        }
    }
    //图片上传和保存
    public function upload(){
        $file = request()->file('avatar');
        if($file){
            $info = $file->rule('uniqid')->move(ROOT_PATH.'public'.DS.'images');
            if(true !== $this->validate(['avatar'=>$file],['avatar'=>'image'])) {
                return $this->error();
            }else {
                $image = Image::open($file);
                $image_type = request()->param('type') ? request()->param('type') : 1;
                switch ($image_type) {
                    case 1:
                        $image->thumb(150, 150, Image::THUMB_CENTER);
                        break;
                }
                $fileName = explode('.', $info->getFilename());
                $saveName = $fileName[0] . '_thumb.' . $info->getExtension();
                $image->save($this->data['upload_path'] . '/' . $saveName);
                $this->changeThumbName = $saveName;
                return $this->changeThumbName;
            }
        }else{
            return false;
        }
    }

    //删除给管理员
    public function delete($id){
       $user = User::get($id);
        $data['id'] = $id;
        if ($user) {
            $user->delete();
        }
        return $data;
    }

}
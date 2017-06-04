<?php
namespace app\admin\controller;

use app\admin\model\User;
use think\Image;
use think\Request;

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
        $info = $user->where('status','>=',0)->select();
        $this->assign('data', $this->data);
        $this->assign('list', $list);
        $this->assign('info',$info);

        $this->data['edit_field'] = [
            'username' => array('type' => 'text', 'label' => '用户名'),
            'nickname' => array('type' => 'text', 'label' => '昵称'),
            'pwd' => array('type' => 'password', 'label' => '密码', 'notes' => '更新管理员资料默认不填写则不修改密码','create'=>''),
            'avatar' => array('type' => 'file', 'label' => '头像','id'=>''),
            'status' => array('type' => 'radio', 'label' => '状态', 'default' => array(-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'),'create'=>''),
        ];
        //默认值设置
        $item['status'] = '正常';//定义默认status状态
        $this->assign('item', $item);
        $this->assign('data', $this->data);
        return $this->fetch();

    }

    //新增用户方法
    public function add()
    {
        $data = input('post.');
        $user = new User();
        var_dump($data);
        if($user->where('username','=',$data['username'])->find())
        {
           return $this->error('用户名已存在');
        } else{
            $data['avatar'] = $this->upload();
            if(!$data['avatar']){
                unset($data['avatar']);
            }
            $data['pwd'] = md5($data['pwd']);
            $user->save($data);
            return $this->success('注册成功');
        }
    }

    //读取管理员信息
    public function read($id=''){

        $user = new User();
        $this->data['edit_field'] = [
            'username' => array('type' => 'text', 'label' => '用户名'),
            'nickname' => array('type' => 'text', 'label' => '昵称'),
            'pwd' => array('type' => 'password', 'label' => '密码', 'notes' => '更新管理员资料默认不填写则不修改密码','create'=>''),
            'avatar' => array('type' => 'file', 'label' => '头像','id'=>''),
            'status' => array('type' => 'radio', 'label' => '状态', 'default' => array(-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核'),'create'=>''),
        ];
        //默认值设置
        $item = $user->get($id);
        $item['status'] = '正常';//定义默认status状态
        // echo json_encode($item);
        $this->assign('item', $item);
        $this->assign('data', $this->data);
        return $this->fetch();
    }

    //修改管理员信息方法
    public function update($id){
        $user  = new User();
        $data = input('post.');
        $data['avatar'] = $this->upload();
        if(!$data['avatar']){
            unset($data['avatar']);
        }
        $data['pwd'] = md5($data['pwd']);
        $data['id'] = $id;
        if($user->update($data)){
            return $this->success('修改成功','/admin/administrator');
        }else{
            return $this->error();
        }
    }

    public function upload(){
        $file = request()->file('avatar');//获取input中的文件
        var_dump($file);
        if($file){
            //验证文件的名称和类型.
                $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' .DS. 'images');//把传进来的图片移动到public/images
                $image = Image::open($file);//读取图片作为把$image作为句柄
                $image_type = request()->param('type') ? request()->param('type') : 1;
                switch($image_type){
                    case 1:
                        $image->thumb(150,150,Image::THUMB_CENTER);
                        break;
                    case 2:
                        $image->crop(300,300);
                        break;
                    case 3:
                        $image->flip();
                        break;
                    case 4:
                        $image->flip(Image::FLIP_Y);
                        break;
                    case 5:
                        $image->rotate();
                        break;
                    case 6:
                        $image->water(ROOT_PATH.'public/static/images/logo.png',Image::WATER_NORTHWEST,50);
                        break;
                    case 7:
                        $image->text('Sen',VENDOR_PATH.'topthink/think-captcha/assets/ttfs/1.ttf',20,'#ffffff');
                        break;
                }
                $this->sourceFile = $info->getFilename();

                $fileName = explode('.',$info->getFilename());
                $saveName = $fileName[0].'_thumb.'.$info->getExtension();
                $image->save($this->data['upload_path'].'/'.$saveName);
                $this->imageThumbName = $saveName;
                return $this->imageThumbName;
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
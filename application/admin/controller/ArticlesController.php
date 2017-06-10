<?php
namespace app\admin\controller;
use app\admin\model\Article;
use app\admin\model\User;
use think\Image;
use think\Validate;

class ArticlesController extends AdminAuth{

    private $data = [
        'module_url' => '/admin/articles/',
        'upload_path'=>UPLOAD_PATH,

    ];


    public function index(){
        $article = new Article();
        $list = $article->where('status','>=',0)->order('id','ASC')->paginate();
        $this->assign('list',$list);
        $this->assign('data',$this->data);
        return $this->fetch();
    }

    public function create(){
        $user = new User();
        $admin =  $user->where('status',1)->column('nickname','id');

        $this->data['edit_field'] = [
            'title'=>['type'=>'text','label'=>'文章标题'],
            'content'=>['type'=>'textarea','label'=>'文章内容'],
            'author'=>['type'=>'select','label'=>'作者','default'=>$admin],
            'image'=>['type'=>'file','label'=>'图片'],
            'status'=>['type'=>'radio','label'=>'发布状态','default'=>[-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核']],
        ];
        $item['status'] = '正常';
        $this->assign(['data'=>$this->data,'item'=>$item]);
        return $this->fetch();
    }

    public function add(){
        $articles = new Article();
        $data = input('post.');

        $rule = [
            'title' => 'require|min:5',
            'content' => 'require',
            'author' => 'require',
        ];
        $validate = new Validate($rule);
        $result = $validate->check($data);
        if (!$result) {
           return $validate->getError();
        }

        $data['image'] = $this->upload();
        if(!$data['image']){
            unset($data['image']);
        }
        if ($articles->save($data)) {
            return $this->success('新增文章成功', '/admin/articles');
        } else {
            return $this->error('文章添加失败');
        }
    }

    public function read($id){
        $user = new User();
        $articles = new Article();
        $admin =  $user->where('status',1)->column('nickname','id');

        $this->data['edit_field'] = [
            'title'=>['type'=>'text','label'=>'文章标题'],
            'author'=>['type'=>'select','label'=>'作者','default'=>$admin],
            'content'=>['type'=>'textarea','label'=>'文章内容'],
            'image'=>['type'=>'file','label'=>'图片'],
            'status'=>['type'=>'radio','label'=>'发布状态','default'=>[-1 => '删除', 0 => '禁用', 1 => '正常', 2 => '待审核']],
        ];
        $item = $articles->get($id);
        $item['status'] = '正常';
        $this->assign('item',$item);
        $this->assign('data',$this->data);
        return $this->fetch();

    }
    public function update($id){
        $articles = new Article();
        $data = input('post.');
        $data['id'] = $id;

        $rule = [
            'title'=>'require',
            'content' => 'require',
            'author' => 'require',
        ];

        $validate = new Validate($rule);
        $result = $validate->check($data);
        if(!$result){
           return $validate->getError();
        }
        $data['image'] = $this->upload();
        if(!$data['image']){
            unset($data['image']);
        }

        if($articles->update($data)){
            return  $this->success('修改文章内容成功','/admin/articles');
        }else{
            return $this->error('修改文章失败');
        }
    }

    public function upload(){
        $file = request()->file('image');
        if($file){
            $info = $file->rule('uniqid')->move(ROOT_PATH.'public'.DS.'images');
            if(true !== $this->validate(['image'=>$file],['image'=>'image'])) {
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

    public function delete($id){
        $article =  Article::get($id);
        $data['id'] = $id;
        if($article){
            $article->delete($id);
        }
        return $data;
    }
}
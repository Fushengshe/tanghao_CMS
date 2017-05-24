<?php
namespace app\admin\controller;
use think\Controller;

class Article extends Controller
{
    public function lst()
    {
        return $this->fetch();
    }
    public function add()
    {
        if(request()->isPost()){
            $data=[
                'title'=>input('title'),
                'keywords'=>input('keywords'),
                'lmdesc'=>input('lmdesc'),
                'content'=>input('content'),
                'time'=>time()
            ];

            if($_FILES['pic']['tmp_name']){
                echo 11111;die;
            }else{
                echo 2222;die;
            }
            $validate = \think\Loader::validate('article');
            if ($validate->check($data)) {
                $db = \think\Db::name('article')->insert($data);
                if ($db) {
                    return $this->success('添加文章成功!', 'lst');
                } else {
                    return $this->error('添加文章失败!');
                }
            } else {
                return $this->error($validate->getError());
            }

            return;
        }
        return $this->fetch();
    }

}
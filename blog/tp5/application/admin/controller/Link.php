<?php
namespace app\admin\controller;
use think\Controller;

class Link extends Controller
{
    public function lst()
    {
        $links = \think\Db::name('link')->paginate(3);
        $this->assign('links', $links);
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'title' => input('title'),
                'url' => input('url'),
                'lmdesc' => input('lmdesc'),
            ];
            $validate = \think\Loader::validate('Link');
            if ($validate->check($data)) {
                $db = \think\Db::name('link')->insert($data);
                if ($db) {
                    return $this->success('添加链接成功!', 'lst');
                } else {
                    return $this->error('添加链接失败!');
                }
            } else {
                return $this->error($validate->getError());
            }
            return;
        }
        return $this->fetch();
    }
    public function edit(){
        if(request()->isPost()){
            $data=[
                'id'=>input('id'),
                'title'=>input('title'),
                'url'=>input('url'),
                'lmdesc'=>input('lmdesc'),
            ];
            $validate = \think\Loader::validate('Link');
            if($validate->scene('edit')->check($data)){
                if ($db = \think\Db::name('link')->update($data)){
                    return $this->success('修改链接成功','lst');
                }else{
                    return $this->error('修改链接失败！');
                }
            }else {
                return $this->error($validate->getError());
            }
            return;
        }
        $id = input('id');
        $links = db('link')->where('id',$id)->find();
        $this->assign('links',$links);
        return $this -> fetch();
    }
    public function del(){
        $id = input('id');
        if(db('link')->delete($id)){
            return $this->success('删除链接成功！','lst');
        }else{
            return $this->error('删除链接失败！');
        }
    }
}

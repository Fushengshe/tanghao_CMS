<?php
namespace app\admin\controller;
use think\Controller;

class Article extends Controller
{
    public function lst()
    {
        $artres = \think\Db::name('article')->alias('a')->join('cate c','a.cateid= c.id','LEFT')->field('a.id,a.title,a.pic,a.click,a.time,c.catename
        ')->paginate(3);
        $this -> assign('artres',$artres);
        return $this->fetch();
    }
    public function add()
    {
        if(request()->isPost()){
            $data=[
                'title'=>input('title'),
                'keywords'=>input('keywords'),
                'lmdesc'=>input('lmdesc'),
                'cateid'=>input('cateid'),
                'content'=>input('content'),
                'time'=>time()
            ];
            if ($_FILES['pic']['tmp_name']) {
                // 获取表单上传文件
                $file = request()->file('pic');
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads/');
                if ($info) {
                    $data['pic'] = '/static/uploads/'.date('ymd').'/'.$info->getFilename();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
//                    echo $info->getFilename();
                } else {
                    // 上传失败获取错误信息
//                    echo $file->getError();
                    return $this->error($file->getError());
                }
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
        $cateres = db('cate')->select();
        $this->assign('cateres',$cateres);
        return $this->fetch();
    }
    public function edit()
    {
        if (request()->isPost()) {
            $data = [
                'id' => input('id'),
                'title' => input('title'),
                'keywords' => input('keywords'),
                'lmdesc' => input('lmdesc'),
                'cateid' => input('cateid'),
                'content' => input('content'),
            ];
            if ($_FILES['pic']['tmp_name']) {
                // 获取表单上传文件
                $file = request()->file('pic');
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads/');
                if ($info) {
                    $data['pic'] = '/static/uploads/' . date('ymd') . '/' . $info->getFilename();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
//                    echo $info->getFilename();
                } else {
                    // 上传失败获取错误信息
//                    echo $file->getError();
                    return $this->error($file->getError());
                }
            }
            $validate = \think\Loader::validate('article');
            if ($validate->check($data)) {
                $db = \think\Db::name('article')->update($data);
                if ($db) {
                    return $this->success('修改文章成功!', 'lst');
                } else {
                    return $this->error('修改文章失败!未改变内容！');
                }
            } else {
                return $this->error($validate->getError());
            }
            return;
        }
        $arts = \think\Db::name('article')->where('id',input('id'))->find();
        $cateres = db('cate')->select();
        $this->assign('cateres', $cateres);
        $this->assign('arts', $arts);
        return $this->fetch();
    }

    public function del(){
        $id = input('id');
        if(db('article')->delete($id)){
            return $this->success('删除文章成功！','lst');
        }else{
            return $this->error('删除文章失败！');
        }


    }
}
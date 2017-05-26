<?php
namespace app\admin\model;
use think\Controller;

class Article extends Controller
{
    public function lst()
    {
        return $this->fetch();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = [
                'title' => input('title'),
                'keywords' => input('keywords'),
                'lmdesc' => input('lmdesc'),
                'content' => input('content'),
                'time' => time()
            ];
            if ($_FILES['pic']['tmp_name']) {
                // 获取表单上传文件
                $file = request()->file('pic');
                // 移动到框架应用根目录/public/uploads/ 目录下
                $info = $file->move(ROOT_PATH . 'public' . DS . '/static/uploads');
                if ($info) {
                    $data['pic'] = '/static/uploads'.date('ymd').'/'.$info->getFilename();
                    // 输出 42a79759f284b767dfcb2a0197904287.jpg
                    echo $info->getFilename();
                } else {
                    // 上传失败获取错误信息
//                    echo $file->getError();
                    return $this->error($file->getError());
                }
            }
            $validate = \think\Loader::validate('Article');
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
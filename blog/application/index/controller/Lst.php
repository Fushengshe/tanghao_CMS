<?php
namespace app\index\controller;
class Lst extends Base
{
    public function index()
    {
        $cates = \think\Db::name('cate')->field('catename')->find(input('cateid'));
        $catename = $cates['catename'];

        $artres = \think\Db::name('article')->order('id desc')->where('cateid','=',input('cateid'))->paginate(2);
        $this->assign('artres',$artres);
        $this->assign('catename',$catename);
        return $this->fetch('Lst');
    }
}

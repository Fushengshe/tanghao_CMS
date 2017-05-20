<?php
namespace app\admin\controller;
use think\Controller;
class Cate extends Controller
{
    public function lst()
    {
        return $this -> fetch();
    }
}

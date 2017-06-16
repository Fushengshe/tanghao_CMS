<?php
namespace app\admin\controller;

class Index extends Base
{
    public function index()
    {
//        echo \think\Session::get('id');
        return $this -> fetch('index');
    }
}

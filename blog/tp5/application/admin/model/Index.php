<?php
namespace app\admin\model;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return $this -> fetch('index');
    }
}

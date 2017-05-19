<?php
namespace app\index\controller;
use think\Controller;
class Lst extends Controller
{
    public function index()
    {
        return $this->fetch('Lst');
    }
}

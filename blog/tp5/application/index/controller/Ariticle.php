<?php

namespace app\index\controller;
use think\Controller;
class Ariticle extends Controller
{
    public function index()
    {
        return $this -> fetch('ariticle');
    }

}
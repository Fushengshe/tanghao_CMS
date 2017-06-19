<?php
namespace app\admin\controller;
use think\Controller;
class Test extends Controller
{
    public function index()
    {
        $user = \think\Db::query('select * from mk_user where id=?',[17]);
//        echo $user[0]['username'];
        print_r($user);
    }
}

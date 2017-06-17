<?php
namespace app\admin\model;
use think\Model;

class Loginup extends Model{
    public function loginup($username,$password){
        $admin  = \think\Db::name('user')->where('username','=',$username)->find();
        if($admin){
            return 4;
        }elseif($username == ''){
            return 3;
        }elseif($password == ''){
            return 2;
        }else{
            return 1;
        }
    }

}

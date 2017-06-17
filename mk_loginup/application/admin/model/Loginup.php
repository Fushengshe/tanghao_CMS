<?php
namespace app\admin\model;
use think\Model;

class Loginup extends Model{
    public function loginup($username,$password,$mobile){
        $admin  = \think\Db::name('user')->where('username','=',$username)->find();
        if($admin){
            return 5;
        }elseif($username == ''){
            return 4;
        }elseif($password == ''){
            return 3;
        }elseif($mobile == ''){
            return 2;
        }elseif(is_int($mobile)){
            return 22;
        }else{
            return 1;
        }
    }

}

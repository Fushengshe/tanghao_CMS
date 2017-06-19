<?php
namespace app\admin\model;
use think\Model;

class Loginup extends Model{
    public function loginup($username,$password,$mobile,$confirm){
        $admin  = \think\Db::name('user')->where('username','=',$username)->find();
        if($admin){
            return 5;
        }elseif($username == ''){
            return 4;
        }elseif($mobile == ''){
            return 2;
        }elseif(!ctype_digit($mobile)){
            return 22;
        }elseif($password == ''){
            return 3;
        }elseif(!($password === $confirm)){
            return 33;
        }else{
            return 1;
        }
    }

}

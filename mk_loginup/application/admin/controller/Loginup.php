<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Loginup as Log;
class Loginup extends Controller
{
    public function index()
    {
//        $links = \think\Db::name('link')->paginate(3);
//        $this->assign('links', $links);
            $loginup = new Log;
            $username = input('username');
            $password = input('password');
            $mobile = input('mobile');
            $confirm = input('confirm');
            $status = $loginup->loginup($username,$password,$mobile,$confirm);
            if($status == 1){
                $intermediateSalt = uniqid(rand(), true);
                $salt = substr($intermediateSalt, 0, 4);
                $password = sha1(md5($password.$salt));

                $data = [
                    'username' => $username,
                    'password' => $password,
                    'mobile' => $mobile,
                    'usergroup' => 1,
                    'created_at' => date("Y-m-d"),
                    'updated_at' => date("Y-m-d"),
                    'salt' => $salt,
                ];
                \think\Db::table('mk_user')->insert($data);
                return json(['status' => '1','msg' => '注册成功！']);
            }elseif($status == 5){
                return json(['status' => '5','msg' => '注册失败，用户名已存在！']);
            }elseif($status == 4){
                return json(['status' => '4','msg' => '注册失败，用户名不能为空！']);
            }elseif($status ==2){
                return json(['status' => '2','msg' => '注册失败，手机号不能为空！']);
            }elseif($status ==22){
                return json(['status' => '22','msg' => '注册失败，手机号必须为数字！']);
            }elseif($status ==3){
                return json(['status' => '3','msg' => '注册失败，密码不能为空！']);
            }elseif($status ==33){
                return json(['status' => '33','msg' => '注册失败，密码不一致！！']);
            }
 
    }
}

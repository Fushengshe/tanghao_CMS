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
        if(request()->isPost()){
            $login = new Log;
            $username = input('username');
            $password = input('password');
            $status = $login->loginup($username,$password);

            if($status == 1){
                $intermediateSalt = uniqid(rand(), true);
                $salt = substr($intermediateSalt, 0, 4);
                $password = sha1(md5($password.$salt));

                $data = [
                    'username' => $username,
                    'password' => $password,
                    'usergroup' => 1,
                    'token' => '',
                    'token_exp' => 3600,
                    'created_at' => date("Y-m-d"),
                    'updated_at' => date("Y-m-d"),
                    'salt' => $salt,
                ];
                \think\Db::table('mk_user')->insert($data);
                return $this->success('注册成功！');
            }elseif($status == 4){
                return $this->error('注册失败，用户名已存在！');
            }elseif($status == 3){
                return $this->error('注册失败，用户名不能为空！');
            }elseif($status == 2){
                return $this->error('注册失败，密码不能为空！');
            }else{
                return $this->error('注册失败!');
            }
        }
        return $this->fetch('loginup');
    }
}

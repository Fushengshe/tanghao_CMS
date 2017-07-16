<?php

/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/6/21
 * Time: 下午7:55
 */

namespace app\admin\model;
use think\Model;
use think\Db;
use think\Session;
class AuthMod extends Model
{
    protected $table="user";
    public function login($data)
    {
        if(isset($data['mobile'])){
            $db = Db::name('user')
                ->where('mobile',$data['mobile'])
                ->select();
        }else
        {
            return json(['status'=>0,'msg'=>'请输入用户名']);
        }

        if($db)
        {
            $userInfo = $this->where('password',sha1(md5($data['password'].$db[0]['salt'])))->find();
            if($userInfo){
                $token=AuthMod::setToken($db[0]['id']);
                return json([ 'token' => $token, 'id' => $db[0]['id'] , 'mobile' => $data['mobile'] ]);
            }
            else{
                return json(['status'=>0,'msg'=>'密码错误']);
            }
        }
        else{
            return json(['status'=>0,'msg'=>'用户不存在']);
        }
    }
    public static function setToken($id)
    {
        $str = md5(uniqid(md5(microtime(true)),true));
        $str = sha1($str);
        Db::table('user')
            ->where('id',$id)
            ->update(['token_exp'=>time()+86400,'token'=>$str]);
        $token = Db::name('user')
            ->where('id','=',$id)
            ->value('token');
        return $token;
    }

    public static function checkTokens($token)
    {
        $res = Db::table('user')
            ->where('token',$token)
            ->select();
        if (time() - $res[0]['token_exp'] > 0)
        {
            return 90003;  //token长时间未使用而过期，需重新登陆
        }
        else
        {
            Db::table('user')
                ->where('token',$token)
                ->update(['token_exp'=>time()+86400]);
            return 90001;  //token验证成功，time_out刷新成功，可以获取接口信息
        }

        return 90002;  //token错误验证失败
    }
    public function signup($username,$password,$mobile,$confirm){
        $admin  = \think\Db::name('user')->where('username','=',$username)->find();
        if($admin){
            return json(['status' => '5','msg' => '注册失败，用户名已存在！']);
        }elseif($username == ''){
            return json(['status' => '4','msg' => '注册失败，用户名不能为空！']);
        }elseif($mobile == ''){
            return json(['status' => '2','msg' => '注册失败，手机号不能为空！']);
        }elseif(!ctype_digit($mobile)){
            return json(['status' => '22','msg' => '注册失败，手机号必须为数字！']);
        }elseif($password == ''){
            return json(['status' => '3','msg' => '注册失败，密码不能为空！']);
        }elseif(!($password === $confirm)){
            return json(['status' => '33','msg' => '注册失败，密码不一致！！']);
        }else{
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
            \think\Db::table('user')->insert($data);
            return json(['status' => '1','msg' => '注册成功！']);
        }
    }


}
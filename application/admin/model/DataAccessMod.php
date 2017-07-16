<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017/7/16
 * Time: 14:24
 */

namespace app\admin\model;
use think\Model;
use think\Db;
use think\Session;

class DataAccessMod extends Model
{
    public function checkTokens($token)
    {
        $res = Db::table('user')
            ->where('token',$token)
            ->select();
        if (time() - $res[0]['token_exp'] > 0)
        {
            return json(['status'=>90003,'msg'=>'token验证失败!']);;  //token长时间未使用而过期，需重新登陆
        }
        else
        {
            Db::table('user')
                ->where('token',$token)
                ->update(['token_exp'=>time()+86400]);
            $user = Db::table('user')->where('token',$token)->find();
            $profile = Db::table('profile')->where('id',$user[0]['id'])->find();
            $uid = $profile[0]['uid'];
            $avatar = $profile[0]['avatar'];
            return json(['status'=>90001,'uid'=>$uid,'avatar'=>$avatar]);//token验证成功，time_out刷新成功，可以获取接口信息
        }

        return json(['status'=>90002,'msg'=>'token验证失败!']);  //token错误验证失败
    }

}
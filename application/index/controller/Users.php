<?php
/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/5/30
 * Time: 下午4:41
 */

namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Session;

use app\index\model\UserModel;
class Users extends Controller
{
    public function user_list(){
        header('Access-Control-Allow-Origin : *');//有的Apache可能需要关掉header才能进行线下localhost调试
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');

        //$post_data  = Request::instance()->post();
        if(!session('user_username')){
            return json(['status'=>0,'msg'=>'请先登录']);
        }
        $User = new UserModel();
        $data = $User -> showlist(0);
        return json($data);
    }
    public function user_del(){
        header('Access-Control-Allow-Origin : *');//有的Apache可能需要关掉header才能进行线下localhost调试
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');
        if(!session('user_username')){
            return ['status'=>0,'msg'=>'请先登录'];
        }
        $User = new UserModel();
        $user_id = Request::instance()->post('id');
        //var_dump($user_id);
        $res = $User -> del_user($user_id);
        //var_dump($res);
        if(!$res){
            return json(['status'=>0,'msg'=>'参数错误']);
        }else{
            return json(['status'=>1,'msg'=>'删除用户成功','id'=>$user_id]);
        }
    }
    public function user_add(){
        header('Access-Control-Allow-Origin : *');//有的Apache可能需要关掉header才能进行线下localhost调试
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');
        $User = new UserModel();
        $data = Request::instance()->post();

        $res = $User -> adduser($data);
        if($res){
            return json(['status'=>1,'msg'=>'用户添加成功']);
        }else{
            return json(['status'=>0,'msg'=>'用户添加失败']);
        }
    }
    public function user_showdetail(){
        header('Access-Control-Allow-Origin : *');//有的Apache可能需要关掉header才能进行线下localhost调试
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');

        $User = new UserModel();
        $user_id = Request::instance()->post('id');

        $res = $User -> userdetail($user_id);
        if($res){
            return json(['status'=>1,'data'=>$res]);
        }else{
            return json(['status'=>0,'msg'=>'查询信息失败']);
        }
    }
    public function user_mod(){
        header('Access-Control-Allow-Origin : *');//有的Apache可能需要关掉header才能进行线下localhost调试
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');

        if(!session('user_username')){
            return ['status'=>0,'msg'=>'请先登录'];
        }
        $User = new UserModel();
        $data = Request::instance()->get();//要求前端传进来的有id才可以

        $res = $User -> user_moder($data);
        if($res){
            return json(['status'=>1,'msg'=>'信息修改成功']);
        }else{
            return json(['status'=>0,'msg'=>'信息修改失败']);
        }

    }


    public function user_login(){
        header('Access-Control-Allow-Origin : *'); // 有的Apache可能需要关掉header才能进行线下localhost调试
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');

        $User = new UserModel();
        $user_name = Request::instance()->get('username');
        $user_password = Request::instance()->get('password');
        $res = $User -> user_loginer($user_name,$user_password);
        if($res){
            //session写入
            session::clear();
            Session::set('user_username', $user_name);
            Session::set('user_id', $res[0]['id']);
            Session::set('user_group', $res[0]['group']);
            //todo token
            return json(['status'=>1,'msg'=>'登陆成功']);
        }else{
            session::clear();
            return json(['status'=>0,'msg'=>'登陆失败，用户名或者密码错误']);
        }
    }
    public function user_logout(){
        session::clear();
        return json(['status'=>1,'msg'=>'用户注销成功']);
    }
}
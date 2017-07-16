<?php

/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/6/21
 * Time: 下午7:49
 */
namespace app\admin\controller;
use think\Controller;
use think\Response;
use think\Request;
use app\admin\model\AuthMod;
class Auth extends Controller
{
    public function register()
    {
//        header('Access-Control-Allow-Origin : *');
//        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
//        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');

        $loginup = new AuthMod();
        $username = input('username');
        $password = input('password');
        $mobile = input('mobile');
        $confirm = input('confirm');
        return $loginup->signup($username,$password,$mobile,$confirm);

    }

    public function login()
    {
//        header('Access-Control-Allow-Origin : *');
//        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
//        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');

        if(Request::instance()->isPost()) {
            $my = new AuthMod();
            return $my->login(input('post.'));
        }
    }


}
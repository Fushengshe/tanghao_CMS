<?php

/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/5/30
 * Time: 下午4:44
 */

namespace app\index\model;

use phpDocumentor\Reflection\Types\Null_;
use think\Model;
use think\Db;
use think\Session;
class UserModel extends Model
{
    public function showlist($cate = '0'){ //cate代表查询的usergroup 0则为全部查询，默认为0
        if($cate == '0'){
            $db = Db::name('user')
                ->select();
            return $db;
        }else{
            $db = Db::name('user')
                ->where('usergroup','=',$cate)
                ->select();
            return $db;
        }
    }
    public function del_user($id = '0'){
        if($id == '0'){
            return false;
        }else{
            $db = Db::name('user')
                ->where('id','=',$id)
                ->delete();
            return $db;
        }
    }
    public function adduser($data){
        if($data['username']==NULL || $data['password']==NULL || $data['usergroup']==NULL){
            return false;
        }else{
            $data['password'] = md5($data['password']);
            $data['userstatus'] = 1;
            $db = Db::name('user')
                ->insert($data);
            return $db;
        }
    }
    public function userdetail($id='0'){
        if($id == '0'){
            return false;
        }else{
            $db = Db('user')
                ->where('id','=',$id)
                ->select();
            return $db;
        }
    }
    public function user_loginer($username,$password){
        if($username==NULL || $password==NULL){
            return false;
        }else{
            $password = md5($password);
            $username = Db::name('user')
                ->where('username','=',$username)
                ->select();
            if($username[0]['password'] == $password){
                return true;
            }else{
                return false;
            }
        }

    }
    public function user_moder($data){
        if(
            $data['id'] == NULL
            ||$data['truename'] == NULL
            ||$data['addr'] == NULL
            ||$data['telephone'] == NULL
            ||$data['phone'] == NULL
            ||$data['email'] == NULL
            ||$data['hobbys'] == NULL
        ){
            return false;
        }else{
            $db = Db::name('user')
                ->where('id','=',$data['id'])
                ->select();
            $attr_id = $db[0]['user_attr_id'];
            //var_dump($attr_id);
            unset($data['id']);
            $db = Db::name('user_attr')
                ->where('attr_id','=',$attr_id)
                ->update($data);
            return $db;
        }
    }

}
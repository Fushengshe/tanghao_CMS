<?php
/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/5/31
 * Time: 下午6:59
 */

namespace app\index\controller;
use think\Controller;
use think\Request;

use app\index\model\GoodsModel;
class Goods extends Controller
{
    public function showlist(){
        //test function
        header('Access-Control-Allow-Origin : *');
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');
        $Goods = new GoodsModel();
        $res = $Goods -> showGoodsList('0');
        return json($res);
    }
    public function goods_add(){
        header('Access-Control-Allow-Origin : *');
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');

        if(!session('user_username')){
            return json(['status'=>0,'msg'=>'请先登录']);
        }
        $Goods = new GoodsModel();
        $goods_data = Request::instance()->get();
        $res = $Goods -> goodsAdd($goods_data);
        if($res){
            return json(['status'=>1,'msg'=>'商品添加成功','data'=>$goods_data]);
        }else{
            return json(['status'=>0,'msg'=>'商品添加失败,请检查信息']);
        }
    }
    public function goods_del(){
        header('Access-Control-Allow-Origin : *');
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');
        if(!session('user_username')){
            return json(['status'=>0,'msg'=>'请先登录']);
        }
        $Goods = new GoodsModel();
        $id = Request::instance()->get('id');
        $res = $Goods -> goodsDel($id);
        if($res){
            return json(['status'=>1,'msg'=>'商品删除成功']);
        }else{
            return json(['status'=>0,'msg'=>'商品删除失败,请检查信息']);
        }
    }
    public function goods_detail(){
        header('Access-Control-Allow-Origin : *');
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');
        $Goods = new GoodsModel();
        $id = Request::instance()->get('id');
        $res = $Goods -> goodsDetail($id);
        if($res){
            return json(['status'=>1,'data'=>$res[0]]);
        }else{
            return json(['status'=>0,'msg'=>'查询信息失败']);
        }
    }
    public function goods_mod(){
        header('Access-Control-Allow-Origin : *');
        header('Access-Control-Allow-Methods : POST,GET,PUT,DELETE,OPTIONS');
        header('Access-Control-Allow-Headers : token,accept,content-type,X-Requested-With');
        $Goods = new GoodsModel();
        $data = Request::instance()->get();
        $res = $Goods -> goodsModer($data);
        if($res){
            return json(['status'=>1,'msg'=>'商品信息修改成功']);
        }else{
            return json(['status'=>0,'msg'=>'商品信息修改失败']);
        }
    }
}
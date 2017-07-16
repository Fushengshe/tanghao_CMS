<?php
/**
 * Created by PhpStorm.
 * User: hequanli
 * Date: 17/5/31
 * Time: 下午7:00
 */

namespace app\index\model;
use think\Model;
use think\Db;
use think\Session;

class GoodsModel extends Model
{
    public function showGoodsList($msg){//用以搜索等方法，传入msg为‘0’时显示全部
        if($msg == '0'){
            $db = Db::name('goods')
                ->select();
            return $db;
        }
        //todo 写其他的showlist方式
    }
    public function goodsAdd($goods_data){
        if(
              $goods_data['goods_name'] == NULL
            ||$goods_data['goods_provider'] == NULL
            ||$goods_data['goods_provider_id'] == NULL
            ||$goods_data['goods_type'] == NULL
            ||$goods_data['goods_price'] == NULL
            ||$goods_data['sales_volume'] == NULL
            ||$goods_data['goods_location'] == NULL
        )
        {
            return false;
        }else{
            $goods_data['updated_at'] = date('Y:m:d H:i:s');
            $goods_data['is_on_sale'] = 1;
            $goods_data['goods_click'] = 0;
            $db = Db::name('goods')
                ->insert($goods_data);
            return $db;
        }

    }
    public function goodsDel($id){
        if($id == NULL || $id <= 0){
            return false;
        }else{
            $db = Db::name('goods')
                ->where('goods_id','=',$id)
                ->delete();
            return $db;
        }
    }
    public function goodsDetail($id){
        if($id <= 0 || $id == NULL){
            return false;
        }else{
            $db = Db::name('goods')
                ->where('goods_id','=',$id)
                ->select();
            return $db;
        }
    }
    public function goodsModer($data){
        if(
            $data['goods_id'] == NULL ||
            $data['goods_name'] == NULL||
            $data['goods_type'] == NULL||
            $data['goods_price'] == NULL
        ){
            return false;
        }
        else{
                $db = Db::name('goods')
                    ->where('goods_id','=',$data['goods_id'])
                    ->update($data);
                return $db;
        }
    }
}
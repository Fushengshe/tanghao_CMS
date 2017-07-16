<?php
/**
 * Created by PhpStorm.
 * User: hasee
 * Date: 2017/7/16
 * Time: 12:02
 */

namespace app\admin\controller;
use think\Controller;
use think\Response;
use think\Request;
use app\admin\model\DataAccessMod;

class Dataaccess extends Controller
{
    public function Dataaccess(){
        if (isset($_SERVER["HTTP_REFERER"])) {
            $url       = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
            $str   = str_replace("http://", "", $url);  //去掉http://
            $strdomain = explode("/", $str);               // 以“/”分开成数组
            $domain    = $strdomain[0];              //取第一个“/”以前的字符
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: http://".$domain);
            header("Access-Control-Allow-Headers: content-type");
        } else {
            header("Access-Control-Allow-Credentials: true");
            header("Access-Control-Allow-Origin: *");
            header("Access-Control-Allow-Headers: content-type");
        }
        $token = time();
        $dataAccess = new DataAccessMod();
        return $dataAccess->checkTokens($token);
    }
}
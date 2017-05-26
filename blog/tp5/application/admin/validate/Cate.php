<?php
namespace app\admin\validate;

use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename' => 'require|max:25|unique:cate',
//        'email' => 'email',
    ];
    protected $message = [
        'catename.require'  => '栏目名称不能为空！',
        'catename.unique'  => '栏目名称不能重复！',
        'catename.max'  => '栏目名称不能超过25位！',
//        'name.max'      => '名称最多不能超过25个字符',
//        'age.number'    => '年龄必须是数字',
//        'age.between'   => '年龄只能在1-120之间',
//        'email'         => '邮箱格式错误',
    ];


}

<?php
namespace app\admin\validate;

use think\Validate;

class Article extends Validate
{
    protected $rule = [
        'title' => 'require|max:25|unique:article',
//        'email' => 'email',
    ];
    protected $message = [
        'title.require'  => '标题名称不能为空!！',
        'title.unique'  => '标题名称不能重复！',
        'title.max'  => '标题名称不能超过100位！',
//        'name.max'      => '名称最多不能超过25个字符',
//        'age.number'    => '年龄必须是数字',
//        'age.between'   => '年龄只能在1-120之间',
//        'email'         => '邮箱格式错误',
    ];


}

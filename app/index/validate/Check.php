<?php
namespace app\index\validate;

use think\Validate;

class Check extends Validate
{
	//验证规则
	protected $rule = [
        '__token__' => 'token',
        'username' 	=> 'require|max:25',
        'password' 	=> 'require|max:16',
    ];
    //验证错误提示
    protected $message = [
        'username.require' 	=> '名称不能为空',
        'username.max'     	=> '名称最多不能超过25个字符',
        'password.require'  => '密码不能为空',
        'password.max' 		=> '密码最多不能超过16个字符',
    ];
    //场景
    protected $scene = [
        'login'  =>  ['username','password'],
    ];
}
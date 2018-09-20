<?php

namespace app\index\model;

use \think\Model;
use \app\index\validate\Check;

class Login extends Model
{
	public function check($data)
	{
		$validate = new Check;
		//场景验证
		$result = $validate->scene('login')->check($data);
		if($result)
		{
			// $user = self::where('username',$data['username'])->find();
			//判断管理员是否存在
			$user = ['username'=>1,'password'=>2];
			if(!$user) rejson(400,'该管理员不存在');

			if($user['password'] == md5($data['password']))
			{
				rejson(200,'登录成功');
			}
			else
				rejson(400,'登录失败');
		}
		else
			rejson(400,$validate->getError());
	}
}
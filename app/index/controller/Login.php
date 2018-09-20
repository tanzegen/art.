<?php
namespace app\index\controller;

use \think\Controller;
use \app\index\model\Login as LoginModel;

class Login extends Controller
{
	public function index()
	{
		return $this->fetch();
	}

	public function login()
	{
		//请求数据获取
		$data = input('post.');
		dump($data);
		$data = processed($data);

		if(checkSet($data,'username','password'))
		{
			$login = new LoginModel;
			return $login->check($data);
		}
		else
			rejson(400,'数据错误,请稍后再试');
	}
}
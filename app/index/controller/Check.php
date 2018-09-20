<?php

namespace app\index\controller;

use \think\Controller;

class Check extends Controller{
	protected $token;

	protected $data;

	public function _initialize(){
		// //csrf_token 开始
		// $token = input('post.token')??exit('请求不合法');
		// $sess_token = session('token')??exit('脱脱脱啃识别错误');
		// if($token === $sess_token)
		// {
		// 	$nonce_str = nonce_str();
		// 	session('token',$nonce_str);
		// 	$this->token = $nonce_str;
		// }
		// else
		// 	session(NULL);
		// 	exit('这波操作失败了，下波再来');

		// //请求数据获取
		// $data = input('post.');
		// $this->data = processed($data);
	}
}
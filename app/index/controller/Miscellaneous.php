<?php

namespace app\index\controller;

use \think\Controller;

//迷之类..
class Miscellaneous extends Controller
{
	public function notFound()
	{
		return $this->fetch();
	}
}
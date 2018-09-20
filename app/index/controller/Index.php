<?php
namespace app\index\controller;

use \think\Loader;

class Index extends Check
{
    public function index()
    {
        return $this->fetch();
    }

    public function check()
    {
    	return 1;
    }
}

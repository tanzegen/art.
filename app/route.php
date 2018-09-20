<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use \think\Route;

//首页路由
Route::get('index','index/Index/index');
//登录页路由
Route::get('login','index/Login/index');
//登录页请求路由
Route::post('loginto$','index/Login/login');
//miss路由
Route::miss('miscellaneous/notFound');


// return [
//     '__pattern__' => [
//         'name' => '\w+',
//     ],
//     '[hello]'     => [
//         ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
//         ':name' => ['index/hello', ['method' => 'post']],
//     ],
//     'login'   => ['index/Login/index',['method' => 'get']],
//     'loginto' => ['index/Login/login',['method' => 'post'],['username' => '\w+']]

// ];
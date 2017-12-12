<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
ini_set('date.timezone','Asia/Shanghai');
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
$today = date_create(date('Y-m-d H:i:s'));
var_dump($today);
echo '<br />';
$eventDay = date_create('2017-12-12');
var_dump($eventDay);
echo '<br />';
var_dump(date_diff($today, $eventDay)->days);
echo '<br />';
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';

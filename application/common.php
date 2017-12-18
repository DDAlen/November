<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------


use think\Request;
// 应用公共文件
function twig($template, $vars=[], $httpCode=false)
{
   //\think\Loader::import('twig');
    //定义模板目录
    require_once ROOT_PATH . '/extend/twig/lib/Twig/Autoloader.php';
    \Twig\Twig_Autoloader::register();
    //$request = Reuqest::instance(); 
    //$path = $request->module() .'/view/'.$request->controller() . '/' . (empty($template) ?? $request->action());
    
    $loader = new Twig_Loader_Filesystem( ROOT_PATH.'/application/index/view/index');
    //初始化
    $twig = new Twig_Environment($loader, array(
        'cache' => RUNTIME_PATH.'/twig',
        'debug' => config('app_debug')
    ));
    //函数扩展
    $url_function = new Twig_SimpleFunction('url', function($url = '', $vars = '', $suffix = true, $domain = false){
        return url($url, $vars, $suffix, $domain);
    });
    $twig->addFunction($url_function);
    //输出模板
    return $twig->render($template.config('twig.view_suffix'), $vars);
}

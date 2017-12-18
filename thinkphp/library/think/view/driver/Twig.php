<?php
namespace think\view\driver;

use think\App;
use think\exception\TemplateNotFoundException;
use think\Log;
use think\Request;
use think\Template;

class Twig{

    protected $config = [
        // 模板起始路径
        'view_path'   => '',
        // 模板文件后缀
        'view_suffix' => 'html.wendortwig',
        // 模板文件名分隔符
        'view_depr'   => DS,
        //Whetaher to open the template chche,set to true eveyr time the default cache
        'tpl_cache'   => true,
    ];
     public function __construct($config = [])
    {
        $this->config = array_merge($this->config, $config);
        if (empty($this->config['view_path'])) {
            $this->config['view_path'] = App::$modulePath . 'view' . DS;
        }
        $this->template = new Template($this->config);
    }

    /**
     * 检测是否存在模板文件s
     * @access public
     * @param string $template 模板文件或者模板规则
     * @return bool
     */
    public function exists($template)
    {
        if ('' == pathinfo($template, PATHINFO_EXTENSION)) {
            // 获取模板文件名
            $template = $this->parseTemplate($template);
        }
        return is_file($template);
    }
    /**
     * 渲染模板文件
     * @access public
     * @param string    $template 模板文件
     * @param array     $data 模板变量
     * @return void
     */
     public function fetch($template, $data = [])
    {
        if ('' == pathinfo($template, PATHINFO_EXTENSION)) {
            // 获取模板文件名
            $template = $this->parseTemplate($template);
        }
        // 模板不存在 抛出异常
        if (!is_file($template)) {
            throw new TemplateNotFoundException('template not exists:' . $template, $template);
        }
        // 记录视图信息
        App::$debug && Log::record('[ VIEW ] ' . $template . ' [ ' . var_export(array_keys($data), true) . ' ]', 'info');
        extract($data, EXTR_OVERWRITE);
        include $template;
    }
    /**
     * 渲染模板内容
     * @access public
     * @param string    $template 模板内容
     * @param array     $data 模板变量
     * @param array     $config 模板参数
     * @return void
     */
    public function display($template, $data = [], $config = [])
    {
        $this->template->display($template, $data, $config);
    }

    /**
     * 自动定位模板文件
     * @access private
     * @param string $template 模板文件规则
     * @return string
     */
    private function parseTemplate($template)
    {
        // 获取视图根目录
        if (strpos($template, '@')) {
            // 跨模块调用
            list($module, $template) = explode('@', $template);
            $path                    = APP_PATH . $module . DS . 'view' . DS;
        } else {
            // 当前视图目录
            $path = $this->config['view_path'];
        }
       
    
    $loader = new \Twig_Loader_Filesystem( ROOT_PATH.'views' );
    //初始化
    $twig = new \Twig_Environment($loader, array(
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

        // 分析模板文件规则
        $request    = Request::instance();
        $controller = $request->controller();
        if ($controller && 0 !== strpos($template, '/')) {
            $depr     = $this->config['view_depr'];
            $template = str_replace(['/', ':'], $depr, $template);
            if ('' == $template) {
                // 如果模板文件名为空 按照默认规则定位
                $template = str_replace('.', DS, $controller) . $depr . $request->action();
            } elseif (false === strpos($template, $depr)) {
                $template = str_replace('.', DS, $controller) . $depr . $template;
            }
        }
        return $path . ltrim($template, '/') . '.' . ltrim($this->config['view_suffix'], '.');
    }

    public function __call($method, $params)
    {
        return call_user_func_array([$this->template, $method], $params);
    }

    public  function render($file,$array=array())
     {
       //$name= strtolower(get_class($this));
       //$controller= substr($name,0,strpos($name,'controller'));
       //$filename= _DIR_."/".$controller."/".$file;
		$filename=dirname(__DIR__) . '/view/index/index_twg.html';
        Twig_Autoloader::register();
        $loader= new Twig_loader_Filesystem(VIEW_PATH);
        $twig= new Twig_Environment($loader,array(
                           'cache'=> ROOT_DIR.'/cache',
                           'debug'=> DEBUG,
                 ));
        $template= $twig->loadTemplate($controller.’/’.$file.".php");
        $template->display($array);
     }

}
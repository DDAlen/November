<?php
namespace app\index\Controller;
use think\Controller;
use think\Request;
use think\Db;
use app\index\model\User as UserModel;

/**
* 	点击验证码刷新
*/
class Index extends Base
{
	//登录界面
	protected $is_login = ['error'];

	public function _empty()
	{
		return $this->index();
	}

	public function index()
	{
		return $this->twig('index', ['data' => '测试twig']);
		//return twig('index_twig', null);	
		 //session(null);
		 //$this->render('index', ['data' => '测试twig']);
		 //$view = new \think\view\driver\Twig();
		 //return $this->fetch('index', ['data' => '测试twig']);
	}
	
	public function login()
	{
		/*if(!captcha_check(input('post.validateCode')))
		{
            $this->error('验证码不正确', 'index/Index/index');
        }*/

		$user = new UserModel();
		$res = $user->where('user_name', input('post.userName'))->where('deleted', 0)->find();
		if (null === $res)
		{
			$this->error('账号或密码错误', 'index/Index/index');
		}
		
		if ($res['user_password'] === md5(input('post.userPassword')))
		{
			session('user_id', $res['id']);
			EventManage::dealWithEvent('index/index/login');
			$this->redirect('Main/main');
		}
		else
		{
			$this->error('账号或密码错误', 'Index/index');
		}
	}

	public function loginOut()
	{
		session(null);
		$this->redirect('/index/index/index');
	}

	public function register() 
	{
		return $this->fetch('register', ['question' => DB::name('question')->where('delete', 0)->select()]);	
	}

	public function twig($template, $vars=[], $httpCode=false)
	{
	    //定义模板目录//
	    \Twig\Autoloader::register();
	    
	    $request = Request::instance(); 
	    $path = $request->module() .'/view/'.$request->controller() . '/' . (empty($template) ?? $request->action());
	    
	    $loader = new \Twig_Loader_Filesystem( ROOT_PATH.'/application/' . $path);
	    //$loader = new Twig_Loader_Filesystem( ROOT_PATH.'/application/index/view/index');
	    //初始化
	    $twig = new \Twig_Environment($loader, array(
	        'cache' => RUNTIME_PATH.'/twig',
	        'debug' => config('app_debug')
	    ));
	    //函数扩展
	    $url_function = new \Twig_SimpleFunction('url', function($url = '', $vars = '', $suffix = true, $domain = false){
	        return url($url, $vars, $suffix, $domain);
	    });
	    $twig->addFunction($url_function);
	    //输出模板
	    return $twig->render($template.config('twig.view_suffix'), $vars);
	}

    public static function autoload($class)
    {
        if (0 !== strpos($class, 'Twig')) {
            return;
        }
        $tmp = $class;
        $class = str_replace('\\', '/', $class);
        $class = explode('/', $class);
        $class = $class[count($class) - 1];
      
        $file = dirname(__FILE__).'/../'.str_replace(array('_', "\0"), array('/', ''), $class).'.php';
        if (is_file($file)) {
            require $file;
        }
        else
        {
            echo $tmp;
            echo $file;
        }
    }
}

?>
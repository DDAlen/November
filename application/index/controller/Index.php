<?php
namespace app\index\Controller;
use think\Controller;
use think\Request;
use think\Db;
use app\index\model\User as UserModel;
use app\index\validate\user\UserLogin;
use app\index\logic\User as UserLogic;
/**
* 	点击验证码刷新
*/
class Index extends Controller
{
	//登录界面
	public function _empty()
	{
		return $this->index();
	}

	public function index()
	{
		session(null);
		$data = [
			'loginUrl' => '/index/index/login',
			'register' => '/index/index/register',
		];
		$data = ['data' => ['name' => '是山东', 'message' => '撒旦说']];
		return $this->twig('', $data);
		 //return $this->fetch('index', ['data' => '测试twig']);
	}
	
	public function login()
	{
		/*if(!captcha_check(input('post.validateCode')))
		{
            $this->error('验证码不正确', 'index/Index/index');
        }*/

        $data = [
        	'name' => input('post.userName'),
        	'password' => input('post.userPassword'),
        ];

        $validate = new UserLogin();
        if (!$validate->check($data))
        {
        	return $validate->getError();
        }

        $userLogic = new UserLogic();

        if (!$userLogic->login($data))
        {
        	$this->error('账号或密码错误', 'Index/index');
        }

        $this->redirect('Main/main');
		

		// $user = new UserModel();
		// $res = $user->where('user_name', input('post.userName'))->where('deleted', 0)->find();
		// if (null === $res)
		// {
		// 	$this->error('账号或密码错误', 'index/Index/index');
		// }
		
		// if ($res['user_password'] === md5(input('post.userPassword')))
		// {
			
		// 	$this->redirect('Main/main');
		// }
		// else
		// {
		// 	$this->error('账号或密码错误', 'Index/index');
		// }
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
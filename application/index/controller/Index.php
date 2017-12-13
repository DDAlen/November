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
	public function index()
	{
		session(null);
		return $this->fetch();
	}
	
	public function login()
	{
		/*if(!captcha_check(input('post.validateCode')))
		{
            // 校验失败
            $this->error('验证码不正确', 'index/Index/index');
        }*/

		$user = new UserModel();
		$res = $user->where('user_name', input('post.userName'))->where('deleted', 0)->find();
		if (null === $res)
		{
			$this->error('用户名错误', 'index/Index/index');
		}
		
		if ($res['user_password'] === md5(input('post.userPassword')))
		{
			session('userName', input('post.userName'));
			session('id', $res['id']);
			$this->redirect('Main/main');
		}
		else
		{
			$this->error('密码错误', 'Index/index');
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
}

?>
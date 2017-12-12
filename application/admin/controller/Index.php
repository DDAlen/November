<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\User as UserModel;
/**
* 	点击验证码刷新
*/
class Index extends Base
{
	//登录界面
	public function index()
	{
		session(null);
		return $this->fetch();
	}
	
	public function login()
	{
		if(!captcha_check(input('post.validateCode')))
		{
            // 校验失败
            $this->error('验证码不正确', 'admin/Index/index');
        }

		$user = new UserModel();
		$res = $user->where('userName', input('post.userName'))->where('deleted', 0)->find();
		if (null === $res)
		{
			$this->error('用户名错误', 'admin/Index/index');
		}
		
		if ($res['user_password'] === md5(input('post.userPassword')))
		{
			session('userName', input('post.userName'));
			session('id', $res['id']);
			return $this->main();
		}
		else
		{
			$this->error('密码错误', 'admin/Index/index');
		}
	}

	public function register()
	{
		return $this->fetch();	
	}

	public function main()
	{
		if(!session('?userName'))
		{
			$this->error('请先登录', 'admin/Index/index');
			return;
		}
		return $this->fetch('main');
	}

	public function refreshImage()
	{
		return captcha_src();
	}

}

?>
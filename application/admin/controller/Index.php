<?php
namespace app\admin\Controller;
use think\Controller;
use think\Request;
use think\Db;
use app\admin\model\AdminUser as AdminUserModel;
/**
* 	点击验证码刷新
*/
class Index extends Controller
{
	//登录界面
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
            $this->error('验证码不正确', 'admin/Index/index');
        }*/

		$user = new AdminUserModel();
		$res = $user->where('user_name', input('post.userName'))->where('deleted', 0)->find();
		if (null === $res)
		{
			$this->error('用户名错误', 'admin/Index/index');
		}
		
		if ($res['user_password'] === md5(input('post.userPassword')))
		{
			session('adminUserName', input('post.userName'));
			session('adminId', $res['id']);
			$this->redirect('Main/main');
		}
		else
		{
			$this->error('密码错误', 'admin/Index/index');
		}
	}

	//退出登录
	public function loginOut()
	{
		session(null);
		$this->success('退出登录成功', '/admin/index/index');
	}
}

?>
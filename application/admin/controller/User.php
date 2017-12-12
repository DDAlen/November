<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\model\User as UserModel;
/**
* 
*/
class User extends controller
{
	
	public function addUser()
	{
		/*if(!captcha_check(input('post.validateCode')))
		{
            // 校验失败
            $this->error('验证码不正确', 'admin/Index/register');
        }*/

        if (UserModel::get(['user_name' => input('post.userName')]))
    	{
		   $this->error('用户名重复', 'admin/Index/index');
    	}

    	$user = UserModel::create(['user_name' => input('post.userName'), 'user_password' => md5(input('post.userPassword'))]);
    	session('id', $user->id);
    	session('userName', $user->user_name);
    	$this->redirect('Index/main');
	}
}


?>
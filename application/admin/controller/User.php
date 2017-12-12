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
    	$this->redirect('Main/main');
	}

	public function validateUserName()
	{
		if (UserModel::get(['user_name' => input('post.userName')]))
    	{
    		echo json_encode(['result' => false, 'message' => '恭喜，该用户名'.input('post.userName').'不可用']);
    	}

    	echo json_encode(['result' => true, 'message' => '恭喜，该用户名'.input('post.userName').'可用']);
	}

}





?>
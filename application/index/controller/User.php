<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\index\model\User as UserModel;
use think\Db;
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
            $this->error('验证码不正确', 'index/Index/register');
        }*/
       
        if (UserModel::get(['user_name' => input('post.userName')]))
    	{
		   $this->error('用户名重复', 'index/Index/register');
    	}

        if (input('post.userPassword') != input('post.userPasswordTwo') || empty(trim(input('post.userPassword'))))
        {
             $this->error('密码不一致', 'index/Index/register');
        }

        if(empty(trim(input('post.answer'))))
        {
            $this->error('回答问题不能为空', 'index/Index/register');
        }

        Db::startTrans();
        $userId = 0;
        try
        {
            $userId = Db::name('user')->insertGetId(['user_name' => input('post.userName'), 'user_password' => md5(input('post.userPassword'))]);
           
            if (!($userId > 0))
            {
                throw new Exception("插入失败", 1);
            }

            if (Db::name('user_answers')->insertGetId([
                    'user_id' => $userId, 
                    'question_id' => input('post.question_id'),
                    'user_anwers' => trim(input('post.answer'))
                 ]) > 0)
            {
                Db::commit();   
            }
            else
            {
                throw new Exception("插入问题失败", 1);
            }
        }
        catch(Exception $e)
        {
            Db::rollback();
            $this->error($e->getMessage(), '/index/index/register');
        }
  
    	session('id',  $userId);
    	session('userName', UserModel::get($userId)->user_name);
    	$this->success('注册成功','Main/main');
	}

	public function validateUserName()
	{
		if (UserModel::get(['user_name' => input('post.userName')]))
    	{
    		echo json_encode(['result' => false, 'message' => input('post.userName').'不可用']);
    	}

    	echo json_encode(['result' => true, 'message' => input('post.userName').'可用']);
	}

    public function forgetPassword()
    {
        return $this->fetch();
    }

    public function editPassword()
    {

    }
}

?>
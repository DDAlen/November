<?php
namespace app\index\controller;
use app\index\model\User as UserModel;

/**
* 
*/
class User 
{
	
	//新增一条数据
	public function add()
	{
		/*
		$user = new UserModel();
		$user->name = '刘云';
		$user->email = '460154786.com';
		$user->birthday = strtotime(time());

		if ($user->save())
		{
			return '用户新增成功';
		}
		else
		{
			return '用户新增失败';
		}
*/		
		$user = ['name' => '成功', 'email' => 'qq.com', 'birthday' => strtotime('1993-09-05')];

		if (UserModel::create($user))
		{
			return '用户新增成功';
		}
		else
		{
			return '用户新增失败';
		}
	}

	public function addList()
	{
		$user = new UserModel();
		$list = [
				['name' => '张三', 'email' => 'zhangsanqq.com', 'birthday' => strtotime('1999-09-05')],
				['name' => '李四', 'email' => 'lisiqq.com', 'birthday' => strtotime('1996-09-05')]
		];
		if ($user->saveAll($list))
		{
			return '用户新增成功';
		}
		else
		{
			return '用户新增失败';
		}
	}

	public function update()
	{
		//通过主键ID获取一个对象
		/*$user = UserModel::get(1);
		$user->name = '成长';
		if ($user->save())
		{
			return '更新用户成功';
		}
		else
		{
			return '更新新增失败';
		}
		*/
/*
		$user = new UserModel();
		if ($user->save(['name' => '快乐'], ['id' => 3]))
		{
			return '更新用户成功';
		}
		else
		{
			return '更新新增失败';
		}*/

		$user = new UserModel();
		$list = [['id' => 1, 'name' => '第一'], ['id' => 2, 'name' => '第二']];
		if ($user->saveAll($list))
		{
			return '更新用户成功';
		}
		else
		{
			return '更新新增失败';
		}


	}

}

?>
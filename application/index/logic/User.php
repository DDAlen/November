<?php
namespace app\index\logic;
use think\Model;
/**
* 
*/
class User extends Model
{
	public function login($data)
	{
		$user = $this->where('user_name', $data['name'])->where('deleted', 0)->select();

		if (empty($user) || count($user) > 1)
		{
			return false;
		}
		
		if ($user[0]->user_password !== md5($data['password']))
		{
			return false;
		}

		session('user_id', $user[0]['id']);
		EventManage::dealWithEvent('index/index/login');
		return true;
	}
}

?>
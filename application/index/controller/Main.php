<?php
namespace app\index\Controller;
use think\Controller;
use app\index\Model\User as UserModel;
/**
* 
*/
class Main extends Controller
{
	public function main()
	{

		if(!session('?userName') || ! session('?id'))
		{
			$this->error('请先登录', 'index/Index/index');
			return;
		}

		return $this->fetch('main', [
			'user' => UserModel::get(session('id'))
		]);
	}

}

?>
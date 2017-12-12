<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\User as UserModel;
/**
* 
*/
class Main extends Controller
{
	public function main()
	{

		if(!session('?userName') || ! session('?id'))
		{
			$this->error('请先登录', 'admin/Index/index');
			return;
		}

		return $this->fetch('main', [
			'user' => UserModel::get(session('id'))
		]);
	}

}

?>
<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\AdminUser as AdminUserModel;
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
			'user' => AdminUserModel::get(session('id'))
		]);
	}

}

?>
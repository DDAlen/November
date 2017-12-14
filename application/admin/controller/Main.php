<?php
namespace app\admin\Controller;
use think\Controller;
use app\admin\Model\AdminUser as AdminUserModel;
/**
* 
*/
class Main extends Base
{
	public function main()
	{
		return $this->fetch('main', [
			'user' => AdminUserModel::get(session('id'))
		]);
	}
}

?>
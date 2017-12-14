<?php
namespace app\admin\Controller;

/**
* 
*/
class Question extends Base
{
	protected $isLoginIn = ['*'];
	public function list()
	{
		return $this->fetch();
	}
}

?>
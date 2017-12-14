<?php
namespace app\admin\Controller;
use think\Controller;
use think\Request;
/**
* 
*/
class Base extends Controller
{
	protected $isLoginIn = [];
    public function _initialize()
    {
	   if (!session('?adminId') && (in_array(Request::instance()->action(), $this->isLoginIn) || empty($this->isLoginIn[0])))
        {
        	$this->error('请先登录', 'Index/index');
        }
    }
}

?>
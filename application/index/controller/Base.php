<?php
namespace app\index\Controller;
use think\Controller;
use think\Request;
/**
* 
*/
class Base extends Controller
{
	protected $is_login = [];
    public function _initialize()
    {
        if ((!session('?userName') && in_array(Request::instance()->action(), $this->is_login)) && $this->is_login[0] == '*')
        {
        	$this->error('请先登录', 'Index/index');
        }

       EventManage::exitEventConditions(Request::instance()->controller() . '/' . Request::instance()->action());
    }
}
?>
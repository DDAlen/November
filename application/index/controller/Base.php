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
        if (!session('?user_id') && (in_array(Request::instance()->action(), $this->is_login) || empty($this->is_login)))
        {
        	$this->error('请先登录', 'Index/index');
        }
    }
}
?>
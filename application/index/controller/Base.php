<?php
namespace app\index\Controller;
use think\Controller;
use think\Request;
/**
* 
*/
class Base extends Controller
{
	
    public function _initialize()
    {
        if (!session('?userName'))
        {
        	$this->error('请先登录', 'Index/index');
        }
    }
}

?>
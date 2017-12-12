<?php
namespace app\admin\Controller;
use think\Controller;
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
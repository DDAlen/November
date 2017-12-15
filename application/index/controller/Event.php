<?php
namespace app\index\Controller;
use think\Db;
/**
* 
*/
class Event extends Base
{
	//显示用户事件奖励
	public function eventLogList()
	{
		return $this->fetch('eventLogList', ['data' => Db::name('event_log')->where('user_id', session('user_id'))->select()]);
	}
}


?>
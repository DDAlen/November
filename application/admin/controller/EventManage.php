<?php
namespace app\admin\Controller;
use app\admin\Model\Event as EventModel;
/**
* 
*/
class EventManage 
{
	//判断是否存在事件且满足条件
	public function exitEventConditions($eventName) 
	{
		$event = new EventModel();
		$event->where('delete', 0)->where('envet_name', "'{$eventName}'")->where('end_time < NOW()')->find();
		if (empty($envet))
		{
			return false;
		}



		return true;
	}	
}


?>
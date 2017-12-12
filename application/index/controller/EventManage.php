<?php
namespace app\index\Controller;
use app\index\Model\Event as EventModel;
use app\index\Model\EventLog as EventLogModel;
use think\Db;
/**
* 
*/
class EventManage 
{
	//判断是否存在事件且满足条件
	public static function exitEventConditions($eventName) 
	{
		$eventModel = new EventModel();
		$event = $eventModel->where('delete', 0)->where('envet_name', "'{$eventName}'")->where('end_time < NOW()')->find();
		if (empty($envet))
		{
			return false;
		}

		//不限
		if ((int)$event->cycle_count == 0)
		{
			return true;
		}

		$eventLog = new EventLogModel();
		if ($event->cycle_days == 0)
		{
			//无限长，只判断个数
			if ($eventLog->where('user_id', session('id'))->where('event_id', $event->id)->count() < $event->cycle_count)
			{
				return true;
			}
			return false;
		}

		//判定是否满足周期 次数

		$days = date_diff(date_create(date('Y-m-d H:i:s')), date_create($event->startTime))->days / $event->cycle_days;
		if (floor($days) == $days)
		{   //0 1 2 3 
			$days_floor_day = date_add(date_create($event->startTime), date_interval_create_from_date_string(max(0, ($days - 1)) *  $event->cycle_days . " days"));
			$days_ceil_day  = date_add(date_create($event->startTime), date_interval_create_from_date_string(max(1, $days) *  $event->cycle_days . " days"));
		}
		else
		{
			$days_floor_day = date_add(date_create($event->startTime), date_interval_create_from_date_string(max(0, (floor($days) - 1)) *  $event->cycle_days . " days"));
			$days_ceil_day  = date_add(date_create($event->startTime), date_interval_create_from_date_string(max(1, ceil($days)) *  $event->cycle_days . " days"));
		}
		
		if (DB::name('event_log')->where("user_id = {session('id')} AND event_id = {$event->id}")->where('start_time', 'between', [$days_floor_day, $days_ceil_day])->count()< $event->cycle_count)
		{
			return true;
		}

		return false;
	}	
}
?>
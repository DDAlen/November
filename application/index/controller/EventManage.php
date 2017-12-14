<?php
namespace app\index\Controller;
use app\index\Model\Event as EventModel;
use app\index\Model\EventLog as EventLogModel;
use think\Db;
use app\index\Model\User as UserModel;
/**
* 
*/
class EventManage 
{
	//处理事件
	public static function dealWithEvent($eventName)
	{
		$eventModel = new EventModel();
		$event = $eventModel->where('delete', 0)->where('envet_name', $eventName)->where('end_time > NOW()')->find();
		if (self::exitEventConditions($event))
		{
			//更新积分等，添加日志
			$data = [
				'user_id' => session('id'),
				 'event_id' => $event->id,
				  'descript' => $event->log_descript,
				   'add_time' => date('Y-m-d H:i:s')
				];
			Db::startTrans();
			try
			{
				Db::name('event_log')->insert($data);
				$user = UserModel::get(session('id'));
    			Db::name('user')->where('id', session('id'))->update([
    				'user_point' => $user->user_point + $event->point, 
    				'user_wealth' => $user->user_wealth + $event->wealth,
    				'user_prestige' => $user->user_prestige + $event->prestige
    			]);
    			Db::commit();    
			}
			catch(Exception $e)
			{
				Db::rollback();
			}
		}
	}

	//判断是否存在事件且满足条件
	public static function exitEventConditions($event) 
	{
		if (empty($event))
		{
			return false;
		}

		//关闭
		if ($event->cycle_count == -1 || $event->cycle_days == -1)
		{
			return false;
		}

		//不限
		if ((int)$event->cycle_count == 0)
		{
			return true;
		}

		//周期类型，1天，2周，3月，4年，5不限，6一次性
		//date("Y-m-d",strtotime("+1months",strtotime("2015-11-27"))); 
		$eventLog = new EventLogModel();
		if($event->cycle_type == 1)
		{

		}
		else if ($event->cycle_type == 2)
		{
				
		}
		else if ($event->cycle_type == 3)
		{

		}
		else if ($event->cycle_type == 4)
		{

		}

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
		$days = date_diff(date_create(date('Y-m-d H:i:s')), date_create($event->start_time))->days / $event->cycle_days;

		if (floor($days) == $days)
		{ 
			$floor_date = (max(0, ($days - 1)) + 1) *  $event->cycle_days . " days";
			$ceil_date = ((max(1, $days) + 1) *  $event->cycle_days) . " days";
		}
		else
		{
			$floor_date = max(0, (floor($days))) *  $event->cycle_days . " days";
			$ceil_date = (max(1, ceil($days)) *  $event->cycle_days - 1) . " days";
		}

		$days_floor_day = date_format(date_add(date_create($event->start_time), date_interval_create_from_date_string($floor_date)), "Y-m-d 00:00:00");
		$days_ceil_day  = date_format(date_add(date_create($event->start_time), date_interval_create_from_date_string($ceil_date)), "Y-m-d 23:59:59");

		if (Db::name('event_log')->where(['user_id' => session('id'), 'event_id' => $event->id])->where('add_time', 'BETWEEN', [$days_floor_day, $days_ceil_day])->count()< $event->cycle_count)
		{
			return true;
		}
		return false;
	}	
}
?>
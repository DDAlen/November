<?php
namespace app\index\logic;
use app\index\Model\Event as EventModel;
use app\index\Model\EventLog as EventLogModel;
use think\Db;
use app\index\Model\User as UserModel;
use app\index\Model\EventType as EventTypeModel;
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
				'user_id' => session('user_id'),
				'event_id' => $event->id,
				'descript' => $event->log_descript,
				'add_time' => date('Y-m-d H:i:s'),
				'wealth'   => $event->wealth,
				'point'    => $event->point,
				'prestige' => $event->prestige,
				];
			Db::startTrans();
			try
			{
				Db::name('event_log')->insert($data);
				$user = UserModel::get(session('user_id'));
    			Db::name('user')->where('id', session('user_id'))->update([
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
		else
		{
			dump("条件不满足");
		}
	}

	//判断是否存在事件且满足条件
	public static function exitEventConditions($event) 
	{
		$typeNever = 5;
		$typeOnce = 6;

		if (empty($event))
		{
			return false;
		}

		//关闭
		if ($event->cycle_count == -1 || $event->cycle_num == -1)
		{
			return false;
		}

		//不限
		if ((int)$event->cycle_count == 0 || $event->cycle_num == 0)
		{
			return true;
		}

		//不限类型 判断次数就行
		if ($event->cycle_type == $typeNever)
		{
			$eventLog = new EventLogModel();
			return $eventLog->where('user_id', session('user_id'))->where('event_id', $event->id)->count() < $event->cycle_count;
		}

		if ($event->cycle_type == $typeOnce)
		{
			$eventLog = new EventLogModel();
			return $eventLog->where('user_id', session('user_id'))->where('event_id', $event->id)->count() < 1;
		}
	
		$dateType = EventTypeModel::get($event->cycle_type)->name;
		$time = date('Y-m-d H:i:s');

		$count = Db::name('event_log')->where('user_id',session('user_id'))->where('add_time', 'exp', " >= DATE_ADD('{$time}',INTERVAL -{$event->cycle_num} {$dateType})")->count();
		return $count < $event->cycle_count;
	}	
}
?>
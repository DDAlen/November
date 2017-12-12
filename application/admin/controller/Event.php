<?php
namespace app\admin\Controller;
use app\admin\Model\Event as EventModel;

/**
* 
*/
class Event extends Controller
{
	public function list()
	{
		return $this->fetch();
	}

	public function add()
	{
		if (EventModel::update(['id' => input('post.eventId'), 'delete' => 0]) > 0)
		{
			$this->success('添加成功', 'Event/list');
		}	
		$this->error('添加失败', 'Event/list');
	}

	public function deleteEvent()
	{
		if (EventModel::update(['id' => input('post.eventId'), 'delete' => 0]) > 0)
		{
			$this->success('删除成功', 'Event/list');
		}	
		$this->error('删除失败', 'Event/list');
	}

	public function updateEvent()
	{
		if (EventModel::update(['id' => input('post.eventId'), 'delete' => 0]) > 0)
		{
			$this->success('更新成功', 'Event/list');
		}	
		$this->error('更新失败', 'Event/list');
	}
}

?>
<?php
namespace app\admin\Controller;
use app\admin\Model\Event as EventModel;
use think\Request;
use think\Db;
/**
* 
*/

class Event extends Base
{
	public function list()
	{
		$eventModel = new EventModel();
		return $this->fetch('', ['data' => $eventModel->where('delete', 0)->select()]);
	}

	public function add()
	{
		$data = input('post.');
		$data['envet_name'] = 'index/index/login';
		if (EventModel::create($data)->id > 0)
		{
			$this->success('添加成功', 'Event/list');
		}	
		$this->error('添加失败', 'Event/list');
	}

	public function deleteEvent()
	{
		if (EventModel::update(['id' => (int)input('id'), 'delete' => 1]))
		{
			$this->success('删除成功', 'Event/list');
		}	
		$this->error('删除失败', 'Event/list');
	}

	public function editEvent()
	{
		return $this->fetch('editEvent', ['event' => EventModel::get(input('id'))]);
	}

	public function updateEvent()
	{
		if (!Request::instance()->isPost())
		{
			$this->error('未知错误', '/admin/index/index');
		}

		if (Db::name('event')->update(input('post.')))
		{
			$this->success('更新成功', 'Event/list');
		}	
		$this->error('更新失败', 'Event/list');
	}
}

?>
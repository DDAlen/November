<?php
namespace app\index\Controller;
use think\Db;
use app\index\Model\Note as NoteModel;
use think\Helper;
use think\Request;
/**
* 节点管理
*/
class Note extends Base
{
	protected $is_login = ['*'];

	public function editNote()
	{
		return $this->fetch('editNote', ['data' => Db::name('note')->where(['delete' => 0, 'user_id' => session('user_id')])->select()]);
	}
	
	//添加节点
	public function submitNote()
	{
		if(Request::instance()->isPost())
		{
			$data['user_id'] = session('user_id');
			$data['note_name'] = input('post.bookName');
			$note = NoteModel::where('note_id', input('post.note_id'))->where('user_id', session('user_id'))->find();
			$data['parent_id'] = empty($note) ? 0 : $note['note_id'];
			
			if (NoteModel::create($data))
			{
				$this->success('添加节点成功', '/index/main/main');
			}
			else
			{
				$this->error('失败了', '/index/main/main');
			}
		}

		$this->error('未知错误', '/index/main/main');
	}

	//显示页面
	public function scanNote()
	{
		$this->redirect('/index/Main/main', ['noteId' => input('noteId')]);
	}
}

?>
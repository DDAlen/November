<?php
namespace app\index\Controller;
use think\Controller;
use app\index\Model\User as UserModel;
use app\index\Model\Note as NoteModel;
use app\index\Model\Book as BookModel;
use think\Helper;
use think\Request;
/**
* 
*/
class Main extends Controller
{
	public function main($noteId = 0)
	{
		if(!session('?userName') || ! session('?id'))
		{
			$this->error('请先登录', 'index/Index/index');
			return;
		}

		$notes = new NoteModel();
		$books = new BookModel();
		$book = null;
		
		return $this->fetch('main', [
			'addUrl' => '/index/Book/add/noteId/'. $noteId,
			'noteId' => $noteId,
			'user' => UserModel::get(session('id')),
			'data' => $notes->scanNote($noteId),
			'book' => $books->where('user_id', session('id'))->where('delete', 0)->where('note_id', $noteId)->select(),
		]);
	}
}

?>
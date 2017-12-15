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
class Main extends Base
{
	public function main($noteId = 0)
	{
		$notes = new NoteModel();
		$books = new BookModel();
		$book = null;
		
		return $this->fetch('main', [
			'addUrl' => '/index/Book/add/noteId/'. $noteId,
			'noteId' => $noteId,
			'user' => UserModel::get(session('user_id')),
			'data' => $notes->getFirstNote($noteId),
			'book' => $books->where('user_id', session('user_id'))->where('delete', 0)->where('note_id', $noteId)->select(),
		]);
	}
}

?>
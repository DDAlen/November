<?php
namespace app\index\Controller;
use think\Controller;
use app\index\Model\User as UserModel;
use app\index\Model\Book as BookModel;
use think\Request;
/**
* 文章管理
*/
class Book extends Base
{
	protected $is_login = ['*'];
	public function add()
	{
		if (input('noteId') == 0)
		{
			$this->error('请先添加一个分类', '/index/note/editNote');
		}
		return $this->fetch('add', ['note_id' => input('noteId')]);		
	}

	public function createBook()
	{
		if (!Request::instance()->isPost())
		{
			$this->error('未知错误', '/index/main/main');
		}
		
		if (Request::instance()->param('note_id') == 0)
		{
			$this->error('请先添加一个分类', '/index/note/editNote');
		}
	
		if (BookModel::create([
			'note_id' => Request::instance()->param('note_id'),
			'user_id' => session('user_id'),
			'book_title' =>  Request::instance()->param('book_title'),
			'book_text' =>  Request::instance()->param('book_text'),
		])->book_id  > 0)
		{
			EventManage::dealWithEvent('index/book/createBook');
			$this->success('发布成功', '/index/main/main');
		}

		$this->error('发布失败', '/index/main/main');
	}

	public function getBook()
	{
		$book = BookModel::get(input('book_id'));
		return $book->book_text;
	}

	public function updateBooks()
	{
		$book = BookModel::get(Request::instance()->param('bookId'));
		if (empty($book))
		{
			$this->error('乱改数据了吧', '/index/main/main');
		}

		if ($book->user_id != session('user_id') || $book->book_text == Request::instance()->param('book_text'))
		{
			$this->error('不是你的就不要动', '/index/main/main');
		}

		$book->book_text = Request::instance()->param('book_text');
		if (!$book->save())
		{
			$this->error('修改失败', '/index/main/main');
		}

		$this->success('修改成功', '/index/main/main');
	}

	public function deleteBook()
	{
		$book = BookModel::get(Request::instance()->param('book_id'));
		if (empty($book))
		{
			$this->error('乱改数据了吧', '/index/main/main');
		}

		if ($book->user_id != session('user_id') || $book->book_text == Request::instance()->param('book_text'))
		{
			$this->error('不是你的就不要动', '/index/main/main');
		}

		$book->delete = 1;
		if ($book->save())
		{
			$this->success('删除成功', '/index/main/main');
		}
		else
		{
			$this->error('删除失败', '/index/main/main');
		}
	}
}

?>
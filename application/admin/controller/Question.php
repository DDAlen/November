<?php
namespace app\admin\Controller;
use think\Db;
use think\Request;
/**
* 
*/
class Question extends Base
{
	public function list()
	{
		return $this->fetch('list', ['question' => Db::name('question')->where('delete',0)->select()]);
	}

	public function delete()
	{
		if (Db::name('question')->update(['question_id' => input('id'), 'delete' => 1]))
		{
			//$this->success('修改成功','/admin/question/list');
			$this->redirect('/admin/question/list');
		}
		$this->error('删除失败', '/admin/question/list');
	}

	public function addQuestion()
	{ 
		try
		{
			dump(1);
			if (!Request::instance()->isPost())
			{
				return;
			}

			$question = trim(input('post.question'));
			if (empty(Db::name('question')->where('question', $question)->find()))
			{
				Db::name('question')->insert(['question' => $question]);
			}
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
}

?>
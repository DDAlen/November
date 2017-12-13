<?php
namespace app\index\Model;
use think\Model;
/**
* 
*/		
class Note extends Model
{
	//显示一级节点
	public function scanNote($noteId)
	{
		$notes = Note::where('user_id', session('id'))->where('delete', 0)->where('parent_id', $noteId)->select();
		return $notes;
	}
}

?>
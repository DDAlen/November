<?php
namespace app\index\Controller;
use think\Controller;
use app\index\Model\User as UserModel;
use app\index\Model\Book as BookModel;
/**
* 文章管理
*/
class Book extends Controller
{
	protected $is_login = ['*'];

}

?>
<?php
namespace app\index\controller;
use think\Request;
use think\Db;
class Index
{
    public function index()
    {
      //  return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/cubrid_client_encoding()t.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    	$request = Request::instance();
    	echo '后缀  '.  $request->ext(). '<br />'; //与伪静态有关
    	echo  '域名  ' . $request->domain() . '<br />';
    	echo '入口文件  '.  $request->baseFile(). '<br />';
    	echo '操作方法  '.  $request->action(). '<br />';
    	
    	echo '变量  '.  $request->param('name'). '<br />';	//获取
    	dump( $request->param());
    	echo '变量  '.  input('name'). '<br />';
    	dump( input('get.name'));
    }

    public function indexTest()
    {
    	echo 'index.Test';
    }

	public function dbNative()
	{ 
		
		// 原生的 插入 修改 删除 数据，返回插入影响的数据的条数
	    //$result = Db::execute('insert into ecs_data (name, status) values (\'坑货\', 0), (\'坑货1\', 1), (\'坑货2\', 1)'); 
	  	//$result = Db::execute('update ecs_data set name = \'风中凌乱\' where id in (2, 3)'); 
	 	//$result = Db::execute('delete from ecs_data  where id in (2, 3)'); 
	 	$result = Db::query('select * from ecs_data');
		//插入数据 原生的，返回插入的数据的条数
		dump($result);
	}

	public function dbPDO()
	{
		//$result = Db::table('ecs_data')->insert(['name' => 'GG', 'status' => 3]);
		//$result = Db::name('data')->insert(['name' => 'GG', 'status' => 3]);

		//$result = Db::table('ecs_data')->where('id', 1)->update(['name' => 'PDO', 'status' => 2]);
		//$result = Db::name('data')->where('id', 1)->update(['name' => 'PDO', 'status' => 2]);

		//$result = Db::table('ecs_data')->where('id', 1)->update(['name' => 'PDO', 'status' => 2]);
		//$result = Db::name('data')->where('id', 1)->update(['name' => 'PDO', 'status' => 2]);
		//$result = Db::table('ecs_data')->select();

		//Db函数，每次都会连接数据库，所以尽量使用Db
		//$db = Db('data');
		//$result = $db->insert(['name' => '黎明', 'status' => 1]);
		//$result = $db->where('id', 7)->update(['name' => '黎明②', 'status' => 1]);
		//$result = Db::name('data')->where('status', 1)->where('name', '=', '黎明')->field('id', 'name')->order('id', 'desc')->select();

		//一次性插入多条数据
		$data = [
			['name' => '孙燕姿', 'status' => 9],
			['name' => '孔雀', 'status' => 0],
			['name' => '灵芝', 'status' => 3],
			['name' => '人参', 'status' => 1],
			['name' => '鹿茸', 'status' => 9],
		];
		//$result = Db::name('data')->insertAll($data);
		
		//更改字段值
		$result = Db::name('data')->where('id', 1)->setField('name', 'thinkPHP');

		dump($result);
	}

}

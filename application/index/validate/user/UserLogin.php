<?php
namespace app\index\validate\user;
use think\Validate;
/**
* 
*/
class UserLogin extends Validate
{	
	protected $rule = [
        'name'  => 'require|max:25',
	    'password'  => 'require|max:25',
    ];
	
	protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'password.require' => '密码不能为空',
        'password.max'     => '密码最多不能超过25个字符',
    ];
}

?>
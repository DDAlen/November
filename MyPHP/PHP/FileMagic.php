<?php

# 测试 魔术常量 __FILE__ 等方法的

	
echoEx(__FILE__);	
echoEx(dirname(__FILE__));
echoEx(__DIR__);
echoEx(__NAMESPACE__);	


function echoEx($str){
	echo '<br />'. $str . '<br />';
}

?>
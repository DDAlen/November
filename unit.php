<?php

function echoEx($str){

	echo '<br />'. $str . '<br />';
}

function printArrEx(array $data)
{
	echo '<pre>';
	print_r($data);
	echo '</ pre>';
}

?>
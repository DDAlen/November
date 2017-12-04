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


function refreshUrl($timeSlot, $url, $message)
{
	require_once DOCUMENTROOT . '/public/Transfer.php';
	//include(DOCUMENTROOT . '/public/transfer.html');

	header("refresh:{$timeSlot};url=". DOCUMENTROOT . "/{$url}");
}

?>
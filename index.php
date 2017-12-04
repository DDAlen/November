<?php
require "config.php";
require DOCUMENTROOT . '/unit.php';
// echo 'hello word';
// echo '<br />';
// echo mt_rand();

// $conn=mysqli_connect(HOST, MYSQLUSER, PASWORD, false);
// echo 22;
// if ($conn){
//   echo "LNMP platform connect to mysql is successful!";
// }else{
//   echo "LNMP platform connect to mysql is failed!";
// }

//refreshUrl(3, "reception/view/index.html", '');
// printArrEx(['data' => 'test', 'message' => 'SUCCESS']);
header("refresh:3;url=". DOCUMENTROOT . "/reception/view/index.html");
exit();
//include  DOCUMENTROOT . "/reception/view/index.html";
?>

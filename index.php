<?php
require "config.php";
echo 'hello word';
echo '<br />';
echo mt_rand();

$conn=mysqli_connect(HOST, MYSQLUSER, PASWORD, false);
echo 22;
if ($conn){
  echo "LNMP platform connect to mysql is successful!";
}else{
  echo "LNMP platform connect to mysql is failed!";
}


printArrEx(['data' => 'test', 'message' => 'SUCCESS']);

?>

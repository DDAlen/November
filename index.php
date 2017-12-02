<?php
echo 'hello word';
echo '<br />';
echo mt_rand();


$conn=mysqli_connect('192.168.0.106:3306','root','password',false);
echo 22;
if ($conn){
  echo "LNMP platform connect to mysql is successful!";
}else{
  echo "LNMP platform connect to mysql is failed!";
}

?>

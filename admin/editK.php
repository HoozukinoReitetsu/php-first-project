<?php 
include 'include/connect.php';
$maK=$_GET['maK'];
$mk=md5("123456");
$sql="UPDATE khachhang set mk='$mk' where maK=$maK";
$conn->query($sql);
header("location:listuser.php");
 ?>
<?php 
include 'include/connect.php';
$maK=$_GET['ma'];
$sql="DELETE FROM khachhang where maK=$maK";
$conn->query($sql);
$sql="DELETE FROM hoadon where maK='$maK'";
$conn->query($sql);
 header("location:listuser.php");
 ?>
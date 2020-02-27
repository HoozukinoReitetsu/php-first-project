<?php 
include 'include/connect.php';
$maDT=$_GET['ma'];
$sql="DELETE FROM hoadon where maDT=$maDT";
$conn->query($sql);
 header("location:listHD.php");
 ?>
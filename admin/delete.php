<?php 
include 'include/connect.php';
$maDT=$_GET['ma'];
$sql="DELETE FROM dt where maDT=$maDT";
$conn->query($sql);
 header("location:listDT.php");
 ?>
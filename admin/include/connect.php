<?php 
$conn=mysqli_connect('localhost','root','','shopdt');
if($conn->connect_error){
	die("kết nối thất bại");}
	else{
		mysqli_set_charset($conn,'utf8');
	}

 ?>
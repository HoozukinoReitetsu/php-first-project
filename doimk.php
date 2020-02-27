<?php session_start(); 
include 'admin/include/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đổi Mật Khẩu</title>
</head>
<body>
	<form action="" method="post">
		<div style="text-align: right;margin-right: 50%;">
        Mật Khẩu cũ: <input type="password" name="mkc" >
        <br>
		Mật khẩu mới:<input type="password" name="mkm">
		<br>
		Nhập Lại Mk:<input type="password" name="mkmr" >
		<br>
		<input type="submit" value="đổi mật khẩu" name="mk" style="margin-right: 10%;">
		<a href="index.php">Về Trang chủ</a>
    </div>
	</form>
	<?php 
	$tk=$_SESSION['tk'];
	if(isset($_POST['mk'])){
		$query="SELECT mk FRom khachhang WHERE tk='$tk'";
	$result=mysqli_query($conn,$query);
	$user=mysqli_fetch_array($result,MYSQLI_ASSOC);
		if($user['mk']!=md5($_POST['mkc'])){
			echo "mật khẩu bạn nhập chưa đúng vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
		}
		if($_POST['mkm']!=$_POST['mkmr']){
		echo "mật khẩu bạn nhập chưa trùng nhau vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
		}
		else{
			$mkm=md5($_POST['mkm']);
		$sql="UPDATE khachhang SET mk='$mkm' WHERE tk='$tk'" ;
 if ($conn->query($sql) === TRUE) {

     $_SESSION['tk']=$tk;
      echo "Cập Nhật Thành Công";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
		}
	 }?>
	
</body>
</html>
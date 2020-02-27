<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Đăng nhập</title>
</head>
<body>
	<form action="login.php" method="post" style="text-align: center;" autocomplete="off">
		
			<label>tài khoản</label>
			<input type="text" name="user" >
			<br>
			<br>
			<label > mật khẩu</label>
			<input type="password" name='pass'>
			<br>
			<input type="submit" name="dn" value="Đăng Nhập">
			<input type="submit" name="dk" value="Đăng Kí">
	</form>
	
</body>
</html>
<?php
	include 'admin/include/connect.php';
		
	  if(isset($_POST["dn"])){
		$pas=$_POST['pass'];
		$user=$_POST["user"];
		if(!$pas||!$user){
			die("phải nhập đủ thông tin");
		}
		else{	
		 $pas=md5($pas);
		$sql="SELECT * FROM khachhang WHERE mk='$pas' AND tk='$user' ";
		// var_dump($sql);
		$query=mysqli_query($conn,$sql);

		$numrow=mysqli_num_rows($query);
		if($numrow==0){
			echo "tài khoản hoặc mật khẩu sai";
		 }
		else{
			$_SESSION['tk']=$user;
			header("location:index.php");
		}
	}
}
	
	 if (isset($_POST['dk'])) {
		# code...
		header("location:signup.php");
	}
	?>
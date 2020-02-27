<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Đăng Kí</title>
</head>
<body>
	<form action="" method="post" accept-charset="utf-8">
		<div style="text-align: right;margin-right: 50%;">
        Họ Tên: <input type="text" name="ten">
        <br>
        Tên đăng nhập: <input type="text" name="tk">
		<br>
		Mật Khẩu:<input type="password" name="mk">
		<br>
		Địa Chỉ      :<input type="text" name="dc">
		<br>
		SDT          :<input type="text" name="dt">
		<br>
		email        :<input type="text" name="mail">
		<br>
		<input type="submit" value="Đăng Kí" name="dk" style="margin-right: 10%;">
    </div>
	</form>
</body>
</html>
<?php 
include 'admin/include/connect.php';
mysqli_set_charset('utf8',$conn);
// mysqli_query("SET NAME 'UTF8'");
	if(isset($_POST['dk'])){
		$tk=$_POST['tk'];
		$mk=$_POST['mk'];
		$dc=$_POST['dc'];
		$dt=$_POST['dt'];
        $ten=$_POST['ten'];
		$mail=$_POST['mail'];
        $maK=rand(0, 5000);
        $sql="SELECT maK FROM khachhang WHERE maK='$maK'";
        $result=mysqli_query( $conn, $sql);
        $count=mysqli_num_rows($result);
        while($count>0){
        $maK=rand(0, 5000);
        }
		if(!$ten||!$tk||!$mk||!$dc||!$dt||!$mail){
			 echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        	 exit;
		}
    //kiểm tra xem tên người dùng có tồn tại hay chưa
    $sql="SELECT tk FROM khachhang WHERE tk='$tk'";
   $result=mysqli_query( $conn, $sql);
    $count=mysqli_num_rows($result);
   if ($count>0){
        echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    $mysql="SELECT email From	khachhang where email='$mail'";
    $result=mysqli_query($conn,$sql);
    $count=mysqli_num_rows($result);
    if ($count>0) {

        # code...
         echo "email này đã có người dùng. Vui lòng chọn email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
     $pattern = '/^0+[0-9]{9}+$/';
	if (!preg_match($pattern, $dt)){
    	echo "bạn nhập SĐT sai.<a href='javascript: history.go(-1)'>Trở lại</a>";
    	exit;
    }
    // kiểm tra dạnh email
    // var_dump(filter_var($email,FILTER_VALIDATE_EMAIL));
    if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        echo "email bạn vừa nhập sai.vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
    $mk=md5($mk);
    //Lưu thông tin thành viên vào bảng
    $sql="INSERT INTO khachhang (maK,tk, mk, email, ten, dc, sdt)
        VALUE ('$maK','$tk', '$mk','$mail', '$ten', '$dc', '$dt')";
 if ($conn->query($sql) === TRUE) {
    $sql="SELECT dc FROM khachhang WHERE tk='$tk'";
   $result=mysqli_query( $conn, $sql);
     $_SESSION['tk']=$tk;
      header("location:index.php");
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
	}
 ?>
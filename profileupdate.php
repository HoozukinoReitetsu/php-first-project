<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cập Nhật Thông Tin</title>
</head>
<body>
	<?php 
	$tk=$_SESSION['tk'];
	include 'admin/include/connect.php';
	$query="SELECT * FRom khachhang WHERE tk='$tk'";
	$result=mysqli_query($conn,$query);
	while ($user=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		# code...
	 ?>
		<form action="" method="post" accept-charset="utf-8" autocomplete="false">
		<div style="text-align: right;margin-right: 50%;">
        Họ Tên: <input type="text" name="ten" value= "<?php echo $user['ten'] ?>">
        <br>
		Địa Chỉ      :<input type="text" name="dc" value= "<?php echo $user['dc'] ?>">
		<br>
		SDT          :<input type="text" name="dt" value= "<?php echo $user['sdt'] ?>">
		<br>
		email        :<input type="text" name="mail" value= "<?php echo $user['email'] ?>">
		<br>
		<input type="submit" value="cập nhật" name="cn" style="margin-right: 10%;">
		<a href="doimk.php">Đổi mk</a>
		<a href="index.php">Về Trang chủ</a>
    </div>
	</form>
<?php } 
	if(isset($_POST['cn'])){
		$dc=$_POST['dc'];
		$dt=$_POST['dt'];
        $ten=$_POST['ten'];
		$mail=$_POST['mail'];
		if(!$ten||!$dc||!$dt||!$mail){
			 echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
        	 exit;
		}
		$mysql="SELECT email From	khachhang where email='$mail'";
    $result=mysqli_query($conn,$mysql);
    $count=mysqli_num_rows($result);
    if ($count>1) {

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
    $sql="UPDATE khachhang SET ten='$ten',dc='$dc',sdt='$dt',email='$mail' WHERE tk='$tk'" ;
 if ($conn->query($sql) === TRUE) {

     $_SESSION['tk']=$tk;
     	header("location:profileupdate.php");
      echo "Cập Nhật Thành Công";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
	}
		?>
</body>
</html>
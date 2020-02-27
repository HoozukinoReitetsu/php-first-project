<?php include("include/top.php");
include 'include/connect.php';
?>
<div id="content">
	<div style="font-size: 40px;">Nhập các thông tin cho điện thoại</div>	
	<form action="" method="post" style="margin-top: 30px;font-size: 20px;display: block;"  enctype="multipart/form-data"	>
		<div class="item"><label>Tên Điện Thoại : </label><input type="text" name="name"></div>
		<div class="item"><label>Giá Điện Thoại : </label><input type="text" name="cost"></div>
		<div class="item"><label>Hãng Điện Thoại : </label><input type="text" name="hang"></div>
		<div class="item"><label >Chọn File ảnh : </label><input type='file' name='img' /></div>
		<input type="submit" name="sub" value="Đăng điện thoại">
</form></div>


<?php 
if(isset($_POST['sub'])){
	$name=$_POST['name'];
	$cost=$_POST['cost'];
	$hang=$_POST['hang'];
	if(!$name||!$cost||!$hang){
		echo "vui lòng nhập đủ thông tin";
		exit();
	}
	else{
		if(!is_numeric($cost)){
			echo '<div style="
    color: red;
    font-size: 20px;
    text-align: center;
    margin: 22px;
">giá nhập vào phải là số không thể là chữ</div>';
			exit();
		}
		else{
	    $maDT=rand(0, 5000);
	    $sql="SELECT maDT FROM dt WHERE maDT='$maDT'";
        $result=mysqli_query( $conn, $sql);
        $count=mysqli_num_rows($result);
        while($count>0){
        $maDT=rand(0, 5000);
        }
		if(isset($_FILES['img'])){
 		move_uploaded_file($_FILES['img']['tmp_name'],"../picture/".$_FILES['img']['name']);
 		$url="picture/".$_FILES['img']['name'];
 		$namef=$_FILES['img']['name'];
		$sql="insert into images(img_url,img_name,maDT) values('$url','$namef','$maDT')";
		mysqli_set_charset($conn, 'UTF8'); 
		$conn->query($sql);
		$sql="INSERT INTO dt(maDT, tenDT, gia, hang) VALUES ('$maDT','$name','$cost','$hang')";
		mysqli_set_charset($conn, 'UTF8'); 
		$conn->query($sql);
		}
	}
	
	}
}

 ?>
 <?php include("include/botton.php"); ?>

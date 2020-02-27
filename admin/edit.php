<?php include 'include/top.php'; 
include 'include/connect.php';
$maDT=$_GET['maDT'];
$sql="SELECT * FROM dt WHERE maDT='$maDT'";
$res=mysqli_query($conn,$sql);
$dt=mysqli_fetch_array($res,MYSQLI_ASSOC);
?>
<div id="content">
	<div style="font-size: 40px;">Nhập các thông tin cho điện thoại</div>	
	<form action="" method="post" style="margin-top: 30px;font-size: 20px;display: block;"  enctype="multipart/form-data"	>
		<div class="item"><label>Tên Điện Thoại : </label><input type="text" name="name" value="<?php echo $dt['tenDT']; ?>"></div>
		<div class="item"><label>Giá Điện Thoại : </label><input type="text" name="cost" value="<?php echo $dt['gia'];?>"></div>
		<div class="item"><label>Hãng Điện Thoại : </label><input type="text" name="hang" value="<?php echo $dt['hang'];
		?>"></div>
		<input type="submit" name="sub" value="Cập Nhật">
</form></div>
<?php 
if(isset($_POST['sub'])){
	$ten=$_POST['name'];
	$gia=$_POST['cost'];
	$hang=$_POST['hang'];
	$sql="UPDATE dt SET tenDT='$ten',gia='$gia',hang='$hang' Where maDT=$maDT";
	if($conn->query($sql)){
	header("location:listDT.php");
	}
	else{
		echo $conn->error;
	}
	
}


include 'include/botton.php'; ?>
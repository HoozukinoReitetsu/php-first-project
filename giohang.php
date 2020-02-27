	<?php session_start(); 
if(!isset($_SESSION['tk'])) header("location:login.php"); 
include 'admin/include/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Giỏ hàng</title>
</head>
<body>
	<table>
		<thead>
			<tr>
				<th>Tên DT</th>
				<th>Số Lượng</th>
				<th>Giá</th>
				<th>Thành Tiền</th>
			</tr>
		</thead>
		<tbody>

			<?php 
				$tk=$_SESSION['tk'];
		$sql="SELECT maK FROM khachhang where tk='$tk'";
		$maK=mysqli_fetch_array(mysqli_query($conn,$sql),MYSQLI_ASSOC);
		$maK=$maK['maK'];

				$sql="SELECT * FROM  ban,dt WHERE ban.maK='$maK' AND ban.maDT=dt.maDT";
				$result=mysqli_query($conn,$sql);
				$tongtien=0;
				while ($sp=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					# code...
				$maK=$sp['maK'];
				 $tt=$sp["sl"]*$sp["gia"];
				 (int)$tongtien+=$tt;
			 ?>
			 	<tr>
				<td><?php echo $sp["tenDT"]; ?></td>
				<td><?php echo $sp["sl"]; ?></td>
				<td><?php echo $sp["gia"]; ?></td>
				<td><?php echo $tt;?></td>
			</tr>

			<?php } ?>
				</tbody>

	</table>
	<div>Tổng Tiền: <?php echo " $tongtien"; ?></div>
	<div style="display: flex;"><a href="index.php">quay về trang chủ</a>
	<form action="" method="post" style="margin-left: 20px">
		<?php  if($tongtien!=0)echo'<input type="submit" name="tt" value="Thanh Toán">'?>
	</form></div>
</body>
</html>
<?php 
if(isset($_POST['tt'])){
			$tk=$_SESSION['tk'];
		$sql="SELECT maK FROM khachhang where tk='$tk'";
		$maK=mysqli_fetch_array(mysqli_query($conn,$sql),MYSQLI_ASSOC);
		$maK=$maK['maK'];

				$sql="SELECT * FROM  ban,dt WHERE ban.maK='$maK' AND ban.maDT=dt.maDT";
				$result=mysqli_query($conn,$sql);
	while ($sp=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					# code...
				$maK=$sp['maK'];
				 $tt=$sp["sl"]*$sp["gia"];
				 $maDT=$sp["maDT"];
				 $sl=$sp["sl"];
	$sql="SELECT maK,maDT FROM hoadon WHERE maK='$maK' AND maDT='$maDT'";
	// var_dump($sql);
	if(mysqli_num_rows(mysqli_query($conn,$sql))==0){
	$sql="INSERT INTO hoadon(maK, maDT, sl) VALUES ($maK,$maDT,$sl) ";
	// var_dump($sql);
	$conn->query($sql);
}
	else{
		$sql="SELECT sl FROM hoadon WHERE maK='$maK' AND maDT='$maDT'";		
		$hd=mysqli_fetch_array($conn->query($sql),MYSQLI_ASSOC);
		$slend=$hd['sl']+$sl;
		$sql="UPDATE hoadon SET sl='$slend' WHERE  maK='$maK' AND maDT='$maDT'";
		$conn->query($sql);
	}

}

	$sql="DELETE FROM ban WHERE maK='$maK'";
	$conn->query($sql);
	header("location:index.php");
}

 ?>
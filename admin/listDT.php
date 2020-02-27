<?php include 'include/top.php';
include 'include/connect.php';
$sql="SELECT * FROM dt";
$res=mysqli_query($conn,$sql);
 ?>
<table>
		<thead>
			<tr>
			<th>Mã điện thoại</th>
			<th>Tên Điện Thoại</th>
			<th>Giá</th>
			<th>Đã Bán</th>
			<th>Sửa</th>
			<th>Xóa</th>
		</tr>
		</thead>
<?php while($dt=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$maDT=$dt['maDT'];
	?>
		<tbody>
			<tr>
				<td><?php echo $dt['maDT'] ?></td>
				<td><?php echo $dt['tenDT'] ?></td>
				<td><?php echo $dt['gia'] ?></td>
				<td><?php echo $dt['slb'] ?></td>
				<td><a href="edit.php?maDT=<?php echo $maDT ?>"><img src="include/picture/edit.png" alt=""></a></td>
				<td><a href="delete.php?ma=<?php echo $maDT ?>"><img src="include/picture/xóa.jpg" alt=""></a></td>
			</tr>
		</tbody>
<?php } ?>
</table>
<?php include 'include/botton.php'; ?>
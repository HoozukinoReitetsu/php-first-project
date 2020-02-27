<?php include 'include/top.php'; 
include 'include/connect.php';
$sql="SELECT * FROM khachhang";
$res=mysqli_query($conn,$sql);
 ?>
<table>
		<thead>
			<tr>
			<th>Mã người dùng</th>
			<th>Tên </th>
			<th>TK</th>
			<th>SDT</th>
			<th>email</th>
			<th>Địa Chỉ</th>
			<th>reset mk</th>
			<th>Xóa</th>
		</tr>
		</thead>
<?php while($user=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$maK=$user['maK'];
	?>
		<tbody>
			<tr>
				<td><?php echo $user['maK'] ?></td>
				<td><?php echo $user['ten'] ?></td>
				<td><?php echo $user['tk'] ?></td>
				<td><?php echo $user['sdt'] ?></td>
				<td><?php echo $user['email'] ?></td>
				<td><?php echo $user['dc'] ?></td>
				<td><a href="editK.php?maK=<?php echo $maK ?>"><img src="include/picture/edit.png" alt=""></a></td>
				<td><a href="deleteK.php?ma=<?php echo $maK ?>"><img src="include/picture/xóa.jpg" alt=""></a></td>
			</tr>
		</tbody>
<?php } ?>
</table>
<?php include 'include/botton.php'; ?>
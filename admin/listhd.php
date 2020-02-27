<?php include 'include/top.php'; 
include 'include/connect.php';
$sql="SELECT * FROM khachhang AS k,hoadon AS hd,dt where hd.maDT=dt.maDT AND hd.maK=k.maK";
$res=mysqli_query($conn,$sql);
 ?>
<table>
		<thead>
			<tr>
			<th>Tên </th>
			<th>SDT</th>
			<th>email</th>
			<th>Địa Chỉ</th>
			<th>Điện Thoại</th>
			<th>SL</th>
			<th>Tiền</th>
			<th>Xóa</th>
		</tr>
		</thead>
<?php while($hd=mysqli_fetch_array($res,MYSQLI_ASSOC)){
	$maDT=$hd['maDT'];
	?>
		<tbody>
			<tr>
				<td><?php echo $hd['ten'] ?></td>
				<td><?php echo $hd['sdt'] ?></td>
				<td><?php echo $hd['email'] ?></td>
				<td><?php echo $hd['dc'] ?></td>
				<td><?php echo $hd['tenDT'] ?></td>
				<td><?php echo $hd['sl'] ?></td>
				<td><?php echo $hd['gia']*$hd['sl'] ?></td>
				<td><a href="deleteHD.php?ma=<?php echo $maDT ?>"><img src="include/picture/xóa.jpg" alt=""></a></td>
			</tr>
		</tbody>
<?php } ?>
</table>
<?php include 'include/botton.php'; ?>
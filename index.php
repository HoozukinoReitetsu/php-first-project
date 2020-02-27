<?php session_start(); 
	include 'admin/include/connect.php';
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Điện Thoại Oline</title>
	<meta charset="UTF-8">
</head>
<link rel="stylesheet" type="text/css" href="style.css"/>
<body>
<div id="ontop" style="display: flex;">
	<div style="margin-left: 48%"><input type="seach" >Seach</div>
	<div style="
    /* float: right; */
    margin-right: auto;
    margin-left: auto;
    display: grid;
">
		<?php if(isset($_SESSION['tk'])){
	 	echo '<a href="profileupdate.php">'.$_SESSION['tk'].'</a>';
	 	echo '<a href="logout.php">Đăng Xuất</a>';
	 } 
	 else{
	 	echo '<a href="login.php">Đăng Nhập</a>';
	 }?>

	</div> 
	<div style="
    /* float: right; */
    margin-right: auto;
    margin-left: auto;
">
<a href="giohang.php">Giỏ hàng</a>
</div>
</div>
<div id="header" >
	<div id="imgtrai">
		<img src="picture/anhr1.jpg" alt="dien thoai hot" >
	</div>
	<div id="imgphai">
		<img src="picture/tải xuống (1).jpg" alt="" class="imgphai">
		<img src="picture/tải xuống (2).jpg" alt="" class="imgphai" style="margin-top: 10px;">
	</div>	
</div>

<div id="menu">
	<div class="item"><a href="http://localhost/ban%20DT?page=0">Trang Chủ</a></div>
	<div class="item"><a href="http://localhost/ban%20DT?hang=oppo&page=0">oppo</a></div>
	<div class="item"><a href="http://localhost/ban%20DT?hang=iphone&page=0">iphone</a></div>
	<div class="item"><a href="http://localhost/ban%20DT?hang=nokia&page=0">nokia</a></div>
	<div class="item"><a href="http://localhost/ban%20DT?hang=samsung&page=0">samsung</a></div>
</div>
<div id="thân">
	<div id="trai">
		 <div style="
    color: red;
    font-size: 18px;
">Các Sản Phẩm Bán Chạy Nhất</div>
		<?php
		$sql="SELECT tenDT FROM dt order by slb limit 0,4";
		mysqli_set_charset($conn, 'UTF8');
		$result=mysqli_query($conn,$sql); 
		while($bc=mysqli_fetch_array($result,MYSQLI_ASSOC)){
			echo ' <div class="item1"><a href="">'.($bc["tenDT"]).'</a></div>';
		}

		?>
	</div>

	<div id="phai" >
		<?php 
		if(isset($_GET['hang'])){
			$hang=$_GET['hang'];
			$sql="SELECT * FROM dt,images where hang='$hang' AND dt.maDT=images.maDT";
			if(isset($_GET['page'])){

				$current_page =  $_GET['page'];
			}
			else $current_page=0;
			$total_records=mysqli_num_rows(mysqli_query($conn,$sql));
			$limit = 4;
			$total_page = ceil($total_records / $limit);
			if ($current_page > $total_page){
   			 $current_page = $total_page;
				}
			else if ($current_page < 1){
   			$current_page = 1;
			}
 
			// Tìm Start
			$start = ($current_page - 1) * $limit;
			mysqli_set_charset($conn, 'UTF8'); 
			$sql="SELECT * FROM dt,images where hang='$hang' AND dt.maDT=images.maDT LIMIT $start, $limit";
			
			$result=mysqli_query($conn,$sql);
			$dem=0;
			while($dt=mysqli_fetch_array($result,MYSQLI_ASSOC)){
				
				if($dem==0||$dem==2){
					echo '<div class="bocngoai">';				
					
				}
				echo '<form method="post" class="item2"><div ><a href="">';
				echo'<input type="hidden" name="id" value='.($dt["maDT"]).'>';
				echo '<img src='.($dt["img_url"]).'>';		
				echo '<div >'.($dt["tenDT"]).'</div>';
				echo '<div>'.($dt["gia"]).'</div>';
				echo '<input type="submit" name="add" value="thêm vào giỏ hàng" style="
   				 background-color: #e80a0aba;
    			border-style: solid;
    height: 43px;
    -webkit-border-radius: 10px;
    font-size: 21px;
    font-family: sans-serif;
">';
				echo '</a></div></form>';
				$dem++;
				
				if($dem==0||$dem==2){
					echo "</div>";
					$dem=0;
				}
			}
			if($dem==1) echo "</div>";
			if($total_records>0){
			echo'<div class="pagination" style="
    color: red;
    height: 43px;
    background-color: bisque;
">';
if ($current_page > 1 && $total_page > 1){
   			  echo '<a href="index.php?hang='.($hang).'&page='.($current_page-1).'" style="color:blue"">Prev</a> ';
}
 
// Lặp khoảng giữa
for ($i = 1; $i <= $total_page; $i++){
    // Nếu là trang hiện tại thì hiển thị thẻ span
    // ngược lại hiển thị thẻ a
    if ($i == $current_page){
        echo '<span style="color:blue">'.$i.'</span> | ';
    }
    else{
        echo '<a href="index.php?hang='.($hang).'&page='.$i.'" style="color:blue">'.$i.'</a> | ';
    }
}
 
// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
if ($current_page < $total_page && $total_page > 1){
    echo '<a href="index.php?hang='.($hang).'&page='.($current_page+1).'">Next</a> | ';
}

echo "</div>";

}
else echo '<div style="color: red;
    text-align: center;
    font-size: 30px;">ko có sản phẩm của hãng này</div>';		
		}
		else{
			$sql="SELECT * FROM dt,images where dt.maDT=images.maDT";
			$total_records=mysqli_num_rows(mysqli_query($conn,$sql));
			if(isset($_GET['page'])){

				$current_page =  $_GET['page'];
			}
			else $current_page=0;
			
			$limit = 4;
			$total_page = ceil($total_records / $limit);
			if ($current_page > $total_page){
   			 $current_page = $total_page;
				}
			else if ($current_page < 1){
   			$current_page = 1;
			}
 
			// Tìm Start
			$start = ($current_page - 1) * $limit;
			$sql="SELECT * FROM dt,images where dt.maDT=images.maDT LIMIT $start, $limit";
			$result=mysqli_query($conn,$sql);
			$dem=0;
			while($dt=mysqli_fetch_array($result,MYSQLI_ASSOC)){
				
				if($dem==0||$dem==2){
					echo '<div class="bocngoai">';				
					
				}
				echo '<form method="post" class="item2"><div ><a href="">';
				echo'<input type="hidden" name="id" value='.($dt["maDT"]).'>';
				echo '<img src='.($dt["img_url"]).'>';		
				echo '<div id="tenDT">'.($dt["tenDT"]).'</div>';
				echo '<div>'.($dt["gia"]).'</div>';
				echo '<input type="submit" name="add" value="thêm vào giỏ hàng" style="
    background-color: #e80a0aba;
    border-style: solid;
    height: 43px;
    -webkit-border-radius: 10px;
    font-size: 21px;
    font-family: sans-serif;
">';
				echo '</a></div></form>';
				$dem++;
				
				if($dem==0||$dem==2){
					echo "</div>";
					$dem=0;
				}
			}
if($dem==1)echo "</div>";
			echo'<div class="pagination" style="
    color: red;
    height: 43px;
    background-color: bisque;
">';
if ($current_page > 1 && $total_page > 1){
   			  echo '<a href="index.php?page='.($current_page-1).'" style="color:blue"">Prev</a> ';
}
 
// Lặp khoảng giữa
for ($i = 1; $i <= $total_page; $i++){
    // Nếu là trang hiện tại thì hiển thị thẻ span
    // ngược lại hiển thị thẻ a
    if ($i == $current_page){
        echo '<span style="color:blue">'.$i.'</span> | ';
    }
    else{
        echo '<a href="index.php?page='.$i.'" style="color:blue">'.$i.'</a> | ';
    }
}
 
// nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
if ($current_page < $total_page && $total_page > 1){
    echo '<a href="index.php?page='.($current_page+1).'">Next</a> | ';
}

echo "</div>";

}
	 ?>
	  
		

	</div>
</div>
<div id="footer">
	Thực Hiện Bởi:Đinh Tiến Thọ
	<br>
	Số Điện Thoại:0354219333
	<br>
	Địa Chỉ:Mỗ Lao-Hà Đông
	<br>
	Chuyên Ngành:Công nghệ Thông Tin(Học Viện Công Nghệ Bưu Chính Viễn Thông)
</div>
</body>
</html>
<?php 
if(isset($_POST["add"])){
	if(isset($_SESSION['tk'])){
		$tk=$_SESSION['tk'];
		$sql="SELECT maK FROM khachhang where tk='$tk'";
		$maK=mysqli_fetch_array(mysqli_query($conn,$sql),MYSQLI_ASSOC);
		$maK=$maK['maK'];
		$maDT=$_POST['id'];
		$sql="SELECT * FROM ban where maK='$maK' AND maDT='$maDT'";
		$count=mysqli_num_rows(mysqli_query($conn,$sql));
		if($count==0){
		$sql="INSERT INTO ban(maK, maDT,sl) VALUES('$maK' ,'$maDT','1')";
		if ($conn->query($sql) === TRUE) {
      echo "thêm thành công";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
		}
		else {
			$sql="SELECT sl FROM ban where maK='$maK' AND maDT='$maDT'";
			$sl=(mysqli_fetch_array(mysqli_query($conn,$sql)));
			$sl=$sl["sl"]+1;
			$sql="UPDATE ban SET sl=$sl where maK='$maK' AND maDT='$maDT'";
		if ($conn->query($sql) === TRUE) {
      echo "thêm thành công";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}
		}
		
	}
	else{
		header("location:login.php");
	}
}


 ?>
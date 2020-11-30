<!-- $ten=urlencode( base64_encode( $ten ) ); -->
<!-- $ten = base64_decode( urldecode( $ten ) ); -->

		<!DOCTYPE html >
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="style/trangchu.css"/>
			<title>Món Ăn Ngon</title>
		</head>
		<body>
			<div class="drapper">
				<div class="top">
					<center><a href="trangchu.php"><image src="imags/logo.jpg" height="150px" width="500px"></a></center>
				</div>  <!-- top -->
				<div class="menu">
					<ul>
						<li><a href="trangchu.php">Trang chủ</a></li>
						<li><a href="top5.php">Danh sách các món hot</a></li>
						<li><a href="yeuthich.php">Danh sách các món yêu thích</a></li>
						<?php
							session_start();
							if (isset($_SESSION['id']) && $_SESSION['id']){
								$tdn=$_SESSION['id'];
								echo "<li id='tdn'> Xin chào, $tdn.</li>";
								echo "<a id='dx' href=xu_li/dangxuat.php>Đăng xuất&nbsp</a>";
							}
							else{
								echo "<a id='dx' href=index.php>Bạn có muốn đăng nhập?&nbsp</a>";
							}
						?>

					</ul>
				</div> <!-- menu -->

					<center>
						<div class="center"><br>
							<center><div class="filter">
								<form action="de_xuat.php" method="POST">
									<br>SEARCH:
									<input type="text" name="tu_khoa" placeholder="Nhập vào từ khoá...sau đó nhấn enter.">
									<button type="submit"><img src="imags/search.png" style="width:15px;height:15px"></button></h3>
									<h3>Filter</h3>
										<h3>Cách thức nấu: &nbsp;
										<select class="select" name="loai">
											<option value="all">Tất cả</option>
											<option value="chien">Chiên</option>
											<option value="xao">Xào</option>
											<option value="nuong">Nướng</option>
											<option value="hap">Hấp</option>
											<option value="kho">Kho</option>
											<option value="nau">Nấu</option>
											<option value="ham">Hầm</option>
										</select>
										&nbsp;Nguyên liệu chính: &nbsp;
										<select class="select" name="nlieu">
											<option value="all">Tất cả</option>
											<option value="heo">Thịt heo</option>
											<option value="bo">Thịt bò</option>
											<option value="ga">Thịt gà</option>
											<option value="haisan">Hải sản</option>
										</select>
										&nbsp;Sắp xếp: &nbsp;
										<select class="select" name="sapxep">
											<option value="giam">Lượt xem giảm dần</option>
											<option value="tang">Lượt xem tăng dần</option>
										</select>
										&nbsp;&nbsp;
								</form>
							</div>
							<br>
							<div class="chitiet">
							<?php
								$ten =  $_GET["ten"];
								$ten = base64_decode( urldecode( $ten ) );
								include('ketnoi.php');
								$conn->query("UPDATE thuc_an SET `luot_xem` = `luot_xem` + 1 WHERE `ten` = '$ten' ");
								$result = $conn->query("SELECT * FROM thuc_an WHERE ten = '$ten'") or die("Lỗi truy vấn");
								$row = $result->fetch_assoc();
								echo  "<table width='900px' height='400px'><tr>";

								echo "<td><center><h1>$ten</h1></center><br><br><h2>&emsp;Nguyên liệu: ".$row['nguyen_lieu_phu']." <br><br>&emsp;Mô tả: ".$row['mo_ta']."

								</h2></td>";
								echo "<td style='width:502px;height:302px;'><br><br><br><center><img src='".$row['hinh_anh']."'height='400' width='500'></td>";
								echo  "</tr></table>";
							 ?>
							</div><br>
						</div>
				<div class="footer">
                    <br>
                    <center ><p></p><a style="text-decoration: none;color:#FF8000" href='#'>Gusto</a> là nơi chia sẻ và đánh giá công thức nấu món ăn ngon, sản phẩm nội trợ cùng bình luận hữu ích. Tham gia để trải nghiệm với cộng đồng yêu thích nấu ăn </p><br><p>Liên hệ với chúng tôi qua&emsp;SDT: 0989859577&emsp;hoặc&emsp;Email: MinhKhangkp@gmail.com</p></center>
                </div>
			</div> <!-- drapper -->
		</body>
		</html>

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
					</div>
					<div class="menu">
						<ul>
							<li><a href="trangchu.php">Trang chủ</a></li>
							<li><a href="top5.php">Danh sách các món hot</a></li>
							<?php 
							session_start();
							if (isset($_SESSION['id']) && $_SESSION['id']){
								echo "<a href=xu_li/dangxuat.php>Đăng xuất&nbsp</a>";
							}
							else{
								echo "<a href=index.php>Bạn có muốn đăng nhập?&nbsp</a>";
							}
						?>
						</ul>
					</div>
					
						<center>
							<div class="center">
								<br>
								<center>
									<div class="filter">
									<form action="de_xuat.php" method="POST">
										<br>SEARCH: 
										<input type="text" name="tu_khoa" placeholder="Nhập vào từ khoá...">
										<button type="submit"><img src="imags/search.png" style="width:15px;height:15px"></button>
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
								<div class="de_xuat">
										<?php
										echo"<h1>";
										include('ketnoi.php');
										$somon1trang = 5;
										$trang = $_GET['trang'];
									 	$from=($trang - 1) * $somon1trang;
									 	if ($trang>0){
									 		$_POST['loai']=$_GET['o1'];
									 		$_POST['nlieu']=$_GET['o2'];
									 		$_POST['sapxep']=$_GET['o3'];
									 		$_POST['tu_khoa']=$_GET['o4'];
									 	}
									 	if (isset($_POST['tu_khoa'])) {
									 		if ($_POST['loai']=='all' && $_POST['nlieu']=='all' ){
												if($_POST['sapxep']==tang){
													$result = $conn->query("SELECT * FROM thuc_an where lower(ten) like '%".$_POST[tu_khoa]."%' order by luot_xem");
												}
												else $result = $conn->query("SELECT * FROM thuc_an where lower(ten) like '%".$_POST[tu_khoa]."%' order by luot_xem DESC");
											}
											else if($_POST['nlieu']=='all' || $_POST['loai']=='all'){
												if($_POST['sapxep']==tang){
													$result = $conn->query("SELECT * FROM thuc_an WHERE (lower(ten) like '%".$_POST[tu_khoa]."%') and (loai='".$_POST[loai]."' or nguyen_lieu = '".$_POST[nlieu]."') order by luot_xem");
												}
												else $result = $conn->query("SELECT * FROM thuc_an WHERE (lower(ten) like '%".$_POST[tu_khoa]."%') and (loai='".$_POST[loai]."' or nguyen_lieu = '".$_POST[nlieu]."') order by luot_xem DESC");
											}
											else {
												if($_POST['sapxep']==tang){
													$result = $conn->query("SELECT * FROM thuc_an WHERE (lower(ten) like '%".$_POST[tu_khoa]."%') and loai='".$_POST[loai]."' and nguyen_lieu = '".$_POST[nlieu]."' order by luot_xem");
												}
												else $result = $conn->query("SELECT * FROM thuc_an WHERE (lower(ten) like '%".$_POST[tu_khoa]."%') and loai='".$_POST[loai]."' and nguyen_lieu = '".$_POST[nlieu]."' order by luot_xem DESC");
											}
									 	}
										echo "<table width='995px' border='1'>"; 
										echo "<tr><th>THÔNG TIN MÓN ĂN</th><th>MÓN ĂN</th></tr>"; 
										$i=-1;$u=0;
										while ($row = $result->fetch_assoc()){
											$i++;
											if($i<($trang-1)*5||$u>4){ //hiển thị 5 món với số trang tương ứng.
												continue;
											}
											$conn->query("UPDATE thuc_an SET `luot_xem` = `luot_xem` + 1 WHERE `ten` = '" . $row["ten"] . "' ");
													$ten=$row["ten"];
													$luot_xem=$row["luot_xem"];
													echo "<td><center>$ten<br>Số lượt xem: $luot_xem<br>";
													$ten=urlencode( base64_encode( $ten ) );
													echo "<br><a href='chitiet.php?ten=$ten'>Xem chi tiết...</a></td>";
													echo "<td style='width:502px;height:302px;'><center><img src='".$row['hinh_anh']."'height='300' width='500'>";
													$ten2=$row["ten"];
													$id=$_SESSION['id'];
													$result2 = $conn->query("SELECT * FROM thich where id='$id' and ten='$ten2'");
													if($result2->num_rows==0){
														echo "<a href = 'xu_li/like.php?ten=$ten'><img src='imags/dislike.jpg' style='width:30px;height:30px'></a>";
													}
													else 
														echo "<a href = 'xu_li/dislike.php?ten=$ten'><img src='imags/like.jpg' style='width:30px;height:30px'></a>";

													echo "</td></tr>";
											$u++;
										}
										echo "</table>";
										$conn->close(); 
										?>
										</div>
										<?php 
											$tongso_mon = $result->num_rows;
											$sotrang = ceil($tongso_mon/$somon1trang);
											echo "Tìm được $tongso_mon kết quả.<br>";
											if($sotrang>1){
												for($i=1; $i<=$sotrang; $i++){
													if($trang==null) $trang=1;
													if($trang==$i){
														echo "<a href='de_xuat.php?trang=$i&o1=$_POST[loai]&o2=$_POST[nlieu]&o3=$_POST[sapxep]&o4=$_POST[tu_khoa]' style='color:red'>Trang $i</a>&emsp;";
													}
													else echo "<a href='de_xuat.php?trang=$i&o1=$_POST[loai]&o2=$_POST[nlieu]&o3=$_POST[sapxep]&o4=$_POST[tu_khoa]'>Trang $i</a>&emsp;";
												}
											}
										 ?>
								</div>
					<div class="footer">
					<br>
						<center><h3>Hotline: 0123456789&emsp;Gmail: foodsearch@abc@gmail.com.vn </h3><br><p>CÔNG TY TNHH MỘT THÀNH VIÊN FOODSEARCH</p></center>
					</div>
				</div>
			</body>
			</html>




















			//////////////////////////////////////////////////////

			
		<!DOCTYPE html >
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="style/trangchu.css"/>
			<title>REVIEW</title>
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
						<?php 
							session_start();
							if (isset($_SESSION['id']) && $_SESSION['id']){
								echo "<a href=xu_li/dangxuat.php>Đăng xuất&nbsp</a>";
							}
							else{
								echo "<a href=index.php>Bạn có muốn đăng nhập?&nbsp</a>";
							}
						?>
						
					</ul>
				</div> <!-- menu -->
				
					<center>
						<div class="center"><br>
							<center><div class="filter">
								<form action="de_xuat.php" method="POST">
									<br>SEARCH: 
									<input type="text" name="tu_khoa" placeholder="Nhập vào từ khoá...">
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
							<div class="de_xuat">
									<?php
									include('ketnoi.php');
									echo"<h1>";
									$somon1trang = 5;
									$trang = $_GET['trang'];
								 	$from=($trang - 1) * $somon1trang	;
									$result = $conn->query("SELECT * FROM thuc_an");
									echo "<table width='995px' border='1'>"; 
									echo "<tr><th>THÔNG TIN MÓN ĂN</th><th>MÓN ĂN</th></tr>"; 
									$i=-1;$u=0;
									while ($row = $result->fetch_assoc()){
										$i++;
										if($i<($trang-1)*5||$u>4){ //hiển thị 5 món với số trang tương ứng.
											continue;
										}
										echo "<tr>";
													$ten=$row["ten"];
													$luot_xem=$row["luot_xem"];
													echo "<td><center>$ten<br>Số lượt xem: $luot_xem<br>";
													$ten=urlencode( base64_encode( $ten ) );
													echo "<br><a href='chitiet.php?ten=$ten'>Xem chi tiết...</a></td>";
													echo "<td style='width:502px;height:302px;'><center><img src='".$row['hinh_anh']."'height='300' width='500'>";
													$ten2=$row["ten"];
													$id=$_SESSION['id'];
													$result2 = $conn->query("SELECT * FROM thich where id='$id' and ten='$ten2'");
													if($result2->num_rows==0){
														echo "<a href = 'xu_li/like.php?ten=$ten'><img src='imags/dislike.jpg' style='width:30px;height:30px'></a>";
													}
													else 
														echo "<a href = 'xu_li/dislike.php?ten=$ten'><img src='imags/like.jpg' style='width:30px;height:30px'></a>";

													echo "</td></tr>";
										$u++;
									}
									echo "</table>";
									$conn->close(); 
									?>
									</div>
									<?php 
										$tongso_mon = $result->num_rows;
										$sotrang = ceil($tongso_mon/$somon1trang);
										for($i=1; $i<=$sotrang; $i++){
											if($trang==null) $trang=1;
											if($trang==$i){
												echo "<a href='trangchu.php?trang=$i'style='color:red'>Trang $i</a>&emsp;";
											}
											else echo "<a href='trangchu.php?trang=$i'>Trang $i</a>&emsp;";
										}
									 ?>
						</div>
				<div class="footer">
					<br>
					<center><h3>Hotline: 0123456789&emsp;Gmail: foodsearch@abc@gmail.com.vn </h3><br><p>CÔNG TY TNHH MỘT THÀNH VIÊN FOODSEARCH</p></center>
				</div>
			</div> <!-- drapper -->
		</body>
		</html>
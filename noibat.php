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

					<?php
					session_start();
					if (isset($_SESSION['id']) && $_SESSION['id']){
						$tdn=$_SESSION['id'];
						echo "<li id='tdn'>Chào mừng $tdn đến với Gusto | Email: Gusto@gmail.com</li>";
						echo "<a id='dx' href=xu_li/dangxuat.php><li>&ensp;<image id=image src=imags/dang_xuat.png> Đăng xuất</li></a>";
					}
					else{
						echo "<li>Chào mừng $tdn đến với Gusto | Email: Gusto@gmail.com</li>";
						echo "<a id='dx' href=index.php><li><image id=image src=imags/dang_nhap.png> Đăng nhập</li></a>";
						echo "<a id='dx' href=index.php><li>&ensp;<image id=image src=imags/dang_ki.png> Đăng kí</li></a>";
					}
					?>

				</ul>
			</div> <!-- menu -->
			<div class='trang_chu'><a id="menu" href="trangchu.php"><li>TRANG CHỦ</li></a></div>
            <div class='yeu_thich'><a id="menu" href="yeuthich.php"><li>YÊU THÍCH</li></a></div>
            <div class="noi_bat"><a id="menu" href="noibat.php"><li>NỔI BẬT</li></a></div>
			<div class="center_left">
				<center><h1>HOT</h1></center>
				<div class="slides">
					<a href="#"><img class='slide' src="imags/bo_kho_rung.jpg" height="190px" width="300px"></a>
					<a href="#"><img class='slide' src="imags/ca_kho_to.jpg" height="190px" width="300px"></a>
					<a href="#"><img class='slide' src="imags/bo_xao_nam.jpg" height="190px" width="300px"></a>
					<center><span class="btn" onclick="currentSlide(0)"></span>
						<span class="btn" onclick="currentSlide(1)"></span>
						<span class="btn" onclick="currentSlide(2)"></span></center>
						<script type="text/javascript" src="js/slide.js"></script>
					</div>
					<div class = 'danh_muc'>
                        <div class="cach_thuc_nau">
                            <button class="btn_dm"><strong>CÁCH THỨC NẤU +</strong>
                                <div class="danh_muc_con1">
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_dm"><strong>NGUYÊN LIỆU CHÍNH +</strong>
                                <div class="danh_muc_con2">
                                    <a href="#">Cá</a>
                                    <a href="#">Gà</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                    <a href="#">Chiên</a>
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                        <div class="nguyen_lieu">
                            <button class="btn_none"><strong></strong>
                                <div class="">
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
				<div class="center_right">
					<center><h1>FILTER</h1></center>
					<div class="filter">
						<form action="de_xuat.php" method="GET">
							<br>SEARCH:
							<input type="text" name="tu_khoa" placeholder="Nhập vào từ khoá...sau đó nhấn enter."><br><br>
							Cách thức nấu: &nbsp;
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
							<br>
							<button type="submit"><img src="imags/search.png" style="width:15px;height:15px"></button>
						</form>
					</div>
					<div class="mon_an">
						<?php
						include('ketnoi.php');
						$somon1trang = 10;
						$trang = $_GET['trang'];
						$from=($trang - 1) * $somon1trang ;
						$result = $conn->query("SELECT * FROM thuc_an order by luot_xem DESC limit 10") or die("Lỗi truy vấn");
						echo "<table class='table' cellspacing='3' >";
						$i=-1;$u=0;
						echo "<tr>";
						while ($row = $result->fetch_assoc()){
                        if ($u==5) {
                        	echo "<tr>";
                        }
                        $ten=$row["ten"];
                        $luot_xem=$row["luot_xem"];
                        echo "<td><a href='chitiet.php?ten=$ten'>";
                        echo "<center><img src='".$row['hinh_anh']."'height='150' width='225'>";
                        echo "<center>$ten<br>Số lượt xem: $luot_xem<br>";
                        $ten=urlencode( base64_encode( $ten ) );
                        $ten2=$row["ten"];
                        $id=$_SESSION['id'];
                        $result2 = $conn->query("SELECT * FROM thich where id='$id' and ten='$ten2'") ;
                        $result3 = $conn->query("SELECT * FROM thich where ten='$ten2'");
                        if($result2->num_rows==0){
                        	echo "<a href = 'xu_li/like.php?ten=$ten'><img src='imags/dislike.jpg' style='width:20px;height:20px; margin-top:5px;'></a>";
                        	echo "<h5>".$result3->num_rows." người     </h5>";
                        }
                        else {
                        	echo "<a href = 'xu_li/dislike.php?ten=$ten'><img src='imags/like.jpg' style='width:20px;height:20px; margin-top:5px;'></a>";
                        	if($result3->num_rows>1)
                        		echo "<h5>Bạn và ".($result3->num_rows-1)." người khác thích món này</h5>";
                        	else echo "<h5>Bạn đã thích món này</h5>";
                        }


                        echo "</a></td>";

                        $u++;
                        if ($u==5) {
                        	echo "</tr>";
                        }
                    }
                    echo "</tr></table>";
                    $conn->close();
                    ?>
                </div>
            </div>
            <div class="footer">
                    <br>
                    <center ><p></p><a style="text-decoration: none;color:#FF8000" href='#'>Gusto</a> là nơi chia sẻ và đánh giá công thức nấu món ăn ngon, sản phẩm nội trợ cùng bình luận hữu ích. Tham gia để trải nghiệm với cộng đồng yêu thích nấu ăn </p><br><p>Liên hệ với chúng tôi qua&emsp;SDT: 0989859577&emsp;hoặc&emsp;Email: MinhKhangkp@gmail.com</p></center>
                </div>  
        </div> <!-- drapper -->
    </body>
    </html>

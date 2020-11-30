<?php
	session_start();
	if (isset($_SESSION['id']) && $_SESSION['id']){
		$id = $_SESSION['id'];
		include('ketnoi.php');
		$result = $conn->query("SELECT chucvu FROM tai_khoan where id = '$id'");
		$row = $result->fetch_assoc();
		if($row["chucvu"]=='user'){
			header("location: trangchu.php");
		}
		else if($row["chucvu"]=='admin') {
			header("location: admin.php?trang='1'");
		}
	}
	if(isset($_POST['dangnhap'])){
		include('ketnoi.php');
		$id  = addslashes($_POST['txtid']);
		$pass  = addslashes($_POST['txtpass']);
		if(!$id||!$pass){
			echo "Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.<a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
		$result = $conn->query("SELECT id,pass FROM tai_khoan where id='$id'");
		if($result->num_rows==0){
			echo "Tên đăng nhập không tồn tại.<a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
		$row = $result->fetch_assoc();
		if ($pass != $row['pass']) {
        	echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
       		exit;
   		}

		$_SESSION['id'] = $id;
		if($row['pass']=="admin"){

			echo "Xin chào " . $id . ". Bạn đã đăng nhập thành công. <a href='admin.php'>Về trang chủ</a>";
		}
		else {
			echo "Xin chào " . $id . ". Bạn đã đăng nhập thành công. <a href='trangchu.php'>Về trang chủ</a>";
		}
    	die();
	}
	if(isset($_POST['dangki'])){
		include('ketnoi.php');
		$hoten = addslashes($_POST['txthoten']);
		$id  = addslashes($_POST['txtid']);
		$pass1  = addslashes($_POST['txtpass1']);
		$pass2  = addslashes($_POST['txtpass2']);
		$sdt = addslashes($_POST['txtsdt']);
		$gioitinh = addslashes($_POST['txtgioitinh']);
		if(!$id||!$pass1||!$pass2||!$sdt||!$gioitinh){
			echo "Vui lòng nhập đầy đủ thông tin.<a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
		$result = $conn->query("SELECT id FROM tai_khoan WHERE id='$id'");
		if ($result->num_rows > 0){
	        echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
	        exit;
   		}
   		if($pass1!=$pass2){
   			echo "Mật khẩu không khớp. Vui lòng nhập lại mật khẩu. <a href='javascript: history.go(-1)'>Trở lại</a>";
	        exit;
   		}
   		$result = $conn->query("SELECT sdt FROM tai_khoan WHERE sdt='$sdt'");
   		if ($result->num_rows > 0){
	        echo "Số điện thoại này đã có người dùng. Vui lòng chọn số điện thoại khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
	        exit;
   		}
   		if (!preg_match("/^[0-9]{10,11}+$/", $sdt)){
   			echo "Số điện thoại không hợp lệ. Vui long nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
            exit;
   		}
   		$result = $conn->query("INSERT INTO tai_khoan (
            id,
            pass,
            hoten,
            sdt,
            gioitinh,
            chucvu
        )
        VALUE (
            '{$id}',
            '{$pass1}',
            '{$hoten}',
            '{$sdt}',
            '{$gioitinh}',
            'user'
        )"
    	);

   		if ($result){
        	echo "Quá trình đăng ký thành công. <a href='trangchu.php'>Về trang chủ</a>";
        	exit;
   		}
   		else{
        	echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='dangky.php'>Thử lại</a>";
        	exit;
   		}
	}
 ?>


		<!DOCTYPE html >
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<link rel="stylesheet" type="text/css" href="style/index.css"/>
			<title>REVIEW</title>
		</head>
		<body>
			<div class="drapper">
				<div class="top">
					<div class="logo">&emsp;&emsp;&emsp;&emsp;<a href="index.php"><input type="image" src="imags/logo.jpg" height="150px" width="330px" /></a> </div>
					<div class="dangnhap">
						<br><br><br>
						<form action="	index.php" method="POST">
						USERNAME &emsp;&emsp;&emsp;&emsp;&emsp;&ensp;&emsp;
						PASSWORD <br>
						<input type="text" name="txtid">&emsp;&emsp;
						<input type="password" name="txtpass">&emsp;
						<input type="submit" value=" ĐĂNG NHẬP " name="dangnhap">
						</form>
					</div>
				</div>
				<center><div class="backgr"><br><br>
					<div class="dangki"><br><br><h2>TẠO TÀI KHOẢN MỚI</h2><br><br><br>
						<form action="index.php" method="POST">
							HỌ TÊN :&emsp;&emsp;&emsp;&ensp;&ensp; <input type="text" name="txthoten"><br><br>
							USERNAME :&emsp;&emsp; <input type="text" name="txtid"><br><br>
							PASSWORD :&emsp;&emsp; <input type="password" name="txtpass1"><br><br>
							PASSWORD :&emsp;&emsp; <input type="password" name="txtpass2"><br><br>
							SỐ ĐT :&emsp; &emsp; &emsp;&ensp;&ensp; <input type="text" name="txtsdt"><br><br>
							GIỚI TÍNH : &emsp; &emsp;&emsp;&emsp;<input type="radio" name="txtgioitinh" value="nam">Nam:&emsp;&emsp;<input type="radio" name="txtgioitinh" value="nu"> Nữ &emsp;<br><br><br>
							<input type="reset" value=" NHẬP LẠI "> &emsp;
				&emsp;			<input type="submit" value=" ĐĂNG KÍ " name="dangki">

						</form>
					</div>
				</div></center>
				<div class="footer">
					<br>
					<center ><p></p><a style="text-decoration: none;color:#FF8000" href='#'>Gusto</a> là nơi chia sẻ và đánh giá công thức nấu món ăn ngon, sản phẩm nội trợ cùng bình luận hữu ích. Tham gia để trải nghiệm với cộng đồng yêu thích nấu ăn </p><br><p>Liên hệ với chúng tôi qua&emsp; SDT: 0989859577&emsp; hoặc&emsp; Email: MinhKhangkp@gmail.com</p></center>
				</div>
			</div> <!-- drapper -->
		</body>
		</html>

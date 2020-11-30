<?php session_start();
	$id=$_SESSION['id'];
	$ten =  $_GET["ten"];
	$ten = base64_decode( urldecode( $ten ) );
	include('../ketnoi.php');
	$result=$conn->query("INSERT INTO thich(id,ten) values ('$id','$ten')") or die("Lỗi truy vấn");
	if($result){
		echo "<script>
			history.back();
		</script>";
	}
 ?>
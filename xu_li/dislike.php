<?php session_start();
	$id=$_SESSION['id'];
	$ten =  $_GET["ten"];
	$ten = base64_decode( urldecode( $ten ) );
	include('../ketnoi.php');
	$result=$conn->query("DELETE FROM thich WHERE id = '$id' and ten = '$ten'") or die("Lỗi truy vấn");
	if($result){
		echo "<script>
			history.back();
		</script>";
	}
 ?>
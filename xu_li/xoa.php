<?php
include('../ketnoi.php');
if($_GET['op']=='tai_khoan'){
	$id = $_GET['id'];
	$conn->query("DELETE FROM thich WHERE id = '$id'");
	$conn->query("DELETE FROM tai_khoan WHERE id = '$id'");
	header("location: ../admin.php?op=tai_khoan");
}
else{
	$ten = $_GET['ten'];
	$ten = base64_decode( urldecode( $ten ) );
	$conn->query("DELETE FROM thich WHERE ten = '$ten'");
	$result=$conn->query("SELECT hinh_anh from thuc_an where ten = '$ten'");
	$row = $result->fetch_assoc();
	$anh_xoa="../".$row["hinh_anh"];
	if($result) {
		unlink($anh_xoa);
		$conn->query("DELETE FROM thuc_an WHERE ten = '$ten'");
		header("location: ../admin.php");
	}
}
?>



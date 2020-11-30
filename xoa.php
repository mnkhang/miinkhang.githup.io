<?php 

if($_GET['op']=='tai_khoan')
	{$id = $_GET['id'];
	echo "Bạn có muốn xóa tài khoản ".$id."? <a href='xu_li/xoa.php?op=tai_khoan&id=$id'>Có</a>, <a href='javascript: history.go(-1)'>Không</a>";
}
else {
	$ten = $_GET['ten'];
	$ten1 = base64_decode( urldecode( $ten ) );
	echo "Bạn có muốn xóa món  ".$ten1."? <a href='xu_li/xoa.php?ten=$ten'> Có </a>, <a href='javascript: history.go(-1)'>Không</a>";
}
 ?>
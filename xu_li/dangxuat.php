<?php session_start(); 
 
if (isset($_SESSION['id'])){
    unset($_SESSION['id']); // xóa session login
}
?>
Đăng xuất  thành công.
<a href="../index.php">Trở lại</a>
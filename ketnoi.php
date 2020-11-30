<?php 
error_reporting(E_ERROR); //bỏ thông báo lỗi nhỏ
									// tao ket noi den server mysql 
									$conn = new mysqli("127.0.0.1", "root", "", "de_xuat");
									// Check connection
									if ($conn->connect_error) { 
										die("Connection failed: " . $conn->connect_error);
										}
 ?>
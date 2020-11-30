

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
                                <form action="de_xuat.php" method="GET">
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
                            <div class="de_xuat">
                                    <?php
                                    include('ketnoi.php');
                                    echo"<h1>";
                                    $somon1trang = 5;
                                    $trang = $_GET['trang'];
                                    $from=($trang - 1) * $somon1trang   ;
                                    $result = $conn->query("SELECT * FROM thuc_an th, thich t where id='$tdn' and th.ten=t.ten");
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
                                                    $result2 = $conn->query("SELECT * FROM thich where id='$id' and ten='$ten2'") ;
                                                    $result3 = $conn->query("SELECT * FROM thich where ten='$ten2'");
                                                    if($result2->num_rows==0){
                                                        echo "<a href = 'xu_li/like.php?ten=$ten'><img src='imags/dislike.jpg' style='width:30px;height:30px'></a>";
                                                    echo "<h6>".$result3->num_rows." người yêu thích</h6>";
                                                    }
                                                    else {
                                                        echo "<a href = 'xu_li/dislike.php?ten=$ten'><img src='imags/like.jpg' style='width:30px;height:30px'></a>";
                                                        if($result3->num_rows>1)
                                                            echo "<h6>Bạn và ".($result3->num_rows-1)." người khác yêu thích món này</h6>";
                                                        else echo "<h6>Bạn đã yêu thích món này</h6>";
                                                    }


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
                                                echo "<a href='yeuthich.php?trang=$i'style='color:red'>Trang $i</a>&emsp;";
                                            }
                                            else echo "<a href='yeuthich.php?trang=$i'>Trang $i</a>&emsp;";
                                        }
                                     ?>
                        </div>
               <div class="footer">
                    <br>
                    <center ><p></p><a style="text-decoration: none;color:#FF8000" href='#'>Gusto</a> là nơi chia sẻ và đánh giá công thức nấu món ăn ngon, sản phẩm nội trợ cùng bình luận hữu ích. Tham gia để trải nghiệm với cộng đồng yêu thích nấu ăn </p><br><p>Liên hệ với chúng tôi qua&emsp;SDT: &emsp;hoặc&emsp;Email: MinhKhangkp@gmail.com</p></center>
                </div>
            </div> <!-- drapper -->
        </body>
        </html>


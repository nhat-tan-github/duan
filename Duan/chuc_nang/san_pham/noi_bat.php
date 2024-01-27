<br><br>
Sản phẩm nổi bật <br><br>
<center>
    <?php
        // Kết nối cơ sở dữ liệu bằng MySQLi
        $mysqli = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

        // Kiểm tra kết nối
        if ($mysqli->connect_error) {
            die("Kết nối không thành công: " . $mysqli->connect_error);
        }

        // Truy vấn sử dụng MySQLi
        $query = "SELECT id, ten, hinh_anh FROM san_pham WHERE noi_bat='co' ORDER BY id DESC LIMIT 0,3";
        $result = $mysqli->query($query);

        // Lặp qua kết quả
        while ($row = $result->fetch_assoc()) {
            $link_anh = "chuc_nang/hinh_anh/san_pham/" . $row['hinh_anh'];
            $link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $row['id'];
            
            // Hiển thị thông tin sản phẩm
            echo "<a href='$link_chi_tiet' >";
                echo "<img src='$link_anh' width='100px' >";
            echo "</a>";
            echo "<br><br>";
            echo $row['ten'];
            echo "<br>";
            echo "<br>";
        }

        // Đóng kết nối
        $mysqli->close();
    ?>
</center>

<br><br>
Sản phẩm mới <br><br>
<center>
    <?php
        $mysqli = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        $query = "SELECT id, ten, hinh_anh FROM san_pham ORDER BY id DESC LIMIT 0,3";
        $result = $mysqli->query($query);

        while($row = $result->fetch_assoc()) {
            $link_anh = "chuc_nang/hinh_anh/san_pham/" . $row['hinh_anh'];
            $link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $row['id'];

            echo "<a href='$link_chi_tiet'>";
                echo "<img src='$link_anh' width='100px'>";
            echo "</a>";
            echo "<br><br>";
            echo $row['ten'];
            echo "<br>";
            echo "<br>";
        }

        // Close connection
        $mysqli->close();
    ?>
</center>

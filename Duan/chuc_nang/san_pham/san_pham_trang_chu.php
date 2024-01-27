<br><br>
Sản phẩm của chúng tôi
<br><br>
<?php
    $conn = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    $tv = "SELECT id, ten, gia, hinh_anh, thuoc_menu FROM san_pham WHERE trang_chu='co' ORDER BY sap_xep_trang_chu DESC LIMIT 0,15";
    $result = $conn->query($tv);

    echo "<table>";
    while ($tv_2 = $result->fetch_assoc()) {
        echo "<tr>";
        for ($i = 1; $i <= 3; $i++) {
            echo "<td align='center' width='215px' valign='top' >";
            if ($tv_2 != false) {
                $link_anh = "chuc_nang/hinh_anh/san_pham/" . $tv_2['hinh_anh'];
                $link_chi_tiet = "?thamso=chi_tiet_san_pham&id=" . $tv_2['id'];

                echo "<a href='$link_chi_tiet' >";
                echo "<img src='$link_anh' width='150px' >";
                echo "</a>";
                echo "<br>";
                echo "<a href='$link_chi_tiet' >";
                echo $tv_2['ten'];
                echo "</a>";
                echo "<br>";
                echo $tv_2['gia'];
                echo "<br>";
                echo "<br>";
            } else {
                echo "&nbsp;";
            }
            echo "</td>";
            if ($i != 3) {
                $tv_2 = $result->fetch_assoc();
            }
        }
        echo "</tr>";
    }
    echo "</table>";

    // Đóng kết nối
    $conn->close();
?>

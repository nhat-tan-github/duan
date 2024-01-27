<?php
    $so_du_lieu = 15;

    // Tạo kết nối
    $servername = "localhost";
    $username = "admin01";
    $password = "123admin123";
    $dbname = "ban_hang";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy tổng số dữ liệu
    $tv = "SELECT COUNT(*) FROM san_pham";
    $tv_1 = $conn->query($tv);
    $tv_2 = $tv_1->fetch_array();
    $so_trang = ceil($tv_2[0] / $so_du_lieu);

    // Xác định vị trí bắt đầu
    if (!isset($_GET['trang'])) {
        $vtbd = 0;
    } else {
        $vtbd = ($_GET['trang'] - 1) * $so_du_lieu;
    }

    // Lấy dữ liệu trang hiện tại
    $tv = "SELECT id, ten, gia, hinh_anh, thuoc_menu FROM san_pham ORDER BY id DESC LIMIT $vtbd, $so_du_lieu";
    $tv_1 = $conn->query($tv);

    echo "<table>";
    while ($tv_2 = $tv_1->fetch_array()) {
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
                $tv_2 = $tv_1->fetch_array();
            }
        }
        echo "</tr>";
    }

    echo "<tr>";
    echo "<td colspan='3' align='center' >";
    echo "<div class='phan_trang' >";
    for ($i = 1; $i <= $so_trang; $i++) {
        $link = "?thamso=xuat_san_pham_2&trang=" . $i;
        echo "<a href='$link' >";
        echo $i;
        echo " ";
        echo "</a>";
    }
    echo "</div>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";

    // Đóng kết nối
    $conn->close();
?>

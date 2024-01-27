<?php
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

    $tv = "SELECT id, ten, loai_menu FROM menu_ngang ORDER BY id";
    $tv_1 = $conn->query($tv);

    echo "<div class='menu_ngang'>";
    echo "<a href='index.php'>Trang chủ</a>";

    while ($tv_2 = $tv_1->fetch_assoc()) {
        if ($tv_2['loai_menu'] == "") {
            $link_menu = "?thamso=xuat_mot_tin&id=" . $tv_2['id'];
        } elseif ($tv_2['loai_menu'] == "san_pham") {
            $link_menu = "?thamso=xuat_san_pham_2";
        }

        echo "<a href='$link_menu'>";
        echo $tv_2['ten'];
        echo "</a>";
    }

    echo "</div>";

    // Đóng kết nối
    $conn->close();
?>

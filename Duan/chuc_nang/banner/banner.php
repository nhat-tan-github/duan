<?php
    $conn = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    $tv = "SELECT * FROM banner LIMIT 0,1";
    $result = $conn->query($tv);

    if ($result->num_rows > 0) {
        $tv_2 = $result->fetch_assoc();
        $link_hinh = "chuc_nang/hinh_anh/banner/" . $tv_2['hinh'];
        echo "<img src='" . $link_hinh . "' width='" . $tv_2['rong'] . "' height='" . $tv_2['cao'] . "' >";
    }

    // Đóng kết nối
    $conn->close();
?>

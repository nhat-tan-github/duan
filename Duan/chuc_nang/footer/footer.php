<?php
    $conn = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    $tv = "SELECT * FROM footer LIMIT 0,1";
    $result = $conn->query($tv);

    if ($result->num_rows > 0) {
        $tv_2 = $result->fetch_assoc();
        echo $tv_2['html'];
    }

    // Đóng kết nối
    $conn->close();
?>

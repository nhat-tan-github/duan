<?php
    $id = $_GET['id'];

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

    $tv = "SELECT * FROM menu_ngang WHERE id='$id'";
    $tv_1 = $conn->query($tv);

    // Kiểm tra xem có dữ liệu hay không
    if ($tv_1->num_rows > 0) {
        $tv_2 = $tv_1->fetch_assoc();
        echo "<h1>";
        echo $tv_2['ten'];
        echo "</h1>";
        echo $tv_2['noi_dung'];
    } else {
        echo "Không tìm thấy dữ liệu";
    }

    // Đóng kết nối
    $conn->close();
?>

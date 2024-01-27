<?php
    $servername = "localhost";
    $username = "admin01";
    $password = "123admin123";
    $dbname = "ban_hang";

    // Tạo kết nối
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $tv = "SELECT * FROM menu_doc ORDER BY id";
    $tv_1 = $conn->query($tv);

    echo "<div class='menu_doc'>";
    while ($tv_2 = $tv_1->fetch_assoc()) {
        $id = $tv_2['id'];
        $ten = $tv_2['ten']; // Giả sử 'name' là tên cột đúng

        // Xây dựng đường link với URL encoding đúng
        $link = "?thamso=xuat_san_pham&id=" . urlencode($id);

        echo "<a href='$link'>";
        echo $ten;
        echo "</a>";
    }
    echo "</div>";

    // Đóng kết nối
    $conn->close();
?>

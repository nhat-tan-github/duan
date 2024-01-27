<br>Quảng cáo <br><br>
<?php
    $conn = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    $vi_tri = 'trai';
    $tv = "SELECT html FROM quang_cao WHERE vi_tri='$vi_tri'";
    $result = $conn->query($tv);

    if ($result->num_rows > 0) {
        // Lấy dữ liệu từ cơ sở dữ liệu
        $tv_2 = $result->fetch_assoc();
        echo $tv_2['html'];
    } else {
        echo "Không có quảng cáo.";
    }

    // Đóng kết nối
    $conn->close();
?>

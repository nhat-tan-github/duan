<?php
session_start();

if (isset($_SESSION['id_them_vao_gio'])) {
    $ten_nguoi_mua = trim($_POST['ten_nguoi_mua']);
    $email = trim($_POST['email']);
    $dien_thoai = trim($_POST['dien_thoai']);
    $dia_chi = trim(nl2br($_POST['dia_chi']));
    $noi_dung = nl2br($_POST['noi_dung']);

    if ($ten_nguoi_mua != "" && $dien_thoai != "" && $dia_chi != "") {
        $hang_duoc_mua = "";
        for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
            $hang_duoc_mua .= $_SESSION['id_them_vao_gio'][$i] . "[|||]" . $_SESSION['sl_them_vao_gio'][$i] . "[|||||]";
        }

        $mysqli = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

        // Check connection
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        }

        // Use prepared statement to prevent SQL injection
        $query = $mysqli->prepare("INSERT INTO hoa_don (ten_nguoi_mua, email, dia_chi, dien_thoai, noi_dung, hang_duoc_mua) VALUES (?, ?, ?, ?, ?, ?)");

        $query->bind_param("ssssss", $ten_nguoi_mua, $email, $dia_chi, $dien_thoai, $noi_dung, $hang_duoc_mua);
        
        // Execute the query
        if ($query->execute()) {
            // Query executed successfully
            unset($_SESSION['id_them_vao_gio']);
            unset($_SESSION['sl_them_vao_gio']);
            thong_bao_html_roi_chuyen_trang("Cảm ơn bạn đã mua hàng tại website chúng tôi", "index.php");
        } else {
            // Query failed
            echo "Error: " . $query->error;
        }

        // Close prepared statement and connection
        $query->close();
        $mysqli->close();
    } else {
        thong_bao_html("Không được bỏ trống tên người mua, điện thoại, địa chỉ");
        trang_truoc();
        exit();
    }
}
?>

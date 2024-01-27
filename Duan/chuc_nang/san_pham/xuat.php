<?php
    $id = $_GET['id'];
    $so_du_lieu = 15;

    // Kết nối cơ sở dữ liệu
    $servername = "localhost";
    $username = "admin01";
    $password = "123admin123";
    $dbname = "ban_hang";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Lấy tổng số lượng sản phẩm
    $tv_count = "SELECT COUNT(*) FROM san_pham WHERE thuoc_menu=?";
    $stmt_count = $conn->prepare($tv_count);
    $stmt_count->bind_param("s", $id);
    $stmt_count->execute();
    $stmt_count->bind_result($total_records);
    $stmt_count->fetch();
    $stmt_count->close();

    // Tính số trang
    $so_trang = ceil($total_records / $so_du_lieu);

    // Xác định vị trí bắt đầu của dữ liệu
    if (!isset($_GET['trang'])) {
        $vtbd = 0;
    } else {
        $vtbd = ($_GET['trang'] - 1) * $so_du_lieu;
    }

    // Lấy dữ liệu sản phẩm cho trang hiện tại
    $tv = "SELECT id, ten, gia, hinh_anh, thuoc_menu FROM san_pham WHERE thuoc_menu=? ORDER BY id DESC LIMIT ?, ?";
    $stmt = $conn->prepare($tv);
    $stmt->bind_param("sii", $id, $vtbd, $so_du_lieu);
    $stmt->execute();
    $result = $stmt->get_result();

    // Hiển thị sản phẩm trong bảng
    echo "<table>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        for ($i = 1; $i <= 3; $i++) {
            echo "<td align='center' width='215px' valign='top'>";
            if ($row != false) {
                $link_anh = "chuc_nang/hinh_anh/san_pham/" . $row['hinh_anh'];
                $link_chi_tiet = "?thamso=chi_tiet_san_pham&id=".$row['id'];
                
                echo "<a href='$link_chi_tiet'>";
                echo "<img src='$link_anh' width='150px'>";
                echo "</a>";
                echo "<br>";
                echo "<a href='$link_chi_tiet'>";
                echo $row['ten'];
                echo "</a>";
                echo "<br>";
                echo $row['gia'];
                echo "<br><br>";
            } else {
                echo "&nbsp;";
            }
            echo "</td>";

            if ($i != 3 && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }
        }
        echo "</tr>";
    }
    echo "<tr>";
    echo "<td colspan='3' align='center'>";
    echo "<div class='phan_trang'>";
    for ($i = 1; $i <= $so_trang; $i++) {
        $link = "?thamso=xuat_san_pham&id=".$id."&trang=".$i;
        echo "<a href='$link'>";
        echo $i; echo " ";
        echo "</a>";
    }
    echo "</div>";
    echo "</td>";
    echo "</tr>";
    echo "</table>";

    // Đóng kết nối
    $stmt->close();
    $conn->close();
?>

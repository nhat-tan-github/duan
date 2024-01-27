<?php


// Check if product ID is set and the session variable is set to "co"
if (isset($_GET['id']) && $_SESSION['trang_chi_tiet_gio_hang'] == "co") {
    $_SESSION['trang_chi_tiet_gio_hang'] = "huy_bo";

    // Check if the session variable is set
    if (isset($_SESSION['id_them_vao_gio'])) {
        $so = count($_SESSION['id_them_vao_gio']);
        $trung_lap = "khong";

        // Check for duplicate product ID in the cart
        for ($i = 0; $i < $so; $i++) {
            if ($_SESSION['id_them_vao_gio'][$i] == $_GET['id']) {
                $trung_lap = "co";
                $vi_tri_trung_lap = $i;
                break;
            }
        }

        // If not a duplicate, add the product to the cart; otherwise, update quantity
        if ($trung_lap == "khong") {
            $_SESSION['id_them_vao_gio'][$so] = $_GET['id'];
            $_SESSION['sl_them_vao_gio'][$so] = $_GET['so_luong'];
        } elseif ($trung_lap == "co") {
            $_SESSION['sl_them_vao_gio'][$vi_tri_trung_lap] += $_GET['so_luong'];
        }
    } else {
        // If the session variable is not set, initialize the cart
        $_SESSION['id_them_vao_gio'][0] = $_GET['id'];
        $_SESSION['sl_them_vao_gio'][0] = $_GET['so_luong'];
    }
}

$gio_hang = "khong";

// Check if there are items in the cart
if (isset($_SESSION['id_them_vao_gio'])) {
    $so_luong = array_sum($_SESSION['sl_them_vao_gio']);
    if ($so_luong != 0) {
        $gio_hang = "co";
    }
}

echo "Giỏ hàng";
echo "<br><br>";

if ($gio_hang == "khong") {
    echo "Không có sản phẩm trong giỏ hàng";
} else {
    echo "<form action='' method='post'>";
    echo "<input type='hidden' name='cap_nhat_gio_hang' value='co'> ";
    echo "<table>";
    echo "<tr>";
    echo "<td width='200px'>Tên</td>";
    echo "<td width='150px'>Số lượng</td>";
    echo "<td width='150px'>Đơn giá</td>";
    echo "<td width='170px'>Thành tiền</td>";
    echo "</tr>";
    $tong_cong = 0;

    // Loop through items in the cart
    for ($i = 0; $i < count($_SESSION['id_them_vao_gio']); $i++) {
        $id_san_pham = $_SESSION['id_them_vao_gio'][$i];

        // Use prepared statements to prevent SQL injection
        $mysqli = new mysqli("localhost", "admin01", "123admin123", "ban_hang");
        $query = $mysqli->prepare("SELECT id, ten, gia FROM san_pham WHERE id = ?");
        $query->bind_param("i", $id_san_pham);
        $query->execute();
        $result = $query->get_result();
        $query->close();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ten_san_pham = $row['ten'];
            $gia_san_pham = $row['gia'];

            $so_luong_san_pham = $_SESSION['sl_them_vao_gio'][$i];
            $tien = $gia_san_pham * $so_luong_san_pham;

            $tong_cong += $tien;

            $name_id = "id_" . $i;
            $name_sl = "sl_" . $i;

            if ($so_luong_san_pham != 0) {
                echo "<tr>";
                echo "<td>$ten_san_pham</td>";
                echo "<td>";
                echo "<input type='hidden' name='$name_id' value='$id_san_pham'>";
                echo "<input type='text' style='width:50px' name='$name_sl' value='$so_luong_san_pham'> ";
                echo "</td>";
                echo "<td>$gia_san_pham</td>";
                echo "<td>$tien</td>";
                echo "</tr>";
            }
        }
    }

    echo "<tr>";
    echo "<td>&nbsp;</td>";
    echo "<td><input type='submit' value='Cập nhật'></td>";
    echo "<td>&nbsp;</td>";
    echo "<td>&nbsp;</td>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";
    echo "<br>";
    echo "Tổng giá trị đơn hàng là : $tong_cong VNĐ";
    include("chuc_nang/gio_hang/bieu_mau_mua_hang.php");
}

?>

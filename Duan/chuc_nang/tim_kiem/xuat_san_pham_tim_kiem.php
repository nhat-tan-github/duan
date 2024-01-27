<?php
if (isset($_GET['tu_khoa']) && trim($_GET['tu_khoa']) != "") {
    $tu_khoa = trim($_GET['tu_khoa']);
    $m = explode(" ", $tu_khoa);
    $chuoi_tim_sql = "";

    for ($i = 0; $i < count($m); $i++) {
        $tu = trim($m[$i]);
        if ($tu != "") {
            $chuoi_tim_sql .= " ten LIKE '%" . $tu . "%' OR";
        }
    }

    $m_2 = explode(" ", $chuoi_tim_sql);
    $chuoi_tim_sql_2 = implode(" ", array_slice($m_2, 0, -1));

    $so_du_lieu = 15;
    $conn = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $tv_count = "SELECT count(*) FROM san_pham WHERE $chuoi_tim_sql_2";
    $result_count = $conn->query($tv_count);

    if ($result_count) {
        $tv_2 = $result_count->fetch_array();
        $so_trang = ceil($tv_2[0] / $so_du_lieu);

        if (!isset($_GET['trang'])) {
            $vtbd = 0;
        } else {
            $vtbd = ($_GET['trang'] - 1) * $so_du_lieu;
        }

        $tv = "SELECT id, ten, gia, hinh_anh, thuoc_menu FROM san_pham WHERE $chuoi_tim_sql_2 ORDER BY id DESC LIMIT $vtbd, $so_du_lieu";
        $result = $conn->query($tv);

        if ($result) {
            echo "<table>";
            while ($tv_2 = $result->fetch_array()) {
                echo "<tr>";
                for ($i = 1; $i <= 3; $i++) {
                    echo "<td align='center' width='215px' valign='top' >";
                    if ($tv_2 != false) {
                        $link_anh = "hinh_anh/san_pham/" . $tv_2['hinh_anh'];
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
                        $tv_2 = $result->fetch_array();
                    }
                }
                echo "</tr>";
            }

            echo "<tr>";
            echo "<td colspan='3' align='center' >";
            echo "<div class='phan_trang' >";
            for ($i = 1; $i <= $so_trang; $i++) {
                $link = "?thamso=tim_kiem&tu_khoa=" . $_GET['tu_khoa'] . "&trang=" . $i;
                echo "<a href='$link' >";
                echo $i;
                echo " ";
                echo "</a>";
            }
            echo "</div>";
            echo "</td>";
            echo "</tr>";
            echo "</table>";
        } else {
            echo "Lỗi truy vấn: " . $conn->error;
        }

        $result->close();
    } else {
        echo "Lỗi truy vấn: " . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
} else {
    echo "Bạn chưa nhập từ khóa";
}
?>

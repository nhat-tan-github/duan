

<?php
    $_SESSION['trang_chi_tiet_gio_hang'] = "co";
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    $conn = new mysqli("localhost", "admin01", "123admin123", "ban_hang");

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    $tv = "SELECT * FROM san_pham WHERE id = ?";
    $stmt = $conn->prepare($tv);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $tv_2 = $result->fetch_assoc();
        $link_anh="chuc_nang/hinh_anh/san_pham/".$tv_2['hinh_anh'];
            echo "<table>";
                echo "<tr>";
                    echo "<td width='250px' align='center' >";
                        echo "<img src='$link_anh' width='150px' >";
                    echo "</td>";
                    echo "<td valign='top' >";
                        echo "<a href='#'>";
                            echo $tv_2['ten'];
                        echo "</a>";
                        echo "<br>";
                        echo "<br>";
                        echo $tv_2['gia'];
                        echo "<br>";
                        echo "<br>";
                        echo "<form>";
                            echo "<input type='hidden' name='thamso' value='gio_hang' > ";
                            echo "<input type='hidden' name='id' value='".$_GET['id']."' > ";
                            echo "<input type='text' name='so_luong' value='1' style='width:50px' > ";
                            echo "<input type='submit' value='Thêm vào giỏ' style='margin-left:15px' > ";
                        echo "</form>";
                    echo "</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td colspan='2' >";
                        echo "<br>";
                        echo "<br>";
                        echo $tv_2['noi_dung'];
                    echo "</td>";
                echo "</tr>";
            echo "</table>";
     }
?>
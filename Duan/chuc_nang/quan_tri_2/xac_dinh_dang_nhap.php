<?php
    
    $bien_bao_mat = "co";

    $server = "localhost";
    $username = "admin01";
    $password = "123admin123";
    $database = "ban_hang";

    $conn = new mysqli($server, $username, $password, $database);

    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    function thong_bao_abc($c)
    {
        $lien_ket_trang_truoc = $_SERVER['HTTP_REFERER'];
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Thông báo</title>
            </head>
            <body>
                <style type="text/css">
                    a.trang_truoc_c8w {
                        text-decoration: none;
                        color: blue;
                        font-size: 36px;
                        margin-left: 50px;
                    }
                    a.trang_truoc_c8w:hover {
                        color: red;
                    }
                </style>
                <br><br><br><br>
                <a href="<?php echo $lien_ket_trang_truoc; ?>" class="trang_truoc_c8w" >Bấm vào đây để trở về trang trước</a>
                <script type="text/javascript">
                    alert("<?php echo $c; ?>");
                </script>
            </body>
        </html>
        <?php
        exit();
    }

    function trang_truoc_abc()
    {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Đang chuyển về trang trước</title>
            </head>
            <body>
                <script type="text/javascript">
                    window.history.back();
                </script>
            </body>
        </html>
        <?php
    }

    if (isset($_POST['dang_nhap_quan_tri'])) {
        $ky_danh = $_POST['ky_danh'];
        $ky_danh = str_replace("'", "", $ky_danh);
        $ky_danh = str_replace('"', '', $ky_danh);

        $mat_khau = $_POST['mat_khau'];

        $tv = "SELECT mat_khau FROM thong_tin_quan_tri WHERE ky_danh = ? LIMIT 1";
        $stmt = $conn->prepare($tv);
        $stmt->bind_param('s', $ky_danh);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($mat_khau, $hashed_password)) {
            $_SESSION['ky_danh'] = $ky_danh;
            $_SESSION['mat_khau'] = $hashed_password;
        } else {
            thong_bao_abc("Thông tin nhập vào không đúng");
        }
        trang_truoc_abc();
    }

    if (isset($_SESSION['ky_danh'])) {
        $ky_danh = $_SESSION['ky_danh'];
        $mat_khau = $_SESSION['mat_khau'];

        $tv = "SELECT * FROM thong_tin_quan_tri WHERE ky_danh = ? AND mat_khau = ? LIMIT 1";
        $stmt = $conn->prepare($tv);
        $stmt->bind_param('ss', $ky_danh, $mat_khau);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $xac_dinh_dang_nhap = "co";
        }
    }
?>


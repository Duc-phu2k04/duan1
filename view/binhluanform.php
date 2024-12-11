<?php
session_start();
require_once "../model/pdo.php";   // Đảm bảo đường dẫn đúng
require_once "../model/binhluan.php";
require_once "../model/sanpham.php";  // Đảm bảo đường dẫn đúng

// Kiểm tra xem có id_sp trong request không
$id_sp = isset($_REQUEST['id_sp']) ? $_REQUEST['id_sp'] : null;
if ($id_sp === null) {
    echo "Không có sản phẩm được chọn!";
    exit;
}

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION["user"])) {
    $id_nguoidung = $_SESSION["user"]["id"];
} else {
    echo "Bạn cần đăng nhập để bình luận.";
    exit;
}

// Lấy danh sách bình luận của sản phẩm từ database
$listbl = loadall_binhluan($id_sp);

// Kiểm tra khi người dùng gửi bình luận
if (isset($_POST['guibinhluan']) && $_POST['guibinhluan']) {
    $noidung = $_POST['noidung'];
    $ngaybinhluan = date('d/m/Y');
    insert_binhluan($noidung, $id_nguoidung, $id_sp, $ngaybinhluan);
    header("Location: " . $_SERVER['HTTP_REFERER']);  // Điều hướng lại trang sau khi gửi bình luận
    exit;
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bình luận sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/index.css">
    <link rel="stylesheet" href="../CSS/sanpham.css">
</head>

<body>

    <div class="container mt-3 px-3">
        <h1>Bình luận</h1>

        <!-- Hiển thị danh sách bình luận -->
        <div class="mt-3">
            <table class="table table-borderless text-center" style="border: 1px solid black; height: 140px;">
                <tr>
                    <th class="w-5">Người dùng</th>
                    <th class="w-5">Nội dung</th>
                    <th class="w-5">Ngày bình luận</th>
                </tr>
                <?php
                // Lặp qua các bình luận và hiển thị chúng
                foreach ($listbl as $bl) {
                    extract($bl);
                    echo '<tr>
                        <td>' . $nguoidung . '</td>
                        <td>' . $noidung . '</td>
                        <td>' . $ngaybinhluan . '</td>
                      </tr>';
                }
                ?>
            </table>
        </div>

        <!-- Form gửi bình luận -->
        <form style="margin: 10px 15px;" action="binhluanform.php" method="POST">
            <input type="hidden" name="id_sp" value="<?= $id_sp ?>">
            <input type="hidden" name="id_nguoidung" value="<?= $id_nguoidung ?>">

            <div class="form-group">
                <input type="text" name="noidung" class="form-control" placeholder="Nhập bình luận..." required>
            </div>

            <input type="submit" class="btn btn-primary mt-2" name="guibinhluan" value="Gửi bình luận">
        </form>
    </div>

    <!-- Kết nối với các thư viện JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>

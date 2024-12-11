<?php

session_start();
include "../../model/pdo.php";
include "../../model/binhluan.php";
include "../../model/sanpham.php";

// Kiểm tra xem có tồn tại id_sp không
if (isset($_REQUEST['id_sp'])) {
    $id_sp = $_REQUEST['id_sp'];
} else {
    echo "Không có sản phẩm được chọn!";
    exit;
}

if(isset($_SESSION["user"])) {
    $id_nguoidung = $_SESSION["user"]["id"];
} else {
    echo "<p class='text-warning'>Vui lòng đăng nhập để bình luận.</p>";
    exit;
}

// Lấy danh sách bình luận
$listbl = loadall_binhluan($id_sp);
$sanpham = loadone_sanpham($id_sp);
if(is_array($sanpham)) {
    extract($sanpham);
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="../CSS/index.css">
<link rel="stylesheet" href="../CSS/sanpham.css">

<div class="mt-3 px-3">
    <h1>Bình luận</h1>
    <div class="mt-3">
        <table class="table table-borderless text-center" style="border: 1px solid black; height: 140px;">
            <tr>
                <th class="w-5">Người dùng</th>
                <th class="w-5">Nội dung</th>
                <th class="w-5">Ngày bình luận</th>
            </tr>
            <?php
            if (is_array($listbl)) {
                foreach($listbl as $bl) {
                    extract($bl);
                    echo '<tr>
                        <td>'.$nguoidung.'</td>
                        <td>'.$noidung.'</td>
                        <td>'.$ngaybinhluan.'</td>
                      </tr>';
                }
            } else {
                echo "<tr><td colspan='3'>Chưa có bình luận nào</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

<form style="margin: 10px 15px;" action="binhluanform.php" method="POST">
    <input type="hidden" name="id_sp" value="<?= $id_sp ?>">
    <input type="hidden" name="id_nguoidung" value="<?= $id_nguoidung ?>">

    <input type="text" name="noidung" class="form-control" required>
    <button type="submit" class="guibl btn btn-primary mt-2" name="guibinhluan" value="Gửi bình luận">Gửi bình luận</button>
</form>

<?php
if(!empty($_SESSION["user"])) {
    if(isset($_POST['guibinhluan']) && ($_POST['guibinhluan'])) {

        // Xác thực nội dung bình luận
        $noidung = trim($_POST['noidung']);
        if (empty($noidung)) {
            echo "<p class='text-danger'>Vui lòng nhập nội dung bình luận!</p>";
        } else {
            $id_sp = $_POST['id_sp'];
            $id_nguoidung = $_SESSION['user']['id'];
            $ngaybinhluan = date('d/m/Y');
            insert_binhluan($noidung, $id_nguoidung, $sanpham['id'], $ngaybinhluan);
            header("Location: ".$_SERVER['HTTP_REFERER']);
        }
    }
} else {
    echo "<p class='text-warning'>Vui lòng đăng nhập để bình luận.</p>";
}
?>

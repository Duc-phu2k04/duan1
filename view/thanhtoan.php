<?php
session_start();

// Kiểm tra nếu giỏ hàng không tồn tại hoặc trống
if (!isset($_SESSION['mycart']) || count($_SESSION['mycart']) == 0) {
    echo "Giỏ hàng của bạn trống. Vui lòng thêm sản phẩm trước khi thanh toán.";
    exit();
}

//Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user'])) {
    echo "Bạn cần đăng nhập trước khi thanh toán.";
    exit();
}

// Khởi tạo biến cho danh sách sản phẩm yêu thích (nếu có)
$sanphamtop5 = isset($sanphamtop5) ? $sanphamtop5 : []; // Nếu không có, khởi tạo mảng rỗng
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <!-- Thêm Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Thông tin thanh toán</h2>
    <form method="POST" action="index.php?act=thanhtoan">
        <div class="mb-3">
            <label for="nguoidung" class="form-label">Họ và tên:</label>
            <input type="text" name="nguoidung" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="diachi" class="form-label">Địa chỉ:</label>
            <input type="text" name="diachi" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="sdt" class="form-label">Số điện thoại:</label>
            <input type="tel" name="sdt" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="pt_thanhtoan" class="form-label">Phương thức thanh toán:</label>
            <select name="pt_thanhtoan" class="form-select">
                <option value="Tiền mặt">Tiền mặt</option>
                <option value="Chuyển khoản">Chuyển khoản</option>
            </select>
        </div>
        <button type="submit" name="dongythanhtoan" class="btn btn-primary">Đặt hàng</button>
    </form>

    <h3 class="mt-4">Thông tin đơn hàng</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tongTien = 0;
            if (isset($_SESSION['mycart']) && is_array($_SESSION['mycart'])) {
                $stt = 1;
                foreach ($_SESSION['mycart'] as $cart) {
                    $price = str_replace(' VND', '', $cart[3]); // Loại bỏ "VND"
                    $price = floatval(str_replace(',', '', $price)); // Chuyển thành số
                    echo "
                    <tr>
                        <td>{$stt}</td>
                        <td><img src='../upload_file/{$cart[2]}' width='50' alt=''></td>
                        <td>{$cart[1]}</td>
                        <td>" . number_format($price) . " VND</td>
                        <td>{$cart[4]}</td>
                    </tr>
                    ";
                    $tongTien += $price * $cart[4]; // Cộng tổng tiền
                    $stt++;
                }
            }
            ?>
        </tbody>
    </table>

    <p><strong>Tổng tiền: <?php echo number_format($tongTien); ?> VND</strong></p>

    <!-- Phần sản phẩm có thể bạn thích -->
    <h3>Sản phẩm có thể bạn thích</h3>
    <?php if (!empty($sanphamtop5)): ?>
        <ul>
            <?php foreach ($sanphamtop5 as $sanpham): ?>
                <li><?php echo $sanpham['name']; ?> - <?php echo number_format($sanpham['price']); ?> VND</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Không có sản phẩm gợi ý nào.</p>
    <?php endif; ?>
</div>

<!-- Thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
session_start();

// Kiểm tra nếu giỏ hàng, đơn hàng và người dùng đã được lưu trong session
if (!isset($_SESSION['giohang']) || empty($_SESSION['giohang'])) {
    echo "Giỏ hàng của bạn trống.";
    exit();
}

if (!isset($_SESSION['donhang']) || empty($_SESSION['donhang'])) {
    echo "Không tìm thấy thông tin đơn hàng.";
    exit();
}

if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
    echo "Thông tin người dùng không tồn tại.";
    exit();
}

// Lấy thông tin đơn hàng, giỏ hàng và người dùng từ session
$donhang = $_SESSION['donhang'];
$giohang = $_SESSION['giohang'];
$nguoidung = $_SESSION['user'];

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hóa đơn</title>
    <!-- Thêm Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Hóa Đơn</h2>

    <!-- Thông tin đơn hàng -->
    <div class="mb-4">
        <h4>Thông tin đơn hàng</h4>
        <p><strong>Mã đơn hàng:</strong> <?php echo isset($donhang['id']) ? $donhang['id'] : 'N/A'; ?></p>
        <p><strong>Ngày đặt hàng:</strong> <?php echo isset($donhang['date']) ? $donhang['date'] : 'N/A'; ?></p>
        <p><strong>Phương thức thanh toán:</strong> <?php echo isset($donhang['payment_method']) ? $donhang['payment_method'] : 'N/A'; ?></p>
    </div>

    <!-- Thông tin người dùng -->
    <div class="mb-4">
        <h4>Thông tin người dùng</h4>
        <p><strong>Người dùng:</strong> <?php echo isset($nguoidung['name']) ? $nguoidung['name'] : 'N/A'; ?></p>
        <p><strong>Địa chỉ:</strong> <?php echo isset($nguoidung['address']) ? $nguoidung['address'] : 'N/A'; ?></p>
        <p><strong>Email:</strong> <?php echo isset($nguoidung['email']) ? $nguoidung['email'] : 'N/A'; ?></p>
        <p><strong>Số điện thoại:</strong> <?php echo isset($nguoidung['phone']) ? $nguoidung['phone'] : 'N/A'; ?></p>
    </div>

    <!-- Chi tiết đơn hàng -->
    <h4>Chi tiết đơn hàng</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Đơn giá</th>
                <th>Số lượng</th>
                <th>Tổng</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tongTien = 0;
            if (isset($giohang) && is_array($giohang)) {
                foreach ($giohang as $cartItem) {
                    $price = floatval(str_replace(',', '', str_replace(' VND', '', $cartItem['price']))); // Chuyển giá trị thành số
                    $totalPrice = $price * $cartItem['quantity'];
                    $tongTien += $totalPrice;
                    ?>
                    <tr>
                        <td><img src="../upload_file/<?php echo $cartItem['image']; ?>" width="50" alt=""></td>
                        <td><?php echo $cartItem['name']; ?></td>
                        <td><?php echo number_format($price); ?> VND</td>
                        <td><?php echo $cartItem['quantity']; ?></td>
                        <td><?php echo number_format($totalPrice); ?> VND</td>
                    </tr>
                <?php }
            } else {
                echo "<tr><td colspan='5'>Giỏ hàng trống</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <p><strong>Tổng số tiền: <?php echo number_format($tongTien); ?> VND</strong></p>

    <p>MIỄN PHÍ VẬN CHUYỂN TOÀN CẦU</p>
    <p>ĐẢM BẢO HOÀN LẠI TIỀN</p>
    <p>HỖ TRỢ TRỰC TUYẾN 24/7</p>
</div>

<!-- Thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

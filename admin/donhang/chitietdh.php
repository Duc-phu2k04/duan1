<?php
// Kết nối với cơ sở dữ liệu
require_once 'commons/pdo.php';

// Lấy ID đơn hàng từ URL (hoặc từ các tham số khác)
$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Kiểm tra nếu có ID đơn hàng thì lấy thông tin
if ($id > 0) {
    // Truy vấn thông tin đơn hàng
    $sql_order = "SELECT * FROM donhang WHERE id = :id_donhang";
    $params_order = [':id_donhang' => $id];
    $order_details = pdo_query($sql_order, $params_order);

    if (count($order_details) > 0) {
        $order = $order_details[0];  // Lấy đơn hàng đầu tiên nếu có
        $nguoidung = $order['ten_nguoidung'];
        $sdt = $order['sdt'];
        $email = $order['email'];
        $diachi = $order['diachi'];
        $order_date = $order['ngay_mua'];
        $thanhtoan = $order['phuongthuc_thanhtoan'];
        $ten_trangthai = $order['ten_trangthai'];
        $tongtien = $order['tongtien'];
    }

    // Truy vấn giỏ hàng cho đơn hàng
    $sql_cart = "SELECT giohang.*, sanpham.tensp, sanpham.img, sanpham.giasp 
                 FROM giohang
                 JOIN sanpham ON giohang.id_sanpham = sanpham.id
                 WHERE giohang.id_donhang = :id_donhang";
    $params_cart = [':id_donhang' => $id];
    $giohang = pdo_query($sql_cart, $params_cart);
} else {
    echo "Không tìm thấy đơn hàng.";
    exit;
}

// Hàm tính tổng tiền
function calculateTotal($giohang) {
    $tong = 0;
    foreach ($giohang as $item) {
        $tong += $item['giasp'] * $item['soluong'];
    }
    return $tong;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="path/to/your/css/styles.css"> <!-- Thêm đường dẫn tới file CSS của bạn -->
</head>
<body>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Đơn hàng</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h4>
        </div>
        <br>

        <div class="card-body">
            <div class="table-responsive">
                <div class="container">
                    <div class="row">
                        <div class="container">
                            <h2><label for="">Mã đơn: <?= $id ?></label></h2>
                            <h2><label for="">Tên khách hàng: <?= $nguoidung ?></label></h2>
                            <h2><label for="">Số điện thoại: <?= $sdt ?></label></h2>
                            <h2><label for="">Email: <?= $email ?></label></h2>
                            <h2><label for="">Địa chỉ giao hàng: <?= $diachi ?></label></h2>
                            <h2><label for="">Thời gian mua: <?= $order_date ?></label></h2>
                            <h2><label for="">Phương thức thanh toán: 
                                <?= $thanhtoan == 0 ? 'Thanh toán khi giao hàng' : 'Chuyển khoản trực tiếp' ?>
                            </label></h2>
                            <h2><label for="">Trạng thái: <?= $ten_trangthai ?></label></h2>
                            <h2><label for="">Tổng tiền: <?= number_format($tongtien, 0, ',', '.') ?> VND</label></h2>
                        </div>
                    </div>
                </div>
            </div>
            <br>

            <div class="m-2">
                <h2>Sản phẩm</h2>
                <br>
                <table class="text-center" style="font-size: 20px; width: 100%;">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh</th>
                        <th>Giá tiền</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>

                    <?php foreach ($giohang as $gh): ?>
                        <tr>
                            <td style="padding-top: 30px;"><?= htmlspecialchars($gh['tensp']) ?></td>
                            <td style="padding-top: 30px;">
                                <img src="<?= '../upload_file/' . htmlspecialchars($gh['img']) ?>" width="100px" alt="">
                            </td>
                            <td style="padding-top: 30px;">
                                <?= number_format((int) $gh['giasp'], 0, ',', '.') ?> VND
                            </td>
                            <td style="padding-top: 30px;">
                                <?= $gh['soluong'] ?>
                            </td>
                            <td style="padding-top: 30px;">
                                <?= number_format((int) $gh['giasp'] * $gh['soluong'], 0, ',', '.') ?> VND
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <br>
                <h2>Tổng giá: <?= number_format(calculateTotal($giohang), 0, ',', '.') ?> VND</h2>
            </div>

            <div class="function-back">
                <a href="index.php?act=listdh"><input type="submit" class="btn btn-primary mt-5" value="Quay lại trang đơn hàng"></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php

if (is_array($donhang)) {
    extract($donhang);
}



?>


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
                            <h2><label for="">Mã đơn:
                                    <?= $id ?>
                                </label></h2>
                            <h2><label for="">Tên khách hàng:
                                    <?= $nguoidung ?>
                                </label></h2>
                            </label></h2>
                            <h2><label for="">Số điện thoại
                                    <?= $sdt ?>
                                </label></h2>
                            <h2><label for="">Địa chỉ giao hàng:
                                    <?= $diachi ?>
                                </label></h2>
                            <h2><label for="">Thời gian mua:
                                    <?= $thoigian_mua ?>
                                </label></h2>
                            <h2><label for="">Số lượng:
                                    <?= $soluong ?>
                                </label></h2>
                            <h2><label for="">Phương thức thanh toán:
                                    <?= $pt_thanhtoan == 0 ? 'Thanh toán khi giao hàng' : 'Chuyển khoản trực tiếp' ?>
                                </label></h2>
                            <h2><label for="">Trạng thái:
                                    <?php
                                    if ($id_trangthai_donhang == 1) {
                                        echo "Chờ xác nhận";
                                    } else if ($id_trangthai_donhang == 2) {
                                        echo "Đã xác nhận";
                                    } else if ($id_trangthai_donhang == 3) {
                                        echo "Đang xửa lý";
                                    } else if ($id_trangthai_donhang == 4) {
                                        echo "Đang vận chuyển";
                                    } else if ($id_trangthai_donhang == 5) {
                                        echo "Giao hàng thành công";
                                    } else if ($id_trangthai_donhang == 6) {
                                        echo "CHờ thanh toán ";
                                    } else if ($id_trangthai_donhang == 7) {
                                        echo "Đã thanh toán";
                                    } else {
                                        echo "Đã hủy";
                                    }

                                    ?>
                                </label></h2>
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

                    <?php foreach ($giohang as $gh):
                        extract($gh);
                        ?>

                        <tr>
                            <td style="padding-top: 30px;">
                                <?= $tensp ?>
                            </td>
                            <td style="padding-top: 30px;"><img src="<?= ' ../upload_file/' . $img ?>" width="100px" alt="">
                            </td>
                            <td style="padding-top: 30px;">
                                <?= (int) $giasp ?>.000 ₫
                            </td>
                            <td style="padding-top: 30px;">
                                <?= $soluong ?>
                            </td>
                            <td style="padding-top: 30px;">
                                <?= (int) $giasp * $soluong ?>.000 ₫
                            </td>
                        </tr>

                    <?php endforeach; ?>
                </table>
                <br>
                <h2>Tổng giá:
                    <?php
                    $tong = 0;
                    foreach ($giohang as $value) {
                        extract($value);
                        $tong += (int) $giasp * $soluong;
                    }
                    echo $tong;
                    ?>.000 đ
                </h2>
            </div>





            <div class="function-back">
                <a href="index.php?act=listdh"><input type="submit" class="btn btn-primary mt-5"
                        value="Quay lại trang đơn hàng"></a>
            </div>

        </div>
    </div>

</div>
<!--End Content -->

</div>
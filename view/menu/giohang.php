<?php
session_start();
if (!isset($_SESSION['mycart'])) {
    $_SESSION['mycart'] = [];
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .price {
            color: red;
            font-weight: bold;
        }

        .shop-table {
            margin-bottom: 30px;
        }

        .product-thumbnail img {
            width: 100px;
            height: 100px;
        }

        .product-name a {
            text-decoration: none;
            color: #007bff;
        }

        .quantity-cart input[type="number"] {
            width: 60px;
            text-align: center;
        }

        .box-cart-total {
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-price span {
            font-size: 1.2em;
        }
    </style>
</head>

<body>

<div class="container my-5">
    <div class="shop-top">
        <div class="shop-top-left">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="main-content">
        <div class="page-title mb-4">
            <h3>Giỏ hàng</h3>
        </div>

        <div class="row">
            <div class="col-md-8">
                <table class="table table-bordered shop-table">
                    <thead>
                        <tr>
                            <th class="text-center">Ảnh sản phẩm</th>
                            <th class="text-center">Sản phẩm</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['mycart']) && count($_SESSION['mycart']) > 0) {
                            $id = 0;
                            foreach ($_SESSION['mycart'] as $cart) {
                                $hinh = '../upload_file/' . $cart[2];  
                                $linksp = 'index.php?act=chitietsp';
                                $xoa = 'index.php?act=deletecart&id=' . $id;  

                                echo '
                                <tr>
                                    <td class="product-thumbnail text-center"><img src="' . $hinh . '" alt=""></td>
                                    <td class="product-name text-center"><a href="' . $linksp . '">' . $cart[1] . '</a></td>
                                    <form action="" method="post" class="quantity-cart">
                                        <td class="product-soluong text-center">
                                            <div class="form-soluong">
                                                <input type="hidden" name="id" value="' . $cart[0] . '">
                                                <input type="submit" name="giamsoluong" class="btn btn-outline-secondary btn-sm" value="-">
                                                <input type="number" name="soluong" class="form-control d-inline-block" value="' . $cart[4] . '" style="width: 60px;">
                                                <input type="submit" name="tangsoluong" class="btn btn-outline-secondary btn-sm" value="+">
                                            </div>
                                        </td>
                                    </form>
                                    <td class="product-price text-center"><span>' . number_format(floatval(str_replace(",", "", $cart[3]))) . ' VND</span></td>
                                    <td class="product-remove text-center">
                                        <a href="' . $xoa . '" onclick="return confirmDeletegh()"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>';
                                $id++;
                            }
                        } else {
                            echo '<tr><td colspan="4" class="text-center">Giỏ hàng của bạn hiện tại trống.</td></tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <div class="box-cart-total">
                    <h4 class="title">Tổng đơn hàng</h4>
                    <table class="table">
                        <tr>
                            <td>Số lượng sản phẩm:</td>
                            <td>
                                <?php
                                $tongSoLuong = 0;
                                if (isset($_SESSION['mycart']) && is_array($_SESSION['mycart'])) {
                                    foreach ($_SESSION['mycart'] as $cart) {
                                        $tongSoLuong += $cart[4];
                                    }
                                }
                                echo $tongSoLuong;
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tổng giá trị:</td>
                            <td>
                                <span class="price">
                                    <?php
                                    $tong = 0;
                                    foreach ($_SESSION['mycart'] as $cart) {
                                        $tong += $cart[5];
                                    }
                                    echo number_format($tong) . ' VND';
                                    ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                    <a href="index.php?act=thanhtoan" class="btn btn-danger btn-block">Đặt hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDeletegh() {
        return confirm("Bạn có muốn xóa sản phẩm này không?");
    }
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


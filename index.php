<?php

session_start();
ob_start();
include("../model/pdo.php");
include("../model/binhluan.php");
include("../model/sanpham.php");
include("../model/giohang.php");
include("../model/donhang.php");
include("global.php");

include("header.php");

if (!isset($_SESSION['mycart'])) {
    $_SESSION['mycart'] = [];
}

if (isset($_GET['act']) && $_GET['act'] != "") {
    $act = $_GET['act'];
    switch ($act) {
        case "chitietdonhang":
            if (isset($_GET['id']) && $_GET['id']) {
                $giohang = load_cart($_GET['id']);
            }
            include "view/ct_donhang.php";
            break;

        case "huydonhang":
            if (isset($_GET['id']) && $_GET['id']) {
                huydonhang($_GET['id']);
                header("Location: index.php?act=tkcanhan");
            }
            $donhang = loadone_donhang_user($_SESSION['user']['id']);
            $giohang = load_cart_user();
            $taikhoan = loadone_taikhoan($id);
            include "view/tkcanhan.php";
            break;

        

        case "lienhe":
            include("view/menu/lienhe.php");
            break;

        case "about":
            include("view/menu/about.php");
            break;


        case 'addgiohang':
            if (isset($_POST['addtocart']) && ($_POST['addtocart'])) {
                $id = $_POST['id'];
                $tensp = $_POST['tensp'];
                $img = $_POST['img'];
                $giasp = $_POST['giasp'];
                $soluong = $_POST['soluong'];
                $thanhtien = ((int) $soluong * (int) $giasp);
                $sanphamadd = [$id, $tensp, $img, $giasp, $soluong, $thanhtien];
                if (isset($_SESSION['mycart'])) {
                    $cartItems = $_SESSION['mycart'];
                    $existingItemKey = null;
                    foreach ($cartItems as $key => $item) {
                        if ($item[0] == $id) {
                            $existingItemKey = $key;
                            break;
                        }
                    }
                }
                if ($existingItemKey !== null) {
                    $cartItems[$existingItemKey][5] += $thanhtien;
                    $cartItems[$existingItemKey][4]++;
                } else {

                    array_push($cartItems, $sanphamadd);
                }
                $_SESSION['mycart'] = $cartItems;
            }

            if (isset($_POST['tangsoluong']) && $_POST['tangsoluong']) {
                $id = $_POST['id'];
                $cartItems = $_SESSION['mycart'];

                // Tìm kiếm sản phẩm trong giỏ hàng
                foreach ($cartItems as $key => $item) {
                    if ($item[0] == $id) {
                        // Tăng số lượng và giá tiền của sản phẩm
                        $cartItems[$key][4]++;
                        $cartItems[$key][5] += (int) $item[3];
                        break;
                    }
                }
                //Lưu giỏ hàng SESSION
                $_SESSION['mycart'] = $cartItems;
            }

            if (isset($_POST['giamsoluong']) && $_POST['giamsoluong']) {
                $id = $_POST['id'];
                $cartItems = $_SESSION['mycart'];

                // Tìm kiếm sản phẩm trong giỏ hàng
                foreach ($cartItems as $key => $item) {
                    if ($item[0] == $id) {
                        // Giảm số lượng và giá tiền của sản phẩm
                        if ($item[4] > 1) {
                            $cartItems[$key][4]--;
                            $cartItems[$key][5] -= (int) $item[3];
                            break;
                        }
                    }
                }
                //Lưu giỏ hàng SESSION
                $_SESSION['mycart'] = $cartItems;
            }
            $sanphamtop6 = load_sanpham_top6();
            include('view/menu/giohang.php');
            break;

            case "thanhtoan":
                // Kiểm tra người dùng đã đăng nhập chưa
                if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
                    echo "Bạn chưa đăng nhập tài khoản";
                    die;
                }
            
                $donhang = null;
                $giohang = null;
            
                if (isset($_POST['dongythanhtoan']) && $_POST['dongythanhtoan']) {
                    $nguoidung = $_POST['nguoidung'];
                    $diachi = $_POST['diachi'];
                    $sdt = $_POST['sdt'];
                    $email = $_POST['email'];
                    $thoigian_mua = date('d/m/Y');
                    $pt_thanhtoan = $_POST['pt_thanhtoan'];
            
                    // Thêm đơn hàng vào cơ sở dữ liệu
                    $id_dathang = insert_donhang($nguoidung, $sdt, $email, $diachi, $thoigian_mua, $pt_thanhtoan, count($_SESSION['mycart']), $_SESSION['user']['id']);
            
                    // Lấy chi tiết đơn hàng
                    $donhang = loadone_donhang($id_dathang);
                    $giohang = load_cart($id_dathang);
            
                    // Thêm các sản phẩm vào đơn hàng
                    foreach ($_SESSION['mycart'] as $cart) {
                        insert_giohang($_SESSION['user']['id'], $cart[0], $cart[1], $cart[2], $cart[3], $cart[4], $id_dathang);
                    }
            
                    // Xóa giỏ hàng sau khi đặt
                    $_SESSION['mycart'] = [];
            
                    // Điều hướng tới trang hóa đơn sau khi đặt hàng thành công
                    header("Location: index.php?act=hoadon&id_donhang=$id_dathang");
                    exit();
                }
            
                // Nếu form chưa được gửi, hiển thị trang thanh toán
                $donhang = load_hoadon_user($_SESSION['user']['id']);
                $giohang = load_cart($_SESSION['user']['id']);
                $sanphamtop5 = loadall_sanpham_top5();
                include("view/thanhtoan.php");
                break;
            
        case "hoadon":
            if (!isset($_SESSION["user"])) {
                header("Location: index.php");
            }
            if (isset($_GET['id_donhang']) && ($_GET['id_donhang']) > 0) {
                $giohang = load_cart($_GET['id_donhang']);
            }
            $donhang = loadonedonang();
            include "view/hoadon.php";
            break;

            case "deletecart":
                if (isset($_GET['act']) && $_GET['act'] == 'deletecart') {
                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        $id = $_GET['id'];
                        
                        // Kiểm tra nếu 'mycart' tồn tại và là một mảng
                        if (isset($_SESSION['mycart']) && is_array($_SESSION['mycart']) && count($_SESSION['mycart']) > 0) {
                            // Xóa sản phẩm tại chỉ mục $id
                            array_splice($_SESSION['mycart'], $id, 1);
                            
                            // Sau khi xóa xong, điều hướng về trang giỏ hàng để xem kết quả
                            header("Location: view/menu/giohang.php");
                            exit();
                        }
                    }
                }
                break;
    }
}

include("footer.php");
ob_end_flush();
?>
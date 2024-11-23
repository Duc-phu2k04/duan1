<?php

include "../models/taikhoan.php";
include "../models/donhang.php";
include "../commons/pdo.php";

include "header.php";

// Kiểm tra nếu có action (act) từ URL
if (isset($_GET['act'])) {
    $act = $_GET['act'];

    switch ($act) {
        // Liệt kê các đơn hàng
        case "listdh":
            $listdonhang = loadall_donhang();  // Load tất cả đơn hàng
            include "donhang/list.php";         // Hiển thị danh sách đơn hàng
            break;

        // Chi tiết đơn hàng
        case "chitietdh":
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $giohang = load_cart($_GET['id']);  // Load giỏ hàng của đơn hàng
                $donhang = loadone_donhang($_GET['id']);  // Load thông tin đơn hàng
                include "./donhang/chitietdh.php";     // Hiển thị chi tiết đơn hàng
            } else {
                echo "ID đơn hàng không hợp lệ!";
            }
            break;

        // Sửa thông tin đơn hàng
        case "suadh":
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $donhang = loadone_donhang($_GET['id']);  // Load thông tin đơn hàng
                $listtrangthai = loadall_trangthai();    // Load tất cả trạng thái đơn hàng
                include "donhang/update.php";             // Hiển thị form sửa đơn hàng
            } else {
                echo "ID đơn hàng không hợp lệ!";
            }
            break;

        // Xóa đơn hàng
        case "xoadh":
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_donhang($_GET['id']);   // Xóa đơn hàng
                $listdonhang = loadall_donhang();  // Tải lại danh sách đơn hàng
                include "donhang/list.php";         // Hiển thị danh sách đơn hàng
            } else {
                echo "ID đơn hàng không hợp lệ!";
            }
            break;

        // Cập nhật thông tin đơn hàng
        case "updatedh":
            if (isset($_POST["capnhat"]) && $_POST["capnhat"]) {
                // Lấy dữ liệu từ form POST
                $id = $_POST['id'];
                $nguoidung = $_POST['nguoidung'];
                $sdt = $_POST['sdt'];  // Số điện thoại
                $email = $_POST['email'];  // Email
                $order_date = $_POST['thoigian_mua'];  // Ngày đặt hàng
                $diachi = $_POST['diachi'];
                
                // Kiểm tra và xử lý số lượng
                $soluong = isset($_POST['soluong']) ? $_POST['soluong'] : 0;
                
                // Kiểm tra xem giá trị soluong có phải là số nguyên hợp lệ không
                if (!is_numeric($soluong) || (int)$soluong != $soluong) {
                    echo "Số lượng phải là một số nguyên hợp lệ.";
                    exit; // Dừng lại nếu giá trị không hợp lệ
                }
                $soluong = (int)$soluong; // Ép kiểu số nguyên
        
                $trangthai = $_POST['trangthai'];  // Trạng thái đơn hàng
        
                // Cập nhật đơn hàng trong cơ sở dữ liệu
                update_donhang($id, $nguoidung, $sdt, $email, $diachi, $order_date, $soluong, $trangthai);
                $thongbao = 'Cập nhật thành công';
            }
            $listtrangthai = loadall_trangthai();  // Load trạng thái đơn hàng
            $listdonhang = loadall_donhang();      // Load danh sách đơn hàng
            include "donhang/list.php";             // Hiển thị danh sách đơn hàng
            break;
        

        // Mặc định khi không có action
        default:
            include "home.php";  // Trang chủ
            break;
    }
} else {
    include "home.php";  // Nếu không có action, hiển thị trang chủ
}
?>

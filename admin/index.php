<?php
// admin/index.php
include "../model/pdo.php";
include "../model/giohang.php";
include "../model/binhluan.php";
include "../model/thongke.php";
include "../model/donhang.php";
include "../model/giohang.php";
include "../model/tong.php";
include "header.php";



if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        // Bình luận
        case "listbl":
            $listbl = loadall_binhluan($id_sp);
            $listbinhluan = loadall_binhluan_admin();
            include "binhluan/list.php";
            break;

        // Thống kê
        case "thongke":
            $listthongke = loadall_thongke();
            include "thongke/list.php";
            break;

        case "bieudo":
            $listthongke = loadall_thongke();
            include "thongke/bieudo.php";
            break;

        // Đơn hàng
        case "listdh":
            $listdonhang = loadall_donhang();
            include "donhang/list.php";
            break;

        case "chitietdh":
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $giohang = load_cart($_GET['id']);
                $donhang = loadone_donhang($_GET['id']);
            }
            include "donhang/chitietdh.php";
            break;

        case "suadh":
            if (isset($_GET['id']) && ($_GET['id'] > 0)) {
                $donhang = loadone_donhang($_GET['id']);
            }
            $listtrangthai = loadall_trangthai();
            $listdonhang = loadall_donhang();
            include "donhang/update.php";
            break;

        case "xoadh":
            if (isset($_GET['id']) && ($_GET['id'])) {
                delete_donhang($_GET['id']);
            }
            $listdonhang = loadall_donhang();
            include "donhang/list.php";
            break;

        case "updatedh":
            if (isset($_POST["capnhat"]) && ($_POST["capnhat"])) {
                $id = $_POST['id'];
                $nguoidung = $_POST['nguoidung'];
                $sdt = $_POST['sdt'];
                $email = $_POST['email'];
                $diachi = $_POST['diachi'];
                $thoigian_mua = $_POST['thoigian_mua'];
                $soluong = $_POST['soluong'];
                $id_trangthai_donhang = $_POST['trangthai'];

                update_donhang($id, $nguoidung, $sdt, $email, $diachi, $thoigian_mua, $soluong, $id_trangthai_donhang);
                $thongbao = 'Cập nhật thành công';

            }
            $listtrangthai = loadall_trangthai();
            $listdonhang = loadall_donhang();
            include "donhang/list.php";
            break;

        default:
            $tongdm = tinhtongdm();
            $tongsp = tinhtongsp();
            $tongtk = tinhtongtk();
            $tongbl = tinhtongbl();
            $listthongke = loadall_thongke();
            include "home.php";
            break;
    }
} 
    include "home.php";



include "footer.php";

?>


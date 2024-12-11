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
        case "chitietsp":
            if (isset($_GET['id']) && $_GET['id'] > 0) {

                $sanpham = loadone_sanpham($_GET['id']);


            }
            $listbinhluan = loadall_binhluan_admin();
            include "sanpham/chitietsp.php";
            break;

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


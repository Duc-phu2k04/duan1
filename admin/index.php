<?php
// admin/index.php
require_once "../commons/pdo.php";
require_once "../models/binhluan.php";

require_once "header.php";

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'dsbl':
            $listbinhluan = loadall_binhluan(0); // Tải tất cả bình luận
            include "binhluan/list.php";
            break;

        case 'xoabl':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                delete_binhluan($_GET['id']); // Xóa bình luận với id
            }
            $listbinhluan = loadall_binhluan(0); // Cập nhật lại danh sách bình luận
            include "binhluan/list.php";
            break;
    }
}

?>


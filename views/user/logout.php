<?php
// Bắt đầu phiên làm việc
session_start();

// Xóa tất cả session
session_unset();

// Hủy phiên làm việc
session_destroy();

// Chuyển hướng về trang home.php hoặc trang đăng nhập
header("Location: ../views/home.php"); // Quay lại trang home.php
exit();

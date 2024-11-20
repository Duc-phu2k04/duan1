<?php
require_once '../../models/user_model.php'; // Điều chỉnh đường dẫn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $ten = $_POST['ten'];
    $password = $_POST['password'];
    
    if (UserModel::register($email, $ten, $password)) {
        // Đăng ký thành công, chuyển hướng và hiển thị thông báo
        echo "<script>
                alert('Đăng ký thành công!'); 
                window.location.href = '../../views/user/login.php';
              </script>";
        exit();
    } else {
        // Đăng ký thất bại, hiển thị thông báo lỗi
        echo "<script>
                alert('Đăng ký thất bại! Vui lòng thử lại.');
              </script>";
    }
}
?>

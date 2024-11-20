<?php
session_start();
require_once '../../models/user_model.php'; // Điều chỉnh đường dẫn

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = UserModel::login($email, $password);
    
    if ($user) {
        // Đăng nhập thành công, lưu thông tin vào session
        $_SESSION['user'] = $user;
        if ($user['vaitro'] == 1) {
            $_SESSION['is_admin'] = true;
        }
        // Chuyển hướng và hiển thị thông báo đăng nhập thành công
        echo "<script>
                alert('Đăng nhập thành công!');
                window.location.href = '../../views/home.php';
              </script>";
        exit();
    } else {
        // Đăng nhập thất bại, hiển thị thông báo lỗi
        echo "<script>
                alert('Đăng nhập thất bại! Vui lòng kiểm tra lại email và mật khẩu.');
              </script>";
    }
}
?>
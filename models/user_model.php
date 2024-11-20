<?php
// Đảm bảo rằng bạn đã gọi đúng đường dẫn để sử dụng file pdo.php
require_once 'C:/laragon/www/abcxyz/commons/pdo.php';

class UserModel {

    // Đăng ký người dùng mới
    public static function register($email, $ten, $password) {
        // Lấy kết nối PDO từ hàm pdo_get_connection()
        $pdo = pdo_get_connection();
        
        // Không mã hóa mật khẩu, lưu mật khẩu thuần túy
        // Chuẩn bị câu lệnh SQL để chèn dữ liệu
        $stmt = $pdo->prepare("INSERT INTO nguoidung (email, ten, password, created_at, updated_at) VALUES (?, ?, ?, NOW(), NOW())");
        
        // Thực thi câu lệnh SQL với các tham số đã chuẩn bị
        return $stmt->execute([$email, $ten, $password]); // Lưu mật khẩu thuần túy vào CSDL
    }

    // Đăng nhập người dùng
    public static function login($email, $password) {
        // Lấy kết nối PDO từ hàm pdo_get_connection()
        $pdo = pdo_get_connection();
        
        // Chuẩn bị câu lệnh SQL để lấy dữ liệu người dùng theo email
        $stmt = $pdo->prepare("SELECT * FROM nguoidung WHERE email = ?");
        
        // Thực thi câu lệnh SQL
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        // Kiểm tra xem có người dùng không và in các giá trị ra để debug
        if ($user) {
            // In ra mật khẩu lưu trong CSDL và mật khẩu người dùng nhập vào
            echo 'Mật khẩu trong CSDL: ' . $user['password'] . '<br>';
            echo 'Mật khẩu nhập vào: ' . $password . '<br>';
    
            // Kiểm tra mật khẩu nếu khớp với mật khẩu lưu trong CSDL
            if ($user['password'] === $password) { 
                return $user; // Trả về thông tin người dùng nếu mật khẩu đúng
            } else {
                echo 'Mật khẩu không khớp!<br>';
            }
        } else {
            echo 'Không tìm thấy người dùng.<br>';
        }
        
        return false; // Trả về false nếu không có người dùng hoặc mật khẩu sai
    }
    
}
?>

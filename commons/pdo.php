// commons/pdo.php

<?php
$dsn = "mysql:host=localhost;dbname=nhom2";  // Cập nhật thông tin kết nối cơ sở dữ liệu
$username = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
}
?>

<?php 
// models/binhluan.php

// Hàm thêm bình luận
function insert_binhluan($user_id, $user_name, $product_id, $noidung, $trangthai) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO binhluan (user_id, user_name, product_id, noidung, trangthai) VALUES (:user_id, :user_name, :product_id, :noidung, :trangthai)");
    $stmt->execute([
        ':user_id' => $user_id,
        ':user_name' => $user_name,
        ':product_id' => $product_id,
        ':noidung' => $noidung,
        ':trangthai' => $trangthai
    ]);
}

// Hàm lấy tất cả bình luận cho một sản phẩm
function loadall_binhluan($product_id) {
    global $pdo;
    $sql = "SELECT * FROM binhluan WHERE product_id = :product_id ORDER BY trangthai DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':product_id' => $product_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Hàm xóa bình luận theo ID
function delete_binhluan($id) {
    global $pdo;
    $sql = "DELETE FROM binhluan WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

?>
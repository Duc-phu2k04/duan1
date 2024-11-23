<?php
// Chèn đơn hàng mới vào bảng donhang
function insert_donhang($nguoidung, $sdt, $email, $diachi, $thoigian_mua, $pt_thanhtoan, $soluong, $id_trangthai_donhang, $id_taikhoan)
{
    $sql = "INSERT INTO donhang (nguoidung, sdt, email, diachi, thoigian_mua, pt_thanhtoan, soluong, id_trangthai_donhang, id_taikhoan, created_at, updated_at) 
            VALUES (:nguoidung, :sdt, :email, :diachi, :thoigian_mua, :pt_thanhtoan, :soluong, :id_trangthai_donhang, :id_taikhoan, NOW(), NOW())";
   return pdo_execute_return_lastInsertId($sql, [
    'nguoidung' => $nguoidung, 
    'sdt' => $sdt, 
    'email' => $email, 
    'diachi' => $diachi, 
    'thoigian_mua' => $thoigian_mua, 
    'pt_thanhtoan' => $pt_thanhtoan, 
    'soluong' => $soluong, 
    'id_trangthai_donhang' => $id_trangthai_donhang,
    'id_taikhoan' => $id_taikhoan
]);

}

// Xóa đơn hàng theo ID
function delete_donhang($id)
{
    $sql = "DELETE FROM donhang WHERE id = :id";  // Xóa đơn hàng theo ID
    pdo_execute($sql, ['id' => $id]);  // Truyền ID vào câu lệnh SQL
}

// Lấy danh sách trạng thái đơn hàng
function loadall_trangthai()
{
    $sql = "SELECT * FROM trangthai_donhang"; // Kiểm tra lại tên bảng và cột
    $listtrangthai = pdo_query($sql);
    return $listtrangthai;
}

// Lấy đơn hàng của người dùng theo ID
function loadone_donhang_user($id)
{
    $sql = "SELECT 
                donhang.id, 
                donhang.nguoidung, 
                donhang.diachi,
                donhang.sdt, 
                donhang.email, 
                donhang.thoigian_mua, 
                donhang.pt_thanhtoan, 
                donhang.soluong, 
                donhang.id_trangthai_donhang, 
                donhang.id_taikhoan, 
                trangthai_donhang.ten_trangthai
        FROM donhang
        LEFT JOIN trangthai_donhang ON trangthai_donhang.id_trangthai = donhang.id_trangthai_donhang
        WHERE donhang.id_taikhoan = :id";
    $donhang = pdo_query($sql, ['id' => $id]);
    return $donhang;
}

// Lấy tất cả các đơn hàng
// Hàm lấy tất cả các đơn hàng
function loadall_donhang()
{
    $sql = "SELECT 
                donhang.id,
                donhang.nguoidung,
                donhang.sdt,
                donhang.email,
                donhang.diachi,
                donhang.thoigian_mua,
                donhang.pt_thanhtoan,
                donhang.soluong,
                donhang.id_trangthai_donhang,   -- Sử dụng id_trangthai_donhang từ bảng donhang
                donhang.id_taikhoan,
                trangthai_donhang.ten_trangthai   -- Truyền tên trạng thái từ bảng trangthai_donhang
            FROM donhang
            INNER JOIN trangthai_donhang ON trangthai_donhang.id_trangthai = donhang.id_trangthai_donhang";  // Kết nối bằng id_trangthai_donhang
    $listdonhang = pdo_query($sql);
    return $listdonhang;
}


// Lấy một đơn hàng theo ID
// Hàm lấy một đơn hàng theo ID
// Hàm lấy một đơn hàng theo ID
function loadone_donhang($id)
{
    $sql = "SELECT 
                donhang.id,
                donhang.nguoidung,
                donhang.sdt,
                donhang.email,
                donhang.diachi,
                donhang.thoigian_mua,
                donhang.pt_thanhtoan,
                donhang.soluong,
                donhang.id_trangthai_donhang,
                donhang.id_taikhoan,
                trangthai_donhang.ten_trangthai   -- Lấy tên trạng thái từ bảng trangthai_donhang
            FROM donhang
            INNER JOIN trangthai_donhang ON trangthai_donhang.id_trangthai = donhang.id_trangthai_donhang
            WHERE donhang.id = :id";  // Lọc theo ID đơn hàng
    $donhang = pdo_query_one($sql, ['id' => $id]);  // Truyền tham số id vào câu lệnh SQL
    return $donhang;
}



// Lấy thông tin giỏ hàng theo id đơn hàng
function load_cart($id_donhang)
{
    $sql = "SELECT giohang.id, giohang.id_donhang, giohang.id_tk, giohang.tensp, giohang.giasp, giohang.soluong 
            FROM giohang WHERE giohang.id_donhang = :id_donhang";
    $cart = pdo_query($sql, ['id_donhang' => $id_donhang]);
    return $cart;
}

// Hủy đơn hàng
function huydonhang($id)
{
    $sql = "UPDATE donhang SET id_trangthai_donhang = 8 WHERE id = :id"; // Giả sử trạng thái '8' là trạng thái hủy
    pdo_execute($sql, ['id' => $id]);
    header("Location: index.php?act=listdh");
}

// Cập nhật thông tin đơn hàng
function update_donhang($id, $nguoidung, $sdt, $email, $diachi, $thoigian_mua, $soluong, $id_trangthai_donhang)
{
    $sql = "UPDATE donhang 
            SET nguoidung = :nguoidung, sdt = :sdt, email = :email, diachi = :diachi, thoigian_mua = :thoigian_mua, soluong = :soluong, id_trangthai_donhang = :id_trangthai_donhang 
            WHERE id = :id";
    pdo_execute($sql, [
        'nguoidung' => $nguoidung, 
        'sdt' => $sdt, 
        'email' => $email, 
        'diachi' => $diachi, 
        'thoigian_mua' => $thoigian_mua,
        'soluong' => $soluong,  // Đảm bảo giá trị này là một số hợp lệ
        'id_trangthai_donhang' => $id_trangthai_donhang, 
        'id' => $id
    ]);
}



?>

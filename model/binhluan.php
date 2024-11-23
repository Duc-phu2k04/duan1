<?php

function insert_binhluan($noidung, $id_nguoidung, $id_sp,  $ngaybinhluan)
{
    if (!empty($noidung)) {
        $sql = "INSERT INTO binhluan VALUES(null,'$noidung','$id_nguoidung','$id_sp','$ngaybinhluan')";
        
        pdo_execute($sql);
    }
}


function delete_binhluan($id_sp,$id)
{
    $sql = "delete from binhluan where id=" . $id;
    pdo_execute($sql);
    header("Location: listbl.php?id_sp=$id_sp");
   
}

function loadall_binhluan_admin()
{
    
    $sql = "
            SELECT binhluan.id, binhluan.noidung, taikhoan.nguoidung, sanpham.tensp , binhluan.id_nguoidung, binhluan.id_sp, binhluan.ngaybinhluan FROM `binhluan` 
            LEFT JOIN taikhoan ON binhluan.id_nguoidung = taikhoan.id
            LEFT JOIN sanpham ON binhluan.id_sp = sanpham.id; 
        ";
    $listbinhluan = pdo_query($sql);
    return $listbinhluan;
}


function loadall_binhluan($id_sp) {
    // Kiểm tra biến $id_sp có giá trị không, nếu không thì trả về mảng rỗng
    if (empty($id_sp)) {
        return [];
    }

    // Truy vấn lấy bình luận từ database
    $sql = "SELECT binhluan.*, nguoidung.ten AS nguoidung FROM binhluan 
            JOIN nguoidung ON binhluan.id_nguoidung = nguoidung.id 
            WHERE binhluan.id_sp = ?";
    return pdo_query($sql, $id_sp);
}

function loadone_binhluan($id)
{

    $sql = "
    SELECT binhluan.id, binhluan.noidung, taikhoan.nguoidung,  binhluan.ngaybinhluan FROM `binhluan` 
     JOIN taikhoan ON binhluan.id_nguoidung = taikhoan.id
     JOIN sanpham ON binhluan.id_sp = sanpham.id
    WHERE sanpham.id = $id;
";
    $binh_luan = pdo_query($sql);
    return $binh_luan;
}


?>
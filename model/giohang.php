<?php


function insert_giohang($id_tk, $id_sp, $tensp, $img, $giasp, $soluong, $id_donhang)
{
    $sql = "insert into giohang values(null,'$id_tk','$id_sp','$tensp','$img','$giasp','$soluong','$id_donhang', 1)";
    return pdo_execute($sql);
}


function load_hoadon_user($id)
{
    $sql = " SELECT 
                giohang.id, 
                giohang.id_tk,
                giohang.id_sp, 
                giohang.tensp, 
                giohang.img, 
                giohang.giasp,
                giohang.soluong, 
                giohang.id_donhang, 
                donhang.thoigian_mua,
                donhang.pt_thanhtoan,
                trangthai_donhang.ten_trangthai
        FROM giohang
        LEFT JOIN donhang 
        ON giohang.id_donhang = donhang.id
        LEFT JOIN trangthai_donhang
        ON giohang.id_trangthai_donhang = trangthai_donhang.id_trangthai
        WHERE id_tk = $id ";
    $giohang = pdo_query($sql);
    return $giohang;
}



function load_cart($id_donhang){
    $sql = "SELECT
                gh.id, 
                gh.id_tk,
                gh.id_sp, 
                gh.tensp, 
                gh.img, 
                gh.giasp,
                gh.soluong, 
                gh.id_donhang,
                dh.thoigian_mua,
                ttdh.ten_trangthai
            FROM giohang as gh
            INNER JOIN donhang as dh 
            ON gh.id_donhang = dh.id
            INNER JOIN trangthai_donhang as ttdh
            ON gh.id_trangthai_donhang = ttdh.id_trangthai
            where gh.id_donhang = $id_donhang";
    $giohang = pdo_query($sql);
    return $giohang;
}


function load_cart_user(){
    $sql = "select * from giohang";
    $giohang = pdo_query($sql);
    return $giohang;
}

// function load_hoadon($id_donhang){
//     $sql = "select * from giohang where id_tk = $id_donhang";
//     $giohang = pdo_query($sql);
//     return $giohang;
// }
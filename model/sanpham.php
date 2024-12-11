<?php

function insert_sanpham($tensp, $giasp, $hinh, $mota, $soluong, $luotxem, $trangthai, $iddm, $id_sptheomua)
{
    $sql = "insert into sanpham (tensp, giasp, img , mota, soluong, luotxem, trangthai, iddm, id_sptheomua) values ('$tensp', '$giasp', '$hinh', '$mota','$soluong','$luotxem','$trangthai', '$iddm',  '$id_sptheomua')";
    pdo_execute($sql);

}


function loadall_sanpham_top5()
{
    $sql = "select * from sanpham where 1 order by giasp desc limit 0,5";
    $sanphamtop5 = pdo_query($sql);
    return $sanphamtop5;
}

function loadall_sanpham_top10()
{
    $sql = "select * from sanpham where 1 order by giasp desc limit 0,10";
    $sanphamtop10 = pdo_query($sql);
    return $sanphamtop10;
}

function loadall_shop($kyw = " ", $iddm = 0)
{
    $sql = "select * from sanpham where 1";
    if ($kyw != "") {
        $sql .= " and tensp like '%" . $kyw . "%'";
    }
    if ($iddm > 0) {
        $sql .= " and iddm ='" . $iddm . "'";
    }
    $sql .= " order by luotxem asc limit 0, 10";
    // $sql = "select * from sanpham where 1 order by id desc ";
    $sanphamShop = pdo_query($sql);
    return $sanphamShop;
}

function load_sanpham_top6()
{
    $sql = "select * from sanpham order by giasp desc limit 6";
    $sanphamtop6 = pdo_query($sql);
    return $sanphamtop6;
}



function delete_sapham($id)
{
    $sql = "delete from sanpham where id=" . $id;
    pdo_execute($sql);
}



function loadall_sanpham($kyw = " ", $iddm = 0)
{
    $sql = "select * from sanpham where 1";
    if ($kyw != "") {
        $sql .= " and tensp like '%" . $kyw . "%'";
    }
    if ($iddm > 0) {
        $sql .= " and iddm ='" . $iddm . "'";
    }

    $sql .= " order by id desc";

    $listsanpham = pdo_query($sql);
    return $listsanpham;
}

function loadall_sp_theomua($kyw = " ", $id_sptheomua = 0)
{
    $sql = "select * from sanpham where 1";
    if ($kyw != "") {
        $sql .= " and tensp like '%" . $kyw . "%'";
    }
    if ($id_sptheomua > 0) {
        $sql .= " and id_sptheomua ='" . $id_sptheomua . "'";
    }

    $sql .= " order by id desc";

    $listsp_theomua = pdo_query($sql);
    return $listsp_theomua;
}



function loadone_sanpham($id)
{
    $sql = "select * from sanpham where id= " . $id;
    $sanpham = pdo_query_one($sql);
    return $sanpham;
}

// function load_ten_dm($iddm)
// {
//     if ($iddm > 0) {
//         $sql = "select * from danhmuc where id=" . $iddm;
//         $danhmuc = pdo_query_one($sql);
//         extract($danhmuc);
//         return $tendm;
//     } else {
//         return "";
//     }
// }


function update_sanpham($id, $iddm, $id_sptheomua, $tensp, $giasp, $mota, $soluong, $luotxem, $trangthai, $hinh)
{
    if ($hinh != "") {
        $sql = " update sanpham set iddm = '" . $iddm . "' , id_sptheomua = '" . $id_sptheomua . "' , tensp = '" . $tensp . "', giasp = '" . $giasp . " ', mota = '" . $mota . "', soluong='" . $soluong . "', luotxem='" . $luotxem . "', trangthai='" . $trangthai . "', img = '" . $hinh . "' where id = " . $id;
    } else {
        $sql = " update sanpham set iddm = '" . $iddm . "' , id_sptheomua = '" . $id_sptheomua . "' , tensp = '" . $tensp . "', giasp = '" . $giasp . " ', mota = '" . $mota . "', soluong='" . $soluong . "', luotxem='" . $luotxem . "', trangthai='" . $trangthai . "' where id = " . $id;
    }
    pdo_execute($sql);
}

function tang_luotxem($luotxem,$idsp){
    $sql = "UPDATE sanpham SET luotxem='$luotxem' WHERE id_sp='$idsp'";
    pdo_execute($sql);
}

?>
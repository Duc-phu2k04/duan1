<?php

function tinhtongsp(){
    $sql = "select Count(*) as tongsp from sanpham";
    $tongsp = pdo_query($sql);
    return $tongsp;
}

function tinhtongdm(){
    $sql = "select Count(*) as tongdm from danhmuc";
    $tongdm = pdo_query($sql);
    return $tongdm;
}

function tinhtongtk(){
    $sql = "select Count(*) as tongtk from taikhoan";
    $tongtk = pdo_query($sql);
    return $tongtk;
}

function tinhtongbl(){
    $sql = "select Count(*) as tongbl from binhluan";
    $tongbl = pdo_query($sql);
    return $tongbl;
}
?>
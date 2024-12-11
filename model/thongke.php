<?php
    function loadall_thongke(){
        $sql="select danhmuc.id as madm, danhmuc.tendm , count(sanpham.id) as countsp, min(sanpham.giasp) as minprice, max(sanpham.giasp) as maxprice, avg(sanpham.giasp) as avgprice"; 
        $sql.=" from  sanpham left join danhmuc on danhmuc.id = sanpham.iddm ";
        $sql.=" group by danhmuc.id order by danhmuc.id asc";
        $listtk=pdo_query($sql);
        return $listtk;
    }


?>
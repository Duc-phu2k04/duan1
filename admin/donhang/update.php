<?php

if (is_array($donhang)) {
    extract($donhang);
}
?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Đơn hàng</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Sửa đơn hàng</h4>
        </div>
        <div class="card-body">

            <div class="table-responsive">

                <br>
                <form action="index.php?act=updatedh" method="post">
                    <div class="mb-3">
                        <label for="exampleInputId" class="form-label">Mã đơn hàng</label>
                        <input type="hidden" class="form-control" name="id" value="<?= $id ?>">
                        <input type="text" class="form-control" name="id" value="<?= $id ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Tên khách hàng</label>
                        <input type="text" class="form-control" name="nguoidung" value="<?= $nguoidung ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="sdt" value="<?= $sdt ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Email</label>
                        <input type="text" class="form-control" name="email" value="<?= $email?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Địa chỉ giao hàng</label>
                        <input type="text" class="form-control" name="diachi" value="<?= $diachi ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Thời gian mua</label>
                        <input type="text" class="form-control" name="thoigian_mua" value="<?= $thoigian_mua ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Số lượng</label>
                        <input type="number" class="form-control" name="soluong" value="<?= $soluong ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Trạng thái</label><br>
                        
                            <select name="trangthai" class="form-control" id="trangthai">
                            <?php
                            foreach ($listtrangthai as $trangthai):
                                extract($trangthai); ?>
                                <option <?= $trangthai['id_trangthai'] == $donhang['id_trangthai_donhang'] ? 'selected' : '' ?>
                                    value="<?= $trangthai['id_trangthai'] ?>">
                                    <?= $trangthai['ten_trangthai'] ?>
                                </option>

                            <?php endforeach; ?>

                        </select>

                    </div>
                    <input type="submit" class="btn btn-success" onclick="return confirm('Bạn có muốn cập nhật không ?')" name="capnhat" value="Cập nhật">
                    <input type="reset" class="btn btn-info" value="Nhập lại">

                    <a href="index.php?act=listdh"><input type="button" class="btn btn-primary" value="Danh sách"></a>
                    <?php

                    if (isset($thongbao) && ($thongbao != ""))
                        echo $thongbao;

                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
<?php

include "../../model/pdo.php";
include "../../model/binhluan.php";

$id_sp = $_REQUEST['id_sp'];
$listbinhluan = loadall_binhluan($id_sp);

if(isset($_GET['id']) && ($_GET['id'] > 0)) {
    delete_binhluan($id_sp,$_GET['id']);
}

?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary">Bình luận</h4>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <br>
            <table id="dataTable" width="100%"  cellspacing="0" >
                
                    <tr >
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Nội dung</th>
                        <th>Ngày bình luận</th>
                        <th>Hành động</th>

                    </tr>
                

                    <?php
                    foreach($listbinhluan as $key => $binhluan):
                        extract($binhluan);
                        $xoabl = "listbl.php?id_sp=$id_sp&id=".$id;
                        ?>

                        <tr class="text-center" style="text-align: center;">
                            <td class="text-center" style=" padding-top: 30px;">
                                <?= $key + 1 ?>
                            </td>
                            <td class="text-center" style=" padding-top: 30px;">
                                <?= $nguoidung ?>
                            </td>
                            <td class="text-center" style=" padding-top: 30px;">
                                <?= $noidung ?>
                            </td>
                            <td class="text-center" style=" padding-top: 30px;">
                                <?= $ngaybinhluan ?>
                            </td>
                            <td class="text-center" style=" padding-top: 30px;">
                                <a href="<?= $xoabl ?>" onclick="return confirmDeletebl()"><input type="button"
                                        class="form-control btn btn-danger mt-2" style="background-color: red; color: white; width: 130px; height: 40px; border-radius: 5px" value="Xóa"></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDeletebl() {
        if (confirm("Bạn có muốn xóa bình luận này không")) {
            document.location = "index.php?act=listbl";
        } else {
            return false;
        }
    }
</script>


</div>
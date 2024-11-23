<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary">Thống kê sản phẩm</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <br>
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Mã danh mục</th>
                            <th>Tên danh mục</th>
                            <th>Số lượng</th>
                            <th>Giá cao nhất</th>
                            <th>Giá thấp nhất</th>
                            <th>Giá trung bình</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($listthongke as $thongke):
                            extract($thongke);
                            ?>
                            <tr>
                                <td>
                                    <?= $thongke['madm'] ?>
                                </td>
                                <td>
                                    <?= $thongke['tendm'] ?>
                                </td>
                                <td>
                                    <?= $thongke['countsp'] ?>
                                </td>
                                <td>
                                    <?= $thongke['maxprice'] ?>
                                </td>
                                <td>
                                    <?= $thongke['minprice'] ?>
                                </td>
                                <td>
                                    <?= $thongke['avgprice'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>



                    </tbody>
                </table>
                <form action="">

                    <a href="index.php?act=bieudo"><input type="button" class="  btn btn-success" value="Biểu đồ"></a>

                </form>
            </div>
        </div>
    </div>

</div>
</div>
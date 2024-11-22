<form action="index.php?act=suabl&id=<?= $binhluan['id'] ?>" method="post">
    <div class="formtitle">
        <h1>Sửa Bình Luận</h1>
    </div>
    <div class="formcontent">
        <input type="text" name="noidung" value="<?= $binhluan['noidung'] ?>">
        <input type="submit" value="Cập nhật">
    </div>
</form>
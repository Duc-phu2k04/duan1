<!-- admin/binhluan/list.php -->

<div class="row">
    <form action="index.php?act=dskh" method="post">
        <div class="row formtitle">
            <h1>DANH SÁCH BÌNH LUẬN</h1>
        </div>
        
        <div class="row formcontent">
            <div class="row mb10 formdsloai">
                <table>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Id User</th>
                        <th>ID Name</th>
                        <th>Id Pro</th>
                        <th>Nội Dung</th>
                        <th>Ngày Bình luận</th>
                        <th>Action</th>
                    </tr>
                    <?php
                      try {
                        // Database connection (PDO example)
                        $pdo = new PDO("mysql:host=localhost;dbname=nhom2", "root", "");
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        // Query to fetch comments
                        $sql = "SELECT * FROM binhluan";  // Modify according to your database schema
                        $stmt = $pdo->query($sql);
                        
                        // Fetch the data
                        $listbinhluan = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    // Hiển thị danh sách bình luận
                    if (is_array($listbinhluan) && !empty($listbinhluan)) {
                        foreach ($listbinhluan as $binhluan) {
                            extract($binhluan);
                            $xoabl = "index.php?act=xoabl&id=" . $id;  // Đường dẫn xóa bình luận
                            echo '
                            <tr>
                                <td><input type="checkbox" name="delete[]" value="' . $id . '" id=""></td>
                                <td>' . $id . '</td>
                               <td>' . $user_id . '</td>
                                <td>' . $user_name . '</td>
                                <td>' . $product_id . '</td>
                                <td>' . $noidung . '</td>
                                <td>' . $trangthai . '</td>
                                <td>
                                      <a href="' . $xoabl . '"><button type="button">Xóa</button></a>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo "<tr><td colspan='8'>Không có bình luận nào.</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </form>
</div>

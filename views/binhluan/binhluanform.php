<!-- views/binhluan/binhluanform.php -->

<?php
session_start();
require_once('../../commons/pdo.php');
require_once('./models/binhluan.php');

$product_id = $_REQUEST['product_id'];  // Lấy ID sản phẩm từ tham số GET hoặc POST
$dsbl = loadall_binhluan($product_id);  // Lấy danh sách bình luận của sản phẩm
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bình Luận Sản Phẩm</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="row mb">
        <?php
        if (isset($_SESSION['user'])) {
            extract($_SESSION['user']);
        ?>

        <div class="boxtitle">
            Bình Luận
        </div>

        <div class="boxcontent2 menudoc binhluan">
            <ul>
                <table>
                    <?php 
                    // Hiển thị danh sách bình luận
                    foreach ($dsbl as $bl) {
                        extract($bl);
                        echo '<tr><td>' . $noidung . '</td>';
                        echo '<td>' . $user_id . '</td>';
                        echo '<td>' . $trangthai . '</td></tr>';
                    }
                    ?>
                </table>
            </ul>
        </div>

        <div class="boxfooter searchbox">
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
                <input type="hidden" name="product_id" value="<?= $product_id ?>">
                <input type="text" name="noidung" placeholder="Nhập bình luận..." required>
                <input type="submit" name="guibinhluan" value="Gửi Bình Luận">
            </form>
        </div>

        <?php
        // Xử lý khi người dùng gửi bình luận mới
        if (isset($_POST['guibinhluan']) && $_POST['guibinhluan']) {
            $user_id = $_SESSION['user']['id']; 
            $user_name = $_SESSION['user']['user_name'];  // Lấy tên người dùng từ session
            $noidung = $_POST['noidung'];
            $trangthai = date('h:i:sa d/m/Y');
        
            // Gửi bình luận mới vào cơ sở dữ liệu
            insert_binhluan($user_id, $user_name, $product_id, $noidung, $trangthai);
        
            // Sau khi gửi bình luận, quay lại trang hiện tại
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit;
        }
        ?>

        </div>
    </div>

    <?php
        // Nếu người dùng chưa đăng nhập, yêu cầu đăng nhập
        } else {
            echo 'Vui lòng đăng nhập để bình luận.';
        }
    ?>
</body>
</html>

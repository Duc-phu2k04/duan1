<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ - Cửa Hàng</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-item img {
            width: 100%;
            height: 500px; 
            object-fit: cover; 
        }
    </style>
</head>
<body>
    <!-- Thanh điều hướng -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Cửa Hàng</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Đặt các phần tử bên trái -->
            <ul class="navbar-nav mr-auto">
                <!-- Thanh tìm kiếm -->
                <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
                    <input class="form-control mr-sm-2" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search" name="query">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                </form>

                <!-- Menu danh mục -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Danh Mục
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Danh mục 1</a>
                        <a class="dropdown-item" href="#">Danh mục 2</a>
                        <a class="dropdown-item" href="#">Danh mục 3</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Khác</a>
                    </div>
                </li>

                <!-- Giỏ hàng -->
                <li class="nav-item">
                    <a class="nav-link" href="view/cart.php">Giỏ Hàng</a>
                </li>
            </ul>

            <!-- Phần đăng nhập và thông tin người dùng nằm phía bên phải -->
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Nếu người dùng đã đăng nhập -->
                    <?php if ($_SESSION['user']['vaitro'] == '1'): ?>
                        <!-- Nếu người dùng là admin, hiển thị nút Admin -->
                        <li class="nav-item">
                            <a class="nav-link" href="admin.php">Admin</a>
                        </li>
                    <?php endif; ?>
                    
                    <!-- Hiển thị tên người dùng và nút Đăng xuất -->
                    <li class="nav-item">
                        <span class="nav-link">Xin chào, <?php echo $_SESSION['user']['ten']; ?></span>
                    </li>
                    <!-- Khi nhấn vào tên người dùng, chuyển đến trang thông tin khách hàng -->
                    <li class="nav-item">
                        <a class="nav-link" href="customer_info.php">Thông tin khách hàng</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="../user/logout.php">Đăng xuất</a>

                    </li>
                <?php else: ?>
                    <!-- Nếu người dùng chưa đăng nhập -->
                    <li class="nav-item">
                        <a class="nav-link" href="./user/login.php">Đăng Nhập</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Nội dung trang chủ -->
    <div class="container mt-5">
        <h1 class="text-center">Chào mừng đến với Cửa Hàng của chúng tôi!</h1>
        
        <!-- Slideshow Banner -->
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://rolex.dafc.com.vn/rolex/wp-content/uploads/2024/06/rolex-new-watches-2024-dafc-banner-mobile.jpg" class="d-block w-100" alt="Banner 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Banner 1</h5>
                        <p>Mô tả ngắn cho banner 1.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://euluxury.vn/data/new/Gia_dong_ho_Rolex_nam_(14).jpg" class="d-block w-100" alt="Banner 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Banner 2</h5>
                        <p>Mô tả ngắn cho banner 2.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://www.bobswatches.com/rolex-blog/wp-content/uploads/2021/02/Rolex_Submariner_116610_5D3_4341-Edit-1.jpg" class="d-block w-100" alt="Banner 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Banner 3</h5>
                        <p>Mô tả ngắn cho banner 3.</p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <p class="text-center">Khám phá các sản phẩm nổi bật dưới đây:</p>

        <!-- Danh sách sản phẩm -->
        <?php
        // Gọi file kết nối cơ sở dữ liệu
        require_once '../commons/pdo.php'; // Đảm bảo đã kết nối thành công

        // Kết nối tới cơ sở dữ liệu
        $pdo = pdo_get_connection(); // Sử dụng hàm kết nối để tạo đối tượng PDO

        // Truy vấn danh sách sản phẩm từ cơ sở dữ liệu
        $sql = "SELECT id, name, anh, gia, mota FROM sanpham";
        try {
            // Thực hiện truy vấn và lấy tất cả sản phẩm
            $stmt = $pdo->query($sql);
            $products = $stmt->fetchAll();
        } catch (PDOException $e) {
            // Xử lý lỗi nếu có
            $thongbao = "Lỗi khi lấy danh sách sản phẩm: " . $e->getMessage();
        }

        // Đảm bảo rằng bạn đã nhúng Bootstrap CSS trong phần head của HTML
        echo '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />';
        echo '<style>
            /* Cố định chiều cao của thẻ card */
            .product-card {
                display: flex;
                flex-direction: column;
                height: 100%;
            }
            /* Cố định chiều cao của ảnh và đảm bảo không bị lệch */
            .product-card img {
                height: 200px;
                object-fit: cover;
                overflow: hidden;
            }
            /* Cố định chiều cao của phần card-body để tất cả đều đồng đều */
            .card-body {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }
            .card-body h5, .card-body p {
                margin: 0;
            }
            /* Đảm bảo nút xem chi tiết luôn ở dưới cùng */
            .card-body a {
                margin-top: auto;
            }
        </style>';

        // Kiểm tra xem có sản phẩm nào để hiển thị không
        if (!empty($products)) {
            echo "<div class='container my-4'>";
            echo "<h2 class='text-center mb-4'>Danh Sách Sản Phẩm</h2>";
            echo "<div class='row g-4'>"; // Mở thẻ div cho hàng sản phẩm với khoảng cách giữa các cột

            // Duyệt qua danh sách sản phẩm
            foreach ($products as $product) {
                echo "<div class='col-md-3 col-sm-6'>"; // Đảm bảo có tối đa 4 sản phẩm trong mỗi hàng
                echo "<div class='card shadow-sm border-light rounded product-card'>"; // Thêm lớp 'product-card'

                // Ảnh sản phẩm có chiều cao đồng đều, không bị biến dạng
                echo "<img src='" . htmlspecialchars($product['anh']) . "' alt='" . htmlspecialchars($product['name']) . "' class='card-img-top' />";
                
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>" . htmlspecialchars($product['name']) . "</h5>";
                echo "<p class='card-text'>Giá: <span class='fw-bold'>" . htmlspecialchars(number_format($product['gia'])) . " VND</span></p>";
                echo "<p class='card-text'>" . htmlspecialchars($product['mota']) . "</p>";
                echo "<a href='chitiet.php?id=" . $product['id'] . "' class='btn btn-primary w-100'>Xem chi tiết</a>"; // Nút xem chi tiết
                echo "</div>"; // Đóng thẻ card-body
                echo "</div>"; // Đóng thẻ card
                echo "</div>"; // Đóng thẻ col
            }

            echo "</div>"; // Đóng thẻ row
            echo "</div>"; // Đóng thẻ container
        } else {
            echo "<p class='text-center text-danger'>Không có sản phẩm nào để hiển thị.</p>";
        }

        // Tùy chọn hiển thị thông báo lỗi nếu có
        if (isset($thongbao)) {
            echo "<p class='text-danger text-center'>" . htmlspecialchars($thongbao) . "</p>";
        }

        echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>';
        ?>
    </div>

    <!-- JavaScript Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

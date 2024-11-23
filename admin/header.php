<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin </title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                <div class="sidebar-brand-text mx-3">
                    <h3>Admin</h3>
                </div>
            </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Chức năng
            </div>

            <li class="nav-item">
                <a class="nav-link" href="index.php?act=listtk">
                    <i class="fas fa-fw fa-user-circle"></i>
                    <span>Quản lý tài khoản</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?act=listdm">
                    <i class="fas fa-fw fa-clipboard"></i>
                    <span>Quản lý danh mục</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?act=listsp">
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>Quản lý sản phẩm</span></a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link" href="index.php?act=thongke">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Thống kê</span></a>
            </li> -->

            <li class="nav-item">
                <a class="nav-link" href="index.php?act=listdh">
                    <!-- <i class="fas fa-fw "></i> -->
                    <i class="fas fa-fw fa-solid fa-basket-shopping"></i>
                    <span>Đơn hàng</span></a>
            </li>


            <hr class="sidebar-divider d-none d-md-block">


            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                   

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/12.jpg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                               
                                <a class="dropdown-item" href="../Client/index.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Trang web
                                </a>
                                
                            </div>
                        </li>
                    </ul>


                </nav>
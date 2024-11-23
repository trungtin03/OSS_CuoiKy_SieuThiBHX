<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .dashboard-container {
            margin-top: 50px;
        }
        body {
            background-image: url('images/bachhoaxanh_background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
        }
        .card {
            cursor: pointer;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Quản Lý Bách Hóa Xanh</a>
        <div class="d-flex">
            <a href="logout_admin.php" class="btn btn-outline-light">Đăng Xuất</a>
        </div>
    </div>
</nav>
<div class="container dashboard-container">
    <div class="row">
        <div class="col-md-6 col-lg-4 mb-4">
            <a href="admin_products.php" class="text-decoration-none text-dark">
                <div class="card text-center shadow h-100">
                    <div class="card-body">
                        <i class="fas fa-box-open fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Quản Lý Sản Phẩm</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <a href="admin_customers.php" class="text-decoration-none text-dark">
                <div class="card text-center shadow h-100">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Quản Lý Khách Hàng</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-lg-4 mb-4">
            <a href="admin_discounts.php" class="text-decoration-none text-dark">
                <div class="card text-center shadow h-100">
                    <div class="card-body">
                        <i class="fas fa-users fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Quản Lý Mã Giảm Giá</h5>
                    </div>
                </div>
            </a>
        </div>
        <!-- Bạn có thể thêm các chức năng khác như Quản Lý Đơn Hàng, Mã Giảm Giá, v.v. -->
    </div>
</div>
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS và dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

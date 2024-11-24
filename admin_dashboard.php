<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

// Truy vấn số liệu thống kê
$total_products_sql = "SELECT COUNT(*) AS total FROM sanpham";
$total_customers_sql = "SELECT COUNT(*) AS total FROM taikhoan";
$total_discounts_sql = "SELECT COUNT(*) AS total FROM giamgia";
$total_orders_sql = "SELECT COUNT(*) AS total FROM hoadon";
$total_categories_sql = "SELECT COUNT(*) AS total FROM loaisanpham";

$total_products = mysqli_fetch_assoc(mysqli_query($conn, $total_products_sql))['total'];
$total_customers = mysqli_fetch_assoc(mysqli_query($conn, $total_customers_sql))['total'];
$total_discounts = mysqli_fetch_assoc(mysqli_query($conn, $total_discounts_sql))['total'];
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, $total_orders_sql))['total'];
$total_categories = mysqli_fetch_assoc(mysqli_query($conn, $total_categories_sql))['total'];
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #586667;
            color: #fff;
            transition: all 0.3s;
        }
        .sidebar .nav-link {
            color: #fff;
        }
        .sidebar .nav-link:hover {
            background: #495057;
        }
        /* Content */
        .content {
            width: 100%;
            padding: 20px;
            background: #f8f9fa;
        }
        .custom-bg1 {
            background-color: #6E7261 !important;
        }
.custom-bg2 {
    background-color: #999F7B !important;
}
.custom-bg3 {
    background-color: #C2C8AC !important;
}
.custom-bg4 {
    background-color: #B4AD90 !important;
}
        .custom-bg5 {
            background-color: #A8855F !important;
        }
        /* Card Styles */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card .card-body i {
            font-size: 2.5rem;
        }
        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                min-width: 100px;
                max-width: 100px;
                text-align: center;
            }
            .sidebar .nav-link {
                padding: 10px 0;
                font-size: 0.9rem;
            }
            .sidebar .nav-link span {
                display: none;
            }
            .content {
                padding: 10px;
            }
            .card .card-body i {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <nav class="sidebar d-flex flex-column p-3">
        <a href="admin_dashboard.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none text-white">
            <i class="fas fa-store fa-2x me-2"></i>
            <span class="fs-4">Bách Hóa Xanh</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-2">
                <a href="admin_products.php" class="nav-link text-white">
                    <i class="fas fa-box-open me-2"></i>
                    <span>Sản Phẩm</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="admin_customers.php" class="nav-link text-white">
                    <i class="fas fa-users me-2"></i>
                    <span>Khách Hàng</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="admin_discounts.php" class="nav-link text-white">
                    <i class="fas fa-percent me-2"></i>
                    <span>Mã Giảm Giá</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="admin_orders.php" class="nav-link text-white">
                    <i class="fas fa-receipt me-2"></i>
                    <span>Hóa Đơn</span>
                </a>
            </li>
            <li class="nav-item mb-2">
                <a href="admin_categories.php" class="nav-link text-white">
                    <i class="fas fa-tags me-2"></i>
                    <span>Loại SP</span>
                </a>
            </li>
            <!-- Bạn có thể thêm các mục khác ở đây -->
        </ul>
    </nav>

    <!-- Content -->
    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Dashboard</h1>
            <a href="logout_admin.php" class="btn btn-danger"><i class="fas fa-sign-out-alt me-2"></i>Đăng Xuất</a>
        </div>
        <div class="row g-4">
            <!-- Sản Phẩm -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-white bg-primary custom-bg1 h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-box-open mb-3"></i>
                        <h5 class="card-title">Sản Phẩm</h5>
                        <p class="card-text fs-4"><?php echo $total_products; ?></p>
                    </div>
                    <a href="admin_products.php" class="stretched-link"></a>
                </div>
            </div>
            <!-- Khách Hàng -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-white bg-success custom-bg2 h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-users mb-3"></i>
                        <h5 class="card-title">Khách Hàng</h5>
                        <p class="card-text fs-4"><?php echo $total_customers; ?></p>
                    </div>
                    <a href="admin_customers.php" class="stretched-link"></a>
                </div>
            </div>
            <!-- Mã Giảm Giá -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-white bg-warning custom-bg3 h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-percent mb-3"></i>
                        <h5 class="card-title">Mã Giảm Giá</h5>
                        <p class="card-text fs-4"><?php echo $total_discounts; ?></p>
                    </div>
                    <a href="admin_discounts.php" class="stretched-link"></a>
                </div>
            </div>
            <!-- Hóa Đơn -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-white bg-danger custom-bg4 h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-receipt mb-3"></i>
                        <h5 class="card-title">Hóa Đơn</h5>
                        <p class="card-text fs-4"><?php echo $total_orders; ?></p>
                    </div>
                    <a href="admin_orders.php" class="stretched-link"></a>
                </div>
            </div>
            <!-- Loại Sản Phẩm -->
            <div class="col-md-6 col-lg-3">
                <div class="card text-white bg-info custom-bg5 h-100">
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <i class="fas fa-tags mb-3"></i>
                        <h5 class="card-title">Loại SP</h5>
                        <p class="card-text fs-4"><?php echo $total_categories; ?></p>
                    </div>
                    <a href="admin_categories.php" class="stretched-link"></a>
                </div>
            </div>
            <!-- Bạn có thể thêm các thẻ thống kê khác ở đây -->
        </div>
    </div>

    <!-- Bootstrap JS và dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

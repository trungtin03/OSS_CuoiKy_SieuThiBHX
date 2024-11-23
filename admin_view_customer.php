<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

// Kiểm tra xem có ID khách hàng trong URL không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_customers.php");
    exit();
}

$ma_tai_khoan = intval($_GET['id']);

// Truy vấn thông tin khách hàng
$sql = "SELECT * FROM taikhoan WHERE ma_tai_khoan = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ma_tai_khoan);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: admin_customers.php");
    exit();
}

$customer = $result->fetch_assoc();

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Khách Hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .customer-detail-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
        }
        .table th {
            width: 30%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
        <div class="d-flex">
            <a href="logout_admin.php" class="btn btn-outline-light">Đăng Xuất</a>
        </div>
    </div>
</nav>
<div class="container customer-detail-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <h3 class="card-title text-center mb-4">Chi Tiết Khách Hàng</h3>
                <table class="table table-bordered">
                    <tr>
                        <th>ID</th>
                        <td><?php echo htmlspecialchars($customer['ma_tai_khoan']); ?></td>
                    </tr>
                    <tr>
                        <th>Tên Tài Khoản</th>
                        <td><?php echo htmlspecialchars($customer['ten_tai_khoan']); ?></td>
                    </tr>
                    <tr>
                        <th>Họ Tên</th>
                        <td><?php echo htmlspecialchars($customer['ho_ten']); ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo htmlspecialchars($customer['email']); ?></td>
                    </tr>
                    <tr>
                        <th>SĐT</th>
                        <td><?php echo htmlspecialchars($customer['sdt']); ?></td>
                    </tr>
                    <tr>
                        <th>Địa Chỉ</th>
                        <td><?php echo htmlspecialchars($customer['dia_chi']); ?></td>
                    </tr>
                    <tr>
                        <th>Ngày Sinh</th>
                        <td><?php echo htmlspecialchars($customer['ngay_sinh']); ?></td>
                    </tr>
                    <tr>
                        <th>Giới Tính</th>
                        <td><?php echo htmlspecialchars($customer['gioi_tinh']); ?></td>
                    </tr>
                </table>
                <a href="admin_customers.php" class="btn btn-secondary w-100 mt-3">Quay lại danh sách khách hàng</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS và dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

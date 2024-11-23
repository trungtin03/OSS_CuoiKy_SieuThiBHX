<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

// Truy vấn tất cả khách hàng
$sql = "SELECT * FROM taikhoan";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Khách Hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .customers-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .table img {
            width: 50px;
            height: auto;
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
<div class="container customers-container">
    <div class="d-flex justify-content-between mb-3">
        <h2>Quản Lý Khách Hàng</h2>
        <!-- Bạn có thể thêm các chức năng khác nếu cần -->
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên Tài Khoản</th>
                <th>Họ Tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Địa Chỉ</th>
                <th>Ngày Sinh</th>
                <th>Giới Tính</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($row['ma_tai_khoan'])."</td>";
                    echo "<td>".htmlspecialchars($row['ten_tai_khoan'])."</td>";
                    echo "<td>".htmlspecialchars($row['ho_ten'])."</td>";
                    echo "<td>".htmlspecialchars($row['email'])."</td>";
                    echo "<td>".htmlspecialchars($row['sdt'])."</td>";
                    echo "<td>".htmlspecialchars($row['dia_chi'])."</td>";
                    echo "<td>".htmlspecialchars($row['ngay_sinh'])."</td>";
                    echo "<td>".htmlspecialchars($row['gioi_tinh'])."</td>";
                    echo "<td>
                            <a href='admin_view_customer.php?id=".$row['ma_tai_khoan']."' class='btn btn-sm btn-info me-2'>Xem</a>
                            <a href='admin_edit_customer.php?id=".$row['ma_tai_khoan']."' class='btn btn-sm btn-info me-2'>Chỉnh sửa</a>
                            <a href='admin_delete_customer.php?id=".$row['ma_tai_khoan']."' class='btn btn-sm btn-danger' onclick=\"return confirm('Bạn có chắc chắn muốn xóa khách hàng này?');\">Xóa</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>Không có khách hàng nào.</td></tr>";
            }
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS và dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

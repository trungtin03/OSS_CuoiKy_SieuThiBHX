<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

$message = '';
if (isset($_GET['message'])) {
    $msg = $_GET['message'];
    switch ($msg) {
        case 'add_success':
            $message = '<div class="alert alert-success">Thêm mã giảm giá thành công.</div>';
            break;
        case 'add_error':
            $message = '<div class="alert alert-danger">Lỗi khi thêm mã giảm giá.</div>';
            break;
        case 'update_success':
            $message = '<div class="alert alert-success">Cập nhật mã giảm giá thành công.</div>';
            break;
        case 'update_error':
            $message = '<div class="alert alert-danger">Lỗi khi cập nhật mã giảm giá.</div>';
            break;
        case 'delete_success':
            $message = '<div class="alert alert-success">Xóa mã giảm giá thành công.</div>';
            break;
        case 'delete_error':
            $message = '<div class="alert alert-danger">Lỗi khi xóa mã giảm giá.</div>';
            break;
        case 'discount_not_found':
            $message = '<div class="alert alert-warning">Mã giảm giá không tồn tại.</div>';
            break;
        default:
            $message = '';
    }
}

// Truy vấn tất cả các mã giảm giá
$sql = "SELECT * FROM giamgia";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Mã Giảm Giá</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .discount-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .table-responsive {
            margin-top: 20px;
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
<div class="container discount-container">
    <h2 class="text-center">Danh Sách Mã Giảm Giá</h2>
    <?php echo $message; ?>
    <a href="admin_add_discount.php" class="btn btn-primary">Thêm Mã Giảm Giá Mới</a>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Mã Giảm Giá</th>
                    <th>Tên Mã Giảm Giá</th>
                    <th>Mệnh Giá Giảm Giá (%)</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['ma_giam_gia']); ?></td>
                            <td><?php echo htmlspecialchars($row['ten_ma_giam_gia']); ?></td>
                            <td><?php echo htmlspecialchars($row['menh_gia_giam_gia']); ?>%</td>
                            <td>
                                <a href="admin_edit_discount.php?id=<?php echo $row['ma_giam_gia']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                                <a href="admin_delete_discount.php?id=<?php echo $row['ma_giam_gia']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa mã giảm giá này?');">Xóa</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">Không có mã giảm giá nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Bootstrap JS và dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

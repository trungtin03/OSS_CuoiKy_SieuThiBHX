<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Kiểm tra tham số mã hóa đơn
if (!isset($_GET['ma_hoa_don']) || !is_numeric($_GET['ma_hoa_don'])) {
    header("Location: admin_orders.php");
    exit();
}

$ma_hoa_don = intval($_GET['ma_hoa_don']);

// Kết nối cơ sở dữ liệu
include("config.php");

// Truy vấn hóa đơn
$order_sql = "SELECT * FROM hoadon WHERE ma_hoa_don = ?";
$stmt = $conn->prepare($order_sql);
$stmt->bind_param("i", $ma_hoa_don);
$stmt->execute();
$order_result = $stmt->get_result();

if ($order_result->num_rows === 0) {
    echo "<div class='alert alert-warning m-4'>Không tìm thấy hóa đơn này.</div>";
    exit();
}

$order = $order_result->fetch_assoc();
$stmt->close();

// Truy vấn chi tiết hóa đơn (giả sử có bảng chi_tiet_hoa_don)
$details_sql = "SELECT ct.*, sp.ten_san_pham FROM chitiethoadon ct 
               JOIN sanpham sp ON ct.ma_san_pham = sp.ma_san_pham 
               WHERE ct.ma_hoa_don = ?";
$stmt_details = $conn->prepare($details_sql);
$stmt_details->bind_param("i", $ma_hoa_don);
$stmt_details->execute();
$details_result = $stmt_details->get_result();
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Hóa Đơn #<?php echo htmlspecialchars($ma_hoa_don); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .order-details-container {
            margin-top: 80px; /* Điều chỉnh cho phù hợp với navbar fixed-top */
            margin-bottom: 50px;
        }
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php"><i class="fas fa-store-alt me-2"></i>Bách Hóa Xanh Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_orders.php"><i class="fas fa-receipt me-1"></i>Quản Lý Hóa Đơn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php"><i class="fas fa-sign-out-alt me-1"></i>Đăng Xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container order-details-container">
        <h2 class="mb-4"><i class="fas fa-eye me-2"></i>Chi Tiết Hóa Đơn #<?php echo htmlspecialchars($ma_hoa_don); ?></h2>

        <!-- Thông tin cơ bản của hóa đơn -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                Thông Tin Cơ Bản
            </div>
            <div class="card-body">
                <p><strong>Họ Tên:</strong> <?php echo htmlspecialchars($order['ho_ten']); ?></p>
                <p><strong>SĐT:</strong> <?php echo htmlspecialchars($order['sdt']); ?></p>
                <p><strong>Địa Chỉ:</strong> <?php echo htmlspecialchars($order['dia_chi']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                <p><strong>Tổng Tiền:</strong> <?php echo number_format($order['tong_tien'], 0, ',', '.'); ?> đ</p>
                <p><strong>Thời Gian:</strong> <?php echo htmlspecialchars($order['thoigian']); ?></p>
                <p><strong>Phương Thức Thanh Toán:</strong> <?php echo htmlspecialchars($order['pt_thanh_toan']); ?></p>
            </div>
        </div>

        <!-- Chi tiết các sản phẩm trong hóa đơn -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Chi Tiết Sản Phẩm
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID SP</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền (đ)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($details_result && $details_result->num_rows > 0): ?>
                                <?php while($detail = $details_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($detail['ma_san_pham']); ?></td>
                                        <td><?php echo htmlspecialchars($detail['ten_san_pham']); ?></td>
                                        <td><?php echo htmlspecialchars($detail['so_luong']); ?></td>
                                        <td><?php echo number_format($detail['thanh_tien'], 0, ',', '.'); ?> đ</td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">Không có chi tiết sản phẩm nào.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <a href="admin_orders.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Quay Lại</a>
            <a href="admin_delete_order.php?ma_hoa_don=<?php echo htmlspecialchars($ma_hoa_don); ?>" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này?');"><i class="fas fa-trash-alt me-2"></i>Xóa Hóa Đơn</a>
        </div>
    </div>

    <!-- Bootstrap JS và dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>

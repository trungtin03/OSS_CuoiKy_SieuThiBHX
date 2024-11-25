<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

// Phân trang
$limit = 10; // Số hóa đơn trên mỗi trang
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Tính tổng số hóa đơn
$total_sql = "SELECT COUNT(*) AS total FROM hoadon";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_orders = $total_row['total'];

// Tính tổng doanh thu
$revenue_sql = "SELECT SUM(tong_tien) AS total_revenue FROM hoadon";
$revenue_result = $conn->query($revenue_sql);
$revenue_row = $revenue_result->fetch_assoc();
$total_revenue = $revenue_row['total_revenue'];

// Tính tổng số trang
$total_pages = ceil($total_orders / $limit);

// Truy vấn hóa đơn cho trang hiện tại
$orders_sql = "SELECT * FROM hoadon ORDER BY ma_hoa_don DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($orders_sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$orders_result = $stmt->get_result();

// Kiểm tra thông báo từ URL
$notification = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'deleted') {
        $notification = "<div class='alert alert-success'>Đã xóa hóa đơn thành công!</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Hóa Đơn</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .orders-container {
            margin-top: 80px; /* Điều chỉnh cho phù hợp với navbar fixed-top */
            margin-bottom: 50px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .action-btn {
            margin-right: 5px;
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
                        <a class="nav-link" href="admin_dashboard.php"><i class="fas fa-home me-1"></i>Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php"><i class="fas fa-sign-out-alt me-1"></i>Đăng Xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container orders-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-receipt me-2"></i>Quản Lý Hóa Đơn</h2>
        </div>

        <!-- Thông báo -->
        <?php echo $notification; ?>

        <!-- Thông tin tổng doanh thu -->
        <div class="alert alert-info">
            <strong>Tổng Doanh Thu:</strong> <?php echo number_format($total_revenue, 0, ',', '.'); ?> đ
        </div>

        <!-- Bảng hóa đơn -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Mã Hóa Đơn</th>
                        <th>Họ Tên</th>
                        <th>SĐT</th>
                        <th>Địa Chỉ</th>
                        <th>Email</th>
                        <th>Tổng Tiền (đ)</th>
                        <th>Thời Gian</th>
                        <th>Phương Thức Thanh Toán</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($orders_result && $orders_result->num_rows > 0): ?>
                        <?php while($order = $orders_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($order['ma_hoa_don']); ?></td>
                                <td><?php echo htmlspecialchars($order['ho_ten']); ?></td>
                                <td><?php echo htmlspecialchars($order['sdt']); ?></td>
                                <td><?php echo htmlspecialchars($order['dia_chi']); ?></td>
                                <td><?php echo htmlspecialchars($order['email']); ?></td>
                                <td><?php echo number_format($order['tong_tien'], 0, ',', '.'); ?> đ</td>
                                <td><?php echo htmlspecialchars($order['thoigian']); ?></td>
                                <td><?php echo htmlspecialchars($order['pt_thanh_toan']); ?></td>
                                <td>
                                    <a href="admin_order_details.php?ma_hoa_don=<?php echo htmlspecialchars($order['ma_hoa_don']); ?>" class="btn btn-sm btn-info action-btn" title="Chi Tiết">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="admin_delete_order.php?ma_hoa_don=<?php echo htmlspecialchars($order['ma_hoa_don']); ?>" class="btn btn-sm btn-danger action-btn" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa hóa đơn này?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">Không có hóa đơn nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Phân Trang -->
        <?php if ($total_pages > 1): ?>
            <nav>
                <ul class="pagination">
                    <!-- Nút Trang Trước -->
                    <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php echo ($page <=1 ) ? '#' : "?page=".($page-1); ?>">Trước</a>
                    </li>

                    <!-- Các Nút Trang -->
                    <?php
                        $max_links = 5;
                        $start = max(1, $page - floor($max_links / 2));
                        $end = min($total_pages, $start + $max_links - 1);

                        if(($end - $start) < ($max_links - 1)){
                            $start = max(1, $end - $max_links + 1);
                        }

                        for($i = $start; $i <= $end; $i++):
                    ?>
                        <li class="page-item <?php if($i == $page){ echo 'active'; } ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Nút Trang Sau -->
                    <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php echo ($page >= $total_pages) ? '#' : "?page=".($page+1); ?>">Sau</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS và dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>

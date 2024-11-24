<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
include("config.php");

// Xử lý form khi submit
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ma_giam_gia = trim($_POST['ma_giam_gia']);
    $ten_ma_giam_gia = trim($_POST['ten_ma_giam_gia']);
    $menh_gia_giam_gia = intval($_POST['menh_gia_giam_gia']);
    
    // Kiểm tra dữ liệu bắt buộc
    if (empty($ma_giam_gia) || empty($ten_ma_giam_gia) || empty($menh_gia_giam_gia)) {
        $message = "<div class='alert alert-danger'>Vui lòng nhập đầy đủ các trường bắt buộc.</div>";
    }

    // Nếu không có lỗi, tiến hành thêm mã giảm giá
    if (empty($message)) {
        // Kiểm tra xem mã giảm giá đã tồn tại chưa
        $check_sql = "SELECT ma_giam_gia FROM giamgia WHERE ma_giam_gia = ?";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->bind_param("s", $ma_giam_gia);
        $stmt_check->execute();
        $check_result = $stmt_check->get_result();

        if ($check_result->num_rows > 0) {
            $message = "<div class='alert alert-danger'>Mã giảm giá này đã tồn tại. Vui lòng chọn mã khác.</div>";
            $stmt_check->close();
        } else {
            $stmt_check->close();
            // Thêm mã giảm giá mới
            $insert_sql = "INSERT INTO giamgia (ma_giam_gia, ten_ma_giam_gia, menh_gia_giam_gia) 
                           VALUES (?, ?, ?)";
            $stmt_insert = $conn->prepare($insert_sql);
            $stmt_insert->bind_param("ssi", $ma_giam_gia, $ten_ma_giam_gia, $menh_gia_giam_gia,);
            
            if ($stmt_insert->execute()) {
                $stmt_insert->close();
                $conn->close();
                header("Location: admin_discounts.php?msg=added");
                exit();
            } else {
                $message = "<div class='alert alert-danger'>Lỗi khi thêm mã giảm giá: " . htmlspecialchars($stmt_insert->error) . "</div>";
                $stmt_insert->close();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Thêm Mã Giảm Giá Mới</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .add-discount-container {
            margin-top: 80px; /* Điều chỉnh cho phù hợp với navbar fixed-top */
            margin-bottom: 50px;
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
                        <a class="nav-link" href="admin_discounts.php"><i class="fas fa-percent me-1"></i>Quản Lý Mã Giảm Giá</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php"><i class="fas fa-sign-out-alt me-1"></i>Đăng Xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container add-discount-container">
        <h2 class="mb-4"><i class="fas fa-plus-circle me-2"></i>Thêm Mã Giảm Giá Mới</h2>

        <!-- Thông báo -->
        <?php echo $message; ?>

        <form action="admin_add_discount.php" method="POST">
            <div class="mb-3">
                <label for="ma_giam_gia" class="form-label">Mã Giảm Giá <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ma_giam_gia" name="ma_giam_gia" required>
                <div class="form-text">Chỉ chứa chữ và số, không khoảng trắng.</div>
            </div>
            <div class="mb-3">
                <label for="ten_ma_giam_gia" class="form-label">Tên Mã Giảm Giá <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_ma_giam_gia" name="ten_ma_giam_gia" required>
            </div>
            <div class="mb-3">
                <label for="menh_gia_giam_gia" class="form-label">Mệnh Giá Giảm Giá (%) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="menh_gia_giam_gia" name="menh_gia_giam_gia" min="0" max="100" required>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Thêm Mã Giảm Giá</button>
            <a href="admin_discounts.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Quay Lại</a>
        </form>
    </div>

    <!-- Bootstrap JS và dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>

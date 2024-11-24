<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Kiểm tra tham số ID
if (!isset($_GET['id']) || empty(trim($_GET['id']))) {
    header("Location: admin_discounts.php");
    exit();
}

$ma_giam_gia = trim($_GET['id']);

// Kết nối cơ sở dữ liệu
include("config.php");

// Truy vấn mã giảm giá cần chỉnh sửa
$discount_sql = "SELECT * FROM giamgia WHERE ma_giam_gia = ?";
$stmt = $conn->prepare($discount_sql);
$stmt->bind_param("s", $ma_giam_gia);
$stmt->execute();
$discount_result = $stmt->get_result();

if ($discount_result->num_rows === 0) {
    echo "<div class='alert alert-warning m-4'>Không tìm thấy mã giảm giá này.</div>";
    exit();
}

$discount = $discount_result->fetch_assoc();
$stmt->close();

// Xử lý form khi submit
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ten_ma_giam_gia = trim($_POST['ten_ma_giam_gia']);
    $menh_gia_giam_gia = intval($_POST['menh_gia_giam_gia']);
    
    // Kiểm tra dữ liệu bắt buộc
    if (empty($ten_ma_giam_gia) || empty($menh_gia_giam_gia)) {
        $message = "<div class='alert alert-danger'>Vui lòng nhập đầy đủ các trường bắt buộc.</div>";
    }

    // Nếu không có lỗi, tiến hành cập nhật mã giảm giá
    if (empty($message)) {

        $update_sql = "UPDATE giamgia 
                       SET ten_ma_giam_gia = ?, menh_gia_giam_gia = ?
                       WHERE ma_giam_gia = ?";
        $stmt_update = $conn->prepare($update_sql);
        $stmt_update->bind_param("sis", $ten_ma_giam_gia, $menh_gia_giam_gia, $ma_giam_gia);
        
        if ($stmt_update->execute()) {
            $stmt_update->close();
            $conn->close();
            header("Location: admin_discounts.php?msg=updated");
            exit();
        } else {
            $message = "<div class='alert alert-danger'>Lỗi khi cập nhật mã giảm giá: " . htmlspecialchars($stmt_update->error) . "</div>";
            $stmt_update->close();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Mã Giảm Giá</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .edit-discount-container {
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
    <div class="container edit-discount-container">
        <h2 class="mb-4"><i class="fas fa-edit me-2"></i>Chỉnh Sửa Mã Giảm Giá</h2>

        <!-- Thông báo -->
        <?php echo $message; ?>

        <form action="admin_edit_discount.php?id=<?php echo htmlspecialchars($ma_giam_gia); ?>" method="POST">
            <div class="mb-3">
                <label for="ma_giam_gia" class="form-label">Mã Giảm Giá</label>
                <input type="text" class="form-control" id="ma_giam_gia" name="ma_giam_gia" value="<?php echo htmlspecialchars($ma_giam_gia); ?>" disabled>
                <div class="form-text">Mã giảm giá không thể chỉnh sửa.</div>
            </div>
            <div class="mb-3">
                <label for="ten_ma_giam_gia" class="form-label">Tên Mã Giảm Giá <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_ma_giam_gia" name="ten_ma_giam_gia" value="<?php echo htmlspecialchars($discount['ten_ma_giam_gia']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="menh_gia_giam_gia" class="form-label">Mệnh Giá Giảm Giá (%) <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="menh_gia_giam_gia" name="menh_gia_giam_gia" min="0" max="100" value="<?php echo htmlspecialchars($discount['menh_gia_giam_gia']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Cập Nhật Mã Giảm Giá</button>
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

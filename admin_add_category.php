<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
include("config.php");

// Truy vấn mặt hàng để hiển thị trong dropdown
$category_type_sql = "SELECT ma_mat_hang, ten_mat_hang FROM mathang ORDER BY ten_mat_hang ASC";
$category_type_result = $conn->query($category_type_sql);

// Xử lý form khi submit
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $ma_loai_san_pham = trim($_POST['ma_loai_san_pham']);
    $ten_loai_san_pham = trim($_POST['ten_loai_san_pham']);
    $ma_mat_hang = intval($_POST['ma_mat_hang']);
    $anh_loai_sp = "";

    // Xử lý upload ảnh
    if (isset($_FILES['anh_loai_sp']) && $_FILES['anh_loai_sp']['error'] == 0) {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $filename = $_FILES['anh_loai_sp']['name'];
        $file_tmp = $_FILES['anh_loai_sp']['tmp_name'];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types)) {
            $upload_dir = 'images/logo-menu/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            $new_filename = uniqid() . "." . $file_ext;
            if (move_uploaded_file($file_tmp, $upload_dir . $new_filename)) {
                $anh_loai_sp = $new_filename;
            } else {
                $message = "<div class='alert alert-danger'>Không thể tải lên ảnh loại sản phẩm.</div>";
            }
        } else {
            $message = "<div class='alert alert-danger'>Chỉ cho phép định dạng JPG, JPEG, PNG, GIF cho ảnh loại sản phẩm.</div>";
        }
    }

    // Kiểm tra dữ liệu bắt buộc
    if (empty($ma_loai_san_pham) || empty($ten_loai_san_pham) || empty($ma_mat_hang)) {
        $message = "<div class='alert alert-danger'>Vui lòng nhập đầy đủ các trường bắt buộc.</div>";
    }

    // Nếu không có lỗi, tiến hành thêm loại sản phẩm
    if (empty($message)) {
        // Kiểm tra xem mã loại sản phẩm đã tồn tại chưa
        $check_sql = "SELECT ma_loai_san_pham FROM loaisanpham WHERE ma_loai_san_pham = ?";
        $stmt_check = $conn->prepare($check_sql);
        $stmt_check->bind_param("s", $ma_loai_san_pham);
        $stmt_check->execute();
        $check_result = $stmt_check->get_result();

        if ($check_result->num_rows > 0) {
            $message = "<div class='alert alert-danger'>Mã loại sản phẩm này đã tồn tại. Vui lòng chọn mã khác.</div>";
            $stmt_check->close();
        } else {
            $stmt_check->close();
            // Thêm loại sản phẩm mới
            $insert_sql = "INSERT INTO loaisanpham (ma_loai_san_pham, ten_loai_san_pham, ma_mat_hang, anh_loai_sp) 
                           VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($insert_sql);
            $stmt_insert->bind_param("ssis", $ma_loai_san_pham, $ten_loai_san_pham, $ma_mat_hang, $anh_loai_sp);
            
            if ($stmt_insert->execute()) {
                $stmt_insert->close();
                $conn->close();
                header("Location: admin_categories.php?msg=added");
                exit();
            } else {
                $message = "<div class='alert alert-danger'>Lỗi khi thêm loại sản phẩm: " . htmlspecialchars($stmt_insert->error) . "</div>";
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
    <title>Thêm Loại Sản Phẩm Mới</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .add-category-container {
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
                        <a class="nav-link" href="admin_categories.php"><i class="fas fa-tags me-1"></i>Quản Lý Loại Sản Phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php"><i class="fas fa-sign-out-alt me-1"></i>Đăng Xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container add-category-container">
        <h2 class="mb-4"><i class="fas fa-plus-circle me-2"></i>Thêm Loại Sản Phẩm Mới</h2>

        <!-- Thông báo -->
        <?php echo $message; ?>

        <form action="admin_add_category.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="ma_loai_san_pham" class="form-label">Mã Loại Sản Phẩm <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ma_loai_san_pham" name="ma_loai_san_pham" required>
                <div class="form-text">Chỉ chứa chữ và số, không khoảng trắng.</div>
            </div>
            <div class="mb-3">
                <label for="ten_loai_san_pham" class="form-label">Tên Loại Sản Phẩm <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="ten_loai_san_pham" name="ten_loai_san_pham" required>
            </div>
            <div class="mb-3">
                <label for="ma_mat_hang" class="form-label">Mã Mặt Hàng <span class="text-danger">*</span></label>
                <select class="form-select" id="ma_mat_hang" name="ma_mat_hang" required>
                    <option value="">Chọn Mã Mặt Hàng</option>
                    <?php if ($category_type_result && $category_type_result->num_rows > 0): ?>
                        <?php while($type = $category_type_result->fetch_assoc()): ?>
                            <option value="<?php echo htmlspecialchars($type['ma_mat_hang']); ?>">
                                <?php echo htmlspecialchars($type['ten_mat_hang']); ?>
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="anh_loai_sp" class="form-label">Ảnh Loại Sản Phẩm</label>
                <input class="form-control" type="file" id="anh_loai_sp" name="anh_loai_sp" accept="image/*">
                <div class="form-text">Tải lên ảnh loại sản phẩm (jpg, jpeg, png, gif).</div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Thêm Loại Sản Phẩm</button>
            <a href="admin_categories.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Quay Lại</a>
        </form>
    </div>

    <!-- Bootstrap JS và dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
$conn->close();
?>

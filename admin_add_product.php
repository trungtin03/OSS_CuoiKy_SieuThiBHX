<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

// Khai báo các biến và khởi tạo với giá trị rỗng
$ten_san_pham = $ma_loai_san_pham = $gia = $trong_luong = $thuong_hieu = $noi_san_xuat = $gioi_thieu = $giam_gia = "";
$anh1 = $anh2 = $anh3 = "";
$errors = [];
$success = "";

// Xử lý form khi người dùng gửi dữ liệu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy và kiểm tra dữ liệu từ form
    $ten_san_pham = trim($_POST['ten_san_pham']);
    $ma_loai_san_pham = intval($_POST['ma_loai_san_pham']);
    $gia = intval($_POST['gia']);
    $trong_luong = floatval($_POST['trong_luong']);
    $thuong_hieu = trim($_POST['thuong_hieu']);
    $noi_san_xuat = trim($_POST['noi_san_xuat']);
    $gioi_thieu = trim($_POST['gioi_thieu']);
    $giam_gia = intval($_POST['giam_gia']);

    // Kiểm tra các trường bắt buộc
    if (empty($ten_san_pham)) {
        $errors[] = "Tên sản phẩm không được để trống.";
    }

    if (empty($ma_loai_san_pham)) {
        $errors[] = "Loại sản phẩm không được để trống.";
    }

    if (empty($gia)) {
        $errors[] = "Giá sản phẩm không được để trống.";
    }

    // Xử lý upload hình ảnh
    // Định nghĩa thư mục lưu hình ảnh
    $target_dir = "images/products/";

    // Hàm xử lý upload hình ảnh
    function upload_image($file_input_name, &$errors, $target_dir) {
        $filename = "";
        if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
            $target_file = $target_dir . basename($_FILES[$file_input_name]['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES[$file_input_name]['tmp_name']);
            if ($check !== false) {
                // Kiểm tra định dạng file
                if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                    // Đổi tên file để tránh trùng lặp
                    $filename = uniqid() . "." . $imageFileType;
                    $target_file = $target_dir . $filename;
                    if (!move_uploaded_file($_FILES[$file_input_name]['tmp_name'], $target_file)) {
                        $errors[] = "Không thể tải $file_input_name lên.";
                        $filename = "";
                    }
                } else {
                    $errors[] = "Chỉ hỗ trợ file JPG, JPEG, PNG & GIF cho $file_input_name.";
                }
            } else {
                $errors[] = "File $file_input_name không phải là hình ảnh.";
            }
        } elseif ($file_input_name === 'anh1') {
            // Ảnh1 là bắt buộc
            $errors[] = "Ảnh1 là trường bắt buộc.";
        }
        return $filename;
    }

    // Upload các hình ảnh
    $anh1 = upload_image('anh1', $errors, $target_dir);
    $anh2 = upload_image('anh2', $errors, $target_dir);
    $anh3 = upload_image('anh3', $errors, $target_dir);

    // Nếu không có lỗi, tiến hành thêm sản phẩm vào cơ sở dữ liệu
    if (empty($errors)) {
        // Sử dụng Prepared Statements để tránh SQL Injection
        $stmt = $conn->prepare("INSERT INTO sanpham (ten_san_pham, ma_loai_san_pham, gia, trong_luong, thuong_hieu, noi_san_xuat, gioi_thieu, anh1, anh2, anh3, giam_gia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            $errors[] = "Lỗi chuẩn bị câu lệnh: " . htmlspecialchars($conn->error);
        } else {
            // Điều chỉnh chuỗi định nghĩa kiểu để bao gồm 11 biến
            // Các kiểu: s (string), i (integer), d (double)
            // Fields: ten_san_pham (s), ma_loai_san_pham (i), gia (i), trong_luong (d), thuong_hieu (s), noi_san_xuat (s), gioi_thieu (s), anh1 (s), anh2 (s), anh3 (s), giam_gia (i)
            $stmt->bind_param("siidssssssi", $ten_san_pham, $ma_loai_san_pham, $gia, $trong_luong, $thuong_hieu, $noi_san_xuat, $gioi_thieu, $anh1, $anh2, $anh3, $giam_gia);

            if ($stmt->execute()) {
                $success = "Thêm sản phẩm thành công!";
                // Đặt các biến về rỗng sau khi thêm thành công
                $ten_san_pham = $ma_loai_san_pham = $gia = $trong_luong = $thuong_hieu = $noi_san_xuat = $gioi_thieu = $giam_gia = "";
                $anh1 = $anh2 = $anh3 = "";
            } else {
                $errors[] = "Lỗi khi thêm sản phẩm: " . htmlspecialchars($stmt->error);
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm Mới</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .error-message {
            color: red;
        }
        .success-message {
            color: green;
        }
        .required::after {
            content:" *";
            color: red;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin_products.php">Admin Dashboard</a>
        <div class="d-flex">
            <a href="logout_admin.php" class="btn btn-outline-light">Đăng Xuất</a>
        </div>
    </div>
</nav>
<div class="container form-container">
    <h2 class="mb-4">Thêm Sản Phẩm Mới</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li class="error-message"><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <form action="admin_add_product.php" method="POST" enctype="multipart/form-data">
        <!-- Tên Sản Phẩm -->
        <div class="mb-3">
            <label for="ten_san_pham" class="form-label required">Tên Sản Phẩm:</label>
            <input type="text" class="form-control" id="ten_san_pham" name="ten_san_pham" value="<?php echo htmlspecialchars($ten_san_pham); ?>" required>
        </div>

        <!-- Loại Sản Phẩm -->
        <div class="mb-3">
            <label for="ma_loai_san_pham" class="form-label required">Loại Sản Phẩm:</label>
            <select class="form-select" id="ma_loai_san_pham" name="ma_loai_san_pham" required>
                <option value="">Chọn Loại Sản Phẩm</option>
                <?php
                // Kết nối lại cơ sở dữ liệu
                include("config.php");
                $sql_loai = "SELECT ma_loai_san_pham, ten_loai_san_pham FROM loaisanpham ORDER BY ten_loai_san_pham ASC";
                $result_loai = mysqli_query($conn, $sql_loai);

                if (mysqli_num_rows($result_loai) > 0) {
                    while ($row_loai = mysqli_fetch_assoc($result_loai)) {
                        $selected = ($ma_loai_san_pham == $row_loai['ma_loai_san_pham']) ? 'selected' : '';
                        echo "<option value='" . htmlspecialchars($row_loai['ma_loai_san_pham']) . "' $selected>" . htmlspecialchars($row_loai['ten_loai_san_pham']) . "</option>";
                    }
                } else {
                    echo "<option value=''>Không có loại sản phẩm nào</option>";
                }

                mysqli_close($conn);
                ?>
            </select>
        </div>

        <!-- Giá -->
        <div class="mb-3">
            <label for="gia" class="form-label required">Giá:</label>
            <input type="number" class="form-control" id="gia" name="gia" value="<?php echo htmlspecialchars($gia); ?>" required>
        </div>

        <!-- Trọng Lượng -->
        <div class="mb-3">
            <label for="trong_luong" class="form-label">Trọng Lượng (kg):</label>
            <input type="number" step="0.01" class="form-control" id="trong_luong" name="trong_luong" value="<?php echo htmlspecialchars($trong_luong); ?>">
        </div>

        <!-- Thương Hiệu -->
        <div class="mb-3">
            <label for="thuong_hieu" class="form-label">Thương Hiệu:</label>
            <input type="text" class="form-control" id="thuong_hieu" name="thuong_hieu" value="<?php echo htmlspecialchars($thuong_hieu); ?>">
        </div>

        <!-- Nơi Sản Xuất -->
        <div class="mb-3">
            <label for="noi_san_xuat" class="form-label">Nơi Sản Xuất:</label>
            <input type="text" class="form-control" id="noi_san_xuat" name="noi_san_xuat" value="<?php echo htmlspecialchars($noi_san_xuat); ?>">
        </div>

        <!-- Giới Thiệu -->
        <div class="mb-3">
            <label for="gioi_thieu" class="form-label">Giới Thiệu:</label>
            <textarea class="form-control" id="gioi_thieu" name="gioi_thieu" rows="5"><?php echo htmlspecialchars($gioi_thieu); ?></textarea>
        </div>

        <!-- Hình Ảnh 1 -->
        <div class="mb-3">
            <label for="anh1" class="form-label required">Hình Ảnh 1:</label>
            <input type="file" class="form-control" id="anh1" name="anh1" accept="image/*" required>
        </div>

        <!-- Hình Ảnh 2 -->
        <div class="mb-3">
            <label for="anh2" class="form-label">Hình Ảnh 2:</label>
            <input type="file" class="form-control" id="anh2" name="anh2" accept="image/*">
        </div>

        <!-- Hình Ảnh 3 -->
        <div class="mb-3">
            <label for="anh3" class="form-label">Hình Ảnh 3:</label>
            <input type="file" class="form-control" id="anh3" name="anh3" accept="image/*">
        </div>

        <!-- Giảm Giá -->
        <div class="mb-3">
            <label for="giam_gia" class="form-label">Giảm Giá (%):</label>
            <input type="number" class="form-control" id="giam_gia" name="giam_gia" value="<?php echo htmlspecialchars($giam_gia); ?>" min="0" max="100">
        </div>

        <!-- Nút Submit -->
        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        <a href="admin_products.php" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
<!-- Bootstrap JS và dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

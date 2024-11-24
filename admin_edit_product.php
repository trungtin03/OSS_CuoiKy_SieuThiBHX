<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

// Kiểm tra tham số ma_san_pham
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_products.php");
    exit();
}

$ma_san_pham = intval($_GET['id']);

// Khai báo các biến và khởi tạo với giá trị rỗng
$ten_san_pham = $ma_loai_san_pham = $gia = $trong_luong = $thuong_hieu = $noi_san_xuat = $gioi_thieu = $giam_gia = "";
$anh1 = $anh2 = $anh3 = "";
$errors = [];
$success = "";

// Truy vấn thông tin sản phẩm hiện tại
$sql = "SELECT * FROM sanpham WHERE ma_san_pham = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $ma_san_pham);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Không tìm thấy sản phẩm.";
    exit();
}

$product = $result->fetch_assoc();

// Gán giá trị hiện tại vào các biến
$ten_san_pham = $product['ten_san_pham'];
$ma_loai_san_pham = $product['ma_loai_san_pham'];
$gia = $product['gia'];
$trong_luong = $product['trong_luong'];
$thuong_hieu = $product['thuong_hieu'];
$noi_san_xuat = $product['noi_san_xuat'];
$gioi_thieu = $product['gioi_thieu'];
$giam_gia = $product['giam_gia'];
$anh1_existing = $product['anh1'];
$anh2_existing = $product['anh2'];
$anh3_existing = $product['anh3'];

$stmt->close();

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
    function upload_image_edit($file_input_name, $existing_file, &$errors, $target_dir) {
        $filename = $existing_file; // Giữ nguyên nếu không cập nhật
        if (isset($_FILES[$file_input_name]) && $_FILES[$file_input_name]['error'] == 0) {
            $target_file = $target_dir . basename($_FILES[$file_input_name]['name']);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES[$file_input_name]['tmp_name']);
            if ($check !== false) {
                // Kiểm tra định dạng file
                if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
                    // Đổi tên file để tránh trùng lặp
                    $filename_new = uniqid() . "." . $imageFileType;
                    $target_file = $target_dir . $filename_new;
                    if (move_uploaded_file($_FILES[$file_input_name]['tmp_name'], $target_file)) {
                        // Xóa file cũ nếu tồn tại và khác file mới
                        if (!empty($existing_file) && file_exists($target_dir . $existing_file) && $existing_file != $filename_new) {
                            unlink($target_dir . $existing_file);
                        }
                        $filename = $filename_new;
                    } else {
                        $errors[] = "Không thể tải $file_input_name lên.";
                    }
                } else {
                    $errors[] = "Chỉ hỗ trợ file JPG, JPEG, PNG & GIF cho $file_input_name.";
                }
            } else {
                $errors[] = "File $file_input_name không phải là hình ảnh.";
            }
        }
        return $filename;
    }

    // Upload các hình ảnh (nếu có)
    $anh1 = upload_image_edit('anh1', $anh1_existing, $errors, $target_dir);
    $anh2 = upload_image_edit('anh2', $anh2_existing, $errors, $target_dir);
    $anh3 = upload_image_edit('anh3', $anh3_existing, $errors, $target_dir);

    // Nếu không có lỗi, tiến hành cập nhật sản phẩm vào cơ sở dữ liệu
    if (empty($errors)) {
        // Sử dụng Prepared Statements để tránh SQL Injection
        $sql_update = "UPDATE sanpham SET 
                        ten_san_pham = ?, 
                        ma_loai_san_pham = ?, 
                        gia = ?, 
                        trong_luong = ?, 
                        thuong_hieu = ?, 
                        noi_san_xuat = ?, 
                        gioi_thieu = ?, 
                        anh1 = ?, 
                        anh2 = ?, 
                        anh3 = ?, 
                        giam_gia = ? 
                      WHERE ma_san_pham = ?";

        $stmt = $conn->prepare($sql_update);

        if ($stmt === false) {
            $errors[] = "Lỗi chuẩn bị câu lệnh: " . htmlspecialchars($conn->error);
        } else {
            // Điều chỉnh chuỗi định nghĩa kiểu để bao gồm 12 biến
            // Các kiểu: s (string), i (integer), d (double)
            // Fields: ten_san_pham (s), ma_loai_san_pham (i), gia (i), trong_luong (d), thuong_hieu (s), noi_san_xuat (s), gioi_thieu (s), anh1 (s), anh2 (s), anh3 (s), giam_gia (i), ma_san_pham (i)
            $stmt->bind_param("siidssssssii", $ten_san_pham, $ma_loai_san_pham, $gia, $trong_luong, $thuong_hieu, $noi_san_xuat, $gioi_thieu, $anh1, $anh2, $anh3, $giam_gia, $ma_san_pham);

            if ($stmt->execute()) {
                $success = "Cập nhật sản phẩm thành công!";
            } else {
                $errors[] = "Lỗi khi cập nhật sản phẩm: " . htmlspecialchars($stmt->error);
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
    <title>Chỉnh Sửa Sản Phẩm</title>
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
        .existing-img {
            width: 150px;
            height: auto;
            margin-bottom: 10px;
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
    <h2 class="mb-4">Chỉnh Sửa Sản Phẩm</h2>

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

    <form action="admin_edit_product.php?id=<?php echo $ma_san_pham; ?>" method="POST" enctype="multipart/form-data">
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
            <label for="trong_luong" class="form-label">Trọng Lượng (g):</label>
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
            <label for="anh1" class="form-label">Hình Ảnh 1:</label>
            <?php if (!empty($anh1_existing)): ?>
                <div class="mb-2">
                    <img src="images/products/<?php echo htmlspecialchars($anh1_existing); ?>" alt="Ảnh 1" class="existing-img">
                </div>
            <?php endif; ?>
            <input type="file" class="form-control" id="anh1" name="anh1" accept="image/*">
            <small class="form-text text-muted">Tải lên để thay đổi hình ảnh 1.</small>
        </div>

        <!-- Hình Ảnh 2 -->
        <div class="mb-3">
            <label for="anh2" class="form-label">Hình Ảnh 2:</label>
            <?php if (!empty($anh2_existing)): ?>
                <div class="mb-2">
                    <img src="images/products/<?php echo htmlspecialchars($anh2_existing); ?>" alt="Ảnh 2" class="existing-img">
                </div>
            <?php endif; ?>
            <input type="file" class="form-control" id="anh2" name="anh2" accept="image/*">
            <small class="form-text text-muted">Tải lên để thay đổi hình ảnh 2.</small>
        </div>

        <!-- Hình Ảnh 3 -->
        <div class="mb-3">
            <label for="anh3" class="form-label">Hình Ảnh 3:</label>
            <?php if (!empty($anh3_existing)): ?>
                <div class="mb-2">
                    <img src="images/products/<?php echo htmlspecialchars($anh3_existing); ?>" alt="Ảnh 3" class="existing-img">
                </div>
            <?php endif; ?>
            <input type="file" class="form-control" id="anh3" name="anh3" accept="image/*">
            <small class="form-text text-muted">Tải lên để thay đổi hình ảnh 3.</small>
        </div>

        <!-- Giảm Giá -->
        <div class="mb-3">
            <label for="giam_gia" class="form-label">Giảm Giá (%):</label>
            <input type="number" class="form-control" id="giam_gia" name="giam_gia" value="<?php echo htmlspecialchars($giam_gia); ?>" min="0" max="100">
        </div>

        <!-- Nút Submit -->
        <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
        <a href="admin_products.php" class="btn btn-secondary">Quay Lại</a>
    </form>
</div>
<!-- Bootstrap JS và dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

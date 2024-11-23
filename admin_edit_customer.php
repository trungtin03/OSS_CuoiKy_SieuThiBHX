<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

$error = '';
$success = '';

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

// Xử lý cập nhật thông tin khách hàng khi form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy và sanitize dữ liệu từ form
    $ho_ten = trim($_POST['ho_ten']);
    $email = trim($_POST['email']);
    $sdt = trim($_POST['sdt']);
    $dia_chi = trim($_POST['dia_chi']);
    $ngay_sinh = trim($_POST['ngay_sinh']);
    $gioi_tinh = trim($_POST['gioi_tinh']);

    // Kiểm tra các trường bắt buộc
    if (empty($ho_ten) || empty($email) || empty($sdt) || empty($dia_chi) || empty($ngay_sinh) || empty($gioi_tinh)) {
        $error = "Vui lòng điền đầy đủ thông tin.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Định dạng email không hợp lệ.";
    } else {
        // Truy vấn cập nhật thông tin khách hàng
        $updateSql = "UPDATE taikhoan SET ho_ten = ?, email = ?, sdt = ?, dia_chi = ?, ngay_sinh = ?, gioi_tinh = ? WHERE ma_tai_khoan = ?";
        $stmt_update = $conn->prepare($updateSql);
        $stmt_update->bind_param("ssssssi", $ho_ten, $email, $sdt, $dia_chi, $ngay_sinh, $gioi_tinh, $ma_tai_khoan);

        if ($stmt_update->execute()) {
            $success = "Cập nhật thông tin khách hàng thành công.";
            // Cập nhật lại thông tin khách hàng sau khi chỉnh sửa
            $customer['ho_ten'] = $ho_ten;
            $customer['email'] = $email;
            $customer['sdt'] = $sdt;
            $customer['dia_chi'] = $dia_chi;
            $customer['ngay_sinh'] = $ngay_sinh;
            $customer['gioi_tinh'] = $gioi_tinh;
        } else {
            $error = "Lỗi khi cập nhật thông tin: " . $stmt_update->error;
        }

        $stmt_update->close();
    }
}

$stmt->close();
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Khách Hàng</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .edit-customer-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .card {
            padding: 20px;
            border-radius: 10px;
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
<div class="container edit-customer-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <h3 class="card-title text-center mb-4">Chỉnh Sửa Khách Hàng</h3>
                <?php if ($error): ?>
                    <div class="alert alert-danger">
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>
                <form method="POST" action="admin_edit_customer.php?id=<?php echo $ma_tai_khoan; ?>">
                    <div class="mb-3">
                        <label for="ten_tai_khoan" class="form-label">Tên Tài Khoản:</label>
                        <input type="text" class="form-control" id="ten_tai_khoan" name="ten_tai_khoan" style="background-color: #f6f6f6;"  value="<?php echo htmlspecialchars($customer['ten_tai_khoan']); ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="ho_ten" class="form-label">Họ Tên:</label>
                        <input type="text" class="form-control" id="ho_ten" name="ho_ten" value="<?php echo htmlspecialchars($customer['ho_ten']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($customer['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sdt" class="form-label">Số Điện Thoại:</label>
                        <input type="tel" class="form-control" id="sdt" name="sdt" value="<?php echo htmlspecialchars($customer['sdt']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="dia_chi" class="form-label">Địa Chỉ:</label>
                        <input type="text" class="form-control" id="dia_chi" name="dia_chi" value="<?php echo htmlspecialchars($customer['dia_chi']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="ngay_sinh" class="form-label">Ngày Sinh:</label>
                        <input type="date" class="form-control" id="ngay_sinh" name="ngay_sinh" value="<?php echo htmlspecialchars($customer['ngay_sinh']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gioi_tinh" class="form-label">Giới Tính:</label>
                        <select class="form-select" id="gioi_tinh" name="gioi_tinh" required>
                            <option value="Nam" <?php if ($customer['gioi_tinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                            <option value="Nữ" <?php if ($customer['gioi_tinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                            <option value="Khác" <?php if ($customer['gioi_tinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100">Cập Nhật Khách Hàng</button>
                </form>
                <a href="admin_customers.php" class="btn btn-secondary w-100 mt-3">Quay lại danh sách khách hàng</a>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS và dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

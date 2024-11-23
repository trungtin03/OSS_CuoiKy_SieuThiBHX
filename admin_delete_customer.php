<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

// Kiểm tra xem có ID khách hàng trong URL không
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_customers.php");
    exit();
}

$ma_tai_khoan = intval($_GET['id']);

// Truy vấn để lấy thông tin khách hàng (có thể dùng để hiển thị nếu cần)
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

// Truy vấn để xóa khách hàng
$deleteSql = "DELETE FROM taikhoan WHERE ma_tai_khoan = ?";
$stmt_delete = $conn->prepare($deleteSql);
$stmt_delete->bind_param("i", $ma_tai_khoan);

if ($stmt_delete->execute()) {
    header("Location: admin_customers.php?message=delete_success");
    exit();
} else {
    // Nếu xảy ra lỗi khi xóa, bạn có thể chuyển hướng hoặc hiển thị thông báo lỗi
    echo "Lỗi khi xóa khách hàng: " . $stmt_delete->error;
}

$stmt_delete->close();
$stmt->close();
mysqli_close($conn);
?>

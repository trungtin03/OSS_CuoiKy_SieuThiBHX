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

// Kiểm tra tồn tại mã giảm giá
$check_sql = "SELECT * FROM giamgia WHERE ma_giam_gia = ?";
$stmt_check = $conn->prepare($check_sql);
$stmt_check->bind_param("s", $ma_giam_gia);
$stmt_check->execute();
$check_result = $stmt_check->get_result();

if ($check_result->num_rows === 0) {
    echo "<div class='alert alert-warning m-4'>Không tìm thấy mã giảm giá này.</div>";
    exit();
}
$stmt_check->close();

// Xóa mã giảm giá
$delete_sql = "DELETE FROM giamgia WHERE ma_giam_gia = ?";
$stmt_delete = $conn->prepare($delete_sql);
$stmt_delete->bind_param("s", $ma_giam_gia);

if ($stmt_delete->execute()) {
    $stmt_delete->close();
    $conn->close();
    header("Location: admin_discounts.php?msg=deleted");
    exit();
} else {
    echo "<div class='alert alert-danger m-4'>Lỗi khi xóa mã giảm giá: " . htmlspecialchars($stmt_delete->error) . "</div>";
    $stmt_delete->close();
    $conn->close();
    exit();
}
?>

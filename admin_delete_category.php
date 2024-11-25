<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Kiểm tra tham số mã loại sản phẩm
if (!isset($_GET['ma_loai_san_pham']) || empty(trim($_GET['ma_loai_san_pham']))) {
    header("Location: admin_categories.php");
    exit();
}

$ma_loai_san_pham = trim($_GET['ma_loai_san_pham']);

// Kết nối cơ sở dữ liệu
include("config.php");

// Kiểm tra tồn tại loại sản phẩm
$check_sql = "SELECT * FROM loaisanpham WHERE ma_loai_san_pham = ?";
$stmt_check = $conn->prepare($check_sql);
$stmt_check->bind_param("s", $ma_loai_san_pham);
$stmt_check->execute();
$check_result = $stmt_check->get_result();

if ($check_result->num_rows === 0) {
    echo "<div class='alert alert-warning m-4'>Không tìm thấy loại sản phẩm này.</div>";
    exit();
}
$stmt_check->close();

// Kiểm tra xem loại sản phẩm có sản phẩm nào không
$products_sql = "SELECT ma_san_pham FROM sanpham WHERE ma_loai_san_pham = ?";
$stmt_products = $conn->prepare($products_sql);
$stmt_products->bind_param("s", $ma_loai_san_pham);
$stmt_products->execute();
$products_result = $stmt_products->get_result();

if ($products_result->num_rows > 0) {
    echo "<div class='alert alert-warning m-4'>Không thể xóa loại sản phẩm này vì còn tồn tại sản phẩm thuộc loại này.</div>";
    exit();
}
$stmt_products->close();

// Xóa loại sản phẩm
$delete_sql = "DELETE FROM loaisanpham WHERE ma_loai_san_pham = ?";
$stmt_delete = $conn->prepare($delete_sql);
$stmt_delete->bind_param("s", $ma_loai_san_pham);

if ($stmt_delete->execute()) {
    $stmt_delete->close();
    $conn->close();
    header("Location: admin_categories.php?msg=deleted");
    exit();
} else {
    echo "<div class='alert alert-danger m-4'>Lỗi khi xóa loại sản phẩm: " . htmlspecialchars($stmt_delete->error) . "</div>";
    $stmt_delete->close();
    $conn->close();
    exit();
}
?>

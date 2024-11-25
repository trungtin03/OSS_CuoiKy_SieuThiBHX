<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Kiểm tra tham số ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin_products.php");
    exit();
}

$ma_san_pham = intval($_GET['id']);

// Kết nối cơ sở dữ liệu
include("config.php");

// Truy vấn sản phẩm để lấy các ảnh
$product_sql = "SELECT anh1, anh2, anh3 FROM sanpham WHERE ma_san_pham = ?";
$stmt = $conn->prepare($product_sql);
$stmt->bind_param("i", $ma_san_pham);
$stmt->execute();
$product_result = $stmt->get_result();

if ($product_result->num_rows === 0) {
    echo "<div class='alert alert-warning m-4'>Không tìm thấy sản phẩm này.</div>";
    exit();
}

$product = $product_result->fetch_assoc();
$stmt->close();

// Xóa sản phẩm
$delete_sql = "DELETE FROM sanpham WHERE ma_san_pham = ?";
$stmt_delete = $conn->prepare($delete_sql);
$stmt_delete->bind_param("i", $ma_san_pham);

if ($stmt_delete->execute()) {
    // Xóa các ảnh nếu tồn tại
    $upload_dir = 'images/products/';
    for ($i = 1; $i <=3; $i++) {
        if (!empty($product["anh$i"]) && file_exists($upload_dir . $product["anh$i"])) {
            unlink($upload_dir . $product["anh$i"]);
        }
    }
    $stmt_delete->close();
    $conn->close();
    header("Location: admin_products.php?msg=deleted");
    exit();
} else {
    echo "<div class='alert alert-danger m-4'>Lỗi khi xóa sản phẩm: " . htmlspecialchars($stmt_delete->error) . "</div>";
    $stmt_delete->close();
    $conn->close();
    exit();
}
?>

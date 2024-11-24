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

// Truy vấn thông tin sản phẩm để lấy tên file hình ảnh
$sql_select = "SELECT anh1, anh2, anh3 FROM sanpham WHERE ma_san_pham = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $ma_san_pham);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

if ($result_select->num_rows == 0) {
    echo "Không tìm thấy sản phẩm.";
    exit();
}

$product = $result_select->fetch_assoc();
$anh1 = $product['anh1'];
$anh2 = $product['anh2'];
$anh3 = $product['anh3'];

$stmt_select->close();

// Xóa sản phẩm khỏi cơ sở dữ liệu
$sql_delete = "DELETE FROM sanpham WHERE ma_san_pham = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $ma_san_pham);

if ($stmt_delete->execute()) {
    // Xóa các hình ảnh liên quan khỏi thư mục
    $target_dir = "images/products/";
    if (!empty($anh1) && file_exists($target_dir . $anh1)) {
        unlink($target_dir . $anh1);
    }
    if (!empty($anh2) && file_exists($target_dir . $anh2)) {
        unlink($target_dir . $anh2);
    }
    if (!empty($anh3) && file_exists($target_dir . $anh3)) {
        unlink($target_dir . $anh3);
    }

    $stmt_delete->close();
    $conn->close();

    // Chuyển hướng về danh sách sản phẩm với thông báo thành công
    header("Location: admin_products.php?msg=deleted");
    exit();
} else {
    echo "Lỗi khi xóa sản phẩm: " . htmlspecialchars($stmt_delete->error);
    $stmt_delete->close();
    $conn->close();
    exit();
}
?>

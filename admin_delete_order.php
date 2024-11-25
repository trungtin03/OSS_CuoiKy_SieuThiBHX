<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Kiểm tra tham số mã hóa đơn
if (!isset($_GET['ma_hoa_don']) || !is_numeric($_GET['ma_hoa_don'])) {
    header("Location: admin_orders.php");
    exit();
}

$ma_hoa_don = intval($_GET['ma_hoa_don']);

// Kết nối cơ sở dữ liệu
include("config.php");

// Truy vấn để lấy các chi tiết hóa đơn (giả sử có bảng chi_tiet_hoa_don)
$details_sql = "SELECT * FROM chitiethoadon WHERE ma_hoa_don = ?";
$stmt_details = $conn->prepare($details_sql);
$stmt_details->bind_param("i", $ma_hoa_don);
$stmt_details->execute();
$details_result = $stmt_details->get_result();

// Kiểm tra tồn tại hóa đơn
if ($details_result->num_rows === 0) {
    // Có thể không có chi tiết hóa đơn nhưng vẫn có hóa đơn
    // Kiểm tra hóa đơn tồn tại
    $check_order_sql = "SELECT * FROM hoadon WHERE ma_hoa_don = ?";
    $stmt_check = $conn->prepare($check_order_sql);
    $stmt_check->bind_param("i", $ma_hoa_don);
    $stmt_check->execute();
    $order_result = $stmt_check->get_result();
    if ($order_result->num_rows === 0) {
        echo "<div class='alert alert-warning m-4'>Không tìm thấy hóa đơn này.</div>";
        exit();
    }
    $stmt_check->close();
}

// Xóa các chi tiết hóa đơn trước
$delete_details_sql = "DELETE FROM chitiethoadon WHERE ma_hoa_don = ?";
$stmt_delete_details = $conn->prepare($delete_details_sql);
$stmt_delete_details->bind_param("i", $ma_hoa_don);
$stmt_delete_details->execute();
$stmt_delete_details->close();

// Xóa hóa đơn
$delete_order_sql = "DELETE FROM hoadon WHERE ma_hoa_don = ?";
$stmt_delete_order = $conn->prepare($delete_order_sql);
$stmt_delete_order->bind_param("i", $ma_hoa_don);

if ($stmt_delete_order->execute()) {
    $stmt_delete_order->close();
    $conn->close();
    header("Location: admin_orders.php?msg=deleted");
    exit();
} else {
    echo "<div class='alert alert-danger m-4'>Lỗi khi xóa hóa đơn: " . htmlspecialchars($stmt_delete_order->error) . "</div>";
    $stmt_delete_order->close();
    $conn->close();
    exit();
}
?>

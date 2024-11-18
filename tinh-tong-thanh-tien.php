<?php
session_start();
// Kết nối tới cơ sở dữ liệu
include "config.php";

// Truy vấn để tính tổng tiền của tất cả sản phẩm trong giỏ hàng
$query_total_amount = "SELECT SUM(thanh_tien) as totalAmount FROM giohang";
$result_total_amount = mysqli_query($conn, $query_total_amount);

if ($row_total_amount = mysqli_fetch_assoc($result_total_amount)) {
    $totalAmount = $row_total_amount['totalAmount'];
} else {
    $totalAmount = 0;
}

// Trả về tổng tiền dưới dạng định dạng số có dấu phân cách hàng nghìn
echo number_format($totalAmount);

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);
?>
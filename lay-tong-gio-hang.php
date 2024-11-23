<?php
session_start();

// Kết nối tới cơ sở dữ liệu
include "config.php";

// Lấy mã giảm giá từ tham số truyền vào (nếu có)
$discountCode = isset($_GET['ma_giam_gia']) ? $_GET['ma_giam_gia'] : '';

// Kiểm tra xem có mã giảm giá được truyền vào hay không
if (!empty($discountCode)) {
    // Truy vấn để lấy thông tin về giảm giá từ bảng giamgia
    $query_discount = "SELECT * FROM giamgia WHERE ten_ma_giam_gia = '$discountCode'";
    $result_discount = mysqli_query($conn, $query_discount);

    if ($row_discount = mysqli_fetch_assoc($result_discount)) {
        $discountPercentage = $row_discount['menh_gia_giam_gia'];

        // Tính toán giá sau khi áp dụng giảm giá
        $query_total = "SELECT SUM(thanh_tien) as totalAmount FROM giohang";
        $result_total = mysqli_query($conn, $query_total);

        if ($row_total = mysqli_fetch_assoc($result_total)) {
            $totalAmount = $row_total['totalAmount'];

            // Áp dụng giảm giá
            $totalAmount = $totalAmount * (1 - $discountPercentage / 100);

            echo  $totalAmount;
    } else {
        echo 0;
    }
    } else {
        echo 0;
    }
} else {
    // Lấy tổng số lượng sản phẩm trong giỏ hàng
    $query = "SELECT SUM(so_luong) as totalQuantity FROM giohang";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $totalQuantity = $row['totalQuantity'];
        echo $totalQuantity;
    } else {
        echo 0;
    }

    // Tính tổng thành tiền của tất cả sản phẩm trong giỏ hàng
    $query_total = "SELECT SUM(thanh_tien) as totalAmount FROM giohang";
    $result_total = mysqli_query($conn, $query_total);

    if ($row_total = mysqli_fetch_assoc($result_total)) {
        $totalAmount = $row_total['totalAmount'];
        echo $totalAmount;
    } else {
        echo 0;
    }
}

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);
?>
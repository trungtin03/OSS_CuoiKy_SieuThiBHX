<?php
session_start();
include "config.php";

// Đặt header để trả về JSON
header('Content-Type: application/json');

// Lấy mã giảm giá từ tham số truyền vào (nếu có)
$discountCode = isset($_GET['ma_giam_gia']) ? trim($_GET['ma_giam_gia']) : '';

// Khởi tạo mảng phản hồi
$response = array();

// Lấy tổng thành tiền của tất cả sản phẩm trong giỏ hàng
$query_total = "SELECT SUM(thanh_tien) as totalAmount FROM giohang";
$result_total = mysqli_query($conn, $query_total);
$totalAmount = 0;
if ($row_total = mysqli_fetch_assoc($result_total)) {
    $totalAmount = $row_total['totalAmount'];
}

if (!empty($discountCode)) {
    // Chuyển mã giảm giá sang chữ in hoa
    $discountCodeUpper = strtoupper($discountCode);

    // Truy vấn để lấy thông tin về giảm giá từ bảng giamgia
    $query_discount = "SELECT * FROM giamgia WHERE UPPER(ten_ma_giam_gia) = '$discountCodeUpper'";
    $result_discount = mysqli_query($conn, $query_discount);

    if ($row_discount = mysqli_fetch_assoc($result_discount)) {
        $discountPercentage = $row_discount['menh_gia_giam_gia'];

        // Áp dụng giảm giá
        $totalAfterDiscount = $totalAmount * (1 - $discountPercentage / 100);

        // Định dạng số tiền
        $formattedTotal = number_format($totalAfterDiscount, 0, '', ',');

        $response['status'] = 'success';
        $response['totalAmount'] = $formattedTotal;
    } else {
        // Mã giảm giá không hợp lệ
        $formattedTotal = number_format($totalAmount, 0, '', ',');
        $response['status'] = 'error';
        $response['message'] = 'Mã giảm giá không hợp lệ.';
        $response['totalAmount'] = $formattedTotal;
    }
} else {
    // Không có mã giảm giá, trả về tổng tiền bình thường
    $formattedTotal = number_format($totalAmount, 0, '', ',');
    $response['status'] = 'success';
    $response['totalAmount'] = $formattedTotal;
}

// Trả về phản hồi dạng JSON
echo json_encode($response);

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);
?>

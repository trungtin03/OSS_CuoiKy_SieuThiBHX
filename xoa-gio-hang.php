<?php
// Kết nối tới cơ sở dữ liệu
include "config.php";

// Truy vấn để xóa tất cả thông tin trong bảng giohang
$query_clear_cart = "DELETE FROM giohang";
$result_clear_cart = mysqli_query($conn, $query_clear_cart);

// Kiểm tra xem xóa thành công hay không
if ($result_clear_cart) {
    echo "Xóa giỏ hàng thành công";
} else {
    echo "Xóa giỏ hàng thất bại";
}

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);
?>
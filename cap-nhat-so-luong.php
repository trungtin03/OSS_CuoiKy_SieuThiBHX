<?php
session_start();
// Kết nối tới cơ sở dữ liệu
include "config.php";

// Kiểm tra xem có tham số productId và amount được gửi lên không
if (isset($_POST['productId']) && isset($_POST['amount'])) {
    $productId = $_POST['productId'];
    $amount = $_POST['amount'];

    // Truy vấn để lấy thông tin sản phẩm từ mã sản phẩm
    $query_product = "SELECT * FROM sanpham WHERE ma_san_pham = '$productId'";
    $result_product = mysqli_query($conn, $query_product);

    if ($row_product = mysqli_fetch_assoc($result_product)) {
        $productPrice = $row_product['gia'];

        // Truy vấn để lấy số lượng hiện tại và thành tiền của sản phẩm trong bảng giohang
        $query_get_quantity = "SELECT so_luong, thanh_tien FROM giohang WHERE ma_san_pham = '$productId'";
        $result_get_quantity = mysqli_query($conn, $query_get_quantity);

        if ($row = mysqli_fetch_assoc($result_get_quantity)) {
            $currentQuantity = $row['so_luong'];
            $currentTotalPrice = $row['thanh_tien'];

            // Tính toán số lượng mới và thành tiền mới
            $newQuantity = $currentQuantity + $amount;
            $newTotalPrice = $productPrice * $newQuantity;

            // Kiểm tra xem số lượng mới có đủ để thực hiện thay đổi không
            if ($newQuantity >= 0) {
                // Truy vấn để cập nhật số lượng và thành tiền của sản phẩm trong bảng giohang
                $query_update_quantity = "UPDATE giohang SET so_luong = $newQuantity, thanh_tien = $newTotalPrice WHERE ma_san_pham = '$productId'";
                $result_update_quantity = mysqli_query($conn, $query_update_quantity);

                // Kiểm tra xem cập nhật số lượng và thành tiền thành công hay không
                if ($result_update_quantity) {
                    echo "Cập nhật số lượng và thành tiền thành công";
                } else {
                    echo "Cập nhật số lượng và thành tiền thất bại";
                }
            } else {
                echo "Không thể giảm số lượng xuống âm";
            }
        }
    }
}

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);
?>
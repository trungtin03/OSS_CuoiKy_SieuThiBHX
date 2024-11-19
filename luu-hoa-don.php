<?php
// Establish database connection
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the total amount sent via AJAX
    $totalAmount = $_POST['totalAmount'];

    // Assuming you have other form data accessible here as well

    // Insert data into 'hoadon' table
    $query_hoadon = "INSERT INTO hoadon (tong_tien) 
                     VALUES ('$totalAmount')";

    if (mysqli_query($conn, $query_hoadon)) {
        $maHoaDon = mysqli_insert_id($conn); // Get the auto-generated ID

        // Thêm dữ liệu vào bảng chitiethoadon từ giỏ hàng
    $query_cart = "SELECT * FROM giohang";
    $result_cart = mysqli_query($conn, $query_cart);

    while ($row_cart = mysqli_fetch_assoc($result_cart)) {
        $maSanPham = $row_cart['ma_san_pham'];
        $soLuong = $row_cart['so_luong'];
        $thanhTien = $row_cart['thanh_tien'];

        // Thêm dữ liệu vào bảng chitiethoadon
        $query_insert_chitiethoadon = "INSERT INTO chitiethoadon (ma_hoa_don, ma_san_pham, so_luong, thanh_tien) VALUES ('$maHoaDon', '$maSanPham', '$soLuong', '$thanhTien')";
        $result_insert_chitiethoadon = mysqli_query($conn, $query_insert_chitiethoadon);
    }

        echo "success"; // Send success response to the JavaScript function
    } else {
        echo "error"; // Send error response to the JavaScript function
    }
}
?>

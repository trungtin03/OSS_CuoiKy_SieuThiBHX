<?php
// Kết nối tới cơ sở dữ liệu
include "config.php";

// Lấy mã hóa đơn gần nhất
$query = "SELECT ma_hoa_don FROM hoadon ORDER BY ma_hoa_don DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $maHoaDon = $row['ma_hoa_don'];

    // Lấy các thông tin từ URL
    $hoTen = $_GET['full-name'];
    $sdt = $_GET['phone'];
    $diaChi = $_GET['address'];
    $email = $_GET['email'];
    $tongTien = $_GET['total-amount'];
    $thoiGian = $_GET['pickup-time'];
    $ptThanhToan = $_GET['payment-method'];
    $ptGiaoHang = $_GET['delivery-fee'];

    // Kiểm tra giá trị của ptThanhToan và thiết lập giá trị cho paymentMethod
    $paymentMethod = '';
    if ($ptThanhToan === 'Thanh toán trực tiếp') {
        $paymentMethod = 'Thanh toán trực tiếp';
    } elseif ($ptThanhToan === 'Thanh toán chuyển khoản') {
        $paymentMethod = 'Thanh toán chuyển khoản';
    }


    if ($ptGiaoHang === '15000') {
        $tongTien += 15000 ;
    } elseif ($ptGiaoHang === '20000') {
        $tongTien += 20000 ;
    }

    // Cập nhật thông tin trong bảng hoadon
    $updateQuery = "UPDATE hoadon SET ho_ten = '$hoTen', sdt = '$sdt', dia_chi = '$diaChi', email = '$email', tong_tien = '$tongTien', thoigian = '$thoiGian', pt_thanh_toan = '$paymentMethod' WHERE ma_hoa_don = '$maHoaDon'";
    $updateResult = mysqli_query($conn, $updateQuery);

    if ($updateResult) {
        // Cập nhật thành công
        echo "Cập nhật thông tin hóa đơn thành công!";
    } else {
        // Cập nhật không thành công
        // Xử lý lỗi tại đây
        echo "Cập nhật thông tin hóa đơn không thành công!";
    }
} else {
    // Không tìm thấy mã hóa đơn
    // Xử lý lỗi tại đây
    echo "Không tìm thấy mã hóa đơn!";
}

// Đóng kết nối với cơ sở dữ liệu
mysqli_close($conn);
?>
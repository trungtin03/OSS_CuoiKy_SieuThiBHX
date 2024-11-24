<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập, trả về lỗi
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo "not_logged_in";
    exit();
}

include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị từ form
    $totalAmount = isset($_POST['totalAmount']) ? $_POST['totalAmount'] : null;
    $discountCode = isset($_POST['discountCode']) ? $_POST['discountCode'] : null;
    $ho_ten = isset($_POST['ho_ten']) ? $_POST['ho_ten'] : null;
    $sdt = isset($_POST['sdt']) ? $_POST['sdt'] : null;
    $dia_chi = isset($_POST['dia_chi']) ? $_POST['dia_chi'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $pt_thanh_toan = isset($_POST['pt_thanh_toan']) ? $_POST['pt_thanh_toan'] : null;

    if ($totalAmount === null || $ho_ten === null || $sdt === null || $dia_chi === null || $email === null || $pt_thanh_toan === null) {
        echo "invalid_data";
        exit();
    }

    // Lấy ID người dùng từ session
    $maTaiKhoan = $_SESSION['user_id'];

    // Insert dữ liệu vào bảng 'hoadon'
    $query_hoadon = "INSERT INTO hoadon (ma_tai_khoan, ho_ten, sdt, dia_chi, email, tong_tien, thoigian, pt_thanh_toan) 
                     VALUES (?, ?, ?, ?, ?, ?, NOW(), ?)";
    $stmt = $conn->prepare($query_hoadon);
    $stmt->bind_param("isssdss", $maTaiKhoan, $ho_ten, $sdt, $dia_chi, $email, $totalAmount, $pt_thanh_toan);

    if ($stmt->execute()) {
        $maHoaDon = $stmt->insert_id;

        // Truy vấn giỏ hàng của người dùng
        $query_cart = "SELECT * FROM giohang WHERE ma_tai_khoan = ?";
        $stmt_cart = $conn->prepare($query_cart);
        $stmt_cart->bind_param("i", $maTaiKhoan);
        $stmt_cart->execute();
        $result_cart = $stmt_cart->get_result();

        while ($row_cart = mysqli_fetch_assoc($result_cart)) {
            $maSanPham = $row_cart['ma_san_pham'];
            $soLuong = $row_cart['so_luong'];
            $thanhTien = $row_cart['thanh_tien'];

            // Insert vào 'chitiethoadon'
            $query_insert = "INSERT INTO chitiethoadon (ma_hoa_don, ma_san_pham, so_luong, thanh_tien) 
                             VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bind_param("iiid", $maHoaDon, $maSanPham, $soLuong, $thanhTien);
            $stmt_insert->execute();
            $stmt_insert->close();
        }

        $stmt_cart->close();

        // Xóa giỏ hàng sau khi đặt hàng thành công
        $query_clear = "DELETE FROM giohang WHERE ma_tai_khoan = ?";
        $stmt_clear = $conn->prepare($query_clear);
        $stmt_clear->bind_param("i", $maTaiKhoan);
        $stmt_clear->execute();
        $stmt_clear->close();

        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
}

mysqli_close($conn);
?>

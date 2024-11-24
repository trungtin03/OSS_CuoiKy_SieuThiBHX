<?php
include("config.php");
    // Xóa chi tiết hóa đơn
    $sql_delete_chitiet = "DELETE FROM chitiethoadon";
    if ($conn->query($sql_delete_chitiet) === TRUE) {
        // Xóa hóa đơn
        $sql_delete_hoadon = "DELETE FROM hoadon";
        if ($conn->query($sql_delete_hoadon) === TRUE) {
            echo "success";
        } else {
            echo "failure";
        }
    } else {
        echo "failure";
    }

// Đóng kết nối
$conn->close();
?>

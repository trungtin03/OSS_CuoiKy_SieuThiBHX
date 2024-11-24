<?php
session_start();

// Kiểm tra nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

include("config.php");

// Số sản phẩm trên mỗi trang
$limit = 10;

// Xác định trang hiện tại từ URL, mặc định là 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

// Tính OFFSET
$offset = ($page - 1) * $limit;

// Truy vấn tổng số sản phẩm để tính toán số trang
$total_sql = "SELECT COUNT(*) FROM sanpham";
$total_result = mysqli_query($conn, $total_sql);
$total_row = mysqli_fetch_array($total_result);
$total_products = $total_row[0];

// Tính tổng số trang
$total_pages = ceil($total_products / $limit);

// Truy vấn sản phẩm cho trang hiện tại
$sql = "SELECT * FROM sanpham LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Sản Phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .products-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .table img {
            width: 50px;
            height: auto;
        }
        .pagination {
            justify-content: center;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="admin_dashboard.php">Admin Dashboard</a>
        <div class="d-flex">
            <a href="logout_admin.php" class="btn btn-outline-light">Đăng Xuất</a>
        </div>
    </div>
</nav>
<div class="container products-container">
    <div class="d-flex justify-content-between mb-3">
        <h2>Quản Lý Sản Phẩm</h2>
        <a href="admin_add_product.php" class="btn btn-primary">Thêm Sản Phẩm Mới</a>
    </div>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá (đ)</th>
                <th>Hình Ảnh</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>".htmlspecialchars($row['ma_san_pham'])."</td>";
                    echo "<td>".htmlspecialchars($row['ten_san_pham'])."</td>";
                    echo "<td>".number_format($row['gia'], 0, ',', '.')." đ</td>";
                    echo "<td><img src='images/products/".htmlspecialchars($row['anh1'])."' alt='".htmlspecialchars($row['ten_san_pham'])."'></td>";
                    echo "<td>
                            <a href='admin_edit_product.php?id=".htmlspecialchars($row['ma_san_pham'])."' class='btn btn-sm btn-warning me-2'>Sửa</a>
                            <a href='admin_delete_product.php?id=".htmlspecialchars($row['ma_san_pham'])."' class='btn btn-sm btn-danger' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');\">Xóa</a>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>Không có sản phẩm nào.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
    <!-- Phân Trang -->
    <?php if ($total_pages > 1): ?>
    <nav>
        <ul class="pagination">
            <!-- Nút Trang Trước -->
            <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($page <=1 ){ echo '#'; } else { echo "?page=".($page-1); } ?>">Trước</a>
            </li>
            
            <!-- Các Nút Trang -->
            <?php
            // Hiển thị tối đa 5 trang trong phân trang
            $max_links = 5;
            $start = max(1, $page - floor($max_links / 2));
            $end = min($total_pages, $start + $max_links - 1);

            // Điều chỉnh lại nếu không đủ số trang
            if(($end - $start) < ($max_links - 1)){
                $start = max(1, $end - $max_links + 1);
            }

            for($i = $start; $i <= $end; $i++):
            ?>
                <li class="page-item <?php if($i == $page){ echo 'active'; } ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            
            <!-- Nút Trang Sau -->
            <li class="page-item <?php if($page >= $total_pages){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page+1); } ?>">Sau</a>
            </li>
        </ul>
    </nav>
    <?php endif; ?>
</div>
<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<!-- Bootstrap JS và dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

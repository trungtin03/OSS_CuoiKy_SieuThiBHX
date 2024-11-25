<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// Kết nối cơ sở dữ liệu
include("config.php");

// Số sản phẩm trên mỗi trang
$limit = 10;

// Xác định trang hiện tại từ URL, mặc định là 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;

// Tính OFFSET
$offset = ($page - 1) * $limit;

// Truy vấn tổng số sản phẩm để tính toán số trang
$total_sql = "SELECT COUNT(*) AS total FROM sanpham";
$total_result = $conn->query($total_sql);

if ($total_result) {
    $total_row = $total_result->fetch_assoc();
    $total_products = $total_row['total'];
} else {
    $total_products = 0;
}

// Tính tổng số trang
$total_pages = ceil($total_products / $limit);

// Truy vấn sản phẩm cho trang hiện tại
$products_sql = "SELECT * FROM sanpham ORDER BY ma_san_pham DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($products_sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$products_result = $stmt->get_result();

// Kiểm tra thông báo từ URL
$notification = "";
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'added':
            $notification = "<div class='alert alert-success'>Thêm sản phẩm thành công!</div>";
            break;
        case 'updated':
            $notification = "<div class='alert alert-success'>Cập nhật sản phẩm thành công!</div>";
            break;
        case 'deleted':
            $notification = "<div class='alert alert-success'>Xóa sản phẩm thành công!</div>";
            break;
        default:
            $notification = "";
    }
}
?>
<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Sản Phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .products-container {
            margin-top: 80px; /* Điều chỉnh cho phù hợp với navbar fixed-top */
            margin-bottom: 50px;
        }
        .table img {
            width: 60px;
            height: auto;
            border-radius: 5px;
        }
        .pagination {
            justify-content: center;
        }
        .action-btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="admin_dashboard.php"><i class="fas fa-store-alt me-2"></i>Bách Hóa Xanh Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php"><i class="fas fa-home me-1"></i>Trang Chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php"><i class="fas fa-sign-out-alt me-1"></i>Đăng Xuất</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container products-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-box-open me-2"></i>Quản Lý Sản Phẩm</h2>
            <a href="admin_add_product.php" class="btn btn-success"><i class="fas fa-plus me-2"></i>Thêm Sản Phẩm Mới</a>
        </div>

        <!-- Thông báo -->
        <?php echo $notification; ?>

        <!-- Bảng sản phẩm -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá (đ)</th>
                        <th>Hình Ảnh</th>
                        <th>Thể Loại</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($products_result && $products_result->num_rows > 0): ?>
                        <?php while($product = $products_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($product['ma_san_pham']); ?></td>
                                <td><?php echo htmlspecialchars($product['ten_san_pham']); ?></td>
                                <td><?php echo number_format($product['gia'], 0, ',', '.'); ?> đ</td>
                                <td>
                                    <?php if (!empty($product['anh1']) && file_exists('images/products/' . $product['anh1'])): ?>
                                        <img src="images/products/<?php echo htmlspecialchars($product['anh1']); ?>" alt="<?php echo htmlspecialchars($product['ten_san_pham']); ?>">
                                    <?php else: ?>
                                        <i class="fas fa-image text-secondary"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php 
                                        // Truy vấn tên loại sản phẩm
                                        $category_sql = "SELECT ten_loai_san_pham FROM loaisanpham WHERE ma_loai_san_pham = ?";
                                        $stmt_cat = $conn->prepare($category_sql);
                                        $stmt_cat->bind_param("i", $product['ma_loai_san_pham']);
                                        $stmt_cat->execute();
                                        $result_cat = $stmt_cat->get_result();
                                        if ($result_cat && $result_cat->num_rows > 0) {
                                            $category = $result_cat->fetch_assoc();
                                            echo htmlspecialchars($category['ten_loai_san_pham']);
                                        } else {
                                            echo "Không xác định";
                                        }
                                        $stmt_cat->close();
                                    ?>
                                </td>
                                <td>
                                    <a href="admin_edit_product.php?id=<?php echo htmlspecialchars($product['ma_san_pham']); ?>" class="btn btn-sm btn-warning action-btn" title="Chỉnh Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="admin_delete_product.php?id=<?php echo htmlspecialchars($product['ma_san_pham']); ?>" class="btn btn-sm btn-danger action-btn" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Không có sản phẩm nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Phân Trang -->
        <?php if ($total_pages > 1): ?>
            <nav>
                <ul class="pagination">
                    <!-- Nút Trang Trước -->
                    <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                        <a class="page-link" href="<?php echo ($page <=1 ) ? '#' : "?page=".($page-1); ?>">Trước</a>
                    </li>

                    <!-- Các Nút Trang -->
                    <?php
                        $max_links = 5;
                        $start = max(1, $page - floor($max_links / 2));
                        $end = min($total_pages, $start + $max_links - 1);

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
                        <a class="page-link" href="<?php echo ($page >= $total_pages) ? '#' : "?page=".($page+1); ?>">Sau</a>
                    </li>
                </ul>
            </nav>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS và dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Optional: Font Awesome JS (nếu cần) -->
</body>
</html>
<?php
$conn->close();
?>

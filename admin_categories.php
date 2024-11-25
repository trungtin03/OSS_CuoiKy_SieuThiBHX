<?php
session_start();

// Kiểm tra đăng nhập admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}
include("config.php");

// Phân trang
$limit = 10; // Số loại sản phẩm trên mỗi trang
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $limit;

// Tính tổng số loại sản phẩm
$total_sql = "SELECT COUNT(*) AS total FROM loaisanpham";
$total_result = $conn->query($total_sql);
$total_row = $total_result->fetch_assoc();
$total_categories = $total_row['total'];

// Tính tổng số trang
$total_pages = ceil($total_categories / $limit);

// Truy vấn loại sản phẩm cho trang hiện tại
$categories_sql = "SELECT * FROM loaisanpham ORDER BY ma_loai_san_pham DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($categories_sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$categories_result = $stmt->get_result();

// Kiểm tra thông báo từ URL
$notification = "";
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'added':
            $notification = "<div class='alert alert-success'>Thêm loại sản phẩm thành công!</div>";
            break;
        case 'updated':
            $notification = "<div class='alert alert-success'>Cập nhật loại sản phẩm thành công!</div>";
            break;
        case 'deleted':
            $notification = "<div class='alert alert-success'>Xóa loại sản phẩm thành công!</div>";
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
    <title>Quản Lý Loại Sản Phẩm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .categories-container {
            margin-top: 80px; /* Điều chỉnh cho phù hợp với navbar fixed-top */
            margin-bottom: 50px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .action-btn {
            margin-right: 5px;
        }
        .table-img {
            width: 60px;
            height: auto;
            border-radius: 5px;
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
    <div class="container categories-container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2><i class="fas fa-tags me-2"></i>Quản Lý Loại Sản Phẩm</h2>
            <a href="admin_add_category.php" class="btn btn-success"><i class="fas fa-plus me-2"></i>Thêm Loại SP Mới</a>
        </div>

        <!-- Thông báo -->
        <?php echo $notification; ?>

        <!-- Bảng loại sản phẩm -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Mã Loại SP</th>
                        <th>Tên Loại SP</th>
                        <th>Mã Mặt Hàng</th>
                        <th>Ảnh Loại SP</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($categories_result && $categories_result->num_rows > 0): ?>
                        <?php while($category = $categories_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($category['ma_loai_san_pham']); ?></td>
                                <td><?php echo htmlspecialchars($category['ten_loai_san_pham']); ?></td>
                                <td>
                                    <?php 
                                        // Truy vấn tên mặt hàng từ ma_mat_hang
                                        $category_type_sql = "SELECT ten_mat_hang FROM mathang WHERE ma_mat_hang = ?";
                                        $stmt_type = $conn->prepare($category_type_sql);
                                        $stmt_type->bind_param("i", $category['ma_mat_hang']);
                                        $stmt_type->execute();
                                        $result_type = $stmt_type->get_result();
                                        if ($result_type && $result_type->num_rows > 0) {
                                            $type = $result_type->fetch_assoc();
                                            echo htmlspecialchars($type['ten_mat_hang']);
                                        } else {
                                            echo "Không xác định";
                                        }
                                        $stmt_type->close();
                                    ?>
                                </td>
                                <td>
                                    <?php if (!empty($category['anh_loai_sp']) && file_exists('images/logo-menu/' . $category['anh_loai_sp'])): ?>
                                        <img src="images/logo-menu/<?php echo htmlspecialchars($category['anh_loai_sp']); ?>" alt="<?php echo htmlspecialchars($category['ten_loai_san_pham']); ?>" class="table-img">
                                    <?php else: ?>
                                        <i class="fas fa-image text-secondary"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="admin_edit_category.php?ma_loai_san_pham=<?php echo htmlspecialchars($category['ma_loai_san_pham']); ?>" class="btn btn-sm btn-warning action-btn" title="Chỉnh Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="admin_delete_category.php?ma_loai_san_pham=<?php echo htmlspecialchars($category['ma_loai_san_pham']); ?>" class="btn btn-sm btn-danger action-btn" title="Xóa" onclick="return confirm('Bạn có chắc chắn muốn xóa loại sản phẩm này?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Không có loại sản phẩm nào.</td>
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
</body>
</html>
<?php
$conn->close();
?>

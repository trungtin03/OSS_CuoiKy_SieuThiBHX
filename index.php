<?php session_start(); ?>
<!DOCTYPE html>
<!--[if IE 9 ]> <html lang="vi-VN" class="ie9 loading-site no-js"> <![endif]-->
<!--[if IE 8 ]> <html lang="vi-VN" class="ie8 loading-site no-js"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="vi-VN" class="loading-site no-js"> <!--<![endif]-->

<head>
    <meta charset="UTF-8" />

    <title>Siêu thị Bách hoá XANH - Mua bán thực phẩm, sản phẩm gia đình</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel='dns-prefetch' href='//maxcdn.bootstrapcdn.com' />
    <link rel="stylesheet" id="flatsome-ionfas fas-css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" media="all" />
    <link rel='stylesheet' id='flatsome-main-css' href="assets/css/flatsome.css" type='text/css' media='all' />
    <link rel='stylesheet' id='flatsome-style-css' href="assets/css/style-kh.css" type='text/css' media='all' />

    <link rel="canonical" href="index.php" />
    <link rel='shortlink' href='index.php/' />
    <link rel='stylesheet' id="custom-css" href="assets/css/style.css" type="text/css" />
    <link rel="icon" href="images/logo/logo-icon.png" sizes="32x32" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>
    <!-- Thư viện jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Thư viện Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</head>

<body class="home page-template page-template-page-left-sidebar page-template-page-left-sidebar-php page page-id-163 theme-flatsome woocommerce-no-js full-width lightbox nav-dropdown-has-arrow">

    <a class="skip-link screen-reader-text" href="#main">Skip to content</a>

    <div id="wrapper">


        <header id="header" class="header ">
            <div class="header-wrapper">
                <div id="masthead" class="header-main hide-for-sticky nav-dark">
                    <div class="header-inner flex-row container logo-left" role="navigation">

                        <!-- Logo -->
                        <div id="logo" class="flex-col logo">
                            <!-- Header logo -->
                            <a href="index.php" title="Bách hóa online" rel="home">
                                <img width="218" height="55" src="images/logo/logo-1.png" class="header_logo header-logo" alt="Bách hóa xanh online" /><img width="218" height="55" src="images/logo/logo-1.png" class="header-logo-dark" alt="Bách hóa xanh online" /></a>
                        </div>

                        <!-- Mobile Left Elements -->
                        <div class="flex-col show-for-medium flex-left">
                            <ul class="mobile-nav nav nav-left ">
                            </ul>
                        </div>
                        <!-- Left Elements -->
                        <div class="flex-col hide-for-medium flex-left
            flex-grow">
                            <ul class="header-nav header-nav-main nav nav-left  nav-spacing-medium nav-uppercase">
                                <li class="header-search-form search-form html relative has-fas fa">
                                    <div class="header-search-form-wrapper">
                                        <div class="searchform-wrapper ux-search-box relative form-flat is-normal">
                                            <div class="searchform-wrapper ux-search-box relative form-flat is-normal">
                                                <form role="search" method="get" class="searchform " action="tim-kiem.php">
                                                    <div class="flex-row relative">
                                                        <div class="flex-col flex-grow">
                                                            <label class="screen-reader-text" for="woocommerce-product-search-field-0">Tìm kiếm:</label>
                                                            <input type="search" id="woocommerce-product-search-field-0" class="search-field mb-0" placeholder="Nhập từ khóa...." value="" name="s" />
                                                            <input type="hidden" name="post_type" value="product" />
                                                        </div><!-- .flex-col -->
                                                        <div class="flex-col">
                                <li class="cart-item has-fas fa has-dropdown">
                                    <a href="gio-hang.php" title="Giỏ hàng" class="header-cart-link is-small">
                                        <i class="fas fa-shopping-cart" data-fas fa-label="0"><?php
                                        include "config.php";
                                        $query = "SELECT SUM(so_luong) AS totalQuantity FROM giohang";
                                        $result = mysqli_query($conn, $query);

                                        if ($row = mysqli_fetch_assoc($result)) {
                                            $totalQuantity = $row['totalQuantity'];
                                            if ($totalQuantity > 0) {
                                                echo '<span id="cart-quantity" class="cart-quantity-badge">' . $totalQuantity . '</span>';
                                            }
                                        }
                                        mysqli_close($conn);
                                        ?></i>
                                    </a>
                                    <ul class="nav-dropdown nav-dropdown-simple">
                                        <li class="html widget_shopping_cart">
                                            <div class="widget_shopping_cart_content">
                                                <?php
                                                include "config.php";
                                                $query = "SELECT * FROM giohang";
                                                $result = mysqli_query($conn, $query);

                                                if (mysqli_num_rows($result) > 0) {
                                                    echo '<ul class="cart-list">';
                                                    $i = 1; // Biến đếm số thứ tự
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        $maSanPham = $row['ma_san_pham'];
                                                        $soLuong = $row['so_luong'];

                                                        // Lấy thông tin sản phẩm từ cơ sở dữ liệu
                                                        $query_sp = "SELECT * FROM sanpham WHERE ma_san_pham = '$maSanPham'";
                                                        $result_sp = mysqli_query($conn, $query_sp);
                                                        if ($row_sp = mysqli_fetch_assoc($result_sp)) {
                                                            $anh1 = $row_sp['anh1'];
                                                            $tenSanPham = $row_sp['ten_san_pham'];
                                                            $gia = $row_sp['gia'];

                                                            echo '<li class="cart-item">';
                                                            echo '<div class="product-thumbnail">';
                                                            echo '<a href="#">' . $i . '/ <img src="images/products/' . $anh1 . '" alt="' . $tenSanPham . '"></a>';
                                                            echo '</div>';
                                                            echo '<div class="product-info">';
                                                            echo '<a href="#" class="product-title">Sản phẩm: ' . $tenSanPham . '</a>';
                                                            echo '<span class="product-price">Giá: ' . $gia . '0 đ - </span>';
                                                            echo '<span class="product-quantity">Số lượng: ' . $soLuong . '</span>';
                                                            echo '</div>';
                                                            echo '</li>';

                                                            $i++; // Tăng số thứ tự
                                                        }
                                                    }
                                                    echo '</ul>';
                                                } else {
                                                    echo '<p class="woocommerce-mini-cart__empty-message">Chưa có sản phẩm trong giỏ hàng.</p>';
                                                }

                                                mysqli_close($conn);
                                                ?>
                                            </div>
                                        </li>
                                    </ul><!-- .nav-dropdown -->
                                    <style>
                                        .cart-list {
                                            list-style-type: none;
                                            padding: 0;
                                            margin: 0;
                                            max-height: 200px;
                                            /* Giới hạn chiều cao */
                                            overflow-y: auto;
                                            /* Hiển thị thanh cuộn khi vượt quá chiều cao */
                                        }

                                        .cart-item {
                                            display: flex;
                                            align-items: center;
                                            margin: 10px 0 10px 0;
                                        }

                                        .product-thumbnail img {
                                            max-width: 100px;
                                            height: auto;
                                            margin: 20px 10px 0 0;
                                        }

                                        .product-info {
                                            flex: 1;
                                        }

                                        .product-title {
                                            font-weight: bold;
                                            margin-bottom: -15px;
                                        }

                                        .product-price {
                                            font-style: italic;
                                            margin-bottom: 5px;
                                        }

                                        .product-quantity {
                                            font-size: 12px;
                                        }

                                        .cart-quantity-badge {
                                            position: absolute;
                                            top: 15px;
                                            right: -3px;
                                            transform: translate(50%, -50%);
                                            display: inline-block;
                                            background-color: red;
                                            color: white;
                                            border-radius: 50%;
                                            padding: 3px 6px;
                                            font-size: 10px;
                                        }

                                        .nav-dropdown {
                                            position: absolute;
                                            top: 160px;
                                            left: -500px;
                                            transform: translate(50%, -50%);
                                        }

                                        .fa-shopping-cart {
                                            margin-top: 5px;
                                            font-size: 20px;
                                            color: green;
                                        }
                                    </style>
                                </li>

                        </div><!-- .flex-col -->
                    </div><!-- .flex-row -->
                    <div class="live-search-results text-left z-top"></div>
                    </form>
                </div>
            </div>
    </div>
    </li>
    </ul>
    </div>

    <!-- Right Elements -->
    <div class="flex-col hide-for-medium flex-right">
        <ul class="header-nav header-nav-main nav nav-right  nav-spacing-medium nav-uppercase">
            <li class="account-item">
                <a href="#" class="nav-top-link nav-top-logged-in is-small" style="display: inline-flex;">
                    <i class="fas fa-user"></i>
                    <span id="user-name" has-dropdown></span>
                </a>
                <ul class="dropdown-list-1">
                    <li><a href="don-hang.php">Đơn hàng</a></li>
                    <li><a href="tai-khoan.php">Thông tin tài khoản</a></li>
                    <li><a href="logout.php" id="logout">Đăng xuất</a></li>
                </ul>

            </li>
            <style>
                .dropdown-list-1 {
                    display: none;
                    position: absolute;
                    background-color: #fff;
                    padding: 20px;
                    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
                    border-radius: 4px;
                    z-index: 1;
                }


                .dropdown-list-1 li {
                    position: relative;
                    list-style: none;
                }

                .dropdown-list-1 li a {
                    display: block;
                    padding: 10px;
                    text-decoration: none;
                    color: #333;
                    background-color: #f4f4f4;
                    transition: background-color 0.3s;
                }

                .dropdown-list-1 li a:hover {
                    background-color: #eaeaea;
                }

                .dropdown-list-1 ul {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    min-width: 160px;
                    padding: 0;
                    margin: 0;
                    background-color: #f4f4f4;
                    list-style: none;
                    opacity: 0;
                    visibility: hidden;
                    transform: translateY(10px);
                    transition: opacity 0.3s, transform 0.3s;
                }

                .dropdown-list-1 li:hover ul {
                    opacity: 1;
                    visibility: visible;
                    transform: translateY(0);
                }

                .dropdown-list-1 ul li {
                    display: block;
                }

                .dropdown-list-1 ul li a {
                    padding: 10px;
                    color: #333;
                    white-space: nowrap;
                }

                .dropdown-list-1 ul li a:hover {
                    background-color: #eaeaea;
                }

                .account-item:hover .dropdown-list-1 {
                    display: block;
                }
            </style>



        </ul>
    </div>

    </div><!-- .header-inner -->



    </div><!-- .flex-row -->
    </div><!-- .header-bottom -->

    <div class="header-bg-container fill">
        <div class="header-bg-image fill"></div>
        <div class="header-bg-color fill"></div>
    </div><!-- .header-bg-container -->
    </div><!-- header-wrapper-->
    </header>


    <main id="main" class="">


        <div class="page-wrapper page-left-sidebar">
            <div class="row">

                <div id="content" class="large-9 div-phai right col" role="main">
                    <div class="page-inner">

                        <section class="section section-slide" id="section_1542544733">
                            <div class="bg section-bg fill bg-fill  bg-loaded">
                            </div><!-- .section-bg -->

                            <div class="section-content relative">

                                <div class="row" id="row-1755783796">
                                    <div class="col div-no-padding small-12 large-12">
                                        <div class="col-inner">

                                            <p class="tieu-de-nhom"><span><strong>Nhóm hàng thường mua</strong></span></p>
                                            <?php
                                            include("config.php");

                                            // Kiểm tra kết nối
                                            if (!$conn) {
                                                die("Kết nối tới cơ sở dữ liệu thất bại: " . mysqli_connect_error());
                                            }

                                            // Truy vấn dữ liệu từ database
                                            $sql = "SELECT mh.ma_mat_hang,mh.ten_mat_hang, lsp.ten_loai_san_pham, lsp.anh_loai_sp, lsp.ma_loai_san_pham
                        FROM mathang mh
                        INNER JOIN loaisanpham lsp ON mh.ma_mat_hang = lsp.ma_mat_hang
                        ORDER BY RAND() LIMIT 8";

                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                echo '<div class="row div-danh-muc-sp large-columns-8 medium-columns-3 small-columns-2 row-xsmall">';
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $ma_mat_hang = $row['ma_mat_hang'];
                                                    $ten_mat_hang = $row['ten_mat_hang'];
                                                    $ten_loai_san_pham = $row['ten_loai_san_pham'];
                                                    $anh_loai_sp = $row['anh_loai_sp'];
                                                    $ma_loai_san_pham = $row['ma_loai_san_pham'];

                                                    echo '<div class="product-category col">';
                                                    echo '<div class="col-inner">';

                                                    // Tạo liên kết đến trang xem-sp.php và truyền mã mặt hàng
                                                    echo '<a href="xem-sp.php?ma_mat_hang=' . $ma_mat_hang . '">';
                                                    echo '<div class="box box-category has-hover box-normal">';
                                                    echo '<div class="box-image" style="border-radius:50%;width:47%;">';
                                                    echo '<div class="image-cover" style="padding-top:100%;">';
                                                    echo '<img src="images/logo-menu/' . $anh_loai_sp . '" alt="' . $ten_loai_san_pham . '" width="300" height="300" />';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '<div class="box-text text-center" style="padding:20px 0px 0px 0px;">';
                                                    echo '<div class="box-text-inner">';
                                                    echo '<h5 class="uppercase header-title">' . $ten_loai_san_pham . '</h5>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                    echo '</a>';

                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                                echo '</div>';
                                            } else {
                                                echo "Không tìm thấy danh mục sản phẩm.";
                                            }

                                            // Đóng kết nối tới cơ sở dữ liệu
                                            mysqli_close($conn);
                                            ?>
                                        </div>
                                    </div>

                                    <style scope="scope">
                                        #row-1755783796>.col>.col-inner {
                                            padding: 0px 0px 0px 0px;
                                        }
                                    </style>
                                </div>
                            </div><!-- .section-content -->


                            <style scope="scope">
                                #section_1542544733 {
                                    padding-top: 0px;
                                    padding-bottom: 0px;
                                    background-color: rgb(255, 255, 255);
                                    margin-bottom: 80px;
                                }
                            </style>
                        </section>
                        <!---Giảm giá--->

                        <div class="custom-container-2">
                            <a href="">
                                <div class="custom-banner-2 custom-banner-2-border">
                                    <img style="width: 100%;" src="https://img.tgdd.vn/imgt/f_webp,fit_outside,quality_100,/https://cdn.tgdd.vn/bachhoaxanh/banners/7551/phien-cho-sieu-sieu-giam-13102023143015.png">
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_6">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #fff;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small slider-1-dis ">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có giảm giá (giam_gia khác 0)
                                                            $query = "SELECT * FROM sanpham WHERE giam_gia <> 0 ";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $discountPercentage = $row['giam_gia'];

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
            <div class="col-inner">
                <div class="custom-box-1 box has-hover box-normal-2 box-text-1-bottom" style=" background-size: cover; padding: 10px; border: 1px solid #00ac5b;">
                    <div class="box-image-1" style="flex: 1;">
                        <div class="">
                            <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="200" height="200" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                        </div>
                        <div class="image-tools top right show-on-hover"></div>
                        <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                            <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                        </div>
                    </div>
                    <div class="box-text-1 text-center" style="flex: 1;">
                        <div class="title-wrapper-1">
                            <p class="name-product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                        </div>
                        <div class="price-wrapper-1">
                            <del class="old-price" style="color: black;">' . $productPrice . ' đ</del> <br>
                            <span class="new-price" style="color: red;">' . $productPrice * (100 - $discountPercentage) / 100 . ' đ</span> <br>
                            <span class="discount-percentage">-' . $discountPercentage . '%</span>
                        </div>
                        <div class="add-to-cart-button-1" style="float: right;">
                            <a onclick="addToCart(' . $productId . ')" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline">MUA</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                            <style>
                                .custom-container-2 {

                                    position: relative;
                                    margin-top: 28px;
                                    min-height: 30px;
                                    width: 100%;
                                    border-top: 1px solid #9D1010;
                                    background-color: #FFf;
                                }

                                .custom-banner-2 {
                                    position: absolute;
                                    left: 50%;
                                    top: -60px;
                                    transform: translateX(-50%);
                                    width: max-content;
                                    min-width: 260px;
                                }

                                .custom-banner-2::before {
                                    content: "";
                                    position: absolute;
                                    left: -31px;
                                    top: -1px;
                                    border-right: 30px solid #9D1010;
                                    border-top: 60px solid transparent;
                                    border-right-color: #9D1010;
                                }

                                .custom-banner-2::after {
                                    content: "";
                                    position: absolute;
                                    right: -30px;
                                    top: -1px;
                                    border-left: 30px solid #9D1010;
                                    border-top: 60px solid transparent;
                                    border-left-color: #9D1010;
                                }


                                .custom-banner-2-border {
                                    border-radius: 0 0 10px 10px;
                                    padding: 7px;
                                    background-color: #FFECC9;
                                    border: 1px solid #00ac5b;
                                }

                                .custom-box-1 {
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                }

                                .custom-box-1 .box-image-1 {
                                    flex: 1;
                                }

                                .custom-box-1 .box-text-1 {
                                    flex: 1;
                                    display: flex;
                                    flex-direction: column;
                                    align-items: flex-start;
                                    justify-content: center;
                                    padding-left: 20px;
                                }

                                .custom-box-1 .box-text-1 .title-wrapper-1 {
                                    width: 100%;
                                    text-overflow: ellipsis;
                                    margin-bottom: 10px;
                                    overflow: auto;
                                    max-height: 2em;
                                }

                                .custom-box-1 .box-text-1 .price-wrapper-1 {
                                    margin-bottom: 10px;
                                }

                                .custom-box-1 .box-text-1 .add-to-cart-button-1 {
                                    margin-bottom: 10px;
                                }

                                @media (max-width: 767px) {
                                    .custom-box-1 {
                                        flex-direction: column;
                                    }

                                    .custom-box-1 .box-image-1,
                                    .custom-box-1 .box-text-1 {
                                        flex: none;
                                    }
                                }

                                .discount-percentage {
                                    display: inline-block;
                                    border: 1px solid red;
                                    padding: 3px 8px;
                                    color: white;
                                    background-color: red;


                                }

                                /* CSS for Previous (trái) button */
                                .slick-prev {
                                    left: -2.5%;
                                    top: 50%;
                                    transform: translateY(400%);
                                    float: left;
                                }

                                /* CSS for Next (phải) button */
                                .slick-next {
                                    right: -4%;
                                    top: 50%;
                                    transform: translateY(-350%);
                                    float: right;
                                }
                            </style>

                            <style scope="scope">
                                #section_5 {
                                    padding-top: 10px;
                                    padding-bottom: 10px;
                                }
                            </style>

                            <style scope="scope">
                                #section_6 {
                                    margin-top: 0px;
                                    padding-top: 5px;
                                    padding-bottom: 10px;
                                    background-color: #fff;
                                }

                                #section_6 .section-content {
                                    background-color: #00ac5b;
                                }
                            </style>
                        </section>
                        <!-- 1---->
                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/thit_trung_hai_san_banner-1.webp" alt="Image 1">
                                    </div>
                                </div>
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/thit_trung_hai_san_banner-2.webp" alt="Image 2">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <style>
                            .slider-wrapper {
                                position: relative;
                                width: 100%;
                                max-width: 1200px;
                                /* Tùy chỉnh kích thước tối đa của slider wrapper */
                                margin: 0 auto;
                                overflow: hidden;
                            }

                            .slider {
                                width: 100%;
                            }

                            .slider img {
                                display: block;
                                width: 100%;
                                height: auto;
                            }
                        </style>
                        <!-- .ux-slider-wrapper -->
                        <div class="custom-container">
                            <a href="">
                                <div class="custom-banner custom-banner-border">
                                    <div class="custom-banner-text">Thịt, trứng, hải sản</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_1">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #d8ecd4;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #d8ecd4;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (1, 2, 3) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {

                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=2" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                            <style>
                                .custom-container {
                                    position: relative;
                                    margin-top: 28px;
                                    min-height: 30px;
                                    width: 100%;
                                    border-top: 1px solid #00ac5b;
                                    background-color: #d8ecd4;
                                }

                                .custom-banner {
                                    position: absolute;
                                    left: 50%;
                                    top: -16px;
                                    transform: translateX(-50%);
                                    width: max-content;
                                    min-width: 260px;
                                }

                                .custom-banner::before {
                                    content: "";
                                    position: absolute;
                                    left: -9px;
                                    top: -1px;
                                    border-right: 9px solid #00ac5b;
                                    border-top: 16px solid transparent;
                                    border-right-color: #3b854e;
                                }

                                .custom-banner::after {
                                    content: "";
                                    position: absolute;
                                    right: -9px;
                                    top: -1px;
                                    border-left: 9px solid #00ac5b;
                                    border-top: 16px solid transparent;
                                    border-left-color: #3b854e;
                                }

                                .custom-banner-text {
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    height: 24px;
                                    font-size: 16px;
                                    font-weight: bold;
                                    text-transform: uppercase;
                                    line-height: 18px;
                                    background-color: #00ac5b;
                                    color: #fff;
                                    border-radius: 4px;
                                }

                                .custom-banner-border {
                                    border: 1px solid #00ac5b;
                                    border-radius: 0 0 10px 10px;
                                    padding: 7px;
                                    background-color: #00ac5b;
                                }

                                .box-normal-1 {
                                    border: 1px solid #00ac5b;
                                    border-radius: 4px;
                                    background-color: #d8ecd4;
                                    margin-bottom: 5px;
                                }
                            </style>
                            <style scope="scope">
                                #section_1421624528 {
                                    padding-top: 10px;
                                    padding-bottom: 10px;
                                }
                            </style>

                            <style scope="scope">
                                #section_1 {
                                    margin-top: -5px;
                                    padding-top: 5px;
                                    padding-bottom: 10px;
                                    background-color: #d8ecd4;
                                }

                                #section_1 .section-content {
                                    background-color: #00ac5b;
                                }
                            </style>
                        </section>
                        <!--------2----------->
                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/rau_cu_nam_trai_cay_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            .slider-wrapper {
                                position: relative;
                                width: 100%;
                                max-width: 1200px;
                                /* Tùy chỉnh kích thước tối đa của slider wrapper */
                                margin: 0 auto;
                                overflow: hidden;
                            }

                            .slider {
                                width: 100%;
                            }

                            .slider img {
                                display: block;
                                width: 100%;
                                height: auto;
                            }
                        </style>

                        <!-- .ux-slider-wrapper -->
                        <div class="custom-container-1">
                            <a href="">
                                <div class="custom-banner-1 custom-banner-1-border">
                                    <div class="custom-banner-1-text">Rau, củ, nấm, trái cây</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_2">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #fff;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #fff;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (4,5,6) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=3" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                            <style>
                                .custom-container-1 {
                                    position: relative;
                                    margin-top: 28px;
                                    min-height: 30px;
                                    width: 100%;
                                    border-top: 1px solid #00ac5b;
                                    background-color: #fff;
                                }

                                .custom-banner-1 {
                                    position: absolute;
                                    left: 50%;
                                    top: -16px;
                                    transform: translateX(-50%);
                                    width: max-content;
                                    min-width: 260px;
                                }

                                .custom-banner-1::before {
                                    content: "";
                                    position: absolute;
                                    left: -9px;
                                    top: -1px;
                                    border-right: 9px solid #00ac5b;
                                    border-top: 16px solid transparent;
                                    border-right-color: #3b854e;
                                }

                                .custom-banner-1::after {
                                    content: "";
                                    position: absolute;
                                    right: -9px;
                                    top: -1px;
                                    border-left: 9px solid #00ac5b;
                                    border-top: 16px solid transparent;
                                    border-left-color: #3b854e;
                                }

                                .custom-banner-1-text {
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    height: 24px;
                                    font-size: 16px;
                                    font-weight: bold;
                                    text-transform: uppercase;
                                    line-height: 18px;
                                    background-color: #d8ecd4;
                                    color: #00ac5b;
                                    border-radius: 4px;
                                }

                                .custom-banner-1-border {
                                    border-radius: 0 0 10px 10px;
                                    padding: 7px;
                                    background-color: #d8ecd4;
                                    border: 1px solid #00ac5b;
                                }

                                .box-normal-1 {
                                    border: 1px solid #00ac5b;
                                    border-radius: 4px;
                                    background-color: #fff;
                                    margin-bottom: 5px;
                                }
                            </style>
                            <style scope="scope">
                                #section_4 {
                                    padding-top: 10px;
                                    padding-bottom: 10px;
                                }
                            </style>

                            <style scope="scope">
                                #section_2 {
                                    margin-top: -5px;
                                    padding-top: 5px;
                                    padding-bottom: 10px;
                                    background-color: #fff;
                                }

                                #section_2 .section-content {
                                    background-color: #00ac5b;
                                }
                            </style>
                        </section>

                        <!-------->
                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/dauan_nuoccham_giavi_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container">
                            <a href="">
                                <div class="custom-banner custom-banner-border">
                                    <div class="custom-banner-text">Dầu ăn, nước chấm, gia vị</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_1">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #d8ecd4;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #d8ecd4;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (7,8,9) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=4" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                        </section>

                        <!-- .ux-slider-wrapper -->
                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/kem_thucphamdongmat_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container-1">
                            <a href="">
                                <div class="custom-banner-1 custom-banner-1-border">
                                    <div class="custom-banner-1-text">Kem, thực phẩm đông lạnh</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_2">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #fff;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #fff;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (10,11) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=5" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/mi_mien_chao_pho_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container">
                            <a href="">
                                <div class="custom-banner custom-banner-border">
                                    <div class="custom-banner-text">Mì, miến, cháo, phở</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_1">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #d8ecd4;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #d8ecd4;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (12,13) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=6" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                        </section>
                        <!-- .ux-slider-wrapper -->
                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/gao_bot_dokho_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container-1">
                            <a href="">
                                <div class="custom-banner-1 custom-banner-1-border">
                                    <div class="custom-banner-1-text">Gạo, bột, đồ khô</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_2">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #fff;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #fff;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (14,15,16,17) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=1" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/bia_nuocgiaikhat_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container">
                            <a href="">
                                <div class="custom-banner custom-banner-border">
                                    <div class="custom-banner-text">Bia, nước giải khát</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_1">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #d8ecd4;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #d8ecd4;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (18,19,20) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=7" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                        </section>
                        <!-- .ux-slider-wrapper -->
                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/sua_cac_loai_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container-1">
                            <a href="">
                                <div class="custom-banner-1 custom-banner-1-border">
                                    <div class="custom-banner-1-text">Sữa các loại</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_2">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #fff;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #fff;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (21,22,23,24) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                // Tạo HTML cho sản phẩm
                echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=8" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/banh_keo_cac_loai_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container">
                            <a href="">
                                <div class="custom-banner custom-banner-border">
                                    <div class="custom-banner-text">Bánh kẹo các loại</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_1">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #d8ecd4;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #d8ecd4;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (25,26,27) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=9" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                        </section>
                        <!-- .ux-slider-wrapper -->
                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/cham_soc_ca_nhan_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container-1">
                            <a href="">
                                <div class="custom-banner-1 custom-banner-1-border">
                                    <div class="custom-banner-1-text">chăm sóc cá nhân</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_2">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #fff;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #fff;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham IN (28,29,30) LIMIT 4";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=10" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>


                        <div class="slider-wrapper">
                            <div class="slider slider-nav-circle slider-nav-large slider-nav-light slider-style-normal">
                                <div class="img has-hover">
                                    <div class="img-inner dark">
                                        <img src="images/banner/ve_sinh_nha_cua_banner.webp" alt="Image 1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="custom-container">
                            <a href="">
                                <div class="custom-banner custom-banner-border">
                                    <div class="custom-banner-text">Vệ sịnh nhà cửa</div>
                                </div>
                            </a>
                        </div>
                        <section class="section" id="section_1">
                            <div class="section-content relative">
                                <div class="row row-sp-5" id="row-1763273593">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left">
                                            <div class="row row-sp-noi-bat" id="row-1380101599">
                                                <div class="col title-danh-muc div-no-padding small-12 large-12">
                                                    <div class="col-inner text-center" style="background-color: #d8ecd4;">
                                                        <div class="row large-columns-4 medium-columns- small-columns-2 row-small" style="background-color: #d8ecd4;">
                                                            <?php
                                                            // Kết nối tới cơ sở dữ liệu
                                                            include "config.php";

                                                            // Lấy danh sách sản phẩm có cùng mã mặt hàng "1"
                                                            $query = "SELECT * FROM sanpham WHERE ma_loai_san_pham ";
                                                            $result = mysqli_query($conn, $query);

                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Lặp qua các sản phẩm và tạo HTML tương tự như code mẫu trên
                                                                while ($row = mysqli_fetch_assoc($result)) {
                                                                    $productTitle = $row['ten_san_pham'];
                                                                    $productPrice = $row['gia'];
                                                                    $productImage = $row['anh1'];
                                                                    $productId = $row['ma_san_pham']; // Lấy mã sản phẩm

                                                                    // Tạo HTML cho sản phẩm
                                                                    echo '<div class="col">
                <div class="col-inner">
                    <div class="custom-box box has-hover box-normal-1 box-text-bottom" style="background-color: white; margin-bottom: 5px;">
                        <div class="box-image">
                            <div class="">
                                <a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '"><img width="220" height="220" src="images/products/' . $productImage . '" class="attachment-woocommerce_thumbnail size-woocommerce_thumbnail" alt="" loading="lazy" /></a>
                            </div>
                            <div class="image-tools top right show-on-hover"></div>
                            <div class="image-tools grid-tools text-center hide-for-small bottom hover-slide-in show-on-hover">
                                <a class="quick-view" data-prod="1302" href="#quick-view">Quick View</a>
                            </div>
                        </div>
                        <div class="box-text text-center">
                            <div class="title-wrapper">
                                <p class="name product-title"><a href="xem-chi-tiet.php?ma_san_pham=' . $productId . '">' . $productTitle . '</a></p>
                            </div>
                            <div class="price-wrapper">
                                <span class="price">' . $productPrice . ' đ</span>
                            </div>
                            <div class="add-to-cart-button">
                                <a onclick="addToCart(' . $productId . ')" data-quantity="1" class="primary is-small mb-0 button product_type_simple add_to_cart_button ajax_add_to_cart is-outline" data-product_id="1302" data-product_sku="" rel="nofollow">MUA</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
                                                                }
                                                            } else {
                                                                echo "No products found.";
                                                            }

                                                            // Đóng kết nối với cơ sở dữ liệu
                                                            mysqli_close($conn);
                                                            ?>
                                                        </div>
                                                        <a href="xem-sp.php?ma_mat_hang=12" target="_self" class="button success is-link is-small lowercase">
                                                            <span>Xem thêm các sản phẩm khác</span>
                                                        </a>



                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- .section-content -->
                        </section>
                        <!-- .ux-slider-wrapper -->

                        <!------ƯU ĐÃI-------->
                        <div style="margin-top: 40px; background-color: white;">
                            <div style="position: relative; margin-top: 30px; min-height: 30px; width: 100%; border-top: 1px solid #FF5D01; background: radial-gradient(73.24% 73.24% at 50% 26.76%, rgba(255, 214, 0, 0.2) 0%, rgba(255, 92, 0, 0.2) 100%);">
                                <div style="position: absolute; left: 50%; top: -34px; width: 85%; min-width: 325px; transform: translateX(-50%);">
                                    <div style="position: relative; display: flex; align-items: center; justify-content: center; border-top-left-radius: 20px; border-top-right-radius: 20px; border: 1px solid #FF5D01; background: linear-gradient(to right, #FF946F, #FFD35E); padding: 4px; color: #00AC5B;">
                                        <div style="margin-left: 1px; display: flex; min-height: 24px; align-items: center; text-transform: uppercase; line-height: 18px; color: #fff;">
                                            <i class="fas fa__yellow-star"></i><span style="margin-left: 4px; font-size: 16px; font-weight: bold; letter-spacing: normal;">Gian hàng và ưu đãi từ hãng</span><i class="fas fa__yellow-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; flex-wrap: wrap; align-content: stretch; padding: 6px; padding-bottom: 8px; padding-top: 18px;">
                                    <div style="width: 50%; padding: 6px; padding-bottom: 4px; max-width: 25%;">
                                        <a href="/thuong-hieu/test-unilever-ct14">
                                            <img src="https://cdn.tgdd.vn/bachhoaxanh/shopinshop/14/bannerbrandpromo/unilever-viet-nam-2310202394815.jpg" style="width: 100%; height: auto; border-radius: 4px;" alt="Unilever Việt Nam">
                                        </a>
                                    </div>
                                    <div style="width: 50%; padding: 6px; padding-bottom: 4px; max-width: 25%;">
                                        <a href="/thuong-hieu/test-unilever-ct14">
                                            <img src="https://cdn.tgdd.vn/bachhoaxanh/shopinshop/20/bannerbrandpromo/nestle-191020238326.jpg" style="width: 100%; height: auto; border-radius: 4px;" alt="Nestlé">
                                        </a>
                                    </div>
                                    <div style="width: 50%; padding: 6px; padding-bottom: 4px; max-width: 25%;">
                                        <a href="/thuong-hieu/test-unilever-ct14">
                                            <img src="https://cdn.tgdd.vn/bachhoaxanh/shopinshop/9/bannerbrandpromo/coca-cola-2010202316848.jpg" style="width: 100%; height: auto; border-radius: 4px;" alt="COCA COLA">
                                        </a>
                                    </div>
                                    <div style="width: 50%; padding: 6px; padding-bottom: 4px; max-width: 25%;">
                                        <a href="/thuong-hieu/test-unilever-ct14">
                                            <img src="https://cdn.tgdd.vn/bachhoaxanh/shopinshop/16/bannerbrandpromo/p-g-161020239728.png" style="width: 100%; height: auto; border-radius: 4px;" alt="P&amp;G">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="section section-tieu-de" id="section_32833313">
                            <div class="bg section-bg fill bg-fill  bg-loaded">





                            </div><!-- .section-bg -->

                            <div class="section-content relative">


                            </div><!-- .section-content -->


                            <style scope="scope">
                                #section_32833313 {
                                    padding-top: 10px;
                                    padding-bottom: 10px;
                                }
                            </style>
                        </section>

                        <section class="section section-tin-tuc" id="section_997422195">
                            <div class="bg section-bg fill bg-fill  bg-loaded">




                                <div class="is-border" style="border-width:0px 0px 0px 0px;">
                                </div>

                            </div><!-- .section-bg -->

                            <div class="section-content relative">

                                <div class="row row-sp-5" id="row-38298990">
                                    <div class="col div-san-pham small-12 large-12">
                                        <div class="col-inner text-left" style="background-color:rgb(255, 255, 255);padding:0px 0px 0px 0px;">
                                            <div class="row row-sp-noi-bat" id="row-256251677">
                                                <div class="col title-danh-muc col-sp-noi-bat small-12 large-12">
                                                    <div class="col-inner">
                                                        <div class="row" id="row-1136332700">
                                                            <div class="col div-no-padding medium-8 small-12 large-8">
                                                                <div class="col-inner">
                                                                    <div class="video video-fit mb" style="padding-top:56.25%;">
                                                                        <p><iframe width="1020" height="574" src="https://www.youtube.com/embed/videoseries?list=PLuhqQ0YoA_Kf1O5AZGrGDxdtbhVGVv0LD" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col div-tin-tuc div-no-padding medium-4 small-12 large-4">
                                                                <div class="col-inner">


                                                                    <div class="row large-columns-1 medium-columns-1 small-columns-1 row-xsmall">
                                                                        <div class="col post-item">
                                                                            <div class="col-inner">
                                                                                <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/cach-lam-tom-rang-nuoc-cot-dua-beo-ngay-an-rat-hao-com-1315620" class="plain">
                                                                                    <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                                                                                        <div class="box-image" style="width:26%;">
                                                                                            <div class="image-cover" style="padding-top:56.25%;">
                                                                                                <img width="640" height="400" src="images/news/news-1.webp" sizes="(max-width: 640px) 100vw, 640px" />
                                                                                            </div>
                                                                                        </div><!-- .box-image -->
                                                                                        <div class="box-text text-left is-small">
                                                                                            <div class="box-text-inner blog-post-inner">


                                                                                                <h5 class="post-title is-large ">Công thức làm tôm rang nước cốt dừa thơm béo đãi cả nhà</h5>
                                                                                                <div class="is-divider"></div>



                                                                                            </div><!-- .box-text-inner -->
                                                                                        </div><!-- .box-text -->
                                                                                    </div><!-- .box -->
                                                                                </a><!-- .link -->
                                                                            </div><!-- .col-inner -->
                                                                        </div><!-- .col -->
                                                                        <div class="col post-item">
                                                                            <div class="col-inner">
                                                                                <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/nuoi-thu-cung-nhung-nha-van-sach-thom-chi-voi-5-meo-sau-1554511" class="plain">
                                                                                    <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                                                                                        <div class="box-image" style="width:26%;">
                                                                                            <div class="image-cover" style="padding-top:56.25%;">
                                                                                                <img width="800" height="400" src="images/news/news-2.jpg" class="attachment-medium size-medium wp-post-image" alt="" loading="lazy" />
                                                                                            </div>
                                                                                        </div><!-- .box-image -->
                                                                                        <div class="box-text text-left is-small">
                                                                                            <div class="box-text-inner blog-post-inner">


                                                                                                <h5 class="post-title is-large ">Nuôi thú cưng nhưng nhà vẫn sạch thơm chỉ với 5 mẹo sau</h5>
                                                                                                <div class="is-divider"></div>



                                                                                            </div><!-- .box-text-inner -->
                                                                                        </div><!-- .box-text -->
                                                                                    </div><!-- .box -->
                                                                                </a><!-- .link -->
                                                                            </div><!-- .col-inner -->
                                                                        </div><!-- .col -->
                                                                        <div class="col post-item">
                                                                            <div class="col-inner">
                                                                                <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/tuong-nen-loai-tuong-dac-biet-cho-nguoi-an-chay-1554500" class="plain">
                                                                                    <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                                                                                        <div class="box-image" style="width:26%;">
                                                                                            <div class="image-cover" style="padding-top:56.25%;">
                                                                                                <img width="548" height="400" src="images/news/news-3.jpg" sizes="(max-width: 548px) 100vw, 548px" />
                                                                                            </div>
                                                                                        </div><!-- .box-image -->
                                                                                        <div class="box-text text-left is-small">
                                                                                            <div class="box-text-inner blog-post-inner">


                                                                                                <h5 class="post-title is-large ">Tương nén - Loại tương đặc biệt cho người ăn chay</h5>
                                                                                                <div class="is-divider"></div>



                                                                                            </div><!-- .box-text-inner -->
                                                                                        </div><!-- .box-text -->
                                                                                    </div><!-- .box -->
                                                                                </a><!-- .link -->
                                                                            </div><!-- .col-inner -->
                                                                        </div><!-- .col -->
                                                                        <div class="col post-item">
                                                                            <div class="col-inner">
                                                                                <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/de-dien-thoai-tranh-2-bo-phan-nay-tren-nguoi-me-bau-cang-xa-cang-tot-1554499" class="plain">
                                                                                    <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                                                                                        <div class="box-image" style="width:26%;">
                                                                                            <div class="image-cover" style="padding-top:56.25%;">
                                                                                                <img width="755" height="400" src="images/news/news-4.jpeg" sizes="(max-width: 755px) 100vw, 755px" />
                                                                                            </div>
                                                                                        </div><!-- .box-image -->
                                                                                        <div class="box-text text-left is-small">
                                                                                            <div class="box-text-inner blog-post-inner">


                                                                                                <h5 class="post-title is-large ">Để điện thoại tránh 2 bộ phận này trên người mẹ bầu càng xa càng tốt</h5>
                                                                                                <div class="is-divider"></div>



                                                                                            </div><!-- .box-text-inner -->
                                                                                        </div><!-- .box-text -->
                                                                                    </div><!-- .box -->
                                                                                </a><!-- .link -->
                                                                            </div><!-- .col-inner -->
                                                                        </div><!-- .col -->
                                                                        <div class="col post-item">
                                                                            <div class="col-inner">
                                                                                <a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/tong-hop-5-dia-diem-nghi-duong-chua-lanh-cho-ngay-thu-tha-1554516" class="plain">
                                                                                    <div class="box box-vertical box-text-bottom box-blog-post has-hover">
                                                                                        <div class="box-image" style="width:26%;">
                                                                                            <div class="image-cover" style="padding-top:56.25%;">
                                                                                                <img width="548" height="400" src="images/news/news-5.jpg" sizes="(max-width: 548px) 100vw, 548px" />
                                                                                            </div>
                                                                                        </div><!-- .box-image -->
                                                                                        <div class="box-text text-left is-small">
                                                                                            <div class="box-text-inner blog-post-inner">


                                                                                                <h5 class="post-title is-large ">Tổng hợp 5 địa điểm nghỉ dưỡng, chữa lành cho ngày thư thả</h5>
                                                                                                <div class="is-divider"></div>



                                                                                            </div><!-- .box-text-inner -->
                                                                                        </div><!-- .box-text -->
                                                                                    </div><!-- .box -->
                                                                                </a><!-- .link -->
                                                                            </div><!-- .col-inner -->
                                                                        </div><!-- .col -->

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row large-columns-5 medium-columns-4 small-columns-2 row-collapse slider row-slider slider-nav-simple slider-nav-push" data-flickity-options='{"imagesLoaded": true, "groupCells": "100%", "dragThreshold" : 5, "cellAlign": "left","wrapAround": true,"prevNextButtons": true,"percentPosition": true,"pageDots": false, "rightToLeft": false, "autoPlay" : 3000}'>

                                                        </div>
                                                    </div>
                                                </div>

                                                <style scope="scope">

                                                </style>
                                            </div>
                                        </div>
                                    </div>

                                    <style scope="scope">

                                    </style>
                                </div>
                                <style>
                                    .flex {
                                        display: flex;
                                    }

                                    .w-full {
                                        width: 105%;
                                    }

                                    .items-center {
                                        align-items: center;
                                    }

                                    .justify-between {
                                        justify-content: space-between;
                                    }

                                    .bg-green {
                                        background-color: #007e42;
                                    }

                                    .px-3 {
                                        padding-left: 12px;
                                        padding-right: 12px;
                                    }

                                    .py-2 {
                                        padding-top: 8px;
                                        padding-bottom: 8px;
                                    }

                                    .text-white {
                                        color: #fff;
                                    }

                                    .text-10 {
                                        font-size: 10px;
                                    }

                                    .text-12 {
                                        font-size: 12px;
                                    }

                                    .text-14 {
                                        font-size: 14px;
                                    }

                                    .font-semibold {
                                        font-weight: 600;
                                    }

                                    .ml-2 {
                                        margin-left: 8px;
                                    }

                                    .text-yellow {
                                        color: #fff101;
                                    }

                                    .ml-20 {
                                        margin-left: -20px;
                                    }

                                    .mr-10 {
                                        margin-right: 5px;
                                    }

                                    .inline-flex {
                                        display: inline-flex;
                                    }

                                    .whitespace-nowrap {
                                        white-space: nowrap;
                                    }

                                    .fa-phone {
                                        display: inline-block;
                                        width: 14px;
                                        height: 14px;
                                        background-image: url('path_to_phone_fas fa.png');
                                        background-size: cover;
                                        margin-right: 4px;
                                    }

                                    .fa-check {
                                        display: inline-block;
                                        width: 14px;
                                        height: 14px;
                                        border-radius: 50%;
                                        border: 1px solid white;
                                        margin-right: 4px;
                                    }
                                </style>

                                <div class="flex w-full items-center justify-between bg-green px-3 py-2 text-white " style="margin: 10px 0 0 -20px;">
                                    <div class="flex items-center">
                                        <div class="text-12">Bán hàng 7:00 - 21:30</div>
                                        <span class="ml-2 text-14 font-semibold">
                                            <i class="fas fa-phone"></i>
                                            <a class="text-14" href="tel:19001908">1900 1908</a>
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="text-12">Khiếu nại 7:30 - 21:00</div>
                                        <span class="ml-2 text-14 font-semibold">
                                            <i class="fas fa-phone"></i>
                                            <a class="text-14" href="tel:18001067">1800 1067</a>
                                        </span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="text-12">
                                            <div class="flex items-center">
                                                <div class="w-58 min-w-65 text-12 font-semibold text-yellow">Cam kết:</div>
                                                <div class="ml-2 flex text-white">
                                                    <div class="mr-10 inline-flex items-center text-12">
                                                        <span class="fas fa-check"></span>
                                                        <span class="whitespace-nowrap">15.000 sản phẩm</span>
                                                    </div>
                                                    <div class="mr-10 inline-flex items-center text-12">
                                                        <span class="fas fa-check"></span>
                                                        <span class="whitespace-nowrap">Freeship đơn 300k</span>
                                                    </div>
                                                    <div class="mr-10 inline-flex items-center text-12">
                                                        <span class="fas fa-check"></span>
                                                        <span class="whitespace-nowrap">Giao 2h</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <footer style="margin: auto; display: flex ;width: 100% ;min-width: 360px ;max-width: 1280px ;flex-direction: column">
                                    <div style="display: flex ;flex-direction: column ;background-color: #fff ;padding: 12px">
                                        <div class="display: flex">
                                            <div style="max-width: 60%"><a href="https://www.bachhoaxanh.com/huong-dan-mua-hang" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Hướng dẫn mua hàng</a>
                                                <a href="https://hddt.bachhoaxanh.com" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Hóa đơn điện tử</a>
                                                <a href="chinh-sach-khach-hang" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Chính sách khách hàng</a><a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/chuong-trinh-tich-diem-cho-khach-hang-than-thiet-qua-ung-dung-qua-tang-vip-1434797" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Tích điểm Quà tặng VIP</a><a href="https://www.bachhoaxanh.com/gioi-thieu" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Giới thiệu công ty</a><a href="https://www.bachhoaxanh.com/chinh-sach-giao-hang" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Chính sách giao hàng</a><a href="https://matbang.thegioididong.com/" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Cần thuê mặt bằng</a><a href="https://www.bachhoaxanh.com/lien-he" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Liên hệ</a><a href="https://www.bachhoaxanh.com/kinh-nghiem-hay/chinh-sach-doi-tra-1230736" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Chính sách đổi trả</a><a href="https://www.bachhoaxanh.com/hoi-dap" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Hỏi đáp</a><a href="https://www.bachhoaxanh.com/he-thong-sieu-thi" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Xem 1706 cửa hàng</a><a href="https://www.thegioididong.com/tien-ich/thanh-toan-tra-gop?utm_source=bhx&amp;utm_medium=link_menu&amp;utm_campaign=promote_tragop" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Trả góp, điện nước</a><a href="https://vieclam.thegioididong.com" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Tuyển 3050 việc</a><a href="https://www.bachhoaxanh.com/quy-che-hoat-dong" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Quy chế Web</a><a href="https://www.bachhoaxanh.com/thu-mua-san-pham" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Đăng ký chào hàng</a><a href="https://www.bachhoaxanh.com/dat-mua-phieu-mua-hang" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Mua Phiếu mua hàng</a><a href="https://www.thegioididong.com/sim-so-dep?utm_source=bhx&amp;utm_medium=link_menu&amp;utm_campaign=promote_simthe" style="float: left ;width: 33.33% ;overflow: hidden ;padding-right: 4px ;text-align: left ;font-size: 14px ;line-height: 30px ;color: #222b45" target="_blank" rel="nofollow noreferrer">Mua sim, thẻ cào</a>
                                            </div>
                                            <div style="display: flex ;flex-direction: column">
                                                <div style="overflow: hidden"><a href="https://www.facebook.com/sieuthibachhoaxanh/" class="list_footer_desktop" style="margin-bottom: 10px" target="_blank" rel="noopener noreferrer">
                                                        <div class="fb-subscriber"><i class="fab fa-facebook" style="color: blue"></i> <b>503</b>k fan
                                                        </div>
                                                    </a><a class="list_footer_desktop " style="margin-bottom: 10px" href="http://online.gov.vn/Home/WebDetails/94623"><i class="fas fa-bct-mobile"></i></a><a href="https://www.dmca.com/Protection/Status.aspx?ID=278f841e-9c77-4573-a1c8-1f692ee09504&amp;refurl=https://www.bachhoaxanh.com/thit-bo/dui-bo-nhap-khau-dong-lanh-tui-500g" class="list_footer_desktop" style=" margin-bottom: 10px" title="DMCA.com Protection Status"><i class="fas fa-dmca-mobile"></i></a><a href="https://www.youtube.com/channel/UCF7OPnbn3u8OivdD4cqBkRQ" class="list_footer_desktop" style=" margin-bottom: 10px" target="_blank" rel="noopener noreferrer">
                                                        <div class="yt-subscriber"><i class="fab fa-youtube" style="color: red"></i> <b>50</b>k theo
                                                            dõi</div>
                                                    </a>
                                                    <a href="http://online.gov.vn/Home/WebDetails/94623" class="list_footer_desktop" style=" margin-bottom: 10px" title="Chung nhan Tin Nhiem Mang" target="_blank" rel="noreferrer">
                                                        <picture class="relative inline-block lazy loaded" style="width: 100px; height: 45px;">
                                                            <source type="image/webp" srcset="http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png"><img width="100" height="45" class="lazy loaded" data-src="http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png" src="http://online.gov.vn/Content/EndUser/LogoCCDVSaleNoti/logoSaleNoti.png" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
                                                        </picture>
                                                    </a>
                                                    <a href="https://tinnhiemmang.vn/danh-ba-tin-nhiem/bachhoaxanhcom-1632835470" class="list_footer_desktop" style=" margin-bottom: 10px" title="Chung nhan Tin Nhiem Mang" target="_blank" rel="noreferrer">
                                                        <picture class="relative inline-block lazy loaded" style="width: 100px; height: 45px;">
                                                            <source type="image/webp" srcset="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com"><img width="100" height="45" class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
                                                        </picture>
                                                    </a>
                                                    <a href="https://www.dmca.com/Protection/Status.aspx?ID=278f841e-9c77-4573-a1c8-1f692ee09504&refurl=https://www.bachhoaxanh.com/thit-bo/dui-bo-nhap-khau-dong-lanh-tui-500g" class="list_footer_desktop" style=" margin-bottom: 10px" title="Chung nhan Tin Nhiem Mang" target="_blank" rel="noreferrer">
                                                        <picture class="relative inline-block lazy loaded" style="width: 100px; height: 45px;">
                                                            <source type="image/webp" srcset="https://www.dmca.com/PP2020/images/status/verified-badge.png"><img width="100" height="45" class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
                                                        </picture>
                                                    </a>

                                                    <div style="display: flex ;min-width: 220px; flex-direction: column" class="items-start">
                                                        <div style="margin-left: -85px ;display: flex; justify-content: center" class="items-center">
                                                            <picture class="relative inline-block lazy loaded" style="width: 50px; height: 50px;">
                                                                <source type="image/webp" srcset="https://cdn.tgdd.vn/2020/06/GameApp/bach-hoa-xanh-logo-02-06-2020-200x200-2.png"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
                                                            </picture>
                                                            <ul style="margin: 25px 0 25px 5px; display: flex ;flex-direction: column ;justify-content: space-between; list-style: none">
                                                                <li style="font-size: 14px ;font-weight: bold ;color: #037841">Tải app Bách hoá XANH
                                                                </li>
                                                                <li style="font-size: 14px ;color: #515764">Mua nhanh, mua dễ</li>
                                                            </ul>
                                                        </div>
                                                        <div style="margin-left: 3px; margin-top: 3px; display: flex ;width: 100%"><a href="https://play.google.com/store/apps/details?id=com.bachhoaxanh&amp;referrer=utm_source%3Dfromefooterandroid" style="width: 105px" rel="noopener noreferrer">
                                                                <picture class="relative inline-block lazy loaded" style="width: 100px; height: 50px;">
                                                                    <source type="image/webp" srcset="https://w7.pngwing.com/pngs/696/500/png-transparent-google-play-mobile-phones-google-search-google-text-logo-sign.png"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
                                                                </picture>
                                                            </a>
                                                            <a href="https://click.google-analytics.com/redirect?tid=UA-204038942-1&amp;url=https%3A%2F%2Fitunes.apple.com%2Fus%2Fapp%2Fb%C3%A1ch-h%C3%B3a-xanh%2Fid1207511445&amp;aid=com.bachhoaxanh&amp;idfa=%{idfa}&amp;cs=fromfooterios" style="margin-left: 2px;  width: 105px" rel="noopener noreferrer">
                                                                <picture class="relative inline-block lazy loaded" style="width: 100px; height: 100px;">
                                                                    <source type="image/webp" srcset="https://w7.pngwing.com/pngs/314/368/png-transparent-itunes-app-store-apple-logo-apple-text-rectangle-logo.png"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
                                                                </picture>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-bottom: 1px;  margin-top: 3px; font-size: 14px">Website cùng tập đoàn</div>
                                        <div style="display: flex ;justify-content: space-between">
                                            <a href="https://www.thegioididong.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                                <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                                    <source type="image/webp" srcset="https://cdn.haitrieu.com/wp-content/uploads/2021/11/Logo-The-Gioi-Di-Dong-MWG-B-H.png"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                                </picture>
                                            </a>
                                            <a href="https://www.dienmayxanh.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                                <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                                    <source type="image/webp" srcset="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSyhqg2_q2fPOD7HQMX3fZ-i5YwmikH-6kyNaYc-bVVNb4O2IRz"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                                </picture>
                                            </a>
                                            <a href="https://www.topzone.vn/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                                <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                                    <source type="image/webp" srcset="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQN8L9IHHvyPO6ouZt6ZV1Rbb8bvboiDQ8ihcyz1tSiSc89DvSP"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                                </picture>
                                            </a>
                                            <a href="https://www.avakids.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                                <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                                    <source type="image/webp" srcset="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT2Ax9Jy_KA3e5JumTOovaR809hWOjjJs-q4M1qqWVOtm3FTpdv"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                                </picture>
                                            </a>
                                            <a href="https://www.nhathuocankhang.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                                <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                                    <source type="image/webp" srcset="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcR1dmWrvbaOBJPo4wu4IeDtFq9Wg-LOGtKP-84x_U_oObOX7bew"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                                </picture>
                                            </a>
                                            <a href="https://www.dichvutantam.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                                <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                                    <source type="image/webp" srcset="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcR_Dr-oHj4pYP0uKkVteQvIzqE0W6Tb6s6hzFVeACHMTpOW0QF2"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                                </picture>
                                            </a>
                                            <a href="https://www.maiamtgdd.vn/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                                <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                                    <source type="image/webp" srcset="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTHP7uiG7Fzg5B8wZMMJn900_Oj114qHW9hWzFOmXcKHAXhy40T"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                                </picture>
                                            </a>
                                            <a href="https://www.4kfarm.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                                <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                                    <source type="image/webp" srcset="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSipup1Kadc_F69eLFU09JgeeOZ-uhP-TVvRg-NfY8BP9XKUvf2"><img class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                                </picture>
                                        </div>
                                    </div>
                                    <div style="padding: 20px ;text-align: center ;font-size: 12px ;color: #9da7bc">© 2018. Công Ty Cổ Phần Thương Mại Bách Hoá Xanh. GPDKKD: 0310471746 do sở KH & ĐT TP.HCM cấp ngày 23/11/2010. Giấy phép thiết lập mạng xã hội trên mạng (Số 20/GP-BTTTT) do Bộ Thông Tin Và Truyền Thông cấp ngày 11/01/2021. Trụ sở chính: 128 Trần Quang Khải, P.Tân Định, Quận.1, TP.HCM. Địa chỉ liên hệ: Toà nhà MWG, Lô T2-1.2, Đường D1, Khu Công Nghệ Cao, P. Tân Phú, TP.Thủ Đức, TP.HCM. Email:lienhe@bachhoaxanh.com SĐT: 028.38125960 Chịu trách nhiệm nội dung: Trần Nhật Linh.<a href="/thoa-thuan-su-dung-trang-mxh" style="text-decoration: underline" rel="nofollow">Xem chính sách sử
                                            dụng web</a></div>
                                </footer>

                            </div><!-- .section-content -->


                            <style scope="scope">
                                #section_997422195 {
                                    padding-top: 10px;
                                    padding-bottom: 10px;
                                    background-color: rgb(255, 255, 255);
                                }
                            </style>
                        </section>

                    </div><!-- .page-inner -->
                </div><!-- end #content large-9 left -->
                <div class="large-3 div-sidebar col col-first col-divided hide-for-medium">
                    <div class="div-trong">
                        <div id="secondary" class="widget-area" role="complementary" style="overflow-y: auto;">
                            <aside id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
                                <span class="widget-title"><span>Danh mục sản phẩm</span></span>
                                <div class="is-divider small"></div>
                                <ul class='product-categories'>
  <li class='cat-item cat-parent'>
  </li>
</ul>
                                <?php
                                include("config.php");
                                // SQL query to fetch the list of categories and their respective sub-categories
                                $sql = "SELECT mh.ma_mat_hang, mh.ten_mat_hang, GROUP_CONCAT(lsp.ten_loai_san_pham SEPARATOR '; ') AS loai_san_pham
        FROM mathang mh
        INNER JOIN loaisanpham lsp ON mh.ma_mat_hang = lsp.ma_mat_hang
        GROUP BY mh.ma_mat_hang";

                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    echo "<ul class='product-categories'>";

                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $ma_mat_hang = $row['ma_mat_hang'];
                                        $ten_mat_hang = $row['ten_mat_hang'];
                                        $loai_san_pham = $row['loai_san_pham'];
                                        echo "<li class='cat-item cat-parent'>";
                                        echo "<a href='xem-sp.php?ma_mat_hang=$ma_mat_hang' class='category-name'>$ten_mat_hang </a>";
                                        echo "<ul class='children'>";

                                        $sub_categories_arr = explode('; ', $loai_san_pham);

                                        echo "</ul>";
                                        echo "</li>";
                                    }

                                    echo "</ul>";
                                } else {
                                    echo "No categories found.";
                                }

                                // Close the database connection
                                mysqli_close($conn);
                                ?>
                            </aside>
                        </div><!-- #secondary -->
                    </div>
                </div><!-- end sidebar -->

                <style>
                    .fa-angle-down {
                        float: right;
                        margin: 5px -20px;
                    }

                    .category-name {
                        display: flex;
                        justify-content: space-between;
                        align-items: center;
                    }

                    .category-name i {
                        margin-left: 5px;
                        transition: transform 0.3s, background-color 0.3s;
                        background-color: #ffffff;
                    }

                    .category-name.active i {
                        transform: rotate(180deg);
                        background-color: #f2f2f2;
                    }

                    .children {
                        display: none;
                        height: calc(110vh - 100px);
                        /* Chiều cao mở rộng */
                        overflow: hidden;
                        transition: height 0.3s;
                    }

                    .children.show {
                        display: block;
                        height: auto;
                        overflow-y: auto;
                        /* Thêm thanh cuộn dọc khi danh mục đã được mở */
                    }
                </style>





    </main><!-- #main -->

    <footer id="footer" class="footer-wrapper">





        <a href="#top" class="back-to-top button fas fa invert plain fixed bottom z-1 is-outline circle" id="top-link">↑ </a>

    </footer><!-- .footer-wrapper -->

    </div><!-- #wrapper -->




    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var categoryNames = document.querySelectorAll(".fa-angle-down");
            var openCategories = 0;

            categoryNames.forEach(function(categoryName) {
                categoryName.addEventListener("click", function() {
                    var children = this.nextElementSibling;
                    var icon = this.querySelector("i");

                    if (children.classList.contains("show")) {
                        children.classList.remove("show");
                        icon.classList.remove("active");
                        icon.style.transform = "rotate(0deg)"; // Quay ngược lại
                        openCategories--;

                        if (openCategories === 0) {
                            document.getElementById("secondary").style.height = ""; // Xóa thuộc tính height để thu về chiều cao ban đầu
                        }
                    } else {
                        children.classList.add("show");
                        icon.classList.add("active");
                        icon.style.transform = "rotate(180deg)"; // Quay ngược lại
                        openCategories++;

                        document.getElementById("secondary").style.height = "calc(110vh - 100px)"; // Chiều cao mở rộng
                    }
                });
            });
        });
    </script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var slider = new Flickity('.slider', {
                cellAlign: 'center',
                imagesLoaded: true,
                lazyLoad: 1,
                freeScroll: false,
                wrapAround: true,
                autoPlay: true, // Slider tự động chạy
                pauseAutoPlayOnHover: true,
                prevNextButtons: true,
                contain: true,
                adaptiveHeight: true,
                dragThreshold: 10,
                percentPosition: true,
                pageDots: true,
                rightToLeft: false,
                draggable: true,
                selectedAttraction: 0.1,
                parallax: 0,
                friction: 0.6
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('.slider-1-dis').slick({
                slidesToShow: 2, // Số lượng sản phẩm hiển thị trên mỗi slide
                slidesToScroll: 1, // Số lượng sản phẩm được scroll mỗi lần
                autoplay: true, // Tự động chạy slide
                autoplaySpeed: 2000, // Thời gian chờ giữa các slide (đơn vị millisecond)
                dots: false, // Hiển thị chỉ số dưới dạng dấu chấm
                prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            slidesToShow: 1
                        }
                    }
                ]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(".account-item").hover(
                function() {
                    $(this).find(".dropdown-list").show();
                },
                function() {
                    $(this).find(".dropdown-list").hide();
                }
            );
        });
    </script>
    <script>
        function addToCart(productId) {
            // Send Ajax request to add product to cart
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'them-vao-gio-hang.php?ma_san_pham=' + productId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    const response = xhr.responseText;
                    if (response === 'success') {
                        // Update cart quantity
                        updateCartQuantity();
                        alert("Product added to cart successfully!");
                        location.reload();
                    } else {
                        alert("Failed to add product to cart.");
                    }
                }
            };
            xhr.send();
        }

        function updateCartQuantity() {
            // Send Ajax request to get updated cart quantity
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'lay-tong-gio-hang.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    const cartQuantity = xhr.responseText;
                    document.getElementById('cart-quantity').textContent = cartQuantity;
                }
            };
            xhr.send();
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var userNameElement = document.getElementById("user-name");
            var dropdownList = document.querySelector(".dropdown-list-1");

            document.getElementById("logout").addEventListener("click", function(event) {
                event.preventDefault();

                // Send an AJAX request to perform logout
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        location.reload();
                        window.location.href = "index.php"; // Redirect to the homepage after successful logout
                    }
                };

                xhr.open('GET', 'logout.php', true);
                xhr.send();
            });

            <?php if (isset($_SESSION['hoTen'])) { ?>
                userNameElement.textContent = '<?php echo $_SESSION['hoTen']; ?>';
                dropdownList.style.display = 'hidden';
            <?php } else { ?>
                userNameElement.innerHTML = '<a href="dang-nhap.php">Đăng nhập / Đăng ký</a>';
                dropdownList.style.display = 'none';
            <?php } ?>
        });
    </script>
</body>

</html>
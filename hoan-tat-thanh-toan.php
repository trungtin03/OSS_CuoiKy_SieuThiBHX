<?php session_start(); ?>
<!DOCTYPE html>
<!--[if IE 9 ]> <html lang="vi-VN" class="ie9 loading-site no-js"> <![endif]-->
<!--[if IE 8 ]> <html lang="vi-VN" class="ie8 loading-site no-js"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="vi-VN" class="loading-site no-js"> <!--<![endif]-->

<head>
<meta charset="UTF-8" />

<title>Hoàn tất thanh toán hóa đơn</title>
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

    <script>
    function addToCart(productId) {
        // Send Ajax request to add product to cart
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'them-vao-gio-hang.php?ma_san_pham=' + productId, true);
        xhr.onreadystatechange = function () {
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
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                const cartQuantity = xhr.responseText;
                document.getElementById('cart-quantity').textContent = cartQuantity;
            }
        };
        xhr.send();
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
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

<script>
function xoaHD() {
    var xhttp = new XMLHttpRequest();
    
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
            if (this.status == 200) {
                var response = this.responseText;
                if (response === 'success') {
                    alert('Xóa đơn hàng thành công');
                    window.location.href = 'index.php';
                } else {
                    alert('Hủy đơn hàng thất bại');
                }
            } else {
                alert('Đã xảy ra lỗi trong quá trình xóa đơn hàng');
            }
        }
    };
    
    xhttp.open("GET", "xoa-hoa-don.php", true);
    xhttp.send();
}


</script>

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
														<i class="fas fa-search" style="color: green"></i>
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
                            <li class="account-item" >
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
<li class="cart-item has-fas fa has-dropdown">
    <a href="gio-hang.php" title="Giỏ hàng" class="header-cart-link is-small">
        <span class="header-cart-title">
            Giỏ hàng / <span class="cart-price"><span class="woocommerce-Price-amount amount">
            <?php
        include "config.php";
        $query_total = "SELECT SUM(thanh_tien) as totalAmount FROM giohang";
$result_total = mysqli_query($conn, $query_total);

if ($row_total = mysqli_fetch_assoc($result_total)) {
    $totalAmount = $row_total['totalAmount'];
            if ($totalAmount > 0) {
                echo '<span id="cart-quantity">' . $totalAmount . '</span>';
            }
        }
        mysqli_close($conn);
        ?>
            &nbsp;<span class="woocommerce-Price-currencySymbol">&#8363;</span></span></span>
        </span>
        <i class="fas fa-shopping-basket" data-fas fa-label="0"></i>
        <?php
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
        ?>
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
                            echo '<a href="#" class="product-title">Tên sản phẩm: ' . $tenSanPham . '</a>';
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
    max-height: 200px; /* Giới hạn chiều cao */
    overflow-y: auto; /* Hiển thị thanh cuộn khi vượt quá chiều cao */
}

.cart-item {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
}

.product-thumbnail img {
    max-width: 100px;
    height: auto;
    margin-right: 10px;
}

.product-info {
    flex: 1;
}

.product-title {
    font-weight: bold;
    margin-bottom: 5px;
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
    top: 10px;
    right: -10px;
    transform: translate(50%, -50%);
    display: inline-block;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 3px 6px;
    font-size: 10px;
    margin-left: 5px;
}
</style>
</li>
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
    <div>

		<div class="page-wrapper page-left-sidebar">
			<div class="row" id="row">

            <div class="container-1">
        <i class="fas fa-check-circle success-icon-1"><h1 class="title-1">ĐẶT HÀNG THÀNH CÔNG</h1></i>
        

        <div class="info-1">
            <label>Người nhận:</label>
            <span><?php 
            echo $_GET['full-name'];  ?></span>
            <span>- <?php echo $_GET['phone']; ?></span>
            <span>- <?php echo $_GET['address']; ?></span>

        </div>

        <div class="info-1">
            <label>Giao lúc:</label>
            <span><?php echo $_GET['pickup-time']; ?></span>
        </div>

        <div class="info-1">
            <label>Thanh toán:</label>
            <span><?php echo $_GET['payment-method']; ?></span>
            <?php if ($_GET['payment-method'] === 'Thanh toán chuyển khoản'): ?>
                        <div id="qr-code">
                            <h3>Quét QR Code để thanh toán:</h3>
                            <img width="30%" src="images/maQR.png" alt="QR Code">
                        </div>
                    <?php endif; ?>
        </div>

        <div class="info-1">
            <label>Tổng tiền:</label>
            <span><?php 
            echo $_GET['total-amount'] ; ?> + Phí giao hàng(<?php echo $_GET['delivery-fee']; ?> đ)</span>
        </div>

        <div class="buttons-1">
            <a href="index.php" class="button-1"><i class="fas fa-shopping-cart"></i> Tiếp tục mua sắm</a>
            <a href="#" id="xoaHD"  onclick="xoaHD()" class="button-1"><i class="fas fa-times-circle"></i> Hủy đơn hàng</a>
        </div>
    </div>
    <style>

        .container-1 {
            max-width: 600px;
            margin: 10px 50px 10px 120px ;
            padding: 20px;
            text-align: center;
            background-color: #f7f7f7;
        }

        .title-1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .success-icon-1 {
            color: green;
            font-size: 48px;
            margin-bottom: 20px;
        }

        .info-1 {
            text-align: left;
            margin-bottom: 20px;
        }

        .info-1 label {
            font-weight: bold;
        }

        .buttons-1 {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button-1 {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: green;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button-1:hover {
            background-color: #0056b3;
        }
    </style>






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

                                


                                <footer style="margin: auto; display: flex ;width: 100% ;min-width: 360px ;max-width: 1280px ;flex-direction: column; background-color:rgb(255, 255, 255); margin-top: 20px;">
                                  <div class="flex items-center justify-between bg-green px-3 py-2 text-white ">
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
                                                            <source type="image/webp" srcset="https://cdn.tgdd.vn/2020/06/GameApp/bach-hoa-xanh-logo-02-06-2020-200x200-2.png"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
                                                        </picture>
                                                            <ul style="margin: 25px 0 25px 5px; display: flex ;flex-direction: column ;justify-content: space-between; list-style: none">
                                                                <li style="font-size: 14px ;font-weight: bold ;color: #037841">Tải app Bách hoá XANH
                                                                </li>
                                                                <li style="font-size: 14px ;color: #515764">Mua nhanh, mua dễ</li>
                                                            </ul>
                                                        </div>
                                                        <div style="margin-left: 3px; margin-top: 3px; display: flex ;width: 100%"><a href="https://play.google.com/store/apps/details?id=com.bachhoaxanh&amp;referrer=utm_source%3Dfromefooterandroid" style="width: 105px" rel="noopener noreferrer">
                                                        <picture class="relative inline-block lazy loaded" style="width: 100px; height: 50px;">
                                                            <source type="image/webp" srcset="https://w7.pngwing.com/pngs/696/500/png-transparent-google-play-mobile-phones-google-search-google-text-logo-sign.png"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
                                                        </picture>
                                                    </a>
                                                    <a href="https://click.google-analytics.com/redirect?tid=UA-204038942-1&amp;url=https%3A%2F%2Fitunes.apple.com%2Fus%2Fapp%2Fb%C3%A1ch-h%C3%B3a-xanh%2Fid1207511445&amp;aid=com.bachhoaxanh&amp;idfa=%{idfa}&amp;cs=fromfooterios" style="margin-left: 2px;  width: 105px" rel="noopener noreferrer">
                                                    <picture class="relative inline-block lazy loaded" style="width: 100px; height: 100px;">
                                                            <source type="image/webp" srcset="https://w7.pngwing.com/pngs/314/368/png-transparent-itunes-app-store-apple-logo-apple-text-rectangle-logo.png"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 100px; height: 45px;">
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
                                        <source type="image/webp" srcset="https://cdn.haitrieu.com/wp-content/uploads/2021/11/Logo-The-Gioi-Di-Dong-MWG-B-H.png"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                        </picture>    
                                        </a>
                                        <a href="https://www.dienmayxanh.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                        <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                        <source type="image/webp" srcset="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcSyhqg2_q2fPOD7HQMX3fZ-i5YwmikH-6kyNaYc-bVVNb4O2IRz"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                        </picture>
                                        </a>
                                        <a href="https://www.topzone.vn/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                        <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                        <source type="image/webp" srcset="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQN8L9IHHvyPO6ouZt6ZV1Rbb8bvboiDQ8ihcyz1tSiSc89DvSP"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                        </picture></a>
                                        <a href="https://www.avakids.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                        <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                        <source type="image/webp" srcset="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcT2Ax9Jy_KA3e5JumTOovaR809hWOjjJs-q4M1qqWVOtm3FTpdv"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                        </picture></a>
                                        <a href="https://www.nhathuocankhang.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                        <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                        <source type="image/webp" srcset="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcR1dmWrvbaOBJPo4wu4IeDtFq9Wg-LOGtKP-84x_U_oObOX7bew"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                        </picture></a>
                                        <a href="https://www.dichvutantam.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                        <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                        <source type="image/webp" srcset="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcR_Dr-oHj4pYP0uKkVteQvIzqE0W6Tb6s6hzFVeACHMTpOW0QF2"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                        </picture></a>
                                        <a href="https://www.maiamtgdd.vn/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                        <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                        <source type="image/webp" srcset="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcTHP7uiG7Fzg5B8wZMMJn900_Oj114qHW9hWzFOmXcKHAXhy40T"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                        </picture></a>
                                        <a href="https://www.4kfarm.com/" class="list_footer_desktop" target="_blank" rel="noopener noreferrer">
                                        <picture class="relative inline-block lazy loaded" style="width: 80px; height:25px;">
                                        <source type="image/webp" srcset="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSipup1Kadc_F69eLFU09JgeeOZ-uhP-TVvRg-NfY8BP9XKUvf2"><img  class="lazy loaded" data-src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" src="https://tinnhiemmang.vn/handle_cert?id=bachhoaxanh.com" data-was-processed="true" alt="Chung nhan Tin Nhiem Mang" style="width: 80px; height: 25px;">
                                        </picture></div>
                                    </div>
                                    <div style="padding: 20px ;text-align: center ;font-size: 12px ;color: #9da7bc">© 2018. Công Ty Cổ Phần Thương Mại Bách Hoá Xanh. GPDKKD: 0310471746 do sở KH & ĐT TP.HCM cấp ngày 23/11/2010. Giấy phép thiết lập mạng xã hội trên mạng (Số 20/GP-BTTTT) do Bộ Thông Tin Và Truyền Thông cấp ngày 11/01/2021. Trụ sở chính: 128 Trần Quang Khải, P.Tân Định, Quận.1, TP.HCM. Địa chỉ liên hệ: Toà nhà MWG, Lô T2-1.2, Đường D1, Khu Công Nghệ Cao, P. Tân Phú, TP.Thủ Đức, TP.HCM. Email:lienhe@bachhoaxanh.com SĐT: 028.38125960 Chịu trách nhiệm nội dung: Trần Nhật Linh.<a href="/thoa-thuan-su-dung-trang-mxh" style="text-decoration: underline" rel="nofollow">Xem chính sách sử
                                            dụng web</a></div>
                                </footer>






















					<div class="large-3 div-sidebar col col-first col-divided hide-for-medium">
						<div class="div-trong">
							<div id="secondary" class="widget-area" role="complementary">
								<aside id="woocommerce_product_categories-2" class="widget woocommerce widget_product_categories">
									<span class="widget-title" onclick="toggleProductList()">Danh mục sản phẩm</span>
									<div class="is-divider small"></div>

									<ul class="product-categories" id="productList" style="display: none;">
										<?php
										include("config.php");
										// SQL query to fetch the list of categories and their respective sub-categories
										$sql = "SELECT mh.ma_mat_hang, mh.ten_mat_hang, GROUP_CONCAT(lsp.ten_loai_san_pham SEPARATOR '; ') AS loai_san_pham
          FROM mathang mh
          INNER JOIN loaisanpham lsp ON mh.ma_mat_hang = lsp.ma_mat_hang
          GROUP BY mh.ma_mat_hang";

										$result = mysqli_query($conn, $sql);

										if (mysqli_num_rows($result) > 0) {
											while ($row = mysqli_fetch_assoc($result)) {
												$ten_mat_hang = $row['ten_mat_hang'];
												$loai_san_pham = $row['loai_san_pham'];

												echo "<li class='cat-item cat-parent'>";
												echo "<a href='#' class='category-name'>$ten_mat_hang <i class='fas fa-angle-down'></i></a>";
												echo "<ul class='children'>";

												$sub_categories_arr = explode('; ', $loai_san_pham);

												foreach ($sub_categories_arr as $sub_category) {
													echo "<li class='cat-item'><a href='#'>$sub_category</a></li>";
												}

												echo "</ul>";
												echo "</li>";
											}
										} else {
											echo "<li>No categories found.</li>";
										}

										// Close the database connection
										mysqli_close($conn);
										?>
									</ul>
								</aside>
							</div><!-- #secondary -->
						</div>
					</div>

					<style>
						#secondary {
							height: 40px;
						}

						.fa-angle-down {
							float: right;
							margin: 5px -15px;
							transition: transform 0.3s, opacity 0.3s, background-color 0.3s;
							background-color: #ffffff;
						}

						.category-name {
							display: flex;
							justify-content: space-between;
							align-items: center;
							cursor: pointer;
						}

						.category-name i {
							transition: transform 0.3s;
						}

						.children {
							display: none;
							opacity: 0;
							overflow: hidden;
							transition: opacity 0.3s;
							padding-left: 15px;
						}

						.category-name.active .fa-angle-down {
							transform: rotate(180deg);
							background-color: #f2f2f2;
						}

						.category-name.active+.children {
							display: block;
							opacity: 1;
							transition-delay: 0.3s;
						}

						.widget-title {
							cursor: pointer;
						}
					</style>

					<script>
						document.addEventListener("DOMContentLoaded", function() {
							var categoryNames = document.querySelectorAll(".category-name");

							categoryNames.forEach(function(categoryName) {
								categoryName.addEventListener("click", function() {
									this.classList.toggle("active");
								});
							});
						});

						function toggleProductList() {
							var productList = document.getElementById("productList");
							productList.style.display = productList.style.display === "none" ? "block" : "none";
							updateBackgroundHeight();
						}

						function updateBackgroundHeight() {
							var productList = document.getElementById("productList");
							var secondary = document.getElementById("secondary");
							var section1 = document.getElementById("section_1");
							var section2 = document.getElementById("section_2");
							var row = document.getElementById("row");
							var main = document.getElementById("main");

							if (productList.style.display === "block") {
								var productListHeight = productList.offsetHeight;
								secondary.style.height = "calc(110vh - 100px)";
								secondary.style.backgroundColor = "white";
								section1.style.backgroundColor = "#464647";
								section2.style.backgroundColor = "#464647";
								row.style.backgroundColor = "#464647";
								main.style.backgroundColor = "#464647";
							} else {
								secondary.style.height = "40px";
								secondary.style.backgroundColor = "white";
								section1.style.backgroundColor = "rgb(255, 255, 255)";
								section2.style.backgroundColor = "rgb(255, 255, 255)";
								row.style.backgroundColor = "rgb(255, 255, 255)";
								main.style.backgroundColor = "rgb(255, 255, 255)";
							}
						}


						window.addEventListener("resize", updateBackgroundHeight);

						
					</script>



	</main><!-- #main -->

	<footer id="footer" class="footer-wrapper">



		<!-- FOOTER 2 -->



		<div class="absolute-footer dark medium-text-center text-center">
			<div class="container clearfix">


				<div class="footer-primary pull-left">
					<div class="copyright-footer">
						<p>MST: 01E8018201 | Ngày cấp 06.11.2014 do UBND Quận Đống Đa, Phòng Kinh Tế, TP.Hà Nội cấp.
						</p>
					</div>
				</div><!-- .left -->
			</div><!-- .container -->
		</div><!-- .absolute-footer -->
		<a href="#top" class="back-to-top button fas fa invert plain fixed bottom z-1 is-outline circle" id="top-link">↑ </a>

	</footer><!-- .footer-wrapper -->

	</div><!-- #wrapper -->

	<div class="ppocta-ft-fix show-for-small">

		<div id="messengerButton"> <a href="http://fb.com/m.me/Wanbitran3879" target="_blank"><i></i></a></div>

		<div id="zaloButton"> <a href="http://zalo.me/0969263879 " target="_blank"><i></i></a></div>

		<div id="callNowButton"> <a href="tel:0969263879 "><i></i></a> <a href="tel: 0969263879 " class="txt"></a></div>

	</div>
	<div id="gopy"> <a href="#gop-y"><i class="fa fa-envelope-o" aria-hidden="true"></i><span>Tư vấn</span></a></div>
	<div id="gop-y" class="lightbox-by-id lightbox-content mfp-hide lightbox-white " style="max-width:650px ;padding:20px">
		<div role="form" class="wpcf7" id="wpcf7-f5-o1" lang="vi" dir="ltr">
			<div class="screen-reader-response"></div>
			<form action="/#wpcf7-f5-o1" method="post" class="wpcf7-form" novalidate="novalidate">
				<div style="display: none;">
					<input type="hidden" name="_wpcf7" value="5" />
					<input type="hidden" name="_wpcf7_version" value="5.1.6" />
					<input type="hidden" name="_wpcf7_locale" value="vi" />
					<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f5-o1" />
					<input type="hidden" name="_wpcf7_container_post" value="0" />
				</div>
				<div class="form-gui-di">
					<h3>Vui lòng nhập thông tin, chúng tôi sẽ liên lạc lại tư vấn miễn phí cho quý vị </h3>
					<p><label> Họ tên<br />
							<span class="wpcf7-form-control-wrap your-name"><input type="text" name="your-name" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" /></span> </label></p>
					<p><label>Email<br />
							<span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" /></span> </label></p>
					<p><label>Số điện thoại<br />
							<span class="wpcf7-form-control-wrap your-phone"><input type="tel" name="your-phone" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-tel wpcf7-validates-as-required wpcf7-validates-as-tel" aria-required="true" aria-invalid="false" /></span> </label></p>
					<p><label>Sản phẩm, nội dung quý vị quan tâm cần tư vấn chi tiết<br />
							<span class="wpcf7-form-control-wrap your-message"><textarea name="your-message" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false"></textarea></span> </label></p>
					<p><input type="submit" value="Gửi đi" class="wpcf7-form-control wpcf7-submit" />
					</p>
				</div>
				<div class="wpcf7-response-output wpcf7-display-none"></div>
			</form>
		</div>
	</div>



</body>

</html>
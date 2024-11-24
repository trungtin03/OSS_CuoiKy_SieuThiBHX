-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 11:08 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanly_bachhoaxanh`
--

-- --------------------------------------------------------

--
-- Table structure for table `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `ma_hoa_don` int(11) DEFAULT NULL,
  `ma_san_pham` int(11) DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `thanh_tien` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `giamgia`
--

CREATE TABLE `giamgia` (
  `ma_giam_gia` int(11) NOT NULL,
  `ten_ma_giam_gia` text NOT NULL,
  `menh_gia_giam_gia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `giamgia`
--

INSERT INTO `giamgia` (`ma_giam_gia`, `ten_ma_giam_gia`, `menh_gia_giam_gia`) VALUES
(1, 'GIAMGIAGIUATUAN10', 10),
(2, 'GIAMGIACUOITUAN15', 15),
(3, 'GIAMGIANGAYLE20', 20),
(4, 'GIAMGIAKHTHANTHIET25', 25),
(5, 'GIAMGIABLACKFRIDAT30', 30);

-- --------------------------------------------------------

--
-- Table structure for table `giohang`
--

CREATE TABLE `giohang` (
  `ma_gio_hang` int(11) NOT NULL,
  `ma_san_pham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `thanh_tien` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

CREATE TABLE `hoadon` (
  `ma_hoa_don` int(11) NOT NULL,
  `ho_ten` varchar(255) DEFAULT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `tong_tien` decimal(10,2) DEFAULT NULL,
  `thoigian` date NOT NULL,
  `pt_thanh_toan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `ma_loai_san_pham` int(11) NOT NULL,
  `ten_loai_san_pham` varchar(255) DEFAULT NULL,
  `ma_mat_hang` int(11) DEFAULT NULL,
  `anh_loai_sp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`ma_loai_san_pham`, `ten_loai_san_pham`, `ma_mat_hang`, `anh_loai_sp`) VALUES
(1, 'Thịt các loại', 2, 'thit.webp'),
(2, 'Trứng các loại', 2, 'trung.webp'),
(3, 'Hải sản các loại', 2, 'hai-san.webp'),
(4, 'Trái cây', 3, 'trai-cay.webp'),
(5, 'Rau, củ, nấm các loại', 3, 'rau-cu-1.webp'),
(6, 'Rau, củ sơ chế', 3, 'rau-cu-2.webp'),
(7, 'Dầu ăn', 4, 'dau-an.webp'),
(8, 'Nước chấm các loại', 4, 'nuoc-cham.webp'),
(9, 'Gia vị các loại', 4, 'gia-vi.webp'),
(10, 'Kem, sữa chua, phô mai', 5, 'sua-chua.webp'),
(11, 'Thực phẩm đông lạnh các loại', 5, 'dong-lanh.webp'),
(12, 'Mì, phở, bún, miến, cháo ăn liền', 6, 'mi-an-lien.webp'),
(13, 'Mì, nui, bún khô', 6, 'mi-kho.webp'),
(14, 'Gạo các loại', 1, 'gao.webp'),
(15, 'Bột các loại', 1, 'bot.webp'),
(16, 'Đồ hộp các loại', 1, 'do-hop.webp'),
(17, 'Đồ chay các loại', 1, 'do-chay.webp'),
(18, 'Đồ uống có cồn', 7, 'bia.webp'),
(19, 'Đồ uống giải khát', 7, 'nuoc-ngot.webp'),
(20, 'Trà, cà phê, ngũ cốc', 7, 'ca-phe.webp'),
(21, 'Sữa tươi', 8, 'sua-tuoi.webp'),
(22, 'Sữa hạt', 8, 'sua-hat.webp'),
(23, 'Sữa bột', 8, 'sua-bot.webp'),
(24, 'Sữa đặc', 8, 'sua-dac.webp'),
(25, 'Bánh các loại', 9, 'banh.webp'),
(26, 'Kẹo các loại', 9, 'keo.webp'),
(27, 'Trái cây sấy', 9, 'trai-cay-say.webp'),
(28, 'Sản phẩm dành cho đầu', 10, 'hair.webp'),
(29, 'Sản phẩm dành cho cơ thể', 10, 'body.webp'),
(30, 'Sản phẩm dành cho mặt', 10, 'face.webp'),
(31, 'Nước tẩy rửa các loại', 12, 'nuoc-tay-rua.webp'),
(32, 'Túi đựng rác', 12, 'bich-rac.webp'),
(33, 'Dụng cụ lau trùi', 12, 'lau-chui.webp');

-- --------------------------------------------------------

--
-- Table structure for table `mathang`
--

CREATE TABLE `mathang` (
  `ma_mat_hang` int(11) NOT NULL,
  `ten_mat_hang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mathang`
--

INSERT INTO `mathang` (`ma_mat_hang`, `ten_mat_hang`) VALUES
(1, 'Gạo, bột, đồ khô'),
(2, 'Thịt, trứng, hải sản'),
(3, 'Rau, củ, nấm, trái cây'),
(4, 'Dầu ăn, nước chấm, gia vị'),
(5, 'Kem, thực phẩm đông lạnh'),
(6, 'Mì, miến, cháo, phở'),
(7, 'Bia, nước giải khát'),
(8, 'Sữa các loại'),
(9, 'Bánh kẹo các loại'),
(10, 'Chăm sóc cá nhân'),
(12, 'Vệ sinh nhà cửa');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_san_pham` int(11) NOT NULL,
  `ten_san_pham` varchar(255) DEFAULT NULL,
  `ma_loai_san_pham` int(11) DEFAULT NULL,
  `gia` int(11) DEFAULT NULL,
  `trong_luong` decimal(10,2) DEFAULT NULL,
  `thuong_hieu` varchar(255) DEFAULT NULL,
  `noi_san_xuat` varchar(255) DEFAULT NULL,
  `gioi_thieu` text DEFAULT NULL,
  `anh1` varchar(255) DEFAULT NULL,
  `anh2` varchar(255) DEFAULT NULL,
  `anh3` varchar(255) DEFAULT NULL,
  `giam_gia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`ma_san_pham`, `ten_san_pham`, `ma_loai_san_pham`, `gia`, `trong_luong`, `thuong_hieu`, `noi_san_xuat`, `gioi_thieu`, `anh1`, `anh2`, `anh3`, `giam_gia`) VALUES
(1, 'Sườn non heo nhập khẩu đông lạnh 500g(2-4 miếng)', 1, 75000, '500.00', 'Việt Nam', 'Nhập khẩu Đức, Brazil, Nga', 'Sườn non heo nhập khẩu có tỉ lệ nạc mỡ vừa đủ nên rất phù hợp để chế biến thành nhiều món ăn ngon cho gia đình. Sườn non nhập khẩu đông lạnh với phương pháp cấp đông hiện đại, giúp lưu giữ hương vị tự nhiên, mang đến những món ăn ngon cho gia đình.', 'avt_thit_heo.webp', 'suon-non-heo.webp', 'sp_thit_heo.webp', 0),
(2, 'Đùi bò nhập khẩu đông lạnh 500gr', 1, 99000, '500.00', 'Việt Nam', 'Úc', 'Thịt đùi có vị ngon tương tự phần mông bò và thường được cắt thành lát dày như bít-tết để nướng. Đùi bò nhập khẩu đông lạnh được cấp đông từ thịt bò tươi ngon là sản phẩm có xuất xứ rõ ràng nên đảm bảo an toàn thực phẩm và giàu chất dinh dưỡng', 'avt_dui_bo.webp', 'sp_dui_bo.webp', 'dui-bo-nhap-khau.webp', 0),
(3, 'Gà dai hàn quốc nhập khẩu đông lạnh nguyên con từ 1.1kg-1.3kg', 1, 88000, '1.10', 'Việt Nam', 'Hàn Quốc', 'Gà dai nhập khẩu được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm. Gà dai nguyên con nhập khẩu đông lạnh với chân gà sẫm màu do gà vận động nhiều, vẫn giữ được phần thịt gà dai, thơm, ngọt nên thường dùng để hầm nấu canh, súp hoặc cháo, giúp người dùng bảo quản lâu hơn.', 'avt_ga_dai.webp', 'sp_ga_dai_han_quoc.webp', 'ga-dai-han-quoc-nhap-khau.webp', 0),
(4, 'Cá diêu hồng làm sạch 300g - 450g/con', 3, 39000, '300.00', 'Việt Nam', 'Việt Nam', 'Cá diêu hồng loại cá phổ biến có thịt nhiều, ít xương, thịt trắng, ngọt và lành tính, cá diêu hồng chế biến thành rất nhiều món ngon trong bữa cơm gia đình như cá diêu hồng kho, cá diêu hồng nấu canh chua, cá diêu hồng chiên giòn, cá diêu hồng sốt cà chua,Việt Nam', 'avt_ca_dieu_hong.webp', 'sp_ca_dieu_hong.webp', 'ca-dieu-hong.webp', 20),
(5, 'Cua thịt Cà Mau con (200g - 250g)', 3, 99000, '200.00', 'Việt Nam', 'Việt Nam', 'Cua thịt nguyên con, tươi ngon, thịt cua chắc, ngọt thịt. Cua thịt giàu dinh dưỡng, hương vị thơm ngon, hấp dẫn, được nhiều người yêu thích lựa chọn. Cua thịt tại Bách hóa XANH chất lượng, đảm bảo độ tươi, mang đến sự hài lòng của khách hàng.', 'avt_cua_ca_mau.webp', 'sp_cua_ca_mau.webp', 'cua-thit-ca-mau.webp', 0),
(6, 'Mực một nắng 500g (3 - 5 con)', 3, 270000, '500.00', 'Song Phương', 'Việt Nam', 'Mực to, dày thịt, ngọt phù hợp để nướng hoặc chiên đều ngon. Mực một nắng thương hiệu Song Phương được phơi một nắng và đóng gói tiện lợi dễ dàng bảo quản', 'avt_muc_mot_nang.webp', 'sp_muc_mot_nang.webp', 'muc-mot-nang.webp', 0),
(7, 'Trứng gà Happy Egg hộp 10 quả', 2, 26000, '54.00', 'Happy Egg', 'Việt Nam', 'Hộp 10 trứng gà Happy Egg được đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt về vệ sinh và an toàn thực phẩm, đảm bảo về chất lượng của thực phẩm. Trứng gà to tròn, đều. Trứng gà Happy Egg có thể luộc chín chế biến thành một số món ăn khác như: thịt kho trứng, cơm chiên trứng,Việt Nam', 'avt_trung_ga.webp', 'sp_trung_ga.webp', 'trung-ga.webp', 10),
(8, 'Trứng vịt bắc thảo Phương Nam hộp 4 quả', 2, 26000, '70.00', 'Phương Nam', 'Việt Nam', 'Trứng vịt bắc thảo Phương Nam đảm bảo chất lượng, trứng to tròn, cầm chắc tay và giàu dinh dưỡng. Trứng vịt bắc thảo dùng để nấu soup cua, làm bánh, nấu cháo,Việt Nam ăn rất ngon và bắt vị.', 'avt_trung_vit.webp', 'sp_trung_vit.webp', 'trung-vit.webp', 0),
(9, 'Trứng cút Phương Nam hộp 30 quả', 2, 26000, '9.00', 'Phương Nam', 'Việt Nam', 'Trứng cút Phương Nam được đóng hộp 30 trứng đảm bảo tươi mới, trứng cút tròn, đều nhau. Trứng được thu hoạch, đóng gói và bảo quản theo những tiêu chuẩn nghiêm ngặt, đảm bảo vệ sinh và an toàn thực phẩm.', 'avt_trung_cut.webp', 'sp_trung_cut.webp', 'trung_cut.webp', 0),
(10, 'Khăn lau đa năng Nano kháng khuẩn hương tự nhiên túi 30 tờ', 33, 20000, '100.00', 'Nano ()', 'Việt Nam', 'Giấy lau bếp Nano với công thức đặc biệt giúp lau bếp hiệu quả, sạch nhanh, sạch nhẹ nhàng các vết bẩn cứng đầu, vết dầu mỡ bám xung quanh hoặc các vết cháy khét xung quanh căn bếp. 30 tờ khăn lau đa năng Nano kháng khuẩn hương tự nhiên túi 30cm lau sạch nhẹ nhàng, bếp sáng bóng.', 'avt_khan_lau_nano.webp', 'sp_khan_lau_nano.webp', 'khan_lau_nano.webp', 0),
(11, 'Nước lau kính Gift sắc biển tươi mát chai 800ml', 31, 27000, '800.00', 'Gift (Việt Nam)', 'Việt Nam', 'Nước lau kính Gift là loại nước lau kính được ưa chuộng vì giúp làm sạch nhanh, sáng, khử mùi hiệu quả và rất an toàn cho da tay. Nước lau kính Gift sắc biển tươi mát chai 800ml giúp bạn nhanh chóng loại bỏ vết bẩn, hạn chế bám bẩn, hương tươi mát.', 'avt_nuoc_lau_kinh.webp', 'sp_nuoc_lau_kinh.webp', 'nuoc_lau_kinh.webp', 0),
(12, 'Nước giặt Surf hương nước hoa túi 3.1kg', 31, 95000, '3.10', 'Surf (Anh và Hà Lan)', 'Việt Nam', 'Surf là sản phẩm nước giặt thương hiệu đến từ Hà Lan và Anh, nước giặt Surf giúp sạch nhanh hiệu quả, đưa hương thơm lan toả dù ngày nắng hay mưa, giúp bạn tự tin với quần áo luôn thơm tho, sạch sẽ. Nước giặt Surf hương nước hoa túi 3.1kg với hương cỏ hoa thơm mát dễ chịu.', 'avt_nuoc_giat_surf.webp', 'sp_nuoc_giat_surf.webp', 'nuoc_giat_surf.webp', 0),
(13, '2 chai nước lau sàn Rena hương bạc hà 1 lít', 31, 38000, '1.00', 'Rena ()', 'Việt Nam', 'Sản phẩm nước lau nhà chất lượng của thương hiệu nước lau nhà Rena phù hợp với mọi loại sàn, giúp sàn sạch bóng và mang hương thơm dễ chịu cho căn nhà của bạn. Nước lau sàn nhà Rena hương bạc hà chai 1 lít hương thơm bạc hà tươi mát, lan toả không khí thư giãn cho cả căn nhà của bạn.', 'avt_nuoc_lau_san.webp', 'nuoc_lau_san.webp', 'nuoc_lau_san.webp', 0),
(14, 'Nguyên liệu cơm chiên dương châu 150g', 6, 20000, '150.00', 'An Lạc', 'Việt Nam', 'Sản phẩm gồm những topping quen thuộc sử dụng trong món cơm chiên dương châu như cà rốt, bắp hạt, đậu,Việt Namđược làm sạch và cắt nhỏ miếng vừa ăn vô cùng tiện lợi đóng gói sạch sẽ thành nguyên liệu cơm chiên dương châu vô cùng tiện lợi, giúp tiết kiệm được thời gian khi nấu nướng.', 'avt_nguyen_lieu_com_chien.webp', 'sp_nguyen_lieu_com_chien.webp', 'nguyen_lieu_com_chien.webp', 0),
(15, 'Rau hỗn hợp 300g', 6, 25000, '300.00', 'SG Food', 'Việt Nam', 'Rau hỗn hợp gồm cà rốt, bắp non, măng tây tươi ngon, là những loại rau củ dinh dưỡng, thích hợp nấu được nhiều món ăn ngon. Rau củ chất lượng, được cắt sẵn, tiện lợi và tiết kiệm thời gian cho người nấu ăn.', 'avt_rau_hon_hop.webp', 'sp_rau_hon_hop.webp', 'rau_hon_hop.webp', 0),
(16, 'Xà lách thủy tinh thủy canh từ 200g', 5, 14000, '200.00', 'Langbiangfarm', 'Việt Nam', 'Xà lách thủy tinh thủy canh tươi ngon, chất lượng, có lá dày xoăn, hơi nhọn, vị ngọt và giòn. Vì vậy rau xà lách thủy tinh thường được sử dụng cho những món salad giúp cung cấp dưỡng chất, thanh mát cơ thể,Việt Nam', 'avt_xa_lach.webp', 'sp_xa_lach.webp', 'xa-lach.webp', 0),
(17, 'Dưa leo 500g (3 -5 trái)', 5, 13000, '500.00', 'Dưa leo Đà Lạt', 'Lâm Đồng - Việt Nam', 'Dưa leo trái lớn tươi ngon, được trồng và thu hoạch đảm bảo chất lượng, an toàn cho sức khỏe người sử dụng. Trong dưa leo chứa nhiều chất xơ, vitamin C, E, K, magie,Việt Namdễ ăn, dễ phối trộn với các món ăn khác, tốt sức khỏe vừa mang lại hiệu quả làm đẹp rất tốt', 'avt_dua_leo.webp', 'sp_dua_leo.webp', 'dua_leo.webp', 0),
(18, 'Nấm đùi gà baby 200g', 5, 25000, '200.00', 'FoodMap', 'Việt Nam', 'Nấm được nuôi trồng và đóng gói theo những tiêu chuẩn nghiêm ngặt, bảo đảm các tiêu chuẩn xanh - sạch, chất lượng và an toàn với người dùng. Nấm đùi gà baby giòn dai, ngọt thịt, nhiều dinh dưỡng thường được dùng cho các món xào, chiên giòn hoặc nướng ăn kèm với các loại xốt chấm.', 'avt_nam.webp', 'sp_nam.webp', 'nam.webp', 20),
(19, 'Bưởi da xanh lão trái 800g - 1kg', 4, 24000, '800.00', 'An Phát', 'Đồng Nai - Việt Nam', 'Bưởi Da xanh là trái cây đặc sản nổi tiếng của Việt Nam. Bưởi da xanh xuất xứ Đồng Nai, có đặc điểm vỏ có màu xanh đến xanh hơi vàng khi chín.Tép bưởi màu hồng đỏ, vị ngọt thanh, màu sắc đẹp mắt, là loại trái cây cực tốt cho sức khoẻ với nhiều công dụng thần kỳ khác nhau đã được khoa học chứng minh.', 'avt_buoi_da_xanh.webp', 'sp_buoi_da_xanh.webp', 'buoi_da_xanh.webp', 10),
(20, 'Cam sành 0.9-1.1kg (6 - 9 trái)', 4, 17000, '0.90', 'Việt Nam', 'Việt Nam', 'Cam sành là loại trái cây mọng nước, ngon ngọt, giàu vitamin, rất tốt cho sức khỏe và được nhiều người yêu thích. Cam sành có vỏ màu xanh và chuyển vàng khi chín, vỏ sần và dày, tép màu vàng cam đậm, mọng nước, vị ngọt chua và khá nhiều hạt. Thường được sử dụng để vắt lấy nước uống, đảm bảo nguồn gốc cam được trồng tại các tỉnh như Tiền Giang, Vĩnh Long,Việt Nam tuỳ theo mùa vụ, dạt chuẩn 100% VS ATTP', 'avt_cam_sanh.webp', 'sp_cam_sanh.webp', 'cam_sanh.webp', 0),
(21, 'Dưa hấu đỏ trái 1.7kg - 2kg', 4, 25500, '1.70', 'Việt Nam', 'Việt Nam', 'Dưa hấu đỏ là trái cây rất phổ biến tại Việt Nam và có quanh năm. Đặc điểm trái nhiều nước và vitamin, khoáng chất tốt cho sức khỏe, đặc biệt là ít calo và chất béo. Nước ép Dưa hấu có thể giải khát rất tốt trong mùa nóng nắng. Dưa hấu ngọt khi trái đủ độ chín, có vỏ xanh đậm, cuống héo nhẹ.', 'avt_dua_hau.webp', 'sp_dua_hau.webp', 'dua_hau.webp', 15),
(22, 'Dầu thực vật tinh luyện Cái Lân chai 1 lít', 7, 30000, '1.00', 'Cái Lân', 'Việt Nam', 'Dầu ăn Cái Lân là thương hiệu dầu ăn được ưa chuộng hàng đầu của người nội trợ Việt. Dầu thực vật tinh luyện Cái Lân chai 1 lít được làm từ dầu Olein cọ, dầu đậu nành tinh luyện,Việt Namgiúp tăng hương vị cho các món ăn, đặc biệt là những món chiên giòn trở nên hấp dẫn, thơm ngon.', 'avt_dau_an_cai_lan.webp', 'sp_đau_an_cai_lan.webp', 'dau_an_cai_lan.webp', 0),
(23, 'Dầu đậu nành nguyên chất Simply can 2 lít', 7, 102000, '2.00', 'Simply', 'Việt Nam', 'Dầu ăn Simply là loại dầu ăn sử dụng nguyên liệu chọn lọc, không chất bảo quản, tạo màu, rất an toàn cho sức khỏe. Dầu đậu nành Simply can 2 lít bổ sung Omega 3, 6, 9 có lợi cho sức khỏe và sự phát triển của não bộ, đẩy lùi nguy cơ mắc bệnh tim mạch.', 'avt_dau_an_simply.webp', 'sp_dau_an_simply.webp', 'dau_an_simply.webp', 0),
(24, 'Dầu ăn thượng hạng Neptune Light chai 1 lít', 7, 60000, '1.00', 'Neptune', 'Việt Nam', 'Là dòng dầu ăn thượng hạng của thương hiệu dầu ăn Neptune. Sản phẩm Dầu ăn thượng hạng Neptune Light can 1 lít không chứa cholesterol, đặc biệt với công thức Healthy GP giúp cơ thể giảm hấp thụ cholesterol từ thực phẩm, nên rất an toàn cho sức khỏe.', 'avt_dau_an_neptune.webp', 'sp_dau_an_neptune.webp', 'dau_an_neptune.webp', 0),
(25, 'Bột ngọt hạt lớn Ajinomoto gói 454g', 9, 35500, '454.00', 'Ajinomoto', 'Việt Nam', 'Bột ngọt hạt lớn Ajinomoto là thương hiệu bột ngọt hạt lớn sản xuất bằng phương pháp lên men tự nhiên từ mật mía đường và tinh bột khoai mì. Bột ngọt hạt lớn Ajinomoto 454g dùng trong chế biến món ăn gia đình, quán ăn,Việt Nam giúp món ăn thêm ngon, hấp dẫn.', 'avt_bot_ngot.webp', 'sp_bot_ngot.webp', 'bot_ngot.webp', 0),
(26, 'Đường tinh luyện An Khê gói 1kg', 9, 29000, '1.00', 'An Khê', 'Việt Nam', 'Thương hiệu đường An Khê là một trong những sự lựa chọn của mọi gia đình Việt. Đường tinh luyện An Khê gói 1kg với hạt đường trắng tinh, được sản xuất trên dây chuyền công nghệ hiện đại và sự lựa chọn hàng đầu cho các bà nội trợ trong việc chế biến.', 'avt_duong.webp', 'sp_duong.webp', 'duong.webp', 10),
(27, 'Muối sấy I-ốt Sosal Group gói 1kg', 9, 6900, '1.00', 'Sosal Group', 'Việt Nam', 'Muối Sosal Group là thương hiệu muối ăn thường được sử dụng trong bữa ăn hằng ngày của mọi gia đình. Muối sấy i-ốt Sosal Group 1kg là loại muối đã được sấy khô, hạt trắng mịn. Muối có màu sắc và vị mặn đặc trưng, được dùng làm phụ gia trực tiếp trong các bếp ăn.', 'avt_muoi.webp', 'sp_muoi.webp', 'muoi.webp', 0),
(28, '2 chai nước tương đậu nành đậm đặc Maggi 300ml', 8, 33000, '300.00', 'Maggi', 'Việt Nam', 'Với hương vị thanh ngon đặc trưng trong từng giọt nước tương sánh đậm, để lại dư vị tinh tế cho từng món ăn. Nước tương Maggi đậm đặc chai 300ml với tinh chất đậu nành đậm đặc, sử dụng công nghệ lên men tự nhiên 100% giúp giữ lại vị ngon tinh túy đến từ thương hiệu nước tương Maggi.', 'avt_nuoc_tuong_maggi.webp', 'sp_nuoc_tuong_maggi.webp', 'nuoc_tuong_maggi.webp', 0),
(29, 'Nước chấm Nam Ngư Đệ Nhị chai 900ml', 8, 25000, '900.00', 'Nam Ngư', 'Việt Nam', 'Nước mắm Nam Ngư là thương hiệu nước mắm rất nổi tiếng tại Việt Nam. Nước chấm Nam Ngư đệ nhị chai 900ml với thành phần cá cơm tươi ngon cùng với công thức pha chế đặc biệt, mang đến những bữa ăn trọn vẹn, đảm bảo an toàn cho gia đình.', 'avt_nuoc_cham_nam_ngu.webp', 'sp_nuoc_cham_nam_ngu.webp', 'nuoc_cham_nam_ngu.webp', 0),
(30, 'Nước mắm cốt Phú Quốc Quốc Vị 40 độ đạm chai 520ml', 8, 107000, '520.00', 'Phú Quốc', 'Việt Nam', 'Nước mắm Phú Quốc là thương hiệu nước mắm truyền thống được người dùng ưa chuộng nhất. Nước mắm cốt Phú Quốc Quốc Vị 40 độ đạm 520ml là nước mắm \"Cốt\" lấy thành phẩm đầu tiên được ủ chượp theo phương pháp truyền thống với các nguyên liệu tự nhiên và công nghệ sản xuất hiện đại.', 'avt_nuoc_mam_phu_quoc.webp', 'sp_nuoc_mam_phu_quoc.webp', 'nuoc_mam_phu_quoc.webp', 10),
(31, '2 hộp kem socola mảnh vị vani Iberri 250g (Nhập khẩu Thái Lan)', 10, 62000, '250.00', 'Iberri (Thái Lan)', 'Thái Lan', 'Sản phẩm đến từ thương hiệu kem Iberri quen thuộc, mang đến sự kết hợp giữa nhiều hương vị. 2 hộp kem socola mảnh vani Iberri 250g với sự kết hợp hương kem vani cùng các mảnh socola vụn đậm đà ngon khó cưỡng, cực đã khi dùng kem mát lạnh giữa thời tiết nóng bức.', 'avt_kem_socola.webp', 'sp_kem_socola.webp', 'kem_socola.webp', 0),
(32, 'Lốc 4 hộp sữa chua ăn TH True Yogurt táo sơ ri tự nhiên 100g', 10, 33000, '100.00', 'TH True Yogurt', 'Việt Nam', 'sữa chua ăn TH True Yogurt là thương hiệu sữa chua ăn nổi tiếng hàng đầu tại Việt Nam với đa dạng các sản phẩm chất lượng, nhiều hương vị tha hồ cho bạn chọn lựa. Lốc 4 hộp sữa chua ăn TH True Yogurt táo sơ ri tự nhiên 100g vị táo và sơ ri kết hợp 1 cách hoàn hảo, tốt cho hệ tiêu hóa.', 'avt_sua_chua.webp', 'sp_sua_chua.webp', 'sua_chua.webp', 0),
(33, '2 hộp phô mai Vinamilk 120g (8 miếng)', 10, 52000, '120.00', 'Vinamilk', 'Việt Nam', 'Là loại phô mai quen thuộc, được nhiều bà mẹ tin dùng đến từ thương hiệu phô mai Vinamilk. 2 hộp phô mai Vinamilk 120g (8 miếng) được chế biến từ sữa, là nguồn cung cấp năng lượng và các chất dinh dưỡng và các vitamin cần thiết không những cho trẻ em mà còn cho cả người lớn.', 'avt_pho_mai.webp', 'sp_pho_mai.webp', 'pho_mai.webp', 10),
(34, 'Cá nục 1 nắng 250g (4 - 6 con)', 11, 46500, '250.00', 'Song Phương', 'Việt Nam', 'Cá nục 1 nắng khay 250g là loại cá ngon, nhiều dinh dưỡng, lại vô cùng tiện lợi. Cá nục một nắng Song Phương có thể chế biến thành nhiều món ăn ngon như rim, chiên giòn,Việt Nam vừa ngon lại vừa dinh dưỡng, đảm bảo chất lượng và vệ sinh vô cùng.', 'avt_ca_nuc.webp', 'sp_ca_nuc.webp', 'ca_nuc.webp', 15),
(35, 'Thịt ba rọi bò Thảo Tiến Foods khay 300g', 11, 90000, '300.00', 'Thảo Tiến Foods', 'Việt Nam', 'Thịt bò Mỹ Thảo Tiến Foods là loại thịt bò đông lạnh được thái bằng máy tự động trong môi trường lạnh, tạo nên những khoanh thịt đỏ hồng. Thịt ba rọi bò Mỹ Thảo Tiến Foods khay 300g là phần thịt bò nằm ở phần bụng, có lớp nạc mỡ xen kẽ nhau, tạo nên độ mềm ngọt, thơm ngậy nhưng không ngấy.', 'avt_thit_bo_ba_roi.webp', 'sp_thit_bo_ba_roi.webp', 'thit_bo_ba_roi.webp', 20),
(36, 'Vây cá hồi SG Food gói 500g', 11, 59500, '500.00', 'SG Food', 'Việt Nam', 'Hải sản đông lạnh chất lượng từ cá đông lạnh SG Food. Vây cá hồi SG Food gói 500g với thành phần vây cá hồi 100% tươi ngon, chứa nhiều dưỡng chất, đặc biệt là dồi dào omega 3, không chất bảo quản được làm sạch và đóng gói kín đáo, an toàn tiện lợi chế biến thành nhiều món ăn ngon.', 'avt_vay_ca_hoi.webp', 'sp_vay_ca_hoi.webp', 'vay_ca_hoi.webp', 0),
(37, 'Thùng 30 gói mì Hảo Hảo tôm chua cay 75g', 12, 115000, '75.00', 'Mì Hảo Hảo', 'Việt Nam', 'Sợi mì Hảo Hảo vàng dai ngon hòa quyện trong nước súp tôm chua cay đậm đà từng sợi mì sóng sánh cùng hương thơm quyến rũ ngất ngây. Thùng 30 gói mì Hảo Hảo tôm chua cay 75g là lựa chọn hấp dẫn không thể bỏ qua đặc biệt là những ngày bận rộn cần bổ sung năng lượng nhanh chóng, đủ chất.', 'avt_mi_haohao.webp', 'sp_mi_haohao.webp', 'mi_haohao.webp', 15),
(38, '5 gói hủ tiếu Nam Vang Nhịp Sống 70g', 12, 42300, '70.00', 'Nhịp Sống (New Zealand)', 'Việt Nam', '5 gói hủ tiếu Nam Vang Nhịp Sống 70g là bữa ăn cực tiện lợi và thơm ngon cho cả gia đình,  là sản phẩm hủ tiếu ăn liền của thương hiệu hủ tiếu Nhịp Sống với hương vị hủ tiếu Nam Vang đậm đà thấm đều trong từng sợi hủ tiếu dai ngon cực đã cùng mùi hương hấp dẫn.', 'avt_hu_tieu.webp', 'sp_hu_tieu.webp', 'hu_tieu.webp', 0),
(39, '5 gói cháo yến thịt bằm Yến Việt 50g', 12, 46400, '50.00', 'Yến Việt', 'Việt Nam', 'Là dòng sản phẩm cháo yến ăn liền tiện lợi từ thương hiệu cháo Yến Việt. 5 gói cháo yến Yến Việt vị thịt bằm 50g có chứa tổ yến tự nhiên cùng rau thịt tươi sấy thăng hoa mang hương vị thịt bằm tươi ngon và giàu dinh dưỡng là lựa chọn hoàn hảo cho bữa ăn nhanh chóng đơn giản, thơm ngon.', 'avt_chao_yen.webp', 'sp_chao_yen.webp', 'chao_yen.webp', 0),
(40, 'Mì trứng Erci sợi nhỏ gói 500g', 13, 21700, '500.00', 'Erci (Việt Nam)', 'Việt Nam', 'Mì trứng là món ăn giúp cung cấp năng lượng, vitamin, dưỡng chất cần thiết cho các hoạt động hàng ngày. Kích thước sợi mì tròn, nhỏ. Mì trứng Erci sợi nhỏ gói 500g sợi mì dai, mềm, ăn một miếng là không thể nào quên được hương vị thơm ngon lưu luyến trên đầu lưỡi.', 'avt_mi_trung.webp', 'sp_mi_trung.webp', 'mi_trung.webp', 0),
(41, 'Nui cao cấp Meizan gói 400g', 13, 28600, '400.00', 'Meizan (Việt Nam)', 'Việt Nam', 'Nui Meizan thích hợp trong việc chế biến những món ăn cho trẻ con hoặc ăn kèm với các món súp bởi nui có đặc tính mềm, dai nhẹ và kích thước nhỏ. Nui cao cấp Meizan gói 400g chế biến từ nguồn nguyên liệu an toàn, thân thiện với sức khỏe và không hề chứa hàn the.', 'avt_nui.webp', 'sp_nui.webp', 'nui.webp', 0),
(42, 'Bún gạo khô Jimmy túi 250g', 13, 22000, '250.00', 'Jimmy (Việt Nam)', 'Việt Nam', 'Bún gạo được làm từ bột gạo 89%, bột bắp 11% tốt cho sức khỏe cả gia đình bạn. Bún gạo khô Jimmy túi 250g được sản xuất theo công nghệ tiên tiến của Hà Lan (100% nguồn gốc tự nhiên, không phụ gia, không chất bảo quản). Bún khô có thể xào hoặc nấu với nước lèo tùy sở thích.', 'avt_bun_gao_kho.webp', 'sp_bun_gao_kho.webp', 'bun_gao_kho.webp', 0),
(43, 'Gạo Meizan Nàng Thơm túi 5kg', 14, 117000, '5.00', 'Meizan (Việt Nam)', 'Việt Nam', 'Gạo khi nấu có độ mềm dẻo vừa phải cùng hương thơm nhẹ nhàng, kích thích cho bữa ăn thêm phần hấp dẫn. Gạo Meizan Nàng Thơm túi 5kg của hãng gạo Meizan với hạt gạo thon dài, màu trắng ngà tự nhiên, được nuôi trồng canh tác theo tiêu chuẩn nghiêm ngặt đảm bảo an toàn và chất lượng.', 'avt_gao_meizan.webp', 'sp_gao_meizan.webp', 'gao_meizan.webp', 10),
(44, 'Gạo Nhật Neptune Japonica túi 5kg', 14, 135000, '5.00', 'Neptune (Việt Nam)', 'Việt Nam', 'Gạo các loại Neptune là sự lựa chọn tuyệt vời dành cho gia đình bạn. Gạo Nhật Neptune Japonica túi 5kg thơm ngon không chỉ được sử dụng trong bữa cơm gia đình mà còn dùng làm susi, cơm cuộn, cơm nắm. Gạo được làm từ giống lúa Japonica chất lượng, an toàn cho người sử dụng.', 'avt_gao_nhat.webp', 'sp_gao_nhat.webp', 'gao_nhat.webp', 0),
(45, 'Gạo thơm Ngon ST24 túi 5kg', 14, 160000, '5.00', 'Ngon (Việt Nam)', 'Việt Nam', 'Gạo khi nấu cho cơm mềm ngọt, dẻo dai, rất ngon tạo cảm giác dễ chịu cho người ăn. Gạo thơm Ngon ST24 túi 5kg thuộc thương hiệu gạo Ngon được nuôi trồng canh tác theo quy trình tiên tiến, nghiêm ngặt đảm bảo không chất bảo quản, không thuốc trừ sâu, kích thích tăng trưởng.', 'avt_gao_thom.webp', 'sp_gao_thom.webp', 'gao_thom.webp', 15),
(46, '2 gói bột chiên giòn Meizan 150g', 15, 14000, '150.00', 'Meizan (Việt Nam)', 'Việt Nam', 'Cho những chiếc đùi gà giòn ta, những rau củ quả hay hải sản được chiên giòn. 2 gói bột chiên giòn Meizan 150g tiện dụng, được căn chỉnh hoàn hảo, cho món chiên giòn rụm thơm ngon. Bột chiên giòn Meizan tiện lợi, an toàn và chất lượng cao.', 'avt_bot_chien_gion_meizan.webp', 'sp_bot_chien_gion_meizan.webp', 'bot_chien_gion_meizan.webp', 20),
(47, '2 gói bột tẩm khô chiên giòn Aji-Quick 84g', 15, 24500, '84.00', 'Aji-Quick (Việt Nam)', 'Việt Nam', 'Thích hợp cho những món gà chiên, hải sản chiên hay rau củ chiên cũng rất thơm ngon. 2 gói bột tẩm khô chiên giòn Aji-Quick 84g mang đến những món ăn ngon, giòn tan mà không bị ngán. Bột Aji-Quick được căn chỉnh đậm đà gia vị, phù hợp khẩu vị của người Việt.', 'avt_bot_tam_kho.webp', 'sp_bot_tam_kho.webp', 'bot_tam_kho.webp', 0),
(48, 'Sương sáo đen 3K gói 50g', 15, 17000, '50.00', '3K (Việt Nam)', 'Việt Nam', 'Sản phẩm bao gồm: 1 gói bột sương sáo, 1 gói dầu chuối, 1 gói đường trắng. Bột sương sáo đen 3K gói 50g tiện lợi giúp bạn chế biến món ăn thanh mát, dinh dưỡng cho gia đình vào những ngày hè oi bức. Bột sương sáo 3K an toàn, chất lượng và được tin dùng.', 'avt_bot_suong_sao_den.webp', 'sp_bot_suong_sao_den.webp', 'bot_suong_sao_den.webp', 0),
(49, 'Hạt nêm cao cấp nấm hương Maggi gói 800g', 9, 89000, '800.00', 'Maggi (Việt Nam)', 'Việt Nam', ' Hạt nêm chay của thương hiệu Maggi là sự lựa chọn tuyệt vời cho món ăn gia đình bạn thêm tròn vị và hấp dẫn. Hạt nêm cao cấp nấm hương Maggi gói 800g với thành phần nấm hương tự nhiên thanh ngọt làm dây lên vị ngọt đậm đà và mùi thơm tự nhiên cho món ăn thêm đậm đà tròn vị.', 'avt_hat_nem_cao_cap.webp', 'sp_hat_nem_cao_cap.webp', 'hat_nem_cao_cap.webp', 0),
(50, 'Lẩu chua cay chay Trần Gia khay 500g', 17, 66500, '500.00', 'Trần Gia', 'Việt Nam', 'Thực phẩm tẩm ướp Trần Gia là hãng thực phẩm sơ chế, tẩm ướp rất có tiếng tại Việt Nam với các sản phẩm chất lượng cao, an toàn. Lẩu chua cay chay Trần Gia khay 500g với nguyên liệu tự nhiên, dinh dưỡng cho món lẩu chay nhanh chóng, tiện dụng hơn bao giờ hết.', 'avt_lau_chay.webp', 'sp_lau_chay.webp', 'lau_chay.webp', 0),
(51, 'Thùng 30 gói mì chay lá đa 3 Miền 65g', 17, 96000, '65.00', '3 Miền (Việt Nam)', 'Việt Nam', 'Mì sợi to, cay cay siêu ngon. Thùng 30 gói mì chay lá đa 3 Miền 65g thích hợp cho những ai ăn chay với bữa ăn nhanh chóng, tiện lợi và vẫn đủ năng lượng hoạt động cho ngày dài. Mì chay 3 Miền tiện lợi, dinh dưỡng và thơm ngon.', 'avt_mi_3mien_chay.webp', 'sp_mi_3mien_chay.webp', 'mi_3mien_chay.webp', 10),
(52, '2 hộp bò hai lát 3 bông mai Vissan 150g', 16, 36000, '150.00', 'Vissan (Việt Nam)', 'Việt Nam', 'Bò hộp tiện lợi, thơm ngon, dinh dưỡng. 2 hũ bò hai lát 3 bông mai Vissan 150g hương vị đậm đà hấp dẫn, kích thích vị giác. Bò hộp Vissan  giúp bạn tiết kiệm thời gian mà vẫn cũng cấp chất dinh dưỡng cho gia đình. Sản phẩm ngon, ăn nhiều cơm mà không bị ngán.', 'avt_hop_bo_2lat.webp', 'sp_hop_bo_2lat.webp', 'hop_bo_2lat.webp', 0),
(53, 'Cá mòi xốt cà chua nắp giật 3 Cô Gái hộp 155g', 16, 16900, '155.00', '3 Cô Gái (Thái Lan)', 'Việt Nam', 'Sản phẩm cá hộp mang đến cho người dùng sự tiện lợi, cùng hương vị đậm đà của nước sốt cà. Cá mòi sốt cà 3 Cô Gái hộp nắp giựt 155g có thể dùng để ăn liền hoặc chế biến thành các món ăn tuỳ ý. Cá hộp 3 cô gái đem đến cho gia đình bạn những món ăn ngon lành và bổ dưỡng.', 'avt_hop_ca_moi.webp', 'sp_hop_ca_moi.webp', 'hop_ca_moi.webp', 0),
(54, 'Pate gan Vissan 170g', 16, 29000, '170.00', 'Vissan (Việt Nam)', 'Việt Nam', 'Những món ăn ngon hết sẩy khi ăn kèm với pate: bánh mì, gà nấu pate tiêu xanh, bắp bò nấu pate, bánh pate sô… Pate gan heo Vissan hộp 170g được đóng hộp nhỏ gọn, tiện lợi sử dụng trong gia đình hoặc mang đi du lịch, dã ngoại. Pate Vissan nhỏ gọn dễ dàng bảo quản, dễ dàng đem theo và sử dụng.', 'avt_pate.webp', 'sp_pate.webp', 'pate.webp', 0),
(55, 'Thùng 24 lon bia Heineken Bạc 330ml', 18, 446000, '330.00', 'Heineken (Hà Lan)', 'Việt Nam', 'Bia thơm ngon chất lượng chính hãng thương hiệu bia được ưa chuộng tại hơn 192 quốc gia trên thế giới đến từ Hà Lan - bia Heineken. 24 lon Heineken Bạc 330ml thơm ngon hương vị bia tuyệt hảo, cân bằng và êm dịu, thiết kế đẹp mắt, cho người dùng cảm giác sang trọng, nâng tầm đẳng cấp.', 'avt_bia_heniken.webp', 'sp_bia_heniken.webp', 'bia_heniken.webp', 10),
(56, 'Rượu soju Chumchurum Saero 16% chai 375ml', 18, 44000, '375.00', 'Chumchurum', 'Hàn Quốc', 'Sản phẩm rượu chính hãng chất lượng, nhập khẩu trực tiếp từ Hàn Quốc của thương hiệu rượu Chumchurum nổi tiếng. Rượu soju Chumchurum Saero 16% chai 375ml được sản xuất từ ngũ cốc chưng cất và lúa mạch thượng hạng cùng công thức độc đáo nhà Chumchurum cho hương vị sảng khoái', 'avt_ruou_soju.webp', 'sp_ruou_soju.webp', 'ruoi_soju.webp', 0),
(57, 'Rượu Vang Đà Lạt Excellence đỏ 12% chai 750ml', 18, 210000, '750.00', 'Vang Đà Lạt', 'Việt Nam', 'Rượu vang thơm ngon từ thương hiệu rượu Vang Đà Lạt. Rượu Vang Đà Lạt Excellence đỏ 12% 750ml có màu tím đỏ sậm, mùi hương phức hợp của quả khô và sô cô la, vị đậm, mượt mà và hậu vị kéo dài, rất phù hợp với các món ăn là thịt, kể cả thịt đỏ, thịt trắng hay gia cầm. Cam kết chất lượng và an toàn.', 'avt_ruou_vang.webp', 'sp_ruou_vang.webp', 'ruou_vang.webp', 20),
(58, '6 lon nước ngọt Mirinda vị cam 320ml', 19, 52500, '320.00', 'Mirinda (Việt Nam)', 'Việt Nam', 'Sản phẩm nước ngọt giải khát từ thương hiệu nước ngọt Mirinda nổi tiếng được nhiều người ưa chuộng. 6 lon nước ngọt Mirinda cam lon 320ml với hương vị cam đặc trưng, không chỉ giải khát, mà còn bổ sung thêm vitamin C giúp lấy lại năng lượng cho hoạt động hàng ngày.', 'avt_nuoc_ngot.webp', 'sp_nuoc_ngot.webp', 'nuoc_ngot.webp', 0),
(59, 'Nước cam có tép Teppy 1 lít', 19, 22500, '1.00', 'Teppy (Việt Nam)', 'Việt Nam', 'Chiết xuất từ những quả cam mọng nước cùng với những tép cam tươi hấp dẫn tự nhiên. Và được sản xuất theo công nghệ hiện đại, không chất độc hại không ảnh hưởng đến sức khỏe người tiêu dùng. Nước ép cam Teppy nguyên tép chứa nhiều vitamin C hỗ trợ cung cấp năng lượng cho cơ thể.', 'avt_nuoc_ep.webp', 'sp_nuoc_ep.webp', 'nuoc_ep.webp', 0),
(60, 'Nước ngọt có ga Coca Cola chai 390ml', 19, 7800, '390.00', 'Coca Cola (Mỹ)', 'Việt Nam', 'Từ thương hiệu nước giải khát hàng đầu thế giới, nước ngọt Coca Cola chai 390ml xua tan nhanh mọi cảm giác mệt mỏi, căng thẳng, đặc biệt thích hợp sử dụng với các hoạt động ngoài trời. Bên cạnh đó thiết kế dạng chai nhỏ gọn, tiện lợi dễ dàng bảo quản khi không sử dụng hết.', 'avt_nuoc_coca.webp', 'sp_nuoc_coca.webp', 'nuoc_coca.webp', 0),
(61, 'Trà ô long Tea Plus 320ml', 20, 6600, '320.00', 'Tea Plus (Việt Nam)', 'Việt Nam', 'Trà ô long Tea Plus 320ml với hương vị ngọt nhẹ thanh mát, mùi thơm đặc trưng cùng hoạt chất OTTP giúp hạn chế hấp thu chất chéo. Trà ô long Tea Plus giúp làm lắng nhẹ những cơn ưu tư mang đến cảm giác nhẹ nhàng. Thưởng thức nước trà ngay mỗi ngày để cuộc sống thêm nhẹ.', 'avt_tra_o_long.webp', 'sp_tra_o_long.webp', 'tra_o_long.webp', 0),
(62, 'Hộp 5 gói nước cốt cà phê sữa NesCafé 75ml', 20, 25500, '375.00', 'NesCafé', 'Việt Nam', 'Chất cà phê phin mà lại nhanh chóng như cà phê hòa tan chính là nước cốt cà phê được chiết xuất từ bột cà phê rang xay, mô phỏng kỹ thuật ủ cà phê phin, giữ lại nước cốt đầu tinh túy. Hộp 5 gói nước cốt cà phê sữa NesCafé 75ml chính hãng cà phê Nescafé cho bạn nguồn năng lượng sảng khoái.', 'avt_nuoc_cot_cf.webp', 'sp_nuoc_cot_cf.webp', 'nuoc_cot_cf.webp', 0),
(63, 'Mật ong chín hoa yên bạch Honimore hũ 110g', 20, 74000, '110.00', 'Honimore', 'Việt Nam', 'Hoa Yên Bạch nở vào cuối đông, đầu xuân, là cây dược liệu dùng trong Đông Y. Mật ong chín hoa yên bạch Honimore hũ 110g là mật ong đơn hoa, có màu vàng đậm, vị ngậy và mùi thảo dược. Mật ong là thực phẩm tốt cho sức khỏe lẫn làm đẹp.', 'avt_mat_ong_chin.webp', 'sp_mat_ong_chin.webp', 'mat_ong_chin.webp', 10),
(64, '2 lốc sữa tươi tiệt trùng Dutch Lady có đường 180ml', 21, 54000, '180.00', 'Dutch Lady (Hà Lan)', 'Việt Nam', 'Sữa tươi Dutch Lady sử dụng nguyên liệu là sữa tươi, bổ sung protein, phốt pho, Vitamin B2 và B12 cùng nhiều vitamin và khoáng chất trong sữa tươi cần thiết cho cơ thể. 2 lốc sữa tươi tiệt trùng Dutch Lady có đường 180ml bán lốc 4 tiện sử dụng, tiết kiệm, thêm đường dễ uống.', 'avt_sua_dutch_lady.webp', 'sp_sua_dutch_lady.webp', 'sua_dutch_lady.webp', 15),
(65, 'Lốc 4 hộp sữa tươi tiệt trùng ít đường TH true MILK 110ml', 21, 24000, '110.00', 'TH true MILK (Việt Nam)', 'Việt Nam', 'Sữa tươi TH True Milk đảm bảo không sử dụng thêm hương liệu, mang vị ngon sữa tươi nguyên chất 100%, chứa nhiều vitamin và khoáng chất như Vitamin A, D, B1, B2, canxi, kẽm. Lốc 4 hộp sữa tươi tiệt trùng ít đường TH true MILK 110ml đóng lốc tiện lợi, tiết kiệm, ít đường dễ uống.', 'avt_sua_TH_nho.webp', 'sp_sua_TH_nho.webp', 'sua_TH_nho.webp', 0),
(66, '2 hộp sữa tươi tiệt trùng không đường Vinamilk 100% Sữa tươi 1 lít', 21, 65000, '1.00', 'Vinamilk (Việt Nam)', 'Việt Nam', 'Sữa tươi Vinamilk là thương hiệu được tin dùng hàng đầu với chất lượng tuyệt vời được chế biến từ nguồn sữa tươi 100% chứa nhiều dưỡng chất như vitamin A, D3, canxi,Việt Nam tốt cho xương và hệ miễn dịch. 2 hộp sữa tươi tiệt trùng Vinamilk 100% không đường 1 lít thơm ngon, bổ dưỡng.', 'avt_sua_vinamilk.webp', 'sp_sua_vinamilk.webp', 'sua_vinamilk.webp', 0),
(67, '2 hộp sữa bột Anlene Gold 3X vị socola ít béo 440g', 22, 347000, '440.00', 'Anlene (New Zealand)', 'Malaysia', 'Sữa bột Anlene là dòng sữa bột chống loãng xương hàng đầu rất được ưa chuộng, chứa Bonemax, canxi, vitamin D, đạm, magiê và fos inulin giúp xương chắc khoẻ hơn mỗi ngày. 2 hộp sữa bột Anlene Gold 3X socola ít béo 440g cho người trên 40 tuổi, hương thơm socola thơm ngon dễ uống.', 'avt_sua_bot_anlene.webp', 'sp_sua-bot_anlene.webp', 'sua_bot_anlene.webp', 0),
(68, 'Lốc 6 chai sữa bột pha sẵn Ensure Original vani 237ml', 23, 229000, '237.00', 'Ensure (Mỹ)', 'Mỹ', 'Sữa bột Ensure là sản phẩm dinh dưỡng đầy đủ và cân đối cho người lớn, hỗ trợ tiêu hóa. Sữa bột pha sẵn có thể thay thế bữa ăn hoặc dùng ăn bổ sung cho người cần cải thiện tình trạng dinh dưỡng. Lốc 6 chai sữa bột pha sẵn Ensure Original vani 237ml hỗ trợ tăng cường sức khỏe, thể chất hiệu quả.', 'avt_sua_bot_pha_san.webp', 'sp_sua_bot_pha_san.webp', 'sua_bot_pha_san.webp', 10),
(69, 'Sữa bột Wincofood Canxi Bone & Joints hương vani lon 800g', 23, 379000, '800.00', 'Wincofood (Việt Nam)', 'Việt Nam', 'Sữa bột Wincofood Canxi Bone & Joints vani 800g bổ sung canxi, vitamin D và collagen giúp tăng độ đàn hồi, độ ẩm của da và cho xương chắc khỏe hơn. Sữa bột Wincofood Canxi Bone & Joints là dòng sản phẩm sữa bột dành cho người trên 30 tuổi cần bổ sung canxi và collagen.', 'avt_sua_wincofood.webp', 'sp_wincofood.webp', 'sua_wincofood.webp', 10),
(70, '2 thùng sữa đậu đen óc chó hạnh nhân Sahmyook 190ml', 22, 547000, '190.00', 'Sahmyook (Hàn Quốc)', 'Hàn Quốc', 'Ngoài sữa tươi, các loại sữa hạt, sữa đậu cũng giúp bổ sung dưỡng chất tốt, cần thiết cho cơ thể. Được làm từ 3 loại đậu vô cùng giàu dinh dưỡng: đậu đen, óc chó và hạnh nhân, 2 thùng sữa đậu đen óc chó hạnh nhân Sahmyook 190ml mang đến cho bạn và cả gia đình nguồn dinh dưỡng dồi dào.​​', 'avt_sua_hat_dau_den.webp', 'sp_sua_hat_dau_den.webp', 'sua_hat_dau_den.webp', 10),
(71, '3 hộp sữa 9 loại hạt Vinamilk Super Nut ít đường 1 lít', 22, 163000, '1.00', 'Vinamilk (Việt Nam)', 'Việt Nam', '3 hộp sữa 9 loại hạt Vinamilk Super Nut ít đường 1 lít có chứa Omega 3 và nhiều loại vitamin tốt cho trí não, vóc dáng và làn da. Sữa hạt Vinamilk Super Nut đuợc làm từ 9 loại hạt cao cấp, với thành phần chứa hơn 94% sữa hạt, mang đến hàm lượng dinh dưỡng cao, hương vị lại thơm ngon, hấp dẫn.', 'avt_sua_9_loai_hat.webp', 'sp_sua_9_loai_hat.webp', 'sua_9_loai_hat.webp', 15),
(72, 'Sữa đậu nành nguyên chất Nuti bịch 200ml', 22, 4500, '200.00', 'Nuti (Việt Nam)', 'Việt Nam', 'Sữa đậu nành Nuti thơm ngon, được làm từ 100% hạt đậu nành chọn lọc, không cholesterol, không chất bảo quản. Sữa đậu nành còn mang đến hương vị thơm ngon thuần khiết. Sữa đậu nành nguyên chất Nuti bịch 200ml có chứa protein, chất xơ và vitamin rất tốt cho sức khoẻ.', 'avt_sua_dau_nanh.webp', 'sp_sua_dau_nanh.webp', 'sua_dau_nanh.webp', 0),
(73, 'Sữa đặc có đường Ông Thọ Trắng nhãn xanh hộp 380g', 24, 25500, '380.00', 'Ông Thọ (Việt Nam)', 'Việt Nam', 'Sữa đặc Ông Thọ với vị thơm ngon, sánh đặc, là bí quyết giúp mẹ có những món ăn ngon, chăm sóc cho cả gia đình. Sữa đặc có đường Ông Thọ trắng nhãn xanh hộp 380g ngọt đậm và có hàm lượng chất béo khá cao. Ngoài ra, sữa đặc còn là nguồn nguyên liệu hoàn hảo để làm món ăn, thức uống khác.', 'avt_sua_dac_ong_tho.webp', 'sp_sua_dac_ong_tho.webp', 'sua_dac_ong_tho.webp', 0),
(74, 'Kem đặc Vinamilk Tài Lộc lon 380g', 24, 15800, '380.00', 'Vinamilk (Việt Nam)', 'Việt Nam', 'Kem đặc của thương hiệu kem đặc Vinamilk với vị ngọt đậm đà, độ sánh mịn phù hợp với mọi nhu cầu sử dụng. Kem đặc mang lại vị ngon, ngọt, béo thơm ngon và hấp dẫn cực kỳ. Kem đặc Vinamilk Tài Lộc lon 380g tiện lợi, giá tốt, thơm ngon đi cùng năm tháng, phù hợp pha chế nhiều món ăn, thức uống.', 'avt_kem_dac.webp', 'sp_kem_dac.webp', 'kem_dac.webp', 0),
(75, 'Kem đặc có đường Ngôi sao Phương Nam Xanh lá hộp 380g', 24, 20000, '380.00', 'Ngôi sao Phương Nam (Việt Nam)', 'Việt Nam', 'Sữa đặc Ngôi sao Phương Nam xanh lá đậm đà đặc sánh, mang lại hương vị hài hòa, thơm béo. Sữa đặc là nguồn nguyên liệu lý tưởng dùng để pha sữa, chấm bánh mì,.. thơm ngon tuyệt vời. Kem đặc có đường Ngôi sao Phương Nam xanh lá hộp 380g ngọt và béo nhất so với các sản phẩm cùng loại.', 'avt_kem_dac_ngoi_sao_phuong_nam.webp', 'sp_kem_dac_ngoi_sao_phuong_nam.webp', 'kem_dac_ngoi_sao_phuong_nam.webp', 0),
(76, 'Bánh gạo nướng vị tảo biển Orion An gói 111.3g', 25, 23000, '111.30', 'Orion (Hàn Quốc)', 'Việt Nam', 'Bánh gạo giòn giòn thơm ngon, bánh có lớp rong biển phủ bên ngoài, thơm ngon, lạ miệng và kích thích vị giác. Bánh gạo nướng vị tảo biển Orion An gói 111.3g tiện lợi cho các buổi tiệc ngọt. Bánh gạo Orion dinh dưỡng, ăn vặt cũng rất phù hợp để thư giãn và đọc sách.', 'avt_banh_gao.webp', 'sp_banh_gao.webp', 'banh_gao.webp', 10),
(77, 'Bánh quế vị kem socola Cosy gói 117.6g', 25, 14500, '117.60', 'Cosy (Việt Nam)', 'Việt Nam', 'Bánh thơm ngon, giòn tan đậm vị socola. Bánh quế vị kem sô cô la Cosy gói 117.6g là sản phẩm chất lượng đến từ thương hiệu bánh quế Cosy, hương vị thơm ngon, kích thích vị giác khi ăn. Bánh quế có thể sử dụng để ăn vặt hoặc trang trí những món ngọt tùy thích như kem, puding,Việt Nam', 'avt_banh_que.webp', 'sp_banh_que.webp', 'banh_que.webp', 0),
(78, 'Bánh quy vị cà phê Libra Braka hộp 150g', 25, 29000, '150.00', 'Libra', 'Việt Nam', 'Bánh quy cà phê thơm ngon, có vị ngọt vừa phải cùng lớp đường phủ trên bề mặt rất hấp dẫn. Bánh quy cà phê Braka Libra hộp 150g giòn ngon, kích thích vị giác khi ăn vô cùng. Bánh quy Libra là sản phẩm Việt Nam chất lượng cao.', 'avt_banh_quy.webp', 'sp_banh_quy.webp', 'banh_quy.webp', 0),
(79, 'Kẹo sing-gum Cool Air hương bạc hà khuynh diệp gói 145g', 26, 50000, '145.00', 'Cool Air (Mông Cổ)', 'Philippines', 'Kẹo Singum cho hơi thở thơm mát, giúp sảng khoái tinh thần. Kẹo sing-gum Cool Air hương bạc hà khuynh diệp gói 145g giúp bạn thơm miệng, tự tin giao tiếp. Kẹo Singum Cool Air còn giúp bạn tạo ra nguồn năng lượng tích cực để làm việc và vui chơi, tự tin giao tiếp.', 'avt_keo_singum.webp', 'sp_keo_singum.webp', 'keo_singum.webp', 0),
(80, 'Kẹo hương bạc hà nhân socola Dynamite Big Bang gói 120g', 26, 13000, '120.00', 'Dynamite (Việt Nam)', 'Việt Nam', 'Kẹo cứng lớp vỏ bạc hà the mát, bọc lấy nhân socola thơm béo, thích miệng. Không chứa chất bảo quản và đường hoá học. Kẹo hương bạc hà nhân socola Dynamite Big Bang gói 120g ngọt thanh mang đến cho bạn sự dễ chịu, thỏa mái. Kẹo ngậm Dynamite giúp bạn bùng nổ cảm xúc.', 'avt_keo_bac_ha.webp', 'sp_keo_bac_ha.webp', 'keo_bac_ha.webp', 0),
(81, 'Kẹo mềm vị sữa Sumika gói 70g', 26, 8000, '70.00', 'Sumika (Việt Nam)', 'Việt Nam', 'Kẹo mềm, vị sữa béo ngậy hoà quyện trong viên kẹo mềm dẻo, tạo nên hương vị thơm ngon quen thuộc với khẩu vị của người Việt. Kẹo mềm vị sữa Sumika gói 70g được chia thành những viên nhỏ, đóng gói lẻ tiện lợi,dễ bảo quản. Kẹo mềm Sumika thơm ngon, hấp dẫn, béo ngậy.', 'avt_keo_mem.webp', 'sp_keo_mem.webp', 'keo_mem.webp', 0),
(82, 'Mít sấy Vinamit gói 100g', 27, 39500, '100.00', 'Vinamit (Việt Nam)', 'Việt Nam', 'Mít sấy giòn giòn, thơm và giữ được độ ngọt tự nhiên của trái cây, ăn rất thích. Mít sấy Vinamit gói 250g vừa ăn vừa xem phim, đọc sách rất phù hợp hoặc thưởng trà. Trái cây sấy Vinamit chất lượng, vệ sinh và dinh dưỡng, là món ăn tiện lợi và thơm ngon.', 'avt_mit_say.webp', 'sp_mit_say.webp', 'mit_say.webp', 10),
(83, 'Chuối sấy Rộp Rộp gói 100g', 27, 25000, '100.00', 'Rộp Rộp (Việt Nam)', 'Việt Nam', 'Chuối sấy là loại trái cây sấy giòn giòn, giữ được độ ngọt tự nhiên của chuối chín. Chuối sấy Rộp Rộp gói 100g tiện lợi, loại bỏ hạt, có vị xốp xốp nhưng không mất đi hương vị tự nhiên của nó. Chuối sấy Rộp Rộp vừa ăn vặt vừa thưởng trà thư giãn rất phù hợp.', 'avt_chuoi_say.webp', 'sp_chuoi_say.webp', 'chuoi_say.webp', 0),
(84, '2 gói khoai môn sấy Rộp Rộp 100g', 27, 45000, '100.00', 'Rộp Rộp (Việt Nam)', 'Việt Nam', 'Khoai môn thật thơm ngon, dinh dưỡng lại còn có màu tím hấp dẫn, phù hợp với mọi người. 2 gói hoai môn sấy Rộp Rộp100g thơm thơm, giòn giòn, ngọt tự nhiên, dễ ăn phù hợp ăn tráng miệng, uống tràViệt Nam Khoai lang sấy Rộp Rộp là sản phẩm chất lượng cao.', 'avt_khoai_mon_say.webp', 'sp_khoai_mon_say.webp', 'khoai_mon_say.webp', 10),
(85, 'Dầu gội Head & Shoulders làm sạch gàu mềm mượt óng ả 625ml', 28, 139000, '625.00', 'Head & Shoulders (Mỹ)', 'Thái Lan', 'Dầu gội Head & Shoulders là dòng sản phẩm dầu gội dành cho nam giới được nhiều người yêu thích. Dầu gội Head & Shoulders làm sạch gàu mềm mượt óng ả 625ml với công thức tạo bọt Micro làm sạch sâu cho da đầu. Khả năng chống gàu và ngứa kéo dài đến 72 giờ.', 'avt_dau_goi.webp', 'sp_dau_goi.webp', 'dau_goi.webp', 0),
(86, 'Tắm gội 2 in 1 Romano Classic  900g', 28, 224000, '900.00', 'Romano (Singapore)', 'Việt Nam', 'Với sự kết hợp giữa những hương gỗ tự nhiên cùng công thức cải tiến trong sản phẩm tắm gội 2 trong 1 giúp làm sạch và nuôi dưỡng làn da mềm mịn, tắm gội Romano Classic 900g với dung tích lớn, là sản phẩm được nam giới tin dùng đến từ thương hiệu tắm gội Romano.', 'avt_tam_goi_2in1.webp', 'sp_tam_goi_2in1.webp', 'tam_goi_2in1.webp', 10),
(87, 'Tắm gội 3 in 1 X-men For Boss Legend hương gió biển 830g', 28, 248000, '830.00', 'X-men ()', 'Việt Nam', 'Tắm gội 3 in 1 X-men For Boss Legend hương gió biển 830g với thành phần dầu tắm gội được cải tiếng với công thức Ultra Keratin, dưỡng ẩm da đầu và toàn thân với chiết xuất olive và hương nước hoa thanh mát, nam tính. Dầu tắm gội X-men là thương hiệu nổi tiếng được ưa chuộng dàng cho nam giới.', 'avt_tam_goi_3in1.webp', 'sp_tam_goi_3in1.webp', 'tam_goi_3in1.webp', 0),
(88, '2 gói khăn giấy rút Bless You Famille 2 lớp 200 tờ', 30, 35000, '800.00', 'Bless You (Việt Nam)', 'Việt Nam', 'Khăn giấy thương hiệu khăn giấy Bless You - sản xuất tại Việt Nam. Không mùi, thành phần 100% bột giấy nguyên thủy an toàn cho da khi sử dụng. 2 gói khăn giấy rút Bless You Famille 2 lớp 200 tờ dùng làm sạch da mặt, lau chùi vết bẩn.', 'avt_khan_giay.webp', 'sp_khan_giay.webp', 'khan_giay.webp', 0),
(89, 'Khẩu trang y tế Famapro Sunny 4 lớp xanh hộp 50 cái', 30, 28000, '140.00', 'Famapro (Việt Nam)', 'Việt Nam', 'Khẩu trang y tế  Famapro chất lượng được nhiều người lựa chọn tin dùng. Khẩu trang y tế Famapro Sunny 4 lớp màu xanh hộp 50 cái giúp với nguyên liệu cao cấp giúp kháng khuẩn, ngăn bụi và chống tia UV hiệu quả. Khẩu trang với thiết kế ôm sát vừa vặn cho người sử dụng.', 'avt_khau_trang.webp', 'sp_khau_trang.webp', 'khau_trang.webp', 0),
(90, 'Xịt khử mùi AXE Gold Temptation 135ml', 29, 81000, '135.00', 'AXE', 'Thái Lan', 'Xịt khử mùi với thiết kế chai dạng xịt tiện lợi, dễ sử dụng, thiết kế nhỏ gọn để bạn có thể dễ dàng mang theo bên mình đến bất kì đâu. Xịt khử mùi AXE không gây ố vàng khi sử dụng. Xịt khử mùi AXE Gold Temptation chai 135ml giúp giữ cho cơ thể thơm mát suốt ngày dài.', 'avt_xit_khu_mui.webp', 'sp_xit_khu_mui.jpg', 'xit_khu_mui.webp', 0),
(91, 'Sữa rửa mặt làm sạch sâu Ponds Pure White 50g', 30, 39000, '50.00', 'Ponds (Mỹ)', 'Indonesia', 'Sữa rửa mặt Ponds rất được ưa chuộng bởi mức giá tốt cùng hiệu quả làm sạch hiệu quả. Sữa rửa mặt làm sạch sâu Ponds Pure White 50g là loại sữa rửa mặt có chứa carbon hoạt tính và vitamin B3 giúp tẩy sạch các hạt bụi bẩn và ô nhiễm trên da, đồng thời giúp làm sáng da.', 'avt_sua_rua_mat.webp', 'sp_sua_rua_mat.webp', 'sua_rua_mat.webp', 0),
(92, 'Mặt nạ giấy trắng da dưa leo Vedette 22ml', 30, 13000, '22.00', 'Vedette (Việt Nam)', 'Việt Nam', 'Mặt nạ Vedette giúp bảo vệ da khỏi tác động của tia UV. Mặt nạ giấy trắng da dưa leo Vedette 22ml kết hợp với dưỡng chất thiên nhiên giúp cấp ẩm chuyên sâu và se khít lỗ chân lông hiệu quả. Mặt nạ chứa nhiều dưỡng chất và Vitamin E giúp nhẹ nhàng lấy đi các lớp tế bào chết trên da.', 'avt_mat_na_dua_leo.webp', 'sp_mat_na_dua_leo.webp', 'mat_na_dua_leo.webp', 0),
(93, 'Mặt nạ mắt tinh chất vitamin và vàng ròng Hani Hani 60 miếng', 30, 365000, '60.00', 'Hani Hani (Hàn Quốc)', 'Hàn Quốc', 'Mặt nạ Hani Hani được sản xuất tại Hàn Quốc. Mặt nạ với công thức cải tiến vượt trội đem lại hiệu quả chăm sóc da tốt hơn với nhiều dòng sản phẩm khác nhau, được chị em ưa chuộng. Mặt nạ mắt tinh chất vitamin và vàng ròng Hani Hani 60 miếng giúp làm giảm nếp nhăn, bọng mắt, quầng thâm.', 'avt_mat_na_tinh_chat.webp', 'sp_mat_na_tin_chat.webp', 'mat_na_tinh_chat.webp', 0),
(94, '1 cuộn túi rác tiện dụng hương lavender Inochi 60x90cm', 32, 28000, '1.00', 'Inochi', 'Việt Nam', 'Túi đựng rác Inochi được sản xuất theo tiêu chuẩn châu Âu, giúp nhà cửa gọn gàng, sạch sẽ mỗi ngày. Túi rác tiện dụng Inochi 60x90cm dẽo dai, co giãn tốt và khó rách, túi đựng rác không mùi không hóa chất an toàn cho sức khoẻ.', 'avt_tui_rac_tien_dung.webp', 'sp_tui_rac_tien_dung.webp', 'tui_rac_tien_dung.webp', 0),
(95, '2 lốc 6 cuộn túi rác đen tự huỷ sinh học Bách Hóa XANH 55x65cm (1kg)', 32, 85000, '1.00', 'Bách Hóa XANH', 'Việt Nam', 'Được sản xuất từ chất liệu nhựa HDPE, giữa các túi đựng rác Bách Hoá XANH có gân sọc dễ dàng xé, tách túi đựng rác mỗi khi muốn sử dụng, dễ dàng nhanh chóng. 2 lốc 6 cuộn túi rác đen tự huỷ sinh học Bách Hóa XANH 55x65cm (1kg) thân thiện với môi trường, an toàn với người dùng.', 'avt_tui_rac_tu_huy.webp', 'sp_tui_rac_tu_huy.webp', 'tui_rac_tu_huy.webp', 0),
(96, '3 cuộn túi rác nhiều màu Khai Tuệ 45x55cm (1kg)', 32, 58000, '1.00', 'Khai Tuệ', 'Việt Nam', 'Được sản xuất từ chất liệu nhựa HDPE, giữa các túi rác Khai Tuệ có gân sọc dễ dàng xé, tách túi rác mỗi khi muốn sử dụng. Lốc 3 cuộn túi rác nhiều màu Khai Tuệ 45x55cm (1kg) có nhiều màu để phân loại, tiện lợi, thân thiện với môi trường, an toàn khi sử dụng.', 'avt_tui_rac_nhieu_mau.webp', 'sp_tui_rac_nhieu_mau.webp', 'tui_rac_nhieu_mau.webp', 0),
(97, 'Bộ 3 khăn lau đa năng microfiber Scotch Brite 30 x 30cm', 33, 44000, '150.00', 'Scotch Brite (Mỹ)', 'Việt Nam', 'Là loại khăn lau đa năng có khả năng thấm hút nước gấp 20 lần so với trọng lượng khăn đến từ thương hiệu khăn lau Scoth-Brite. Lốc 3 khăn lau đa năng microfiber Scotch Brite 30 x 30cm có độ bền cao với màu sắc tươi sáng, giúp người dùng lau chùi nhanh chóng.', 'avt_khan_lau.webp', 'sp_khan_kau.webp', 'khan_lau.webp', 0),
(98, 'Khăn giấy lau bếp Hefei Huicheng 120g', 33, 40000, '120.00', 'Hefei Huicheng (Trung Quốc)', 'Trung Quốc', 'Được làm từ chất liệu Polyester, khăn lau bếp Hefei Huicheng có khả năng chống nhăn, chống bụi bẩn, nấm mốc. Giấy lau bếp đa năng Hefei Huicheng nhiều màu 50 tờ có mặt vải mềm mại, thấm hút tốt, giúp lau bếp nhanh chóng và tẩy vết bẩn khô lẫn ướt hiệu quả mà không để lại vết lau.', 'avt_khan_giay_lau_bep.webp', 'sp_khan_giay_lau_bep.webp', 'khan_giay_lau_bep.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `taikhoan`
--

CREATE TABLE `taikhoan` (
  `ma_tai_khoan` int(11) NOT NULL,
  `ho_ten` text NOT NULL,
  `ten_tai_khoan` text NOT NULL,
  `email` text NOT NULL,
  `sdt` text NOT NULL,
  `dia_chi` text NOT NULL,
  `mat_khau` text NOT NULL,
  `ngay_sinh` date NOT NULL,
  `gioi_tinh` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taikhoan`
--

INSERT INTO `taikhoan` (`ma_tai_khoan`, `ho_ten`, `ten_tai_khoan`, `email`, `sdt`, `dia_chi`, `mat_khau`, `ngay_sinh`, `gioi_tinh`) VALUES
(1, 'Võ Chí Khoa', 'vochikhoa2003', 'vochikhoa2003@gmail.com', '0913568692', ' Nha Trang', '$2y$10$lB/jvoWDhL/8mr1sYuCl6eLEJijSQsN1KdtwF0N6SfFUIl8l.hDj.', '2003-06-12', 'male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD KEY `ma_hoa_don` (`ma_hoa_don`),
  ADD KEY `ma_san_pham` (`ma_san_pham`);

--
-- Indexes for table `giamgia`
--
ALTER TABLE `giamgia`
  ADD PRIMARY KEY (`ma_giam_gia`);

--
-- Indexes for table `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`ma_gio_hang`),
  ADD KEY `ma_san_pham` (`ma_san_pham`);

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`ma_hoa_don`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`ma_loai_san_pham`),
  ADD KEY `ma_mat_hang` (`ma_mat_hang`);

--
-- Indexes for table `mathang`
--
ALTER TABLE `mathang`
  ADD PRIMARY KEY (`ma_mat_hang`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma_san_pham`),
  ADD KEY `ma_loai_san_pham` (`ma_loai_san_pham`);

--
-- Indexes for table `taikhoan`
--
ALTER TABLE `taikhoan`
  ADD PRIMARY KEY (`ma_tai_khoan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `giamgia`
--
ALTER TABLE `giamgia`
  MODIFY `ma_giam_gia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `giohang`
--
ALTER TABLE `giohang`
  MODIFY `ma_gio_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `ma_hoa_don` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `taikhoan`
--
ALTER TABLE `loaisanpham`
  MODIFY `ma_loai_san_pham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

ALTER TABLE `mathang`
  MODIFY `ma_mat_hang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `sanpham`
  MODIFY `ma_san_pham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

ALTER TABLE `taikhoan`
  MODIFY `ma_tai_khoan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`ma_hoa_don`) REFERENCES `hoadon` (`ma_hoa_don`),
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`);

--
-- Constraints for table `giohang`
--
ALTER TABLE `giohang`
  ADD CONSTRAINT `giohang_ibfk_1` FOREIGN KEY (`ma_san_pham`) REFERENCES `sanpham` (`ma_san_pham`);

--
-- Constraints for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD CONSTRAINT `loaisanpham_ibfk_1` FOREIGN KEY (`ma_mat_hang`) REFERENCES `mathang` (`ma_mat_hang`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`ma_loai_san_pham`) REFERENCES `loaisanpham` (`ma_loai_san_pham`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

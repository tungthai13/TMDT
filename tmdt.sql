-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2018 at 06:18 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.1.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tmdt`
--
CREATE DATABASE IF NOT EXISTS `tmdt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tmdt`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `capNhatSanPham`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `capNhatSanPham` (IN `maSanPham` INT, IN `tenSanPham` VARCHAR(256) CHARSET utf8, IN `donGia` INT, IN `tenNhomSanPham` VARCHAR(256), IN `trangThaiSanPham` INT, IN `anhMinhHoa` VARCHAR(256) CHARSET utf8)  NO SQL
BEGIN
	UPDATE san_pham SET san_pham.ten_san_pham = tenSanPham, san_pham.don_gia = donGia, san_pham.ten_nhom_san_pham = tenNhomSanPham, san_pham.trang_thai_san_pham = trangThaiSanPham, anh_minh_hoa = anhMinhHoa;
END$$

DROP PROCEDURE IF EXISTS `chiTietSanPham`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `chiTietSanPham` (IN `maSanPham` INT)  NO SQL
BEGIN
	SELECT * FROM san_pham WHERE san_pham.ma_san_pham = maSanPham;
END$$

DROP PROCEDURE IF EXISTS `danhSachCuaHangCaNhan`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `danhSachCuaHangCaNhan` (IN `maNguoiQuanLy` INT)  NO SQL
BEGIN
	SELECT * FROM cua_hang WHERE cua_hang.ma_nguoi_quan_ly = maNguoiQuanLy;
END$$

DROP PROCEDURE IF EXISTS `danhSachSanPham`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `danhSachSanPham` (IN `maCuaHang` INT)  NO SQL
BEGIN
	SELECT * FROM san_pham WHERE san_pham.ma_cua_hang = maCuaHang;
END$$

DROP PROCEDURE IF EXISTS `tatCaCuaHang`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `tatCaCuaHang` ()  BEGIN
   SELECT *  FROM cua_hang;
END$$

DROP PROCEDURE IF EXISTS `themSanPham`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `themSanPham` (IN `maCuaHang` INT, IN `tenSanPham` VARCHAR(256) CHARSET utf8, IN `donGia` INT, IN `soLanDat` INT, IN `tenNhomSanPham` VARCHAR(256) CHARSET utf8, IN `trangThaiSanPham` INT, IN `anhMinhHoa` VARCHAR(256) CHARSET utf8)  NO SQL
BEGIN
	INSERT INTO san_pham (san_pham.ma_cua_hang, san_pham.ten_san_pham, san_pham.don_gia, san_pham.so_lan_dat, san_pham.ten_nhom_san_pham, san_pham.trang_thai_san_pham, san_pham.anh_minh_hoa) values (maCuaHang, tenSanPham, donGia, soLanDat, tenNhomSanPham, trangThaiSanPham, anhMinhHoa);
END$$

DROP PROCEDURE IF EXISTS `timCuaHangBangMaCuaHang`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `timCuaHangBangMaCuaHang` (IN `id` INT)  NO SQL
BEGIN
	SELECT * FROM cua_hang WHERE cua_hang.ma_cua_hang = id;
END$$

DROP PROCEDURE IF EXISTS `xoaSanPham`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `xoaSanPham` (IN `maSanPham` INT)  NO SQL
BEGIN
	DELETE FROM san_pham WHERE san_pham.ma_san_pham = maSanPham;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

DROP TABLE IF EXISTS `chi_tiet_don_hang`;
CREATE TABLE IF NOT EXISTS `chi_tiet_don_hang` (
  `ma_don_hang` int(11) NOT NULL,
  `ma_san_pham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  PRIMARY KEY (`ma_don_hang`,`ma_san_pham`),
  KEY `FKchi_tiet_d647335` (`ma_san_pham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hang`
--

DROP TABLE IF EXISTS `chi_tiet_gio_hang`;
CREATE TABLE IF NOT EXISTS `chi_tiet_gio_hang` (
  `ma_gio_hang` int(11) NOT NULL,
  `ma_cua_hang` int(11) NOT NULL,
  `ma_san_pham` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  PRIMARY KEY (`ma_gio_hang`,`ma_cua_hang`,`ma_san_pham`),
  KEY `FKchi_tiet_g185789` (`ma_cua_hang`),
  KEY `FKchi_tiet_g609333` (`ma_san_pham`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cua_hang`
--

DROP TABLE IF EXISTS `cua_hang`;
CREATE TABLE IF NOT EXISTS `cua_hang` (
  `ma_cua_hang` int(11) NOT NULL AUTO_INCREMENT,
  `ten_cua_hang` varchar(256) NOT NULL,
  `dia_chi` varchar(256) NOT NULL,
  `ma_quan_huyen` int(11) NOT NULL,
  `mo_ta` varchar(256) DEFAULT NULL,
  `logo` varchar(256) NOT NULL,
  `ma_nguoi_quan_ly` int(11) NOT NULL,
  `gio_mo_cua` varchar(10) NOT NULL,
  `gio_dong_cua` varchar(10) NOT NULL,
  `so_dien_thoai` int(11) NOT NULL,
  `trang_thai_cua_hang` int(11) NOT NULL,
  `lat` double DEFAULT NULL,
  `lng` double DEFAULT NULL,
  `tong_diem` int(11) NOT NULL DEFAULT '10',
  `so_luot_cham` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ma_cua_hang`),
  KEY `FKcua_hang268799` (`ma_quan_huyen`),
  KEY `FKcua_hang380667` (`ma_nguoi_quan_ly`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cua_hang`
--

INSERT INTO `cua_hang` (`ma_cua_hang`, `ten_cua_hang`, `dia_chi`, `ma_quan_huyen`, `mo_ta`, `logo`, `ma_nguoi_quan_ly`, `gio_mo_cua`, `gio_dong_cua`, `so_dien_thoai`, `trang_thai_cua_hang`, `lat`, `lng`, `tong_diem`, `so_luot_cham`) VALUES
(1, 'Sumo BBQ Big C', '222 Trần Duy Hưng, Trung Hoà, Cầu Giấy, Hà Nội', 1, NULL, 'logo-default.jpg', 1, '9:00', '22:00', 912345678, 2, 21.007341, 105.793425, 10, 1),
(2, 'Popeyes Giảng Võ', 'D2 Giảng Võ, Khu tập thể Giảng Võ, Ba Đình, Hà Nội', 5, NULL, 'logo-default.jpg\r\n', 1, '9:00', '22:00', 123456789, 2, 21.026296, 105.822245, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cua_hang_loai_cua_hang`
--

DROP TABLE IF EXISTS `cua_hang_loai_cua_hang`;
CREATE TABLE IF NOT EXISTS `cua_hang_loai_cua_hang` (
  `ma_cua_hang` int(11) NOT NULL,
  `ma_loai_cua_hang` int(11) NOT NULL,
  PRIMARY KEY (`ma_cua_hang`,`ma_loai_cua_hang`),
  KEY `FKcua_hang_l51468` (`ma_loai_cua_hang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dia_chi_khach_hang`
--

DROP TABLE IF EXISTS `dia_chi_khach_hang`;
CREATE TABLE IF NOT EXISTS `dia_chi_khach_hang` (
  `ma_khach_hang` int(11) NOT NULL,
  `dia_chi` int(11) NOT NULL,
  PRIMARY KEY (`ma_khach_hang`,`dia_chi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `diem_cham_cua_hang`
--

DROP TABLE IF EXISTS `diem_cham_cua_hang`;
CREATE TABLE IF NOT EXISTS `diem_cham_cua_hang` (
  `ma_khach_hang` int(11) NOT NULL,
  `ma_cua_hang` int(11) NOT NULL,
  `diem_cham` int(11) NOT NULL,
  PRIMARY KEY (`ma_khach_hang`,`ma_cua_hang`),
  KEY `FKdiem_cham_711933` (`ma_cua_hang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

DROP TABLE IF EXISTS `don_hang`;
CREATE TABLE IF NOT EXISTS `don_hang` (
  `ma_don_hang` int(11) NOT NULL AUTO_INCREMENT,
  `ma_cua_hang` int(11) NOT NULL,
  `ma_khach_hang` int(11) NOT NULL,
  `so_dien_thoai` varchar(11) NOT NULL,
  `dia_chi` varchar(256) NOT NULL,
  `ngay_tao_don_hang` varchar(10) NOT NULL,
  `ngay_giao_hang` varchar(10) NOT NULL,
  `gio_giao_hang` varchar(10) NOT NULL,
  `tong_chi_phi_van_chuyen` int(11) NOT NULL,
  `tong_tien_thanh_toan` int(11) NOT NULL,
  `ma_phuong_thuc_thanh_toan` int(11) NOT NULL,
  `trang_thai_don_hang` varchar(256) NOT NULL,
  `ghi_chu` varchar(256) DEFAULT NULL,
  `ma_van_chuyen` int(11) NOT NULL,
  PRIMARY KEY (`ma_don_hang`),
  KEY `FKdon_hang729837` (`ma_khach_hang`),
  KEY `FKdon_hang631726` (`ma_cua_hang`),
  KEY `FKdon_hang587609` (`ma_phuong_thuc_thanh_toan`),
  KEY `FKdon_hang700206` (`ma_van_chuyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

DROP TABLE IF EXISTS `gio_hang`;
CREATE TABLE IF NOT EXISTS `gio_hang` (
  `ma_gio_hang` int(11) NOT NULL AUTO_INCREMENT,
  `ma_khach_hang` int(11) NOT NULL,
  PRIMARY KEY (`ma_gio_hang`),
  KEY `FKgio_hang767839` (`ma_khach_hang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `khach_hang`
--

DROP TABLE IF EXISTS `khach_hang`;
CREATE TABLE IF NOT EXISTS `khach_hang` (
  `ma_khach_hang` int(11) NOT NULL AUTO_INCREMENT,
  `ten_khach_hang` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `so_dien_thoai` varchar(100) NOT NULL,
  `mat_khau` varchar(256) NOT NULL,
  PRIMARY KEY (`ma_khach_hang`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `khach_hang`
--

INSERT INTO `khach_hang` (`ma_khach_hang`, `ten_khach_hang`, `email`, `so_dien_thoai`, `mat_khau`) VALUES
(1, 'foodapp', 'foodapp@foodapp.com', '0988192713', '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `loai_cua_hang`
--

DROP TABLE IF EXISTS `loai_cua_hang`;
CREATE TABLE IF NOT EXISTS `loai_cua_hang` (
  `ma_loai_cua_hang` int(11) NOT NULL AUTO_INCREMENT,
  `ten_loai_cua_hang` varchar(256) NOT NULL,
  PRIMARY KEY (`ma_loai_cua_hang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phuong_thuc_thanh_toan`
--

DROP TABLE IF EXISTS `phuong_thuc_thanh_toan`;
CREATE TABLE IF NOT EXISTS `phuong_thuc_thanh_toan` (
  `ma_phuong_thuc` int(11) NOT NULL AUTO_INCREMENT,
  `ten_phuong_thuc` varchar(256) NOT NULL,
  PRIMARY KEY (`ma_phuong_thuc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `quan_huyen`
--

DROP TABLE IF EXISTS `quan_huyen`;
CREATE TABLE IF NOT EXISTS `quan_huyen` (
  `ma_quan_huyen` int(11) NOT NULL AUTO_INCREMENT,
  `ten_quan_huyen` varchar(256) NOT NULL,
  `ma_tinh_thanh` int(11) NOT NULL,
  PRIMARY KEY (`ma_quan_huyen`),
  KEY `FKquan_huyen271908` (`ma_tinh_thanh`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quan_huyen`
--

INSERT INTO `quan_huyen` (`ma_quan_huyen`, `ten_quan_huyen`, `ma_tinh_thanh`) VALUES
(1, 'Quận Hà Đông', 1),
(2, 'Quận Thanh Xuân', 1),
(3, 'Quận Đống Đa', 1),
(4, 'Quận Hai Bà Trưng', 1),
(5, 'Quận Ba Đình', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quan_tri_vien`
--

DROP TABLE IF EXISTS `quan_tri_vien`;
CREATE TABLE IF NOT EXISTS `quan_tri_vien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ten_tai_khoan` varchar(256) NOT NULL,
  `mat_khau` varchar(256) NOT NULL,
  `quyen` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

DROP TABLE IF EXISTS `san_pham`;
CREATE TABLE IF NOT EXISTS `san_pham` (
  `ma_san_pham` int(11) NOT NULL AUTO_INCREMENT,
  `ten_san_pham` varchar(256) NOT NULL,
  `don_gia` int(11) NOT NULL,
  `so_lan_dat` int(11) NOT NULL,
  `ten_nhom_san_pham` varchar(256) NOT NULL,
  `mo_ta` varchar(256) DEFAULT NULL,
  `anh_minh_hoa` varchar(256) NOT NULL,
  `ma_cua_hang` int(11) NOT NULL,
  `trang_thai_san_pham` int(11) NOT NULL,
  PRIMARY KEY (`ma_san_pham`),
  KEY `FKsan_pham78820` (`ma_cua_hang`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`ma_san_pham`, `ten_san_pham`, `don_gia`, `so_lan_dat`, `ten_nhom_san_pham`, `mo_ta`, `anh_minh_hoa`, `ma_cua_hang`, `trang_thai_san_pham`) VALUES
(1, 'Thịt gà', 11000, 0, 'Món chính', NULL, 'anhMinhHoa11.jpg', 2, 1),
(2, 'Thịt gà', 11000, 0, 'Món chính', NULL, 'anhMinhHoa11.jpg', 2, 1),
(3, 'Thịt gà', 11000, 0, 'Món chính', NULL, 'anhMinhHoa11.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `the_thanh_toan`
--

DROP TABLE IF EXISTS `the_thanh_toan`;
CREATE TABLE IF NOT EXISTS `the_thanh_toan` (
  `ngay_het_han` int(11) NOT NULL,
  `ma_so_bi_mat` int(11) NOT NULL,
  `ma_so_the` int(11) NOT NULL AUTO_INCREMENT,
  `ma_khach_hang` int(11) NOT NULL,
  PRIMARY KEY (`ma_so_the`),
  KEY `FKthe_thanh_290284` (`ma_khach_hang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `thong_tin_thanh_toan`
--

DROP TABLE IF EXISTS `thong_tin_thanh_toan`;
CREATE TABLE IF NOT EXISTS `thong_tin_thanh_toan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ma_don_hang` int(11) NOT NULL,
  `thoi_gian_giao_dich` datetime NOT NULL,
  `ma_phuong_thuc_thanh_toan` int(11) NOT NULL,
  `ma_trang_thai` int(11) NOT NULL,
  `ma_so_the` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKthong_tin_354007` (`ma_trang_thai`),
  KEY `FKthong_tin_4351` (`ma_phuong_thuc_thanh_toan`),
  KEY `FKthong_tin_912715` (`ma_don_hang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tinh_thanh`
--

DROP TABLE IF EXISTS `tinh_thanh`;
CREATE TABLE IF NOT EXISTS `tinh_thanh` (
  `ma_tinh_thanh` int(11) NOT NULL AUTO_INCREMENT,
  `ten_tinh_thanh` varchar(256) NOT NULL,
  PRIMARY KEY (`ma_tinh_thanh`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tinh_thanh`
--

INSERT INTO `tinh_thanh` (`ma_tinh_thanh`, `ten_tinh_thanh`) VALUES
(1, 'Hà Nội');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_thanh_toan`
--

DROP TABLE IF EXISTS `trang_thai_thanh_toan`;
CREATE TABLE IF NOT EXISTS `trang_thai_thanh_toan` (
  `ma_trang_thai` int(11) NOT NULL AUTO_INCREMENT,
  `mo_ta_trang_thai` varchar(256) NOT NULL,
  PRIMARY KEY (`ma_trang_thai`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `van_chuyen`
--

DROP TABLE IF EXISTS `van_chuyen`;
CREATE TABLE IF NOT EXISTS `van_chuyen` (
  `ma_van_chuyen` int(11) NOT NULL AUTO_INCREMENT,
  `loai_van_chuyen` varchar(256) NOT NULL,
  `phi_van_chuyen` int(11) NOT NULL,
  `mo_ta` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`ma_van_chuyen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `FKchi_tiet_d647335` FOREIGN KEY (`ma_san_pham`) REFERENCES `san_pham` (`ma_san_pham`),
  ADD CONSTRAINT `FKchi_tiet_d982974` FOREIGN KEY (`ma_don_hang`) REFERENCES `don_hang` (`ma_don_hang`);

--
-- Constraints for table `chi_tiet_gio_hang`
--
ALTER TABLE `chi_tiet_gio_hang`
  ADD CONSTRAINT `FKchi_tiet_g134983` FOREIGN KEY (`ma_gio_hang`) REFERENCES `gio_hang` (`ma_gio_hang`),
  ADD CONSTRAINT `FKchi_tiet_g185789` FOREIGN KEY (`ma_cua_hang`) REFERENCES `cua_hang` (`ma_cua_hang`),
  ADD CONSTRAINT `FKchi_tiet_g609333` FOREIGN KEY (`ma_san_pham`) REFERENCES `san_pham` (`ma_san_pham`);

--
-- Constraints for table `cua_hang`
--
ALTER TABLE `cua_hang`
  ADD CONSTRAINT `FKcua_hang268799` FOREIGN KEY (`ma_quan_huyen`) REFERENCES `quan_huyen` (`ma_quan_huyen`),
  ADD CONSTRAINT `FKcua_hang380667` FOREIGN KEY (`ma_nguoi_quan_ly`) REFERENCES `khach_hang` (`ma_khach_hang`);

--
-- Constraints for table `cua_hang_loai_cua_hang`
--
ALTER TABLE `cua_hang_loai_cua_hang`
  ADD CONSTRAINT `FKcua_hang_l370151` FOREIGN KEY (`ma_cua_hang`) REFERENCES `cua_hang` (`ma_cua_hang`),
  ADD CONSTRAINT `FKcua_hang_l51468` FOREIGN KEY (`ma_loai_cua_hang`) REFERENCES `loai_cua_hang` (`ma_loai_cua_hang`);

--
-- Constraints for table `dia_chi_khach_hang`
--
ALTER TABLE `dia_chi_khach_hang`
  ADD CONSTRAINT `FKdia_chi_kh764151` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`);

--
-- Constraints for table `diem_cham_cua_hang`
--
ALTER TABLE `diem_cham_cua_hang`
  ADD CONSTRAINT `FKdiem_cham_613822` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`),
  ADD CONSTRAINT `FKdiem_cham_711933` FOREIGN KEY (`ma_cua_hang`) REFERENCES `cua_hang` (`ma_cua_hang`);

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `FKdon_hang587609` FOREIGN KEY (`ma_phuong_thuc_thanh_toan`) REFERENCES `phuong_thuc_thanh_toan` (`ma_phuong_thuc`),
  ADD CONSTRAINT `FKdon_hang631726` FOREIGN KEY (`ma_cua_hang`) REFERENCES `cua_hang` (`ma_cua_hang`),
  ADD CONSTRAINT `FKdon_hang700206` FOREIGN KEY (`ma_van_chuyen`) REFERENCES `van_chuyen` (`ma_van_chuyen`),
  ADD CONSTRAINT `FKdon_hang729837` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`);

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `FKgio_hang767839` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`);

--
-- Constraints for table `quan_huyen`
--
ALTER TABLE `quan_huyen`
  ADD CONSTRAINT `FKquan_huyen271908` FOREIGN KEY (`ma_tinh_thanh`) REFERENCES `tinh_thanh` (`ma_tinh_thanh`);

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `FKsan_pham78820` FOREIGN KEY (`ma_cua_hang`) REFERENCES `cua_hang` (`ma_cua_hang`);

--
-- Constraints for table `the_thanh_toan`
--
ALTER TABLE `the_thanh_toan`
  ADD CONSTRAINT `FKthe_thanh_290284` FOREIGN KEY (`ma_khach_hang`) REFERENCES `khach_hang` (`ma_khach_hang`);

--
-- Constraints for table `thong_tin_thanh_toan`
--
ALTER TABLE `thong_tin_thanh_toan`
  ADD CONSTRAINT `FKthong_tin_354007` FOREIGN KEY (`ma_trang_thai`) REFERENCES `trang_thai_thanh_toan` (`ma_trang_thai`),
  ADD CONSTRAINT `FKthong_tin_4351` FOREIGN KEY (`ma_phuong_thuc_thanh_toan`) REFERENCES `phuong_thuc_thanh_toan` (`ma_phuong_thuc`),
  ADD CONSTRAINT `FKthong_tin_912715` FOREIGN KEY (`ma_don_hang`) REFERENCES `don_hang` (`ma_don_hang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

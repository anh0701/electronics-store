-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2024 at 12:00 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thuctaptotnghiep`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baiviet`
--

CREATE TABLE `tbl_baiviet` (
  `MaBaiViet` int NOT NULL,
  `TenBaiViet` varchar(50) NOT NULL,
  `SlugBaiViet` varchar(50) NOT NULL,
  `TrangThai` int NOT NULL,
  `MaDanhMucBV` int NOT NULL,
  `NoiDung` text NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_baocaodoanhthu`
--

CREATE TABLE `tbl_baocaodoanhthu` (
  `MaBCDT` int NOT NULL,
  `MaLienKet` varchar(50) NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `NgayTao` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_binhluan`
--

CREATE TABLE `tbl_binhluan` (
  `MaBinhLuan` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `MaSanPham` int NOT NULL,
  `NoiDung` text NOT NULL,
  `TrangThai` int NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietbaocaodoanhthu`
--

CREATE TABLE `tbl_chitietbaocaodoanhthu` (
  `MaCTBCDT` int NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuongNhap` int NOT NULL,
  `SoLuongBan` int NOT NULL,
  `GiaNhap` varchar(50) NOT NULL,
  `GiaBan` varchar(50) NOT NULL,
  `MaLienKet` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietdonhang`
--

CREATE TABLE `tbl_chitietdonhang` (
  `MaCTDH` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuong` int NOT NULL,
  `GiaSanPham` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitiethoadon`
--

CREATE TABLE `tbl_chitiethoadon` (
  `MaCTHD` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuong` int NOT NULL,
  `GiaSanPham` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietlichsubaohanh`
--

CREATE TABLE `tbl_chitietlichsubaohanh` (
  `MaCTLSBH` int NOT NULL,
  `MaLienKet` int NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuong` int NOT NULL,
  `TinhTrang` varchar(50) NOT NULL,
  `ThoiGianTra` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieubaohanh`
--

CREATE TABLE `tbl_chitietphieubaohanh` (
  `MaCTPBH` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuong` int NOT NULL,
  `GiaSanPham` int NOT NULL,
  `ThoiGianBaoHanh` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieukiemkho`
--

CREATE TABLE `tbl_chitietphieukiemkho` (
  `MaCTPKK` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuong` varchar(50) NOT NULL,
  `TinhTrang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieunhap`
--

CREATE TABLE `tbl_chitietphieunhap` (
  `MaCTPN` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuong` int NOT NULL,
  `GiaSanPham` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieutrahang`
--

CREATE TABLE `tbl_chitietphieutrahang` (
  `MaCTPTH` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuong` int NOT NULL,
  `GiaSanPham` varchar(50) NOT NULL,
  `LyDoTraHang` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chitietphieuxuat`
--

CREATE TABLE `tbl_chitietphieuxuat` (
  `MaCTPX` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `MaSanPham` int NOT NULL,
  `SoLuong` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chuongtrinhgiamgia`
--

CREATE TABLE `tbl_chuongtrinhgiamgia` (
  `MaCTGG` int NOT NULL,
  `SlugCTGG` int NOT NULL,
  `TenCTGG` varchar(255) NOT NULL,
  `HinhAnh` varchar(255) NOT NULL,
  `MoTa` text NOT NULL,
  `TrangThai` int NOT NULL,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chuongtrinhgiamgiasp`
--

CREATE TABLE `tbl_chuongtrinhgiamgiasp` (
  `MaCTGGSP` int NOT NULL,
  `MaSanPham` int NOT NULL,
  `MaCTGG` int NOT NULL,
  `PhamTramGiam` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhgia`
--

CREATE TABLE `tbl_danhgia` (
  `MaDanhGia` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `MaSanPham` int NOT NULL,
  `NoiDung` text NOT NULL,
  `SoSao` int NOT NULL,
  `TrangThai` int NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NOT NULL,
  `MaDonHang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmuc`
--

CREATE TABLE `tbl_danhmuc` (
  `MaDanhMuc` int NOT NULL,
  `TenDanhMuc` varchar(50) NOT NULL,
  `SlugDanhMuc` varchar(50) NOT NULL,
  `MoTa` text NOT NULL,
  `TrangThai` int NOT NULL,
  `DanhMucCha` int DEFAULT NULL,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_danhmuc`
--

INSERT INTO `tbl_danhmuc` (`MaDanhMuc`, `TenDanhMuc`, `SlugDanhMuc`, `MoTa`, `TrangThai`, `DanhMucCha`, `ThoiGianTao`, `ThoiGianSua`) VALUES
(1, 'Tivi', 'tivi', 'Tivi hay còn được gọi với nhiều tên khác như TV, vô tuyến truyền hình (truyền hình không dây), máy thu hình, máy phát hình, hay vô tuyến... là hệ thống điện tử viễn thông có khả năng thu nhận tín hiệu sóng và tín hiệu vô tuyến/hữu tuyến để chuyển thành hình ảnh và âm thanh (truyền thanh truyền hình) truyền tải đến người xem.', 1, 0, '2024-04-01 13:23:09', NULL),
(2, 'Laptop', 'laptop', 'Laptop hay còn gọi là máy tính xách tay là một chiếc máy tính cá nhân giúp dễ dàng mang đi và làm việc ở những địa điểm và địa hình khác nhau. Những chiếc máy tính xách tay đã được thiết kế đầy đủ chức năng giống như một máy tính để bàn, có nghĩa là chúng cũng có thể chạy những phần mềm tương tự và mở những tập tin cùng loại như chiếc máy tính để bàn.Tuy nhiên, một số loại máy tính xách tay như Netbook, lại bỏ đi một số chức năng để có thể cầm tay nhiều hơn.', 1, 0, '2024-04-01 13:24:06', NULL),
(3, 'Máy giặt', 'may-giat', 'Máy giặt (tiếng Anh: washing machine, laundry machine, clothes washer, washer) là một thiết bị gia đình được sử dụng để giặt đồ giặt. Thuật ngữ này chủ yếu được áp dụng cho các máy sử dụng nước thay vì giặt khô (sử dụng chất lỏng làm sạch thay thế và được thực hiện bởi các doanh nghiệp chuyên nghiệp) hoặc chất tẩy rửa siêu âm. Người dùng thêm hóa chất giặt tẩy, có thể ở dạng lỏng hoặc bột, vào ngăn đựng nước giặt của máy.', 1, 0, '2024-04-01 13:25:15', NULL),
(4, 'Camera', 'camera', 'Camare', 1, 0, '2024-04-02 14:08:27', NULL),
(5, 'Camera trong nhà', 'Camera-trong-nha', 'Camera ngoài trời là thiết bị ghi hình an ninh chống trộm hiện đại, tích hợp nhiều công nghệ nhất hiện nay như sử dụng công nghệ kín, giúp sản phẩm hoạt động bền bỉ, ổn định dưới tác động xấu của thời tiết, khói bụi, độ ẩm.', 1, 4, '2024-04-01 13:51:20', '2024-04-04 15:29:42'),
(6, 'Camera ngoài trời', 'Camera-ngoai-troi', 'Camera trong nhà (indoor): là loại camera chỉ được lắp đặt ở trong nhà những nơi có mái che để thuận lợi nhất cho việc quan sát của thiết bị này. Camera trong nhà thường là loại camera có hình bán cầu, hình cầu được lắp đặt trên tường hoặc trần nhà nơi có những góc quan sát rộng thuận tiện cho việc quan sát.', 1, 4, '2024-04-01 13:51:20', '2024-04-05 08:10:06'),
(7, 'Phụ kiện điện thoại', 'phu-kien-dien-thoai', 'Phụ kiện điện thoại', 1, 0, '2024-04-01 14:14:28', '2024-04-01 14:25:51'),
(8, 'Điện thoại', 'dien-thoai', 'Điện thoại', 1, 0, '2024-04-01 14:14:56', NULL),
(9, 'HeadPhones', 'headphones', 'HeadPhone còn gọi là tai nghe to vì không biết tiếng Anh nên đặt tạm', 1, 7, '2024-04-01 14:27:40', '2024-04-01 14:37:44'),
(10, 'Sạc dự phòng', 'sac-du-phong', 'Pin sạc dự phòng là phụ kiện dành cho các thiết bị công nghệ sử dụng pin như điện thoại, máy tính bảng, đồng hồ thông minh, loa Bluetooth, … Nó có khả năng lưu trữ điện năng để cung cấp cho các thiết bị ở bất kỳ nơi đâu mà không cần có nguồn điện trực tiếp.', 1, 7, '2024-04-01 14:28:19', '2024-04-04 15:30:59'),
(12, 'Ốp lưng điện thoại', 'op-lung-dien-thoai', 'Ốp lưng', 1, 7, '2024-04-01 14:36:57', NULL),
(13, 'Giá đỡ điện thoại', 'gia-do-dien-thoai', 'Cáp điện thoại', 1, 7, '2024-04-01 14:39:27', '2024-04-05 09:01:02'),
(15, 'Tủ lạnh', 'tu-lanh', 'Tủ lạnh là một thiết bị làm mát. Thiết bị gia dụng này bao gồm một ngăn cách nhiệt và nhiệt một máy bơm hóa chất phương tiện cơ khí phương tiện để truyền nhiệt từ nó ra môi trường bên ngoài, làm mát bên trong đến một nhiệt độ thấp hơn môi trường xung quanh.', 1, 0, '2024-04-04 14:49:10', NULL),
(16, 'Cáp sạc điện thoại', 'cap-sac-dien-thoai', 'Cáp sạc điện thoại', 1, 7, '2024-04-05 08:59:13', NULL),
(17, 'Máy lạnh', 'may-lanh', 'Máy lạnh', 1, 0, '2024-04-05 09:17:11', NULL),
(18, 'Loa', 'loa', 'Loa', 1, 0, '2024-04-05 09:18:12', NULL),
(19, 'Máy sấy', 'may-say', 'Mấy sấy', 1, 0, '2024-04-05 09:18:57', NULL),
(20, 'Máy xay', 'may-xay', 'Máy xay', 0, 0, '2024-04-05 09:19:33', NULL),
(21, 'Tai nghe điện thoại', 'tai-nghe-dien-thoai', 'tai nghe điện thoại', 1, 7, '2024-04-08 02:20:59', NULL),
(22, 'Máy rửa bát', 'may-rua-bat', 'Cấu tạo của máy rửa bát (cơ bản)\r\nHệ thống điều khiển: Đặt ngoài cánh cửa ngay phần phía điều khiển dùng để điều khiển chu trình hoạt động, thời gian. Đồng thời, bộ phận này còn đảm nhận chức năng phun nước, xả nước tẩy ở mỗi quy trình làm việc.\r\nPhần van nạp: Có nhiệm vụ dẫn nước trực tiếp vào bên trong máy máy bằng cách mở van nạp, lúc này van nạp sẽ sinh ra áp lực và đẩy nước vào bên trong thân máy.\r\nPhần bơm: Có chức năng bơm nước vào bên trong thân máy, đẩy nước vào phần hệ thống tay phun với các chu trình bơm, xả, trực tiếp từ ống thoát nước.\r\nTrên thị trường hiện nay gồm các loại máy rửa như sau: Máy rửa chén độc lập, máy rửa chén để bàn, máy rửa chén âm tủ, máy rửa chén mini, máy rửa chén có sấy,…', 1, 0, '2024-04-28 06:02:08', '2024-04-28 06:08:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmucbaiviet`
--

CREATE TABLE `tbl_danhmucbaiviet` (
  `MaDanhMucBV` int NOT NULL,
  `TenDanhMucBV` varchar(50) NOT NULL,
  `SlugDanhMucBV` varchar(50) NOT NULL,
  `TrangThai` int NOT NULL,
  `MoTa` text NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_danhmuctskt`
--

CREATE TABLE `tbl_danhmuctskt` (
  `MaDMTSKT` int NOT NULL,
  `TenDMTSKT` varchar(50) NOT NULL,
  `SlugDMTSKT` varchar(50) NOT NULL,
  `TrangThai` int NOT NULL,
  `MoTa` text NOT NULL,
  `MaDanhMuc` int NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_danhmuctskt`
--

INSERT INTO `tbl_danhmuctskt` (`MaDMTSKT`, `TenDMTSKT`, `SlugDMTSKT`, `TrangThai`, `MoTa`, `MaDanhMuc`, `ThoiGianTao`, `ThoiGianSua`) VALUES
(1, 'RAM', 'ram', 1, 'RAM được viết tắt từ Random Access Memory - một trong những yếu tố hết sức quan trọng bên cạnh vi xử lý. RAM là bộ nhớ tạm của máy giúp lưu trữ thông tin hiện hành để CPU có thể truy xuất và xử lý.\r\n\r\nRAM không thể lưu trữ được dữ liệu khi mất nguồn điện cung cấp. Nếu như thiết bị bị mất nguồn, tắt máy thì dữ liệu trên RAM sẽ bị xóa.', 2, '2024-05-06 00:53:12', '2024-05-06 00:49:34'),
(2, 'CPU', 'cpu', 1, 'CPU viết tắt của chữ Central Processing Unit, tạm dịch là bộ xử lý trung tâm, là các mạch điện tử trong một máy tính, thực hiện các câu lệnh của chương trình máy tính bằng cách thực hiện các phép tính số học, logic, so sánh và các hoạt động nhập/xuất dữ liệu cơ bản do mã lệnh chỉ ra.', 2, '2024-05-06 00:55:49', NULL),
(3, 'Card màn hình', 'card-man-hinh', 1, 'Kích cỡ màn hình', 2, '2024-05-06 13:51:18', NULL),
(4, 'Độ phân giải', 'do-phan-giai', 1, 'Độ phân giải', 2, '2024-05-06 00:57:54', NULL),
(5, 'Ổ cứng', 'o-cung', 1, 'Ổ cứng', 2, '2024-05-06 00:58:19', NULL),
(6, 'Độ phân giải', 'do-phan-giai', 1, 'Độ phân giải của tivi', 1, '2024-05-06 00:59:07', NULL),
(7, 'Kích cỡ màn hình', 'kich-cu-man-hinh', 1, 'Kích cỡ màn hình của tivi', 1, '2024-05-06 13:08:53', NULL),
(8, 'Hệ điều hành', 'he-dieu-hanh', 1, 'Hệ điều hành của tivi', 1, '2024-05-06 01:00:14', NULL),
(9, 'Dung tích', 'dung-tich', 1, 'Dung tích của tủ lạnh', 15, '2024-05-06 01:01:13', NULL),
(10, 'Số cánh cửa', 'so-canh-cua', 1, 'Số cánh cửa của tủ lạnh', 15, '2024-05-06 01:01:43', NULL),
(11, 'Kiểu tủ', 'kieu-tu', 1, 'Kiểu tủ lạnh', 15, '2024-05-06 01:02:35', NULL),
(12, 'Chất lượng cửa', 'chat-luong-cua', 1, 'Chất lượng cửa tủ lạnh', 15, '2024-05-06 01:04:19', NULL),
(13, 'Độ dài cáp sạc', 'do-dai-cap-sac', 1, 'Độ dài của cáp sạc điện thoại', 16, '2024-05-06 07:55:45', NULL),
(14, 'Dung lượng pin', 'dung-luong-pin', 1, 'Dung lượng pin của sạc dự phòng', 10, '2024-05-06 07:56:54', NULL),
(15, 'Công xuất sạc', 'cong-xuat-sac', 1, 'Công xuất sạc của điện thoại', 10, '2024-05-06 07:57:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_donhang`
--

CREATE TABLE `tbl_donhang` (
  `MaDonHang` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `MaGiaoHang` int NOT NULL,
  `MaGiamGia` int DEFAULT NULL,
  `order_code` varchar(50) NOT NULL,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_giaohang`
--

CREATE TABLE `tbl_giaohang` (
  `MaGiaoHang` int NOT NULL,
  `TenNguoiNhan` varchar(50) NOT NULL,
  `TienGiaoHang` varchar(50) NOT NULL,
  `DiaChi` varchar(255) NOT NULL,
  `SoDienThoai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hoadon`
--

CREATE TABLE `tbl_hoadon` (
  `MaHoaDon` int NOT NULL,
  `MaDonHang` int NOT NULL,
  `TenKhachHang` varchar(50) NOT NULL,
  `ThongTinThanhToan` varchar(255) DEFAULT NULL,
  `order_code` varchar(50) NOT NULL,
  `MaGiamGia` int DEFAULT NULL,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lichsubaohanh`
--

CREATE TABLE `tbl_lichsubaohanh` (
  `MaLSBH` int NOT NULL,
  `MaPhieuBaoHanh` int NOT NULL,
  `NgayBaoHanh` timestamp NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `MaLienKet` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_magiamgia`
--

CREATE TABLE `tbl_magiamgia` (
  `MaGiamGia` int NOT NULL,
  `TenMaGiamGia` varchar(50) NOT NULL,
  `SlugMaGiamGia` varchar(50) NOT NULL,
  `TinhNang` int NOT NULL,
  `MaCode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_magiamgiand`
--

CREATE TABLE `tbl_magiamgiand` (
  `MaGGND` int NOT NULL,
  `MaGiamGia` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `SoLuong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_magiamgiannguoidung`
--

CREATE TABLE `tbl_magiamgiannguoidung` (
  `MaGGND` int NOT NULL,
  `MaGiamGia` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `SoLuong` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_nhacungcap`
--

CREATE TABLE `tbl_nhacungcap` (
  `MaNhaCungCap` int NOT NULL,
  `TenNhaCungCap` varchar(50) NOT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `SoDienThoai` int DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `ThoiHanHopDong` timestamp NULL DEFAULT NULL,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phanquyen`
--

CREATE TABLE `tbl_phanquyen` (
  `MaPhanQuyen` int NOT NULL,
  `TenPhanQuyen` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_phanquyen`
--

INSERT INTO `tbl_phanquyen` (`MaPhanQuyen`, `TenPhanQuyen`) VALUES
(1, 'Khách hàng'),
(2, 'Nhân viên bán hàng'),
(3, 'Quản trị viên'),
(4, 'Quản trị viên cao cấp'),
(5, 'Nhân viên kho'),
(6, 'Nhân viên kế toán'),
(1, 'Khách hàng'),
(2, 'Nhân viên bán hàng'),
(3, 'Quản trị viên'),
(4, 'Quản trị viên cao cấp'),
(5, 'Nhân viên kho'),
(6, 'Nhân viên kế toán'),
(1, 'Khách hàng'),
(2, 'Nhân viên bán hàng'),
(3, 'Quản trị viên'),
(4, 'Quản trị viên cao cấp'),
(5, 'Nhân viên kho'),
(6, 'Nhân viên kế toán'),
(1, 'Khách hàng'),
(2, 'Nhân viên bán hàng'),
(3, 'Quản trị viên'),
(4, 'Quản trị viên cao cấp'),
(5, 'Nhân viên kho'),
(6, 'Nhân viên kế toán');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phanquyennguoidung`
--

CREATE TABLE `tbl_phanquyennguoidung` (
  `MaPQND` int NOT NULL,
  `MaPhanQuyen` int NOT NULL,
  `MaTaiKhoan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_phanquyennguoidung`
--

INSERT INTO `tbl_phanquyennguoidung` (`MaPQND`, `MaPhanQuyen`, `MaTaiKhoan`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 5, 1),
(4, 3, 1),
(5, 4, 1),
(6, 6, 1),
(7, 1, 2),
(8, 1, 3),
(10, 2, 3),
(11, 3, 4),
(12, 4, 3),
(13, 5, 3),
(14, 1, 4),
(15, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieubaohanh`
--

CREATE TABLE `tbl_phieubaohanh` (
  `MaPhieuBaoHanh` int NOT NULL,
  `MaDonHang` int NOT NULL,
  `NgayTao` timestamp NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `TenKhachHang` varchar(50) NOT NULL,
  `TenNhanVien` varchar(50) NOT NULL,
  `SoDienThoai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieukiemkho`
--

CREATE TABLE `tbl_phieukiemkho` (
  `MaPKK` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieunhap`
--

CREATE TABLE `tbl_phieunhap` (
  `MaPhieuNhap` int NOT NULL,
  `MaNhaCungCap` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `TienTra` varchar(50) DEFAULT NULL,
  `TienNo` varchar(50) DEFAULT NULL,
  `PhuongThucThanhToan` varchar(255) DEFAULT NULL,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieutrahang`
--

CREATE TABLE `tbl_phieutrahang` (
  `MaPhieuTraHang` int NOT NULL,
  `MaNhaCungCap` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phieuxuat`
--

CREATE TABLE `tbl_phieuxuat` (
  `MaPhieuXuat` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_phigiaohang`
--

CREATE TABLE `tbl_phigiaohang` (
  `MaTienGiaoHang` int NOT NULL,
  `MaThanhPho` int NOT NULL,
  `MaQuanHuyen` int NOT NULL,
  `MaXaPhuong` int NOT NULL,
  `SoTien` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quanhuyen`
--

CREATE TABLE `tbl_quanhuyen` (
  `MaQuyenHuyen` int NOT NULL,
  `TenQuyenHuyen` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(30) NOT NULL,
  `MaThanhPho` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quyen`
--

CREATE TABLE `tbl_quyen` (
  `MaPhanQuyen` int NOT NULL,
  `TenPhanQuyen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_quyen`
--

INSERT INTO `tbl_quyen` (`MaPhanQuyen`, `TenPhanQuyen`) VALUES
(1, 'Khách hàng'),
(2, 'Nhân viên bán hàng'),
(3, 'Quản trị viên'),
(4, 'Quản trị viên cao cấp'),
(5, 'Nhân viên kho'),
(6, 'Nhân viên kế toán');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sanpham`
--

CREATE TABLE `tbl_sanpham` (
  `MaSanPham` int NOT NULL,
  `TenSanPham` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `SlugSanPham` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `MaThuongHieu` int DEFAULT NULL,
  `MaDanhMuc` int DEFAULT NULL,
  `HinhAnh` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `TrangThai` int DEFAULT NULL,
  `MoTa` text,
  `SoLuongHienTai` int DEFAULT NULL,
  `SoLuongBan` int DEFAULT NULL,
  `SoLuongTrongKho` int DEFAULT NULL,
  `GiaSanPham` varchar(50) DEFAULT NULL,
  `ThongSoKyThuat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_sanpham`
--

INSERT INTO `tbl_sanpham` (`MaSanPham`, `TenSanPham`, `SlugSanPham`, `MaThuongHieu`, `MaDanhMuc`, `HinhAnh`, `TrangThai`, `MoTa`, `SoLuongHienTai`, `SoLuongBan`, `SoLuongTrongKho`, `GiaSanPham`, `ThongSoKyThuat`, `ThoiGianTao`, `ThoiGianSua`) VALUES
(1, 'Smart Tivi Samsung 4K Crystal UHD 75 inch UA75AU8100', 'smart-tivi-samsung-4k-crystal-uhd-75-inch-ua75au8100', 8, 1, 'led-4k-samsung-ua75au8100-29.jpg', 1, 'Tivi LED 4K Samsung UA75AU8100 có thiết kế hiện đại với không viền 3 cạnh sang trọng loại bỏ cảm giác bị giới hạn bởi khung viền đen, mang đến cho bạn cảm giác xem phim không bị không bị phân tâm.\r\n\r\nKích thước tivi Samsung 75 inch phù hợp để trên kệ tủ hay treo trên tường ở những nơi không gian lớn như: Phòng khách, phòng họp,...', NULL, NULL, NULL, '17900000', '', '2024-04-01 17:17:33', '2024-04-02 02:02:43'),
(2, 'Smart Tivi Samsung 4K 55 inch UA55AU7002', 'smart-tivi-samsung-4k-55-inch-ua55au7002', 8, 1, 'vi-vn-smart-samsung-4k-55-inch-ua55au7002-137.jpg', 1, '- Smart Tivi Samsung 4K 55 inch UA55AU7002 có vẻ ngoài thanh lịch, đường viền đen lịch lãm giúp tôn lên phong cách hiện đại, cao cấp của mọi không gian.\r\n- Sản phẩm thích hợp để trang trí cho các căn phòng có diện tích vừa và lớn với màn hình kích cỡ 55 inch.\r\n- Có thể lắp đặt treo tường hoặc sử dụng chân đế chữ V úp ngược để bố trí kiểu để bàn tùy theo thiết kế của từng căn phòng.', NULL, NULL, NULL, '8490000', '', '2024-04-02 02:06:43', NULL),
(3, 'Google Tivi Sony 4K 43 inch KD-43X77L', 'google-tivi-sony-4k-43-inch-kd-43x77l', 11, 1, 'vi-vn-google-tivi-sony-4k-43-inch-kd-43x77l-0162.jpg', 1, 'Google Tivi Sony 4K KD-43X77L có kích thước màn hình 43 inch, viền tivi được thiết kế mỏng, đen, giúp bạn dễ dàng tập trung vào màn hình, hình ảnh sắc nét chuẩn 4K với bộ xử lý hình ảnh chuẩn 4K kết hợp cùng với âm thanh vòm Dolby Audio cho bạn trải nghiệm xem phim đầy lôi cuốn.', NULL, NULL, NULL, '11090000', '', '2024-04-02 02:20:52', NULL),
(4, 'Tủ lạnh Samsung Inverter 236 lít RT22M4032BY/SV', 'tu-lanh-samsung-inverter-236-lit-rt22m4032bysv', 8, 15, 'samsung-rt22m4032by-sv-140821-091759026.jpg', 1, 'Thịt cá tươi ngon, ăn trong ngày không cần rã đông với ngăn đông mềm -1 độ C Optimal Fresh Zone\r\nNgăn đông mềm thực phẩm ở nhiệt độ -1°C của tủ lạnh giúp thịt cá luôn tươi ngon, trọn vẹn dinh dưỡng do chúng không bị đông đá, giúp bạn có thể chế biến thực phẩm nhanh chóng không cần rã đông.\r\nBạn nên sử dụng ngăn này đối với thực phẩm sẽ chế biến trong ngày, nếu muốn trữ lâu hơn, bạn hãy dùng ngăn đông để bảo quản được tốt nhất.', NULL, NULL, NULL, '5290000', NULL, '2024-04-04 14:51:17', NULL),
(5, 'Máy giặt Samsung Inverter 8kg WW80T3020WW/SV', 'may-giat-samsung-inverter-8kg-ww80t3020wwsv', 8, 3, 'vi-vn-may-giat-samsung-inverter-8kg-ww80t3020ww-sv-0139.jpg', 1, 'Động cơ Digital Inverter tối ưu hóa hiệu năng và lượng điện tiêu thụ\r\nMáy giặt được trang bị động cơ Digital Inverter với nam châm vĩnh cửu, giảm tối đa ma sát khi máy giặt vận hành, giúp tiết kiệm điện năng, vận hành êm ái hơn so với động cơ thông thường sử dụng chổi than. Đặc biệt, động cơ Digital Inverter có độ bền vượt trội và được bảo hành đến 11 năm.', NULL, NULL, NULL, '3990000', NULL, '2024-04-05 01:33:50', '2024-04-05 14:53:04'),
(6, 'Điện thoại Samsung Galaxy S24 5G 256GB', 'dien-thoai-samsung-galaxy-s24-5g-256gb', 8, 8, 'samsung-galaxy-s24-sliderr-11-1020x57028.jpg', 1, 'Thông tin sản phẩm\r\nSamsung Galaxy S24 - mẫu điện thoại flagship của nhà Samsung vừa được giới thiệu tại sự kiện thường niên vào ngày 18/01. Sản phẩm lần này thu hút sự chú ý nhờ tích hợp chip mới tự hãng sản xuất, kết hợp cùng với đó là nhiều tính năng AI thông minh và những cải tiến mới cho màn hình và camera.\r\nĐặc điểm nổi bật trên Samsung Galaxy S24\r\n• Thiết kế vuông hơn, hiện đai hơn\r\n• Camera 50 MP cho khả năng chụp ảnh sắc nét\r\n• Tích hợp nhiều tính năng AI giúp tăng sự tiện ích khi sử dụng\r\n• Trang bị chip nhà làm \"Exynos 2400\"\r\n• Hỗ trợ quay video 8K nhằm đáp ứng tốt cho các công việc sáng tạo', NULL, NULL, NULL, '22090000', NULL, '2024-04-05 01:35:36', NULL),
(7, 'Điện thoại Samsung Galaxy S23 FE 5G 128GB', 'dien-thoai-samsung-galaxy-s23-fe-5g-128gb', 8, 8, 'samsung-galaxy-s23-fe-sld-1-1020x57081.jpg', 1, 'Samsung Galaxy S23 FE 5G là mẫu điện thoại thuộc dòng cận cao cấp được ra mắt tại thị trường Việt Nam. Sản phẩm lần này được đánh giá cao với những tính năng ấn tượng, bao gồm cấu hình mạnh mẽ, camera 50 MP có khả năng quay video 8K và màn hình 120 Hz, tạo nên một sản phẩm đáng chú ý trong phân khúc của mình.\r\nVẻ ngoài sang trọng cùng độ bền ấn tượng\r\nMặt lưng của Galaxy S23 FE được thiết kế phẳng, tạo nên một bề mặt đẹp mắt và hiện đại. Chất liệu kính cường lực Gorilla Glass 5 không chỉ mang lại vẻ đẹp của sự sang trọng mà còn đảm bảo độ bền và chống trầy tốt. Khả năng chịu lực và chống va đập của Gorilla Glass 5 giúp bảo vệ chiếc điện thoại khỏi những tác động không mong muốn trong cuộc sống hằng ngày.', NULL, NULL, NULL, '12890000', NULL, '2024-04-05 01:36:56', NULL),
(8, 'Điện thoại Samsung Galaxy A15 5G', 'dien-thoai-samsung-galaxy-a15-5g', 8, 8, 'samsung-galaxy-a15-5g-xanh-thumb-600x60091.jpg', 1, 'Hiển thị sắc nét hình ảnh - Samsung Galaxy A15 5G\r\nVới độ phân giải Full HD+ (1080 x 2340 Pixels) và kích thước màn hình 6.5 inch, màn hình máy được tăng cường mật độ điểm ảnh, làm cho mọi nội dung trở nên chân thực và sắc nét hơn.\r\nNgoài ra, sản phẩm còn điểm nhấn với tần số quét cao 90 Hz và độ sáng màn hình lên đến 800 nits. Tất cả những điểm mạnh này tạo ra trải nghiệm sử dụng tuyệt vời đến bạn và đặt sản phẩm này vào vị thế hàng đầu trong phân khúc của nó.\r\nNgoại hình đẹp mắt và hiện đại\r\nTổng thể, Samsung Galaxy A15 5G có thiết kế hình hộp vuông vắn, bao gồm mặt lưng và màn hình phẳng, thuộc dạng thiết kế phổ biến trong các dòng smartphone hiện đại. Mặt lưng được chế tạo từ nhựa cho cảm giác cầm nắm nhẹ nhàng và hạn chế dấu vết vân tay.\r\nThiết kế trẻ trung, đpẹ mắt - Samsung Galaxy A15 5G\r\nGalaxy A15 5G trang bị cảm biến vân tay tích hợp ở cạnh viền, giúp người dùng mở khóa thiết bị một cách nhanh chóng và thuận tiện. Chỉ cần một cái chạm nhẹ, điện thoại sẽ mở khóa ngay lập tức, đồng thời bảo vệ dữ liệu cá nhân và thông tin trên máy một cách an toàn và hiệu quả.\r\nChụp ảnh rõ nét với camera chính 50 MP\r\nGalaxy A15 5G trang bị camera chính với độ phân giải 50 MP, mang đến sự tinh tế và chi tiết cho mỗi bức ảnh. Camera góc siêu rộng 5 MP và camera cận cảnh 2 MP được tối ưu hóa tạo ra những bức ảnh có góc nhìn rộng hay ảnh chân dung với hiệu ứng nền mờ đẹp mắt.\r\nCamera chụp ảnh sắc nét - Samsung Galaxy A15 5G\r\nỞ mặt trước, điện thoại tích hợp camera selfie với độ phân giải 13 MP, kèm theo tính năng xóa phông và chức năng làm đẹp, giúp tạo nên những bức ảnh tự sướng hoàn hảo và rạng ngời.\r\nCấu hình vượt trội cân mọi tác vụ\r\nVề cấu hình, Galaxy A15 5G trang bị bộ vi xử lý MediaTek Dimensity 6100+ 8 nhân, mang lại sức mạnh ấn tượng. Tốc độ CPU cao giúp điện thoại xử lý mượt mà các tác vụ đa nhiệm như mở ứng dụng, duyệt web, chơi game hay xem video mà không gặp khó khăn.\r\nSức mạnh 5G - Samsung Galaxy A15 5G\r\n\r\nSử dụng hệ điều hành Android 14, điện thoại Samsung Galaxy A này sẵn sàng đối mặt với mọi thách thức. Hệ điều hành Android 14 không chỉ mang đến giao diện tinh tế và dễ sử dụng mà còn hỗ trợ nhiều tính năng đa dạng, từ bảo mật tối ưu đến trải nghiệm sử dụng tốt nhất.\r\n\r\nSamsung Galaxy A15 5G còn là mẫu điện thoại RAM 8 GB cho phép chạy nhiều ứng dụng cùng một lúc mà không cần lo lắng về hiệu suất, từ đó mang lại trải nghiệm sử dụng mượt mà và không bị giật lag.\r\n\r\nHỗ trợ sạc nhanh 25 W với viên pin lớn\r\nSamsung Galaxy A15 5G sở hữu viên pin khủng lên đến 5000 mAh, dung lượng pin được xem là tiêu chuẩn với một chiếc smartphone. Với dung lượng này, Galaxy A15 5G có khả năng đáp ứng tốt nhu cầu sử dụng hằng ngày, thậm chí có thể sử dụng liên tục trong cả hai ngày với các tác vụ nghe gọi hay nhắn tin.\r\n\r\nGalaxy A15 5G còn hỗ trợ sạc nhanh với công suất 25 W, cho phép bạn nhanh chóng nạp đầy pin để tiếp tục sử dụng. Điều này cực kỳ hữu ích khi bạn đang có việc gấp và cần sử dụng máy một cách tức thì.\r\n\r\nViên pin dung lượng lớn - Samsung Galaxy A15 5G\r\n\r\nTổng thể, Samsung Galaxy A15 5G là một chiếc điện thoại Android được đánh giá cao trong phân khúc. Với thiết kế trẻ trung, màn hình chất lượng, camera ổn định và hiệu năng đáp ứng tốt cho nhiều nhu cầu, đây là lựa chọn phù hợp cho những người tìm kiếm chiếc điện thoại giá trị với các tính năng mới mẻ.\r\n\r\nXem thêm\r\nĐánh giá Điện thoại Samsung Galaxy A15 5G\r\n3.6\r\n\r\n23 đánh giá\r\n5\r\n22%\r\n4\r\n35%\r\n3\r\n26%\r\n\r\n2\r\n13%\r\n\r\n1\r\n4%\r\n\r\nNGUYỄN THỊ HUYỀN TRANG  Đã mua tại TGDĐ\r\n    \r\nSẽ giới thiệu cho bạn bè, người thân\r\n\r\nMong được hỗ trợ. Mình mua máy từ 16/1, trong quá trình sử dụng có khoảng 10 lần máy không nhận cuộc gọi đến được, hoặc thực hiện cuộc gọi đi thì báo không có mạng di động mặc dù điện thoại vẫn báo vạch sóng. Đó là những lần mình thực hiện gọi nên phát hiện ra, còn thực tế không biết là máy không thể liên lạc qua sim nhiều không nữa. RẤT MONG ĐƯỢC HỖ TRỢ, VÌ TÔI CHƯA QUA TRỰC TIẾP ĐƯỢC HỆ THỐNG CỬA HÀNG TGDĐ\r\n\r\nHữu ích (1) Đã dùng khoảng 2 tháng\r\nNguyễn Thị Nhí  Đã mua tại TGDĐ\r\n    \r\nMáy bấm có xíu tuột pin nhanh với lại k bấm lâu mà máy nóng sạt cũng nóng mới mua chưa được 1 tháng nhưng gọi video lúc nghe được tiếng lúc k nghe được tiếng và hình ảnh bị nhè tôi muốn đổi lại cái khác dc k vì mua ch dc 1 tháng\r\n\r\nimage supportBộ phận bảo hành đã liên hệ hỗ trợ ngày 18/03/2024\r\nHữu ích (2) Đã dùng khoảng 2 tuần\r\nXem 23 đánh giá\r\nViết đánh giá\r\nXanh dương nhạt Xanh dương đậm Đen\r\nGiá tại Hồ Chí Minh\r\n5.790.000₫ 6.290.000₫ -7% Trả góp 0%\r\n\r\n+11.580 điểm tích lũy Quà Tặng VIP\r\n\r\n\r\nKhuyến mãi\r\n\r\nGiá và khuyến mãi dự kiến áp dụng đến 23:00 | 08/04\r\n1\r\nTặng gói Bảo hiểm mở rộng Samsung Care+ 6 tháng Xem chi tiết\r\n\r\n2\r\nTặng suất mua Samsung Galaxy Fit 3 giảm đến 300.000đ (không kèm KM khác của đồng hồ)\r\n\r\n3\r\nNhập mã VNPAYTGDD2 giảm ngay 1% (tối đa 200.000đ) khi thanh toán qua VNPAY-QR, áp dụng cho đơn hàng từ 3 Triệu (Xem chi tiết tại đây)\r\n\r\nChọn địa chỉ nhận hàng để biết thời gian giao.\r\n\r\nXem siêu thị có hàng\r\nMUA NGAY\r\nMUA TRẢ GÓP 0%\r\nDuyệt hồ sơ trong 5 phút\r\nTRẢ GÓP QUA THẺ\r\nVisa, Mastercard, JCB, Amex\r\nGọi đặt mua 1900 232 461 (7:30 - 22:00)\r\n\r\nƯU ĐÃI HẤP DẪN KHI MUA KÈM\r\n\r\nĐiện thoại Samsung Galaxy A15 5G\r\n5.790.000₫ 6.290.000₫\r\nGiảm 30%\r\nSạc Samsung EP-TA800N\r\n340.000₫ 490.000₫\r\nChọn adapter sạc khác\r\nGiảm 30%\r\nTai nghe Bluetooth True Wireless AVA+ FreeGo A20\r\n200.000₫ 290.000₫\r\nChọn tai nghe khác\r\nTổng tiền:\r\n6.330.000₫\r\n7.070.000₫\r\nMUA 3 SẢN PHẨM\r\n9 ưu đãi thêm Dự kiến áp dụng đến 23:59 | 01/05\r\n\r\nĐồng hồ thông minh hãng Befit Giảm 30% khi mua kèm Smartphone (trừ iPhone) ( Tùy Model, Không áp dụng khuyến mãi khác).\r\n\r\nSamsung Galaxy Watch6, Watch6 Classic giảm thêm 1,000,000đ khi mua kèm SS Phone.\r\n\r\nXem thêm 7 ưu đãi khác\r\n\r\nQuét để tải App\r\n\r\n\r\nQuà Tặng VIP\r\n\r\nTích & Sử dụng điểm\r\ncho khách hàng thân thiết\r\n\r\nSản phẩm của tập đoàn MWG\r\n\r\nGoogle PlayAppStore\r\nCấu hình Điện thoại Samsung Galaxy A15 5G\r\n\r\nMàn hình:\r\n\r\nSuper AMOLED6.5\"Full HD+\r\nHệ điều hành:\r\n\r\nAndroid 14\r\nCamera sau:\r\n\r\nChính 50 MP & Phụ 5 MP, 2 MP\r\nCamera trước:\r\n\r\n13 MP\r\nChip:\r\n\r\nMediaTek Dimensity 6100+\r\nRAM:\r\n\r\n8 GB\r\nDung lượng lưu trữ:\r\n\r\n256 GB\r\nSIM:\r\n\r\n2 Nano SIMHỗ trợ 5G\r\nPin, Sạc:\r\n5000 mAh25 W\r\nXem thêm cấu hình chi tiết', NULL, NULL, NULL, '5790000', NULL, '2024-04-05 01:38:53', NULL),
(9, 'Máy giặt Samsung Inverter 14 kg WA14CG5745BVSV', 'may-giat-samsung-inverter-14-kg-wa14cg5745bvsv', 8, 3, 'may-giat-samsung-14kg-wa14cg5745bvsv638258800871763098-1020x57099.jpg', 1, 'Máy giặt Samsung Inverter 14kg WA14CG5745BVSV có khả năng đánh bay vết bẩn cứng đầu hiệu quả nhờ công nghệ giặt bong bóng siêu mịn Eco Bubble, công nghệ Digital Inverter tiết kiệm điện năng vận hành êm ái, giặt sạch siêu tốc 29 phút đảm bảo hiệu quả sạch sâu.\r\nThiết kế\r\n- Samsung 14kg WA14CG5745BVSV được thiết kế kiểu máy giặt lồng đứng quen thuộc. Chất liệu vỏ máy bằng thép không gỉ có độ bền tốt và phủ sơn tĩnh điện giúp giảm thiểu tình trạng trầy xước đáng kể.\r\n- Bảng điều khiển song ngữ Anh - Việt có màn hình hiển thị tiện lợi.\r\n- Nắp máy giặt được làm bằng kính chịu lực trong suốt, có độ bền tốt. Ngoài ra, cửa máy còn được trang bị van điều tiết làm chậm chuyển động, giúp thao tác đóng và mở cửa nắp máy trở nên nhẹ nhàng, an toàn hơn.\r\n- Lồng giặt được làm bằng thép không gỉ, sáng bóng và có độ bền tốt, giảm thiểu hiện tượng gỉ sét.', NULL, NULL, NULL, '10890000', NULL, '2024-04-05 01:43:14', NULL),
(10, 'Tai nghe Bluetooth True Wireless Mozard TS13', 'tai-nghe-bluetooth-true-wireless-mozard-ts13', 4, 9, 'tai-nghe-bluetooth-true-wireless-mozard-ts13-den-1-org53.jpg', 1, 'Đặc điểm nổi bật\r\nThiết kế gọn nhẹ, đẹp mắt, đeo vừa vặn.\r\nChất âm sống động, quyến rũ.\r\nKết nối nhanh, ổn định với công nghệ Bluetooth 5.0.\r\nThời gian sử dụng tối đa 5 giờ, sạc 1.5 giờ qua cổng Micro USB.', NULL, NULL, NULL, '135000', NULL, '2024-04-05 05:49:43', NULL),
(11, 'Tai nghe Bluetooth AirPods Pro (2nd Gen) MagSafe Charge Apple MQD83', 'tai-nghe-bluetooth-airpods-pro-2nd-gen-magsafe-charge-apple-mqd83', 2, 9, 'tai-nghe-bluetooth-airpods-pro-2-magsafe-charge-apple-mqd83-trang-090922-034128-600x600198.jpg', 1, 'Thông tin sản phẩm\r\nAirPods Pro 2 là một trong những sản phẩm được Apple ra mắt trong năm 2022, với nhiều nâng cấp ấn tượng, chip H2 mạnh mẽ, âm thanh phong phú hơn, khả năng khử tiếng ồn chủ động,... hứa hẹn sẽ mang lại trải nghiệm tuyệt vời cho người dùng.\r\nThiết kế gọn gàng, vẫn giữ nét đặc trưng của AirPods Pro\r\nKiểu dáng AirPods Pro 2 vẫn tương tự AirPods Pro, giữ gam màu trắng sang trọng, vẻ ngoài tinh giản, phù hợp phối đồ với nhiều loại trang phục đi học, đi chơi, đi làm,... \r\nKích thước housing nhỏ nhắn đi kèm 4 cặp đệm tai silicone mềm mại với các kích cỡ XS, S, M, L. Giúp phù hợp với nhiều cỡ tai người dùng và giúp tạo ra 1 lớp đệm kín âm thanh hỗ trợ loại bỏ tiếng ồn tối ưu, cố định AirPods Pro này trên tai một cách chắc chắn.', NULL, NULL, NULL, '5790000', NULL, '2024-04-05 08:20:10', NULL),
(12, 'Tai nghe Bluetooth truyền âm thanh qua xương Shokz OPENRUN PRO S810', 'tai-nghe-bluetooth-truyen-am-thanh-qua-xuong-shokz-openrun-pro-s810', 2, 9, 'shokz-openrun-pro-s810-xanh-hc-15.jpg', 1, 'Shokz OPENRUN PRO S810 là dòng sản phẩm tai nghe Bluetooth truyền âm thanh qua xương thế hệ mới với nhiều ưu điểm ấn tượng, đáp ứng tốt các nhu cầu sử dụng hằng ngày như giải trí, đàm thoại, nghe nhạc khi luyện tập thể thao,...\r\n• Tai nghe Shokz sở hữu thiết kế tai nghe mở độc đáo với khung titanium siêu nhẹ cùng lớp phủ silicone mềm mại, cho phép bạn thoải mái đeo cả ngày mà không gây hầm bí, khó chịu.\r\n\r\n• Với công nghệ truyền âm thanh qua xương, bạn có thể tận hưởng âm nhạc trọn vẹn nhưng vẫn giữ được khả năng nghe nhận âm thanh xung quanh, giúp bạn an toàn hơn trong các buổi luyện tập ngoài trời.\r\n\r\n• OpenRun Pro được trang bị micro chống ồn kép mang đến bạn những cuộc gọi với chất lượng rõ ràng, ổn định dù ở trong môi trường nhiều tạp âm như văn phòng hay quán cà phê,...\r\n\r\n• Công nghệ dẫn truyền âm thanh qua xương thế hệ thứ 9 hiện đại Shokz Turbo Pitch trên tai nghe thể thao này mang đến dải âm trung và âm cao rõ nét, âm bass ấn tượng giúp bạn thưởng thức trọn vẹn từng giai điệu yêu thích.\r\n\r\n• Thời lượng pin kéo dài đến 10 giờ cho bạn thoải mái sử dụng trong các cuộc họp hay những buổi luyện tập ngoài trời,... mà không lo hết pin giữa chừng. Thiết bị còn được trang bị sạc nhanh, chỉ với 5 phút sạc, bạn đã có thể sử dụng lại tai nghe được 1 giờ 30 phút.\r\n\r\n• Chuẩn chống nước và bụi IP55 cho phép OpenRun Pro đồng hành cùng bạn trong nhiều điều kiện như đi mưa, đổ mồ hôi hay ở trong môi trường nhiều cát, bụi bẩn.', NULL, NULL, NULL, '4490000', NULL, '2024-04-05 08:21:31', NULL),
(13, 'Laptop Acer Aspire 3 A315 510P 32EF i3 N305/8GB/256GB/Win11', 'laptop-acer-aspire-3-a315-510p-32ef-i3-n3058gb256gbwin11', 9, 2, 'vi-vn-acer-aspire-3-a315-510p-32ef-i3-nxkdhsv001-slider-3-1020x57061.jpg', 1, 'Laptop Acer Aspire 3 A315 510P 32EF i3 N305 (NX.KDHSV.001) đã trở thành một người bạn đồng hành tốt cùng mình giải quyết mọi vấn đề trong công việc cũng như học tập nhờ hiệu năng ổn định đến từ bộ xử lý Intel thế hệ 12 tân tiến.\r\n• Laptop Acer sở hữu bộ vi xử lý Intel Core i3 Alder Lake chuỗi N với tốc độ tối đa 3.8 GHz nhờ Turbo Boost, đảm bảo xử lý mượt mà mọi tác vụ học tập như soạn thảo word, học online, chuẩn bị bản thuyết trình trên PowerPoint,... đến các hoạt động giải trí cơ bản. Đi kèm với card tích hợp Intel UHD Graphics hỗ trợ tốt các nhu cầu đồ họa đơn giản một cách dễ dàng.\r\n• RAM 8 GB LPDDR5 cùng với tốc độ bus RAM cao 4800 MHz cho phép đa nhiệm mượt mà và truy cập dữ liệu nhanh hơn, giúp tăng hiệu suất cũng như nâng cao trải nghiệm người dùng.\r\n\r\n• Ổ cứng SSD NVMe PCIe dung lượng 256 GB cung cấp đủ không gian để lưu trữ tệp tin, tài liệu và phương tiện truyền thông một cách thuận tiện. Ngoài ra, để thỏa mãn nhu cầu lưu trữ cao hơn bạn cũng có thể tháo ra và lắp thanh tối đa 1 TB.\r\n\r\n• Với kích thước 15.6 inch cùng độ phân giải Full HD (1920 x 1080) và tấm nền IPS giúp hiển thị rõ nét, góc nhìn mở rộng lên đến 178 độ, bạn có thể nhìn rõ hình ảnh ngay cả khi ngồi nghiêng.\r\n\r\n• Nhờ công nghệ Stereo speakers cung cấp âm thanh 2 kênh, cho âm thanh từ hai phía, hỗ trợ tốt cho không gian giải trí, học tập của bạn.\r\n\r\n• Laptop học tập - văn phòng khoác lên mình một chiếc vỏ nhựa, màu bạc hiện đại thanh lịch. Chỉ với cân nặng khoảng 1.7 kg bạn sẽ dễ dàng bỏ vào balo và di chuyển mọi nơi rất phù hợp với các bạn học sinh, sinh viên.\r\n• Tuy nhiên, một điều thật đáng tiếc ở chiếc laptop này là bàn phím không được trang bị đèn chính vì thế bạn nên sử dụng ở nơi có ánh sáng phù hợp để dễ dàng thực hiện các thao tác gõ phím.\r\n• Laptop Acer Aspire cũng có nhiều cổng giao tiếp như: USB Type-C, USB 3.2, HDMI và Jack tai nghe 3.5 mm hỗ trợ kết nối đa thiết bị ngoại vi.', NULL, NULL, NULL, '8990000', NULL, '2024-04-05 08:23:17', NULL),
(14, 'Laptop Acer Aspire 7 Gaming A715 43G R8GA R5 5625U/8GB/512GB/4GB RTX3050/144Hz/Win11', 'laptop-acer-aspire-7-gaming-a715-43g-r8ga-r5-5625u8gb512gb4gb-rtx3050144hzwin11', 9, 2, 'vi-vn-acer-aspire-7-gaming-a715-43g-r8ga-r5-nhqhdsv002-228.jpg', 1, 'Phiên bản Acer Aspire 7 Gaming này đã được nâng cấp lên chút đỉnh so với các sản phẩm tiền nhiệm khi trang bị bộ vi xử lý AMD Ryzen 5 5625U cùng card rời NVIDIA GeForce RTX 3050 4 GB giải quyết nhẹ nhàng mọi tác vụ từ cơ bản đến nâng cao trên các ứng dụng học tập, làm việc của Office, Google,... hay thậm chí là chiếc laptop RTX 30 series này còn chiến các tựa game phổ biến như LOL, CS:GO, Asphalt,... một cách mượt mà.', NULL, NULL, NULL, '15990000', NULL, '2024-04-05 08:24:26', NULL),
(15, 'Laptop Acer Nitro 5 Gaming AN515 57 5669 i5 11400H/8GB/512GB/144Hz/4GB GTX1650/Win11', 'laptop-acer-nitro-5-gaming-an515-57-5669-i5-11400h8gb512gb144hz4gb-gtx1650win11', 9, 2, 'vi-vn-acer-nitro-5-gaming-an515-57-5669-i5-nhqehsv001-139.jpg', 1, 'Laptop Acer Nitro 5 Gaming AN515 57 5669 i5 (NH.QEHSV.001) sở hữu vẻ ngoài cá tính, nổi bật cùng hiệu năng mạnh mẽ đến từ con chip Intel thế hệ 11 tân tiến, card đồ hoạ rời NVIDIA GeForce GTX, hứa hẹn mang đến các trải nghiệm tuyệt vời cho người dùng.\r\nSức mạnh ấn tượng đến từ CPU thế hệ mới\r\nChiếc máy tính chơi game này được trang bị bộ vi xử lý Intel Core i5 Tiger Lake 11400H với cấu trúc 6 nhân 12 luồng mang đến xung nhịp cơ bản 2.70 GHz và đạt tối đa lên đến 4.5 GHz nhờ Turbo Boost xử lý các tác vụ đồ họa chuyên nghiệp một cách trơn tru, chạy tốt các tựa game cấu hình cao cho bạn tận hưởng các trận chiến game một cách thỏa mãn nhất.\r\n\r\nTrang bị RAM 8 GB chuẩn DDR4 2 khe (1 khe 8 GB + 1 khe rời) cho khả năng xử lý đa nhiệm mượt mà, bạn có thể thực hiện cùng lúc nhiều tác vụ, việc di chuyển qua lại giữa các phần mềm vô cùng mượt, không lo hiện tượng giật, lag với tốc độ 3200 MHz. Đồng thời, bạn có thể nâng cấp bộ nhớ lên 32 GB nếu nhu cầu sử dụng cao hơn bộ nhớ mặc định của máy.', NULL, NULL, NULL, '15990000', NULL, '2024-04-05 08:26:07', '2024-04-05 08:26:27'),
(16, 'Laptop Acer Aspire 3 A315 58 589K i5 1135G7/8GB/256GB/Win11', 'laptop-acer-aspire-3-a315-58-589k-i5-1135g78gb256gbwin11', 9, 2, 'acer-aspire-3-a315-58-589k-i5-nxam0sv008-thumb-600x60057.jpg', 1, 'Laptop Acer Aspire 3 A315 58 589K i5 1135G7 (NX.AM0SV.008) là một trong những mẫu laptop học tập - văn phòng đáng để bạn cân nhắc sở hữu nhất khi mang trong mình những thông số cấu hình ổn định, thiết kế đẹp mắt và có mức giá bán dễ tiếp cận.\r\n• Với bộ vi xử lý Intel Core i5 1135G7 và card tích hợp Intel Iris Xe Graphics, laptop Acer Aspire đáp ứng tốt nhu cầu làm việc đa nhiệm và xử lý các tác vụ văn phòng như Word, Excel, PowerPoint mà vẫn đảm bảo sự mượt mà và hiệu quả.\r\n\r\n• Bộ nhớ RAM 8 GB và ổ cứng SSD 256 GB không chỉ cho phép bạn làm việc đa tác vụ và khởi động máy nhanh chóng mà còn giúp tăng tốc độ tải ứng dụng cũng như sao chép dữ liệu, từ đó giúp tăng hiệu suất làm việc.\r\n\r\n• Laptop Acer có màn hình 15.6 inch với độ phân giải Full HD cho bạn trải nghiệm hình ảnh sắc nét và mượt mà. Đặc biệt, công nghệ Acer ComfyView và tấm nền LED Backlit giúp giảm ánh sáng chói và mỏi mắt khi sử dụng máy trong thời gian dài.\r\n\r\n• Tận hưởng không gian âm nhạc sống động hơn với công nghệ Stereo speakers trên thiết bị, đem lại trải nghiệm âm thanh tuyệt vời và sống động.\r\n\r\n• Với khối lượng 1.7 kg, laptop tỏ ra tiện lợi khi bạn cần mang theo máy, giúp bạn có thể sử dụng máy tính bất cứ khi nào và ở bất cứ đâu một cách dễ dàng. Hơn nữa Aspire 3 còn có thiết kế bắt mắt với tông màu vàng sang trọng, tạo điểm nhấn trong mắt người dùng.\r\n\r\n• Máy cũng được trang bị đầy đủ các cổng giao tiếp như USB 2.0, USB 3.0, HDMI, Jack tai nghe 3.5 mm và LAN giúp kết nối với nhiều thiết bị một cách dễ dàng.', NULL, NULL, NULL, '10990000', NULL, '2024-04-05 08:30:31', NULL),
(17, 'Google Tivi Sony 32 inch KD-32W830K', 'google-tivi-sony-32-inch-kd-32w830k', 11, 1, 'vi-vn-google-sony-32-inch-kd-32w830k-129.jpg', 1, 'Google Tivi Sony 32 inch KD-32W830K trang bị các công nghệ xử lý hình ảnh, âm thanh hiện đại như nâng cấp hình ảnh X-Reality PRO, chuyển động mượt Motionflow XR 200, S-Master Digital Amplifier, đặc biệt hệ điều hành Google TV đáp ứng đa dạng nhu cầu giải trí của người sử dụng.\r\nThiết kế\r\n- Google Tivi Sony sở hữu thiết kế màn hình phẳng, viền đen mềm mại. Chiếc tivi Sony có kích thước màn hình 32 inch tivi được nâng đỡ chắc chắn trên chân đế chữ V úp ngược bằng nhựa.\r\n- Sản phẩm là sự chọn phù hợp cho các không gian phòng khách, phòng ngủ nhỏ, đặc biệt phù hợp với không gian phòng khách sạn, nhà nghỉ,...', NULL, NULL, NULL, '7490000', NULL, '2024-04-05 08:32:48', NULL),
(18, 'Google Tivi Sony 4K 43 inch KD-43X75K', 'google-tivi-sony-4k-43-inch-kd-43x75k', 11, 1, 'android-sony-4k-55-inch-kd-55x80k-180322-022717-550x3406.png', 1, 'Google Tivi Sony 4K 43 inch KD-43X75K được trang bị đa dạng các công nghệ xử lý hình ảnh, âm thanh hiện đại, cùng với các tính năng thông minh tiên tiến, tivi Sony cho bạn có những trải nghiệm tuyệt vời trên chiếc tivi này.', NULL, NULL, NULL, '5990000', NULL, '2024-04-05 08:35:13', '2024-04-28 13:42:51'),
(19, 'Cáp chuyển đổi Lightning sang 3.5mm Apple MMX62', 'cap-chuyen-doi-lightning-sang-35mm-apple-mmx62', 11, 16, 'cap-chuyen-doi-lightning-sang-35mm-mmx62-1-org39.jpg', 1, 'Đặc điểm nổi bật\r\nThiết kế nhỏ gọn, độ dài lý tưởng.\r\nGiúp chuyển đổi từ cổng lightning sang 3.5mm.\r\nKết nối được với loa, gậy chụp ảnh,... tùy vào nhu cầu sử dụng.\r\nSản phẩm chính hãng nguyên seal 100%.\r\nLưu ý: Thanh toán trước khi mở seal.', NULL, NULL, NULL, '270000', NULL, '2024-04-05 08:58:29', '2024-04-05 09:02:00'),
(20, 'Adapter Sạc Type C PD 25W Samsung EP-TA800N', 'adapter-sac-type-c-pd-25w-samsung-ep-ta800n', 8, 16, 'type-c-pd-25w-samsung-ep-ta800n-223.jpg', 1, 'Đặc điểm nổi bật\r\nThiết kế hiện đại, nhỏ, nhẹ, tiện dụng. \r\nChuẩn sạc nhanh Power Delivery cho công suất lớn tới 25 W.\r\nCổng Type-C khi sạc thường 5V - 3A, sạc nhanh PDO: 9V - 2.77A / PPS: 3.3-5.9V - 3A hoặc 3.3-11V - 2.25A.\r\nSử dụng cho nhiều dòng điện thoại, máy tính bảng,...\r\nThông tin sản phẩm\r\nThiết kế năng động, hiện đại\r\nAdapter Sạc Type C PD 25W Samsung EP-TA800N có 2 tông màu đen - trắng thời trang, khối lượng nhẹ, kích thước nhỏ gọn, không chiếm diện tích khi bỏ vào túi quần, túi xách hay balo nên cực hoàn hảo để đồng hành trong các chuyến đi, hỗ trợ cung cấp năng lượng tiện ích ở mọi nơi.', NULL, NULL, NULL, '390000', NULL, '2024-04-05 13:37:46', NULL),
(21, 'Camera IP 360 Độ 3MP TIANDY TC-H332N', 'camera-ip-360-do-3mp-tiandy-tc-h332n', 8, 6, 'camera-ip-360-do-3mp-tiandy-tc-h332n-thumb-2-600x60080.jpg', 1, 'Thông tin sản phẩm\r\nCamera IP 360 Độ 3MP TIANDY TC-H332N có thiết kế nhỏ gọn, cùng nhiều tính năng thông minh như: Báo động âm thanh khi có sự kiện bất thường, gửi thông báo đến điện thoại khi có báo động, chế độ riêng tư, đèn LED trợ sáng vào ban đêm,... Đây sẽ là lựa chọn tuyệt vời cho những ai muốn mua camera giám sát thông minh và tiện lợi.\r\nThiết kế tối giản, gam màu sang trọng\r\nSở hữu thiết kế nhỏ gọn và gam màu trắng thanh lịch, camera cực kỳ phù hợp để lắp đặt cho không gian phòng khách, phòng ngủ,... Khối lượng camera chỉ 220 g và kích thước gọn giúp người dùng dễ dàn', NULL, NULL, NULL, '550000', NULL, '2024-04-05 13:39:18', NULL),
(22, 'Camera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR', 'camera-ip-360-do-3mp-imou-ranger-rc-gk2cp-3c0wr', 10, 6, 'camera-ip-360-do-3mp-tiandy-tc-h332n-thumb-2-600x60070.jpg', 1, 'Camera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR sở hữu kiểu dáng nhỏ gọn, với nhiều tính năng thông minh như cuộc gọi 1 chạm, nhận diện con người, báo động khi có âm thanh bất thường,... cho người dùng tiện lợi quan sát, gọi điện, bảo vệ gia đình và người thân một cách tốt nhất.\r\nThiết kế đẹp mắt, gam màu tinh tế\r\nCamera có thiết kế nhỏ gọn và thanh lịch với khối lượng chỉ 171 g, dễ dàng lắp đặt ở bất kỳ vị trí nào trong nhà, từ phòng khách, phòng ngủ cho đến phòng bếp. \r\n\r\nCamera được bọc bởi lớp vỏ chắc chắn, hạn chế bám bụi giúp camera luôn sạch sẽ và bền bỉ theo thời gian. Camera có thể hoạt động ổn định trong khoảng nhiệt độ từ - 10 độ C đến 45 độ C và độ ẩm dưới 95% RH, không lo bị ảnh hưởng bởi nhiệt độ môi trường, phù hợp với điều kiện thời tiết Việt Nam.\r\n\r\nCamera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR - Thiết kế nhỏ gọn, cứng cáp\r\n\r\nĐộ phân giải UHD cho hình ảnh sắc nét, chân thực\r\nCamera sở hữu ống kính 3.6 mm, có thể xoay ngang 355 độ (nhìn ngang 360 độ) và xoay dọc lên đến 70 độ, cho phép camera quan sát bao quát toàn bộ không gian trong nhà.\r\n\r\nỐng kính có độ phân giải 3 MP (1296p), đem lại hình ảnh rõ nét và trung thực. Tầm nhìn xa hồng ngoại lên đến 10 m, giúp camera nhìn rõ kể cả trong điều kiện thiếu sáng.\r\n\r\nCamera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR - Chất lượng ảnh sắc nét\r\n\r\nTrang bị nhiều tính năng thông minh\r\nTrang bị tính năng 1 chạm để gọi, giúp bạn gọi điện thoại chỉ bằng một cú chạm vào biểu tượng trên camera. Tính năng này rất tiện lợi cho người già hoặc trẻ nhỏ khi cần liên lạc gấp với người thân.\r\n\r\nCamera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR - Dễ dàng gọi điện trên camera\r\n\r\nCamera IMOU cũng có tính năng phát hiện và theo dõi chuyển động, phát hiện con người, giúp camera nhận diện được các vật thể hoặc người đang di chuyển trong tầm nhìn của camera. Camera sẽ gửi thông báo cho điện thoại của bạn khi có sự cố xảy ra, giúp bạn kiểm soát và theo dõi từ xa hiệu quả.\r\n\r\nCamera được trang bị tính năng bảo vệ riêng tư thông minh, khi bật tính năng này ống kính sẽ được che kín. Mọi hoạt động và âm thanh trong khu vực giám sát sẽ không được ghi lại, giúp bạn và gia đình của bạn thoải mái hoạt động.\r\n\r\nCamera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR - Hỗ trợ chế độ riêng tư\r\n\r\nCamera còn có tính năng báo động khi có âm thanh bất thường, camera sẽ cảnh báo khi phát hiện các âm thanh lạ như tiếng đập cửa, tiếng kính vỡ, tiếng la hét, tiếng súng,... Bên cạnh đó, người dùng có thể đàm thoại 2 chiều, giúp bạn trò chuyện hoặc cảnh báo với người đang ở gần camera một cách dễ dàng.\r\n\r\nCamera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR - Báo động khi có âm thanh bất thường\r\n\r\nHỗ trợ lưu trữ lên đến 30 ngày\r\nCamera giám sát có khe cắm thẻ nhớ hỗ trợ dung lượng lên đến 256 GB, cho phép lưu trữ video, hình ảnh trong khoảng 21 - 30 ngày. Người dùng có thể truy cập và xem lại dữ liệu một cách thuận tiện khi cần thiết. Ngoài thẻ nhớ, camera có thể lưu trữ qua đầu ghi hình, qua NAS (theo Onvif / RTSP) hoặc lưu qua đám mây Imou Protect (dùng thử trong 14 ngày, lịch sử lưu lại 3 ngày).\r\nCamera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR - Hỗ trợ lưu trữ qua thẻ nhớ\r\nDễ dàng kết nối và điều khiển camera qua ứng dụng\r\nCamera có khả năng kết nối với wifi ở cả hai băng tần 2.4 GHz, tạo ra kết nối ổn định và nhanh chóng với các thiết bị di động, máy tính bảng chạy hệ điều hành Android, iOS. Người dùng có thể thao tác chỉnh góc xoay, thiết lập cài đặt và theo dõi video ghi được từ camera một cách tiện lợi qua ứng dụng Imou Life.\r\n\r\nCamera có khả năng chia sẻ hình ảnh với nhiều người dùng khác nhau, nếu bạn không đăng ký dịch vụ đám mây Imou Protect, bạn có thể chia sẻ camera với tối đa 6 người. Nếu bạn đăng ký gói Basic của Imou Protect, bạn có thể chia sẻ camera với tối đa 10 người. Và với gói Plus, bạn có thể chia sẻ camera cho tối đa 20 người.\r\n\r\nCamera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR - Điều khiển camera qua ứng dụng\r\n\r\nNhìn chung, camera IP 360 Độ 3MP IMOU RANGER RC GK2CP-3C0WR có thiết kế nhỏ gọn, dễ lắp đặt, cùng nhiều tính năng quan sát thông minh. Sản phẩm hứa hẹn đem đến cho bạn nhiều trải nghiệm sử dụng tuyệt vời.', NULL, NULL, NULL, '650000', NULL, '2024-04-05 13:41:35', '2024-04-29 04:56:12'),
(23, 'Camera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N', 'camera-ip-ngoai-troi-360-do-3mp-tiandy-tc-h333n', 11, 5, 'camera-ip-ngoai-troi-360-do-3mp-tiandy-tc-h333n-thumb-1-600x60097.jpg', 1, 'Camera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N sở hữu thiết kế thanh lịch với nhiều tính năng nổi bật như báo động âm thanh, gửi thông báo đến điện thoại, phát hiện và theo dõi người khi có chuyển động,... hỗ trợ theo dõi, bảo vệ an toàn không gian sống cho người dùng và gia đình.\r\nThiết kế nhỏ gọn, khối lượng nhẹ\r\nCamera có kiểu dáng nhỏ gọn cùng khối lượng nhẹ chỉ 0.47 kg, lớp vỏ được làm từ chất liệu nhựa cứng cáp, giúp bảo vệ linh kiện bên trong, tránh hư hỏng camera trong quá trình sử dụng.\r\n\r\nCamera có khả năng chống nước, bụi chuẩn IP66, với nhiệt độ hoạt động từ - 30°C - 60°C, độ ẩm dưới 95%, dễ dàng lắp đặt cho mọi không gian bên ngoài mà không lo hư hỏng do ảnh hưởng của thời tiết.\r\n\r\nCamera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N - Thiết kế gọn nhẹ, dễ lắp đặt\r\n\r\nChất lượng hình ảnh, video sắc nét, rõ ràng\r\nVới camera TIANDY, người dùng có thể yên tâm về chất lượng hình ảnh và video, bởi camera có độ phân giải cao lên đến 3 MP (2304 x 1296 pixels), cho khả năng hiển thị luôn sắc nét, rõ ràng. Tích hợp đèn LED trợ sáng cùng tầm nhìn xa hồng ngoại lên đến 50 m trong tối (quay đen trắng) và 15 m (quay có màu).\r\n\r\nCamera có thể xoay ngang 294 độ, xoay dọc 90 độ giúp quan sát bao quát không gian sống. Bên cạnh đó, người dùng còn có thể phóng to hay thu nhỏ video, hình ảnh mà không lo mờ, nhòe.\r\n\r\nCamera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N - Camera sắc nét, hình ảnh chân thực\r\n\r\nTrang bị nhiều tiện ích thông minh, tiên tiến\r\nKhông chỉ có khả năng ghi hình sắc nét, camera còn được tích hợp nhiều tính năng thông minh, hỗ trợ quan sát, bảo vệ ngôi nhà của bạn một cách tốt nhất.\r\n\r\nVới tính năng báo động âm thanh bất thường, giúp phát ra âm thanh cảnh báo khi có biểu hiện đáng ngờ xuất hiện trong khu vực quan sát như tiếng la hét, tiếng mở cửa, đập phá,... cho người dùng kịp thời phản ứng và xử lý.\r\n\r\nCamera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N - Báo động thông minh khi phát hiện âm thanh lạ\r\n\r\nĐặc biệt, camera còn có tính năng phát hiện chuyển động thông minh và theo dõi chuyển động, giúp camera nhận diện và theo dõi vật thể hay người di chuyển trong khu vực quan sát. Đồng thời, người dùng còn có thể giao tiếp với thành viên trong gia đình hay người đứng gần camera bằng loa và micro tích hợp một cách dễ dàng.\r\n\r\nBên cạnh đó, bạn còn có thể chọn khu vực quan sát cụ thể, như cửa ra vào, lối đi,... bằng cách thao tác chọn vùng trên màn hình điện thoại, máy tính bảng,...\r\n\r\nKhi có người hay bất cứ thứ gì đi vào khu vực, thì camera sẽ báo động và gửi thông báo đến điện thoại của bạn.\r\n\r\nCamera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N - Phát hiện và theo dõi chuyển động thông minh\r\n\r\nKhông cần lo lắng hình ảnh cá nhân của bạn bị ghi lại, bởi camera tích hợp chế độ riêng tư, chế độ này sẽ tắt camera, cho bạn tận hưởng không gian với gia đình, bạn bè một cách thoải mái, trọn vẹn.\r\n\r\nCamera có hỗ trợ chống sét trực tiếp 6000V và chống sét lan truyền 2000V, người dùng có thể yên tâm sử dụng mà không lo ảnh hưởng của thời tiết hay các tác động khác từ thiên nhiên.\r\n\r\nCamera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N - Chống sét lan truyền hiệu quả\r\n\r\nBộ nhớ rộng rãi, lưu trữ lên đến 30 ngày\r\nNgười dùng có thể mua thêm thẻ nhớ MicroSD (tối đa 512 GB) gắn vào camera ngoài trời, hỗ trợ lưu trữ video lên tới 30 ngày, giúp xem lại video, hình ảnh khi cần thiết.\r\n\r\nCamera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N - Hỗ trợ lưu trữ lâu dài\r\n\r\nKết nối linh hoạt với nhiều thiết bị\r\nDễ dàng kết nối camera với nhiều thiết bị như máy tính, điện thoại, máy tính bảng,... có hệ điều hành Windows 7 trở lên, macOS X 11 trở lên, iOS, Android 5.0 trở lên.\r\n\r\nBên cạnh đó, bạn còn có 2 tùy chọn kết nối mạng với camera, qua cổng LAN hoặc wifi (băng tần 2.4 Ghz). Người dùng còn có thể chia sẻ quyền truy cập camera của mình cho các thành viên trong gia đình bằng cách đăng nhập tài khoản, quét mã QR hoặc chia sẻ mã QR cực tiện lợi.\r\n\r\nCamera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N - Dễ dàng kết nối với nhiều thiết bị\r\n\r\nỨng dụng điều khiển thông minh, giao diện đơn giản, dễ thao tác\r\nVới ứng dụng EasyLive Lite hoặc ứng dụng Easy7 Smart Client là bạn có thể tùy chỉnh các cài đặt và chức năng của camera như âm báo, độ sáng tối,... và nhiều tiện ích khác một cách đơn giản. Ngoài ra, ứng dụng có hỗ trợ tiếng Việt, dễ dàng sử dụng cho cả người lớn tuổi.\r\n\r\nCamera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N - Dễ dàng điều khiển camera thông qua ứng dụng\r\n\r\nTóm lại, camera IP Ngoài Trời 360 Độ 3MP TIANDY TC-H333N sở hữu thiết kế đơn giản cùng nhiều tính năng thông minh, hỗ trợ người dùng giám sát không gian sống, bảo vệ an toàn cho gia đình, người thân một cách tốt nhất.', NULL, NULL, NULL, '790000', NULL, '2024-04-05 13:43:08', '2024-04-29 05:13:41'),
(25, 'sạc điện thoại abc', 'sac-dien-thoai-abc', 11, 1, 'avatar5.jpg', 1, 'abc', NULL, NULL, NULL, '790000', NULL, NULL, '2024-05-06 17:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_taikhoan`
--

CREATE TABLE `tbl_taikhoan` (
  `MaTaiKhoan` int NOT NULL,
  `Email` varchar(50) NOT NULL,
  `TenTaiKhoan` varchar(50) DEFAULT NULL,
  `SoDienThoai` int NOT NULL,
  `MatKhau` varchar(50) NOT NULL,
  `HinhAnh` varchar(50) DEFAULT NULL,
  `TrangThai` int DEFAULT NULL,
  `BacNguoiDung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_taikhoan`
--

INSERT INTO `tbl_taikhoan` (`MaTaiKhoan`, `Email`, `TenTaiKhoan`, `SoDienThoai`, `MatKhau`, `HinhAnh`, `TrangThai`, `BacNguoiDung`, `ThoiGianTao`, `ThoiGianSua`) VALUES
(1, 'admin@gmail.com', 'admin ', 123456789, '123456', NULL, 1, '', NULL, NULL),
(2, 'binhUser@gmail.com', 'binh', 122233221, 'e10adc3949ba59abbe56e057f20f883e', NULL, 1, '', '2024-04-02 07:01:52', NULL),
(3, 'buiphuonglinh@gmail.com', 'Bùi Phương Linh', 111222333, 'e10adc3949ba59abbe56e057f20f883e', NULL, 1, '', '2024-04-02 07:24:31', NULL),
(4, 'dominhquang@gmail.com', 'Đỗ Minh Quang', 998887777, '123456', NULL, 0, '', '2024-04-02 07:25:25', NULL),
(5, 'VuMinhQuang@gmail.com', 'Vũ Minh Quang', 1999888777, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL),
(6, 'abc@gmail.com', 'abc', 1233344556, 'e10adc3949ba59abbe56e057f20f883e', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thanhtruot`
--

CREATE TABLE `tbl_thanhtruot` (
  `MaThanhTruot` int NOT NULL,
  `MaCTGG` int NOT NULL,
  `SlugThanhTruot` varchar(50) NOT NULL,
  `HinhAnh` varchar(50) NOT NULL,
  `MoTa` text NOT NULL,
  `TrangThai` int NOT NULL,
  `ThoiGianTao` timestamp NOT NULL,
  `ThoiGianSua` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thongsokythuat`
--

CREATE TABLE `tbl_thongsokythuat` (
  `MaTSKT` int NOT NULL,
  `TenTSKT` varchar(50) NOT NULL,
  `MaDMTSKT` int DEFAULT NULL,
  `TrangThai` int NOT NULL,
  `SlugTSKT` varchar(50) NOT NULL,
  `MoTa` text,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_thongsokythuat`
--

INSERT INTO `tbl_thongsokythuat` (`MaTSKT`, `TenTSKT`, `MaDMTSKT`, `TrangThai`, `SlugTSKT`, `MoTa`, `ThoiGianTao`, `ThoiGianSua`) VALUES
(1, '48 inch', 7, 1, '48-inch', 'Tivi có khích cỡ 32 inch', '2024-05-06 13:02:27', '2024-05-06 13:47:32'),
(2, '40 inch', 7, 1, '40-inch', 'Tivi có kích cỡ màn hành là 40 inch', '2024-05-06 13:10:19', NULL),
(4, '42 inch', 7, 1, '42-inch', 'Kích cỡ màn hình tivi là 42 inch', '2024-05-06 13:12:49', NULL),
(5, '43 inch', 7, 1, '43-inch', 'Kích cỡ 43 inch của màn hành tivi', '2024-05-06 13:14:24', NULL),
(6, '60 inch', 7, 1, '60-inch', 'Tivi có kích cỡ màn hình 60 inch', '2024-05-06 13:52:04', NULL),
(7, 'Full HD', 6, 1, 'full-hd', 'Độ phân giải của tivi', '2024-05-06 13:53:20', NULL),
(8, 'HD', 6, 1, 'hd', 'Độ phân giải Tivi là HD', '2024-05-06 13:53:46', NULL),
(9, '4K', 6, 1, '4k', 'Độ phân giải của tivi là 4k', '2024-05-06 13:54:20', NULL),
(10, '8K', 6, 1, '8k', 'Độ phân giải tivi là 8K', '2024-05-06 13:55:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thongsokythuatsp`
--

CREATE TABLE `tbl_thongsokythuatsp` (
  `MaTSKTSP` int NOT NULL,
  `MaSanPham` int NOT NULL,
  `MaTSKT` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thuonghieu`
--

CREATE TABLE `tbl_thuonghieu` (
  `MaThuongHieu` int NOT NULL,
  `TenThuongHieu` varchar(50) DEFAULT NULL,
  `SlugThuongHieu` varchar(50) DEFAULT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `TrangThai` int DEFAULT NULL,
  `MoTa` text,
  `ThoiGianTao` timestamp NULL DEFAULT NULL,
  `ThoiGianSua` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_thuonghieu`
--

INSERT INTO `tbl_thuonghieu` (`MaThuongHieu`, `TenThuongHieu`, `SlugThuongHieu`, `HinhAnh`, `TrangThai`, `MoTa`, `ThoiGianTao`, `ThoiGianSua`) VALUES
(2, 'Apple', 'Apple', 'apple93.png', 1, 'Apple (hoặc Apple Inc.) là một công ty công nghệ đa quốc gia có trụ sở tại Cupertino, California, Hoa Kỳ. Được thành lập vào ngày 1 tháng 4 năm 1976 bởi Steve Jobs, Steve Wozniak và Ronald Wayne. Apple đã trở thành một trong những công ty công nghệ lớn trên toàn thế giới, nổi tiếng với việc sản xuất và phân phối các sản phẩm công nghệ như iPhone, Mac, iPad, Apple Watch và các dịch vụ như App Store, iTunes và Apple Music.', NULL, NULL),
(4, 'Dell', 'dell', 'Dell66.png', 1, 'Dell bán các sản phẩm như máy tính cá nhân (PC), máy chủ, thiết bị lưu trữ dữ liệu, bộ chuyển mạng, phần mềm máy tính, thiết bị ngoại vi máy tính, HDTV, máy ảnh, máy in và điện tử được sản xuất bởi các nhà sản xuất khác.', NULL, NULL),
(5, 'Lenovo', 'lenovo', 'Lenovo54.png', 1, 'Lenovo Group Ltd. /lɛnˈoʊvoʊ/ là tập đoàn đa quốc gia về công nghệ máy tính có trụ sở chính ở Bắc Kinh, Trung Quốc và Morrisville, Bắc Carolina, Mỹ.[2] Tập đoàn thiết kế, phát triển, sản xuất và bán các sản phẩm như máy tính cá nhân, máy tính bảng, smartphone, các trạm máy tính, server, thiết bị lưu trữ điện tử, phần mềm quản trị IT và ti vi thông minh.', NULL, NULL),
(7, 'Asus', 'Asus', 'Asus57.png', 1, 'Asus là gì ai biết', NULL, '2024-03-31 04:49:51'),
(8, 'Samsung', 'samsung', 'Samsung7.png', 1, 'Samsung là một danh hiệu lắm', '2024-04-01 07:16:29', NULL),
(9, 'Acer', 'acer', 'Acer89.png', 1, 'acer', '2024-04-01 08:08:46', NULL),
(10, 'Mitsubishi', 'mitubishi', 'Mitsubishi30.png', 1, 'Công ty Mitsubishi đầu tiên là một công ty chuyển hàng thành lập bởi Iwasaki Yatarō vào năm 1870. Năm 1873, tên công ty được đổi thành Mitsubishi Shoukai (三菱商会: Tam Lăng thương hội). Tên Mitsubishi (三菱 (Tam Lăng)?) có nghĩa là \"3 củ ấu\", loại củ có hai đầu nhọn. Từ nguồn gốc đó mà Mitsubishi xếp ba củ ấu cách điệu làm biểu tượng (logo) cho hãng.\r\nCông ty chuyển sang lĩnh vực khai thác than năm 1881 sau khi mua mỏ than Takashima [1] và đảo Hashima năm 1890, sử dụng sản phẩm làm nguyên liệu cho đội tàu thủy hơi nước. Công ty cũng bắt đầu đa dạng hóa kinh doanh sang các lĩnh vực đóng tàu, bảo hiểm, xếp gỡ hàng và thương mại. Sau này sự đa dạng hóa được tiếp tục với việc Mitsubishi xâm nhập thêm vào các lĩnh vực khác như sản xuất giấy, thép, thủy tinh, hàng điện tử, tàu sân bay, khai thác dầu mỏ và bất động sản. Khi Mitsubishi xây dựng thành một nghiệp đoàn lớn, nó đóng vai trò quan trọng trong quá trình hiện đại hóa công nghiệp Nhật Bản.', '2024-04-01 08:09:23', '2024-04-28 05:40:36'),
(11, 'Sony', 'sony', 'sony80.png', 0, 'Công ty công nghiệp Sony (ソニーグループ株式会社 (Sonī Gurūpu Chu Thức Hội Xã) Sonī Gurūpu kabushiki gaisha?, tiếng Anh: Sony Corporation), cách điệu SONY, là một tập đoàn đa quốc gia của Nhật Bản, với trụ sở chính nằm tại Minato, Tokyo, Nhật Bản, và là tập đoàn điện tử đứng thứ 5 thế giới với 81,64 tỉ USD (2011). Sony là một trong những công ty hàng đầu thế giới về điện tử, sản xuất tivi, điện thoại, máy ảnh, máy tính xách tay và đồ dân dụng khác.\r\nĐược thành lập vào tháng 5/1946 tại Nihonbashi, Chūō, Tokyo, được mang tên là Tokyo Tsushin Kogyo K.K (東京通信工業株式会社, Đông Kinh Thông tin Công nghiệp Chu Thức Hội Xã) với số vốn ban đầu là 190.000 yên. Công ty này đổi tên thành Sony vào tháng 1/1958.\r\nTừ \"Sony\" là kết hợp của từ \"sonus\" trong tiếng La-tinh (âm thanh) và từ \"sonny\" trong tiếng Anh (cậu bé nhanh nhẹn thông minh) theo cách gọi tên thân mật. Những nhà sáng lập hy vọng tên \"Sony\" thể hiện tinh thần nhiệt huyết và sáng tạo của giới trẻ.', '2024-04-01 08:09:46', '2024-04-28 05:37:00'),
(12, 'Toshiba', 'toshiba', 'TOSHIBA_Logo98.png', 0, 'Toshiba được thành lập vào năm 1939 dưới tên Tokyo Shibaura Electric K.K. qua sự hợp nhất của Shibaura Seisaku-sho (thành lập năm 1875) và Tokyo Denki (thành lập năm 1890). Tên tập đoàn đã được chình thức thay đổi sang Toshiba Corporation vào năm 1978.\r\nToshiba được tổ chức thành bốn nhóm thương mại chính: Nhóm Sản Phẩm Số, Nhóm Thiết Bị Điện Tử, Nhóm Đồ Dùng Gia Dụng và Nhóm Cơ Sở Hạ Tầng Xã hội. Vào năm 2010, Toshiba là công ty máy tính cá nhân lớn thứ năm thế giới về doanh thu (xếp phía sau Hewlett-Packard, Dell, Acer và Lenovo). Vào cùng năm, nó cũng là công ty sản xuất chất bán dẫn lớn thứ tư thế giới về doanh thu (xếp phía sau Intel Corporation, Samsung và Texas Instruments).', '2024-04-28 05:31:44', '2024-04-28 05:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_thuonghieudanhmuc`
--

CREATE TABLE `tbl_thuonghieudanhmuc` (
  `MaTHDM` int NOT NULL,
  `MaThuongHieu` int NOT NULL,
  `MaDanhMuc` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_thuonghieudanhmuc`
--

INSERT INTO `tbl_thuonghieudanhmuc` (`MaTHDM`, `MaThuongHieu`, `MaDanhMuc`) VALUES
(1, 8, 1),
(2, 4, 5),
(3, 7, 2),
(4, 11, 1),
(5, 10, 12),
(6, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tichdiem`
--

CREATE TABLE `tbl_tichdiem` (
  `MaTichDiem` int NOT NULL,
  `MaTaiKhoan` int NOT NULL,
  `TongDiem` int NOT NULL,
  `SoLuongDonHang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tinhthanhpho`
--

CREATE TABLE `tbl_tinhthanhpho` (
  `MaThanhPho` int NOT NULL,
  `TenThanhPho` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_xaphuongthitran`
--

CREATE TABLE `tbl_xaphuongthitran` (
  `MaXaPhuong` int NOT NULL,
  `TenXaPhuong` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `type` varchar(30) NOT NULL,
  `MaQuyenHuyen` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  ADD PRIMARY KEY (`MaBaiViet`),
  ADD KEY `MaDanhMucBV` (`MaDanhMucBV`);

--
-- Indexes for table `tbl_baocaodoanhthu`
--
ALTER TABLE `tbl_baocaodoanhthu`
  ADD PRIMARY KEY (`MaBCDT`),
  ADD UNIQUE KEY `MaLienKet` (`MaLienKet`);

--
-- Indexes for table `tbl_binhluan`
--
ALTER TABLE `tbl_binhluan`
  ADD PRIMARY KEY (`MaBinhLuan`),
  ADD KEY `MaSanPham` (`MaSanPham`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Indexes for table `tbl_chitietbaocaodoanhthu`
--
ALTER TABLE `tbl_chitietbaocaodoanhthu`
  ADD PRIMARY KEY (`MaCTBCDT`),
  ADD KEY `MaSanPham` (`MaSanPham`),
  ADD KEY `MaLienKet` (`MaLienKet`);

--
-- Indexes for table `tbl_chitietdonhang`
--
ALTER TABLE `tbl_chitietdonhang`
  ADD PRIMARY KEY (`MaCTDH`),
  ADD KEY `MaSanPham` (`MaSanPham`),
  ADD KEY `order_code` (`order_code`);

--
-- Indexes for table `tbl_chitiethoadon`
--
ALTER TABLE `tbl_chitiethoadon`
  ADD PRIMARY KEY (`MaCTHD`),
  ADD KEY `order_code` (`order_code`);

--
-- Indexes for table `tbl_chitietlichsubaohanh`
--
ALTER TABLE `tbl_chitietlichsubaohanh`
  ADD KEY `MaSanPham` (`MaSanPham`);

--
-- Indexes for table `tbl_chitietphieubaohanh`
--
ALTER TABLE `tbl_chitietphieubaohanh`
  ADD PRIMARY KEY (`MaCTPBH`),
  ADD KEY `order_code` (`order_code`);

--
-- Indexes for table `tbl_chitietphieukiemkho`
--
ALTER TABLE `tbl_chitietphieukiemkho`
  ADD KEY `order_code` (`order_code`);

--
-- Indexes for table `tbl_chitietphieunhap`
--
ALTER TABLE `tbl_chitietphieunhap`
  ADD KEY `MaSanPham` (`MaSanPham`),
  ADD KEY `order_code` (`order_code`);

--
-- Indexes for table `tbl_chitietphieutrahang`
--
ALTER TABLE `tbl_chitietphieutrahang`
  ADD PRIMARY KEY (`MaCTPTH`),
  ADD KEY `MaSanPham` (`MaSanPham`),
  ADD KEY `order_code` (`order_code`);

--
-- Indexes for table `tbl_chitietphieuxuat`
--
ALTER TABLE `tbl_chitietphieuxuat`
  ADD PRIMARY KEY (`MaCTPX`),
  ADD KEY `order_code` (`order_code`);

--
-- Indexes for table `tbl_chuongtrinhgiamgia`
--
ALTER TABLE `tbl_chuongtrinhgiamgia`
  ADD PRIMARY KEY (`MaCTGG`),
  ADD UNIQUE KEY `SlugCTGG` (`SlugCTGG`);

--
-- Indexes for table `tbl_chuongtrinhgiamgiasp`
--
ALTER TABLE `tbl_chuongtrinhgiamgiasp`
  ADD PRIMARY KEY (`MaCTGGSP`),
  ADD KEY `MaCTGG` (`MaCTGG`),
  ADD KEY `MaSanPham` (`MaSanPham`);

--
-- Indexes for table `tbl_danhgia`
--
ALTER TABLE `tbl_danhgia`
  ADD PRIMARY KEY (`MaDanhGia`),
  ADD KEY `MaSanPham` (`MaSanPham`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`),
  ADD KEY `MaDonHang` (`MaDonHang`);

--
-- Indexes for table `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  ADD PRIMARY KEY (`MaDanhMuc`),
  ADD UNIQUE KEY `SlugDanhMuc` (`SlugDanhMuc`);

--
-- Indexes for table `tbl_danhmucbaiviet`
--
ALTER TABLE `tbl_danhmucbaiviet`
  ADD PRIMARY KEY (`MaDanhMucBV`);

--
-- Indexes for table `tbl_danhmuctskt`
--
ALTER TABLE `tbl_danhmuctskt`
  ADD PRIMARY KEY (`MaDMTSKT`),
  ADD KEY `MaDanhMuc` (`MaDanhMuc`);

--
-- Indexes for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD PRIMARY KEY (`MaDonHang`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `MaGiamGia` (`MaGiamGia`),
  ADD KEY `MaGiaoHang` (`MaGiaoHang`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Indexes for table `tbl_giaohang`
--
ALTER TABLE `tbl_giaohang`
  ADD PRIMARY KEY (`MaGiaoHang`);

--
-- Indexes for table `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  ADD PRIMARY KEY (`MaHoaDon`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `MaGiamGia` (`MaGiamGia`),
  ADD KEY `MaDonHang` (`MaDonHang`);

--
-- Indexes for table `tbl_lichsubaohanh`
--
ALTER TABLE `tbl_lichsubaohanh`
  ADD PRIMARY KEY (`MaLSBH`),
  ADD UNIQUE KEY `MaLienKet` (`MaLienKet`),
  ADD KEY `MaPhieuBaoHanh` (`MaPhieuBaoHanh`);

--
-- Indexes for table `tbl_magiamgia`
--
ALTER TABLE `tbl_magiamgia`
  ADD PRIMARY KEY (`MaGiamGia`);

--
-- Indexes for table `tbl_magiamgiannguoidung`
--
ALTER TABLE `tbl_magiamgiannguoidung`
  ADD PRIMARY KEY (`MaGGND`),
  ADD KEY `MaGiamGia` (`MaGiamGia`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Indexes for table `tbl_nhacungcap`
--
ALTER TABLE `tbl_nhacungcap`
  ADD PRIMARY KEY (`MaNhaCungCap`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `tbl_phanquyennguoidung`
--
ALTER TABLE `tbl_phanquyennguoidung`
  ADD PRIMARY KEY (`MaPQND`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`),
  ADD KEY `MaPhanQuyen` (`MaPhanQuyen`);

--
-- Indexes for table `tbl_phieubaohanh`
--
ALTER TABLE `tbl_phieubaohanh`
  ADD PRIMARY KEY (`MaPhieuBaoHanh`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `MaDonHang` (`MaDonHang`);

--
-- Indexes for table `tbl_phieukiemkho`
--
ALTER TABLE `tbl_phieukiemkho`
  ADD PRIMARY KEY (`MaPKK`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Indexes for table `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  ADD PRIMARY KEY (`MaPhieuNhap`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `MaNhaCungCap` (`MaNhaCungCap`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Indexes for table `tbl_phieutrahang`
--
ALTER TABLE `tbl_phieutrahang`
  ADD PRIMARY KEY (`MaPhieuTraHang`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD KEY `MaNhaCungCap` (`MaNhaCungCap`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Indexes for table `tbl_phieuxuat`
--
ALTER TABLE `tbl_phieuxuat`
  ADD PRIMARY KEY (`MaPhieuXuat`),
  ADD UNIQUE KEY `order_code` (`order_code`),
  ADD UNIQUE KEY `order_code_2` (`order_code`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Indexes for table `tbl_phigiaohang`
--
ALTER TABLE `tbl_phigiaohang`
  ADD PRIMARY KEY (`MaTienGiaoHang`),
  ADD KEY `MaThanhPho` (`MaThanhPho`),
  ADD KEY `MaQuanHuyen` (`MaQuanHuyen`),
  ADD KEY `MaXaPhuong` (`MaXaPhuong`);

--
-- Indexes for table `tbl_quanhuyen`
--
ALTER TABLE `tbl_quanhuyen`
  ADD PRIMARY KEY (`MaQuyenHuyen`),
  ADD KEY `matp` (`MaThanhPho`);

--
-- Indexes for table `tbl_quyen`
--
ALTER TABLE `tbl_quyen`
  ADD PRIMARY KEY (`MaPhanQuyen`);

--
-- Indexes for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD PRIMARY KEY (`MaSanPham`),
  ADD UNIQUE KEY `SlugSanPham` (`SlugSanPham`),
  ADD KEY `MaDanhMuc` (`MaDanhMuc`),
  ADD KEY `MaThuongHieu` (`MaThuongHieu`);

--
-- Indexes for table `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  ADD PRIMARY KEY (`MaTaiKhoan`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `tbl_thanhtruot`
--
ALTER TABLE `tbl_thanhtruot`
  ADD PRIMARY KEY (`MaThanhTruot`),
  ADD UNIQUE KEY `SlugThanhTruot` (`SlugThanhTruot`),
  ADD KEY `MaCTGG` (`MaCTGG`);

--
-- Indexes for table `tbl_thongsokythuat`
--
ALTER TABLE `tbl_thongsokythuat`
  ADD PRIMARY KEY (`MaTSKT`),
  ADD KEY `MaDMTSKT` (`MaDMTSKT`);

--
-- Indexes for table `tbl_thongsokythuatsp`
--
ALTER TABLE `tbl_thongsokythuatsp`
  ADD KEY `MaSanPham` (`MaSanPham`),
  ADD KEY `MaTSKT` (`MaTSKT`);

--
-- Indexes for table `tbl_thuonghieu`
--
ALTER TABLE `tbl_thuonghieu`
  ADD PRIMARY KEY (`MaThuongHieu`),
  ADD UNIQUE KEY `SlugThuongHieu` (`SlugThuongHieu`);

--
-- Indexes for table `tbl_thuonghieudanhmuc`
--
ALTER TABLE `tbl_thuonghieudanhmuc`
  ADD PRIMARY KEY (`MaTHDM`),
  ADD KEY `MaDanhMuc` (`MaDanhMuc`),
  ADD KEY `MaThuongHieu` (`MaThuongHieu`);

--
-- Indexes for table `tbl_tichdiem`
--
ALTER TABLE `tbl_tichdiem`
  ADD PRIMARY KEY (`MaTichDiem`),
  ADD KEY `MaTaiKhoan` (`MaTaiKhoan`);

--
-- Indexes for table `tbl_tinhthanhpho`
--
ALTER TABLE `tbl_tinhthanhpho`
  ADD PRIMARY KEY (`MaThanhPho`);

--
-- Indexes for table `tbl_xaphuongthitran`
--
ALTER TABLE `tbl_xaphuongthitran`
  ADD PRIMARY KEY (`MaXaPhuong`),
  ADD KEY `maqh` (`MaQuyenHuyen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  MODIFY `MaBaiViet` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_baocaodoanhthu`
--
ALTER TABLE `tbl_baocaodoanhthu`
  MODIFY `MaBCDT` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_binhluan`
--
ALTER TABLE `tbl_binhluan`
  MODIFY `MaBinhLuan` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chitietbaocaodoanhthu`
--
ALTER TABLE `tbl_chitietbaocaodoanhthu`
  MODIFY `MaCTBCDT` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chitietdonhang`
--
ALTER TABLE `tbl_chitietdonhang`
  MODIFY `MaCTDH` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chitiethoadon`
--
ALTER TABLE `tbl_chitiethoadon`
  MODIFY `MaCTHD` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chitietphieubaohanh`
--
ALTER TABLE `tbl_chitietphieubaohanh`
  MODIFY `MaCTPBH` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chitietphieutrahang`
--
ALTER TABLE `tbl_chitietphieutrahang`
  MODIFY `MaCTPTH` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chitietphieuxuat`
--
ALTER TABLE `tbl_chitietphieuxuat`
  MODIFY `MaCTPX` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chuongtrinhgiamgia`
--
ALTER TABLE `tbl_chuongtrinhgiamgia`
  MODIFY `MaCTGG` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_chuongtrinhgiamgiasp`
--
ALTER TABLE `tbl_chuongtrinhgiamgiasp`
  MODIFY `MaCTGGSP` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_danhgia`
--
ALTER TABLE `tbl_danhgia`
  MODIFY `MaDanhGia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_danhmuc`
--
ALTER TABLE `tbl_danhmuc`
  MODIFY `MaDanhMuc` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_danhmucbaiviet`
--
ALTER TABLE `tbl_danhmucbaiviet`
  MODIFY `MaDanhMucBV` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_danhmuctskt`
--
ALTER TABLE `tbl_danhmuctskt`
  MODIFY `MaDMTSKT` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  MODIFY `MaDonHang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_giaohang`
--
ALTER TABLE `tbl_giaohang`
  MODIFY `MaGiaoHang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  MODIFY `MaHoaDon` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_magiamgia`
--
ALTER TABLE `tbl_magiamgia`
  MODIFY `MaGiamGia` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_magiamgiannguoidung`
--
ALTER TABLE `tbl_magiamgiannguoidung`
  MODIFY `MaGGND` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_nhacungcap`
--
ALTER TABLE `tbl_nhacungcap`
  MODIFY `MaNhaCungCap` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_phanquyennguoidung`
--
ALTER TABLE `tbl_phanquyennguoidung`
  MODIFY `MaPQND` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_phieubaohanh`
--
ALTER TABLE `tbl_phieubaohanh`
  MODIFY `MaPhieuBaoHanh` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_phieukiemkho`
--
ALTER TABLE `tbl_phieukiemkho`
  MODIFY `MaPKK` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  MODIFY `MaPhieuNhap` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_phieutrahang`
--
ALTER TABLE `tbl_phieutrahang`
  MODIFY `MaPhieuTraHang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_phieuxuat`
--
ALTER TABLE `tbl_phieuxuat`
  MODIFY `MaPhieuXuat` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_phigiaohang`
--
ALTER TABLE `tbl_phigiaohang`
  MODIFY `MaTienGiaoHang` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quanhuyen`
--
ALTER TABLE `tbl_quanhuyen`
  MODIFY `MaQuyenHuyen` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quyen`
--
ALTER TABLE `tbl_quyen`
  MODIFY `MaPhanQuyen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  MODIFY `MaSanPham` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_taikhoan`
--
ALTER TABLE `tbl_taikhoan`
  MODIFY `MaTaiKhoan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_thanhtruot`
--
ALTER TABLE `tbl_thanhtruot`
  MODIFY `MaThanhTruot` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_thongsokythuat`
--
ALTER TABLE `tbl_thongsokythuat`
  MODIFY `MaTSKT` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_thuonghieu`
--
ALTER TABLE `tbl_thuonghieu`
  MODIFY `MaThuongHieu` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_thuonghieudanhmuc`
--
ALTER TABLE `tbl_thuonghieudanhmuc`
  MODIFY `MaTHDM` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_tichdiem`
--
ALTER TABLE `tbl_tichdiem`
  MODIFY `MaTichDiem` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tinhthanhpho`
--
ALTER TABLE `tbl_tinhthanhpho`
  MODIFY `MaThanhPho` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_xaphuongthitran`
--
ALTER TABLE `tbl_xaphuongthitran`
  MODIFY `MaXaPhuong` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_baiviet`
--
ALTER TABLE `tbl_baiviet`
  ADD CONSTRAINT `tbl_baiviet_ibfk_1` FOREIGN KEY (`MaDanhMucBV`) REFERENCES `tbl_danhmucbaiviet` (`MaDanhMucBV`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_binhluan`
--
ALTER TABLE `tbl_binhluan`
  ADD CONSTRAINT `tbl_binhluan_ibfk_1` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_binhluan_ibfk_2` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitietbaocaodoanhthu`
--
ALTER TABLE `tbl_chitietbaocaodoanhthu`
  ADD CONSTRAINT `tbl_chitietbaocaodoanhthu_ibfk_1` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_chitietbaocaodoanhthu_ibfk_2` FOREIGN KEY (`MaLienKet`) REFERENCES `tbl_baocaodoanhthu` (`MaLienKet`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitietdonhang`
--
ALTER TABLE `tbl_chitietdonhang`
  ADD CONSTRAINT `tbl_chitietdonhang_ibfk_1` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_chitietdonhang_ibfk_2` FOREIGN KEY (`order_code`) REFERENCES `tbl_donhang` (`order_code`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitiethoadon`
--
ALTER TABLE `tbl_chitiethoadon`
  ADD CONSTRAINT `tbl_chitiethoadon_ibfk_1` FOREIGN KEY (`order_code`) REFERENCES `tbl_hoadon` (`order_code`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitietlichsubaohanh`
--
ALTER TABLE `tbl_chitietlichsubaohanh`
  ADD CONSTRAINT `tbl_chitietlichsubaohanh_ibfk_1` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitietphieubaohanh`
--
ALTER TABLE `tbl_chitietphieubaohanh`
  ADD CONSTRAINT `tbl_chitietphieubaohanh_ibfk_1` FOREIGN KEY (`order_code`) REFERENCES `tbl_phieubaohanh` (`order_code`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitietphieukiemkho`
--
ALTER TABLE `tbl_chitietphieukiemkho`
  ADD CONSTRAINT `tbl_chitietphieukiemkho_ibfk_1` FOREIGN KEY (`order_code`) REFERENCES `tbl_phieukiemkho` (`order_code`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitietphieunhap`
--
ALTER TABLE `tbl_chitietphieunhap`
  ADD CONSTRAINT `tbl_chitietphieunhap_ibfk_1` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_chitietphieunhap_ibfk_2` FOREIGN KEY (`order_code`) REFERENCES `tbl_phieunhap` (`order_code`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitietphieutrahang`
--
ALTER TABLE `tbl_chitietphieutrahang`
  ADD CONSTRAINT `tbl_chitietphieutrahang_ibfk_1` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_chitietphieutrahang_ibfk_2` FOREIGN KEY (`order_code`) REFERENCES `tbl_phieutrahang` (`order_code`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chitietphieuxuat`
--
ALTER TABLE `tbl_chitietphieuxuat`
  ADD CONSTRAINT `tbl_chitietphieuxuat_ibfk_1` FOREIGN KEY (`order_code`) REFERENCES `tbl_phieuxuat` (`order_code`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_chuongtrinhgiamgiasp`
--
ALTER TABLE `tbl_chuongtrinhgiamgiasp`
  ADD CONSTRAINT `tbl_chuongtrinhgiamgiasp_ibfk_1` FOREIGN KEY (`MaCTGG`) REFERENCES `tbl_chuongtrinhgiamgia` (`MaCTGG`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_chuongtrinhgiamgiasp_ibfk_2` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_danhgia`
--
ALTER TABLE `tbl_danhgia`
  ADD CONSTRAINT `tbl_danhgia_ibfk_1` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_danhgia_ibfk_2` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_danhgia_ibfk_3` FOREIGN KEY (`MaDonHang`) REFERENCES `tbl_donhang` (`MaDonHang`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_danhmuctskt`
--
ALTER TABLE `tbl_danhmuctskt`
  ADD CONSTRAINT `tbl_danhmuctskt_ibfk_1` FOREIGN KEY (`MaDanhMuc`) REFERENCES `tbl_danhmuc` (`MaDanhMuc`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_donhang`
--
ALTER TABLE `tbl_donhang`
  ADD CONSTRAINT `tbl_donhang_ibfk_1` FOREIGN KEY (`MaGiamGia`) REFERENCES `tbl_magiamgia` (`MaGiamGia`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_donhang_ibfk_2` FOREIGN KEY (`MaGiaoHang`) REFERENCES `tbl_giaohang` (`MaGiaoHang`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_donhang_ibfk_3` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_hoadon`
--
ALTER TABLE `tbl_hoadon`
  ADD CONSTRAINT `tbl_hoadon_ibfk_1` FOREIGN KEY (`MaGiamGia`) REFERENCES `tbl_magiamgia` (`MaGiamGia`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_hoadon_ibfk_2` FOREIGN KEY (`MaDonHang`) REFERENCES `tbl_donhang` (`MaDonHang`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_lichsubaohanh`
--
ALTER TABLE `tbl_lichsubaohanh`
  ADD CONSTRAINT `tbl_lichsubaohanh_ibfk_1` FOREIGN KEY (`MaPhieuBaoHanh`) REFERENCES `tbl_phieubaohanh` (`MaPhieuBaoHanh`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_magiamgiannguoidung`
--
ALTER TABLE `tbl_magiamgiannguoidung`
  ADD CONSTRAINT `tbl_magiamgiannguoidung_ibfk_1` FOREIGN KEY (`MaGiamGia`) REFERENCES `tbl_magiamgia` (`MaGiamGia`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_magiamgiannguoidung_ibfk_2` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_phanquyennguoidung`
--
ALTER TABLE `tbl_phanquyennguoidung`
  ADD CONSTRAINT `tbl_phanquyennguoidung_ibfk_1` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_phanquyennguoidung_ibfk_2` FOREIGN KEY (`MaPhanQuyen`) REFERENCES `tbl_quyen` (`MaPhanQuyen`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_phieubaohanh`
--
ALTER TABLE `tbl_phieubaohanh`
  ADD CONSTRAINT `tbl_phieubaohanh_ibfk_1` FOREIGN KEY (`MaDonHang`) REFERENCES `tbl_donhang` (`MaDonHang`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_phieukiemkho`
--
ALTER TABLE `tbl_phieukiemkho`
  ADD CONSTRAINT `tbl_phieukiemkho_ibfk_1` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_phieunhap`
--
ALTER TABLE `tbl_phieunhap`
  ADD CONSTRAINT `tbl_phieunhap_ibfk_1` FOREIGN KEY (`MaNhaCungCap`) REFERENCES `tbl_nhacungcap` (`MaNhaCungCap`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_phieunhap_ibfk_2` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_phieutrahang`
--
ALTER TABLE `tbl_phieutrahang`
  ADD CONSTRAINT `tbl_phieutrahang_ibfk_1` FOREIGN KEY (`MaNhaCungCap`) REFERENCES `tbl_nhacungcap` (`MaNhaCungCap`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_phieutrahang_ibfk_2` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_phieuxuat`
--
ALTER TABLE `tbl_phieuxuat`
  ADD CONSTRAINT `tbl_phieuxuat_ibfk_1` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_phigiaohang`
--
ALTER TABLE `tbl_phigiaohang`
  ADD CONSTRAINT `tbl_phigiaohang_ibfk_1` FOREIGN KEY (`MaThanhPho`) REFERENCES `tbl_tinhthanhpho` (`MaThanhPho`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_phigiaohang_ibfk_2` FOREIGN KEY (`MaQuanHuyen`) REFERENCES `tbl_quanhuyen` (`MaQuyenHuyen`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_phigiaohang_ibfk_3` FOREIGN KEY (`MaXaPhuong`) REFERENCES `tbl_xaphuongthitran` (`MaXaPhuong`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_quanhuyen`
--
ALTER TABLE `tbl_quanhuyen`
  ADD CONSTRAINT `tbl_quanhuyen_ibfk_1` FOREIGN KEY (`MaThanhPho`) REFERENCES `tbl_tinhthanhpho` (`MaThanhPho`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_sanpham`
--
ALTER TABLE `tbl_sanpham`
  ADD CONSTRAINT `tbl_sanpham_ibfk_1` FOREIGN KEY (`MaDanhMuc`) REFERENCES `tbl_danhmuc` (`MaDanhMuc`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_sanpham_ibfk_2` FOREIGN KEY (`MaThuongHieu`) REFERENCES `tbl_thuonghieu` (`MaThuongHieu`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_thanhtruot`
--
ALTER TABLE `tbl_thanhtruot`
  ADD CONSTRAINT `tbl_thanhtruot_ibfk_1` FOREIGN KEY (`MaCTGG`) REFERENCES `tbl_chuongtrinhgiamgia` (`MaCTGG`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_thongsokythuat`
--
ALTER TABLE `tbl_thongsokythuat`
  ADD CONSTRAINT `tbl_thongsokythuat_ibfk_1` FOREIGN KEY (`MaDMTSKT`) REFERENCES `tbl_danhmuctskt` (`MaDMTSKT`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_thongsokythuatsp`
--
ALTER TABLE `tbl_thongsokythuatsp`
  ADD CONSTRAINT `tbl_thongsokythuatsp_ibfk_1` FOREIGN KEY (`MaSanPham`) REFERENCES `tbl_sanpham` (`MaSanPham`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_thongsokythuatsp_ibfk_2` FOREIGN KEY (`MaTSKT`) REFERENCES `tbl_thongsokythuat` (`MaTSKT`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_thuonghieudanhmuc`
--
ALTER TABLE `tbl_thuonghieudanhmuc`
  ADD CONSTRAINT `tbl_thuonghieudanhmuc_ibfk_1` FOREIGN KEY (`MaDanhMuc`) REFERENCES `tbl_danhmuc` (`MaDanhMuc`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tbl_thuonghieudanhmuc_ibfk_2` FOREIGN KEY (`MaThuongHieu`) REFERENCES `tbl_thuonghieu` (`MaThuongHieu`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_tichdiem`
--
ALTER TABLE `tbl_tichdiem`
  ADD CONSTRAINT `tbl_tichdiem_ibfk_1` FOREIGN KEY (`MaTaiKhoan`) REFERENCES `tbl_taikhoan` (`MaTaiKhoan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_xaphuongthitran`
--
ALTER TABLE `tbl_xaphuongthitran`
  ADD CONSTRAINT `tbl_xaphuongthitran_ibfk_1` FOREIGN KEY (`MaQuyenHuyen`) REFERENCES `tbl_quyen` (`MaPhanQuyen`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

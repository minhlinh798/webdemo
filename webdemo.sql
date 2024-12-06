-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 06, 2024 lúc 12:17 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webdemo`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id_danhmuc` int(11) NOT NULL,
  `ten_danhmuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danhmuc`
--

INSERT INTO `danhmuc` (`id_danhmuc`, `ten_danhmuc`) VALUES
(1, 'Trà Sữa'),
(2, 'Ăn Vặt'),
(3, 'Lẩu'),
(4, 'Món Mặn');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id_donhang` int(11) NOT NULL,
  `ten_sanpham` varchar(100) NOT NULL,
  `giasp` varchar(100) NOT NULL,
  `soluong` varchar(100) NOT NULL,
  `tongtien` varchar(100) NOT NULL,
  `anh` varchar(100) NOT NULL,
  `trangthai` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `giohang`
--

CREATE TABLE `giohang` (
  `id_giohang` int(11) NOT NULL,
  `id_sanpham` int(11) NOT NULL,
  `ten_sanpham` varchar(100) NOT NULL,
  `anh` varchar(100) NOT NULL,
  `giasp` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `tongtien` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `giohang`
--

INSERT INTO `giohang` (`id_giohang`, `id_sanpham`, `ten_sanpham`, `anh`, `giasp`, `quantity`, `tongtien`, `user_id`) VALUES
(3, 1, 'Trà Sữa Trân Châu', 'b2.png', '50000', 2, '100000', 1),
(4, 2, 'Lẩu Thái', 's1.png', '299000', 3, '897000', 1),
(12, 8, 'Chân Gà Sốt Thái', 'a4.png', '79000', 1, '79000', 2),
(14, 18, 'Bánh Mỳ', 'd1.png', '50000', 1, '50000', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id_lienhe` int(11) NOT NULL,
  `ten_nguoidung` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sdt` varchar(100) NOT NULL,
  `noidung` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id_lienhe`, `ten_nguoidung`, `email`, `sdt`, `noidung`, `created_at`) VALUES
(1, 'linh', '123@gmail.com', '0123123123', 'admin hỗ trợ e giải quyết lỗi thanh toán đi ạ!', '2024-12-06 06:56:53');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id_sanpham` int(11) NOT NULL,
  `ten_sanpham` varchar(100) NOT NULL,
  `ten_danhmuc` varchar(100) NOT NULL,
  `giasp` varchar(100) NOT NULL,
  `soluong` varchar(100) NOT NULL,
  `mota` varchar(100) NOT NULL,
  `anh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id_sanpham`, `ten_sanpham`, `ten_danhmuc`, `giasp`, `soluong`, `mota`, `anh`) VALUES
(1, 'Trà Sữa Trân Châu', 'Trà Sữa', '50000', '50', 'Ngon tuyệt!', 'b2.png'),
(2, 'Lẩu Thái', 'Lẩu', '299000', '10', 'Lẩu Thái là một trong những món ăn nổi tiếng nhất của Thái Lan. ', 's1.png'),
(3, 'Gà Rán', 'Ăn Vặt', '60000', '50', 'Gà rán luôn là một món ăn hấp dẫn và thu hút đối với trẻ nhỏ. ', 'a1.png'),
(4, 'CaCao Đá', 'Trà Sữa', '60000', '20', 'cacao hơi bị ngon!\"', 'b10.png'),
(5, 'Lạp Xưởng Nướng Đá', 'Ăn Vặt', '99000', '20', 'Tuyệt vời!', 's2.png'),
(6, 'Trà Vải', 'Trà Sữa', '50000', '50', 'Tuyệt vời!', 'b7.png'),
(7, 'Thái Xanh', 'Trà Sữa', '50000', '60', 'Tuyệt!', 'b4.png'),
(8, 'Chân Gà Sốt Thái', 'Ăn Vặt', '79000', '30', 'Quá đã!', 'a4.png'),
(9, 'Sữa Chua Đá', 'Trà Sữa', '50000', '30', 'Ngon tuyệt!', 'b8.png'),
(10, 'Tobokky', 'Ăn Vặt', '199000', '10', 'quá đãzzzzzzzzzz', 's5.png'),
(11, 'Thịt Chuột', 'Món Mặn', '299000', '5', 'Đặc sản miền tây!', 'ư1.png'),
(12, 'Bánh Tráng Trộn', 'Ăn Vặt', '79000', '20', 'ngon!', 'a3.png'),
(13, 'Trà Đào', 'Trà Sữa', '50000', '40', 'ngon', 'b6.png'),
(14, 'Thịt Chóa', 'Món Mặn', '500000', '5', 'Chóa là bạn không phải đồ ăn. Đặc Sản Quảng Nam!', 'g1.png'),
(15, 'Bạc Xĩu', 'Trà Sữa', '50000', '10', 'tuyệt!', 'b9.png'),
(16, 'Mỳ Tôm', 'Món Mặn', '10000', '10', 'Cứu đói sinh viên cuối tháng!', 'd2.png'),
(17, 'Matcha Đá Xay', 'Trà Sữa', '70000', '10', 'ngon tuyệt', 'f1.png'),
(18, 'Bánh Mỳ', 'Món Mặn', '50000', '20', 'tuyệt vời!', 'd1.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT 'icons.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `password`, `icon`, `created_at`) VALUES
(2, 'nguyễn minh lĩnh', 'linh', '$2y$10$7Oj5VAcgKxAvTVF.J7PZD.zEyi3buICJljol4hc42ZqOamO8IF6iW', 'icons.png', '2024-12-06 08:55:38');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id_danhmuc`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_donhang`);

--
-- Chỉ mục cho bảng `giohang`
--
ALTER TABLE `giohang`
  ADD PRIMARY KEY (`id_giohang`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id_lienhe`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_sanpham`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id_danhmuc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_donhang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `giohang`
--
ALTER TABLE `giohang`
  MODIFY `id_giohang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id_lienhe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_sanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

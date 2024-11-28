-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2024 at 09:31 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- ---------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `price` int(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `brand` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `brand`) VALUES
(1, 'Cân điện tử SF400', 97000, 'sf400.jpg', 'dungcu'),
(2, 'Bàn xoay', 250000, 'banxoay.jpg', 'dungcu'),
(3, 'Bột làm bánh', 350000, 'botlambanh.jpg', 'nguyenlieu'),
(18, 'Bột mì đa dụng', 50000, 'botmi.jpg', 'nguyenlieu'),
(19, 'Đường kính', 30000, 'duongkinh.jpg', 'nguyenlieu'),
(20, 'Bơ nhạt', 60000, 'bonhat.jpg', 'nguyenlieu'),
(21, 'Sữa tươi', 20000, 'suatươi.jpg', 'phache'),
(22, 'Trứng gà', 15000, 'trunggà.jpg', 'nguyenlieu'),
(23, 'Bột nở', 20000, 'botno.jpg', 'nguyenlieu'),
(24, 'Vanilla', 25000, 'vanilla.jpg', 'phache'),
(25, 'Socola đen', 70000, 'socola_den.jpg', 'phache'),
(26, 'Hạnh nhân', 80000, 'hanhnhan.jpg', 'nguyenlieu'),
(27, 'Nho khô', 35000, 'nhokho.jpg', 'phache'),
(28, 'Khuôn bánh tròn', 120000, 'kuon_banh.jpg', 'dungcu'),
(29, 'Cân điện tử', 80000, 'can_dientu.jpg', 'dungcu'),
(30, 'Bàn xoay', 250000, 'ban_xoay.jpg', 'dungcu'),
(31, 'Phới lồng', 15000, 'phoilong.jpg', 'dungcu'),
(32, 'Máy đánh trứng', 500000, 'may_danh_trung.jpg', 'dungcu'),
(33, 'Thìa đong', 10000, 'thiadong.jpg', 'dungcu'),
(34, 'Dao cắt bánh', 30000, 'dao_cat_banh.jpg', 'dungcu'),
(35, 'Khay nướng', 70000, 'khay_nuong.jpg', 'dungcu'),
(36, 'Bộ dụng cụ trang trí bánh', 200000, 'dungcu_trangtri.jpg', 'trangtri'),
(37, 'Nhiệt kế lò nướng', 60000, 'nhietke.jpg', 'dungcu'),
(38, 'Kem tươi', 40000, 'kem_tươi.jpg', 'phache'),
(39, 'Socola trang trí', 50000, 'socola_trangtri.jpg', 'trangtri'),
(40, 'Đường bột', 20000, 'duong_bot.jpg', ''),
(41, 'Trái cây tươi', 30000, 'traicay.jpg', ''),
(42, 'Hạt dẻ cười', 60000, 'hat_de_cuoi.jpg', ''),
(43, 'Kẹo màu', 15000, 'keo_mau.jpg', ''),
(44, 'Bột màu thực phẩm', 25000, 'bot_mau.jpg', ''),
(45, 'Nến sinh nhật', 10000, 'nen_sinhnhat.jpg', ''),
(46, 'Giấy ăn trang trí', 20000, 'giay_an.jpg', ''),
(47, 'Ruy băng', 30000, 'ruy_bang.jpg', ''),
(48, 'Máy xay sinh tố', 300000, 'may_xay.jpg', ''),
(49, 'Bình đong', 15000, 'binh_dong.jpg', ''),
(50, 'Thìa khuấy', 10000, 'thia_khuay.jpg', ''),
(51, 'Cốc đo', 20000, 'coc_do.jpg', ''),
(52, 'Bát trộn', 25000, 'bat_tron.jpg', ''),
(53, 'Máy trộn bột', 600000, 'may_tron_bot.jpg', ''),
(54, 'Mũi khoan trộn', 30000, 'mui_khoan.jpg', ''),
(55, 'Cây cán bột', 20000, 'cay_can.jpg', ''),
(56, 'Bộ lọc bột', 15000, 'bo_loc_bot.jpg', ''),
(57, 'Bộ ly đo lường', 25000, 'ly_do.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) DEFAULT NULL,
  `phone` int(10) NOT NULL,
  `registration_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_id`, `first_name`, `last_name`, `phone`, `registration_time`, `password`, `role`) VALUES
(67, '1@GMAIL.COM', 'Sham', 'das', 0, '2024-10-30 06:27:14', '1', 'admin'),
(68, 'trunghttq1@gmail.com', 'Trung', 'Nguyễn Bảo', 0, '2024-10-15 16:56:14', 'c4ca4238a0b923820dcc509a6f75849b', 'user'),
(69, '2@gmail.com', '2', '2', 0, '2024-10-16 15:00:49', 'c81e728d9d4c2f636f067f89cc14862c', 'user'),
(70, '3@gmail.com', '1', '1', 0, '2024-10-30 06:29:04', 'c4ca4238a0b923820dcc509a6f75849b', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `users_products`
--

CREATE TABLE `users_products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `status` enum('Added To Cart','Confirmed') NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_products`
--

INSERT INTO `users_products` (`id`, `user_id`, `item_id`, `status`, `quantity`) VALUES
(59, 69, 21, 'Added To Cart', 1),
(60, 69, 2, 'Added To Cart', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `users_products`
--
ALTER TABLE `users_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_products`
--
ALTER TABLE `users_products`
  ADD CONSTRAINT `users_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_products_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

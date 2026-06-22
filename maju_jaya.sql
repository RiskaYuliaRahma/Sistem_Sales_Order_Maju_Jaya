-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2026 at 08:24 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maju_jaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'Andi Pratama', 'Jl. Raya Rajeg No. 12, Tangerang', '081234567890', '2026-06-11 17:45:57', '2026-06-21 10:26:22'),
(2, 'Siti Aisyah', 'Jl. Citra Raya Blok A3 No. 05, Tangerang', '081356781234', '2026-06-11 17:45:57', '2026-06-21 10:26:35'),
(6, 'Rina Wulandari', 'Jl. Baru Cikupa No. 18, Tangerang', '082199887766', '2026-06-21 10:26:06', '2026-06-21 10:26:06'),
(7, 'Fajar Ramadhan', 'Jl. Tigaraksa Indah No. 09, Tangerang', '087822338899', '2026-06-21 10:27:25', '2026-06-21 10:27:25'),
(8, 'Bagas Maulana', 'Jl. Sepatan Raya No. 03, Tangerang', '082233445566', '2026-06-21 10:28:11', '2026-06-21 10:28:11'),
(9, 'Dimas Saputra', 'Jl. Balaraja Permai No. 07, Tangerang', '085711223344', '2026-06-21 10:29:03', '2026-06-21 10:29:03'),
(10, 'Nabila Zahra', 'Jl. Raya Curug No. 21, Tangerang', '081944556677', '2026-06-21 10:29:44', '2026-06-21 10:29:44'),
(11, 'Ahmad Fauzi', 'Jl. Melati Raya No. 10, Tangerang', '081344556677', '2026-06-21 14:40:25', '2026-06-21 14:40:25'),
(12, 'Dewi Lestari', 'Jl. Anggrek Indah No. 08, Tangerang', '082155667788', '2026-06-21 14:41:06', '2026-06-21 14:41:06'),
(13, 'Rizky Hidayat', 'Jl. Kenangan No. 25, Tangerang', '085623456789', '2026-06-21 14:41:52', '2026-06-21 14:41:52'),
(14, 'Maya Sari', 'Jl. Mawar Permai No. 14, Tangerang', '081987654321', '2026-06-21 14:42:42', '2026-06-21 14:42:42'),
(15, 'Tiara Tin Ningsih', 'Jl. Perdamaian, Kampung Gembang, Tangerang', '081533447788', '2026-06-22 03:01:29', '2026-06-22 03:01:29'),
(16, 'Yunia Herawati', 'Jl. Flamboyan Merah, Bumi Indah No. 15, Tangerang', '082355668899', '2026-06-22 03:02:50', '2026-06-22 03:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) GENERATED ALWAYS AS (`quantity` * `unit_price`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(7, 5, 8, 2, '320000.00'),
(8, 5, 14, 1, '4800000.00'),
(9, 6, 5, 5, '400000.00'),
(10, 7, 2, 2, '2500000.00'),
(11, 7, 9, 4, '250000.00'),
(12, 8, 1, 1, '7800000.00'),
(13, 9, 6, 2, '280000.00'),
(14, 10, 4, 1, '3500000.00'),
(15, 11, 3, 1, '2200000.00'),
(16, 12, 13, 1, '3950000.00'),
(17, 13, 10, 7, '120000.00'),
(18, 13, 11, 1, '15000000.00'),
(19, 14, 5, 1, '400000.00'),
(20, 14, 4, 2, '3500000.00'),
(21, 14, 7, 1, '150000.00'),
(22, 15, 9, 2, '250000.00'),
(23, 16, 7, 1, '150000.00'),
(24, 16, 12, 1, '1850000.00'),
(25, 17, 5, 1, '400000.00'),
(26, 17, 4, 2, '3500000.00'),
(27, 18, 10, 5, '120000.00'),
(28, 18, 6, 3, '280000.00');

--
-- Triggers `order_items`
--
DELIMITER $$
CREATE TRIGGER `update_order_total_after_delete` AFTER DELETE ON `order_items` FOR EACH ROW BEGIN
    UPDATE sales_orders
    SET total_amount = (
        SELECT IFNULL(SUM(subtotal), 0)
        FROM order_items
        WHERE order_id = OLD.order_id
    )
    WHERE id = OLD.order_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_order_total_after_insert` AFTER INSERT ON `order_items` FOR EACH ROW BEGIN
    UPDATE sales_orders
    SET total_amount = (
        SELECT IFNULL(SUM(subtotal), 0)
        FROM order_items
        WHERE order_id = NEW.order_id
    )
    WHERE id = NEW.order_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_order_total_after_update` AFTER UPDATE ON `order_items` FOR EACH ROW BEGIN
    UPDATE sales_orders
    SET total_amount = (
        SELECT IFNULL(SUM(subtotal), 0)
        FROM order_items
        WHERE order_id = NEW.order_id
    )
    WHERE id = NEW.order_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `price`, `stock`, `created_at`, `updated_at`) VALUES
(1, 'ELK002', 'Laptop Lenovo', '7800000.00', 9, '2026-06-11 17:45:57', '2026-06-21 14:31:53'),
(2, 'ELK001', 'Smartphone Android', '2500000.00', 18, '2026-06-11 17:45:57', '2026-06-21 14:29:56'),
(3, 'ELK003', 'TV LED 32 Inch', '2200000.00', 7, '2026-06-11 17:45:57', '2026-06-21 14:37:44'),
(4, 'ELK004', 'Kipas Angin', '3500000.00', 20, '2026-06-21 10:14:44', '2026-06-22 03:04:52'),
(5, 'ELK005', 'Rice Cooker', '400000.00', 11, '2026-06-21 10:15:22', '2026-06-22 03:04:52'),
(6, 'ELK006', 'Blender', '280000.00', 17, '2026-06-21 10:16:02', '2026-06-22 03:06:43'),
(7, 'ELK007', 'Setrika Listrik', '150000.00', 28, '2026-06-21 10:16:36', '2026-06-21 14:46:39'),
(8, 'ELK008', 'Speaker Bluetooth', '320000.00', 13, '2026-06-21 10:17:18', '2026-06-21 14:24:25'),
(9, 'ELK009', 'Headset Wireless', '250000.00', 21, '2026-06-21 10:18:02', '2026-06-21 14:45:33'),
(10, 'ELK010', 'Charger Fast Charging', '120000.00', 28, '2026-06-21 10:19:03', '2026-06-22 03:06:43'),
(11, 'ELK011', 'Laptop Asus 14 inch', '15000000.00', 14, '2026-06-21 13:23:13', '2026-06-21 14:44:02'),
(12, 'ELK012', 'Mesin Cuci 2 Tabung', '1850000.00', 7, '2026-06-21 13:40:09', '2026-06-21 14:46:39'),
(13, 'ELK013', 'Kulkas 2 Pintu', '3950000.00', 5, '2026-06-21 13:40:46', '2026-06-21 14:38:33'),
(14, 'ELK014', 'AC Portable', '4800000.00', 9, '2026-06-21 13:48:35', '2026-06-21 14:24:25');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `order_date` date NOT NULL DEFAULT curdate(),
  `status` enum('draft','dikirim','selesai','dibatalkan') NOT NULL DEFAULT 'draft',
  `total_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id`, `order_number`, `customer_id`, `created_by`, `order_date`, `status`, `total_amount`, `notes`, `created_at`, `updated_at`) VALUES
(5, 'SO/2026/0005', 8, 6, '2026-06-21', 'dikirim', '5440000.00', 'Tambahkan bubble wrap nya ', '2026-06-21 14:24:24', '2026-06-21 14:24:35'),
(6, 'SO/2026/0006', 1, 6, '2026-06-21', 'draft', '2000000.00', 'Tolong diantar dengan hati\"', '2026-06-21 14:29:03', '2026-06-21 14:29:03'),
(7, 'SO/2026/0007', 8, 6, '2026-06-21', 'selesai', '6000000.00', '-', '2026-06-21 14:29:56', '2026-06-21 14:30:06'),
(8, 'SO/2026/0008', 7, 6, '2026-06-21', 'dibatalkan', '7800000.00', '-', '2026-06-21 14:31:53', '2026-06-21 14:31:59'),
(9, 'SO/2026/0009', 10, 2, '2026-06-21', 'draft', '560000.00', '-', '2026-06-21 14:36:27', '2026-06-21 14:36:27'),
(10, 'SO/2026/0010', 6, 2, '2026-06-21', 'dikirim', '3500000.00', '', '2026-06-21 14:37:08', '2026-06-21 14:37:15'),
(11, 'SO/2026/0011', 2, 2, '2026-06-21', 'selesai', '2200000.00', '', '2026-06-21 14:37:44', '2026-06-21 14:37:53'),
(12, 'SO/2026/0012', 7, 2, '2026-06-21', 'dibatalkan', '3950000.00', '', '2026-06-21 14:38:33', '2026-06-21 14:38:44'),
(13, 'SO/2026/0013', 11, 4, '2026-06-21', 'selesai', '15840000.00', '', '2026-06-21 14:44:02', '2026-06-21 14:44:08'),
(14, 'SO/2026/0014', 12, 4, '2026-06-21', 'dikirim', '7550000.00', '', '2026-06-21 14:44:49', '2026-06-21 14:44:55'),
(15, 'SO/2026/0015', 13, 4, '2026-06-21', 'draft', '500000.00', '', '2026-06-21 14:45:33', '2026-06-21 14:45:56'),
(16, 'SO/2026/0016', 14, 4, '2026-06-21', 'dibatalkan', '2000000.00', '', '2026-06-21 14:46:39', '2026-06-21 14:46:46'),
(17, 'SO/2026/0017', 16, 6, '2026-06-22', 'selesai', '7400000.00', '-', '2026-06-22 03:04:52', '2026-06-22 03:05:02'),
(18, 'SO/2026/0018', 15, 2, '2026-06-22', 'dikirim', '1440000.00', '-', '2026-06-22 03:06:43', '2026-06-22 03:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('admin','sales','manager') NOT NULL DEFAULT 'sales',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$osHzLRKy5BtPa4.dheBXBuRhAvO/Bk1odGkDRx0i.4xHqanN9R636', 'Riska Yulia Rahma', 'admin', '2026-06-11 17:45:57', '2026-06-22 02:53:49'),
(2, 'sales_budi', '$2y$10$RSys1rcW5LWSpqoigGqgx.WX22ZHBQ2guCyid..1.Ug0AEERK9Zmu', 'Budi Prasetya', 'sales', '2026-06-11 17:45:57', '2026-06-22 02:54:13'),
(3, 'manager', '$2y$10$6O6r6B2ctvv6f9mLdl.26OChDiUbCL8xooed3lrA6euLGfyKmHkyC', 'Alexandra Putri', 'manager', '2026-06-11 17:45:57', '2026-06-22 02:54:31'),
(4, 'sales_nadia', '$2y$10$SlsXVLqa.02UjqkScgEZAeeXQYhv/8g1hvJ8kA063YGFGcGYi4AWG', 'Nadia Omara', 'sales', '2026-06-11 18:21:59', '2026-06-22 02:54:49'),
(6, 'sales_putri', '$2y$10$I.8M1SKYIOzFS8S8Udg63OKGqZQ5EwKmJY6f32.vbCbGU5rosvywy', 'Putri Amalia ', 'sales', '2026-06-20 14:06:52', '2026-06-22 02:55:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_order` (`order_id`),
  ADD KEY `idx_product` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `idx_order_date` (`order_date`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_sales` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `sales_orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD CONSTRAINT `sales_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `sales_orders_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

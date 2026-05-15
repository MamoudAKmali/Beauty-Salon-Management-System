-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql202.infinityfree.com
-- Generation Time: Apr 24, 2026 at 06:28 PM
-- Server version: 11.4.10-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_41747859_beauty_salon_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `status` enum('pending','confirmed','completed','cancelled','reminded') DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `customer_id`, `service_id`, `employee_id`, `appointment_date`, `appointment_time`, `status`, `notes`, `created_at`) VALUES
(1, 7, 2, 1, '2026-04-30', '14:00:00', 'pending', '', '2026-04-24 21:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `loyalty_points` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(255) DEFAULT NULL,
  `role` enum('customer','admin') DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `loyalty_points`, `created_at`, `password`, `role`) VALUES
(1, 'فاطمة محمد', '0555000001', 'fatima@example.com', 150, '2026-04-24 19:31:23', NULL, 'customer'),
(2, 'نوف خالد', '0555000002', 'nouf@example.com', 80, '2026-04-24 19:31:23', NULL, 'customer'),
(3, 'عبير سالم', '0555000003', 'abeer@example.com', 220, '2026-04-24 19:31:23', NULL, 'customer'),
(4, 'دانا يوسف', '0555000004', 'dana@example.com', 50, '2026-04-24 19:31:23', NULL, 'customer'),
(5, 'المدير', 'admin', NULL, 0, '2026-04-24 20:39:25', '$2y$10$Kbr12v7xymGuQHLS7Gs9.uJdoRVISFXhIGAx.lrym.6FXGgwaaA32', 'admin'),
(6, 'المدير العام', '0000000000', 'admin@salon.com', 0, '2026-04-24 21:13:07', '$2y$10$u4ejHifo.JyCtURdWvX6eObjaKm/cVTKZOXH6dTGykmPwWU33DAhC', 'admin'),
(7, 'Rahaf', '96654390871425', 'rahaf@gmail.com', 10, '2026-04-24 21:43:20', '$2y$10$lQu4IR8ykPbrqbSt3fzUcOFzQw3DtyqbDM7Dl728WL3qzBtS1PXIG', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `specialization` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `specialization`, `phone`, `bio`, `photo`, `is_active`, `created_at`) VALUES
(1, 'سارة الأحمد', 'تصفيف الشعر وصبغاته', '0501234567', NULL, NULL, 1, '2026-04-24 19:31:23'),
(2, 'نورة العتيبي', 'الأظافر والجل', '0507654321', NULL, NULL, 1, '2026-04-24 19:31:23'),
(3, 'ريم الزهراني', 'المكياج والجمال', '0509876543', NULL, NULL, 1, '2026-04-24 19:31:23'),
(4, 'لمى القحطاني', 'العناية بالبشرة', '0503456789', NULL, NULL, 1, '2026-04-24 19:31:23'),
(5, 'هنوف السبيعي', 'الحواجب والرموش', '0506789012', NULL, NULL, 1, '2026-04-24 19:31:23');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `rating` tinyint(4) NOT NULL
) ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_id`, `service_id`, `employee_id`, `rating`, `comment`, `is_approved`, `created_at`) VALUES
(1, 1, 1, 1, 5, 'خدمة رائعة جداً وأسلوب تعامل راقي! سارة متميزة في عملها', 1, '2026-04-24 19:31:24'),
(2, 2, 4, 2, 5, 'نورة فنانة في الأظافر، الجل استمر أكثر من شهر!', 1, '2026-04-24 19:31:24'),
(3, 3, 6, 3, 4, 'مكياج ريم جميل ومناسب للمناسبات، سأعود مجدداً', 1, '2026-04-24 19:31:24'),
(4, 4, 8, 4, 5, 'تنظيف البشرة غيّر حياتي، بشرتي أصبحت مشرقة!', 1, '2026-04-24 19:31:24');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `category` enum('hair','nails','makeup','skincare','eyebrow','other') NOT NULL DEFAULT 'other',
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `duration_minutes` int(11) DEFAULT 60,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `category`, `description`, `price`, `duration_minutes`, `image`, `is_active`, `created_at`) VALUES
(1, 'قص وتصفيف الشعر', 'hair', 'قص الشعر وتصفيفه بأحدث الموضات على يد متخصصات محترفات', '120.00', 60, 'assets/img/services/1777066124_قص الشعر.jpg', 1, '2026-04-24 19:31:21'),
(2, 'صبغة الشعر الكاملة', 'hair', 'صبغة شعر كاملة بأفضل الماركات العالمية', '250.00', 120, 'assets/img/services/1777065527_صبغة الشعر.webp', 1, '2026-04-24 19:31:21'),
(3, 'كيراتين البروتين', 'hair', 'علاج كيراتين احترافي يمنح شعركِ النعومة والبريق', '400.00', 180, 'assets/img/services/1777065867_كيراتين.avif', 1, '2026-04-24 19:31:21'),
(4, 'مانيكير كلاسيكي', 'nails', 'العناية بالأظافر وتلوينها بأرقى الألوان', '80.00', 45, 'assets/img/services/1777066287_العناية بالاضافر.webp', 1, '2026-04-24 19:31:21'),
(5, 'جل الأظافر', 'nails', 'تركيب جل احترافي يدوم طويلاً مع تصاميم مميزة', '150.00', 90, 'assets/img/services/1777066200_جل.jpeg', 1, '2026-04-24 19:31:21'),
(6, 'مكياج سواريه', 'makeup', 'مكياج سواريه احترافي يناسب حفلاتكِ ومناسباتكِ', '200.00', 90, 'assets/img/services/1777066375_سوارية.webp', 1, '2026-04-24 19:31:21'),
(7, 'مكياج عروس', 'makeup', 'إطلالة عروس لا تُنسى بلمسة خبيرة المكياج', '600.00', 150, 'assets/img/services/1777066569_مكياج-عروس-خليجي.jpg', 1, '2026-04-24 19:31:21'),
(8, 'تنظيف البشرة العميق', 'skincare', 'جلسة تنظيف عميق للبشرة وتفتيحها', '180.00', 90, 'assets/img/services/1777066631_تنظيف البشره.webp', 1, '2026-04-24 19:31:21'),
(9, 'رسم الحواجب', 'eyebrow', 'رسم الحواجب وتشكيلها لإطار مثالي للوجه', '60.00', 30, 'assets/img/services/1777066748_رسم الحواجب.jpg', 1, '2026-04-24 19:31:21'),
(10, 'الإكستنشن', 'hair', 'تركيب إكستنشن طبيعي عالي الجودة', '500.00', 180, 'assets/img/services/1777065670_اكستنشن.webp', 1, '2026-04-24 19:31:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_3` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

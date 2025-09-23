-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 23, 2025 at 12:37 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baalxamp`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Color', '2025-09-22 06:41:41', '2025-09-22 06:41:41'),
(2, 'Storage', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(3, 'Country', '2025-09-22 06:45:37', '2025-09-22 06:45:37');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_values`
--

CREATE TABLE `attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `attribute_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_values`
--

INSERT INTO `attribute_values` (`id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(6, 2, '2GB + 512MB', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(7, 2, '4GB + 128GB', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(8, 2, '4GB + 256GB', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(9, 2, '6GB + 128GB', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(10, 2, '6GB + 256GB', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(11, 2, '6GB + 512GB', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(12, 2, '8GB + 256GB', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(13, 2, '8GB + 512GB', '2025-09-22 06:44:10', '2025-09-22 06:44:10'),
(14, 3, 'USA', '2025-09-22 06:45:37', '2025-09-22 06:45:37'),
(15, 3, 'UK', '2025-09-22 06:45:37', '2025-09-22 06:45:37'),
(16, 3, 'India', '2025-09-22 06:45:37', '2025-09-22 06:45:37'),
(17, 3, 'Singapore', '2025-09-22 06:45:37', '2025-09-22 06:45:37'),
(18, 3, 'China', '2025-09-22 06:45:37', '2025-09-22 06:45:37'),
(19, 3, 'Malaysia', '2025-09-22 06:45:37', '2025-09-22 06:45:37'),
(20, 3, 'Vietnam', '2025-09-22 06:45:37', '2025-09-22 06:45:37'),
(21, 3, 'UAE (Dubai)', '2025-09-22 06:45:38', '2025-09-22 06:45:38'),
(22, 3, 'Japan', '2025-09-22 06:45:38', '2025-09-22 06:45:38'),
(23, 1, 'Midnight', '2025-09-22 06:47:05', '2025-09-22 06:47:05'),
(24, 1, 'White', '2025-09-22 06:47:05', '2025-09-22 06:47:05'),
(25, 1, 'Blue', '2025-09-22 06:47:05', '2025-09-22 06:47:05'),
(26, 1, 'Red', '2025-09-22 06:47:05', '2025-09-22 06:47:05'),
(27, 1, 'Golden', '2025-09-22 06:47:05', '2025-09-22 06:47:05'),
(28, 1, 'Pink', '2025-09-22 06:47:05', '2025-09-22 06:47:05');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(53, 3, 1, 1, '2025-09-23 05:10:04', '2025-09-23 05:10:04');

-- --------------------------------------------------------

--
-- Table structure for table `cart_variations`
--

CREATE TABLE `cart_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED NOT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_variations`
--

INSERT INTO `cart_variations` (`id`, `cart_id`, `product_variation_id`, `created_at`, `updated_at`) VALUES
(36, 53, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Smartphone', 'buy-smartphone-at-affordable-price', 'categories/hdMKgwl6qzmPuAtxJ28vEjON2n1JxJDuT1MMEMT1.png', '2025-09-22 06:21:16', '2025-09-22 06:21:16'),
(2, 'Tablets', 'buy-tablets-at-best-price', 'categories/lRRnOuTlTCgfT3AmhtpkGcibfFOzuYYEMUZvW62m.png', '2025-09-22 06:21:37', '2025-09-22 06:21:37'),
(3, 'Smart Watch', 'smart-watch', 'categories/XHhxB9kkj3eOFLVvKrcLz8he04tnvxS9rjxPAEXt.png', '2025-09-22 06:21:52', '2025-09-22 06:21:52'),
(4, 'Desktop', 'desktop', 'categories/rnp7CmSfrRWIy7jkI0HPXYW5M6SnPdZX6nxOv7yN.png', '2025-09-22 06:22:02', '2025-09-22 06:22:02'),
(5, 'Accessories', 'accessories', 'categories/99rSw99109HfaHLHshKCfr7eiUwhGKipeUhoi3tP.png', '2025-09-22 06:22:13', '2025-09-22 06:22:13'),
(6, 'Projector', 'projector', 'categories/PO5BXmZrb1FjdcA2TnAFai5TP11ysoRx7ijjxULl.png', '2025-09-22 06:22:25', '2025-09-22 06:22:25'),
(7, 'Digital Whiteboard', 'digital-whiteboard', 'categories/LkqougOElzozRyJhGSeCXQeSLi1BFcdVQrtBEB8K.png', '2025-09-22 06:22:42', '2025-09-22 06:22:42'),
(8, 'Laptops', 'laptops', 'categories/ZAe9UGvXGklHxQQvdotBHoF834qq338QtIlFXWsw.png', '2025-09-22 06:22:57', '2025-09-22 06:22:57'),
(9, 'Camera', 'camera', 'categories/VqBgFIgmZlbGmeuztw0mC3bAu4ReIj7VdNP1yDci.png', '2025-09-22 06:23:09', '2025-09-22 06:23:09'),
(10, 'Gaming', 'gaming', 'categories/FAs7NDV8pstBuIAtQj6iWhbi3oLlp5T50NeM50lS.png', '2025-09-22 06:23:28', '2025-09-22 06:23:28'),
(11, 'Graphics Tab', 'graphics-tab', 'categories/VlRZreNYUxTPNsA3VVJyxJqrJe3LYa4vcGrqNl2C.png', '2025-09-22 06:23:38', '2025-09-22 06:23:38'),
(12, 'TV and Monitors', 'tv-and-monitors', 'categories/vBnVaCMfnAAZCXciARCTcwzYuWb9pt9RgEhOxqGS.png', '2025-09-22 06:23:54', '2025-09-22 06:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permanent_addr` text DEFAULT NULL,
  `shipping_addr` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `permanent_addr`, `shipping_addr`, `created_at`, `updated_at`) VALUES
(1, 2, 'Chagolnaiya, Feni', 'Chagolnaiya, Feni', '2025-09-22 11:08:03', '2025-09-22 11:08:03'),
(2, 3, 'Churamankati, Jashore', 'Jashore University of Science & Technology', '2025-09-23 03:57:39', '2025-09-23 03:57:39'),
(3, 4, 'Apnar Bashar pashe, Ctg', 'Jashore University of Science & Technology', '2025-09-23 05:09:29', '2025-09-23 05:09:29'),
(4, 5, 'Jessore University of Science & Technology, Ambottola, Jessore Sadar, Khulna', 'Jashore University of Science & Technology', '2025-09-23 05:44:54', '2025-09-23 05:44:54'),
(5, 6, 'Jessore University of Science & Technology, Ambottola, Jessore Sadar, Khulna', 'Jashore University of Science & Technology', '2025-09-23 05:46:09', '2025-09-23 05:46:09'),
(6, 7, 'Jessore University of Science & Technology, Ambottola, Jessore Sadar, Khulna', 'Jessore University of Science & Technology, Ambottola, Jessore Sadar, Khulna', '2025-09-23 05:47:04', '2025-09-23 05:47:04'),
(7, 8, '14 Gausul Azam Avenue Road (Lift-3), Sector No-13, Uttara Model Town, Dhaka-1230.', '14 Gausul Azam Avenue Road (Lift-3), Sector No-13, Uttara Model Town, Dhaka-1230.', '2025-09-23 05:48:16', '2025-09-23 05:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_19_174102_categories', 2),
(5, '2025_09_19_174129_create_subcategories_table', 2),
(6, '2025_09_19_175627_create_customers_table', 2),
(7, '2025_09_19_175729_create_reviews_table', 2),
(8, '2025_09_19_175750_create_wishlists_table', 2),
(9, '2025_09_19_175806_create_carts_table', 2),
(10, '2025_09_19_170433_product_variations', 3),
(11, '2025_09_19_170513_attributes', 3),
(12, '2025_09_19_170555_atrribute_values', 3),
(13, '2025_09_19_170817_variation_attribute_values', 3),
(14, '2025_09_22_214034_orders', 4),
(15, '2025_09_22_214528_order_items', 5),
(16, '2025_09_22_225300_create_temp_orders_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `shipping` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('surjopay','cash_on_delivery') NOT NULL,
  `payment_status` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `order_status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `full_name`, `email`, `phone`, `address`, `subtotal`, `shipping`, `tax`, `total`, `payment_method`, `payment_status`, `order_status`, `transaction_id`, `created_at`, `updated_at`) VALUES
(2, 2, 'NOK68d187a07e048', 'Md. Abdullah Mahmud Adib', 'adib@gmail.com', '01521776375', 'Chagolnaiya, Feni', 60875.00, 10.00, 6765.00, 67650.00, 'surjopay', 'paid', 'shipped', '68d187ae', '2025-09-22 17:30:23', '2025-09-23 03:32:52'),
(3, 2, 'NOK68d1893b8e572', 'Md. Abdullah Mahmud Adib', 'adib@gmail.com', '01521776375', 'Chagolnaiya, Feni', 42065.00, 10.00, 4675.00, 46750.00, 'surjopay', 'paid', 'processing', '68d1894c', '2025-09-22 17:37:17', '2025-09-22 17:37:17'),
(4, 3, 'NOK68d21bfc0404e', 'Md. Mamun-Or-Rashid', '200101.cse@student.just.edu.bd', '01707695177', 'Jashore University of Science & Technology', 2168.00, 10.00, 242.00, 2420.00, 'surjopay', 'paid', 'cancelled', '68d21c0c', '2025-09-23 04:03:26', '2025-09-23 04:35:24'),
(5, 2, 'NOK68d22cb8b482a', 'Md. Abdullah Mahmud Adib', 'adib@gmail.com', '01521776375', 'Chagolnaiya, Feni', 42461.00, 10.00, 4719.00, 47190.00, 'surjopay', 'paid', 'shipped', '68d22cdb', '2025-09-23 05:15:08', '2025-09-23 05:21:22'),
(6, 5, 'NOK68d2389f666a7', 'Tahsin Arafat', 'tahsin@gmail.com', '01456823449', 'Jashore University of Science & Technology', 126116.00, 10.00, 14014.00, 140140.00, 'surjopay', 'paid', 'shipped', '68d238b4', '2025-09-23 06:05:42', '2025-09-23 06:06:16'),
(7, 5, 'NOK68d23cb9299d4', 'Tahsin Arafat', 'tahsin@gmail.com', '01456823449', 'Jashore University of Science & Technology', 386.00, 10.00, 44.00, 440.00, 'surjopay', 'paid', 'processing', '68d23cce', '2025-09-23 06:23:12', '2025-09-23 06:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `variations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`variations`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `variations`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 61500.00, '\"[22]\"', '2025-09-22 17:30:23', '2025-09-22 17:30:23'),
(2, 3, 2, 1, 42500.00, '\"[32]\"', '2025-09-22 17:37:17', '2025-09-22 17:37:17'),
(3, 4, 3, 1, 2200.00, '\"[]\"', '2025-09-23 04:03:26', '2025-09-23 04:03:26'),
(4, 5, 2, 1, 42500.00, '\"[25]\"', '2025-09-23 05:15:08', '2025-09-23 05:15:08'),
(5, 5, 6, 1, 400.00, '\"[]\"', '2025-09-23 05:15:08', '2025-09-23 05:15:08'),
(6, 6, 1, 2, 61500.00, '\"[24]\"', '2025-09-23 06:05:42', '2025-09-23 06:05:42'),
(7, 6, 7, 1, 2200.00, '\"[]\"', '2025-09-23 06:05:42', '2025-09-23 06:05:42'),
(8, 6, 3, 1, 2200.00, '\"[]\"', '2025-09-23 06:05:42', '2025-09-23 06:05:42'),
(9, 7, 6, 1, 400.00, '\"[]\"', '2025-09-23 06:23:12', '2025-09-23 06:23:12');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `subcategory_id` bigint(20) UNSIGNED NOT NULL,
  `key_feature_left` text NOT NULL,
  `key_feature_right` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` longtext NOT NULL,
  `primary_image` varchar(255) NOT NULL,
  `secondary_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`secondary_images`)),
  `video_url` varchar(255) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `status` enum('sell','sold') NOT NULL DEFAULT 'sell',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `category_id`, `subcategory_id`, `key_feature_left`, `key_feature_right`, `price`, `description`, `primary_image`, `secondary_images`, `video_url`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 'i Phone 13', 'i-phone-13', 1, 4, '<ul>\r\n<li data-start=\"94\" data-end=\"137\">\r\n<p data-start=\"96\" data-end=\"137\"><strong>Display:</strong> 6.1-inch Super Retina XDR OLED</p>\r\n</li>\r\n<li data-start=\"138\" data-end=\"186\">\r\n<p data-start=\"140\" data-end=\"186\"><strong>Camera:</strong> Dual 12MP system (Wide + Ultra Wide)</p>\r\n</li>\r\n<li data-start=\"187\" data-end=\"219\">\r\n<p data-start=\"189\" data-end=\"219\"><strong>Front Camera:</strong> 12MP TrueDepth</p>\r\n</li>\r\n<li data-start=\"220\" data-end=\"262\">\r\n<p data-start=\"222\" data-end=\"262\"><strong>Battery:</strong> Up to 19 hours video playback</p>\r\n</li>\r\n</ul>', '<ul>\r\n<li data-start=\"281\" data-end=\"311\">\r\n<p data-start=\"283\" data-end=\"311\"><strong>Processor:</strong> A15 Bionic chip</p>\r\n</li>\r\n<li data-start=\"312\" data-end=\"394\">\r\n<p data-start=\"314\" data-end=\"394\"><strong>Storage:</strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB/1TB variants)</p>\r\n</li>\r\n<li data-start=\"395\" data-end=\"422\">\r\n<p data-start=\"397\" data-end=\"422\"><strong>OS:</strong> iOS 15 (upgradable)</p>\r\n</li>\r\n<li data-start=\"423\" data-end=\"467\">\r\n<p data-start=\"425\" data-end=\"467\"><strong>Connectivity:</strong> 5G, Wi-Fi 6, Bluetooth 5.0</p>\r\n</li>\r\n</ul>', 61500.00, '<p data-start=\"0\" data-end=\"490\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display</strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera</strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera</strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip</strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.</p>\r\n<p data-start=\"492\" data-end=\"1017\">This model includes <strong>4GB RAM and 128G</strong>B of storage(We have more variants of <strong>4GB + 256 GB</strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.</p>', 'products/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp', '[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"]', 'https://www.youtube.com/watch?v=kdepgkh4Ve4', 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:52:24'),
(2, 'Motorola Edge 60 Pro 5G', 'motorola-edge-60-pro-5g', 1, 7, '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">Stunning 6.7\" P-OLED display with 1B colors, 120Hz refresh, and 4500 nits peak brightness</li>\r\n<li dir=\"ltr\" role=\"presentation\">Dimensity 8350 Extreme chipset delivers high-end performance and efficiency</li>\r\n</ul>', '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">Stunning 6.7\" P-OLED display with 1B colors, 120Hz refresh, and 4500 nits peak brightness</li>\r\n<li dir=\"ltr\" role=\"presentation\">Dimensity 8350 Extreme chipset delivers high-end performance and efficiency</li>\r\n<li dir=\"ltr\" role=\"presentation\">Flagship-level triple camera setup with 50MP ultra-wide + telephoto &amp; Pantone validation</li>\r\n<li dir=\"ltr\" role=\"presentation\">Sharp 50MP front camera with 4K video support for creators and selfies</li>\r\n<li dir=\"ltr\" role=\"presentation\">Massive 6000mAh battery with 90W wired and 15W wireless charging</li>\r\n<li dir=\"ltr\" role=\"presentation\">Premium eco-leather back, IP68/IP69 rating, and Gorilla Glass 7i protection</li>\r\n<li dir=\"ltr\" role=\"presentation\">Stereo speakers with Dolby Atmos and Hi-Res 24-bit/192kHz audio support</li>\r\n</ul>', 42500.00, '<p dir=\"ltr\">Blending flagship-grade hardware with eco-conscious design, the&nbsp;<a href=\"https://www.applegadgetsbd.com/brands/motorola\">Motorola&nbsp;</a>Edge 60 Pro 5G stands out as one of the most advanced Android phones of 2025. It features a gorgeous 6.7-inch P-OLED display with 1 billion colors, HDR10+, and an incredible peak brightness of 4500 nits. It is perfect for any lighting condition. Built with Gorilla Glass 7i on the front and an eco-leather silicone polymer back, it&rsquo;s tough, stylish, and water resistant (IP68/IP69 rated). Inside, the powerful MediaTek Dimensity 8350 Extreme chipset and up to 16GB RAM offer blazing speed and smooth multitasking. The triple camera system, featuring dual 50MP sensors and 3x optical zoom, is Pantone Validated for true-to-life color. A large 6000mAh battery supports ultra-fast 90W wired and 15W wireless charging. The Edge 60 Pro 5G is made for users who demand premium performance with a sustainable twist.</p>', 'products/wJVtgrozCS4dZkq2viMoF8ZRnOCbyIhKG61s8RSu.webp', '[\"products\\/tvYPNbYQdVeYxOaYLiqA6jquW6noXe7frMigJCS4.webp\",\"products\\/jGJMvTF71D1j9PygFtcYLPhMDe57GFBZjROuGpHA.webp\"]', 'https://youtu.be/74jALGfuWYU?feature=shared', 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:58:28'),
(3, 'Google Pixel USB-C earbuds', 'google-pixel-usbc-earbuds', 5, 13, '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio</li>\r\n<li dir=\"ltr\" role=\"presentation\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks</li>\r\n</ul>', '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio</li>\r\n<li dir=\"ltr\" role=\"presentation\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks</li>\r\n<li dir=\"ltr\" role=\"presentation\">Real-time Translation with&nbsp; Google Translate reduces your worry about translating languages when you are abroad or with foreigners&nbsp;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Always be up to date with your latest notifications without reaching out to your phone by pressing and holding the Volume up button</li>\r\n</ul>', 2200.00, '<p>Experience the ultimate audio pleasure with&nbsp;<a href=\"https://www.applegadgetsbd.com/brands/google\">Google</a> Pixel USB-C Earbuds. Designed for both comfort and clarity, these earbuds offer an immersive way to enjoy music, podcasts, and more. Their ergonomic design ensures hours of comfortable wear, while the exceptional sound quality elevates your listening experience. Seamlessly switch between calls and music with the built-in microphone, and harness the power of Google Assistant for added convenience. Indulge in uninterrupted audio bliss with these versatile earbuds.</p>', 'products/Xflad0fpBTzGa4oAqEzVu9okEgOXcd49Q8bcp9NZ.png', '[\"products\\/vbBwWhLdIeQUd0kVPBHkaag37sEzuS5mOPVzonrZ.png\",\"products\\/eQ8A32Y4OEPMM4dvq9UQulnUA4CdOkEkmFtFj717.png\",\"products\\/PBIjUTbxPrvnYE18irZmL8KQW9Veb587PLD7n9ep.png\"]', 'https://youtu.be/3zQWMvI5DP0?feature=shared', 50, 'sell', '2025-09-22 18:21:07', '2025-09-22 18:21:07'),
(4, 'Apple USB-C to Lightning Cable - 1m', 'apple-usbc-to-lightning-cable-1m', 5, 14, '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">2 meters longer in length cable for distant wall plug usage;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Lightweight material used for easy to carry in your backpack;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Due to longer lengthy cable charge devices without any difficulty;</li>\r\n</ul>', '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">2 meters longer in length cable for distant wall plug usage;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Lightweight material used for easy to carry in your backpack;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Due to longer lengthy cable charge devices without any difficulty;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Charge multiple Apple devices including your iPhones, iPad &amp; Macbooks;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Enable to charge your latest iPhone 15 series and even data transfer;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Reversible design makes charging easier to charge in the dark without any worries;</li>\r\n<li dir=\"ltr\" role=\"presentation\">Original &ldquo;USB-C To C&rdquo; charging cable designed by Apple.</li>\r\n</ul>', 1600.00, '<p>This&nbsp;<a href=\"https://www.applegadgetsbd.com/brands/apple\">Apple</a> USB-C charging cable designed by Apple made specially for your versatile usage for people who need longer length cables and travel a lot. Designed by Apple, this \"USB-C To C\'\' cable is a must-have for those on the move. With an extended 2-meter length, it\'s perfect for distant wall plug usage. Lightweight and easy to carry in your backpack, this cable ensures hassle-free charging wherever you go. Compatible with iPhones, iPads, and MacBooks, it effortlessly handles the latest iPhone 15 series. Not just for charging, but also enables high-speed data transfer. The reversible design adds convenience, making charging in the dark worry-free. Elevate your charging experience with Apple\'s USB-C Charge Cable!</p>', 'products/lFXIYlHxWGcGXOX0OQLaPKzK3nxWOlWWCsbSQylz.png', '[\"products\\/l4safmURp9530PVSu8o7qXaWypQncjHjHgP4Xs1W.png\"]', 'https://youtu.be/bGI_OjUhYDs?feature=shared', 50, 'sell', '2025-09-22 18:29:10', '2025-09-22 18:29:10'),
(5, 'Sony Alpha a7 III Mirrorless Digital Camera (Body Only)', 'sony-alpha-a7-iii-mirrorless-digital-camera-body-only', 9, 15, '<ul class=\"list_22p_DbxsLr4MV-m3EOA_5T\">\r\n<li>Model: Sony Alpha A7 III</li>\r\n<li>5-axis image stabilization</li>\r\n<li>BIONZ X image processing engine</li>\r\n<li>35 mm 24.3 MP 7 Exmor CMOS sensor</li>\r\n<li>High-resolution OLED Tru-Finder</li>\r\n</ul>', '<ul class=\"list_22p_DbxsLr4MV-m3EOA_5T\">\r\n<li>Model: Sony Alpha A7 III</li>\r\n<li>5-axis image stabilization</li>\r\n<li>BIONZ X image processing engine</li>\r\n<li>35 mm 24.3 MP 7 Exmor CMOS sensor</li>\r\n<li>High-resolution OLED Tru-Finder</li>\r\n</ul>', 136000.00, '<h2>Sony Alpha a7 III Mirrorless Camera in Bangladesh</h2>\r\n<p>Capture the peaks of more decisive moments with the &Icirc;&plusmn;7 III from Sony, packing newly developed back-illuminated full-frame CMOS sensor and other advanced imaging innovations, high-speed response, ease of operation, and reliable durability that are ready for various shooting needs. A software upgrade is now available to support Sony&rsquo;s new Real-time Eye AF for Animals. The feature works by automatically detecting and tracking the eyes of animals that you&rsquo;re photographing, for beautiful pet portraits and wildlife shots. With outstanding imaging capability and high-speed performance contained in a compact body, the &Icirc;&plusmn;7 III gives you the power, precision, and flexibility to capture once-in-a-lifetime moments just as you like. A newly developed back-illuminated image sensor and evolved image processing system fulfill various shooting needs with high-quality imaging capabilities that you would expect only of a full-frame camera. A new version of the 24.2-megapixel Exmor R CMOS sensor, now featuring a back-illuminated structure, is combined with the latest BIONZ X image processing engine and front-end LSI, and this combination achieves a data readout speed that is two times faster and data processing capability that is 1.8 times higher. The 35-mm full-frame CMOS image sensor with back-illuminated structure enhances light collection efficiency, expands circuitry scale, and, with the help of a copper wiring layer that contributes to quicker data transfer, outputs data at very high speed, while minimizing noise to reveal fine details in every picture. Standard ISO range is extended to ISO 100-51200 (expandable to ISO 50-204800 for stills), while Detail Reproduction and Area-specific Noise Reduction technologies maintain image details and cut noise. With highly effective performance in mid-to-high sensitivity ranges, you can shoot at high ISO with no concerns about noise or image deterioration. The latest high-precision stabilization uses stabilization unit and gyro sensors and algorithms to achieve a 5.0-step shutter speed advantage in a system that compensates five types of camera shake with a wide range of lenses and delivers excellent performance. For smoother, more natural gradation, the latest BIONZ X image processor and front-end LSI process image signals in 16-bit form. This processor also allows 14-bit RAW data output, even when in silent or continuous shooting mode. AF performance is improved using the same AF advancements as in the &Icirc;&plusmn;9 and applying it optimally. Once the &Icirc;&plusmn;7 III captures such unpredictably moving subjects as dancers, boxers, and wild animals in action, it won&acirc;&euro;&trade;t easily let them go. This camera features 693 phase-detection AF points covering approx. 93% of image area, plus 425 densely positioned contrast-detection AF points to improve focus.</p>', 'products/l5XG1SELFkYNyMihTTwJYlZXGA9PpTP5vREdelyV.png', '[\"products\\/vnWBklbMw6cUtDH5cUtssiml93eFW08c1eHxNMkq.png\",\"products\\/zuzccQ2optcDoAppWW7dIaC0nQtvbsf4zYqdSF94.png\",\"products\\/2Kn1jTyuok8mfZ3Hzf7WyVStKL3LfK3mzF2iG6dN.png\"]', 'https://youtu.be/3yk_YgkaWGo?feature=shared', 50, 'sell', '2025-09-22 18:36:33', '2025-09-22 18:36:33'),
(6, 'Canon ES-68 Lens Hood', 'canon-es68-lens-hood', 9, 16, '<ul class=\"top-section-list\" data-selenium=\"highlightList\">\r\n<li class=\"top-section-list-item\">For EF 50mm f/1.8 STM Lens</li>\r\n<li class=\"top-section-list-item\">Blocks Stray Light from Entering Lens</li>\r\n<li class=\"top-section-list-item\">Protects Lens from Impact</li>\r\n</ul>', '<h2 class=\"fs16 OpenSans-600-normal product-highlights-header\">Product Highlights</h2>\r\n<ul class=\"top-section-list\" data-selenium=\"highlightList\">\r\n<li class=\"top-section-list-item\">For EF 50mm f/1.8 STM Lens</li>\r\n<li class=\"top-section-list-item\">Blocks Stray Light from Entering Lens</li>\r\n<li class=\"top-section-list-item\">Protects Lens from Impact</li>\r\n</ul>\r\n<table class=\"specTable\" data-selenium=\"specTable\">\r\n<tbody data-selenium=\"specBody\">\r\n<tr>\r\n<td class=\"specTopic fs18\" data-selenium=\"specTopic\">Mount Type</td>\r\n<td class=\"specDetail fs18\" data-selenium=\"specDetail\"><span class=\"notSpecfMon\">Not Specified by Manufacturer</span></td>\r\n</tr>\r\n<tr>\r\n<td class=\"specTopic fs18\" data-selenium=\"specTopic\">Material</td>\r\n<td class=\"specDetail fs18\" data-selenium=\"specDetail\"><span class=\"notSpecfMon\">Not Specified by Manufacturer</span></td>\r\n</tr>\r\n<tr>\r\n<td class=\"specTopic fs18\" data-selenium=\"specTopic\">Dimensions</td>\r\n<td class=\"specDetail fs18\" data-selenium=\"specDetail\"><span class=\"notSpecfMon\">Not Specified by Manufacturer</span></td>\r\n</tr>\r\n<tr>\r\n<td class=\"specTopic fs18\" data-selenium=\"specTopic\">Weight</td>\r\n<td class=\"specDetail fs18\" data-selenium=\"specDetail\">1.1 oz / 30 g</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"specTable\" data-selenium=\"specTable\">\r\n<tbody data-selenium=\"specBody\">\r\n<tr>\r\n<th class=\"specHeader Header\" colspan=\"2\" data-selenium=\"specHeader\"><a id=\"shipping\" class=\"fs32 OpenSans-300-normal\" name=\"shipping\" data-selenium=\"specHeaderLink\"></a>Packaging Info</th>\r\n</tr>\r\n<tr>\r\n<td class=\"specTopic fs18\" data-selenium=\"specTopic\">Package Weight</td>\r\n<td class=\"specDetail fs18\" data-selenium=\"specDetail\">0.1 lb</td>\r\n</tr>\r\n<tr>\r\n<td class=\"specTopic fs18\" data-selenium=\"specTopic\">Box Dimensions (LxWxH)</td>\r\n<td class=\"specDetail fs18\" data-selenium=\"specDetail\">3.5 x 3.4 x 1.5&Prime;</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>', 400.00, '<h2 class=\"fs16 OpenSans-600-normal product-highlights-header\">Product Highlights</h2>\r\n<ul class=\"top-section-list\" data-selenium=\"highlightList\">\r\n<li class=\"top-section-list-item\">For EF 50mm f/1.8 STM Lens</li>\r\n<li class=\"top-section-list-item\">Blocks Stray Light from Entering Lens</li>\r\n<li class=\"top-section-list-item\">Protects Lens from Impact</li>\r\n</ul>', 'products/3N8JMAZqrmhGIdavRzVud5MncHTuVUMNZ0MTT8lv.png', '[\"products\\/ACuMqFigBF8zEYRlBY6oBLWwVoRUOJ8pzjYlPHML.png\"]', 'https://youtu.be/74jALGfuWYU?feature=shared', 2000, 'sell', '2025-09-22 18:44:07', '2025-09-22 18:44:07'),
(7, 'Nokia C2-01', 'nokia-c201', 1, 10, '<p>The&nbsp;<strong>left selection key</strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.</p>', '<p>The&nbsp;<strong>left selection key</strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.</p>', 2200.00, '<p>The&nbsp;<strong>left selection key</strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.</p>', 'products/XjXF3Ncy2fV9rvgbPnERCsVtIPZCUMruRGZBAfDK.png', '[\"products\\/qVEmYrPCU3J4fomZFH3MFlfpCrIzFZyRwNusc3Tq.png\"]', NULL, 100, 'sell', '2025-09-23 05:29:20', '2025-09-23 05:33:21'),
(8, 'Galaxy S25 Ultra 5G', 'galaxy-s25-ultra-5g', 1, 5, '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">Comes with a flat design on both sides with a sleek titanium frame.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Large AMOLED screen with a high refresh rate is a peace of the eye.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Feel lightning-fast performance with the Snapdragon 8 Elite.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Improve your daily productivity with personalized AI-driven insights.</li>\r\n</ul>', '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">Comes with a flat design on both sides with a sleek titanium frame.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Large AMOLED screen with a high refresh rate is a peace of the eye.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Feel lightning-fast performance with the Snapdragon 8 Elite.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Improve your daily productivity with personalized AI-driven insights.</li>\r\n</ul>', 112000.00, '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">Comes with a flat design on both sides with a sleek titanium frame.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Large AMOLED screen with a high refresh rate is a peace of the eye.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Feel lightning-fast performance with the Snapdragon 8 Elite.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Improve your daily productivity with personalized AI-driven insights.</li>\r\n</ul>', 'products/QHRJWBCkgEmo91fQi0RCfrRGHyahM7XodvgbAB0F.png', '[\"products\\/ONpb4efWLGuuc8nmhTalr21DjUfVhHNsZo30Hqsl.png\"]', 'https://www.youtube.com/watch?v=3i1OB6wKYms', 50, 'sell', '2025-09-23 05:42:40', '2025-09-23 05:42:40'),
(9, 'Samsung Galaxy S25 FE', 'samsung-galaxy-s25-fe', 1, 5, '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">Comes with a flat design on both sides with a sleek titanium frame.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Large AMOLED screen with a high refresh rate is a peace of the eye.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Feel lightning-fast performance with the Snapdragon 8 Elite.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Improve your daily productivity with personalized AI-driven insights.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Quad camera setup with powerful lenses to capture beyond.&nbsp;</li>\r\n<li dir=\"ltr\" role=\"presentation\">A large battery with flash charging will keep you powered all day long.</li>\r\n</ul>', '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">Comes with a flat design on both sides with a sleek titanium frame.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Large AMOLED screen with a high refresh rate is a peace of the eye.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Feel lightning-fast performance with the Snapdragon 8 Elite.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Improve your daily productivity with personalized AI-driven insights.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Quad camera setup with powerful lenses to capture beyond.&nbsp;</li>\r\n<li dir=\"ltr\" role=\"presentation\">A large battery with flash charging will keep you powered all day long.</li>\r\n</ul>', 112000.00, '<ul>\r\n<li dir=\"ltr\" role=\"presentation\">Comes with a flat design on both sides with a sleek titanium frame.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Large AMOLED screen with a high refresh rate is a peace of the eye.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Feel lightning-fast performance with the Snapdragon 8 Elite.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Improve your daily productivity with personalized AI-driven insights.</li>\r\n<li dir=\"ltr\" role=\"presentation\">Quad camera setup with powerful lenses to capture beyond.&nbsp;</li>\r\n<li dir=\"ltr\" role=\"presentation\">A large battery with flash charging will keep you powered all day long.</li>\r\n</ul>', 'products/6uvNQXHQA1j4EBQhFzfGjoU3CUzl6SwJ0TManM6x.png', '[\"products\\/AiAGxPNwa4HmYgbc1Sjj0Bxk7rrJqDSHIjeNiBSJ.png\"]', 'https://www.youtube.com/watch?v=3i1OB6wKYms', 50, 'sell', '2025-09-23 05:51:35', '2025-09-23 05:51:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_variations`
--

CREATE TABLE `product_variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `status` enum('sell','sold') NOT NULL DEFAULT 'sell',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variations`
--

INSERT INTO `product_variations` (`id`, `product_id`, `name`, `price`, `stock`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Color: Midnight Country: India Storage: 4GB + 128GB', 61500.00, 300, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:53:10'),
(2, 1, 'Color: Midnight Country: India Storage: 4GB + 256GB', 68000.00, 0, 'sold', '2025-09-22 06:50:45', '2025-09-22 06:53:37'),
(3, 1, 'Color: Midnight Country: Singapore Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(4, 1, 'Color: Midnight Country: Singapore Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(5, 1, 'Color: Midnight Country: China Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(6, 1, 'Color: Midnight Country: China Storage: 4GB + 256GB', 67999.98, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(7, 1, 'Color: White Country: India Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(8, 1, 'Color: White Country: India Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(9, 1, 'Color: White Country: Singapore Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(10, 1, 'Color: White Country: Singapore Storage: 4GB + 256GB', 67999.99, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(11, 1, 'Color: White Country: China Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(12, 1, 'Color: White Country: China Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(13, 1, 'Color: Blue Country: India Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(14, 1, 'Color: Blue Country: India Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(15, 1, 'Color: Blue Country: Singapore Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(16, 1, 'Color: Blue Country: Singapore Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(17, 1, 'Color: Blue Country: China Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(18, 1, 'Color: Blue Country: China Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(19, 1, 'Color: Pink Country: India Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(20, 1, 'Color: Pink Country: India Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(21, 1, 'Color: Pink Country: Singapore Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(22, 1, 'Color: Pink Country: Singapore Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(23, 1, 'Color: Pink Country: China Storage: 4GB + 128GB', 61500.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(24, 1, 'Color: Pink Country: China Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45'),
(25, 2, 'Color: Blue Country: USA Storage: 6GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(26, 2, 'Color: Blue Country: USA Storage: 6GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(27, 2, 'Color: Blue Country: USA Storage: 8GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(28, 2, 'Color: Blue Country: USA Storage: 8GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(29, 2, 'Color: Blue Country: Singapore Storage: 6GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(30, 2, 'Color: Blue Country: Singapore Storage: 6GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(31, 2, 'Color: Blue Country: Singapore Storage: 8GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(32, 2, 'Color: Blue Country: Singapore Storage: 8GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(33, 2, 'Color: Golden Country: USA Storage: 6GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(34, 2, 'Color: Golden Country: USA Storage: 6GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(35, 2, 'Color: Golden Country: USA Storage: 8GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(36, 2, 'Color: Golden Country: USA Storage: 8GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(37, 2, 'Color: Golden Country: Singapore Storage: 6GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(38, 2, 'Color: Golden Country: Singapore Storage: 6GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(39, 2, 'Color: Golden Country: Singapore Storage: 8GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(40, 2, 'Color: Golden Country: Singapore Storage: 8GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(41, 2, 'Color: Pink Country: USA Storage: 6GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(42, 2, 'Color: Pink Country: USA Storage: 6GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(43, 2, 'Color: Pink Country: USA Storage: 8GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(44, 2, 'Color: Pink Country: USA Storage: 8GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(45, 2, 'Color: Pink Country: Singapore Storage: 6GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(46, 2, 'Color: Pink Country: Singapore Storage: 6GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(47, 2, 'Color: Pink Country: Singapore Storage: 8GB + 256GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31'),
(48, 2, 'Color: Pink Country: Singapore Storage: 8GB + 512GB', 42500.00, 50, 'sell', '2025-09-22 17:32:31', '2025-09-22 17:32:31');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `rating` float NOT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_id`, `product_id`, `rating`, `feedback`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 3, 'i got my product at ambottola within 120 years', '2025-09-22 20:08:00', '2025-09-22 20:08:00'),
(3, 1, 6, 2, 'sob somoy kharap review dei product valo hote pare', '2025-09-23 02:32:00', '2025-09-23 02:32:00'),
(4, 2, 6, 5, 'best product', '2025-09-23 03:58:20', '2025-09-23 03:58:20'),
(5, 7, 8, 4, 'My favourite Smartphone. Thanks to OPTIMUS PRIME', '2025-09-23 05:49:07', '2025-09-23 05:49:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('4ZAslGkUR9WjW3c1LSi0R86Q2jE0g5cxIE5fBi2m', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSDF4bGtOZXhNeUlMY0FnWXc5TTlzc3g2ZmlKSTVzdFQ2NDQ4WFN6ZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXJ0L2NvdW50Ijt9czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7fQ==', 1758609195);

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 2, 'Lenovo Tab', 'lenovo-tab', 'subcategories/5tmKSgvdteNCE6MOgp96AkEHPLIEqKYlTRfTEVsC.png', '2025-09-22 06:24:24', '2025-09-22 06:24:24'),
(2, 2, 'Samsung Tab', 'samsung-tab', 'subcategories/c558tTO0izMNGccarTt1F1OafYkqenWnkTTJ0680.png', '2025-09-22 06:30:29', '2025-09-22 06:30:29'),
(3, 8, 'Lenevo Laptop', 'lenevo-laptop', 'subcategories/U7uNmZEFomFoZIPmiO1z7oqW4kjKwTvImWHwLxy5.png', '2025-09-22 06:31:01', '2025-09-22 06:31:01'),
(4, 1, 'Apple iPhone', 'apple-iphone', 'subcategories/xhhsCeRmjpnhC6TNiXacO0ujpQvZrSoXeykp2K9e.png', '2025-09-22 06:31:24', '2025-09-22 06:31:24'),
(5, 1, 'Samsung Galaxy', 'samsung-galaxy', 'subcategories/OoRUzPmZHisle8D9se6UU4idpMA4j5LsGRYusGyw.png', '2025-09-22 06:31:46', '2025-09-22 06:31:46'),
(6, 1, 'Xiomi', 'xiomi', 'subcategories/CrHoTxoogVtvXCt8PMtJzSOYB69vGFjVaq5RM7je.png', '2025-09-22 06:31:59', '2025-09-22 06:31:59'),
(7, 1, 'Motorola', 'motorola', 'subcategories/L3GM8YgGfXOjVyhJPU9fjzJHmJop9cLCbq11OXIU.png', '2025-09-22 06:32:27', '2025-09-22 06:32:27'),
(8, 1, 'One Plus', 'one-plus', 'subcategories/cbPSI5ekeM1XVN3D7Q2fNejIE6Gw8nGKedo6Zwnr.png', '2025-09-22 06:32:48', '2025-09-22 06:32:48'),
(9, 1, 'Oppo', 'oppo', 'subcategories/6y90l8zkZZUPf4xPLvjBHVO13zL0vfKM3juadCbt.png', '2025-09-22 06:33:04', '2025-09-22 06:33:04'),
(10, 1, 'Nokia', 'nokia', 'subcategories/O0jZvtifUVHetKCOv94L0explbFBscn5EH1lbcPo.png', '2025-09-22 06:33:20', '2025-09-22 06:33:20'),
(11, 1, 'Google Pixel', 'google-pixel', 'subcategories/wWWZQesxpeo3dDzZwyyLEdHMMIfhqumE9VuG8lNs.png', '2025-09-22 06:33:40', '2025-09-22 06:33:40'),
(12, 1, 'Sony Xperia', 'sony-xperia', 'subcategories/U6w3X8gupG3pagTwnQrWjnQsjFq5oSCz8pQB2cCh.png', '2025-09-22 06:33:56', '2025-09-22 06:33:56'),
(13, 5, 'Earbuds', 'earbuds', 'subcategories/qDHx6wWqxMaCPY97fzMW7OlE1Qzf69WzIcO4czap.png', '2025-09-22 18:15:23', '2025-09-22 18:15:23'),
(14, 5, 'Charging Cable', 'charging-cable', 'subcategories/W8j4oKPVBbVhYhEmXLtStxGvGkal3wvcN81eC95v.png', '2025-09-22 18:26:34', '2025-09-22 18:26:34'),
(15, 9, 'SONY', 'sony', 'subcategories/BvhpKOdB3br58Qg1VgQG1Xc91VYORITmuWwSrONu.png', '2025-09-22 18:31:42', '2025-09-22 18:31:42'),
(16, 9, 'CANON', 'canon', 'subcategories/cEbZSajjcjWV7l3iWB090wUJIHZxc4bWe1hiPVnX.png', '2025-09-22 18:39:43', '2025-09-22 18:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `temp_orders`
--

CREATE TABLE `temp_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `address` text NOT NULL,
  `cart_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`cart_data`)),
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temp_orders`
--

INSERT INTO `temp_orders` (`id`, `order_id`, `user_id`, `customer_id`, `address`, `cart_data`, `total`, `created_at`) VALUES
(1, 'NOK_1758560056_2', 2, 1, 'Chagolnaiya, Feni', '[{\"id\":47,\"customer_id\":1,\"product_id\":1,\"quantity\":1,\"created_at\":\"2025-09-22T15:20:10.000000Z\",\"updated_at\":\"2025-09-22T15:20:10.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":17,\"product_id\":1,\"name\":\"Color: Blue Country: China Storage: 4GB + 128GB\",\"price\":\"61500.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":47,\"product_variation_id\":17}}]}]', 67650.00, '2025-09-22 16:54:16'),
(2, 'NOK_1758560171_2', 2, 1, 'Chagolnaiya, Feni', '[{\"id\":47,\"customer_id\":1,\"product_id\":1,\"quantity\":1,\"created_at\":\"2025-09-22T15:20:10.000000Z\",\"updated_at\":\"2025-09-22T15:20:10.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":17,\"product_id\":1,\"name\":\"Color: Blue Country: China Storage: 4GB + 128GB\",\"price\":\"61500.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":47,\"product_variation_id\":17}}]}]', 67650.00, '2025-09-22 16:56:11'),
(3, 'NOK_1758560584_2', 2, 1, 'Ambottola, Jessore', '[{\"id\":48,\"customer_id\":1,\"product_id\":1,\"quantity\":1,\"created_at\":\"2025-09-22T17:02:36.000000Z\",\"updated_at\":\"2025-09-22T17:02:36.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":22,\"product_id\":1,\"name\":\"Color: Pink Country: Singapore Storage: 4GB + 256GB\",\"price\":\"68000.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":48,\"product_variation_id\":22}}]}]', 67650.00, '2025-09-22 17:03:04'),
(4, 'NOK_1758560832_2', 2, 1, 'Chagolnaiya, Feni', '[{\"id\":48,\"customer_id\":1,\"product_id\":1,\"quantity\":1,\"created_at\":\"2025-09-22T17:02:36.000000Z\",\"updated_at\":\"2025-09-22T17:02:36.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":22,\"product_id\":1,\"name\":\"Color: Pink Country: Singapore Storage: 4GB + 256GB\",\"price\":\"68000.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":48,\"product_variation_id\":22}}]}]', 67650.00, '2025-09-22 17:07:12'),
(5, 'TEMP_1758561174_2', 2, 1, 'Chagolnaiya, Feni', '[{\"id\":48,\"customer_id\":1,\"product_id\":1,\"quantity\":1,\"created_at\":\"2025-09-22T17:02:36.000000Z\",\"updated_at\":\"2025-09-22T17:02:36.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":22,\"product_id\":1,\"name\":\"Color: Pink Country: Singapore Storage: 4GB + 256GB\",\"price\":\"68000.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":48,\"product_variation_id\":22}}]}]', 67650.00, '2025-09-22 17:12:54'),
(6, 'TEMP_1758561308_2', 2, 1, 'Chagolnaiya, Feni', '[{\"id\":48,\"customer_id\":1,\"product_id\":1,\"quantity\":1,\"created_at\":\"2025-09-22T17:02:36.000000Z\",\"updated_at\":\"2025-09-22T17:02:36.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":22,\"product_id\":1,\"name\":\"Color: Pink Country: Singapore Storage: 4GB + 256GB\",\"price\":\"68000.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":48,\"product_variation_id\":22}}]}]', 67650.00, '2025-09-22 17:15:08'),
(9, 'TEMP_1758600037_3', 3, 2, 'Jashore University of Science & Technology', '[{\"id\":52,\"customer_id\":2,\"product_id\":3,\"quantity\":1,\"created_at\":\"2025-09-23T04:00:17.000000Z\",\"updated_at\":\"2025-09-23T04:00:17.000000Z\",\"product\":{\"id\":3,\"name\":\"Google Pixel USB-C earbuds\",\"slug\":\"google-pixel-usbc-earbuds\",\"category_id\":5,\"subcategory_id\":13,\"key_feature_left\":\"<ul>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Real-time Translation with&nbsp; Google Translate reduces your worry about translating languages when you are abroad or with foreigners&nbsp;<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Always be up to date with your latest notifications without reaching out to your phone by pressing and holding the Volume up button<\\/li>\\r\\n<\\/ul>\",\"price\":\"2200.00\",\"description\":\"<p>Experience the ultimate audio pleasure with&nbsp;<a href=\\\"https:\\/\\/www.applegadgetsbd.com\\/brands\\/google\\\">Google<\\/a> Pixel USB-C Earbuds. Designed for both comfort and clarity, these earbuds offer an immersive way to enjoy music, podcasts, and more. Their ergonomic design ensures hours of comfortable wear, while the exceptional sound quality elevates your listening experience. Seamlessly switch between calls and music with the built-in microphone, and harness the power of Google Assistant for added convenience. Indulge in uninterrupted audio bliss with these versatile earbuds.<\\/p>\",\"primary_image\":\"products\\/Xflad0fpBTzGa4oAqEzVu9okEgOXcd49Q8bcp9NZ.png\",\"secondary_images\":[\"products\\/vbBwWhLdIeQUd0kVPBHkaag37sEzuS5mOPVzonrZ.png\",\"products\\/eQ8A32Y4OEPMM4dvq9UQulnUA4CdOkEkmFtFj717.png\",\"products\\/PBIjUTbxPrvnYE18irZmL8KQW9Veb587PLD7n9ep.png\"],\"video_url\":\"https:\\/\\/youtu.be\\/3zQWMvI5DP0?feature=shared\",\"stock\":50,\"status\":\"sell\",\"created_at\":\"2025-09-22T18:21:07.000000Z\",\"updated_at\":\"2025-09-22T18:21:07.000000Z\"},\"variations\":[]}]', 2420.00, '2025-09-23 04:00:37'),
(10, 'TEMP_1758600097_3', 3, 2, 'Jashore University of Science & Technology', '[{\"id\":52,\"customer_id\":2,\"product_id\":3,\"quantity\":1,\"created_at\":\"2025-09-23T04:00:17.000000Z\",\"updated_at\":\"2025-09-23T04:00:17.000000Z\",\"product\":{\"id\":3,\"name\":\"Google Pixel USB-C earbuds\",\"slug\":\"google-pixel-usbc-earbuds\",\"category_id\":5,\"subcategory_id\":13,\"key_feature_left\":\"<ul>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Real-time Translation with&nbsp; Google Translate reduces your worry about translating languages when you are abroad or with foreigners&nbsp;<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Always be up to date with your latest notifications without reaching out to your phone by pressing and holding the Volume up button<\\/li>\\r\\n<\\/ul>\",\"price\":\"2200.00\",\"description\":\"<p>Experience the ultimate audio pleasure with&nbsp;<a href=\\\"https:\\/\\/www.applegadgetsbd.com\\/brands\\/google\\\">Google<\\/a> Pixel USB-C Earbuds. Designed for both comfort and clarity, these earbuds offer an immersive way to enjoy music, podcasts, and more. Their ergonomic design ensures hours of comfortable wear, while the exceptional sound quality elevates your listening experience. Seamlessly switch between calls and music with the built-in microphone, and harness the power of Google Assistant for added convenience. Indulge in uninterrupted audio bliss with these versatile earbuds.<\\/p>\",\"primary_image\":\"products\\/Xflad0fpBTzGa4oAqEzVu9okEgOXcd49Q8bcp9NZ.png\",\"secondary_images\":[\"products\\/vbBwWhLdIeQUd0kVPBHkaag37sEzuS5mOPVzonrZ.png\",\"products\\/eQ8A32Y4OEPMM4dvq9UQulnUA4CdOkEkmFtFj717.png\",\"products\\/PBIjUTbxPrvnYE18irZmL8KQW9Veb587PLD7n9ep.png\"],\"video_url\":\"https:\\/\\/youtu.be\\/3zQWMvI5DP0?feature=shared\",\"stock\":50,\"status\":\"sell\",\"created_at\":\"2025-09-22T18:21:07.000000Z\",\"updated_at\":\"2025-09-22T18:21:07.000000Z\"},\"variations\":[]}]', 2420.00, '2025-09-23 04:01:37'),
(12, 'TEMP_1758604218_4', 4, 3, 'Jashore University of Science & Technology', '[{\"id\":53,\"customer_id\":3,\"product_id\":1,\"quantity\":1,\"created_at\":\"2025-09-23T05:10:04.000000Z\",\"updated_at\":\"2025-09-23T05:10:04.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":13,\"product_id\":1,\"name\":\"Color: Blue Country: India Storage: 4GB + 128GB\",\"price\":\"61500.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":53,\"product_variation_id\":13}}]}]', 67650.00, '2025-09-23 05:10:18'),
(14, 'TEMP_1758607361_5', 5, 4, 'Jashore University of Science & Technology', '[{\"id\":55,\"customer_id\":4,\"product_id\":1,\"quantity\":2,\"created_at\":\"2025-09-23T06:02:03.000000Z\",\"updated_at\":\"2025-09-23T06:02:03.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":24,\"product_id\":1,\"name\":\"Color: Pink Country: China Storage: 4GB + 256GB\",\"price\":\"68000.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":55,\"product_variation_id\":24}}]},{\"id\":56,\"customer_id\":4,\"product_id\":7,\"quantity\":1,\"created_at\":\"2025-09-23T06:02:22.000000Z\",\"updated_at\":\"2025-09-23T06:02:22.000000Z\",\"product\":{\"id\":7,\"name\":\"Nokia C2-01\",\"slug\":\"nokia-c201\",\"category_id\":1,\"subcategory_id\":10,\"key_feature_left\":\"<p>The&nbsp;<strong>left selection key<\\/strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.<\\/p>\",\"key_feature_right\":\"<p>The&nbsp;<strong>left selection key<\\/strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.<\\/p>\",\"price\":\"2200.00\",\"description\":\"<p>The&nbsp;<strong>left selection key<\\/strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.<\\/p>\",\"primary_image\":\"products\\/XjXF3Ncy2fV9rvgbPnERCsVtIPZCUMruRGZBAfDK.png\",\"secondary_images\":[\"products\\/qVEmYrPCU3J4fomZFH3MFlfpCrIzFZyRwNusc3Tq.png\"],\"video_url\":null,\"stock\":100,\"status\":\"sell\",\"created_at\":\"2025-09-23T05:29:20.000000Z\",\"updated_at\":\"2025-09-23T05:33:21.000000Z\"},\"variations\":[]},{\"id\":57,\"customer_id\":4,\"product_id\":3,\"quantity\":1,\"created_at\":\"2025-09-23T06:02:34.000000Z\",\"updated_at\":\"2025-09-23T06:02:34.000000Z\",\"product\":{\"id\":3,\"name\":\"Google Pixel USB-C earbuds\",\"slug\":\"google-pixel-usbc-earbuds\",\"category_id\":5,\"subcategory_id\":13,\"key_feature_left\":\"<ul>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Real-time Translation with&nbsp; Google Translate reduces your worry about translating languages when you are abroad or with foreigners&nbsp;<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Always be up to date with your latest notifications without reaching out to your phone by pressing and holding the Volume up button<\\/li>\\r\\n<\\/ul>\",\"price\":\"2200.00\",\"description\":\"<p>Experience the ultimate audio pleasure with&nbsp;<a href=\\\"https:\\/\\/www.applegadgetsbd.com\\/brands\\/google\\\">Google<\\/a> Pixel USB-C Earbuds. Designed for both comfort and clarity, these earbuds offer an immersive way to enjoy music, podcasts, and more. Their ergonomic design ensures hours of comfortable wear, while the exceptional sound quality elevates your listening experience. Seamlessly switch between calls and music with the built-in microphone, and harness the power of Google Assistant for added convenience. Indulge in uninterrupted audio bliss with these versatile earbuds.<\\/p>\",\"primary_image\":\"products\\/Xflad0fpBTzGa4oAqEzVu9okEgOXcd49Q8bcp9NZ.png\",\"secondary_images\":[\"products\\/vbBwWhLdIeQUd0kVPBHkaag37sEzuS5mOPVzonrZ.png\",\"products\\/eQ8A32Y4OEPMM4dvq9UQulnUA4CdOkEkmFtFj717.png\",\"products\\/PBIjUTbxPrvnYE18irZmL8KQW9Veb587PLD7n9ep.png\"],\"video_url\":\"https:\\/\\/youtu.be\\/3zQWMvI5DP0?feature=shared\",\"stock\":50,\"status\":\"sell\",\"created_at\":\"2025-09-22T18:21:07.000000Z\",\"updated_at\":\"2025-09-22T18:21:07.000000Z\"},\"variations\":[]}]', 140140.00, '2025-09-23 06:02:41');
INSERT INTO `temp_orders` (`id`, `order_id`, `user_id`, `customer_id`, `address`, `cart_data`, `total`, `created_at`) VALUES
(15, 'TEMP_1758607472_5', 5, 4, 'Jashore University of Science & Technology', '[{\"id\":55,\"customer_id\":4,\"product_id\":1,\"quantity\":2,\"created_at\":\"2025-09-23T06:02:03.000000Z\",\"updated_at\":\"2025-09-23T06:02:03.000000Z\",\"product\":{\"id\":1,\"name\":\"i Phone 13\",\"slug\":\"i-phone-13\",\"category_id\":1,\"subcategory_id\":4,\"key_feature_left\":\"<ul>\\r\\n<li data-start=\\\"94\\\" data-end=\\\"137\\\">\\r\\n<p data-start=\\\"96\\\" data-end=\\\"137\\\"><strong>Display:<\\/strong> 6.1-inch Super Retina XDR OLED<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"138\\\" data-end=\\\"186\\\">\\r\\n<p data-start=\\\"140\\\" data-end=\\\"186\\\"><strong>Camera:<\\/strong> Dual 12MP system (Wide + Ultra Wide)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"187\\\" data-end=\\\"219\\\">\\r\\n<p data-start=\\\"189\\\" data-end=\\\"219\\\"><strong>Front Camera:<\\/strong> 12MP TrueDepth<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"220\\\" data-end=\\\"262\\\">\\r\\n<p data-start=\\\"222\\\" data-end=\\\"262\\\"><strong>Battery:<\\/strong> Up to 19 hours video playback<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li data-start=\\\"281\\\" data-end=\\\"311\\\">\\r\\n<p data-start=\\\"283\\\" data-end=\\\"311\\\"><strong>Processor:<\\/strong> A15 Bionic chip<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"312\\\" data-end=\\\"394\\\">\\r\\n<p data-start=\\\"314\\\" data-end=\\\"394\\\"><strong>Storage:<\\/strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB\\/1TB variants)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"395\\\" data-end=\\\"422\\\">\\r\\n<p data-start=\\\"397\\\" data-end=\\\"422\\\"><strong>OS:<\\/strong> iOS 15 (upgradable)<\\/p>\\r\\n<\\/li>\\r\\n<li data-start=\\\"423\\\" data-end=\\\"467\\\">\\r\\n<p data-start=\\\"425\\\" data-end=\\\"467\\\"><strong>Connectivity:<\\/strong> 5G, Wi-Fi 6, Bluetooth 5.0<\\/p>\\r\\n<\\/li>\\r\\n<\\/ul>\",\"price\":\"61500.00\",\"description\":\"<p data-start=\\\"0\\\" data-end=\\\"490\\\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display<\\/strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera<\\/strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera<\\/strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip<\\/strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.<\\/p>\\r\\n<p data-start=\\\"492\\\" data-end=\\\"1017\\\">This model includes <strong>4GB RAM and 128G<\\/strong>B of storage(We have more variants of <strong>4GB + 256 GB<\\/strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.<\\/p>\",\"primary_image\":\"products\\/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp\",\"secondary_images\":[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"],\"video_url\":\"https:\\/\\/www.youtube.com\\/watch?v=kdepgkh4Ve4\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:52:24.000000Z\"},\"variations\":[{\"id\":24,\"product_id\":1,\"name\":\"Color: Pink Country: China Storage: 4GB + 256GB\",\"price\":\"68000.00\",\"stock\":500,\"status\":\"sell\",\"created_at\":\"2025-09-22T06:50:45.000000Z\",\"updated_at\":\"2025-09-22T06:50:45.000000Z\",\"pivot\":{\"cart_id\":55,\"product_variation_id\":24}}]},{\"id\":56,\"customer_id\":4,\"product_id\":7,\"quantity\":1,\"created_at\":\"2025-09-23T06:02:22.000000Z\",\"updated_at\":\"2025-09-23T06:02:22.000000Z\",\"product\":{\"id\":7,\"name\":\"Nokia C2-01\",\"slug\":\"nokia-c201\",\"category_id\":1,\"subcategory_id\":10,\"key_feature_left\":\"<p>The&nbsp;<strong>left selection key<\\/strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.<\\/p>\",\"key_feature_right\":\"<p>The&nbsp;<strong>left selection key<\\/strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.<\\/p>\",\"price\":\"2200.00\",\"description\":\"<p>The&nbsp;<strong>left selection key<\\/strong> serves as a menu access button&nbsp;that opens a pop-up menu when pressed. This key provides quick access to context-sensitive options and functions depending on what screen or&nbsp;application is currently active.&nbsp;The left key is&nbsp;fully customizable through&nbsp;the phone\'s shortcut settings, allowing users to assign frequently&nbsp;used phone functions for quick access.<\\/p>\",\"primary_image\":\"products\\/XjXF3Ncy2fV9rvgbPnERCsVtIPZCUMruRGZBAfDK.png\",\"secondary_images\":[\"products\\/qVEmYrPCU3J4fomZFH3MFlfpCrIzFZyRwNusc3Tq.png\"],\"video_url\":null,\"stock\":100,\"status\":\"sell\",\"created_at\":\"2025-09-23T05:29:20.000000Z\",\"updated_at\":\"2025-09-23T05:33:21.000000Z\"},\"variations\":[]},{\"id\":57,\"customer_id\":4,\"product_id\":3,\"quantity\":1,\"created_at\":\"2025-09-23T06:02:34.000000Z\",\"updated_at\":\"2025-09-23T06:02:34.000000Z\",\"product\":{\"id\":3,\"name\":\"Google Pixel USB-C earbuds\",\"slug\":\"google-pixel-usbc-earbuds\",\"category_id\":5,\"subcategory_id\":13,\"key_feature_left\":\"<ul>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks<\\/li>\\r\\n<\\/ul>\",\"key_feature_right\":\"<ul>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">With its premium quality speakers and 24-bit digital audio system delivers a pure and immersive digital audio<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Google Assistant becomes your assistant on the go to control your music, get directions, make calls, text, and manage daily tasks<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Real-time Translation with&nbsp; Google Translate reduces your worry about translating languages when you are abroad or with foreigners&nbsp;<\\/li>\\r\\n<li dir=\\\"ltr\\\" role=\\\"presentation\\\">Always be up to date with your latest notifications without reaching out to your phone by pressing and holding the Volume up button<\\/li>\\r\\n<\\/ul>\",\"price\":\"2200.00\",\"description\":\"<p>Experience the ultimate audio pleasure with&nbsp;<a href=\\\"https:\\/\\/www.applegadgetsbd.com\\/brands\\/google\\\">Google<\\/a> Pixel USB-C Earbuds. Designed for both comfort and clarity, these earbuds offer an immersive way to enjoy music, podcasts, and more. Their ergonomic design ensures hours of comfortable wear, while the exceptional sound quality elevates your listening experience. Seamlessly switch between calls and music with the built-in microphone, and harness the power of Google Assistant for added convenience. Indulge in uninterrupted audio bliss with these versatile earbuds.<\\/p>\",\"primary_image\":\"products\\/Xflad0fpBTzGa4oAqEzVu9okEgOXcd49Q8bcp9NZ.png\",\"secondary_images\":[\"products\\/vbBwWhLdIeQUd0kVPBHkaag37sEzuS5mOPVzonrZ.png\",\"products\\/eQ8A32Y4OEPMM4dvq9UQulnUA4CdOkEkmFtFj717.png\",\"products\\/PBIjUTbxPrvnYE18irZmL8KQW9Veb587PLD7n9ep.png\"],\"video_url\":\"https:\\/\\/youtu.be\\/3zQWMvI5DP0?feature=shared\",\"stock\":50,\"status\":\"sell\",\"created_at\":\"2025-09-22T18:21:07.000000Z\",\"updated_at\":\"2025-09-22T18:21:07.000000Z\"},\"variations\":[]}]', 140140.00, '2025-09-23 06:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `photo` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `role`, `photo`, `phone`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Madmin', 'madmin2309', 'admin@gmail.com', NULL, '$2y$12$YQEgymuzy2GSi5koW7xUu.3Ucc.1alVi367YN9AM/8GciXUS1oxIS', 'admin', NULL, NULL, 'active', 'BnWSkTAGGcay8gDWYC2Lj5gCxGj1riDT2dAc56BSNKvcXH6FsHbTodqULAUa', NULL, '2025-09-22 06:18:21'),
(2, 'Md. Abdullah Mahmud Adib', 'md-abdullah-mahmud-adib_6375', 'adib@gmail.com', NULL, '$2y$12$hxgCXAkwrdRS8oJk1q8MTeIhwfY3Zg6Tdk78NWBVbwQCm1hrJeEaK', 'customer', 'profile_photos/NNaGx8O7IK5IfNSjKwf7ygkejC0lfXqoXEdhi0bT.jpg', '01521776375', 'active', 'FNLi2D5XEIL7GkUo6RUIMgosjYH2eHmuvuA12SWnRrEGC6gSxeK50Rli63UQ', '2025-09-22 11:08:03', '2025-09-22 19:24:12'),
(3, 'Md. Mamun-Or-Rashid', 'md-mamun-or-rashid_5177', '200101.cse@student.just.edu.bd', NULL, '$2y$12$/bPiAeTuLBaB4fwhJC.P3us3Ce8bJV6LMCwMl/D2r09IrnxvCP3Sy', 'customer', 'avatar.png', '01707695177', 'active', NULL, '2025-09-23 03:57:39', '2025-09-23 05:16:22'),
(4, 'Ashraful Hossain', 'ashraful-hossain_2335', 'valochele@gmail.com', NULL, '$2y$12$9LAS8xaPpGrv8C3xEO0/0ushOihuka8O3nC4aYNOOxnkyBMtA8In2', 'customer', 'avatar.png', '01237892335', 'active', NULL, '2025-09-23 05:09:29', '2025-09-23 05:09:29'),
(5, 'Tahsin Arafat', 'tahsin-arafat_3449', 'tahsin@gmail.com', NULL, '$2y$12$9oovYMT5dsFQJkDFFGkBCed/LIBMqZFe52Iq301HPbsSloPWDuMdy', 'customer', 'profile_photos/E3c3TMfInjPAS4Bh5MYaDyibc4iSBML0NVioAcWC.png', '01456823449', 'active', 'hFYMnkiOc19gOuCCCoFa2zq9h8zhAToXaD4elrppYgneS4PsweRgASnNIfDX', '2025-09-23 05:44:54', '2025-09-23 06:08:25'),
(6, 'Pranto Bala', 'pranto-bala_5991', 'pranto@gamil.com', NULL, '$2y$12$k5mQMw.bPa4vcnDsyMAYJ./9f3J1c7cDxkHvcbIslnhRbA1tyIu7m', 'customer', 'avatar.png', '01823465991', 'active', NULL, '2025-09-23 05:46:09', '2025-09-23 05:46:09'),
(7, 'choton Barman', 'choton-barman_5003', 'Choton@gmail.com', NULL, '$2y$12$bT5Dr3gZAy5eYYMWUIRFFeVYVY/gVd6b3XPI5HIOVqHxmV.isbHKu', 'customer', 'avatar.png', '01837465003', 'active', NULL, '2025-09-23 05:47:04', '2025-09-23 05:47:04'),
(8, 'Rahat Hossain', 'rahat-hossain_8559', 'rahat@gmail.com', NULL, '$2y$12$hx6qT7kB4myMtkNf9AFCTeilA5/sfnuM5ZMHrPvwIbIY1NRTox6lu', 'customer', 'avatar.png', '01823408559', 'active', NULL, '2025-09-23 05:48:16', '2025-09-23 05:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `variation_attribute_values`
--

CREATE TABLE `variation_attribute_values` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_variation_id` bigint(20) UNSIGNED NOT NULL,
  `attribute_value_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variation_attribute_values`
--

INSERT INTO `variation_attribute_values` (`id`, `product_variation_id`, `attribute_value_id`, `created_at`, `updated_at`) VALUES
(1, 1, 23, NULL, NULL),
(2, 1, 16, NULL, NULL),
(3, 1, 7, NULL, NULL),
(4, 2, 23, NULL, NULL),
(5, 2, 16, NULL, NULL),
(6, 2, 8, NULL, NULL),
(7, 3, 23, NULL, NULL),
(8, 3, 17, NULL, NULL),
(9, 3, 7, NULL, NULL),
(10, 4, 23, NULL, NULL),
(11, 4, 17, NULL, NULL),
(12, 4, 8, NULL, NULL),
(13, 5, 23, NULL, NULL),
(14, 5, 18, NULL, NULL),
(15, 5, 7, NULL, NULL),
(16, 6, 23, NULL, NULL),
(17, 6, 18, NULL, NULL),
(18, 6, 8, NULL, NULL),
(19, 7, 24, NULL, NULL),
(20, 7, 16, NULL, NULL),
(21, 7, 7, NULL, NULL),
(22, 8, 24, NULL, NULL),
(23, 8, 16, NULL, NULL),
(24, 8, 8, NULL, NULL),
(25, 9, 24, NULL, NULL),
(26, 9, 17, NULL, NULL),
(27, 9, 7, NULL, NULL),
(28, 10, 24, NULL, NULL),
(29, 10, 17, NULL, NULL),
(30, 10, 8, NULL, NULL),
(31, 11, 24, NULL, NULL),
(32, 11, 18, NULL, NULL),
(33, 11, 7, NULL, NULL),
(34, 12, 24, NULL, NULL),
(35, 12, 18, NULL, NULL),
(36, 12, 8, NULL, NULL),
(37, 13, 25, NULL, NULL),
(38, 13, 16, NULL, NULL),
(39, 13, 7, NULL, NULL),
(40, 14, 25, NULL, NULL),
(41, 14, 16, NULL, NULL),
(42, 14, 8, NULL, NULL),
(43, 15, 25, NULL, NULL),
(44, 15, 17, NULL, NULL),
(45, 15, 7, NULL, NULL),
(46, 16, 25, NULL, NULL),
(47, 16, 17, NULL, NULL),
(48, 16, 8, NULL, NULL),
(49, 17, 25, NULL, NULL),
(50, 17, 18, NULL, NULL),
(51, 17, 7, NULL, NULL),
(52, 18, 25, NULL, NULL),
(53, 18, 18, NULL, NULL),
(54, 18, 8, NULL, NULL),
(55, 19, 28, NULL, NULL),
(56, 19, 16, NULL, NULL),
(57, 19, 7, NULL, NULL),
(58, 20, 28, NULL, NULL),
(59, 20, 16, NULL, NULL),
(60, 20, 8, NULL, NULL),
(61, 21, 28, NULL, NULL),
(62, 21, 17, NULL, NULL),
(63, 21, 7, NULL, NULL),
(64, 22, 28, NULL, NULL),
(65, 22, 17, NULL, NULL),
(66, 22, 8, NULL, NULL),
(67, 23, 28, NULL, NULL),
(68, 23, 18, NULL, NULL),
(69, 23, 7, NULL, NULL),
(70, 24, 28, NULL, NULL),
(71, 24, 18, NULL, NULL),
(72, 24, 8, NULL, NULL),
(73, 25, 25, NULL, NULL),
(74, 25, 14, NULL, NULL),
(75, 25, 10, NULL, NULL),
(76, 26, 25, NULL, NULL),
(77, 26, 14, NULL, NULL),
(78, 26, 11, NULL, NULL),
(79, 27, 25, NULL, NULL),
(80, 27, 14, NULL, NULL),
(81, 27, 12, NULL, NULL),
(82, 28, 25, NULL, NULL),
(83, 28, 14, NULL, NULL),
(84, 28, 13, NULL, NULL),
(85, 29, 25, NULL, NULL),
(86, 29, 17, NULL, NULL),
(87, 29, 10, NULL, NULL),
(88, 30, 25, NULL, NULL),
(89, 30, 17, NULL, NULL),
(90, 30, 11, NULL, NULL),
(91, 31, 25, NULL, NULL),
(92, 31, 17, NULL, NULL),
(93, 31, 12, NULL, NULL),
(94, 32, 25, NULL, NULL),
(95, 32, 17, NULL, NULL),
(96, 32, 13, NULL, NULL),
(97, 33, 27, NULL, NULL),
(98, 33, 14, NULL, NULL),
(99, 33, 10, NULL, NULL),
(100, 34, 27, NULL, NULL),
(101, 34, 14, NULL, NULL),
(102, 34, 11, NULL, NULL),
(103, 35, 27, NULL, NULL),
(104, 35, 14, NULL, NULL),
(105, 35, 12, NULL, NULL),
(106, 36, 27, NULL, NULL),
(107, 36, 14, NULL, NULL),
(108, 36, 13, NULL, NULL),
(109, 37, 27, NULL, NULL),
(110, 37, 17, NULL, NULL),
(111, 37, 10, NULL, NULL),
(112, 38, 27, NULL, NULL),
(113, 38, 17, NULL, NULL),
(114, 38, 11, NULL, NULL),
(115, 39, 27, NULL, NULL),
(116, 39, 17, NULL, NULL),
(117, 39, 12, NULL, NULL),
(118, 40, 27, NULL, NULL),
(119, 40, 17, NULL, NULL),
(120, 40, 13, NULL, NULL),
(121, 41, 28, NULL, NULL),
(122, 41, 14, NULL, NULL),
(123, 41, 10, NULL, NULL),
(124, 42, 28, NULL, NULL),
(125, 42, 14, NULL, NULL),
(126, 42, 11, NULL, NULL),
(127, 43, 28, NULL, NULL),
(128, 43, 14, NULL, NULL),
(129, 43, 12, NULL, NULL),
(130, 44, 28, NULL, NULL),
(131, 44, 14, NULL, NULL),
(132, 44, 13, NULL, NULL),
(133, 45, 28, NULL, NULL),
(134, 45, 17, NULL, NULL),
(135, 45, 10, NULL, NULL),
(136, 46, 28, NULL, NULL),
(137, 46, 17, NULL, NULL),
(138, 46, 11, NULL, NULL),
(139, 47, 28, NULL, NULL),
(140, 47, 17, NULL, NULL),
(141, 47, 12, NULL, NULL),
(142, 48, 28, NULL, NULL),
(143, 48, 17, NULL, NULL),
(144, 48, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_values_attribute_id_foreign` (`attribute_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_customer_id_foreign` (`customer_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `cart_variations`
--
ALTER TABLE `cart_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_variations_cart_id_foreign` (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variations_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reviews_customer_id_product_id_unique` (`customer_id`,`product_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategories_slug_unique` (`slug`),
  ADD KEY `subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_orders`
--
ALTER TABLE `temp_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variation_attribute_values`
--
ALTER TABLE `variation_attribute_values`
  ADD PRIMARY KEY (`id`),
  ADD KEY `variation_attribute_values_product_variation_id_foreign` (`product_variation_id`),
  ADD KEY `variation_attribute_values_attribute_value_id_foreign` (`attribute_value_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wishlists_customer_id_product_id_unique` (`customer_id`,`product_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_values`
--
ALTER TABLE `attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `cart_variations`
--
ALTER TABLE `cart_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `temp_orders`
--
ALTER TABLE `temp_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `variation_attribute_values`
--
ALTER TABLE `variation_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_values`
--
ALTER TABLE `attribute_values`
  ADD CONSTRAINT `attribute_values_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_variations`
--
ALTER TABLE `cart_variations`
  ADD CONSTRAINT `cart_variations_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variations`
--
ALTER TABLE `product_variations`
  ADD CONSTRAINT `product_variations_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `variation_attribute_values`
--
ALTER TABLE `variation_attribute_values`
  ADD CONSTRAINT `variation_attribute_values_attribute_value_id_foreign` FOREIGN KEY (`attribute_value_id`) REFERENCES `attribute_values` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `variation_attribute_values_product_variation_id_foreign` FOREIGN KEY (`product_variation_id`) REFERENCES `product_variations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 22, 2025 at 01:07 PM
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
(13, '2025_09_19_170817_variation_attribute_values', 3);

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
(1, 'i Phone 13', 'i-phone-13', 1, 4, '<ul>\r\n<li data-start=\"94\" data-end=\"137\">\r\n<p data-start=\"96\" data-end=\"137\"><strong>Display:</strong> 6.1-inch Super Retina XDR OLED</p>\r\n</li>\r\n<li data-start=\"138\" data-end=\"186\">\r\n<p data-start=\"140\" data-end=\"186\"><strong>Camera:</strong> Dual 12MP system (Wide + Ultra Wide)</p>\r\n</li>\r\n<li data-start=\"187\" data-end=\"219\">\r\n<p data-start=\"189\" data-end=\"219\"><strong>Front Camera:</strong> 12MP TrueDepth</p>\r\n</li>\r\n<li data-start=\"220\" data-end=\"262\">\r\n<p data-start=\"222\" data-end=\"262\"><strong>Battery:</strong> Up to 19 hours video playback</p>\r\n</li>\r\n</ul>', '<ul>\r\n<li data-start=\"281\" data-end=\"311\">\r\n<p data-start=\"283\" data-end=\"311\"><strong>Processor:</strong> A15 Bionic chip</p>\r\n</li>\r\n<li data-start=\"312\" data-end=\"394\">\r\n<p data-start=\"314\" data-end=\"394\"><strong>Storage:</strong> 4GB RAM | 128GB ROM (base model, expandable up to 512GB/1TB variants)</p>\r\n</li>\r\n<li data-start=\"395\" data-end=\"422\">\r\n<p data-start=\"397\" data-end=\"422\"><strong>OS:</strong> iOS 15 (upgradable)</p>\r\n</li>\r\n<li data-start=\"423\" data-end=\"467\">\r\n<p data-start=\"425\" data-end=\"467\"><strong>Connectivity:</strong> 5G, Wi-Fi 6, Bluetooth 5.0</p>\r\n</li>\r\n</ul>', 61500.00, '<p data-start=\"0\" data-end=\"490\">iPhone 13 comes with a stunning <strong>6.1-inch Super Retina XDR OLED display</strong> that delivers vibrant colors and sharp details, making every image and video look more immersive. The <strong>dual 12MP rear camera</strong> system with Wide and Ultra Wide lenses captures professional-quality photos, even in low light, while the <strong>12MP TrueDepth front camera</strong> is perfect for selfies and FaceTime calls. Powered by the<strong> A15 Bionic chip</strong>, it ensures lightning-fast performance, smooth multitasking, and efficient power use.</p>\r\n<p data-start=\"492\" data-end=\"1017\">This model includes <strong>4GB RAM and 128G</strong>B of storage(We have more variants of <strong>4GB + 256 GB</strong> also), giving you plenty of space for apps, photos, and videos. With 5G connectivity, you can enjoy faster downloads and seamless streaming. The device also supports Wi-Fi 6 and Bluetooth 5.0 for a strong and stable connection. A long-lasting battery provides up to 19 hours of video playback, ensuring you stay powered throughout the day. Running on iOS 15 with upgrade support, the iPhone 13 offers the latest features, security, and seamless integration with Apple&rsquo;s ecosystem.</p>', 'products/ZuYw0OOWr4HubxuAIhmIDRCdSeaRPgZDr137OwyC.webp', '[\"products\\/xoYjJvkyD9d7ELLN3Xd2uLC9uovfeO9ySo62bRML.webp\",\"products\\/Ymdi7IVjwO4aaEG0jnFWJLqAMkMTwDeUnwrdjwGH.webp\",\"products\\/eDJenRakt9HwB0sGMvLNqWeamqL4ICodygYMqIBx.webp\"]', 'https://www.youtube.com/watch?v=kdepgkh4Ve4', 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:52:24');

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
(24, 1, 'Color: Pink Country: China Storage: 4GB + 256GB', 68000.00, 500, 'sell', '2025-09-22 06:50:45', '2025-09-22 06:50:45');

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
('vw14THSbTZwVNB2LocGoORABs5QH01ti5NhNOQDp', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36 Edg/140.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRjFSTUVxSUxibHJzMHRaWE8wbjdlY0ZBZTRPcU5qVFN3VjZxdDhGSiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1758524044);

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
(12, 1, 'Sony Xperia', 'sony-xperia', 'subcategories/U6w3X8gupG3pagTwnQrWjnQsjFq5oSCz8pQB2cCh.png', '2025-09-22 06:33:56', '2025-09-22 06:33:56');

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
(1, 'Madmin', 'madmin2309', 'admin@gmail.com', NULL, '$2y$12$YQEgymuzy2GSi5koW7xUu.3Ucc.1alVi367YN9AM/8GciXUS1oxIS', 'admin', NULL, NULL, 'active', 'Dddt59t0AoUDMtj0JLQnF5XyHMAaa32VkwJGNEsSrqityeo0quUi8aJ3fY8K', NULL, '2025-09-22 06:18:21');

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
(72, 24, 8, NULL, NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_variations`
--
ALTER TABLE `cart_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_variations`
--
ALTER TABLE `product_variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variation_attribute_values`
--
ALTER TABLE `variation_attribute_values`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

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

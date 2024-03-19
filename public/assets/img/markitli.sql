-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 04:25 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `markitli`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `displayed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `description`, `displayed`, `created_at`, `updated_at`) VALUES
(1, 'Doloribus reprehende', '<p>ewdfwefdwcfer</p>', 0, '2023-05-09 10:59:53', '2023-05-09 11:00:30');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_detials_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `total` double(8,2) NOT NULL,
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
  `image` varchar(255) NOT NULL,
  `displayed` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `displayed`, `created_at`, `updated_at`) VALUES
(3, 'Hamish Becker', 'categories/hzTxcfIRu6G1X0vPcgRglpDSLH8FmDj0rKKAJDNR.png', 1, '2023-05-09 10:21:04', '2023-05-09 10:25:16'),
(4, 'الكترونيات', 'categories/nl54nCCYIDyPhqOlfjiQzWVYrrqARlghIzE8yXMV.png', 1, '2023-05-19 12:50:51', '2023-05-19 12:50:51'),
(5, 'تصميمات', 'categories/NR45IjrcCMz0tHG90tbvFbQhmA0QO1a517TDoasE.png', 1, '2023-05-19 12:51:28', '2023-05-19 12:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `code`, `created_at`, `updated_at`) VALUES
(1, '#e5a2f7', '2023-05-14 10:20:43', '2023-05-14 10:20:43'),
(2, '#9fa566', '2023-05-14 11:16:52', '2023-05-14 11:16:52'),
(3, '#f85617', '2023-05-14 11:43:37', '2023-05-14 11:43:37'),
(4, '#ff0000', '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(5, '#7300ff', '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(6, '#ff5900', '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(7, '#00ffb3', '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(8, '#eeff00', '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(9, '#ff0088', '2023-05-19 12:57:41', '2023-05-19 12:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subjecet` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `phone`, `email`, `subjecet`, `message`, `created_at`, `updated_at`) VALUES
(1, 'Jenna Mckinney', '+1 (424) 658-8464', 'zajivisad@mailinator.com', 'Nisi occaecat lorem', 'Id nihil eiusmod ips', '2023-05-20 14:23:35', '2023-05-20 14:23:35');

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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'products/VH8Cs0cdrFdhJRncXXKOBqckZG4JU7dCQb0sq5sD.png', 1, '2023-05-14 10:20:43', '2023-05-14 10:20:43'),
(2, 'products/HQQZ0LffXdQ5K9QlLakhkJ1K37fRCgYbUvYWCGID.png', 1, '2023-05-14 10:20:43', '2023-05-14 10:20:43'),
(3, 'products/Fh9mm4tx1JSRih2vcEVboj06FfCbYYTkvP4bXQLh.png', 1, '2023-05-14 10:20:43', '2023-05-14 10:20:43'),
(4, 'products/DHBnGwbLt7tCnpDmsm2eePH4XZ74mZN8jitsikhi.png', 1, '2023-05-14 10:20:43', '2023-05-14 10:20:43'),
(5, 'products/dnPQJRhVNhpXuR9EkdeDK7SxxWlGDkLLGHzZelsk.png', 1, '2023-05-14 10:20:43', '2023-05-14 10:20:43'),
(6, 'products/bzUwOEf2llBXKkZAMEiwhnlEVHMgPpXxRnKqopYw.png', 1, '2023-05-14 10:20:43', '2023-05-14 10:20:43'),
(11, 'products/zSjM3uaogyth7Sv9NAgOqf4QwgLSyClpwr8RfpZv.png', 4, '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(12, 'products/nc5TEsJd9PpFriYhTTwoVfTETbNCzuJnkdjPJAG4.jpg', 4, '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(13, 'products/oV4q9NToD4D7GtOriPegfhviJ5BgXfFFRNQAckNO.png', 4, '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(14, 'products/qZ1C6Mvv2ti9L0rHeK8gZQGEr96DMjbLtQ6iBfKF.png', 4, '2023-05-19 12:57:41', '2023-05-19 12:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `infos`
--

CREATE TABLE `infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2000_05_05_230405_create_roles_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_05_05_230450_create_permissions_table', 1),
(7, '2023_05_05_230521_create_user_permissions_table', 1),
(8, '2023_05_05_230546_create_settings_table', 1),
(9, '2023_05_05_230608_create_infos_table', 1),
(10, '2023_05_05_230625_create_socials_table', 1),
(11, '2023_05_05_230648_create_abouts_table', 1),
(12, '2023_05_05_230715_create_terms_table', 1),
(13, '2023_05_05_230738_create_privaces_table', 1),
(14, '2023_05_05_230801_create_categories_table', 1),
(15, '2023_05_05_230819_create_colors_table', 1),
(16, '2023_05_05_230835_create_sizes_table', 1),
(17, '2023_05_05_230856_create_products_table', 1),
(18, '2023_05_05_230915_create_images_table', 1),
(19, '2023_05_05_230935_create_product_detials_table', 1),
(20, '2023_05_05_230955_create_orders_table', 1),
(21, '2023_05_05_231013_create_order_detials_table', 1),
(22, '2023_05_05_231032_create_carts_table', 1),
(23, '2023_05_05_231051_create_wallets_table', 1),
(24, '2023_05_09_112414_create_user_detials_table', 2),
(25, '2023_05_09_113639_create_sliders_table', 2),
(26, '2023_05_14_150701_create_product_updates_table', 2),
(27, '2023_05_14_150738_create_product_updates_detials_table', 2),
(28, '2023_05_14_150852_create_product_updates_images_table', 2),
(29, '2023_05_20_171201_create_contacts_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `total` double(8,2) NOT NULL,
  `commission` double(8,2) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_detials`
--

CREATE TABLE `order_detials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_detials_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `total` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'setting_change', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(2, 'admin_create', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(3, 'admin_edit', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(4, 'admin_delete', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(5, 'merchant_create', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(6, 'merchant_edit', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(7, 'merchant_delete', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(8, 'marketer_create', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(9, 'marketer_edit', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(10, 'marketer_delete', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(11, 'category_create', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(12, 'category_edit', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(13, 'category_delete', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(14, 'social_create', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(15, 'social_edit', '2023-05-09 06:38:29', '2023-05-09 06:38:29'),
(16, 'social_delete', '2023-05-09 06:38:29', '2023-05-09 06:38:29'),
(17, 'term_create', '2023-05-09 07:47:46', '2023-05-09 07:47:46'),
(18, 'term_edit', '2023-05-09 07:47:46', '2023-05-09 07:47:46'),
(19, 'term_delete', '2023-05-09 07:48:18', '2023-05-09 07:48:18'),
(20, 'about_create', '2023-05-09 07:48:18', '2023-05-09 07:48:18'),
(21, 'about_edit', '2023-05-09 07:48:18', '2023-05-09 07:48:18'),
(22, 'about_delete', '2023-05-09 07:48:18', '2023-05-09 07:48:18'),
(23, 'size_create', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(24, 'size_edit', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(25, 'size_delete', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(29, 'marketer', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(30, 'merchant', '2023-05-09 06:38:28', '2023-05-09 06:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `privaces`
--

CREATE TABLE `privaces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `displayed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `count` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `displayed` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `count`, `user_id`, `category_id`, `displayed`, `created_at`, `updated_at`) VALUES
(1, 'Galvin George', '<p>نتهننننننننننننننننننننننننننننننننننننننننننننننننننننننننننننن</p>', 6, 1, 3, 1, '2023-05-14 10:20:43', '2023-05-14 10:34:52'),
(4, 'تصميم 1', '<p>علم قائم على درس نصّ كتابيّ وإيضاح معناه بحسب قواعد النقد العلميّ،</p><p>وفقه اللغة والتقليد العقائديّ، وبيان ما هو غامض فيه أو ما هو مدعاة للجدل، نقيض المتن.</p>', 490, 1, 5, 1, '2023-05-19 12:57:41', '2023-05-19 12:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_detials`
--

CREATE TABLE `product_detials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` double(8,2) NOT NULL,
  `count` int(11) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_detials`
--

INSERT INTO `product_detials` (`id`, `price`, `count`, `product_id`, `color_id`, `size_id`, `created_at`, `updated_at`) VALUES
(4, 200.00, 150, 4, 4, 4, '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(5, 150.00, 200, 4, 5, 5, '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(6, 100.00, 50, 4, 6, 6, '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(7, 101.00, 20, 4, 7, 6, '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(8, 201.00, 30, 4, 8, 4, '2023-05-19 12:57:41', '2023-05-19 12:57:41'),
(9, 151.00, 40, 4, 9, 5, '2023-05-19 12:57:41', '2023-05-19 12:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_updates`
--

CREATE TABLE `product_updates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `update_number` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `count` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_updates_detials`
--

CREATE TABLE `product_updates_detials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `product_updates_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `price` float(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_updates_images`
--

CREATE TABLE `product_updates_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `product_updates_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(2, 'admin', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(3, 'marketer', '2023-05-09 06:38:28', '2023-05-09 06:38:28'),
(4, 'merchant', '2023-05-09 06:38:28', '2023-05-09 06:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name_ar` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `site_status` tinyint(4) NOT NULL DEFAULT 0,
  `closed_message_ar` longtext NOT NULL,
  `amount` int(11) NOT NULL,
  `mail_user` varchar(255) NOT NULL,
  `mail_password` varchar(255) NOT NULL,
  `mail_address` varchar(255) NOT NULL,
  `mail_host` varchar(255) NOT NULL,
  `firebase_key` longtext NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name_ar`, `phone`, `email`, `site_status`, `closed_message_ar`, `amount`, `mail_user`, `mail_password`, `mail_address`, `mail_host`, `firebase_key`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Gabriel Maynard', '+1 (322) 346-5423', 'xuku@mailinator.com', 0, 'Quod et enim exceptu', 42, 'radore@mailinator.com', 'hgdechsdgdg', 'hipowaxoqu@mailinator.com', 'necifydi@mailinator.com', 'Sunt accusamus sit', 'settings/BTubLMBZ7tGz2w1L5wWI9EFTTBvGdGw2giny0s2I.jpg', '2023-05-20 13:44:37', '2023-05-20 14:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Voluptate explicabo', 1, '2023-05-14 10:20:17', '2023-05-14 10:20:17'),
(4, 'XL', 1, '2023-05-19 12:49:42', '2023-05-19 12:49:42'),
(5, 'M', 1, '2023-05-19 12:49:58', '2023-05-19 12:49:58'),
(6, 'S', 1, '2023-05-19 12:50:08', '2023-05-19 12:50:08'),
(7, 'xl', 11, '2023-05-20 09:55:05', '2023-05-20 09:55:05');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `socials`
--

CREATE TABLE `socials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `link` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `displayed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `displayed` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `title`, `description`, `displayed`, `created_at`, `updated_at`) VALUES
(1, 'Inventore qui sit in', '<p>يثبصثبؤصثبؤصث</p>', 1, '2023-05-09 11:05:29', '2023-05-09 11:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `role_id`, `remember_token`, `verified`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super.admin@gmail.com', '00000000000', NULL, '$2y$10$Uj1dv2cGAJqO2TaOtiG7f.z3ga.V77Ktih4Wc2ODaOImJYO8G/jLa', 1, NULL, 0, '2023-05-09 06:38:29', '2023-05-09 06:38:29'),
(5, 'Dacey Jennings', 'ahmed@gmail.com', '+1 (111) 465-3814', NULL, '$2y$10$ra1OsA51eDGtnCZMxbgGPuQwnrISUoL2Q3gqxULGu8QP.ClaZoi9O', 2, NULL, 1, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(10, 'Desiree Ryan', 'kipivo@mailinator.com', '2561671671', NULL, '$2y$10$Uj1dv2cGAJqO2TaOtiG7f.z3ga.V77Ktih4Wc2ODaOImJYO8G/jLa', 3, NULL, 1, '2023-05-19 17:20:55', '2023-05-19 17:20:55'),
(11, 'Olympia Whitney', 'kakexok@mailinator.com', '+1 (371) 871-3406', NULL, '$2y$10$7MwvfadAWs6bo72YVoWsFOs3MGwSnq54UqJUGWxevAYQ9bsRJDpCi', 4, NULL, 1, '2023-05-20 09:47:48', '2023-05-20 09:47:48'),
(14, 'Cheryl Hines', 'wyxupub@mailinator.com', '+1 (848) 368-5343', NULL, '$2y$10$xXnntV0c3ff2oPyBSlP1GeDV/4RnSp0XBAEmG8MBt7yw8dlRLhdB2', 4, NULL, 1, '2023-05-20 11:06:36', '2023-05-20 11:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_detials`
--

CREATE TABLE `user_detials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(44, 5, 1, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(45, 5, 2, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(46, 5, 3, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(47, 5, 4, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(48, 5, 5, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(49, 5, 6, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(50, 5, 7, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(51, 5, 8, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(52, 5, 9, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(53, 5, 10, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(54, 5, 11, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(55, 5, 12, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(56, 5, 13, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(57, 5, 14, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(58, 5, 15, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(59, 5, 16, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(60, 5, 17, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(61, 5, 18, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(62, 5, 19, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(63, 5, 20, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(64, 5, 21, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(65, 5, 22, '2023-05-09 08:31:51', '2023-05-09 08:31:51'),
(66, 10, 29, '2023-05-19 18:38:37', NULL),
(68, 11, 30, '2023-05-20 09:47:48', '2023-05-20 09:47:48'),
(69, 14, 30, '2023-05-20 11:06:36', '2023-05-20 11:06:36');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_detials_id_foreign` (`product_detials_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_product_id_foreign` (`product_id`);

--
-- Indexes for table `infos`
--
ALTER TABLE `infos`
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
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_detials`
--
ALTER TABLE `order_detials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_detials_product_detials_id_foreign` (`product_detials_id`),
  ADD KEY `order_detials_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `privaces`
--
ALTER TABLE `privaces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `product_detials`
--
ALTER TABLE `product_detials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_detials_product_id_foreign` (`product_id`),
  ADD KEY `product_detials_color_id_foreign` (`color_id`),
  ADD KEY `product_detials_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_updates`
--
ALTER TABLE `product_updates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_updates_user_id_foreign` (`user_id`),
  ADD KEY `product_updates_category_id_foreign` (`category_id`),
  ADD KEY `product_updates_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_updates_detials`
--
ALTER TABLE `product_updates_detials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_updates_detials_product_updates_id_foreign` (`product_updates_id`),
  ADD KEY `product_updates_detials_color_id_foreign` (`color_id`),
  ADD KEY `product_updates_detials_size_id_foreign` (`size_id`);

--
-- Indexes for table `product_updates_images`
--
ALTER TABLE `product_updates_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_updates_images_product_updates_id_foreign` (`product_updates_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `socials`
--
ALTER TABLE `socials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_detials`
--
ALTER TABLE `user_detials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_permissions_user_id_foreign` (`user_id`),
  ADD KEY `user_permissions_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wallets_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `infos`
--
ALTER TABLE `infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_detials`
--
ALTER TABLE `order_detials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privaces`
--
ALTER TABLE `privaces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_detials`
--
ALTER TABLE `product_detials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_updates`
--
ALTER TABLE `product_updates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_updates_detials`
--
ALTER TABLE `product_updates_detials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_updates_images`
--
ALTER TABLE `product_updates_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `socials`
--
ALTER TABLE `socials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_detials`
--
ALTER TABLE `user_detials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_detials_id_foreign` FOREIGN KEY (`product_detials_id`) REFERENCES `product_detials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_detials`
--
ALTER TABLE `order_detials`
  ADD CONSTRAINT `order_detials_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_detials_product_detials_id_foreign` FOREIGN KEY (`product_detials_id`) REFERENCES `product_detials` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_detials`
--
ALTER TABLE `product_detials`
  ADD CONSTRAINT `product_detials_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_detials_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_detials_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_updates`
--
ALTER TABLE `product_updates`
  ADD CONSTRAINT `product_updates_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_updates_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_updates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_updates_detials`
--
ALTER TABLE `product_updates_detials`
  ADD CONSTRAINT `product_updates_detials_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_updates_detials_product_updates_id_foreign` FOREIGN KEY (`product_updates_id`) REFERENCES `product_updates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_updates_detials_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_updates_images`
--
ALTER TABLE `product_updates_images`
  ADD CONSTRAINT `product_updates_images_product_updates_id_foreign` FOREIGN KEY (`product_updates_id`) REFERENCES `product_updates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `sizes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD CONSTRAINT `user_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Sep 2023 pada 12.55
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang_jabek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Kategori A', '2023-08-25 04:23:06', '2023-08-25 04:23:06'),
(3, 'Kategori B', '2023-08-25 07:06:15', '2023-08-25 07:06:15'),
(11, '/', '2023-09-04 08:02:39', '2023-09-04 08:02:39'),
(12, 'FOOD', '2023-09-04 08:02:39', '2023-09-04 08:02:39'),
(13, 'NON FOOD', '2023-09-04 08:02:40', '2023-09-04 08:02:40'),
(14, 'SAMPINGAN', '2023-09-04 08:02:40', '2023-09-04 08:02:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_orders`
--

CREATE TABLE `delivery_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record_at` datetime DEFAULT NULL,
  `sum_total_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sum_percent_price_markup` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sum_total_price` decimal(15,3) DEFAULT 0.000,
  `status` enum('0','1') DEFAULT '0',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `delivery_order_items`
--

CREATE TABLE `delivery_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(100) NOT NULL,
  `cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `percent_price_markup` decimal(15,2) DEFAULT 0.00,
  `total_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `departements`
--

INSERT INTO `departements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Produksi', '2023-08-25 04:56:29', '2023-08-25 04:56:29'),
(4, 'Pengiriman', '2023-08-25 08:03:11', '2023-08-25 08:03:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `unit_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `current_cost` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `items`
--

INSERT INTO `items` (`id`, `category_id`, `unit_id`, `code`, `name`, `current_cost`, `created_at`, `updated_at`) VALUES
(7, 11, 1, '10654', 'Kemplang Besar My Emak', '15500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(8, 11, 1, '10653', 'Kemplang Kecil My Emak', '5500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(9, 11, 1, '10644', 'Keripik Nanas Darsa', '15000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(10, 11, 1, '10584', 'Lampung Gold 200gr', '29500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(11, 11, 1, '10643', 'MIx Fruit Darsa', '15000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(12, 11, 1, '10367', 'Teh Pucuk Harum Besar', '5900.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(13, 11, 1, '10368', 'Teh Pucuk Harum Kecil', '3134.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(14, 11, 1, '123456789', 'Barang Testing', '1000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(15, 11, 1, '000101', 'Produk Testing', '10000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(16, 11, 1, '000105', 'Produk Coba', '10000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(17, 11, 1, '10691', 'Gas Elpiji', '205000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(18, 11, 1, '10692', 'Galon', '3500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(19, 11, 1, '10696', 'Madu Sachet Suhita', '12000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(20, 11, 9, '10694', 'Abon', '125000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(21, 12, 1, '10001', 'Abon', '120000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(22, 12, 1, '10040', 'Cery Tangkai Merah Frutaneira', '378750.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(23, 12, 1, '10071', 'Elmer Choco Chip Dark Hr 4x3kg', '51666.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(24, 12, 1, '10087', 'Elmer Filling Pasta Tropical @ 4 X 5 Kg', '168750.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(25, 12, 1, '10512', 'Golden City Choc Ball (6x1kg)', '369075.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(26, 12, 1, '10251', 'Morin Kaya Pandan 2 X 5 Kg', '72150.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(27, 12, 1, '10252', 'Morin Kaya Paste 2 X 5 Kg', '72150.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(28, 12, 1, '10254', 'Morin Kelapa Muda Jam 5 X 2 Kg', '72150.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(29, 12, 1, '10323', 'Rich Battercream 12x907 Gr', '56907.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(30, 12, 1, '10540', 'Safari BTR Choc Coklat (30x100gr)', '4312.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(31, 12, 1, '10412', 'Snowhip Wiping-topping 12x1', '45916.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(32, 12, 1, '10342', 'Yangini-sosis Sapi Kombinasi 900 Gr', '70350.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(33, 12, 2, '10384', 'Black Cookies Crumb 5x1 Kg', '349000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(34, 12, 2, '10025', 'BOS 15 Kg', '474000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(35, 12, 2, '10364', 'Susu UHT Fc Indomilk Plain 950 Ml', '192000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(36, 12, 2, '10605', 'C\'Baking Syrup Silver BIB @25 Kg ( Gula Cair )', '320000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(37, 12, 2, '10681', 'Pondan Soft Ice Cream Van', '1062936.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(38, 12, 9, '10060', 'Daging Sapi', '105000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(39, 12, 9, '10061', 'Delmonte Extra Hot Pc 1 Kg @ 10 Bngks X 1 Kg', '20440.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(40, 12, 9, '10602', 'Lepatta Bakery Vanilla 10x1kg', '30830.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(41, 12, 9, '10620', 'LEPATTA REALFRUIT DURIAN 8x1 Kg', '63537.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(42, 12, 9, '10369', 'Telur Ayam', '25500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(43, 12, 10, '10119', 'Gula Rose', '660000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(44, 12, 10, '10121', 'Gusto Maffin Chocolate 10 Kg', '449328.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(45, 12, 10, '10122', 'Gusto Maffin Vanila 10 Kg', '344433.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(46, 12, 10, '10362', 'Susu Bubuk Ampec Biru', '1775000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(47, 12, 10, '10373', 'Terigu Perdana', '240000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(48, 12, 10, '10700', 'Maizena', '330000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(49, 12, 10, '10708', 'Cakra  Mas', '262000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(50, 12, 11, '10014', 'AMF', '1900000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(51, 12, 11, '10039', 'Cery Gundul Aptunion', '1183000.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(52, 12, 11, '10083', 'Elmer Dip Glaze Dark  Gold 2x5 Kg', '242500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(53, 12, 11, '10084', 'Elmer Dip Glaze Greantea  2x5kg', '232500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(54, 12, 11, '10442', 'Elmer Crunchy Chocomaltine 2x5 Kg', '307500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(55, 12, 11, '10574', 'SPONTEX 1X20 Kg', '680999.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(56, 12, 11, '10688', 'Elmer Dip Glaze Tiramizu Gold', '257500.00', '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(57, 12, 12, '10318', 'Prochise Spredable 8 X 2 Kg', '99750.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(58, 12, 12, '10377', 'Topchise 2 Kg 8x2kg', '89204.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(59, 13, 1, '10711', 'Lap Aneka', '23000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(60, 13, 1, '10712', 'Lap Pel', '85000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(61, 13, 9, '10035', 'Niacet Calcium Propionate Crystal 1x25kg', '72576.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(62, 13, 11, '10710', 'Kertas Koran', '175000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(63, 13, 13, '10413', 'Gas Elpiji', '205000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(64, 14, 1, '10569', 'Ante Besar', '18000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(65, 14, 1, '10045', 'Hagelslag Milk 4x2x12x80gr', '9662.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(66, 14, 1, '10062', 'Dodol Batangan Besar', '14500.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(67, 14, 1, '10063', 'Dodol Batangan Kecil', '10000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(68, 14, 1, '10064', 'Dodol Mika Rasa', '14500.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(69, 14, 1, '10065', 'Dodol Sirsak', '10000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(70, 14, 1, '10469', 'Keripik Tempe Rizky Bulat', '27000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(71, 14, 1, '10505', 'Keripik Tempe Rizky Kotak', '14000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(72, 14, 1, '10248', 'Morin Bluebarry Jam 12 X 170 Gram', '24050.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(73, 14, 1, '10249', 'Morin Chocolate Peanut 12 X 150 Gram', '21182.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(74, 14, 1, '10250', 'Morin Kaya Pandan 12 X  170 G', '16835.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(75, 14, 1, '10255', 'Morin Mixed Fruits Jam 12 X 170 G', '18130.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(76, 14, 1, '10257', 'Morin Orange Marmalade 12x170 G', '18685.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(77, 14, 1, '10259', 'Morin Peanut Butter 12 X 150 G', '20997.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(78, 14, 1, '10261', 'Morin Peanut Butter Chunky 12x150 G', '20997.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(79, 14, 1, '10262', 'Morin Pinapple Jam 12 X 170 Gram', '17020.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(80, 14, 1, '10265', 'Morin Strawbery Jam 12 X 170 Gram', '20350.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(81, 14, 1, '10482', 'Skm Biru Bendera 48x370gr', '11616.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(82, 14, 1, '10387', 'Tulip Hagelslag Choco  4x30x75gr', '6316.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(83, 14, 1, '10388', 'Tulip Hagelslag Warna 90g 4x30x90gr', '6316.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(84, 14, 1, '10682', 'Keripik Pisang Fanana All Rasa', '15500.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(85, 14, 1, '10683', 'Kerifik  Fanana Ubi Ungu', '16000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(86, 14, 1, '10684', 'Berty Sale Pisang', '12000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(87, 14, 1, '10685', 'Berty Tas Premium', '16500.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(88, 14, 1, '10686', 'Hagelslag 4x2x12x80 Gr', '9662.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(89, 14, 1, '10687', 'Hagelslag Festive 4x2x12x80 Gr', '9662.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(90, 14, 1, '10689', 'Sambal Oye All Variant', '23000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(91, 14, 1, '10690', 'Teh Pucuk Harum Besar Jasmine', '3780.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(92, 14, 1, '10697', 'Sale Madu', '17000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(93, 14, 1, '10698', 'Sale Tepung', '20000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(94, 14, 1, '10699', 'Keripik Lampung Rumah Ainun', '10000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(95, 14, 1, '10701', 'Brondong Jagung Original', '16500.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(96, 14, 1, '10702', 'Jipang', '16500.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(97, 14, 1, '10703', 'Jipang Kecil', '10000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(98, 14, 1, '10704', 'Ante Kecil', '9000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(99, 14, 1, '10705', 'Keripik Sale Pisang', '12000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(100, 14, 1, '10706', 'Opak Mini Rendang', '12000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(101, 14, 1, '10707', 'Opak Mini Telur Asin', '12000.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(102, 14, 1, '10709', 'Kopi Urian 20 Gr', '5500.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(103, 14, 2, '10310', 'Pocari Sweet Pet Besar 24 X 500 Ml', '154320.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(104, 14, 2, '10311', 'Pocari Sweet Pet Kecil 24 X350 Ml', '129600.00', '2023-09-04 08:48:52', '2023-09-04 08:48:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `item_supplier`
--

CREATE TABLE `item_supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `item_supplier`
--

INSERT INTO `item_supplier` (`id`, `item_id`, `supplier_id`) VALUES
(132, 7, 4),
(133, 9, 5),
(134, 10, 6),
(135, 12, 7),
(136, 14, 8),
(137, 17, 9),
(138, 19, 10),
(139, 20, 11),
(140, 22, 12),
(141, 23, 13),
(142, 25, 14),
(143, 26, 15),
(144, 29, 16),
(145, 31, 17),
(146, 32, 18),
(147, 38, 19),
(148, 39, 20),
(149, 40, 21),
(150, 42, 22),
(151, 43, 23),
(152, 46, 24),
(153, 47, 25),
(154, 48, 26),
(155, 57, 27),
(156, 59, 28),
(157, 63, 29),
(158, 64, 30),
(159, 65, 31),
(160, 66, 32),
(161, 70, 33),
(162, 81, 34),
(163, 84, 35),
(164, 86, 36),
(165, 90, 37),
(166, 92, 38),
(167, 94, 39),
(168, 95, 40),
(169, 99, 41),
(170, 102, 42);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_managers`
--

CREATE TABLE `menu_managers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` tinyint(4) NOT NULL DEFAULT 0,
  `menu_permission_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_managers`
--

INSERT INTO `menu_managers` (`id`, `parent_id`, `menu_permission_id`, `role_id`, `title`, `path_url`, `icon`, `type`, `sort`) VALUES
(1, 0, 1, 1, NULL, NULL, NULL, NULL, 1),
(2, 0, NULL, 1, 'Master', '#', 'fa fa-desktop', NULL, 2),
(6, 0, NULL, 1, 'Sistem & Pengaturan', '#', 'fa fa-cog', NULL, 5),
(55, 0, NULL, 1, 'Laporan (Rekapitulasi)', '#', 'fa fa-briefcase', NULL, 4),
(62, 0, NULL, 1, 'Manajemen Penerimaan', '#', 'fas fa-bullseye', NULL, 3),
(63, 2, 43, 1, NULL, NULL, NULL, NULL, 6),
(64, 2, 40, 1, NULL, NULL, NULL, NULL, 3),
(65, 2, 38, 1, NULL, NULL, NULL, NULL, 1),
(66, 2, 42, 1, NULL, NULL, NULL, NULL, 5),
(67, 2, 39, 1, NULL, NULL, NULL, NULL, 2),
(68, 2, 41, 1, NULL, NULL, NULL, NULL, 4),
(69, 6, 44, 1, NULL, NULL, NULL, NULL, 2),
(70, 6, 4, 1, NULL, NULL, NULL, NULL, 3),
(71, 6, 5, 1, NULL, NULL, NULL, NULL, 1),
(72, 6, 3, 1, NULL, NULL, NULL, NULL, 4),
(73, 62, 45, 1, NULL, NULL, NULL, NULL, 1),
(74, 62, 46, 1, NULL, NULL, NULL, NULL, 2),
(75, 62, 47, 1, NULL, NULL, NULL, NULL, 3),
(76, 62, 48, 1, NULL, NULL, NULL, NULL, 4),
(77, 62, 49, 1, NULL, NULL, NULL, NULL, 5),
(78, 62, 50, 1, NULL, NULL, NULL, NULL, 6),
(79, 62, 51, 1, NULL, NULL, NULL, NULL, 7),
(80, 62, 52, 1, NULL, NULL, NULL, NULL, 8),
(81, 62, 53, 1, NULL, NULL, NULL, NULL, 9),
(82, 55, 54, 1, NULL, NULL, NULL, NULL, 1),
(83, 55, 55, 1, NULL, NULL, NULL, NULL, 2),
(84, 55, 56, 1, NULL, NULL, NULL, NULL, 3),
(85, 55, 57, 1, NULL, NULL, NULL, NULL, 4),
(86, 55, 58, 1, NULL, NULL, NULL, NULL, 5),
(87, 55, 59, 1, NULL, NULL, NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_permissions`
--

CREATE TABLE `menu_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'fas fa-address-card',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'backend'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_permissions`
--

INSERT INTO `menu_permissions` (`id`, `title`, `slug`, `path_url`, `icon`, `type`) VALUES
(1, 'Dashboard', 'backend dashboard', '/backend/dashboard', 'fas fa-home', 'backend'),
(3, 'Roles', 'backend roles', '/backend/roles', 'fa fa-id-card', 'backend'),
(4, 'Menu (Hak Akses)', 'backend menu', '/backend/menu', 'fa fa-cog', 'backend'),
(5, 'Settings Web', 'backend settings', '/backend/settings', 'fab fa-deviantart', 'backend'),
(38, 'Divisi', 'backend Divisi', '/backend/divisi', 'fa fa-cubes', 'backend'),
(39, 'Pemasok', 'backend pemasok', '/backend/pemasok', 'fa fa-sitemap', 'backend'),
(40, 'Cabang (Pelanggan)', 'backend cabang', '/backend/cabang', 'fa fa-university', 'backend'),
(41, 'Satuan', 'backend satuan', '/backend/satuan', 'fas fa-file', 'backend'),
(42, 'Kategori', 'backend kategori', '/backend/kategori', 'fas fa-archive', 'backend'),
(43, 'Barang', 'backend Barang', '/backend/barang', 'fas fa-boxes', 'backend'),
(44, 'Pengguna', 'backend users', '/backend/users', 'fas fa-user-friends', 'backend'),
(45, 'Penerimaan', 'backend penerimaan', '/backend/penerimaan', 'fas fa-receipt', 'backend'),
(46, 'Retur Penerimaan', 'backend retur penerimaan', '/backend/returpenerimaan', 'fas fa-redo-alt', 'backend'),
(47, 'Pengiriman', 'backend pengiriman', '/backend/pengiriman', 'fas fa-reply-all', 'backend'),
(48, 'Retur Pengiriman', 'backend retur pengiriman', '/backend/returpengiriman', 'fas fa-redo', 'backend'),
(49, 'Pemakaian', 'backend pemakaian', '/backend/pemakaian', 'fas fa-warehouse', 'backend'),
(50, 'Stok Opname', 'backend stok opname', '/backend/stokopname', 'fas fa-weight', 'backend'),
(51, 'Saldo Stok', 'backend saldo stok', '/backend/saldostok', 'fa fa-cubes', 'backend'),
(52, 'Pergerakan Stok', 'backend movingstok', '/backend/movingstok', 'fa fa-briefcase', 'backend'),
(53, 'Kartu Stok', 'backend kartu stok', '/backend/kartustok', 'fa fa-briefcase', 'backend'),
(54, 'Jumlah Penerimaan', 'backend jumlah penerimaan', '/backend/jumlahpenerimaan', 'fas fa-poll-h', 'backend'),
(55, 'Nilai Penerimaan', 'backend nilai penerimaan', '/backend/nilaipenerimaan', 'fas fa-poll-h', 'backend'),
(56, 'Jumlah Pengiriman', 'backend jumlah pengiriman', '/backend/jumlahpengiriman', 'fas fa-poll-h', 'backend'),
(57, 'Nilai Pengiriman', 'backend nilai pengiriman', '/backend/nilaipengiriman', 'fas fa-poll-h', 'backend'),
(58, 'Jumlah Pemakaian', 'backend jumlah Pemakaian', '/backend/jumlahpemakaian', 'fas fa-poll-h', 'backend'),
(59, 'Nilai Pemakaian', 'backend nilai pemakaian', '/backend/nilaipemakaian', 'fas fa-poll-h', 'backend');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_permission_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Backend','Frontend') COLLATE utf8mb4_unicode_ci DEFAULT 'Backend'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `menu_permission_id`, `name`, `slug`, `type`) VALUES
(1, 1, 'Dashboard List', 'backend-dashboard-list', 'Backend'),
(2, 1, 'Dashboard Create', 'backend-dashboard-create', 'Backend'),
(3, 1, 'Dashboard Edit', 'backend-dashboard-edit', 'Backend'),
(4, 1, 'Dashboard Delete', 'backend-dashboard-delete', 'Backend'),
(9, 3, 'Roles List', 'backend-roles-list', 'Backend'),
(10, 3, 'Roles Create', 'backend-roles-create', 'Backend'),
(11, 3, 'Roles Edit', 'backend-roles-edit', 'Backend'),
(12, 3, 'Roles Delete', 'backend-roles-delete', 'Backend'),
(13, 4, 'Menu (Hak Akses) List', 'backend-menu-list', 'Backend'),
(14, 4, 'Menu (Hak Akses) Create', 'backend-menu-create', 'Backend'),
(15, 4, 'Menu (Hak Akses) Edit', 'backend-menu-edit', 'Backend'),
(16, 4, 'Menu (Hak Akses) Delete', 'backend-menu-delete', 'Backend'),
(17, 5, 'Settings Web List', 'backend-settings-list', 'Backend'),
(18, 5, 'Settings Web Create', 'backend-settings-create', 'Backend'),
(19, 5, 'Settings Web Edit', 'backend-settings-edit', 'Backend'),
(20, 5, 'Settings Web Delete', 'backend-settings-delete', 'Backend'),
(141, 38, 'Divisi List', 'backend-divisi-list', 'Backend'),
(142, 38, 'Divisi Create', 'backend-divisi-create', 'Backend'),
(143, 38, 'Divisi Edit', 'backend-divisi-edit', 'Backend'),
(144, 38, 'Divisi Delete', 'backend-divisi-delete', 'Backend'),
(145, 39, 'Pemasok List', 'backend-pemasok-list', 'Backend'),
(146, 39, 'Pemasok Create', 'backend-pemasok-create', 'Backend'),
(147, 39, 'Pemasok Edit', 'backend-pemasok-edit', 'Backend'),
(148, 39, 'Pemasok Delete', 'backend-pemasok-delete', 'Backend'),
(149, 40, 'Cabang (Pelanggan) List', 'backend-cabang-list', 'Backend'),
(150, 40, 'Cabang (Pelanggan) Create', 'backend-cabang-create', 'Backend'),
(151, 40, 'Cabang (Pelanggan) Edit', 'backend-cabang-edit', 'Backend'),
(152, 40, 'Cabang (Pelanggan) Delete', 'backend-cabang-delete', 'Backend'),
(153, 41, 'Satuan List', 'backend-satuan-list', 'Backend'),
(154, 41, 'Satuan Create', 'backend-satuan-create', 'Backend'),
(155, 41, 'Satuan Edit', 'backend-satuan-edit', 'Backend'),
(156, 41, 'Satuan Delete', 'backend-satuan-delete', 'Backend'),
(157, 42, 'Kategori List', 'backend-kategori-list', 'Backend'),
(158, 42, 'Kategori Create', 'backend-kategori-create', 'Backend'),
(159, 42, 'Kategori Edit', 'backend-kategori-edit', 'Backend'),
(160, 42, 'Kategori Delete', 'backend-kategori-delete', 'Backend'),
(161, 43, 'Barang List', 'backend-barang-list', 'Backend'),
(162, 43, 'Barang Create', 'backend-barang-create', 'Backend'),
(163, 43, 'Barang Edit', 'backend-barang-edit', 'Backend'),
(164, 43, 'Barang Delete', 'backend-barang-delete', 'Backend'),
(165, 44, 'Pengguna List', 'backend-users-list', 'Backend'),
(166, 44, 'Pengguna Create', 'backend-users-create', 'Backend'),
(167, 44, 'Pengguna Edit', 'backend-users-edit', 'Backend'),
(168, 44, 'Pengguna Delete', 'backend-users-delete', 'Backend'),
(169, 45, 'Penerimaan List', 'backend-penerimaan-list', 'Backend'),
(170, 45, 'Penerimaan Create', 'backend-penerimaan-create', 'Backend'),
(171, 45, 'Penerimaan Edit', 'backend-penerimaan-edit', 'Backend'),
(172, 45, 'Penerimaan Delete', 'backend-penerimaan-delete', 'Backend'),
(173, 46, 'Retur Penerimaan List', 'backend-retur-penerimaan-list', 'Backend'),
(174, 46, 'Retur Penerimaan Create', 'backend-retur-penerimaan-create', 'Backend'),
(175, 46, 'Retur Penerimaan Edit', 'backend-retur-penerimaan-edit', 'Backend'),
(176, 46, 'Retur Penerimaan Delete', 'backend-retur-penerimaan-delete', 'Backend'),
(177, 47, 'Pengiriman List', 'backend-pengiriman-list', 'Backend'),
(178, 47, 'Pengiriman Create', 'backend-pengiriman-create', 'Backend'),
(179, 47, 'Pengiriman Edit', 'backend-pengiriman-edit', 'Backend'),
(180, 47, 'Pengiriman Delete', 'backend-pengiriman-delete', 'Backend'),
(181, 48, 'Retur Pengiriman List', 'backend-retur-pengiriman-list', 'Backend'),
(182, 48, 'Retur Pengiriman Create', 'backend-retur-pengiriman-create', 'Backend'),
(183, 48, 'Retur Pengiriman Edit', 'backend-retur-pengiriman-edit', 'Backend'),
(184, 48, 'Retur Pengiriman Delete', 'backend-retur-pengiriman-delete', 'Backend'),
(185, 49, 'Pemakaian List', 'backend-pemakaian-list', 'Backend'),
(186, 49, 'Pemakaian Create', 'backend-pemakaian-create', 'Backend'),
(187, 49, 'Pemakaian Edit', 'backend-pemakaian-edit', 'Backend'),
(188, 49, 'Pemakaian Delete', 'backend-pemakaian-delete', 'Backend'),
(189, 50, 'Stok Opname List', 'backend-stok-opname-list', 'Backend'),
(190, 50, 'Stok Opname Create', 'backend-stok-opname-create', 'Backend'),
(191, 50, 'Stok Opname Edit', 'backend-stok-opname-edit', 'Backend'),
(192, 50, 'Stok Opname Delete', 'backend-stok-opname-delete', 'Backend'),
(193, 51, 'Saldo Stok List', 'backend-saldo-stok-list', 'Backend'),
(194, 51, 'Saldo Stok Create', 'backend-saldo-stok-create', 'Backend'),
(195, 51, 'Saldo Stok Edit', 'backend-saldo-stok-edit', 'Backend'),
(196, 51, 'Saldo Stok Delete', 'backend-saldo-stok-delete', 'Backend'),
(197, 52, 'Pergerakan Stok List', 'backend-movingstok-list', 'Backend'),
(198, 52, 'Pergerakan Stok Create', 'backend-movingstok-create', 'Backend'),
(199, 52, 'Pergerakan Stok Edit', 'backend-movingstok-edit', 'Backend'),
(200, 52, 'Pergerakan Stok Delete', 'backend-movingstok-delete', 'Backend'),
(201, 53, 'Kartu Stok List', 'backend-kartu-stok-list', 'Backend'),
(202, 53, 'Kartu Stok Create', 'backend-kartu-stok-create', 'Backend'),
(203, 53, 'Kartu Stok Edit', 'backend-kartu-stok-edit', 'Backend'),
(204, 53, 'Kartu Stok Delete', 'backend-kartu-stok-delete', 'Backend'),
(205, 54, 'Jumlah Penerimaan List', 'backend-jumlah-penerimaan-list', 'Backend'),
(206, 54, 'Jumlah Penerimaan Create', 'backend-jumlah-penerimaan-create', 'Backend'),
(207, 54, 'Jumlah Penerimaan Edit', 'backend-jumlah-penerimaan-edit', 'Backend'),
(208, 54, 'Jumlah Penerimaan Delete', 'backend-jumlah-penerimaan-delete', 'Backend'),
(209, 55, 'Nilai Penerimaan List', 'backend-nilai-penerimaan-list', 'Backend'),
(210, 55, 'Nilai Penerimaan Create', 'backend-nilai-penerimaan-create', 'Backend'),
(211, 55, 'Nilai Penerimaan Edit', 'backend-nilai-penerimaan-edit', 'Backend'),
(212, 55, 'Nilai Penerimaan Delete', 'backend-nilai-penerimaan-delete', 'Backend'),
(213, 56, 'Jumlah Pengiriman List', 'backend-jumlah-pengiriman-list', 'Backend'),
(214, 56, 'Jumlah Pengiriman Create', 'backend-jumlah-pengiriman-create', 'Backend'),
(215, 56, 'Jumlah Pengiriman Edit', 'backend-jumlah-pengiriman-edit', 'Backend'),
(216, 56, 'Jumlah Pengiriman Delete', 'backend-jumlah-pengiriman-delete', 'Backend'),
(217, 57, 'Nilai Pengiriman List', 'backend-nilai-pengiriman-list', 'Backend'),
(218, 57, 'Nilai Pengiriman Create', 'backend-nilai-pengiriman-create', 'Backend'),
(219, 57, 'Nilai Pengiriman Edit', 'backend-nilai-pengiriman-edit', 'Backend'),
(220, 57, 'Nilai Pengiriman Delete', 'backend-nilai-pengiriman-delete', 'Backend'),
(221, 58, 'Jumlah Pemakaian List', 'backend-jumlah-pemakaian-list', 'Backend'),
(222, 58, 'Jumlah Pemakaian Create', 'backend-jumlah-pemakaian-create', 'Backend'),
(223, 58, 'Jumlah Pemakaian Edit', 'backend-jumlah-pemakaian-edit', 'Backend'),
(224, 58, 'Jumlah Pemakaian Delete', 'backend-jumlah-pemakaian-delete', 'Backend'),
(225, 59, 'Nilai Pemakaian List', 'backend-nilai-pemakaian-list', 'Backend'),
(226, 59, 'Nilai Pemakaian Create', 'backend-nilai-pemakaian-create', 'Backend'),
(227, 59, 'Nilai Pemakaian Edit', 'backend-nilai-pemakaian-edit', 'Backend'),
(228, 59, 'Nilai Pemakaian Delete', 'backend-nilai-pemakaian-delete', 'Backend');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_manager_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`id`, `menu_manager_id`, `permission_id`, `role_id`) VALUES
(1, 17, 1, 1),
(2, 17, 2, 1),
(3, 17, 3, 1),
(4, 17, 4, 1),
(9, 21, 13, 1),
(10, 21, 14, 1),
(11, 21, 15, 1),
(12, 21, 16, 1),
(13, 22, 9, 1),
(14, 22, 10, 1),
(15, 22, 11, 1),
(16, 22, 12, 1),
(21, 24, 17, 1),
(22, 24, 18, 1),
(23, 24, 19, 1),
(24, 24, 20, 1),
(133, 57, 157, 1),
(134, 57, 158, 1),
(135, 57, 159, 1),
(136, 57, 160, 1),
(137, 58, 153, 1),
(138, 58, 154, 1),
(139, 58, 155, 1),
(140, 58, 156, 1),
(141, 59, 161, 1),
(142, 59, 162, 1),
(143, 59, 163, 1),
(144, 59, 164, 1),
(145, 60, 165, 1),
(146, 60, 166, 1),
(147, 60, 167, 1),
(148, 60, 168, 1),
(149, 61, 185, 1),
(150, 61, 186, 1),
(151, 61, 187, 1),
(152, 61, 188, 1),
(153, 62, 173, 1),
(154, 62, 174, 1),
(155, 62, 175, 1),
(156, 62, 176, 1),
(161, 64, 181, 1),
(162, 64, 182, 1),
(163, 64, 183, 1),
(164, 64, 184, 1),
(165, 65, 177, 1),
(166, 65, 178, 1),
(167, 65, 179, 1),
(168, 65, 180, 1),
(173, 67, 193, 1),
(174, 67, 194, 1),
(175, 67, 195, 1),
(176, 67, 196, 1),
(177, 68, 189, 1),
(178, 68, 190, 1),
(179, 68, 191, 1),
(180, 68, 192, 1),
(181, 69, 197, 1),
(182, 69, 198, 1),
(183, 69, 199, 1),
(184, 69, 200, 1),
(185, 72, 201, 1),
(186, 72, 202, 1),
(187, 72, 203, 1),
(188, 72, 204, 1),
(189, 74, 205, 1),
(190, 74, 206, 1),
(191, 74, 207, 1),
(192, 74, 208, 1),
(193, 75, 209, 1),
(194, 75, 210, 1),
(195, 75, 211, 1),
(196, 75, 212, 1),
(197, 76, 213, 1),
(198, 76, 214, 1),
(199, 76, 215, 1),
(200, 76, 216, 1),
(201, 78, 217, 1),
(202, 78, 218, 1),
(203, 78, 219, 1),
(204, 78, 220, 1),
(209, 80, 221, 1),
(210, 80, 222, 1),
(211, 80, 223, 1),
(212, 80, 224, 1),
(3958, 1462, 1, 93),
(3959, 1462, 2, 93),
(3960, 1462, 3, 93),
(3961, 1462, 4, 93),
(3966, 1616, 1, 100),
(3967, 1616, 2, 100),
(3968, 1616, 3, 100),
(3969, 1617, 161, 100),
(3970, 1617, 162, 100),
(3971, 1620, 221, 100),
(3972, 1620, 222, 100),
(3973, 1619, 153, 100),
(3974, 1619, 154, 100),
(3975, 1618, 157, 100),
(3976, 1618, 158, 100),
(3977, 1630, 165, 100),
(3978, 1630, 166, 100),
(3979, 1624, 209, 100),
(3980, 1624, 210, 100),
(3981, 1624, 211, 100),
(3982, 1637, 169, 100),
(3983, 1637, 170, 100),
(3984, 1637, 171, 100),
(3985, 1637, 172, 100),
(3986, 1629, 201, 100),
(3987, 1629, 202, 100),
(3988, 1621, 173, 100),
(3989, 1621, 174, 100),
(3990, 1628, 213, 100),
(3991, 1628, 214, 100),
(3992, 1626, 177, 100),
(3993, 1626, 178, 100),
(3994, 1623, 181, 100),
(3995, 1623, 182, 100),
(3996, 1627, 217, 100),
(3997, 1627, 218, 100),
(3998, 1625, 205, 100),
(3999, 1625, 206, 100),
(4000, 1644, 169, 101),
(4001, 1643, 173, 101),
(4002, 1648, 177, 101),
(4003, 1645, 181, 101),
(4004, 1646, 209, 101),
(4005, 1646, 210, 101),
(4011, 1671, 201, 102),
(4012, 1671, 202, 102),
(4013, 1671, 203, 102),
(4014, 1670, 213, 102),
(4015, 1670, 214, 102),
(4016, 1670, 215, 102),
(4017, 1669, 217, 102),
(4018, 1669, 218, 102),
(4019, 1669, 219, 102),
(4024, 7, 13, 1),
(4025, 7, 14, 1),
(4026, 7, 15, 1),
(4027, 7, 16, 1),
(4028, 8, 9, 1),
(4029, 8, 10, 1),
(4030, 8, 11, 1),
(4031, 8, 12, 1),
(4032, 9, 17, 1),
(4033, 9, 18, 1),
(4034, 9, 19, 1),
(4035, 9, 20, 1),
(4220, 63, 161, 1),
(4221, 63, 162, 1),
(4222, 63, 163, 1),
(4223, 63, 164, 1),
(4224, 64, 149, 1),
(4225, 64, 150, 1),
(4226, 64, 151, 1),
(4227, 64, 152, 1),
(4228, 65, 141, 1),
(4229, 65, 142, 1),
(4230, 65, 143, 1),
(4231, 65, 144, 1),
(4232, 66, 157, 1),
(4233, 66, 158, 1),
(4234, 66, 159, 1),
(4235, 66, 160, 1),
(4236, 67, 145, 1),
(4237, 67, 146, 1),
(4238, 67, 147, 1),
(4239, 67, 148, 1),
(4240, 68, 153, 1),
(4241, 68, 154, 1),
(4242, 68, 155, 1),
(4243, 68, 156, 1),
(4244, 69, 165, 1),
(4245, 69, 166, 1),
(4246, 69, 167, 1),
(4247, 69, 168, 1),
(4248, 70, 13, 1),
(4249, 70, 14, 1),
(4250, 70, 15, 1),
(4251, 70, 16, 1),
(4252, 71, 17, 1),
(4253, 71, 18, 1),
(4254, 71, 19, 1),
(4255, 71, 20, 1),
(4256, 72, 9, 1),
(4257, 72, 10, 1),
(4258, 72, 11, 1),
(4259, 72, 12, 1),
(4260, 73, 169, 1),
(4261, 74, 173, 1),
(4262, 75, 177, 1),
(4263, 76, 181, 1),
(4264, 77, 185, 1),
(4265, 78, 189, 1),
(4266, 79, 193, 1),
(4267, 79, 194, 1),
(4268, 79, 195, 1),
(4269, 79, 196, 1),
(4270, 80, 197, 1),
(4271, 80, 198, 1),
(4272, 80, 199, 1),
(4273, 80, 200, 1),
(4274, 81, 201, 1),
(4275, 81, 202, 1),
(4276, 81, 203, 1),
(4277, 81, 204, 1),
(4278, 83, 209, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_orders`
--

CREATE TABLE `receive_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record_at` datetime DEFAULT NULL,
  `sum_total_cost` decimal(15,2) DEFAULT 0.00,
  `status` enum('0','1') DEFAULT '0',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `receive_orders`
--

INSERT INTO `receive_orders` (`id`, `code`, `supplier_id`, `record_at`, `sum_total_cost`, `status`, `description`, `created_at`, `updated_at`) VALUES
(3, 'RO-230904-001', 39, '2023-09-04 00:00:00', '150000.00', '1', '4444', '2023-09-04 08:54:26', '2023-09-04 08:54:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `receive_order_items`
--

CREATE TABLE `receive_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `receive_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `item_id` bigint(20) DEFAULT NULL,
  `qty` int(100) NOT NULL DEFAULT 0,
  `cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `receive_order_items`
--

INSERT INTO `receive_order_items` (`id`, `receive_order_id`, `code`, `item_id`, `qty`, `cost`, `total_cost`, `created_at`, `updated_at`) VALUES
(5, 3, 'RO-230904-001', 94, 15, '10000.00', '150000.00', '2023-09-04 08:54:26', '2023-09-04 08:54:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_delivery_orders`
--

CREATE TABLE `return_delivery_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record_at` datetime DEFAULT NULL,
  `sum_total_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sum_percent_price_markup` decimal(15,2) NOT NULL DEFAULT 0.00,
  `sum_total_price` decimal(15,3) DEFAULT 0.000,
  `status` enum('0','1') DEFAULT '0',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_delivery_order_items`
--

CREATE TABLE `return_delivery_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_delivery_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(100) NOT NULL,
  `cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `percent_price_markup` decimal(15,2) DEFAULT 0.00,
  `total_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_receive_orders`
--

CREATE TABLE `return_receive_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `supplier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record_at` date DEFAULT NULL,
  `sum_total_cost` decimal(15,2) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `return_receive_order_items`
--

CREATE TABLE `return_receive_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `return_receive_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `item_id` bigint(20) DEFAULT NULL,
  `qty` int(100) DEFAULT NULL,
  `cost` decimal(15,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `parent` enum('0','1') COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `level`, `parent`) VALUES
(1, 'superadmin', 'superadmin', '1', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`) VALUES
(2, 1, 1),
(25, 1, 32);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout_mode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout_position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `layout_width` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topbar_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sidebar_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `settings`
--

INSERT INTO `settings` (`id`, `name`, `sidebar_logo`, `favicon`, `icon`, `layout`, `layout_mode`, `layout_position`, `layout_width`, `topbar_color`, `sidebar_size`, `sidebar_color`, `created_at`, `updated_at`) VALUES
(1, 'JayaBakery', 'logo-1-1692763702.png', 'logo-1-1692763703.png', 'logo-1-1692763703.png', 'vertical', 'light', 'fixed', 'fluid', 'light', 'lg', 'brand', NULL, '2023-09-02 07:55:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_adjustments`
--

CREATE TABLE `stock_adjustments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `record_at` datetime DEFAULT NULL,
  `sum_total_cost` decimal(15,2) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_adjustment_items`
--

CREATE TABLE `stock_adjustment_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stock_adjustment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty_data` int(100) DEFAULT NULL,
  `qty_real` int(100) DEFAULT NULL,
  `qty_diff` int(100) DEFAULT NULL,
  `cost` decimal(15,2) DEFAULT NULL,
  `total_cost` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_balances`
--

CREATE TABLE `stock_balances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(100) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stock_balances`
--

INSERT INTO `stock_balances` (`id`, `item_id`, `qty`, `created_at`, `updated_at`) VALUES
(4, 7, 0, '2023-09-04 08:48:51', '2023-09-04'),
(5, 8, 0, '2023-09-04 08:48:51', '2023-09-04'),
(6, 9, 0, '2023-09-04 08:48:51', '2023-09-04'),
(7, 10, 0, '2023-09-04 08:48:51', '2023-09-04'),
(8, 11, 0, '2023-09-04 08:48:51', '2023-09-04'),
(9, 12, 0, '2023-09-04 08:48:51', '2023-09-04'),
(10, 13, 0, '2023-09-04 08:48:51', '2023-09-04'),
(11, 14, 0, '2023-09-04 08:48:51', '2023-09-04'),
(12, 15, 0, '2023-09-04 08:48:51', '2023-09-04'),
(13, 16, 0, '2023-09-04 08:48:51', '2023-09-04'),
(14, 17, 0, '2023-09-04 08:48:51', '2023-09-04'),
(15, 18, 0, '2023-09-04 08:48:51', '2023-09-04'),
(16, 19, 0, '2023-09-04 08:48:51', '2023-09-04'),
(17, 20, 0, '2023-09-04 08:48:51', '2023-09-04'),
(18, 21, 0, '2023-09-04 08:48:51', '2023-09-04'),
(19, 22, 0, '2023-09-04 08:48:51', '2023-09-04'),
(20, 23, 0, '2023-09-04 08:48:51', '2023-09-04'),
(21, 24, 0, '2023-09-04 08:48:51', '2023-09-04'),
(22, 25, 0, '2023-09-04 08:48:51', '2023-09-04'),
(23, 26, 0, '2023-09-04 08:48:51', '2023-09-04'),
(24, 27, 0, '2023-09-04 08:48:51', '2023-09-04'),
(25, 28, 0, '2023-09-04 08:48:51', '2023-09-04'),
(26, 29, 0, '2023-09-04 08:48:51', '2023-09-04'),
(27, 30, 0, '2023-09-04 08:48:51', '2023-09-04'),
(28, 31, 0, '2023-09-04 08:48:51', '2023-09-04'),
(29, 32, 0, '2023-09-04 08:48:51', '2023-09-04'),
(30, 33, 0, '2023-09-04 08:48:51', '2023-09-04'),
(31, 34, 0, '2023-09-04 08:48:51', '2023-09-04'),
(32, 35, 0, '2023-09-04 08:48:51', '2023-09-04'),
(33, 36, 0, '2023-09-04 08:48:51', '2023-09-04'),
(34, 37, 0, '2023-09-04 08:48:51', '2023-09-04'),
(35, 38, 0, '2023-09-04 08:48:51', '2023-09-04'),
(36, 39, 0, '2023-09-04 08:48:51', '2023-09-04'),
(37, 40, 0, '2023-09-04 08:48:51', '2023-09-04'),
(38, 41, 0, '2023-09-04 08:48:51', '2023-09-04'),
(39, 42, 0, '2023-09-04 08:48:51', '2023-09-04'),
(40, 43, 0, '2023-09-04 08:48:51', '2023-09-04'),
(41, 44, 0, '2023-09-04 08:48:51', '2023-09-04'),
(42, 45, 0, '2023-09-04 08:48:51', '2023-09-04'),
(43, 46, 0, '2023-09-04 08:48:51', '2023-09-04'),
(44, 47, 0, '2023-09-04 08:48:51', '2023-09-04'),
(45, 48, 0, '2023-09-04 08:48:51', '2023-09-04'),
(46, 49, 0, '2023-09-04 08:48:51', '2023-09-04'),
(47, 50, 0, '2023-09-04 08:48:51', '2023-09-04'),
(48, 51, 0, '2023-09-04 08:48:51', '2023-09-04'),
(49, 52, 0, '2023-09-04 08:48:51', '2023-09-04'),
(50, 53, 0, '2023-09-04 08:48:51', '2023-09-04'),
(51, 54, 0, '2023-09-04 08:48:51', '2023-09-04'),
(52, 55, 0, '2023-09-04 08:48:51', '2023-09-04'),
(53, 56, 0, '2023-09-04 08:48:51', '2023-09-04'),
(54, 57, 0, '2023-09-04 08:48:52', '2023-09-04'),
(55, 58, 0, '2023-09-04 08:48:52', '2023-09-04'),
(56, 59, 0, '2023-09-04 08:48:52', '2023-09-04'),
(57, 60, 0, '2023-09-04 08:48:52', '2023-09-04'),
(58, 61, 0, '2023-09-04 08:48:52', '2023-09-04'),
(59, 62, 0, '2023-09-04 08:48:52', '2023-09-04'),
(60, 63, 0, '2023-09-04 08:48:52', '2023-09-04'),
(61, 64, 0, '2023-09-04 08:48:52', '2023-09-04'),
(62, 65, 0, '2023-09-04 08:48:52', '2023-09-04'),
(63, 66, 0, '2023-09-04 08:48:52', '2023-09-04'),
(64, 67, 0, '2023-09-04 08:48:52', '2023-09-04'),
(65, 68, 0, '2023-09-04 08:48:52', '2023-09-04'),
(66, 69, 0, '2023-09-04 08:48:52', '2023-09-04'),
(67, 70, 0, '2023-09-04 08:48:52', '2023-09-04'),
(68, 71, 0, '2023-09-04 08:48:52', '2023-09-04'),
(69, 72, 0, '2023-09-04 08:48:52', '2023-09-04'),
(70, 73, 0, '2023-09-04 08:48:52', '2023-09-04'),
(71, 74, 0, '2023-09-04 08:48:52', '2023-09-04'),
(72, 75, 0, '2023-09-04 08:48:52', '2023-09-04'),
(73, 76, 0, '2023-09-04 08:48:52', '2023-09-04'),
(74, 77, 0, '2023-09-04 08:48:52', '2023-09-04'),
(75, 78, 0, '2023-09-04 08:48:52', '2023-09-04'),
(76, 79, 0, '2023-09-04 08:48:52', '2023-09-04'),
(77, 80, 0, '2023-09-04 08:48:52', '2023-09-04'),
(78, 81, 0, '2023-09-04 08:48:52', '2023-09-04'),
(79, 82, 0, '2023-09-04 08:48:52', '2023-09-04'),
(80, 83, 0, '2023-09-04 08:48:52', '2023-09-04'),
(81, 84, 0, '2023-09-04 08:48:52', '2023-09-04'),
(82, 85, 0, '2023-09-04 08:48:52', '2023-09-04'),
(83, 86, 0, '2023-09-04 08:48:52', '2023-09-04'),
(84, 87, 0, '2023-09-04 08:48:52', '2023-09-04'),
(85, 88, 0, '2023-09-04 08:48:52', '2023-09-04'),
(86, 89, 0, '2023-09-04 08:48:52', '2023-09-04'),
(87, 90, 0, '2023-09-04 08:48:52', '2023-09-04'),
(88, 91, 0, '2023-09-04 08:48:52', '2023-09-04'),
(89, 92, 0, '2023-09-04 08:48:52', '2023-09-04'),
(90, 93, 0, '2023-09-04 08:48:52', '2023-09-04'),
(91, 94, 15, '2023-09-04 08:54:26', '2023-09-04'),
(92, 95, 0, '2023-09-04 08:48:52', '2023-09-04'),
(93, 96, 0, '2023-09-04 08:48:52', '2023-09-04'),
(94, 97, 0, '2023-09-04 08:48:52', '2023-09-04'),
(95, 98, 0, '2023-09-04 08:48:52', '2023-09-04'),
(96, 99, 0, '2023-09-04 08:48:52', '2023-09-04'),
(97, 100, 0, '2023-09-04 08:48:52', '2023-09-04'),
(98, 101, 0, '2023-09-04 08:48:52', '2023-09-04'),
(99, 102, 0, '2023-09-04 08:48:52', '2023-09-04'),
(100, 103, 0, '2023-09-04 08:48:52', '2023-09-04'),
(101, 104, 0, '2023-09-04 08:48:52', '2023-09-04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_cards`
--

CREATE TABLE `stock_cards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(100) DEFAULT NULL,
  `record_at` datetime DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `reference_type` varchar(255) DEFAULT NULL,
  `reference_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stock_cards`
--

INSERT INTO `stock_cards` (`id`, `item_id`, `qty`, `record_at`, `link`, `reference_type`, `reference_id`, `created_at`, `updated_at`) VALUES
(4, 7, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/7', 'inisialisasi stok', 7, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(5, 8, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/8', 'inisialisasi stok', 8, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(6, 9, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/9', 'inisialisasi stok', 9, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(7, 10, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/10', 'inisialisasi stok', 10, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(8, 11, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/11', 'inisialisasi stok', 11, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(9, 12, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/12', 'inisialisasi stok', 12, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(10, 13, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/13', 'inisialisasi stok', 13, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(11, 14, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/14', 'inisialisasi stok', 14, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(12, 15, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/15', 'inisialisasi stok', 15, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(13, 16, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/16', 'inisialisasi stok', 16, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(14, 17, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/17', 'inisialisasi stok', 17, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(15, 18, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/18', 'inisialisasi stok', 18, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(16, 19, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/19', 'inisialisasi stok', 19, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(17, 20, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/20', 'inisialisasi stok', 20, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(18, 21, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/21', 'inisialisasi stok', 21, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(19, 22, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/22', 'inisialisasi stok', 22, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(20, 23, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/23', 'inisialisasi stok', 23, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(21, 24, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/24', 'inisialisasi stok', 24, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(22, 25, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/25', 'inisialisasi stok', 25, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(23, 26, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/26', 'inisialisasi stok', 26, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(24, 27, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/27', 'inisialisasi stok', 27, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(25, 28, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/28', 'inisialisasi stok', 28, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(26, 29, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/29', 'inisialisasi stok', 29, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(27, 30, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/30', 'inisialisasi stok', 30, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(28, 31, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/31', 'inisialisasi stok', 31, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(29, 32, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/32', 'inisialisasi stok', 32, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(30, 33, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/33', 'inisialisasi stok', 33, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(31, 34, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/34', 'inisialisasi stok', 34, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(32, 35, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/35', 'inisialisasi stok', 35, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(33, 36, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/36', 'inisialisasi stok', 36, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(34, 37, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/37', 'inisialisasi stok', 37, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(35, 38, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/38', 'inisialisasi stok', 38, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(36, 39, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/39', 'inisialisasi stok', 39, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(37, 40, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/40', 'inisialisasi stok', 40, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(38, 41, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/41', 'inisialisasi stok', 41, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(39, 42, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/42', 'inisialisasi stok', 42, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(40, 43, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/43', 'inisialisasi stok', 43, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(41, 44, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/44', 'inisialisasi stok', 44, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(42, 45, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/45', 'inisialisasi stok', 45, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(43, 46, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/46', 'inisialisasi stok', 46, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(44, 47, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/47', 'inisialisasi stok', 47, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(45, 48, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/48', 'inisialisasi stok', 48, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(46, 49, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/49', 'inisialisasi stok', 49, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(47, 50, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/50', 'inisialisasi stok', 50, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(48, 51, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/51', 'inisialisasi stok', 51, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(49, 52, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/52', 'inisialisasi stok', 52, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(50, 53, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/53', 'inisialisasi stok', 53, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(51, 54, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/54', 'inisialisasi stok', 54, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(52, 55, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/55', 'inisialisasi stok', 55, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(53, 56, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/56', 'inisialisasi stok', 56, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(54, 57, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/57', 'inisialisasi stok', 57, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(55, 58, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/58', 'inisialisasi stok', 58, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(56, 59, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/59', 'inisialisasi stok', 59, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(57, 60, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/60', 'inisialisasi stok', 60, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(58, 61, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/61', 'inisialisasi stok', 61, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(59, 62, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/62', 'inisialisasi stok', 62, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(60, 63, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/63', 'inisialisasi stok', 63, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(61, 64, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/64', 'inisialisasi stok', 64, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(62, 65, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/65', 'inisialisasi stok', 65, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(63, 66, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/66', 'inisialisasi stok', 66, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(64, 67, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/67', 'inisialisasi stok', 67, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(65, 68, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/68', 'inisialisasi stok', 68, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(66, 69, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/69', 'inisialisasi stok', 69, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(67, 70, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/70', 'inisialisasi stok', 70, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(68, 71, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/71', 'inisialisasi stok', 71, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(69, 72, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/72', 'inisialisasi stok', 72, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(70, 73, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/73', 'inisialisasi stok', 73, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(71, 74, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/74', 'inisialisasi stok', 74, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(72, 75, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/75', 'inisialisasi stok', 75, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(73, 76, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/76', 'inisialisasi stok', 76, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(74, 77, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/77', 'inisialisasi stok', 77, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(75, 78, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/78', 'inisialisasi stok', 78, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(76, 79, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/79', 'inisialisasi stok', 79, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(77, 80, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/80', 'inisialisasi stok', 80, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(78, 81, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/81', 'inisialisasi stok', 81, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(79, 82, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/82', 'inisialisasi stok', 82, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(80, 83, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/83', 'inisialisasi stok', 83, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(81, 84, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/84', 'inisialisasi stok', 84, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(82, 85, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/85', 'inisialisasi stok', 85, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(83, 86, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/86', 'inisialisasi stok', 86, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(84, 87, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/87', 'inisialisasi stok', 87, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(85, 88, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/88', 'inisialisasi stok', 88, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(86, 89, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/89', 'inisialisasi stok', 89, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(87, 90, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/90', 'inisialisasi stok', 90, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(88, 91, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/91', 'inisialisasi stok', 91, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(89, 92, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/92', 'inisialisasi stok', 92, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(90, 93, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/93', 'inisialisasi stok', 93, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(91, 94, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/94', 'inisialisasi stok', 94, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(92, 95, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/95', 'inisialisasi stok', 95, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(93, 96, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/96', 'inisialisasi stok', 96, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(94, 97, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/97', 'inisialisasi stok', 97, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(95, 98, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/98', 'inisialisasi stok', 98, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(96, 99, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/99', 'inisialisasi stok', 99, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(97, 100, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/100', 'inisialisasi stok', 100, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(98, 101, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/101', 'inisialisasi stok', 101, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(99, 102, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/102', 'inisialisasi stok', 102, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(100, 103, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/103', 'inisialisasi stok', 103, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(101, 104, 0, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/barang/104', 'inisialisasi stok', 104, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(102, 94, 15, '2023-09-04 00:00:00', 'http://127.0.0.1:8000/backend/penerimaan/3', 'ReceiveOrder', 3, '2023-09-04 08:54:26', '2023-09-04 08:54:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stores`
--

INSERT INTO `stores` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(3, 'A1', NULL, '2023-08-25 05:32:45', '2023-08-25 05:32:45'),
(4, 'A2', NULL, '2023-08-25 05:32:51', '2023-08-25 05:32:51'),
(5, 'A3', NULL, '2023-08-25 05:32:58', '2023-08-25 05:32:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(4, 'My Emak', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(5, 'Darsa', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(6, 'PT. Sari Alami', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(7, 'PT. Cipta Niaga Semesta', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(8, 'Supplier Testing', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(9, 'PT. Amerta Lestari Pratama', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(10, 'PT. Suhita Lebah Indonesia', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(11, 'Sumber Kue', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(12, 'PT. Sinar Paramita Niaga', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(13, 'CV. Jaya Abadi', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(14, 'PT. Sinar Sinergi Mulia', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(15, 'PT. Bertalu Anugrah', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(16, 'CV. Aladin Jaya', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(17, 'PT. Jaya Fermex', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(18, 'PT. Kemang Food', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(19, 'Habibi Zebeb', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(20, 'PT. Cahaya Lestari Teguh Makmur', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(21, 'PT. Erico Indonesia', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(22, 'Joko Farm', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(23, 'Siti Sabar Group', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(24, 'Citra Boga', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(25, 'CV. Jaya Makmur Sentosa', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(26, 'Toko Dura', NULL, '2023-09-04 08:48:51', '2023-09-04 08:48:51'),
(27, 'PT. Sinar Niaga Sejahtera', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(28, 'Sumatra', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(29, 'PT. Ram Sugih Bersamo', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(30, 'Ibu Tar', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(31, 'PT. Perdhana Adhi Lestari', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(32, 'Mandiri', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(33, 'Keripik Riski', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(34, 'PT. Bahtera Wiraniaga Internusa', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(35, 'Keripik Pisang Fanana', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(36, 'KENLOVA', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(37, 'Sambal Oye', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(38, 'Alzahra', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(39, 'Ainun', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(40, 'Ny Wie', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(41, 'Gatiga Snack', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52'),
(42, 'Kopi Sudu', NULL, '2023-09-04 08:48:52', '2023-09-04 08:48:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pcs', '2023-08-25 04:26:11', '2023-08-25 04:26:11'),
(2, 'Dus', '2023-08-25 04:25:59', '2023-08-25 04:25:59'),
(4, 'Pack', '2023-08-25 07:06:26', '2023-08-25 07:06:26'),
(9, 'KILOGRAM', '2023-09-04 08:02:39', '2023-09-04 08:02:39'),
(10, 'SAK', '2023-09-04 08:02:40', '2023-09-04 08:02:40'),
(11, 'PAIL', '2023-09-04 08:02:40', '2023-09-04 08:02:40'),
(12, 'BATANG', '2023-09-04 08:02:40', '2023-09-04 08:02:40'),
(13, 'TABUNG', '2023-09-04 08:02:40', '2023-09-04 08:02:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usage_orders`
--

CREATE TABLE `usage_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `departement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `record_at` datetime DEFAULT NULL,
  `sum_total_cost` decimal(15,2) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `usage_orders`
--

INSERT INTO `usage_orders` (`id`, `code`, `departement_id`, `record_at`, `sum_total_cost`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'UO-230829-001', 4, '2023-08-29 00:00:00', '305000.00', '1', 'EWEW', '2023-08-29 12:26:52', '2023-08-29 12:26:52'),
(2, 'UO-230902-001', 1, '2023-09-02 00:00:00', '15000.00', '1', '3q33q', '2023-09-02 07:45:55', '2023-09-02 07:45:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `usage_order_items`
--

CREATE TABLE `usage_order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usage_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `qty` int(100) DEFAULT NULL,
  `cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_cost` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `usage_order_items`
--

INSERT INTO `usage_order_items` (`id`, `usage_order_id`, `code`, `item_id`, `qty`, `cost`, `total_cost`, `created_at`, `updated_at`) VALUES
(1, 1, 'UO-230829-001', 1, 2, '5000.00', '10000.00', '2023-08-29 12:26:52', '2023-08-29 12:26:52'),
(2, 1, 'UO-230829-001', 2, 5, '10000.00', '50000.00', '2023-08-29 12:26:52', '2023-08-29 12:26:52'),
(3, 1, 'UO-230829-001', 3, 3, '15000.00', '45000.00', '2023-08-29 12:26:52', '2023-08-29 12:26:52'),
(4, 1, 'UO-230829-001', 4, 4, '50000.00', '200000.00', '2023-08-29 12:26:52', '2023-08-29 12:26:52'),
(5, 2, 'UO-230902-001', 1, 3, '5000.00', '15000.00', '2023-09-02 07:45:55', '2023-09-02 07:45:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `image`, `email`, `hp`, `email_verified_at`, `password`, `active`, `remember_token`, `last_seen`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', NULL, 'admin@gmail.com', NULL, '2023-04-26 22:06:06', '$2y$10$fk.n3uqhY6Y6ByLBfpLfaeNccPnY6DVFFtuWTgPztVnlX2f3UItQK', 1, 'oKOz7ckWagHn80oSPylnnOpaXZLye6T1ANFfzUUR7S3LIg90GdwLdUGRc1gy', '2023-09-04 17:53:04', '2023-04-26 22:06:06', '2023-09-04 10:53:04'),
(32, 'Adminhendri', 'adminhendri', NULL, 'adminhendri@gmail.com', NULL, '2023-08-23 04:52:21', '$2y$10$jwVDtRm7JlIhgoMhAGEs4es.y.yKEZbUl.x71XT5OGRHL91zrv8M.', 1, NULL, NULL, '2023-08-23 04:52:21', '2023-08-23 04:52:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `delivery_orders`
--
ALTER TABLE `delivery_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `delivery_order_items`
--
ALTER TABLE `delivery_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_order_id` (`delivery_order_id`);

--
-- Indeks untuk tabel `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indeks untuk tabel `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `menu_managers`
--
ALTER TABLE `menu_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_managers_menu_permission_id_foreign` (`menu_permission_id`),
  ADD KEY `menu_managers_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `menu_permissions`
--
ALTER TABLE `menu_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_menu_permission_id_foreign` (`menu_permission_id`);

--
-- Indeks untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_roles_permission_id_foreign` (`permission_id`),
  ADD KEY `permissions_roles_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `receive_orders`
--
ALTER TABLE `receive_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `receive_order_items`
--
ALTER TABLE `receive_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receive_order_id` (`receive_order_id`);

--
-- Indeks untuk tabel `return_delivery_orders`
--
ALTER TABLE `return_delivery_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `return_delivery_order_items`
--
ALTER TABLE `return_delivery_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_order_id` (`return_delivery_order_id`);

--
-- Indeks untuk tabel `return_receive_orders`
--
ALTER TABLE `return_receive_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `return_receive_order_items`
--
ALTER TABLE `return_receive_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_receive_order_id` (`return_receive_order_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_adjustment_items`
--
ALTER TABLE `stock_adjustment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stock_adjustment_id` (`stock_adjustment_id`);

--
-- Indeks untuk tabel `stock_balances`
--
ALTER TABLE `stock_balances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeks untuk tabel `stock_cards`
--
ALTER TABLE `stock_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indeks untuk tabel `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indeks untuk tabel `usage_orders`
--
ALTER TABLE `usage_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `usage_order_items`
--
ALTER TABLE `usage_order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `delivery_orders`
--
ALTER TABLE `delivery_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `delivery_order_items`
--
ALTER TABLE `delivery_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT untuk tabel `item_supplier`
--
ALTER TABLE `item_supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=171;

--
-- AUTO_INCREMENT untuk tabel `menu_managers`
--
ALTER TABLE `menu_managers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `menu_permissions`
--
ALTER TABLE `menu_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=229;

--
-- AUTO_INCREMENT untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4279;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `receive_orders`
--
ALTER TABLE `receive_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `receive_order_items`
--
ALTER TABLE `receive_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `return_delivery_orders`
--
ALTER TABLE `return_delivery_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `return_delivery_order_items`
--
ALTER TABLE `return_delivery_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `return_receive_orders`
--
ALTER TABLE `return_receive_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `return_receive_order_items`
--
ALTER TABLE `return_receive_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stock_adjustments`
--
ALTER TABLE `stock_adjustments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `stock_adjustment_items`
--
ALTER TABLE `stock_adjustment_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `stock_balances`
--
ALTER TABLE `stock_balances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT untuk tabel `stock_cards`
--
ALTER TABLE `stock_cards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `usage_orders`
--
ALTER TABLE `usage_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `usage_order_items`
--
ALTER TABLE `usage_order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `delivery_order_items`
--
ALTER TABLE `delivery_order_items`
  ADD CONSTRAINT `delivery_order_items_ibfk_1` FOREIGN KEY (`delivery_order_id`) REFERENCES `delivery_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`);

--
-- Ketidakleluasaan untuk tabel `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD CONSTRAINT `item_supplier_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_supplier_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `menu_managers`
--
ALTER TABLE `menu_managers`
  ADD CONSTRAINT `menu_managers_menu_permission_id_foreign` FOREIGN KEY (`menu_permission_id`) REFERENCES `menu_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `menu_managers_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_menu_permission_id_foreign` FOREIGN KEY (`menu_permission_id`) REFERENCES `menu_permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permissions_roles_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permissions_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `receive_order_items`
--
ALTER TABLE `receive_order_items`
  ADD CONSTRAINT `receive_order_items_ibfk_1` FOREIGN KEY (`receive_order_id`) REFERENCES `receive_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `return_delivery_order_items`
--
ALTER TABLE `return_delivery_order_items`
  ADD CONSTRAINT `return_delivery_order_items_ibfk_1` FOREIGN KEY (`return_delivery_order_id`) REFERENCES `return_delivery_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `return_receive_order_items`
--
ALTER TABLE `return_receive_order_items`
  ADD CONSTRAINT `return_receive_order_items_ibfk_1` FOREIGN KEY (`return_receive_order_id`) REFERENCES `return_receive_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_adjustment_items`
--
ALTER TABLE `stock_adjustment_items`
  ADD CONSTRAINT `stock_adjustment_items_ibfk_1` FOREIGN KEY (`stock_adjustment_id`) REFERENCES `stock_adjustments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_balances`
--
ALTER TABLE `stock_balances`
  ADD CONSTRAINT `stock_balances_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stock_cards`
--
ALTER TABLE `stock_cards`
  ADD CONSTRAINT `stock_cards_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

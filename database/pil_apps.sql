-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 21, 2021 at 09:50 
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pil_apps`
--

-- --------------------------------------------------------

--
-- Table structure for table `contents`
--

CREATE TABLE `contents` (
  `_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `youtube` varchar(450) DEFAULT NULL,
  `description` text NOT NULL,
  `slug` varchar(65) NOT NULL,
  `status` enum('active','suspend') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contents`
--

INSERT INTO `contents` (`_id`, `menu_id`, `title`, `image`, `youtube`, `description`, `slug`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 1, 'Kompetensi Dasar', NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. [ini hanya contoh saja]', 'kompetensi-dasar-1616312118', 'active', '2021-03-21 14:35:18', 1, NULL, NULL),
(3, 2, 'Pengertian Kehamilan', 'contoh.jpg', 'https://www.youtube.com/watch?v=VQB6xOVGGtM', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. [ini hanya contoh saja]', 'pengertian-kehamilan-1616312791', 'active', '2021-03-21 14:46:31', 1, NULL, NULL),
(4, 2, 'Perubahan Fisiologi dan Psikologi dalam Kehamilan', NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. [ini hanya contoh saja]', 'perubahan-fisiologi-dan-psikologi-dalam-kehamilan-1616312832', 'active', '2021-03-21 14:47:12', 1, NULL, NULL),
(5, 2, 'Kebutuhan Gizi pda Ibu Hamil', NULL, 'https://www.youtube.com/watch?v=VQB6xOVGGtM', 'Gizi adalah rangkaian proses secara organic makanan yang dicerna oleh tubuh untuk memmenuhi kebutuhan pertumbuhan dan fungsi normal organ, serta mempertahankan kehidupan seseorang. Gizi berasal dari Bahasa Arab “ghidza”, yang memiliki arti sebagai makanan. Di Indonesia, gizi berkaitan erat dengan pangan, yaitu segala bahan yang dapat digunakan sebagai makanan. Menurut Turner definisi ilmu gizi sebagai ilmu yang mempelajari proses-proses dimana organisme hidup mempergunakan material-material yang diperlukan untuk pemeliharaan fungsi tubuh. Adapun menurut Eva D. Wilson ilmu gizi sebagai ilmu yang mempelajari tentang tubuh yang terdiri dari jenis, jumlah. Materi yang harus dicukupi dalam makanan sehari-hari guna pemeliharaan sel-sel tubuh. [ini hanya contoh saja]', 'kebutuhan-gizi-pda-ibu-hamil-1616312879', 'active', '2021-03-21 14:47:59', 1, NULL, NULL),
(6, 2, 'Kebutuhan Dasar Ibu Hamil', 'contoh.jpg', NULL, 'Gizi adalah rangkaian proses secara organic makanan yang dicerna oleh tubuh untuk memmenuhi kebutuhan pertumbuhan dan fungsi normal organ, serta mempertahankan kehidupan seseorang. Gizi berasal dari Bahasa Arab “ghidza”, yang memiliki arti sebagai makanan. Di Indonesia, gizi berkaitan erat dengan pangan, yaitu segala bahan yang dapat digunakan sebagai makanan. Menurut Turner definisi ilmu gizi sebagai ilmu yang mempelajari proses-proses dimana organisme hidup mempergunakan material-material yang diperlukan untuk pemeliharaan fungsi tubuh. Adapun menurut Eva D. Wilson ilmu gizi sebagai ilmu yang mempelajari tentang tubuh yang terdiri dari jenis, jumlah. Materi yang harus dicukupi dalam makanan sehari-hari guna pemeliharaan sel-sel tubuh. [ini hanya contoh saja]', 'kebutuhan-dasar-ibu-hamil-1616312917', 'active', '2021-03-21 14:48:37', 1, NULL, NULL),
(7, 2, 'Pemeriksaan Ante Natal Care', 'contoh.jpg', 'https://www.youtube.com/watch?v=VQB6xOVGGtM', 'Gizi adalah rangkaian proses secara organic makanan yang dicerna oleh tubuh untuk memmenuhi kebutuhan pertumbuhan dan fungsi normal organ, serta mempertahankan kehidupan seseorang. Gizi berasal dari Bahasa Arab “ghidza”, yang memiliki arti sebagai makanan. Di Indonesia, gizi berkaitan erat dengan pangan, yaitu segala bahan yang dapat digunakan sebagai makanan. Menurut Turner definisi ilmu gizi sebagai ilmu yang mempelajari proses-proses dimana organisme hidup mempergunakan material-material yang diperlukan untuk pemeliharaan fungsi tubuh. Adapun menurut Eva D. Wilson ilmu gizi sebagai ilmu yang mempelajari tentang tubuh yang terdiri dari jenis, jumlah. Materi yang harus dicukupi dalam makanan sehari-hari guna pemeliharaan sel-sel tubuh. [ini hanya contoh saja]', 'pemeriksaan-ante-natal-care-1616312946', 'active', '2021-03-21 14:49:06', 1, NULL, NULL),
(8, 2, 'Deteksi Dini Komplikasi Masa Kehamilan', NULL, NULL, 'Gizi adalah rangkaian proses secara organic makanan yang dicerna oleh tubuh untuk memmenuhi kebutuhan pertumbuhan dan fungsi normal organ, serta mempertahankan kehidupan seseorang. Gizi berasal dari Bahasa Arab “ghidza”, yang memiliki arti sebagai makanan. Di Indonesia, gizi berkaitan erat dengan pangan, yaitu segala bahan yang dapat digunakan sebagai makanan. Menurut Turner definisi ilmu gizi sebagai ilmu yang mempelajari proses-proses dimana organisme hidup mempergunakan material-material yang diperlukan untuk pemeliharaan fungsi tubuh. Adapun menurut Eva D. Wilson ilmu gizi sebagai ilmu yang mempelajari tentang tubuh yang terdiri dari jenis, jumlah. Materi yang harus dicukupi dalam makanan sehari-hari guna pemeliharaan sel-sel tubuh. [ini hanya contoh saja]', 'deteksi-dini-komplikasi-masa-kehamilan-1616312968', 'active', '2021-03-21 14:49:28', 1, NULL, NULL),
(9, 3, 'Profil', NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.. [ini hanya contoh saja]', 'profil-1616314004', 'active', '2021-03-21 15:06:44', 1, NULL, NULL),
(10, 3, 'Referensi', NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.. [ini hanya contoh saja]', 'referensi-1616314036', 'active', '2021-03-21 15:07:16', 1, NULL, NULL),
(11, 4, 'Petunjuk Penggunaan', NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.. [ini hanya contoh saja]', 'petunjuk-penggunaan-1616314056', 'active', '2021-03-21 15:07:36', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `_id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `slug` varchar(55) NOT NULL,
  `status` enum('active','suspend') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`_id`, `title`, `slug`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Kompetensi', 'kompetensi', 'active', '2021-03-21 13:59:46', 1, NULL, NULL),
(2, 'Materi', 'materi', 'active', '2021-03-21 14:03:07', 1, NULL, NULL),
(3, 'Tentang', 'tentang', 'active', '2021-03-21 14:03:11', 1, NULL, NULL),
(4, 'Bantuan', 'bantuan', 'active', '2021-03-21 14:03:15', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `_id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('super_admin','admin','user') NOT NULL,
  `status` enum('active','suspend') NOT NULL DEFAULT 'active',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`_id`, `username`, `password`, `role`, `status`, `created_at`) VALUES
(1, 'admin', '$2y$10$XK3/qGDBwt1QcGuKRWrtxe0r.PedMVHARVfDjp8TUvC2pEQXHsDei', 'admin', 'active', '2021-03-21 13:17:42'),
(2, 'user1', '$2y$10$D043OsM3cgXD41925FQ8xepliwgohr7LoaAAOaaYr9O/eSPG1YMKa', 'user', 'active', '2021-03-21 13:33:00'),
(3, 'user2', '$2y$10$e08FqFOd0Eb4z8rIUIn1tO0jee3wtIAqgOpuFmT5GVi6sC/UY/.m2', 'user', 'active', '2021-03-21 13:48:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contents`
--
ALTER TABLE `contents`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2024 pada 09.20
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pra_ujikom2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `phone` int(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Tsaqila', 12345678, 'lupa saya', '2024-12-02 03:03:28', '2024-12-02 03:13:20'),
(2, 'Ayuningrum', 1235566, 'lalalala', '2024-12-02 03:08:31', '2024-12-02 03:13:13'),
(3, 'HANA ', 98765432, 'hk tau', '2024-12-02 08:20:14', '2024-12-02 08:20:14'),
(4, 'Fifi ', 321647888, 'jl. Kemayoran', '2024-12-03 00:53:12', '2024-12-03 00:53:12'),
(5, 'Nana', 81245668, 'alamat', '2024-12-03 01:10:03', '2024-12-03 01:10:03'),
(6, 'Ahmad', 812355488, 'alamat nya', '2024-12-03 03:51:07', '2024-12-03 03:51:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `level_name` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id`, `level_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', '2024-12-02 02:19:50', '2024-12-02 02:19:50', '2024-12-02 02:19:50'),
(2, 'Kasir', '2024-12-02 04:18:58', '2024-12-02 04:18:58', '2024-12-02 04:18:58'),
(3, 'Pimpinan', '2024-12-02 04:55:04', '2024-12-02 04:55:04', '2024-12-02 04:55:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_laundry_pickup`
--

CREATE TABLE `trans_laundry_pickup` (
  `id` int(11) NOT NULL,
  `id_order` int(50) NOT NULL,
  `id_customer` int(50) NOT NULL,
  `pickup_date` date NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trans_laundry_pickup`
--

INSERT INTO `trans_laundry_pickup` (`id`, `id_order`, `id_customer`, `pickup_date`, `notes`, `created_at`, `updated_at`) VALUES
(16, 14, 1, '0000-00-00', '', '2024-12-03 01:04:30', '2024-12-03 01:04:30'),
(18, 16, 5, '0000-00-00', '', '2024-12-03 03:47:20', '2024-12-03 03:47:20'),
(20, 18, 4, '0000-00-00', '', '2024-12-03 04:03:54', '2024-12-03 04:03:54'),
(21, 19, 6, '2024-12-03', '', '2024-12-03 07:06:52', '2024-12-03 07:06:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_order`
--

CREATE TABLE `trans_order` (
  `id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `order_code` varchar(50) NOT NULL,
  `order_date` date NOT NULL,
  `order_end_date` date NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `order_payment` int(50) NOT NULL,
  `order_change` int(50) NOT NULL,
  `total` int(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trans_order`
--

INSERT INTO `trans_order` (`id`, `id_customer`, `order_code`, `order_date`, `order_end_date`, `order_status`, `order_payment`, `order_change`, `total`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 1, '#QT/031224/00014', '2024-12-03', '2024-12-06', 1, 50000, 10000, 0, '2024-12-03 01:03:03', '2024-12-03 01:04:30', '2024-12-03 01:03:03'),
(15, 5, '#QT/031224/00015', '2024-12-03', '2024-12-05', 1, 20000, 10000, 0, '2024-12-03 01:10:22', '2024-12-03 01:14:33', '2024-12-03 01:10:22'),
(16, 5, '#QT/031224/00016', '2024-12-03', '2024-12-06', 1, 20000, 10000, 0, '2024-12-03 01:16:15', '2024-12-03 03:47:20', '2024-12-03 01:16:15'),
(18, 4, '#QT/031224/00018', '2024-12-03', '2024-12-05', 1, 20000, 15000, 5000, '2024-12-03 04:03:35', '2024-12-03 04:03:54', '2024-12-03 04:03:35'),
(19, 6, '#QT/031224/00019', '2024-12-03', '2024-12-06', 1, 20000, 6000, 14000, '2024-12-03 07:05:58', '2024-12-03 07:06:52', '2024-12-03 07:05:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_order_detail`
--

CREATE TABLE `trans_order_detail` (
  `id` int(11) NOT NULL,
  `id_order` int(50) NOT NULL,
  `id_service` int(50) NOT NULL,
  `qty` int(50) NOT NULL,
  `subtotal` int(50) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `trans_order_detail`
--

INSERT INTO `trans_order_detail` (`id`, `id_order`, `id_service`, `qty`, `subtotal`, `notes`, `created_at`, `updated_at`) VALUES
(14, 14, 1, 8000, 40000, '', '2024-12-03 01:03:03', '2024-12-03 01:03:03'),
(15, 15, 1, 2000, 10000, '', '2024-12-03 01:10:22', '2024-12-03 01:10:22'),
(16, 16, 1, 2000, 10000, '', '2024-12-03 01:16:15', '2024-12-03 01:16:15'),
(18, 18, 1, 1000, 5000, '', '2024-12-03 04:03:35', '2024-12-03 04:03:35'),
(19, 19, 4, 2000, 14000, '', '2024-12-03 07:05:58', '2024-12-03 07:05:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `type_of_service`
--

CREATE TABLE `type_of_service` (
  `id` int(11) NOT NULL,
  `service_name` varchar(50) NOT NULL,
  `price` int(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `type_of_service`
--

INSERT INTO `type_of_service` (`id`, `service_name`, `price`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cuci dan Gosok', 5000, 'Cuci dan Gosok aja', '2024-12-02 03:36:14', '2024-12-02 03:36:14', '2024-12-02 03:36:14'),
(2, 'Cuci', 4500, 'Cuci aja nih', '2024-12-03 07:02:07', '2024-12-03 07:02:07', '2024-12-03 07:02:07'),
(3, 'Gosok', 5000, 'Gosok baju', '2024-12-03 07:02:37', '2024-12-03 07:02:37', '2024-12-03 07:02:37'),
(4, 'Laundry Besar', 7000, 'selimut, karpet, mantel dan sprei my love', '2024-12-03 07:03:27', '2024-12-03 07:03:27', '2024-12-03 07:03:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` int(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `id_level`, `name`, `email`, `username`, `password`, `created_at`, `updated_at`) VALUES
(2, 1, 'Admin', 'admin@gmail.com', '', 12345678, '2024-12-02 02:20:21', '2024-12-02 02:20:21'),
(3, 3, 'Qaulan Tsaqila', 'qaulantsaqila75@gmail.com', '', 12345678, '2024-12-02 02:48:34', '2024-12-03 04:13:13'),
(4, 2, 'Kasir', 'kasir@gmail.com', '', 12345678, '2024-12-02 04:19:21', '2024-12-03 04:12:52');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_order` (`id_order`);

--
-- Indeks untuk tabel `trans_order`
--
ALTER TABLE `trans_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_customer` (`id_customer`);

--
-- Indeks untuk tabel `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_order` (`id_order`),
  ADD KEY `id_service` (`id_service`);

--
-- Indeks untuk tabel `type_of_service`
--
ALTER TABLE `type_of_service`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_level` (`id_level`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `trans_order`
--
ALTER TABLE `trans_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `type_of_service`
--
ALTER TABLE `type_of_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `trans_laundry_pickup`
--
ALTER TABLE `trans_laundry_pickup`
  ADD CONSTRAINT `trans_laundry_pickup_ibfk_1` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_laundry_pickup_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `trans_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `trans_order_detail`
--
ALTER TABLE `trans_order_detail`
  ADD CONSTRAINT `trans_order_detail_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `trans_order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `trans_order_detail_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `type_of_service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

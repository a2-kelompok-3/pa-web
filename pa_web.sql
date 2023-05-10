-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Bulan Mei 2023 pada 13.42
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pa_web`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `status` enum('progress','success','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id`, `user_id`, `total_price`, `status`) VALUES
(2, 3, 4400000, 'success'),
(3, 3, 700000, 'success'),
(4, 3, 100000, 'success'),
(5, 3, 33000, 'success'),
(6, 3, 68000, 'cancelled'),
(7, 3, 35000, 'cancelled'),
(8, 3, 120000, 'progress');

--
-- Trigger `order`
--
DELIMITER $$
CREATE TRIGGER `Transaksi sukses` AFTER UPDATE ON `order` FOR EACH ROW IF NEW.status = 'success' THEN 
        INSERT INTO `transaction_history` (`id_produk`, `user_id`, `total_price`, `status`) 
        VALUES (NEW.id, NEW.user_id, NEW.total_price, NEW.status); 
    END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_product`
--

CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `amount`, `total`) VALUES
(2, 2, 4, 4, 1600000),
(3, 2, 6, 4, 2400000),
(5, 3, 6, 1, 600000),
(11, 8, 5, 1, 5000),
(12, 8, 11, 1, 5000),
(13, 8, 13, 5, 25000),
(14, 8, 15, 10, 85000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `description`) VALUES
(3, 'Bakpiaku Ubi Ungu', 5500, '595490803_bakpia_ubiungu.jpg', 'Krispi di luar, lembut di dalam dengan rasa yang manis dan warna ungu yang cantik!\r\n'),
(4, 'Bakpiaku Keju', 7000, '2112876353_bakpia_keju.jpg', 'Best Seller! Manis, gurih, asin, nikmat rasanya!!\r\n'),
(5, 'Bakpiaku Pandan', 5000, '824872357_bakpia_pandan.jpg', 'Rasa manis yang alami dari pandan!'),
(6, 'Bakpiaku Kacang', 5500, '1848769015_bakpia_kacang.jpg', 'Rasa yang nikmat dan lezat!'),
(11, 'Bakpiaku Nanas', 5000, '253197816_bakpia_nanas.jpg', 'Enak karena sangat terasa nanasnya!'),
(12, 'Bakpiaku Cokelat', 5000, '1447306687_bakpia_cokelat.jpg', 'Super Best Seller!!'),
(13, 'Bakpiaku Susu', 5000, '739985605_bakpia_susu.jpg', 'Rasa yang manis dan lembut di mulut'),
(14, 'Bakpiaku Kacang Hijau', 5500, '657438779_bakpia_khijau.jpg', 'Rasa yang gurih dan lembut di mulut'),
(15, 'Bakpiaku Durian', 8500, '1673675448_bakpia_durian.jpg', 'Rasa Terbaru! Enak karena manis dan lembut juga sangat terasa duriannya!!!');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(5) NOT NULL,
  `user_id` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `total_price` int(20) NOT NULL,
  `status` enum('progress','success','cancelled') NOT NULL,
  `waktu` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaction_history`
--

INSERT INTO `transaction_history` (`id`, `user_id`, `id_produk`, `total_price`, `status`, `waktu`) VALUES
(1, 3, 3, 700000, 'success', '2023-05-07 20:11:30'),
(2, 3, 4, 100000, 'success', '2023-05-07 20:12:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin','owner') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'owner', 'owner@gmail.com', 'owner', 'owner'),
(2, 'admin', 'admin@gmail.com', 'admin', 'admin'),
(3, 'user1', 'user1@gmail.com', 'user', 'user'),
(4, 'eja', 'ferryzanurwahyu50@gmail.com', '$2y$10$pgV6pE31LUQ6Axxo.zl30OnYJFPZMJitG/rtjYorXlOgfNNQoLDES', 'user'),
(5, 'apa', 'sadasd@email.com', '$2y$10$qC.yTf9kBsz6ojrdizlsluPh4jr6.273XZguRGLwUeBsrudwQrXka', 'user'),
(6, 'dasdas', 'asdas', '$2y$10$m8RKkYfuk.I0n6uYoayHpO.zpl99IKpjkyEx3cmHixljCA8dqam/G', 'user'),
(7, 'adDAS', 'asds', '$2y$10$wSpooCRHjQLwhSWieuLzOunA0Hp0.oZFvtwjwVPHRgZUGOQx8Vo3C', 'user');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Ketidakleluasaan untuk tabel `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Agu 2021 pada 04.49
-- Versi server: 10.1.37-MariaDB
-- Versi PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simasdang_system`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `about_us`
--

CREATE TABLE `about_us` (
  `about_id` int(11) NOT NULL,
  `about_desc` text NOT NULL,
  `about_img` varchar(30) NOT NULL,
  `about_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_customers`
--

CREATE TABLE `account_customers` (
  `account_id` bigint(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_name` text NOT NULL,
  `jk` enum('Pria','Wanita') NOT NULL,
  `tgl_lahir` date NOT NULL,
  `nomor_telp` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `account_img` varchar(255) NOT NULL,
  `customer_role` enum('Pelanggan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `account_systems`
--

CREATE TABLE `account_systems` (
  `account_id` bigint(255) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_system_name` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `nomor_telp` varchar(20) NOT NULL,
  `role` enum('admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account_systems`
--

INSERT INTO `account_systems` (`account_id`, `username`, `password`, `account_system_name`, `email`, `nomor_telp`, `role`) VALUES
(100000000001, 'admin', '$2y$10$iKRYfuJj8kvmD0KAK02Wqe3jSSLOm9Bhy0l6xWQEawEo.ZC17spzO', 'admin', 'biskandar128@gmail.com', '081297639943', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `address_customers`
--

CREATE TABLE `address_customers` (
  `address_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `kota` varchar(255) NOT NULL,
  `provinsi` varchar(255) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kode_pos` varchar(30) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `account_id` bigint(255) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `goods`
--

CREATE TABLE `goods` (
  `goods_id` bigint(255) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `varian` varchar(30) NOT NULL,
  `berat` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `goods_content`
--

CREATE TABLE `goods_content` (
  `content_id` bigint(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `goods_img` varchar(50) NOT NULL,
  `status` varchar(30) NOT NULL,
  `goods_status` int(1) NOT NULL,
  `goods_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_img` varchar(30) NOT NULL,
  `payment_receiver` varchar(255) NOT NULL,
  `payment_name` varchar(30) NOT NULL,
  `payment_transfer` varchar(30) NOT NULL,
  `payment_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonial_id` bigint(255) NOT NULL,
  `ulasan` varchar(100) NOT NULL,
  `rate` int(3) NOT NULL,
  `testi_status` int(1) NOT NULL,
  `account_id` bigint(255) NOT NULL,
  `transaction_id` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` bigint(255) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_total` int(11) NOT NULL,
  `shipping` varchar(30) NOT NULL,
  `shipping_cost` int(11) NOT NULL,
  `transaction_status` varchar(20) NOT NULL,
  `account_id` bigint(255) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL,
  `delivered_date` date NOT NULL,
  `estimated_day` int(11) NOT NULL,
  `estimated_date` date NOT NULL,
  `tracking` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `transaction_id` bigint(255) NOT NULL,
  `goods_id` bigint(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `trs_detail_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`about_id`);

--
-- Indeks untuk tabel `account_customers`
--
ALTER TABLE `account_customers`
  ADD PRIMARY KEY (`account_id`);

--
-- Indeks untuk tabel `account_systems`
--
ALTER TABLE `account_systems`
  ADD PRIMARY KEY (`account_id`);

--
-- Indeks untuk tabel `address_customers`
--
ALTER TABLE `address_customers`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indeks untuk tabel `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`goods_id`);

--
-- Indeks untuk tabel `goods_content`
--
ALTER TABLE `goods_content`
  ADD PRIMARY KEY (`content_id`),
  ADD KEY `goods_id` (`goods_id`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indeks untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonial_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `account_id` (`account_id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `account_id` (`account_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `goods_id` (`goods_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `about_us`
--
ALTER TABLE `about_us`
  MODIFY `about_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `account_customers`
--
ALTER TABLE `account_customers`
  MODIFY `account_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT untuk tabel `account_systems`
--
ALTER TABLE `account_systems`
  MODIFY `account_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT untuk tabel `address_customers`
--
ALTER TABLE `address_customers`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `goods`
--
ALTER TABLE `goods`
  MODIFY `goods_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT untuk tabel `goods_content`
--
ALTER TABLE `goods_content`
  MODIFY `content_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonial_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `address_customers`
--
ALTER TABLE `address_customers`
  ADD CONSTRAINT `address_customers_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account_customers` (`account_id`);

--
-- Ketidakleluasaan untuk tabel `goods_content`
--
ALTER TABLE `goods_content`
  ADD CONSTRAINT `goods_content_ibfk_1` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`goods_id`);

--
-- Ketidakleluasaan untuk tabel `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `testimonials_ibfk_2` FOREIGN KEY (`account_id`) REFERENCES `account_customers` (`account_id`);

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `account_customers` (`account_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`address_id`) REFERENCES `address_customers` (`address_id`);

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`),
  ADD CONSTRAINT `transaction_details_ibfk_2` FOREIGN KEY (`goods_id`) REFERENCES `goods` (`goods_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 16 Mar 2020 pada 16.35
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cost_control_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_kas`
--

CREATE TABLE `mst_kas` (
  `id` int(11) NOT NULL,
  `amount` int(200) NOT NULL,
  `kas_type` int(10) NOT NULL,
  `created_by` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_kas`
--

INSERT INTO `mst_kas` (`id`, `amount`, `kas_type`, `created_by`, `created_at`) VALUES
(3, 2000000003, 1, 'harby', '2020-03-16 14:17:04'),
(4, 100000001, 2, 'harby', '0000-00-00 00:00:00'),
(5, 900000000, 1, 'harby', '2020-03-16 14:49:06'),
(6, 1000000000, 1, 'harby', '2020-03-16 15:06:55'),
(8, 10000004, 2, 'harby', '2020-03-16 15:07:05'),
(9, 570000000, 2, 'harby', '2020-03-16 14:54:30'),
(10, 808080899, 1, 'harby', '2020-03-16 15:09:35');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_param`
--

CREATE TABLE `mst_param` (
  `id` int(11) NOT NULL,
  `param` varchar(30) NOT NULL,
  `value` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_param`
--

INSERT INTO `mst_param` (`id`, `param`, `value`) VALUES
(1, 'kas_type', 'Kas Besar'),
(2, 'kas_type', 'Kas Office');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_users`
--

CREATE TABLE `mst_users` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mst_users`
--

INSERT INTO `mst_users` (`user_id`, `fullname`, `username`, `password`, `role`) VALUES
(1, 'harby anwardi', 'harby', '5ebe2294ecd0e0f08eab7690d2a6ee69', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mst_kas`
--
ALTER TABLE `mst_kas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_param`
--
ALTER TABLE `mst_param`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mst_users`
--
ALTER TABLE `mst_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mst_kas`
--
ALTER TABLE `mst_kas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `mst_param`
--
ALTER TABLE `mst_param`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `mst_users`
--
ALTER TABLE `mst_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

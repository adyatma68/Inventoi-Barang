-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2024 pada 12.02
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorii`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `merek` varchar(255) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `spesifikasi` varchar(255) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama`, `merek`, `id_kategori`, `spesifikasi`, `satuan`, `qty`) VALUES
('AC001', 'ACC', 'AC', 57, 'AC', 'Each', 5),
('BT001', 'Baterai ', 'CMOS', 53, 'Baterai CMOS', 'PCS', 5),
('CC001', 'CCTV', 'HIKVISION', 53, 'Ultra Wide-Angle lens', 'Each', 1),
('CC002', 'Kamera CCTV', 'Kamera CCTV', 57, 'Kamera CCTV', 'PCS', 2),
('CP001', 'Card Printer', 'DTC 45000e HID FARGO', 57, 'Card Printer', 'Each', 1),
('DP001', 'Dispenser', 'Dispenser', 57, 'Dispenser', 'Each', 1),
('DT001', 'Double Tip', 'Double Tip', 56, 'Double Tip', 'Each', 1),
('GL001', 'Galon', 'Aqua', 57, 'Galon', 'PCS', 2),
('JM001', 'Jam Dinding', 'Jam Dinding', 57, 'Jam Dinding', 'Each', 1),
('KJ001', 'Kursi Kerja', 'Kursi Kerja', 57, 'Kursi Kerja', 'Each', 18),
('KK001', 'Kulkas', 'Kulkas', 57, 'Kulkas', 'Each', 1),
('KO001', 'Keyboard', 'Logitech', 53, 'USB', 'PCS', 1),
('LA001', 'Lakban Bening', 'Lakban', 56, 'Kecil', 'Each', 1),
('LA002', 'Lakban Hitam', 'Lakban', 56, 'Hitam', 'Each', 1),
('LA003', 'Lakban Kertas', 'Lakban', 56, 'Kertas', 'Each', 0),
('MC001', 'Memory Card', 'SandDisk', 53, '16 GB', 'Each', 1),
('MJ001', 'Meja Kerja', 'Meja Kerja', 57, 'Meja Kerja', 'Each', 16),
('MJ002', 'Meja Rak', 'Meja Rak', 57, 'Meja Rak', 'Each', 9),
('MO001', 'Mouse', 'DELL', 53, 'USB ', 'PCS', 2),
('MON001', 'Monitor', 'Monitor', 57, 'Monitor', 'Each', 20),
('PC001', 'PC', 'PC', 57, 'PC', 'Each', 5),
('PM001', 'Papan Mading', 'Papan Mading', 56, 'Papan Mading', 'Each', 1),
('PR001', 'Printer', 'EPSON L3110', 57, 'Multifunctional 3:1 - print, copy, scan', 'Each', 1),
('PT001', 'Papan Tulis ', 'Papan', 56, 'Papan Tulis ', 'Each', 5),
('RM001', 'RAM SODIMM', 'RAM', 53, '8GB 2R PC4 2666V', ' PCS', 4),
('RM002', 'RAM LONGDIMM', 'RAM ', 53, '8GB 2R PC4 2666V', 'PCS', 6),
('RM003', 'RAM LONGDIMM', 'RAM', 53, '16GB 2R PC4 3200AA', 'PCS', 2),
('RS001', 'Rak Sepatu', 'Rak Sepatu', 57, '3 Baris', 'Each', 1),
('SD001', 'Smart Lock Door', 'Smart Lock Door', 57, 'Smart Lock Door', 'Each', 1),
('SM001', 'Smoke Detector', 'Smart Wifi', 53, '360 Inspection', 'Each', 7),
('SMT001', 'Smart TV', 'Smart TV', 57, 'Smart TV', 'Each', 2),
('SP001', 'Screen Protector', 'Tempered Glass', 53, 'For Ipad, Slim', 'Each', 7),
('SPI001', 'Spidol', 'Snowman', 56, 'Permanent Hitam', 'Each', 10),
('SS001', 'SSD', 'Samsung ', 53, '500 GB', 'Each', 1),
('ST001', 'Sticky Note', 'Sticky Note', 56, 'Besar', 'Pack', 1),
('ST002', 'Sticky Note', 'Sticky Note', 56, 'Kecil', 'Pack', 1),
('STP001', 'Staples', 'Staples', 56, 'Besar', 'Each', 1),
('STP002', 'Staples', 'Staples', 56, 'Kecil', 'Each', 2),
('TS001', 'Tempat Sampah', 'Tempat Sampah', 57, 'Kecil', 'Each', 2),
('TS002', 'Tempat Sampah', 'Tempat Sampah', 57, 'Besar', 'Each', 1),
('US001', 'USB Adapter', 'Cabletime', 53, 'USB C / USB A', 'Each', 4),
('VC001', 'VGA Conventer', 'Vention', 53, '1080p, 60Hz', 'Each', 7),
('VG001', 'VGA', 'MSI', 53, 'RTX4060', 'PCS', 2),
('WC001', 'Webcam', 'Logitech', 53, '720 HD', 'Each', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `deskripsi`) VALUES
(53, 'Periferal'),
(56, 'ATK'),
(57, 'Inventaris IT Harmoni');

-- --------------------------------------------------------

--
-- Struktur dari tabel `riwayat`
--

CREATE TABLE `riwayat` (
  `id_riwayat` int(11) NOT NULL,
  `aksi` varchar(255) DEFAULT NULL,
  `waktu` date NOT NULL,
  `keterangan_barang` varchar(255) DEFAULT NULL,
  `kode_barang` varchar(50) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(8, 'Adyatma', '123'),
(9, 'admin', '123'),
(10, 'Pangestu_Pratama', '123'),
(11, 'Arba_Dharma_N', '123\r\n');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  ADD PRIMARY KEY (`id_riwayat`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `riwayat`
--
ALTER TABLE `riwayat`
  MODIFY `id_riwayat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

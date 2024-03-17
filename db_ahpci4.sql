-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Sep 2022 pada 16.41
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ahpci4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `app_set`
--

CREATE TABLE `app_set` (
  `id` int(11) NOT NULL,
  `app_name` varchar(150) NOT NULL,
  `app_title` varchar(100) NOT NULL,
  `dashboard_desc` varchar(250) NOT NULL,
  `jenis_perhitungan` enum('hitung','hitung2') NOT NULL,
  `persentase_diterima` int(2) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `app_set`
--

INSERT INTO `app_set` (`id`, `app_name`, `app_title`, `dashboard_desc`, `jenis_perhitungan`, `persentase_diterima`, `last_updated`) VALUES
(1, 'Penentuan Mustahik (Penerima Zakat) Dengan Model Analytic  Hierarchy Process (AHP) Di Kota Medan', 'SPK metode AHP', 'di Sistem Pendukung Keputusan (SPK) untuk Penentuan Mustahik (Penerima Zakat) Dengan Model Analytic \r\nHierarchy Process (AHP) Di Kota Medan', 'hitung', 75, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_tbl`
--

CREATE TABLE `master_tbl` (
  `nomor` int(11) UNSIGNED NOT NULL,
  `nama_tbl` varchar(20) NOT NULL,
  `nm_tmp` varchar(30) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `tabel` text NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `min_lvl` char(1) NOT NULL,
  `tampil` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `master_tbl`
--

INSERT INTO `master_tbl` (`nomor`, `nama_tbl`, `nm_tmp`, `icon`, `tabel`, `kategori`, `min_lvl`, `tampil`) VALUES
(1, 'mst_akun', 'Master Users', '', '{\"id\":{\"jns\":\"int(11)\",\"pk\":\"Y\",\"ai\":\"Y\",\"ref\":\"\",\"edt\":\"1\"},\"username\":{\"jns\":\"varchar(20)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"password\":{\"jns\":\"varchar(40)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"4\"},\"full_name\":{\"jns\":\"varchar(20)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"level\":{\"jns\":\"char(1)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"rules\":{\"jns\":\"text()\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"}}', 'Users', '9', 'Y'),
(2, 'mst_kat', 'Master Category', '', '{\"nomor\":{\"jns\":\"int(11)\",\"pk\":\"Y\",\"ai\":\"Y\",\"ref\":\"\",\"edt\":\"1\"},\"kategori\":{\"jns\":\"varchar(30)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"}}', 'Reference', '9', 'Y'),
(3, 'mst_profil', 'Master Profile', '', '{\"id\":{\"jns\":\"varchar(20)\",\"pk\":\"Y\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"ins_name\":{\"jns\":\"varchar(50)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"address\":{\"jns\":\"varchar(80)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"6\"},\"phone_number\":{\"jns\":\"varchar(15)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"standing_date\":{\"jns\":\"int(11)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"2\"},\"founder\":{\"jns\":\"varchar(50)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"ceo\":{\"jns\":\"varchar(50)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"description\":{\"jns\":\"varchar(100)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"0\"},\"logo\":{\"jns\":\"varchar(100)\",\"pk\":\"N\",\"ai\":\"N\",\"ref\":\"\",\"edt\":\"5\"}}', 'Reference', '9', 'Y'),
(4, 'tbl_alternatif', 'Alternatif', 'simple-icon-notebook', '{\"id\":{\"jns\":\"VARCHAR(16)\",\"pk\":\"Y\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"0\"},\"nama\":{\"jns\":\"VARCHAR(40)\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"0\"},\"tgl_input\":{\"jns\":\"INT(11)\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"2\"}}', 'Master Data', '9', 'Y'),
(5, 'tbl_kriteria', 'Kriteria', 'simple-icon-notebook', '{\"id_kriteria\":{\"jns\":\"INT(11)\",\"pk\":\"Y\",\"ai\":\"Y\",\"ref\":\"\",\"edt\":\"1\"},\"nama_kriteria\":{\"jns\":\"VARCHAR(40)\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"0\"},\"bobot\":{\"jns\":\"INT(2)\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"1\"}}', 'Master Data', '9', 'Y'),
(6, 'tbl_bobotk', 'Bobot Kriteria', 'simple-icon-notebook', '{\"no\":{\"jns\":\"INT(11)\",\"pk\":\"Y\",\"ai\":\"Y\",\"ref\":\"\",\"edt\":\"1\"},\"kriteria1\":{\"jns\":\"INT(11)\",\"pk\":\"\",\"ai\":\"\",\"ref\":{\"tblr\":\"tbl_kriteria\",\"tmpr\":\"nama_kriteria\"},\"edt\":\"7\"},\"kriteria2\":{\"jns\":\"INT(11)\",\"pk\":\"\",\"ai\":\"\",\"ref\":{\"tblr\":\"tbl_kriteria\",\"tmpr\":\"nama_kriteria\"},\"edt\":\"7\"},\"bobot\":{\"jns\":\"DOUBLE\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"1\"}}', 'Master Data', '9', 'Y'),
(7, 'tbl_penilaian', 'Penilaian', 'simple-icon-notebook', '{\"kd_penilaian\":{\"jns\":\"INT(11)\",\"pk\":\"Y\",\"ai\":\"Y\",\"ref\":\"\",\"edt\":\"1\"},\"tanggal\":{\"jns\":\"INT(11)\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"2\"},\"total_nilai\":{\"jns\":\"INT(11)\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"1\"},\"keterangan\":{\"jns\":\"VARCHAR(100)\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"0\"}}', 'Master Data', '9', 'Y'),
(8, 'tbl_bobotalt', 'Bobot Alternatif', 'simple-icon-notebook', '{\"no\":{\"jns\":\"INT(11)\",\"pk\":\"Y\",\"ai\":\"Y\",\"ref\":\"\",\"edt\":\"1\"},\"kriteria\":{\"jns\":\"INT(11)\",\"pk\":\"\",\"ai\":\"\",\"ref\":{\"tblr\":\"tbl_kriteria\",\"tmpr\":\"nama_kriteria\"},\"edt\":\"7\"},\"alternatif1\":{\"jns\":\"VARCHAR(16)\",\"pk\":\"\",\"ai\":\"\",\"ref\":{\"tblr\":\"tbl_masyarakat\",\"tmpr\":\"nama\"},\"edt\":\"7\"},\"alternatif2\":{\"jns\":\"VARCHAR(16)\",\"pk\":\"\",\"ai\":\"\",\"ref\":{\"tblr\":\"tbl_masyarakat\",\"tmpr\":\"nama\"},\"edt\":\"7\"},\"bobot\":{\"jns\":\"DOUBLE\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"1\"}}', 'Master Data', '9', 'N'),
(9, 'tbl_submas', 'Kriteria Alternatif', '', '{\"no\":{\"jns\":\"INT(11)\",\"pk\":\"Y\",\"ai\":\"Y\",\"ref\":\"\",\"edt\":\"1\"},\"id\":{\"jns\":\"VARCHAR(16)\",\"pk\":\"\",\"ai\":\"\",\"ref\":{\"tblr\":\"tbl_alternatif\",\"tmpr\":\"nama\"},\"edt\":\"7\"},\"kriteria\":{\"jns\":\"INT(11)\",\"pk\":\"\",\"ai\":\"\",\"ref\":{\"tblr\":\"tbl_kriteria\",\"tmpr\":\"nama_kriteria\"},\"edt\":\"7\"},\"bobot\":{\"jns\":\"DOUBLE\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"1\"}}', 'Master Data', '9', 'Y'),
(10, 'tbl_subk', 'Sub Kriteria', '', '{\"no\":{\"jns\":\"INT(11)\",\"pk\":\"Y\",\"ai\":\"Y\",\"ref\":\"\",\"edt\":\"1\"},\"kriteria\":{\"jns\":\"INT(11)\",\"pk\":\"\",\"ai\":\"\",\"ref\":{\"tblr\":\"tbl_kriteria\",\"tmpr\":\"nama_kriteria\"},\"edt\":\"7\"},\"nama_sub\":{\"jns\":\"VARCHAR(40)\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"0\"},\"bobot\":{\"jns\":\"DOUBLE\",\"pk\":\"\",\"ai\":\"\",\"ref\":\"\",\"edt\":\"0\"}}', 'Master Data', '9', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mst_akun`
--

CREATE TABLE `mst_akun` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `full_name` varchar(20) NOT NULL,
  `level` char(1) NOT NULL,
  `rules` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `mst_akun`
--

INSERT INTO `mst_akun` (`id`, `username`, `password`, `full_name`, `level`, `rules`) VALUES
(1, 'admin', 'k6E9', 'Admin Sistem', '9', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `id` varchar(16) NOT NULL,
  `nama` varchar(40) DEFAULT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgl_input` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`id`, `nama`, `alamat`, `tgl_input`) VALUES
('1', 'Fakir', '', 1661878800),
('2', 'Miskin', '', 1661878800),
('3', 'Amil', '', 1661878800),
('4', 'Mualaf', '', 1661878800),
('5', 'Garim', '', 1661878800),
('6', 'Riqab', '', 1661878800),
('7', 'Ibnu Sabil', '', 1661878800),
('8', 'Fisabilillah', '', 1661878800);

--
-- Trigger `tbl_alternatif`
--
DELIMITER $$
CREATE TRIGGER `hapus` BEFORE DELETE ON `tbl_alternatif` FOR EACH ROW BEGIN
DELETE FROM tbl_submas WHERE tbl_submas.id=old.id;
DELETE FROM tbl_bobotalt WHERE tbl_bobotalt.alternatif1=old.id or tbl_bobotalt.alternatif2=old.id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bobotalt`
--

CREATE TABLE `tbl_bobotalt` (
  `no` int(11) NOT NULL,
  `kriteria` int(11) DEFAULT NULL,
  `alternatif1` varchar(16) DEFAULT NULL,
  `alternatif2` varchar(16) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_bobotalt`
--

INSERT INTO `tbl_bobotalt` (`no`, `kriteria`, `alternatif1`, `alternatif2`, `bobot`) VALUES
(74, 1, '1', '1', 1),
(75, 1, '1', '2', 6),
(76, 1, '1', '3', 4),
(77, 1, '1', '4', 5),
(78, 1, '1', '5', 2),
(79, 1, '1', '6', 3),
(80, 1, '1', '7', 3),
(81, 1, '1', '8', 4),
(82, 1, '2', '1', 0.16666666666667),
(83, 1, '2', '2', 1),
(84, 1, '2', '3', 0.25),
(85, 1, '2', '4', 0.33333333333333),
(86, 1, '2', '5', 0.16666666666667),
(87, 1, '2', '6', 0.2),
(88, 1, '2', '7', 3),
(89, 1, '2', '8', 5),
(90, 1, '3', '1', 0.25),
(91, 1, '3', '2', 4),
(92, 1, '3', '3', 1),
(93, 1, '3', '4', 2),
(94, 1, '3', '5', 0.25),
(95, 1, '3', '6', 0.33333333333333),
(96, 1, '3', '7', 0.33333333333333),
(97, 1, '3', '8', 0.5),
(98, 1, '4', '1', 0.2),
(99, 1, '4', '2', 3),
(100, 1, '4', '3', 0.5),
(101, 1, '4', '4', 1),
(102, 1, '4', '5', 0.2),
(103, 1, '4', '6', 0.25),
(104, 1, '4', '7', 5),
(105, 1, '4', '8', 0.33333333333333),
(106, 1, '5', '1', 0.5),
(107, 1, '5', '2', 6),
(108, 1, '5', '3', 4),
(109, 1, '5', '4', 5),
(110, 1, '5', '5', 1),
(111, 1, '5', '6', 2),
(112, 1, '5', '7', 2),
(113, 1, '5', '8', 0.25),
(114, 1, '6', '1', 0.33333333333333),
(115, 1, '6', '2', 5),
(116, 1, '6', '3', 3),
(117, 1, '6', '4', 4),
(118, 1, '6', '5', 0.5),
(119, 1, '6', '6', 1),
(120, 1, '6', '7', 3),
(121, 1, '6', '8', 0.5),
(122, 1, '7', '1', 0.33333333333333),
(123, 1, '7', '2', 0.33333333333333),
(124, 1, '7', '3', 3),
(125, 1, '7', '4', 0.2),
(126, 1, '7', '5', 0.5),
(127, 1, '7', '6', 0.33333333333333),
(128, 1, '7', '7', 1),
(129, 1, '7', '8', 0.5),
(130, 1, '8', '1', 0.25),
(131, 1, '8', '2', 0.2),
(132, 1, '8', '3', 2),
(133, 1, '8', '4', 3),
(134, 1, '8', '5', 4),
(135, 1, '8', '6', 2),
(136, 1, '8', '7', 2),
(137, 1, '8', '8', 1),
(138, 2, '1', '1', 1),
(139, 2, '1', '2', 7),
(140, 2, '1', '3', 5),
(141, 2, '1', '4', 6),
(142, 2, '1', '5', 2),
(143, 2, '1', '6', 3),
(144, 2, '1', '7', 3),
(145, 2, '1', '8', 3),
(146, 2, '2', '1', 0.14285714285714),
(147, 2, '2', '2', 1),
(148, 2, '2', '3', 0.25),
(149, 2, '2', '4', 0.33333333333333),
(150, 2, '2', '5', 0.16666666666667),
(151, 2, '2', '6', 0.2),
(152, 2, '2', '7', 0.33333333333333),
(153, 2, '2', '8', 5),
(154, 2, '3', '1', 0.2),
(155, 2, '3', '2', 4),
(156, 2, '3', '3', 1),
(157, 2, '3', '4', 2),
(158, 2, '3', '5', 0.25),
(159, 2, '3', '6', 0.33333333333333),
(160, 2, '3', '7', 3),
(161, 2, '3', '8', 0.5),
(162, 2, '4', '1', 0.16666666666667),
(163, 2, '4', '2', 3),
(164, 2, '4', '3', 0.5),
(165, 2, '4', '4', 1),
(166, 2, '4', '5', 0.2),
(167, 2, '4', '6', 0.25),
(168, 2, '4', '7', 4),
(169, 2, '4', '8', 0.2),
(170, 2, '5', '1', 0.5),
(171, 2, '5', '2', 6),
(172, 2, '5', '3', 4),
(173, 2, '5', '4', 5),
(174, 2, '5', '5', 1),
(175, 2, '5', '6', 2),
(176, 2, '5', '7', 2),
(177, 2, '5', '8', 0.5),
(178, 2, '6', '1', 0.33333333333333),
(179, 2, '6', '2', 5),
(180, 2, '6', '3', 3),
(181, 2, '6', '4', 4),
(182, 2, '6', '5', 0.5),
(183, 2, '6', '6', 1),
(184, 2, '6', '7', 0.5),
(185, 2, '6', '8', 3),
(186, 2, '7', '1', 0.33333333333333),
(187, 2, '7', '2', 3),
(188, 2, '7', '3', 0.33333333333333),
(189, 2, '7', '4', 0.25),
(190, 2, '7', '5', 0.5),
(191, 2, '7', '6', 2),
(192, 2, '7', '7', 1),
(193, 2, '7', '8', 0.5),
(194, 2, '8', '1', 0.33333333333333),
(195, 2, '8', '2', 0.2),
(196, 2, '8', '3', 2),
(197, 2, '8', '4', 5),
(198, 2, '8', '5', 2),
(199, 2, '8', '6', 0.33333333333333),
(200, 2, '8', '7', 2),
(201, 2, '8', '8', 1),
(202, 3, '1', '1', 1),
(203, 3, '1', '2', 7),
(204, 3, '1', '3', 4),
(205, 3, '1', '4', 5),
(206, 3, '1', '5', 6),
(207, 3, '1', '6', 9),
(208, 3, '1', '7', 7),
(209, 3, '1', '8', 3),
(210, 3, '2', '1', 0.14285714285714),
(211, 3, '2', '2', 1),
(212, 3, '2', '3', 5),
(213, 3, '2', '4', 0.2),
(214, 3, '2', '5', 5),
(215, 3, '2', '6', 2),
(216, 3, '2', '7', 7),
(217, 3, '2', '8', 3),
(218, 3, '3', '1', 0.25),
(219, 3, '3', '2', 0.2),
(220, 3, '3', '3', 1),
(221, 3, '3', '4', 0.2),
(222, 3, '3', '5', 3),
(223, 3, '3', '6', 6),
(224, 3, '3', '7', 0.5),
(225, 3, '3', '8', 0.33333333333333),
(226, 3, '4', '1', 0.2),
(227, 3, '4', '2', 5),
(228, 3, '4', '3', 5),
(229, 3, '4', '4', 1),
(230, 3, '4', '5', 7),
(231, 3, '4', '6', 8),
(232, 3, '4', '7', 0.5),
(233, 3, '4', '8', 0.2),
(234, 3, '5', '1', 0.16666666666667),
(235, 3, '5', '2', 0.2),
(236, 3, '5', '3', 0.33333333333333),
(237, 3, '5', '4', 0.14285714285714),
(238, 3, '5', '5', 1),
(239, 3, '5', '6', 3),
(240, 3, '5', '7', 2),
(241, 3, '5', '8', 3),
(242, 3, '6', '1', 0.11111111111111),
(243, 3, '6', '2', 0.5),
(244, 3, '6', '3', 0.16666666666667),
(245, 3, '6', '4', 0.125),
(246, 3, '6', '5', 0.33333333333333),
(247, 3, '6', '6', 1),
(248, 3, '6', '7', 0.5),
(249, 3, '6', '8', 0.25),
(250, 3, '7', '1', 0.14285714285714),
(251, 3, '7', '2', 0.14285714285714),
(252, 3, '7', '3', 2),
(253, 3, '7', '4', 2),
(254, 3, '7', '5', 0.5),
(255, 3, '7', '6', 2),
(256, 3, '7', '7', 1),
(257, 3, '7', '8', 0.5),
(258, 3, '8', '1', 0.33333333333333),
(259, 3, '8', '2', 0.33333333333333),
(260, 3, '8', '3', 3),
(261, 3, '8', '4', 5),
(262, 3, '8', '5', 0.33333333333333),
(263, 3, '8', '6', 4),
(264, 3, '8', '7', 2),
(265, 3, '8', '8', 1),
(266, 4, '1', '1', 1),
(267, 4, '1', '2', 8),
(268, 4, '1', '3', 3),
(269, 4, '1', '4', 7),
(270, 4, '1', '5', 4),
(271, 4, '1', '6', 5),
(272, 4, '1', '7', 3),
(273, 4, '1', '8', 2),
(274, 4, '2', '1', 0.125),
(275, 4, '2', '2', 1),
(276, 4, '2', '3', 7),
(277, 4, '2', '4', 5),
(278, 4, '2', '5', 0.2),
(279, 4, '2', '6', 0.25),
(280, 4, '2', '7', 7),
(281, 4, '2', '8', 2),
(282, 4, '3', '1', 0.33333333333333),
(283, 4, '3', '2', 0.14285714285714),
(284, 4, '3', '3', 1),
(285, 4, '3', '4', 0.5),
(286, 4, '3', '5', 2),
(287, 4, '3', '6', 4),
(288, 4, '3', '7', 2),
(289, 4, '3', '8', 0.33333333333333),
(290, 4, '4', '1', 0.14285714285714),
(291, 4, '4', '2', 0.2),
(292, 4, '4', '3', 2),
(293, 4, '4', '4', 1),
(294, 4, '4', '5', 0.25),
(295, 4, '4', '6', 4),
(296, 4, '4', '7', 3),
(297, 4, '4', '8', 5),
(298, 4, '5', '1', 0.25),
(299, 4, '5', '2', 5),
(300, 4, '5', '3', 0.5),
(301, 4, '5', '4', 4),
(302, 4, '5', '5', 1),
(303, 4, '5', '6', 3),
(304, 4, '5', '7', 2),
(305, 4, '5', '8', 2),
(306, 4, '6', '1', 0.2),
(307, 4, '6', '2', 4),
(308, 4, '6', '3', 0.25),
(309, 4, '6', '4', 0.25),
(310, 4, '6', '5', 0.33333333333333),
(311, 4, '6', '6', 1),
(312, 4, '6', '7', 3),
(313, 4, '6', '8', 0.33333333333333),
(314, 4, '7', '1', 0.33333333333333),
(315, 4, '7', '2', 0.14285714285714),
(316, 4, '7', '3', 0.5),
(317, 4, '7', '4', 0.33333333333333),
(318, 4, '7', '5', 0.5),
(319, 4, '7', '6', 0.33333333333333),
(320, 4, '7', '7', 1),
(321, 4, '7', '8', 0.5),
(322, 4, '8', '1', 0.5),
(323, 4, '8', '2', 0.5),
(324, 4, '8', '3', 3),
(325, 4, '8', '4', 0.2),
(326, 4, '8', '5', 0.5),
(327, 4, '8', '6', 3),
(328, 4, '8', '7', 2),
(329, 4, '8', '8', 1),
(330, 5, '1', '1', 1),
(331, 5, '1', '2', 3),
(332, 5, '1', '3', 4),
(333, 5, '1', '4', 2),
(334, 5, '1', '5', 0.25),
(335, 5, '1', '6', 0.5),
(336, 5, '1', '7', 7),
(337, 5, '1', '8', 9),
(338, 5, '2', '1', 0.33333333333333),
(339, 5, '2', '2', 1),
(340, 5, '2', '3', 7),
(341, 5, '2', '4', 0.5),
(342, 5, '2', '5', 0.2),
(343, 5, '2', '6', 5),
(344, 5, '2', '7', 9),
(345, 5, '2', '8', 3),
(346, 5, '3', '1', 0.25),
(347, 5, '3', '2', 0.14285714285714),
(348, 5, '3', '3', 1),
(349, 5, '3', '4', 4),
(350, 5, '3', '5', 0.5),
(351, 5, '3', '6', 0.33333333333333),
(352, 5, '3', '7', 2),
(353, 5, '3', '8', 4),
(354, 5, '4', '1', 0.5),
(355, 5, '4', '2', 2),
(356, 5, '4', '3', 0.25),
(357, 5, '4', '4', 1),
(358, 5, '4', '5', 0.2),
(359, 5, '4', '6', 0.2),
(360, 5, '4', '7', 3),
(361, 5, '4', '8', 5),
(362, 5, '5', '1', 4),
(363, 5, '5', '2', 5),
(364, 5, '5', '3', 2),
(365, 5, '5', '4', 5),
(366, 5, '5', '5', 1),
(367, 5, '5', '6', 0.5),
(368, 5, '5', '7', 2),
(369, 5, '5', '8', 4),
(370, 5, '6', '1', 2),
(371, 5, '6', '2', 0.2),
(372, 5, '6', '3', 3),
(373, 5, '6', '4', 5),
(374, 5, '6', '5', 2),
(375, 5, '6', '6', 1),
(376, 5, '6', '7', 2),
(377, 5, '6', '8', 3),
(378, 5, '7', '1', 0.14285714285714),
(379, 5, '7', '2', 0.11111111111111),
(380, 5, '7', '3', 0.5),
(381, 5, '7', '4', 0.33333333333333),
(382, 5, '7', '5', 0.5),
(383, 5, '7', '6', 0.5),
(384, 5, '7', '7', 1),
(385, 5, '7', '8', 3),
(386, 5, '8', '1', 0.11111111111111),
(387, 5, '8', '2', 0.33333333333333),
(388, 5, '8', '3', 0.25),
(389, 5, '8', '4', 0.2),
(390, 5, '8', '5', 0.25),
(391, 5, '8', '6', 0.33333333333333),
(392, 5, '8', '7', 0.33333333333333),
(393, 5, '8', '8', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bobotk`
--

CREATE TABLE `tbl_bobotk` (
  `no` int(11) NOT NULL,
  `kriteria1` int(11) DEFAULT NULL,
  `kriteria2` int(11) DEFAULT NULL,
  `bobot` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_bobotk`
--

INSERT INTO `tbl_bobotk` (`no`, `kriteria1`, `kriteria2`, `bobot`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 4),
(3, 1, 3, 9),
(4, 1, 4, 8),
(5, 1, 5, 3),
(6, 2, 1, 0.25),
(7, 2, 2, 1),
(8, 2, 3, 7),
(9, 2, 4, 6),
(10, 2, 5, 2),
(11, 3, 1, 0.11111111111111),
(12, 3, 2, 0.14285714285714),
(13, 3, 3, 1),
(14, 3, 4, 0.33333333333333),
(15, 3, 5, 0.2),
(16, 4, 1, 0.125),
(17, 4, 2, 0.16666666666667),
(18, 4, 3, 3),
(19, 4, 4, 1),
(20, 4, 5, 0.25),
(21, 5, 1, 0.33333333333333),
(22, 5, 2, 0.5),
(23, 5, 3, 5),
(24, 5, 4, 4),
(25, 5, 5, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_hasil`
--

CREATE TABLE `tbl_hasil` (
  `nomor` int(11) NOT NULL,
  `tanggal` int(11) DEFAULT NULL,
  `hasil` text DEFAULT NULL,
  `rinci` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(40) DEFAULT NULL,
  `bobot` int(2) NOT NULL,
  `aktif` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `aktif`) VALUES
(1, 'Pekerjaan', 1, 1),
(2, 'Jumlah Tanggungan', 1, 1),
(3, 'Usia', 1, 1),
(4, 'Kepemilikan Rumah', 1, 1),
(5, 'Pendapatan', 1, 1);

--
-- Trigger `tbl_kriteria`
--
DELIMITER $$
CREATE TRIGGER `hapusKrta` BEFORE DELETE ON `tbl_kriteria` FOR EACH ROW BEGIN
DELETE FROM tbl_bobotalt WHERE tbl_bobotalt.kriteria=old.id_kriteria;
DELETE FROM tbl_bobotk WHERE tbl_bobotk.kriteria1=old.id_kriteria or tbl_bobotk.kriteria2=old.id_kriteria;
DELETE FROM tbl_subk WHERE tbl_subk.kriteria=old.id_kriteria;
DELETE FROM tbl_submas WHERE tbl_submas.kriteria=old.id_kriteria;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_subk`
--

CREATE TABLE `tbl_subk` (
  `no` int(11) NOT NULL,
  `kriteria` int(11) NOT NULL,
  `nama_sub` varchar(40) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_subk`
--

INSERT INTO `tbl_subk` (`no`, `kriteria`, `nama_sub`, `bobot`) VALUES
(10, 4, 'Tidak Bekerja', 5),
(11, 4, 'Buruh', 3),
(12, 4, 'Pekerjaan paruh waktu', 1),
(13, 5, '> 5 anak', 5),
(14, 5, '4 anak', 3),
(15, 5, '< 4 anak', 1),
(16, 6, '50 tahun - 70 tahun', 5),
(17, 6, '30 tahun - 49 tahun', 3),
(18, 6, '10 tahun – 29 tahun', 1),
(19, 7, 'Rumah sewa', 5),
(20, 7, 'Rumah tidak permanen', 3),
(21, 7, 'Rumah Permanen', 1),
(22, 8, 'Tidak pasti', 5),
(23, 8, '300.000-600.000/bulan', 3),
(24, 8, '700.000-900.000/bulan', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_submas`
--

CREATE TABLE `tbl_submas` (
  `no` int(11) NOT NULL,
  `id` varchar(16) NOT NULL,
  `kriteria` int(11) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `app_set`
--
ALTER TABLE `app_set`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `master_tbl`
--
ALTER TABLE `master_tbl`
  ADD PRIMARY KEY (`nomor`);

--
-- Indeks untuk tabel `mst_akun`
--
ALTER TABLE `mst_akun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_bobotalt`
--
ALTER TABLE `tbl_bobotalt`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tbl_bobotk`
--
ALTER TABLE `tbl_bobotk`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  ADD PRIMARY KEY (`nomor`);

--
-- Indeks untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indeks untuk tabel `tbl_subk`
--
ALTER TABLE `tbl_subk`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `tbl_submas`
--
ALTER TABLE `tbl_submas`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `app_set`
--
ALTER TABLE `app_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `master_tbl`
--
ALTER TABLE `master_tbl`
  MODIFY `nomor` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mst_akun`
--
ALTER TABLE `mst_akun`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_bobotalt`
--
ALTER TABLE `tbl_bobotalt`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT untuk tabel `tbl_bobotk`
--
ALTER TABLE `tbl_bobotk`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tbl_hasil`
--
ALTER TABLE `tbl_hasil`
  MODIFY `nomor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tbl_subk`
--
ALTER TABLE `tbl_subk`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tbl_submas`
--
ALTER TABLE `tbl_submas`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 11:19 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipernik`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `JumlahHari` (`tgl1` DATE, `tgl2` DATE)  SELECT dd.iBedaHari, dd.iBedaHari - dd.iAkhirMinggu AS iHariKerja, dd.iAkhirMinggu 
FROM ( 
  SELECT 
    dd.iBedaHari, 
    ((dd.iMinggu * 2) +  
    IF(dd.iBedaSabtu >= 0 AND dd.iBedaSabtu < dd.iHari, 1, 0) +  
    IF (dd.iBedaMinggu >= 0 AND dd.iBedaMinggu < dd.iHari, 1, 0)) AS iAkhirMinggu 
  FROM ( 
    SELECT 
      dd.iBedaHari, 
      FLOOR(dd.iBedaHari / 7) AS iMinggu, 
      dd.iBedaHari % 7 iHari, 
      5 - dd.iTglMulai AS iBedaSabtu,
      6 - dd.iTglMulai AS iBedaMinggu 
    FROM ( 
      SELECT 
        1 + DATEDIFF(tgl2, tgl1) AS iBedaHari, 
        WEEKDAY(tgl1) AS iTglMulai 
      ) AS dd 
  ) AS dd 
) AS dd$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ctr_barang`
--

CREATE TABLE `ctr_barang` (
  `id` bigint(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `satuan` varchar(50) NOT NULL,
  `jumlah` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_barang`
--

INSERT INTO `ctr_barang` (`id`, `kode_barang`, `uraian`, `satuan`, `jumlah`) VALUES
(1, '0001', 'KERTAS F4', 'RIM', 10),
(2, '0002', 'KERTAS A4', 'RIM', 0),
(3, '0003', 'KERTAS CD', 'RIM', 0),
(4, '0004', 'BOLPOINT', 'BUAH', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ctr_disposisi`
--

CREATE TABLE `ctr_disposisi` (
  `id` int(5) NOT NULL,
  `surat_id` int(5) NOT NULL,
  `dari` int(2) DEFAULT NULL,
  `kepada` int(2) NOT NULL,
  `tgl_disposisi` date DEFAULT NULL,
  `isi_disposisi` varchar(300) NOT NULL,
  `sifat` varchar(50) NOT NULL,
  `ket_disposisi` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_disposisi`
--

INSERT INTO `ctr_disposisi` (`id`, `surat_id`, `dari`, `kepada`, `tgl_disposisi`, `isi_disposisi`, `sifat`, `ket_disposisi`) VALUES
(1, 2, 1, 3, '2023-11-12', 'dsfsdf', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ctr_ekspedisi`
--

CREATE TABLE `ctr_ekspedisi` (
  `id` smallint(6) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_ekspedisi`
--

INSERT INTO `ctr_ekspedisi` (`id`, `nama`) VALUES
(1, 'POS'),
(2, 'JNE'),
(3, 'TIKI'),
(4, 'Diantar Langsung');

-- --------------------------------------------------------

--
-- Table structure for table `ctr_jabatan`
--

CREATE TABLE `ctr_jabatan` (
  `id` int(2) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `urutan` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_jabatan`
--

INSERT INTO `ctr_jabatan` (`id`, `jabatan`, `urutan`) VALUES
(1, 'KETUA', 1),
(2, 'WAKIL KETUA', 2),
(3, 'PANITERA', 3),
(4, 'SEKRETARIS', 4),
(5, 'WAKIL PANITERA', 5),
(6, 'PANMUD. PERKARA', 6),
(7, 'PANMUD. HUKUM', 7),
(11, 'UMUM DAN KEUANGAN', 11),
(12, 'KEPEGAWAIAN DAN ORTALA', 12),
(13, 'PERENCANAAN, TI DAN PELAPORAN', 13),
(14, 'HAKIM', 14),
(15, 'PANITERA PENGGANTI', 15),
(16, 'JURUSITA', 16),
(17, 'PEGAWAI', 17),
(18, 'HONORER', 18);

-- --------------------------------------------------------

--
-- Table structure for table `ctr_kategori_surat`
--

CREATE TABLE `ctr_kategori_surat` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ctr_kategori_surat`
--

INSERT INTO `ctr_kategori_surat` (`id_kategori`, `kategori`) VALUES
(2, 'Naskah Dinas Pengaturan'),
(3, 'Naskah Dinas Penetapan'),
(4, 'Naskah Dinas Penugasan'),
(5, 'Naskah Dinas Korespondensi Internal'),
(6, 'Naskah Dinas Korespondensi Eksternal'),
(7, 'Nota Kesepahaman'),
(8, 'Surat Perjanjian Kerjasama'),
(9, 'Berita Acara'),
(10, 'Surat Keterangan'),
(11, 'Surat Pengantar'),
(12, 'Pengumuman'),
(13, 'Laporan'),
(14, 'Telaah Staff'),
(15, 'Notula');

-- --------------------------------------------------------

--
-- Table structure for table `ctr_ordner`
--

CREATE TABLE `ctr_ordner` (
  `id` int(2) NOT NULL,
  `kode` char(5) NOT NULL,
  `nama` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_ordner`
--

INSERT INTO `ctr_ordner` (`id`, `kode`, `nama`) VALUES
(1, 'PAN', 'PRK.2.01'),
(2, 'HUKUM', 'KEPANITERAAN HUKUM'),
(3, 'LAIN2', 'LAIN-LAIN'),
(4, 'UMUM', 'UMUM DAN KEUANGAN'),
(5, 'KEPEG', 'KEPEGAWAIAN & ORTALA'),
(6, 'PTIP', 'P. TI. & PELAPORAN'),
(7, 'A.01', 'SURAT MASUK PERKARA ');

-- --------------------------------------------------------

--
-- Table structure for table `ctr_pegawai`
--

CREATE TABLE `ctr_pegawai` (
  `id` bigint(20) NOT NULL,
  `jabatan_id` int(2) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nip` varchar(20) NOT NULL,
  `pangkat` varchar(20) DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `jabatan_nama` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `foto` varchar(100) DEFAULT 'default.png',
  `alamat` varchar(255) DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `aktif` char(1) DEFAULT 'Y',
  `diinput_oleh` varchar(20) DEFAULT NULL,
  `diinput_tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_pegawai`
--

INSERT INTO `ctr_pegawai` (`id`, `jabatan_id`, `nama`, `nip`, `pangkat`, `golongan`, `jabatan_nama`, `email`, `keterangan`, `foto`, `alamat`, `telpon`, `aktif`, `diinput_oleh`, `diinput_tanggal`) VALUES
(1, 1, 'Super Administrator', 'W4.TUN7', 'W4.TUN7', 'W4.TUN7', 'Administrator', NULL, NULL, 'Logo_kecil.jpg', 'ptun.gorontalo@gmail.com', '0852 9844 1125', 'Y', NULL, NULL),
(3, 14, 'CECKLY JEMBLY KEREH, S.H.', '19800604 200404 1 00', 'PENATA TK.I', 'III/d', 'HAKIM', NULL, NULL, 'PAK_CECKLY.JPG', 'ceckjemb@gmail.com', '0895377353055', 'Y', NULL, NULL),
(5, 14, 'ANDI HENDRA DWI BAYU PUTRA, S.H.', '19860908 200912 1 00', 'PENATA', 'III/c', 'HAKIM', NULL, NULL, 'PAK_HENDRA.JPG', 'hendra_bayu1986@yahoo.com', '081241847706', 'Y', NULL, NULL),
(6, 14, 'RINOVA HEPPYANI SIMANJUNTAK,S.H., M.H.', '19860411 200912 2 00', 'PENATA', 'III/c', 'HAKIM', NULL, NULL, 'IBU_RINOVA.JPG', 'novaheppyani@yahoo.co.id', '082142201456', 'Y', NULL, NULL),
(13, 7, 'JAENAL ARIFIN SUJOKO, S.H.', '197905162006041004', 'PENATA MUDA Tk.I.', 'III/b', 'Plt. PANITERA MUDA HUKUM', NULL, NULL, 'JAENAL.JPG', 'jaenal2008@gmail.com', '085399566115', 'Y', NULL, NULL),
(14, 4, 'SYAMSUL BAKHRY, S.H., M.H.', '196611251990031001', 'PEMBINA Tk.I', 'IV/b', 'SEKRETARIS', NULL, NULL, 'PAK_SYAMSUL.JPG', 'syb.embas@gmail.com', '085241006627', 'Y', NULL, NULL),
(15, 11, 'R. SOEPRAPTO SUMANTRI', '196707061993031006', 'PENATA MUDA TK.I', 'III/b', 'KASUBAG. UMUM DAN KEUANGAN', NULL, NULL, 'PAK_SOEPRAPTO.JPG', '', '082293310077', 'Y', NULL, NULL),
(16, 12, 'JULIEN UDUAS, S.H.', '196907061991032003', 'PENATA TK.I', 'III/d', 'KASUBAG. KEPEGAWAIAN DAN ORTALA', NULL, NULL, 'IBU_JULIEN.JPG', '', '082398985787', 'Y', NULL, NULL),
(17, 13, 'FRISKA IRIANSYAH, S.H.', '198710172006042001', 'PENATA ', 'III/c', 'KASUBAG. PERENCANAAN, TI, DAN PELAPORAN', NULL, NULL, 'IBU_FRISKA.JPG', '', '082187157009', 'Y', NULL, NULL),
(18, 17, 'YUNIARSI INDRASARI, S.E., M.H.', '198306162008022001', 'Pembina', 'IV/a', 'Panitera Pengganti', NULL, NULL, 'IBU_YUNI.jpg', 'yuniarsi.indrasari@gmail.com', '08114341983', 'Y', NULL, NULL),
(19, 12, 'SRI IMELDA AYU UTAMI DUDE, S.E.', '198207122007012009', 'Penata Tingkat I', 'III/d', 'STAF', NULL, NULL, 'MELI.JPG', '', '085240327547', 'Y', NULL, NULL),
(20, 17, 'AHMAD FITRI, S.H.I', '19860204 201903 1 00', 'PENATA MUDA Tk.I.', 'III/b', 'Panitera Pengganti', NULL, NULL, 'ahmad_fitri_back_org.jpg', '', '085742460381', 'Y', NULL, NULL),
(21, 17, 'AHMAD SUJA’I , S.I.P', '19860614 201903 1 00', 'PENATA MUDA Tk.I.', 'III/b', 'Analis Kepegawaian ', NULL, NULL, 'ahmad_sujai_org.jpg', '', '085659556210', 'Y', NULL, NULL),
(22, 17, 'ADITYA AFIEQ PRAKOSO, S.Psi', '19930727 201903 1 01', 'PENATA MUDA Tk.I.', 'III/b', 'Jurusita Pengganti', NULL, NULL, 'adit.jpg', '', '085725979816', 'Y', NULL, NULL),
(23, 17, 'RAHMAWATI HASAN, AMD', '19880307 201903 2 00', 'PENGATUR Tk.i.', 'II/d', 'Penggelola sistem dan jaringan', NULL, NULL, 'rahma2.jpg', '', '085240800100', 'Y', NULL, NULL),
(24, 18, 'ZULKIFLI NASIR, S.PI.', '-', '-', '-', 'STAF', NULL, NULL, 'PAK_ZUL.JPG', '', '081241918415', 'Y', NULL, NULL),
(25, 18, 'MUHAMAD ARYANDI YAHYA, S.H.', '-', '-', '-', 'STAF', NULL, NULL, 'PAK_ANDI.JPG', '', '08114347910', 'Y', NULL, NULL),
(26, 18, 'IDRIS DJAKARIA, S.H.', '-', '-', '-', 'STAF', NULL, NULL, 'IDRIS.JPG', '', '085256790733', 'Y', NULL, NULL),
(27, 18, 'RISKAWATI PANTO, S.H.', '-', '-', '-', 'STAF', NULL, NULL, 'IBU_RISKA.JPG', 'riskawatipanto94@gmail.com', '085280354392', 'Y', NULL, NULL),
(28, 17, 'NURVINA I. UMAR, S.KOM.', '-', '-', '-', 'HONORER', NULL, NULL, 'IBU_VINA.JPG', 'Umarvhina@gmail.com', '085255390214', 'Y', NULL, NULL),
(30, 17, 'ptsp', '-', '-', '-', 'ptsp', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(31, 6, 'BURHAN ,S.H.,M.H.', '196912311993031024', 'Pembina', 'IV/a', 'PANMUD PERKARA', NULL, NULL, 'pak_burhan_4x6.jpg', '-', '085342798763', 'Y', NULL, NULL),
(32, 1, 'Plh. KETUA', '-', '-', '-', '-', NULL, NULL, 'default.png', '-', '', 'Y', NULL, NULL),
(34, 3, 'plh. PANITERA', '-', '-', '-', '-', NULL, NULL, 'default.png', '-', '-', 'Y', NULL, NULL),
(36, 14, 'VINKY RIZKY OKTAVIA, S.H., M.H.', '198810192017122001', 'Penata Muda Tingkat ', 'III/b', 'Hakim Pratama Muda', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(38, 12, 'DHANANG NURKUSUMA, S.Kom.', '199606092020121009', 'Penata Muda ', 'III/a', 'Pranata Komputer', NULL, NULL, 'default.png', '', '081393939730', 'Y', NULL, NULL),
(39, 13, 'FAJAR ANDHIKA SUWARTO PUTRA, A.Md.', '199404072020121009', 'Pengatur', 'II/c', 'Pengelola Sistem dan Jaringan', NULL, NULL, 'default.png', '', '089674813113', 'Y', NULL, NULL),
(40, 11, 'NURUL FAIZAH, S.E.', '199604192020122013', 'Penata Muda ', 'III/a', 'Verifikator Keuangan', NULL, NULL, 'default.png', '', '082147749009', 'Y', NULL, NULL),
(41, 1, 'SUGIYANTO, S.H., M.H.', '197009061991031005', 'Pembina Tk.I', 'IV/c', 'Ketua', NULL, NULL, 'kawaka11.png', '', '', 'Y', NULL, NULL),
(42, 3, 'JOEL JOJADA ALEXANDER ROEROE, S.H.', '197001101991031005', 'Penata TK. I', 'III/d', 'Panitera Tingkat Pertama Klas IA', NULL, NULL, 'default.png', 'joel@ptungorontalo.com', '', 'Y', NULL, NULL),
(44, 1, 'plt. Pankum', '-', '-', '-', '-', NULL, NULL, 'default.png', 'ptun.gorontalo@gmail.com', '-', 'Y', NULL, NULL),
(45, 1, 'SUTIYONO, S.H., M.H.', '196801201997031001', 'Pembina Utama Muda', 'IV/c', 'Ketua', NULL, NULL, '_GDZ9520.jpg', '', '', 'Y', NULL, NULL),
(46, 4, 'Plh. SEKRETARIS', '-', '-', '-', '-', NULL, NULL, 'default.png', '-', '', 'Y', NULL, NULL),
(47, 17, 'DOZEN SAPUTRA, A.Md.', '19910603 202203 1 00', 'Pengatur', 'II/c', 'Pengelola BMN', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(48, 14, 'MUHAMMAD RIZALDI RAHMAN, S.H.	', '199501042017121007', 'Penata Muda Tingkat ', 'III/b', 'Hakim Pratama Muda', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(49, 18, 'HASRUL A. ANTUNG	', '-', '-', '-', 'STAF PPNPN', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(50, 17, 'WAHYU DESIANA, S.H.', '199612072022032014', 'Penata Muda', 'III/a', 'Analis Perkara Peradilan', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(51, 17, 'RADEN AFIRAL DEVIAN RANGGA BRAMASTYA, S.H.', '199709232022031008', 'Penata Muda', 'III/a', 'Analis Perkara Peradilan', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(52, 17, 'RIZKI CINTIA DEVI, S.H.', '199803312022032009', 'Penata Muda', 'III/a', 'Analis Perkara Peradilan', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(53, 17, 'DOZEN SAPUTRA, A.Md.', '199106032022031006', 'Pengatur', 'II/c', 'Pengelola Barang Milik Negara', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(54, 17, 'DWI NURYATI, A.Md.', '199211132022032009', 'Pengatur', 'II/c', 'Pengelola Perkara', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(55, 3, 'SULTHAN, S.H.', '196812081991031007', 'Pembina', 'IV/a', 'Panitera Tingkat Pertama Klas IA', NULL, NULL, 'default.png', 'ptip.ptungorontalo@gmai.com', '', 'Y', NULL, NULL),
(56, 15, 'SALTIE LONDONG, S.H.', '198103222009042002', 'Penata ', '(III/c)', 'Panitera Pengganti', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(57, 15, 'AGUS SUJONO, S.H.', '196604101989031007', 'Penata', '(III/c)', 'Panitera Pengganti', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL),
(58, 2, 'RIALAM SIHITE, S.H., M.H.', '197004271996032004', 'Pembina Tingkat I', 'IV/b', 'WAKIL KETUA', NULL, NULL, 'Bu_Rialam.png', 'wakilketua@gmail.com', '', 'Y', NULL, NULL),
(59, 6, 'Plh. Panitera Muda Perkara', '-', '-', '-', '-', NULL, NULL, 'default.png', '', '', 'Y', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ctr_permintaan_barang`
--

CREATE TABLE `ctr_permintaan_barang` (
  `id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `tgl_permintaan` date NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `jumlah_diminta` smallint(6) DEFAULT NULL,
  `jumlah_diberikan` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctr_pesan`
--

CREATE TABLE `ctr_pesan` (
  `id` bigint(20) NOT NULL,
  `user_source` int(11) DEFAULT NULL,
  `user_target` int(11) DEFAULT NULL,
  `isi` text,
  `tgl_kirim` datetime DEFAULT NULL,
  `status` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctr_sifat_disposisi`
--

CREATE TABLE `ctr_sifat_disposisi` (
  `id` int(5) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_sifat_disposisi`
--

INSERT INTO `ctr_sifat_disposisi` (`id`, `nama`, `keterangan`) VALUES
(1, 'Biasa', 'Biasa'),
(4, 'Segera', 'Segera ditindaklanjuti'),
(5, 'Tidak Perlu', 'Tidak Perlu'),
(6, 'Lain-lain', 'Lain lain'),
(7, 'Penting', 'Segera Ditindaklanjuti');

-- --------------------------------------------------------

--
-- Table structure for table `ctr_sifat_surat`
--

CREATE TABLE `ctr_sifat_surat` (
  `sifat_id` int(5) NOT NULL,
  `kode` char(20) NOT NULL,
  `nama` varchar(500) DEFAULT NULL,
  `current_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_sifat_surat`
--

INSERT INTO `ctr_sifat_surat` (`sifat_id`, `kode`, `nama`, `current_time`) VALUES
(1, 'B', 'Biasa', NULL),
(2, 'R', 'Rahasia', NULL),
(3, 'T', 'Terbatas', NULL),
(4, 'SR', 'Sangat Rahasia', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ctr_status_surat`
--

CREATE TABLE `ctr_status_surat` (
  `status_id` int(5) NOT NULL,
  `nama` varchar(500) DEFAULT NULL,
  `current_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_status_surat`
--

INSERT INTO `ctr_status_surat` (`status_id`, `nama`, `current_time`) VALUES
(1, 'Diterima', NULL),
(2, 'Surat Kembali', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ctr_surat_keluar`
--

CREATE TABLE `ctr_surat_keluar` (
  `surat_id` int(5) NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `format_nomor_id` int(11) NOT NULL,
  `sifat_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL,
  `no_surat` char(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `pengirim` varchar(255) NOT NULL,
  `untuk` varchar(255) NOT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `ekspedisi` smallint(6) DEFAULT NULL,
  `perihal` varchar(255) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `status_disposisi` char(1) DEFAULT '0' COMMENT '1 sudah disposisi 0 belum disposisi',
  `file_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_surat_keluar`
--

INSERT INTO `ctr_surat_keluar` (`surat_id`, `no_agenda`, `format_nomor_id`, `sifat_id`, `status_id`, `no_surat`, `tgl_surat`, `tgl_terima`, `pengirim`, `untuk`, `tgl_kirim`, `ekspedisi`, `perihal`, `ket`, `status_disposisi`, `file_name`) VALUES
(4, '4/KELUAR/XI/2023', 1, 2, 1, 'W8-TUN2/4/OT.00/11/2023', '2023-11-05', '2023-11-05', 'PTUN.GTO', 'saya', '2023-11-05', 1, 'mmm', '', '0', 'Virtual_background1.jpg'),
(5, '5/KELUAR/XI/2023', 1, 2, 2, 'W8-TUN2/5/OT.00/11/2023', '2023-11-12', '2023-11-12', 'PTUN.GTO', 'asdawdsadwad', '2023-11-12', 1, 'sadawdsadaw', 'asdasd', '0', 'Virtual_background3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ctr_surat_keluar_2`
--

CREATE TABLE `ctr_surat_keluar_2` (
  `surat_id` int(5) NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `format_nomor_id` int(11) NOT NULL,
  `sifat_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL,
  `no_surat` char(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `pengirim` varchar(255) NOT NULL,
  `untuk` varchar(255) NOT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `ekspedisi` smallint(6) DEFAULT NULL,
  `perihal` varchar(255) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `status_disposisi` char(1) DEFAULT '0' COMMENT '1 sudah disposisi 0 belum disposisi',
  `file_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctr_surat_keluar_baru`
--

CREATE TABLE `ctr_surat_keluar_baru` (
  `surat_id` int(5) NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `format_nomor_id` int(11) NOT NULL,
  `format_no_surat_id` int(11) NOT NULL,
  `sifat_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `no_surat` char(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_terima` date DEFAULT NULL,
  `pengirim` varchar(255) NOT NULL,
  `untuk` varchar(255) NOT NULL,
  `tgl_kirim` date DEFAULT NULL,
  `ekspedisi` smallint(6) DEFAULT NULL,
  `perihal` varchar(255) NOT NULL,
  `ket` varchar(100) NOT NULL,
  `status_disposisi` char(1) DEFAULT '0' COMMENT '1 sudah disposisi 0 belum disposisi',
  `file_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_surat_keluar_baru`
--

INSERT INTO `ctr_surat_keluar_baru` (`surat_id`, `no_agenda`, `format_nomor_id`, `format_no_surat_id`, `sifat_id`, `status_id`, `kategori_id`, `no_surat`, `tgl_surat`, `tgl_terima`, `pengirim`, `untuk`, `tgl_kirim`, `ekspedisi`, `perihal`, `ket`, `status_disposisi`, `file_name`) VALUES
(1, '1/KELUAR/X/2023', 1, 1, 1, 0, 3, '1/KPTUN.W8-TUN2/OT.00/10/2023', '2023-10-13', '2023-10-13', 'PTUN.GTO', 'sddwed', '2023-10-13', 1, 'wed', 'wed', '0', NULL),
(2, '2/KELUAR/X/2023', 1, 1, 1, 0, 7, '2/KPTUN.W8-TUN2/OT.00/10/2023', '2023-10-13', '2023-10-13', 'PTUN.GTO', 'hbuhb', '2023-10-13', 1, 'huihn', 'hbh', '0', NULL),
(3, '3/KELUAR/X/2023', 1, 1, 1, 0, 2, '3/KPTUN.W8-TUN2/OT.00/10/2023', '2023-10-13', '2023-10-13', 'PTUN.GTO', 'sads', '2023-10-13', 1, 'dasd', '', '0', '705a54300692591fe4885fe0acc95b9a1.jpg'),
(4, '4/KELUAR/XI/2023', 1, 1, 2, 0, 2, '', '2023-11-12', '2023-11-12', 'PTUN.GTO', 'adsawda', '2023-11-12', 1, 'sdawdsadaw', 'asdawdsdaw', '0', 'Virtual_background.jpg'),
(5, '5/KELUAR/XI/2023', 1, 3, 3, 0, 10, '1/PAN.PTUN.W8-TUN2/OT.00/11/2023', '2023-11-12', '2023-11-12', 'PTUN.GTO', 'ewqeqweqweqwe', '2023-11-12', 1, 'qdwqeqweqweq', 'qweqweqewqeqweq', '0', NULL),
(6, '6/KELUAR/XI/2023', 1, 2, 2, 0, 10, '12/SEK.PTUN.W8-TUN2/OT.00/11/2023', '2023-11-12', '2023-11-12', 'PTUN.GTO', 'fdgsegsdgs', '2023-11-12', 1, 'awdasdawdasd', 'hdfgdfgdfgd', '0', NULL),
(7, '7/KELUAR/XI/2023', 1, 1, 1, 2, 3, '1/KPTUN.W8-TUN2/OT.00/11/2023', '2023-11-12', '2023-11-12', 'PTUN.GTO', 'dawdasdawd', '2023-11-12', 1, 'awdasdwads', 'wadasdawdadwa', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ctr_surat_masuk`
--

CREATE TABLE `ctr_surat_masuk` (
  `surat_id` int(5) NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `balasan` varchar(20) NOT NULL DEFAULT '-',
  `sifat_id` int(5) NOT NULL,
  `status_id` int(5) NOT NULL,
  `no_surat` char(100) NOT NULL,
  `tgl_surat` date NOT NULL,
  `tgl_terima` date NOT NULL,
  `pengirim` varchar(255) NOT NULL,
  `untuk` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `ket` varchar(100) DEFAULT NULL,
  `status_disposisi` char(1) DEFAULT '0' COMMENT '1 sudah disposisi 0 belum disposisi',
  `status_diterima` char(1) DEFAULT '0' COMMENT '1 sudah diterima 0 blm diterima',
  `file_name` varbinary(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctr_surat_masuk`
--

INSERT INTO `ctr_surat_masuk` (`surat_id`, `no_agenda`, `balasan`, `sifat_id`, `status_id`, `no_surat`, `tgl_surat`, `tgl_terima`, `pengirim`, `untuk`, `perihal`, `ket`, `status_disposisi`, `status_diterima`, `file_name`) VALUES
(1, '1/MASUK/XI/2023', '-', 1, 0, '1', '2023-11-05', '2023-11-05', 'rsry', 'Ketua PTUN.GTO', 'guiou', '', '0', '0', 0x3730356135343330303639323539316665343838356665306163633935623961332e6a7067),
(2, '2/MASUK/XI/2023', '-', 4, 0, 'dfsdf', '2023-11-12', '2023-11-12', 'sfsdfs', 'Ketua PTUN.GTO', 'sdfsdf', 'sdfsdf', '1', '0', 0x5669727475616c5f6261636b67726f756e642e6a7067),
(3, '3/MASUK/XI/2023', '-', 0, 2, 'dawdasdawd', '2023-11-12', '2023-11-12', 'asdwadasdwa', 'Ketua PTUN.GTO', 'asdwadsdaw', 'dsdawdasdaw', '0', '0', 0x5669727475616c5f6261636b67726f756e64342e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `ctr_surat_ordner`
--

CREATE TABLE `ctr_surat_ordner` (
  `id` int(5) NOT NULL,
  `ordner_id` int(5) NOT NULL,
  `surat_id` int(5) NOT NULL,
  `tgl_ordner` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ctr_transaksi_barang`
--

CREATE TABLE `ctr_transaksi_barang` (
  `id` bigint(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jenis` char(1) NOT NULL DEFAULT '1' COMMENT '1 masuk 2 keluar',
  `jumlah` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dix_buku_tamu`
--

CREATE TABLE `dix_buku_tamu` (
  `id` bigint(20) NOT NULL,
  `tujuan_id` int(2) NOT NULL COMMENT '"menghadap kebagian" refer table ctr_jabatan kolom id',
  `nama` varchar(50) NOT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `keperluan` varchar(255) NOT NULL,
  `diinput_oleh` varchar(50) DEFAULT NULL,
  `diinput_tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dix_ref_format_nomor_surat`
--

CREATE TABLE `dix_ref_format_nomor_surat` (
  `id` int(11) NOT NULL,
  `format_penomoran` varchar(100) NOT NULL,
  `kode_surat` varchar(100) DEFAULT NULL,
  `uraian` varchar(100) NOT NULL,
  `bagian` char(1) DEFAULT NULL COMMENT '1. Kepegawaian, 2. Umum dan Keuangan, 3.IT, 4. Pidana, 5. Perdata, 6. Hukum'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dix_ref_format_nomor_surat`
--

INSERT INTO `dix_ref_format_nomor_surat` (`id`, `format_penomoran`, `kode_surat`, `uraian`, `bagian`) VALUES
(1, 'W8-TUN2/NMR/OT.00/BLN/THN', 'OT.00', 'Surat yang berhubungan dengan pembentukan, perubahan organisasi, uraian pekerjaan dan pembahasannya', '1'),
(4, 'W8-TUN2/NMR/HM.00/BLN/THN', 'HM.00', 'Surat yang berhubungan dengan segala kegiatan penerangan terhadap masyarakat tentang kegiatan MARI.', '2'),
(5, 'W8-TUN2/NMR/OT.01.4/BLN/THN', 'OT.01.4', 'Surat yang berhubungan dengan penyusunan pembakuan sarana kerja yakni penentuan kualitas & kuantitas', '1'),
(6, 'W8-TUN2/NMR/OT.01.3/BLN/THN', 'OT.01.3', 'Surat yang berkenaan dengan penyusunan sistem, prosedur, pedoman, petunjuk pelaksanaan, tata kerja', '1'),
(7, 'W8-TUN2/NMR/OT.01.2/BLN/THN', 'OT.01.2', 'Surat yang berhubungan dengan laporan umum, monitoring, evaluasi dan unit kerja ', '1'),
(8, 'W8-TUN2/NMR/OT.01.1/BLN/THN', 'OT.01.1', 'Surat yang berhubungan dgn penyusunan perencanaan/program kerja oleh unit-unit kerja Mahkamah Agung', '1'),
(9, 'W8-TUN2/NMR/KU.01/BLN/THN', 'KU.01', 'Surat penyiapan bahan bimbingan dlm pelaksanaan penggunaan anggaran & pertanggung jawaban keuangan', '2'),
(10, 'W8-TUN2/NMR/KU.04.2/BLN/THN', 'KU.04.2', 'Surat Tentang PNBP', '2'),
(11, 'W8-TUN2/NMR/PL.01/BLN/THN', 'PL.01', 'Surat Tentang Perencanaan, Pengadaan, pelelangan, pendistribusian, pemeliharaan dan penghapusan', '2'),
(12, 'W8-TUN2/NMR/PL.02/BLN/THN', 'PL.02', 'Surat Tentang Perencanaan, Pengadaan/pelelangan, pemeliharaan, penghapusan dan tukar gulingng tanah', '2'),
(13, 'W8-TUN2/NMR/PL.03/BLN/THN', 'PL.03', 'Surat Tentang Perencanaan, Pengadaan, pelelangan, pendistribusian, pemeliharaan & penghapusan', '2'),
(17, 'W8-TUN2/NMR/HK.00.8/BLN/THN', 'HK.00.8', 'Surat Tentang Peraturan Tk Banding dan Tk Pertama', '6'),
(20, 'W8-TUN2/NMR/HM.01.1/BLN/THN', 'HM.01.1', 'Surat kegiatan intern MARI, dan antara MARI dgn pihak lain, baik dlm maupun luar negeri', '2'),
(21, 'W8-TUN2/NMR/HM.01.2/BLN/THN', 'HM.01.2', 'Surat yg berkenaan dgn masalah pertokolan (Tamu pimpinan MA, Kunjungan kerja MA, Upacara, HUT MARI)', '2'),
(22, 'W8-TUN2/NMR/HM.02.1/BLN/THN', 'HM.02.1', 'Surat yang berhubungan dengan penyediaan/pengumpulan bahan/dokumentasi, termasuk penyebarannya', '2'),
(23, 'W8-TUN2/NMR/HM.02.2/BLN/THN', 'HM.02.2', 'Surat yang berhubungan dengan penyediaan, pengumpulan, dan penataan bahan-bahan kepustakaan', '2'),
(24, 'W8-TUN2/NMR/HM.02.3/BLN/THN', 'HM.02.3', 'Surat yang berhubungan dgn perencanaan, penyediaan, pemeliharaan, pengelolaan & IT', '3'),
(25, 'W8-TUN2/NMR/KP.00.1/BLN/THN', 'KP.00.1', 'Surat perencanaan pengadaan pegawai, nota usul formasi, persetujuan termasuk didlmnya pegawai honor', '1'),
(26, 'W8-TUN2/NMR/KP.00.2/BLN/THN', 'KP.00.2', 'Surat penerimaan pegawai baru/honor, mulai dr pengumuman penerimaan, panggilan test, s,d pengumuman', '1'),
(27, 'W8-TUN2/NMR/KP.00.3/BLN/THN', 'KP.00.3', 'Surat pengangkatan, penempatan CPNS s.d menjadi PNS mulai dr persyaratan, pemeriksaan & ket lainnya', '1'),
(28, 'W8-TUN2/NMR/KP.01.1/BLN/THN', 'KP.01.1', 'Surat izin tdk masuk kerja, termasuk tugas pd instansi lain baik tugas belajar, tugas di L. Negeri ', '1'),
(29, 'W8-TUN2/NMR/KP.01.2/BLN/THN', 'KP.01.2', 'Surat ket pegawai & klgnya, surat yg berkaitan dgn NIP, KARPEG, KARSU/KARIS & data peg/pejabat', '1'),
(30, 'W8-TUN2/NMR/KP.02.1/BLN/THN', 'KP.02.1', 'Surat penilaian pekerjaan, disiplin pegawai, pemalsuan administrasi kepegawaian dan rehabilitasi', '1'),
(31, 'W8-TUN2/NMR/KP.02.2/BLN/THN', 'KP.02.2', 'Surat hukuman pegawai (teguran tertulis, penundaan KGB, Penundaan kenaikan pangkat dsb', '1'),
(32, 'W8-TUN2/NMR/KP.03/BLN/THN', 'KP.03', 'Surat pembinaan mental pegawai, termasuk didalamnya pembinaan kerohanian', '1'),
(33, 'W8-TUN2/NMR/KP.04.1/BLN/THN', 'KP.04.1', 'Surat kenaikan pangkat, ujian dinas, ujian penyesuaian ijazah, dan DUK', '1'),
(34, 'W8-TUN2/NMR/KP.04.2/BLN/THN', 'KP.04.2', 'Surat yang berkenaan dengan KGB', '1'),
(35, 'W8-TUN2/NMR/KP.04.3/BLN/THN', 'KP.04.3', 'Surat penyesuaian masa kerja untuk perubahan ruang gaji dan impassing', '1'),
(36, 'W8-TUN2/NMR/KP.04.4/BLN/THN', 'KP.04.4', 'Surat yang berkenaan dengan penyesuaian tunjangan keluarga', '1'),
(37, 'W8-TUN2/NMR/KP.04.5/BLN/THN', 'KP.04.5', 'Surat pengangkatan & pemberhentian dlm jabatan struktural/fungsional, termasuk tunjangan jabatan ', '1'),
(38, 'W8-TUN2/NMR/KP.04.6/BLN/THN', 'KP.04.6', 'Surat pengangkatan dan pemberhentian jabatan struktural/fungsional termasuk tunjangan jabatan', '1'),
(39, 'W8-TUN2/NMR/KP.05.1/BLN/THN', 'KP.05.1', 'Surat penyelenggaraan kesehatan bagi pegawai (asuransi, general chek up bagi pimpinan & pejabat', '1'),
(40, 'W8-TUN2/NMR/KP.05.2/BLN/THN', 'KP.05.2', 'Surat yang berkenaan dengan cuti pegawai (Cuti sakit, hamil/bersalin, cuti diluar tanggung jawab neg', '1'),
(41, 'W8-TUN2/NMR/KP.05.3/BLN/THN', 'KP.05.3', 'Surat yang berkenaan dengan rekreasi dan olah raga', '1'),
(42, 'W8-TUN2/NMR/KP.05.4/BLN/THN', 'KP.05.4', 'Surat pemberian bantuan/tunjangan sosial kepada pegawai dan klg yang mengalami musibah, termasuk uca', '1'),
(43, 'W8-TUN2/NMR/KP.05.5/BLN/THN', 'KP.05.5', 'Surat organisasi koperasi termasuk didalamnya masalah pengurusan kebutuhan bahan pokok', '1'),
(44, 'W8-TUN2/NMR/KP.05.6/BLN/THN', 'KP.05.6', 'Surat yg berkenaan dgn rumah pegawai, pejabat struktural/fungsional, pimpinan dan hakim agung', '1'),
(45, 'W8-TUN2/NMR/KP.05.7/BLN/THN', 'KP.05.07', 'Surat yang berkenaan dengan transportasi pegawai', '1'),
(46, 'W8-TUN2/NMR/KP.05.8/BLN/THN', 'KP.05.8', 'Surat yang berkenaan dengan penghargaan, tanda jasa, piagam, satya lencana, dan sejenisnya', '1'),
(47, 'W8-TUN2/NMR/KU.OO/BLN/THN', 'KU.00', 'Surat penyiapan pelaksanaan & pembinaan pembukuan keuangan, serta penyusunan perhitungan anggaran', '2'),
(48, 'W8-TUN2/NMR/KU.02/BLN/THN', 'KU.02', 'Surat penyiapan pencatatan, penelitian, pembinaan, & penyusunan laporan ttg verifikasi & ganti rugi', '2'),
(49, 'W8-TUN2/NMR/KU.03/BLN/THN', 'KU.03', 'Surat bimbingan dan ketatausahaan perbendaharaan dan pelaksanaan pembinaan perbendaharawan', '2'),
(50, 'W8-TUN2/NMR/KU.04.1/BLN/THN', 'KU.04.1', 'Surat yang berkenaan dengan pendapatan negara dan hasil pajak yang meliputi PPN, PPH, dan pajak lain', '2'),
(51, 'W8-TUN2/NMR/KU.05/BLN/THN', 'KU.05', 'Surat tentang perbankan (pembukaan rek.,spesemen tanda tangan, rekening koran) dsb', '2'),
(52, 'W8-TUN2/NMR/KU.06/BLN/THN', 'KU.06', 'Surat permintaan, pemberian, sumbangan/bantuan khusus diluar tugas pokok MA (bencana alam, kebakaran', '1'),
(53, 'W8-TUN2/NMR/KS.00/BLN/THN', 'KS.00', 'Surat yg berkenaan dgn penggunaan fasilitas,ketertiban & keamanan, konsumsi, pakaian dinas, stempel,', '2'),
(54, 'W8-TUN2/NMR/PL.04/BLN/THN', 'PL.04', 'Surat perencanaan, pengadaan, pendistribusian, pemeliharaan & penghapusan (Ac, laptop, computer, dsb', '3'),
(55, 'W8-TUN2/NMR/PL.05/BLN/THN', 'PL.05', 'Surat perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan penghapusan meubeleir (kursi', '3'),
(56, 'W8-TUN2/NMR/PL.06/BLN/THN', 'PL.06', 'Surat mengenai kendaraan, dari perencanaan, pengadaan, pelelangan, pendistribusian, pemeliharaan dan', '3'),
(57, 'W8-TUN2/NMR/PL.07/BLN/THN', 'PL.07', 'Surat inventaris perlengkapan, laporan inventaris perlengkapan baik pusat maupun daerah', '2'),
(58, 'W8-TUN2/NMR/PL.08/BLN/THN', 'PL.08', 'Surat ttg pelelangan dari persiapan pelelangan s.d pengumuman pemenang.', '2'),
(59, 'W8-TUN2/NMR/PL.09/BLN/THN', 'PL.09', 'Surat korespondensi, kearsipan, penandatanganan surat & wewenangnya, cap dinas dsb', '2'),
(62, 'W8-TUN2/NMR/HK.00.1/BLN/THN', 'HK.00.1', 'Undang-undang termasuk PERPU', '6'),
(63, 'W8-TUN2/NMR/HK.00.2/BLN/THN', 'HK.00.2', 'Peraturan Pemerintah', '6'),
(64, 'W8-TUN2/NMR/HK.00.3/BLN/THN', 'HK.00.3', 'Keputusan presiden, intruksi presiden, penetapan presiden)', '6'),
(65, 'W8-TUN2/NMR/HK.00.4/BLN/THN', 'HK.00.4', 'Peraturan Ketua Mahkamah Agung', '6'),
(66, 'W8-TUN2/NMR/HK.00.6/BLN/THN', 'HK.00.6', 'Keputusan Pejabat Eselon I', '6'),
(67, 'W8-TUN2/NMR/HK.00.5/BLN/THN', 'HK.00.5', 'Keputusan Mahkamah Agung, Intruksi Mahkamah Agung', '6'),
(68, 'W8-TUN2/NMR/HK.00.7/BLN/THN', 'HK.00.7', 'Surat edaran pejabat eselon I', '6'),
(69, 'W8-TUN2/NMR/HK.00.8/BLN/THN', 'HK.00.8', 'Peraturan Pengadilan Tingkat Banding dan Tingkat Pertama', '6'),
(70, 'W8-TUN2/NMR/HK.00.9/BLN/THN', 'HK.00.9', 'Peraturan PEMDA Tk.I dan PEMDA Tk.II', '6'),
(71, 'W8-TUN2/NMR/HK.06/BLN/THN', 'HK.06', 'Surat yang berkenaan dengan penyelesaian perkara tata usaha negara', '6'),
(72, 'W8-TUN2/NMR/HK.01/BLN/THN', 'HK.01', 'Surat yang berhubungan dengan penyelesaian perkara pidana, baik pidana kejahatan maupun pidana pelan', '6'),
(73, 'W8-TUN2/NMR/PP.00.1/BLN/THN', 'PP.00.1', 'Surat yg berkaitan dgn perencanaan, evaluasi penyelenggaraan pendidikan & pelatihan hakim', '1'),
(74, 'W8-TUN2/NMR/PP.00.2/BLN/THN', 'PP.00.2', 'Surat surat yg berkenaan dgn perencanaan, pelaksanaan, evaluasi penyelenggaraan diklat panitera', '1'),
(75, 'W8-TUN2/NMR/PP.00.3/BLN/THN', 'PP.00.3', 'Surat yg berhubungan dgn perencanaan, pelaksanaan, evaluasi penyelenggaraan diklat jurusita', '1'),
(76, 'W8-TUN2/NMR/PP.00.4/BLN/THN', 'PP.00.4', 'Surat yg berkenaan dgn perencanaan, pelaksanaan, evaluasi peyelenggaraan diklat teknis lainnya', '1'),
(77, 'W8-TUN2/NMR/PP.01.1/BLN/THN', 'PP.01.1', 'Surat yg berkenaan dgn diklat penjenjangan (Diklat PIM tk. I, II, III dan  IV, Lemhanas)', '1'),
(78, 'W8-TUN2/NMR/PP.01.2/BLN/THN', 'PP.01.2', 'surat yg berkenaan dgn Diklat kepangkatan (Prajabatan, SICATUR, SUSCATA, SUSCABIN (kursus calan Peng', '1'),
(79, 'W8-TUN2/NMR/PP.01.3/BLN/THN', 'PP.01.3', 'Surat lat tenaga adm, kursus, penataran, di bid manajemen atau lainnya baik dlm negeri maupun luar n', '1'),
(80, 'W8-TUN2/NMR/PB.00/BLN/THN', 'PP.00', 'Surat penelitian & pengembangan hukum, sejak dr perencanaan, perizinan s.d pelaporan hasil penelitia', '1'),
(81, 'W8-TUN2/NMR/PB.01/BLN/THN', 'PP.01', 'Surat penelitian pengembangan peradilan, sejak dr perencanaan, perizinan, pelaksanaan, s.d pelaporan', '1'),
(82, 'W8-TUN2/NMR/PP.02/BLN/THN', 'PP.02', 'Surat masalah-masalah pengembangan penelitian & perencanaan, pelaksanaan s.d pelaporan', '1'),
(83, 'W8-TUN2/NMR/PS.00/BLN/THN', 'PS.00', 'Surat pengawasan adm umum (pengawasan ketatausahaan, kepegawaian, perlengkapan LHP & tindak lanjutny', '2'),
(84, 'W8-TUN2/NMR/PS.01/BLN/THN', 'PS.01', 'Surat pengawasan bid teknis peradilan. dr perencanaan, pelaksanaan, LHP dan tindak lanjutnya', '2'),
(85, 'W8-TUN2/NMR/KP.06/BLN/THN', 'KP.06', 'Surat yg berkenaan dengan pensiun pegawai,termasuk jaminan asuransi karena berhenti atas permintaan ', '1'),
(86, 'W4-TUN7/NMR/KS.00/BLN/THN', 'KS.00', 'Kerumahtanggaan', '1'),
(87, 'W8-TUN2/NMR/KP.04/BLN/THN', 'KP.04', 'MUTASI', '1');

-- --------------------------------------------------------

--
-- Table structure for table `dix_ref_nomor_agenda`
--

CREATE TABLE `dix_ref_nomor_agenda` (
  `id` int(1) NOT NULL,
  `format_nomor_agenda` varchar(100) NOT NULL,
  `uraian` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dix_ref_nomor_agenda`
--

INSERT INTO `dix_ref_nomor_agenda` (`id`, `format_nomor_agenda`, `uraian`) VALUES
(1, 'NMR/MASUK/BLN/THN', 'Nomor Agenda Surat Masuk'),
(2, 'NMR/KELUAR/BLN/THN', 'Nomor Agenda Surat Keluar');

-- --------------------------------------------------------

--
-- Table structure for table `dix_spt`
--

CREATE TABLE `dix_spt` (
  `id` bigint(20) NOT NULL,
  `pegawai_id` varchar(50) NOT NULL,
  `nomor_surat` varchar(50) NOT NULL,
  `tanggal_surat` date NOT NULL,
  `pergi_ke` varchar(50) NOT NULL,
  `keperluan` varchar(255) NOT NULL,
  `berkendaraan` varchar(50) NOT NULL,
  `berangkat` date NOT NULL,
  `mulai` date NOT NULL,
  `selesai` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `diinput_oleh` varchar(50) DEFAULT NULL,
  `diinput_tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dix_surat_ijin`
--

CREATE TABLE `dix_surat_ijin` (
  `id` bigint(20) NOT NULL,
  `pegawai_id` bigint(20) NOT NULL,
  `jenis_ijin` char(1) DEFAULT NULL COMMENT '1. Ijin Tdk Masuk, 2. Cuti Sakit, 3.Cuti Tahunan, 4.Cuti Besar, 5. Cuti Bersalin, 6. Cuti Karena Alasan Penting',
  `tgl_permohonan` date NOT NULL,
  `mulai_ijin` date NOT NULL,
  `selesai_ijin` date NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nomor_urut_surat` int(11) DEFAULT NULL,
  `nomor_surat` varchar(100) DEFAULT NULL,
  `diijinkan` char(1) DEFAULT NULL COMMENT '1.Ya 2.Tidak',
  `tgl_diijinkan` date DEFAULT NULL,
  `diinput_oleh` varchar(50) DEFAULT NULL,
  `diinput_tanggal` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dix_surat_ijin`
--

INSERT INTO `dix_surat_ijin` (`id`, `pegawai_id`, `jenis_ijin`, `tgl_permohonan`, `mulai_ijin`, `selesai_ijin`, `keterangan`, `nomor_urut_surat`, `nomor_surat`, `diijinkan`, `tgl_diijinkan`, `diinput_oleh`, `diinput_tanggal`) VALUES
(2, 55, '3', '2023-01-02', '2023-01-02', '2023-01-03', '2 HK Sisa cuti tahun 2023 sebanyak 10 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-01-03 03:36:44'),
(3, 15, '3', '2023-01-03', '2023-01-03', '2023-01-10', '6 HK Sisa cuti tahun 2023 sebanyak 6 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-01-03 03:45:45'),
(4, 55, '2', '2023-01-04', '2023-01-04', '2023-01-06', '3 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-01-05 12:38:55'),
(5, 56, '2', '2023-01-06', '2023-01-06', '2023-01-06', '1 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-01-06 10:23:13'),
(6, 55, '2', '2023-01-09', '2023-01-09', '2023-01-11', '3 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-01-09 09:35:05'),
(7, 16, '2', '2023-01-12', '2023-01-11', '2023-01-12', '2 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-01-12 06:29:57'),
(8, 55, '2', '2023-01-12', '2023-01-12', '2023-01-13', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-01-13 09:17:44'),
(9, 54, '2', '2023-01-13', '2023-01-13', '2023-01-13', '1 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-01-16 09:00:27'),
(10, 19, '2', '2023-01-19', '2023-01-19', '2023-01-20', '2 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-01-19 02:49:08'),
(11, 54, '5', '2023-01-10', '2023-01-16', '2023-03-26', '2 Bulan 10 Hari', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-27 05:20:01'),
(12, 41, '3', '2023-01-10', '2023-02-13', '2023-02-20', '6 HK Sisa Cuti Tahun 2023 sebanyak 8 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-02-22 01:15:02'),
(13, 14, '2', '2023-02-06', '2023-02-06', '2023-02-06', '1 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-02-07 06:49:29'),
(14, 52, '2', '2023-02-07', '2023-02-07', '2023-02-08', '2 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-02-07 06:50:14'),
(15, 53, '2', '2023-02-07', '2023-02-07', '2023-02-09', '3 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-02-07 06:52:04'),
(16, 13, '3', '2023-02-14', '2023-02-16', '2023-02-22', '5 HK Sisa Cuti Tahun 2023 sebanyak 8 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-02-14 07:53:39'),
(17, 55, '3', '2023-02-14', '2023-02-16', '2023-02-21', '4 HK Sisa Cuti Tahun 2023 sebanyak 6 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-02-14 07:54:40'),
(18, 16, '2', '2023-02-16', '2023-02-13', '2023-02-15', '3 HK', NULL, NULL, NULL, NULL, 'ahmadsujai', '2023-02-17 03:32:29'),
(19, 55, '2', '2023-02-22', '2023-02-22', '2023-02-24', '3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-02-23 04:29:12'),
(20, 18, '3', '2023-02-27', '2023-02-28', '2023-03-01', '2 HK Sisa Cuti Tahun 2022 sebanyak 5 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-02-28 08:01:48'),
(21, 23, '3', '2023-02-27', '2023-03-06', '2023-03-10', '5 HK Sisa Cuti Tahun 2022 sebanyak 5 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-02-28 08:02:32'),
(22, 21, '3', '2023-03-01', '2023-03-02', '2023-03-03', '2 HK Sisa Cuti Tahun 2021 Sebanyak 2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-12 02:11:25'),
(23, 38, '2', '2023-03-07', '2023-03-06', '2023-03-07', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-07 01:36:24'),
(24, 55, '3', '2023-03-17', '2023-03-20', '2023-03-20', '1 HK Sisa Cuti Tahun 2023 Sebanyak 5 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-17 06:43:19'),
(25, 13, '3', '2023-03-21', '2023-03-24', '2023-03-24', '1 HK Sisa Cuti Tahun 2023 Sebanyak 7 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-21 02:09:43'),
(26, 55, '2', '2023-03-21', '2023-03-21', '2023-03-24', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-21 04:13:43'),
(27, 55, '2', '2023-03-27', '2023-03-27', '2023-03-29', '3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-27 05:53:14'),
(28, 16, '2', '2023-03-27', '2023-03-27', '2023-03-28', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-27 05:52:57'),
(29, 40, '3', '2023-03-29', '2023-04-13', '2023-05-05', '11 HK Sisa Cuti Tahun 2023 Sebanyak 11 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-30 02:25:53'),
(30, 17, '3', '2023-03-29', '2023-04-26', '2023-05-05', '7 HK Sisa Cuti Tahun 2023 Sebanyak 10 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-30 02:27:35'),
(31, 39, '3', '2023-03-29', '2023-04-26', '2023-05-03', '5 HK Sisa Cuti Tahun 2023 Sebanyak 9 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-30 04:17:12'),
(32, 50, '2', '2023-03-30', '2023-03-30', '2023-03-31', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-03-30 07:52:58'),
(33, 15, '3', '2023-03-29', '2023-04-17', '2023-05-02', '6 HK Sisa Cuti Tahun 2023 sudah habis ', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-06 04:47:18'),
(34, 55, '3', '2023-04-05', '2023-04-17', '2023-04-18', '2 HK Sisa Cuti Tahun 2023 sebanyak 3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-06 04:47:08'),
(35, 31, '3', '2023-04-04', '2023-04-17', '2023-05-05', '9 HK Sisa Cuti Tahun 2023 sebanyak 8 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-09 03:00:43'),
(36, 22, '3', '2023-04-03', '2023-04-26', '2023-05-12', '12 HK Sisa Cuti Tahun 2023 Sebanyak 9 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-18 08:12:49'),
(37, 20, '3', '2023-04-03', '2023-04-17', '2023-05-10', '12 HK Sisa Cuti Tahun 2023 Sebanyak 5 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-06 04:50:18'),
(38, 50, '5', '2023-04-04', '2023-05-02', '2023-08-02', '3 Bulan', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-06 04:51:01'),
(39, 48, '1', '2023-03-30', '2023-04-26', '2023-05-05', '7 HK Sisa Cuti Tahun 2023 Sebanyak 12 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-06 04:52:26'),
(40, 45, '1', '2023-04-03', '2023-04-05', '2023-04-28', '12 HK Sisa Cuti Tahun 2022 Sebanyak 5 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-06 04:53:19'),
(41, 21, '3', '2023-04-12', '2023-04-26', '2023-05-08', '8 HK Sisa Cuti Tahun 2022 Sebanyak 6 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-12 06:02:53'),
(42, 51, '2', '2023-04-10', '2023-04-10', '2023-04-10', '1 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-12 06:03:34'),
(43, 14, '3', '2023-04-11', '2023-04-17', '2023-04-28', '5 HK Sisa Cuti Tahun 2022 Sebanyak 11 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-04-12 06:05:06'),
(44, 50, '2', '2023-04-26', '2023-04-26', '2023-04-28', '3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-09 03:13:50'),
(45, 19, '2', '2023-04-26', '2023-04-26', '2023-04-28', '3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-09 03:14:34'),
(46, 52, '2', '2023-04-26', '2023-04-26', '2023-04-28', '3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-09 03:15:08'),
(47, 51, '2', '2023-04-26', '2023-04-26', '2023-04-28', '3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-09 03:23:28'),
(48, 15, '2', '2023-05-03', '2023-05-03', '2023-05-05', '3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-09 03:16:20'),
(49, 39, '2', '2023-05-04', '2023-05-04', '2023-05-05', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-09 03:16:55'),
(50, 55, '6', '2023-05-05', '2023-05-08', '2023-05-17', '10 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-09 04:29:09'),
(51, 20, '2', '2023-05-11', '2023-05-11', '2023-05-12', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-11 10:15:30'),
(52, 13, '3', '2023-05-12', '2023-05-15', '2023-05-19', '4 HK Sisa Cuti Tahun 2023 Sebanyak 3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-12 11:04:24'),
(53, 55, '2', '2023-05-19', '2023-05-19', '2023-05-19', '1 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-22 07:47:31'),
(54, 23, '2', '2023-05-19', '2023-05-17', '2023-05-19', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-05-22 07:48:00'),
(55, 52, '3', '2023-06-05', '2023-06-26', '2023-07-04', '4 HK Sisa Cuti Tahun 2023 Sebanyak 8 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-06-21 09:07:28'),
(56, 54, '2', '2023-06-14', '2023-06-13', '2023-06-13', '1 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-06-14 06:08:53'),
(57, 55, '6', '2023-06-15', '2023-06-19', '2023-06-30', '7 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-06-21 09:06:02'),
(58, 52, '2', '2023-06-19', '2023-06-19', '2023-06-19', '1 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-06-19 07:44:24'),
(59, 52, '2', '2023-06-20', '2023-06-20', '2023-06-20', '1 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-06-20 07:36:16'),
(60, 19, '3', '2023-06-15', '2023-06-21', '2023-06-23', '3 HK Sisa Cuti Tahun 2021 Sebanyak 3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-06-21 04:32:48'),
(61, 17, '3', '2023-06-21', '2023-06-26', '2023-07-07', '7 HK Sisa Cuti Tahun 2023 Sebanyak 3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-07-03 10:13:01'),
(62, 17, '2', '2023-06-22', '2023-06-22', '2023-06-23', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-06-23 04:03:50'),
(63, 56, '3', '2023-06-27', '2023-07-03', '2023-07-18', '12 HK Sisa Cuti Tahun 2023 sudah habis', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-06-27 04:54:57'),
(64, 15, '6', '2023-06-26', '2023-07-03', '2023-07-07', '5 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-07-03 09:41:20'),
(65, 16, '2', '2023-07-04', '2023-07-04', '2023-07-05', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-07-04 09:19:39'),
(66, 16, '3', '2023-07-06', '2023-07-06', '2023-07-06', '1 HK Sisa Cuti Tahun 2023 Sebanyak 11 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-07-06 07:39:00'),
(67, 39, '3', '2023-07-18', '2023-07-26', '2023-08-02', '6 HK Sisa Cuti Tahun 2023 Sebanyak 3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-07-18 08:49:56'),
(68, 31, '3', '2023-07-20', '2023-07-24', '2023-07-28', '5 HK Sisa Cuti Tahun 2023 Sebanyak 3 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-07-20 07:36:16'),
(69, 56, '2', '2023-07-20', '2023-07-20', '2023-07-21', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-07-20 07:36:48'),
(70, 13, '2', '2023-07-21', '2023-07-20', '2023-07-21', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-07-21 02:24:15'),
(71, 16, '2', '2023-08-01', '2023-07-31', '2023-08-01', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-08-01 09:26:16'),
(72, 39, '2', '2023-08-03', '2023-08-03', '2023-08-04', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-08-03 10:40:15'),
(73, 50, '2', '2023-08-03', '2023-08-03', '2023-08-04', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-08-03 10:40:48'),
(74, 40, '2', '2023-08-08', '2023-08-08', '2023-08-09', '2 HK', NULL, NULL, NULL, NULL, 'kepegawaian', '2023-08-09 02:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `format_nomor_surat`
--

CREATE TABLE `format_nomor_surat` (
  `id` int(11) NOT NULL,
  `format_nomor` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `format_nomor_surat`
--

INSERT INTO `format_nomor_surat` (`id`, `format_nomor`, `jabatan`) VALUES
(1, 'NMR/KPTUN.W8-TUN2/KODE/BLN/THN', 'Ketua'),
(2, 'NMR/SEK.PTUN.W8-TUN2/KODE/BLN/THN', 'Sekretaris'),
(3, 'NMR/PAN.PTUN.W8-TUN2/KODE/BLN/THN', 'Panitera');

-- --------------------------------------------------------

--
-- Table structure for table `sys_config`
--

CREATE TABLE `sys_config` (
  `id` int(1) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `ketua` varchar(100) DEFAULT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `versi` char(10) DEFAULT NULL,
  `format_nomor_surat` varchar(100) DEFAULT NULL,
  `format_nomor_agenda` varchar(100) DEFAULT NULL,
  `telp` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `kode_pn` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_config`
--

INSERT INTO `sys_config` (`id`, `nama`, `alamat`, `ketua`, `nip`, `logo`, `versi`, `format_nomor_surat`, `format_nomor_agenda`, `telp`, `fax`, `kota`, `kode_pn`) VALUES
(1, 'PTUN GORONTALO', 'Jalan Prof. Dr. Aloei Saboe, Bone Bolango, Gorontalo', 'SUTIYONO, S.H., M.H.', '196801201997031001', 'Logo_kecil1.jpg', '0', 'NMR/AGNO.M/BLN/THNT', 'NMR/AGNO.M/BLN/THN', '0', '0', 'GORONTALO', 'PTUN.GTO');

-- --------------------------------------------------------

--
-- Table structure for table `sys_groups`
--

CREATE TABLE `sys_groups` (
  `groupid` int(11) NOT NULL COMMENT 'Primary Key: (by system)',
  `level` int(1) DEFAULT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Aktif: pilihan 1=Ya; 0=Tidak',
  `ordering` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_groups`
--

INSERT INTO `sys_groups` (`groupid`, `level`, `name`, `description`, `enable`, `ordering`) VALUES
(0, 0, 'Super Admin', 'Super Administrator', 1, 1),
(1, 1, 'Ketua', 'Ketua', 1, 1),
(2, 2, 'Wakil Ketua', 'Wakil Ketua', 1, 2),
(3, 3, 'Panitera', 'Panitera', 1, 3),
(4, 4, 'Sekretaris', 'Sekretaris', 1, 4),
(5, 5, 'Wakil Panitera', 'Wakil Panitera', 1, 5),
(6, 6, 'Panitera Muda Perkara', 'Panitera Muda Perkara', 1, 6),
(7, 7, 'Panitera Muda Hukum', 'Panitera Muda Hukum', 1, 7),
(8, 8, 'Panitera Muda Tipikor', 'Panitera Muda Tipikor', 1, 8),
(9, 9, 'Panitera Muda Niaga', 'Panitera Muda Niaga', 1, 9),
(10, 10, 'Panitera Muda PHI', 'Panitera Muda PHI', 1, 10),
(11, 11, 'Subbag. Umum dan Keuangan', 'Subbag. Umum dan Keuangan', 1, 11),
(12, 12, 'Subbag. Kepegawaian & Ortala', 'Subbag. Kepegawaian & Ortala', 1, 12),
(13, 13, 'Subbag. Perencanaan, TI & Pelaporan', 'Subbag. Perencanaan, TI & Pelaporan', 1, 13),
(14, 14, 'Hakim', 'Hakim', 1, 14),
(15, 15, 'Panitera Pengganti', 'Panitera Pengganti', 1, 15),
(16, 16, 'Jurusita', 'Jurusita', 1, 16),
(17, 17, 'Pegawai', 'Pegawai', 1, 17),
(18, 18, 'Honorer', 'Honorer', 1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `sys_users`
--

CREATE TABLE `sys_users` (
  `userid` bigint(20) UNSIGNED NOT NULL COMMENT 'UserId: (by system)',
  `pegawai_id` bigint(20) DEFAULT NULL,
  `groupid` int(11) DEFAULT NULL,
  `nip_nrp` varchar(25) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL DEFAULT '' COMMENT 'Nama Lengkap: isian bebas',
  `username` varchar(30) NOT NULL DEFAULT '' COMMENT 'Nama User: isian bebas',
  `password` varchar(100) NOT NULL DEFAULT '' COMMENT 'Password: sudah di-encript',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'Alamat Email: format email',
  `last_login` datetime DEFAULT NULL COMMENT 'Tanggal Terakhir Login: (by system)',
  `block` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Blok User: pilihan 0=Tidak; 1=ya',
  `code_activation` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_users`
--

INSERT INTO `sys_users` (`userid`, `pegawai_id`, `groupid`, `nip_nrp`, `fullname`, `username`, `password`, `email`, `last_login`, `block`, `code_activation`) VALUES
(1, 1, 1, '-', 'Super Administrator', 'admin', '28cb9b46551251d23a63bd4c6d0b5832', 'ptun.gorontalo@gmail.com', '2023-11-12 19:06:18', 0, 'd1c5a1d07ec79ad891c3e692cba2b420'),
(2, 45, 1, '196801201997031001', 'SUTIYONO, S.H., M.H.', 'ketua', '32e45d9c377ef416206f1133c1d685dc', 'bandaaceh@ptun.org', '2023-08-21 02:40:56', 0, '1202a0a5d66c6361efef9a10fdb3e852'),
(9, 14, 4, '196611251990031001', 'SYAMSUL BAKHRY, S.H., M.H.', 'sekretaris', 'db57d0045057bdb0ce2ae614108ac8fd', 'bandaaceh@ptun.org', '2023-08-21 02:20:24', 0, '766c8c0c3f494c45bc9522b636b36905'),
(10, 13, 7, '197905162006041004', 'JAENAL ARIFIN SUJOKO, S.H.', 'plthukum', '811848155996fbb492b042eadb2f41a3', 'bandaaceh@ptun.org', '2023-05-23 04:46:37', 0, '04b4d3a5aaa80dbe4aa5f276644a78c9'),
(13, 13, 7, '197905162006041004', 'JAENAL ARIFIN SUJOKO, S.H.', 'jaenal', 'bad8f5c03bebe97240efa6039341de07', 'bandaaceh@ptun.org', '2023-06-15 03:22:49', 0, '89c60cf065213fe0292d1e6d413f81a5'),
(15, 15, 17, '196707061993031006', 'R. SOEPRAPTO SUMANTRI', 'soeprapto', 'ec3cdca8a790ef9ef1553452468801c7', 'bandaaceh@ptun.org', '2023-01-11 04:24:44', 0, 'afc56434109ae5322a7963e6920be764'),
(16, 16, 17, '196907061991032003', 'JULIEN UDUAS, S.H.', 'julien', '6a0206d723a5ad049c0a5eeedd1e1f06', 'bandaaceh@ptun.org', '2022-10-26 08:34:20', 0, 'd6060bf3d46289264267a520ad2c4f60'),
(17, 17, 13, '198710172006042001', 'FRISKA IRIANSYAH, S.H.', 'friska', '2075c0f3c951dd60e31957d58442bba0', 'bandaaceh@ptun.org', '2023-07-31 02:57:18', 0, '842a327be6f31f67724bb9fbde58797d'),
(18, 18, 17, '198306162008022001', 'YUNIARSI INDRASARI, S.E.', 'yuni', '0859a6a6f97aee6188f932781f906617', 'ptun.gorontalo@gmail.com', '2020-02-10 09:13:06', 0, 'ed95ac7eacd84042c49c472abe8e1618'),
(19, 19, 17, '198207122007012009', 'SRI IMELDA AYU UTAMI DUDE', 'imelda', '4553bde86aba875514f8bd28cd72b4f6', 'ptun.gorontalo@gmail.com', NULL, 0, 'ec469844b7e8a1f7727b492087bed08d'),
(20, 24, 17, '-', 'ZULKIFLI NASIR, S.PI.', 'zulkifli', '49c47a594593cacab0600a756c667298', 'bandaaceh@ptun.org', NULL, 0, 'e6844e1d7621b33b24a9890c5c245a8d'),
(21, 25, 17, '-', 'MUHAMAD ARYANDI YAHYA, S.H.', 'aryandi', '023f61c62567f6f683b8a263765cb4d5', 'bandaaceh@ptun.org', '2020-01-09 05:54:05', 0, '64130d390782db86afca1372f14beb53'),
(22, 27, 17, '-', 'RISKAWATI PANTO, S.H.', 'riska', 'bebfba15839a7e00e1f7906b7603c61f', 'bandaaceh@ptun.org', '2022-06-15 04:53:33', 0, '5d6c274d6c5f66d5414fa81664cef5a4'),
(24, 26, 17, '-', 'IDRIS DJAKARIA, S.H.', 'idris', '47fa3034bd1769ae839dc2b09aeb0ba4', 'bandaaceh@ptun.org', NULL, 0, '122eb3657b83149ad7b49f7904a2d89d'),
(25, 20, 17, '19860204 201903 1 00', 'AHMAD FITRI, S.H.I', 'ahmadfitri', '54e350da22cb6d28e9d7c2e8182d8b87', 'bandaaceh@ptun.org', '2022-07-21 04:07:36', 0, 'd8d9c8b63dd816a4a64abe1fe461674b'),
(26, 21, 17, '19860614 201903 1 00', 'AHMAD SUJA’I , S.I.P', 'ahmadsujai', '3f1cffbf443fd93cad3a7123421479ef', 'ptun.gorontalo@gmail.com', '2023-03-17 06:25:09', 0, '3491c94ea030a1bbdb7358d1dcbf819c'),
(27, 22, 17, '19930727 201903 1 01', 'ADITYA AFIEQ PRAKOSO, S.Psi', 'aditya', 'f5f9b8365ba2d690090ff77f57695e51', 'ptun.gorontalo@gmail.com', '2023-03-06 09:35:31', 0, 'ae00f98886ac6836f7f3e17aac122306'),
(28, 23, 17, '19880307 201903 2 00', 'RAHMAWATI HASAN, AMD', 'rahmawati', 'baf0f0b97891dec6cd6354ff4dcebd26', 'ptun.gorontalo@gmail.com', '2023-07-24 10:09:22', 0, '9be67d5599674914024e9814db4d3f26'),
(29, 30, 11, '-', 'ptsp', 'ptsp', '7ad219d818e1c2c7604e2aa178bbadf0', 'bandaaceh@ptun.org', '2023-08-21 02:05:30', 0, 'b9574617e54c03ed0f0d830299f6c75d'),
(30, 28, 17, '-', 'NURVINA I. UMAR, S.KOM.', 'nurvina', 'f1dd8edde5329c65a66f9aec87b72f60', 'bandaaceh@ptun.org', '2020-12-17 04:54:30', 0, 'fa53d35269e1fadb77cb8b63f661d47d'),
(32, 16, 1, '196907061991032003', 'JULIEN UDUAS, S.H.', 'kepegawaian', '57afc94e3bc7f1ebae49c8908811b5c9', 'bandaaceh@ptun.org', '2023-08-21 02:20:39', 0, '05353fb3f355fa78f4891ee72c1a44b6'),
(33, 31, 6, '196912311993031024', 'BURHAN ,S.H.', 'burhan', '497ad1dbfe2056e7e7c3fd777b0e487e', 'bandaaceh@ptun.org', '2023-07-13 03:52:58', 0, '60d15d50f3289c2e84b2adc7c7f9c0b9'),
(34, 32, 1, '-', 'Plh. KETUA', 'plhketua', 'd2e9753724361e75a149447ac7b9fa2f', 'bandaaceh@ptun.org', '2023-07-13 08:24:07', 0, 'b3f31d1e6b10d9f2de2ef7216938502f'),
(39, 36, 14, '198810192017122001', 'VINKY RIZKY OKTAVIA, S.H.', 'vinky', 'dac93d8609e27d5c721f635b33b04205', 'bandaaceh@ptun.org', '2022-09-14 10:28:29', 0, 'b1bf1bab41a616a2f3431ecd0f7f53ba'),
(40, 34, 3, '-', 'plh. PANITERA', 'plhpanitera', '71729e793b1b6efe5cd7f5ad5f52ed44', 'bandaaceh@ptun.org', '2023-06-21 04:39:11', 0, 'cac9ed713d159ef987dad98a63224cde'),
(41, 39, 13, '199404072020121009', 'FAJAR ANDHIKA SUWARTO PUTRA, A.Md.', 'fajar', '102a6794392fe2e3c9bc91ec04e5cd68', 'bandaaceh@ptun.org', '2023-02-21 01:02:24', 0, '5ccaceb07569b4d2a1967dea99195cf2'),
(42, 6, 14, '19860411 200912 2 00', 'RINOVA HEPPYANI SIMANJUNTAK,S.H., M.H.', 'rinova', '4cf13ae7fa563ee407b6c9544ffd371f', 'bandaaceh@ptun.org', '2023-06-15 13:36:23', 0, '356b8099c6f85c1ef6f8c2cc1e4bbf8f'),
(43, 46, 4, '-', 'Plh. SEKRETARIS', 'plhsekretaris', '1f20d52f092af3818b3d4e5a9eef5e71', 'bandaaceh@ptun.org', '2023-05-09 09:43:56', 0, '4ec57d9214992f79180d946004e0e6df'),
(44, 55, 1, '196812081991031007', 'SULTHAN, S.H.', 'panitera', 'fbbc79f6b498c745897ae3e8d5bd4f86', 'bandaaceh@ptun.org', '2023-08-07 03:41:44', 0, '24fd2b18f5f62d94d4129d5d5faff4fc'),
(45, 19, 12, '198207122007012009', 'SRI IMELDA AYU UTAMI DUDE, S.E.', 'melly', '9a4dd014eeb1a14311caa40882bd6924', 'bandaaceh@ptun.org', '2023-01-30 09:22:15', 0, 'f5b5089bef2a36d63a6e10155e516752'),
(46, 58, 2, '197004271996032004', 'RIALAM SIHITE, S.H., M.H.', 'wakil', 'c98b5c0025b03f4bf6ac7c6f2da8397b', 'bandaaceh@ptun.org', '2023-08-10 03:42:11', 0, 'd089a122a761484c498c8d394d55386f'),
(47, 59, 6, '-', 'Plh. Panitera Muda Perkara', 'plhperkara', '90ad3ec14cab119d1431c76f1df56d0b', 'bandaaceh@ptun.org', '2023-07-26 07:41:24', 0, 'ba4ebf82a4ad47168503088481006afe');

-- --------------------------------------------------------

--
-- Table structure for table `sys_user_online`
--

CREATE TABLE `sys_user_online` (
  `session_id` char(32) NOT NULL DEFAULT '' COMMENT 'SessionId (by system)',
  `userid` int(11) NOT NULL COMMENT 'UserId: merujuk ke tabel sys_users ke kolom userid (by system)',
  `host_address` varchar(50) NOT NULL DEFAULT '' COMMENT 'Alamat IP (by system)',
  `login_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Waktu login (by system)',
  `user_agent` varchar(255) NOT NULL DEFAULT '' COMMENT 'Jenis browser (by system)',
  `uri` varchar(1024) NOT NULL DEFAULT '' COMMENT 'Alamat URL (by system)',
  `current_page` varchar(50) NOT NULL DEFAULT '' COMMENT 'Halaman saat ini (by system)',
  `last_visit` datetime DEFAULT NULL COMMENT 'Terakhir Berkunjung (by system)',
  `data` text COMMENT 'Data Lain (by system)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sys_user_online`
--

INSERT INTO `sys_user_online` (`session_id`, `userid`, `host_address`, `login_time`, `user_agent`, `uri`, `current_page`, `last_visit`, `data`) VALUES
('18', 18, '10.12.18.207', '2020-02-10 01:13:06', 'Chrome 80.0.3987.87 Windows 10', '', '', NULL, NULL),
('37', 37, '10.12.18.21', '2021-08-06 03:29:49', 'Chrome 92.0.4515.131 Windows 10', '', '', NULL, NULL),
('25', 25, '10.236.0.2', '2022-07-20 20:07:35', 'Firefox 102.0 Windows 10', '', '', NULL, NULL),
('16', 16, '10.236.0.2', '2022-10-26 00:34:20', 'Chrome 106.0.0.0 Windows 10', '', '', NULL, NULL),
('15', 15, '10.236.0.2', '2023-01-10 20:24:44', 'Chrome 108.0.0.0 Windows 10', '', '', NULL, NULL),
('43', 43, '10.236.0.2', '2023-05-09 01:43:55', 'Firefox 112.0 Windows 10', '', '', NULL, NULL),
('10', 10, '10.236.0.2', '2023-05-22 20:46:37', 'Chrome 113.0.0.0 Windows 10', '', '', NULL, NULL),
('42', 42, '10.12.18.6', '2023-06-15 05:36:23', 'Chrome 114.0.0.0 Windows 10', '', '', NULL, NULL),
('40', 40, '10.236.0.2', '2023-06-20 20:39:11', 'Chrome 114.0.0.0 Windows 10', '', '', NULL, NULL),
('33', 33, '10.236.0.2', '2023-07-12 19:52:58', 'Chrome 114.0.0.0 Windows 10', '', '', NULL, NULL),
('34', 34, '10.236.0.2', '2023-07-13 00:24:07', 'Firefox 115.0 Windows 10', '', '', NULL, NULL),
('17', 17, '10.236.0.2', '2023-07-30 18:57:18', 'Chrome 114.0.21608.201 Windows 10', '', '', NULL, NULL),
('44', 44, '10.236.0.2', '2023-08-06 19:41:44', 'Firefox 115.0 Windows 10', '', '', NULL, NULL),
('46', 46, '10.236.0.2', '2023-08-09 19:42:11', 'Chrome 115.0.0.0 Windows 10', '', '', NULL, NULL),
('9', 9, '10.236.0.2', '2023-08-20 18:20:24', 'Chrome 115.0.0.0 Windows 10', '', '', NULL, NULL),
('32', 32, '10.236.0.2', '2023-08-20 18:20:39', 'Chrome 116.0.0.0 Windows 10', '', '', NULL, NULL),
('2', 2, '10.236.0.2', '2023-08-20 18:40:55', 'Firefox 116.0 Windows 10', '', '', NULL, NULL),
('1', 1, '::1', '2023-11-12 12:06:18', 'Chrome 119.0.0.0 Windows 10', '', '', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ctr_barang`
--
ALTER TABLE `ctr_barang`
  ADD PRIMARY KEY (`id`,`kode_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `ctr_disposisi`
--
ALTER TABLE `ctr_disposisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `surat_id` (`surat_id`);

--
-- Indexes for table `ctr_ekspedisi`
--
ALTER TABLE `ctr_ekspedisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctr_jabatan`
--
ALTER TABLE `ctr_jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctr_kategori_surat`
--
ALTER TABLE `ctr_kategori_surat`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `ctr_ordner`
--
ALTER TABLE `ctr_ordner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctr_pegawai`
--
ALTER TABLE `ctr_pegawai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `ctr_permintaan_barang`
--
ALTER TABLE `ctr_permintaan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctr_pesan`
--
ALTER TABLE `ctr_pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ctr_sifat_disposisi`
--
ALTER TABLE `ctr_sifat_disposisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `ctr_sifat_surat`
--
ALTER TABLE `ctr_sifat_surat`
  ADD PRIMARY KEY (`sifat_id`);

--
-- Indexes for table `ctr_status_surat`
--
ALTER TABLE `ctr_status_surat`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `ctr_surat_keluar`
--
ALTER TABLE `ctr_surat_keluar`
  ADD PRIMARY KEY (`surat_id`,`no_agenda`);

--
-- Indexes for table `ctr_surat_keluar_2`
--
ALTER TABLE `ctr_surat_keluar_2`
  ADD PRIMARY KEY (`surat_id`,`no_agenda`);

--
-- Indexes for table `ctr_surat_keluar_baru`
--
ALTER TABLE `ctr_surat_keluar_baru`
  ADD PRIMARY KEY (`surat_id`,`no_agenda`);

--
-- Indexes for table `ctr_surat_masuk`
--
ALTER TABLE `ctr_surat_masuk`
  ADD PRIMARY KEY (`surat_id`,`no_agenda`);

--
-- Indexes for table `ctr_surat_ordner`
--
ALTER TABLE `ctr_surat_ordner`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `surat` (`surat_id`);

--
-- Indexes for table `ctr_transaksi_barang`
--
ALTER TABLE `ctr_transaksi_barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `dix_buku_tamu`
--
ALTER TABLE `dix_buku_tamu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `dix_ref_format_nomor_surat`
--
ALTER TABLE `dix_ref_format_nomor_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dix_ref_nomor_agenda`
--
ALTER TABLE `dix_ref_nomor_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dix_spt`
--
ALTER TABLE `dix_spt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `dix_surat_ijin`
--
ALTER TABLE `dix_surat_ijin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `format_nomor_surat`
--
ALTER TABLE `format_nomor_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_config`
--
ALTER TABLE `sys_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_groups`
--
ALTER TABLE `sys_groups`
  ADD PRIMARY KEY (`groupid`);

--
-- Indexes for table `sys_users`
--
ALTER TABLE `sys_users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ctr_barang`
--
ALTER TABLE `ctr_barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ctr_disposisi`
--
ALTER TABLE `ctr_disposisi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ctr_ekspedisi`
--
ALTER TABLE `ctr_ekspedisi`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ctr_jabatan`
--
ALTER TABLE `ctr_jabatan`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ctr_kategori_surat`
--
ALTER TABLE `ctr_kategori_surat`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `ctr_ordner`
--
ALTER TABLE `ctr_ordner`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ctr_pegawai`
--
ALTER TABLE `ctr_pegawai`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `ctr_permintaan_barang`
--
ALTER TABLE `ctr_permintaan_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ctr_pesan`
--
ALTER TABLE `ctr_pesan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ctr_sifat_disposisi`
--
ALTER TABLE `ctr_sifat_disposisi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ctr_sifat_surat`
--
ALTER TABLE `ctr_sifat_surat`
  MODIFY `sifat_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ctr_status_surat`
--
ALTER TABLE `ctr_status_surat`
  MODIFY `status_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ctr_surat_ordner`
--
ALTER TABLE `ctr_surat_ordner`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ctr_transaksi_barang`
--
ALTER TABLE `ctr_transaksi_barang`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dix_buku_tamu`
--
ALTER TABLE `dix_buku_tamu`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dix_ref_format_nomor_surat`
--
ALTER TABLE `dix_ref_format_nomor_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `dix_ref_nomor_agenda`
--
ALTER TABLE `dix_ref_nomor_agenda`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `dix_spt`
--
ALTER TABLE `dix_spt`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dix_surat_ijin`
--
ALTER TABLE `dix_surat_ijin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `format_nomor_surat`
--
ALTER TABLE `format_nomor_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sys_config`
--
ALTER TABLE `sys_config`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sys_users`
--
ALTER TABLE `sys_users`
  MODIFY `userid` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'UserId: (by system)', AUTO_INCREMENT=48;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `ctr_disposisi`
--
ALTER TABLE `ctr_disposisi`
  ADD CONSTRAINT `ctr_disposisi_ibfk_1` FOREIGN KEY (`surat_id`) REFERENCES `ctr_surat_masuk` (`surat_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `ctr_surat_ordner`
--
ALTER TABLE `ctr_surat_ordner`
  ADD CONSTRAINT `ctr_surat_ordner_ibfk_1` FOREIGN KEY (`surat_id`) REFERENCES `ctr_surat_masuk` (`surat_id`) ON DELETE CASCADE;

--
-- Constraints for table `ctr_transaksi_barang`
--
ALTER TABLE `ctr_transaksi_barang`
  ADD CONSTRAINT `ctr_transaksi_barang_ibfk_1` FOREIGN KEY (`kode_barang`) REFERENCES `ctr_barang` (`kode_barang`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

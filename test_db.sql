-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table test_db.tbl_berita
CREATE TABLE IF NOT EXISTS `tbl_berita` (
  `no_id` int NOT NULL AUTO_INCREMENT,
  `nomor_agenda` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dari` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kepada` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tembusan` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `klasifikasi` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_surat` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twu` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `isi` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_upload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `disposisi` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`no_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table test_db.tbl_berita: ~12 rows (approximately)
INSERT INTO `tbl_berita` (`no_id`, `nomor_agenda`, `dari`, `kepada`, `tembusan`, `klasifikasi`, `nomor_surat`, `twu`, `isi`, `file_upload`, `disposisi`, `status`) VALUES
	(8, '005', 'Wakasal', 'Koarmada I', 'Puspomal', 'Rahasia', '001/WAT/2023', '0123.0987', 'Mengajukan Permohonan Usul', '2. Siti Sopiyani 462611.pdf', '', 0),
	(9, '006', 'Kasal', 'Koarmada I', 'Puspomal', 'Rahasia', '001/WAT/2023', '0123.0987', 'permohonan', '3. Justina Karurukan 462612.pdf', '', 0),
	(10, '007', 'Disminpersal', 'Kasal', 'Puspomal', 'Biasa', '001/WAT/2023', '0123.0987', 'Mengajukan Permohonan Usul', '12. B. Rini Iswari Pada Uleng 462621.pdf', '', 0),
	(11, '008', 'Wakasal', 'Koarmada I', 'Aspers', 'Biasa', '001/WAT/2023', '0123.0987', 'permohonan', '11. Endang Nurmawati 462620.pdf', '', 0),
	(12, '009', 'Wakasal', 'Koarmada I', 'Puspomal', 'Rahasia', '001/WAT/2023', '0123.0987', 'permohonan', '21. Zulkarman 462630.pdf', '', 0),
	(13, '010', 'Kasal', 'Koarmada I', 'Aspers', 'Rahasia', '001/WAT/2023', '0123.0987', 'Mengajukan Permohonan Usul', '10. Lies Setiawati 462619.pdf', '', 0),
	(19, '011', 'Wakasal', 'Koarmada I', 'Puspomal', 'Biasa', '001/WAT/2023', '0123.0987', 'Mengajukan Permohonan Usul tolong sukses lah', '13. Wiyono 462622_1716601514.pdf', '', 0),
	(20, '012', 'Aspers Kasal', 'Kasal', 'Kadisminpersal', 'Sangat Rahasia (Surat MAs', '002/SPERS/0624', '0011.2234', 'Pengaruh penting', '14. Sabar 462623.pdf', '', 0),
	(21, '013', 'Lantamal VI', 'Pangkoarmada RI', 'Pangkoarmada I', 'Rahasia', '321/SPERS/0524', '0525.1225', 'Permintaan KRI Banda Aceh Satgas ', '20. Sumiyati 462629.pdf', '', 0),
	(22, '109/Kom/2024', 'Kasal', 'Danlantamal V-Danlanal PL', 'Pangkoarmada RI', 'Terbuka', '003/Kum/0324', '0304.1142', 'Meningkatkan Pengawasan dan Supervisi Terhadap Aset-aset Tanah TNI AL', '003.KUM.0324.pdf', '', 0),
	(23, '123', 'qwerty', 'qwerty', 'qwerty', 'qwerty', '123', '123', 'qwerty', 'rev 26jul.pdf', '', 0),
	(24, '123', 'qwerty', 'qwerty', 'qwerty', 'qwerty', '123', '123', 'qwerty', 'rev 26jul_1717906670.pdf', 'qwerties', 1);

-- Dumping structure for table test_db.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table test_db.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `user_name`, `password`, `name`, `role`) VALUES
	(1, 'admin', 'admin', 'admin', 1),
	(2, 'John', '12345678', 'John', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

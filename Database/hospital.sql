-- Adminer 4.8.1 MySQL 5.5.5-10.4.27-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors` (
  `doctorid` int(11) NOT NULL AUTO_INCREMENT,
  `doctorname` varchar(50) NOT NULL,
  `doctoremail` varchar(50) NOT NULL,
  `doctorphone` varchar(50) NOT NULL,
  `doctorjob` varchar(50) NOT NULL,
  `doctorabout` text NOT NULL,
  `doctorimg` varchar(50) NOT NULL,
  PRIMARY KEY (`doctorid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;


DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `requestid` int(11) NOT NULL AUTO_INCREMENT,
  `request` text NOT NULL,
  `requestsdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `requesting` int(11) NOT NULL DEFAULT 0,
  `priority` int(11) NOT NULL DEFAULT 0,
  `requestnot` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `reqdoctor` int(11) NOT NULL,
  PRIMARY KEY (`requestid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `useremail` varchar(50) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `userphone` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `doctorid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

INSERT INTO `users` (`userid`, `username`, `useremail`, `userpassword`, `userphone`, `gender`, `role`, `doctorid`) VALUES
(1,	'Doctor1',	'doctor1@gmail.com',	'$2y$10$4imLUH24gOyL.3ZHZ/TIwOhdvB1vS4MM6v2RS4vQvT/TS9Y.vqoaq',	'05074532741',	'Male',	3,	1),
(2,	'Doctor2',	'doctor2@gmail.com',	'$2y$10$Vas8GeCVMOQjzhnSr/nHku33QNpDwnouz5VNzT3UX6OVWG4EZdnj.',	'05053819237',	'Female',	3,	2),
(3,	'Kaan Kaltakkıran',	'kaan_fb_aslan@hotmail.com',	'$2y$10$T87vsn8EpTn5ce2pL5yzCuvuAwXpK6GU1yfThOXHeTjn3A9OvZA92',	'05076600884',	'Male',	1,	0),
(4,	'Ayşe Yılmaz',	'ayse@gmail.com',	'$2y$10$aXLjTK3W9J7Y4GFUSSLOy.unnoIHG/dA9RXJ5RPWCo1RkVqvUvyLy',	'05067439531',	'Female',	1,	0),
(5,	'Ahmet Yılmaz',	'ahmet@gmail.com',	'$2y$10$BfFM7uHtL8hW5psiRhioxeK8ayC7DFBht8FVmlLxAqbB3LIKJcDRG',	'05043324830',	'Male',	1,	0),
(6,	'Admin',	'admin@gmail.com',	'$2y$10$2epr7eCmt7V3BFUN/mKmLeJDpiWt.WLikDsrHgXdYj/gv1dMwUtfG',	'05076600884',	'Male',	2,	0),
(7,	'Doctor 3',	'doctor3@gmail.com',	'$2y$10$41INQTU2cIhDvDdba/60peGg2uW70KTvf50osLZDlquywEjKcwtK.',	'05063490231',	'Female',	3,	3);

-- 2023-11-14 09:35:49

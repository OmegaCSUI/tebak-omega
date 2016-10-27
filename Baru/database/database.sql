-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 27, 2016 at 05:58 PM
-- Server version: 10.1.18-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `anakomeg_games`
--

-- --------------------------------------------------------

--
-- Table structure for table `data`
--

CREATE TABLE IF NOT EXISTS `data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `counter` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `data`
--

INSERT INTO `data` (`id`, `nama`, `counter`) VALUES
(1, 'Satu', 21),
(2, 'Dua', 4),
(3, 'Tiga', 22),
(4, 'Empat', 6),
(5, 'Lima', 6),
(6, 'Enam', 4),
(7, 'Tujuh', 3),
(8, 'Delapan', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE IF NOT EXISTS `pertanyaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `1` int(11) NOT NULL,
  `2` int(11) NOT NULL,
  `3` int(11) NOT NULL,
  `4` int(11) NOT NULL,
  `5` int(11) NOT NULL,
  `6` int(11) NOT NULL,
  `7` int(11) NOT NULL,
  `8` int(11) NOT NULL,
  `tanya` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id`, `1`, `2`, `3`, `4`, `5`, `6`, `7`, `8`, `tanya`) VALUES
(1, 0, 1, 1, 0, 1, 0, 1, 0, 'Prima?'),
(2, 1, 0, 1, 0, 1, 0, 1, 0, 'Ganjil?'),
(3, 1, 0, 0, 1, 0, 0, 0, 0, 'Kuadrat?'),
(4, 1, 0, 0, 0, 0, 0, 0, 1, 'Kubik?'),
(5, 1, 0, 1, 0, 1, 1, 0, 0, 'Hurufnya ada 4?'),
(6, 0, 0, 1, 0, 0, 0, 0, 0, 'Apakah dia 3?');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

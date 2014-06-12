-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 09, 2014 at 04:16 AM
-- Server version: 5.5.23
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vamo_db`
--
CREATE DATABASE IF NOT EXISTS `vamo_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `vamo_db`;

-- --------------------------------------------------------

--
-- Table structure for table `arquivos_arq`
--

CREATE TABLE IF NOT EXISTS `arquivos_arq` (
  `id_arq` int(11) NOT NULL AUTO_INCREMENT,
  `nome_arq` varchar(510) DEFAULT NULL,
  `estensao_arq` varchar(64) DEFAULT NULL,
  `id_fk_arq` int(11) DEFAULT NULL,
  `id_ars_arq` int(11) DEFAULT NULL,
  `caminho_arq` varchar(255) DEFAULT NULL,
  `extra1_arq` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_arq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_06_07_182415_create_produtos_pro', 1),
('2014_06_07_183438_create_produtos_tipo_ptp', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produtos_pro`
--

CREATE TABLE IF NOT EXISTS `produtos_pro` (
  `id_pro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_ptp_pro` int(11) DEFAULT NULL,
  `status_pro` tinyint(1) DEFAULT '1',
  `nome_pro` varchar(255) DEFAULT NULL,
  `descricao_pro` varchar(500) DEFAULT NULL,
  `last_date_pro` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_date_pro` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pro`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `produtos_pro`
--

INSERT INTO `produtos_pro` (`id_pro`, `id_ptp_pro`, `status_pro`, `nome_pro`, `descricao_pro`, `last_date_pro`, `first_date_pro`) VALUES
(1, 1, 1, 'Capacete Honda', 'Capacete HondaCapacete HondaCapacete Honda', '2014-06-08 03:29:44', '2014-06-07 04:00:00'),
(5, 2, NULL, 'Pneu Maxxis', 'Pneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu MaxxisPneu Maxxis', '2014-06-08 16:51:21', '2014-06-07 04:00:00'),
(7, 1, 1, 'Capacete San Marino', 'Capacete San MarinoCapacete San MarinoCapacete San MarinoCapacete San Marino', '2014-06-08 16:41:25', '2014-06-08 04:00:00'),
(8, 2, 1, 'Pneu Michelin', 'Pneu MichelinPneu MichelinPneu Michelin', '2014-06-08 17:03:59', '2014-06-08 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `produtos_tipo_ptp`
--

CREATE TABLE IF NOT EXISTS `produtos_tipo_ptp` (
  `id_ptp` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status_ptp` tinyint(4) DEFAULT '1',
  `nome_ptp` varchar(255) NOT NULL,
  `last_date_ptp` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_date_ptp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_ptp`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `produtos_tipo_ptp`
--

INSERT INTO `produtos_tipo_ptp` (`id_ptp`, `status_ptp`, `nome_ptp`, `last_date_ptp`, `first_date_ptp`) VALUES
(1, 1, 'Capacetes', NULL, NULL),
(2, NULL, 'Pneus', '2014-06-08 17:45:04', NULL),
(3, 1, 'Escapamentos', '2014-06-08 17:45:08', '2014-06-08 04:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vamo_usuarios_usr`
--

CREATE TABLE IF NOT EXISTS `vamo_usuarios_usr` (
  `id_usr` int(11) NOT NULL AUTO_INCREMENT,
  `id_per_usr` int(11) DEFAULT NULL,
  `nome_usr` varchar(255) DEFAULT NULL,
  `login_usr` varchar(255) DEFAULT NULL,
  `email_usr` varchar(255) DEFAULT NULL,
  `senha_usr` varchar(255) DEFAULT NULL,
  `ra_usr` varchar(32) DEFAULT NULL,
  `cgu_usr` varchar(32) DEFAULT NULL,
  `status_usr` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `last_date_usr` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `first_date_usr` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_usr`),
  UNIQUE KEY `email_usr` (`email_usr`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `vamo_usuarios_usr`
--

INSERT INTO `vamo_usuarios_usr` (`id_usr`, `id_per_usr`, `nome_usr`, `login_usr`, `email_usr`, `senha_usr`, `ra_usr`, `cgu_usr`, `status_usr`, `remember_token`, `last_date_usr`, `first_date_usr`) VALUES
(1, NULL, 'Superadmin', NULL, 'marcelo@cbkdigital.com.br', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '081002840-9', '75209610', 1, NULL, '2014-06-02 23:31:34', '2014-06-01 22:18:27'),
(3, NULL, 'Superadmin', NULL, 'marcelo1@cbkdigital.com.br', '123', '081002840-9', '75209610', 1, NULL, '2014-06-01 22:24:55', '2014-06-01 22:24:55');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

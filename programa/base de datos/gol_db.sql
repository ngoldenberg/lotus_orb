-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 14, 2014 at 09:06 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gol_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bloques`
--

CREATE TABLE IF NOT EXISTS `bloques` (
  `fechai` date NOT NULL,
  `id` int(11) NOT NULL,
  `remito` int(11) NOT NULL,
  `alto` float NOT NULL,
  `ancho` float NOT NULL,
  `profundo` float NOT NULL,
  `toneladas` float NOT NULL,
  `color` varchar(15) NOT NULL,
  `observaciones` varchar(80) NOT NULL,
  `fechae` date NOT NULL,
  `disp` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bloques`
--

INSERT INTO `bloques` (`fechai`, `id`, `remito`, `alto`, `ancho`, `profundo`, `toneladas`, `color`, `observaciones`, `fechae`, `disp`) VALUES
('2013-12-20', 0, 110, 1.1, 1.5, 0.9, 3.7125, 'IC', '', '0000-00-00', 1),
('2013-12-20', 2, 401, 1.3, 2.1, 1.1, 7.5075, 'IO', '', '2013-12-20', 0),
('2013-12-20', 3, 401, 1.7, 0.8, 2.7, 9.18, 'IC', '', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `constante`
--

CREATE TABLE IF NOT EXISTS `constante` (
  `constante` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `constante`
--

INSERT INTO `constante` (`constante`) VALUES
(2.5);

-- --------------------------------------------------------

--
-- Table structure for table `enqueid`
--

CREATE TABLE IF NOT EXISTS `enqueid` (
  `valor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enqueid`
--

INSERT INTO `enqueid` (`valor`) VALUES
(4);

-- --------------------------------------------------------

--
-- Table structure for table `filania`
--

CREATE TABLE IF NOT EXISTS `filania` (
  `fecha` date NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bloque` int(11) NOT NULL,
  `toneladas` float NOT NULL,
  `color` varchar(20) NOT NULL,
  `mlineales` float NOT NULL,
  `mcuadrados` float NOT NULL,
  `observaciones` varchar(50) NOT NULL,
  `horas` int(11) NOT NULL,
  `corte` varchar(15) NOT NULL,
  `disp` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `filania`
--

INSERT INTO `filania` (`fecha`, `id`, `bloque`, `toneladas`, `color`, `mlineales`, `mcuadrados`, `observaciones`, `horas`, `corte`, `disp`) VALUES
('2013-12-20', 14, 2, 2.8875, 'CLARO', 4.68, 7.8, '', 8, 'Agua', 1),
('2013-12-20', 15, 1, 1.92, 'IC', 2.64, 4.4, '', 5, 'Agua', 1),
('2013-12-20', 16, 4, 13.53, 'IC', 1.32, 2.2, '', 6, 'Agua', 1),
('2013-12-20', 17, 2, 7.5075, 'IO', 1.32, 2.2, '', 4, 'Agua', 1),
('2013-12-20', 18, 5, 29.4525, 'IC', 3.3, 5.5, '', 4, 'Agua', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lotes`
--

CREATE TABLE IF NOT EXISTS `lotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `producto` varchar(120) NOT NULL,
  `mcuadrados` int(11) NOT NULL,
  `aov` varchar(10) NOT NULL,
  `disp` smallint(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `lotes`
--

INSERT INTO `lotes` (`id`, `fecha`, `producto`, `mcuadrados`, `aov`, `disp`) VALUES
(1, '0000-00-00', 'prueba', 10, 'agua', 1),
(2, '2013-12-30', 'rustico x LL', 12, 'agua', 1),
(3, '2013-12-30', 'rustico x 1M', 8, 'agua', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `producto` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `producto`) VALUES
(1, 'rustico x LL'),
(2, 'rustico x 1M'),
(3, 'natural x LL'),
(4, 'natural x 1M'),
(5, 'antiguo x LL');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

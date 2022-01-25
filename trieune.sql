-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2021 at 02:52 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trieune`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `email` varchar(45) NOT NULL,
  `cellPhone` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `idCustomer_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`email`, `cellPhone`, `name`, `surname`, `password`) VALUES
('odilestanley0@gmail.com', '0768918441', 'Odile', 'Stanley', 'odilestanley');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `starter` longtext,
  `meals` longtext,
  `dessert` longtext,
  `drinks` longtext,
  `pricePerPerson` double DEFAULT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`idMenu`, `name`, `starter`, `meals`, `dessert`, `drinks`, `pricePerPerson`) VALUES
(1, 'spit braai menu', 'Assorted cheeses, crackers, dried fruit, nuts & pretzels', '450g Lamb spit per Person\r\nBaby jacket potatoes\r\nGarlic Bread\r\nSavoury rice\r\nGreek Salad\r\nPotato salad\r\n', '(summer)Ice-cream and chocolate brownies/(winter) malva pudding & custard', '2x FRUIT JUICE SERVINGS PER TABLE', 250);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `idOrder` int(11) NOT NULL AUTO_INCREMENT,
  `dateOrdered` date DEFAULT NULL,
  `dateOfEvent` date DEFAULT NULL,
  `venueAddress` varchar(45) DEFAULT NULL,
  `numPeople` int(11) DEFAULT NULL,
  `decor` tinyint(1) DEFAULT NULL,
  `videography` tinyint(1) DEFAULT NULL,
  `photography` tinyint(1) DEFAULT NULL,
  `publicAddress` tinyint(1) DEFAULT NULL,
  `totalAmt` decimal(10,0) DEFAULT NULL,
  `Menu_idMenu` int(11) NOT NULL,
  `Customer_email` varchar(45) NOT NULL,
  PRIMARY KEY (`idOrder`,`Menu_idMenu`,`Customer_email`),
  UNIQUE KEY `dateOfEvent_UNIQUE` (`dateOfEvent`),
  KEY `fk_Order_Menu_idx` (`Menu_idMenu`),
  KEY `fk_Order_Customer1_idx` (`Customer_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`idOrder`, `dateOrdered`, `dateOfEvent`, `venueAddress`, `numPeople`, `decor`, `videography`, `photography`, `publicAddress`, `totalAmt`, `Menu_idMenu`, `Customer_email`) VALUES
(1, '2021-06-27', '2021-07-15', '21 Savage Street, Plumstead', 45, 1, 1, 1, 1, '20000', 1, 'odilestanley0@gmail.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_Order_Customer1` FOREIGN KEY (`Customer_email`) REFERENCES `customer` (`email`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Order_Menu` FOREIGN KEY (`Menu_idMenu`) REFERENCES `menu` (`idMenu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

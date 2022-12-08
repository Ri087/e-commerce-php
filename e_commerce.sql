-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 08 déc. 2022 à 22:07
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `e_commerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_addresses`
--

DROP TABLE IF EXISTS `t_addresses`;
CREATE TABLE IF NOT EXISTS `t_addresses` (
  `User_ID` int(11) NOT NULL,
  `Addr_Address1` varchar(256) NOT NULL,
  `Addr_Address2` varchar(256) DEFAULT NULL,
  `Addr_Address3` varchar(256) DEFAULT NULL,
  `Addr_City` varchar(64) DEFAULT NULL,
  `Addr_State` varchar(64) DEFAULT NULL,
  `Addr_Country` varchar(64) DEFAULT NULL,
  `Addr_PostalCode` varchar(16) DEFAULT NULL,
  KEY `User_ID` (`User_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

DROP TABLE IF EXISTS `t_category`;
CREATE TABLE IF NOT EXISTS `t_category` (
  `Cate_Name` varchar(32) NOT NULL,
  `Cate_Description` text NOT NULL,
  PRIMARY KEY (`Cate_Name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_productscategory`
--

DROP TABLE IF EXISTS `t_productscategory`;
CREATE TABLE IF NOT EXISTS `t_productscategory` (
  `TOP_ID` int(11) NOT NULL,
  `Cate_Name` varchar(32) NOT NULL,
  KEY `TOP_ID` (`TOP_ID`),
  KEY `Cate_Name` (`Cate_Name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_productsphoto`
--

DROP TABLE IF EXISTS `t_productsphoto`;
CREATE TABLE IF NOT EXISTS `t_productsphoto` (
  `TOP_ID` int(11) NOT NULL,
  `PP_Photo` blob NOT NULL,
  KEY `TOP_ID` (`TOP_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_rate`
--

DROP TABLE IF EXISTS `t_rate`;
CREATE TABLE IF NOT EXISTS `t_rate` (
  `TOP_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) NOT NULL,
  `Rate_Description` text,
  `Rate_Notation` tinyint(4) NOT NULL,
  KEY `Prod_ID` (`TOP_ID`),
  KEY `User_ID` (`User_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_typeofproducts`
--

DROP TABLE IF EXISTS `t_typeofproducts`;
CREATE TABLE IF NOT EXISTS `t_typeofproducts` (
  `TOP_ID` int(11) NOT NULL AUTO_INCREMENT,
  `TOP_Name` varchar(32) NOT NULL,
  `TOP_Description` text NOT NULL,
  `TOP_DefaultPrice` varchar(32) NOT NULL,
  `TOP_TVA` double(3,2) NOT NULL,
  `TOP_Quantity` int(11) NOT NULL,
  PRIMARY KEY (`TOP_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
CREATE TABLE IF NOT EXISTS `t_user` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_FakeName` varchar(32) NOT NULL,
  `User_FirstName` varchar(32) NOT NULL,
  `User_LastName` varchar(32) NOT NULL,
  `User_Email` varchar(128) NOT NULL,
  `User_PhoneNumber` varchar(32) NOT NULL,
  `User_BirthDate` date NOT NULL,
  `User_Permission` int(11) DEFAULT '0',
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `User_Email` (`User_Email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_usersecret`
--

DROP TABLE IF EXISTS `t_usersecret`;
CREATE TABLE IF NOT EXISTS `t_usersecret` (
  `User_ID` int(11) NOT NULL,
  `US_Password` varchar(256) NOT NULL,
  KEY `User_ID` (`User_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

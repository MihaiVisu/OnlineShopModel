-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 17, 2012 at 11:07 AM
-- Server version: 5.1.63
-- PHP Version: 5.3.3-7+squeeze14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tml_tractorii`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NUME` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`ID`, `NUME`) VALUES
(1, 'Componente Periferice'),
(2, 'Desktop-uri'),
(6, 'Chitare'),
(20, 'Birotica si Papetarie'),
(24, 'Flori');

-- --------------------------------------------------------

--
-- Table structure for table `comanda`
--

CREATE TABLE IF NOT EXISTS `comanda` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT '1',
  `DATETIME` datetime NOT NULL,
  `SUMA` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `comanda`
--

INSERT INTO `comanda` (`ID`, `USER_ID`, `STATUS`, `DATETIME`, `SUMA`) VALUES
(1, 11, 3, '2012-11-16 22:12:46', 135),
(2, 11, 3, '2012-11-16 22:23:50', 8329),
(3, 13, 3, '2012-11-17 02:35:38', 6201),
(4, 13, 3, '2012-11-17 02:37:18', 4899);

-- --------------------------------------------------------

--
-- Table structure for table `comentariu`
--

CREATE TABLE IF NOT EXISTS `comentariu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `COMENTARIU` varchar(1000) NOT NULL,
  `OBIECT_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `DATETIME` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `comentariu`
--

INSERT INTO `comentariu` (`ID`, `COMENTARIU`, `OBIECT_ID`, `USER_ID`, `DATETIME`) VALUES
(1, 'sdfsfsdfs', 62, 19, '2012-11-16 23:58:49'),
(28, 'Proba :))', 57, 12, '2012-11-17 02:19:41'),
(3, 'Comm', 59, 12, '2012-11-17 00:06:18'),
(16, ''' wefbw', 59, 12, '2012-11-17 01:09:15'),
(10, 'sal\r\n', 59, 12, '2012-11-17 00:49:37'),
(12, 'avhfsad', 59, 12, '2012-11-17 00:58:18'),
(6, 'gfdgd', 62, 19, '2012-11-17 00:08:57'),
(20, 'sal', 59, 19, '2012-11-17 01:45:12'),
(19, 'asdbn\r\nasdlbha\r\nashd', 59, 11, '2012-11-17 01:32:25'),
(25, '--------Comentariu test---------', 59, 12, '2012-11-17 01:52:32'),
(27, 'fhlasf ;a', 57, 12, '2012-11-17 02:19:32'),
(29, 'alt comentariu test', 59, 13, '2012-11-17 02:22:10'),
(30, 'hkjghdfkgdf', 59, 13, '2012-11-17 02:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `cos`
--

CREATE TABLE IF NOT EXISTS `cos` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OBIECT_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `CANTITATE` int(11) NOT NULL,
  `NUME` varchar(255) NOT NULL,
  `PRET` int(20) NOT NULL,
  `DATA` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=93 ;

--
-- Dumping data for table `cos`
--

INSERT INTO `cos` (`ID`, `OBIECT_ID`, `USER_ID`, `CANTITATE`, `NUME`, `PRET`, `DATA`) VALUES
(68, 38, 29, 2, 'Epiphone Explorer GT', 650, '2012-11-16'),
(74, 53, 30, 3, 'Monitor LG Flatron', 699, '2012-11-16'),
(76, 54, 26, 4, 'Lg m228-wa', 999, '2012-11-16'),
(77, 53, 26, 1, 'Monitor LG Flatron', 699, '2012-11-16');

-- --------------------------------------------------------

--
-- Table structure for table `mesaj`
--

CREATE TABLE IF NOT EXISTS `mesaj` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATETIME` datetime NOT NULL,
  `MESAJ` text NOT NULL,
  `EMAIL` varchar(40) NOT NULL,
  `TELEFON` varchar(15) NOT NULL,
  `NUME` varchar(50) NOT NULL,
  `VAZUT` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `mesaj`
--

INSERT INTO `mesaj` (`ID`, `DATETIME`, `MESAJ`, `EMAIL`, `TELEFON`, `NUME`, `VAZUT`) VALUES
(43, '2012-11-16 23:16:51', 'Mesaj test.', 'mihai_visu@yahoo.com', '', 'Anonim', 0);

-- --------------------------------------------------------

--
-- Table structure for table `obiect`
--

CREATE TABLE IF NOT EXISTS `obiect` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NUME` varchar(250) NOT NULL,
  `SUBCATEGORIE_ID` int(11) NOT NULL,
  `PRET` float NOT NULL,
  `CANTITATE` int(11) NOT NULL,
  `SPECIFICATIE` varchar(1000) NOT NULL,
  `IMAGINI` varchar(255) NOT NULL,
  `DATA` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `obiect`
--

INSERT INTO `obiect` (`ID`, `NUME`, `SUBCATEGORIE_ID`, `PRET`, `CANTITATE`, `SPECIFICATIE`, `IMAGINI`, `DATA`) VALUES
(3, 'Yamaha RBX 170', 4, 800, 16, 'Yamaha RBX 170 este bassul pe care trebuia sa-l am', '3.jpg', '2012-11-13'),
(38, 'Epiphone Explorer GT', 1, 650, 5, 'Chitara mea\r\n', '38.jpg', '2012-11-16'),
(39, 'Pana .71 rupta', 17, 2, 1, 'Pana ruuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu uuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuuu uuuuuuuuuuuuuuuuuuuuupta''', '39.jpg', '2012-11-17'),
(52, 'Ibanez GSR180', 4, 745, 4, 'Bass', '52.jpg', '2012-11-16'),
(53, 'Monitor LG Flatron', 21, 699, 28, 'Monitor LG....fsdkfjsdkfhsdkl  fhsklafhfjdasfhkjhasfklhsdklfhsdklf hs dklf jhsdjfksdfhsdfsd hskldfh sdklfhsdkfh sdklfh sdkf sdklhf sdhkf;''l;;''j', '53.jpg', '2012-11-16'),
(54, 'Lg m228-wa', 21, 999, 44, 'fsdkj h shskh shklhsdfh sdh fshf shkfhafhashkjshkjfsk./,f slkfskln sss f', '54.jpg', '2012-11-16'),
(56, 'Epiphone', 1, 500, 10, 'Epiphone', '56.JPG', '2012-11-17'),
(57, 'Alt Epiphone', 1, 450, 8, 'Epiphone in galben', '57.JPG', '2012-11-16'),
(58, 'Gibson Les Paul', 1, 2500, 10, 'Gibson. What else to say?', '58.jpg', '2012-11-16'),
(59, 'Jackson RR3', 1, 1800, 20, 'Jackson Randy Rhoads 3fjsdklfjsdfjsdfhsdlhfls hskl hksh skldjhfklsdh ksldh kssklh kslhfksljfh k sfk shsk kh jk hh skl h klshdk sd sdl sdssdjsh lsjhslsd s d lsslsdl sdlsdl sld s s lsdh sl dshl dhsl sdl sdk hdsk j sjlgfa l;fh uaiegyugae f  dl'';a    m. h kjclh . .fd d  f.', '59.jpg', '2012-11-17'),
(60, 'Jackson KVX10', 1, 1750, 14, 'Jackson King VX 10', '60.jpg', '2012-11-16'),
(61, 'ESP LTD EX50', 1, 1100, 10, 'ESP LTD EX50 negru', '61.jpg', '2012-11-16'),
(62, 'ESP LTD Snakebyte', 1, 4300, 1, 'ESP LTD Snakebyte James Hetfield Signature', '62.png', '2012-11-17'),
(63, 'Gibson Explorer 76', 1, 2550, 3, 'Gibson Explorer ''76 Classic White', '63.jpg', '2012-11-17'),
(64, 'Gibson Explorer Thunderhorse', 1, 5150, 0, 'Gibson Explorer Dethklok Thunderhorse', '64.jpg', '2012-11-17'),
(65, 'Chitara electrica Dean Vendetta XMT Tremolo', 1, 599, 6, 'Chitara electrica Dean Vendetta XMT Tremolo la pret de 599 LEI.', '65.jpg', '2012-11-17');

-- --------------------------------------------------------

--
-- Table structure for table `obiect_comanda`
--

CREATE TABLE IF NOT EXISTS `obiect_comanda` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `OBIECT_ID` int(11) NOT NULL,
  `COMANDA_ID` int(11) NOT NULL,
  `CANTITATE` int(11) NOT NULL,
  `NUME` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `obiect_comanda`
--

INSERT INTO `obiect_comanda` (`ID`, `OBIECT_ID`, `COMANDA_ID`, `CANTITATE`, `NUME`) VALUES
(1, 55, 1, 3, 'Lalele'),
(2, 52, 2, 3, 'Ibanez GSR180'),
(3, 38, 2, 2, 'Epiphone Explorer GT'),
(4, 53, 2, 4, 'Monitor LG Flatron'),
(5, 54, 2, 2, 'Lg m228-wa'),
(6, 57, 3, 1, 'Alt Epiphone'),
(7, 39, 3, 1, 'Pana .71 rupta'),
(8, 65, 3, 1, 'Chitara electrica Dean Vendetta XMT Tremolo'),
(9, 64, 3, 1, 'Gibson Explorer Thunderhorse'),
(10, 65, 4, 1, 'Chitara electrica Dean Vendetta XMT Tremolo'),
(11, 62, 4, 1, 'ESP LTD Snakebyte');

-- --------------------------------------------------------

--
-- Table structure for table `subcategorie`
--

CREATE TABLE IF NOT EXISTS `subcategorie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NUME` varchar(40) NOT NULL,
  `CATEGORIE_ID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `subcategorie`
--

INSERT INTO `subcategorie` (`ID`, `NUME`, `CATEGORIE_ID`) VALUES
(1, 'Chitare electrice', 6),
(2, 'Mouseuri', 1),
(3, 'Boxe si Difuzoare', 1),
(4, 'Chitare bass electrice', 6),
(10, 'Lalele', 24),
(17, 'Accesorii', 6),
(21, 'Monitoare', 2),
(22, 'Unitati centrale', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PAROLA` varchar(250) NOT NULL,
  `STATUT` int(11) NOT NULL,
  `USERNAME` varchar(30) NOT NULL,
  `EMAIL` varchar(250) NOT NULL,
  `ADRESA` varchar(250) NOT NULL,
  `NUMAR_TELEFON` varchar(20) NOT NULL,
  `COD_POSTAL` varchar(20) NOT NULL,
  `NUME` varchar(250) NOT NULL,
  `PRENUME` varchar(250) NOT NULL,
  `IMAGINE` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `PAROLA`, `STATUT`, `USERNAME`, `EMAIL`, `ADRESA`, `NUMAR_TELEFON`, `COD_POSTAL`, `NUME`, `PRENUME`, `IMAGINE`) VALUES
(11, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'bff', 'testing@yahoo.com', 'Bistrita, bl44', '0764237112', '420073', 'Berbecariu', 'Flaviu Florin', 'NoImage.png'),
(12, 'd033e22ae348aeb5660fc2140aec35850c4da997', 2, 'admin', 'admin.missing@yahoo.com', 'BN,Decebal', '', '0', 'admin', 'admin', 'NoImage.png'),
(13, '8cb2237d0679ca88db6464eac60da96345513964', 1, 'mitza', 'mihai_visu@yahoo.com', 'BN,Decebal,NR.29<%><>?$#%<$#?', '0748814282', '04004', 'Visuian', 'Mihai', 'NoImage.png'),
(14, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'client', 'fs@yahoo.com', 'fsdfsd', '', '205', 'dasd', 'dasd', 'NoImage.png'),
(19, '83592796bc17705662dc9a750c8b6d0a4fd93396', 3, 'visu', 'mihai@fdss.com', 'hfsdklfhsdkjf', '', '0456', 'hdkfsdh', 'fhsdkldfh', 'NoImage.png'),
(21, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 3, 'test', 'adasdkjfhj@gjdh.com', '', '', '', 'gigel', 'cornel', 'NoImage.png'),
(22, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'fsdf', 'mihaiv_94@yahoo.com', 'fsdf', '', '0132', '  mihai', 'mihai', 'NoImage.png'),
(23, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'mihi', 'fsjfs@y.com', 'fsdfd', '', '04', 'hgdkj', 'ghdkgh', 'NoImage.png'),
(24, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'm!ha!*', 'mihafdsfsdiv_94@yahoo.com', 'sfdf', '', '0561', 'Visuian', 'Mihai', 'NoImage.png'),
(25, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'gaugau', 'dj_al3xin0@yahoo.com', 'Magnoliei, 11', '', '420073', 'Gaurean', 'Alexandru', 'NoImage.png'),
(26, '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1, 'Mihai', 'mihaiv@fsdfd.com', 'Bistrita', '', '420073', 'Visuian', 'Mihai', 'NoImage.png'),
(27, 'a9072cbed2a748559bf3e3e4504d6c7a43d1d167', 1, 'yukffyfu', 'a163672@rmqkr.net', 'nr25 strbradului', '0754323412', '545200', 'asd', 'sa', 'NoImage.png'),
(28, '51abb9636078defbf888d8457a7c76f85c8f114c', 1, 'usertest', 'mail@mail.ro', 'test', '0758666422', '42865', 'usertest', 'usertest', 'NoImage.png'),
(29, 'a9072cbed2a748559bf3e3e4504d6c7a43d1d167', 1, 'mihai11', 'yourmind47@yahoo.com', 'nr.25 str. Bradului', '0745442098', '545200', 'mihai', 'mihai', 'NoImage.png'),
(30, 'ea3243132d653b39025a944e70f3ecdf70ee3994', 1, 'test7', 'tesat@yahoo.com', 'sdfsdfsd', '0745623422', '123456', 'dsfsdfsd', 'sdfsss', 'NoImage.png'),
(31, '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 1, 'a', 'a@a.a', 'a', '1234567812', '12345', 'a', 'a', 'NoImage.png'),
(32, 'efb2bf484d3fc4734d30dde45079dd602755a33d', 1, 'andi', 'andi@foosa.ro', 'Str. Fericirii nr 12', '', '423214', 'Oltean', 'Andi', 'NoImage.png');

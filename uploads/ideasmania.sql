-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2017 at 02:56 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ideasmania`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `Admin_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(250) NOT NULL,
  `Password` varchar(250) NOT NULL,
  `IsSuperAdmin` bit(1) NOT NULL,
  PRIMARY KEY (`Admin_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`Admin_Id`, `Username`, `Password`, `IsSuperAdmin`) VALUES
(1, 'sa', 'sa', b'1'),
(2, 'zzz', 'zzz', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `Category_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(500) NOT NULL,
  PRIMARY KEY (`Category_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_Id`, `Title`) VALUES
(3, 'Other'),
(4, 'Art'),
(5, 'Software'),
(6, 'Music'),
(7, 'Travel'),
(8, 'Food'),
(9, 'Fun'),
(10, 'Games');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `Comment_Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Id` int(11) NOT NULL,
  `Idea_Id` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Comment_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_Id`, `User_Id`, `Idea_Id`, `Comment`, `Date`) VALUES
(1, 3, 4, 'nice idea ', '2017-05-01'),
(3, 3, 4, 'very nice idea', '2017-05-01'),
(4, 3, 4, 'no no no no very bad one', '2017-05-01'),
(5, 3, 4, 'vvvvvvvvvvvvvvv', '2017-05-01'),
(6, 3, 3, 'bbbbbb', '2017-05-01');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `Country_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(500) NOT NULL,
  PRIMARY KEY (`Country_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`Country_Id`, `Title`) VALUES
(1, 'Egypt'),
(2, 'Saudi Arabia'),
(3, 'Qatar'),
(4, 'Kuwait'),
(5, 'Japan');

-- --------------------------------------------------------

--
-- Table structure for table `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
  `Idea_Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(200) DEFAULT NULL,
  `Description` text,
  `Content` text,
  `Category_Id` int(11) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `Date` date DEFAULT NULL,
  PRIMARY KEY (`Idea_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ideas`
--

INSERT INTO `ideas` (`Idea_Id`, `Title`, `Description`, `Content`, `Category_Id`, `User_Id`, `Date`) VALUES
(1, 'Test idea 1', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.\r\nCum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.', 3, 3, '2017-05-07'),
(3, 'idea 2222', 'kgkfgkl kdfklmkgk dkmfk', '<p>okdfgofdkgd m odfbopm opmop mopmrbopm&nbsp;</p>', 3, 3, '2017-05-05'),
(5, 'my idea jj', 'mvmbmbmbmbm', 'fkjgnpppopopop &nbsp;okok &nbsp;oojk &nbsp;oojojoj &nbsp;okokm &nbsp;omoo &nbsp;okoo ojojoj ojojojo dfjkgn fdjkn jkdfng jkfd', 3, 3, '2017-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `User_Id` int(11) NOT NULL,
  `Idea_Id` int(11) NOT NULL,
  `RatingValue` int(11) NOT NULL,
  PRIMARY KEY (`User_Id`,`Idea_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`User_Id`, `Idea_Id`, `RatingValue`) VALUES
(3, 1, 1),
(3, 3, 1),
(3, 5, 1),
(6, 1, 1),
(6, 3, 1),
(6, 5, 1),
(7, 1, 0),
(7, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `User_Id` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(200) DEFAULT NULL,
  `LastName` varchar(200) DEFAULT NULL,
  `Username` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Gender` tinyint(1) DEFAULT NULL,
  `Country_Id` int(11) DEFAULT NULL,
  `PhotoPath` varchar(500) DEFAULT NULL,
  `JoinedDate` date DEFAULT NULL,
  PRIMARY KEY (`User_Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `FirstName`, `LastName`, `Username`, `Password`, `Email`, `Gender`, `Country_Id`, `PhotoPath`, `JoinedDate`) VALUES
(3, 'Tarek2', 'Ahmed ', 'tt', 'tt', 'tarek.iraqi@hotmail.com', 1, 1, 'uploads/maxresdefault (1)03052017122420.jpg', '2017-05-01'),
(6, 'ramez', 'samir', 'rr', 'rr', 'ramiz@gmail.com', 1, 1, 'uploads/me17042017014458.jpg', NULL),
(7, 'asmaa', 'tarek', 'ss', 'ss', 'asmaa@gmail.com', 2, 1, 'uploads/download19052017024004.jpg', '2017-04-17'),
(8, 'mervat', 'hassan', 'mm', 'mm', 'mervat@gmail.com', 1, 1, 'uploads/cash_paid_icon17042017021341.png', NULL),
(9, 'nadia', 'fathy', 'nn', 'nn', 'nadia@gmail.com', 2, 4, 'uploads/blue_wood_balls_focus_depth_of_field_deck_reflections_marble_1920x1080_wallpaper_Wallpaper_1920x1080_www17042017040827.jpg', '0000-00-00'),
(10, 'Hany', '', 'ooo', 'hh', 'hany@gmail.com', 1, 2, '', '2017-04-17'),
(11, 'basem', '', 'bb', 'bb', 'basem@gamil.com', 1, 1, '', '2017-04-17'),
(13, 'xx', '', 'xx', 'xx', 'xx@gmail.com', 1, 1, '', '2017-05-16');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2021 at 05:05 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notesmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CountryCode` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `Name`, `CountryCode`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'India', '+91', '2021-03-02 11:13:41', 70, NULL, NULL, b'1'),
(2, 'USA', '+1', '2021-03-02 11:14:42', 70, NULL, NULL, b'1'),
(3, 'Australia', '+61', '2021-03-02 11:15:27', 70, NULL, NULL, b'1'),
(4, 'Pakistan', '+92', '2021-03-02 11:15:46', 70, NULL, NULL, b'1'),
(5, 'Bangladesh', '+880', '2021-03-02 11:18:35', 70, NULL, NULL, b'1'),
(6, 'Afghanistan', '+93', '2021-04-09 22:21:22', 82, '2021-04-09 22:24:15', 82, b'0'),
(7, 'Sri Lanka', '+94', '2021-04-09 22:24:02', 82, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `Seller` int(11) NOT NULL,
  `Downloader` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(2) NOT NULL,
  `AttachmentPath` varchar(255) DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL,
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` bit(2) NOT NULL,
  `PurchasedPrice` decimal(10,0) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`ID`, `NoteID`, `Seller`, `Downloader`, `IsSellerHasAllowedDownload`, `AttachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(32, 112, 63, 62, b'01', '../Member/63/112/Attachment/Attachment_[0]_040321125656.pdf', b'1', '2021-04-07 22:13:08', b'00', '0', 'svnd trading skill', 'MBA', '2021-03-26 19:29:37', 62, '2021-04-07 22:13:08', 62, b'1'),
(35, 115, 62, 62, b'01', '../Member/62/115/Attachment/Attachment_[0]_040321012511.pdf', b'1', '2021-03-26 20:09:55', b'00', '0', 'web design', 'IT', '2021-03-26 20:09:55', 62, NULL, NULL, b'1'),
(36, 132, 62, 62, b'01', '../Member/62/132/Attachment/Attachment_[0]_050321021811.pdf', b'1', '2021-03-26 20:42:30', b'00', '0', 'Lorem', 'MBA', '2021-03-26 20:42:13', 62, '2021-03-26 20:42:30', 62, b'1'),
(38, 111, 63, 62, b'01', '../Member/63/111/Attachment/Attachment_[0]_040321123710.pdf', b'1', '2021-04-07 20:34:37', b'01', '499', 'hack the hacker', 'CS', '2021-03-26 21:01:18', 62, '2021-04-07 20:34:37', 62, b'1'),
(39, 116, 62, 63, b'01', '../Member/62/116/Attachment/Attachment_[0]_040321060433.pdf', b'1', '2021-03-26 21:03:28', b'00', '0', 'ECONOMICS', 'MBA', '2021-03-26 21:03:28', 63, NULL, NULL, b'1'),
(40, 118, 62, 63, b'01', '../Member/62/118/Attachment/Attachment_[0]_050321115308.pdf', b'1', '2021-03-26 21:05:28', b'00', '0', 'Account', 'CA', '2021-03-26 21:05:28', 63, NULL, NULL, b'1'),
(41, 119, 62, 63, b'00', '../Member/62/119/Attachment/Attachment_[0]_050321115557.pdf', b'0', NULL, b'01', '500', 'Social Studies', 'MBA', '2021-03-26 21:06:12', 63, NULL, NULL, b'1'),
(42, 120, 62, 63, b'01', '../Member/62/120/Attachment/Attachment_[0]_050321115827.pdf', b'1', '2021-03-26 21:06:59', b'00', '0', 'Bussiness intelligent', 'IT', '2021-03-26 21:06:59', 63, NULL, NULL, b'1'),
(43, 132, 62, 63, b'01', '../Member/62/132/Attachment/Attachment_[0]_050321021811.pdf', b'1', '2021-03-27 15:23:14', b'00', '0', 'Lorem', 'MBA', '2021-03-27 15:23:14', 63, NULL, NULL, b'1'),
(44, 121, 62, 63, b'01', '../Member/62/121/Attachment/Attachment_[0]_050321120101.pdf', b'1', '2021-04-07 20:35:21', b'01', '200', 'python', 'CS', '2021-03-29 15:16:32', 63, '2021-04-07 20:35:21', 63, b'1'),
(49, 127, 63, 62, b'00', '../Member/63/127/Attachment/Attachment_[0]_050321014436.pdf', b'0', NULL, b'01', '500', 'c++', 'IT', '2021-03-29 15:35:15', 62, NULL, 63, b'1'),
(50, 135, 63, 62, b'00', '../Member/63/135/Attachment/Attachment_[0]_050321022709.pdf', b'0', NULL, b'01', '599', 'Data intelligence', 'IT', '2021-03-29 15:35:37', 62, NULL, NULL, b'1'),
(53, 186, 62, 63, b'00', '../Member/62/186/Attachment/Attachment_300321062841.zip', b'0', NULL, b'01', '499', 'economics science', 'MBA', '2021-03-30 22:10:09', 63, NULL, NULL, b'1'),
(54, 187, 63, 62, b'01', '../Member/63/187/Attachment/Attachment_300321063755.zip', b'1', '2021-04-01 20:59:18', b'00', '0', 'computer science', 'CS', '2021-03-30 22:12:15', 62, '2021-04-01 20:59:18', 62, b'1'),
(63, 185, 62, 62, b'00', '../Member/62/185/Attachment/Attachment_300321061736.zip', b'0', NULL, b'01', '50', 'Digital Electronics', 'CS', '2021-04-01 21:02:55', 62, '2021-04-01 21:04:52', 62, b'1'),
(75, 111, 63, 63, b'01', '../Member/63/111/Attachment/Attachment_[0]_040321123710.pdf', b'1', '2021-04-07 20:36:03', b'01', '499', 'hack the hacker', 'CS', '2021-04-07 17:46:19', 63, '2021-04-07 20:36:03', 63, b'1'),
(76, 188, 65, 62, b'01', '../Member/65/188/Attachment/Attachment_[0]_090421084039.pdf', b'1', '2021-04-09 12:22:29', b'00', '0', 'aaa', 'IT', '2021-04-09 12:22:29', 62, NULL, NULL, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `notecategories`
--

CREATE TABLE `notecategories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notecategories`
--

INSERT INTO `notecategories` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'IT', 'Information and technology department', '2021-03-02 11:10:55', 70, NULL, NULL, b'1'),
(2, 'CS', 'Computer Science ', '2021-03-02 11:11:34', 70, NULL, NULL, b'1'),
(3, 'CA', 'Charted Accountant', '2021-03-02 11:11:56', 70, '2021-04-09 20:57:43', 81, b'1'),
(4, 'MBA', 'Management Department', '2021-03-02 11:12:22', 70, NULL, NULL, b'1'),
(5, 'History', 'It\'s History of the world', '2021-04-09 20:49:53', 81, '2021-04-09 21:04:43', 82, b'0'),
(6, 'Science', 'It\'s  for  science book', '2021-04-09 20:59:27', 82, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notetypes`
--

CREATE TABLE `notetypes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notetypes`
--

INSERT INTO `notetypes` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'HandWritten', 'hand written books', '2021-03-02 11:07:18', 70, NULL, NULL, b'1'),
(2, 'StoryBook', 'Story and novel books', '2021-03-02 11:08:00', 70, NULL, NULL, b'1'),
(3, 'UniversityBook', '     University OR college books      ', '2021-03-02 11:08:49', 70, '2021-04-09 21:38:48', 82, b'1'),
(4, 'NA', 'Not Appear', '2021-03-11 19:32:19', 70, NULL, NULL, b'1'),
(6, 'SoftBook', 'Soft copy book', '2021-04-09 21:39:23', 82, '2021-04-09 21:41:19', 82, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `referencedata`
--

CREATE TABLE `referencedata` (
  `ID` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `DataValue` varchar(100) NOT NULL,
  `RefCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referencedata`
--

INSERT INTO `referencedata` (`ID`, `value`, `DataValue`, `RefCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'Male', 'M', 'Gender', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(2, 'Female', 'Fe', 'Gender', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(3, 'Unknown', 'U', 'Gender', '2021-03-02 13:14:03', NULL, NULL, NULL, b'0'),
(4, 'Paid', 'P', 'Selling Mode', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(5, 'Free', 'F', 'Selling Mode', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(6, 'Draft', 'Draft', 'Notes Status', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(7, 'Submitted For Review', 'Submitted For Review', 'Notes Status', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(8, 'In Review', 'In Review', 'Notes Status', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(9, 'Published', 'Approved', 'Notes Status', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(10, 'Rejected', 'Rejected', 'Notes Status', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1'),
(11, 'Removed', 'Removed', 'Notes Status', '2021-03-02 13:14:03', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotes`
--

CREATE TABLE `sellernotes` (
  `ID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `ActionedBy` int(11) DEFAULT NULL,
  `AdminRemarks` varchar(255) DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `Category` int(11) NOT NULL,
  `DisplayPicture` varchar(500) DEFAULT NULL,
  `NoteType` int(11) DEFAULT NULL,
  `NumberofPages` int(11) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `UniversityName` varchar(200) DEFAULT NULL,
  `Country` int(11) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseCode` varchar(100) DEFAULT NULL,
  `Professor` varchar(100) DEFAULT NULL,
  `IsPaid` int(1) NOT NULL DEFAULT 0,
  `SellingPrice` decimal(10,0) DEFAULT NULL,
  `NotesPreview` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT current_timestamp(),
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotes`
--

INSERT INTO `sellernotes` (`ID`, `SellerID`, `Status`, `ActionedBy`, `AdminRemarks`, `PublishedDate`, `Title`, `Category`, `DisplayPicture`, `NoteType`, `NumberofPages`, `Description`, `UniversityName`, `Country`, `Course`, `CourseCode`, `Professor`, `IsPaid`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(111, 63, 9, 70, NULL, '2021-03-05 14:13:30', 'hack the hacker', 2, 'DP_040321123710.jpeg', 3, 77, 'prevent hacking!!!!!!!!!!!!!!!!!!!!!!!', 'ADIT', 1, 'hacking skills', '123456', 'amit pachouri', 4, '499', 'Preview_040321123710.pdf', '2021-03-04 17:07:10', 63, NULL, 63, b'1'),
(112, 63, 9, 70, NULL, '2021-03-05 14:13:30', 'svnd trading skill', 4, 'DP_040321125656.jpeg', 1, 12, 'trading knowledge', 'SVND', 1, 'hacking skills', '123456', 'shubham dhanani', 5, '0', 'Preview_040321125656.pdf', '2021-03-04 17:26:56', 63, NULL, 63, b'1'),
(114, 63, 9, 70, NULL, '2021-03-05 14:13:30', 'artificial Inteligence', 1, 'DP_040321011154.jpeg', 1, 154, 'AI technologies', 'ADIT', 1, 'AI', '333333', 's.k.singh', 5, '0', 'Preview_040321011154.pdf', '2021-03-04 17:41:54', 63, NULL, 63, b'1'),
(115, 62, 9, 70, NULL, '2021-04-08 14:13:30', 'web design', 1, 'DP_040321012510.jpeg', 3, 125, 'web designing and developing', 'ADIT', 1, 'web technology', '0702', 'a.k.singh', 5, '0', 'Preview_040321012510.pdf', '2021-03-04 17:55:10', 62, NULL, 62, b'1'),
(116, 62, 9, 81, NULL, '2021-04-09 14:13:30', 'ECONOMICS', 4, 'DP_040321060433.jpg', 3, 4520, 'ECONOMICS BASICS', 'IIT,bombay', 1, 'MBA', '412', 'P L ADVANI', 5, '0', 'Preview_040321060433.pdf', '2021-03-04 22:34:33', 62, NULL, 62, b'1'),
(118, 62, 9, 70, NULL, '2021-03-06 14:13:30', 'Account', 3, 'DP_050321115308.jpeg', 3, 154, 'Accounts !!!!!!!!!!!!!!!!!', 'oxford univesity', 2, 'accounting', '1115236', 'a.k.rai', 5, '0', 'Preview_050321115308.pdf', '2021-03-05 16:23:08', 62, NULL, 62, b'1'),
(119, 62, 9, 70, NULL, '2021-03-08 14:13:30', 'Social Studies', 4, 'DP_050321115557.jpg', 1, 112, 'Social Behaviour studies', 'w.k.institute', 3, 'social study', '12435', 'm.s.dhoni', 4, '500', 'Preview_050321115557.pdf', '2021-03-05 16:25:57', 62, NULL, 62, b'1'),
(120, 62, 9, 70, NULL, '2021-03-08 14:13:30', 'Bussiness intelligent', 1, 'DP_050321115827.jpg', 1, 48, 'BI techniques...!!', 'a.d.p institute', 5, 'BI', '1145356', 'S.N.Dhanani', 5, '0', 'Preview_050321115827.pdf', '2021-03-05 16:28:27', 62, NULL, 62, b'1'),
(121, 62, 9, 70, NULL, '2021-03-08 14:13:30', 'python', 2, 'DP_050321120101.jpeg', 1, 154, 'basics of python', 'Ljk', 4, 'python basics', '152546', 'abdul khan', 4, '200', 'Preview_050321120101.pdf', '2021-03-05 16:31:01', 62, NULL, 62, b'1'),
(122, 62, 9, 70, NULL, '2021-03-08 14:13:30', 'computer network', 1, 'DP_050321120248.jpeg', 3, 78, 'Computer networking', 'ADIT', 1, 'CN', '214555', 'preraksir', 5, '0', 'Preview_050321120248.pdf', '2021-03-05 16:32:48', 62, NULL, 62, b'1'),
(124, 62, 9, 70, NULL, '2021-03-06 14:13:30', 'c++', 1, 'DP_050321011944.jpeg', 3, 153, 'advance c language', 'ADIT', 1, 'c++', '215413', 's.patel', 4, '99', 'Preview_050321011944.pdf', '2021-03-05 17:49:44', 62, NULL, 62, b'1'),
(125, 62, 9, 70, NULL, '2021-03-06 14:13:30', 'java', 2, 'DP_050321012235.jpeg', 3, 256, 'Java Language', 'IIT,bombay', 1, 'java', '212453', 's.d.patel', 5, '0', 'Preview_050321012235.pdf', '2021-03-05 17:52:35', 62, NULL, 62, b'1'),
(126, 63, 9, 70, NULL, '2021-03-06 14:13:30', 'java', 2, 'DP_050321014259.jpg', 3, 524, 'java language', 'IIT,bombay', 1, 'java', '1245433', 'a.k.sinha', 5, '0', 'Preview_050321014259.pdf', '2021-03-05 18:12:59', 63, NULL, 63, b'1'),
(127, 63, 9, 70, NULL, '2021-03-06 14:13:30', 'c++', 1, 'DP_050321014435.jpeg', 3, 64, 'advance c', 'oxford univesity', 2, 'c++', '122345', 'a.k.rai', 4, '500', 'Preview_050321014435.pdf', '2021-03-05 18:14:35', 63, NULL, 63, b'1'),
(128, 62, 9, 70, NULL, '2021-03-06 14:13:30', 'Master of management', 4, 'DP_050321021016.jpg', 3, 1234, 'advance level of management', 'iim', 1, 'management', '124344', 'aniruddha tripathi', 4, '1299', 'Preview_050321021016.pdf', '2021-03-05 18:40:16', 62, NULL, 62, b'1'),
(129, 62, 9, 70, NULL, '2021-04-08 14:13:30', 'Data Science', 2, 'DP_050321021228.jpeg', 3, 124, 'basics of data  science', 'ljpk', 4, 'data engineering', '2454855', 'abdul hasan', 5, '0', 'Preview_050321021228.pdf', '2021-03-05 18:42:28', 62, NULL, 62, b'1'),
(131, 62, 9, 70, NULL, '2021-04-08 14:13:30', 'robotics engineering', 2, 'DP_050321021628.jpg', 3, 455, 'robotics!!!!!!!!!!!!', 'A.K.I.T', 5, 'robotics', '147963', 'mr.p.k.khan', 4, '99', 'Preview_050321021628.pdf', '2021-03-05 18:46:28', 62, NULL, 62, b'1'),
(132, 62, 9, 70, NULL, '2021-04-08 14:13:30', 'Lorem', 4, 'DP_050321021811.jpeg', 2, 135, 'lorem is the best!!!!!!!!!!!!!!!', 'iim,ahmedabad', 1, 'lorem', '000012', 'lorem ipsum', 5, '0', 'Preview_050321021811.pdf', '2021-03-05 18:48:11', 62, NULL, 62, b'1'),
(133, 62, 9, 70, NULL, '2021-04-08 14:13:30', 'stock guru', 4, 'DP_050321022015.jpeg', 1, 451, 'be the stock guru!!!!!:>', 'sdit', 2, 'stockmarket', '122343', 's.n.d', 5, '0', 'Preview_050321022015.pdf', '2021-03-05 18:50:15', 62, NULL, 62, b'1'),
(134, 62, 9, 70, NULL, '2021-04-08 14:13:30', 'stocks trading ', 3, 'DP_050321022154.jpg', 2, 213, 'stock trading strategies', 'SVND', 3, 'stockmarket', '123456', 'svnd', 4, '2000', 'Preview_050321022154.pdf', '2021-03-05 18:51:54', 62, NULL, 62, b'1'),
(135, 63, 9, 70, NULL, '2021-04-08 14:13:30', 'Data intelligence', 1, 'DP_050321022709.jpeg', 3, 251, 'data science tools', 'oxford univesity', 2, 'data engineering', '555451', 'a.p.kohli', 4, '599', 'Preview_050321022709.pdf', '2021-03-05 18:57:09', 63, NULL, 63, b'1'),
(136, 63, 9, 70, NULL, '2021-04-08 14:13:30', 'Adwance web design', 1, 'DP_050321023011.jpeg', 1, 134, 'advance web development', 'iit,kanpur', 1, 'web technology', '454543', 'a.k.singh', 5, '0', 'Preview_050321023011.pdf', '2021-03-05 19:00:11', 63, NULL, 63, b'1'),
(137, 63, 9, 70, NULL, '2021-04-08 14:13:30', 'PHP development', 2, 'DP_050321023145.jpeg', 1, 62, 'php learning from basic.', 'thapa technical', 1, 'php', '154315', 'vinod bahadur thapa', 5, '0', 'Preview_050321023145.pdf', '2021-03-05 19:01:45', 63, NULL, 63, b'1'),
(153, 63, 6, 63, NULL, '2021-03-28 10:13:52', 'Account fundamental', 3, 'DP_280321064352.jpg', 3, 251, 'Account fundamental Book', 'oxford univesity', 2, 'accounting', '211485', 'Mr.G.K.singh', 4, '29', 'Preview_280321064352.pdf', '2021-03-28 10:13:52', 63, NULL, 63, b'1'),
(154, 63, 8, 70, NULL, '2021-03-28 10:16:17', 'Business Economics', 4, 'DP_280321064617.jpg', 1, 55, 'Business Economics handwritten', 'SVND', 1, 'Bussiness Study', '455482', 'Mr.S.N.Dhanani', 5, '0', 'Preview_280321064617.pdf', '2021-03-28 10:16:17', 63, '2021-04-06 21:56:57', 70, b'1'),
(155, 63, 7, 63, NULL, '2021-03-28 10:19:05', 'Business Ethics', 4, 'DP_280321064905.jpg', 3, 500, 'Business Ethics Book!!!!', 'A.K.I.T', 3, 'Bussiness Study', '554877', 'a.k.rai', 5, '0', 'Preview_280321064905.pdf', '2021-03-28 10:19:05', 63, NULL, 63, b'1'),
(156, 63, 6, 63, NULL, '2021-03-28 10:21:10', 'Business Manage', 4, 'DP_280321065110.jpg', 1, 45, 'Business Manage Skills', 'SVND', 1, 'Bussiness Study', '154452', 'amit pachouri', 4, '25', 'Preview_280321065110.pdf', '2021-03-28 10:21:10', 63, NULL, 63, b'1'),
(157, 63, 10, 70, 'It\'s Not CD book', '2021-04-08 17:09:49', 'Compiler Design', 2, 'DP_280321065324.jpg', 3, 152, 'Compiler Designing', 'sdit', 2, 'computer', '154848', 'Mr.A.K.Sinha', 5, '0', 'Preview_280321065324.pdf', '2021-03-28 10:23:24', 63, '2021-04-08 17:10:30', 70, b'1'),
(158, 62, 7, 62, NULL, '2021-03-28 10:27:36', 'Cyber Security', 1, 'DP_280321065736.jpg', 3, 445, 'Cyber Security Book Of Engineering', 'Ljk', 5, 'cyber security', '545488', 'abdul khan', 5, '0', 'Preview_280321065736.pdf', '2021-03-28 10:27:36', 62, NULL, 62, b'1'),
(159, 62, 6, 62, NULL, '2021-03-28 10:29:55', 'Design Engineer I', 2, 'DP_280321065955.jpg', 1, 55, 'Design Engineer I', 'SND Institute', 3, 'design engineering', '124563', 'Mr.Glen Maxwell', 4, '25', 'Preview_280321065955.pdf', '2021-03-28 10:29:55', 62, NULL, 62, b'1'),
(160, 62, 10, 70, 'wrong book', '2021-03-28 10:31:59', 'Design Engineer II', 2, 'DP_280321070159.jpg', 1, 42, 'Design Engineer II', 'SND Institute', 3, 'design engineering', '245466', 'Mr.Glen Maxwell', 4, '10', 'Preview_280321070159.pdf', '2021-03-28 10:31:59', 62, '2021-04-06 21:46:18', 70, b'1'),
(161, 62, 11, 70, 'Not Right Book to Publish', '2021-03-28 10:33:27', 'Design Engineer III', 2, 'DP_280321070327.jpg', 1, 24, 'Design Engineer III', 'SND Institute', 3, 'design engineering', '155485', 'Mr.Glen Maxwell', 4, '10', 'Preview_280321070327.pdf', '2021-03-28 10:33:27', 62, '2021-04-08 12:39:04', 70, b'0'),
(162, 62, 7, 62, NULL, '2021-03-28 10:34:51', 'Design Engineer IV', 2, 'DP_280321070451.jpg', 1, 110, 'Design Engineer IV', 'SND Institute', 3, 'design engineering', '575545', 'Mr.Glen Maxwell', 4, '25', 'Preview_280321070451.pdf', '2021-03-28 10:34:51', 62, NULL, 62, b'1'),
(163, 62, 6, 62, NULL, '2021-03-28 10:37:37', 'Digital Security', 1, 'DP_280321070737.jpg', 2, 124, 'Digital Security , Story base book', 'A.K.I.T', 1, 'cyber security', '154555', 'a.k.singh', 5, '0', 'Preview_280321070737.pdf', '2021-03-28 10:37:37', 62, NULL, 62, b'1'),
(164, 62, 7, 62, NULL, '2021-03-28 10:40:25', 'MCWC', 1, 'DP_280321071025.jpg', 3, 125, 'Mobile Computing Wireless Networking', 'SVND', 1, 'computing', '548515', 'Mr.V.N.Dhanani', 5, '0', 'Preview_280321071025.pdf', '2021-03-28 10:40:25', 62, NULL, 62, b'1'),
(185, 62, 9, 70, NULL, '2021-04-08 14:13:30', 'Digital Electronics', 2, 'DP_300321061736.jpeg', 3, 123, 'Digital Electronics Books', 'ADIT', 1, 'DE', '212456', 'a.k.sinha', 4, '50', 'Preview_300321061736.pdf', '2021-03-30 21:47:36', 62, NULL, 62, b'1'),
(186, 62, 9, 70, NULL, '2021-04-08 14:13:30', 'economics science', 4, 'DP_300321062841.jpeg', 1, 142, 'economics science handwritten book!!', 'oxford univesity', 2, 'economics', '154552', 'k.k.singh', 4, '499', 'Preview_300321062841.pdf', '2021-03-30 21:58:41', 62, NULL, 62, b'1'),
(187, 63, 9, 70, NULL, '2021-04-08 14:13:30', 'computer science', 2, 'DP_300321063755.jpg', 3, 124, 'computer science book of india', 'SVND', 1, 'computer', '656563', 'mr.g.mexwell', 5, '0', 'Preview_300321063755.pdf', '2021-03-30 22:07:55', 63, NULL, 63, b'1'),
(188, 65, 11, 70, NULL, '2021-04-09 12:21:58', 'aaa', 1, 'DP_090421084039.jpg', 1, 122, 'wssdw', 'NA', 2, 'NA', 'NA', 'NA', 5, '0', 'Preview_090421084039.pdf', '2021-04-09 12:10:39', 65, '2021-04-09 12:10:39', 65, b'0'),
(189, 65, 11, 70, NULL, NULL, 'ppp', 1, 'DP_090421084648.jpg', 1, 0, 'aewe', 'NA', 1, 'NA', 'NA', 'NA', 4, '500', 'Preview_090421084648.pdf', '2021-04-09 12:16:48', 65, '2021-04-09 12:16:48', 65, b'0'),
(191, 66, 9, 70, NULL, '2021-04-10 17:52:00', 'check', 6, '', 4, 0, 'checking...!!!!!!!', 'NA', 1, 'NA', 'NA', 'NA', 5, '0', 'Preview_100421021503.pdf', '2021-04-10 17:45:03', 66, '2021-04-10 17:45:03', 66, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesattachements`
--

CREATE TABLE `sellernotesattachements` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotesattachements`
--

INSERT INTO `sellernotesattachements` (`ID`, `NoteID`, `FileName`, `FilePath`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(114, 111, 'Attachment_[0]_040321123710.pdf', '../Member/63/111/Attachment/Attachment_[0]_040321123710.pdf', '2021-03-04 17:07:10', 63, NULL, 63, b'1'),
(115, 112, 'Attachment_[0]_040321125656.pdf', '../Member/63/112/Attachment/Attachment_[0]_040321125656.pdf', '2021-03-04 17:26:56', 63, NULL, 63, b'1'),
(118, 114, 'Attachment_[0]_040321011154.pdf', '../Member/63/114/Attachment/Attachment_[0]_040321011154.pdf', '2021-03-04 17:41:54', 63, NULL, 63, b'1'),
(119, 115, 'Attachment_[0]_040321012511.pdf', '../Member/62/115/Attachment/Attachment_[0]_040321012511.pdf', '2021-03-04 17:55:11', 62, NULL, 62, b'1'),
(120, 116, 'Attachment_[0]_040321060433.pdf', '../Member/62/116/Attachment/Attachment_[0]_040321060433.pdf', '2021-03-04 22:34:33', 62, NULL, 62, b'1'),
(122, 118, 'Attachment_[0]_050321115308.pdf', '../Member/62/118/Attachment/Attachment_[0]_050321115308.pdf', '2021-03-05 16:23:08', 62, NULL, 62, b'1'),
(123, 119, 'Attachment_[0]_050321115557.pdf', '../Member/62/119/Attachment/Attachment_[0]_050321115557.pdf', '2021-03-05 16:25:57', 62, NULL, 62, b'1'),
(124, 120, 'Attachment_[0]_050321115827.pdf', '../Member/62/120/Attachment/Attachment_[0]_050321115827.pdf', '2021-03-05 16:28:27', 62, NULL, 62, b'1'),
(125, 121, 'Attachment_[0]_050321120101.pdf', '../Member/62/121/Attachment/Attachment_[0]_050321120101.pdf', '2021-03-05 16:31:01', 62, NULL, 62, b'1'),
(126, 122, 'Attachment_[0]_050321120248.pdf', '../Member/62/122/Attachment/Attachment_[0]_050321120248.pdf', '2021-03-05 16:32:48', 62, NULL, 62, b'1'),
(129, 124, 'Attachment_[0]_050321011944.pdf', '../Member/62/124/Attachment/Attachment_[0]_050321011944.pdf', '2021-03-05 17:49:44', 62, NULL, 62, b'1'),
(130, 125, 'Attachment_[0]_050321012236.pdf', '../Member/62/125/Attachment/Attachment_[0]_050321012236.pdf', '2021-03-05 17:52:36', 62, NULL, 62, b'1'),
(131, 126, 'Attachment_[0]_050321014259.pdf', '../Member/63/126/Attachment/Attachment_[0]_050321014259.pdf', '2021-03-05 18:12:59', 63, NULL, 63, b'1'),
(132, 127, 'Attachment_[0]_050321014436.pdf', '../Member/63/127/Attachment/Attachment_[0]_050321014436.pdf', '2021-03-05 18:14:36', 63, NULL, 63, b'1'),
(133, 128, 'Attachment_[0]_050321021016.pdf', '../Member/62/128/Attachment/Attachment_[0]_050321021016.pdf', '2021-03-05 18:40:16', 62, NULL, 62, b'1'),
(134, 129, 'Attachment_[0]_050321021228.pdf', '../Member/62/129/Attachment/Attachment_[0]_050321021228.pdf', '2021-03-05 18:42:28', 62, NULL, 62, b'1'),
(137, 131, 'Attachment_[0]_050321021628.pdf', '../Member/62/131/Attachment/Attachment_[0]_050321021628.pdf', '2021-03-05 18:46:28', 62, NULL, 62, b'1'),
(138, 132, 'Attachment_[0]_050321021811.pdf', '../Member/62/132/Attachment/Attachment_[0]_050321021811.pdf', '2021-03-05 18:48:11', 62, NULL, 62, b'1'),
(139, 133, 'Attachment_[0]_050321022015.pdf', '../Member/62/133/Attachment/Attachment_[0]_050321022015.pdf', '2021-03-05 18:50:15', 62, NULL, 62, b'1'),
(140, 134, 'Attachment_[0]_050321022155.pdf', '../Member/62/134/Attachment/Attachment_[0]_050321022155.pdf', '2021-03-05 18:51:55', 62, NULL, 62, b'1'),
(141, 135, 'Attachment_[0]_050321022709.pdf', '../Member/63/135/Attachment/Attachment_[0]_050321022709.pdf', '2021-03-05 18:57:09', 63, NULL, 63, b'1'),
(142, 136, 'Attachment_[0]_050321023011.pdf', '../Member/63/136/Attachment/Attachment_[0]_050321023011.pdf', '2021-03-05 19:00:11', 63, NULL, 63, b'1'),
(143, 137, 'Attachment_[0]_050321023145.pdf', '../Member/63/137/Attachment/Attachment_[0]_050321023145.pdf', '2021-03-05 19:01:45', 63, NULL, 63, b'1'),
(159, 153, 'Attachment_[0]_280321064352.pdf', '../Member/63/153/Attachment/Attachment_[0]_280321064352.pdf', '2021-03-28 10:13:52', 63, NULL, 63, b'1'),
(160, 154, 'Attachment_[0]_280321064617.pdf', '../Member/63/154/Attachment/Attachment_[0]_280321064617.pdf', '2021-03-28 10:16:17', 63, NULL, 63, b'1'),
(161, 155, 'Attachment_[0]_280321064905.pdf', '../Member/63/155/Attachment/Attachment_[0]_280321064905.pdf', '2021-03-28 10:19:05', 63, NULL, 63, b'1'),
(162, 156, 'Attachment_[0]_280321065110.pdf', '../Member/63/156/Attachment/Attachment_[0]_280321065110.pdf', '2021-03-28 10:21:10', 63, NULL, 63, b'1'),
(163, 157, 'Attachment_[0]_280321065324.pdf', '../Member/63/157/Attachment/Attachment_[0]_280321065324.pdf', '2021-03-28 10:23:24', 63, NULL, 63, b'1'),
(164, 158, 'Attachment_[0]_280321065736.pdf', '../Member/62/158/Attachment/Attachment_[0]_280321065736.pdf', '2021-03-28 10:27:37', 62, NULL, 62, b'1'),
(165, 159, 'Attachment_[0]_280321065955.pdf', '../Member/62/159/Attachment/Attachment_[0]_280321065955.pdf', '2021-03-28 10:29:55', 62, NULL, 62, b'1'),
(166, 160, 'Attachment_[0]_280321070159.pdf', '../Member/62/160/Attachment/Attachment_[0]_280321070159.pdf', '2021-03-28 10:31:59', 62, NULL, 62, b'1'),
(167, 161, 'Attachment_[0]_280321070327.pdf', '../Member/62/161/Attachment/Attachment_[0]_280321070327.pdf', '2021-03-28 10:33:27', 62, NULL, 62, b'1'),
(168, 162, 'Attachment_[0]_280321070451.pdf', '../Member/62/162/Attachment/Attachment_[0]_280321070451.pdf', '2021-03-28 10:34:51', 62, NULL, 62, b'1'),
(169, 163, 'Attachment_[0]_280321070737.pdf', '../Member/62/163/Attachment/Attachment_[0]_280321070737.pdf', '2021-03-28 10:37:37', 62, NULL, 62, b'1'),
(170, 164, 'Attachment_[0]_280321071025.pdf', '../Member/62/164/Attachment/Attachment_[0]_280321071025.pdf', '2021-03-28 10:40:25', 62, NULL, 62, b'1'),
(179, 185, 'Attachment_300321061736.zip', '../Member/62/185/Attachment/Attachment_300321061736.zip', '2021-03-30 21:47:37', 62, NULL, 62, b'1'),
(180, 186, 'Attachment_300321062841.zip', '../Member/62/186/Attachment/Attachment_300321062841.zip', '2021-03-30 21:58:42', 62, NULL, 62, b'1'),
(181, 187, 'Attachment_300321063755.zip', '../Member/63/187/Attachment/Attachment_300321063755.zip', '2021-03-30 22:07:55', 63, NULL, 63, b'1'),
(182, 188, 'Attachment_[0]_090421084039.pdf', '../Member/65/188/Attachment/Attachment_[0]_090421084039.pdf', '2021-04-09 12:10:39', 65, NULL, 65, b'0'),
(183, 189, 'Attachment_[0]_090421084648.pdf', '../Member/65/189/Attachment/Attachment_[0]_090421084648.pdf', '2021-04-09 12:16:48', 65, NULL, 65, b'0'),
(185, 191, 'Attachment_[0]_100421021503.pdf', '../Member/66/191/Attachment/Attachment_[0]_100421021503.pdf', '2021-04-10 17:45:03', 66, NULL, 66, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreportedissues`
--

CREATE TABLE `sellernotesreportedissues` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReportedByID` int(11) NOT NULL,
  `AgainstDownloadID` int(11) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotesreportedissues`
--

INSERT INTO `sellernotesreportedissues` (`ID`, `NoteID`, `ReportedByID`, `AgainstDownloadID`, `Remarks`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(8, 120, 63, 42, 'diff book', '2021-04-09 12:40:07', 63, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreviews`
--

CREATE TABLE `sellernotesreviews` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReviewedByID` int(11) NOT NULL,
  `AgainstDownloadsID` int(11) NOT NULL,
  `Ratings` decimal(10,0) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotesreviews`
--

INSERT INTO `sellernotesreviews` (`ID`, `NoteID`, `ReviewedByID`, `AgainstDownloadsID`, `Ratings`, `Comments`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(8, 112, 62, 32, '5', 'It\'s Amazing Book!!!!\r\nsvnd trading skill', '2021-03-27 15:16:56', 62, '2021-03-27 15:18:03', 62, b'1'),
(11, 115, 62, 35, '4', 'good book for beginers', '2021-03-27 15:21:43', 62, NULL, NULL, b'1'),
(12, 116, 63, 39, '5', 'it\'s Amazing', '2021-03-27 15:22:40', 63, NULL, NULL, b'1'),
(14, 132, 63, 43, '4', 'lorem ipsum!!!!!!!', '2021-03-27 15:23:47', 63, NULL, NULL, b'1'),
(15, 132, 62, 36, '5', 'Lorem Ipsum Is The Best....!!!!!!!', '2021-04-07 15:34:46', 62, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `systemconfigurations`
--

CREATE TABLE `systemconfigurations` (
  `ID` int(11) NOT NULL,
  `KeyName` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `systemconfigurations`
--

INSERT INTO `systemconfigurations` (`ID`, `KeyName`, `Value`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'SupportEmail', 's@gmail.com', '2021-04-10 16:08:00', NULL, NULL, NULL, b'1'),
(2, 'SupportPhone', '9876543210', '2021-04-10 16:08:00', NULL, NULL, NULL, b'1'),
(3, 'Emails', 'a@gmail.com,b@gmail.com', '2021-04-10 16:11:35', NULL, NULL, NULL, b'1'),
(4, 'FacebookURL', 'https://www.facebook.com/', '2021-04-10 16:11:35', NULL, NULL, NULL, b'1'),
(5, 'TwitterURL', 'https://twitter.com/', '2021-04-10 16:11:35', NULL, NULL, NULL, b'1'),
(6, 'LinkedinURL', 'https://www.linkedin.com/', '2021-04-10 16:11:35', NULL, NULL, NULL, b'1'),
(7, 'DefaultNoteImage', '../images/note/example.jpg', '2021-04-10 16:11:35', NULL, NULL, NULL, b'1'),
(8, 'DefaultProfile', '../images/person/t1.jpg', '2021-04-10 16:11:35', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` datetime DEFAULT NULL,
  `Gender` int(11) DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) DEFAULT NULL,
  `PhoneNumber_CountryCode` varchar(5) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `ProfilePicture` varchar(500) DEFAULT NULL,
  `AddressLine1` varchar(100) NOT NULL,
  `AddressLine2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`ID`, `UserID`, `DOB`, `Gender`, `SecondaryEmailAddress`, `PhoneNumber_CountryCode`, `PhoneNumber`, `ProfilePicture`, `AddressLine1`, `AddressLine2`, `City`, `State`, `ZipCode`, `Country`, `University`, `College`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(6, 62, '2000-02-07 00:00:00', 1, NULL, '+91', '9558591227', '../Member/62/DP_240321125146.jpg', 'Plot no :-47/b,', 'shivnagar society', 'bhavnagar', 'gujarat', '364003', 'India', 'cvm', 'adit', '2021-03-24 17:21:46', 62, '2021-03-24 19:23:31', 62, b'1'),
(10, 65, '2021-04-02 00:00:00', 1, NULL, '+91', '5578785454', '../Member/65/DP_090421083848.jpg', 'aaaaaaaaaaa', 'cccccccccccccc', 'sssssssssssss', 'sssssssssssssss', '122222222', 'India', 'uuuuuuuuuu', 'ccccccccccc', '2021-04-09 12:08:48', 65, NULL, NULL, b'0'),
(11, 70, '2000-02-07 00:00:00', 1, NULL, '+91', '9664683430', '../Member/70/DP_090421123054.jpg', 'Plot no :-47/b,', 'shivnagar society', 'bhavnagar', 'gujarat', '364003', 'India', 'cvm', 'ADIT', '2021-04-09 16:00:54', 70, NULL, NULL, b'1'),
(15, 80, NULL, NULL, NULL, '+91', '7894561230', NULL, ' ', ' ', ' ', ' ', ' ', ' ', NULL, NULL, '2021-04-09 19:19:51', NULL, NULL, NULL, b'1'),
(16, 81, NULL, NULL, 'svndpro@gmail.com', '+91', '1234567890', '../Member/81/DP_100421075523.jpg', ' ', ' ', ' ', ' ', ' ', ' ', NULL, NULL, '2021-04-09 19:33:34', NULL, '2021-04-10 11:35:19', 81, b'1'),
(17, 82, NULL, NULL, NULL, '+91', '8748445547', NULL, ' ', ' ', ' ', ' ', ' ', ' ', NULL, NULL, '2021-04-09 19:36:12', NULL, NULL, NULL, b'1'),
(18, 66, '2003-03-26 00:00:00', 1, NULL, '+91', '1234567890', '../Member/66/DP_100421020037.jpg', 'address1', 'address2', 'city', 'state', '123456', 'India', '', '', '2021-04-10 17:30:37', 66, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'super admin', 'notesmarket place super admin', '2021-02-24 14:08:39', NULL, NULL, NULL, b'1'),
(2, 'admin', 'notesmarket place admin', '2021-02-24 14:09:00', NULL, NULL, NULL, b'1'),
(3, 'user', 'notesmarket place user', '2021-02-24 14:10:02', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(60) NOT NULL,
  `password for you` varchar(255) DEFAULT NULL,
  `IsEmailVerified` bit(1) NOT NULL DEFAULT b'0',
  `Token` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `password for you`, `IsEmailVerified`, `Token`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(62, 3, 'snd', 'snd', 'snd@gmail.com', '$2y$10$pF0uq4LjEirJ0jWyOJkQ8uuOm1EzmAoJglPb2pQ0sEkLjeptHM8ta', 'snd', b'1', '9575b44f581ecd7fd56685e95449c8', '2021-02-25 20:23:06', NULL, NULL, NULL, b'1'),
(63, 3, 'Shubham', 'Dhanani', 'sndhanani43@gmail.com', '$2y$10$CFty7nc9cTgLkjBPvjD.bO5ZO/IcU/vLNgOU.mBIOXyqplCmjUXVS', 'svnd', b'1', '38d0a743df53839c859eb151b8c384', '2021-02-25 20:43:54', NULL, NULL, NULL, b'1'),
(64, 3, 'nikita', 'limbani', 'nikita@gmail.com', '$2y$10$x4e4mh.iHm48w92l4Gu2qOj8ElaOaQVrN4eM9SzFCJtNIwD0c0NrS', '', b'1', '94b058920bf66ec871055ff6f41de6', '2021-02-26 10:38:11', NULL, NULL, NULL, b'1'),
(65, 3, 'sss', 'ddd', 'sd@gmail.com', '$2y$10$sbaaB/7ZvEOrZkFHqwpENuHgathLk6tmzqndQlWKeX0BYLXkVAEV2', 'sd', b'1', 'e010ae6c7b0da3f3c1d4e026756944', '2021-02-26 16:28:03', NULL, '2021-04-09 19:47:44', 70, b'0'),
(66, 3, 'Vinal', 'Dhanani', 'vinal@gmail.com', '$2y$10$NuUbmO72wnxvaxfgD2/8l.GmYxiqYmN4SgxO5z9FO/Kadw2XdgPMi', 'vinal', b'1', '19e7bf3625e828af955fab503886fe', '2021-02-28 20:26:34', NULL, NULL, NULL, b'1'),
(69, 1, 'Super Admin', 'Admin', 'superadmin@admin.com', '$2y$10$02FXxy5NRLbMEBKj4yqeJusSmaLq1G90sDalbC6YDPej74uyzoa9e', 'superadmin', b'1', 'b480fffe077971e43ff9d12e7a404b', '2021-03-05 11:00:02', NULL, NULL, NULL, b'1'),
(70, 2, 'Admin', 'Admin', 'admin@admin.com', '$2y$10$DmT4tEFjCGG0.xgZX9ih3OlX0eNxJCg/aN6uwNM.xU2t3y5d2qr7W', 'admin', b'1', '19689a68f2ef95dfcacc3c8b5c0bed', '2021-03-05 11:01:38', NULL, NULL, NULL, b'1'),
(80, 2, 'Niks', 'Delicious', 'nd@gmail.com', '$2y$10$u6kGYUCJHR8VJbAy4ivin.tRUhyrgW4ja0gyOvHH/1w3hPZ.opUX6', '652e92b1@Nmp1', b'1', '', '2021-04-09 19:19:51', NULL, '2021-04-09 20:05:56', 69, b'0'),
(81, 2, 'Shubham', 'Dhanani', 'shubham@gmail.com', '$2y$10$dxZS/MRJnC6TRymUnEhiyuRxEQyvoyVtnF1jJhHro0w77kzDxuLNq', 'd93ff613@Nmp1', b'1', '', '2021-04-09 19:33:34', NULL, '2021-04-10 11:11:04', NULL, b'1'),
(82, 2, 'SND', 'Dhanani', 'sndha@gmail.com', '$2y$10$6SaCfwnhxK2cCII31JU9tuv8Bsg.MAHzBBCdIaWdi5LpkJyLmwDmO', '2ac6c56a@Nmp1', b'1', '', '2021-04-09 19:36:12', NULL, NULL, NULL, b'1'),
(83, 3, 'VND', 'Dhanani', 'vnd@gmail.com', '$2y$10$8oUG0eWtDjQX/rPlEFE6Fu5EAR2PQuHtitAlWX7Kw2aXE3sPklX9C', NULL, b'1', 'f092e5af980bed0470989fffe73e87', '2021-04-10 15:05:29', NULL, NULL, NULL, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `Seller` (`Seller`),
  ADD KEY `Downloader` (`Downloader`);

--
-- Indexes for table `notecategories`
--
ALTER TABLE `notecategories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notetypes`
--
ALTER TABLE `notetypes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `referencedata`
--
ALTER TABLE `referencedata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `Status` (`Status`),
  ADD KEY `ActionedBy` (`ActionedBy`),
  ADD KEY `Category` (`Category`),
  ADD KEY `NoteType` (`NoteType`),
  ADD KEY `Country` (`Country`);

--
-- Indexes for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `sellernotesattachements_ibfk_1` (`NoteID`);

--
-- Indexes for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReportedByID` (`ReportedByID`),
  ADD KEY `AgainstDownloadID` (`AgainstDownloadID`);

--
-- Indexes for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReviewedByID` (`ReviewedByID`),
  ADD KEY `AgainstDownloadsID` (`AgainstDownloadsID`);

--
-- Indexes for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Gender` (`Gender`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmailID` (`EmailID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sellernotes`
--
ALTER TABLE `sellernotes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`Seller`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`Downloader`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD CONSTRAINT `sellernotes_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotes_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `referencedata` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotes_ibfk_3` FOREIGN KEY (`ActionedBy`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotes_ibfk_4` FOREIGN KEY (`Category`) REFERENCES `notecategories` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotes_ibfk_5` FOREIGN KEY (`NoteType`) REFERENCES `notetypes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotes_ibfk_6` FOREIGN KEY (`Country`) REFERENCES `countries` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  ADD CONSTRAINT `sellernotesattachements_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_2` FOREIGN KEY (`ReportedByID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloads` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD CONSTRAINT `sellernotesreviews_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotesreviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sellernotesreviews_ibfk_3` FOREIGN KEY (`AgainstDownloadsID`) REFERENCES `downloads` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userprofile_ibfk_2` FOREIGN KEY (`Gender`) REFERENCES `referencedata` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

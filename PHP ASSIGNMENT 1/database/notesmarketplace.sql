-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 04:03 PM
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
(1, 'India', '+91', '2021-03-02 11:13:41', NULL, NULL, NULL, b'1'),
(2, 'USA', '+1', '2021-03-02 11:14:42', NULL, NULL, NULL, b'1'),
(3, 'Australia', '+61', '2021-03-02 11:15:27', NULL, NULL, NULL, b'1'),
(4, 'Pakistan', '+92', '2021-03-02 11:15:46', NULL, NULL, NULL, b'1'),
(5, 'Bangladesh', '+880', '2021-03-02 11:18:35', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `Seller` int(11) NOT NULL,
  `Downloader` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(1) NOT NULL,
  `AttachmentPath` varchar(255) DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL,
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` bit(1) NOT NULL,
  `PurchasedPrice` decimal(10,0) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `ModifiedDated` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notecategories`
--

INSERT INTO `notecategories` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDated`, `ModifiedBy`, `IsActive`) VALUES
(1, 'IT', 'Information and technology department', '2021-03-02 11:10:55', NULL, NULL, NULL, b'1'),
(2, 'CS', 'Computer Science ', '2021-03-02 11:11:34', NULL, NULL, NULL, b'1'),
(3, 'CA', 'Charted accountant', '2021-03-02 11:11:56', NULL, NULL, NULL, b'1'),
(4, 'MBA', 'Management Department', '2021-03-02 11:12:22', NULL, NULL, NULL, b'1');

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
(1, 'HandWritten', 'hand written books', '2021-03-02 11:07:18', NULL, NULL, NULL, b'1'),
(2, 'StoryBook', 'Story and novel books', '2021-03-02 11:08:00', NULL, NULL, NULL, b'1'),
(3, 'University Book', 'University or college books', '2021-03-02 11:08:49', NULL, NULL, NULL, b'1');

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
  `PublishedDate` datetime DEFAULT current_timestamp(),
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
  `IsPaid` bit(1) NOT NULL DEFAULT b'0',
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
(111, 63, 7, 63, NULL, '2021-03-04 17:07:10', 'hack the hacker', 2, 'DP_040321123710.jpeg', 3, 77, 'prevent hacking!!!!!!!!!!!!!!!!!!!!!!!', 'ADIT', 1, 'hacking skills', '123456', 'amit pachouri', b'1', '499', 'Preview_040321123710.pdf', '2021-03-04 17:07:10', 63, '2021-03-04 17:07:10', 63, b'1'),
(112, 63, 7, 63, NULL, '2021-03-04 17:26:56', 'svnd trading skill', 4, 'DP_040321125656.jpeg', 1, 12, 'trading knowledge', 'SVND', 1, 'hacking skills', '123456', 'shubham dhanani', b'0', '0', 'Preview_040321125656.pdf', '2021-03-04 17:26:56', 63, '2021-03-04 17:26:56', 63, b'1'),
(113, 63, 7, 63, NULL, '2021-03-04 17:31:52', 'computer science', 2, 'DP_040321010152.jpg', 3, 123, 'computer engineering', 'oxford univesity', 1, 'computer', '123456', 'mr.g.mexwell', b'0', '0', 'Preview_040321010152.pdf', '2021-03-04 17:31:52', 63, '2021-03-04 17:31:52', 63, b'1'),
(114, 63, 7, 63, NULL, '2021-03-04 17:41:54', 'artificial Inteligence', 1, 'DP_040321011154.jpeg', 1, 154, 'AI technologies', 'ADIT', 1, 'AI', '333333', 's.k.singh', b'0', '0', 'Preview_040321011154.pdf', '2021-03-04 17:41:54', 63, '2021-03-04 17:41:54', 63, b'1'),
(115, 62, 7, 62, NULL, '2021-03-04 17:55:10', 'web design', 1, 'DP_040321012510.jpeg', 3, 125, 'web designing and developing', 'ADIT', 1, 'web technology', '0702', 'a.k.singh', b'0', '0', 'Preview_040321012510.pdf', '2021-03-04 17:55:10', 62, '2021-03-04 17:55:10', 62, b'1'),
(116, 62, 6, 62, NULL, '2021-03-04 22:34:33', 'ECONOMICS', 4, 'DP_040321060433.jpg', 3, 4520, 'ECONOMICS BASICS', 'IIT,bombay', 1, 'MBA', '412', 'P L ADVANI', b'0', '0', 'Preview_040321060433.pdf', '2021-03-04 22:34:33', 62, '2021-03-04 22:34:33', 62, b'1'),
(117, 62, 7, 62, NULL, '2021-03-04 22:38:08', 'ECONOMICS', 4, 'DP_040321060808.jpg', 3, 124, 'economics basic', 'IIT,bombay', 1, 'MBA', '1234', 'P L ADVANI', b'0', '0', 'Preview_040321060808.pdf', '2021-03-04 22:38:08', 62, '2021-03-04 22:38:08', 62, b'1'),
(118, 62, 6, 62, NULL, '2021-03-05 16:23:08', 'Account', 3, 'DP_050321115308.jpeg', 3, 154, 'Accounts !!!!!!!!!!!!!!!!!', 'oxford univesity', 2, 'accounting', '1115236', 'a.k.rai', b'0', '0', 'Preview_050321115308.pdf', '2021-03-05 16:23:08', 62, '2021-03-05 16:23:08', 62, b'1'),
(119, 62, 7, 62, NULL, '2021-03-05 16:25:57', 'Social Studies', 4, 'DP_050321115557.jpg', 1, 112, 'Social Behaviour studies', 'w.k.institute', 3, 'social study', '12435', 'm.s.dhoni', b'1', '500', 'Preview_050321115557.pdf', '2021-03-05 16:25:57', 62, '2021-03-05 16:25:57', 62, b'1'),
(120, 62, 6, 62, NULL, '2021-03-05 16:28:27', 'Bussiness intelligent', 1, 'DP_050321115827.jpg', 1, 48, 'BI techniques...!!', 'a.d.p institute', 5, 'BI', '1145356', 'S.N.Dhanani', b'0', '0', 'Preview_050321115827.pdf', '2021-03-05 16:28:27', 62, '2021-03-05 16:28:27', 62, b'1'),
(121, 62, 7, 62, NULL, '2021-03-05 16:31:01', 'python', 2, 'DP_050321120101.jpeg', 1, 154, 'basics of python', 'Ljk', 4, 'python basics', '152546', 'abdul khan', b'1', '200', 'Preview_050321120101.pdf', '2021-03-05 16:31:01', 62, '2021-03-05 16:31:01', 62, b'1'),
(122, 62, 6, 62, NULL, '2021-03-05 16:32:48', 'computer network', 1, 'DP_050321120248.jpeg', 3, 78, 'Computer networking', 'ADIT', 1, 'CN', '214555', 'preraksir', b'0', '0', 'Preview_050321120248.pdf', '2021-03-05 16:32:48', 62, '2021-03-05 16:32:48', 62, b'1'),
(123, 62, 7, 62, NULL, '2021-03-05 16:35:38', 'Digital Electronics', 2, 'DP_050321120538.jpeg', 3, 1474, 'digital electronics', 'ADIT', 1, 'DE', '123554', 'a.k.sinha', b'1', '50', 'Preview_050321120538.pdf', '2021-03-05 16:35:38', 62, '2021-03-05 16:35:38', 62, b'1'),
(124, 62, 6, 62, NULL, '2021-03-05 17:49:44', 'c++', 1, 'DP_050321011944.jpeg', 3, 153, 'advance c language', 'ADIT', 1, 'c++', '215413', 's.patel', b'1', '99', 'Preview_050321011944.pdf', '2021-03-05 17:49:44', 62, '2021-03-05 17:49:44', 62, b'1'),
(125, 62, 7, 62, NULL, '2021-03-05 17:52:35', 'java', 2, 'DP_050321012235.jpeg', 3, 256, 'Java Language', 'IIT,bombay', 1, 'java', '212453', 's.d.patel', b'0', '0', 'Preview_050321012235.pdf', '2021-03-05 17:52:35', 62, '2021-03-05 17:52:35', 62, b'1'),
(126, 63, 6, 63, NULL, '2021-03-05 18:12:59', 'java', 2, 'DP_050321014259.jpg', 3, 524, 'java language', 'IIT,bombay', 1, 'java', '1245433', 'a.k.sinha', b'0', '0', 'Preview_050321014259.pdf', '2021-03-05 18:12:59', 63, '2021-03-05 18:12:59', 63, b'1'),
(127, 63, 7, 63, NULL, '2021-03-05 18:14:35', 'c++', 1, 'DP_050321014435.jpeg', 3, 64, 'advance c', 'oxford univesity', 2, 'c++', '122345', 'a.k.rai', b'1', '500', 'Preview_050321014435.pdf', '2021-03-05 18:14:35', 63, '2021-03-05 18:14:35', 63, b'1'),
(128, 62, 9, 62, NULL, '2021-03-05 18:40:16', 'Master of management', 4, 'DP_050321021016.jpg', 3, 1234, 'advance level of management', 'iim', 1, 'management', '124344', 'aniruddha tripathi', b'1', '1299', 'Preview_050321021016.pdf', '2021-03-05 18:40:16', 62, '2021-03-05 18:40:16', 62, b'1'),
(129, 62, 9, 62, NULL, '2021-03-05 18:42:28', 'Data Science', 2, 'DP_050321021228.jpeg', 3, 124, 'basics of data  science', 'ljpk', 4, 'data engineering', '2454855', 'abdul hasan', b'0', '0', 'Preview_050321021228.pdf', '2021-03-05 18:42:28', 62, '2021-03-05 18:42:28', 62, b'1'),
(130, 62, 9, 62, NULL, '2021-03-05 18:44:26', 'economics science', 4, 'DP_050321021426.jpeg', 1, 135, 'economics handwritten book', 'oxford univesity', 2, 'economics', '456325', 'k.k.singh', b'1', '5000', 'Preview_050321021426.pdf', '2021-03-05 18:44:26', 62, '2021-03-05 18:44:26', 62, b'1'),
(131, 62, 9, 62, NULL, '2021-03-05 18:46:28', 'robotics engineering', 2, 'DP_050321021628.jpg', 3, 455, 'robotics!!!!!!!!!!!!', 'A.K.I.T', 5, 'robotics', '147963', 'mr.p.k.khan', b'1', '99', 'Preview_050321021628.pdf', '2021-03-05 18:46:28', 62, '2021-03-05 18:46:28', 62, b'1'),
(132, 62, 9, 62, NULL, '2021-03-05 18:48:11', 'Lorem', 4, 'DP_050321021811.jpeg', 2, 135, 'lorem is the best!!!!!!!!!!!!!!!', 'iim,ahmedabad', 1, 'lorem', '000012', 'lorem ipsum', b'0', '0', 'Preview_050321021811.pdf', '2021-03-05 18:48:11', 62, '2021-03-05 18:48:11', 62, b'1'),
(133, 62, 9, 62, NULL, '0000-00-00 00:00:00', 'stock guru', 4, 'DP_050321022015.jpeg', 1, 451, 'be the stock guru!!!!!:>', 'sdit', 2, 'stockmarket', '122343', 's.n.d', b'0', '0', 'Preview_050321022015.pdf', '2021-03-05 18:50:15', 62, '2021-03-05 18:50:15', 62, b'1'),
(134, 62, 9, 62, NULL, '2021-03-05 18:51:54', 'stocks trading ', 3, 'DP_050321022154.jpg', 2, 213, 'stock trading strategies', 'SVND', 3, 'stockmarket', '123456', 'svnd', b'1', '2000', 'Preview_050321022154.pdf', '2021-03-05 18:51:54', 62, '2021-03-05 18:51:54', 62, b'1'),
(135, 63, 9, 63, NULL, '2021-03-05 18:57:09', 'Data intelligence', 1, 'DP_050321022709.jpeg', 3, 251, 'data science tools', 'oxford univesity', 2, 'data engineering', '555451', 'a.p.kohli', b'1', '599', 'Preview_050321022709.pdf', '2021-03-05 18:57:09', 63, '2021-03-05 18:57:09', 63, b'1'),
(136, 63, 9, 63, NULL, '2021-03-05 19:00:11', 'Adwance web design', 1, 'DP_050321023011.jpeg', 1, 134, 'advance web development', 'iit,kanpur', 1, 'web technology', '454543', 'a.k.singh', b'0', '0', 'Preview_050321023011.pdf', '2021-03-05 19:00:11', 63, '2021-03-05 19:00:11', 63, b'1'),
(137, 63, 9, 63, NULL, '2021-03-05 19:01:45', 'PHP development', 2, 'DP_050321023145.jpeg', 1, 62, 'php learning from basic', 'thapa technical', 1, 'php', '154315', 'vinod bahadur thapa', b'0', '0', 'Preview_050321023145.pdf', '2021-03-05 19:01:45', 63, '2021-03-05 19:01:45', 63, b'1');

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
(116, 113, 'Attachment_[0]_040321010152.pdf', '../Member/63/113/Attachment/Attachment_[0]_040321010152.pdf', '2021-03-04 17:31:52', 63, NULL, 63, b'1'),
(117, 113, 'Attachment_[1]_040321010152.pdf', '../Member/63/113/Attachment/Attachment_[1]_040321010152.pdf', '2021-03-04 17:31:52', 63, NULL, 63, b'1'),
(118, 114, 'Attachment_[0]_040321011154.pdf', '../Member/63/114/Attachment/Attachment_[0]_040321011154.pdf', '2021-03-04 17:41:54', 63, NULL, 63, b'1'),
(119, 115, 'Attachment_[0]_040321012511.pdf', '../Member/62/115/Attachment/Attachment_[0]_040321012511.pdf', '2021-03-04 17:55:11', 62, NULL, 62, b'1'),
(120, 116, 'Attachment_[0]_040321060433.pdf', '../Member/62/116/Attachment/Attachment_[0]_040321060433.pdf', '2021-03-04 22:34:33', 62, NULL, 62, b'1'),
(121, 117, 'Attachment_[0]_040321060808.pdf', '../Member/62/117/Attachment/Attachment_[0]_040321060808.pdf', '2021-03-04 22:38:08', 62, NULL, 62, b'1'),
(122, 118, 'Attachment_[0]_050321115308.pdf', '../Member/62/118/Attachment/Attachment_[0]_050321115308.pdf', '2021-03-05 16:23:08', 62, NULL, 62, b'1'),
(123, 119, 'Attachment_[0]_050321115557.pdf', '../Member/62/119/Attachment/Attachment_[0]_050321115557.pdf', '2021-03-05 16:25:57', 62, NULL, 62, b'1'),
(124, 120, 'Attachment_[0]_050321115827.pdf', '../Member/62/120/Attachment/Attachment_[0]_050321115827.pdf', '2021-03-05 16:28:27', 62, NULL, 62, b'1'),
(125, 121, 'Attachment_[0]_050321120101.pdf', '../Member/62/121/Attachment/Attachment_[0]_050321120101.pdf', '2021-03-05 16:31:01', 62, NULL, 62, b'1'),
(126, 122, 'Attachment_[0]_050321120248.pdf', '../Member/62/122/Attachment/Attachment_[0]_050321120248.pdf', '2021-03-05 16:32:48', 62, NULL, 62, b'1'),
(127, 123, 'Attachment_[0]_050321120538.pdf', '../Member/62/123/Attachment/Attachment_[0]_050321120538.pdf', '2021-03-05 16:35:38', 62, NULL, 62, b'1'),
(128, 123, 'Attachment_[1]_050321120538.pdf', '../Member/62/123/Attachment/Attachment_[1]_050321120538.pdf', '2021-03-05 16:35:38', 62, NULL, 62, b'1'),
(129, 124, 'Attachment_[0]_050321011944.pdf', '../Member/62/124/Attachment/Attachment_[0]_050321011944.pdf', '2021-03-05 17:49:44', 62, NULL, 62, b'1'),
(130, 125, 'Attachment_[0]_050321012236.pdf', '../Member/62/125/Attachment/Attachment_[0]_050321012236.pdf', '2021-03-05 17:52:36', 62, NULL, 62, b'1'),
(131, 126, 'Attachment_[0]_050321014259.pdf', '../Member/63/126/Attachment/Attachment_[0]_050321014259.pdf', '2021-03-05 18:12:59', 63, NULL, 63, b'1'),
(132, 127, 'Attachment_[0]_050321014436.pdf', '../Member/63/127/Attachment/Attachment_[0]_050321014436.pdf', '2021-03-05 18:14:36', 63, NULL, 63, b'1'),
(133, 128, 'Attachment_[0]_050321021016.pdf', '../Member/62/128/Attachment/Attachment_[0]_050321021016.pdf', '2021-03-05 18:40:16', 62, NULL, 62, b'1'),
(134, 129, 'Attachment_[0]_050321021228.pdf', '../Member/62/129/Attachment/Attachment_[0]_050321021228.pdf', '2021-03-05 18:42:28', 62, NULL, 62, b'1'),
(135, 130, 'Attachment_[0]_050321021427.pdf', '../Member/62/130/Attachment/Attachment_[0]_050321021427.pdf', '2021-03-05 18:44:27', 62, NULL, 62, b'1'),
(136, 130, 'Attachment_[1]_050321021427.pdf', '../Member/62/130/Attachment/Attachment_[1]_050321021427.pdf', '2021-03-05 18:44:27', 62, NULL, 62, b'1'),
(137, 131, 'Attachment_[0]_050321021628.pdf', '../Member/62/131/Attachment/Attachment_[0]_050321021628.pdf', '2021-03-05 18:46:28', 62, NULL, 62, b'1'),
(138, 132, 'Attachment_[0]_050321021811.pdf', '../Member/62/132/Attachment/Attachment_[0]_050321021811.pdf', '2021-03-05 18:48:11', 62, NULL, 62, b'1'),
(139, 133, 'Attachment_[0]_050321022015.pdf', '../Member/62/133/Attachment/Attachment_[0]_050321022015.pdf', '2021-03-05 18:50:15', 62, NULL, 62, b'1'),
(140, 134, 'Attachment_[0]_050321022155.pdf', '../Member/62/134/Attachment/Attachment_[0]_050321022155.pdf', '2021-03-05 18:51:55', 62, NULL, 62, b'1'),
(141, 135, 'Attachment_[0]_050321022709.pdf', '../Member/63/135/Attachment/Attachment_[0]_050321022709.pdf', '2021-03-05 18:57:09', 63, NULL, 63, b'1'),
(142, 136, 'Attachment_[0]_050321023011.pdf', '../Member/63/136/Attachment/Attachment_[0]_050321023011.pdf', '2021-03-05 19:00:11', 63, NULL, 63, b'1'),
(143, 137, 'Attachment_[0]_050321023145.pdf', '../Member/63/137/Attachment/Attachment_[0]_050321023145.pdf', '2021-03-05 19:01:45', 63, NULL, 63, b'1');

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
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `IsActive` bit(1) DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `password for you`, `IsEmailVerified`, `Token`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(62, 3, 'snd', 'snd', 'snd@gmail.com', '$2y$10$pF0uq4LjEirJ0jWyOJkQ8uuOm1EzmAoJglPb2pQ0sEkLjeptHM8ta', 'snd', b'1', '9575b44f581ecd7fd56685e95449c8', '2021-02-25 20:23:06', NULL, NULL, NULL, b'1'),
(63, 3, 'Shubham', 'Dhanani', 'sndhanani43@gmail.com', '$2y$10$CFty7nc9cTgLkjBPvjD.bO5ZO/IcU/vLNgOU.mBIOXyqplCmjUXVS', 'svnd', b'1', '38d0a743df53839c859eb151b8c384', '2021-02-25 20:43:54', NULL, NULL, NULL, b'1'),
(64, 3, 'nikita', 'limbani', 'nikita@gmail.com', '$2y$10$GTg2HqEY7QVLsuIiCDsymOIC0zYYZPhOO4eTmPVdiX0kdgMqU8Q1G', '', b'1', '94b058920bf66ec871055ff6f41de6', '2021-02-26 10:38:11', NULL, NULL, NULL, b'1'),
(65, 3, 's', 'd', 'sd@gmail.com', '$2y$10$tQ8CUZGHXyphR2gMNtO6yOJNiepBK92KteRgxYZ5jbC4Q/R0klYcm', '', b'1', 'e010ae6c7b0da3f3c1d4e026756944', '2021-02-26 16:28:03', NULL, NULL, NULL, b'1'),
(66, 3, 'Vinal', 'Dhanani', 'vinal@gmail.com', '$2y$10$m5xRW1nD2LpIf7CqPN4FeecPvjCifqz./pukk.8DriRQiRIR9mrju', '', b'1', '19e7bf3625e828af955fab503886fe', '2021-02-28 20:26:34', NULL, NULL, NULL, b'1'),
(69, 1, 'Super Admin', 'Admin', 'superadmin@admin.com', '$2y$10$02FXxy5NRLbMEBKj4yqeJusSmaLq1G90sDalbC6YDPej74uyzoa9e', 'superadmin', b'1', 'b480fffe077971e43ff9d12e7a404b', '2021-03-05 11:00:02', NULL, NULL, NULL, b'1'),
(70, 2, 'Admin', 'Admin', 'admin@admin.com', '$2y$10$DmT4tEFjCGG0.xgZX9ih3OlX0eNxJCg/aN6uwNM.xU2t3y5d2qr7W', 'admin', b'1', '19689a68f2ef95dfcacc3c8b5c0bed', '2021-03-05 11:01:38', NULL, NULL, NULL, b'1');

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `sellernotes`
--
ALTER TABLE `sellernotes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`Seller`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`Downloader`) REFERENCES `users` (`ID`);

--
-- Constraints for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD CONSTRAINT `sellernotes_ibfk_1` FOREIGN KEY (`SellerID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_2` FOREIGN KEY (`Status`) REFERENCES `referencedata` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_3` FOREIGN KEY (`ActionedBy`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_4` FOREIGN KEY (`Category`) REFERENCES `notecategories` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_5` FOREIGN KEY (`NoteType`) REFERENCES `notetypes` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_6` FOREIGN KEY (`Country`) REFERENCES `countries` (`ID`);

--
-- Constraints for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  ADD CONSTRAINT `sellernotesattachements_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_2` FOREIGN KEY (`ReportedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD CONSTRAINT `sellernotesreviews_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_3` FOREIGN KEY (`AgainstDownloadsID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `userprofile_ibfk_2` FOREIGN KEY (`Gender`) REFERENCES `referencedata` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

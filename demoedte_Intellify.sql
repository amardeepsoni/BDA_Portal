-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2019 at 07:19 AM
-- Server version: 10.1.39-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demoedte_Intellify`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenitiesnspecification`
--

CREATE TABLE `amenitiesnspecification` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amtorfeatuire` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `iocn` varchar(200) NOT NULL,
  `shortdescription` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `amspeimage`
--

CREATE TABLE `amspeimage` (
  `id` int(11) NOT NULL,
  `home` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `amspeimage_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amspeimage`
--

INSERT INTO `amspeimage` (`id`, `home`, `name`, `image`, `status`, `date_added`, `date_modify`, `amspeimage_id`) VALUES
(2, '0', 'Level 1', 'image/1901ShareholdersList31032018_MGT-7.pdf', 1, '2018-11-02 10:17:29', '2018-11-02 10:55:30', 4),
(3, '0', 'Level 2', 'image/1901ShareholdersList31032018_MGT-7.pdf', 1, '2018-11-02 10:17:29', '2018-11-02 10:55:35', 4),
(4, '0', 'Level 3', 'image/1901ShareholdersList31032018_MGT-7.pdf', 1, '2018-11-02 10:17:29', '2018-11-02 10:55:39', 4),
(5, '0', 'Level 0', 'image/1901ShareholdersList31032018_MGT-7.pdf', 1, '2018-11-02 10:17:29', '2018-11-02 10:49:46', 5),
(6, '0', 'Level 1', 'image/1901ShareholdersList31032018_MGT-7.pdf', 1, '2018-11-02 10:17:29', '2018-11-02 10:55:30', 5),
(8, '0', 'Level 3', 'image/1901ShareholdersList31032018_MGT-7.pdf', 1, '2018-11-02 10:17:29', '2018-11-02 10:55:39', 5);

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `questionbank_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `orderno` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`id`, `questionbank_id`, `answer`, `orderno`, `date_added`, `date_modify`) VALUES
(192, 29, 'Freud', 1, '2018-12-02 17:25:17', '0000-00-00 00:00:00'),
(193, 29, 'James', 2, '2018-12-02 17:25:17', '0000-00-00 00:00:00'),
(194, 29, 'Horney', 3, '2018-12-02 17:25:17', '0000-00-00 00:00:00'),
(195, 29, 'None of the above', 4, '2018-12-02 17:25:17', '0000-00-00 00:00:00'),
(200, 30, 'Freud’s theory', 1, '0000-00-00 00:00:00', '2018-12-02 17:26:25'),
(201, 30, 'Roger’s theory', 2, '0000-00-00 00:00:00', '2018-12-02 17:26:25'),
(202, 30, 'Maslow’s theory', 3, '0000-00-00 00:00:00', '2018-12-02 17:26:25'),
(203, 30, 'Adler’s theory', 4, '0000-00-00 00:00:00', '2018-12-02 17:26:25'),
(204, 31, 'Learning', 1, '2018-12-02 17:27:13', '0000-00-00 00:00:00'),
(205, 31, 'Habits', 2, '2018-12-02 17:27:13', '0000-00-00 00:00:00'),
(206, 31, 'Conscience', 3, '2018-12-02 17:27:13', '0000-00-00 00:00:00'),
(207, 31, 'Memory', 4, '2018-12-02 17:27:13', '0000-00-00 00:00:00'),
(208, 32, 'Displacement', 1, '2018-12-02 17:28:00', '0000-00-00 00:00:00'),
(209, 32, 'Regression', 2, '2018-12-02 17:28:00', '0000-00-00 00:00:00'),
(210, 32, 'Sublimation', 3, '2018-12-02 17:28:00', '0000-00-00 00:00:00'),
(211, 32, 'None of the above', 4, '2018-12-02 17:28:00', '0000-00-00 00:00:00'),
(212, 33, 'Microcephaly', 1, '2018-12-02 17:28:56', '0000-00-00 00:00:00'),
(213, 33, 'Hydrocephaly', 2, '2018-12-02 17:28:56', '0000-00-00 00:00:00'),
(214, 33, 'Childhood dwarfism', 3, '2018-12-02 17:28:56', '0000-00-00 00:00:00'),
(215, 33, 'Cretinism', 4, '2018-12-02 17:28:56', '0000-00-00 00:00:00'),
(216, 34, 'Habitual', 1, '2018-12-02 17:29:36', '0000-00-00 00:00:00'),
(217, 34, 'Abnormal', 2, '2018-12-02 17:29:36', '0000-00-00 00:00:00'),
(218, 34, 'Disruptive', 3, '2018-12-02 17:29:36', '0000-00-00 00:00:00'),
(219, 34, 'None of these', 4, '2018-12-02 17:29:36', '0000-00-00 00:00:00'),
(223, 36, 'Microcephaly', 1, '2018-12-02 17:31:28', '0000-00-00 00:00:00'),
(224, 36, 'Hydrocephaly', 2, '2018-12-02 17:31:28', '0000-00-00 00:00:00'),
(225, 36, 'Childhood dwarfism', 3, '2018-12-02 17:31:28', '0000-00-00 00:00:00'),
(226, 36, 'Cretinism', 4, '2018-12-02 17:31:28', '0000-00-00 00:00:00'),
(227, 35, 'Sigmund Freud', 1, '0000-00-00 00:00:00', '2018-12-02 17:31:43'),
(228, 35, 'Carl Gustav Jung', 2, '0000-00-00 00:00:00', '2018-12-02 17:31:43'),
(229, 35, 'Alfred Adler', 3, '0000-00-00 00:00:00', '2018-12-02 17:31:43'),
(230, 35, 'None of the above', 4, '0000-00-00 00:00:00', '2018-12-02 17:31:43'),
(231, 37, 'Nomothetic analysis', 1, '2018-12-02 17:32:35', '0000-00-00 00:00:00'),
(232, 37, 'Idiographic analysis', 2, '2018-12-02 17:32:35', '0000-00-00 00:00:00'),
(233, 37, 'Numeral analysis ', 3, '2018-12-02 17:32:35', '0000-00-00 00:00:00'),
(234, 37, 'Factor analysis', 4, '2018-12-02 17:32:35', '0000-00-00 00:00:00'),
(235, 38, 'Displacement', 1, '2018-12-02 17:33:08', '0000-00-00 00:00:00'),
(236, 38, 'Regression', 2, '2018-12-02 17:33:08', '0000-00-00 00:00:00'),
(237, 38, 'Sublimation', 3, '2018-12-02 17:33:08', '0000-00-00 00:00:00'),
(238, 38, 'None of the above', 4, '2018-12-02 17:33:08', '0000-00-00 00:00:00'),
(239, 39, 'Source traits', 1, '2018-12-02 17:33:36', '0000-00-00 00:00:00'),
(240, 39, 'Common traits', 2, '2018-12-02 17:33:36', '0000-00-00 00:00:00'),
(241, 39, 'Surface traits', 3, '2018-12-02 17:33:36', '0000-00-00 00:00:00'),
(242, 39, 'Individual traits', 4, '2018-12-02 17:33:36', '0000-00-00 00:00:00'),
(243, 40, 'Projective techniques', 1, '2018-12-02 17:34:04', '0000-00-00 00:00:00'),
(244, 40, 'Traits', 2, '2018-12-02 17:34:04', '0000-00-00 00:00:00'),
(245, 40, 'Id and ego', 3, '2018-12-02 17:34:04', '0000-00-00 00:00:00'),
(246, 40, 'None of the above', 4, '2018-12-02 17:34:04', '0000-00-00 00:00:00'),
(247, 41, 'Horney', 1, '2018-12-02 17:34:47', '0000-00-00 00:00:00'),
(248, 41, 'Jung', 2, '2018-12-02 17:34:47', '0000-00-00 00:00:00'),
(249, 41, 'Freud', 3, '2018-12-02 17:34:47', '0000-00-00 00:00:00'),
(250, 41, 'None of the above', 4, '2018-12-02 17:34:47', '0000-00-00 00:00:00'),
(251, 41, '', 5, '2018-12-02 17:34:47', '0000-00-00 00:00:00'),
(252, 42, 'Surface traits', 1, '2018-12-02 17:35:19', '0000-00-00 00:00:00'),
(253, 42, 'Common traits', 2, '2018-12-02 17:35:19', '0000-00-00 00:00:00'),
(254, 42, 'Source traits', 3, '2018-12-02 17:35:19', '0000-00-00 00:00:00'),
(255, 42, 'Individual traits', 4, '2018-12-02 17:35:19', '0000-00-00 00:00:00'),
(256, 43, 'Emotions ', 1, '2018-12-02 17:35:47', '0000-00-00 00:00:00'),
(257, 43, 'Adjustment ', 2, '2018-12-02 17:35:47', '0000-00-00 00:00:00'),
(258, 43, 'Social behaviour', 3, '2018-12-02 17:35:47', '0000-00-00 00:00:00'),
(259, 43, 'Personality', 4, '2018-12-02 17:35:47', '0000-00-00 00:00:00'),
(260, 44, 'E. Rorschach', 1, '2018-12-02 17:36:34', '0000-00-00 00:00:00'),
(261, 44, 'Hermann Rorschach', 2, '2018-12-02 17:36:34', '0000-00-00 00:00:00'),
(262, 44, 'L.F. Rorschach', 3, '2018-12-02 17:36:34', '0000-00-00 00:00:00'),
(263, 44, 'None of the above', 4, '2018-12-02 17:36:34', '0000-00-00 00:00:00'),
(264, 45, 'Id', 1, '2018-12-02 17:37:37', '0000-00-00 00:00:00'),
(265, 45, 'Ego ', 2, '2018-12-02 17:37:37', '0000-00-00 00:00:00'),
(266, 45, 'Super ego', 3, '2018-12-02 17:37:37', '0000-00-00 00:00:00'),
(267, 45, 'All the above', 4, '2018-12-02 17:37:37', '0000-00-00 00:00:00'),
(268, 46, 'Alfred Adler', 1, '2018-12-02 17:38:04', '0000-00-00 00:00:00'),
(269, 46, 'William James', 2, '2018-12-02 17:38:04', '0000-00-00 00:00:00'),
(270, 46, 'Sigmund Freud', 3, '2018-12-02 17:38:04', '0000-00-00 00:00:00'),
(271, 46, 'None of the above', 4, '2018-12-02 17:38:04', '0000-00-00 00:00:00'),
(272, 47, 'Factorial validity', 1, '2018-12-02 17:38:33', '0000-00-00 00:00:00'),
(273, 47, 'Face validity content validity', 2, '2018-12-02 17:38:33', '0000-00-00 00:00:00'),
(274, 47, 'Empirical validity', 3, '2018-12-02 17:38:33', '0000-00-00 00:00:00'),
(275, 47, '', 4, '2018-12-02 17:38:33', '0000-00-00 00:00:00'),
(276, 48, 'Rogers', 1, '2018-12-02 17:39:28', '0000-00-00 00:00:00'),
(277, 48, 'Piaget', 2, '2018-12-02 17:39:28', '0000-00-00 00:00:00'),
(278, 48, 'Bruner ', 3, '2018-12-02 17:39:28', '0000-00-00 00:00:00'),
(279, 48, 'Maslow', 4, '2018-12-02 17:39:28', '0000-00-00 00:00:00'),
(280, 49, 'Ego', 1, '2018-12-02 17:40:46', '0000-00-00 00:00:00'),
(281, 49, 'Id', 2, '2018-12-02 17:40:46', '0000-00-00 00:00:00'),
(282, 49, 'Super ego', 3, '2018-12-02 17:40:46', '0000-00-00 00:00:00'),
(283, 49, 'None of the above', 4, '2018-12-02 17:40:46', '0000-00-00 00:00:00'),
(284, 50, 'Rating scale', 1, '2018-12-02 17:41:26', '0000-00-00 00:00:00'),
(285, 50, 'Behavior test', 2, '2018-12-02 17:41:26', '0000-00-00 00:00:00'),
(286, 50, 'Paper-pencil test', 3, '2018-12-02 17:41:26', '0000-00-00 00:00:00'),
(287, 50, 'Projective test', 4, '2018-12-02 17:41:26', '0000-00-00 00:00:00'),
(288, 51, 'Trait and type', 1, '2018-12-02 17:42:20', '0000-00-00 00:00:00'),
(289, 51, 'Dynamic ', 2, '2018-12-02 17:42:20', '0000-00-00 00:00:00'),
(290, 51, 'Behavioural', 3, '2018-12-02 17:42:20', '0000-00-00 00:00:00'),
(291, 51, 'Phenomenological.', 4, '2018-12-02 17:42:20', '0000-00-00 00:00:00'),
(292, 52, 'Sigmund rued', 1, '2018-12-02 17:42:47', '0000-00-00 00:00:00'),
(293, 52, 'Alfred Adler', 2, '2018-12-02 17:42:47', '0000-00-00 00:00:00'),
(294, 52, 'Karen Horney', 3, '2018-12-02 17:42:47', '0000-00-00 00:00:00'),
(295, 52, 'None of the above', 4, '2018-12-02 17:42:47', '0000-00-00 00:00:00'),
(380, 59, 'More important', 1, '2018-12-02 18:54:18', '0000-00-00 00:00:00'),
(381, 59, 'More errors of judgment', 2, '2018-12-02 18:54:18', '0000-00-00 00:00:00'),
(382, 59, 'Less important', 3, '2018-12-02 18:54:18', '0000-00-00 00:00:00'),
(383, 59, 'Less errors of judgment', 4, '2018-12-02 18:54:18', '0000-00-00 00:00:00'),
(384, 60, 'Toddler stage', 1, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(385, 60, 'Libido', 2, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(386, 60, 'Phallic', 3, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(387, 60, 'Middle childhood', 4, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(388, 61, 'Maslow', 1, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(389, 61, 'Freud', 2, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(390, 61, 'Jung', 3, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(391, 61, 'None of the above', 4, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(392, 62, 'Rating scale', 1, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(393, 62, 'MMPI', 2, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(394, 62, 'Behaviour Tests', 3, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(395, 62, 'Interviews', 4, '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(396, 63, 'Possessive attitude', 1, '2018-12-02 18:54:20', '0000-00-00 00:00:00'),
(397, 63, 'Self-concept', 2, '2018-12-02 18:54:20', '0000-00-00 00:00:00'),
(398, 63, 'Anima', 3, '2018-12-02 18:54:20', '0000-00-00 00:00:00'),
(399, 63, 'Animus', 4, '2018-12-02 18:54:20', '0000-00-00 00:00:00'),
(400, 64, 'Humanistic', 1, '2018-12-02 18:54:21', '0000-00-00 00:00:00'),
(401, 64, 'Social', 2, '2018-12-02 18:54:21', '0000-00-00 00:00:00'),
(402, 64, 'Psychoanalytic', 3, '2018-12-02 18:54:21', '0000-00-00 00:00:00'),
(403, 64, 'None of the above', 4, '2018-12-02 18:54:21', '0000-00-00 00:00:00'),
(442, 25, 'A', 1, '0000-00-00 00:00:00', '2019-01-22 13:55:01'),
(443, 25, 'B', 2, '0000-00-00 00:00:00', '2019-01-22 13:55:01'),
(444, 25, 'C', 3, '0000-00-00 00:00:00', '2019-01-22 13:55:01'),
(445, 25, 'D', 4, '0000-00-00 00:00:00', '2019-01-22 13:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `blogcat`
--

CREATE TABLE `blogcat` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `shortdescription` text NOT NULL,
  `description` text NOT NULL,
  `punchline` text NOT NULL,
  `lastdescription` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogcat`
--

INSERT INTO `blogcat` (`id`, `pid`, `name`, `linkname`, `page_title`, `meta_keyword`, `meta_description`, `image`, `banner`, `shortdescription`, `description`, `punchline`, `lastdescription`, `status`, `date_added`, `date_modify`) VALUES
(30, 0, 'Blogs', 'blogs', 'Official Blog of Utsaah ', 'Official Blog of Utsaah ', 'Official Blog of Utsaah ', '', 'blogcat/8398mainbanner.jpg', '', '', '', '', 1, '2018-04-26 10:27:14', '2018-07-06 14:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `mrpprice` decimal(15,2) NOT NULL DEFAULT '0.00',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `image` varchar(255) NOT NULL,
  `bigimage` varchar(255) NOT NULL,
  `shortdescription` text NOT NULL,
  `description` text NOT NULL,
  `specification` text NOT NULL,
  `feature` text NOT NULL,
  `ordernum` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `home` varchar(20) NOT NULL,
  `latest` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `blogs_blogcat`
--

CREATE TABLE `blogs_blogcat` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blogs_blogcat`
--

INSERT INTO `blogs_blogcat` (`id`, `product_id`, `category_id`) VALUES
(57, 10, 30),
(58, 11, 30),
(59, 7, 30),
(60, 8, 30),
(61, 9, 30);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `wwhu` int(11) NOT NULL,
  `footerservices` int(11) NOT NULL,
  `countryyes` int(11) NOT NULL,
  `homehead` text NOT NULL,
  `bannerhead` text NOT NULL,
  `countryhead` text NOT NULL,
  `homeicon` varchar(200) NOT NULL,
  `home` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(200) NOT NULL,
  `flagiocn` varchar(255) NOT NULL,
  `shortdescription` text NOT NULL,
  `homecontent` text NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `user_id`, `pid`, `wwhu`, `footerservices`, `countryyes`, `homehead`, `bannerhead`, `countryhead`, `homeicon`, `home`, `name`, `linkname`, `page_title`, `meta_keyword`, `meta_description`, `image`, `banner`, `flagiocn`, `shortdescription`, `homecontent`, `description`, `status`, `ordernum`, `ip`, `user_agent`, `date_added`, `date_modify`) VALUES
(52, 1, 0, 0, 0, 0, '', '', '', '', 0, 'Math', 'Math', 'Math', 'Mathogy', 'Math', '', '', '', '<p>Math</p>\r\n', '<p>Math</p>\r\n', '<p>Math</p>\r\n', 1, 1, '112.196.132.154', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', '2018-07-06 08:21:38', '2018-11-29 16:59:20'),
(53, 1, 0, 0, 0, 0, '', '', '', '', 0, 'Checmistry', 'Checmistry', 'Checmistry', 'Checmistry', 'Checmistry', '', '', '', '<p>Checmistry</p>\r\n', '<p>Checmistry</p>\r\n', '<p>Checmistry</p>\r\n', 1, 1, '112.196.132.154', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', '2018-07-06 09:28:46', '2018-11-29 16:59:43'),
(54, 1, 0, 0, 0, 0, '', '', '', '', 0, 'Subjects 12', 'Subjects 12', 'Subjects 12er 2)', 'Subjects 12', 'Subjects 12', '', '', '', '<p>Subjects 12</p>\r\n', '<p>Subjects 12</p>\r\n', '<p>Subjects 12</p>\r\n', 1, 2, '112.196.132.154', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', '2018-07-06 09:29:18', '2018-11-29 17:00:10'),
(55, 1, 0, 0, 0, 0, '', '', '', '', 0, 'Hindi', 'Hindi', 'Hindi', 'Hindiy', 'Hindi', '', '', '', '<p>Hindi</p>\r\n', '<p>Hindi</p>\r\n', '<p>Hindi</p>\r\n', 1, 3, '112.196.132.154', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36', '2018-07-06 09:29:43', '2018-11-29 17:00:32'),
(56, 3, 0, 0, 0, 0, '', '', '', '', 0, 'Category 1', 'category-1', 'Category 1', 'Category 1', 'Category 1', '', '', '', '<p>Category 1</p>\r\n', '<p>Category 1</p>\r\n', '<p>Category 1</p>\r\n', 1, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:09:38', '2018-09-13 17:12:05'),
(57, 3, 0, 0, 0, 0, '', '', '', '', 0, 'Category 2', 'category-2', 'Category 2', 'Category 2', 'Category 2', '', '', '', '<p>Category 2</p>\r\n', '<p>Category 2</p>\r\n', '<p>Category 2</p>\r\n', 1, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:10:15', '2018-09-13 17:12:23'),
(59, 1, 0, 0, 0, 0, '', '', '', '', 0, 'GRE Psychology', 'GRE Psychology', 'GRE Psychology', 'GRE Psychology', 'GRE Psychology', '', '', '', '', '<p>GRE Psychology</p>\r\n', '<p>GRE Psychology</p>\r\n', 1, 0, '103.82.191.255', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36', '2018-09-27 01:30:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE `chapter` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`id`, `user_id`, `pid`, `name`, `subject_id`, `subject`, `status`, `ordernum`, `ip`, `user_agent`, `date_added`, `date_modify`) VALUES
(1, 1, 0, 'Chapter 1', 1, 'English', 1, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-08-04 07:19:41', '2018-08-16 18:51:07'),
(2, 1, 0, 'Chapter 2', 1, 'English', 1, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-08-04 07:19:53', '2018-08-16 18:51:19'),
(3, 1, 0, 'Chapter 3', 2, 'Reseaoning', 1, 3, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-08-04 07:20:03', '2018-08-24 12:11:55'),
(4, 1, 0, 'Chapter 4', 2, 'Reseaoning', 1, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-08-04 07:20:10', '2018-08-24 12:12:01'),
(5, 1, 0, 'Chapter 5', 0, '', 1, 5, '', '', '2018-08-04 07:20:22', '0000-00-00 00:00:00'),
(7, 1, 0, 'Chapter 6', 0, '', 1, 6, '', '', '2018-08-04 07:32:43', '0000-00-00 00:00:00'),
(8, 1, 0, 'Chapter 7', 0, '', 1, 7, '', '', '2018-08-04 07:33:39', '0000-00-00 00:00:00'),
(9, 3, 0, 'Chapter 1', 3, 'English', 1, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:14:00', '0000-00-00 00:00:00'),
(10, 3, 0, 'Chapter 2', 3, 'English', 1, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:14:07', '0000-00-00 00:00:00'),
(11, 3, 0, 'Chapter 3', 4, 'Hindi', 1, 3, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:14:15', '0000-00-00 00:00:00'),
(12, 3, 0, 'Chapter 4', 4, 'Hindi', 1, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:14:22', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `commercialspace`
--

CREATE TABLE `commercialspace` (
  `id` int(11) NOT NULL,
  `home` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` varchar(400) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `headerbanner`
--

CREATE TABLE `headerbanner` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `heading1` text NOT NULL,
  `heading2` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `home` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `vidorimg` varchar(20) NOT NULL,
  `videos` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `linkname`, `date_added`) VALUES
(1, 'Common Setting', 'setting', '2018-09-12 00:00:00'),
(5, 'Subject Manager', 'subject', '2018-09-12 00:00:00'),
(8, 'Question Bank Manager', 'questionbank', '2018-09-12 00:00:00'),
(9, 'Test Manager', 'testpanel', '2018-09-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `menu_user`
--

CREATE TABLE `menu_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_user`
--

INSERT INTO `menu_user` (`id`, `user_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(114, 3, 1),
(115, 3, 5),
(116, 3, 8),
(117, 3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subhead` varchar(300) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `bigimage` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `shortdescription` text NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `paddques`
--

CREATE TABLE `paddques` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `option1` varchar(255) NOT NULL,
  `option2` varchar(255) NOT NULL,
  `option3` varchar(255) NOT NULL,
  `option4` varchar(255) NOT NULL,
  `option5` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paddques`
--

INSERT INTO `paddques` (`id`, `product_id`, `name`, `image`, `description`, `status`, `date_added`, `date_modify`, `option1`, `option2`, `option3`, `option4`, `option5`) VALUES
(1, 35, 'I have the ability to prevent accidents.', '', '', 1, '2018-07-06 08:39:16', '2018-07-06 11:09:49', 'After setting up y', 'After setting up your', 'After setting', 'After ', ''),
(2, 35, 'Others consider my lifestyle wild and exciting.', '', '<p>dfdf</p>\r\n', 1, '2018-07-06 08:47:32', '2018-07-06 11:15:40', 'The printing and typesetting industry', 'The printing ', 'The printing and typese', 'The printing and ty', 'The printing and typese'),
(3, 35, 'I have a short attention span. ', '', '', 1, '2018-07-06 11:10:28', '0000-00-00 00:00:00', 'After setting up y', 'After setting up y', 'After setting up y', 'After setting up y', '');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `pid` int(20) NOT NULL,
  `home` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `bannerhead` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `shortdescription` text NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `pid`, `home`, `name`, `bannerhead`, `linkname`, `page_title`, `meta_keyword`, `meta_description`, `image`, `banner`, `pdf`, `shortdescription`, `description`, `status`, `date_added`, `date_modify`) VALUES
(4, 0, '1', 'About Us', 'Welcome Utsaah Psychological Services', 'about-us', 'About Us', 'About Us', 'About Us', 'cms/888aboutus.jpg', 'cms/1496aboutusbanner.jpg', 'cms/4713abstract guidelines.pdf', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', 1, '2017-10-07 21:00:58', '2019-01-12 12:32:43'),
(5, 4, '0', 'Our Story', 'Our Story', 'our-story', 'Our Story', 'Our Story', 'Our Story', 'cms/6928teamphoto-min.jpg', '', '', '', '<p>We started Intellify with our vision to change the education system in India. Since our undergraduate days, We always felt the lack of a system or platform that gave the govt school kids and underprivileged kids motivation to be innovative and creative.</p>\r\n\r\n<p>Lack of a common platform that gave them a chance to compete with the Private School kids always left them asking for more.</p>\r\n\r\n<p>Along with this, we felt the schools were continuing in the same way they were 150 years ago, with the focus on getting the syllabus completed and exams done.</p>\r\n\r\n<p>&nbsp;</p>\r\n', 1, '2019-01-12 12:10:01', '2019-01-14 07:30:31'),
(6, 4, '0', 'What we do?', 'What we do?', 'What we do?', 'What we do?', 'What we do?', 'What we do?', 'cms/2143min.jpg', '', '', '', '<p>We saw that there is a grave need to bring a paradigm shift in education space in India with focus back on learning, innovation and creativity backed by a first platform in India that has everyone on it - Kids from the privileged background and the kids from the underprivileged at the same time, with resources available for everyone without any discrimination for them to explore and become a master at their innate abilities, continuous monitoring and support to hone those skills and talents.</p>\r\n\r\n<p>Intellify aims to be a platform available for all the kids across the nation that doesn&#39;t discriminate on basis of anything but promises to help each and everyone who wants to improve!</p>\r\n', 1, '2019-01-12 12:10:28', '2019-01-12 12:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `mrpprice` decimal(15,2) NOT NULL DEFAULT '0.00',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `image` varchar(255) NOT NULL,
  `bigimage` varchar(255) NOT NULL,
  `shortdescription` text NOT NULL,
  `description` text NOT NULL,
  `specification` text NOT NULL,
  `feature` text NOT NULL,
  `ordernum` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `home` varchar(20) NOT NULL,
  `latest` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `name`, `linkname`, `page_title`, `meta_keyword`, `meta_description`, `mrpprice`, `price`, `image`, `bigimage`, `shortdescription`, `description`, `specification`, `feature`, `ordernum`, `status`, `date_added`, `date_modify`, `home`, `latest`) VALUES
(37, 'Vietnam Embassy Attestation ', '', '', '', '', '0.00', '0.00', 'product/9022Vietnam-.jpg', '', '', '', '', '', '1', 1, '2018-05-31 12:22:14', '0000-00-00 00:00:00', '0', '');

-- --------------------------------------------------------

--
-- Table structure for table `photo_category`
--

CREATE TABLE `photo_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo_category`
--

INSERT INTO `photo_category` (`id`, `product_id`, `category_id`) VALUES
(99, 36, 4),
(100, 37, 34);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `mrpprice` decimal(15,2) NOT NULL DEFAULT '0.00',
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `image` varchar(255) NOT NULL,
  `bigimage` varchar(255) NOT NULL,
  `shortdescription` text NOT NULL,
  `description` text NOT NULL,
  `specification` text NOT NULL,
  `feature` text NOT NULL,
  `ordernum` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `home` varchar(20) NOT NULL,
  `latest` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `linkname`, `page_title`, `meta_keyword`, `meta_description`, `mrpprice`, `price`, `image`, `bigimage`, `shortdescription`, `description`, `specification`, `feature`, `ordernum`, `status`, `date_added`, `date_modify`, `home`, `latest`) VALUES
(35, 'Accident Proneness Test', 'accident-proneness-test', 'Accident Proneness Test', 'Accident Proneness Test', 'Accident Proneness Test', '0.00', '0.00', '', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', '', '1', 1, '2018-07-06 08:25:30', '2018-07-06 09:34:19', '0', '0'),
(36, 'Big Five Personality Test', 'big-five-personality-test', 'Big Five Personality Test', 'Big Five Personality Test', 'Big Five Personality Test', '0.00', '0.00', '', '', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a</p>\r\n', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '', '', '2', 1, '2018-07-06 09:31:19', '2018-07-06 09:34:29', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

CREATE TABLE `productimage` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_id`, `category_id`) VALUES
(98, 35, 53),
(99, 36, 53);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `home` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subhead` varchar(255) NOT NULL,
  `shortdescription` text NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `home`, `name`, `subhead`, `shortdescription`, `description`, `image`, `icon`, `status`, `date_added`, `date_modify`) VALUES
(1, '0', 'ISCO', 'International Science & Creativity Olympiad', '<p>International science and Creativity Olympiad(ISCO) is a unique methodology to gauge the general intellectual functioning of a student.</p>\r\n', '<h5>What we do?</h5>\r\n\r\n<p>To ignite and grow creativity and passion for science and innovation among school students by not only providing them a platform to showcase their skills but also enhance them through mastery learning methodology. The focus being to provide an opportunity that will force them to think out of what is taught in schools and covered in books.</p>\r\n\r\n<h5>How we do?</h5>\r\n\r\n<p>The Olympiad will take you through a range of well designed tests and events which will determine the various components that form the base of innovative quotient of participants. The olympiad will measure your Creativity and Innovation Quotient through an offline test followed by an online test and then followed by an interactive event at IIT Delhi. The whole process will be aided by continuous assessment from Intellify&#39;s online student portal.</p>\r\n', 'image/9697ISCOProject.jpg', 'image/7500icon-1.png', 1, '2019-01-14 10:18:41', '2019-01-19 12:19:01'),
(2, '0', 'School Redesign', '', '<p>&lsquo;Educational research&rsquo; involving study of educational methodologies and pedagogies adopted in..</p>\r\n', '<h5>What we do?</h5>\r\n\r\n<p>To ignite and grow creativity and passion for science and innovation among school students by not only providing them a platform to showcase their skills but also enhance them through mastery learning methodology. The focus being to provide an opportunity that will force them to think out of what is taught in schools and covered in books.</p>\r\n\r\n<h5>How we do?</h5>\r\n\r\n<p>The Olympiad will take you through a range of well designed tests and events which will determine the various components that form the base of innovative quotient of participants. The olympiad will measure your Creativity and Innovation Quotient through an offline test followed by an online test and then followed by an interactive event at IIT Delhi. The whole process will be aided by continuous assessment from Intellify&#39;s online student portal.</p>\r\n', 'image/8023idealclassroom.jpg', 'image/90icon-2.png', 1, '2019-01-14 10:20:39', '2019-01-19 12:25:31'),
(3, '0', 'Solve App', '', '<p>Solve is a FREE doubt solving-cum-classroom discussion platform for all schools.</p>\r\n', '<h5>What we do?</h5>\r\n\r\n<p>Solve is a FREE doubt solving-cum-classroom discussion platform for all schools.<br />\r\nIn day-to-day academics, doubts form an integral part of the learning process and a large number of students are not able to get their doubts clarified instantly and that concepts just doesn&#39;t get clarified ever and thus hinders learning. Most of the doubt solving platforms demand money, but here we encourage peer to peer interaction with our unique credit system.</p>\r\n\r\n<h5>How we do?</h5>\r\n\r\n<p>Our app ensures that each and every student from the school should be able to clarify their doubts at the tap of a button instantly! Also, the platform provides constant feedback about the student&rsquo;s performance to the parents, teachers and the school!<br />\r\n<br />\r\nTo learn how to use this app click <a href=\"https://docs.google.com/document/d/1g0-wNicq8zJZKuQW-2eB-t5Zgmz7OoXIusBfQaKqCj4/edit?usp=sharing\">here</a>.</p>\r\n', 'image/1716solveapp.png', 'image/7799icon-3.png', 1, '2019-01-14 10:21:39', '2019-01-19 12:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `questionbank`
--

CREATE TABLE `questionbank` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `schoollavel_id` int(11) NOT NULL,
  `schoollavel` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `perquestionmark` varchar(100) NOT NULL,
  `negativemark` varchar(100) NOT NULL,
  `rightanswer` varchar(255) NOT NULL,
  `explaintext` text NOT NULL,
  `explainattachment` varchar(255) NOT NULL,
  `videolink` text NOT NULL,
  `status` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questionbank`
--

INSERT INTO `questionbank` (`id`, `user_id`, `schoollavel_id`, `schoollavel`, `subject_id`, `subject`, `language`, `name`, `image`, `perquestionmark`, `negativemark`, `rightanswer`, `explaintext`, `explainattachment`, `videolink`, `status`, `ip`, `user_agent`, `date_added`, `date_modify`) VALUES
(25, 1, 5, 'Level1', 1, 'Psychology', '', '<p>When an infant is behaving according to the pleasure principle, he acts upon_______ regardless of the circumstances.</p>\r\n', 'images/test.jpg', '2', '1', '443', 'Test       ', 'images/test.docx', 'asda', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2018-11-27 12:56:53', '2019-01-22 13:55:01'),
(29, 1, 5, 'Level1', 1, 'Psychology', '', '<p>______ said basic anxiety is what arises in childhood when the child feels helpless in a threatening world</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:25:17', '0000-00-00 00:00:00'),
(30, 1, 5, 'Level1', 1, 'Psychology', '', '<p>The &quot;self&quot; is the central concept in __________.</p>\r\n', '', '', '', '3', '  ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:26:17', '2018-12-02 17:26:25'),
(31, 1, 5, 'Level1', 1, 'Psychology', '', '<p>Man is viewed as a creature of________ , they are the fabric of his personality</p>\r\n', '', '', '', '1', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:27:13', '0000-00-00 00:00:00'),
(32, 1, 5, 'Level1', 1, 'Psychology', '', '<p>In the face of a threat, one may retreat to an earlier pattern of adaptation, possibly a childish or primitive one, this is called:</p>\r\n', '', '', '', '4', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:28:00', '0000-00-00 00:00:00'),
(33, 1, 5, 'Level1', 1, 'Psychology', '', '<p>Under secretion of thyroid gland leads to __________.</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:28:56', '0000-00-00 00:00:00'),
(34, 1, 5, 'Level1', 1, 'Psychology', '', '<p>Excessive drinking, if it relieves an intense feeling of anxiety , may become</p>\r\n', '', '', '', '3', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:29:36', '0000-00-00 00:00:00'),
(35, 1, 5, 'Level1', 1, 'Psychology', '', '<p>People are always struggling to overcome their feelings of inferiority and this struggle is the most basic life urge of them; this is the view of:</p>\r\n', '', '', '', '1', '  ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:30:22', '2018-12-02 17:31:43'),
(36, 1, 5, 'Level1', 1, 'Psychology', '', 'Under secretion of pituitary gland leads to __________.', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:31:28', '0000-00-00 00:00:00'),
(37, 1, 5, 'Level1', 1, 'Psychology', '', 'The_________ is aimed at describing gene principles of personality, which apply to many persons.', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:32:35', '0000-00-00 00:00:00'),
(38, 1, 5, 'Level1', 1, 'Psychology', '', '<p>When a new baby is the centre of attention an older child may become Jealous prevented from harming the baby, the child demolishes a doll-this is an example of:</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:33:08', '0000-00-00 00:00:00'),
(39, 1, 5, 'Level1', 1, 'Psychology', '', '<p>The psychometric tests detect the __________.</p>\r\n', '', '', '', '4', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:33:36', '0000-00-00 00:00:00'),
(40, 1, 5, 'Level1', 1, 'Psychology', '', '<p>Factor analysis has been used to discover the _______ in personality, but no final agreement has been reached as to the primary factor.</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:34:04', '0000-00-00 00:00:00'),
(41, 1, 5, 'Level1', 1, 'Psychology', '', '<p>_______ described several defence mechanisms by which the ego disguises, redirects, hides and otherwise copes with the id&rsquo;s urges.</p>\r\n', '', '', '', '3', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:34:47', '0000-00-00 00:00:00'),
(42, 1, 5, 'Level1', 1, 'Psychology', '', '<p>The projective tests measure the __________.</p>\r\n', '', '', '', '3', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:35:19', '0000-00-00 00:00:00'),
(43, 1, 5, 'Level1', 1, 'Psychology', '', '<p>__________refers to the distinctive patterns of behaviour that characterise each individual&#39;s adaptation to the situations of his or her life.</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:35:47', '0000-00-00 00:00:00'),
(44, 1, 5, 'Level1', 1, 'Psychology', '', '<p>The Rorschach Test is developed by the famous psychiatrist :</p>\r\n', '', '', '', '4', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:36:34', '0000-00-00 00:00:00'),
(45, 1, 5, 'Level1', 1, 'Psychology', '', '<p>The ______consists of primitive drives which may be constructive destructive.</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:37:37', '0000-00-00 00:00:00'),
(46, 1, 5, 'Level1', 1, 'Psychology', '', '<p>________ stressed the concepts of compensation and over compensation, the pursuit of activities designed to make up for or to overcome inferiority.</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:38:04', '0000-00-00 00:00:00'),
(47, 1, 5, 'Level1', 1, 'Psychology', '', '<p>The MMPI (Minnesota Multiphasic Personality Inventory) is an objective type of test with __________.</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:38:33', '0000-00-00 00:00:00'),
(48, 1, 5, 'Level1', 1, 'Psychology', '', '<p>________self-actualization theory stresses the positive tendency to fulfill one basic potentiality.</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:39:28', '0000-00-00 00:00:00'),
(49, 1, 5, 'Level1', 1, 'Psychology', '', '<p>The ________ is working &lsquo;in the service of the reality principle&rsquo;, according to Freud.</p>\r\n', '', '', '', '1', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:40:46', '0000-00-00 00:00:00'),
(50, 1, 5, 'Level1', 1, 'Psychology', '', '<p>MMPI (Minnesota Multiphasic Personality Inventory) is a __________.</p>\r\n', '', '', '', '3', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:41:26', '0000-00-00 00:00:00'),
(51, 1, 5, 'Level1', 1, 'Psychology', '', '<p>The ______ approach in study of personality emphasizes motivational factors and the lively interplay of various components of personality.</p>\r\n', '', '', '', '2', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:42:20', '0000-00-00 00:00:00'),
(52, 1, 5, 'Level1', 1, 'Psychology', '', '<p>Who is the author of Feminine Psychology?</p>\r\n', '', '', '', '1', ' ', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 17:42:47', '0000-00-00 00:00:00'),
(59, 1, 5, 'Level1', 1, 'Psychology', '', 'Rating scales, in comparison to intervely __________.', 'images/test.jpg', '', '', '2', 'Test', 'images/test.docx', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/H7T3LiKSEJ4\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 18:54:18', '0000-00-00 00:00:00'),
(60, 1, 5, 'Level1', 1, 'Psychology', '', 'The early psycho-sexual stages of development are the oral, the anal and the ', 'images/test.jpg', '', '', '4', 'Test', 'images/test.docx', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/H7T3LiKSEJ4\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(61, 1, 5, 'Level1', 1, 'Psychology', '', '_______ believed that much of our cultural heritage viz, literature, music, art is the product of sublimation.', 'images/test.jpg', '', '', '1', 'Test', 'images/test.docx', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/H7T3LiKSEJ4\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(62, 1, 5, 'Level1', 1, 'Psychology', '', 'Honesty is tested by __________.', 'images/test.jpg', '', '', '1', 'Test', 'images/test.docx', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/H7T3LiKSEJ4\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 18:54:19', '0000-00-00 00:00:00'),
(63, 1, 5, 'Level1', 1, 'Psychology', '', 'Attitudes, feelings, perceptions and evaluations of self as an object constitute the_________ of a person. ', 'images/test.jpg', '', '', '2', 'Test', 'images/test.docx', '<iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/H7T3LiKSEJ4\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 18:54:20', '0000-00-00 00:00:00'),
(64, 1, 5, 'Level1', 1, 'Psychology', '', '_______ theories of personality are concerned with the individual’s personal view of the world, his self-concept and his push toward growth or self-actualization.', 'images/test.jpg', '', '', '', '', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:63.0) Gecko/20100101 Firefox/63.0', '2018-12-02 18:54:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `questiontype`
--

CREATE TABLE `questiontype` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questiontype`
--

INSERT INTO `questiontype` (`id`, `user_id`, `name`, `status`, `ip`, `user_agent`, `date_added`, `date_modify`) VALUES
(1, 1, 'Image', 1, '', '', '2018-08-04 06:59:47', '0000-00-00 00:00:00'),
(2, 1, 'Multiple Question ', 1, '', '', '2018-08-04 06:59:57', '0000-00-00 00:00:00'),
(3, 1, 'Match Making', 1, '', '', '2018-08-04 07:00:08', '0000-00-00 00:00:00'),
(4, 1, 'True False', 1, '', '', '2018-08-04 07:00:16', '0000-00-00 00:00:00'),
(5, 1, 'Descriptive', 1, '', '', '2018-08-04 07:00:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sampleflat`
--

CREATE TABLE `sampleflat` (
  `id` int(11) NOT NULL,
  `home` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` varchar(400) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `conperson` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `mobile1` varchar(15) NOT NULL,
  `who` varchar(255) NOT NULL,
  `know` varchar(255) NOT NULL,
  `intern` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mpassword` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `educationalqualification` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `regcount` int(11) DEFAULT NULL,
  `school_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`category_id`, `name`, `image`, `email`, `conperson`, `mobile`, `mobile1`, `who`, `know`, `intern`, `password`, `mpassword`, `address`, `educationalqualification`, `date_added`, `date_modify`, `status`, `ordernum`, `regcount`, `school_type`) VALUES
(2, 'Avinash Bhutani', '', 'bhutani302@gmail.com', 'Avinash Bhutani', '8708388722', '7206793191', 'principal', '', '', '80a95aaefb314a54b54e6f7379f19e54', 'pizzakibaatmatmaro', '<p>IIT Delhi</p>', '', '2018-12-14 12:20:32', '2019-01-23 14:51:33', 1, 1, 0, 0),
(6, 'Budding Minds International School', '', 'bmis@buddingminds.net', 'Anuradha P', '-9840391724', '+91- 96771 1151', 'principal', '', '', '81dc9bdb52d04dc20036dbd8313ed055', '1234', '<p>Sri Annamachari Street, _x000D_ M.S.Subbulakshmi Nagar,_x000D_ Manimangalam&Atilde;&cent;&acirc;&sbquo;&not;&acirc;&euro;&oelig; 601301.</p>\r\n', '', '2018-12-14 12:20:32', '2019-01-23 18:06:51', 1, 2, 0, 0),
(7, ' UNITED SCHOOL, VASAD', '', 'united_vasad123@yahoo.com', 'Miria Sebastian', '(02692) 274511', '7574835546', 'principal', '', '', 'e10adc3949ba59abbe56e057f20f883e', '1234', 'Address: BH. Sardar patel vinay mandir high school_x000D_\nPO: VASAD,388306_x000D_\nDIST: ANAND_x000D_\nSTATE: GUJARAT', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 3, 0, 0),
(9, 'MBS INTERNATIONAL SCHOOL', '', 'readisha@gmail.com', 'ATUL WADHAWAN', '9968239568', '1145312000', 'principal', '', '', 'e10adc3949ba59abbe56e057f20f883e', '1234', 'SECTOR - 11, DWARKA, NEW DELHI- 110075_x000D_\n', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 4, 0, 0),
(11, 'Prudential Academy', '', 'vivekmittal04@gmail.com', 'Vivek Mittal', '9818033350', '9958326292', 'principal', '', '', '427739ccaaa12a30fb11c69ff3ed3a3b', 'isco_2k18_9511', '61 jagriti enclave near Karkardooma Metro station delhi', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 5, 0, 0),
(15, 'St Mary&lsquo;s Egnlish Medium School', '', 'stmarys_s@yahoo.in', 'Myrtle L F Lewis', '9448501249', '9481509322', 'principal', '', '', '426fc5101999b5d4b46b587be0361bdc', 'united@intellify', '6th Cross, Balaji Layout, Kannarpady, Udupi District, Karnataka State - 576103', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 6, 0, 0),
(17, 'Krishna Public School', '', 'kps.bhilai@gmail.com', 'Sabita Tripathi', '7882292715', '8461978075', 'principal', '', '', '0959c7480f1fb0fb2c4658e098d35810', 'mbs@intellify', 'Krishna Public School, Nehru Nagar, Bhilai_x000D_\nPin Code - 490020', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 7, 0, 0),
(19, 'Andishmand Farda', '', 'math.home.of.tehran@gmail.com', 'Reza Haghi', '982166430017', '989122393525', 'principal', '', '', '0fa2bf963996328b911c2c9e672cf487', 'arlene-777', 'No.250,Dr. Fatemi St., Tehran, Iran', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 8, 0, 0),
(20, 'Sarvodaya Kanya Vidyalaya ', '', 'Aanchal.sharma2017@teachforindia.org', 'Aanchal sharma ', '8219973671', '701828422', 'principal', '', '', '818637008bdfc3a60cea7678bcbebad8', 'mit101', 'J block, Sangam Vihar, New Delhi, 110080', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 9, 0, 0),
(21, 'Rani Chenemma SKV ', '', 'Jasleen.kaur2018@teachforindia.org', 'Jasleen Kaur', '8860073107', 'Not Available', 'principal', '', '', 'a5c522823970f24f5741cbcc0e912040', 'bindhu#1980', 'Jahangirpuri D-Block', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 10, 0, 0),
(22, 'RANI CHENNAMMA GOVT GIRLS SR SEC SCHOOL', '', 'Aashish7verma@gmail.com', 'Aashish Verma', '9711777957', 'Not Available', 'principal', '', '', '6c77b20a04aabb827ec4d91b7937b0de', 'vldk1975', 'D BLOCK JAHANGIR PURI DELHI - 110033', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 11, 0, 0),
(23, 'Gangotri Public School', '', 'Divyangna.s2017@teachforindia.org', 'Divyangna', '9646541636', 'Not Available', 'principal', '', '', 'd352207ce2fa243217287028954afac3', 'navdivpriya', 'L-24, Fateh Singh Marg, Gautam Vihar, Delhi', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 12, 0, 0),
(24, 'mehrauli kothi kale school ', '', 'srishti.c2017@teachforindia.org', 'Srishti chauhan', '9971408742', 'NA', 'principal', '', '', '354696898536312c465fba2a2ca39308', 'Mary@123', 'MCD kothi kale khan, ward no.2, near valmiki mandir, Mehrauli', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 13, 0, 0),
(25, 'Government Girls Senior Secondary School No. 2', '', 'abhijit.singh2018@teachforindia.org', 'Abhijit Singh', '9811145410', '9041400463', 'principal', '', '', 'a4c47b7035f0de6c8b217e784a0b160e', 'sonia', 'Tughlaqabad Railway Colony, Delhi', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 14, 0, 0),
(26, 'CHENNAI MIDDLE SCHOOL MGR NAGAR 2', '', 'ramalingam.n2017@teachforindia.org', 'Ramalingam Natarajan', '9840663337', '99406 15213', 'principal', '', '', 'f79103542dc36fc24aedecacfd6de552', 'kpsbhilai', '13 Kamarajar street , MGR Nagar, chennai 600078', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 15, 0, 0),
(27, 'CPS Goyathope', '', 'varun.d2017@teachforindia.org', 'Varun V. Deshpande', '9404291969', 'Not Available', 'principal', '', '', '6bad38e7efd5dffd3b1ff2405ee5d912', 'L5!3qof4bxB', '25 Nagapaan(M) street, Pudupet Chennai', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 16, 0, 0),
(28, 'Sarvodaya Kanya Vidyalaya', '', 'prerna.c2017@teachforindia.org', 'Prerna ', '8447467085', '8722728721', 'principal', '', '', '545ead8da4644ca6e3c63bcb5c2f3010', 'intellify2018', 'SKV, J Block, Sangam Vihar, 110080', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 17, 0, 0),
(29, 'Sarvodaya Bal Vidyalaya Mori Gate No. 1', '', 'akshay.wadhwa2017@teachforindia.com', 'Akshay Wadhwa', '8588057692', '7066207374', 'principal', '', '', 'c88b4cf514b3a5fb0784e4f003d8828b', 'isco_2k18_826', 'Mori Gate, Delhi', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 18, 0, 0),
(30, 'Sarvodhaya Kanya Vidhyala,No - 2,Mehrauli', '', 'saini.sneha97@gmail.com', 'Sneha Saini', '9555580739', '8750399471', 'principal', '', '', 'f20a4d8179dee512fd5a89a207b5a911', 'isco_2k18_169', 'Sarvodhaya Kanya Vidhyala,No - 2,Mehrauli,,New Delhi', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 19, 0, 0),
(31, 'CPS Velachery ', '', 'adelene.n2017@teachforindia.org', 'Adelene ', '8220838211', 'Not Available', 'principal', '', '', 'bd61a0538750568ef08c2d1b4b24136b', 'isco_2k18_810', 'Rajalakshmi nagar 2nd main road Velachery Chennai 42', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 20, 0, 0),
(32, 'CHSS KOYAMBEDU', '', 'saravanan.bharathy2018@teachforindia.org', 'Saravanan Bharathy', '7708835861', '9894622574', 'principal', '', '', 'fd2368fce6c398f5df48ee47fbc634f4', 'isco_2k18_165', 'CHSS Koyambedu, School street, Koyambedu, Chennai - 600107', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 21, 0, 0),
(33, 'CHSS Puliyur', '', 'najwa.maqbool2018@teachforindia.org', 'Najwa Maqbool', '9940025455', '9940024155', 'principal', '', '', '6c2d4c6d59193687f1878f8c33aa44b2', 'isco_2k18_220', 'Arcot Road, Kodambakkam, Chennai - 600024, Opposite Padmaram Kalyana Mandapam, Puliyur', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 22, 0, 0),
(34, 'Govt. Girl&lsquo;s Senior Secondary School', '', 'dilsheen.sahni2018@teachforindia.org', 'Dilsheen Kaur Sahni', '9711228894', '8368814769', 'principal', '', '', '3bc6503cfd738bfd15c561931147b2c9', 'isco_2k18_621', ' Azadpur Colony', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 23, 0, 0),
(35, 'Government Girls Senior Secondary School', '', 'sharanya.s2017@teachforindia.org', 'Sharanya Sharma', '9899619640', '9557332920', 'principal', '', '', 'ea17183aa3a5fa2ce916bf85dab7a3f2', 'isco_2k18_969', 'Chabi Ganj, Kashmere Gate, Delhi-110088', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 24, 0, 0),
(36, 'Government Girls Senior Secondary School', '', 'shrutika.s2017@teachforindia.org', 'Shrutika Silswal', '9557332920', '9899619640', 'principal', '', '', 'bcf456c1f4758ff0624417e7089c5196', 'isco_2k18_344', 'Chabi Ganj, Kashmere Gate, Delhi-110006', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 25, 0, 0),
(37, 'CPS Rangarajapuram', '', 'abigail.r2017@teachforindia.org', 'Abigail Rabindran', '9910903399', '8383910332', 'principal', '', '', '04e51d2b3c70f003f584ea9dfb95c12c', 'isco_2k18_762', 'Chennai Primary school, Rangarajapuram Main Road, Rangarajapuram, Kodambakkam, Chennai - 600024', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 26, 0, 0),
(38, 'S.K.V Ayanagar', '', 'nidhi.m2017@teachforindia.org', 'Nidhi Manchanda', '9873682991', '8168784645', 'principal', '', '', 'a2a4cd8939c1f623a993495a2f7cdbc2', 'isco_2k18_985', 'Sarvodya Kanya Vidyalya , Ayanagar (New Delhi)', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 27, 0, 0),
(39, 'Government Girls Senior Secondary School, Azadpur Colony', '', 'shruti.b2017@teachforindia.org', 'Shruti Bhat', '9818680401', '9811004140', 'principal', '', '', '916190c495fc066ec9cbbd7747666ee3', 'isco_2k18_747', 'Azadpur Colony, Delhi - 110033', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 28, 0, 0),
(40, 'SBV A BLOCK VIKASPURI', '', 'rubina.b2017@teachforindia.org', 'RUBINA BHARDWAJ', '8447662771', 'Not Available', 'principal', '', '', 'e696ac84535ab0ef5a5ab46f6d432551', 'isco_2k18_450', 'SBV A BLOCK VIKASPURI NEAR POLICE STATION NEW DELHI 110018', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 29, 0, 0),
(41, 'Yogaway public school', '', 'Vikash.pandey2018@teachforindia.org', 'Vikash Pandey', '9643144877', 'Not Available', 'principal', '', '', 'f80f37f53b7e8e1330dae131a0ec8d20', 'isco_2k18_733', 'Ram nagar extension ', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 30, 0, 0),
(42, 'SKV No.1 (CR DASS), New Seelampur', '', 'anisha.jain2018@teachforindia.org', 'Anisha Jain', '9773921769', 'Not Available', 'principal', '', '', 'b84e1597bd13fc42ddbfaae651757e82', 'isco_2k18_755', 'J432, New Seelampur, Shahdara, New Seelampur, Shahdara, Delhi, 110053', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 31, 0, 0),
(43, 'Sarvodaya kanya vidhyalaya', '', 'himansha.kharbanda2018@teachforindia.org', 'Himansha kharbanda', '8826102056', '9899936904', 'principal', '', '', '20cb811dc1d324e1295ea52329ca38dc', 'isco_2k18_130', 'A block vikas puri', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 32, 0, 0),
(44, 'CHS Kottur', '', 'kesava.j2018@teachforindia.org', 'Krupakaran', '9894847772', 'Not Available', 'principal', '', '', '2804a2baf83d6087a9e27b094e9ae081', 'isco_2k18_720', 'CHS Kottur, New Street, Kotturpuram, Chennai 85', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 33, 0, 0),
(45, 'Govt girls senior secondary school Azadpur colony ', '', 'Gurmehar.kaur2018@teachforindia.org', 'Gurmehar Kaur ', '9999041714', 'Not Available', 'principal', '', '', '258612a4286c24b54be7234e7b4dc2cf', 'isco_2k18_234', 'Azadpur colony Delhi 110033', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 34, 0, 0),
(46, 'Sarvodaya Co-Ed Senior Secondary school Mashjid moth', '', 'prabhat.ranjan2018@teachforindia.org', 'Prabhat Ranjan', '7760000244', 'Not Available', 'principal', '', '', '39b87112ef76d266c2ecfdd8b4554a9c', 'isco_2k18_855', 'Sarvodaya Co-Ed Senior Secondary school Mashjid moth, Lila Ram market Guneet Kashyap Marg, Masjid moth village South extension II New Delhi 110049', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 35, 0, 0),
(47, 'Sarvodaya co-ed  senior secondary school mashjid moth', '', 'nabeela.nasar2017@teachforindia.org', 'Nabeela Nasar', '77617876922', 'Not Available', 'principal', '', '', '21e8e8fd847ad473e021bc15bd1d3aed', 'isco_2k18_269', 'Sarvodaya co-ed  senior secondary school mashjid moth, Lila Ram market Guneet Kashyab marg Road, mashjid Moth Village south ex II New Delhi 110049', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 36, 0, 0),
(48, 'Sarvodaya Kanya Vidyalaya', '', 'shruti.f2017@teachforindia.org', 'Shruti Fauzdar', '9599615621', 'Not Available', 'principal', '', '', 'd54bd0257b54e61a7892e84e69ae758a', 'isco_2k18_77', 'Adarshnagar', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 37, 0, 0),
(49, 'Government Girls Senior Secondary School No. 2', '', 'girik.gupta2018@teachforindia.org', 'Girik Gupta', '7899188013', 'Not Available', 'principal', '', '', 'e2680870b46d0eb0cf75c085e5d72de8', 'isco_2k18_726', 'Government Girls Senior Secondary School No. 2, Tughlakabad Extension, New Delhi', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 38, 0, 0),
(50, 'Janakpuri C Block Govt. Boys Senior Secondary School', '', 'shivani.bobal2017@teachforindia.org', 'Shivani Bobal', '9811110652', 'Not Available', 'principal', '', '', '0631785c4bbacf8e2685bb1a26cc7a93', 'isco_2k18_211', 'Janakpuri C Block ,New Delhi', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 39, 0, 0),
(51, 'Govt. Boys Sen. Sec., Saket G Block', '', 'Shahnawaz.khan2018@teachforindia.org', 'Shahnawaz Ahmed Khan', '7981340921', 'Not Available', 'principal', '', '', 'e0f6a14a9ae75da823b6fac231415271', 'isco_2k18_968', 'Saket G block new delhi', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 40, 0, 0),
(52, 'SBV, Vikaspuri A Block', '', 'ritika.s2017@teachforindia.org', 'Ritika Singla', '7838971974', '8447140353', 'principal', '', '', '288b2cbc471b72c1dbb2b9814426df85', 'isco_2k18_249', 'SBV, Vikaspuri A Block New Delhi-110018', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 41, 0, 0),
(53, 'Government Girls Senior Secondary School No. 2 , Sector 4, Ambedkar Nagar', '', 'sonu.janewa.2018@teachforindia.org', 'Sonu Janewa', '7988487278', '8901157226', 'principal', '', '', '2adaad82b52f0d886256ced26e03a79c', 'isco_2k18_86', ' Government Girls Senior Secondary School No. 2 , Sector 4, Ambedkar Nagar Pin- 110062 ,(Pili Building School, Madangir,)', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 42, 0, 0),
(54, 'GGSSS No. 2, Sector 4, Ambedkar Nagar, New Delhi', '', 'sonu.janewa2018@teachforindia.org', 'Sonu Janewa', '7988487278', '8901157226', 'principal', '', '', 'e6d9c5a651e4ec3028f97f9b8bab52a5', 'isco_2k18_359', 'Government Girls Senior Secondary School No. 2, Sector 4, Ambedkar Nagar, New Delhi (110062), (Pili Building school, Madangir)', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 43, 0, 0),
(55, 'Sarvodya Kanya Vidyalaya', '', 'piyush.narang2018@gmail.com', 'Piyush Narang', '9860144173', 'Not Available', 'principal', '', '', '487a599f20c4afa0142eb706aecf9424', 'isco_2k18_291', 'Aya Nagar', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 44, 0, 0),
(56, 'Sarvodaya Kanya Vidyalaya, Aya nagar', '', 'sneha.t2017@teachforindia.org', 'Sneha Trivedi', '9815185666', 'Not Available', 'principal', '', '', '4db3ffc6408c56d68338ccaf52727bee', 'isco_2k18_797', 'Aya nagar main road', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 45, 0, 0),
(57, 'GGSSS', '', 'rituparnna.mishra2018@teachforindia.org', 'Rituparnna Mishra', '8895040577', '7008302387', 'principal', '', '', 'c362432af5787af80706496a1e03c8c8', 'isco_2k18_950', 'Sangam vihar, block-C', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 46, 0, 0),
(58, 'GBSSS ', '', 'Ravinder.sd2017@teachforindia.org', 'Ravinder Dahiya ', '9560833755', 'Not Available', 'principal', '', '', 'b4b63c9813d971e9b6fad0d33fbd59f6', 'isco_2k18_110', 'G-block, Saket ', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 47, 0, 0),
(59, 'Aryan Public School', '', 'prashant.s2017@teachforindia.org', 'Prashant Sarbahi', '9717006361', 'Not Available', 'principal', '', '', '4fa3e640be0c4deb0ecf6ab747a01434', 'isco_2k18_915', 'CALL DIRECTIONS SAVE WEBSITE Main Road Brahmpuri, Near Gonda Chowk, Brahampuri Rd, New Seelampur, Shahdara, Delhi, 110053', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 48, 0, 0),
(60, 'GBSSS, Khanpur No.1', '', 'debesh.dm2017@teachforindia.org', 'Debesh Daulat Mohanty', '8826050288', 'Not Available', 'principal', '', '', '7cda85b467736ec8e3de1996a5b82cd9', 'isco_2k18_332', 'Khanpur No.1, New Delhi-110060', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 49, 0, 0),
(61, 'CHSS Koyambedu', '', 'Sabarish.s2017@teachforindia.org', 'Sabarish Shankar', '9810461613', '9810461613', 'principal', '', '', '58f4d330976794a7bf6d2e570251903d', 'isco_2k18_411', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 50, 0, 0),
(62, 'CMS MMDA 1', '', 'baiju.nair2017@teachforindia.org', 'Baiju K Nair', '9328014526', '9328014526', 'principal', '', '', '0b3c15f2b6f0361abe3520af549ada30', 'isco_2k18_803', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 51, 0, 0),
(63, 'CMS MMDA 1', '', 'priyanga.b2017@teachforindia.org', 'priyanga B', '9500525544', '9500525544', 'principal', '', '', 'ed1f68ef8f6d8d4d1f7e0c4c3b422190', 'isco_2k18_377', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 52, 0, 0),
(64, 'CMS MMDA 1', '', 'ananya.u2017@teachforindia.org', 'Ananya Upadhyay', '9939327612', '9939327612', 'principal', '', '', 'dbaa0483df0c398c8602567c8807def0', 'isco_2k18_994', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 53, 0, 0),
(65, 'CHS Kottur', '', 'lokeshwaran.n2017@teachforindia.org', 'Lokeshwaran Nagaraj', '9094087557', '9094087557', 'principal', '', '', 'a51db6ec2be1560dff9a4bd64d4c1fee', 'isco_2k18_398', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 54, 0, 0),
(66, 'CHSS Taramani ', '', 'prasanya.pt2017@teachforindia.org', 'Prasanya Padmasha T ', '9790165063', '9790165063', 'principal', '', '', '2394f4df1fcbafef8eb02c6cdb8510dc', 'isco_2k18_512', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 55, 0, 0),
(67, 'CHSS Taramani', '', 'harini.rk2017@teachforindia.org', 'Harini R', '9940450930', '9940450930', 'principal', '', '', '39a2d53f9e2db3aaa9e1a88d9d722ffe', 'isco_2k18_714', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 56, 0, 0),
(68, 'Vidhyaneketan ', '', 'Mohan.kumar2017@teachforindia.org', 'Mohan Kumar. M', '9500170332', '9500170332', 'principal', '', '', '4cb3d790252728ac0edc0b38e63d8732', 'isco_2k18_141', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 57, 0, 0),
(69, 'CMS MGR NAGAR', '', 'shreeya.2017@teachforindia.org', 'Shreeya', '9789069195', '9789069195', 'principal', '', '', '3d87e30b94a812fd4c4250f652a8188f', 'isco_2k18_39', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 58, 0, 0),
(70, 'CMS Arumbakkam', '', 'harshitha.m2017@teachforindia.org', 'Harshitha Murali', '9677263943', '9677263943', 'principal', '', '', '2d858baf80f577608342c8c45411c534', 'isco_2k18_46', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 59, 0, 0),
(71, 'CHSS Taramani ', '', 'balasubramanian2018@teachforindia.org', 'Balasubramanian.T', '9566173747', '9566173747', 'principal', '', '', '67c5a6795882eba9d0c54f2bc890309f', 'isco_2k18_25', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 60, 0, 0),
(72, 'Vidyaniketan', '', 'shruthi.ramesh2018@teachforindia.org', 'Shruthi Ramesh', '8754442540', '8754442540', 'principal', '', '', 'f3ebf2aa355b68f1b23c135391dca9b2', 'isco_2k18_967', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 61, 0, 0),
(73, 'CMS MMDA-1 ', '', 'deepthi.sunny2018@teachforindia.org', 'Deepthi Maria Sunny ', '9445686290', '9445686290', 'principal', '', '', '137ef201c11f5f8f34d91735c3869b34', 'isco_2k18_114', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 62, 0, 0),
(74, 'CHS KOTTUR', '', 'shrestha.satpathy2018@teachforindia.org', 'shrestha Satpathy ', '9437375866', '9437375866', 'principal', '', '', 'bd218d8f227bdb7ffa1993b747a54f0a', 'isco_2k18_577', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 63, 0, 0),
(75, 'CMS Arumbakkam', '', 'semala.devi2018@teachforindia.org', 'Semala Devi', '9489337110', '9489337110', 'principal', '', '', 'afc82ec538bf78cfc3664adb88f6905f', 'isco_2k18_270', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 64, 34, 0),
(76, 'CMS Arumbakkam', '', 'varshith.c2018@teachforindia.org', 'Varshith Chakrapani', '9790855581', '9790855581', 'principal', '', '', '753277b0d2629f14b56a7447f7e7b08a', 'isco_2k18_228', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 65, 0, 0),
(77, 'CHSS Thiruvanmiyur', '', 'anjali.g2017@teachforindia.org', 'Anjali Govindankutty', '9597967027', '9597967027', 'principal', '', '', '74ca08c975e44c08b6539ad420c76519', 'isco_2k18_965', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 66, 0, 0),
(78, 'CHSS Koyambedu', '', 'anantharaman.g2018@teachforindia.org', 'Anantharaman G', '8111920207', '8111920207', 'principal', '', '', 'ba7792b426d0d27396427b44bff26b0f', 'isco_2k18_345', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 67, 0, 0),
(79, 'CHSS Puliyur', '', 'reslee.v2017@teachforindia.org', 'Reslee Elsa Varghese', '9790780591', '9790780591', 'principal', '', '', '968212690bb350b3d958fc76615e7e2c', 'isco_2k18_79', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 68, 0, 0),
(80, 'CHSS Puliyur', '', 'vani.b2018@teachforindia.org', 'Vani Balasubramaniam', '8390533699', '8390533699', 'principal', '', '', '372f7d65a10a52b87d047b711430c8b2', 'isco_2k18_654', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 69, 0, 0),
(81, 'CPS Thiruvanmiyur', '', 'sruti.srinivasan2018@teachforindia.org', 'Sruti Srinivasan', '8939969125', '8939969125', 'principal', '', '', '5ba8ef4a6ffb6552adca38d7938722e7', 'isco_2k18_80', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 70, 0, 0),
(82, 'CHSS, Taramani', '', 'sankirtana.t2018@teachforindia.org', 'Sankirtana Kumar', '9444742505', '9444742505', 'principal', '', '', '9ea13a5feef4577e3b18b2ea6ac3a728', 'isco_2k18_50', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 71, 0, 0),
(83, 'CHSS, Taramani', '', 'bharadhwaaj.l2018@teachforindia.org', 'Bharadhwaaj L', '7338885010', '7338885010', 'principal', '', '', '2cf7589146d467b0a0b5962d2fedf7a4', 'isco_2k18_563', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 72, 0, 0),
(84, 'Vidyaniketan M. H. S. S.', '', 'niranjana.s2017@teachforindia.org', 'Niranjana', '8939363818', '8939363818', 'principal', '', '', '0bcc6d7c6b2eb5f2a96d773a02221fb0', 'isco_2k18_434', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 73, 0, 0),
(85, 'Vidyaniketan M. H. S. S.', '', 'lavanyaa.kanagavel2018@teachforindia.org', 'Lavanyaa Kanagavel', '7339483339', '7339483339', 'principal', '', '', '5b42299a79c80290ff15f8af7dee64cc', 'isco_2k18_962', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 74, 0, 0),
(86, 'Vidyaniketan M. H. S. S.', '', 'thasneem.fjk2016@teachforindia.org', 'Thasneem Fathima', '9791059343', '9791059343', 'principal', '', '', '7176448edc48a59fee6ecf938155a8b8', 'isco_2k18_212', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 75, 0, 0),
(87, 'Vidyaniketan M.H.S.S', '', 'saravanan.kr2017@teachforindia.org', 'Saravanan KR', '7666663112', '7666663112', 'principal', '', '', '2a2daf8bbd8661b1da7019e4c7bc4607', 'isco_2k18_518', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 76, 0, 0),
(88, 'CHSS Puliyur', '', 'b.hari.prasad2018@teachforindia.org', 'B Hari Prasad', '9766737165', '9766737165', 'principal', '', '', '692f4e5b8bd2ab2846ce160effda709a', 'isco_2k18_349', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 77, 0, 0),
(89, 'CHSS TH road', '', 'ashwin.m2017@teachforindia.org', 'Ashwin Muthamizhselvan', '9976912014', '9976912014', 'principal', '', '', '3e8ad0faa4d36281d96c7450d507cd8d', 'isco_2k18_526', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 78, 0, 0),
(90, 'ECI Tondiarpet', '', 'shyam.pt2017@teachforindia.org', 'Shyam Prasanth T', '9581044474', '9581044474', 'principal', '', '', 'f254db46f60a206f056fea007bd56395', 'isco_2k18_306', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 79, 0, 0),
(91, 'CHS McNichols', '', 'krithi.c2018@teachforindia.org', 'Krithi Chulliparambil Mohan', '9790938182', '9790938182', 'principal', '', '', '5b4afcdfbaff01b5bcf72db8ba0264c8', 'isco_2k18_584', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 80, 0, 0),
(92, 'CHS Kottur', '', 'sathyan.d2017@teachforindia.org', 'Sathyan Devakannan', '9940983049', '9940983049', 'principal', '', '', '285e226b741e582b182f8b3bac1086bb', 'isco_2k18_634', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 81, 0, 0),
(93, 'CPS JONE&lsquo;S ROAD', '', 'desmona.d2017@teachforindia.org', 'Desmona de Melo', '8220620644', '8220620644', 'principal', '', '', '37a1abe87d0cea6826d624f901fbada6', 'isco_2k18_378', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 82, 0, 0),
(94, 'CPS McNichols Road', '', 'madhavi.n2017@teachforindia.org', 'Madhavi Narayanan', '9884611605', '9884611605', 'principal', '', '', '137ef201c11f5f8f34d91735c3869b34', 'isco_2k18_114', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 83, 0, 0),
(95, 'CPS Jones Road', '', 'shyam.k2017@teachforindia.org', 'Shyam Krishnan ', '7550108953', '7550108953', 'principal', '', '', 'd8378d52abd1d57ca38f134f6ee5a2a2', 'isco_2k18_588', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 84, 0, 0),
(96, 'CPS TV Samy', '', 'Keertheesh.m2017@teachforindia.org', 'Keertheesh', '8778942100', '8778942100', 'principal', '', '', '98a44a0796a523653912b4a306daf6bb', 'isco_2k18_540', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 85, 0, 0),
(97, 'CPS TV Samy', '', 'Ravi.v2017@teachforindia.org', 'Ravi', '9566522515', '9566522515', 'principal', '', '', '1b090892a871100026120dba3a10cc94', 'isco_2k18_224', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 86, 0, 0),
(98, 'CPS TV Samy', '', 'Palak.dhawan2018@teachforindia.org', 'Palak', '8197897877', '8197897877', 'principal', '', '', '5fb2aad76f3bdf772ad60f4d9a712222', 'isco_2k18_322', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 87, 0, 0),
(99, 'CHS TV Samy', '', 'Akshay.v@teachforindia.org', 'Akshay', '9043225224', '9043225224', 'principal', '', '', '677ecddce02422790c8f19370cf82ef5', 'isco_2k18_465', 'Not Given', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 88, 0, 0),
(112, 'Rani Chennemma Rajkiya sarvodya Kanya Vidalaya, D block, Jahangir puri', '', 'aashish.verma2018@teachforindia.org', 'Aashish Verma', '011-27635501', '011-27635502', 'principal', '', '', 'd82b69ecfe968cad9d7435981d86a2d1', 'isco_2k18_109', 'Near Kushal Cinema, D block jahangirpuri, Delhi - 110033 ', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 89, 0, 0),
(5, 'Sir CV Raman Central School', '', 'as11abhishekyadav15@gmail.com', 'Abhishek Yadav', '9810152116', '9810152116', 'student', '', '', 'a1c848a363df0e8873352549bee71484', 'isco_2k18_689', 'Vill-Matihanwa, Tola- Sukhrampur', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 90, 0, 0),
(10, 'United school ', '', 'revapdesai@gmail.com', 'Arlene Alistair Desai ', '2692274511', '2692274511', 'student', '', '', 'ad65caffcf548a8845850c8c4da9da4e', 'isco_2k18_261', 'Vasad, district Anand-388306', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 91, 0, 0),
(13, 'Summerfield Residential&DaySchool ', '', 'vsn351975@gmail.com', 'Devanshi Negi', '01360-250268', '01360-250268', 'student', '', '', 'ec8b1ecbc3baf6a94f9b2020af63ec0c', 'isco_2k18_682', 'EdonBagh, WestHopeTown, Herbertpur, Distt-Dehradun', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 92, 0, 0),
(18, 'Maggieved', '', 'xvkjhon@brinkvideo.win', 'Maggieved', '86894348189', '83274637652', 'student', '', '', '7f7ab4861ae3208a77c1ebf57d014b62', 'isco_2k18_119', '', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 94, 0, 0),
(101, 'VIDYODAYA PU COLLEGE', '', 'adityaadiga6@gmail.com', 'Aditya Adiga', '8202531021', '9448000534', 'student', '', '', 'edf77961035b873fc4ccb9e99f40b4c5', 'isco_2k18_937', 'Vidyodaya pu college,Maruthi Veethika, Udupi, Karnataka 576101_x000D_\n', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 95, 0, 0),
(103, 'Dayanand Anglo Vedic Public school ', '', 'kavita19121992sharma@gmail.com', 'Madhvi Sharma', '7442405992', '9414392672', 'student', '', '', '1529d2e027884c4ff58dc974b77c23b2', 'isco_2k18_670', 'DAV Public School, Talwandi, Sector C  324005, Kota, Rajasthan,India', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 96, 0, 0),
(105, 'Dr.Virendra Swarup Education Centre', '', 'agarwalaryan139@gmail.com', 'Aryan Agarwal', '5122641352', '5122641353', 'student', '', '', '2fb20051cd3c3abb1859979c591fc101', 'isco_2k18_953', '435-A Kidwai Nagar Kanpur', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 97, 0, 0),
(106, 'St.andrews scots sr. Sec.school', '', 'jainsachin6833@gmail.com', 'Vidit jain', '011-22241167', '011-22231023', 'student', '', '', '7dec7cec239608c5e26731ff957832d0', 'atikruti', '9th avenue,patparganj, I.P extension _x000D_\nDelhi -110092', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 98, 0, 0),
(108, 'Fxxcbjkkgggbhfff', '', 'ritu.mittal3dfgg5@gmail.com', 'ADGNKUGVF', '8587863288', '8442688865', 'student', '', '', 'a02c1c9d16dae8c4f5ee52960d87651f', 'adi99theflameofthegame', 'Gdxvjyeschjkbcfgg', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 99, 0, 0),
(123, 'AChicehepFease', '', 'oshaewooze@fastmailforyou.net', 'AChicehepFease', '88395853488', '86379194875', 'student', '', '', 'eed68cab27be7985f67ddcd666d40dba', 'inspiringteacher', 'https://www.cialispascherfr24.com/prix-du-cialis-en-suisse/_x000D_\n', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 100, 0, 0),
(127, 'KIDDYS CORNER HIGH SCHOOL', '', 'harshshrivastava252@gmail.com', 'Harsh Shrivastava ', '7512346093', '2346093', 'student', '', '', '781757f0f1b8848bfc765bc2e2ae6da5', '20012003Ms', 'KIDDYS CORNER HIGH SCHOOL, Thatipur, Gwalior', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 101, 0, 0),
(128, 'Dr.Virendra Swarup Education Centre', '', 'nilaysahu.knp@gmail.com', 'Abhinav sahu', '26413525354', '26413525354', 'student', '', '', '08a20f6e0a222bdb69e05bc0885d62af', 'Aa@9336263037', 'K block kidwai Nagar Kanpur', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 102, 0, 0),
(129, 'Dr Virendra Swarup Education Centre Kidwai Nagar', '', 'devanshthakur688@gmail.com', 'Devansh', '8471234251', '2741536965', 'student', '', '', 'db9e418c7acaeed8b7d2e692d97e8e89', 'vidit123', '127/113Kidwai Nagar Kanpur', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 103, 0, 0),
(3, 'Sir CV Raman Central School', '', 'asa@gmail.com', 'Abhishek Yadav', '9810152116', '9810152116', 'teacher', '', '', 'ad199cbab26bccca075547a721c69c52', 'kush6248', 'Vill-Matihanwa, Tola- Sukhrampur', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 104, 0, 0),
(4, 'Sir CV Raman Central School', '', 'asab@gmail.com', 'Abhishek Yadav', '9810152116', '9810152116', 'teacher', '', '', '00ba4353564367fb4c04709506de31f5', 'stpeters', 'Vill-Matihanwa, Tola- Sukhrampur', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 105, 0, 0),
(12, 'cluny convent high school', '', 'bsbindhubm@gmail.com', 'Bindhu Balamurali', '080-28389725', '9880106057', 'teacher', '', '', '01176b73a5c4b9af5d97279a6f1bba25', 'dpswarangal', 'S.M. Road, Jalahalli Post_x000D_\nBangalore - 560013', '', '2018-12-14 12:20:32', '0000-00-00 00:00:00', 1, 106, 0, 0),
(16, 'Dr. Virendra Swarup Education Centre', '', 'sonia.dhingra2008@gmail.com', 'Sonia Dhingra', '0512-2641352', '0512-2641352', 'teacher', '', '', '767853ea76c3139d7b1145c87b5744af', 'iludad', '435-A, H2 Block, Kidwai Nagar_x000D_\nKanpur-208011_x000D_\n', '', '2018-12-14 12:20:33', '0000-00-00 00:00:00', 1, 107, 0, 0),
(100, 'GGss', '', 'kruti.goyal2018@teachforindia.org', 'Kruti Goyal', '7532022541', '9650478561', 'teacher', '', '', '851ec2e992b4ab38fd45c4b083ea0f39', 'schoolofscholars', 'Ggsss, Azadpur colony ', '', '2018-12-14 12:20:33', '0000-00-00 00:00:00', 1, 108, 0, 0),
(102, 'GOVERNMENT GIRLS SENIOR SECONDARY SCHOOL', '', 'AAKRITI.JINDAL2018@TEACHFORINDIA.ORG', 'AAKRITI JINDAL', '9654012727', '9138323103', 'teacher', '', '', '68856c90365e35e3e8df64cc4e9c3345', 'eqeS606898', 'AZADPUR COLONY', '', '2018-12-14 12:20:33', '0000-00-00 00:00:00', 1, 109, 0, 0),
(109, 'St Peter&lsquo;s Central Public School', '', 'spcpswgl@gmail.com', 'Asra Sultana', '8919019463', '8919019463', 'teacher', '', '', '759c56f2edf02fad1e6c459fb1648cb1', 'harshisco_26653512', 'Near Old Bus Depot,_x000D_\nHanamkonda_x000D_\nWarangal (Urban) Dist: _x000D_\nPIN: 506 001_x000D_\nTelangana State: ', '', '2018-12-14 12:20:33', '0000-00-00 00:00:00', 1, 110, 0, 0),
(110, 'Delhi Public School, Warangal', '', 'malathi.m@dpswarangal.in', 'Malathi', '7780190783', '7780190783', 'teacher', '', '', 'c4a1a08c18d19f29b1312397f9378f16', 'Test 1', '16-30/1, Warangal-Hyderabad Highway, Pedda Pendyal (V), Dharmasagar (M), Warangal (Urban), Telangana 506151', '', '2018-12-14 12:20:33', '0000-00-00 00:00:00', 1, 111, 0, 0),
(121, 'School of Scholars', '', 'krajnekar@gmail.com', 'Kunal Rajnekar', '8007555112', '8007555112', 'teacher', '', '', 'e10adc3949ba59abbe56e057f20f883e', '1234', 'Mouza Nimbora khurd, Near Sipna Engineering college, Badnera Road, Amravati, Maharashtra 444701', '', '2018-12-14 12:20:33', '0000-00-00 00:00:00', 1, 112, 0, 0),
(130, 'My school', '', 'sahilkhan03427@gmail.com', 'Md. Sahil Khan 4', '76552562', '3525235', 'principal', '', 'jhkahdss', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'bfasvfjhhasfkaksj', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 2, 0),
(131, 'Damanpreet', '', 'daman@daman', 'Daman', '1234567890', '1234586666', 'Teacher', '', '', '58ba7dfcfc0718df66e940a9d483b7bc', 'daman', 'B-2', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 1, 0),
(132, 'Dhiraj School of Excellence', '', 'dhiraj@dhiraj', 'dhiraj', '1234567809', '1238840099', 'Teacher', '', '', '432639de2357c9d560a9c3d022d3fc8a', 'dhiraj', 'dhiraj India', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 3, 0),
(133, 'new schkl', '', '1234@1234', 'Damna', '21333', '21333', 'Teacher', '', '', '58ba7dfcfc0718df66e940a9d483b7bc', 'daman', 'djajaa', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0),
(134, 'ddhd', '', 'daman@dama', 'daman', '6588', '6776', 'Teacher', '', '', '13a014cb9de9f7cad88d5dafb70ecb41', 'du', 'xzjjjf', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0),
(135, 'damanpreet singh', '', 'dhiraj@dhiraj.com', 'Dhiraj', '8733276', '6438427', 'principal', '', '', '8a3fe6367c20b583a210179a990e62e5', 'dhirajchhabra', 'jnskhbkdfbkjfbdk', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0),
(136, 'Myhoolasahvjhvj', '', 'mnnnahffhfhjjgjhgja@gmail.c', 'Md.SK', '76552562', '3525235', 'principal', '', '', 'c4ca4238a0b923820dcc509a6f75849b', '1', 'bfasvfjh', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, 0),
(137, 'Gupta\'s School', '', 'neelesh@intellify.in', 'Neelesh Gupta', '7530009223', '7530009223', 'Prin', 'Friends', 'ew', '3fa2b98b664cbe6059c3858ee79495c3', 'Neelesh@123', '<p>IIT Delhi</p>\r\n', '', '2019-05-15 12:21:44', '0000-00-00 00:00:00', 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `schoolclass`
--

CREATE TABLE `schoolclass` (
  `id` int(11) NOT NULL,
  `pid` int(20) NOT NULL,
  `home` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolclass`
--

INSERT INTO `schoolclass` (`id`, `pid`, `home`, `name`, `linkname`, `page_title`, `meta_keyword`, `meta_description`, `image`, `description`, `status`, `date_added`, `date_modify`) VALUES
(4, 0, '1', '5', 'about-us', 'About Us', 'About Us', 'About Us', 'cms/888aboutus.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 1, '2017-10-07 21:00:58', '2018-12-29 01:52:05'),
(5, 0, '0', '6', '', '', '', '', '', '', 1, '2018-11-02 10:48:40', '2018-12-29 01:52:16'),
(6, 0, '0', '7', '', '', '', '', '', '', 1, '2018-12-29 01:52:24', '0000-00-00 00:00:00'),
(7, 0, '0', '8', '', '', '', '', '', '', 1, '2018-12-29 01:52:39', '0000-00-00 00:00:00'),
(6, 0, '0', '9', '', '', '', '', '', '', 1, '2018-12-29 01:52:24', '0000-00-00 00:00:00'),
(6, 0, '0', '10', '', '', '', '', '', '', 1, '2018-12-29 01:52:24', '0000-00-00 00:00:00'),
(6, 0, '0', '11', '', '', '', '', '', '', 1, '2018-12-29 01:52:24', '0000-00-00 00:00:00'),
(6, 0, '0', '12', '', '', '', '', '', '', 1, '2018-12-29 01:52:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `schoollavel`
--

CREATE TABLE `schoollavel` (
  `id` int(11) NOT NULL,
  `pid` int(20) NOT NULL,
  `home` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoollavel`
--

INSERT INTO `schoollavel` (`id`, `pid`, `home`, `name`, `linkname`, `page_title`, `meta_keyword`, `meta_description`, `image`, `description`, `status`, `date_added`, `date_modify`) VALUES
(1, 0, '1', '1', 'about-us', 'About Us', 'About Us', 'About Us', 'cms/888aboutus.jpg', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', 1, '2017-10-07 21:00:58', '2018-12-29 01:52:05'),
(2, 0, '0', '2', '', '', '', '', '', '', 1, '2018-11-02 10:48:40', '2018-12-29 01:52:16'),
(3, 0, '0', '3', '', '', '', '', '', '', 1, '2018-12-29 01:52:24', '0000-00-00 00:00:00'),
(4, 0, '0', '4', '', '', '', '', '', '', 1, '2018-12-29 01:52:39', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `schoollavel_subject`
--

CREATE TABLE `schoollavel_subject` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `schoollavel_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoollavel_subject`
--

INSERT INTO `schoollavel_subject` (`id`, `subject_id`, `schoollavel_id`) VALUES
(3, 1, 4),
(4, 2, 4),
(5, 2, 5),
(8, 5, 4),
(9, 5, 5),
(10, 5, 6),
(11, 5, 7),
(12, 6, 4),
(13, 6, 5),
(14, 6, 6),
(15, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `level` varchar(200) NOT NULL,
  `class` int(11) NOT NULL,
  `registrationno` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `mobile1` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mpassword` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(55) NOT NULL,
  `educationalqualification` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `user_id`, `pid`, `name`, `status`, `ordernum`, `ip`, `user_agent`, `date_added`, `date_modify`) VALUES
(1, 1, 0, 'Psychology', 1, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2018-08-06 07:59:48', '2018-12-22 11:59:33'),
(2, 1, 0, 'English', 1, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2018-08-06 08:10:32', '2018-12-22 11:59:43'),
(3, 3, 0, 'English', 1, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:12:31', '0000-00-00 00:00:00'),
(4, 3, 0, 'Hindi', 1, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:12:50', '0000-00-00 00:00:00'),
(5, 1, 0, 'Quantitative Reasoning', 1, 3, '103.27.8.105', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-29 01:51:53', '2018-12-29 01:52:59'),
(6, 1, 0, 'Memory', 1, 1, '116.72.214.35', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2019-01-23 14:28:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `teamcat_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(300) NOT NULL,
  `home` varchar(20) DEFAULT NULL,
  `shortdescription` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `teamcat_id`, `name`, `designation`, `home`, `shortdescription`, `description`, `image`, `status`, `date_added`, `date_modify`) VALUES
(2, 60, 'Amar Srivastava', ' Core Team Member', NULL, '<p>Amar leads Intellify with a vision to change the education system with more focus on creativity rather than rote learning. He intends to create a platform that motivates the govt. school students to give in their best and make resources available to them that are available to the pvt. school stud', '', 'image/3570Amar_Srivastava.png', 1, '2019-01-14 07:48:09', '0000-00-00 00:00:00'),
(3, 60, 'Satvik Paramkusham', 'Core Team Member', NULL, '<p>Satvik is currently final year undergraduate student at IIT Delhi. He is extremely passionate about bringing a change in the Education scenario in India.</p>\r\n', '', 'image/8757Satvik.jpg', 1, '2019-01-14 07:52:17', '2019-01-14 07:52:38'),
(4, 60, 'Avinash Bhutani', 'CORE TEAM MEMBER', NULL, '<p>Creative and a passionate writer, it is the field of education that interests me a lot. Looking forward to work with Intellify in the coming years.</p>\r\n', '', 'image/960142147814_2102652533153641_4237653461400813568_n.jpg', 1, '2019-01-14 07:54:04', '2019-01-23 10:25:23'),
(5, 62, 'Ashutosh Singh', 'AMBASSADOR', NULL, '<p>B.Com Hons student .I strongly believe that it&#39;s a great platform to explore new things and learn a different types of skills ... it&#39;s a great boon for students who wants such type of helps in their school time....</p>\r\n', '', 'image/2188Ashutosh.jpg', 1, '2019-01-14 07:55:06', '2019-01-14 07:55:16'),
(6, 62, 'Gaurav Kakran', 'AMBASSADOR', NULL, '<p>A Mechanical Engineering Graduate, an avid learner and traveller. I am working with Intellify to work in the CSR domain for Education. The students drive my curiosity and make me look into microcosm of learning.</p>\r\n', '', '', 1, '2019-01-14 07:56:18', '0000-00-00 00:00:00'),
(7, 62, 'Oshin Grace Johnson', 'AMBASSADOR', NULL, '<p>Pursuing Economics Honours with psychology. I believe in Intellify&rsquo;s vision of transforming the present education system which would appreciate the importance of learners to think out of the box and bring in innovation to their thinking.</p>\r\n', '', '', 1, '2019-01-14 07:57:23', '0000-00-00 00:00:00'),
(8, 60, 'Avinash Bhutani', 'Core Team Member', NULL, '', '', 'image/511942147814_2102652533153641_4237653461400813568_n.jpg', 1, '2019-01-23 10:23:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `teamcat`
--

CREATE TABLE `teamcat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `linkname` varchar(255) NOT NULL,
  `page_title` text NOT NULL,
  `meta_keyword` text NOT NULL,
  `meta_description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teamcat`
--

INSERT INTO `teamcat` (`id`, `user_id`, `pid`, `name`, `linkname`, `page_title`, `meta_keyword`, `meta_description`, `image`, `status`, `ordernum`, `date_added`, `date_modify`) VALUES
(60, 1, 0, ' Core Team Members', 'dfdf', '', '', '', '', 1, 0, '2019-01-12 14:13:49', '2019-01-12 14:20:42'),
(61, 1, 0, ' Executives', ' Executives', '', '', '', '', 1, 0, '2019-01-12 14:21:01', '0000-00-00 00:00:00'),
(62, 1, 0, ' City Ambassadors', ' City Ambassadors', '', '', '', '', 1, 0, '2019-01-12 14:21:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `temp_questions`
--

CREATE TABLE `temp_questions` (
  `id` int(11) NOT NULL,
  `questionbank_id` int(11) NOT NULL,
  `random` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_questions`
--

INSERT INTO `temp_questions` (`id`, `questionbank_id`, `random`) VALUES
(1, 5, '26210'),
(2, 6, '26210'),
(27, 64, '6091'),
(28, 63, '6091'),
(29, 62, '6091'),
(30, 61, '6091');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `designation` varchar(300) NOT NULL,
  `home` varchar(20) NOT NULL,
  `shortdescription` varchar(300) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `designation`, `home`, `shortdescription`, `description`, `image`, `status`, `date_added`, `date_modify`) VALUES
(4, 'Akshat Agarwal', '(winter 2017 intern)', '1', '', '<p>Intellify sparked a flame in my heart for working for the poor and underprivileged of the society to the best of my abilities. I think it&#39;s safe to say that from now onwards and in the distant future as well, I will work for the development of education system in our country and for the development of poor and underprivileged.</p>\r\n', '', 1, '2019-01-14 08:31:02', '2019-01-14 08:45:27'),
(5, 'Utkarsh Gupta', '(winter 2017 intern)', '1', '', '<p>I think Intellify is taking a much required initiative to help improve our education system. Almost every sphere of life has been touched by technology but we are still teaching using very old techniques. And I think Intellify is rightly trying to change that and I am excited to see what will come from it&#39;s effort.</p>\r\n', '', 1, '2019-01-14 08:31:35', '0000-00-00 00:00:00'),
(6, 'Dhanesh Sethia', '(winter 2017 intern)', '1', '', '<p>After joining Intellify I came to know about the problems the students, teachers and all other people directly or indirectly linked to the education system are facing. Overall, it was a good but shocking experience to have known the ground reality.</p>\r\n', '', 1, '2019-01-14 08:32:01', '0000-00-00 00:00:00'),
(7, 'Shreya Johri', '(winter 2017 intern)', '1', '', '<p>The internship helped me experience interaction on a professional platform. The interaction with teachers and principal from the perspective of proposing a solution was a whole new experience. Also, it helped me gain more confidence and put forward me view without hesitation.</p>\r\n', '', 1, '2019-01-14 08:32:24', '0000-00-00 00:00:00'),
(8, 'A Participant', 'Class 9th ( ISCO 2017)', '1', '', '<p>I have learnt many new things during this Olympiad. This was a whole process and not just an exam that you have to clear. We made a water purifier with bamboo stick, banana leaves and trash material!</p>\r\n', '', 1, '2019-01-14 08:33:04', '0000-00-00 00:00:00'),
(9, 'A teacher ', '( ISCO 2017)', '1', '', '<p>What&#39;s better than seeing your students motivated towards learning something new. I was amazed when I saw them discussing about final round a week before the event.</p>\r\n', '', 1, '2019-01-14 08:33:27', '0000-00-00 00:00:00'),
(10, 'Mr. Manish Sisodia', '( ISCO 2017)', '1', '', '<p>There is a disconnect between &#39;what and how we are teaching to our kids, the way exams are prepared and taken&#39; , and &#39;what we expect from education to do for us&#39;. It&#39;s great to see that students from IIT Delhi are coming up with these kind of innovative education models.</p>\r\n', '', 1, '2019-01-14 08:33:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `testpanel`
--

CREATE TABLE `testpanel` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `schoollavel_id` int(11) NOT NULL,
  `schoollavel` varchar(155) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `testtype` varchar(100) NOT NULL,
  `testoption` varchar(155) NOT NULL,
  `language` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `random` varchar(255) NOT NULL,
  `totaltime` varchar(15) NOT NULL,
  `totalmark` varchar(100) NOT NULL,
  `hour` int(11) NOT NULL,
  `minutes` int(11) NOT NULL,
  `perquestionmark` varchar(100) NOT NULL,
  `negativemark` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `startdate` date NOT NULL,
  `status` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testpanel`
--

INSERT INTO `testpanel` (`id`, `pid`, `user_id`, `schoollavel_id`, `schoollavel`, `subject_id`, `subject`, `testtype`, `testoption`, `language`, `name`, `image`, `random`, `totaltime`, `totalmark`, `hour`, `minutes`, `perquestionmark`, `negativemark`, `description`, `startdate`, `status`, `ip`, `user_agent`, `date_added`, `date_modify`) VALUES
(10, 0, 1, 5, 'Level1', 1, 'Psychology', '', 'free', '', 'My Level 1 Set A Psychology', '', '24073', '00:00:00', '', 1, 10, '', '', '', '2018-12-27', 1, '47.30.178.249', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', '2018-12-22 10:23:50', '2019-02-02 22:42:22'),
(16, 10, 1, 5, 'Level1', 1, 'Psychology', '', 'free', '', 'Puneet Jain', '', '32569', '', '', 1, 10, '', '', '', '0000-00-00', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-22 14:10:46', '0000-00-00 00:00:00'),
(17, 16, 1, 5, 'Level1', 1, 'Psychology', '', 'free', '', 'Puneet Jain second genration', '', '903175172', '', '', 1, 15, '', '', '', '0000-00-00', 1, '196.207.107.103', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-22 22:04:30', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `testpanel_answerbyuser`
--

CREATE TABLE `testpanel_answerbyuser` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `studentname` varchar(255) NOT NULL,
  `studentemail` varchar(255) NOT NULL,
  `testpanel_id` int(11) NOT NULL,
  `testname` varchar(255) NOT NULL,
  `question_id` int(11) NOT NULL,
  `rightanswer` varchar(255) NOT NULL,
  `save` int(11) NOT NULL,
  `savemark` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `timer` time NOT NULL,
  `anslock` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testpanel_question`
--

CREATE TABLE `testpanel_question` (
  `id` int(11) NOT NULL,
  `testpanel_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `schoollavel_id` int(11) NOT NULL,
  `schoollavel` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testpanel_question`
--

INSERT INTO `testpanel_question` (`id`, `testpanel_id`, `question_id`, `subject_id`, `subject`, `schoollavel_id`, `schoollavel`, `date_added`) VALUES
(227, 16, 25, 1, 'Psychology', 5, 'Level1', '2019-01-22 14:10:46'),
(228, 16, 29, 1, 'Psychology', 5, 'Level1', '2019-01-22 14:10:46'),
(229, 16, 30, 1, 'Psychology', 5, 'Level1', '2019-01-22 14:10:46'),
(230, 16, 31, 1, 'Psychology', 5, 'Level1', '2019-01-22 14:10:46'),
(231, 16, 32, 1, 'Psychology', 5, 'Level1', '2019-01-22 14:10:46'),
(232, 16, 33, 1, 'Psychology', 5, 'Level1', '2019-01-22 14:10:46'),
(233, 16, 34, 1, 'Psychology', 5, 'Level1', '2019-01-22 14:10:46'),
(234, 17, 32, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(235, 17, 33, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(236, 17, 38, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(237, 17, 39, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(238, 17, 40, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(239, 17, 46, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(240, 17, 47, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(241, 17, 48, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(242, 17, 49, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(243, 17, 51, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(244, 17, 52, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(245, 17, 64, 1, 'Psychology', 5, 'Level1', '2019-01-22 22:04:30'),
(246, 10, 25, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22'),
(247, 10, 33, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22'),
(248, 10, 34, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22'),
(249, 10, 64, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22'),
(250, 10, 63, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22'),
(251, 10, 62, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22'),
(252, 10, 61, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22'),
(253, 10, 60, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22'),
(254, 10, 59, 1, 'Psychology', 5, 'Level1', '2019-02-02 22:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `testtype`
--

CREATE TABLE `testtype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testtype`
--

INSERT INTO `testtype` (`id`, `name`, `status`, `date_added`, `date_modify`) VALUES
(1, 'Hindi', 1, '2018-08-04 06:59:47', '0000-00-00 00:00:00'),
(2, 'English', 1, '2018-08-04 06:59:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `topic`
--

CREATE TABLE `topic` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `chapter_id` int(11) NOT NULL,
  `chapter` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `ordernum` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topic`
--

INSERT INTO `topic` (`id`, `user_id`, `pid`, `name`, `subject_id`, `subject`, `chapter_id`, `chapter`, `status`, `ordernum`, `ip`, `user_agent`, `date_added`, `date_modify`) VALUES
(9, 0, 0, 'Topic 1', 1, 'English', 2, 'Chapter 2', 1, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-08-11 12:15:27', '2018-08-16 19:34:45'),
(10, 0, 0, 'Topic 2', 1, 'English', 1, 'Chapter 1', 1, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-08-11 12:15:33', '2018-08-16 19:34:53'),
(11, 0, 0, 'Topic 3', 2, 'Reseaoning', 3, 'Chapter 3', 1, 3, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-08-24 12:12:16', '2018-08-24 12:13:40'),
(12, 0, 0, 'Topic 4', 2, 'Reseaoning', 4, 'Chapter 4', 1, 4, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:61.0) Gecko/20100101 Firefox/61.0', '2018-08-24 12:12:28', '0000-00-00 00:00:00'),
(13, 3, 0, 'Topic 1', 3, 'English', 9, 'Chapter 1', 1, 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:15:29', '2018-09-13 17:15:41'),
(14, 3, 0, 'Topic 2', 3, 'English', 9, 'Chapter 1', 1, 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:62.0) Gecko/20100101 Firefox/62.0', '2018-09-13 17:15:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `usertype_id` int(11) NOT NULL,
  `usertype` varchar(155) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `context` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `googlemap` text NOT NULL,
  `socialsites` text NOT NULL,
  `feed` varchar(255) NOT NULL,
  `follow` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `gplus` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `aboutpro1` varchar(20) NOT NULL,
  `aboutpro2` varchar(20) NOT NULL,
  `aboutpro3` varchar(20) NOT NULL,
  `aboutpro4` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `user_agent` varchar(200) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modify` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `pid`, `usertype_id`, `usertype`, `lastname`, `firstname`, `user_name`, `user_email`, `user_password`, `page_title`, `meta_keyword`, `meta_description`, `address`, `context`, `phone`, `email`, `fax`, `googlemap`, `socialsites`, `feed`, `follow`, `facebook`, `gplus`, `twitter`, `aboutpro1`, `aboutpro2`, `aboutpro3`, `aboutpro4`, `status`, `ip`, `user_agent`, `date_added`, `date_modify`) VALUES
(1, 0, 1, 'admin', 'Otta', 'Arvind', 'admin', 'punit@edtech.in', '21232f297a57a5a743894a0e4a801fc3', 'Intellify', 'Intellify', 'Intellify', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>\r\n', '9876543210', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 1, 'admin', 'Chauhan', 'Tapes', 'tapes', 'tapes@edtech.in', '827ccb0eea8a706c4c34a16891f84e7b', 'Puneet Jain', 'Puneet Jain', 'Puneet Jain', 'Puneet Jain', '<p>Test</p>\r\n', '9874561230', 'punit@edtech.in', '12345678', '<p>Test</p>\r\n', '', '', '', '', '', '', '', '', '', '', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1; rv:64.0) Gecko/20100101 Firefox/64.0', '2019-01-14 09:07:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'subuser'),
(3, 'institute');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenitiesnspecification`
--
ALTER TABLE `amenitiesnspecification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amspeimage`
--
ALTER TABLE `amspeimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogcat`
--
ALTER TABLE `blogcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs_blogcat`
--
ALTER TABLE `blogs_blogcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commercialspace`
--
ALTER TABLE `commercialspace`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `headerbanner`
--
ALTER TABLE `headerbanner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_user`
--
ALTER TABLE `menu_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paddques`
--
ALTER TABLE `paddques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo_category`
--
ALTER TABLE `photo_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questionbank`
--
ALTER TABLE `questionbank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questiontype`
--
ALTER TABLE `questiontype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sampleflat`
--
ALTER TABLE `sampleflat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `schoollavel`
--
ALTER TABLE `schoollavel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoollavel_subject`
--
ALTER TABLE `schoollavel_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teamcat`
--
ALTER TABLE `teamcat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_questions`
--
ALTER TABLE `temp_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testpanel`
--
ALTER TABLE `testpanel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testpanel_answerbyuser`
--
ALTER TABLE `testpanel_answerbyuser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testpanel_question`
--
ALTER TABLE `testpanel_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testtype`
--
ALTER TABLE `testtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic`
--
ALTER TABLE `topic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenitiesnspecification`
--
ALTER TABLE `amenitiesnspecification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `amspeimage`
--
ALTER TABLE `amspeimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=446;

--
-- AUTO_INCREMENT for table `blogcat`
--
ALTER TABLE `blogcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blogs_blogcat`
--
ALTER TABLE `blogs_blogcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `commercialspace`
--
ALTER TABLE `commercialspace`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `headerbanner`
--
ALTER TABLE `headerbanner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `menu_user`
--
ALTER TABLE `menu_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `paddques`
--
ALTER TABLE `paddques`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `photo_category`
--
ALTER TABLE `photo_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `productimage`
--
ALTER TABLE `productimage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `questionbank`
--
ALTER TABLE `questionbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `questiontype`
--
ALTER TABLE `questiontype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sampleflat`
--
ALTER TABLE `sampleflat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `schoollavel`
--
ALTER TABLE `schoollavel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schoollavel_subject`
--
ALTER TABLE `schoollavel_subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teamcat`
--
ALTER TABLE `teamcat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `temp_questions`
--
ALTER TABLE `temp_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `testpanel`
--
ALTER TABLE `testpanel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `testpanel_answerbyuser`
--
ALTER TABLE `testpanel_answerbyuser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testpanel_question`
--
ALTER TABLE `testpanel_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=255;

--
-- AUTO_INCREMENT for table `testtype`
--
ALTER TABLE `testtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topic`
--
ALTER TABLE `topic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

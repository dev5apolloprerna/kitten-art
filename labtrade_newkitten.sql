-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 04, 2025 at 09:35 AM
-- Server version: 10.6.14-MariaDB-log
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `labtrade_newkitten`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `bannerId` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `iStatus` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(4) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`bannerId`, `image`, `iStatus`, `isDelete`, `created_at`, `updated_at`) VALUES
(6, '1751902116.png', 1, 0, '2025-07-07 11:28:36', '2025-07-07 11:28:36'),
(12, '1752587213.png', 1, 0, '2025-07-15 09:46:53', '2025-07-15 09:46:53');

-- --------------------------------------------------------

--
-- Table structure for table `batch_master`
--

CREATE TABLE `batch_master` (
  `batch_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `batch_name` varchar(100) NOT NULL,
  `batch_day` varchar(50) NOT NULL,
  `batch_from_time` time NOT NULL,
  `batch_to_time` time NOT NULL,
  `iStatus` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `batch_master`
--

INSERT INTO `batch_master` (`batch_id`, `category_id`, `batch_name`, `batch_day`, `batch_from_time`, `batch_to_time`, `iStatus`, `isDelete`, `created_at`, `updated_at`) VALUES
(18, 1, 'Tuesday', '2', '17:30:00', '18:30:00', 1, 0, '2025-04-11 09:10:25', '2025-06-01 12:52:17'),
(17, 1, 'Monday', '1', '17:30:00', '18:30:00', 1, 0, '2025-02-10 13:16:04', '2025-06-01 12:51:57'),
(20, 8, 'Wednesday', '3', '17:30:00', '18:30:00', 1, 0, '2025-04-11 09:12:42', '2025-06-01 12:53:12'),
(21, 8, 'Thursday', '4', '17:30:00', '18:30:00', 1, 0, '2025-04-11 09:13:30', '2025-06-01 12:53:44'),
(22, 1, 'Saturday', '6', '10:00:00', '11:00:00', 1, 0, '2025-04-11 09:14:17', '2025-06-01 12:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `iStatus` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`category_id`, `category_name`, `iStatus`, `isDelete`, `created_at`, `updated_at`) VALUES
(1, '6-8 years', 1, 0, '2024-12-23 09:16:06', '2025-04-08 12:47:34'),
(8, '9-14 year', 1, 0, '2025-01-21 05:34:36', '2025-03-26 14:07:21'),
(14, '14-20 years', 1, 1, '2025-02-28 07:27:09', '2025-02-28 07:27:20'),
(15, 'ww', 1, 1, '2025-03-03 08:34:07', '2025-03-03 08:34:34'),
(16, '15-18 year', 1, 1, '2025-03-05 06:26:44', '2025-03-05 06:36:26'),
(17, '15-18 years', 1, 1, '2025-03-05 06:36:45', '2025-03-05 06:36:55'),
(18, '15 -18 year', 1, 1, '2025-03-06 05:34:58', '2025-03-06 05:38:59'),
(19, '9-14 year', 1, 1, '2025-03-26 14:03:29', '2025-03-26 14:03:52'),
(20, '9-14 year', 1, 1, '2025-03-26 14:03:44', '2025-03-26 14:03:48'),
(21, '9-14 year', 1, 1, '2025-03-26 14:04:21', '2025-03-26 14:04:28'),
(22, 'Adult classes', 1, 1, '2025-04-09 11:27:58', '2025-04-09 11:28:11'),
(23, 'ages 18 above', 1, 1, '2025-04-09 11:28:41', '2025-04-09 11:29:41'),
(24, '14-18 Year', 1, 1, '2025-05-05 01:44:26', '2025-05-05 01:44:43'),
(25, '15-18 Years', 1, 1, '2025-05-05 01:52:44', '2025-05-05 06:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `ebook_master`
--

CREATE TABLE `ebook_master` (
  `ebook_id` int(11) NOT NULL,
  `ebook_name` varchar(100) NOT NULL,
  `ebook_pdf` varchar(100) NOT NULL,
  `ebook_image` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ebook_master`
--

INSERT INTO `ebook_master` (`ebook_id`, `ebook_name`, `ebook_pdf`, `ebook_image`) VALUES
(1, 'Hide and seek', '1736329697.pdf', '1736329697.jpg'),
(2, 'test pdf 123', '1736329612.pdf', '1736329612.png'),
(5, '031:TERRANCE TURTLE\'S NEW HOME', '1737362999.pdf', '1737362999.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `ebook_registration`
--

CREATE TABLE `ebook_registration` (
  `ebook_registration_id` int(11) NOT NULL,
  `ebook_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `ebook_registration`
--

INSERT INTO `ebook_registration` (`ebook_registration_id`, `ebook_id`, `name`, `email`, `mobile`) VALUES
(1, 5, 'Bansari Patel', 'dev5.apolloinfotech@gmail.com', '9987654321'),
(3, 5, 'test', 'dev5.apolloinfotech@gmail.com', '7802801090'),
(4, 2, 'Bansari Patel', 'dev5.apolloinfotech@gmail.com', '9987654321');

-- --------------------------------------------------------

--
-- Table structure for table `event_master`
--

CREATE TABLE `event_master` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `capacity` varchar(100) NOT NULL,
  `Instructors` varchar(255) NOT NULL,
  `discounts` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `detail_description` longtext NOT NULL,
  `to_date` date NOT NULL,
  `from_date` date NOT NULL,
  `to_time` time NOT NULL,
  `from_time` time NOT NULL,
  `image` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `event_master`
--

INSERT INTO `event_master` (`event_id`, `event_name`, `category_id`, `capacity`, `Instructors`, `discounts`, `location`, `detail_description`, `to_date`, `from_date`, `to_time`, `from_time`, `image`, `created_at`, `updated_at`) VALUES
(1, 'And Sew It Begins: Beginner Hand Sewing Class', 1, '10 student', 'Nicole L., Julia E., Rachel C.', 'Sibling Discount', '9113 Leesville Rd, Suite 102, Raleigh, NC 27613', '<h2>Class Experience</h2>\r\n\r\n<p>And Sew It Begins: Join us at Paint Paper Paste for a beginner hand sewing course! No previous sewing experience required - we will begin with the&nbsp;<strong>basics of threading and knot tying, explore several different stitches and embroidery</strong>, and artists will walk away with at least two completed sewing projects in this 6 week course!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Registration for And Sew It Begins is based on class series. Single/drop-in classes are not permitted.&nbsp;<strong>Artists must be in 3rd-7th grade to participate in this class series.</strong>&nbsp;&nbsp;Afterschool Art Adventures Make-Up Policy applies to this offering. &nbsp;See our policies on our website for more details.&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Class Requirements</h3>\r\n\r\n<ul>\r\n	<li>Beginner level class - no prior sewing skills necessary!&nbsp;</li>\r\n	<li>Artists must be currently enrolled in 3rd-7th grade to participate</li>\r\n	<li>Be sure to bring your imagination and creativity!</li>\r\n</ul>\r\n\r\n<h3>Sample Class Format</h3>\r\n\r\n<ul>\r\n	<li>4:25 - Drop-off begins</li>\r\n	<li>4:30 - Instruction begins promptly at class start time</li>\r\n	<li>5:25-5:30 - All students must be promptly picked up by 5:30pm.&nbsp;Failure to pick child up on time will result in a late pickup fee, charged to the registrant&#39;s card on file at the time of pickup.</li>\r\n</ul>\r\n\r\n<h3>Other Things To Know</h3>\r\n\r\n<p>Cancellation Policy</p>\r\n\r\n<p><strong>AFTERSCHOOL ART ADVENTURES:&nbsp;</strong>Cancellations made AT LEAST 1 month/30 days prior to the first class date will receive a full refund, less a $50 cancellation fee for Full Semester Registrations and $15 cancellation fee for Monthly Registrations</p>\r\n\r\n<hr />\r\n<h2>What To Bring</h2>\r\n\r\n<ul>\r\n	<li>Water bottles are welcome! Please finish any afterschool snacks prior to entering the studio.</li>\r\n	<li>Light jacket (our studio runs cold!)</li>\r\n</ul>\r\n\r\n<hr />', '2025-02-10', '2025-01-06', '17:30:00', '16:30:00', '1736423339.jpg', '2024-12-24 10:14:42', '2025-01-31 17:34:27'),
(3, 'Great Outdoors Trackout Camp', 1, '14 Students', 'Maureen C.', 'Sibling Discount', '9113 Leesville Rd, Suite 103, Raleigh, NC 27613', '<h2>Class Experience</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Join us for a week full of art exploration fueled by the great outdoors! &nbsp;From camping landscapes to animal drawings, we will dive into all forms of art in this school&#39;s out camp.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>?Sign up for the full week OR for individual days!</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>⭐️Artists must be currently enrolled in&nbsp;<strong>Kindergarten-5th grade&nbsp;</strong>to participate in School&rsquo;s Out offerings. &nbsp;<em>Artists enrolled in transitional kindergarten or not currently enrolled in kindergarten are not permitted.</em></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>Class Requirements</h3>\r\n\r\n<ul>\r\n	<li>?Art-friendly clothes (artists often get MESSY while creating!)</li>\r\n	<li>⭐️Artists must be in Kindergarten-5th grade to participate in School&rsquo;s Out offerings. &nbsp;Artists enrolled in transitional kindergarten or not currently enrolled in kindergarten are not permitted.&nbsp;</li>\r\n	<li>?Be sure to bring your imagination and creativity!</li>\r\n</ul>\r\n\r\n<h3>Sample Class Format</h3>\r\n\r\n<ul>\r\n	<li>❤️8:50 - Drop-off begins</li>\r\n	<li>?9:05 - Instruction begins</li>\r\n	<li>?10:30-10:45 - Snack break&nbsp;</li>\r\n	<li>?12:00-12:30 - Lunchtime&nbsp;</li>\r\n	<li>?12:45-1:55 - Independent art activities&nbsp;</li>\r\n	<li>?1:55-2:00 - All students must be promptly picked up by 2:00pm. Failure to pick child up on time will result in a late pickup fee, collected at the time of pickup.&nbsp;</li>\r\n</ul>\r\n\r\n<h3>Other Things To Know</h3>\r\n\r\n<p><img src=\"https://cdn-p0.hisawyer.com/packs/static/app/assets/images/pdp_icons/cancellation-policy@2x-47dea2935762f969f9e1.png\" /></p>\r\n\r\n<p>Cancellation Policy</p>\r\n\r\n<p><strong>TRACKOUT CAMPS:&nbsp;</strong>Cancellations made AT LEAST 1 month/30 days prior to the first day will receive a full refund, less a $50 cancellation fee for Full Week Registrations and $15 cancellation fee per day for Single Day Registrations.</p>\r\n\r\n<hr />\r\n<h2>What To Bring</h2>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Copy</p>\r\n\r\n<ul>\r\n	<li>?Art-friendly clothes (Dress for mess - we will get MESSY while we create!)</li>\r\n	<li>?Water bottle</li>\r\n	<li>?Nut-free snack</li>\r\n	<li>?Nut-free lunch</li>\r\n	<li>?Blanket or towel for outside snacktime</li>\r\n	<li>?Light jacket (our studio runs cold!)</li>\r\n</ul>', '2025-02-07', '2025-02-03', '14:00:00', '09:00:00', '1739961947.png', '2025-01-20 12:43:04', '2025-02-19 05:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_master`
--

CREATE TABLE `gallery_master` (
  `gallery_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=owner 2=student',
  `comment` varchar(50) DEFAULT NULL,
  `iStatus` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `gallery_master`
--

INSERT INTO `gallery_master` (`gallery_id`, `image`, `type`, `comment`, `iStatus`, `isDelete`, `created_at`, `updated_at`) VALUES
(43, '1745003558.jpg', 2, '', 1, 0, '2025-04-18 15:12:38', '2025-04-18 15:12:38'),
(38, '1745002505.jpg', 1, '', 1, 0, '2025-04-18 14:55:05', '2025-04-18 14:55:05'),
(39, '1745002812.jpg', 1, '', 1, 0, '2025-04-18 15:00:12', '2025-04-18 15:00:12'),
(37, '1745002485.jpg', 1, '', 1, 0, '2025-04-18 14:54:45', '2025-04-18 14:54:45'),
(50, '1745004757.jpg', 2, '', 1, 0, '2025-04-18 15:32:37', '2025-04-18 15:32:37'),
(51, '1745004802.jpg', 2, '', 1, 0, '2025-04-18 15:33:22', '2025-04-18 15:33:22'),
(40, '1745002832.jpg', 1, '', 1, 0, '2025-04-18 15:00:32', '2025-04-18 15:00:32'),
(22, '1744305409.jpg', 2, '', 1, 0, '2025-04-10 13:16:49', '2025-04-10 13:16:49'),
(41, '1745002852.jpg', 1, '', 1, 0, '2025-04-18 15:00:52', '2025-04-18 15:00:52'),
(23, '1744305502.jpg', 2, '', 1, 0, '2025-04-10 13:18:22', '2025-04-10 13:18:22'),
(24, '1744305773.jpg', 1, '', 1, 0, '2025-04-10 13:22:53', '2025-04-10 13:22:53'),
(42, '1745003522.jpg', 2, '', 1, 0, '2025-04-18 15:12:02', '2025-04-18 15:12:02'),
(27, '1744637503.jpg', 1, '', 1, 0, '2025-04-14 09:31:43', '2025-04-14 09:31:43'),
(28, '1744894670.jpg', 1, '', 1, 0, '2025-04-17 08:57:50', '2025-04-17 08:57:50'),
(29, '1744894807.jpg', 1, '', 1, 0, '2025-04-17 09:00:07', '2025-04-17 09:00:07'),
(30, '1744897766.jpg', 1, '', 1, 0, '2025-04-17 09:49:26', '2025-04-17 09:49:26'),
(31, '1744897790.jpg', 1, '', 1, 0, '2025-04-17 09:49:50', '2025-04-17 09:49:50'),
(32, '1744897820.jpg', 1, '', 1, 0, '2025-04-17 09:50:20', '2025-04-17 09:50:20'),
(33, '1744897846.jpg', 1, '', 1, 0, '2025-04-17 09:50:46', '2025-04-17 09:50:46'),
(34, '1744897896.jpg', 1, '', 1, 0, '2025-04-17 09:51:36', '2025-04-17 09:51:36'),
(44, '1745003608.jpg', 2, '', 1, 0, '2025-04-18 15:13:28', '2025-04-18 15:13:28'),
(45, '1745003641.jpg', 2, '', 1, 0, '2025-04-18 15:14:01', '2025-04-18 15:14:01'),
(46, '1745003685.jpg', 2, '', 1, 0, '2025-04-18 15:14:45', '2025-04-18 15:14:45'),
(47, '1745003732.jpg', 2, '', 1, 0, '2025-04-18 15:15:32', '2025-04-18 15:15:32'),
(48, '1745003792.jpg', 2, '', 1, 0, '2025-04-18 15:16:32', '2025-04-18 15:16:32'),
(49, '1745003841.jpg', 2, '', 1, 0, '2025-04-18 15:17:21', '2025-04-18 15:17:21'),
(52, '1745004837.jpg', 2, '', 1, 0, '2025-04-18 15:33:57', '2025-04-18 15:33:57'),
(53, '1745004881.jpg', 2, '', 1, 0, '2025-04-18 15:34:41', '2025-04-18 15:34:41'),
(54, '1745004920.jpg', 2, '', 1, 0, '2025-04-18 15:35:20', '2025-04-18 15:35:20'),
(59, '1751062555.jpg', 2, '', 1, 0, '2025-06-27 18:15:55', '2025-06-27 18:15:55'),
(60, '1751062629.jpg', 2, '', 1, 0, '2025-06-27 18:17:09', '2025-06-27 18:17:09'),
(65, '1751062901.jpg', 2, '', 1, 0, '2025-06-27 18:21:41', '2025-06-27 18:21:41'),
(62, '1751062702.jpg', 2, '', 1, 0, '2025-06-27 18:18:22', '2025-06-27 18:18:22'),
(63, '1751062730.jpg', 2, '', 1, 0, '2025-06-27 18:18:50', '2025-06-27 18:18:50'),
(64, '1751062772.jpg', 2, '', 1, 0, '2025-06-27 18:19:32', '2025-06-27 18:19:32'),
(66, '1751062933.jpg', 2, '', 1, 0, '2025-06-27 18:22:13', '2025-06-27 18:22:13'),
(67, '1751062975.jpg', 2, '', 1, 0, '2025-06-27 18:22:55', '2025-06-27 18:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `home_page`
--

CREATE TABLE `home_page` (
  `id` int(11) NOT NULL,
  `page_name` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `home_page`
--

INSERT INTO `home_page` (`id`, `page_name`, `name`, `description`) VALUES
(1, 'Index', 'about us', '<p>We offer structured, curriculum-based art classes for children ages 6&ndash;14 years, designed to build a comprehensive understanding of the fundamental principles of visual art. Our program emphasizes technical skill development, critical thinking, and creative problem-solving, providing students with the tools they need to grow as confident, capable young artists.</p>\r\n\r\n<p>Whether your child is just beginning their creative journey or ready to take their skills to the next level, we offer age-appropriate lessons tailored to spark curiosity and personal expression. our classes provide a rigorous yet supportive environment for developing a solid foundation in art.</p>\r\n\r\n<p><strong>Enroll today to invest in your child&rsquo;s artistic education and creative development.</strong></p>'),
(2, 'Index', 'Art Classes', '<p>We believe art is more than a skill&mdash;it&rsquo;s a journey of self-discovery, confidence, and joy. Our art classes provide a strong foundation in essential techniques while encouraging every student to express their unique voice. We have created weekly, unique art classes for kids ages 6-14 to keep your child entertained &amp; creative. It will help them to keep away from screens. Kids will learn something new &amp; innovative in our classes.</p>'),
(3, 'Terms And Conditions', 'Terms And Conditions', '<ol>\r\n	<li><strong>Payment Information</strong>. &nbsp;\r\n	<ol>\r\n		<li>All classes fees must be paid in full prior to the start of the class</li>\r\n		<li>&nbsp;Enrollment is confirmed only after the full payment is received in advance. &nbsp;</li>\r\n		<li>Fees are non-negotiable.</li>\r\n		<li>Payment must be made via:\r\n		<ol>\r\n			<li>Zelle o</li>\r\n			<li>Check (Check must be Payable to &ldquo;Kitten Art Classes LLC&rdquo;)</li>\r\n		</ol>\r\n		</li>\r\n	</ol>\r\n	</li>\r\n	<li><strong>Class Fees </strong>\r\n	<ol>\r\n		<li>Prices are listed as per art class different plans (1 month plan, 3 months plan etc.)</li>\r\n		<li>Fees don&rsquo;t include art supplies. Students need to bring their own art supplies as listed on website.</li>\r\n		<li>Continued failure to pay may result in the student losing their place in the class.</li>\r\n	</ol>\r\n	</li>\r\n	<li><strong>Cancellations &amp; Refunds </strong>\r\n	<ol>\r\n		<li>Cancellations made 7 or more days before the start of the session: Full refund.</li>\r\n		<li>No refunds for cancellations made on or after the class start date, or for missed sessions. 4.</li>\r\n	</ol>\r\n	</li>\r\n	<li><strong>Make-Up Classes </strong>\r\n	<ol>\r\n		<li>Make-up classes are offered only when notice of absence is given at least one week in advance.</li>\r\n		<li>No credits or refunds for no-shows.</li>\r\n	</ol>\r\n	</li>\r\n	<li><strong>Renewal of Student Registration </strong>\r\n	<ol>\r\n		<li>Renewal is required before 2 weeks of the current registration completion to reserve your child spot for next registration.</li>\r\n	</ol>\r\n	</li>\r\n	<li><strong>Class Cancellations by the Studio </strong>\r\n	<ol>\r\n		<li>&nbsp;If a class is cancelled by the studio (e.g., instructor illness, weather), you will be offered a make-up class.</li>\r\n	</ol>\r\n	</li>\r\n	<li><strong>Discounts &amp; Promotions </strong>\r\n	<ol>\r\n		<li>Discount can be applied when you do registration for 3 months or 6 months.</li>\r\n	</ol>\r\n	</li>\r\n	<li><strong>Liability &amp; Conduct </strong>\r\n	<ol>\r\n		<li>The studio is not responsible for lost or damaged personal belongings.</li>\r\n		<li>Children are expected to behave respectfully; disruptive behaviour may result in dismissal from the program with no refund.</li>\r\n	</ol>\r\n	</li>\r\n	<li><strong>Consent &amp; Media Release </strong>\r\n	<ol>\r\n		<li>By enrolling, you agree to allow your child&rsquo;s artwork and/or class participation photos to be used for promotional purposes, unless you notify us in advance.</li>\r\n	</ol>\r\n	</li>\r\n</ol>'),
(4, 'Privacy Policy', 'Privacy Policy', '<p>we have ensured that your personal data is handled in accordance with applicable data privacy regulations.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`image_id`, `image`) VALUES
(1, '1752627357.png');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry`
--

CREATE TABLE `inquiry` (
  `inquiry_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mobileNumber` varchar(12) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `strIp` varchar(50) NOT NULL,
  `iStatus` int(11) NOT NULL DEFAULT 1,
  `isDelete` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `plan_master`
--

CREATE TABLE `plan_master` (
  `planId` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `plan_name` varchar(50) NOT NULL,
  `plan_session` int(11) NOT NULL,
  `plan_amount` decimal(11,2) NOT NULL,
  `plan_image` varchar(100) NOT NULL,
  `plan_description` longtext NOT NULL,
  `detail_description` longtext DEFAULT NULL,
  `iStatus` tinyint(1) NOT NULL DEFAULT 1,
  `isDelete` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `plan_master`
--

INSERT INTO `plan_master` (`planId`, `category_id`, `plan_name`, `plan_session`, `plan_amount`, `plan_image`, `plan_description`, `detail_description`, `iStatus`, `isDelete`, `created_at`, `updated_at`) VALUES
(10, 1, '1 Month Subscription', 4, 60.00, '1737033599.png', '<ul>\r\n	<li>Art Classes (Age: 5-8 years)</li>\r\n	<li>Class: 1 Hour Session on every Saturday</li>\r\n	<li>Cost: $60/month which includes 4 sessions</li>\r\n	<li>All Art supplies included.</li>\r\n</ul>', NULL, 1, 1, '2025-01-16 13:19:59', '2025-04-08 13:04:01'),
(13, 1, '3 Month Subscription', 12, 150.00, '1738912124.jpg', '<ul>\r\n	<li>Art Classes (5-8 years)</li>\r\n	<li>$ 150 for 3 months classes</li>\r\n	<li>Session Includes: 12</li>\r\n	<li>Duration: 1 hour</li>\r\n</ul>', NULL, 1, 1, '2025-01-16 13:27:15', '2025-04-08 13:04:08'),
(14, 1, '6 Month Subscription', 24, 250.00, '1737034073.png', '<ul>\r\n	<li>Art Classes (5-8 years)</li>\r\n	<li>$ 250 for 6 months classes</li>\r\n	<li>Session Includes: 24</li>\r\n	<li>Duration: 1 hour</li>\r\n</ul>', NULL, 1, 1, '2025-01-16 13:27:53', '2025-04-08 13:04:16'),
(16, 8, '1 month class', 4, 80.00, '1737352466.png', '<ul>\r\n	<li>Art Classes (Age: 9-14 years)</li>\r\n	<li>Class: 1 &frac12; Hour Session on every Saturday</li>\r\n	<li>Cost: $80/month which includes 4 sessions.</li>\r\n	<li>All Art supplies included.</li>\r\n</ul>', NULL, 1, 1, '2025-01-20 05:54:26', '2025-04-08 13:04:24'),
(19, 8, '6 months Classes', 48, 500.00, '1740553349.jpeg', '<ul>\r\n	<li>Art Classes (Age: 9-14 years)</li>\r\n	<li>Class: 1 &frac12; Hour Session on every Saturday</li>\r\n	<li>Cost: $90/month which includes 4 sessions.</li>\r\n	<li>All Art supplies included.</li>\r\n</ul>', NULL, 1, 1, '2025-02-10 13:01:13', '2025-04-08 13:03:52'),
(23, 1, 'Test', 6, 20.00, '1739977641.jpg', '<p>Testting</p>', '<p>Tesitin</p>', 1, 1, '2025-02-19 10:07:21', '2025-02-27 08:57:27'),
(21, 1, '6 months Classes 5-8', 48, 500.00, '1739885574.jpg', '<p>tEstibng</p>', '<p>tEstibng</p>', 1, 1, '2025-02-18 08:32:54', '2025-04-08 13:03:45'),
(22, 8, '3 months Classes', 12, 250.00, '1741256336.jpg', '<ul>\r\n	<li>Art Classes (Age: 9-14 years)</li>\r\n	<li>Class: 1 &frac12; Hour Session on every Saturday</li>\r\n	<li>Cost: $90/month which includes 4 sessions.</li>\r\n	<li>All Art supplies included.</li>\r\n</ul>', '<p>test</p>', 1, 1, '2025-02-19 07:27:56', '2025-04-08 13:03:36'),
(24, 1, '5 Month Subscription', 15, 100.00, '1740657981.jpg', '<p>sldkjg</p>', '<p>sldggl</p>', 1, 1, '2025-02-27 07:06:21', '2025-02-27 07:10:11'),
(25, 8, 'Plan 15', 5, 40.00, '1740746357.png', '<p>fcghcbhvdbcjcf</p>', '<p>uyfkyvjhlvjhvjhv</p>', 1, 1, '2025-02-28 07:36:54', '2025-02-28 07:39:23'),
(26, 1, 'Plan 1', 5, 20.00, '1741255755.jpeg', '<p>test</p>', '<p>test</p>', 1, 1, '2025-03-06 05:09:15', '2025-03-06 05:09:22'),
(27, 1, 'plan test', 5, 2000.00, '1741261415.jpeg', '<p>test</p>', '<p>test</p>', 1, 1, '2025-03-06 06:43:35', '2025-03-06 06:44:02'),
(28, 1, 'test123', 5, 50.00, '1743425739.png', '<p>test</p>', '<p>test 123</p>', 1, 1, '2025-03-31 08:55:39', '2025-04-08 13:02:47'),
(29, 1, '3 months Classes', 12, 200.00, '1744131661.jpg', '<p><strong>&nbsp;3 months class description</strong></p>\r\n\r\n<ul>\r\n	<li>Class: 1 hour session</li>\r\n	<li>Cost :$200 for 3 months which includes total 12&nbsp;sessions</li>\r\n	<li>All art supplies included</li>\r\n</ul>', '<p><strong>3 months class description</strong></p>\r\n\r\n<ul>\r\n	<li>Fundamentals of drawing</li>\r\n	<li>Basic shapes</li>\r\n	<li>Basic composition</li>\r\n	<li>Basic pencil Shading</li>\r\n	<li>Drawing from imagination</li>\r\n	<li>Color theory</li>\r\n	<li>Basic painting</li>\r\n	<li>Basic color combination</li>\r\n	<li>Texture &amp; Pattern drawing</li>\r\n	<li>Landscape</li>\r\n</ul>', 1, 1, '2025-04-08 13:01:01', '2025-04-08 13:10:07'),
(30, 1, '1 Month Classes', 4, 75.00, '1744898445.jpg', '<p>Class Duration : 1 hour.</p>\r\n\r\n<p>Cost : $75 for 1 Month Classes.</p>\r\n\r\n<p>Once a week class.</p>\r\n\r\n<p>&nbsp;Art supplies not included</p>', '<p>1 month art classes includes :</p>\r\n\r\n<ul>\r\n	<li>Fundamentals of drawing</li>\r\n	<li>Basic shapes</li>\r\n	<li>Basic color combination</li>\r\n	<li>Cartoon Drawing</li>\r\n</ul>', 1, 0, '2025-04-08 13:08:47', '2025-06-28 19:55:21'),
(31, 1, '1 Month Subscription', 12, 2000.00, '1744188783.png', '<p>test</p>', '<p>test</p>', 1, 1, '2025-04-09 04:53:03', '2025-04-09 11:02:16'),
(32, 1, '3 months Classes', 12, 200.00, '1744211270.jpg', '<p>Class Duration : 1 Hour</p>\r\n\r\n<p>Cost : <s>$ 225 for 3 Months Classes</s></p>\r\n\r\n<p>$ 200 for 3 months classes. (Save $25).</p>\r\n\r\n<p>once a week class.</p>\r\n\r\n<p>All supplies included.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', '<ul>\r\n	<li>Fundamentals of drawing</li>\r\n	<li>Basic shapes</li>\r\n	<li>Basic composition</li>\r\n	<li>Basic pencil Shading</li>\r\n	<li>Drawing from imagination</li>\r\n	<li>Color theory</li>\r\n	<li>Basic painting</li>\r\n	<li>Basic color combination</li>\r\n	<li>Texture &amp; Pattern drawing</li>\r\n	<li>Landscape</li>\r\n</ul>', 1, 1, '2025-04-09 11:07:50', '2025-04-09 11:22:55'),
(33, 1, '3 Months Classes', 12, 200.00, '1744303906.jpg', '<p>Class Duration : 1 Hour</p>\r\n\r\n<p>Cost :&nbsp;<s>$ 225 for 3 Months Classes</s></p>\r\n\r\n<p>$ 200 for 3 months classes. (Save $25).</p>\r\n\r\n<p>once a week class.</p>\r\n\r\n<p>Art supplies not included.</p>', '<p>3 Months classes includes :</p>\r\n\r\n<ul>\r\n	<li>Fundamentals of drawing</li>\r\n	<li>Basic shapes</li>\r\n	<li>Basic composition</li>\r\n	<li>Basic pencil Shading</li>\r\n	<li>Drawing from imagination</li>\r\n	<li>Color theory</li>\r\n	<li>Basic painting</li>\r\n	<li>Basic color combination</li>\r\n	<li>Texture &amp; Pattern drawing</li>\r\n	<li>Landscape</li>\r\n</ul>', 1, 0, '2025-04-09 11:24:20', '2025-06-28 20:01:02'),
(34, 1, '6 Months Classes', 24, 450.00, '1744376814.jpg', '<p>Class Duration : 1 Hour</p>\r\n\r\n<p>Cost :&nbsp;<s>$ 450 for 6 Months Classes.</s></p>\r\n\r\n<p>$ 400 for 6 Months classes. (Save $50).</p>\r\n\r\n<p>once a week class.</p>\r\n\r\n<p>Art supplies not included.</p>', '<ul>\r\n	<li>Fundamentals of drawing</li>\r\n	<li>Basic shapes</li>\r\n	<li>Basic composition</li>\r\n	<li>Basic pencil Shading</li>\r\n	<li>Drawing from imagination</li>\r\n	<li>Color theory</li>\r\n	<li>Basic painting</li>\r\n	<li>Basic color combination</li>\r\n	<li>Texture &amp; Pattern drawing</li>\r\n	<li>Landscape</li>\r\n</ul>\r\n\r\n<ul>\r\n	<li>character or cartoon drawing</li>\r\n	<li>basic still life drawing</li>\r\n	<li>Fruits &amp; vegetables drawing Basic Shapes ad lines -</li>\r\n	<li>Animal &amp; Object Drawing</li>\r\n	<li>Color theory</li>\r\n	<li>Hand on practice with pencils, crayons, markers and more</li>\r\n	<li>Understanding simple proportion of object like tall, short, big &amp; small</li>\r\n	<li>Nature &amp; Environment drawing which includes Animal, plants, Landscapes</li>\r\n	<li>Drawing from imagination</li>\r\n	<li>Pattern &amp; texture like Dots, Stripes</li>\r\n</ul>', 1, 0, '2025-04-09 12:33:09', '2025-06-28 20:01:21'),
(35, 8, '1 Month Classes', 4, 95.00, '1744304064.jpg', '<p>Class Duration : 1.5 hour</p>\r\n\r\n<p>Cost : $95 for 1 Month Classes.</p>\r\n\r\n<p>Once a week class.</p>\r\n\r\n<p>Art supplies not included</p>', '<ul>\r\n	<li>Basic shapes &amp; lines practice</li>\r\n	<li>Basic Drawing Fundamentals</li>\r\n	<li>Value Study which includes pencil shading</li>\r\n	<li>Different sketching &amp; Drawing techniques</li>\r\n</ul>', 1, 0, '2025-04-09 13:04:08', '2025-06-28 19:56:18'),
(36, 8, '3 Months Classes', 12, 255.00, '1744304148.jpg', '<p>Class Duration : 1.5 hour</p>\r\n\r\n<p>Cost : <s>$285 for 3 Month Classes.</s></p>\r\n\r\n<p>$255 For 3 Months Classes ( Save $30)</p>\r\n\r\n<p>Once a week class.</p>\r\n\r\n<p>&nbsp;Art supplies not included</p>', '<ul>\r\n	<li>Basic Drawing Fundamentals</li>\r\n	<li>Value study&nbsp;</li>\r\n	<li>Different sketching &amp; Drawing techniques</li>\r\n	<li>Pencil shading</li>\r\n	<li>Oil Pastels&nbsp;</li>\r\n	<li>color pencils Drwaing</li>\r\n	<li>Still life Drawing</li>\r\n	<li>Landscape Drawing</li>\r\n</ul>', 1, 0, '2025-04-09 13:15:32', '2025-06-28 19:56:44'),
(37, 8, '1 Month Subscription', 10, 2000.00, '1744269643.jpg', '<p>test</p>', '<p>test</p>', 1, 1, '2025-04-10 03:20:43', '2025-04-10 12:33:55'),
(38, 8, '6 Months Classes', 24, 520.00, '1744303216.jpg', '<p>Class Duration : 1.5&nbsp; Hour</p>\r\n\r\n<p>Cost :&nbsp;<s>$ 570 for 6 Months Classes.</s></p>\r\n\r\n<p>$ 520 for 6 Months classes. (Save $50).</p>\r\n\r\n<p>once a week class.</p>\r\n\r\n<p>Art supplies not included.</p>', '<ul>\r\n	<li>Basic Drawing Fundamentals</li>\r\n	<li>Value study which includes pencil shading</li>\r\n	<li>Different sketching &amp; Drawing techniques</li>\r\n	<li>Still life Drawing</li>\r\n	<li>Bird or Animal Drawing</li>\r\n	<li>Color pencils Drawing</li>\r\n	<li>Watercolor painting</li>\r\n	<li>Oil Pastels drawing</li>\r\n	<li>Seasonal OR festive special drawing &amp; painting OR craft</li>\r\n	<li>Drawing from Observation</li>\r\n	<li>Drawing from Imagination</li>\r\n	<li>Light &amp; Shadow</li>\r\n	<li>Shading techniques hatching, crosshatching, blending, stippling etc.</li>\r\n	<li>Cartooning &amp; Anime Drawing</li>\r\n	<li>Landscapes and Nature</li>\r\n	<li>Mixed Media</li>\r\n	<li>Advanced Color theory</li>\r\n	<li>Blending Colors</li>\r\n	<li>Perspective Drawing</li>\r\n</ul>', 1, 0, '2025-04-10 12:40:16', '2025-06-28 19:59:19'),
(39, 25, 'Smart Kidoo\'s 1', 41, 501.00, '1746424856.jpg', '<p>test test1</p>', '<p>test test test1</p>', 1, 1, '2025-05-05 02:00:56', '2025-05-05 06:05:35'),
(40, 8, 'skglggkg', 10, 2000.00, '1746709808.jpg', '<p>lskjklkgkjgk</p>', '<p>sdkdkjgklgjlg</p>', 1, 1, '2025-05-08 09:10:08', '2025-05-08 09:10:12');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(2, 'User', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06'),
(3, 'Reseller', 'web', '2022-09-12 04:33:06', '2022-09-12 04:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `sendemaildetails`
--

CREATE TABLE `sendemaildetails` (
  `id` int(11) NOT NULL,
  `strSubject` varchar(50) DEFAULT NULL,
  `strTitle` varchar(50) DEFAULT NULL,
  `strFromMail` varchar(250) DEFAULT NULL,
  `ToMail` varchar(250) DEFAULT NULL,
  `strCC` varchar(250) DEFAULT NULL,
  `strBCC` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `sendemaildetails`
--

INSERT INTO `sendemaildetails` (`id`, `strSubject`, `strTitle`, `strFromMail`, `ToMail`, `strCC`, `strBCC`) VALUES
(1, 'Login Otp', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, '', ''),
(2, 'Forget Password', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(3, 'Payment Request', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(4, 'Payment Confirmation', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(11, 'Contact Us', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(12, 'Trial Class Registration', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(13, 'Registration', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(14, 'Renewal Request From Kitten Art Classes', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(15, 'Trial Class Schedule', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(16, 'Cancel Subscription', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL),
(17, 'Renewal Successes', 'Kitten Art Class', 'no-reply@kittenart.com', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_images`
--

CREATE TABLE `service_images` (
  `service_image_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `service_images`
--

INSERT INTO `service_images` (`service_image_id`, `service_id`, `image`) VALUES
(6, 1, '1738310627_swee-768x493.png'),
(7, 1, '1738322837_images (12).jpeg'),
(8, 1, '1738322837_f05b43fbaae09fd8bfd7450f28fa8aff.jpg'),
(10, 1, '1738322837_images (11).jpeg'),
(11, 1, '1738322837_images (10).jpeg'),
(12, 1, '1738322837_images (9).jpeg'),
(13, 1, '1738322837_1736329356.jpeg'),
(25, 3, '1746692288_th (1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service_master`
--

CREATE TABLE `service_master` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` longtext NOT NULL,
  `iStatus` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `service_master`
--

INSERT INTO `service_master` (`service_id`, `service_name`, `slug`, `image`, `description`, `iStatus`, `isDelete`, `created_at`, `updated_at`) VALUES
(1, 'summer camp', 'summer-camp', '1736421513.jpg', '<p>Summer camp is a specially crafted program designed for children and teenagers during their summer vacation holidays as they come together and have fun while learning lifelong lessons. It generally involves various outdoor activities, games, sports, music, arts &amp; crafts, and educational programs among other activities that aim to impart new skills and foster personal growth in children. Summer camps are usually organised by schools, churches, community centers, and other organisations.<br />\r\n&nbsp;</p>', 1, 0, '2024-12-30 09:00:16', '2025-01-09 11:18:33'),
(2, 'Paint Party', 'paint-party', '1745937667.jpg', '<p>An &quot;art party at your door&quot; could be a mobile art studio service that brings the creativity directly to your home or event venue. We will bring all the art supplies you need for your Paint Party, pulling up to your door. Whether it&#39;s for a birthday celebration, a team-building event, or simply a fun gathering with friends, having the art party come to you eliminates the need for travel and setup logistics. It&#39;s a convenient way to spark creativity and make memories without having to leave the comfort of your own space. Plus, with an experienced instructor or facilitator on hand, everyone can enjoy the artistic process and create something special together. It&#39;s like a paint-and-sip experience, but with the added convenience of being at your doorstep! If you&#39;re interested in hosting an art paint party mobile event, please fill out the form below to learn more about how our event works, get pricing and start planning of your mobile paint party!</p>', 1, 0, '2025-04-16 04:20:43', '2025-04-29 10:41:07');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `sitename` varchar(5000) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `api_key` varchar(1000) DEFAULT NULL,
  `iStatus` int(11) NOT NULL DEFAULT 1,
  `isDelete` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `strIP` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `sitename`, `logo`, `email`, `api_key`, `iStatus`, `isDelete`, `created_at`, `updated_at`, `strIP`) VALUES
(1, 'Kitten Art Class', NULL, 'kittenart15@gmail.com', 'test', 1, 0, '2024-07-11 05:20:17', NULL, '103.1.100.226');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `attendence_id` int(11) NOT NULL,
  `sattendanceid` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance` varchar(11) NOT NULL COMMENT 'A=Absent P=Present',
  `subscription_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `day` varchar(11) NOT NULL,
  `attendance_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`attendence_id`, `sattendanceid`, `student_id`, `attendance`, `subscription_id`, `plan_id`, `batch_id`, `day`, `attendance_date`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'P', 1, 30, 18, '2', '2025-07-28', '2025-08-01 12:06:59', '2025-08-01 12:06:59'),
(2, 2, 1, 'P', 1, 30, 18, '2', '2025-07-29', '2025-08-01 12:07:29', '2025-08-01 12:07:29'),
(3, 3, 1, 'P', 1, 30, 18, '2', '2025-07-30', '2025-08-01 12:07:55', '2025-08-01 12:07:55'),
(4, 4, 1, 'P', 1, 33, 18, '2', '2025-07-31', '2025-08-01 12:12:54', '2025-08-01 12:12:54'),
(5, 5, 1, 'P', 2, 33, 18, '2', '2025-07-01', '2025-08-01 12:18:41', '2025-08-01 12:18:41'),
(6, 6, 1, 'P', 2, 33, 18, '2', '2025-07-02', '2025-08-01 12:23:08', '2025-08-01 12:33:02'),
(7, 7, 1, 'P', 2, 33, 18, '2', '2025-07-03', '2025-08-01 12:23:24', '2025-08-22 12:21:36'),
(8, 8, 2, 'P', 4, 30, 22, '6', '2025-08-04', '2025-08-04 06:37:19', '2025-08-04 06:37:19'),
(9, 9, 3, 'P', 5, 35, 20, '3', '2025-07-30', '2025-08-05 09:26:30', '2025-08-05 09:26:30'),
(10, 10, 3, 'P', 5, 35, 20, '3', '2025-08-05', '2025-08-05 09:28:53', '2025-08-05 09:28:53'),
(11, 9, 4, 'P', 6, 35, 20, '3', '2025-07-30', '2025-08-07 10:32:30', '2025-08-07 10:32:30'),
(12, 11, 4, 'P', 6, 35, 20, '3', '2025-08-06', '2025-08-07 10:32:58', '2025-08-07 10:32:58'),
(13, 12, 4, 'P', 6, 35, 20, '3', '2025-07-23', '2025-08-07 10:33:26', '2025-08-07 10:33:26'),
(14, 13, 4, 'P', 6, 35, 20, '3', '2025-07-16', '2025-08-07 10:37:42', '2025-08-07 10:37:42'),
(15, 14, 3, 'P', 5, 35, 20, '3', '2025-08-07', '2025-08-07 10:38:34', '2025-08-07 10:38:34'),
(16, 15, 3, 'P', 5, 35, 20, '3', '2025-07-09', '2025-08-07 10:38:58', '2025-08-07 10:38:58'),
(17, 16, 5, 'P', 7, 30, 18, '2', '2025-08-05', '2025-08-18 17:12:00', '2025-08-18 17:12:00'),
(18, 17, 5, 'P', 7, 30, 18, '2', '2025-08-12', '2025-08-18 17:12:27', '2025-08-18 17:12:27'),
(19, 2, 5, 'P', 7, 30, 18, '2', '2025-07-29', '2025-08-18 17:12:45', '2025-08-18 17:12:45'),
(20, 18, 6, 'P', 8, 35, 20, '3', '2025-08-22', '2025-08-22 10:40:30', '2025-08-22 10:40:30'),
(21, 19, 6, 'P', 8, 35, 20, '3', '2025-08-13', '2025-08-22 10:41:10', '2025-08-22 10:41:10'),
(22, 11, 6, 'P', 8, 35, 20, '3', '2025-08-06', '2025-08-22 10:41:45', '2025-08-22 10:41:45'),
(23, 18, 7, 'P', 9, 35, 20, '3', '2025-08-22', '2025-08-22 11:44:25', '2025-08-22 11:44:25'),
(24, 20, 7, 'P', 9, 35, 20, '3', '2025-08-21', '2025-08-22 11:46:39', '2025-08-22 11:46:39'),
(25, 21, 7, 'P', 9, 35, 20, '3', '2025-08-20', '2025-08-22 11:47:18', '2025-08-22 11:47:18'),
(26, 22, 7, 'P', 9, 35, 20, '3', '2025-08-19', '2025-08-22 11:48:16', '2025-08-22 11:48:16'),
(27, 22, 8, 'P', 10, 35, 20, '3', '2025-08-19', '2025-08-22 11:59:02', '2025-08-22 12:30:14'),
(28, 21, 8, 'P', 10, 35, 20, '3', '2025-08-20', '2025-08-22 11:59:16', '2025-08-22 11:59:16'),
(29, 20, 8, 'P', 10, 35, 20, '3', '2025-08-21', '2025-08-22 11:59:37', '2025-08-22 11:59:37'),
(30, 22, 9, 'P', 12, 35, 20, '3', '2025-08-19', '2025-08-22 12:58:34', '2025-08-22 12:58:34'),
(31, 21, 9, 'P', 12, 35, 20, '3', '2025-08-20', '2025-08-22 12:59:03', '2025-08-22 12:59:03'),
(32, 20, 9, 'P', 12, 35, 20, '3', '2025-08-21', '2025-08-22 12:59:38', '2025-08-22 12:59:38'),
(33, 18, 9, 'P', 12, 35, 20, '3', '2025-08-22', '2025-08-22 13:07:40', '2025-08-22 13:07:40'),
(77, 59, 31, 'P', 37, 30, 17, '1', '2025-10-27', '2025-11-19 11:14:51', '2025-11-19 11:14:51'),
(76, 58, 27, 'P', 34, 35, 20, '3', '2025-11-12', '2025-11-17 10:00:07', '2025-11-17 10:00:07'),
(75, 57, 27, 'P', 34, 35, 20, '3', '2025-11-05', '2025-11-17 09:56:25', '2025-11-17 09:56:25'),
(73, 55, 27, 'P', 34, 35, 20, '3', '2025-10-22', '2025-11-17 09:55:36', '2025-11-17 09:55:36'),
(74, 56, 27, 'P', 34, 35, 20, '3', '2025-10-29', '2025-11-17 09:56:00', '2025-11-17 09:56:00'),
(78, 60, 31, 'P', 37, 30, 17, '1', '2025-11-03', '2025-11-19 11:15:13', '2025-11-19 11:15:13'),
(79, 61, 31, 'P', 37, 30, 17, '1', '2025-11-10', '2025-11-19 11:15:29', '2025-11-19 11:15:29'),
(80, 62, 31, 'P', 37, 30, 17, '1', '2025-11-17', '2025-11-19 11:30:18', '2025-11-19 11:30:18'),
(81, 63, 32, 'P', 39, 30, 18, '2', '2025-11-17', '2025-11-25 10:37:38', '2025-11-25 10:37:38'),
(82, 64, 32, 'P', 39, 30, 18, '2', '2025-11-18', '2025-11-25 10:38:32', '2025-11-25 10:38:32'),
(83, 65, 32, 'P', 39, 30, 18, '2', '2025-11-19', '2025-11-25 10:38:54', '2025-11-25 10:38:54'),
(84, 66, 32, 'P', 39, 30, 18, '2', '2025-11-21', '2025-11-25 10:50:31', '2025-11-25 10:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_master`
--

CREATE TABLE `student_attendance_master` (
  `sattendanceid` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `batch_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `student_attendance_master`
--

INSERT INTO `student_attendance_master` (`sattendanceid`, `attendance_date`, `batch_id`, `created_at`, `updated_at`) VALUES
(1, '2025-07-28', 18, '2025-08-01 12:06:59', '2025-08-01 12:06:59'),
(2, '2025-07-29', 18, '2025-08-01 12:07:29', '2025-08-01 12:07:29'),
(3, '2025-07-30', 18, '2025-08-01 12:07:55', '2025-08-01 12:07:55'),
(4, '2025-07-31', 18, '2025-08-01 12:12:54', '2025-08-01 12:12:54'),
(5, '2025-07-01', 18, '2025-08-01 12:18:41', '2025-08-01 12:18:41'),
(6, '2025-07-02', 18, '2025-08-01 12:23:08', '2025-08-01 12:23:08'),
(7, '2025-07-03', 18, '2025-08-01 12:23:24', '2025-08-01 12:23:24'),
(8, '2025-08-04', 22, '2025-08-04 06:37:19', '2025-08-04 06:37:19'),
(9, '2025-07-30', 20, '2025-08-05 09:26:30', '2025-08-05 09:26:30'),
(10, '2025-08-05', 20, '2025-08-05 09:28:53', '2025-08-05 09:28:53'),
(11, '2025-08-06', 20, '2025-08-07 10:32:58', '2025-08-07 10:32:58'),
(12, '2025-07-23', 20, '2025-08-07 10:33:26', '2025-08-07 10:33:26'),
(13, '2025-07-16', 20, '2025-08-07 10:37:42', '2025-08-07 10:37:42'),
(14, '2025-08-07', 20, '2025-08-07 10:38:34', '2025-08-07 10:38:34'),
(15, '2025-07-09', 20, '2025-08-07 10:38:58', '2025-08-07 10:38:58'),
(16, '2025-08-05', 18, '2025-08-18 17:12:00', '2025-08-18 17:12:00'),
(17, '2025-08-12', 18, '2025-08-18 17:12:27', '2025-08-18 17:12:27'),
(18, '2025-08-22', 20, '2025-08-22 10:40:30', '2025-08-22 10:40:30'),
(19, '2025-08-13', 20, '2025-08-22 10:41:10', '2025-08-22 10:41:10'),
(20, '2025-08-21', 20, '2025-08-22 11:46:39', '2025-08-22 11:46:39'),
(21, '2025-08-20', 20, '2025-08-22 11:47:18', '2025-08-22 11:47:18'),
(22, '2025-08-19', 20, '2025-08-22 11:48:16', '2025-08-22 11:48:16'),
(23, '2025-08-27', 20, '2025-09-03 11:13:09', '2025-09-03 11:13:09'),
(24, '2025-08-26', 18, '2025-09-09 10:42:12', '2025-09-09 10:42:12'),
(25, '2025-09-02', 18, '2025-09-09 10:42:40', '2025-09-09 10:42:40'),
(26, '2025-09-09', 18, '2025-09-09 10:43:03', '2025-09-09 10:43:03'),
(27, '2025-09-01', 17, '2025-09-09 12:07:23', '2025-09-09 12:07:23'),
(28, '2025-09-02', 17, '2025-09-09 12:07:54', '2025-09-09 12:07:54'),
(29, '2025-09-03', 17, '2025-09-09 12:08:15', '2025-09-09 12:08:15'),
(30, '2025-09-04', 17, '2025-09-09 12:12:08', '2025-09-09 12:12:08'),
(31, '2025-09-01', 20, '2025-09-12 05:30:48', '2025-09-12 05:30:48'),
(32, '2025-09-02', 20, '2025-09-12 05:31:18', '2025-09-12 05:31:18'),
(33, '2025-09-03', 20, '2025-09-12 05:31:30', '2025-09-12 05:31:30'),
(66, '2025-11-21', 18, '2025-11-25 10:50:31', '2025-11-25 10:50:31'),
(65, '2025-11-19', 18, '2025-11-25 10:38:54', '2025-11-25 10:38:54'),
(58, '2025-11-12', 20, '2025-11-17 10:00:07', '2025-11-17 10:00:07'),
(57, '2025-11-05', 20, '2025-11-17 09:56:25', '2025-11-17 09:56:25'),
(56, '2025-10-29', 20, '2025-11-17 09:56:00', '2025-11-17 09:56:00'),
(55, '2025-10-22', 20, '2025-11-17 09:55:36', '2025-11-17 09:55:36'),
(64, '2025-11-18', 18, '2025-11-25 10:38:32', '2025-11-25 10:38:32'),
(63, '2025-11-17', 18, '2025-11-25 10:37:38', '2025-11-25 10:37:38'),
(62, '2025-11-17', 17, '2025-11-19 11:30:18', '2025-11-19 11:30:18'),
(61, '2025-11-10', 17, '2025-11-19 11:15:29', '2025-11-19 11:15:29'),
(60, '2025-11-03', 17, '2025-11-19 11:15:13', '2025-11-19 11:15:13'),
(59, '2025-10-27', 17, '2025-11-19 11:14:51', '2025-11-19 11:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `student_inquiry_master`
--

CREATE TABLE `student_inquiry_master` (
  `student_inquiry_id` int(11) NOT NULL,
  `student_first_name` varchar(100) NOT NULL,
  `student_last_name` varchar(100) DEFAULT NULL,
  `student_age` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `plan_id` int(11) NOT NULL DEFAULT 0 COMMENT 'intrested plan',
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `communication_mode` int(11) NOT NULL COMMENT '1=whatsapp,2=email,3=text sms	',
  `status` int(11) NOT NULL COMMENT '0=pending,1=rejected',
  `iStatus` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(4) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_ledger`
--

CREATE TABLE `student_ledger` (
  `ledger_id` int(11) NOT NULL,
  `attendence_id` int(11) NOT NULL,
  `attendence_detail_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `opening_balance` int(11) NOT NULL,
  `credit_balance` int(11) NOT NULL,
  `debit_balance` int(11) NOT NULL,
  `closing_balance` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `student_ledger`
--

INSERT INTO `student_ledger` (`ledger_id`, `attendence_id`, `attendence_detail_id`, `student_id`, `subscription_id`, `opening_balance`, `credit_balance`, `debit_balance`, `closing_balance`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 1, 1, 0, 4, 0, 4, '2025-08-01 12:04:41', '2025-08-01 12:04:41'),
(2, 1, 1, 1, 1, 4, 0, 1, 3, '2025-08-01 12:06:59', '2025-08-01 12:06:59'),
(3, 2, 2, 1, 1, 3, 0, 1, 2, '2025-08-01 12:07:29', '2025-08-01 12:07:29'),
(4, 3, 3, 1, 1, 2, 0, 1, 1, '2025-08-01 12:07:55', '2025-08-01 12:07:55'),
(5, 0, 0, 1, 2, 0, 12, 0, 12, '2025-08-01 12:12:10', '2025-08-01 12:12:10'),
(6, 4, 4, 1, 1, 1, 0, 1, 0, '2025-08-01 12:12:54', '2025-08-01 12:12:54'),
(7, 5, 5, 1, 2, 12, 0, 1, 11, '2025-08-01 12:18:41', '2025-08-01 12:18:41'),
(8, 6, 6, 1, 2, 11, 0, 1, 10, '2025-08-01 12:23:08', '2025-08-01 12:23:08'),
(9, 7, 7, 1, 2, 10, 0, 1, 9, '2025-08-01 12:23:24', '2025-08-01 12:23:24'),
(10, 6, 6, 1, 2, 9, 1, 0, 10, '2025-08-01 12:26:54', '2025-08-01 12:26:54'),
(11, 6, 6, 1, 2, 10, 0, 1, 9, '2025-08-01 12:33:02', '2025-08-01 12:33:02'),
(12, 0, 0, 1, 3, 0, 24, 0, 24, '2025-08-01 12:38:21', '2025-08-01 12:38:21'),
(13, 0, 0, 2, 4, 0, 4, 0, 4, '2025-08-04 06:36:57', '2025-08-04 06:36:57'),
(14, 8, 8, 2, 4, 4, 0, 1, 3, '2025-08-04 06:37:19', '2025-08-04 06:37:19'),
(15, 0, 0, 3, 5, 0, 4, 0, 4, '2025-08-05 09:25:13', '2025-08-05 09:25:13'),
(16, 9, 9, 3, 5, 4, 0, 1, 3, '2025-08-05 09:26:30', '2025-08-05 09:26:30'),
(17, 10, 10, 3, 5, 3, 0, 1, 2, '2025-08-05 09:28:53', '2025-08-05 09:28:53'),
(18, 0, 0, 4, 6, 0, 4, 0, 4, '2025-08-07 10:31:33', '2025-08-07 10:31:33'),
(19, 9, 11, 4, 6, 4, 0, 1, 3, '2025-08-07 10:32:30', '2025-08-07 10:32:30'),
(20, 11, 12, 4, 6, 3, 0, 1, 2, '2025-08-07 10:32:58', '2025-08-07 10:32:58'),
(21, 12, 13, 4, 6, 2, 0, 1, 1, '2025-08-07 10:33:26', '2025-08-07 10:33:26'),
(22, 13, 14, 4, 6, 1, 0, 1, 0, '2025-08-07 10:37:42', '2025-08-07 10:37:42'),
(23, 14, 15, 3, 5, 2, 0, 1, 1, '2025-08-07 10:38:34', '2025-08-07 10:38:34'),
(24, 15, 16, 3, 5, 1, 0, 1, 0, '2025-08-07 10:38:58', '2025-08-07 10:38:58'),
(25, 0, 0, 5, 7, 0, 4, 0, 4, '2025-08-18 17:11:23', '2025-08-18 17:11:23'),
(26, 16, 17, 5, 7, 4, 0, 1, 3, '2025-08-18 17:12:00', '2025-08-18 17:12:00'),
(27, 17, 18, 5, 7, 3, 0, 1, 2, '2025-08-18 17:12:27', '2025-08-18 17:12:27'),
(28, 2, 19, 5, 7, 2, 0, 1, 1, '2025-08-18 17:12:45', '2025-08-18 17:12:45'),
(29, 0, 0, 6, 8, 0, 4, 0, 4, '2025-08-22 10:39:26', '2025-08-22 10:39:26'),
(30, 18, 20, 6, 8, 4, 0, 1, 3, '2025-08-22 10:40:30', '2025-08-22 10:40:30'),
(31, 19, 21, 6, 8, 3, 0, 1, 2, '2025-08-22 10:41:10', '2025-08-22 10:41:10'),
(32, 11, 22, 6, 8, 2, 0, 1, 1, '2025-08-22 10:41:45', '2025-08-22 10:41:45'),
(33, 0, 0, 7, 9, 0, 4, 0, 4, '2025-08-22 11:43:38', '2025-08-22 11:43:38'),
(34, 18, 23, 7, 9, 4, 0, 1, 3, '2025-08-22 11:44:25', '2025-08-22 11:44:25'),
(35, 20, 24, 7, 9, 3, 0, 1, 2, '2025-08-22 11:46:39', '2025-08-22 11:46:39'),
(36, 21, 25, 7, 9, 2, 0, 1, 1, '2025-08-22 11:47:18', '2025-08-22 11:47:18'),
(37, 22, 26, 7, 9, 1, 0, 1, 0, '2025-08-22 11:48:16', '2025-08-22 11:48:16'),
(38, 0, 0, 8, 10, 0, 4, 0, 4, '2025-08-22 11:58:08', '2025-08-22 11:58:08'),
(39, 22, 27, 8, 10, 4, 0, 1, 3, '2025-08-22 11:59:02', '2025-08-22 11:59:02'),
(40, 21, 28, 8, 10, 3, 0, 1, 2, '2025-08-22 11:59:16', '2025-08-22 11:59:16'),
(41, 20, 29, 8, 10, 2, 0, 1, 1, '2025-08-22 11:59:37', '2025-08-22 11:59:37'),
(42, 7, 7, 1, 2, 9, 1, 0, 10, '2025-08-22 12:21:28', '2025-08-22 12:21:28'),
(43, 7, 7, 1, 2, 10, 0, 1, 9, '2025-08-22 12:21:36', '2025-08-22 12:21:36'),
(44, 27, 22, 8, 10, 1, 1, 0, 2, '2025-08-22 12:30:05', '2025-08-22 12:30:05'),
(45, 27, 22, 8, 10, 2, 0, 1, 1, '2025-08-22 12:30:14', '2025-08-22 12:30:14'),
(46, 0, 0, 4, 11, 0, 4, 0, 4, '2025-08-22 12:54:43', '2025-08-22 12:54:43'),
(47, 0, 0, 9, 12, 0, 4, 0, 4, '2025-08-22 12:57:59', '2025-08-22 12:57:59'),
(48, 22, 30, 9, 12, 4, 0, 1, 3, '2025-08-22 12:58:34', '2025-08-22 12:58:34'),
(49, 21, 31, 9, 12, 3, 0, 1, 2, '2025-08-22 12:59:03', '2025-08-22 12:59:03'),
(50, 20, 32, 9, 12, 2, 0, 1, 1, '2025-08-22 12:59:38', '2025-08-22 12:59:38'),
(51, 18, 33, 9, 12, 1, 0, 1, 0, '2025-08-22 13:07:40', '2025-08-22 13:07:40'),
(52, 0, 0, 9, 13, 0, 4, 0, 4, '2025-08-22 13:15:55', '2025-08-22 13:15:55'),
(116, 58, 76, 27, 34, 1, 0, 1, 0, '2025-11-17 10:00:07', '2025-11-17 10:00:07'),
(115, 57, 75, 27, 34, 2, 0, 1, 1, '2025-11-17 09:56:25', '2025-11-17 09:56:25'),
(114, 56, 74, 27, 34, 3, 0, 1, 2, '2025-11-17 09:56:00', '2025-11-17 09:56:00'),
(113, 55, 73, 27, 34, 4, 0, 1, 3, '2025-11-17 09:55:36', '2025-11-17 09:55:36'),
(112, 0, 0, 27, 34, 0, 4, 0, 4, '2025-11-17 09:54:48', '2025-11-17 09:54:48'),
(129, 66, 84, 32, 39, 1, 0, 1, 0, '2025-11-25 10:50:31', '2025-11-25 10:50:31'),
(128, 65, 83, 32, 39, 2, 0, 1, 1, '2025-11-25 10:38:54', '2025-11-25 10:38:54'),
(127, 64, 82, 32, 39, 3, 0, 1, 2, '2025-11-25 10:38:32', '2025-11-25 10:38:32'),
(126, 63, 81, 32, 39, 4, 0, 1, 3, '2025-11-25 10:37:38', '2025-11-25 10:37:38'),
(125, 0, 0, 32, 39, 0, 4, 0, 4, '2025-11-25 10:36:20', '2025-11-25 10:36:20'),
(124, 0, 0, 31, 38, 0, 4, 0, 4, '2025-11-19 11:34:06', '2025-11-19 11:34:06'),
(123, 62, 80, 31, 37, 1, 0, 1, 0, '2025-11-19 11:30:18', '2025-11-19 11:30:18'),
(122, 61, 79, 31, 37, 2, 0, 1, 1, '2025-11-19 11:15:29', '2025-11-19 11:15:29'),
(121, 60, 78, 31, 37, 3, 0, 1, 2, '2025-11-19 11:15:13', '2025-11-19 11:15:13'),
(120, 59, 77, 31, 37, 4, 0, 1, 3, '2025-11-19 11:14:51', '2025-11-19 11:14:51'),
(119, 0, 0, 31, 37, 0, 4, 0, 4, '2025-11-19 11:12:55', '2025-11-19 11:12:55'),
(118, 0, 0, 28, 36, 0, 4, 0, 4, '2025-11-17 10:18:49', '2025-11-17 10:18:49'),
(117, 0, 0, 27, 35, 0, 4, 0, 4, '2025-11-17 10:00:30', '2025-11-17 10:00:30'),
(130, 0, 0, 32, 40, 0, 4, 0, 4, '2025-11-25 10:50:53', '2025-11-25 10:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `student_master`
--

CREATE TABLE `student_master` (
  `student_id` int(11) NOT NULL,
  `student_first_name` varchar(100) NOT NULL,
  `student_last_name` varchar(100) NOT NULL,
  `student_age` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL DEFAULT 0 COMMENT 'intrested plan',
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `login_id` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isWaiting` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1= waiting',
  `isRegister` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=register',
  `isPaid` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=paid',
  `communication_mode` int(11) NOT NULL COMMENT '1=whatsapp,2=email,3=text sms',
  `token` varchar(255) DEFAULT NULL,
  `token_time` datetime DEFAULT NULL,
  `iStatus` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(4) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `student_master`
--

INSERT INTO `student_master` (`student_id`, `student_first_name`, `student_last_name`, `student_age`, `mobile`, `email`, `parent_name`, `category_id`, `plan_id`, `batch_id`, `login_id`, `password`, `isWaiting`, `isRegister`, `isPaid`, `communication_mode`, `token`, `token_time`, `iStatus`, `isDelete`, `created_at`, `updated_at`) VALUES
(31, 'Shaili', 'Gandhi', '7', '9802545836', 'maanukush@gmail.com', 'Manushi shah', 1, 30, 17, 'Kac31', '$2y$10$YTvN5kxcbH/4vj.qHwK9je3DlN0LxGTYuPsJ/QPJ9looR.69fykFO', 0, 1, 1, 3, NULL, NULL, 1, 0, '2025-11-19 11:12:41', '2025-11-19 11:34:09'),
(32, 'Anant', 'Shah', '6', '9824773136', 'shahkrunal83@gmail.com', 'Krunal Shah', 1, 30, 18, 'Kac32', '$2y$10$5Ac0mFRiSRP.uvnDPejPo.UBUIhkGZlCP6V.yrOENYtxpCP6W.0Qa', 0, 1, 1, 1, NULL, NULL, 1, 0, '2025-11-25 10:35:53', '2025-11-25 10:50:59'),
(11, 'test', 'user', '12', '9874589878', 'dev4.apolloinfotech@gmail.com', 'test user', 8, 35, 20, 'Kac11', '$2y$10$8zLstwh5N3dvytDf5E06/eJLLa4I4LJ330e0IhgxlEx4t/4lvUhBC', 0, 1, 1, 2, NULL, NULL, 1, 0, '2025-08-23 06:16:35', '2025-08-23 06:16:46'),
(30, 'Shail', 'Gandhi', '7', '9898098980', 'shail.gandhi132@gmail.com', 'Nitin Gandhi', 1, 33, 18, 'Kac30', '$2y$10$pR9Gy74bSwgSZhx/52zlVuZTwP765JJJOlTocN7Ao5OR3oz8hd.7S', 0, 1, 0, 1, NULL, NULL, 1, 0, '2025-11-19 11:07:19', '2025-11-19 11:07:19'),
(27, 'Nak', 'Shah', '11', '3123838478', 'nushah132@gmail.com', 'Naksh Shah', 8, 35, 20, 'Kac27', '$2y$10$cvgDcp2eMS3QG.m0ecVyh.cJqjsXyaLu3cEjJd3m6SxkTOTVlaQrK', 0, 1, 1, 2, NULL, NULL, 1, 0, '2025-11-17 09:54:27', '2025-11-17 10:00:35'),
(28, 'Nick', 'pat', '8', '3123838478', 'Nushah132@gmail.com', 'Shah', 1, 30, 22, 'Kac28', '$2y$10$mHVEko9Y3KFpiBe7apP.nO0zlDGgtfzccN0YMxYExLXguRr8RmkdS', 0, 1, 1, 2, NULL, NULL, 1, 0, '2025-11-17 10:18:36', '2025-11-17 10:18:49'),
(29, 'Navi', 'Ambani', '8', '3123838478', 'nushah132@gmail.com', 'Shah', 1, 30, 22, 'Kac29', '$2y$10$Hc9abSmJGqHdcWMoKHhGquVW5bVarF3VPzmDveBfKIaLuJcf5J/uO', 0, 1, 0, 2, NULL, NULL, 1, 0, '2025-11-17 10:20:32', '2025-11-17 10:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `student_renew_plan`
--

CREATE TABLE `student_renew_plan` (
  `renewplan_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `amount` varchar(11) NOT NULL,
  `plan_session` int(11) NOT NULL,
  `status` varchar(11) NOT NULL DEFAULT '0' COMMENT '0=pending,1=sccepted,2=rejected',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `student_renew_plan`
--

INSERT INTO `student_renew_plan` (`renewplan_id`, `student_id`, `category_id`, `plan_id`, `batch_id`, `amount`, `plan_session`, `status`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 33, 22, '200.00', 12, '1', '2025-08-04 10:37:52', '2025-08-04 10:37:52'),
(6, 9, 8, 36, 20, '255.00', 12, '1', '2025-08-22 17:00:43', '2025-08-22 17:00:43'),
(5, 8, 8, 35, 20, '95.00', 4, '2', '2025-08-22 16:32:36', '2025-08-22 16:32:36'),
(7, 9, 8, 36, 20, '255.00', 12, '1', '2025-08-22 17:04:38', '2025-08-22 17:04:38'),
(10, 11, 8, 36, 21, '255.00', 12, '0', '2025-08-23 10:19:06', '2025-08-23 10:19:06'),
(11, 14, 8, 36, 20, '255.00', 12, '1', '2025-09-03 15:16:01', '2025-09-03 15:16:01'),
(14, 20, 8, 35, 20, '95.00', 4, '0', '2025-09-12 09:50:55', '2025-09-12 09:50:55'),
(15, 24, 1, 30, 18, '75.00', 4, '1', '2025-11-03 18:25:04', '2025-11-03 18:25:04'),
(16, 25, 8, 35, 20, '95.00', 4, '1', '2025-11-03 18:41:47', '2025-11-03 18:41:47');

-- --------------------------------------------------------

--
-- Table structure for table `student_subscription`
--

CREATE TABLE `student_subscription` (
  `subscription_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `total_session` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '1=active,0=Inactive',
  `activate_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `student_subscription`
--

INSERT INTO `student_subscription` (`subscription_id`, `student_id`, `plan_id`, `batch_id`, `category_id`, `total_session`, `amount`, `status`, `activate_date`, `expired_date`, `created_at`, `updated_at`) VALUES
(1, 1, 30, 18, 1, 4, 75, 0, '2025-08-01', '2025-08-01', '2025-08-01 12:04:41', '2025-08-01 12:12:54'),
(2, 1, 33, 17, 1, 12, 200, 1, '2025-08-01', '2025-08-01', '2025-08-01 12:12:10', '2025-08-01 12:12:10'),
(3, 1, 34, 18, 1, 24, 450, 1, '2025-08-01', '2025-08-01', '2025-08-01 12:38:21', '2025-08-01 12:38:21'),
(4, 2, 30, 22, 1, 4, 75, 1, '2025-08-04', '2025-08-04', '2025-08-04 06:36:57', '2025-08-04 06:36:57'),
(5, 3, 35, 20, 8, 4, 95, 0, '2025-08-05', '2025-08-05', '2025-08-05 09:25:13', '2025-08-07 10:38:58'),
(6, 4, 35, 20, 8, 4, 95, 0, '2025-08-07', '2025-08-07', '2025-08-07 10:31:33', '2025-08-07 10:37:42'),
(7, 5, 30, 18, 1, 4, 75, 1, '2025-08-18', '2025-08-18', '2025-08-18 17:11:23', '2025-08-18 17:11:23'),
(8, 6, 35, 20, 8, 4, 95, 1, '2025-08-22', '2025-08-22', '2025-08-22 10:39:26', '2025-08-22 10:39:26'),
(9, 7, 35, 20, 8, 4, 95, 0, '2025-08-22', '2025-08-22', '2025-08-22 11:43:38', '2025-08-22 11:48:16'),
(10, 8, 35, 20, 8, 4, 95, 1, '2025-08-22', '2025-08-22', '2025-08-22 11:58:08', '2025-08-22 11:58:08'),
(11, 4, 35, 20, 8, 4, 95, 1, '2025-08-22', '2025-08-22', '2025-08-22 12:54:43', '2025-08-22 12:54:43'),
(12, 9, 35, 20, 8, 4, 95, 0, '2025-08-22', '2025-08-22', '2025-08-22 12:57:59', '2025-08-22 13:07:40'),
(13, 9, 35, 20, 8, 4, 95, 1, '2025-08-22', '2025-08-22', '2025-08-22 13:15:55', '2025-08-22 13:15:55'),
(39, 32, 30, 18, 1, 4, 75, 0, '2025-11-25', '2025-11-25', '2025-11-25 10:36:20', '2025-11-25 10:50:31'),
(38, 31, 30, 17, 1, 4, 75, 1, '2025-11-19', '2025-11-19', '2025-11-19 11:34:06', '2025-11-19 11:34:06'),
(34, 27, 35, 20, 8, 4, 95, 0, '2025-11-17', '2025-11-17', '2025-11-17 09:54:48', '2025-11-17 10:00:07'),
(36, 28, 30, 22, 1, 4, 75, 1, '2025-11-17', '2025-11-17', '2025-11-17 10:18:49', '2025-11-17 10:18:49'),
(37, 31, 30, 17, 1, 4, 75, 0, '2025-11-19', '2025-11-19', '2025-11-19 11:12:55', '2025-11-19 11:30:18'),
(35, 27, 35, 20, 8, 4, 95, 1, '2025-11-17', '2025-11-17', '2025-11-17 10:00:30', '2025-11-17 10:00:30'),
(40, 32, 30, 18, 1, 4, 75, 1, '2025-11-25', '2025-11-25', '2025-11-25 10:50:53', '2025-11-25 10:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `testimonial_id` int(11) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `parent_photo` varchar(100) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_photo` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending,1=approve,2=reject'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`testimonial_id`, `parent_name`, `parent_photo`, `student_name`, `student_photo`, `description`, `status`) VALUES
(17, 'Swathi', '', 'Shloka', '', 'My daughter has been going to Kitten Art Classes for couple of months now and I can confidently say that Manushi’s passion for art and dedication towards teaching are truly inspiring. Each class is thoughtfully planned, blending creativity with technique, and encouraging kids to explore their own unique styles.\r\n\r\nWhat makes kitten Art stand out is not just the skill level, but the ability to connect with students at every level. Whether someone is a beginner or more advanced, Manushi provides individualized support and feedback that helps kids grow with their creativity.\r\n\r\nI highly recommend Manushi & Kitten Art Classes to anyone looking to grow creatively and be inspired along the way.', 1),
(18, 'Sonia', '', 'Paul', '', '<p>Manushi is a great teacher, the first class my kiddo was a bit nervous and shy but she won him over. He enjoys the class and I don&rsquo;t have to tell him to practice. She makes it a point to work with the kid at their skill level.</p>', 1),
(20, 'Sushri', '', 'Aaryana', '', 'My daughter immensely enjoys her Kitten Art Class. As a parent entrusting my daughter\'s artistic journey to Mrs. Manushi, I\'ve witnessed firsthand her unparalleled dedication and skill in nurturing young talents.\r\n\r\nTechnicality is the cornerstone of Mrs. Manushi\'s teaching approach. She doesn\'t just teach students how to paint or draw; she instills in them a profound understanding of techniques, materials, and artistic principles. What sets Mrs. Manushi apart is her genuine interest in her students\' growth. She takes the time to understand each child\'s unique strengths and challenges, tailoring her guidance to suit their individual needs.\r\n\r\nI wholeheartedly recommend her to anyone seeking a truly transformative artistic experience for their child.', 1),
(11, 'M.Moss', '', 'Aliyah', '', '<p>My daughter has had an awesome experience taking classes here. For her age group, there are a lot children her age. Her teacher is responsive and is a personable. She helps facilitate the skills my daughter needs to be improve her skills.</p>', 1),
(21, 'Natalie', '', 'Suzy', '', 's a person with some background in art and design I am very pleased with the curriculum Manushi developed. My daughter learns a lot at the class and is very eager to keep drawing at home. The quality of her work has increased noticeably in the past several months.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `trial_master`
--

CREATE TABLE `trial_master` (
  `trialclass_student_id` int(11) NOT NULL,
  `student_first_name` varchar(100) NOT NULL,
  `student_last_name` varchar(100) NOT NULL,
  `student_age` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `parent_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL DEFAULT 0 COMMENT 'intrested plan',
  `batch_id` int(11) NOT NULL DEFAULT 0,
  `no_of_reminder_sent` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL COMMENT '0=pending,1=converted,2=discarded',
  `iStatus` tinyint(4) NOT NULL DEFAULT 1,
  `isDelete` tinyint(4) DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT 2 COMMENT '1=Admin, 2=Customer,3=Reseller',
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile_number`, `email_verified_at`, `password`, `role_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super', 'Admin', 'admin@admin.com', '9028187696', NULL, '$2y$10$sQ98BbFv7oQ5lwY5B08L3emU7rHN.oAG8i3S9mnj6A3HetOdkve/C', 1, 1, NULL, '2022-09-12 04:33:06', '2025-03-04 05:54:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`bannerId`);

--
-- Indexes for table `batch_master`
--
ALTER TABLE `batch_master`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `ebook_master`
--
ALTER TABLE `ebook_master`
  ADD PRIMARY KEY (`ebook_id`);

--
-- Indexes for table `ebook_registration`
--
ALTER TABLE `ebook_registration`
  ADD PRIMARY KEY (`ebook_registration_id`);

--
-- Indexes for table `event_master`
--
ALTER TABLE `event_master`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `gallery_master`
--
ALTER TABLE `gallery_master`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `home_page`
--
ALTER TABLE `home_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `inquiry`
--
ALTER TABLE `inquiry`
  ADD PRIMARY KEY (`inquiry_id`);

--
-- Indexes for table `plan_master`
--
ALTER TABLE `plan_master`
  ADD PRIMARY KEY (`planId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `sendemaildetails`
--
ALTER TABLE `sendemaildetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_images`
--
ALTER TABLE `service_images`
  ADD PRIMARY KEY (`service_image_id`);

--
-- Indexes for table `service_master`
--
ALTER TABLE `service_master`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
  ADD PRIMARY KEY (`attendence_id`);

--
-- Indexes for table `student_attendance_master`
--
ALTER TABLE `student_attendance_master`
  ADD PRIMARY KEY (`sattendanceid`);

--
-- Indexes for table `student_inquiry_master`
--
ALTER TABLE `student_inquiry_master`
  ADD PRIMARY KEY (`student_inquiry_id`);

--
-- Indexes for table `student_ledger`
--
ALTER TABLE `student_ledger`
  ADD PRIMARY KEY (`ledger_id`);

--
-- Indexes for table `student_master`
--
ALTER TABLE `student_master`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_renew_plan`
--
ALTER TABLE `student_renew_plan`
  ADD PRIMARY KEY (`renewplan_id`);

--
-- Indexes for table `student_subscription`
--
ALTER TABLE `student_subscription`
  ADD PRIMARY KEY (`subscription_id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`testimonial_id`);

--
-- Indexes for table `trial_master`
--
ALTER TABLE `trial_master`
  ADD PRIMARY KEY (`trialclass_student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `bannerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `batch_master`
--
ALTER TABLE `batch_master`
  MODIFY `batch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ebook_master`
--
ALTER TABLE `ebook_master`
  MODIFY `ebook_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ebook_registration`
--
ALTER TABLE `ebook_registration`
  MODIFY `ebook_registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_master`
--
ALTER TABLE `event_master`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gallery_master`
--
ALTER TABLE `gallery_master`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `home_page`
--
ALTER TABLE `home_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inquiry`
--
ALTER TABLE `inquiry`
  MODIFY `inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `plan_master`
--
ALTER TABLE `plan_master`
  MODIFY `planId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sendemaildetails`
--
ALTER TABLE `sendemaildetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `service_images`
--
ALTER TABLE `service_images`
  MODIFY `service_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `service_master`
--
ALTER TABLE `service_master`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `attendence_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `student_attendance_master`
--
ALTER TABLE `student_attendance_master`
  MODIFY `sattendanceid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `student_inquiry_master`
--
ALTER TABLE `student_inquiry_master`
  MODIFY `student_inquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `student_ledger`
--
ALTER TABLE `student_ledger`
  MODIFY `ledger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `student_master`
--
ALTER TABLE `student_master`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `student_renew_plan`
--
ALTER TABLE `student_renew_plan`
  MODIFY `renewplan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student_subscription`
--
ALTER TABLE `student_subscription`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `testimonial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `trial_master`
--
ALTER TABLE `trial_master`
  MODIFY `trialclass_student_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

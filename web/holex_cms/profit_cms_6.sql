-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 21, 2017 at 08:38 PM
-- Server version: 5.7.13-log
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profit_cms_6`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sef` char(255) NOT NULL,
  `img` char(255) DEFAULT NULL,
  `source_url` char(255) DEFAULT NULL,
  `source_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `publish_datetime` datetime NOT NULL,
  `gallery_id` int(10) UNSIGNED DEFAULT NULL,
  `show_on_main_page` enum('0','1') NOT NULL DEFAULT '0',
  `is_highlighted` enum('0','1') NOT NULL DEFAULT '0',
  `ordering` int(10) UNSIGNED NOT NULL,
  `add_by` int(11) NOT NULL,
  `add_datetime` datetime NOT NULL,
  `mod_by` int(10) UNSIGNED DEFAULT NULL,
  `mod_datetime` datetime DEFAULT NULL,
  `is_published` enum('1','0') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `gallery_id` (`gallery_id`),
  KEY `ordering` (`ordering`),
  KEY `sef` (`sef`),
  KEY `add_by` (`add_by`),
  KEY `mod_by` (`mod_by`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='''keywords'', ''descr'', ''title'', ''short'', ''full''';

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `sef`, `img`, `source_url`, `source_name`, `publish_datetime`, `gallery_id`, `show_on_main_page`, `is_highlighted`, `ordering`, `add_by`, `add_datetime`, `mod_by`, `mod_datetime`, `is_published`, `is_deleted`) VALUES
(1, 'qaydalari-ve-normalarinin-tesdiq-edilmesi-haqqinda-qerar-n_-8', NULL, NULL, NULL, '0000-00-00 00:00:00', 0, '0', '0', 1, 0, '0000-00-00 00:00:00', NULL, NULL, '1', '1'),
(2, 'beden-terbiyesi-ve-idman-haqqinda-azerbaycan-respublikasi-qanununun-tetbiqi-ile-', NULL, NULL, NULL, '2016-04-28 17:55:00', 0, '0', '0', 2, 1, '2016-04-28 18:12:20', NULL, NULL, '1', '1'),
(3, 'mayjaiavms', NULL, NULL, NULL, '2016-04-29 13:10:00', 0, '0', '0', 5, 1, '2016-04-29 13:53:49', NULL, NULL, '0', '1'),
(4, 'aprelin-29-da-yaz-heyeti-layihesi-cherchivesinde-tehsil-muessiselerinde-imecilik', NULL, NULL, NULL, '2016-02-29 16:45:00', 0, '0', '0', 11, 1, '2016-04-29 16:55:11', 1, '2016-05-02 12:31:36', '1', '0'),
(5, 'qurban-vypil-dvesti-qramm-i-uqnal-stroitelnyj-kran', NULL, NULL, NULL, '2016-04-05 19:10:00', 0, '0', '0', 4, 1, '2016-04-29 19:13:57', NULL, NULL, '0', '1'),
(6, 'some-silly-title', NULL, NULL, NULL, '2016-05-02 12:30:00', 0, '0', '0', 6, 1, '2016-05-02 12:32:11', NULL, NULL, '0', '1'),
(7, 'test-opublikovannostineopublikovannosti-jazykovyh-versij', NULL, NULL, NULL, '2016-05-02 13:30:00', 0, '0', '0', 7, 1, '2016-05-02 13:37:58', 1, '2016-05-02 14:01:34', '1', '0'),
(8, 'yadda-saxlanilmamish-deyishiklikler-itirilecek.-davam-etmek-istediyinize-eminsin', NULL, NULL, NULL, '2016-05-03 15:30:00', 0, '0', '0', 8, 1, '2016-05-03 15:38:45', 1, '2016-05-03 15:56:43', '1', '0'),
(9, 'bvfsbngfsn', NULL, NULL, NULL, '2016-05-03 19:25:00', 0, '0', '0', 3, 1, '2016-05-03 19:27:07', NULL, NULL, '1', '1'),
(10, 'gbfsnd-gfnd-g-dnhtg-dngtd-ngfvndn-gbdn-gf-ndg-nfd-b', 'wp_20160427_08_41_43_pro.jpg', NULL, NULL, '2016-05-03 19:35:00', 0, '0', '0', 9, 1, '2016-05-03 19:35:46', 1, '2016-05-06 12:46:30', '1', '0'),
(11, 'bgfvabfdabfdb-afdab-fdab-fda', NULL, NULL, NULL, '2016-05-09 15:20:00', 0, '0', '0', 12, 1, '2016-05-09 15:25:13', NULL, NULL, '1', '1'),
(12, 'arzularina-chatmaq-uchun-dayanmadan-chalishsinlar---ugur-formulu', NULL, NULL, NULL, '2016-05-13 13:30:00', NULL, '0', '0', 13, 1, '2016-05-13 16:32:33', NULL, NULL, '1', '1'),
(13, 'arzularina-chatmaq-uchun-dayanmadan-chalishsinlar---ugur-formulu', 'wp_20160427_08_41_43_pro_680b70ccafa047d3acd0c542a1acdd5f.jpg', NULL, NULL, '2016-05-13 13:30:00', 9, '0', '0', 19, 1, '2016-05-13 16:33:01', 1, '2016-05-17 17:39:51', '1', '0'),
(14, 'dostluq-kuboku-2016-futbol-turniri-kechirilib', NULL, NULL, NULL, '2016-05-17 11:45:00', 1, '0', '0', 18, 1, '2016-05-17 12:07:11', 1, '2016-06-02 15:39:21', '1', '0'),
(15, 'mekteblilerimiz-33-cu-balkan-riyaziyyat-olimpiadasindan-medalla-qayidiblar', NULL, NULL, NULL, '2016-05-17 13:35:00', 0, '1', '1', 10, 1, '2016-05-17 16:26:16', 1, '2016-05-25 14:19:53', '1', '0'),
(16, 'microsoft-imagine-cup-2016-musabiqesinin-milli-finalinin-qalibleri-mueyyenleshib', NULL, NULL, NULL, '2016-05-17 16:45:00', 0, '0', '1', 17, 1, '2016-05-17 16:47:38', 1, '2016-05-25 14:20:30', '1', '0'),
(17, 'sunny\'s-nights', NULL, 'http://www.randomhousebooks.com/books/175244/', 'Random House', '2016-05-24 15:50:00', 0, '0', '0', 14, 1, '2016-05-24 15:57:26', 1, '2016-05-24 16:20:15', '0', '0'),
(18, 'doktorantlarin-ve-genc-tedqiqatchilarin-respublika-elmi-konfransi', NULL, NULL, NULL, '2016-05-25 12:35:00', 0, '1', '0', 16, 1, '2016-05-25 12:38:49', 1, '2016-05-25 14:20:12', '1', '0'),
(19, 'community.az-portali-onlayn-musabiqelerin-qaliblerini-teltif-edib', '04-25.05.16-8.jpg', NULL, NULL, '2016-05-26 13:50:00', 0, '1', '1', 23, 13, '2016-05-26 13:09:24', 13, '2016-05-26 14:56:10', '0', '0'),
(20, 'masalli-celilabad-ve-yardimli-rayonlarinin-tehsil-ishchileri-ile-gorush', '03-26.05.16-1.jpg', NULL, NULL, '2016-05-27 15:00:00', 0, '0', '0', 22, 13, '2016-05-27 15:01:55', 1, '2016-05-27 15:03:17', '0', '0'),
(21, '10455-tel886-2-28856168-fax886-2-28862382-ie10firefoxchromesafari', 'firefox.jpg', NULL, NULL, '2016-06-02 15:35:00', 0, '0', '0', 20, 1, '2016-06-02 15:42:02', 1, '2016-08-14 16:03:22', '0', '1'),
(22, 'azerbaycan-numayende-heyeti-koreyada-seferdedir2', NULL, NULL, NULL, '2016-06-16 11:15:00', 0, '0', '0', 24, 1, '2016-06-16 11:16:29', 1, '2016-06-16 11:17:55', '1', '1'),
(23, 'mezunlar-akademik-fealiyyetde', '01-27.12.16-1.jpg', NULL, NULL, '2016-12-18 00:50:00', 0, '0', '0', 21, 1, '2016-12-18 00:58:42', 1, '2017-01-04 00:19:10', '1', '0'),
(24, 'qar-qizin-nagili-adli-yeni-il-shenliyi-kechirilir', '03-30.12.16-4_73b39bbeffbcd2fa2317c8dca4c34b70.jpg', 'http://edu.gov.az/az/page/9/13439', 'Azərbaycan Respublikası Təhsil Nazirliyi', '2016-12-29 21:15:00', 1, '0', '0', 15, 1, '2016-12-31 22:43:42', 1, '2017-01-15 00:11:46', '1', '0'),
(25, 'stenfordda-tehsil-alan-telebemiz-karyeramin-izi-ile-istenilen-yere-gedeceyem-ugu', NULL, 'http://1news.az/article,12/', '1news.az', '2017-01-15 00:15:00', 1, '0', '0', 25, 1, '2017-01-15 00:22:18', NULL, NULL, '1', '1'),
(26, 'stenfordda-tehsil-alan-telebemiz-karyeramin-izi-ile-istenilen-yere-gedeceyem-ugu', NULL, 'http://1news.az/article,12/', '1news.az', '2017-01-15 00:15:00', 1, '0', '0', 26, 1, '2017-01-15 00:22:44', NULL, NULL, '1', '1'),
(27, 'stenfordda-tehsil-alan-telebemiz-karyeramin-izi-ile-istenilen-yere-gedeceyem-ugu', 'sona_allahverdiyeva.png', 'http://1news.az/article,12/', '1news.az', '2017-01-15 00:25:00', 12, '0', '0', 27, 1, '2017-01-15 00:30:24', 1, '2017-04-09 01:00:18', '1', '0'),
(28, '', NULL, NULL, NULL, '2017-04-10 00:50:00', 0, '0', '0', 28, 1, '2017-04-10 00:11:19', NULL, NULL, '1', '1'),
(29, 'logan-police', '1491810317_0937e2145a67c6f38d745ca1b109f443.jpg', NULL, NULL, '2017-04-10 00:15:00', 0, '0', '0', 29, 1, '2017-04-10 00:16:52', 1, '2017-04-10 00:29:20', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `articles_cats_rel`
--

DROP TABLE IF EXISTS `articles_cats_rel`;
CREATE TABLE IF NOT EXISTS `articles_cats_rel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id` (`article_id`,`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles_cats_rel`
--

INSERT INTO `articles_cats_rel` (`id`, `article_id`, `category_id`) VALUES
(1, 13, 20),
(5, 13, 21),
(6, 19, 29),
(7, 20, 29),
(8, 23, 29),
(9, 25, 18),
(10, 25, 21),
(11, 26, 18),
(12, 26, 21),
(13, 27, 29);

-- --------------------------------------------------------

--
-- Table structure for table `cms_languages`
--

DROP TABLE IF EXISTS `cms_languages`;
CREATE TABLE IF NOT EXISTS `cms_languages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_dir` char(2) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `language_name` char(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `language_dir` (`language_dir`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_languages`
--

INSERT INTO `cms_languages` (`id`, `language_dir`, `language_name`) VALUES
(1, 'az', 'Azərbaycan'),
(2, 'ru', 'Русский'),
(3, 'en', 'English');

-- --------------------------------------------------------

--
-- Table structure for table `cms_log`
--

DROP TABLE IF EXISTS `cms_log`;
CREATE TABLE IF NOT EXISTS `cms_log` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cms_user_id` int(10) UNSIGNED NOT NULL,
  `subj_table` char(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `subj_id` int(10) UNSIGNED NOT NULL,
  `action` char(255) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `descr` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `subj_table` (`subj_table`,`subj_id`),
  KEY `action` (`action`),
  KEY `cms_user_id` (`cms_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=264 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_log`
--

INSERT INTO `cms_log` (`id`, `cms_user_id`, `subj_table`, `subj_id`, `action`, `descr`, `reg_date`) VALUES
(1, 1, 'galleries', 10, 'add', 'Gallery album added by admin Super Admin', '2016-05-27 13:19:44'),
(2, 1, 'galleries', 10, 'edit', 'Gallery album modified by admin Super Admin', '2016-05-27 13:20:37'),
(3, 1, 'galleries', 10, 'delete', 'Gallery album moved to recycle bin by admin Super Admin', '2016-05-27 13:21:02'),
(4, 1, 'galleries', 9, 'edit', 'Gallery album published by admin Super Admin', '2016-05-27 14:50:50'),
(5, 1, 'articles', 17, 'edit', 'Article unpublished by admin Super Admin', '2016-05-27 14:59:11'),
(6, 13, 'articles', 20, 'add', 'Article added by admin Forsaken Eddie', '2016-05-27 15:01:55'),
(7, 1, 'articles', 20, 'edit', 'Article modified by admin Super Admin', '2016-05-27 15:03:17'),
(8, 13, 'articles', 20, 'edit', 'Article published by admin Forsaken Eddie', '2016-05-27 15:05:51'),
(9, 1, 'cms_users', 14, 'add', 'User Grizgoldberg Eleonora added by admin Super Admin', '2016-05-27 16:38:34'),
(10, 1, 'cms_users', 14, 'edit', 'User Grizgoldberg Eleonora modified by admin Super Admin', '2016-05-27 16:38:55'),
(11, 1, 'cms_users', 14, 'edit', 'User blocked by admin Super Admin', '2016-05-27 16:39:09'),
(12, 1, 'cms_users', 14, 'edit', 'User Grizgoldberg Eleonora modified by admin Super Admin', '2016-05-27 16:39:19'),
(13, 1, 'cms_users', 14, 'sections_reassign', 'User`s allowed sections reassigned by admin Super Admin', '2016-05-27 16:39:31'),
(14, 1, 'cms_users', 14, 'erase', 'User erased by admin Super Admin', '2016-05-27 16:43:42'),
(15, 1, 'site_languages', 6, 'edit', 'Site language zh published by admin Super Admin', '2016-05-27 17:20:21'),
(16, 1, 'site_languages', 2, 'edit', 'Site language ru translations file saved by admin Super Admin', '2016-05-27 17:34:48'),
(17, 1, 'site_languages', 6, 'edit', 'Site language zh unpublished by admin Super Admin', '2016-05-27 17:35:25'),
(18, 1, 'site_languages', 6, 'erase', 'Site language zh and translations file erased by admin Super Admin', '2016-05-27 17:40:44'),
(19, 1, 'site_languages', 7, 'add', 'New site language ge added by admin Super Admin', '2016-05-27 17:42:39'),
(20, 1, 'site_languages', 1, 'edit', 'Site language az translations file saved by admin Super Admin', '2016-05-27 17:42:39'),
(21, 1, 'site_languages', 1, 'edit', 'Site language az translations file saved by admin Super Admin', '2016-05-27 18:16:46'),
(22, 1, 'site_languages', 2, 'edit', 'Site language ru translations file saved by admin Super Admin', '2016-05-27 18:17:58'),
(23, 1, 'menu', 30, 'add', 'Menu item added by admin Super Admin', '2016-05-27 18:42:54'),
(24, 1, 'menu', 30, 'delete', 'Menu item moved to recycle bin by admin Super Admin', '2016-05-27 18:43:03'),
(25, 1, 'menu', 29, 'edit', 'Menu item modified by admin Super Admin', '2016-05-27 18:44:02'),
(26, 1, 'galleries', 1, 'edit', 'Gallery album unpublished by admin Super Admin', '2016-05-31 11:14:28'),
(27, 1, 'debates', 1, 'add', 'Poll added by admin Super Admin', '2016-06-01 12:37:08'),
(28, 1, 'debates', 1, 'edit', 'Poll modified by admin Super Admin', '2016-06-01 13:45:13'),
(29, 1, 'debates', 1, 'edit', 'Poll modified by admin Super Admin', '2016-06-01 13:46:04'),
(30, 1, 'debates', 1, 'edit', 'Poll modified by admin Super Admin', '2016-06-01 14:21:55'),
(31, 1, 'debates', 1, 'edit', 'Poll modified by admin Super Admin', '2016-06-01 14:24:12'),
(32, 1, 'debates', 2, 'add', 'Poll added by admin Super Admin', '2016-06-01 14:29:36'),
(33, 1, 'articles', 2, 'edit', 'Article published by admin Super Admin', '2016-06-01 14:35:50'),
(34, 1, 'debates', 2, 'edit', 'Poll published by admin Super Admin', '2016-06-01 14:48:28'),
(35, 1, 'debates', 3, 'add', 'Poll added by admin Super Admin', '2016-06-01 14:55:54'),
(36, 1, 'debates', 3, 'delete', 'Poll moved to recycle bin by admin Super Admin', '2016-06-01 14:56:03'),
(37, 1, 'articles', 14, 'edit', 'Article modified by admin Super Admin', '2016-06-02 15:39:21'),
(38, 1, 'articles', 21, 'add', 'Article added by admin Super Admin', '2016-06-02 15:42:02'),
(39, 1, 'articles', 21, 'edit', 'Article modified by admin Super Admin', '2016-06-02 15:43:36'),
(40, 1, 'cms_users', 14, 'add', 'User Adminin Müavini added by admin Super Admin', '2016-06-06 17:03:56'),
(41, 1, 'site_users', 14, 'edit', 'Site user blocked by admin Super Admin', '2016-06-09 11:47:34'),
(42, 1, 'site_users', 15, 'erase', 'Site user erased by admin Super Admin', '2016-06-09 12:49:26'),
(43, 1, 'comments', 5, 'edit', 'Comment is published by admin Super Admin', '2016-06-09 19:00:05'),
(44, 1, 'comments', 5, 'edit', 'Comment is unpublished by admin Super Admin', '2016-06-09 19:03:00'),
(45, 1, 'comments', 5, 'edit', 'Comment is published by admin Super Admin', '2016-06-09 19:03:02'),
(46, 1, 'comments', 6, 'erase', 'Comment erased by admin Super Admin', '2016-06-10 11:31:55'),
(47, 1, 'site_users', 14, 'edit', 'Site user unblocked by admin Super Admin', '2016-06-14 19:00:34'),
(48, 1, 'site_users', 14, 'edit', 'Site user blocked by admin Super Admin', '2016-06-14 19:00:35'),
(49, 1, 'cms_users', 1, 'edit', 'User Super Admin modified by admin Super Admin', '2016-06-15 17:34:45'),
(50, 1, 'cms_users', 1, 'edit', 'User Super Admin modified by admin Super Admin', '2016-06-15 17:37:04'),
(51, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin', '2016-06-15 19:06:26'),
(52, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin', '2016-06-15 19:06:37'),
(53, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin', '2016-06-15 19:06:51'),
(54, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin', '2016-06-15 19:07:07'),
(55, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin', '2016-06-15 19:07:10'),
(56, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin', '2016-06-15 19:07:13'),
(57, 1, 'articles', 22, 'add', 'Article added by admin Super Admin', '2016-06-16 11:16:29'),
(58, 1, 'articles', 22, 'edit', 'Article modified by admin Super Admin', '2016-06-16 11:17:22'),
(59, 1, 'articles', 22, 'edit', 'Article modified by admin Super Admin', '2016-06-16 11:17:36'),
(60, 1, 'articles', 22, 'edit', 'Article modified by admin Super Admin', '2016-06-16 11:17:55'),
(61, 1, 'articles', 22, 'delete', 'Article moved to recycle bin by admin Super Admin', '2016-06-16 11:20:09'),
(62, 1, 'comments', 1, 'view', 'Comment inspekted by admin Super Admin', '2016-06-16 12:27:06'),
(63, 1, 'comments', 5, 'edit', 'Comment is unpublished by admin Super Admin', '2016-06-16 12:28:39'),
(64, 1, 'comments', 5, 'edit', 'Comment modified by admin Super Admin', '2016-06-16 12:28:55'),
(65, 1, 'comments', 5, 'edit', 'Comment modified by admin Super Admin', '2016-06-16 12:29:07'),
(66, 1, 'comments', 5, 'edit', 'Comment modified by admin Super Admin', '2016-06-16 12:29:33'),
(67, 1, 'comments', 3, 'view', 'Comment inspekted by admin Super Admin', '2016-06-17 11:08:36'),
(68, 1, 'complaints', 3, 'answered_complaint', 'User`s #12 Белоусов Валентин complaint is answered by admin Super Admin', '2016-07-06 17:26:01'),
(69, 1, 'complaints', 3, 'answered_complaint', 'User`s #12 Белоусов Валентин complaint is answered by admin Super Admin', '2016-07-06 17:26:24'),
(70, 1, 'complaints', 6, 'answered_complaint', 'User`s #12 Белоусов Валентин complaint is answered by admin Super Admin', '2016-07-06 17:45:11'),
(71, 1, 'comments', 4, 'view', 'Comment inspected by admin Super Admin', '2016-07-18 17:09:01'),
(72, 1, 'articles', 20, 'edit', 'Article unpublished by admin Super Admin', '2016-07-19 18:42:12'),
(73, 1, 'articles', 20, 'edit', 'Article published by admin Super Admin', '2016-07-19 18:42:17'),
(74, 1, 'galleries', 1, 'edit', 'Gallery album published by admin Super Admin', '2016-07-19 18:43:44'),
(75, 1, 'galleries', 1, 'edit', 'Gallery album unpublished by admin Super Admin', '2016-07-19 18:43:55'),
(76, 1, 'site_users', 14, 'edit', 'Site user unblocked by admin Super Admin', '2016-07-19 18:47:09'),
(77, 1, 'site_users', 14, 'edit', 'Site user blocked by admin Super Admin', '2016-07-19 18:47:11'),
(78, 1, 'comments', 5, 'edit', 'Comment is unpublished by admin Super Admin', '2016-07-19 18:47:51'),
(79, 1, 'comments', 5, 'edit', 'Comment is published by admin Super Admin', '2016-07-19 18:47:52'),
(80, 1, 'cms_users', 15, 'add', 'User asif added by admin Super Admin', '2016-07-19 18:57:47'),
(81, 1, 'cms_users', 15, 'edit', 'User blocked by admin Super Admin', '2016-07-20 10:46:54'),
(82, 1, 'cms_users', 15, 'edit', 'User unblocked by admin Super Admin', '2016-07-20 10:46:56'),
(83, 1, 'articles', 21, 'edit', 'Article modified by admin Super Admin', '2016-07-20 11:03:17'),
(84, 1, 'cms_users', 1, 'edit', 'User Super Admin modified by admin Super Admin', '2016-07-21 18:46:54'),
(85, 1, 'articles', 21, 'edit', 'Article modified by admin Super Admin', '2016-08-14 16:03:22'),
(86, 1, 'cms_users', 18, 'add', 'User  added by admin Super Admin', '2016-09-14 22:34:18'),
(87, 1, 'cms_users', 19, 'add', 'User Merovingen Franchaise added by admin Super Admin', '2016-09-14 22:47:45'),
(88, 1, 'cms_users', 20, 'add', 'User nhgfdsngf added by admin Super Admin ?', '2016-10-18 22:53:13'),
(89, 1, 'cms_users', 20, 'erase', 'User erased by admin Super Admin ?', '2016-10-18 23:23:02'),
(90, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:01:47'),
(91, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:01:58'),
(92, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:02:06'),
(93, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:02:13'),
(94, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:03:06'),
(95, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:04:37'),
(96, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:05:07'),
(97, 1, 'cms_users', 17, 'edit', 'User  modified by admin Super Admin ?', '2016-11-16 00:06:14'),
(98, 1, 'cms_users', 17, 'edit', 'User  modified by admin Super Admin ?', '2016-11-16 00:07:34'),
(99, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:09:19'),
(100, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:11:41'),
(101, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin ?', '2016-11-16 00:13:11'),
(102, 1, 'site_users', 4, 'edit', 'Site user unblocked by admin Super Admin ?', '2016-11-16 23:03:34'),
(103, 1, 'site_users', 3, 'edit', 'Site user blocked by admin Super Admin ?', '2016-11-16 23:03:36'),
(104, 1, 'site_users', 2, 'edit', 'Site user blocked by admin Super Admin ?', '2016-11-16 23:03:37'),
(105, 1, 'cms_users', 1, 'edit', 'User Super Admin ????????? modified by admin Super Admin ?', '2016-11-16 23:38:17'),
(106, 1, 'cms_users', 19, 'edit', 'User blocked by admin Super Admin ?', '2016-11-16 23:51:56'),
(107, 1, 'site_users', 4, 'erase', 'Site user erased by admin Super Admin ?', '2016-11-17 00:06:40'),
(108, 1, 'site_users', 2, 'edit', 'Site user unblocked by admin Super Admin ?', '2016-11-17 00:06:51'),
(109, 1, 'site_users', 1, 'edit', 'Site user blocked by admin Super Admin ?', '2016-11-17 00:06:53'),
(110, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2016-11-17 00:09:20'),
(111, 1, 'comments', 6, 'edit', 'Comment is published by admin Super Admin ?', '2016-12-04 01:30:48'),
(112, 1, 'comments', 6, 'edit', 'Comment is unpublished by admin Super Admin ?', '2016-12-04 01:30:53'),
(113, 1, 'comments', 6, 'edit', 'Comment is published by admin Super Admin ?', '2016-12-04 01:30:58'),
(114, 1, 'comments', 6, 'edit', 'Comment is unpublished by admin Super Admin ?', '2016-12-04 01:30:58'),
(115, 1, 'comments', 6, 'edit', 'Comment is published by admin Super Admin ?', '2016-12-04 01:30:58'),
(116, 1, 'comments', 6, 'edit', 'Comment is unpublished by admin Super Admin ?', '2016-12-04 01:30:58'),
(117, 1, 'comments', 6, 'edit', 'Comment is published by admin Super Admin ?', '2016-12-04 01:30:58'),
(118, 1, 'comments', 6, 'edit', 'Comment is unpublished by admin Super Admin ?', '2016-12-04 01:30:59'),
(119, 1, 'comments', 6, 'edit', 'Comment is published by admin Super Admin ?', '2016-12-04 01:30:59'),
(120, 1, 'comments', 6, 'edit', 'Comment is unpublished by admin Super Admin ?', '2016-12-04 01:30:59'),
(121, 1, 'comments', 6, 'edit', 'Comment is published by admin Super Admin ?', '2016-12-04 01:30:59'),
(122, 1, 'comments', 6, 'edit', 'Comment is unpublished by admin Super Admin ?', '2016-12-04 01:31:00'),
(123, 1, 'comments', 6, 'edit', 'Comment is published by admin Super Admin ?', '2016-12-04 01:31:00'),
(124, 1, 'comments', 6, 'edit', 'Comment is unpublished by admin Super Admin ?', '2016-12-04 01:31:00'),
(125, 1, 'comments', 6, 'edit', 'Comment is published by admin Super Admin ?', '2016-12-04 01:31:05'),
(126, 1, 'comments', 6, 'erase', 'Comment erased by admin Super Admin ?', '2016-12-04 01:34:39'),
(127, 1, 'comments', 7, 'delete', 'Comment moved to recycle bin by admin Super Admin ?', '2016-12-04 01:55:17'),
(128, 1, 'comments', 7, 'delete', 'Comment moved to recycle bin by admin Super Admin ?', '2016-12-04 02:01:19'),
(129, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin ?', '2016-12-04 13:05:50'),
(130, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin ?', '2016-12-04 13:06:38'),
(131, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin ?', '2016-12-04 13:09:08'),
(132, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin ?', '2016-12-04 13:09:19'),
(133, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin ?', '2016-12-04 13:10:18'),
(134, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin ?', '2016-12-04 13:10:22'),
(135, 1, 'comments', 3, 'edit', 'Comment modified by admin Super Admin ?', '2016-12-04 13:10:24'),
(136, 1, 'articles', 21, 'edit', 'Article unpublished by admin Super Admin ?', '2016-12-04 19:48:55'),
(137, 1, 'articles', 13, 'edit', 'Article published by admin Super Admin ?', '2016-12-04 19:49:11'),
(138, 1, 'articles', 21, 'delete', 'Article moved to recycle bin by admin Super Admin ?', '2016-12-04 23:15:27'),
(139, 1, 'articles', 9, 'delete', 'Article moved to recycle bin by admin Super Admin ?', '2016-12-04 23:17:22'),
(140, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2016-12-17 22:04:46'),
(141, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2016-12-18 00:40:48'),
(142, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2016-12-18 00:40:54'),
(143, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2016-12-18 00:43:49'),
(144, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2016-12-18 00:44:53'),
(145, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2016-12-18 00:44:58'),
(146, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2016-12-18 00:45:04'),
(147, 1, 'articles', 23, 'add', 'Article added by admin Super Admin ?', '2016-12-18 00:58:42'),
(148, 1, 'articles', 24, 'add', 'Article added by admin Super Admin ?', '2016-12-31 22:43:42'),
(149, 1, 'articles', 24, 'edit', 'Article modified by admin Super Admin ?', '2017-01-04 00:04:50'),
(150, 1, 'articles', 24, 'edit', 'Article modified by admin Super Admin ?', '2017-01-04 00:06:12'),
(151, 1, 'articles', 24, 'edit', 'Article modified by admin Super Admin ?', '2017-01-04 00:06:29'),
(152, 1, 'articles', 24, 'edit', 'Article modified by admin Super Admin ?', '2017-01-04 00:06:34'),
(153, 1, 'articles', 24, 'edit', 'Article modified by admin Super Admin ?', '2017-01-04 00:06:39'),
(154, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2017-01-04 00:07:54'),
(155, 1, 'cms_users', 1, 'edit', 'User Super Admin ? modified by admin Super Admin ?', '2017-01-04 00:16:27'),
(156, 1, 'articles', 23, 'edit', 'Article modified by admin Super Admin ?', '2017-01-04 00:19:10'),
(157, 1, 'articles', 20, 'edit', 'Article unpublished by admin Super Admin ?', '2017-01-04 00:21:55'),
(158, 1, 'articles', 19, 'edit', 'Article unpublished by admin Super Admin ?', '2017-01-04 00:21:56'),
(159, 1, 'articles', 24, 'edit', 'Article modified by admin Super Admin ?', '2017-01-15 00:05:14'),
(160, 1, 'articles', 24, 'edit', 'Article modified by admin Super Admin ?', '2017-01-15 00:11:10'),
(161, 1, 'articles', 24, 'edit', 'Article modified by admin Super Admin ?', '2017-01-15 00:11:46'),
(162, 1, 'articles', 11, 'delete', 'Article moved to recycle bin by admin Super Admin ?', '2017-01-15 00:19:48'),
(163, 1, 'articles', 25, 'add', 'Article added by admin Super Admin ?', '2017-01-15 00:22:18'),
(164, 1, 'articles', 26, 'add', 'Article added by admin Super Admin ?', '2017-01-15 00:22:44'),
(165, 1, 'articles', 25, 'delete', 'Article moved to recycle bin by admin Super Admin ?', '2017-01-15 00:27:37'),
(166, 1, 'articles', 26, 'delete', 'Article moved to recycle bin by admin Super Admin ?', '2017-01-15 00:27:43'),
(167, 1, 'articles', 27, 'add', 'Article added by admin Super Admin ?', '2017-01-15 00:30:24'),
(168, 1, 'articles', 3, 'delete', 'Article moved to recycle bin by admin Super Admin ?', '2017-01-15 01:26:25'),
(169, 1, 'articles', 6, 'delete', 'Article moved to recycle bin by admin Super Admin ?', '2017-01-15 18:22:01'),
(170, 1, 'galleries', 1, 'edit', 'Gallery album published by admin Super Admin 🌭', '2017-01-18 23:32:34'),
(171, 1, 'galleries', 1, 'edit', 'Gallery album unpublished by admin Super Admin 🌭', '2017-01-18 23:32:38'),
(172, 1, 'galleries', 10, 'delete', 'Gallery album moved to recycle bin by admin Super Admin 🌭', '2017-01-18 23:56:58'),
(173, 1, 'galleries', 12, 'add', 'Gallery album added by admin Super Admin 🌭', '2017-01-20 23:51:29'),
(174, 1, 'galleries', 11, 'delete', 'Gallery album moved to recycle bin by admin Super Admin 🌭', '2017-01-20 23:51:56'),
(175, 1, 'galleries', 12, 'edit', 'Gallery album unpublished by admin Super Admin 🌭', '2017-01-21 00:23:52'),
(176, 1, 'galleries', 1, 'edit', 'Gallery album modified by admin Super Admin 🌭', '2017-01-21 02:39:57'),
(177, 1, 'galleries', 1, 'edit', 'Gallery album modified by admin Super Admin 🌭', '2017-01-21 02:40:05'),
(178, 1, 'galleries', 1, 'edit', 'Gallery album modified by admin Super Admin 🌭', '2017-01-21 02:40:11'),
(179, 1, 'cms_users', 18, 'edit', 'User Ivan Drago modified by admin Super Admin 🌭', '2017-01-27 23:40:41'),
(180, 1, 'cms_users', 18, 'edit', 'User Ivan Drago modified by admin Super Admin 🌭', '2017-01-27 23:47:46'),
(181, 1, 'cms_users', 18, 'edit', 'User Ivan Drago modified by admin Super Admin 🌭', '2017-01-27 23:49:15'),
(182, 1, 'cms_users', 19, 'edit', 'User Merovingen Franchaise modified by admin Super Admin 🌭', '2017-01-28 00:33:16'),
(183, 1, 'cms_users', 17, 'edit', 'User Obama Barack Mustafa Ibrahim ex modified by admin Super Admin 🌭', '2017-01-28 00:34:06'),
(184, 1, 'cms_users', 1, 'edit', 'User Super Admin 🌭 modified by admin Super Admin 🌭', '2017-01-28 00:34:19'),
(185, 1, 'cms_users', 16, 'edit', 'User Padre Domini modified by admin Super Admin 🌭', '2017-01-28 00:35:36'),
(186, 1, 'cms_users', 16, 'edit', 'User Padre Domini modified by admin Super Admin 🌭', '2017-01-28 00:40:39'),
(187, 1, 'cms_users', 18, 'edit', 'User Ivan Drago modified by admin Super Admin 🌭', '2017-01-28 01:03:15'),
(188, 1, 'cms_users', 1, 'edit', 'User Super Admin 🌭 modified by admin Super Admin 🌭', '2017-01-28 01:03:22'),
(189, 1, 'cms_users', 18, 'edit', 'User Ivan Drago modified by admin Super Admin 🌭', '2017-01-28 01:03:38'),
(190, 1, 'cms_users', 1, 'edit', 'User Super Admin 🌭 modified by admin Super Admin 🌭', '2017-01-28 01:03:51'),
(191, 1, 'cms_users', 21, 'add', 'User bvfsbfx added by admin Super Admin 🌭', '2017-01-28 01:11:13'),
(192, 1, 'cms_users', 22, 'add', 'User hwr gtrw hrt added by admin Super Admin 🌭', '2017-01-28 01:12:55'),
(193, 1, 'cms_users', 22, 'erase', 'User erased by admin Super Admin 🌭', '2017-01-28 01:13:13'),
(194, 1, 'gallery_photos', 5, 'erase', 'Gallery photo of album #1 erased by admin Super Admin 🌭', '2017-02-01 22:38:15'),
(195, 1, 'gallery_photos', 38, 'add', 'Gallery photo added to album #1 by admin Super Admin 🌭', '2017-02-01 23:14:22'),
(196, 1, 'gallery_photos', 39, 'add', 'Gallery photo added to album #1 by admin Super Admin 🌭', '2017-02-01 23:14:22'),
(197, 1, 'gallery_photos', 40, 'add', 'Gallery photo added to album #1 by admin Super Admin 🌭', '2017-02-01 23:14:23'),
(198, 1, 'gallery_photos', 2, 'edit', 'Gallery photo of album #1 modified by admin Super Admin 🌭', '2017-02-01 23:59:14'),
(199, 1, 'gallery_photos', 2, 'edit', 'Gallery photo of album #1 modified by admin Super Admin 🌭', '2017-02-01 23:59:21'),
(200, 1, 'gallery_photos', 2, 'edit', 'Gallery photo of album #1 modified by admin Super Admin 🌭', '2017-02-01 23:59:38'),
(201, 1, 'gallery_photos', 2, 'edit', 'Gallery photo of album #1 modified by admin Super Admin 🌭', '2017-02-01 23:59:49'),
(202, 1, 'articles', 27, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-09 00:50:03'),
(203, 1, 'articles', 27, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-09 00:57:30'),
(204, 1, 'articles', 27, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-09 00:57:44'),
(205, 1, 'articles', 27, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-09 01:00:02'),
(206, 1, 'articles', 27, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-09 01:00:18'),
(207, 1, 'cms_users', 1, 'edit', 'User Super Admin 🌭 modified by admin Super Admin 🌭', '2017-04-09 01:13:26'),
(208, 1, 'site_users', 3, 'edit', 'Site user unblocked by admin Super Admin 🌭', '2017-04-09 16:27:52'),
(209, 1, 'site_users', 1, 'edit', 'Site user unblocked by admin Super Admin 🌭', '2017-04-09 16:27:54'),
(210, 1, 'site_users', 1, 'edit', 'Site user blocked by admin Super Admin 🌭', '2017-04-09 16:27:57'),
(211, 1, 'articles', 28, 'add', 'Article added by admin Super Admin 🌭', '2017-04-10 00:11:19'),
(212, 1, 'articles', 29, 'add', 'Article added by admin Super Admin 🌭', '2017-04-10 00:16:52'),
(213, 1, 'articles', 29, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-10 00:17:05'),
(214, 1, 'articles', 29, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-10 00:23:11'),
(215, 1, 'articles', 29, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-10 00:29:04'),
(216, 1, 'articles', 29, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-10 00:29:13'),
(217, 1, 'articles', 29, 'edit', 'Article modified by admin Super Admin 🌭', '2017-04-10 00:29:20'),
(218, 1, 'comments', 3, 'view', 'Comment inspected by admin Super Admin 🌭', '2017-04-15 18:13:11'),
(219, 1, 'cms_users', 18, 'edit', 'User Ivan Drago <script>alert(\'Damn!\');</script> modified by admin Super Admin 🌭', '2017-04-15 19:16:33'),
(220, 1, 'cms_users', 18, 'edit', 'User Ivan Drago <script>alert(\'Damn!\');</script> modified by admin Super Admin 🌭', '2017-04-15 19:18:31'),
(221, 1, 'cms_users', 18, 'edit', 'User Ivan Drago <script>alert(\'Damn!\');</script> modified by admin Super Admin 🌭', '2017-04-15 19:28:58'),
(222, 1, 'cms_users', 18, 'edit', 'User Ivan Drago <script>alert(\'Damn!\');</script> modified by admin Super Admin 🌭', '2017-04-15 19:31:19'),
(223, 1, 'cms_users', 1, 'edit', 'User Super Admin 🌭 modified by admin Super Admin 🌭', '2017-04-15 19:34:32'),
(224, 1, 'articles', 28, 'delete', 'Article moved to recycle bin by admin Super Admin 🌭', '2017-04-15 19:37:28'),
(225, 1, 'cms_users', 1, 'edit', 'User Super Admin 🌭 modified by admin Super Admin 🌭', '2017-04-16 17:03:14'),
(226, 1, 'menu', 1, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-22 00:48:34'),
(227, 1, 'menu', 1, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-22 00:51:41'),
(228, 1, 'menu', 31, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 19:36:42'),
(229, 1, 'menu', 32, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 19:37:44'),
(230, 1, 'menu', 33, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 19:37:56'),
(231, 1, 'menu', 34, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 19:39:30'),
(232, 1, 'menu', 35, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 19:40:54'),
(233, 1, 'menu', 36, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 19:45:23'),
(234, 1, 'menu', 37, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 19:46:01'),
(235, 1, 'menu', 38, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 19:46:32'),
(236, 1, 'menu', 38, 'delete', 'Menu item moved to recycle bin by admin Super Admin 🌭', '2017-04-30 23:18:25'),
(237, 1, 'menu', 39, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 23:18:58'),
(238, 1, 'menu', 40, 'add', 'Menu item added by admin Super Admin 🌭', '2017-04-30 23:21:18'),
(239, 1, 'menu', 40, 'delete', 'Menu item moved to recycle bin by admin Super Admin 🌭', '2017-04-30 23:21:49'),
(240, 1, 'menu', 17, 'delete', 'Menu item moved to recycle bin by admin Super Admin 🌭', '2017-04-30 23:22:54'),
(241, 1, 'menu', 39, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-30 23:23:58'),
(242, 1, 'menu', 39, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-30 23:38:46'),
(243, 1, 'menu', 39, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-30 23:41:16'),
(244, 1, 'menu', 39, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-30 23:44:50'),
(245, 1, 'menu', 39, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-30 23:44:55'),
(246, 1, 'menu', 39, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-30 23:45:03'),
(247, 1, 'menu', 39, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-30 23:47:34'),
(248, 1, 'menu', 39, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-04-30 23:48:00'),
(249, 1, 'menu', 41, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-07 01:59:53'),
(250, 1, 'menu', 41, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-05-07 23:37:57'),
(251, 1, 'menu', 41, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-05-07 23:38:09'),
(252, 1, 'menu', 41, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-05-07 23:38:36'),
(253, 1, 'menu', 41, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-05-07 23:39:05'),
(254, 1, 'menu', 42, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-07 23:58:13'),
(255, 1, 'menu', 43, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-09 13:42:20'),
(256, 1, 'menu', 44, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-09 13:45:41'),
(257, 1, 'menu', 43, 'edit', 'Menu item modified by admin Super Admin 🌭', '2017-05-09 13:47:46'),
(258, 1, 'menu', 45, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-09 13:52:55'),
(259, 1, 'menu', 46, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-09 13:57:05'),
(260, 1, 'menu', 46, 'delete', 'Menu item moved to recycle bin by admin Super Admin 🌭', '2017-05-09 13:57:45'),
(261, 1, 'menu', 47, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-09 13:58:41'),
(262, 1, 'menu', 48, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-09 14:06:24'),
(263, 1, 'menu', 49, 'add', 'Menu item added by admin Super Admin 🌭', '2017-05-09 14:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `cms_users`
--

DROP TABLE IF EXISTS `cms_users`;
CREATE TABLE IF NOT EXISTS `cms_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `login` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` char(32) CHARACTER SET ascii COLLATE ascii_bin NOT NULL DEFAULT 'admin',
  `password` char(96) COLLATE utf8_unicode_ci NOT NULL,
  `name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` char(2) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'az',
  `reg_by` int(10) UNSIGNED NOT NULL,
  `reg_date` datetime NOT NULL,
  `last_login_date` datetime DEFAULT NULL,
  `is_menu_collapsed` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `is_blocked` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  KEY `reg_by` (`reg_by`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cms_users`
--

INSERT INTO `cms_users` (`id`, `login`, `role`, `password`, `name`, `avatar`, `lang`, `reg_by`, `reg_date`, `last_login_date`, `is_menu_collapsed`, `is_blocked`) VALUES
(1, 'irrevion@gmail.com', 'admin', 'dc6a4cb9828faa8d48ca2fef88c8f469b1353bbf64dfcd8955894576f95cc91a8235ee3fe2508912b809699aadd1f7aa', 'Super Admin 🌭', NULL, 'az', 1, '2015-03-26 12:26:32', '2017-05-21 22:51:05', '0', '0'),
(16, 'user@domain.com', 'admin', 'bvfbngfsngfdfbfdsbf', 'Padre Domini', 'i.jpg', 'ru', 1, '2016-09-12 11:33:17', NULL, '0', '0'),
(17, 'obama@penthagon.us', 'editor', '9ba225066b8eb8b8b6580a7e850a4a8c8513719977a4b5f64dde11b6becb619b659382647d5bc37cef787217ff39e539', 'Obama Barack Mustafa Ibrahim ex', 'obama-2.jpg', 'az', 1, '2016-09-12 13:41:08', NULL, '0', '0'),
(18, 'maestro@contoso.com', 'editor', '0ce6f6f0797ad8ed1dd2fe30eb0fe8d6d86b104746fb2ff1e208a90cb7143438cefb830cd732e995da526da216a27825', 'Ivan Drago <script>alert(\'Damn!\');</script>', 'ivan-drago.jpg', 'en', 1, '2016-09-14 22:34:18', NULL, '0', '0'),
(19, 'mero@matrix.com', 'editor', 'd8510708b82fca67ded397f65e039a01f57b73f40d371981484d4d323e15bf1c2cd347f1e8db56e8c8432b6b09b722b2', 'Merovingen Franchaise', '13863134908390.jpg', 'az', 1, '2016-09-14 22:47:45', NULL, '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cms_users_actions`
--

DROP TABLE IF EXISTS `cms_users_actions`;
CREATE TABLE IF NOT EXISTS `cms_users_actions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cms_user_id` int(10) UNSIGNED NOT NULL,
  `controller` varchar(32) NOT NULL DEFAULT 'base',
  `action` varchar(32) NOT NULL DEFAULT '404',
  `is_readonly` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `cms_user_id_2` (`cms_user_id`,`controller`,`action`),
  KEY `cms_user_id` (`cms_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cms_users_menu_sections_rel`
--

DROP TABLE IF EXISTS `cms_users_menu_sections_rel`;
CREATE TABLE IF NOT EXISTS `cms_users_menu_sections_rel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cms_user_id` int(10) UNSIGNED NOT NULL,
  `menu_section_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cms_user_id` (`cms_user_id`,`menu_section_id`),
  KEY `cms_user_id_2` (`cms_user_id`),
  KEY `menu_section_id` (`menu_section_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_users_menu_sections_rel`
--

INSERT INTO `cms_users_menu_sections_rel` (`id`, `cms_user_id`, `menu_section_id`) VALUES
(1, 13, 18),
(3, 13, 26),
(4, 13, 29);

-- --------------------------------------------------------

--
-- Table structure for table `cms_users_roles`
--

DROP TABLE IF EXISTS `cms_users_roles`;
CREATE TABLE IF NOT EXISTS `cms_users_roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(64) NOT NULL,
  `landing_page` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role` (`role`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_users_roles`
--

INSERT INTO `cms_users_roles` (`id`, `role`, `landing_page`) VALUES
(1, 'admin', '?controller=statistics&action=dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `cms_users_roles_actions`
--

DROP TABLE IF EXISTS `cms_users_roles_actions`;
CREATE TABLE IF NOT EXISTS `cms_users_roles_actions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role` varchar(32) NOT NULL DEFAULT 'all',
  `controller` varchar(32) NOT NULL DEFAULT 'base',
  `action` varchar(32) NOT NULL DEFAULT '404',
  `is_readonly` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `role` (`role`,`controller`,`action`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cms_users_roles_actions`
--

INSERT INTO `cms_users_roles_actions` (`id`, `role`, `controller`, `action`, `is_readonly`) VALUES
(1, 'all', 'base', 'password_recovery', '0'),
(2, 'all', 'base', 'sign_out', '0'),
(3, 'all', 'base', 'sign_in', '0'),
(4, 'all', 'base', '404', '0'),
(5, 'all', 'base', 'change_password', '0'),
(6, 'all', 'base', 'ulogin', '0'),
(7, 'admin', 'cms_users', 'list', '0'),
(8, 'admin', 'statistics', 'dashboard', '0'),
(9, 'admin', 'cms_users', 'add', '0'),
(10, 'admin', 'cms_users', 'manage_privilegies', '0'),
(11, 'admin', 'cms_users', 'delete', '0'),
(12, 'admin', 'cms_users', 'edit', '0'),
(13, 'admin', 'site_users', 'list', '0'),
(14, 'admin', 'site_users', 'ajax_set_ban', '0'),
(15, 'admin', 'cms_users', 'ajax_set_ban', '0'),
(16, 'admin', 'site_users', 'delete', '0'),
(17, 'admin', 'site_users', 'view_info', '0'),
(18, 'admin', 'comments', 'list', '0'),
(19, 'admin', 'comments', 'edit', '0'),
(20, 'admin', 'comments', 'ajax_set_status', '0'),
(21, 'admin', 'comments', 'delete', '0'),
(22, 'admin', 'articles', 'list', '0'),
(23, 'admin', 'articles', 'edit', '0'),
(24, 'admin', 'articles', 'add', '0'),
(25, 'admin', 'articles', 'delete', '0'),
(26, 'admin', 'articles', 'ajax_set_status', '0'),
(27, 'admin', 'articles', 'ajax_sort', '0'),
(28, 'admin', 'articles', 'ajax_paged_sort', '0'),
(29, 'admin', 'articles', 'ajax_get_autocomplete', '0'),
(30, 'admin', 'articles', 'ajax_delete_image', '0'),
(31, 'admin', 'gallery', 'ajax_get_autocomplete', '0'),
(32, 'admin', 'gallery', 'list', '0'),
(33, 'admin', 'gallery', 'edit', '0'),
(34, 'admin', 'gallery', 'add', '0'),
(35, 'admin', 'gallery', 'ajax_set_status', '0'),
(36, 'admin', 'gallery', 'photos', '0'),
(37, 'admin', 'gallery', 'delete', '0'),
(38, 'admin', 'gallery', 'add_photo', '0'),
(39, 'admin', 'gallery', 'ajax_photos_sort', '0'),
(40, 'admin', 'gallery', 'delete_photo', '0'),
(41, 'admin', 'gallery', 'edit_photo', '0'),
(42, 'admin', 'base', 'save_menubar_status', '0'),
(43, 'admin', 'nav', 'list', '0'),
(44, 'admin', 'nav', 'add', '0'),
(45, 'admin', 'nav', 'delete', '0'),
(46, 'admin', 'nav', 'edit', '0'),
(47, 'admin', 'nav', 'ajax_set_parent', '0'),
(48, 'admin', 'nav', 'ajax_set_position', '0');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `answered_comment_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ref_table` char(64) NOT NULL,
  `ref_id` int(10) UNSIGNED NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_datetime` datetime NOT NULL,
  `is_published` enum('1','0') NOT NULL DEFAULT '1',
  `is_inspected` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `ref_table` (`ref_table`,`ref_id`),
  KEY `answered_comment_id` (`answered_comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `answered_comment_id`, `user_id`, `ref_table`, `ref_id`, `text`, `add_datetime`, `is_published`, `is_inspected`, `is_deleted`) VALUES
(1, NULL, 10, 'articles', 20, 'Hey, there! I\'m writing comment!', '2016-06-09 13:20:16', '1', '1', '0'),
(2, 1, 12, 'articles', 20, 'Second comment about Masalli', '2016-06-09 13:26:36', '1', '0', '0'),
(3, NULL, 2, 'articles', 20, 'This article is genius!\r\nMy eyes leaked down to the floor)', '2016-06-09 13:28:35', '1', '1', '0'),
(4, NULL, 14, 'articles', 19, 'This community is awesome, just give them a chance.\r\n\r\nKeep up, guys!', '2016-06-09 13:30:47', '1', '1', '0'),
(5, NULL, 2, 'articles', 18, 'Doktorantlarımızla fəxr edirəm!\r\nƏfsuzlar olsun ki ozüm gələ bilmədim... ', '2016-06-10 11:29:34', '0', '1', '0'),
(7, NULL, 2, '', 0, 'bebebe', '2016-12-29 17:25:52', '1', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

DROP TABLE IF EXISTS `complaints`;
CREATE TABLE IF NOT EXISTS `complaints` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tmp_name` varchar(100) DEFAULT NULL,
  `filename` varchar(100) DEFAULT NULL,
  `date` datetime NOT NULL,
  `is_read` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `user_id`, `admin_id`, `message`, `tmp_name`, `filename`, `date`, `is_read`) VALUES
(1, 14, NULL, 'Why did you blocked me?', NULL, NULL, '2016-07-06 14:41:29', '0'),
(2, 13, NULL, 'Hey, there! I\'m writing complaints!\r\n\r\nWhatever...', NULL, NULL, '2016-07-06 15:30:42', '0'),
(3, 12, NULL, 'Why my facebook profile picture is not displaying?', NULL, NULL, '2016-07-06 17:34:11', '1'),
(6, 12, NULL, 'This', 'ne-boltai-300x285.png', 'Не болтай.png', '2016-07-06 17:35:22', '1'),
(5, 12, 1, 'Which picture?', NULL, NULL, '2016-07-06 17:26:24', '0'),
(7, 12, 1, 'No, this pucture is much better', '0a9c05bd73af5ec88f30f6e1469de74b.png', 'xsSombrero.png', '2016-07-06 17:45:11', '0');

-- --------------------------------------------------------

--
-- Table structure for table `content_registry`
--

DROP TABLE IF EXISTS `content_registry`;
CREATE TABLE IF NOT EXISTS `content_registry` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_table` varchar(64) NOT NULL,
  `list_link` varchar(255) NOT NULL,
  `item_link` varchar(255) NOT NULL,
  `item_page` varchar(64) NOT NULL,
  `title_column` varchar(64) NOT NULL,
  `text_column` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_table` (`ref_table`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `content_registry`
--

INSERT INTO `content_registry` (`id`, `ref_table`, `list_link`, `item_link`, `item_page`, `title_column`, `text_column`) VALUES
(1, 'articles', '?controller=articles&action=list', '?controller=articles&action=edit&id={ref_id}', 'articles/edit', 'title', 'short'),
(2, 'debates', '?controller=debates&action=list', '?controller=debates&action=edit_poll&id={ref_id}', 'debates/edit_poll', 'title', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `counters`
--

DROP TABLE IF EXISTS `counters`;
CREATE TABLE IF NOT EXISTS `counters` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_table` char(64) COLLATE ascii_bin NOT NULL,
  `ref_id` int(10) UNSIGNED NOT NULL,
  `type` char(32) COLLATE ascii_bin NOT NULL,
  `counter` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_table` (`ref_table`,`ref_id`,`type`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `counters`
--

INSERT INTO `counters` (`id`, `ref_table`, `ref_id`, `type`, `counter`) VALUES
(1, 'articles', 13, 'like', 0),
(2, 'articles', 13, 'dislike', 0),
(3, 'articles', 13, 'view', 0),
(4, 'articles', 13, 'comment', 0),
(5, 'articles', 14, 'like', 0),
(6, 'articles', 14, 'dislike', 0),
(7, 'articles', 14, 'view', 0),
(8, 'articles', 14, 'comment', 0),
(9, 'articles', 15, 'like', 0),
(10, 'articles', 15, 'dislike', 0),
(11, 'articles', 15, 'view', 0),
(12, 'articles', 15, 'comment', 0),
(13, 'articles', 16, 'like', 0),
(14, 'articles', 16, 'dislike', 0),
(15, 'articles', 16, 'view', 0),
(16, 'articles', 16, 'comment', 0),
(17, 'articles', 17, 'like', 0),
(18, 'articles', 17, 'dislike', 0),
(19, 'articles', 17, 'view', 0),
(20, 'articles', 17, 'comment', 0),
(21, 'articles', 18, 'like', 0),
(22, 'articles', 18, 'dislike', 0),
(23, 'articles', 18, 'view', 0),
(24, 'articles', 18, 'comment', 0),
(25, 'articles', 19, 'like', 0),
(26, 'articles', 19, 'dislike', 0),
(27, 'articles', 19, 'view', 0),
(28, 'articles', 19, 'comment', 0),
(29, 'articles', 20, 'like', 0),
(30, 'articles', 20, 'dislike', 0),
(31, 'articles', 20, 'view', 0),
(32, 'articles', 20, 'comment', 0),
(33, 'debates', 1, 'up_vote', 0),
(34, 'debates', 1, 'down_vote', 0),
(35, 'debates', 1, 'neutral_vote', 0),
(36, 'debates', 1, 'comment', 0),
(37, 'debates', 2, 'up_vote', 0),
(38, 'debates', 2, 'down_vote', 0),
(39, 'debates', 2, 'neutral_vote', 0),
(40, 'debates', 2, 'comment', 0),
(41, 'debates', 3, 'up_vote', 0),
(42, 'debates', 3, 'down_vote', 0),
(43, 'debates', 3, 'neutral_vote', 0),
(44, 'debates', 3, 'comment', 0),
(45, 'articles', 21, 'like', 0),
(46, 'articles', 21, 'dislike', 0),
(47, 'articles', 21, 'view', 0),
(48, 'articles', 21, 'comment', 0),
(49, 'articles', 22, 'like', 0),
(50, 'articles', 22, 'dislike', 0),
(51, 'articles', 22, 'view', 0),
(52, 'articles', 22, 'comment', 0),
(53, 'articles', 23, 'like', 0),
(54, 'articles', 23, 'dislike', 0),
(55, 'articles', 23, 'view', 0),
(56, 'articles', 23, 'comment', 0),
(57, 'articles', 24, 'like', 0),
(58, 'articles', 24, 'dislike', 0),
(59, 'articles', 24, 'view', 0),
(60, 'articles', 24, 'comment', 0),
(61, 'articles', 25, 'like', 0),
(62, 'articles', 25, 'dislike', 0),
(63, 'articles', 25, 'view', 0),
(64, 'articles', 25, 'comment', 0),
(65, 'articles', 26, 'like', 0),
(66, 'articles', 26, 'dislike', 0),
(67, 'articles', 26, 'view', 0),
(68, 'articles', 26, 'comment', 0),
(69, 'articles', 27, 'like', 0),
(70, 'articles', 27, 'dislike', 0),
(71, 'articles', 27, 'view', 0),
(72, 'articles', 27, 'comment', 0),
(73, 'articles', 28, 'like', 0),
(74, 'articles', 28, 'dislike', 0),
(75, 'articles', 28, 'view', 0),
(76, 'articles', 28, 'comment', 0),
(77, 'articles', 29, 'like', 0),
(78, 'articles', 29, 'dislike', 0),
(79, 'articles', 29, 'view', 0),
(80, 'articles', 29, 'comment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

DROP TABLE IF EXISTS `galleries`;
CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `add_by` int(10) UNSIGNED NOT NULL,
  `add_datetime` datetime NOT NULL,
  `mod_by` int(10) UNSIGNED DEFAULT NULL,
  `mod_datetime` datetime DEFAULT NULL,
  `is_published` enum('1','0') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `add_by` (`add_by`),
  KEY `mod_by` (`mod_by`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COMMENT='name';

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `add_by`, `add_datetime`, `mod_by`, `mod_datetime`, `is_published`, `is_deleted`) VALUES
(1, 1, '2015-08-20 15:54:47', 1, '2017-01-21 02:40:11', '1', '0'),
(8, 1, '2016-05-16 11:27:58', NULL, NULL, '1', '1'),
(9, 1, '2016-05-16 11:50:10', 1, '2016-05-16 13:03:32', '1', '0'),
(10, 1, '2016-05-27 13:19:44', 1, '2016-05-27 13:20:37', '0', '1'),
(11, 1, '2017-01-20 23:50:54', NULL, NULL, '1', '1'),
(12, 1, '2017-01-20 23:51:29', NULL, NULL, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_photos`
--

DROP TABLE IF EXISTS `gallery_photos`;
CREATE TABLE IF NOT EXISTS `gallery_photos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `gallery_id` int(10) UNSIGNED NOT NULL,
  `image` char(255) NOT NULL,
  `ordering` int(10) UNSIGNED NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `add_by` int(10) UNSIGNED NOT NULL,
  `add_datetime` datetime NOT NULL,
  `mod_by` int(10) UNSIGNED DEFAULT NULL,
  `mod_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_id` (`gallery_id`),
  KEY `mod_by` (`mod_by`),
  KEY `add_by` (`add_by`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gallery_photos`
--

INSERT INTO `gallery_photos` (`id`, `gallery_id`, `image`, `ordering`, `status`, `add_by`, `add_datetime`, `mod_by`, `mod_datetime`) VALUES
(2, 1, '01-27.12.16-1.jpg', 3, '0', 1, '2015-08-21 17:24:16', 1, '2017-02-01 23:59:49'),
(7, 1, '1.jpg', 15, '1', 1, '2015-08-21 19:28:27', NULL, NULL),
(8, 1, '2.jpg', 6, '1', 1, '2015-08-21 19:28:27', NULL, NULL),
(9, 1, '3.jpg', 2, '1', 1, '2015-08-21 19:28:28', NULL, NULL),
(10, 1, '4.jpg', 4, '1', 1, '2015-08-21 19:28:29', NULL, NULL),
(11, 1, '5.jpg', 17, '1', 1, '2015-08-21 19:28:29', NULL, NULL),
(12, 1, '6.jpg', 20, '1', 1, '2015-08-21 19:28:30', NULL, NULL),
(13, 1, '7.jpg', 11, '1', 1, '2015-08-21 19:28:31', NULL, NULL),
(14, 1, '8.jpg', 16, '1', 1, '2015-08-21 19:28:31', NULL, NULL),
(15, 1, '7-bliss.jpg', 14, '1', 1, '2015-08-21 19:28:32', NULL, NULL),
(16, 1, '9.jpg', 10, '1', 1, '2015-08-21 19:28:33', NULL, NULL),
(17, 1, '10.jpg', 5, '1', 1, '2015-08-21 19:28:34', NULL, NULL),
(18, 1, '11.jpg', 21, '1', 1, '2015-08-21 19:28:34', NULL, NULL),
(19, 1, '12.jpg', 13, '1', 1, '2015-08-21 19:28:35', NULL, NULL),
(20, 1, 'aquamarine.jpg', 9, '1', 1, '2015-08-21 19:28:36', NULL, NULL),
(21, 1, 'black.jpg', 22, '1', 1, '2015-08-21 19:28:36', NULL, NULL),
(22, 1, 'blue.jpg', 12, '1', 1, '2015-08-21 19:28:37', NULL, NULL),
(23, 1, 'dark-red.jpg', 8, '1', 1, '2015-08-21 19:28:38', NULL, NULL),
(24, 1, 'green.jpg', 1, '1', 1, '2015-08-21 19:28:38', NULL, NULL),
(25, 1, 'pink.jpg', 18, '1', 1, '2015-08-21 19:28:39', NULL, NULL),
(26, 1, 'purple.jpg', 19, '1', 1, '2015-08-21 19:28:40', NULL, NULL),
(30, 9, 'img_0155.jpg', 2, '1', 1, '2016-05-16 15:28:10', NULL, NULL),
(31, 9, 'img_0157.jpg', 4, '1', 1, '2016-05-16 15:28:11', NULL, NULL),
(32, 9, 'wp_20160427_00_15_09_pro.jpg', 3, '1', 1, '2016-05-16 15:28:11', NULL, NULL),
(33, 9, 'wp_20160427_00_17_47_pro.jpg', 5, '1', 1, '2016-05-16 15:28:12', NULL, NULL),
(34, 9, 'wp_20160427_01_02_31_pro.jpg', 1, '1', 1, '2016-05-16 15:28:12', NULL, NULL),
(35, 9, 'wp_20160427_08_41_43_pro.jpg', 6, '1', 1, '2016-05-16 16:33:24', NULL, NULL),
(36, 9, 'wp_20160427_08_42_57_pro.jpg', 7, '1', 1, '2016-05-16 16:33:24', NULL, NULL),
(37, 9, 'wp_20160427_11_08_43_pro.jpg', 8, '1', 1, '2016-05-16 16:33:25', NULL, NULL),
(38, 1, '13863134908390.jpg', 23, '1', 1, '2017-02-01 23:14:22', NULL, NULL),
(39, 1, 'obama-2.jpg', 24, '1', 1, '2017-02-01 23:14:22', NULL, NULL),
(40, 1, 'ivan-drago.jpg', 25, '1', 1, '2017-02-01 23:14:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `type` enum('category','article','spec','url') NOT NULL,
  `ref_table` char(64) DEFAULT NULL,
  `ref_id` int(10) UNSIGNED DEFAULT NULL,
  `url` char(255) DEFAULT NULL,
  `sef` char(80) DEFAULT NULL,
  `ordering` int(10) UNSIGNED NOT NULL,
  `add_by` int(10) UNSIGNED NOT NULL,
  `add_datetime` datetime NOT NULL,
  `mod_by` int(10) UNSIGNED DEFAULT NULL,
  `mod_datetime` datetime DEFAULT NULL,
  `is_section` enum('0','1') NOT NULL DEFAULT '0',
  `is_published` enum('1','0') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sef` (`sef`),
  KEY `parent_id` (`parent_id`),
  KEY `ref_table` (`ref_table`,`ref_id`),
  KEY `add_by` (`add_by`),
  KEY `mod_by` (`mod_by`),
  KEY `ordering` (`ordering`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='''name''';

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `parent_id`, `type`, `ref_table`, `ref_id`, `url`, `sef`, `ordering`, `add_by`, `add_datetime`, `mod_by`, `mod_datetime`, `is_section`, `is_published`, `is_deleted`) VALUES
(49, 0, 'category', NULL, NULL, NULL, 'meqaleler', 2, 1, '2017-05-09 14:07:05', NULL, NULL, '0', '1', '0'),
(48, 44, 'category', NULL, NULL, NULL, 'php', 3, 1, '2017-05-09 14:06:24', NULL, NULL, '0', '1', '0'),
(47, 44, 'category', NULL, NULL, NULL, 'it', 2, 1, '2017-05-09 13:58:41', NULL, NULL, '0', '1', '0'),
(46, 44, 'category', NULL, NULL, NULL, '1', 1, 1, '2017-05-09 13:57:05', NULL, NULL, '0', '1', '1'),
(45, 0, 'spec', NULL, NULL, NULL, 'elaqe', 5, 1, '2017-05-09 13:52:55', NULL, NULL, '0', '1', '0'),
(44, 0, 'category', NULL, NULL, NULL, 'xeberler', 1, 1, '2017-05-09 13:45:41', NULL, NULL, '1', '1', '0'),
(43, 0, 'article', 'articles', 4, NULL, 'privacy-policy', 4, 1, '2017-05-09 13:42:20', 1, '2017-05-09 13:47:46', '0', '1', '0'),
(42, 0, 'article', 'articles', 20, NULL, 'istifade-qaydalari', 3, 1, '2017-05-07 23:58:13', NULL, NULL, '0', '1', '0'),
(41, 0, 'url', NULL, NULL, '/', NULL, 0, 1, '2017-05-07 01:59:53', 1, '2017-05-07 23:39:05', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `menu_navpos_rel`
--

DROP TABLE IF EXISTS `menu_navpos_rel`;
CREATE TABLE IF NOT EXISTS `menu_navpos_rel` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item_id` int(10) UNSIGNED NOT NULL,
  `navpos_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_id` (`item_id`,`navpos_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu_navpos_rel`
--

INSERT INTO `menu_navpos_rel` (`id`, `item_id`, `navpos_id`) VALUES
(21, 1, 6),
(12, 2, 5),
(15, 16, 2),
(13, 14, 2),
(14, 15, 2),
(10, 2, 2),
(7, 3, 2),
(8, 4, 2),
(9, 5, 2),
(16, 17, 2),
(17, 18, 2),
(18, 19, 2),
(19, 20, 2),
(20, 20, 6),
(22, 16, 6),
(23, 17, 6),
(24, 18, 6),
(25, 19, 6),
(26, 26, 2),
(27, 26, 6),
(28, 27, 6),
(29, 28, 6),
(30, 29, 6),
(31, 30, 5),
(36, 42, 5),
(35, 41, 6),
(37, 42, 6),
(38, 44, 2),
(39, 44, 6),
(40, 43, 5),
(41, 43, 6),
(42, 45, 2),
(43, 45, 6),
(44, 49, 2),
(45, 49, 6);

-- --------------------------------------------------------

--
-- Table structure for table `nav_positions`
--

DROP TABLE IF EXISTS `nav_positions`;
CREATE TABLE IF NOT EXISTS `nav_positions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `position` char(32) NOT NULL,
  `name_az` char(255) NOT NULL,
  `name_ru` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nav_positions`
--

INSERT INTO `nav_positions` (`id`, `position`, `name_az`, `name_ru`) VALUES
(1, 'top', 'Yuxarı', 'Сверху'),
(2, 'main', 'Əsas menyu', 'Основное меню'),
(3, 'left', 'Soldaki', 'Слева'),
(4, 'right', 'Sağdaki', 'Справа'),
(5, 'bottom', 'Aşağıda', 'В футере'),
(6, 'sitemap', 'Saytın xaritəsi', 'Карта сайта');

-- --------------------------------------------------------

--
-- Table structure for table `site_languages`
--

DROP TABLE IF EXISTS `site_languages`;
CREATE TABLE IF NOT EXISTS `site_languages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `language_dir` char(2) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `language_name` char(64) NOT NULL,
  `is_published` enum('0','1') NOT NULL DEFAULT '0',
  `is_default` enum('0','1') NOT NULL DEFAULT '0',
  `is_rtl` enum('0','1') NOT NULL DEFAULT '0',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `language_dir` (`language_dir`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_languages`
--

INSERT INTO `site_languages` (`id`, `language_dir`, `language_name`, `is_published`, `is_default`, `is_rtl`, `is_deleted`) VALUES
(1, 'az', 'Azərbaycan dili', '1', '1', '0', '0'),
(2, 'ru', 'Русский язык', '1', '0', '0', '1');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

DROP TABLE IF EXISTS `site_settings`;
CREATE TABLE IF NOT EXISTS `site_settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option` char(64) NOT NULL,
  `value` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `option` (`option`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `option`, `value`) VALUES
(6, 'cms_default_landing_page', '?controller=statistics&action=dashboard'),
(2, 'site_default_lang_dir', 'az'),
(3, 'cms_name', 'PROFIT CMS'),
(4, 'cms_default_lang', 'az'),
(5, 'cms_name_formatted', '<b>PROFIT</b>CMS');

-- --------------------------------------------------------

--
-- Table structure for table `site_users`
--

DROP TABLE IF EXISTS `site_users`;
CREATE TABLE IF NOT EXISTS `site_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` char(64) DEFAULT NULL,
  `provider` char(255) DEFAULT NULL,
  `identity` char(255) DEFAULT NULL,
  `profile` char(255) DEFAULT NULL,
  `email` char(255) DEFAULT NULL,
  `password_hash` varchar(96) NOT NULL,
  `verified_email` tinyint(4) NOT NULL,
  `first_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `nickname` char(255) NOT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `registration_datetime` datetime NOT NULL,
  `last_login_datetime` datetime DEFAULT NULL,
  `is_blocked` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uid` (`uid`,`provider`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site_users`
--

INSERT INTO `site_users` (`id`, `uid`, `provider`, `identity`, `profile`, `email`, `password_hash`, `verified_email`, `first_name`, `last_name`, `avatar`, `nickname`, `birth_date`, `gender`, `registration_datetime`, `last_login_datetime`, `is_blocked`) VALUES
(1, '116883195089063849540', 'googleplus', 'https://plus.google.com/u/0/116883195089063849540/', 'https://plus.google.com/116883195089063849540', 'profitaz1@gmail.com', '', 1, 'Professional', 'IT', '', 'profit', NULL, NULL, '2016-05-24 12:16:40', '2016-05-24 13:05:57', '1'),
(2, '1190297687648667', 'facebook', 'https://www.facebook.com/app_scoped_user_id/1190297687648667/', 'https://www.facebook.com/app_scoped_user_id/1190297687648667/', 'vallos_alien@mail.ru', '', 1, 'Валентин', 'Белоусов', '', 'belousov_valentin', NULL, NULL, '2016-05-24 13:22:37', '2016-05-24 13:22:37', '0'),
(3, '111454852475613307532', 'googleplus', 'https://plus.google.com/u/0/111454852475613307532/', 'https://plus.google.com/111454852475613307532', 'qurban.qurbanov93@gmail.com', '', 1, 'Курбан', 'Курбанов', '', 'kurbanov_kurban', '2016-06-24', 'male', '2016-05-24 13:24:00', '2016-05-30 14:19:39', '0');

-- --------------------------------------------------------

--
-- Table structure for table `site_users_events`
--

DROP TABLE IF EXISTS `site_users_events`;
CREATE TABLE IF NOT EXISTS `site_users_events` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `ref_table` varchar(64) NOT NULL,
  `ref_id` int(10) UNSIGNED NOT NULL,
  `event_type` enum('like','vote') NOT NULL,
  `event` enum('like','dislike','up_vote','down_vote','neutral_vote') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id_2` (`user_id`,`ref_table`,`ref_id`,`event_type`),
  KEY `user_id` (`user_id`),
  KEY `ref_table` (`ref_table`,`ref_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `translates`
--

DROP TABLE IF EXISTS `translates`;
CREATE TABLE IF NOT EXISTS `translates` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ref_table` char(64) NOT NULL,
  `ref_id` int(10) UNSIGNED NOT NULL,
  `lang` char(2) NOT NULL,
  `fieldname` char(64) NOT NULL,
  `text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ref_table_2` (`ref_table`,`ref_id`,`lang`,`fieldname`),
  KEY `ref_table` (`ref_table`,`ref_id`)
) ENGINE=MyISAM AUTO_INCREMENT=607 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `translates`
--

INSERT INTO `translates` (`id`, `ref_table`, `ref_id`, `lang`, `fieldname`, `text`) VALUES
(1, 'articles', 4, 'az', 'title', 'Aprelin 29-da “Yaz həyəti” layihəsi çərçivəsində təhsil müəssisələrində iməcilik keçirilib.'),
(2, 'articles', 4, 'az', 'short', ''),
(3, 'articles', 4, 'az', 'full', '- Təhsil Nazirliyi və IDEA İctimai Birliyinin təşkilatçılığı, "Bir" Tələbə-Könüllü Proqramının dəstəyi ilə həyata keçirilən “Yaz həyəti” layihəsinin məqsədi şagird və tələbələr arasında ətraf mühitin qorunmasına dair maarifləndirmə işinin aparılmasıdan ibarətdir.\r\n\r\nLayihə 48 rayon və şəhər üzrə ali, ilk peşə və orta ixtisas, eləcə də ümumi təhsil müəssisələrində həyata keçirilir. Mayın 1-dək təhsil müəssisələrinə ayrılmış 12 000-ə yaxın ağac tingi tədris ocaqlarına aid həyətyanı sahədə əkiləcək.\r\n\r\nHəmçinin, "Yaz həyəti" layihəsi çərçivəsində Bakı, Gəncə və Sumqayıt şəhərlərindəki 26 ümumi təhsil müəssisəsində müsabiqə keçiriləcək. Müsabiqənin şərtlərinə uyğun olaraq, seçilmiş məktəblər pedaqoji kolektivin, şagirdlərin və tələbə-könüllülərin iştirakı ilə təhsil müəssisəsinin həyətyanı sahəsinin təmizlənməsini, yaşıllığın salınmasını, ağacların gövdəsinin əhənglənməsini həyata keçirəcəklər. Layihənin sonunda Təhsil Nazirliyi, IDEA İctimai Birliyi və "Bir" Tələbə-Könüllü Proqramının nümayəndələri tərəfindən qalib müəyyən ediləcək.'),
(10, 'articles', 5, 'az', 'title', 'Гурбан выпил двести грамм и угнал строительный кран'),
(4, 'articles', 4, 'ru', 'title', ''),
(5, 'articles', 4, 'ru', 'short', ''),
(6, 'articles', 4, 'ru', 'full', ''),
(7, 'articles', 4, 'ge', 'title', ''),
(8, 'articles', 4, 'ge', 'short', ''),
(9, 'articles', 4, 'ge', 'full', ''),
(11, 'articles', 5, 'az', 'short', ''),
(12, 'articles', 5, 'az', 'full', 'Неееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееееет!'),
(19, 'articles', 6, 'az', 'title', 'some silly title'),
(20, 'articles', 6, 'az', 'short', ''),
(21, 'articles', 6, 'az', 'full', 'vfdba dfgf sgfv sgf gsb gfs'),
(22, 'articles', 6, 'ru', 'title', ''),
(23, 'articles', 6, 'ru', 'short', ''),
(24, 'articles', 6, 'ru', 'full', ''),
(25, 'articles', 6, 'ge', 'title', ''),
(26, 'articles', 6, 'ge', 'short', ''),
(27, 'articles', 6, 'ge', 'full', ''),
(28, 'articles', 7, 'az', 'title', 'Тест опубликованности/неопубликованности языковых версий'),
(13, 'articles', 5, 'ru', 'title', ''),
(14, 'articles', 5, 'ru', 'short', ''),
(15, 'articles', 5, 'ru', 'full', ''),
(16, 'articles', 5, 'ge', 'title', ''),
(17, 'articles', 5, 'ge', 'short', ''),
(18, 'articles', 5, 'ge', 'full', ''),
(29, 'articles', 7, 'az', 'short', ''),
(30, 'articles', 7, 'az', 'full', 'Тест опубликован ности/неопубл икованности языковых версий Тест опубликованности/неопубликованности языковых версий Тест опубликован икованности языковых версий Тест опубликован опубликованности языковых версий'),
(31, 'articles', 7, 'az', 'is_published', '1'),
(32, 'articles', 7, 'ru', 'title', 'Такой вот русский текст'),
(33, 'articles', 7, 'ru', 'short', ''),
(34, 'articles', 7, 'ru', 'full', 'Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст Такой вот русский текст'),
(35, 'articles', 7, 'ru', 'is_published', '1'),
(36, 'articles', 7, 'ge', 'title', 'А грузинский неопубликован'),
(37, 'articles', 7, 'ge', 'short', ''),
(38, 'articles', 7, 'ge', 'full', 'аим вафи ав фавыи впвф паы памв фавм ав авы авф'),
(39, 'articles', 7, 'ge', 'is_published', '1'),
(40, 'articles', 8, 'az', 'title', 'Yadda saxlanılmamış dəyişikliklər itiriləcək. Davam etmək istədiyinizə əminsinizmi?'),
(41, 'articles', 8, 'az', 'short', ''),
(42, 'articles', 8, 'az', 'full', '<p>&nbsp;vc f bv <strong>xbsgfb htrwhtgehtgshnbg<em>stbgtshbgfbffg gfv</em></strong></p>\r\n\r\n<table border="1" cellpadding="1" cellspacing="1" style="width:500px">\r\n	<tbody>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>&nbsp;</td>\r\n			<td>&nbsp;</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p>&nbsp;</p>'),
(43, 'articles', 8, 'az', 'is_published', '1'),
(44, 'articles', 8, 'ru', 'title', ''),
(45, 'articles', 8, 'ru', 'short', ''),
(46, 'articles', 8, 'ru', 'full', '<p>&nbsp;vbx bvx</p>'),
(47, 'articles', 8, 'ru', 'is_published', '0'),
(48, 'articles', 8, 'ge', 'title', ''),
(49, 'articles', 8, 'ge', 'short', ''),
(50, 'articles', 8, 'ge', 'full', ''),
(51, 'articles', 8, 'ge', 'is_published', '0'),
(52, 'articles', 9, 'az', 'title', 'bvfsbngfsn'),
(53, 'articles', 9, 'az', 'short', ''),
(54, 'articles', 9, 'az', 'full', '<p>bgfvsnbgfsngf</p>'),
(55, 'articles', 9, 'az', 'is_published', '1'),
(56, 'articles', 9, 'ru', 'title', ''),
(57, 'articles', 9, 'ru', 'short', ''),
(58, 'articles', 9, 'ru', 'full', ''),
(59, 'articles', 9, 'ru', 'is_published', '0'),
(60, 'articles', 9, 'ge', 'title', ''),
(61, 'articles', 9, 'ge', 'short', ''),
(62, 'articles', 9, 'ge', 'full', ''),
(63, 'articles', 9, 'ge', 'is_published', '0'),
(64, 'articles', 10, 'az', 'title', 'gbfsnd gfnd g dnhtg dngtd ngfvndn gbdn gf ndg nfd b'),
(65, 'articles', 10, 'az', 'short', ''),
(66, 'articles', 10, 'az', 'full', '<p>&nbsp;fg ngf ngfn gfnd</p>'),
(67, 'articles', 10, 'az', 'is_published', '1'),
(68, 'articles', 10, 'ru', 'title', ''),
(69, 'articles', 10, 'ru', 'short', ''),
(70, 'articles', 10, 'ru', 'full', ''),
(71, 'articles', 10, 'ru', 'is_published', '0'),
(72, 'articles', 10, 'ge', 'title', ''),
(73, 'articles', 10, 'ge', 'short', ''),
(74, 'articles', 10, 'ge', 'full', ''),
(75, 'articles', 10, 'ge', 'is_published', '0'),
(76, 'articles', 11, 'az', 'title', 'bgfvabfdabfdb afdab fdab fda'),
(77, 'articles', 11, 'az', 'short', ''),
(78, 'articles', 11, 'az', 'full', '<p>&nbsp;fda bfda bfdab fda df bfd afddf</p>'),
(79, 'articles', 11, 'az', 'is_published', '1'),
(80, 'articles', 11, 'ru', 'title', ''),
(81, 'articles', 11, 'ru', 'short', ''),
(82, 'articles', 11, 'ru', 'full', ''),
(83, 'articles', 11, 'ru', 'is_published', '0'),
(84, 'articles', 11, 'ge', 'title', ''),
(85, 'articles', 11, 'ge', 'short', ''),
(86, 'articles', 11, 'ge', 'full', ''),
(87, 'articles', 11, 'ge', 'is_published', '0'),
(88, 'menu', 1, 'az', 'name', 'Əsas sahifə'),
(89, 'menu', 1, 'ru', 'name', 'Главная страница'),
(90, 'menu', 1, 'ge', 'name', ''),
(91, 'menu', 2, 'az', 'name', 'тест'),
(92, 'menu', 2, 'ru', 'name', 'тест'),
(93, 'menu', 2, 'ge', 'name', 'тест'),
(94, 'menu', 3, 'az', 'name', 'т2'),
(95, 'menu', 3, 'ru', 'name', ''),
(96, 'menu', 3, 'ge', 'name', ''),
(97, 'menu', 4, 'az', 'name', 'т3'),
(98, 'menu', 4, 'ru', 'name', ''),
(99, 'menu', 4, 'ge', 'name', ''),
(100, 'menu', 5, 'az', 'name', 't4'),
(101, 'menu', 5, 'ru', 'name', ''),
(102, 'menu', 5, 'ge', 'name', ''),
(103, 'menu', 6, 'az', 'name', 't5 Specpage nested'),
(104, 'menu', 6, 'ru', 'name', ''),
(105, 'menu', 6, 'ge', 'name', ''),
(106, 'menu', 7, 'az', 'name', 't6 Category test item'),
(107, 'menu', 7, 'az', 'is_published_lang', '1'),
(108, 'menu', 7, 'ru', 'name', 't6 ru'),
(109, 'menu', 7, 'ru', 'is_published_lang', '1'),
(110, 'menu', 7, 'ge', 'name', 't6 ge'),
(111, 'menu', 7, 'ge', 'is_published_lang', '1'),
(112, 'menu', 8, 'az', 'name', 'Article test item'),
(113, 'menu', 8, 'az', 'is_published_lang', '1'),
(114, 'menu', 8, 'ru', 'name', ''),
(115, 'menu', 8, 'ru', 'is_published_lang', '0'),
(116, 'menu', 8, 'ge', 'name', ''),
(117, 'menu', 8, 'ge', 'is_published_lang', '0'),
(118, 'menu', 9, 'az', 'name', 'Deepest integrity level'),
(119, 'menu', 9, 'az', 'is_published_lang', '1'),
(120, 'menu', 9, 'ru', 'name', ''),
(121, 'menu', 9, 'ru', 'is_published_lang', '0'),
(122, 'menu', 9, 'ge', 'name', ''),
(123, 'menu', 9, 'ge', 'is_published_lang', '0'),
(124, 'menu', 10, 'az', 'name', 'Even more deep level'),
(125, 'menu', 10, 'az', 'is_published_lang', '1'),
(126, 'menu', 10, 'ru', 'name', ''),
(127, 'menu', 10, 'ru', 'is_published_lang', '0'),
(128, 'menu', 10, 'ge', 'name', ''),
(129, 'menu', 10, 'ge', 'is_published_lang', '0'),
(130, 'menu', 11, 'az', 'name', 'Deeper than the deep'),
(131, 'menu', 11, 'az', 'is_published_lang', '1'),
(132, 'menu', 11, 'ru', 'name', ''),
(133, 'menu', 11, 'ru', 'is_published_lang', '0'),
(134, 'menu', 11, 'ge', 'name', ''),
(135, 'menu', 11, 'ge', 'is_published_lang', '0'),
(136, 'menu', 12, 'az', 'name', 'D-d-d-deeper'),
(137, 'menu', 12, 'az', 'is_published_lang', '1'),
(138, 'menu', 12, 'ru', 'name', ''),
(139, 'menu', 12, 'ru', 'is_published_lang', '0'),
(140, 'menu', 12, 'ge', 'name', ''),
(141, 'menu', 12, 'ge', 'is_published_lang', '0'),
(142, 'menu', 13, 'az', 'name', 'Extra mega deep overflow of the navigation panel'),
(143, 'menu', 13, 'az', 'is_published_lang', '1'),
(144, 'menu', 13, 'ru', 'name', ''),
(145, 'menu', 13, 'ru', 'is_published_lang', '0'),
(146, 'menu', 13, 'ge', 'name', ''),
(147, 'menu', 13, 'ge', 'is_published_lang', '0'),
(148, 'menu', 14, 'az', 'name', 'a'),
(149, 'menu', 14, 'az', 'is_published_lang', '1'),
(150, 'menu', 14, 'ru', 'name', ''),
(151, 'menu', 14, 'ru', 'is_published_lang', '0'),
(152, 'menu', 14, 'ge', 'name', ''),
(153, 'menu', 14, 'ge', 'is_published_lang', '0'),
(154, 'menu', 15, 'az', 'name', 'a'),
(155, 'menu', 15, 'az', 'is_published_lang', '1'),
(156, 'menu', 15, 'ru', 'name', ''),
(157, 'menu', 15, 'ru', 'is_published_lang', '0'),
(158, 'menu', 15, 'ge', 'name', ''),
(159, 'menu', 15, 'ge', 'is_published_lang', '0'),
(160, 'menu', 16, 'az', 'name', 'Bizim haqqımızda'),
(161, 'menu', 16, 'az', 'is_published_lang', '1'),
(162, 'menu', 16, 'ru', 'name', 'О нас'),
(163, 'menu', 16, 'ru', 'is_published_lang', '1'),
(164, 'menu', 16, 'ge', 'name', ''),
(165, 'menu', 16, 'ge', 'is_published_lang', '0'),
(166, 'menu', 17, 'az', 'name', 'Ümümtəhsil'),
(167, 'menu', 17, 'az', 'is_published_lang', '1'),
(168, 'menu', 17, 'ru', 'name', 'Общее образование'),
(169, 'menu', 17, 'ru', 'is_published_lang', '1'),
(170, 'menu', 17, 'ge', 'name', ''),
(171, 'menu', 17, 'ge', 'is_published_lang', '0'),
(172, 'menu', 18, 'az', 'name', 'Layfhak'),
(173, 'menu', 18, 'az', 'is_published_lang', '1'),
(174, 'menu', 18, 'ru', 'name', 'Лайфхаки'),
(175, 'menu', 18, 'ru', 'is_published_lang', '1'),
(176, 'menu', 18, 'ge', 'name', ''),
(177, 'menu', 18, 'ge', 'is_published_lang', '0'),
(178, 'menu', 19, 'az', 'name', 'Araşdırmalar'),
(179, 'menu', 19, 'az', 'is_published_lang', '1'),
(180, 'menu', 19, 'ru', 'name', 'Исследования'),
(181, 'menu', 19, 'ru', 'is_published_lang', '1'),
(182, 'menu', 19, 'ge', 'name', ''),
(183, 'menu', 19, 'ge', 'is_published_lang', '0'),
(184, 'menu', 20, 'az', 'name', 'Müsahibələr'),
(185, 'menu', 20, 'az', 'is_published_lang', '1'),
(186, 'menu', 20, 'ru', 'name', 'Интервью'),
(187, 'menu', 20, 'ru', 'is_published_lang', '1'),
(188, 'menu', 20, 'ge', 'name', ''),
(189, 'menu', 20, 'ge', 'is_published_lang', '0'),
(190, 'menu', 21, 'az', 'name', 'Məktəbli'),
(191, 'menu', 21, 'az', 'is_published_lang', '1'),
(192, 'menu', 21, 'ru', 'name', 'Школьник'),
(193, 'menu', 21, 'ru', 'is_published_lang', '1'),
(194, 'menu', 21, 'ge', 'name', ''),
(195, 'menu', 21, 'ge', 'is_published_lang', '0'),
(196, 'menu', 22, 'az', 'name', 'Tələbə'),
(197, 'menu', 22, 'az', 'is_published_lang', '1'),
(198, 'menu', 22, 'ru', 'name', 'Студент'),
(199, 'menu', 22, 'ru', 'is_published_lang', '1'),
(200, 'menu', 22, 'ge', 'name', ''),
(201, 'menu', 22, 'ge', 'is_published_lang', '0'),
(202, 'menu', 23, 'az', 'name', 'Abituriyent'),
(203, 'menu', 23, 'az', 'is_published_lang', '1'),
(204, 'menu', 23, 'ru', 'name', 'Абитуриент'),
(205, 'menu', 23, 'ru', 'is_published_lang', '1'),
(206, 'menu', 23, 'ge', 'name', ''),
(207, 'menu', 23, 'ge', 'is_published_lang', '0'),
(208, 'menu', 24, 'az', 'name', 'Müəllim'),
(209, 'menu', 24, 'az', 'is_published_lang', '1'),
(210, 'menu', 24, 'ru', 'name', 'Педагог'),
(211, 'menu', 24, 'ru', 'is_published_lang', '1'),
(212, 'menu', 24, 'ge', 'name', ''),
(213, 'menu', 24, 'ge', 'is_published_lang', '0'),
(214, 'menu', 25, 'az', 'name', 'Valideyn'),
(215, 'menu', 25, 'az', 'is_published_lang', '1'),
(216, 'menu', 25, 'ru', 'name', 'Родитель'),
(217, 'menu', 25, 'ru', 'is_published_lang', '1'),
(218, 'menu', 25, 'ge', 'name', ''),
(219, 'menu', 25, 'ge', 'is_published_lang', '0'),
(220, 'menu', 26, 'az', 'name', 'Sorğular'),
(221, 'menu', 26, 'az', 'is_published_lang', '1'),
(222, 'menu', 26, 'ru', 'name', 'Опросы'),
(223, 'menu', 26, 'ru', 'is_published_lang', '1'),
(224, 'menu', 26, 'ge', 'name', ''),
(225, 'menu', 26, 'ge', 'is_published_lang', '0'),
(226, 'articles', 13, 'az', 'title', '"Arzularına çatmaq üçün dayanmadan çalışsınlar" - "Uğur formulu"'),
(227, 'articles', 13, 'az', 'short', ''),
(228, 'articles', 13, 'az', 'full', '<p>Təhsil Nazirliyi və&nbsp;Lent.az&nbsp;İnformasiya Agentliyinin &quot;2007-2015-ci illərdə Azərbaycan gənclərinin xarici &ouml;lkələrdə təhsili &uuml;zrə D&ouml;vlət Proqramı&rdquo; təqa&uuml;d&ccedil;&uuml;lərini tanıdan birgə layihəsi &quot;Uğur formulu&rdquo;nun qonağı Kanadanın Vaterloo Universitetinin tələbəsi Anar Xəlilzadədir.&nbsp;</p>\r\n\r\n<p>Anar Xəlilzadə Kanadanın Vaterloo Universitetində kimya m&uuml;həndisliyi ixtisası &uuml;zrə bakalavr səviyyəsində təhsilini davam etdirir.</p>\r\n\r\n<p><strong>- Xaricdə təhsil sizə nə verir? &Uuml;midlərinizi doğruldurmu?</strong></p>\r\n\r\n<p>- Xaricdə təhsil almaq imkanı mənim hələ uşaqlıqdan olan arzumun reallaşmasına imkan yaradıb. X&uuml;susilə se&ccedil;diyim kimya m&uuml;həndisliyi ixtisası &uuml;zrə Qərbdə olan inkişaf səviyyəsini nəzərə alsaq, xaricdə təhsilin mənə və mənim &ouml;lkəmə nə qədər faydalı ola biləcəyini g&ouml;rərik.</p>\r\n\r\n<p>İnanıram ki, xaricdə təhsil &ouml;lkəmizdə &ccedil;ox da populyar olmayan, ancaq olduqca vacib bir sahə &uuml;zrə əsl peşəkar kimi yetişib Azərbaycanda &ccedil;alışmağıma yardım&ccedil;ı olacaq. Bundan əlavə, xaricdə təhsil almaq hər kəsə sərbəst yaşamağı, m&uuml;əyyən məsələlər &uuml;zrə sərbəst qərar verməyi &ouml;yrədir və yekunda insanın tam bir yetkin fərd kimi &ouml;z cəmiyyətinə t&ouml;hfə vermək prosesini s&uuml;rətləndirir.</p>\r\n\r\n<p>Təhsil aldığım Kanadanın Vaterloo Universiteti mənim g&ouml;zləntilərimi tam olaraq doğruldur. Burada se&ccedil;diyim sahə &uuml;zrə y&uuml;ksək səviyyəli peşəkar olmağım &uuml;&ccedil;&uuml;n hər bir şərait yaradılıb. İstər təhsil, istər ictimai həyat baxımından burada ke&ccedil;irdiyim g&uuml;nlər hədsiz dərəcədə maraqlı və yaddaqalan hadisələrlə zəngindir.&nbsp;</p>\r\n\r\n<p><strong>- Fərqli &ouml;lkə və təhsil m&uuml;hitini g&ouml;rd&uuml;kdən sonra əvvəl oxuduğunuz ali məktəbdə nəyin dəyişməsini arzulayardınız?</strong></p>\r\n\r\n<p>- Vaterloo Universiteti mənim təhsil aldığım ilk ali məktəbdir. Odur ki, bu barədə hər hansı bir fikir irəli s&uuml;rməyim m&uuml;mk&uuml;n olmayacaq.&nbsp;</p>\r\n\r\n<p><strong>- Təhsil aldığınız &ouml;lkəyə Azərbaycanla bağlı hansı materialları aparmısınız?</strong></p>\r\n\r\n<p>-Təhsil almağa yola d&uuml;şərkən daha &ccedil;ox Azərbaycana aid materiallar və m&uuml;xtəlif atributları &ouml;z&uuml;mlə g&ouml;t&uuml;rd&uuml;m. Bunlara &ouml;lkəmizin bayrağı, Azərbaycan haqqında ingilis dilində olan broş&uuml;rlər, disklər, milli şirniyyatlar və suvenirlər aiddir. Burada tanış olduğum hər kəsə bacardığım qədər &ouml;lkəmiz haqqında məlumat verməyə &ccedil;alışıram. Tələbə yoldaşlarımın Azərbaycana marağı b&ouml;y&uuml;kd&uuml;r.&nbsp;</p>\r\n\r\n<p><strong>- Azərbaycan gənclərinə, &ouml;lkəmizdəki dostlarınıza, həmyaşıdlarınıza nə demək istərdiniz?</strong></p>\r\n\r\n<p>- &Ouml;z arzularına &ccedil;atmaları &uuml;&ccedil;&uuml;n dayanmadan &ccedil;alışsınlar. M&uuml;asir d&uuml;nyada əldə olunmayacaq bir şey yoxdur. Sadəcə, nəyəsə nail olmaq &uuml;&ccedil;&uuml;n məqsədy&ouml;nl&uuml;, &ccedil;alışqan, d&uuml;r&uuml;st olmaq lazımdır. D&ouml;vlətimiz tərəfindən arzularımızın reallaşması &uuml;&ccedil;&uuml;n hər bir şəraitin yaradılacağına inanaraq, irəliləməyi məsləhət g&ouml;r&uuml;rəm. Sırf m&uuml;həndislik ixtisası &uuml;zrə təhsil almaq niyyətində olanlara məhz oxuduğum Vaterloo Universitetinin M&uuml;həndislik fak&uuml;ltəsini se&ccedil;məyi t&ouml;vsiyə edirəm.&nbsp;</p>\r\n\r\n<p><strong>- Oxuduğunuz ali məktəbdə m&uuml;əllim-tələbə m&uuml;nasibəti necədir?</strong></p>\r\n\r\n<p>- M&uuml;əllimlərlə tələbələr arasında sərbəst və səmimi m&uuml;nasibətlər m&ouml;vcuddur. Burada m&uuml;əllimlərlə sıx interaktiv təmasda olmaq &ccedil;ox &ouml;nəmlidir. Bunun &uuml;&ccedil;&uuml;n m&uuml;əllimlər tərəfindən hər bir imkan yaradılır. Universitetin m&uuml;əllim heyətinin əsas məqsədi tələbələrin hər bir sualını ətraflı şəkildə cavablandırmaq və səmimi akademik m&uuml;hit yaratmaqdır.&nbsp;</p>\r\n\r\n<p><strong>- Universitetdə əcnəbi tələbələrə m&uuml;nasibətdən razısınızmı?</strong></p>\r\n\r\n<p>- Vaterloo Universitetində &ccedil;oxsaylı əcnəbi tələbə təhsil alır. Universitet rəhbərliyi və m&uuml;əllimlər tərəfindən tələbələr he&ccedil; bir halda yerli və ya əcnəbi olaraq fərqləndirilmir. Hər bir tələbəyə eyni dərəcədə şərait yaradılır. Universitetdə 50-dən &ccedil;ox azərbaycanlı tələbə təhsil alır. &Ccedil;alışırıq hər zaman istənilən məsələdə biri-birimizə dəstək olaq.&nbsp;</p>\r\n\r\n<p><strong>- Xarici &ouml;lkədən Azərbaycan təhsilini necə g&ouml;r&uuml;rs&uuml;n&uuml;z?</strong></p>\r\n\r\n<p>- Azərbaycanda ali təhsil almadığım &uuml;&ccedil;&uuml;n bu sualı cavablandırmağa &ccedil;ətinlik &ccedil;əkirəm. Bununla belə, məndə olan məlumata əsaslanaraq, sırf mənim ixtisasım olan kimya m&uuml;həndisliyi sahəsində təhsilin daha da inkişaf etdirilməsinin və praktiki təcr&uuml;bələrin artırılmasının vacib olması qənaətindəyəm.&nbsp;</p>\r\n\r\n<p><strong>- &Ccedil;ətinlikləriniz varmı?</strong></p>\r\n\r\n<p>- Tələbəliyimin ilk ili olmasına g&ouml;rə təbii ki, vaxtaşırı m&uuml;əyyən &ccedil;ətinliklərlə rastlaşıram. Bunlar əsasən, ki&ccedil;ik məişət problemləri, dərslərimin &ccedil;ox olmasına g&ouml;rə vaxt azlığı, &ouml;lkəmizdən fərqli olaraq Kanadaya xas soyuq hava və bu kimi digər amillərdir.&nbsp;</p>\r\n\r\n<p><strong>- Asudə vaxtınızda nə ilə məşğul olursunuz?</strong></p>\r\n\r\n<p>- Təəss&uuml;f ki, dərslərimin &ccedil;ox intensiv olması səbəbindən asudə vaxtım &ccedil;ox azdır. Amma vaxt olanda &ccedil;alışıram ki, idmanla məşğul olum. Universitetin nəzdində bunun &uuml;&ccedil;&uuml;n hər bir imkan yaradılıb.</p>'),
(229, 'articles', 13, 'az', 'is_published', '1'),
(230, 'articles', 13, 'ru', 'title', ''),
(231, 'articles', 13, 'ru', 'short', ''),
(232, 'articles', 13, 'ru', 'full', ''),
(233, 'articles', 13, 'ru', 'is_published', '0'),
(234, 'articles', 13, 'ge', 'title', ''),
(235, 'articles', 13, 'ge', 'short', ''),
(236, 'articles', 13, 'ge', 'full', ''),
(237, 'articles', 13, 'ge', 'is_published', '0'),
(238, 'menu', 18, 'zh', 'name', ''),
(239, 'menu', 18, 'zh', 'is_published_lang', '0'),
(240, 'menu', 20, 'zh', 'name', ''),
(241, 'menu', 20, 'zh', 'is_published_lang', '0'),
(242, 'galleries', 9, 'az', 'name', '"Arzularına çatmaq üçün dayanmadan çalışsınlar" - "Uğur formulu"'),
(243, 'galleries', 9, 'az', 'is_published_lang', '1'),
(244, 'galleries', 9, 'ru', 'name', ''),
(245, 'galleries', 9, 'ru', 'is_published_lang', '0'),
(246, 'galleries', 9, 'zh', 'name', ''),
(247, 'galleries', 9, 'zh', 'is_published_lang', '0'),
(248, 'galleries', 1, 'az', 'name', 'The development testing gallery'),
(249, 'galleries', 1, 'az', 'is_published_lang', '1'),
(250, 'galleries', 1, 'ru', 'name', 'Зе девелопмент тестинг галлери'),
(251, 'galleries', 1, 'ru', 'is_published_lang', '1'),
(252, 'galleries', 1, 'zh', 'name', ''),
(253, 'galleries', 1, 'zh', 'is_published_lang', '0'),
(254, 'gallery_photos', 31, 'az', 'name', 'mi bəndlə qutusu'),
(255, 'gallery_photos', 31, 'ru', 'name', 'коробочка с ми бяндом!'),
(256, 'gallery_photos', 31, 'zh', 'name', ''),
(257, 'gallery_photos', 2, 'az', 'name', 'Yelsabedler2'),
(258, 'gallery_photos', 2, 'ru', 'name', 'руссскай'),
(259, 'gallery_photos', 2, 'zh', 'name', ''),
(263, 'articles', 14, 'az', 'title', '“Dostluq kuboku -2016” futbol turniri keçirilib'),
(264, 'articles', 14, 'az', 'short', ''),
(265, 'articles', 14, 'az', 'full', '<p>&Uuml;mummilli lider Heydər Əliyevin anadan olmasının 93-c&uuml; ild&ouml;n&uuml;m&uuml;nə həsr olunmuş &ldquo;Dostluq kuboku -2016&rdquo; mini futbol turniri turniri ke&ccedil;irilib.</p>\r\n\r\n<p>Yarışlar Azərbaycan Respublikası Təhsil Nazirliyi, Azərbaycan Respublikası Nazirlər Kabineti yanında &ldquo;İ&ccedil;ərişəhər&rdquo; D&ouml;vlət Tarix-Memarlıq Qoruğu İdarəsi, Azərbaycan Respublikasının Prezidenti yanında Vətəndaşlara Xidmət və Sosial İnnovasiyalar &uuml;zrə D&ouml;vlət Agentliyi və&nbsp;Azərbaycan Respublikasının Nazirlər Kabineti yanında Dənizkənarı Bulvar İdarəsinin&nbsp; əməkdaşları arasında&nbsp;ke&ccedil;irilib.</p>\r\n\r\n<p>D&ouml;vlət qurumlarının Həmkarlar İttifaqı komitələrinin təşkilat&ccedil;ılığı ilə ke&ccedil;irilən yarış iş&ccedil;ilərin sağlam həyat tərzinə cəlb edilməsi, onların asudə vaxtının və istirahətinin səmərəliliyinin artırılması məqsədilə təşkil olunub.</p>\r\n\r\n<p>Azərbaycan Tennis Akademiyasının stadionunda baş tutan və gərgin m&uuml;barizə şəraitində ke&ccedil;ən yarışlarda Təhsil Nazirliyinin komandası III yeri tutub.</p>\r\n\r\n<p>Qalib komandalar yarışın təşkilat&ccedil;ıları tərəfindən m&uuml;kafatlandırılıb.</p>'),
(266, 'articles', 14, 'az', 'is_published', '1'),
(267, 'articles', 14, 'ru', 'title', ''),
(268, 'articles', 14, 'ru', 'short', ''),
(269, 'articles', 14, 'ru', 'full', ''),
(270, 'articles', 14, 'ru', 'is_published', '0'),
(271, 'articles', 14, 'zh', 'title', ''),
(272, 'articles', 14, 'zh', 'short', ''),
(273, 'articles', 14, 'zh', 'full', ''),
(274, 'articles', 14, 'zh', 'is_published', '0'),
(275, 'articles', 13, 'zh', 'title', ''),
(276, 'articles', 13, 'zh', 'short', ''),
(277, 'articles', 13, 'zh', 'full', ''),
(294, 'articles', 16, 'az', 'keywords', 'Microsoft, yüksək texnologiyalar, Imagine Cup, innovasiya'),
(309, 'articles', 13, 'az', 'keywords', ''),
(310, 'articles', 13, 'ru', 'keywords', ''),
(311, 'articles', 13, 'zh', 'keywords', ''),
(295, 'articles', 16, 'az', 'title', '“Microsoft Imagine Cup 2016” müsabiqəsinin Milli Finalının qalibləri müəyyənləşib'),
(296, 'articles', 16, 'az', 'full', '<p>Mayın 17-də Təhsil Nazirliyi, Rabitə və Y&uuml;ksək Texnologiyalar Nazirliyi, Y&uuml;ksək Texnologiyalar Parkının dəstəyi, &laquo;Microsoft Azərbaycan&raquo; və &ldquo;Nar Mobile&rdquo; tərəfindən təşkil olunmuş &ldquo;Microsoft Imagine Cup 2016&rdquo; irimiqyaslı beynəlxalq texnologiya m&uuml;sabiqəsinin Milli Final mərhələsi ke&ccedil;irilib.</p>\r\n\r\n<p>Tədbirdə təhsil nazirinin m&uuml;avini Ceyhun Bayramov, rabitə və y&uuml;ksək texnologiyalar nazirinin m&uuml;avini Elmir Vəlizadə, &laquo;Microsoft Azərbaycan&raquo;ın baş direktoru Sərxan Həşimov, &ldquo;Nar Mobile&rdquo; şirkətinin baş icra&ccedil;ı direktoru Kent Maknili, Y&uuml;ksək Texnologiyalar Parkının Direktoru Seymur Ağayev, ali məktəb rektorları və tələbələr iştirak ediblər.</p>\r\n\r\n<p>Qeyd olunub ki, &ldquo;Microsoft Imagine Cup&rdquo; &ndash; innovasiya sahəsində gənclərin gələcək inkişafı, karyera y&uuml;ksəlişi və yeni perspektivlərə təkan verən bir m&uuml;sabiqədir. M&uuml;sabiqənin məqsədi Azərbaycan tələbələrinin istedadını &uuml;zə &ccedil;ıxarmaq və onların əmək bazarının tələblərinə hazırlıqlı m&uuml;təxəssis kimi yetişmələri &uuml;&ccedil;&uuml;n şərait yaratmaqdır.</p>\r\n\r\n<p>M&uuml;sabiqə &ccedil;ər&ccedil;ivəsində ali və ilk peşə-ixtisas təhsil m&uuml;əssisələrinin tələbə və şagirdlərindən ibarət komandalar 3 kateqoriya (&ldquo;İnnovasiya&rdquo;, &ldquo;Sosial layihələr&rdquo; və &ldquo;Oyunlar&rdquo;) &uuml;zrə iştirak ediblər. &ldquo;Sosial layihələr&rdquo; nominasiyasında SABAH qruplarının tələbələrindən ibarət &ldquo;TechSOS&rdquo; komandası qalib gəlib. Komandanın tərkibinə daxil olan Aytac Ağabəyli, G&uuml;nay Abdullayeva, Nailə İsmayılova və Sənan Quluzadə 3 hissədən ibarət olan (smartfonlar &uuml;&ccedil;&uuml;n tətbiq, bulud tətbiqi və avadanlıq) yıxılmanın m&uuml;əyyən edilməsi sistemini hazırlayıblar. Ki&ccedil;ik həcmli peycerə bənzər avadanlıq yaşlı insanın kəmərinə bərkidilir. Həmin ahıl insana nəzarət edən şəxsin Smartfonuna yıxılma baş verdiyi halda bulud tətbiqi vasitəsilə hadisə və hadisənin baş verdiyi yer haqda dərhal məlumat daxil olur. Bu, məlumatlandırma və ilkin yardım proseslərini s&uuml;rətləndirməyə yardım edir.&nbsp;</p>\r\n\r\n<p>&ldquo;İnnovasiya&rdquo; nominasiyasında &ldquo;JavaSet&rdquo; komandası qalib gəlib. Komandanın &uuml;zvləri Nicat Cavadov və Yesset Jusupov sifəti m&uuml;əyyənetmə funksiyası vasitəsilə emosiyaların identifikasiyası layihəsini təqdim ediblər. Bu məhsul m&uuml;əllimlərə dərslərin daha effektiv və keyfiyyətli təşkilində yardım edəcək. Belə ki, auditoriyanın g&ouml;r&uuml;nt&uuml;s&uuml;n&uuml; &ccedil;əkən bu məhsul məktəblilərin və ya tələbələrin sifətini, eləcə də emosiyalarını m&uuml;əyyən edir. Məhsulun şagird və tələbələrin gərginlik və ya narazılığını m&uuml;əyyən etməsi onların dərsi başa d&uuml;şməməsindən xəbər verir. Belə olduğu halda, m&uuml;əllim fənni təkrarən izah edə bilər.</p>\r\n\r\n<p>&ldquo;Oyunlar&rdquo; nominasiyasında &ldquo;ADA&rdquo; Universitetinin &ldquo;The Corp&rdquo; komandası qalib gəlib. Tələbələr &Uuml;lviyyə Məmmədzadə, Toğrul Rəhimli, Ramazan S&uuml;leymanlı və Əli Babayev hazırladıqları g&ouml;r&uuml;nt&uuml;s&uuml; olmayan səsli macəra oyununu təqdim ediblər. İnsan və tətbiq arasında aparılan dialoq vasitəsilə oyunun m&uuml;xtəlif mərhələlərini ke&ccedil;mək m&uuml;mk&uuml;nd&uuml;r. Bu məhsul məkan təfəkk&uuml;r&uuml; və məntiqin formalaşmasına yardım edir.&nbsp;</p>\r\n\r\n<p>&ldquo;Sosial layihələr&rdquo;, &ldquo;İnnovasiya&rdquo; və &ldquo;Oyunlar&rdquo; nominasiyaları &uuml;zrə ən yaxşı olan 3 komanda m&uuml;sabiqənin beynəlxalq yarımfinalında iştirak etmək imkanı qazanıb. Bu mərhələdə onlayn səsvermə təşkil olunacaq. Uğur qazanan komandalar Azərbaycanı 2016-cı ilin iyulunda m&uuml;sabiqənin beynəlxalq finalında təmsil edəcək və əsas m&uuml;kafat &ndash; 50 000 ABŞ dolları uğrunda m&uuml;barizə aparcaqlar.</p>\r\n\r\n<p>Sonra tədbir iştirak&ccedil;ıları qaliblərin qrup təqdimatlarını izləyiblər.</p>\r\n\r\n<p>Tədbirin sonunda &ldquo;Microsoft Imagine Cup 2016&rdquo; m&uuml;sabiqəsinin Milli Finalının qalibləri m&uuml;kafatlandırılıb.</p>'),
(278, 'articles', 13, 'zh', 'is_published', '0'),
(279, 'articles', 15, 'az', 'keywords', 'balkan, riyaziyyat, sinfinin, pilot, eksperimental, liseyin, şagirdi, 33-cü, beynəlxalq, olimpiadada, şagirdin, qazaxıstan, medalla, başlayıblar, qatıldığı, olimpiadalarında, ingiltərə, 2016-cı, səudiyyə, ərəbistanı'),
(280, 'articles', 15, 'az', 'title', 'Məktəblilərimiz 33-cü Balkan Riyaziyyat Olimpiadasından medalla qayıdıblar'),
(281, 'articles', 15, 'az', 'short', ''),
(282, 'articles', 15, 'az', 'full', '<p>5-10 may 2016-cı il tarixlərində Albaniyanın Tirana şəhərində 33-c&uuml; Beynəlxalq Balkan Riyaziyyat Olimpiadası ke&ccedil;irilib.</p>\r\n\r\n<p>Serbiya, Rumıniya, Makedoniya, Bolqarıstan, T&uuml;rkiyə kimi Balkan &ouml;lkələrinin, həm&ccedil;inin İtaliya, Fransa, İngiltərə, Qazaxıstan, Səudiyyə Ərəbistanı da daxil olmaqla, &uuml;mumilikdə 18 &ouml;lkədən 100-dən &ccedil;ox şagirdin qatıldığı olimpiadada Azərbaycan məktəbliləri uğurla &ccedil;ıxış ediblər.</p>\r\n\r\n<p>Olimpiadada &ouml;lkəmizi təmsil edən Gəncə şəhəri 26 n&ouml;mrəli fizika-riyaziyyat təmay&uuml;ll&uuml; liseyin eksperimental pilot&nbsp; sinfinin şagirdi Anar H&uuml;seynov g&uuml;m&uuml;ş və Bakı şəhəri akademik Zərifə Əliyeva adına liseyin eksperimental pilot&nbsp; sinfinin şagirdi Məhəmməd Şirinov b&uuml;r&uuml;nc medal qazanıb.</p>\r\n\r\n<p>Qeyd edək ki, hazırda komanda rəhbərləri və şagirdlər riyaziyyat, fizika, kimya, biologiya və informatika fənləri &uuml;zrə iyul ayında m&uuml;xtəlif &ouml;lkələrdə ke&ccedil;iriləcək beynəlxalq fənn olimpiadalarında daha yaxşı nəticələrin əldə olunması məqsədilə effektli hazırlıq prosesinə başlayıblar.</p>\r\n\r\n<p>&nbsp;</p>'),
(283, 'articles', 15, 'az', 'is_published', '1'),
(284, 'articles', 15, 'ru', 'keywords', ''),
(285, 'articles', 15, 'ru', 'title', ''),
(286, 'articles', 15, 'ru', 'short', ''),
(287, 'articles', 15, 'ru', 'full', ''),
(288, 'articles', 15, 'ru', 'is_published', '0'),
(289, 'articles', 15, 'zh', 'keywords', ''),
(290, 'articles', 15, 'zh', 'title', ''),
(291, 'articles', 15, 'zh', 'short', ''),
(292, 'articles', 15, 'zh', 'full', ''),
(293, 'articles', 15, 'zh', 'is_published', '0'),
(297, 'articles', 16, 'az', 'short', 'Mayın 17-də Təhsil Nazirliyi, Rabitə və Yüksək Texnologiyalar Nazirliyi, Yüksək Texnologiyalar Parkının dəstəyi, «Microsoft Azərbaycan» və “Nar Mobile” tərəfindən təşkil olunmuş “Microsoft Imagine Cup 2016” irimiqyaslı beynəlxalq texnologiya müsabiqəsinin Milli Final mərhələsi keçirilib.'),
(298, 'articles', 16, 'az', 'is_published', '1'),
(299, 'articles', 16, 'ru', 'keywords', ''),
(300, 'articles', 16, 'ru', 'title', ''),
(301, 'articles', 16, 'ru', 'full', ''),
(302, 'articles', 16, 'ru', 'short', ''),
(303, 'articles', 16, 'ru', 'is_published', '0'),
(304, 'articles', 16, 'zh', 'keywords', ''),
(305, 'articles', 16, 'zh', 'title', ''),
(306, 'articles', 16, 'zh', 'full', ''),
(307, 'articles', 16, 'zh', 'short', ''),
(308, 'articles', 16, 'zh', 'is_published', '0'),
(312, 'menu', 27, 'az', 'name', 'Privacy policy'),
(313, 'menu', 27, 'az', 'is_published_lang', '1'),
(314, 'menu', 27, 'ru', 'name', ''),
(315, 'menu', 27, 'ru', 'is_published_lang', '0'),
(316, 'menu', 27, 'zh', 'name', ''),
(317, 'menu', 27, 'zh', 'is_published_lang', '0'),
(318, 'menu', 28, 'az', 'name', 'İstifadə qaydaları'),
(319, 'menu', 28, 'az', 'is_published_lang', '1'),
(320, 'menu', 28, 'ru', 'name', ''),
(321, 'menu', 28, 'ru', 'is_published_lang', '0'),
(322, 'menu', 28, 'zh', 'name', ''),
(323, 'menu', 28, 'zh', 'is_published_lang', '0'),
(324, 'articles', 17, 'az', 'keywords', 'the, bar, and, sunny, that, for, sultan, had, classic, was, his, sign, lost, time, magnificent, lining, tim, saw, among, man'),
(325, 'articles', 17, 'az', 'title', 'Sunny\'s Nights'),
(326, 'articles', 17, 'az', 'full', '<p><strong>Imagine that Alice had walked into a bar instead of falling down the rabbit hole. In the tradition of J. R. Moehringer&rsquo;s <em>The Tender Bar</em> and the classic reportage of Joseph Mitchell, here is an indelible portrait of what is quite possibly the greatest bar in the world&mdash;and the mercurial, magnificent man behind it.</strong><br />\r\n<br />\r\nThe first time he saw Sunny&rsquo;s Bar, in 1995, Tim Sultan was lost, thirsty for a drink, and intrigued by the single bar sign among the forlorn warehouses lining the Brooklyn waterfront. Inside, he found a dimly lit room crammed with maritime artifacts, a dozen well-seasoned drinkers, and, strangely, a projector playing a classic Martha Graham dance performance. Sultan knew he had stumbled upon someplace special. What he didn&rsquo;t know was that he had just found his new home.<br />\r\n<br />\r\nSoon enough, Sultan has quit his office job to bartend full-time for Sunny Balzano, the bar&rsquo;s owner. A wild-haired Tony Bennett lookalike with a fondness for quoting Shakespeare and Samuel Beckett, Sunny is truly one of a kind. Born next to the saloon that...</p>'),
(327, 'articles', 17, 'az', 'short', 'Imagine that Alice had walked into a bar instead of falling down the rabbit hole. In the tradition of J. R. Moehringer’s The Tender Bar and the classic reportage of Joseph Mitchell, here is an indelible portrait of what is quite possibly the greatest bar in the world—and the mercurial, magnificent man behind it.'),
(328, 'articles', 17, 'az', 'is_published', '1'),
(329, 'articles', 17, 'ru', 'keywords', ''),
(330, 'articles', 17, 'ru', 'title', ''),
(331, 'articles', 17, 'ru', 'full', ''),
(332, 'articles', 17, 'ru', 'short', ''),
(333, 'articles', 17, 'ru', 'is_published', '0'),
(334, 'articles', 17, 'zh', 'keywords', ''),
(335, 'articles', 17, 'zh', 'title', ''),
(336, 'articles', 17, 'zh', 'full', ''),
(337, 'articles', 17, 'zh', 'short', ''),
(338, 'articles', 17, 'zh', 'is_published', '0'),
(339, 'articles', 18, 'az', 'keywords', 'elmi, təhsil, ali, gənc, müavini, doktorantların, bayramov, tərəfindən, konfrans, gənclərin, prezidenti, çıxış, nazirliyi, həm, yüksək, yaradılıb, elm, nazirinin, yeni, tədqiqatçıların'),
(340, 'articles', 18, 'az', 'title', 'Doktorantların və gənc tədqiqatçıların Respublika elmi konfransı'),
(341, 'articles', 18, 'az', 'full', '<p>Mayın 24-də Təhsil Nazirliyinin təşkilat&ccedil;ılığı ilə doktorantların və gənc tədqiqat&ccedil;ıların XX Respublika elmi konfransının a&ccedil;ılış mərasimi ke&ccedil;irilib.</p>\r\n\r\n<p>Mərasimdə təhsil nazirinin m&uuml;avini Ceyhun Bayramov, akademiklər, ali təhsil m&uuml;əssisələrinin rəhbərləri, tanınmış ziyalılar, doktorantlar və gənc tədqiqat&ccedil;ılar iştirak ediblər.</p>\r\n\r\n<p>Hər il ənənəvi olaraq təşkil edilən konfrans bu dəfə Azərbaycanda &ldquo;Multikulturalizm ili&rdquo;nə həsr olunub.</p>\r\n\r\n<p>Tədbirdə &ccedil;ıxış edən təhsil nazirinin m&uuml;avini Ceyhun Bayramov bildirib ki, builki konfrans &ldquo;Multikulturalizm ili&rdquo; &ccedil;ər&ccedil;ivəsində və &uuml;mummilli lider Heydər Əliyevin anadan olmasının 93-c&uuml; ild&ouml;n&uuml;m&uuml;nə həsr olunmuş tədbirlər sırasında &ouml;z&uuml;nəməxsus yer tutur. Konfrans gənclərə imkan verir ki, Azərbaycanın davamlı inkişafinı və &ccedil;i&ccedil;əklənməsini təmin edən elmi baxışlarını, yaratdıqları yeni nəzəriyyə və texnologiyalar haqqında fikirlərini b&ouml;l&uuml;şs&uuml;nlər, elmi biliklərini daha da zənginləşdirsinlər.</p>\r\n\r\n<p>M&uuml;asir cəmiyyətdə siyasi, iqtisadi və informasiya sahələrində rəqabətin g&uuml;cləndiyini nəzərə &ccedil;atdıran nazir m&uuml;avini təbii resursların kəskin azaldığı və ekoloji balansın pozulduğu bir d&ouml;vrdə elm və təhsilin rolunun s&uuml;rətlə artdığını s&ouml;yləyib. &Ouml;z&uuml;nun inkişaf strategiyasını insan kapitalının və intellektual resursların &uuml;zərində quran &ouml;lkəmiz Azərbaycan Respublikasının Prezidenti cənab İlham Əliyevin dediyi kimi, neft kapitalının insan kapitalına &ccedil;evrilməsi prinsipinə sadiqdir.</p>\r\n\r\n<p>C.Bayramov qeyd edib ki, təhsil sahəsində aparılan islahatlar yeni d&uuml;ş&uuml;ncəli və geniş d&uuml;nyag&ouml;r&uuml;şl&uuml; gənclərin hazırlanması məqsədlərinə y&ouml;nəlib. Təhsilalanların tədqiqat aparması, yeni informasiya texnologiyalarından istifadə etməsi və xarici dilləri &ouml;yrənməsi &uuml;&ccedil;&uuml;n geniş imkanlar yaradılıb.</p>\r\n\r\n<p>Elm və təhsilin səmərəli əlaqələrinin genişləndirilməsinin əhəmiyyətinə toxunan nazir m&uuml;avini &ldquo;Azərbaycan Respublikasında təhsilin inkişafı &uuml;zrə D&ouml;vlət Strategiyası&rdquo;nın qarşıya qoyduğu strateji istiqamət və hədəflərin Azərbaycan təhsilinin XXI əsrin &ccedil;ağırışlarına uyğun inkişaf meyillərini m&uuml;əyyənləşdirdiyini bildirib. Ali təhsil m&uuml;əssisələrində &ccedil;alışan elmi-pedaqoji kadrların orta yaş g&ouml;stəricilərinin y&uuml;ksək olması gənc elmi kadrların hazırlanmasını qarşıda duran əsas vəzifələrdən biri kimi aktuallaşdırır.</p>\r\n\r\n<p>C.Bayramov Təhsil Nazirliyi tərəfindən elm və təhsilin gələcək inkişafı &uuml;&ccedil;&uuml;n nəzərdə tutulmuş vacib tədbirləri diqqətə &ccedil;atdırıb, gənclərin potensialının tam realizə edilməsinə imkan verən təhsil m&uuml;hitinin yaradılmasının zəruriliyini vurğulayıb. Bu baxımdan gənclərimizin y&uuml;ksək intellektə malik hissəsi x&uuml;susi qayğı ilə əhatə olunur və onların &ouml;zlərini təsdiq etməsi &uuml;&ccedil;&uuml;n d&ouml;vlətimiz tərəfindən hər c&uuml;r şərait yaradılır. İntellektual potensialın qorunması məqsədi ilə y&uuml;ksək ixtisaslı kadrların fasiləsiz hazırlanması prosesi həm respublikamızın, həm də xarici &ouml;lkələrin ən n&uuml;fuzlu universitetlərində həyata ke&ccedil;irilir.</p>\r\n\r\n<p>Nazir m&uuml;avini bildirib ki, &ldquo;Thomson Reuters&rdquo; Agentliyinin bazasına daxil olan jurnalların elmi ictimaiyyət arasındakı n&uuml;fuzunu nəzərə alaraq, eləcə də Azərbaycan alimləri və doktorantları &uuml;&ccedil;&uuml;n bu bazadan istifadə etmək imkanını yaratmaq və alimlərimizin elmi fəaliyyətinə dair elmimetrik g&ouml;stəriciləri əldə etmək məqsədilə Təhsil Nazirliyi &ldquo;Thomson Reuters&rdquo; Agentliyi ilə əməkdaşlıq haqqında m&uuml;qavilə imzalayıb. M&uuml;qaviləyə əsasən, &ouml;lkəmizin 40 ali təhsil m&uuml;əssisəsinə abunə vasitəsilə bu Agentliyin məhsul və xidmətlərinə, eləcə də &ldquo;Web of Science&rdquo; platformasının bazasına &ccedil;ıxış imkanı yaradılıb. Azərbaycanın elmi nailiyyətlərinin beynəlxalq miqyasda tanınması, ali təhsil m&uuml;əssisələrinin elmi-pedaqoji əməkdaşlarının elmi fəaliyyətinin və nəşr aktivliyinin daha da y&uuml;ksəldilməsi məqsədilə Təhsil Nazirliyi &ldquo;Thomson Reuters&rdquo;in bazasına daxil olan jurnallarda &ccedil;ap edilmiş elmi əsərlərə g&ouml;rə hər ilin sonunda m&uuml;əlliflərin m&uuml;kafatlandırması &uuml;&ccedil;&uuml;n m&uuml;sabiqə ke&ccedil;irməyi nəzərdə tutur. M&uuml;stəqil Azərbaycanımızın xoşbəxt gələcəyi məhz gənclərin intellektual səviyyəsindən, milli və &uuml;mumbəşəri dəyərlərə dərindən yiyələnməsindən asılıdır. Bu m&uuml;h&uuml;m məsələlərin həlli yolunda sizin hər birinizə m&uuml;vəffəqiyyətlər, konfransın işinə isə uğurlar diləyirəm.</p>\r\n\r\n<p>Sonra &ccedil;ıxış edənlər gənclərin elmi tədqiqatlara cəlb olunmasının vacibliyini s&ouml;yləyib, son illərdə bu istiqamətdə atılan addımların təqdirəlayiq olduğunu bildiriblər.&nbsp;</p>\r\n\r\n<p>İki g&uuml;n davam edəcək kоnfransa 20 ali təhsil m&uuml;əssisəsindən və AMEA-dan 650 tezis təqdim olunub. Doktorantların və gənc tədqiqat&ccedil;ıların məruzələrinin dinlənilməsi və m&uuml;zakirəsi &uuml;&ccedil;&uuml;n tanınmış alimlərin rəhbərliyi ilə 17 b&ouml;lmə, o c&uuml;mlədən multikulturalizm b&ouml;lməsi yaradılıb.&nbsp;</p>\r\n\r\n<p>Konfransın materialları Azərbaycan D&ouml;vlət Neft və Sənaye Universiteti tərəfindən nəşr olunaraq iştirak&ccedil;ıların istifadəsinə veriləcək.</p>\r\n\r\n<p>Doktorantların və gənc tədqiqat&ccedil;ıların Respublika elmi konfransının materialları Azərbaycan Respublikası Prezidenti yanında Ali Attestasiya Komissiyası tərəfindən dissertasiyaların əsas elmi nəticələrinin dərc olunması t&ouml;vsiyə edilən elmi nəşrlər siyahısına daxildir.</p>\r\n\r\n<p>Plenar iclasdan sonra konfrans &ouml;z işini b&ouml;lmələrdə davam etdirib.</p>'),
(342, 'articles', 18, 'az', 'short', 'Mayın 24-də Təhsil Nazirliyinin təşkilatçılığı ilə doktorantların və gənc tədqiqatçıların XX Respublika elmi konfransının açılış mərasimi keçirilib.'),
(343, 'articles', 18, 'az', 'is_published_lang', '1'),
(344, 'articles', 18, 'ru', 'keywords', ''),
(345, 'articles', 18, 'ru', 'title', ''),
(346, 'articles', 18, 'ru', 'full', ''),
(347, 'articles', 18, 'ru', 'short', ''),
(348, 'articles', 18, 'ru', 'is_published_lang', '0'),
(349, 'articles', 18, 'zh', 'keywords', ''),
(350, 'articles', 18, 'zh', 'title', ''),
(351, 'articles', 18, 'zh', 'full', ''),
(352, 'articles', 18, 'zh', 'short', ''),
(353, 'articles', 18, 'zh', 'is_published_lang', '0'),
(354, 'menu', 17, 'zh', 'name', ''),
(355, 'menu', 17, 'zh', 'is_published_lang', '0'),
(356, 'menu', 19, 'zh', 'name', ''),
(357, 'menu', 19, 'zh', 'is_published_lang', '0'),
(358, 'menu', 26, 'zh', 'name', ''),
(359, 'menu', 26, 'zh', 'is_published_lang', '0'),
(360, 'menu', 29, 'az', 'name', 'Xəbərlər'),
(361, 'menu', 29, 'az', 'is_published_lang', '1'),
(362, 'menu', 29, 'ru', 'name', 'Новости'),
(363, 'menu', 29, 'ru', 'is_published_lang', '1'),
(364, 'menu', 29, 'zh', 'name', ''),
(365, 'menu', 29, 'zh', 'is_published_lang', '0'),
(366, 'articles', 19, 'az', 'keywords', 'bakı, tam, orta, məktəbin, kitab, müəllimi, təhsil, məktəb, community, müsabiqəsinin, edilən, valideynlərin, məqsədi, kvest-i, vətənim-azərbaycan, şagirdlərin, həvəskarı, ədəbiyyata, müəllimlərin, asc'),
(367, 'articles', 19, 'az', 'title', 'Community.az portalı onlayn müsabiqələrin qaliblərini təltif edib'),
(368, 'articles', 19, 'az', 'full', '<p>Məktəb icmaları &uuml;&ccedil;&uuml;n &ldquo;Kitab Kvest-i&rdquo; və &ldquo;Mənim vətənim-Azərbaycan&rdquo; m&uuml;sabiqələrinə yekun vurulub.</p>\r\n\r\n<p>Bu məqsədlə mayın 25-də Bakı şəhərindəki 18 n&ouml;mrəli tam orta məktəbdə hər iki m&uuml;sabiqə qaliblərinin m&uuml;kafatlandırılması mərasimi ke&ccedil;irilib. Tədbirdə Təhsil Nazirliyinin və Bakı Şəhəri &uuml;zrə Təhsil İdarəsinin əməkdaşları, təhsil ekspertləri, KİV n&uuml;mayəndələri iştirak ediblər.</p>\r\n\r\n<p><a href="http://www.community.az/" target="_blank">Community.az</a>&nbsp;portalı tərəfindən təşkil edilən &ldquo;Kitab Kvest-i&rdquo; m&uuml;sabiqəsinin məqsədi şagirdlərin, m&uuml;əllimlərin və valideynlərin ədəbiyyata olan marağını artırmaqdır. &ldquo;Mənim vətənim&ndash;Azərbaycan&rdquo; m&uuml;sabiqəsi isə iştirak&ccedil;ılara &ouml;zlərini əsl foto həvəskarı kimi g&ouml;stərməyə imkan yaradıb.</p>\r\n\r\n<p>Tədbirdə bildirilib ki, m&uuml;sabiqələrə <a href="http://www.community.az" target="_blank">community.az</a>&nbsp; portalında qeydiyyatdan ke&ccedil;ən 500-dən &ccedil;ox&nbsp; şagird, onların valideynləri və m&uuml;əllimləri qoşulub.</p>\r\n\r\n<p>&ldquo;Kitab Kvesti&rdquo; m&uuml;sabiqəsinin qalibləri Bakı şəhəri 169 n&ouml;mrəli tam orta məktəbin m&uuml;əllimi Albina Əbubəkirova, Sumqayıt şəhəri 23 n&ouml;mrəli tam orta məktəbin m&uuml;əllimi Eleonora Kairova və Bakı şəhəri 158 n&ouml;mrəli tam orta məktəbin məktəb icmasının &uuml;zv&uuml; Nailə Buxlova olub.</p>\r\n\r\n<p>&ldquo;Mənim vətənim-Azərbaycan&rdquo; m&uuml;sabiqəsinin qalibi adına isə Bakı şəhəri 46 saylı tam orta məktəbin m&uuml;əllimi G&uuml;ll&uuml; Əhmədova layiq g&ouml;r&uuml;l&uuml;b.</p>\r\n\r\n<p>Qaliblərə Fəxri Fərman və&nbsp; m&uuml;xtəlif qiymətli hədiyyələr təqdim olunub.</p>\r\n\r\n<p>M&uuml;sabiqəyə &ldquo;Access Bank&rdquo; ASC, &ldquo;Sağlam Ailə&rdquo; MMC, &ldquo;Standard Insurance&rdquo; ASC və &ldquo;Allianz Consult&rdquo; şirkətləri tərəfindən dəstək verilib.</p>\r\n\r\n<p>Qeyd edək ki, m&uuml;sabiqələrin ke&ccedil;irilməsində əsas məqsəd məktəb icmalarının fəaliyyətini stimullaşdırmaq, icma &uuml;zvlərini həvəsləndirmək, m&uuml;əllim, şagird və valideynlərə icma yaratmağı təşviq etməkdən ibarətdir.</p>'),
(369, 'articles', 19, 'az', 'short', 'Məktəb icmaları üçün “Kitab Kvest-i” və “Mənim vətənim-Azərbaycan” müsabiqələrinə yekun vurulub.'),
(370, 'articles', 19, 'az', 'is_published_lang', '1'),
(371, 'articles', 19, 'ru', 'keywords', ''),
(372, 'articles', 19, 'ru', 'title', ''),
(373, 'articles', 19, 'ru', 'full', ''),
(374, 'articles', 19, 'ru', 'short', ''),
(375, 'articles', 19, 'ru', 'is_published_lang', '0'),
(376, 'articles', 19, 'zh', 'keywords', ''),
(377, 'articles', 19, 'zh', 'title', ''),
(378, 'articles', 19, 'zh', 'full', ''),
(379, 'articles', 19, 'zh', 'short', ''),
(380, 'articles', 19, 'zh', 'is_published_lang', '0'),
(381, 'galleries', 10, 'az', 'name', 'Logging test'),
(382, 'galleries', 10, 'az', 'is_published_lang', '1'),
(383, 'galleries', 10, 'ru', 'name', ''),
(384, 'galleries', 10, 'ru', 'is_published_lang', '0'),
(385, 'galleries', 10, 'zh', 'name', ''),
(386, 'galleries', 10, 'zh', 'is_published_lang', '0'),
(387, 'articles', 20, 'az', 'keywords', 'təhsil, masallı, rayon, müavini, ümumi, cəlilabad, yardımlı, qurbanov, sahəsində, nazir, rayonlarının, əsas, onları, nazirinin, firudin, görüşdə, hüseynov, işləri, tərbiyə, şöbəsinin'),
(388, 'articles', 20, 'az', 'title', 'Masallı, Cəlilabad və Yardımlı rayonlarının təhsil işçiləri ilə görüş'),
(389, 'articles', 20, 'az', 'full', '<p>Mayın 25-də Masallı Rayon Mədəniyyət Mərkəzində təhsil nazirinin m&uuml;avini Firudin Qurbanov və Təhsil Nazirliyinin məsul əməkdaşları Masallı, Cəlilabad, Yardımlı rayonlarının təhsil iş&ccedil;iləri ilə g&ouml;r&uuml;ş&uuml;b.</p>\r\n\r\n<p>Tədbirin ke&ccedil;irilməsində məqsəd respublikanın şəhər və rayonlarında &ccedil;alışan təhsil iş&ccedil;iləri ilə sıx əlaqə yaratmaq, onların təklif, rəy və təşəbb&uuml;slərindən həyata ke&ccedil;irilən islahatlar prosesində istifadə etmək, təhsil m&uuml;əssisələrində tərbiyə işinin m&ouml;vcud vəziyyəti və g&uuml;cləndirilməsinin əsas istəqamətləri barədə t&ouml;vsiyələr verməkdən ibarətdir.</p>\r\n\r\n<p>&Ouml;ncə tədbir iştirak&ccedil;ıları &uuml;mummilli lider Heydər Əliyevin abidəsi &ouml;n&uuml;nə g&uuml;l dəstələri d&uuml;zərək, xatirəsini ehtiramla yad ediblər. Sonra Mədəniyyət Mərkəzinin foyesində rayon məktəblilərinin əl işləri və idman sahəsində qazandığı uğurları əks etdirən sərgiyə baxış ke&ccedil;irilib.</p>\r\n\r\n<p>G&ouml;r&uuml;şdə Masallı, Yardımlı və Cəlilabad rayon təhsil ş&ouml;bələrinin m&uuml;dirləri və əməkdaşları, &uuml;mumi və məktəbdənkənar təhsil m&uuml;əssisələrinin direktorları, direktor m&uuml;avinləri, psixoloqlar iştirak ediblər.</p>\r\n\r\n<p>Təhsil nazirinin m&uuml;avini Firudin Qurbanov tədbir iştirak&ccedil;ılarını salamlayıb, onları qarşıdan gələn Respublika G&uuml;n&uuml; m&uuml;nasibətilə təbrik edib. Nazir m&uuml;avini son 25 il ərzində &ouml;lkə həyatının b&uuml;t&uuml;n sahələrində qazanılan uğurlardan, regionlarda, o c&uuml;mlədən Masallı rayonunda həyata ke&ccedil;irilən irimiqyaslı layihələrdən danışıb.</p>\r\n\r\n<p>Təhsil sahəsində aparılan islahatlardan bəhs edən F.Qurbanov son illərdə bir sıra vacib h&uuml;quqi-normativ sənədlərin qəbul olunduğunu diqqətə &ccedil;atdırıb. Təhsilin keyfiyyətinin yaxşılaşdırılması istiqamətində yeni proqramların və dərsliklərin hazırlanması işləri davam etdirilir, 12 illik &uuml;mumi təhsilə ke&ccedil;idlə bağlı m&uuml;zakirələr aparılır. Son 10 ildə &ouml;lkəmizdə 3 mindən &ccedil;ox yeni məktəbin tikildiyini və əsaslı təmir edildiyini s&ouml;yləyən nazir m&uuml;avini Təhsil Strategiyasına əsasən, 2020-ci ilə qədər &uuml;mumi təhsil məktəblərində təhsil alan b&uuml;t&uuml;n şagirdlərin planşetlərlə təmin olunacağını bildirib.</p>\r\n\r\n<p>F.Qurbanov &ccedil;ıxışında təhsil sistemində tədrislə yanaşı, əsas diqqətin təlim-tərbiyə məsələlərinə, m&uuml;əllim-sağird m&uuml;nasibətlərinə y&ouml;nəldiyini və bu işlərin yerinə yetirilməsində m&uuml;əllimlərin &uuml;zərinə b&ouml;y&uuml;k vəzifələr d&uuml;şd&uuml;y&uuml;n&uuml; deyib. M&uuml;asir d&ouml;vrdə &ouml;lkənin təhsil sisteminin ali məqsədi XXI əsrin tələblərinə cavab verən, milli ruhlu, vətənpərvər, bilikli, bacarıqlı, kamil vətəndaşlar yetişdirməkdir. Tərbiyənin strateji istiqamətlərindən bəhs edən nazir m&uuml;avini bu baxımdan məktəbdənkənar təhsilin &uuml;zərinə d&uuml;şən vəzifələr haqqında fikirlərini bildirib.</p>\r\n\r\n<p>Masallı Rayon İcra Hakimiyyətinin baş&ccedil;ısı Rafil H&uuml;seynov b&ouml;lgədə&nbsp;belə bir tədbirin ke&ccedil;irilməsinin&nbsp;təqdirəlayiq hal olduğunu s&ouml;yləyib. R.H&uuml;seynov uşaqların, gənclərin tərbiyəsinə, vətənpərvərlik hisslərinin aşılanmasına x&uuml;susi diqqət yetirdiyinə g&ouml;rə Təhsil Nazirliyinə &ouml;z təşəkk&uuml;r&uuml;n&uuml; bildirib və rayon təhsil iş&ccedil;ilərinə yaradılmış bu imkandan yararlanmağı t&ouml;vsiyə edib.</p>\r\n\r\n<p>G&ouml;r&uuml;şdə &ccedil;ıxış edən Masallı Rayon Təhsil Ş&ouml;bəsinin m&uuml;diri Astan İbişov, Cəlilabad Rayon Təhsil Ş&ouml;bəsinin m&uuml;diri Elminaz Nadirova, Yardımlı Rayon Təhsil Ş&ouml;bəsinin m&uuml;diri Manaf Səmədzadə, Masallı şəhərindəki &ldquo;Dəfinə&rdquo; məktəb-liseyin direktoru Taleh Əkbərov və başqaları &uuml;mumi təhsil məktəblərində tədris, təlim və tərbiyə sahəsində g&ouml;r&uuml;lm&uuml;ş işlərdən s&ouml;hbət a&ccedil;ıb, m&ouml;vcud problemlərin həlli ilə bağlı təkliflərini bildiriblər.</p>\r\n\r\n<p>Sonda təhsil iş&ccedil;ilərinin fikirləri dinlənilib və onları maraqlandıran suallar cavablandırılıb.</p>'),
(390, 'articles', 20, 'az', 'short', 'Mayın 25-də Masallı Rayon Mədəniyyət Mərkəzində təhsil nazirinin müavini Firudin Qurbanov və Təhsil Nazirliyinin məsul əməkdaşları Masallı, Cəlilabad, Yardımlı rayonlarının təhsil işçiləri ilə görüşüb.'),
(391, 'articles', 20, 'az', 'is_published_lang', '1'),
(392, 'articles', 20, 'ru', 'keywords', ''),
(393, 'articles', 20, 'ru', 'title', ''),
(394, 'articles', 20, 'ru', 'full', ''),
(395, 'articles', 20, 'ru', 'short', ''),
(396, 'articles', 20, 'ru', 'is_published_lang', '0'),
(397, 'articles', 20, 'zh', 'keywords', ''),
(398, 'articles', 20, 'zh', 'title', ''),
(399, 'articles', 20, 'zh', 'full', ''),
(400, 'articles', 20, 'zh', 'short', ''),
(401, 'articles', 20, 'zh', 'is_published_lang', '0'),
(402, 'menu', 30, 'az', 'name', 't8'),
(403, 'menu', 30, 'az', 'is_published_lang', '1'),
(404, 'menu', 30, 'ru', 'name', ''),
(405, 'menu', 30, 'ru', 'is_published_lang', '0'),
(406, 'menu', 30, 'ge', 'name', ''),
(407, 'menu', 30, 'ge', 'is_published_lang', '0'),
(408, 'menu', 29, 'ge', 'name', ''),
(409, 'menu', 29, 'ge', 'is_published_lang', '0'),
(469, 'articles', 22, 'ge', 'title', ''),
(470, 'articles', 22, 'ge', 'full', ''),
(471, 'articles', 22, 'ge', 'short', ''),
(472, 'articles', 22, 'ge', 'is_published_lang', '0'),
(466, 'articles', 22, 'ru', 'short', ''),
(467, 'articles', 22, 'ru', 'is_published_lang', '0'),
(468, 'articles', 22, 'ge', 'keywords', ''),
(461, 'articles', 22, 'az', 'short', 'Azərbaycan nümayəndə heyəti Koreyada səfərdədir'),
(462, 'articles', 22, 'az', 'is_published_lang', '1'),
(463, 'articles', 22, 'ru', 'keywords', ''),
(464, 'articles', 22, 'ru', 'title', ''),
(465, 'articles', 22, 'ru', 'full', '');
INSERT INTO `translates` (`id`, `ref_table`, `ref_id`, `lang`, `fieldname`, `text`) VALUES
(460, 'articles', 22, 'az', 'full', '<div class="news_desc_text">\r\n<div class="news-archive">\r\n<p style="text-align:justify;text-indent:35.4pt;"><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">İyunun 14-də Koreyanın paytaxtı Seul şəhərində Azərbaycan Respublikası H&ouml;kuməti və Koreya Respublikası H&ouml;kuməti arasında iqtisadi əməkdaşlıq &uuml;zrə Birgə Komissiyanın ilk iclası ke&ccedil;irilib.</span></span></p>\r\n\r\n<p style="text-align:justify;text-indent:35.4pt;"><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">İclasda &ouml;lkəmiz Azərbaycan Respublikası Prezidentinin sərəncamı ilə m&uuml;əyyən edilmiş, Azərbaycan Respublikasının rabitə və y&uuml;ksək texnologiyalar nazirinin m&uuml;avini İltimas Məmmədovun rəhbərlik etdiyi n&uuml;mayəndə heyəti ilə təmsil olunub.</span></span></p>\r\n\r\n<p style="text-align:justify;text-indent:35.4pt;"><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">Təhsil nazirinin m&uuml;avini Firudin Qurbanov sessiyanın iclasında &ccedil;ıxış edərək, &ouml;lkələrimiz və xalqlarımız arasındakı &uuml;mumi oxşarlığın əlaqələrimizin inkişafında m&uuml;h&uuml;m rol oynadığını bildirib. F.Qurbanov qeyd edib ki, digər istiqamətlərlə yanaşı, təhsil sahəsində də əlaqələrimiz inkişaf yolundadır: &ldquo;Azərbaycan və Koreya dilləri &ouml;lkələrimizin n&uuml;fuzlu universitetlərində qarşılıqlı şəkildə tədris olunur, iki d&ouml;vlətin təhsil m&uuml;əssisələri arasında əməkdaşlıq genişlənir. &ldquo;Azərbaycan Respublikası Təhsil Nazirliyi və Koreya Respublikası Təhsil və İnsan Resurslarının İnkişafı Nazirliyi arasında təhsil sahəsində əməkdaşlığa dair Anlaşma Memorandumu&rdquo; &ouml;lkələrimizin qarşılıqlı təhsil əlaqələrinin h&uuml;quqi bazasını təşkil edir&rdquo;.</span></span></p>\r\n\r\n<p style="text-align:justify;text-indent:35.4pt;"><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">İclasdan sonra nazir m&uuml;avini Koreyada fəaliyyət g&ouml;stərən &ldquo;Posco Daewoo Corporation&rdquo;un meneceri Lee Jong Moo ilə g&ouml;r&uuml;ş&uuml;b. G&ouml;r&uuml;ş zamanı L.J.Moo bildirib ki, Bakıda peşə təlim-tədris mərkəzinin yaradılması ilə maraqlanırlar.</span></span></p>\r\n\r\n<p style="text-align:justify;text-indent:35.4pt;"><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">F.Qurbanovun n&ouml;vbəti g&ouml;r&uuml;ş&uuml; Peşə Təhsili və Təlimi &uuml;zrə Koreya Tədqiqat İnstitutunun (KRIVET) n&uuml;mayəndələri ilə olub. Koreya Respublikası Təhsil və İnsan Resurslarının İnkişafı Nazirliyinin departament m&uuml;diri Kim &Ccedil;ohonqun da iştirak etdiyi g&ouml;r&uuml;şdə KRIVET-lə bağlı əməkdaşlığa dair fikir m&uuml;badiləsi aparılıb.</span></span></p>\r\n\r\n<p style="text-align:justify;text-indent:35.4pt;"><span style="font-size:12px;"><span style="font-family:arial,helvetica,sans-serif;">F.Qurbanov səfər &ccedil;ər&ccedil;ivəsində həm&ccedil;inin, Koreyada təhsil alan azərbaycanlı tələbələrlə g&ouml;r&uuml;ş&uuml;b və onları maraqlandıran sualları cavablandırıb.</span></span></p>\r\n</div>\r\n</div>\r\n\r\n<h2 class="news_desc_title">&nbsp;</h2>'),
(458, 'articles', 22, 'az', 'keywords', 'nümayəndə, heyəti, koreyada, səfərdədir'),
(459, 'articles', 22, 'az', 'title', 'Azərbaycan nümayəndə heyəti Koreyada səfərdədir'),
(437, 'articles', 14, 'az', 'keywords', ''),
(438, 'articles', 14, 'ru', 'keywords', ''),
(439, 'articles', 14, 'ge', 'keywords', ''),
(440, 'articles', 14, 'ge', 'title', ''),
(441, 'articles', 14, 'ge', 'short', ''),
(442, 'articles', 14, 'ge', 'full', ''),
(443, 'articles', 21, 'az', 'keywords', '104, fax, 886-2-28856168, tel, 886-2-28862382, ıe10, safari, chrome, firefox'),
(444, 'articles', 21, 'az', 'title', '版權所有© 財團法人中央廣播電臺 | 臺北市104中山區北安路55號 | TEL:886-2-28856168 FAX:886-2-28862382 | 建議最佳瀏覽器 IE10以上、Firefox、Chrome、Safari 隱私權聲明'),
(445, 'articles', 21, 'az', 'full', '<p>版權所有&copy; 財團法人中央廣播電臺 | 臺北市104中山區北安路55號 | TEL:886-2-28856168 FAX:886-2-28862382 | 建議最佳瀏覽器 IE10以上、Firefox、Chrome、Safari<br />\r\n<a data-func="pop_privacy" href=";">隱私權聲明</a> 版權所有&copy; 財團法人中央廣播電臺 | 臺北市104中山區北安路55號 | TEL:886-2-28856168 FAX:886-2-28862382 | 建議最佳瀏覽器 IE10以上、Firefox、Chrome、Safari<br />\r\n<a data-func="pop_privacy" href=";">隱私權聲明</a> 版權所有&copy; 財團法人中央廣播電臺 | 臺北市104中山區北安路55號 | TEL:886-2-28856168 FAX:886-2-28862382 | 建議最佳瀏覽器 IE10以上、Firefox、Chrome、Safari<br />\r\n<a data-func="pop_privacy" href=";">隱私權聲明</a></p>'),
(446, 'articles', 21, 'az', 'short', '版權所有© 財團法人中央廣播電臺 | 臺北市104中山區北安路55號 | TEL:886-2-28856168 FAX:886-2-28862382 | 建議最佳瀏覽器 IE10以上、Firefox、Chrome、Safari'),
(447, 'articles', 21, 'az', 'is_published_lang', '1'),
(448, 'articles', 21, 'ru', 'keywords', ''),
(449, 'articles', 21, 'ru', 'title', ''),
(450, 'articles', 21, 'ru', 'full', ''),
(451, 'articles', 21, 'ru', 'short', ''),
(452, 'articles', 21, 'ru', 'is_published_lang', '0'),
(453, 'articles', 21, 'ge', 'keywords', ''),
(454, 'articles', 21, 'ge', 'title', ''),
(455, 'articles', 21, 'ge', 'full', ''),
(456, 'articles', 21, 'ge', 'short', ''),
(457, 'articles', 21, 'ge', 'is_published_lang', '0'),
(473, 'articles', 23, 'az', 'keywords', 'təhsil, xaricdə, akademik, dövlət, proqramı, universitetlərin, neft, ali, almış, əsas, rektoru, gənclərinin, 2007-2015-ci, məzunların, təhsili, təmin, əlizadə, hafiz, məzunlar, akif'),
(474, 'articles', 23, 'az', 'title', 'Məzunlar akademik fəaliyyətdə'),
(475, 'articles', 23, 'az', 'full', '<p>Dekabrın 17-də <a href="http://ada.edu.az" target="_blank">&ldquo;ADA&rdquo; Universiteti</a>ndə &ldquo;<a href="http://xaricdetehsil.edu.gov.az" target="_blank">2007-2015-ci illərdə Azərbaycan gənclərinin xaricdə təhsili &uuml;zrə D&ouml;vlət Proqramı&rdquo;</a> məzunlarının akademik fəaliyyətə cəlb olunması ilə bağlı işg&uuml;zar panel ke&ccedil;irilib.&nbsp;</p>\r\n\r\n<p>Tədbirdə təhsil naziri Mikayıl Cabbarov, <a href="http://oilfund.az" target="_blank">D&ouml;vlət Neft Fondu</a>nun icra&ccedil;ı direktoru &nbsp;Şahmar M&ouml;vs&uuml;mov, <a href="http://www.science.gov.az" target="_blank">AMEA</a>-nın prezidenti Akif Əlizadə, ADA universitetinin rektoru Hafiz Paşayev, eləcə də digər ali təhsil m&uuml;əssisələrinin rəhbərləri, xaricdə təhsil almış magistr və doktorant məzunlar iştirak edib.&nbsp;</p>\r\n\r\n<p>Panelin &nbsp;əsas məqsədi xaricdə təhsil almış gənclərin universitetlərin akademik və idarəetmə fəaliyyətində iştirakının təmin olunmasıdır.&nbsp;</p>\r\n\r\n<p>Təhsil naziri Mikayıl Cabbarov giriş s&ouml;z&uuml;ndə qeyd edib ki, &ldquo;2007-2015-ci illərdə Azərbaycan gənclərinin xaricdə təhsili &uuml;zrə D&ouml;vlət Proqramı&rdquo;nın əsas fəlsəfəsi &nbsp;&ouml;lkəmizin &nbsp;rəqabətəqabil &nbsp;kadrlara tələbatı ilə bağlı olub. Bu məqsədlə &ouml;tən illər ərzində 3500-dən &ccedil;ox tələbə d&ouml;vlətimizin verdiyi təqa&uuml;d imkanları ilə d&uuml;nyanın aparıcı universitetlərində təhsil almaq h&uuml;ququ qazanıb.</p>\r\n\r\n<p>AMEA-nın prezidenti Akif Əlizadə &nbsp;bildirib ki, &ldquo;Elm haqqında&rdquo; qanuna əsasən tədqiqat universitetləri fəaliyyətə başlayacaq. Bu universitetlərin uğurlu fəaliyyəti həm də gənc elm adamlarının t&ouml;hfələrindən asılı olacaq.</p>\r\n\r\n<p>ADA Universitetinin rektoru Hafiz Paşayev universitetlərin hər zaman hazırlıqlı m&uuml;əllimlərə ehtiyacı olduğunu vurğulayıb və rəhbərlik etdiyi ali təhsil m&uuml;əssisəsinin təcr&uuml;bəsindən danışıb.</p>\r\n\r\n<p>D&ouml;vlət Neft Fondunun icra&ccedil;ı direktoru &nbsp;Şahmar M&ouml;vs&uuml;mov qeyd edib ki, əsas ideyası &ldquo;neft kapitalından insan kapitalına&quot; olan &quot;2007-2015-ci illərdə Azərbaycan gənclərinin xaricdə təhsili &uuml;zrə D&ouml;vlət Proqramı&quot; artıq &ouml;z&uuml;n&uuml; doğruldub. Bu g&uuml;n həmin resurs universitetlərimizin auditoriyalarında məzunların akademik fəaliyyəti ilə əlavə dəyər yaratmalıdır.</p>\r\n\r\n<p><a href="http://sabah.edu.az" target="_blank">SABAH qrupları</a>nın təqdimatında universitetlərdə məzunların akademik fəaliyyəti &uuml;&ccedil;&uuml;n yaradılan imkanlardan bəhs edilib.&nbsp;</p>\r\n\r\n<p>Sonra məzunlar a&ccedil;ıq fikir m&uuml;badiləsinə qoşularaq akademik sahədə daha fəal iştirakı təmin edəcək n&uuml;anslar barədə rəy və şərhlərini s&ouml;yləyiblər.&nbsp;</p>\r\n\r\n<p>Paneldən sonra xaricdə təhsil almış məzunlarla ali təhsil m&uuml;əssisələrinin rəhbər şəxsləri arasında işg&uuml;zar &nbsp;g&ouml;r&uuml;şlər təşkil olunub.&nbsp;</p>'),
(476, 'articles', 23, 'az', 'short', 'Dekabrın 17-də “ADA” Universitetində “2007-2015-ci illərdə Azərbaycan gənclərinin xaricdə təhsili üzrə Dövlət Proqramı” məzunlarının akademik fəaliyyətə cəlb olunması ilə bağlı işgüzar panel keçirilib. '),
(477, 'articles', 23, 'az', 'is_published_lang', '1'),
(478, 'articles', 23, 'ru', 'keywords', ''),
(479, 'articles', 23, 'ru', 'title', ''),
(480, 'articles', 23, 'ru', 'full', ''),
(481, 'articles', 23, 'ru', 'short', ''),
(482, 'articles', 23, 'ru', 'is_published_lang', '0'),
(483, 'articles', 24, 'az', 'keywords', 'tərtibatı, sarayında, keçirilib, şənlik, qar, mədəniyyət, yeni, adlı, qızın, nağılı, təhsil, təlim, dekabrın, mərdəkan, keçirilir, tələbələrin, yanvarın, bakı, ixtisasında, alan'),
(484, 'articles', 24, 'az', 'title', '“Qar qızın nağılı” adlı yeni il şənliyi keçirilir'),
(485, 'articles', 24, 'az', 'full', '<p>Dekabrın 29-da Mərdəkan Mədəniyyət Sarayında &ldquo;Qar qızın nağılı&rdquo; adlı yeni il şənliyi ke&ccedil;irilib.</p>\r\n\r\n<p>Şənlik 5 n&ouml;mrəli Bakı Peşə Məktəbinin tədbir və mərasimlərin təşkilat&ccedil;ısı ixtisasında təhsil alan tələbələrin təşkilat&ccedil;ılığı ilə ke&ccedil;irilib.</p>\r\n\r\n<p>Şənlik 2017-ci il yanvarın 3-dək qeyd olunan mədəniyyət sarayında davam edəcək. Tamaşanın səhnə tərtibatı, dekorasiya işi, personajların kostyumları, qrim, səsyazma, bilet tərtibatı, &ccedil;apı və s. məktəbin təlim emalatxanalarında istehsalat təlimi ustalarının rəhbərliyi ilə şagirdlər tərəfindən hazırlanıb.</p>'),
(486, 'articles', 24, 'az', 'short', 'Dekabrın 29-da Mərdəkan Mədəniyyət Sarayında “Qar qızın nağılı” adlı yeni il şənliyi keçirilib.'),
(487, 'articles', 24, 'az', 'is_published_lang', '1'),
(488, 'articles', 24, 'ru', 'keywords', ''),
(489, 'articles', 24, 'ru', 'title', ''),
(490, 'articles', 24, 'ru', 'full', ''),
(491, 'articles', 24, 'ru', 'short', ''),
(492, 'articles', 24, 'ru', 'is_published_lang', '0'),
(493, 'articles', 25, 'az', 'keywords', 'təhsil, daha, kompüter, tələbə, stenford, şəxsi, məktəbində, ilk, uğur, iki, sərbəstlik, beynəlxalq, elmləri, olub, məktəbdə, xaricdə, idarə, formulu, nəyisə, əsas'),
(494, 'articles', 25, 'az', 'title', 'Stenfordda təhsil alan tələbəmiz: “Karyeramın izi ilə istənilən yerə gedəcəyəm” – “Uğur formulu”'),
(495, 'articles', 25, 'az', 'full', '<p><a href="http://edu.gov.az" target="_blank">Təhsil Nazirliyi</a> və <a href="http://1news.az" target="_blank">1news.az</a> İnformasiya Agentliyinin &ldquo;Uğur formulu&rdquo; layihəsi davam edir.</p>\r\n\r\n<p>&ldquo;Uğur formulu&rdquo; layihəsinin budəfəki qonağı Sona Allahverdiyevadır.</p>\r\n\r\n<p>Sona 1997-ci ildə Bakıda anadan olub. İlk &uuml;&ccedil; il D&uuml;nya Xəzər Məktəbində, daha sonra iki il Bakı Oksford Məktəbində, 7 il isə Azərbaycan Beynəlxalq Məktəbində təhsil alıb. Burada Beynəlxalq bakalavr diplomu əldə edib. Sona hazırda d&uuml;nyanın n&uuml;fuzlu Stenford Universitetində komp&uuml;ter elmləri və sahibkarlıq &uuml;zrə təhsilini davam etdirir.</p>\r\n\r\n<p><strong>- Xaricdə&nbsp; təhsil sizə nə verir? &Uuml;midlərinizi doğruldurmu?</strong></p>\r\n\r\n<p>- Əlbəttə. Stenford Universiteti məni oxuduğum b&uuml;t&uuml;n fənlər &uuml;zrə g&uuml;cl&uuml; nəzəriyyə, həm&ccedil;inin b&uuml;t&uuml;n sahələrdə praktiki biliklə təmin edir. Tədrisin &ccedil;ox hissəsi auditoriyada baş tutsa da, mən bir &ccedil;ox məlumatları yaşıdlarımdan &ouml;yrənirəm. &Ouml;z şirkətlərini yaradıb-yaratmamaları, səhm bazarında milyonlar qazanıb-qazanmamalarından və ya elmi tədqiqat sahəsinə nailiyyətlər əldə edib-etməmələrindən asılı olmayaraq Stenforddakı hər bir tələbə yoldaşımdan nə isə &ouml;yrənirəm.</p>\r\n\r\n<p><strong>- Niyə məhz bu ixtisası se&ccedil;diniz?</strong></p>\r\n\r\n<p>- Stenforddakı ilk r&uuml;b ərzində komp&uuml;ter elmlərini &ccedil;ox bəyəndim. Komp&uuml;ter elmləri məni he&ccedil; bir fənnin edə bilmədiyi qədər təşviq və cəlb edir. Məncə, komp&uuml;ter elmləri yaradıcılıq və hesablamanın vəhdətidir, kəsişmə n&ouml;qtəsində isə texnologiya vasitəsilə nəyisə heyrətamiz etmək durur. Komp&uuml;ter elmlərini oxuyarkən mənə elə gəlir ki, mən m&uuml;mk&uuml;nl&uuml;y&uuml;n sərhədini ke&ccedil;ərək qeyri-m&uuml;mk&uuml;nl&uuml;yə addım atıram.</p>\r\n\r\n<p>D&uuml;zd&uuml;r, bu &ccedil;ətin, bəzən isə qeyri-m&uuml;mk&uuml;n g&ouml;r&uuml;nə bilər, amma nəticə etibarı ilə hansısa məhsulu &ndash; tətbiqi, saytı, alqoritmi və s. g&ouml;stərib fəxrlə deyə bilərəm: &ldquo;Bunu mən etmişəm&rdquo;. Məsələn, sonuncu layihələrimdən biri komp&uuml;ter yaddaş sistemi yaratmaq idi. Bu yaxınlarda isə Silikon vadisində fəaliyyət g&ouml;stərən filantropik şirkət &uuml;&ccedil;&uuml;n mobil tətbiqin dizaynı &uuml;zərində işləyəcəyəm.</p>\r\n\r\n<p><strong>- Fərqli &ouml;lkə və təhsil m&uuml;hitini g&ouml;rd&uuml;kdən sonra əvvəl oxuduğunuz ali məktəbdə nəyin dəyişməsini arzulayardınız?</strong></p>\r\n\r\n<p>Azərbaycan Beynəlxalq Məktəbində və oxuduğum digər m&uuml;əssisələrdəki təhsildən razı qalsam da, inanıram ki, təhsil sistemini təkmilləşdirmək &uuml;&ccedil;&uuml;n qarşımızda uzun bir yol var. D&uuml;ş&uuml;n&uuml;rəm ki, bizim təhsil sistemində ən əsas iki dəyişikliyi etmək lazımdır. Birincisi, təlimə nəzəri deyil, praktiki &uuml;sulla yanaşmaq vacibdir.</p>\r\n\r\n<p>M&uuml;şahidə etmişəm ki, faktları əzbərləməkdənsə, layihələr, təcr&uuml;bə proqramları və yarım g&uuml;n işlər sayəsində daha &ccedil;ox bilik qazanıram.</p>\r\n\r\n<p>İkinci m&uuml;h&uuml;m dəyişiklik isə tələbələrdə daha g&uuml;cl&uuml; sərbəstlik hissi yaratmaqdır. İnanıram ki, sərbəstlik tələbələri işi tapşırıldığı &uuml;&ccedil;&uuml;n deyil, bu işi g&ouml;rməyə onlarda həvəs olduğu &uuml;&ccedil;&uuml;n etməyə s&ouml;vq edəcək. Sərbəstlik mənim uğur qazanmaq &uuml;&ccedil;&uuml;n şəxsi potensialımı reallaşdırmağımda əsas rol oynadı.</p>\r\n\r\n<p><strong>- Təhsil aldığınız &ouml;lkədə Azərbaycanla bağlı nələri tanıtmısınız?</strong></p>\r\n\r\n<p>- Universitetin əksər tələbələri Azərbaycanı yaxından tanısalar da, mən hər zaman həmkarlarımı və qrup yoldaşlarımı &ouml;lkəmiz haqqında daha &ccedil;ox məlumatlandırmağa &ccedil;alışıram. Bir &ccedil;ox dostum muğamın g&ouml;zəlliyinə heyrandır və mənim onlara bəhs etdiyim m&ouml;htəşəm memarlığı &ouml;z g&ouml;zləri ilə g&ouml;rmək &uuml;&ccedil;&uuml;n Bakıya səfər etməyə can atırlar.</p>\r\n\r\n<p><strong>-&nbsp; Oxuduğunuz ali məktəbdə m&uuml;əllim-tələbə m&uuml;nasibəti necədir?</strong></p>\r\n\r\n<p>- M&uuml;əllimlərim mənim məsləhət&ccedil;ilərim və dostlarımdır. M&uuml;əllimlərimdən biri ilə onun bir ne&ccedil;ə məzunla birgə idarə etdiyi &ldquo;Siyasi psixologiya araşdırma qrupu&rdquo; adlı tədqiqat laboratoriyasında &ccedil;alışmışam. M&uuml;əllimlərimlə ən bəyəndiyim qarşılıqlı m&uuml;nasibət dərsdən sonra sevdiyimiz m&ouml;vzu, istəklərimiz və &uuml;mumi maraqlarımızla bağlı m&uuml;zakirələr aparmaq &uuml;&ccedil;&uuml;n onlarla yemək yemək və ya qəhvə i&ccedil;məkdir.</p>\r\n\r\n<p><strong>- Daha &ccedil;ox hansı &ccedil;ətinlikləriniz olub?</strong></p>\r\n\r\n<p>- Burada qarşılaşdığım ən b&ouml;y&uuml;k &ccedil;ətinlik hər işi g&ouml;rməyə &ccedil;alışmağım və &ouml;z&uuml;m&uuml; məhdudlaşdıra bilməməyim idi. İlk ilimin sonunda artıq 7 klubun &uuml;zv&uuml; idim, tamaşa səhnələşdirirdim və gərəyindən daha &ccedil;ox dərs alırdım. Bu il vaxtımı daha yaxşı planlaşdırmağı və vəzifələrimin &ouml;hdəsindən gəlməyi &ouml;yrənmişəm.</p>\r\n\r\n<p><strong>- Oxuduğunuz m&uuml;ddətdə qarşılaşdığınız maraqlı hadisə hansı olub?</strong></p>\r\n\r\n<p>- Yalnız birini se&ccedil;mək &ccedil;ətin olsa da, ilk komp&uuml;ter proqramımı yaratmağım maraqlı olmuşdu. İki yuxusuz g&uuml;ndən sonra səhər saat 6-da proqram nəhayət ki, n&ouml;qsansız &ccedil;alışmışdı.</p>\r\n\r\n<p>Bu yaxınlarda isə mənim şəxsi saytım (<a href="http://www.5ona.com" target="_blank">www.5ona.com</a>) istifadəyə verildi.</p>\r\n\r\n<p><strong>- Universitetdə əcnəbi tələbələrə m&uuml;nasibətdən razısınızmı?</strong></p>\r\n\r\n<p>- Adətən məni amerikalı zənn etsələr də, əcnəbi tələbə olmağım xoş bir s&uuml;rpriz kimi qarşılanır. Mənə tez-tez doğulduğum şəhər, mədəniyyətlər arasındakı fərqlər, siyasi d&uuml;ş&uuml;ncələrim və sair, həm&ccedil;inin Azərbaycana səfər barədə suallar verirlər.</p>\r\n\r\n<p><strong>-&nbsp; Asudə vaxtınızda nə ilə məşğul olursunuz?</strong></p>\r\n\r\n<p>- Braziliya teatrı (Məzlumların Teatrı) &uuml;slubunda olan &ldquo;ACT!&rdquo; adlı &ouml;z tamaşamı səhnələşdirirəm. Həm&ccedil;inin universitetdəki b&uuml;t&uuml;n tələbə qruplarının maliyyə məsələlərini idarə edən Stenford Tələbə Təşkilatının İnkişaf &uuml;zrə direktoruyam. Eyni zamanda Stenford UNİCEF və d&uuml;nyaya sosial rifah gətirmək &uuml;&ccedil;&uuml;n texnologiyadan istifadəyə həsr olunmuş &lsquo;CS + Social Good&rsquo; tələbə birliklərinin də idarə heyətinin &uuml;zv&uuml;yəm.</p>\r\n\r\n<p><strong>- Təhsilinizi başa vurduqdan sonra harada &ccedil;alışmaq istəyərdiniz? Gələcək planlarınız necədir ?</strong></p>\r\n\r\n<p>- Mən gələcəyim haqqında coğrafi planlar qurmamağa &uuml;st&uuml;nl&uuml;k verirəm. Karyeramın və şəxsi məqsədlərimin izi ilə və ən yaxşı imkanların arxasınca istənilən yerə gedəcəyəm.</p>\r\n\r\n<p><strong>- Siz xaricdə təhsil almağa başladıqdan sonra &ouml;z&uuml;n&uuml;zdə nələri dəyişmisiniz ?</strong></p>\r\n\r\n<p>- Şəxsi və akademik potensialıma nail olmağa yaxınlaşsam da fundamental dəyərlərimi və keyfiyyətlərimi dəyişməmişəm.</p>\r\n\r\n<p><strong>- &Ouml;lkəmizdəki dostlarınıza, həmyaşıdlarınıza nə demək istərdiniz?</strong></p>\r\n\r\n<p>- B&ouml;y&uuml;k d&uuml;ş&uuml;n&uuml;n, daha b&ouml;y&uuml;y&uuml;n&uuml; xəyal edin və hər zaman xəyallarınızın arxasınca gedin. Və he&ccedil; kəsə sizə nəyisə bacarmayacağınızı deməyə icazə verməyin.</p>'),
(496, 'articles', 25, 'az', 'short', 'Təhsil Nazirliyi və 1news.az İnformasiya Agentliyinin “Uğur formulu” layihəsi davam edir.'),
(497, 'articles', 25, 'az', 'is_published_lang', '1'),
(498, 'articles', 25, 'ru', 'keywords', ''),
(499, 'articles', 25, 'ru', 'title', ''),
(500, 'articles', 25, 'ru', 'full', ''),
(501, 'articles', 25, 'ru', 'short', ''),
(502, 'articles', 25, 'ru', 'is_published_lang', '0'),
(503, 'articles', 26, 'az', 'keywords', 'təhsil, daha, kompüter, tələbə, stenford, şəxsi, məktəbində, ilk, uğur, iki, formulu, məni, işi, sona, sizə, idarə, öyrənirəm, məktəbdə, nəyisə, əsas'),
(504, 'articles', 26, 'az', 'title', 'Stenfordda təhsil alan tələbəmiz: “Karyeramın izi ilə istənilən yerə gedəcəyəm” – “Uğur formulu”'),
(505, 'articles', 26, 'az', 'full', '<p><a href="http://edu.gov.az" target="_blank">Təhsil Nazirliyi</a> və <a href="http://1news.az" target="_blank">1news.az</a> İnformasiya Agentliyinin &ldquo;Uğur formulu&rdquo; layihəsi davam edir.</p>\r\n\r\n<p>&ldquo;Uğur formulu&rdquo; layihəsinin budəfəki qonağı Sona Allahverdiyevadır.</p>\r\n\r\n<p>Sona 1997-ci ildə Bakıda anadan olub. İlk &uuml;&ccedil; il D&uuml;nya Xəzər Məktəbində, daha sonra iki il Bakı Oksford Məktəbində, 7 il isə Azərbaycan Beynəlxalq Məktəbində təhsil alıb. Burada Beynəlxalq bakalavr diplomu əldə edib. Sona hazırda d&uuml;nyanın n&uuml;fuzlu Stenford Universitetində komp&uuml;ter elmləri və sahibkarlıq &uuml;zrə təhsilini davam etdirir.</p>\r\n\r\n<p><strong>- Xaricdə&nbsp; təhsil sizə nə verir? &Uuml;midlərinizi doğruldurmu?</strong></p>\r\n\r\n<p>- Əlbəttə. Stenford Universiteti məni oxuduğum b&uuml;t&uuml;n fənlər &uuml;zrə g&uuml;cl&uuml; nəzəriyyə, həm&ccedil;inin b&uuml;t&uuml;n sahələrdə praktiki biliklə təmin edir. Tədrisin &ccedil;ox hissəsi auditoriyada baş tutsa da, mən bir &ccedil;ox məlumatları yaşıdlarımdan &ouml;yrənirəm. &Ouml;z şirkətlərini yaradıb-yaratmamaları, səhm bazarında milyonlar qazanıb-qazanmamalarından və ya elmi tədqiqat sahəsinə nailiyyətlər əldə edib-etməmələrindən asılı olmayaraq Stenforddakı hər bir tələbə yoldaşımdan nə isə &ouml;yrənirəm.</p>\r\n\r\n<p><strong>- Niyə məhz bu ixtisası se&ccedil;diniz?</strong></p>\r\n\r\n<p>- Stenforddakı ilk r&uuml;b ərzində komp&uuml;ter elmlərini &ccedil;ox bəyəndim. Komp&uuml;ter elmləri məni he&ccedil; bir fənnin edə bilmədiyi qədər təşviq və cəlb edir. Məncə, komp&uuml;ter elmləri yaradıcılıq və hesablamanın vəhdətidir, kəsişmə n&ouml;qtəsində isə texnologiya vasitəsilə nəyisə heyrətamiz etmək durur. Komp&uuml;ter elmlərini oxuyarkən mənə elə gəlir ki, mən m&uuml;mk&uuml;nl&uuml;y&uuml;n sərhədini ke&ccedil;ərək qeyri-m&uuml;mk&uuml;nl&uuml;yə addım atıram.</p>\r\n\r\n<p>D&uuml;zd&uuml;r, bu &ccedil;ətin, bəzən isə qeyri-m&uuml;mk&uuml;n g&ouml;r&uuml;nə bilər, amma nəticə etibarı ilə hansısa məhsulu &ndash; tətbiqi, saytı, alqoritmi və s. g&ouml;stərib fəxrlə deyə bilərəm: &ldquo;Bunu mən etmişəm&rdquo;. Məsələn, sonuncu layihələrimdən biri komp&uuml;ter yaddaş sistemi yaratmaq idi. Bu yaxınlarda isə Silikon vadisində fəaliyyət g&ouml;stərən filantropik şirkət &uuml;&ccedil;&uuml;n mobil tətbiqin dizaynı &uuml;zərində işləyəcəyəm.</p>\r\n\r\n<p><strong>- Fərqli &ouml;lkə və təhsil m&uuml;hitini g&ouml;rd&uuml;kdən sonra əvvəl oxuduğunuz ali məktəbdə nəyin dəyişməsini arzulayardınız?</strong></p>\r\n\r\n<p>Azərbaycan Beynəlxalq Məktəbində və oxuduğum digər m&uuml;əssisələrdəki təhsildən razı qalsam da, inanıram ki, təhsil sistemini təkmilləşdirmək &uuml;&ccedil;&uuml;n qarşımızda uzun bir yol var. D&uuml;ş&uuml;n&uuml;rəm ki, bizim təhsil sistemində ən əsas iki dəyişikliyi etmək lazımdır. Birincisi, təlimə nəzəri deyil, praktiki &uuml;sulla yanaşmaq vacibdir.</p>\r\n\r\n<p>M&uuml;şahidə etmişəm ki, faktları əzbərləməkdənsə, layihələr, təcr&uuml;bə proqramları və yarım g&uuml;n işlər sayəsində daha &ccedil;ox bilik qazanıram.</p>\r\n\r\n<p>İkinci m&uuml;h&uuml;m dəyişiklik isə tələbələrdə daha g&uuml;cl&uuml; sərbəstlik hissi yaratmaqdır. İnanıram ki, sərbəstlik tələbələri işi tapşırıldığı &uuml;&ccedil;&uuml;n deyil, bu işi g&ouml;rməyə onlarda həvəs olduğu &uuml;&ccedil;&uuml;n etməyə s&ouml;vq edəcək. Sərbəstlik mənim uğur qazanmaq &uuml;&ccedil;&uuml;n şəxsi potensialımı reallaşdırmağımda əsas rol oynadı.</p>\r\n\r\n<p><strong>- Təhsil aldığınız &ouml;lkədə Azərbaycanla bağlı nələri tanıtmısınız?</strong></p>\r\n\r\n<p>- Universitetin əksər tələbələri Azərbaycanı yaxından tanısalar da, mən hər zaman həmkarlarımı və qrup yoldaşlarımı &ouml;lkəmiz haqqında daha &ccedil;ox məlumatlandırmağa &ccedil;alışıram. Bir &ccedil;ox dostum muğamın g&ouml;zəlliyinə heyrandır və mənim onlara bəhs etdiyim m&ouml;htəşəm memarlığı &ouml;z g&ouml;zləri ilə g&ouml;rmək &uuml;&ccedil;&uuml;n Bakıya səfər etməyə can atırlar.</p>\r\n\r\n<p><strong>-&nbsp; Oxuduğunuz ali məktəbdə m&uuml;əllim-tələbə m&uuml;nasibəti necədir?</strong></p>\r\n\r\n<p>- M&uuml;əllimlərim mənim məsləhət&ccedil;ilərim və dostlarımdır. M&uuml;əllimlərimdən biri ilə onun bir ne&ccedil;ə məzunla birgə idarə etdiyi &ldquo;Siyasi psixologiya araşdırma qrupu&rdquo; adlı tədqiqat laboratoriyasında &ccedil;alışmışam. M&uuml;əllimlərimlə ən bəyəndiyim qarşılıqlı m&uuml;nasibət dərsdən sonra sevdiyimiz m&ouml;vzu, istəklərimiz və &uuml;mumi maraqlarımızla bağlı m&uuml;zakirələr aparmaq &uuml;&ccedil;&uuml;n onlarla yemək yemək və ya qəhvə i&ccedil;məkdir.</p>\r\n\r\n<p><strong>- Daha &ccedil;ox hansı &ccedil;ətinlikləriniz olub?</strong></p>\r\n\r\n<p>- Burada qarşılaşdığım ən b&ouml;y&uuml;k &ccedil;ətinlik hər işi g&ouml;rməyə &ccedil;alışmağım və &ouml;z&uuml;m&uuml; məhdudlaşdıra bilməməyim idi. İlk ilimin sonunda artıq 7 klubun &uuml;zv&uuml; idim, tamaşa səhnələşdirirdim və gərəyindən daha &ccedil;ox dərs alırdım. Bu il vaxtımı daha yaxşı planlaşdırmağı və vəzifələrimin &ouml;hdəsindən gəlməyi &ouml;yrənmişəm.</p>\r\n\r\n<p><strong>- Oxuduğunuz m&uuml;ddətdə qarşılaşdığınız maraqlı hadisə hansı olub?</strong></p>\r\n\r\n<p>- Yalnız birini se&ccedil;mək &ccedil;ətin olsa da, ilk komp&uuml;ter proqramımı yaratmağım maraqlı olmuşdu. İki yuxusuz g&uuml;ndən sonra səhər saat 6-da proqram nəhayət ki, n&ouml;qsansız &ccedil;alışmışdı.</p>\r\n\r\n<p>Bu yaxınlarda isə mənim şəxsi saytım (<a href="http://www.5ona.com" target="_blank">www.5ona.com</a>) istifadəyə verildi.</p>\r\n\r\n<p><strong>- Universitetdə əcnəbi tələbələrə m&uuml;nasibətdən razısınızmı?</strong></p>\r\n\r\n<p>- Adətən məni amerikalı zənn etsələr də, əcnəbi tələbə olmağım xoş bir s&uuml;rpriz kimi qarşılanır. Mənə tez-tez doğulduğum şəhər, mədəniyyətlər arasındakı fərqlər, siyasi d&uuml;ş&uuml;ncələrim və sair, həm&ccedil;inin Azərbaycana səfər barədə suallar verirlər.</p>\r\n\r\n<p><strong>-&nbsp; Asudə vaxtınızda nə ilə məşğul olursunuz?</strong></p>\r\n\r\n<p>- Braziliya teatrı (Məzlumların Teatrı) &uuml;slubunda olan &ldquo;ACT!&rdquo; adlı &ouml;z tamaşamı səhnələşdirirəm. Həm&ccedil;inin universitetdəki b&uuml;t&uuml;n tələbə qruplarının maliyyə məsələlərini idarə edən Stenford Tələbə Təşkilatının İnkişaf &uuml;zrə direktoruyam. Eyni zamanda Stenford UNİCEF və d&uuml;nyaya sosial rifah gətirmək &uuml;&ccedil;&uuml;n texnologiyadan istifadəyə həsr olunmuş &lsquo;CS + Social Good&rsquo; tələbə birliklərinin də idarə heyətinin &uuml;zv&uuml;yəm.</p>\r\n\r\n<p><strong>- Təhsilinizi başa vurduqdan sonra harada &ccedil;alışmaq istəyərdiniz? Gələcək planlarınız necədir ?</strong></p>\r\n\r\n<p>- Mən gələcəyim haqqında coğrafi planlar qurmamağa &uuml;st&uuml;nl&uuml;k verirəm. Karyeramın və şəxsi məqsədlərimin izi ilə və ən yaxşı imkanların arxasınca istənilən yerə gedəcəyəm.</p>\r\n\r\n<p><strong>- Siz xaricdə təhsil almağa başladıqdan sonra &ouml;z&uuml;n&uuml;zdə nələri dəyişmisiniz ?</strong></p>\r\n\r\n<p>- Şəxsi və akademik potensialıma nail olmağa yaxınlaşsam da fundamental dəyərlərimi və keyfiyyətlərimi dəyişməmişəm.</p>\r\n\r\n<p><strong>- &Ouml;lkəmizdəki dostlarınıza, həmyaşıdlarınıza nə demək istərdiniz?</strong></p>\r\n\r\n<p>- B&ouml;y&uuml;k d&uuml;ş&uuml;n&uuml;n, daha b&ouml;y&uuml;y&uuml;n&uuml; xəyal edin və hər zaman xəyallarınızın arxasınca gedin. Və he&ccedil; kəsə sizə nəyisə bacarmayacağınızı deməyə icazə verməyin.</p>'),
(506, 'articles', 26, 'az', 'short', 'Təhsil Nazirliyi və 1news.az İnformasiya Agentliyinin “Uğur formulu” layihəsi davam edir.'),
(507, 'articles', 26, 'az', 'is_published_lang', '1'),
(508, 'articles', 26, 'ru', 'keywords', ''),
(509, 'articles', 26, 'ru', 'title', ''),
(510, 'articles', 26, 'ru', 'full', ''),
(511, 'articles', 26, 'ru', 'short', ''),
(512, 'articles', 26, 'ru', 'is_published_lang', '0'),
(513, 'articles', 27, 'az', 'keywords', 'təhsil, daha, kompüter, tələbə, stenford, şəxsi, məktəbində, ilk, uğur, iki, xaricdə, işi, nəyisə, bütün, formulu, əsas, məktəbdə, beynəlxalq, idarə, heç'),
(514, 'articles', 27, 'az', 'title', 'Stenfordda təhsil alan tələbəmiz: “Karyeramın izi ilə istənilən yerə gedəcəyəm” – “Uğur formulu”'),
(515, 'articles', 27, 'az', 'full', '<p><a href="http://edu.gov.az" target="_blank">Təhsil Nazirliyi</a> və <a href="http://1news.az" target="_blank">1news.az</a> İnformasiya Agentliyinin &ldquo;Uğur formulu&rdquo; layihəsi davam edir.</p>\r\n\r\n<p>&ldquo;Uğur formulu&rdquo; layihəsinin budəfəki qonağı Sona Allahverdiyevadır.</p>\r\n\r\n<p>Sona 1997-ci ildə Bakıda anadan olub. İlk &uuml;&ccedil; il D&uuml;nya Xəzər Məktəbində, daha sonra iki il Bakı Oksford Məktəbində, 7 il isə Azərbaycan Beynəlxalq Məktəbində təhsil alıb. Burada Beynəlxalq bakalavr diplomu əldə edib. Sona hazırda d&uuml;nyanın n&uuml;fuzlu Stenford Universitetində komp&uuml;ter elmləri və sahibkarlıq &uuml;zrə təhsilini davam etdirir.</p>\r\n\r\n<p><strong>- Xaricdə&nbsp; təhsil sizə nə verir? &Uuml;midlərinizi doğruldurmu?</strong></p>\r\n\r\n<p>- Əlbəttə. Stenford Universiteti məni oxuduğum b&uuml;t&uuml;n fənlər &uuml;zrə g&uuml;cl&uuml; nəzəriyyə, həm&ccedil;inin b&uuml;t&uuml;n sahələrdə praktiki biliklə təmin edir. Tədrisin &ccedil;ox hissəsi auditoriyada baş tutsa da, mən bir &ccedil;ox məlumatları yaşıdlarımdan &ouml;yrənirəm. &Ouml;z şirkətlərini yaradıb-yaratmamaları, səhm bazarında milyonlar qazanıb-qazanmamalarından və ya elmi tədqiqat sahəsinə nailiyyətlər əldə edib-etməmələrindən asılı olmayaraq Stenforddakı hər bir tələbə yoldaşımdan nə isə &ouml;yrənirəm.</p>\r\n\r\n<p><strong>- Niyə məhz bu ixtisası se&ccedil;diniz?</strong></p>\r\n\r\n<p>- Stenforddakı ilk r&uuml;b ərzində komp&uuml;ter elmlərini &ccedil;ox bəyəndim. Komp&uuml;ter elmləri məni he&ccedil; bir fənnin edə bilmədiyi qədər təşviq və cəlb edir. Məncə, komp&uuml;ter elmləri yaradıcılıq və hesablamanın vəhdətidir, kəsişmə n&ouml;qtəsində isə texnologiya vasitəsilə nəyisə heyrətamiz etmək durur. Komp&uuml;ter elmlərini oxuyarkən mənə elə gəlir ki, mən m&uuml;mk&uuml;nl&uuml;y&uuml;n sərhədini ke&ccedil;ərək qeyri-m&uuml;mk&uuml;nl&uuml;yə addım atıram.</p>\r\n\r\n<p>D&uuml;zd&uuml;r, bu &ccedil;ətin, bəzən isə qeyri-m&uuml;mk&uuml;n g&ouml;r&uuml;nə bilər, amma nəticə etibarı ilə hansısa məhsulu &ndash; tətbiqi, saytı, alqoritmi və s. g&ouml;stərib fəxrlə deyə bilərəm: &ldquo;Bunu mən etmişəm&rdquo;. Məsələn, sonuncu layihələrimdən biri komp&uuml;ter yaddaş sistemi yaratmaq idi. Bu yaxınlarda isə Silikon vadisində fəaliyyət g&ouml;stərən filantropik şirkət &uuml;&ccedil;&uuml;n mobil tətbiqin dizaynı &uuml;zərində işləyəcəyəm.</p>\r\n\r\n<p><strong>- Fərqli &ouml;lkə və təhsil m&uuml;hitini g&ouml;rd&uuml;kdən sonra əvvəl oxuduğunuz ali məktəbdə nəyin dəyişməsini arzulayardınız?</strong></p>\r\n\r\n<p>Azərbaycan Beynəlxalq Məktəbində və oxuduğum digər m&uuml;əssisələrdəki təhsildən razı qalsam da, inanıram ki, təhsil sistemini təkmilləşdirmək &uuml;&ccedil;&uuml;n qarşımızda uzun bir yol var. D&uuml;ş&uuml;n&uuml;rəm ki, bizim təhsil sistemində ən əsas iki dəyişikliyi etmək lazımdır. Birincisi, təlimə nəzəri deyil, praktiki &uuml;sulla yanaşmaq vacibdir.</p>\r\n\r\n<p>M&uuml;şahidə etmişəm ki, faktları əzbərləməkdənsə, layihələr, təcr&uuml;bə proqramları və yarım g&uuml;n işlər sayəsində daha &ccedil;ox bilik qazanıram.</p>\r\n\r\n<p>İkinci m&uuml;h&uuml;m dəyişiklik isə tələbələrdə daha g&uuml;cl&uuml; sərbəstlik hissi yaratmaqdır. İnanıram ki, sərbəstlik tələbələri işi tapşırıldığı &uuml;&ccedil;&uuml;n deyil, bu işi g&ouml;rməyə onlarda həvəs olduğu &uuml;&ccedil;&uuml;n etməyə s&ouml;vq edəcək. Sərbəstlik mənim uğur qazanmaq &uuml;&ccedil;&uuml;n şəxsi potensialımı reallaşdırmağımda əsas rol oynadı.</p>\r\n\r\n<p><strong>- Təhsil aldığınız &ouml;lkədə Azərbaycanla bağlı nələri tanıtmısınız?</strong></p>\r\n\r\n<p>- Universitetin əksər tələbələri Azərbaycanı yaxından tanısalar da, mən hər zaman həmkarlarımı və qrup yoldaşlarımı &ouml;lkəmiz haqqında daha &ccedil;ox məlumatlandırmağa &ccedil;alışıram. Bir &ccedil;ox dostum muğamın g&ouml;zəlliyinə heyrandır və mənim onlara bəhs etdiyim m&ouml;htəşəm memarlığı &ouml;z g&ouml;zləri ilə g&ouml;rmək &uuml;&ccedil;&uuml;n Bakıya səfər etməyə can atırlar.</p>\r\n\r\n<p><strong>-&nbsp; Oxuduğunuz ali məktəbdə m&uuml;əllim-tələbə m&uuml;nasibəti necədir?</strong></p>\r\n\r\n<p>- M&uuml;əllimlərim mənim məsləhət&ccedil;ilərim və dostlarımdır. M&uuml;əllimlərimdən biri ilə onun bir ne&ccedil;ə məzunla birgə idarə etdiyi &ldquo;Siyasi psixologiya araşdırma qrupu&rdquo; adlı tədqiqat laboratoriyasında &ccedil;alışmışam. M&uuml;əllimlərimlə ən bəyəndiyim qarşılıqlı m&uuml;nasibət dərsdən sonra sevdiyimiz m&ouml;vzu, istəklərimiz və &uuml;mumi maraqlarımızla bağlı m&uuml;zakirələr aparmaq &uuml;&ccedil;&uuml;n onlarla yemək yemək və ya qəhvə i&ccedil;məkdir.</p>\r\n\r\n<p><strong>- Daha &ccedil;ox hansı &ccedil;ətinlikləriniz olub?</strong></p>\r\n\r\n<p>- Burada qarşılaşdığım ən b&ouml;y&uuml;k &ccedil;ətinlik hər işi g&ouml;rməyə &ccedil;alışmağım və &ouml;z&uuml;m&uuml; məhdudlaşdıra bilməməyim idi. İlk ilimin sonunda artıq 7 klubun &uuml;zv&uuml; idim, tamaşa səhnələşdirirdim və gərəyindən daha &ccedil;ox dərs alırdım. Bu il vaxtımı daha yaxşı planlaşdırmağı və vəzifələrimin &ouml;hdəsindən gəlməyi &ouml;yrənmişəm.</p>\r\n\r\n<p><strong>- Oxuduğunuz m&uuml;ddətdə qarşılaşdığınız maraqlı hadisə hansı olub?</strong></p>\r\n\r\n<p>- Yalnız birini se&ccedil;mək &ccedil;ətin olsa da, ilk komp&uuml;ter proqramımı yaratmağım maraqlı olmuşdu. İki yuxusuz g&uuml;ndən sonra səhər saat 6-da proqram nəhayət ki, n&ouml;qsansız &ccedil;alışmışdı.</p>\r\n\r\n<p>Bu yaxınlarda isə mənim şəxsi saytım (<a href="http://www.5ona.com" target="_blank">www.5ona.com</a>) istifadəyə verildi.</p>\r\n\r\n<p><strong>- Universitetdə əcnəbi tələbələrə m&uuml;nasibətdən razısınızmı?</strong></p>\r\n\r\n<p>- Adətən məni amerikalı zənn etsələr də, əcnəbi tələbə olmağım xoş bir s&uuml;rpriz kimi qarşılanır. Mənə tez-tez doğulduğum şəhər, mədəniyyətlər arasındakı fərqlər, siyasi d&uuml;ş&uuml;ncələrim və sair, həm&ccedil;inin Azərbaycana səfər barədə suallar verirlər.</p>\r\n\r\n<p><strong>-&nbsp; Asudə vaxtınızda nə ilə məşğul olursunuz?</strong></p>\r\n\r\n<p>- Braziliya teatrı (Məzlumların Teatrı) &uuml;slubunda olan &ldquo;ACT!&rdquo; adlı &ouml;z tamaşamı səhnələşdirirəm. Həm&ccedil;inin universitetdəki b&uuml;t&uuml;n tələbə qruplarının maliyyə məsələlərini idarə edən Stenford Tələbə Təşkilatının İnkişaf &uuml;zrə direktoruyam. Eyni zamanda Stenford UNİCEF və d&uuml;nyaya sosial rifah gətirmək &uuml;&ccedil;&uuml;n texnologiyadan istifadəyə həsr olunmuş &lsquo;CS + Social Good&rsquo; tələbə birliklərinin də idarə heyətinin &uuml;zv&uuml;yəm.</p>\r\n\r\n<p><strong>- Təhsilinizi başa vurduqdan sonra harada &ccedil;alışmaq istəyərdiniz? Gələcək planlarınız necədir ?</strong></p>\r\n\r\n<p>- Mən gələcəyim haqqında coğrafi planlar qurmamağa &uuml;st&uuml;nl&uuml;k verirəm. Karyeramın və şəxsi məqsədlərimin izi ilə və ən yaxşı imkanların arxasınca istənilən yerə gedəcəyəm.</p>\r\n\r\n<p><strong>- Siz xaricdə təhsil almağa başladıqdan sonra &ouml;z&uuml;n&uuml;zdə nələri dəyişmisiniz ?</strong></p>\r\n\r\n<p>- Şəxsi və akademik potensialıma nail olmağa yaxınlaşsam da fundamental dəyərlərimi və keyfiyyətlərimi dəyişməmişəm.</p>\r\n\r\n<p><strong>- &Ouml;lkəmizdəki dostlarınıza, həmyaşıdlarınıza nə demək istərdiniz?</strong></p>\r\n\r\n<p>- B&ouml;y&uuml;k d&uuml;ş&uuml;n&uuml;n, daha b&ouml;y&uuml;y&uuml;n&uuml; xəyal edin və hər zaman xəyallarınızın arxasınca gedin. Və he&ccedil; kəsə sizə nəyisə bacarmayacağınızı deməyə icazə verməyin.</p>'),
(516, 'articles', 27, 'az', 'short', 'Təhsil Nazirliyi və 1news.az İnformasiya Agentliyinin “Uğur formulu” layihəsi davam edir.'),
(517, 'articles', 27, 'az', 'is_published_lang', '1'),
(518, 'articles', 27, 'ru', 'keywords', ''),
(519, 'articles', 27, 'ru', 'title', ''),
(520, 'articles', 27, 'ru', 'full', ''),
(521, 'articles', 27, 'ru', 'short', ''),
(522, 'articles', 27, 'ru', 'is_published_lang', '0'),
(523, 'galleries', 12, 'az', 'name', 'adsdas'),
(524, 'galleries', 12, 'az', 'is_published_lang', '1'),
(525, 'galleries', 12, 'ru', 'name', ''),
(526, 'galleries', 12, 'ru', 'is_published_lang', '0'),
(527, 'articles', 28, 'az', 'keywords', ''),
(528, 'articles', 28, 'az', 'title', ''),
(529, 'articles', 28, 'az', 'full', ''),
(530, 'articles', 28, 'az', 'short', ''),
(531, 'articles', 28, 'az', 'is_published_lang', '1'),
(532, 'articles', 28, 'ru', 'keywords', ''),
(533, 'articles', 28, 'ru', 'title', ''),
(534, 'articles', 28, 'ru', 'full', ''),
(535, 'articles', 28, 'ru', 'short', ''),
(536, 'articles', 28, 'ru', 'is_published_lang', '0'),
(537, 'articles', 29, 'az', 'keywords', ''),
(538, 'articles', 29, 'az', 'title', ''),
(539, 'articles', 29, 'az', 'full', ''),
(540, 'articles', 29, 'az', 'short', ''),
(541, 'articles', 29, 'az', 'is_published_lang', '0'),
(542, 'articles', 29, 'ru', 'keywords', ''),
(543, 'articles', 29, 'ru', 'title', 'gsntrgf2'),
(544, 'articles', 29, 'ru', 'full', '<p>gfshjtgfnsdf2</p>'),
(545, 'articles', 29, 'ru', 'short', ''),
(546, 'articles', 29, 'ru', 'is_published_lang', '1'),
(547, 'menu', 1, 'az', 'is_published_lang', '1'),
(548, 'menu', 1, 'ru', 'is_published_lang', '0'),
(549, 'menu', 31, 'az', 'name', 'Sub-main'),
(550, 'menu', 31, 'az', 'is_published_lang', '1'),
(551, 'menu', 32, 'az', 'name', 'Sub-main'),
(552, 'menu', 32, 'az', 'is_published_lang', '1'),
(553, 'menu', 33, 'az', 'name', 'Sub-main'),
(554, 'menu', 33, 'az', 'is_published_lang', '1'),
(555, 'menu', 34, 'az', 'name', 'Sub-main'),
(556, 'menu', 34, 'az', 'is_published_lang', '1'),
(557, 'menu', 35, 'az', 'name', 'Sub-main'),
(558, 'menu', 35, 'az', 'is_published_lang', '1'),
(559, 'menu', 36, 'az', 'name', 'Sub-main'),
(560, 'menu', 36, 'az', 'is_published_lang', '1'),
(561, 'menu', 37, 'az', 'name', 'Sub-main'),
(562, 'menu', 37, 'az', 'is_published_lang', '1'),
(563, 'menu', 38, 'az', 'name', 'Sub-main'),
(564, 'menu', 38, 'az', 'is_published_lang', '1'),
(565, 'menu', 39, 'az', 'name', 'Sub-sub-main'),
(566, 'menu', 39, 'az', 'is_published_lang', '1'),
(567, 'menu', 40, 'az', 'name', 'sub-sub-sub-main'),
(568, 'menu', 40, 'az', 'is_published_lang', '1'),
(569, 'menu', 39, 'ru', 'name', 'sub-sub-main rus'),
(570, 'menu', 39, 'ru', 'is_published_lang', '0'),
(571, 'menu', 41, 'az', 'name', 'Əsas səhifə'),
(572, 'menu', 41, 'az', 'is_published_lang', '1'),
(573, 'menu', 41, 'ru', 'name', 'Главная'),
(574, 'menu', 41, 'ru', 'is_published_lang', '0'),
(575, 'menu', 42, 'az', 'name', 'Istifadə qaydaları'),
(576, 'menu', 42, 'az', 'is_published_lang', '1'),
(577, 'menu', 42, 'ru', 'name', ''),
(578, 'menu', 42, 'ru', 'is_published_lang', '0'),
(579, 'menu', 43, 'az', 'name', 'Privacy policy'),
(580, 'menu', 43, 'az', 'is_published_lang', '1'),
(581, 'menu', 43, 'ru', 'name', ''),
(582, 'menu', 43, 'ru', 'is_published_lang', '0'),
(583, 'menu', 44, 'az', 'name', 'Xəbərlər'),
(584, 'menu', 44, 'az', 'is_published_lang', '0'),
(585, 'menu', 44, 'ru', 'name', ''),
(586, 'menu', 44, 'ru', 'is_published_lang', '0'),
(587, 'menu', 45, 'az', 'name', 'Əlaqə'),
(588, 'menu', 45, 'az', 'is_published_lang', '0'),
(589, 'menu', 45, 'ru', 'name', 'Əlaqə'),
(590, 'menu', 45, 'ru', 'is_published_lang', '1'),
(591, 'menu', 46, 'az', 'name', 'IT'),
(592, 'menu', 46, 'az', 'is_published_lang', '1'),
(593, 'menu', 46, 'ru', 'name', ''),
(594, 'menu', 46, 'ru', 'is_published_lang', '0'),
(595, 'menu', 47, 'az', 'name', 'IT'),
(596, 'menu', 47, 'az', 'is_published_lang', '0'),
(597, 'menu', 47, 'ru', 'name', ''),
(598, 'menu', 47, 'ru', 'is_published_lang', '0'),
(599, 'menu', 48, 'az', 'name', 'PHP'),
(600, 'menu', 48, 'az', 'is_published_lang', '1'),
(601, 'menu', 48, 'ru', 'name', ''),
(602, 'menu', 48, 'ru', 'is_published_lang', '0'),
(603, 'menu', 49, 'az', 'name', 'Məqalələr'),
(604, 'menu', 49, 'az', 'is_published_lang', '1'),
(605, 'menu', 49, 'ru', 'name', ''),
(606, 'menu', 49, 'ru', 'is_published_lang', '0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

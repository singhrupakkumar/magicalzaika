-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 21, 2019 at 03:03 PM
-- Server version: 5.5.61-cll
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magicals_magicalfoody`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`magicals`@`localhost` FUNCTION `get_distance_in_miles_between_geo_locations` (`geo1_latitude` DECIMAL(10,6), `geo1_longitude` DECIMAL(10,6), `geo2_latitude` DECIMAL(10,6), `geo2_longitude` DECIMAL(10,6)) RETURNS DECIMAL(10,3) BEGIN
return ((ACOS(SIN(geo1_latitude * PI() / 180) * SIN(geo2_latitude * PI() / 180) + COS(geo1_latitude * PI() / 180) * COS(geo2_latitude * PI() / 180) * COS((geo1_longitude - geo2_longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515);
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0',
  `address1` text,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `image` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sessionid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` decimal(6,2) DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `plate` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'full',
  `weight_total` decimal(6,2) DEFAULT NULL,
  `subtotal` decimal(6,2) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `uid`, `image`, `sessionid`, `product_id`, `name`, `weight`, `price`, `quantity`, `plate`, `weight_total`, `subtotal`, `created`, `modified`, `cat_id`) VALUES
(3, 0, '1540547948chh.jpg', 'fpel7i47h2u81j6dh8u335cp32', 77, 'Honey Chilli Cauliflower', NULL, '90.00', 1, 'full', '0.00', '90.00', '2018-10-29 14:46:48', '2018-10-29 14:46:48', 12),
(4, 1, '1540548074achari.jpg', 'vacpht8j1bnie4aor95je8n6g7', 78, 'Chicken Achari', NULL, '300.00', 2, 'half', '0.00', '600.00', '2018-10-29 14:52:47', '2018-10-29 14:52:47', 3),
(5, 0, '1540548835ishtu.jpg', 'vacpht8j1bnie4aor95je8n6g7', 81, 'Chicken Ishtu', NULL, '325.00', 1, 'half', '0.00', '325.00', '2018-10-29 15:54:37', '2018-10-29 15:54:37', 3),
(6, 0, '1540547948chh.jpg', 'vacpht8j1bnie4aor95je8n6g7', 77, 'Honey Chilli Cauliflower', NULL, '90.00', 1, 'full', '0.00', '90.00', '2018-10-29 15:55:36', '2018-10-29 15:55:36', 12),
(7, 6, '1540534365tr.jpg', 'b4rh980cqbdd8mn9b5mmqmpdd2', 26, 'TANDOORI ROTI', NULL, '20.00', 1, 'full', '0.00', '20.00', '2018-10-30 13:57:23', '2018-10-30 13:57:23', 7),
(8, 0, '1540534497mi.jpg', 'aavtmj33k8p9tm7209vl7hun66', 27, 'Missi Roti', NULL, '30.00', 2, 'full', '0.00', '60.00', '2018-10-31 06:21:46', '2018-10-31 06:21:46', 7),
(9, 6, '1540548074achari.jpg', 'vlf17ot0mhfnrtneuqlle90o05', 78, 'Chicken Achari', NULL, '550.00', 1, 'full', '0.00', '550.00', '2018-10-31 08:01:18', '2018-10-31 08:01:18', 3),
(10, 6, '1540548130vegn.jpg', 'vlf17ot0mhfnrtneuqlle90o05', 79, 'Veg. Noodles', NULL, '70.00', 1, 'full', '0.00', '70.00', '2018-10-31 11:37:09', '2018-10-31 11:37:09', 12),
(11, 6, '1540548429green.jpg', 'd2f5884q6prvnhaqg95r4r29t4', 80, 'Green Chicken', NULL, '600.00', 4, 'full', '0.00', '2400.00', '2018-10-31 11:48:34', '2018-10-31 11:48:34', 3),
(12, 6, '1540548429green.jpg', '4gubfh8rbm1fn5l7kp2abrv226', 80, 'Green Chicken', NULL, '600.00', 4, 'full', '0.00', '2400.00', '2018-10-31 11:48:48', '2018-10-31 11:48:48', 3),
(13, 6, '1540548429green.jpg', '5a971397ih6toc7cdqgq1rlt41', 80, 'Green Chicken', NULL, '600.00', 4, 'full', '0.00', '2400.00', '2018-10-31 11:49:43', '2018-10-31 11:49:43', 3),
(14, 6, '1540548995nihari.jpg', '8rcl78rogklsth1nlvdlpi3ie5', 82, 'Chicken Nahari', NULL, '600.00', 1, 'full', '0.00', '600.00', '2018-10-31 13:21:33', '2018-10-31 13:21:33', 3),
(16, 5, '1540548429green.jpg', '0ok19m5cnmg3m13fchjf7da7c0', 80, 'Green Chicken', NULL, '600.00', 1, 'full', '0.00', '600.00', '2018-11-01 06:05:36', '2018-11-01 06:05:36', 3),
(20, 0, '1540473306ak.jpg', 'u1tal8v3hbun4a25pk9mg2atu2', 7, 'Amritsari Chicken Tikka', NULL, '325.00', 6, 'half', '0.00', '1950.00', '2018-11-11 11:34:06', '2018-11-11 11:34:06', 1),
(21, 7, '1540548130vegn.jpg', 's6ac39rvg9detv2u17ddg8abj1', 79, 'Veg. Noodles', NULL, '70.00', 1, 'full', '0.00', '70.00', '2018-11-12 05:45:18', '2018-11-12 05:45:18', 12),
(22, 1, '1540488142ff.jpg', '28jgas299jju5r3qqv16p1v153', 17, 'Fish Finger', NULL, '800.00', 1, 'full', '0.00', '800.00', '2018-11-12 10:43:02', '2018-11-12 10:43:02', 4),
(25, 0, '1540534016paneer bhurji.jpg', '9bhf0l41dt9fml3kj294h5um40', 24, 'Paneer Bhurji', NULL, '210.00', 1, 'full', '0.00', '210.00', '2018-11-19 08:36:44', '2018-11-19 08:36:44', 6),
(26, 0, '1540533202shahi paneer.gif', '9bhf0l41dt9fml3kj294h5um40', 20, 'Shahi Paneer', NULL, '130.00', 1, 'half', '0.00', '130.00', '2018-11-19 08:37:01', '2018-11-19 08:37:01', 6),
(30, 4, '1540537120fm.jpg', 'd3jud87nog4ce82a0tpiujk7g7', 38, 'Family Naan', NULL, '40.00', 1, 'full', '0.00', '40.00', '2018-11-28 10:32:04', '2018-11-28 10:32:04', 7),
(31, 0, '1540539737gjh.jpg', 'd3jud87nog4ce82a0tpiujk7g7', 51, 'Gajar ka Halwa', NULL, '60.00', 2, 'full', '0.00', '120.00', '2018-11-28 11:02:57', '2018-11-28 11:02:57', 10),
(32, 0, '1540533202shahi paneer.gif', '5hmbr6qiqcnsil95rg22i9e8c0', 20, 'Shahi Paneer', NULL, '130.00', 1, 'half', '0.00', '130.00', '2018-11-29 13:30:11', '2018-11-29 13:30:11', 6),
(33, 0, '1540547948chh.jpg', '1jri2ia3d1573880puc56vvm54', 77, 'Honey Chilli Cauliflower', NULL, '90.00', 1, 'full', '0.00', '90.00', '2018-12-12 08:40:30', '2018-12-12 08:40:30', 12),
(34, 0, '1540548130vegn.jpg', '78et765itp8mqo6rrt4gag4hj2', 79, 'Veg. Noodles', NULL, '70.00', 1, 'full', '0.00', '70.00', '2018-12-28 12:52:55', '2018-12-28 12:52:55', 12),
(35, 0, '1540548130vegn.jpg', '0s856jnjdp53a4gtpkm2bm9b47', 79, 'Veg. Noodles', NULL, '70.00', 1, 'full', '0.00', '70.00', '2019-01-03 13:38:11', '2019-01-03 13:38:11', 12);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `slug`, `image`, `status`, `created`) VALUES
(1, 'Non Veg Snacks', '', 'non-veg-snacks', '1540466346non1.jpg', 1, '2018-10-25 11:19:06'),
(2, 'Fried Chicken', '', 'fried-chicken', '1540466413ckfry.jpeg', 1, '2018-10-25 11:20:13'),
(3, 'Gravy', '', 'gravy', '1540466480gra.jpg', 1, '2018-10-25 11:21:20'),
(4, 'Fish Fry', '', 'fish-fry', '1540466556fish.jpg', 1, '2018-10-25 11:22:36'),
(5, 'Fish Gravy', '', 'fish-gravy', '1540466656fish-curry_1.jpeg', 1, '2018-10-25 11:24:16'),
(6, 'Veg Sabji', '', 'veg-sabji', '1540466718veg.jpg', 1, '2018-10-25 11:25:18'),
(7, 'Roti', '', 'roti', '1540466830ro.jpg', 1, '2018-10-25 11:27:10'),
(9, 'Raita', '', 'raita', '1540467086rr.jpg', 1, '2018-10-25 11:31:26'),
(10, 'Desert', '', 'desert', '1540467145des.jpg', 1, '2018-10-25 11:32:25'),
(11, 'Beverages', '', 'beverages', '1540467234bev.jpg', 1, '2018-10-25 11:33:54'),
(12, 'Veg Snacks', '', 'veg-snacks', '1540467336sac.jpg', 1, '2018-10-25 11:35:36'),
(13, 'Naan', '', 'naan', '1540467411nn.jpg', 1, '2018-10-25 11:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `iso_code_2` varchar(2) NOT NULL,
  `iso_code_3` varchar(3) NOT NULL,
  `address_format` text NOT NULL,
  `postcode_required` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `name`, `iso_code_2`, `iso_code_3`, `address_format`, `postcode_required`, `status`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', '', 0, 1),
(2, 'Albania', 'AL', 'ALB', '', 0, 1),
(3, 'Algeria', 'DZ', 'DZA', '', 0, 1),
(4, 'American Samoa', 'AS', 'ASM', '', 0, 1),
(5, 'Andorra', 'AD', 'AND', '', 0, 1),
(6, 'Angola', 'AO', 'AGO', '', 0, 1),
(7, 'Anguilla', 'AI', 'AIA', '', 0, 1),
(8, 'Antarctica', 'AQ', 'ATA', '', 0, 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', '', 0, 1),
(10, 'Argentina', 'AR', 'ARG', '', 0, 1),
(11, 'Armenia', 'AM', 'ARM', '', 0, 1),
(12, 'Aruba', 'AW', 'ABW', '', 0, 1),
(13, 'Australia', 'AU', 'AUS', '', 0, 1),
(14, 'Austria', 'AT', 'AUT', '', 0, 1),
(15, 'Azerbaijan', 'AZ', 'AZE', '', 0, 1),
(16, 'Bahamas', 'BS', 'BHS', '', 0, 1),
(17, 'Bahrain', 'BH', 'BHR', '', 0, 1),
(18, 'Bangladesh', 'BD', 'BGD', '', 0, 1),
(19, 'Barbados', 'BB', 'BRB', '', 0, 1),
(20, 'Belarus', 'BY', 'BLR', '', 0, 1),
(21, 'Belgium', 'BE', 'BEL', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 0, 1),
(22, 'Belize', 'BZ', 'BLZ', '', 0, 1),
(23, 'Benin', 'BJ', 'BEN', '', 0, 1),
(24, 'Bermuda', 'BM', 'BMU', '', 0, 1),
(25, 'Bhutan', 'BT', 'BTN', '', 0, 1),
(26, 'Bolivia', 'BO', 'BOL', '', 0, 1),
(27, 'Bosnia and Herzegovina', 'BA', 'BIH', '', 0, 1),
(28, 'Botswana', 'BW', 'BWA', '', 0, 1),
(29, 'Bouvet Island', 'BV', 'BVT', '', 0, 1),
(30, 'Brazil', 'BR', 'BRA', '', 0, 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', '', 0, 1),
(32, 'Brunei Darussalam', 'BN', 'BRN', '', 0, 1),
(33, 'Bulgaria', 'BG', 'BGR', '', 0, 1),
(34, 'Burkina Faso', 'BF', 'BFA', '', 0, 1),
(35, 'Burundi', 'BI', 'BDI', '', 0, 1),
(36, 'Cambodia', 'KH', 'KHM', '', 0, 1),
(37, 'Cameroon', 'CM', 'CMR', '', 0, 1),
(38, 'Canada', 'CA', 'CAN', '', 0, 1),
(39, 'Cape Verde', 'CV', 'CPV', '', 0, 1),
(40, 'Cayman Islands', 'KY', 'CYM', '', 0, 1),
(41, 'Central African Republic', 'CF', 'CAF', '', 0, 1),
(42, 'Chad', 'TD', 'TCD', '', 0, 1),
(43, 'Chile', 'CL', 'CHL', '', 0, 1),
(44, 'China', 'CN', 'CHN', '', 0, 1),
(45, 'Christmas Island', 'CX', 'CXR', '', 0, 1),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', '', 0, 1),
(47, 'Colombia', 'CO', 'COL', '', 0, 1),
(48, 'Comoros', 'KM', 'COM', '', 0, 1),
(49, 'Congo', 'CG', 'COG', '', 0, 1),
(50, 'Cook Islands', 'CK', 'COK', '', 0, 1),
(51, 'Costa Rica', 'CR', 'CRI', '', 0, 1),
(52, 'Cote D\'Ivoire', 'CI', 'CIV', '', 0, 1),
(53, 'Croatia', 'HR', 'HRV', '', 0, 1),
(54, 'Cuba', 'CU', 'CUB', '', 0, 1),
(55, 'Cyprus', 'CY', 'CYP', '', 0, 1),
(56, 'Czech Republic', 'CZ', 'CZE', '', 0, 1),
(57, 'Denmark', 'DK', 'DNK', '', 0, 1),
(58, 'Djibouti', 'DJ', 'DJI', '', 0, 1),
(59, 'Dominica', 'DM', 'DMA', '', 0, 1),
(60, 'Dominican Republic', 'DO', 'DOM', '', 0, 1),
(61, 'East Timor', 'TL', 'TLS', '', 0, 1),
(62, 'Ecuador', 'EC', 'ECU', '', 0, 1),
(63, 'Egypt', 'EG', 'EGY', '', 0, 1),
(64, 'El Salvador', 'SV', 'SLV', '', 0, 1),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', '', 0, 1),
(66, 'Eritrea', 'ER', 'ERI', '', 0, 1),
(67, 'Estonia', 'EE', 'EST', '', 0, 1),
(68, 'Ethiopia', 'ET', 'ETH', '', 0, 1),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', '', 0, 1),
(70, 'Faroe Islands', 'FO', 'FRO', '', 0, 1),
(71, 'Fiji', 'FJ', 'FJI', '', 0, 1),
(72, 'Finland', 'FI', 'FIN', '', 0, 1),
(74, 'France, Metropolitan', 'FR', 'FRA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(75, 'French Guiana', 'GF', 'GUF', '', 0, 1),
(76, 'French Polynesia', 'PF', 'PYF', '', 0, 1),
(77, 'French Southern Territories', 'TF', 'ATF', '', 0, 1),
(78, 'Gabon', 'GA', 'GAB', '', 0, 1),
(79, 'Gambia', 'GM', 'GMB', '', 0, 1),
(80, 'Georgia', 'GE', 'GEO', '', 0, 1),
(81, 'Germany', 'DE', 'DEU', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(82, 'Ghana', 'GH', 'GHA', '', 0, 1),
(83, 'Gibraltar', 'GI', 'GIB', '', 0, 1),
(84, 'Greece', 'GR', 'GRC', '', 0, 1),
(85, 'Greenland', 'GL', 'GRL', '', 0, 1),
(86, 'Grenada', 'GD', 'GRD', '', 0, 1),
(87, 'Guadeloupe', 'GP', 'GLP', '', 0, 1),
(88, 'Guam', 'GU', 'GUM', '', 0, 1),
(89, 'Guatemala', 'GT', 'GTM', '', 0, 1),
(90, 'Guinea', 'GN', 'GIN', '', 0, 1),
(91, 'Guinea-Bissau', 'GW', 'GNB', '', 0, 1),
(92, 'Guyana', 'GY', 'GUY', '', 0, 1),
(93, 'Haiti', 'HT', 'HTI', '', 0, 1),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', '', 0, 1),
(95, 'Honduras', 'HN', 'HND', '', 0, 1),
(96, 'Hong Kong', 'HK', 'HKG', '', 0, 1),
(97, 'Hungary', 'HU', 'HUN', '', 0, 1),
(98, 'Iceland', 'IS', 'ISL', '', 0, 1),
(99, 'India', 'IN', 'IND', '', 0, 1),
(100, 'Indonesia', 'ID', 'IDN', '', 0, 1),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', '', 0, 1),
(102, 'Iraq', 'IQ', 'IRQ', '', 0, 1),
(103, 'Ireland', 'IE', 'IRL', '', 0, 1),
(104, 'Israel', 'IL', 'ISR', '', 0, 1),
(105, 'Italy', 'IT', 'ITA', '', 0, 1),
(106, 'Jamaica', 'JM', 'JAM', '', 0, 1),
(107, 'Japan', 'JP', 'JPN', '', 0, 1),
(108, 'Jordan', 'JO', 'JOR', '', 0, 1),
(109, 'Kazakhstan', 'KZ', 'KAZ', '', 0, 1),
(110, 'Kenya', 'KE', 'KEN', '', 0, 1),
(111, 'Kiribati', 'KI', 'KIR', '', 0, 1),
(112, 'North Korea', 'KP', 'PRK', '', 0, 1),
(113, 'South Korea', 'KR', 'KOR', '', 0, 1),
(114, 'Kuwait', 'KW', 'KWT', '', 0, 1),
(115, 'Kyrgyzstan', 'KG', 'KGZ', '', 0, 1),
(116, 'Lao People\'s Democratic Republic', 'LA', 'LAO', '', 0, 1),
(117, 'Latvia', 'LV', 'LVA', '', 0, 1),
(118, 'Lebanon', 'LB', 'LBN', '', 0, 1),
(119, 'Lesotho', 'LS', 'LSO', '', 0, 1),
(120, 'Liberia', 'LR', 'LBR', '', 0, 1),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', '', 0, 1),
(122, 'Liechtenstein', 'LI', 'LIE', '', 0, 1),
(123, 'Lithuania', 'LT', 'LTU', '', 0, 1),
(124, 'Luxembourg', 'LU', 'LUX', '', 0, 1),
(125, 'Macau', 'MO', 'MAC', '', 0, 1),
(126, 'FYROM', 'MK', 'MKD', '', 0, 1),
(127, 'Madagascar', 'MG', 'MDG', '', 0, 1),
(128, 'Malawi', 'MW', 'MWI', '', 0, 1),
(129, 'Malaysia', 'MY', 'MYS', '', 0, 1),
(130, 'Maldives', 'MV', 'MDV', '', 0, 1),
(131, 'Mali', 'ML', 'MLI', '', 0, 1),
(132, 'Malta', 'MT', 'MLT', '', 0, 1),
(133, 'Marshall Islands', 'MH', 'MHL', '', 0, 1),
(134, 'Martinique', 'MQ', 'MTQ', '', 0, 1),
(135, 'Mauritania', 'MR', 'MRT', '', 0, 1),
(136, 'Mauritius', 'MU', 'MUS', '', 0, 1),
(137, 'Mayotte', 'YT', 'MYT', '', 0, 1),
(138, 'Mexico', 'MX', 'MEX', '', 0, 1),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', '', 0, 1),
(140, 'Moldova, Republic of', 'MD', 'MDA', '', 0, 1),
(141, 'Monaco', 'MC', 'MCO', '', 0, 1),
(142, 'Mongolia', 'MN', 'MNG', '', 0, 1),
(143, 'Montserrat', 'MS', 'MSR', '', 0, 1),
(144, 'Morocco', 'MA', 'MAR', '', 0, 1),
(145, 'Mozambique', 'MZ', 'MOZ', '', 0, 1),
(146, 'Myanmar', 'MM', 'MMR', '', 0, 1),
(147, 'Namibia', 'NA', 'NAM', '', 0, 1),
(148, 'Nauru', 'NR', 'NRU', '', 0, 1),
(149, 'Nepal', 'NP', 'NPL', '', 0, 1),
(150, 'Netherlands', 'NL', 'NLD', '', 0, 1),
(151, 'Netherlands Antilles', 'AN', 'ANT', '', 0, 1),
(152, 'New Caledonia', 'NC', 'NCL', '', 0, 1),
(153, 'New Zealand', 'NZ', 'NZL', '', 0, 1),
(154, 'Nicaragua', 'NI', 'NIC', '', 0, 1),
(155, 'Niger', 'NE', 'NER', '', 0, 1),
(156, 'Nigeria', 'NG', 'NGA', '', 0, 1),
(157, 'Niue', 'NU', 'NIU', '', 0, 1),
(158, 'Norfolk Island', 'NF', 'NFK', '', 0, 1),
(159, 'Northern Mariana Islands', 'MP', 'MNP', '', 0, 1),
(160, 'Norway', 'NO', 'NOR', '', 0, 1),
(161, 'Oman', 'OM', 'OMN', '', 0, 1),
(162, 'Pakistan', 'PK', 'PAK', '', 0, 1),
(163, 'Palau', 'PW', 'PLW', '', 0, 1),
(164, 'Panama', 'PA', 'PAN', '', 0, 1),
(165, 'Papua New Guinea', 'PG', 'PNG', '', 0, 1),
(166, 'Paraguay', 'PY', 'PRY', '', 0, 1),
(167, 'Peru', 'PE', 'PER', '', 0, 1),
(168, 'Philippines', 'PH', 'PHL', '', 0, 1),
(169, 'Pitcairn', 'PN', 'PCN', '', 0, 1),
(170, 'Poland', 'PL', 'POL', '', 0, 1),
(171, 'Portugal', 'PT', 'PRT', '', 0, 1),
(172, 'Puerto Rico', 'PR', 'PRI', '', 0, 1),
(173, 'Qatar', 'QA', 'QAT', '', 0, 1),
(174, 'Reunion', 'RE', 'REU', '', 0, 1),
(175, 'Romania', 'RO', 'ROM', '', 0, 1),
(176, 'Russian Federation', 'RU', 'RUS', '', 0, 1),
(177, 'Rwanda', 'RW', 'RWA', '', 0, 1),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', '', 0, 1),
(179, 'Saint Lucia', 'LC', 'LCA', '', 0, 1),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', '', 0, 1),
(181, 'Samoa', 'WS', 'WSM', '', 0, 1),
(182, 'San Marino', 'SM', 'SMR', '', 0, 1),
(183, 'Sao Tome and Principe', 'ST', 'STP', '', 0, 1),
(184, 'Saudi Arabia', 'SA', 'SAU', '', 0, 1),
(185, 'Senegal', 'SN', 'SEN', '', 0, 1),
(186, 'Seychelles', 'SC', 'SYC', '', 0, 1),
(187, 'Sierra Leone', 'SL', 'SLE', '', 0, 1),
(188, 'Singapore', 'SG', 'SGP', '', 0, 1),
(189, 'Slovak Republic', 'SK', 'SVK', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city} {postcode}\r\n{zone}\r\n{country}', 0, 1),
(190, 'Slovenia', 'SI', 'SVN', '', 0, 1),
(191, 'Solomon Islands', 'SB', 'SLB', '', 0, 1),
(192, 'Somalia', 'SO', 'SOM', '', 0, 1),
(193, 'South Africa', 'ZA', 'ZAF', '', 0, 1),
(194, 'South Georgia &amp; South Sandwich Islands', 'GS', 'SGS', '', 0, 1),
(195, 'Spain', 'ES', 'ESP', '', 0, 1),
(196, 'Sri Lanka', 'LK', 'LKA', '', 0, 1),
(197, 'St. Helena', 'SH', 'SHN', '', 0, 1),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', '', 0, 1),
(199, 'Sudan', 'SD', 'SDN', '', 0, 1),
(200, 'Suriname', 'SR', 'SUR', '', 0, 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', '', 0, 1),
(202, 'Swaziland', 'SZ', 'SWZ', '', 0, 1),
(203, 'Sweden', 'SE', 'SWE', '{company}\r\n{firstname} {lastname}\r\n{address_1}\r\n{address_2}\r\n{postcode} {city}\r\n{country}', 1, 1),
(204, 'Switzerland', 'CH', 'CHE', '', 0, 1),
(205, 'Syrian Arab Republic', 'SY', 'SYR', '', 0, 1),
(206, 'Taiwan', 'TW', 'TWN', '', 0, 1),
(207, 'Tajikistan', 'TJ', 'TJK', '', 0, 1),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', '', 0, 1),
(209, 'Thailand', 'TH', 'THA', '', 0, 1),
(210, 'Togo', 'TG', 'TGO', '', 0, 1),
(211, 'Tokelau', 'TK', 'TKL', '', 0, 1),
(212, 'Tonga', 'TO', 'TON', '', 0, 1),
(213, 'Trinidad and Tobago', 'TT', 'TTO', '', 0, 1),
(214, 'Tunisia', 'TN', 'TUN', '', 0, 1),
(215, 'Turkey', 'TR', 'TUR', '', 0, 1),
(216, 'Turkmenistan', 'TM', 'TKM', '', 0, 1),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', '', 0, 1),
(218, 'Tuvalu', 'TV', 'TUV', '', 0, 1),
(219, 'Uganda', 'UG', 'UGA', '', 0, 1),
(220, 'Ukraine', 'UA', 'UKR', '', 0, 1),
(221, 'United Arab Emirates', 'AE', 'ARE', '', 0, 1),
(222, 'United Kingdom', 'GB', 'GBR', '', 1, 1),
(223, 'United States', 'US', 'USA', '{firstname} {lastname}\r\n{company}\r\n{address_1}\r\n{address_2}\r\n{city}, {zone} {postcode}\r\n{country}', 0, 1),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', '', 0, 1),
(225, 'Uruguay', 'UY', 'URY', '', 0, 1),
(226, 'Uzbekistan', 'UZ', 'UZB', '', 0, 1),
(227, 'Vanuatu', 'VU', 'VUT', '', 0, 1),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', '', 0, 1),
(229, 'Venezuela', 'VE', 'VEN', '', 0, 1),
(230, 'Viet Nam', 'VN', 'VNM', '', 0, 1),
(231, 'Virgin Islands (British)', 'VG', 'VGB', '', 0, 1),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', '', 0, 1),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', '', 0, 1),
(234, 'Western Sahara', 'EH', 'ESH', '', 0, 1),
(235, 'Yemen', 'YE', 'YEM', '', 0, 1),
(237, 'Democratic Republic of Congo', 'CD', 'COD', '', 0, 1),
(238, 'Zambia', 'ZM', 'ZMB', '', 0, 1),
(239, 'Zimbabwe', 'ZW', 'ZWE', '', 0, 1),
(242, 'Montenegro', 'ME', 'MNE', '', 0, 1),
(243, 'Serbia', 'RS', 'SRB', '', 0, 1),
(244, 'Aaland Islands', 'AX', 'ALA', '', 0, 1),
(245, 'Bonaire, Sint Eustatius and Saba', 'BQ', 'BES', '', 0, 1),
(246, 'Curacao', 'CW', 'CUW', '', 0, 1),
(247, 'Palestinian Territory, Occupied', 'PS', 'PSE', '', 0, 1),
(248, 'South Sudan', 'SS', 'SSD', '', 0, 1),
(249, 'St. Barthelemy', 'BL', 'BLM', '', 0, 1),
(250, 'St. Martin (French part)', 'MF', 'MAF', '', 0, 1),
(251, 'Canary Islands', 'IC', 'ICA', '', 0, 1),
(252, 'Ascension Island (British)', 'AC', 'ASC', '', 0, 1),
(253, 'Kosovo, Republic of', 'XK', 'UNK', '', 0, 1),
(254, 'Isle of Man', 'IM', 'IMN', '', 0, 1),
(255, 'Tristan da Cunha', 'TA', 'SHN', '', 0, 1),
(256, 'Guernsey', 'GG', 'GGY', '', 0, 1),
(257, 'Jersey', 'JE', 'JEY', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` bigint(20) DEFAULT NULL,
  `weight` decimal(8,2) UNSIGNED DEFAULT '0.00',
  `order_item_count` int(11) DEFAULT NULL,
  `paid_by_admin` int(11) NOT NULL DEFAULT '0' COMMENT '0 not paid , 1 paid',
  `commission_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `subtotal` decimal(8,2) DEFAULT NULL,
  `total` decimal(8,2) UNSIGNED DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  `payment_status` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'gateway name',
  `transaction_id` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'paypal/payfort transaction id',
  `payment_gateway_price` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'price to be paid through payment gateway',
  `payment_method` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_status` int(11) NOT NULL DEFAULT '1' COMMENT 'pending1 ,2 processing ,3 complete ,4 cancel, 5 user cancel',
  `delivered_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `uid`, `name`, `email`, `phone`, `address`, `country`, `city`, `state`, `zip`, `weight`, `order_item_count`, `paid_by_admin`, `commission_amount`, `subtotal`, `total`, `created`, `modified`, `payment_status`, `transaction_id`, `payment_gateway_price`, `payment_method`, `order_status`, `delivered_date`) VALUES
(1, 6, 'AdminTest', 'iamadmin@gmail.com', '4646546', NULL, 'United States', NULL, NULL, NULL, '0.00', 1, 0, '0.00', '550.00', '550.00', '2018-11-01 05:24:39', '2018-11-01 05:24:39', NULL, NULL, NULL, 'Cash on delivery', 2, NULL),
(2, 6, 'AdminTest', 'iamadmin@gmail.com', '4646546', NULL, 'United States', NULL, NULL, NULL, '0.00', 1, 0, '0.00', '840.00', '840.00', '2018-11-10 13:33:19', '2018-11-10 13:33:19', NULL, NULL, NULL, 'Cash on delivery', 2, NULL),
(3, 1, 'AdminTest', 'iamadmin@gmail.com', '4646546', NULL, 'United States', NULL, NULL, NULL, '0.00', 1, 0, '0.00', '800.00', '800.00', '2018-11-12 10:43:24', '2018-11-12 10:43:24', NULL, NULL, NULL, 'paypal', 1, NULL),
(4, 8, 'AdminTest', 'iamadmin@gmail.com', '4646546', NULL, 'United States', NULL, NULL, NULL, '0.00', 1, 0, '0.00', '50.00', '50.00', '2018-11-12 11:29:04', '2018-11-12 11:29:04', NULL, NULL, NULL, 'Cash on delivery', 2, NULL),
(5, 9, 'AdminTest', 'iamadmin@gmail.com', '4646546', NULL, 'United States', NULL, NULL, NULL, '0.00', 1, 0, '0.00', '20.00', '20.00', '2018-11-13 07:44:29', '2018-11-13 07:44:29', NULL, NULL, NULL, 'Cash on delivery', 2, NULL),
(6, 6, 'Rupak Kumar Singh', 'rupak.bca111@gmail.com', '8865867270', 'Plot No. 10,  Netsmartz House , Rajiv Gandhi IT Park Chandigarh, 160101', 'United States', 'Chandigarh', 'Chandigarh', 160101, '0.00', 1, 0, '0.00', '600.00', '600.00', '2018-11-21 18:52:32', '2018-11-21 18:52:32', NULL, NULL, NULL, 'Cash on delivery', 2, NULL),
(7, 6, 'Rupak Kumar Singh', 'rupak.bca111@gmail.com', '8865867270', 'Plot No. 10,  Netsmartz House , Rajiv Gandhi IT Park Chandigarh, 160101', 'United States', 'Chandigarh', 'Chandigarh', 160101, '0.00', 1, 0, '0.00', '600.00', '600.00', '2018-11-21 18:53:40', '2018-11-21 18:53:40', NULL, NULL, NULL, 'Cash on delivery', 2, NULL),
(8, 6, 'Rupak Kumar Singh', 'rupak.bca111@gmail.com', '8865867270', 'Plot No. 10,  Netsmartz House , Rajiv Gandhi IT Park Chandigarh, 160101', 'United States', 'Chandigarh', 'Chandigarh', 160101, '0.00', 1, 0, '0.00', '70.00', '70.00', '2018-11-22 18:51:34', '2018-11-22 18:51:34', NULL, NULL, NULL, 'Cash on delivery', 2, NULL),
(9, 6, 'Rupak Kumar Singh', 'rupak.bca111@gmail.com', '8865867270', 'Plot No. 10,  Netsmartz House , Rajiv Gandhi IT Park Chandigarh, 160101', 'United States', 'Chandigarh', 'Chandigarh', 160101, '0.00', 1, 0, '0.00', '600.00', '600.00', '2018-11-25 07:48:02', '2018-11-25 07:48:02', NULL, NULL, NULL, 'Cash on delivery', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED DEFAULT NULL,
  `product_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `weight` decimal(8,2) UNSIGNED DEFAULT '0.00',
  `price` decimal(8,2) UNSIGNED DEFAULT NULL,
  `subtotal` decimal(8,2) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `image`, `quantity`, `weight`, `price`, `subtotal`, `created`, `modified`) VALUES
(1, 1, 78, 'Chicken Achari', '1540548074achari.jpg', 1, '0.00', '550.00', '550.00', '2018-11-01 05:24:39', '2018-11-01 05:24:39'),
(2, 2, 20, 'Shahi Paneer', '1540533202shahi paneer.gif', 4, '0.00', '210.00', '840.00', '2018-11-10 13:33:19', '2018-11-10 13:33:19'),
(3, 3, 17, 'Fish Finger', '1540488142ff.jpg', 1, '0.00', '800.00', '800.00', '2018-11-12 10:43:24', '2018-11-12 10:43:24'),
(4, 4, 49, 'Ice Cream', '1540539516ice.jpg', 1, '0.00', '50.00', '50.00', '2018-11-12 11:29:04', '2018-11-12 11:29:04'),
(5, 5, 31, 'Butter Roti', '1540534889tr.jpg', 1, '0.00', '20.00', '20.00', '2018-11-13 07:44:29', '2018-11-13 07:44:29'),
(6, 6, 80, 'Green Chicken', '1540548429green.jpg', 1, '0.00', '600.00', '600.00', '2018-11-21 18:52:35', '2018-11-21 18:52:35'),
(7, 7, 80, 'Green Chicken', '1540548429green.jpg', 1, '0.00', '600.00', '600.00', '2018-11-21 18:53:41', '2018-11-21 18:53:41'),
(8, 8, 79, 'Veg. Noodles', '1540548130vegn.jpg', 1, '0.00', '70.00', '70.00', '2018-11-22 18:51:34', '2018-11-22 18:51:34'),
(9, 9, 80, 'Green Chicken', '1540548429green.jpg', 1, '0.00', '600.00', '600.00', '2018-11-25 07:48:02', '2018-11-25 07:48:02');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `rest_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `slug` varchar(1000) DEFAULT NULL,
  `name` varchar(1000) DEFAULT NULL,
  `description` text,
  `price` decimal(8,2) DEFAULT '0.00',
  `price_two` decimal(8,2) DEFAULT '1.00',
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `subcat_id` int(11) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `avg_rating` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `rest_id`, `user_id`, `slug`, `name`, `description`, `price`, `price_two`, `cat_id`, `subcat_id`, `image`, `quantity`, `avg_rating`, `status`, `created`) VALUES
(1, 1, NULL, 'tandoori-chicken', 'Tandoori Chicken', '<p>Luscious chicken pieces marinated in yogurt and selected Indian spices and grilled in Indian clay pot.</p>', '700.00', '375.00', 1, NULL, '1540468751tan.jpg', 1, 2, 1, '2018-10-25 11:59:11'),
(2, 1, NULL, 'chicken-afghani', 'Chicken Afghani', '<p>Afghani chicken is a dry dish of chicken marinated in a lime juice, cashew nut paste and heavy cream marinade and glazed and grilled to perfection.</p>', '600.00', '325.00', 1, NULL, '1540468904afgani.jpg', 1, 0, 1, '2018-10-25 12:01:44'),
(3, 1, NULL, 'zafrani-chicken', 'Zafrani Chicken', '<p><strong>Zafrani Chicken</strong> is a rich chicken curry adorned with the flavours of saffron and almonds, goes beautifully well with lightly flavoured rice, or Naan or simply chapatis. Even though this curry is&nbsp;rich because of the saffron and almonds, its not a heavy curry, as its mildly spiced and relies more on the subtle flavors of whole spices like bay leave and cloves.</p>', '650.00', '350.00', 1, NULL, '1540470857ckg.jpg', 1, 0, 1, '2018-10-25 12:34:17'),
(4, 1, NULL, 'chicken-malai-tikka', 'Chicken Malai Tikka', '<p><span style=\"font-size: 16px;\">Chicken Tikka originated in the Punjab region and the Malai Tikka is a variant that uses Cashew paste &amp; Cream to impart totally different flavours to this variant of a Tikka. Works in any scenario, ideal with drinks.</span></p>', '700.00', '375.00', 1, NULL, '1540471999cm.jpg', 1, 0, 1, '2018-10-25 12:53:19'),
(5, 1, NULL, 'chicken-tangri-kebab', 'Chicken Tangri Kebab', '<p>Tangri Kebab is a Kebab made using the legs of chicken. Tangri(pronounced as Tangdi) simply means the leg or drumstick. I made these kebabs not in a tandoor or an oven but in the air-fryer. Air fryer helps cook/fry foods to the desired level with minimal oil. Alternately, the kebabs can be shallow fried in a pan.</p>', '700.00', '375.00', 1, NULL, '1540472151tk.jpg', 1, 0, 1, '2018-10-25 12:55:51'),
(6, 1, NULL, 'chicken-afghani-kabab', 'Chicken Afghani Kabab ', '<p>From the jujeh kebab and falafels in the Middle East to the smoky char-grilled and tandoori specials along and beyond the Hindu Kush countries, there is a massive list of kebabs that have and continue to take our breath away! One such brilliant chicken kebab is Afghani Chicken.</p>', '700.00', '375.00', 1, NULL, '1540472322skb.jpg', 1, 0, 1, '2018-10-25 12:58:42'),
(7, 1, NULL, 'amritsari-chicken-tikka', 'Amritsari Chicken Tikka', '<p>Amritsari Chicken Tikka happens to be the favourite of the most of the people living in North India.</p>', '600.00', '325.00', 1, NULL, '1540473306ak.jpg', 1, 0, 1, '2018-10-25 13:15:06'),
(8, 1, NULL, 'chicken-kali-mirch-tikka', 'Chicken Kali Mirch Tikka', '<p>Food is very much part of the culture in Indian communities and kebab/ tikkas are also eaten with drinks to begin a meal (or even as a snack).</p>', '600.00', '325.00', 1, NULL, '1540473812kl.jpg', 1, 0, 1, '2018-10-25 13:23:32'),
(9, 1, NULL, 'chicken-tikka', 'Chicken Tikka', '<p>Though I love just about every Indian dish on the menu at my local curry shop I often come back to Chicken Tikka Masala.</p>', '180.00', '0.00', 1, NULL, '1540474242tka.jpg', 1, 0, 1, '2018-10-25 13:30:42'),
(10, 1, NULL, 'chicken-seekh-kebab', 'Chicken Seekh Kebab', '<p>A popular Indian appetizer recipe. Chicken Seekh Kebab is made with chicken mince, onion, ginger-garlic paste, coriander, green chillies and spices. It is super simple to make and is a great option for serving to your guests</p>', '60.00', '0.00', 1, NULL, '1540474359kaz.jpg', 1, 0, 1, '2018-10-25 13:32:39'),
(11, 1, NULL, 'chicken-shawarma', 'Chicken Shawarma ', '<p>This Chicken Shawarma recipe is going to knock your socks off! Just a handful of every day spices makes an incredible Chicken Shawarma marinade that&nbsp;infuses the chicken with exotic Middle Eastern flavours. The smell when this is cooking is insane!</p>', '180.00', '0.00', 1, NULL, '1540474615mn.jpg', 1, 0, 1, '2018-10-25 13:34:58'),
(12, 1, NULL, 'chicken-lolli-pop', 'Chicken Lolli Pop', '<p>A delicious chicken lollipop recipe. Crispy Chicken Lollipop is made with chicken drumsticks, cornflour, refined flour, ginger-garlic paste and chilli paste. It is fried to perfection until crispy and best served with sweet chilli&nbsp;sauce.</p>', '600.00', '325.00', 2, NULL, '1540474798lolipop.jpg', 1, 0, 1, '2018-10-25 13:39:58'),
(13, 1, NULL, 'chicken-tangri-fry', 'Chicken Tangri Fry', '<p>Chicken drum sticks marinated in spiced yogurt and cooked over hot charcoal embers with choice of chilli, garlic, ginger and pepper.</p>', '700.00', '375.00', 2, NULL, '1540475027tkl.jpg', 1, 0, 1, '2018-10-25 13:43:47'),
(14, 1, NULL, 'chicken-fry', 'Chicken  Fry', '<p>Easy Simple Chicken Fry is a delicious dish which is liked by people of all age groups. Easy Simple Chicken delicious for a party or special occasion then Easy Simple Chicken Fry is a good option for you. The flavour of Easy Simple Chicken Fry is tempting and you will enjoy each bite of this. Try this Easy Simple Chicken Fry on weekends and impress your family and friends.</p>', '750.00', '400.00', 2, NULL, '1540475353fry.jpg', 1, 0, 1, '2018-10-25 13:49:13'),
(15, 1, NULL, 'fish-fry', 'Fish Fry', '<p>Fish fry tastes best with tomato pepper rasam or with any chicken biryani or lamb biryani or egg biryani. If you are planning for a party complete Indian meal, there should be a fish fry. I would always suggest you to use freshly blended ginger garlic paste.</p>', '650.00', '350.00', 4, NULL, '1540475594fa.jpg', 0, 0, 1, '2018-10-25 13:53:14'),
(16, 1, NULL, 'fish-tandoori', ' Fish Tandoori', '<p>Tandoori Fish is an interesting snack recipe to prepare for your family and friends on occasions like kitty party, pot lucks and get-togethers. This snack recipe is made with a thick marination of Indian spices and yoghurt and tastes super-delicious. This tandoori recipe is best served with green chutney or sauce. Try it!</p>', '350.00', '350.00', 4, NULL, '1540475808fish-tandori.jpg', 1, 0, 1, '2018-10-25 13:56:48'),
(17, 1, NULL, 'fish-finger', 'Fish Finger', '<p><em>Fish fingers</em>&nbsp;have been a family favorite for years so we make sure our&nbsp;<em>fish fingers</em>&nbsp;are the highest quality, with 100% fish fillets.</p>', '800.00', '380.00', 4, NULL, '1540488142ff.jpg', 1, 0, 1, '2018-10-25 17:22:22'),
(18, 1, NULL, 'fish-tikka', 'Fish Tikka', '<p>Fish Tikka is an Indian recipe made using fish fillets, spices, and yogurt. This snack recipe is perfect for any occasion. Try this delicious yet easy appetizer recipe at your home.</p>', '710.00', '380.00', 4, NULL, '1540488391fisht.jpg', 1, 0, 1, '2018-10-25 17:26:31'),
(19, 1, NULL, 'palak-paneer', 'Palak Paneer', '<p>Palak Paneer is also one of the most loved dishes in the Indian community. It is a thick spinach gravy made with onion, tomatoes, and pureed spinach which is boiled for about 10-15 mins. Boiling it helps to get soft and easily blend in into a smooth puree in which cottage cheese cubes are added and cooked till gets soft and aromatic.</p>', '190.00', '120.00', 6, NULL, '1540532923pl.jpg', 1, 0, 1, '2018-10-26 05:48:43'),
(20, 1, NULL, 'shahi-paneer', 'Shahi Paneer', '<p>Shahi Paneer is a scrumptious and easy-to-make North Indian recipe as it uses readily available ingredients in the kitchen like paneer, curd, meat masala and ginger-garlic paste. If you are done with garam masala loaded paneer dishes like Paneer Butter Masala, Kadhai Paneer and Shahi Paneer, this paneer recipe is a welcome variation as it uses meat masala. It is a kids favourite curry recipe and an ideal dish which can be served on anniversaries and kitty parties. One important tip that you should keep in mind while making this recipe is that you need to marinate the paneer pieces well so that the flavours are properly absorbed. Serve this easy paneer recipe with rice, naan or paratha. It also pairs well with garlic naan, missi roti and biryani. A must try paneer recipe for parties and special occasions. You can also garnish this paneer recipe with onions rings for that extra crunch!</p>', '210.00', '130.00', 6, NULL, '1540533202shahi paneer.gif', 0, 0, 1, '2018-10-26 05:53:22'),
(21, 1, NULL, 'khamiri-roti', ' Khamiri Roti', '<p>Khamiri roti is made by using yeast (khamir) and therefore is very soft to eat and thick in size. Khamiri roti is Mughlai roti which taste best with the moghlai food, curries like dal makhni and non-vegetarian food dish. Khamiri roti is a flatbread made from wheat flour. Let&rsquo;s make this khamiri roti at home.</p>', '25.00', '0.00', 7, NULL, '1540533219km.jpg', 1, 0, 1, '2018-10-26 05:53:39'),
(22, 1, NULL, 'butter-masala-paneer', 'Butter Masala Paneer', '<p>Paneer Butter Masala is a traditional Punjabi recipe in which soft pieces of Paneer are cooked in rich creamy butter &amp; tomato gravy. Paneer Butter Masala goes by various names like Butter Paneer, Paneer Makhani etc. the dish is characterised by rich and aromatic gravy made by using tomato puree, onion paste, cashew paste, and some essential Indian spices.</p>\r\n<p>Paneer is a type of fresh cheese common in Indian subcontinent, and Paneer butter masala is one of the most popular Paneer recipes in Indian cuisine. Paneer Butter Masala is one of the most ordered dishes in Indian restaurants and has gained popularity in non Indian people as well who occasionally like to try Indian food</p>', '180.00', '115.00', 6, NULL, '1540533518masala.jpg', 1, 6, 1, '2018-10-26 05:58:38'),
(23, 1, NULL, 'kadhai-paneer', 'kadhai Paneer', '<p>The <em>paneer</em> is cooked with onions, bell peppers, tomatoes and ginger garlic. The main flavors of this dish come from the dry roasted ground spices. I have tried making this dish with pre ground spices and it just does not taste the same. When you freshly roast and grind the spices they add an amazing lemony, warm and spicy flavor to the dish.</p>', '120.00', '130.00', 6, NULL, '1540533783kadhai.jpg', 1, 0, 1, '2018-10-26 06:03:03'),
(24, 1, NULL, 'paneer-bhurji', 'Paneer Bhurji', '<p><span style=\"font-weight: 400;\">Paneer Bhurji is delightful and spicy paneer dish. This is also a good stuffing for</span> Dosas, Vegetables Frankie<span style=\"font-weight: 400;\"> or </span>Kathi Rolls<span style=\"font-weight: 400;\">.There are also other type of bhurji like Egg Bhurji, Matter Paneer Bhurji,Mushroom Bhurji or Mooli ki Bhurji. But Paneer Bhurji and Egg Bhurji are quite popular</span></p>', '210.00', '130.00', 6, NULL, '1540534016paneer bhurji.jpg', 1, 0, 1, '2018-10-26 06:06:56'),
(25, 1, NULL, 'chilli-paneer', 'Chilli Paneer', '<p>Chilli Paneer is a popular mouth melting Indo Chinese snack.Indians loves this fusion.This dish originally served as chilli chicken, but the vegetarians modify the recipe and substitute chicken with paneer.Chilli Paneer with gravy can served with any chinese main course dish like shezwan rice or fried rice, or when you make it dry then can be served as snack or starters.</p>', '190.00', '120.00', 6, NULL, '1540534315chilli paneer.jpg', 1, 0, 1, '2018-10-26 06:11:55'),
(26, 1, NULL, 'tandoori-roti', 'TANDOORI ROTI', '<p>Tandoori roti&rsquo;s or nans to enjoy the gravys, as we think that making them at home is not possible without the huge fancy clay tandoors which the restaurants and dhabawalas have. But it is not so, the same authentic Tandoori Rotis can be made without any clay tandoor in our home kitchen easily with the use of our humble tava or iron griddle.</p>', '20.00', '0.00', 7, NULL, '1540534365tr.jpg', 1, 0, 1, '2018-10-26 06:12:45'),
(27, 1, NULL, 'missi-roti', 'Missi Roti', '<p>Missi Roti is one of the most popular North Indian bread, which is a perfect mix of flavours mixed with gram flour and cooked to perfection. Though, Missi Roti comes from Rajasthan and has a unique flavour that always comes from gram/chick pea flour, this variation can easily be prepared at home if gram flour is not available. This Indian bread recipe can be paired with any curry of your choice. Missi Roti is non-messy and this makes it a perfect thing to pack for lunch and road trips. So, next time whenever you crave for something delicious and satiating, then try this dish and relish it with your family and friends.</p>', '30.00', '0.00', 7, NULL, '1540534497mi.jpg', 1, 0, 1, '2018-10-26 06:14:57'),
(28, 1, NULL, 'mix-veg', 'Mix Veg', '<p><span style=\"font-size: 22px;\">M</span>ix veg recipe is a North Indian Recipe. This recipe is loaded with fresh and healthy vegetables with a spicy taste. The mix veg sabji goes very well with parantha and rice too.</p>', '140.00', '95.00', 6, NULL, '1540534525mix veg.jpg', 1, 0, 1, '2018-10-26 06:15:25'),
(29, 1, NULL, 'dal-makhni', 'Dal Makhni', '<p>Everybody loves a basic tadka Dal as part of an Indian meal. A bowl of warm dal, rice topped with ghee is comfort food and even makes a perfect accompaniment to any meal. But when we think of slow cooked creamy Dal Makhani it&rsquo;s in a league of its own.</p>', '140.00', '95.00', 6, NULL, '1540534702daal.jpg', 1, 0, 1, '2018-10-26 06:18:22'),
(30, 1, NULL, 'plain-roti', 'Plain Roti', '<p><strong>Bread prepared from whole wheat flour &ndash; A main food for the Indians.</strong></p>', '10.00', '0.00', 7, NULL, '1540534743pln.jpg', 1, 0, 1, '2018-10-26 06:19:03'),
(31, 1, NULL, 'butter-roti', 'Butter Roti', '<p>Whole wheat flour bread baked in tandoor clay oven Topped With Fresh Butter</p>', '20.00', '0.00', 7, NULL, '1540534889tr.jpg', 0, 0, 1, '2018-10-26 06:21:29'),
(32, 1, NULL, 'dal-fry-yellow-', 'Dal Fry (Yellow)', '<p>Dal Fry is a popular Indian dal or lentil recipe. Dal fry is usually prepared with Toor dal also known as arhar, tur, toovar, yellow lentils or split pigeon pea. This traditional Indian dish is often served over rice</p>', '110.00', '80.00', 6, NULL, '1540535056yellow.jpg', 1, 0, 1, '2018-10-26 06:24:16'),
(33, 1, NULL, 'stuffed-roti', 'Stuffed Roti ', '<p><span id=\"ctl00_cntrightpanel_lblDesc\"> The Stuffed Roti is wonderful way of preparing healthy cauliflower. Whole wheat flour and a liberal amount of cauliflower make this a nutritious dish, which is crispier than normal parathas due to the addition of rice flour. </span></p>', '30.00', '0.00', 7, NULL, '1540535150stf.jpg', 1, 0, 1, '2018-10-26 06:25:50'),
(34, 1, NULL, 'kadhai-mushroom', 'Kadhai Mushroom', '<p><span id=\"ctl00_cntrightpanel_lblDesc\">Kadai subzis feature koftas or veggies drowned in a rich and spicy gravy. In this case, we have used a combination of mushrooms, onions and capsicums, which are saut&eacute;ed and then cooked with the tongue-tickling gravy to make a really flavour-packed Kadai Mushroom Subzi.</span></p>', '180.00', '115.00', 6, NULL, '1540535704mushroom.jpg', 1, 0, 1, '2018-10-26 06:35:04'),
(35, 1, NULL, 'malai-kofta', 'Malai Kofta', '<p>Malai Kofta is a rich creamy and delicious recipe which is often served as a side dish for naan, chapathi, roti and also goes excellent with rice. It is loaded with loads of flavors and taste which makes us to crave for more. Koftas are Indian fried balls which can be either made with meat chicke kofta curry or with vegetables - most commonly made with potatoes.</p>', '180.00', '115.00', 1, NULL, '1540536228malai kofta.JPG', 1, 0, 1, '2018-10-26 06:43:48'),
(36, 1, NULL, 'paneer-lababdar', 'Paneer Lababdar', '<p>Paneer Lababdar Recipe is a delicious creamy paneer dish. The paneer is cooked in a tomato based gravy, with mild spices and kasuri methi. The kasuri methi adds a very distinctive flavour to the dish.</p>', '195.00', '125.00', 6, NULL, '1540536677lababdar.jpg', 1, 0, 1, '2018-10-26 06:51:17'),
(37, 1, NULL, 'mushroom-do-pyaza', 'Mushroom-Do-Pyaza', '<p>&lsquo;Do Pyaza&rsquo; is a type of creamy South-Asian gravy that is less water and more spice. The somewhat dry masala gravy is named so because of the cooking technique, which requires adding onion to the gravy twice &ndash; both at different stages &ndash; while cooking the dish. The curry is popular in parts of India, Pakistan, and even some regions in Bangladesh. And the best part is that just about any vegetable and/or meat can blend in perfectly with the do pyaza gravy and taste delicious. One such blend is the mushroom do pyaza.</p>', '180.00', '115.00', 1, NULL, '1540537006pyaza.jpg', 1, 0, 1, '2018-10-26 06:56:46'),
(38, 1, NULL, 'family-naan', 'Family Naan', '<p>We definitely have the biggest naan breads in Magicalzaika, and the most reasonable prices. I&rsquo;ve never seen a bigger one</p>', '40.00', '0.00', 7, NULL, '1540537120fm.jpg', 1, 0, 1, '2018-10-26 06:58:40'),
(39, 1, NULL, 'butter-naan', 'Butter naan', '<p>Butter naan is always made with maida or all purpose flour especially in restaurants. Though I prefer to make whole wheat naan regularly, I do make this restaurant style butter naan for guests. Obviously these naans turn out more soft and light when made with all purpose flour as opposite to whole wheat naan.</p>', '30.00', '0.00', 13, NULL, '1540537817btn.jpg', 1, 0, 1, '2018-10-26 07:10:17'),
(40, 1, NULL, 'matar-mushroom', 'Matar Mushroom', '<p>The gravy or sauce in which the green peas and sauteed mushrooms are simmered holds the key to a great tasting dish. I have used cashew nuts and fresh cream which gives matar mushroom curry a smooth silky textured gravy and a rich flavor.</p>', '170.00', '110.00', 6, NULL, '1540537898matar.jpg', 1, 0, 1, '2018-10-26 07:11:38'),
(41, 1, NULL, 'laccha-paratha', 'Laccha Paratha', '<p><span style=\"font-family: \'Arial\',\'sans-serif\';\">Laccha paratha is an unique paratha which can be made of both wheat flour and all-purpose flour. It is layered flat bread which is crispy and flaky. The layers are visible from outside. Lachha Paratha looks more like &lsquo;pin wheel cookie&rsquo;. Once you start eating this paratha it will melt in your mouth and you will feel that the layers are coming off one by another.</span></p>', '40.00', '0.00', 13, NULL, '1540537985lk.jpg', 1, 0, 1, '2018-10-26 07:13:05'),
(42, 1, NULL, 'plain-naan', 'Plain Naan', '<p>Fine flour bread.Fresh white dough hand-rolled thin and baked fresh.</p>', '25.00', '0.00', 13, NULL, '1540538132tr.jpg', 1, 0, 1, '2018-10-26 07:15:32'),
(43, 1, NULL, 'boondi-raita', 'Boondi Raita', '<p><strong><span class=\"blast mmt-sentence\">Boondi Raita</span></strong>&nbsp;<span class=\"blast mmt-sentence\">is a healthy and delicious accompaniment made with yogurt and small fried balls made of chickpea flour and it goes very well with Indian meals.</span></p>', '30.00', '0.00', 9, NULL, '1540538301bn.jpg', 1, 0, 1, '2018-10-26 07:18:21'),
(44, 1, NULL, 'pineapple-raita', 'Pineapple Raita', '<p>Pineapple Raita is an easy to make raita which is really good for your health. This continental raita can be made with pineapple, curd, ginger, powdered sugar, coriander leaves, green chili, cumin powder. The raita needs can be served with your main course meals like rice and chapati. Serve this delicious raita during pot luck, game night, buffet, kitty party, picnic and win accolades.</p>', '40.00', '0.00', 9, NULL, '1540538414pin.jpg', 1, 0, 1, '2018-10-26 07:20:14'),
(45, 1, NULL, 'masala-chaap', 'Masala Chaap', '<p>Soya Chaap Masala, primarily a Northern Indian dish is enriched with proteins and is appealing and tempting to eat. This delight is a pure vegetarian dish but is considered equivalent to non-vegetarian dishes. Soya Chaap Masala is made with soya chaap, onion, tomato, ginger-garlic paste and spices. It is a tangy and flavourful dish which tastes best with rice or roomali roti.</p>', '190.00', '120.00', 6, NULL, '1540538686chaap.jpg', 1, 0, 1, '2018-10-26 07:24:46'),
(46, 1, NULL, 'mushroom-chilli', 'Mushroom Chilli', '<p><span id=\"3126921739964891185\">Chilli Mushroom makes a good starter for mushroom biryani, pulao and all rice varieties and even for all Indian bread varieties like naan, chappathi...</span></p>', '190.00', '120.00', 6, NULL, '1540539019chilli.jpg', 1, 0, 1, '2018-10-26 07:30:19'),
(47, 1, NULL, 'gulab-jamun', 'Gulab Jamun', '<p>Gulab Jamun is one of the most loved sweet dishes. Usually Gulab jamun &nbsp;are prepared with mawa</p>', '18.00', '0.00', 10, NULL, '1540539307gj.jpg', 1, 0, 1, '2018-10-26 07:35:07'),
(48, 1, NULL, 'chicken-korma', 'Chicken Korma', '<p>Chicken Korma is a traditional Indian dish that&rsquo;s light and flavorful almond curry made with tomato paste, plenty of spices and cream thats buttery and completely delicious.</p>', '550.00', '300.00', 3, NULL, '1540539428korma.gif', 1, 0, 1, '2018-10-26 07:37:08'),
(49, 1, NULL, 'ice-cream', 'Ice Cream', '<p>This ice cream features the strong, true flavor of vanilla. Serve it in an ice cream sandwich, or use it to make any of your favorite summer desserts &agrave; la mode.</p>', '50.00', '0.00', 10, NULL, '1540539516ice.jpg', 0, 0, 1, '2018-10-26 07:38:36'),
(50, 1, NULL, 'butter-chicken', 'Butter Chicken', '<div class=\"rgtcontentscroll mCustomScrollbar _mCS_1\">\r\n<div id=\"mCSB_1\" class=\"mCustomScrollBox mCS-dark-3\" style=\"position: relative; height: 100%; overflow: hidden; max-width: 100%;\">\r\n<div class=\"mCSB_container\" style=\"position: relative; top: 0;\">\r\n<p>Butter Chicken is one of the most popular Indian chicken dishes. Typically served with roti, naan or pulao, this easy Butter Chicken is made with a rich and creamy tomato gravy. </p>\r\n</div>\r\n</div>\r\n</div>', '650.00', '300.00', 3, NULL, '1540539652butter chicken.jpg', 1, 0, 1, '2018-10-26 07:40:52'),
(51, 1, NULL, 'gajar-ka-halwa', 'Gajar ka Halwa', '<p>Gajar Ka Halwa is very popular Indian dessert. Here is the easiest way to make delicious gajar ka halwa. Gajar Halwa is made during all festival occasions like Diwali, holi and other holy occasions. Gajar halwa is a classic recipe which is made all over India. In this recipe I have used khoya and also milk. Khoya will make gajar halwa tastier. You can also make gajar halwa without khoya (mava).</p>', '60.00', '0.00', 10, NULL, '1540539737gjh.jpg', 1, 0, 1, '2018-10-26 07:42:17'),
(52, 1, NULL, 'moong-dal-halwa', 'Moong Dal Halwa', '<p>Moong dal halwa or moong ki daal ka halwa is a special occasion sweet recipe made using soaked moong dal and can also be made without soaking moong dal.</p>', '80.00', '0.00', 10, NULL, '154054005321.jpg', 1, 0, 1, '2018-10-26 07:47:33'),
(53, 1, NULL, 'chicken-changezi', 'Chicken Changezi', '<p>Chicken Changezi is rich creamy and quite delicious served with flatbreads like naan or tandoori roti. The main masala of changezi is of onion and kaju paste sauteed in oil or ghee.</p>', '600.00', '325.00', 3, NULL, '1540540413changezi.jpg', 1, 0, 1, '2018-10-26 07:53:33'),
(54, 1, NULL, 'cold-drinks', 'Cold Drinks', '<p>Soft Drinks - Soft Drink Coca Cola - Fanta- Sprite Can 330ml.</p>', '60.00', '0.00', 11, NULL, '1540540483cd.jpg', 1, 0, 1, '2018-10-26 07:54:43'),
(55, 1, NULL, 'mineral-water', 'Mineral Water', '<p>When you are drinking Kinley Mineral Water, you are assured of water in its purest form, because Kinley from the house of Coca-Cola uses reverse osmosis technology to produce clean and safe drinking water.</p>', '60.00', '0.00', 11, NULL, '1540540618min.jpg', 1, 0, 1, '2018-10-26 07:56:58'),
(56, 1, NULL, 'chicken-kali-mirch', 'Chicken Kali Mirch', '<p>Chicken Kali Mirch or Murgh Kali Mirch is a spicy chicken curry that is cooked with loads of Black Pepper or kali Mirch. The aroma of fresh ground Black Pepper that flavors the chicken pieces simmering in thick creamy gravy is hard to resist.</p>', '700.00', '325.00', 3, NULL, '1540540618kali mirch.jpg', 1, 0, 1, '2018-10-26 07:56:58'),
(57, 1, NULL, 'coffee', 'coffee', '<p>Coffee is a deep concoction that was made to soothe souls and wake up tired minds.</p>', '45.00', '0.00', 11, NULL, '1540541013vvv.jpg', 1, 0, 1, '2018-10-26 08:03:33'),
(58, 1, NULL, 'tomato-soup', 'Tomato Soup', '<p>Along with the tomatoes this soup also has carrots onions and garlic because the taste of tomatoes.</p>', '60.00', '0.00', 11, NULL, '1540541220tm.jpg', 1, 0, 1, '2018-10-26 08:07:00'),
(59, 1, NULL, 'drien-chicken', 'Drien Chicken', '<p>roast chicken gets a big flavor boost from a rub that includes a medley of dried herbs and spices.</p>', '700.00', '375.00', 3, NULL, '1540541353drien.jpg', 1, 0, 1, '2018-10-26 08:09:13'),
(60, 1, NULL, 'chicken-soup', 'Chicken  Soup', '<p>The torn romaine lettuce wilts just slightly in the soup and has a lighter, fresher, less earthy flavor than heartier greens like spinach or kale. Slice the carrot the same shape and thickness as the leek so you get a balance of both vegetables in every spoonful.</p>', '90.00', '0.00', 11, NULL, '1540541356ck.jpg', 1, 0, 1, '2018-10-26 08:09:16'),
(61, 1, NULL, 'chilli-chicken', 'Chilli Chicken', '<p>A popular and delicious Hakka, Indian Chinese takeout dish, dry chilli chicken is made with crispy chicken chunks and lightly tossed in a spicy chilli sauce. Packed full of amazing flavours from both worlds.</p>', '500.00', '275.00', 3, NULL, '1540541705chilli chicken.jpg', 1, 0, 1, '2018-10-26 08:15:05'),
(62, 1, NULL, 'fish-korma', 'Fish Korma ', '<p>This recipe calls for white fish, such as carp and a heady combination of spices. Serve the fish korma over a bed of steamed rice for a delicious, wholesome meal!</p>', '850.00', '450.00', 5, NULL, '1540541834kb.jpg', 1, 0, 1, '2018-10-26 08:17:14'),
(63, 1, NULL, 'chicken-d0-pyaza', 'Chicken-Do-Pyaza', '<p>Spicy Chicken do pyaza curry which has double the amount of onions and this curry has a sweet flavour from the onions which taste so yum.</p>', '500.00', '275.00', 3, NULL, '1540542056chicken pyaza.jpg', 1, 0, 1, '2018-10-26 08:20:56'),
(64, 1, NULL, 'chicken-jinger', 'Chicken Jinger', '<p>&nbsp;As the name suggests, this chicken ginger has a very strong taste of ginger as it is the main ingredient. Chicken ginger is a gravy dish served with Tandoori Kulcha and Naan.</p>', '500.00', '275.00', 3, NULL, '1540542387ginger.jpeg', 1, 0, 1, '2018-10-26 08:26:27'),
(65, 1, NULL, 'kadai-chicken', 'Kadai Chicken', '<p>Tasty Kadai chicken is a popular recipe in Northern India and Kadai Chicken is a very famous non-veg delight in restaurants,This spicy &amp; yummy North Indian recipe tastes juicy with distinct flavor of bell pepper, Whole spices ground to a fine paste and cooked with onions, tomatoes and chicken chunks of the bone</p>', '550.00', '300.00', 3, NULL, '1540542823kadai chicken.jpg', 1, 0, 1, '2018-10-26 08:33:43'),
(66, 1, NULL, 'red-white-sauce', 'Red - White Sauce', '<p>This garden-fresh tomato sauce is a delicious way to use summer-ripe tomatoes.</p>', '150.00', '0.00', 12, NULL, '1540545939reds.jpeg', 1, 0, 1, '2018-10-26 09:25:39'),
(67, 1, NULL, 'hakka-noodles', 'Hakka Noodles', '<p><strong>Veg Hakka Noodles</strong> is an Indo-Chinese preparation that is made by tossing boiled noodles and stir fried vegetables in Chinese sauces. The vegetables give it an enjoyable crunchy texture and the Soy and Chilli sauces give it a distinctive flavor.</p>', '80.00', '0.00', 12, NULL, '1540546217hak.jpg', 1, 0, 1, '2018-10-26 09:30:17'),
(68, 1, NULL, 'veg-burger', 'Veg Burger', '<p>Veg Burger is made from vegetables (like potato or corn), textured vegetable protein (like soy), legumes (beans), tofu, nuts, mushrooms, or grains or seeds, like wheat.</p>', '60.00', '0.00', 12, NULL, '1540546357vegb.jpg', 1, 0, 1, '2018-10-26 09:32:37'),
(69, 1, NULL, 'manchurian', 'Manchurian ', '<p><span class=\"wpurp-recipe-description\" style=\"margin-top: 10px !important; margin-bottom: 10px !important; position: static !important; text-align: inherit !important; vertical-align: inherit !important; font-style: italic;\">Vegetable Manchurian is a Chinese recipe and a must have dish for any party or get together. This delicious gravy is made using cauliflower, cabbage, carrots and onion !</span></p>', '80.00', '0.00', 12, NULL, '1540546481mnv.jpg', 1, 0, 1, '2018-10-26 09:34:41'),
(70, 1, NULL, 'chicken-lababdar', 'Chicken Lababdar', '<p>Chicken Lababdar is a mughlai gravy prepared with Chicken pieces marinated in tandoori masala and cooked in onion, tomato and cashew based gravy.</p>', '550.00', '300.00', 3, NULL, '1540547095lababdar.jpg', 1, 0, 1, '2018-10-26 09:44:55'),
(71, 1, NULL, 'fried-rice', 'Fried Rice', '<p><em>This classic Fried Rice recipe is one of my favorite ways to use up leftover rice, and it&rsquo;s ready in under 20 minutes. It&rsquo;s great on its own or as a side!</em></p>', '65.00', '0.00', 12, NULL, '1540547127fr.jpg', 1, 0, 1, '2018-10-26 09:45:27'),
(72, 1, NULL, 'mushroom-corn-masala', 'Mushroom Corn Masala', '<p>Mushroom Masala With Corn Recipe is a delicious desi appetizer with spiced corn and sauteed mushrooms. This is a perfect snack to serve along with your cup of Tea or Coffee.</p>', '70.00', '0.00', 12, NULL, '1540547267mas.jpg', 1, 0, 1, '2018-10-26 09:47:47'),
(73, 1, NULL, 'mughlai-chicken', 'Mughlai Chicken', '<p>Mughlai Chicken is a rich, decadent, restaurant-style, brown-coloured chicken gravy belonging to the Mughal era. A bowl of this Mughlai Chicken with naan or rice will surely have you licking off your plates!</p>', '600.00', '350.00', 3, NULL, '1540547458mughlai.jpg', 1, 0, 1, '2018-10-26 09:50:58'),
(74, 1, NULL, 'corn-capsicum-masala', 'Corn Capsicum Masala ', '<p>Corn Capsicum Masala is a very delicious and Crunchy sabzi. Kids too relish eating sweet corn, they will relish this too.</p>', '85.00', '0.00', 12, NULL, '1540547482cc.jpg', 1, 0, 1, '2018-10-26 09:51:22'),
(75, 1, NULL, 'chicken-lahori', 'Chicken Lahori', '<p>&nbsp;This is Chicken Lahori from Pakistan\'s capital city, where street food is a real theatre for the eyes. Pakistani cuisine generally involves a more heavy-handed use of oil and spices than a lot of Indian cuisine and this is proper Pakistani Punjab fare: hearty and hot.</p>', '550.00', '300.00', 3, NULL, '1540547702lahori.jpg', 1, 0, 1, '2018-10-26 09:55:02'),
(76, 1, NULL, 'honey-chilli-potatoes', 'Honey Chilli Potatoes ', '<p>A hugely popular Chinese dish, Honey Chill Potato is juicy, crunchy and full of flavour snack that you just cannot resist. A delicious pick for kids, the great taste of honey chilli potatoes can be brought home. Try this recipe and you\'ll never head to those street stalls again!</p>', '85.00', '0.00', 12, NULL, '1540547721hhhhh.jpg', 1, 0, 1, '2018-10-26 09:55:21'),
(77, 1, NULL, 'honey-chilli-cauliflower', 'Honey Chilli Cauliflower', '<p>Amazing Chinese recipe that we have experimented with cauliflower. The combination of Honey and Chili with cauliflower gives a nice vibrant flavor to the dish.</p>', '90.00', '0.00', 12, NULL, '1540547948chh.jpg', 0, 0, 1, '2018-10-26 09:59:08'),
(78, 1, NULL, 'chicken-achari', 'Chicken Achari', '<p>Achari murg is, as the name indicates pickled chicken. However, do not misinterpret it as preserved chicken. It actually refers to a preparation wherein chicken is combined with same Indian spices that goes into making of an achaar.</p>', '550.00', '300.00', 3, NULL, '1540548074achari.jpg', 0, 0, 1, '2018-10-26 10:01:14'),
(79, 1, NULL, 'veg-noodles', 'Veg. Noodles', '<p>This is an easy and quick recipe for Vegetable Noodles. Its a great dish for parties and perfect for kids. This&nbsp;Vegetable Noodles is not spicy, its colorful and its healthy too.</p>', '70.00', '0.00', 12, NULL, '1540548130vegn.jpg', 0, 0, 1, '2018-10-26 10:02:10'),
(80, 1, NULL, 'green-chicken', 'Green Chicken', '<p>The simple yet distinct flavors of the greens and spices make it taste delicious with the chutney of your choice and a side of rice or bread.</p>', '600.00', '350.00', 3, NULL, '1540548429green.jpg', 0, 0, 1, '2018-10-26 10:07:09'),
(81, 1, NULL, 'chicken-ishtu', 'Chicken Ishtu', '<p>Chicken ishtu is an excellent combo curry with Appam. This combination is very important in Christian cuisine. It goes well with idiyappam, chappaty, Roti, etc. Cooked with vegetables like carrot, beans, potato, green peas and chicken, it is a very healthy dish.</p>', '550.00', '325.00', 3, NULL, '1540548835ishtu.jpg', 0, 0, 1, '2018-10-26 10:13:55'),
(82, 1, NULL, 'chicken-nahari', 'Chicken Nahari', '<p>Nihari is a Pakistani/Indian/Bangladeshi dish, a fiery spicy stew consisting of slow cooked mutton/beef or chicken. The word Nihari originates from the Arabic word \'Nahaar\' which means early morning.&nbsp; It is so named because Nihari was originally enjoyed in the early morning, right after fajr prayers.</p>', '600.00', '350.00', 3, NULL, '1540548995nihari.jpg', 1, 0, 1, '2018-10-26 10:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `open_time` time DEFAULT NULL,
  `close_time` time DEFAULT NULL,
  `weekend_opening_time` time DEFAULT NULL,
  `weekend_closing_time` time DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`id`, `name`, `description`, `slug`, `image`, `open_time`, `close_time`, `weekend_opening_time`, `weekend_closing_time`, `status`, `created`) VALUES
(1, 'Mcd', '<p>fg</p>', 'mcd', '1539195584images.jpg', '15:45:00', '15:45:00', '15:45:00', '15:45:00', 1, '2018-09-25 15:46:44');

-- --------------------------------------------------------

--
-- Table structure for table `restaurentlocations`
--

CREATE TABLE `restaurentlocations` (
  `id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL DEFAULT '0',
  `location_name` varchar(500) DEFAULT NULL,
  `lat` varchar(100) DEFAULT NULL,
  `long` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurentlocations`
--

INSERT INTO `restaurentlocations` (`id`, `rest_id`, `location_name`, `lat`, `long`, `created`) VALUES
(2, 1, 'Siemensstraße 9, 84405 Dorfen, Germany', '48.2691213', '12.1608507', '2018-09-25 01:50:08'),
(3, 9, '12125 Day St # V208, Moreno Valley, CA 92557, USA', '33.945298', '-117.2808679', '2018-09-25 04:00:53'),
(4, 1, '19847 Century Blvd, Germantown, MD 20874, USA', '39.1815755', '-77.2657889', '2018-09-25 04:01:05'),
(5, 11, 'Phase - I, Manimajra, Chandigarh, Haryana 160101, India', '30.7290307', '76.8458825', '2018-09-25 12:33:16'),
(6, 11, 'Inside Infosys, Rajiv Gandhi Chandigarh Technology Park, Kishangarh, Manimajra, Chandigarh, 160101, India', '30.7262921', '76.8448538', '2018-09-25 12:33:16'),
(7, 11, 'Sector 17D, Chandigarh, 160017, India', '30.743075', '76.781875', '2018-09-25 12:33:16'),
(8, 11, 'Sector 9, Opp National Cactus Botanical Garden, Panchkula, Haryana 134112, India', '30.6970644', '76.8494551', '2018-09-25 12:33:16'),
(9, 11, 'SCO 44, Sector 11, Panchkula, Haryana, India', '30.686114', '76.848801', '2018-09-25 12:33:16'),
(10, 11, 'SCO 37, Sector 8B Near Sector 8 Market, Chandigarh, 160009, India', '30.7401952', '76.7983383', '2018-09-25 12:33:16'),
(11, 11, 'Sco No. 469-470, 35C, Sector 35, Chandigarh, 160022, India', '30.722682', '76.761793', '2018-09-25 12:33:16'),
(12, 11, 'Unnamed Road, Sector 28 D, Sector 28, Chandigarh, 160102, India', '30.7186978', '76.8016353', '2018-09-25 12:33:16'),
(13, 11, 'Second Floor, Shop 229, Elante Mall, Plot No. 178, Industrial Area Phase I, Chandigarh, 160017, India', '30.7050502', '76.8013517', '2018-09-25 12:33:16'),
(14, 11, 'Scf 31, Sector 19D, Opp Dogra Nursing Home, Sector 19, Chandigarh, 160019, India', '30.7297053', '76.791126', '2018-09-25 12:33:16'),
(15, 11, 'Opp Hotel Mountview, Sco 22, Sector 10, Chandigarh, 160011, India', '30.7540196', '76.7875507', '2018-09-25 12:33:16'),
(16, 11, '35 Near State Food Drugs & Excise Lab Market Area Sector 11 D, Chandigarh 160011, India', '30.759704', '76.782798', '2018-09-25 12:33:16'),
(17, 11, 'Shop No.128, 18, Dakshin Marg, Phase 1, Industrial Area Phase I, Chandigarh, 160002, India', '30.7021049', '76.8000091', '2018-09-25 12:33:16'),
(18, 11, 'Sector 10, 223, Amartex Rd, Sector 10, Panchkula, Haryana 134109, India', '30.6842608', '76.8461496', '2018-09-25 12:33:16'),
(19, 11, '1st Floor, 84, Jan Rd, 17G, 17D, Chandigarh, 160017, India', '30.7414265', '76.7828384', '2018-09-25 12:33:16'),
(20, 11, 'The Eating House, Inside Hotel Aroma Complex, Himalaya Marg, Sector 22, Chandigarh, 160022, India', '30.730261', '76.7734658', '2018-09-25 12:33:16'),
(21, 11, 'Sco No. 38 P, Sector 16 D, Chandigarh, 160016, India', '30.7480244', '76.7750107', '2018-09-25 12:33:16'),
(22, 11, '2544, Sector 24C, Sector 24, Chandigarh, 160036, India', '30.7439431', '76.7587437', '2018-09-25 12:33:16'),
(23, 11, 'Scf 9, Phase 11, Sector 65, Sas Nagar, Sector 65, Sahibzada Ajit Singh Nagar, Punjab 160047, India', '30.682894', '76.742972', '2018-09-25 12:33:16'),
(24, 11, 'sco 27, 23C, Sector 23, Chandigarh, 160023, India', '30.7381377', '76.766371', '2018-09-25 12:33:16'),
(25, 2, 'A Block, DLF Phase 1, Sector 28, Gurugram, Haryana 122002, India', '28.475907', '77.09364099999993', '2018-09-25 13:36:45'),
(26, 2, 'Plot Number 22-23, IT Park, Phase - I, Manimajra, Kishangarh, Phase - I, Manimajra, Chandigarh, Haryana 161101, India', '30.7288669', '76.84544260000007', '2018-09-25 13:36:45'),
(27, 3, 'Plot No. 10, Rajiv Gandhi IT Park, Phase - I, Manimajra, Chandigarh, Haryana 160101, India', '30.72396', '76.84711300000004', '2018-09-25 13:38:55'),
(29, 0, 'Unnamed Road, Sector 61, Sahibzada Ajit Singh Nagar, Punjab 160062, India', '30.7057555660034', '76.71971795980221', '2018-09-25 18:48:51'),
(30, 0, 'chandigarh', '30.7333148', '76.7794179', '2018-09-25 18:49:20'),
(31, 1, 'mohali', '30.7046486', '76.7178726', '2018-09-26 17:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(12) NOT NULL,
  `product_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `text` text NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `product_id`, `user_id`, `text`, `rating`, `status`, `created`, `modified`) VALUES
(1, 33, 1, 'this is test review', 5, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 6, 23, 'Jhhh', 1, 0, '2017-03-17 15:12:12', '2017-03-17 15:12:12'),
(5, 33, 24, 'dfdsrerfer', 4, 0, '2017-03-20 10:50:08', '2017-03-20 10:50:08'),
(7, 6, 21, 'It\'s really awesome!!!!', 1, 0, '2017-03-28 16:14:11', '2017-03-28 16:14:11'),
(8, 5, 23, 'Good', 1, 0, '2017-03-28 18:32:14', '2017-03-28 18:32:14'),
(13, 6, 1, '', 0, 0, '2018-01-23 09:23:15', '2018-01-23 09:23:15'),
(12, 1, 20, 'cddfsfgsfgfg', 0, 0, '2018-01-19 07:21:58', '2018-01-19 07:21:58'),
(14, 2, 1, 'Awesome!', 6, 0, '2018-10-15 17:49:59', '2018-10-15 17:49:59'),
(15, 22, 6, 'One of my fav food.', 6, 0, '2018-11-10 13:31:46', '2018-11-10 13:31:46'),
(16, 1, 6, 'Awesome!', 5, 0, '2018-11-23 16:49:26', '2018-11-23 16:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(250) NOT NULL,
  `value` varchar(1000) DEFAULT NULL,
  `type` varchar(50) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `created`, `modified`) VALUES
(1, 'admin_contact_number', '+91-7087400950', '', '2017-03-11 08:19:16', '2017-12-11 14:21:39'),
(2, 'admin_contact_mail', 'info@magicalzaika.com', '', '2017-03-11 08:19:16', '2017-03-11 08:19:16'),
(3, 'address', 'Showroom Number-17-18 Royal Estate Zirakpur', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'facebook_link', 'https://www.facebook.com/', '', '2017-03-14 13:31:30', '2017-03-14 13:31:30'),
(5, 'google_link', 'https://www.google.com/', '', '2017-03-14 13:31:30', '2017-03-14 13:31:30'),
(6, 'twitter_link', 'https://www.twitter.com/', '', '2017-03-14 13:31:30', '2017-03-14 13:31:30'),
(7, 'admin_contact_name', 'Magicalzaika', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'sale_commission', '0', 'commission ', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `staticpages`
--

CREATE TABLE `staticpages` (
  `id` int(11) NOT NULL,
  `slug` varchar(355) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `title` varchar(355) DEFAULT NULL,
  `image` varchar(355) DEFAULT NULL,
  `content` text,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staticpages`
--

INSERT INTO `staticpages` (`id`, `slug`, `position`, `title`, `image`, `content`, `status`, `created`, `modified`) VALUES
(4, 'privacy-policy', 'privacy-policy', 'Privacy Policy', '1512989667pp.jpg', '<section class=\"wrapper-full section grey-bkg\">\r\n<div class=\"container\">\r\n<div class=\"contain\">\r\n<p>We are committed to safeguarding the privacy of our website visitors; this policy&nbsp;sets out how we will treat your personal information. <strong>&nbsp;</strong>Our website uses cookies.&nbsp; By using our website and agreeing to this policy, you consent to our use of cookies in accordance with the terms of this policy. <strong>&nbsp;</strong></p>\r\n<p><strong>(1)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; What information do we collect?</strong></p>\r\n<p>We may collect, store and use the following kinds of personal information:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information about your computer and about your visits to and use of this website (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information relating to any transactions carried out between you and us on or in relation to this website, including information relating to any purchases you make of our goods or services.</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information that you provide to us for the purpose of registering with us (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information that you provide to us for the purpose of subscribing to our website services, email notifications and/or newsletters (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; any other information that you choose to send to us; and</p>\r\n<p><strong>(2)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cookies</strong></p>\r\n<p>A cookie consists of a piece of text sent by a web server to a web browser, and stored by the browser. The information is then sent back to the server each time the browser requests a page from the server. This enables the web server to identify and track the web browser.</p>\r\n<p>We may use both &ldquo;session&rdquo; cookies and &ldquo;persistent&rdquo; cookies on the website.&nbsp; We will use the session cookies to: keep track of you whilst you navigate the website; and <em>other uses</em>.&nbsp; We will use the persistent cookies to: enable our website to recognise you when you visit; and <em>other uses</em>. Session cookies will be deleted from your computer when you close your browser.&nbsp; Persistent cookies will remain stored on your computer until deleted, or until they reach a specified expiry date.</p>\r\n<p>We use Google Analytics to analyse the use of this website.&nbsp; Google Analytics generates statistical and other information about website use by means of cookies, which are stored on users&rsquo; computers.&nbsp; The information generated relating to our website is used to create reports about the use of the website. Google will store this information.&nbsp; Google&rsquo;s privacy policy is available at: http://www.google.com/privacypolicy.html. Our advertisers/payment services providers may also send you cookies.</p>\r\n<p>Most browsers allow you to reject all cookies, whilst some browsers allow you to reject just third party cookies.&nbsp; For example, in Internet Explorer you can refuse all cookies by clicking &ldquo;Tools&rdquo;, &ldquo;Internet Options&rdquo;, &ldquo;Privacy&rdquo;, and selecting &ldquo;Block all cookies&rdquo; using the sliding selector.&nbsp; Blocking all cookies will, however, have a negative impact upon the usability of many websites, including this one.</p>\r\n<p><strong>(3)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Using your personal information</strong></p>\r\n<p>Personal information submitted to us via this website will be used for the purposes specified in this privacy policy or in relevant parts of the website. We may use your personal information to:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; administer the website;</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; improve your browsing experience by personalising the website;</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; enable your use of the services available on the website;</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send to you goods purchased via the website, and supply to you services purchased via the website;</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send statements and invoices to you, and collect payments from you;</p>\r\n<p>(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send you general (non-marketing) commercial communications;</p>\r\n<p>(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send you email notifications which you have specifically requested</p>\r\n<p>(h)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send to you our newsletter and other marketing communications relating to our business or the businesses of carefully-selected third parties which we think may be of interest to you by post or, where you have specifically agreed to this, by email or similar technology (you can inform us at any time if you no longer require marketing communications);</p>\r\n<p>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; provide third parties with statistical information about our users &ndash; but this information will not be used to identify any individual user;</p>\r\n<p>(j)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; deal with enquiries and complaints made by or about you relating to the website; and</p>\r\n<p>(k)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Where you submit personal information for publication on our website, we will publish and otherwise use that information in accordance with the licence you grant to us. We will not without your express consent provide your personal information to any third parties for the purpose of direct marketing. All our website financial transactions are handled through our payment services provider, PayPal.&nbsp; You can review the PayPal privacy policy at www.paypal.com.&nbsp; We will share information with&nbsp; PayPal only to the extent necessary for the purposes of processing payments you make via our website and dealing with complaints and queries relating to such payments.&nbsp;We do not store your payment details but Paypal do.</p>\r\n<p><strong>(4) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Disclosures</strong></p>\r\n<p>We may disclose information about you to any of our employees, officers, agents, suppliers or subcontractors insofar as reasonably necessary for the purposes as set out in this privacy policy. In addition, we may disclose your personal information:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to the extent that we are required to do so by law;</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; in connection with any legal proceedings or prospective legal proceedings;</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; in order to establish, exercise or defend our legal rights (including providing information to others for the purposes of fraud prevention and reducing credit risk);</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to the purchaser (or prospective purchaser) of any business or asset that we are (or are contemplating) selling; and</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to any person who we reasonably believe may apply to a court or other competent authority for disclosure of that personal information where, in our reasonable opinion, such court or authority would be reasonably likely to order disclosure of that personal information. Except as provided in this privacy policy, we will not provide your information to third parties.</p>\r\n<p><strong>(5)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; International data transfers</strong></p>\r\n<p>Information that we collect may be stored and processed in and transferred between any of the countries in which we operate in order to enable us to use the information in accordance with this privacy policy. Information which you provide may be transferred to countries (including the United States, Japan, <em>other countries</em>) which do not have data protection laws equivalent to those in force in the European Economic Area. In addition, personal information that you submit for publication on the website will be published on the internet and may be available, via the internet, around the world.&nbsp; We cannot prevent the use or misuse of such information by others You expressly agree to such transfers of personal information.</p>\r\n<p><strong>(6)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Security of your personal information</strong></p>\r\n<p>We will take reasonable technical and organisational precautions to prevent the loss, misuse or alteration of your personal information. We will store all the personal information you provide on our secure (password- and firewall- protected) servers. All electronic transactions you make to or receive from us will be encrypted using SSL technology. <a title=\"\" href=\"#_ftn16\">[16</a>] Of course, data transmission over the internet is inherently insecure, and we cannot guarantee the security of data sent over the internet. You are responsible for keeping your password and user details confidential. We will not ask you for your password (except when you log in to the website).</p>\r\n<p><strong>(7)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Policy amendments</strong></p>\r\n<p>We may update this privacy policy from time-to-time by posting a new version on our website.&nbsp; You should check this page occasionally to ensure you are happy with any changes. We may also notify you of changes to our privacy policy by email.</p>\r\n<p><strong>(8)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your rights</strong></p>\r\n<p>You may instruct us to provide you with any personal information we hold about you.&nbsp; Provision of such information will be subject to:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the payment of a fee (currently fixed at &pound;10.00); and</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the supply of appropriate evidence of your identity (for this purpose, we will usually accept a photocopy of your passport certified by a solicitor or bank plus an original copy of a utility bill showing your current address). We may withhold such personal information to the extent permitted by law. You may instruct us not to process your personal information for marketing purposes, by sending an email to us.&nbsp; In practice, you will usually either expressly agree in advance to our use of your personal information for marketing purposes, or we will provide you with an opportunity to opt-out of the use of your personal information for marketing purposes.</p>\r\n<p><strong>(9)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Third party websites</strong></p>\r\n<p>The website contains links to other websites. We are not responsible for the privacy policies or practices of third party websites.</p>\r\n<p><strong>(10)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Updating information</strong></p>\r\n<p>Please let us know if the personal information which we hold about you needs to be corrected or updated.</p>\r\n<p><strong>(11) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact</strong></p>\r\n<p>If you have any questions about this privacy policy or our treatment of your personal information, please write to us by email to <em>info@magicalzaika.com</em></p>\r\n</div>\r\n</div>\r\n</section>', 1, '2017-08-17 08:22:56', '2018-01-21 17:41:30'),
(5, 'terms-and-conditions', 'terms-and-conditions', 'Terms and Conditions', '1512989542tc.jpg', '<p>We are committed to safeguarding the privacy of our website visitors; this policy&nbsp;sets out how we will treat your personal information. <strong>&nbsp;</strong>Our website uses cookies.&nbsp; By using our website and agreeing to this policy, you consent to our use of cookies in accordance with the terms of this policy. <strong>&nbsp;</strong></p>\r\n<p><strong>(1)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; What information do we collect?</strong></p>\r\n<p>We may collect, store and use the following kinds of personal information:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information about your computer and about your visits to and use of this website (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information relating to any transactions carried out between you and us on or in relation to this website, including information relating to any purchases you make of our goods or services.</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information that you provide to us for the purpose of registering with us (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information that you provide to us for the purpose of subscribing to our website services, email notifications and/or newsletters (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; any other information that you choose to send to us; and</p>\r\n<p><strong>(2)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cookies</strong></p>\r\n<p>A cookie consists of a piece of text sent by a web server to a web browser, and stored by the browser. The information is then sent back to the server each time the browser requests a page from the server. This enables the web server to identify and track the web browser.</p>\r\n<p>We may use both &ldquo;session&rdquo; cookies and &ldquo;persistent&rdquo; cookies on the website.&nbsp; We will use the session cookies to: keep track of you whilst you navigate the website; and <em>other uses</em>.&nbsp; We will use the persistent cookies to: enable our website to recognise you when you visit; and <em>other uses</em>. Session cookies will be deleted from your computer when you close your browser.&nbsp; Persistent cookies will remain stored on your computer until deleted, or until they reach a specified expiry date.</p>\r\n<p>We use Google Analytics to analyse the use of this website.&nbsp; Google Analytics generates statistical and other information about website use by means of cookies, which are stored on users&rsquo; computers.&nbsp; The information generated relating to our website is used to create reports about the use of the website. Google will store this information.&nbsp; Google&rsquo;s privacy policy is available at: http://www.google.com/privacypolicy.html. Our advertisers/payment services providers may also send you cookies.</p>\r\n<p>Most browsers allow you to reject all cookies, whilst some browsers allow you to reject just third party cookies.&nbsp; For example, in Internet Explorer you can refuse all cookies by clicking &ldquo;Tools&rdquo;, &ldquo;Internet Options&rdquo;, &ldquo;Privacy&rdquo;, and selecting &ldquo;Block all cookies&rdquo; using the sliding selector.&nbsp; Blocking all cookies will, however, have a negative impact upon the usability of many websites, including this one.</p>\r\n<p><strong>(3)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Using your personal information</strong></p>\r\n<p>Personal information submitted to us via this website will be used for the purposes specified in this privacy policy or in relevant parts of the website. We may use your personal information to:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; administer the website;</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; improve your browsing experience by personalising the website;</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; enable your use of the services available on the website;</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send to you goods purchased via the website, and supply to you services purchased via the website;</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send statements and invoices to you, and collect payments from you;</p>\r\n<p>(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send you general (non-marketing) commercial communications;</p>\r\n<p>(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send you email notifications which you have specifically requested</p>\r\n<p>(h)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send to you our newsletter and other marketing communications relating to our business or the businesses of carefully-selected third parties which we think may be of interest to you by post or, where you have specifically agreed to this, by email or similar technology (you can inform us at any time if you no longer require marketing communications);</p>\r\n<p>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; provide third parties with statistical information about our users &ndash; but this information will not be used to identify any individual user;</p>\r\n<p>(j)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; deal with enquiries and complaints made by or about you relating to the website; and</p>\r\n<p>(k)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Where you submit personal information for publication on our website, we will publish and otherwise use that information in accordance with the licence you grant to us. We will not without your express consent provide your personal information to any third parties for the purpose of direct marketing. All our website financial transactions are handled through our payment services provider, PayPal.&nbsp; You can review the PayPal privacy policy at www.paypal.com.&nbsp; We will share information with&nbsp; PayPal only to the extent necessary for the purposes of processing payments you make via our website and dealing with complaints and queries relating to such payments.&nbsp;We do not store your payment details but Paypal do.</p>\r\n<p><strong>(4) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Disclosures</strong></p>\r\n<p>We may disclose information about you to any of our employees, officers, agents, suppliers or subcontractors insofar as reasonably necessary for the purposes as set out in this privacy policy. In addition, we may disclose your personal information:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to the extent that we are required to do so by law;</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; in connection with any legal proceedings or prospective legal proceedings;</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; in order to establish, exercise or defend our legal rights (including providing information to others for the purposes of fraud prevention and reducing credit risk);</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to the purchaser (or prospective purchaser) of any business or asset that we are (or are contemplating) selling; and</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to any person who we reasonably believe may apply to a court or other competent authority for disclosure of that personal information where, in our reasonable opinion, such court or authority would be reasonably likely to order disclosure of that personal information. Except as provided in this privacy policy, we will not provide your information to third parties.</p>\r\n<p><strong>(5)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; International data transfers</strong></p>\r\n<p>Information that we collect may be stored and processed in and transferred between any of the countries in which we operate in order to enable us to use the information in accordance with this privacy policy. Information which you provide may be transferred to countries (including the United States, Japan, <em>other countries</em>) which do not have data protection laws equivalent to those in force in the European Economic Area. In addition, personal information that you submit for publication on the website will be published on the internet and may be available, via the internet, around the world.&nbsp; We cannot prevent the use or misuse of such information by others You expressly agree to such transfers of personal information.</p>\r\n<p><strong>(6)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Security of your personal information</strong></p>\r\n<p>We will take reasonable technical and organisational precautions to prevent the loss, misuse or alteration of your personal information. We will store all the personal information you provide on our secure (password- and firewall- protected) servers. All electronic transactions you make to or receive from us will be encrypted using SSL technology. <a title=\"\" href=\"#_ftn16\">[16</a>] Of course, data transmission over the internet is inherently insecure, and we cannot guarantee the security of data sent over the internet. You are responsible for keeping your password and user details confidential. We will not ask you for your password (except when you log in to the website).</p>\r\n<p><strong>(7)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Policy amendments</strong></p>\r\n<p>We may update this privacy policy from time-to-time by posting a new version on our website.&nbsp; You should check this page occasionally to ensure you are happy with any changes. We may also notify you of changes to our privacy policy by email.</p>\r\n<p><strong>(8) Your rights</strong></p>\r\n<p>You may instruct us to provide you with any personal information we hold about you.&nbsp; Provision of such information will be subject to:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the payment of a fee (currently fixed at &pound;10.00); and</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the supply of appropriate evidence of your identity (for this purpose, we will usually accept a photocopy of your passport certified by a solicitor or bank plus an original copy of a utility bill showing your current address). We may withhold such personal information to the extent permitted by law. You may instruct us not to process your personal information for marketing purposes, by sending an email to us.&nbsp; In practice, you will usually either expressly agree in advance to our use of your personal information for marketing purposes, or we will provide you with an opportunity to opt-out of the use of your personal information for marketing purposes.</p>\r\n<p><strong>(9) Third party websites</strong></p>\r\n<p>The website contains links to other websites. We are not responsible for the privacy policies or practices of third party websites.</p>\r\n<p><strong>(10) Updating information</strong></p>\r\n<p>Please let us know if the personal information which we hold about you needs to be corrected or updated.</p>\r\n<p><strong>(11) Data controller</strong></p>\r\n<p>The data controller responsible in respect of the information collected on this website.</p>', 1, '2017-08-17 09:27:54', '2018-10-14 16:51:56'),
(6, 'frequently-asked-questions', 'faq', 'Frequently Asked Questions', '1512989796faq.jpg', '<section class=\"wrapper-full section grey-bkg\">\r\n<div class=\"container\">\r\n<div class=\"contain\">\r\n<p>We are committed to safeguarding the privacy of our website visitors; this policy&nbsp;sets out how we will treat your personal information. <strong>&nbsp;</strong>Our website uses cookies.&nbsp; By using our website and agreeing to this policy, you consent to our use of cookies in accordance with the terms of this policy. <strong>&nbsp;</strong></p>\r\n<p><strong>(1)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; What information do we collect?</strong></p>\r\n<p>We may collect, store and use the following kinds of personal information:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information about your computer and about your visits to and use of this website (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information relating to any transactions carried out between you and us on or in relation to this website, including information relating to any purchases you make of our goods or services.</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information that you provide to us for the purpose of registering with us (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; information that you provide to us for the purpose of subscribing to our website services, email notifications and/or newsletters (including your IP address, geographical location, browser type and version, operating system, referral source, length of visit, page views, website navigation and e-mail address);</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; any other information that you choose to send to us; and</p>\r\n<p><strong>(2)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Cookies</strong></p>\r\n<p>A cookie consists of a piece of text sent by a web server to a web browser, and stored by the browser. The information is then sent back to the server each time the browser requests a page from the server. This enables the web server to identify and track the web browser.</p>\r\n<p>We may use both &ldquo;session&rdquo; cookies and &ldquo;persistent&rdquo; cookies on the website.&nbsp; We will use the session cookies to: keep track of you whilst you navigate the website; and <em>other uses</em>.&nbsp; We will use the persistent cookies to: enable our website to recognise you when you visit; and <em>other uses</em>. Session cookies will be deleted from your computer when you close your browser.&nbsp; Persistent cookies will remain stored on your computer until deleted, or until they reach a specified expiry date.</p>\r\n<p>We use Google Analytics to analyse the use of this website.&nbsp; Google Analytics generates statistical and other information about website use by means of cookies, which are stored on users&rsquo; computers.&nbsp; The information generated relating to our website is used to create reports about the use of the website. Google will store this information.&nbsp; Google&rsquo;s privacy policy is available at: http://www.google.com/privacypolicy.html. Our advertisers/payment services providers may also send you cookies.</p>\r\n<p>Most browsers allow you to reject all cookies, whilst some browsers allow you to reject just third party cookies.&nbsp; For example, in Internet Explorer you can refuse all cookies by clicking &ldquo;Tools&rdquo;, &ldquo;Internet Options&rdquo;, &ldquo;Privacy&rdquo;, and selecting &ldquo;Block all cookies&rdquo; using the sliding selector.&nbsp; Blocking all cookies will, however, have a negative impact upon the usability of many websites, including this one.</p>\r\n<p><strong>(3)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Using your personal information</strong></p>\r\n<p>Personal information submitted to us via this website will be used for the purposes specified in this privacy policy or in relevant parts of the website. We may use your personal information to:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; administer the website;</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; improve your browsing experience by personalising the website;</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; enable your use of the services available on the website;</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send to you goods purchased via the website, and supply to you services purchased via the website;</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send statements and invoices to you, and collect payments from you;</p>\r\n<p>(f)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send you general (non-marketing) commercial communications;</p>\r\n<p>(g)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send you email notifications which you have specifically requested</p>\r\n<p>(h)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; send to you our newsletter and other marketing communications relating to our business or the businesses of carefully-selected third parties which we think may be of interest to you by post or, where you have specifically agreed to this, by email or similar technology (you can inform us at any time if you no longer require marketing communications);</p>\r\n<p>(i)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; provide third parties with statistical information about our users &ndash; but this information will not be used to identify any individual user;</p>\r\n<p>(j)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; deal with enquiries and complaints made by or about you relating to the website; and</p>\r\n<p>(k)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Where you submit personal information for publication on our website, we will publish and otherwise use that information in accordance with the licence you grant to us. We will not without your express consent provide your personal information to any third parties for the purpose of direct marketing. All our website financial transactions are handled through our payment services provider, PayPal.&nbsp; You can review the PayPal privacy policy at www.paypal.com.&nbsp; We will share information with&nbsp; PayPal only to the extent necessary for the purposes of processing payments you make via our website and dealing with complaints and queries relating to such payments.&nbsp;We do not store your payment details but Paypal do.</p>\r\n<p><strong>(4) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Disclosures</strong></p>\r\n<p>We may disclose information about you to any of our employees, officers, agents, suppliers or subcontractors insofar as reasonably necessary for the purposes as set out in this privacy policy. In addition, we may disclose your personal information:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to the extent that we are required to do so by law;</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; in connection with any legal proceedings or prospective legal proceedings;</p>\r\n<p>(c)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; in order to establish, exercise or defend our legal rights (including providing information to others for the purposes of fraud prevention and reducing credit risk);</p>\r\n<p>(d)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to the purchaser (or prospective purchaser) of any business or asset that we are (or are contemplating) selling; and</p>\r\n<p>(e)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; to any person who we reasonably believe may apply to a court or other competent authority for disclosure of that personal information where, in our reasonable opinion, such court or authority would be reasonably likely to order disclosure of that personal information. Except as provided in this privacy policy, we will not provide your information to third parties.</p>\r\n<p><strong>(5)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; International data transfers</strong></p>\r\n<p>Information that we collect may be stored and processed in and transferred between any of the countries in which we operate in order to enable us to use the information in accordance with this privacy policy. Information which you provide may be transferred to countries (including the United States, Japan, <em>other countries</em>) which do not have data protection laws equivalent to those in force in the European Economic Area. In addition, personal information that you submit for publication on the website will be published on the internet and may be available, via the internet, around the world.&nbsp; We cannot prevent the use or misuse of such information by others You expressly agree to such transfers of personal information.</p>\r\n<p><strong>(6)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Security of your personal information</strong></p>\r\n<p>We will take reasonable technical and organisational precautions to prevent the loss, misuse or alteration of your personal information. We will store all the personal information you provide on our secure (password- and firewall- protected) servers. All electronic transactions you make to or receive from us will be encrypted using SSL technology. <a title=\"\" href=\"#_ftn16\">[16</a>] Of course, data transmission over the internet is inherently insecure, and we cannot guarantee the security of data sent over the internet. You are responsible for keeping your password and user details confidential. We will not ask you for your password (except when you log in to the website).</p>\r\n<p><strong>(7)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Policy amendments</strong></p>\r\n<p>We may update this privacy policy from time-to-time by posting a new version on our website.&nbsp; You should check this page occasionally to ensure you are happy with any changes. We may also notify you of changes to our privacy policy by email.</p>\r\n<p><strong>(8)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Your rights</strong></p>\r\n<p>You may instruct us to provide you with any personal information we hold about you.&nbsp; Provision of such information will be subject to:</p>\r\n<p>(a)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the payment of a fee (currently fixed at &pound;10.00); and</p>\r\n<p>(b)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; the supply of appropriate evidence of your identity (for this purpose, we will usually accept a photocopy of your passport certified by a solicitor or bank plus an original copy of a utility bill showing your current address). We may withhold such personal information to the extent permitted by law. You may instruct us not to process your personal information for marketing purposes, by sending an email to us.&nbsp; In practice, you will usually either expressly agree in advance to our use of your personal information for marketing purposes, or we will provide you with an opportunity to opt-out of the use of your personal information for marketing purposes.</p>\r\n<p><strong>(9)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Third party websites</strong></p>\r\n<p>The website contains links to other websites. We are not responsible for the privacy policies or practices of third party websites.</p>\r\n<p><strong>(10)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Updating information</strong></p>\r\n<p>Please let us know if the personal information which we hold about you needs to be corrected or updated.</p>\r\n<p><strong>(11) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Contact</strong></p>\r\n<p>If you have any questions about this privacy policy or our treatment of your personal information, please write to us by email to <em>info@toplocaltrainer.co.uk</em> or by post to <em>Top Local Trainer, 8 Joan Crescent, Eltham, London, SE95RS</em>.</p>\r\n<p><strong>(12)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Data controller</strong></p>\r\n<p>The data controller responsible in respect of the information collected on this website is <em>Hatzidakis Ltd t/a Top Local Trainer.</em></p>\r\n</div>\r\n</div>\r\n</section>', 1, '2017-12-11 09:27:54', '2018-01-12 08:38:21'),
(7, 'contact', 'contact', 'Contact', '1512989796faq.jpg', '<p>We are happy to answer any questions you have or provide you with an appropriate answer. Just send as a message in the form below with any questions you may have.</p>', 1, '2017-12-11 09:27:54', '2018-01-12 09:43:54'),
(12, 'about-us', 'about-us', 'About Us', '1512989667pp.jpg', '<div class=\"about\">\r\n<div class=\"container\">\r\n<div class=\"row\"><!-- Title Content Start -->\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 col-xs-12 commontop text-left\">\r\n<h4>About Us</h4>\r\n<div class=\"divider style-1 left\">&nbsp;</div>\r\n<p>We are one of the best restaurants and catering in Mohali, Chandigarh and Panchkula specialize in Non- vegetarian dishes, wedding catering, corporate events and birthday parties many more.</p>\r\n<p class=\"des\">Our focus to provide Non vegetarian dishes, delicious, hygienic, catering services, quality cuisine, home style food and affordable price to our customer with pride. Our aim to give our customers an unforgettable dining experience with unmatched service &amp; customer satisfaction. We never compromise with the quality. We always give the best quality and adhere to high standard of hygiene &amp; safety. Our client approach is different from rest of our competitors where we give the clients to customize the menu to any extend possible. The services we deliver is always bundled with host of add on services such as waiters, crockery, Tenting, decoration, and lots of more. We have built a reputation for serving great food every time. We take special care prepare our delicacies and great pride in serving them.</p>\r\n</div>\r\n<!-- Title Content End -->\r\n<div class=\"col-sm-12 col-md-12 col-lg-6 col-xs-12\"><img src=\"../assets/images/about/resa.jpg\" alt=\"restaurant\" /></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- Fun-Factor Start -->\r\n<div class=\"fun-factor\">\r\n<div class=\"container\">\r\n<div class=\"row \">\r\n<div class=\"col-sm-3 col-6\"><!-- Fun-Factor Box Start -->\r\n<div class=\"single-box\">\r\n<h4 class=\"number\" data-from=\"100\" data-to=\"300\" data-refresh-interval=\"10\">100</h4>\r\n<h3>MENU ITEMS</h3>\r\n</div>\r\n<!-- Fun-Factor Box End --></div>\r\n<div class=\"col-sm-3 col-6\"><!-- Fun-Factor Box Start -->\r\n<div class=\"single-box\">\r\n<h4 class=\"number\" data-from=\"100\" data-to=\"600\" data-refresh-interval=\"10\">100</h4>\r\n<h3>VISITOR EVERYDAY</h3>\r\n</div>\r\n<!-- Fun-Factor Box End --></div>\r\n<div class=\"col-sm-3 col-6\"><!-- Fun-Factor Box Start -->\r\n<div class=\"single-box\">\r\n<h4 class=\"number\" data-from=\"100\" data-to=\"400\" data-refresh-interval=\"10\">100</h4>\r\n<h3>EXPERT CHEF</h3>\r\n</div>\r\n<!-- Fun-Factor Box End --></div>\r\n<div class=\"col-sm-3 col-6\"><!-- Fun-Factor Box Start -->\r\n<div class=\"single-box\">\r\n<h4 class=\"number\" data-from=\"10\" data-to=\"100\" data-refresh-interval=\"10\">10</h4>\r\n<h3>TEST &amp; LOVE</h3>\r\n</div>\r\n<!-- Fun-Factor Box End --></div>\r\n</div>\r\n</div>\r\n</div>\r\n<!-- Service Start  -->\r\n<div class=\"service\">\r\n<div class=\"container\">\r\n<div class=\"row \"><!-- Title Content Start -->\r\n<div class=\"col-sm-12 col-xs-12 commontop text-center\">\r\n<h4>Why Choose Us ?</h4>\r\n<div class=\"divider style-1 center\">&nbsp;</div>\r\n<p>Our goal is to provide food lovers &ndash; amazingly inferior prices, ample selection, speedy and trustworthy delivery, and a decent and convenient experience; also lend the food joints and restaurants an excellent e-commerce platform.</p>\r\n</div>\r\n<!-- Title Content End -->\r\n<div class=\"col-sm-12 col-xs-12 video\"><img title=\"image\" src=\"../assets/images/about/about-bg.jpg\" alt=\"image\" /></div>\r\n<div class=\"col-sm-4 col-xs-12\"><!--  Box Start  -->\r\n<div class=\"box text-center\">\r\n<h4>Our Vision</h4>\r\n<p>Our vision is to provide our customers the finest dining experience with the best value for money.</p>\r\n</div>\r\n<!--  Box End  --></div>\r\n<div class=\"col-sm-4 col-xs-12\"><!--  Box Start  -->\r\n<div class=\"box text-center\">\r\n<h4>Our Mission</h4>\r\n<p>Hence, we live by our motto- \"Serving happiness\" to one and all!</p>\r\n</div>\r\n<!--  Box End  --></div>\r\n<div class=\"col-sm-4 col-xs-12\"><!--  Box Start  -->\r\n<div class=\"box text-center\">\r\n<h4>Clean Environment</h4>\r\n<p>Our chefs take utmost care to prepare food in a clean environment.</p>\r\n</div>\r\n<!--  Box End  --></div>\r\n</div>\r\n</div>\r\n</div>', 1, '2017-08-17 08:22:56', '2018-10-14 10:34:54');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `image` varchar(500) DEFAULT NULL,
  `description` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `content`, `created`) VALUES
(1, 'Kapil Patel', '<p>Family and I have eaten here several times. Love the food, the best place in town! Thank you to the Chef and the cooks that prepare the delicious food.</p>', '2018-10-23 17:41:47'),
(3, 'Riya', '<p>This is the best Indian restaurant in tricity, hands down. If you would like to eat authentic Indian food, try this place. The food is really tasty and spicy like it supposed to be. I hope this place will continue to keep up its food\'s quality and not towards pleasing local customers by making bland food like some Indian restaurants do. Keep up the good work.</p>', '2018-10-23 17:52:21'),
(4, 'Aman Kumar', '<p>I will never stop visiting this place. It is just a hideaway for me. In the evening when the sun covers the whole room with light and warmness I enjoy my meal and think of my global plans. Everything is perfect here.</p>\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</p>', '2018-10-23 17:52:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(355) DEFAULT NULL,
  `name` varchar(355) DEFAULT NULL,
  `email` varchar(355) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `phone` varchar(355) DEFAULT NULL,
  `password` varchar(355) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `dob` varchar(355) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(355) DEFAULT NULL,
  `state` varchar(355) DEFAULT NULL,
  `zip` varchar(355) DEFAULT NULL,
  `refer_code` varchar(255) DEFAULT NULL,
  `tokenhash` text,
  `active` int(2) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `username`, `phone`, `password`, `gender`, `image`, `dob`, `address`, `country`, `state`, `zip`, `refer_code`, `tokenhash`, `active`, `created`, `modified`) VALUES
(1, 'admin', 'AdminTest', 'iamadmin@gmail.com', 'test@gmail.com', '4646546', '$2y$10$90xlzFZ28zg6I2iAW8GTX.Md/fDdS3Y6DTiZyi0CPoeRxuHFVpGxO', 'male', '1539798938noimage.png', '09/25/2018', NULL, 'United States', NULL, NULL, NULL, 'e398536d0d2be4a777a19ac7e0f68f8c', 1, '2018-09-20 20:30:00', '2018-11-12 13:36:17'),
(2, 'user', 'Parveen', 'kumar@gmail.com', 'kumar@gmail.com', NULL, '$2y$10$TqZZH6Ti5x3ejFDVpGOkS.EdgKygPBLAkunD1KzUJioZETYe2BsZW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1b1907397b51fedf5cc2303f55b22c63', 1, '2018-10-11 18:22:08', '2018-10-11 18:22:08'),
(4, 'user', 'mukesh saini', 'sainimukesh2018@gmail.com', 'sainimukesh2018@gmail.com', NULL, '$2y$10$MFZnGGIW0abKn14rk4bGueTn1t8byfITQ1vxg1StiB1OG2FmC/fbm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2a54bf8bd35600911f9e632196b155c1', 1, '2018-10-16 05:16:44', '2018-10-16 05:20:18'),
(6, 'user', 'Parveen', 'kumarparveen2007@gmail.com', 'kumarparveen2007@gmail.com', '1234567890', '$2y$10$Q3yMEWL3/m3aHeibgL4NmuqPTVJOajk/FlLdneKZR9wpMxCTrHRie', NULL, '1541856749images.jpg', NULL, '', 'India', 'haryana', '1234', NULL, ' ', 1, '2018-10-25 07:34:46', '2018-11-10 13:32:29'),
(7, 'user', 'Testing', 'msaini3211@gmail.com', 'msaini3211@gmail.com', NULL, '$2y$10$GeQmpj/guSEdydN61SX0xe2rHLLMVnTzQH4lqY6v/495/FgQvwj1m', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ' ', 1, '2018-11-12 05:46:41', '2018-11-12 05:46:41'),
(10, 'user', 'CK MISHRA', 'CKADVERTISER@GMAIL.COM', 'CKADVERTISER@GMAIL.COM', NULL, '$2y$10$OKep5Po6.VA61ntmM7k8VOBxFLF2KiYveucgsSLaCJfipf7zFNQza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8c43654e816785c10a58217a761a26f3', 0, '2018-11-15 08:39:10', '2018-11-15 08:39:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurentlocations`
--
ALTER TABLE `restaurentlocations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staticpages`
--
ALTER TABLE `staticpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `restaurentlocations`
--
ALTER TABLE `restaurentlocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `staticpages`
--
ALTER TABLE `staticpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

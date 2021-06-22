-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2020 at 01:08 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `volunteer`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lkp_country`
--

CREATE TABLE `lkp_country` (
  `id` int(11) NOT NULL,
  `country_en` varchar(255) NOT NULL,
  `country_ar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1256;

--
-- Dumping data for table `lkp_country`
--

INSERT INTO `lkp_country` (`id`, `country_en`, `country_ar`) VALUES
(1, 'Afghanistan', 'أفغانستان'),
(2, 'Albania', 'ألبانيا'),
(3, 'Algeria', 'الجزائر'),
(4, 'American Samoa', 'ساموا-الأمريكي'),
(5, 'Andorra', 'أندورا'),
(6, 'Angola', 'أنغولا'),
(7, 'Anguilla', 'أنغويلا'),
(8, 'Antarctica', 'أنتاركتيكا'),
(9, 'Antigua and Barbuda', 'أنتيغوا وبربودا'),
(10, 'Argentina', 'الأرجنتين'),
(11, 'Armenia', 'أرمينيا'),
(12, 'Aruba', 'أروبا'),
(13, 'Australia', 'أستراليا'),
(14, 'Austria', 'النمسا'),
(15, 'Azerbaijan', 'أذربيجان'),
(16, 'Bahamas', 'الباهاماس'),
(17, 'Bahrain', 'البحرين'),
(18, 'Bangladesh', 'بنغلاديش'),
(19, 'Barbados', 'بربادوس'),
(20, 'Belarus', 'روسيا البيضاء'),
(21, 'Belgium', 'بلجيكا'),
(22, 'Belize', 'بيليز'),
(23, 'Benin', 'بنين'),
(24, 'Bermuda', 'جزر برمود'),
(25, 'Bhutan', 'بوتان'),
(26, 'Bolivia', 'بوليفيا'),
(27, 'Bosnia and Herzegovina', 'البوسنة و الهرسك'),
(28, 'Botswana', 'بوتسوانا'),
(29, 'Brazil', 'البرازيل'),
(30, 'Brunei', 'بروناي'),
(31, 'Bulgaria', 'بلغاريا'),
(32, 'Burkina Faso', 'بوركينا فاسو'),
(33, 'Burundi', 'بوروندي'),
(34, 'Cambodia', 'كمبوديا'),
(35, 'Cameroon', 'كاميرون'),
(36, 'Canada', 'كندا'),
(37, 'Cape Verde', 'الرأس الأخضر'),
(38, 'Cayman Islands', 'جزر كايمان'),
(39, 'Central African Republic', 'جمهورية أفريقيا الوسطى'),
(40, 'Chad', 'تشاد'),
(41, 'Chile', 'تشيلي'),
(42, 'China', 'جمهورية الصين الشعبية'),
(43, 'Christmas Island', 'جزيرة كريسماس'),
(44, 'Cocos (Keeling) Islands', 'جزر كوكوس'),
(45, 'Colombia', 'كولومبيا'),
(46, 'Comoros', 'جزر القمر'),
(47, 'Democratic Republic', 'جمهورية الكونغو الديمقراطية'),
(48, 'Congo, Republic of (Brazzaville)', 'جمهورية الكونغو'),
(49, 'Cook Islands', 'جزر كوك'),
(50, 'Costa Rica', 'كوستاريكا'),
(51, 'Cote d\'Ivoire (Ivory Coast)', 'ساحل العاج'),
(52, 'Croatia', 'كرواتيا'),
(53, 'Cuba', 'كوبا'),
(54, 'Cyprus', 'قبرص'),
(55, 'Czech Republic', 'الجمهورية التشيكية'),
(56, 'Denmark', 'الدانمارك'),
(57, 'Djibouti', 'جيبوتي'),
(58, 'Dominica', 'دومينيكا'),
(59, 'Dominican Republic', 'الجمهورية الدومينيكية'),
(60, 'East Timor Timor-Leste', 'تيمور الشرقية'),
(61, 'Ecuador', 'إكوادور'),
(62, 'Egypt', 'مصر'),
(63, 'El Salvador', 'إلسلفادور'),
(64, 'Equatorial Guinea', 'غينيا الاستوائي'),
(65, 'Eritrea', 'إريتريا'),
(66, 'Estonia', 'استونيا'),
(67, 'Ethiopia', 'أثيوبيا'),
(68, 'Falkland Islands', 'جزر فوكلاند'),
(69, 'Faroe Islands', 'جزر فارو'),
(70, 'Fiji', 'فيجي'),
(71, 'Finland', 'فنلندا'),
(72, 'France', 'فرنسا'),
(73, 'French Guiana', 'غويانا الفرنسية'),
(74, 'French Polynesia', 'بولينيزيا الفرنسية'),
(75, 'Gabon', 'الغابون'),
(76, 'Gambia', 'غامبيا'),
(77, 'Georgia', 'جيورجيا'),
(78, 'Germany', 'ألمانيا'),
(79, 'Ghana', 'غانا'),
(80, 'Greece', 'اليونان'),
(81, 'Greenland', 'جرينلاند'),
(82, 'Grenada', 'غرينادا'),
(83, 'Guadeloupe', 'جزر جوادلوب'),
(84, 'Guam', 'جوام'),
(85, 'Guatemala', 'غواتيمال'),
(86, 'Guinea', 'غينيا'),
(87, 'Guinea-Bissau', 'غينيا-بيساو'),
(88, 'Guyana', 'غيانا'),
(89, 'Haiti', 'هايتي'),
(91, 'Honduras', 'هندوراس'),
(92, 'Hong Kong', 'هونغ كونغ'),
(93, 'Hungary', 'المجر'),
(94, 'Iceland', 'آيسلندا'),
(95, 'India', 'الهند'),
(96, 'Indonesia', 'أندونيسيا'),
(97, 'Iran (Islamic Republic of)', 'إيران'),
(98, 'Iraq', 'العراق'),
(99, 'Ireland (Republic of)', 'جمهورية أيرلندا'),
(100, 'Israel', 'إسرائيل'),
(101, 'Italy', 'إيطاليا'),
(102, 'Jamaica', 'جمايكا'),
(103, 'Japan', 'اليابان'),
(104, 'Jordan', 'الأردن'),
(105, 'Kazakhstan', 'كازاخستان'),
(106, 'Kenya', 'كينيا'),
(107, 'Kiribati', 'كيريباتي'),
(108, 'Korea, (North Korea)', 'كوريا الشمالية'),
(109, 'Korea, (South Korea)', 'كوريا الجنوبية'),
(110, 'Kuwait', 'الكويت'),
(111, 'Kyrgyzstan', 'قيرغيزستان'),
(112, 'Lao, PDR', 'لاوس'),
(113, 'Latvia', 'لاتفيا'),
(114, 'Lebanon', 'لبنان'),
(115, 'Lesotho', 'ليسوتو'),
(116, 'Liberia', 'ليبيريا'),
(117, 'Libya', 'ليبيا'),
(118, 'Liechtenstein', 'ليختنشتين'),
(119, 'Lithuania', 'لتوانيا'),
(120, 'Luxembourg', 'لوكسمبورغ'),
(121, 'Macao', 'ماكاو'),
(122, 'Macedonia, Rep. of', 'جمهورية مقدونيا'),
(123, 'Madagascar', 'مدغشقر'),
(124, 'Malawi', 'مالاوي'),
(125, 'Malaysia', 'ماليزيا'),
(126, 'Maldives', 'المالديف'),
(127, 'Mali', 'مالي'),
(128, 'Malta', 'مالطا'),
(129, 'Marshall Islands', 'جزر مارشال'),
(130, 'Martinique', 'مارتينيك'),
(131, 'Mauritania', 'موريتانيا'),
(132, 'Mauritius', 'موريشيوس'),
(133, 'Mayotte', 'جزيرة مايوت'),
(134, 'Mexico', 'المكسيك'),
(135, 'Micronesia, Federal States of', 'ولايات ميكرونيسيا المتحدة'),
(136, 'Moldova, Republic of', 'مولدافيا'),
(137, 'Monaco', 'موناكو'),
(138, 'Mongolia', 'منغوليا'),
(139, 'Montenegro', 'الجبل الأسو'),
(140, 'Montserrat', 'مونتسيرات'),
(141, 'Morocco', 'المغرب'),
(142, 'Mozambique', 'موزمبيق'),
(143, 'Myanmar, Burma', 'ميانمار'),
(144, 'Namibia', 'ناميبيا'),
(145, 'Nauru', 'ناورو'),
(146, 'Nepal', 'نيبال'),
(147, 'Netherlands', 'هولندا'),
(148, 'Netherlands Antilles', 'جزر الأنتيل الهولندي'),
(149, 'New Caledonia', 'كاليدونيا الجديدة'),
(150, 'New Zealand', 'نيوزيلندا'),
(151, 'Nicaragua', 'نيكاراجوا'),
(152, 'Niger', 'النيجر'),
(153, 'Nigeria', 'نيجيريا'),
(154, 'Niue', 'نييوي'),
(155, 'Northern Mariana Islands', 'جزر ماريانا الشمالية'),
(156, 'Norway', 'النرويج'),
(157, 'Oman', 'عُمان'),
(158, 'Pakistan', 'باكستان'),
(159, 'Palau', 'بالاو'),
(160, 'Palestinian territories', 'فلسطين'),
(161, 'Panama', 'بنما'),
(162, 'Papua New Guinea', 'بابوا غينيا الجديدة'),
(163, 'Paraguay', 'باراغواي'),
(164, 'Peru', 'بيرو'),
(165, 'Philippines', 'الفليبين'),
(166, 'Pitcairn Island', 'جزر بيتكيرن'),
(167, 'Poland', 'بولندا'),
(168, 'Portugal', 'البرتغال'),
(169, 'Puerto Rico', 'بورتوريكو'),
(170, 'Qatar', 'قطر'),
(171, 'Reunion Island', 'ريونيون'),
(172, 'Romania', 'رومانيا'),
(173, 'Russian Federation', 'روسيا'),
(174, 'Rwanda', 'رواندا'),
(175, 'Saint Kitts and Nevis', 'سانت كيتس ونيفس'),
(176, 'Saint Lucia', 'سانت لوسيا'),
(177, 'Saint Vincent and the Grenadines', 'سانت فنسنت وجزر غرينادين'),
(178, 'Samoa', 'ساموا'),
(179, 'San Marino', 'سان مارينو'),
(180, 'Sao Tome and Prيncipe', 'ساو تومي وبرينسيبي'),
(181, 'Saudi Arabia', 'المملكة العربية السعودية'),
(182, 'Senegal', 'السنغال'),
(183, 'Serbia', 'جمهورية صربيا'),
(184, 'Seychelles', 'سيشيل'),
(185, 'Sierra Leone', 'سيراليون'),
(186, 'Singapore', 'سنغافورة'),
(187, 'Slovakia (Slovak Republic)', 'سلوفاكيا'),
(188, 'Slovenia', 'سلوفينيا'),
(189, 'Solomon Islands', 'جزر سليمان'),
(190, 'Somalia', 'الصومال'),
(191, 'South Africa', 'جنوب أفريقيا'),
(192, 'South Sudan', 'جنوب السودان'),
(193, 'Spain', 'إسبانيا'),
(194, 'Sri Lanka', 'سريلانكا'),
(195, 'Sudan', 'السودان'),
(196, 'Suriname', 'سورينام'),
(197, 'Swaziland', 'سوازيلند'),
(198, 'Sweden', 'السويد'),
(199, 'Switzerland', 'سويسرا'),
(200, 'Syria, Syrian Arab Republic', 'سوريا'),
(201, 'Taiwan (Republic of China)', 'تايوان'),
(202, 'Tajikistan', 'طاجيكستان'),
(203, 'Tanzania', 'تنزانيا'),
(204, 'Thailand', 'تايلندا'),
(205, 'Tibet', 'تبت'),
(207, 'Togo', 'توغو'),
(208, 'Tokelau', 'توكيلاو'),
(209, 'Tonga', 'تونغا'),
(210, 'Trinidad and Tobago', 'ترينيداد وتوباغو'),
(211, 'Tunisia', 'تونس'),
(212, 'Turkey', 'تركيا'),
(213, 'Turkmenistan', 'تركمانستان'),
(214, 'Turks and Caicos Islands', 'جزر توركس وكايكوس'),
(215, 'Tuvalu', 'توفالو'),
(216, 'Uganda', 'أوغندا'),
(217, 'Ukraine', 'أوكرانيا'),
(218, 'United Arab Emirates', 'الإمارات العربية المتحدة'),
(219, 'United Kingdom', 'المملكة المتحدة'),
(220, 'United States', 'الولايات المتحدة'),
(221, 'Uruguay', 'أورغواي'),
(222, 'Uzbekistan', 'أوزباكستان'),
(223, 'Vanuatu', 'فانواتو'),
(224, 'Vatican City State', 'دولة مدينة الفاتيكان'),
(225, 'Venezuela', 'فنزويلا'),
(226, 'Vietnam', 'فيتنام'),
(227, 'Virgin Islands (British)', 'الجزر العذراء البريطانية'),
(228, 'Virgin Islands (U.S.)', 'الجزر العذراء الأمريكي'),
(229, 'Wallis and', 'والس وفوتونا'),
(230, 'Futuna Islands', 'جزيرة فوتونا'),
(231, 'Western Sahara', 'الصحراء الغربية'),
(232, 'Yemen', 'اليمن'),
(233, 'Zambia', 'زامبيا'),
(234, 'Zimbabwe', 'زمبابوي');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `user_id`, `name`, `email`, `phone`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'fahad', 'usman@arco.com', '96656525252', 'New Customer To Fiverr', 'sadsasdsad', '2020-12-10 10:24:53', '2020-12-10 10:24:53');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `opportunities`
--

CREATE TABLE `opportunities` (
  `id` int(11) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `volunteering_field_id` int(11) NOT NULL,
  `city` varchar(50) NOT NULL DEFAULT 'Riyadh',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `opportunities`
--

INSERT INTO `opportunities` (`id`, `organization_id`, `title`, `description`, `start_date`, `end_date`, `volunteering_field_id`, `city`, `created_at`, `updated_at`) VALUES
(40, 13, 'Refugee Camp  ', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 2, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(41, 11, 'say auh us', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 2, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(42, 1, 'sas has ua', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 2, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(43, 7, 'asdh hsuhas', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 2, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(44, 13, 'koksoa hsuahu', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 1, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(45, 5, 'Doctorate PHD.', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 2, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(46, 4, 'ui shasu', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 2, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(47, 2, 'iioiop asjd', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 2, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(48, 7, 'kskjjsh shsb', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 2, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(49, 11, 'bjbhs siajdis', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 1, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(50, 6, 'iujuh hgghyh', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 1, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(51, 5, 'ABCD EFGH', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 1, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04'),
(52, 15, 'ABC ABC', 'The COVID-19 pandemic has only made things worse. While UNHCR strives to protect refugees amid the pandemic and ensure their inclusion in national responses.', '2020-12-01', '2020-12-31', 1, 'Riyadh', '2020-12-10 10:16:04', '2020-12-10 10:16:04');

-- --------------------------------------------------------

--
-- Table structure for table `organizations`
--

CREATE TABLE `organizations` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT 'arco@arco.com',
  `contact` varchar(20) NOT NULL DEFAULT '999666222',
  `banner` varchar(100) NOT NULL DEFAULT 'dummy.png',
  `logo` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `email`, `contact`, `banner`, `logo`, `created_at`, `updated`) VALUES
(1, 'Arab Red Crescent Saudi ', 'arco@arco.com', '999666222', 'dummy.png', 'Alsaudi.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(2, 'Arab Red Crescent Algerian', 'arco@arco.com', '999666222', 'dummy.png', 'Algerian.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(3, 'Arab Red Crescent DJIBOUTI', 'arco@arco.com', '999666222', 'dummy.png', 'DJIBOUTI.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(4, 'Arab Red Crescent Emirates', 'arco@arco.com', '999666222', 'dummy.png', 'Emirates.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(5, 'Arab Red Crescent IRAQI', 'arco@arco.com', '999666222', 'dummy.png', 'IRAQI.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(6, 'Arab Red Crescent JORDAN', 'arco@arco.com', '999666222', 'dummy.png', 'JORDAN.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(7, 'Arab Red Crescent Libanaise', 'arco@arco.com', '999666222', 'dummy.png', 'Libanaise.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(8, 'Arab Red Crescent LIBYAN', 'arco@arco.com', '999666222', 'dummy.png', 'LIBYAN.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(9, 'Arab Red Crescent Morocain', 'arco@arco.com', '999666222', 'dummy.png', 'Morocain.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(10, 'Arab Red Crescent Palestine', 'arco@arco.com', '999666222', 'dummy.png', 'Palestn.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(11, 'Arab Red Crescent Syrian', 'arco@arco.com', '999666222', 'dummy.png', 'Syrian.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(12, 'Arab Red Crescent TUNISA', 'arco@arco.com', '999666222', 'dummy.png', 'TUNISA.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(13, 'Arab Red Crescent Kuwait', 'arco@arco.com', '999666222', 'dummy.png', 'Kuwait.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(14, 'Arab Red Crescent Qatar', 'arco@arco.com', '999666222', 'dummy.png', 'Qatar.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26'),
(15, 'Arab Red Crescent Yemen', 'arco@arco.com', '999666222', 'dummy.png', 'Yemen.png', '2020-12-10 10:05:26', '2020-12-10 10:05:26');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Super Admin'),
(2, 'Admin'),
(3, 'volunteer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality_id` int(11) DEFAULT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qualification` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volunteer_field_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `person_picture` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_picture` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `passport_picture` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cv` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `nationality_id`, `contact_number`, `qualification`, `address`, `city`, `volunteer_field_id`, `role_id`, `email_verified_at`, `password`, `remember_token`, `person_picture`, `id_picture`, `passport_picture`, `cv`, `created_at`, `updated_at`) VALUES
(1, 'Rana Muhammad usman Abbas ', 'usman@arco.com', NULL, NULL, '', '', '', NULL, NULL, NULL, '$2y$10$TdVG1mZLqvS9oMXpZaWGgOgyeUgatYNRY/cH4Vpo2v3Cx18/fGr0W', NULL, NULL, NULL, NULL, NULL, '2020-12-09 03:14:34', '2020-12-09 03:14:34'),
(2, 'fahad', 'fahad@arco.com', 1, '0570688138', 'BSCS', 'dhirah,KSA', 'Riyadh', 1, 3, NULL, '$2y$10$F2FwaoNumVBt0Mse342Sa.c4tuO4Lilmt5p4s3gSKnZ2yq6iKb61e', NULL, NULL, NULL, NULL, NULL, '2020-12-09 04:39:36', '2020-12-09 04:39:36');

-- --------------------------------------------------------

--
-- Table structure for table `volunteering_fields`
--

CREATE TABLE `volunteering_fields` (
  `id` int(11) NOT NULL,
  `field_en` varchar(100) NOT NULL,
  `field_ar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `volunteering_fields`
--

INSERT INTO `volunteering_fields` (`id`, `field_en`, `field_ar`) VALUES
(1, 'Health of Children', 'Health of Children'),
(2, 'Education of Children', 'Education of Children');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lkp_country`
--
ALTER TABLE `lkp_country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `COUNTRY_EN` (`country_en`),
  ADD UNIQUE KEY `COUNTRY_AR` (`country_ar`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opportunities`
--
ALTER TABLE `opportunities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `organization_id` (`organization_id`),
  ADD KEY `volunteering_field_id` (`volunteering_field_id`);

--
-- Indexes for table `organizations`
--
ALTER TABLE `organizations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `nationality_id` (`nationality_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `volunteer_field_id` (`volunteer_field_id`);

--
-- Indexes for table `volunteering_fields`
--
ALTER TABLE `volunteering_fields`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lkp_country`
--
ALTER TABLE `lkp_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `opportunities`
--
ALTER TABLE `opportunities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `organizations`
--
ALTER TABLE `organizations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `volunteering_fields`
--
ALTER TABLE `volunteering_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `opportunities`
--
ALTER TABLE `opportunities`
  ADD CONSTRAINT `opportunities_ibfk_1` FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`),
  ADD CONSTRAINT `opportunities_ibfk_2` FOREIGN KEY (`volunteering_field_id`) REFERENCES `volunteering_fields` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`nationality_id`) REFERENCES `lkp_country` (`id`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`volunteer_field_id`) REFERENCES `volunteering_fields` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2022 at 02:41 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bhorer_kagoj`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `inside_dhaka_city` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`address_id`, `name`, `mobile`, `division`, `district`, `address`, `inside_dhaka_city`, `created_at`, `updated_at`) VALUES
(1, 'test', '125454q', 'dhaka', 'dkhaka', 'test address', 1, NULL, NULL),
(2, 'test 2', '48456454', 'comilla', 'comilla', 'sadfafsaf', 0, NULL, NULL),
(5, 'asd', '11111111111', 'asd', 'asd', 'asd', 1, '2022-01-06 13:00:36', '2022-01-06 13:00:36'),
(17, 'user 2', '11111111112', 'ghi', 'jkl', 'address 2', 1, '2022-01-07 12:29:32', '2022-01-07 12:32:45');

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `name`, `description`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'সালেক নাছির উদ্দিন', 'জন্ম ৩ জানুয়ারি, চট্টগ্রাম। সংবাদের মাধ্যমে সাংবাদিকতার হাতেখড়ি। বর্তমানে দৈনিক ভোরের কাগজে সাহিত্য ও সম্পাদকীয় বিভাগে কর্মরত। এছাড়া সাহিত্য ও সংস্কৃতিবিষয়ক কাগজ সমধারা সম্পাদনা করছেন। ঢাকা বিশ্ববিদ্যালয়কেন্দ্রিক আবৃত্তি সংগঠন ‘সুবচন’র প্রধান সমন্বয়ক। সুবিধাবঞ্চিত শিশুদের স্কুল পড়াঘর-এর উদ্যোক্তা। ‘গৌরব ৫২’ তাঁর প্রথম মৌলিক গ্রন্থ। প্রকাশিত হয়েছে ২টি কবিতার বই। রয়েছে তার ১৬টি সম্পাদিত সংকলন।', 'authors/1720380332799925.png', '2021-12-21 03:27:57', '2021-12-28 04:20:29'),
(4, 'মজিদ মাহমুদ', 'জন্ম ১৬ এপ্রিল, ১৯৬৬, পাবনা, বাংলাদেশ। ঢাকা বিশ্ববিদ্যালয় থেকে বাংলা সাহিত্যে প্রথম শ্রেণীতে স্নাতকোত্তর। কবিতা তাঁর নিজস্ব ভুবন হলেও মননশীল গবেষণা-কর্মে খ্যাতি রয়েছে। নজরুল ইনস্টিটিউট, বিশ্ববিদ্যালয় মঞ্জুরি কমিশনের গবেষণা বৃত্তির অধীনে তিনি কাজ করেছেন। সাংবাদিকতা তাঁর মূল পেশা হলেও কলেজ বিশ্ববিদ্যালয়ে শিক্ষকতার অভিজ্ঞতা রয়েছে। ওসাকা নামের একটি বেসরকারি সংস্থার প্রতিষ্ঠাতা তিনি। তাঁর প্রথম গ্রন্থ প্রকাশিত হয় ১৯৮৫ সালে। এ যাবৎ প্রকাশিত গ্রন্থসংখ্যা ৩২। উল্লেখযোগ্য গ্রন্থ : কবিতা : মাহফুজামঙ্গল, গোষ্ঠের দিকে বল উপাখ্যান, আপেল কাহিনী, ধাত্রী-ক্লিনিকের জন্ম, সিংহ ও গর্দভের কবিতা, দেওয়ান-ই-মজিদ। প্রবন্ধ গবেষণা : নজরুল তৃতীয় বিশ্বের মুখপাত্র, নজরুলের মানুষধর্ম, কেন কবি কেন কবি নয়, ভাষার আধিপত্য, উত্তর-উপনিবেশ সাহিত্য, রবীন্দ্রনাথের ভ্রমণ সাহিত্য, রবীন্দ্রনাথ ও ভারতবর্ষ, সাহত্যিচিন্তা ও বিকল্পভাবনা।', 'authors/1720380325235144.png', '2021-12-26 01:50:09', '2021-12-28 04:20:05'),
(5, 'শ্যামল দত্ত', 'শ্যামল দত্ত। জন্ম ৫ ফেব্রুয়ারি, চট্টগ্রামে। তিন দশকেরও বেশি সময় ধরে যুক্ত আছেন সাংবাদিকতার সঙ্গে। তিনি একজন লেখক, সংগঠক ও গণমাধ্যম ব্যক্তিত্ব। মুক্তিযুদ্ধের চেতনার সপক্ষের মুখপত্র দৈনিক ভোরের কাগজের সম্পাদক হিসেবে দায়িত্ব পালন করছেন ২০০৫ সাল থেকে। তিনি আন্তর্জাতিক গণমাধ্যম সংগঠন কমনওয়েলথ জার্নালিস্ট এসোসিয়েশনের (সিজেএ) ভাইস প্রেসিডেন্ট, প্রেস ইনস্টিটিউট অব বাংলাদেশের (পিআইবি) পরিচালনা বোর্ডের সদস্য, চট্টগ্রাম সিটি কর্পোরেশনের উপদেষ্টা, জাতীয় প্রেস ক্লাবের সাবেক কোষাধ্যক্ষ ও বাংলাদেশ সংবাদ সংস্থার সাবেক পরিচালক।', 'authors/1720380293985603.png', '2021-12-26 01:50:18', '2021-12-28 03:08:20'),
(7, 'আন্দালিব রাশদী', 'জন্ম ৩১ ডিসেম্বর ১৯৫৭, ঢাকায়। বেড়ে ওঠা ও জীবনযাপন। এখানেই। কথাসাহিত্যিক, প্রাবন্ধিক, অনুবাদক। পড়াশোনা ঢাকা, ওয়েলস ও লন্ডনে। শুরুতে বিজ্ঞানের ছাত্র ছিলেন। আন্দালিব রাশদী কথাসাহিত্যিক। প্ৰবন্ধ লিখেন, অনুবাদও করেন। জন্ম ঢাকায়, বেড়ে ওঠা এবং জীবনযাপন এখানেই। পড়াশোনা ঢাকা, ওয়েলশ ও লন্ডনে। শুরুতে বিজ্ঞানের ছাত্র। আইনে স্নাতক, রাষ্ট্রবিজ্ঞান ও অর্থনীতিতে স্নাতকোত্তর। ১৯৯৬ সালে লন্ডনে পিএইচডি করেছেন। আন্দালিব রাশদীর উপন্যাস: কাজল নদীর জলে, হাজব্যান্ডস, পপির শহর, ঝুম্পানামা, অধরা, জলি ফুপু, ম্যাজিশিয়ান, ভারপ্রাপ্ত সচিব, প্রতিমন্ত্রী, কাকাতুয়া বোনেরা, সূচনা ও সুস্মিতা, ট্যারা নভেরা, লুবনা ও কোকিলা, ডোনাট পিলো, কঙ্কাবতীর থার্ডফ্লোর, শিমুর ভোরবেলা, বুবনা। ছােটগল্প : শিমুর বিয়ের গল্প, হুমায়ুন, আন্দালিব রাশদীর বাছাই গল্প, ডায়ানা যেদিন সিঁড়িতে বমি করল, পরিত্যক্ত কেলভিনেটর ফ্রিজের গল্প । প্ৰবন্ধ/অনুবাদ ; আমলা শাসানো হুকুমনামা, ইডিপাস কমপ্লেক্স, লেডি গোদিভা ও অন্যান্য প্রবন্ধ, তলস্তয়, রেশমা ও রাধিকা, মুন্নিবাই ও এককুড়ি দক্ষিণ এশীয় গল্প, কুমারী, ভাইস চ্যান্সেলর ও অন্যান্য গল্প, খুশবন্ত সিং-১, খুশবন্ত সিং-২। কিশোর সাহিত্য : কোব্বাদ ফ্রায়েড চিকেন, সিক্কাটুলি থেকে ভূতের গলি, ভূত ধরতে সুপার গ্রু, ভূতশুমারি, সিন্দাবাদ (অনুবাদ), রবিনসন ক্রুসো (অনুবাদ), পলিয়ানা (অনুবাদ), ট্যারা মাখনার নোবেল প্ৰাইজ।', 'authors/1720380317392912.png', '2021-12-27 04:24:17', '2021-12-28 04:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `publication_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isbn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `backside_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_preview` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `regular_price` double NOT NULL,
  `discounted_price` double NOT NULL,
  `discounted_percentage` double NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `publication_id`, `title`, `isbn`, `cover_image`, `backside_image`, `book_preview`, `short_description`, `long_description`, `regular_price`, `discounted_price`, `discounted_percentage`, `is_available`, `is_visible`, `created_at`, `updated_at`) VALUES
(33, 11, 'পিতা', 'ESBN-003', 'books/1720208293774513.png', 'books/1720382633398188.png', 'books/1720194754173031.pdf', 'রাজনীতি ও রাজনীতিবিদ বিষয়ক প্রবন্ধ', 'মানবাধিকার অসাধারণ একটি অধিকার, যা প্রত্যেক মানুষের প্রাপ্য। কিন্তু আমরা এর বহু লঙ্ঘন দেখতে পাই। এই লঙ্ঘন ঠেকাতে হলে প্রথমে বুঝতে হবে, মানবাধিকার আসলে কী। জানতে হবে মানবাধিকার লঙ্ঘিত হলে কী করতে হবে বা দেশে প্রতিকার না পেলে আন্তর্জাতিকভাবে এর প্রতিকার পাওয়ার সুযোগ কোথায় আছে।', 200, 180, 10, 1, 1, '2021-12-26 01:59:16', '2021-12-28 03:56:59'),
(34, 12, 'সেরা দশ উপন্যাস', 'ISBN-002', 'books/1720208378275952.png', 'books/1720383331910086.png', 'books/1720194851586040.pdf', 'test', 'test', 200, 180, 10, 1, 1, '2021-12-26 02:00:49', '2021-12-28 03:56:38'),
(37, 11, 'সেরা লেখক সেরা গল্প', 'ISBN-001', 'books/1720276320530481.png', 'books/1720383002526473.png', 'books/1720276320946214.pdf', 'মানবাধিকার অসাধারণ একটি অধিকার, যা প্রত্যেক মানুষের প্রাপ্য।', 'মানবাধিকার অসাধারণ একটি অধিকার, যা প্রত্যেক মানুষের প্রাপ্য। কিন্তু আমরা এর বহু লঙ্ঘন দেখতে পাই। এই লঙ্ঘন ঠেকাতে হলে প্রথমে বুঝতে হবে, মানবাধিকার আসলে কী। জানতে হবে মানবাধিকার লঙ্ঘিত হলে কী করতে হবে বা দেশে প্রতিকার না পেলে আন্তর্জাতিকভাবে এর প্রতিকার পাওয়ার সুযোগ কোথায় আছে।', 200, 180, 10, 1, 1, '2021-12-26 23:35:44', '2021-12-28 03:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `book_authors`
--

CREATE TABLE `book_authors` (
  `book_author_id` bigint(20) UNSIGNED NOT NULL,
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_authors`
--

INSERT INTO `book_authors` (`book_author_id`, `author_id`, `book_id`, `created_at`, `updated_at`) VALUES
(30, 5, 33, '2021-12-26 01:59:16', '2021-12-26 01:59:16'),
(31, 5, 34, '2021-12-26 02:00:49', '2021-12-26 02:00:49'),
(37, 5, 37, '2021-12-26 23:35:44', '2021-12-26 23:35:44'),
(38, 1, 37, '2021-12-26 23:35:44', '2021-12-26 23:35:44'),
(39, 1, 33, '2021-12-28 03:45:33', '2021-12-28 03:45:33'),
(40, 1, 34, '2021-12-28 03:56:38', '2021-12-28 03:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

CREATE TABLE `book_categories` (
  `book_category_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`book_category_id`, `category_id`, `book_id`, `created_at`, `updated_at`) VALUES
(56, 6, 34, '2021-12-26 02:37:49', '2021-12-26 02:37:49'),
(61, 7, 33, '2021-12-28 03:45:33', '2021-12-28 03:45:33'),
(62, 4, 37, '2021-12-28 03:51:24', '2021-12-28 03:51:24');

-- --------------------------------------------------------

--
-- Table structure for table `book_feature_attributes`
--

CREATE TABLE `book_feature_attributes` (
  `book_feature_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `feature_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_feature_attributes`
--

INSERT INTO `book_feature_attributes` (`book_feature_attribute_id`, `feature_attribute_id`, `book_id`, `value`, `created_at`, `updated_at`) VALUES
(54, 6, 33, 'বাংলাদেশ', '2021-12-26 01:59:16', '2021-12-28 03:56:59'),
(60, 7, 34, '542', '2021-12-26 03:11:41', '2021-12-28 03:56:38'),
(64, 6, 37, 'বাংলাদেশ', '2021-12-26 23:35:44', '2021-12-28 03:51:24'),
(65, 8, 37, '1st Published, 2020', '2021-12-27 04:47:44', '2021-12-28 03:51:24'),
(66, 9, 37, 'বাংলা', '2021-12-27 04:47:44', '2021-12-28 03:51:24'),
(67, 8, 33, '1st Published, 2021', '2021-12-28 03:45:33', '2021-12-28 03:56:59'),
(68, 9, 33, 'বাংলা', '2021-12-28 03:45:33', '2021-12-28 03:56:59'),
(69, 7, 33, '256', '2021-12-28 03:45:33', '2021-12-28 03:56:59'),
(70, 7, 37, '415', '2021-12-28 03:51:24', '2021-12-28 03:51:24'),
(71, 6, 34, 'বাংলাদেশ', '2021-12-28 03:56:38', '2021-12-28 03:56:38'),
(72, 8, 34, '1st Published, 2021', '2021-12-28 03:56:38', '2021-12-28 03:56:38'),
(73, 9, 34, 'বাংলা', '2021-12-28 03:56:38', '2021-12-28 03:56:38');

-- --------------------------------------------------------

--
-- Table structure for table `book_reviews`
--

CREATE TABLE `book_reviews` (
  `book_review_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_reviews`
--

INSERT INTO `book_reviews` (`book_review_id`, `book_id`, `user_id`, `review`, `rating`, `created_at`, `updated_at`) VALUES
(1, 33, 4, 'test', 3, '2021-12-21 05:36:44', NULL),
(2, 34, 1, 'hello', 4, '2022-01-03 05:36:44', NULL),
(3, 33, 3, 'review', 5, '2022-01-08 05:44:01', NULL),
(4, 34, 1, 'asdasd', 2, NULL, NULL),
(5, 33, 1, 'asdasdas', 4.3, '2022-01-02 07:24:02', '2022-01-02 07:24:02'),
(6, 33, 1, 'sadas', 3.6, '2022-01-02 07:27:30', '2022-01-02 07:27:30'),
(7, 33, 1, 'sadas', 3.6, '2022-01-02 07:28:03', '2022-01-02 07:28:03'),
(8, 33, 1, 'sadas', 3.6, '2022-01-02 07:29:14', '2022-01-02 07:29:14'),
(9, 33, 1, 'asdasdasd', 2.4, '2022-01-02 07:35:21', '2022-01-02 07:35:21'),
(10, 33, 1, 'aasdasd', 4.4, '2022-01-02 07:36:24', '2022-01-02 07:36:24'),
(11, 33, 1, 'asdasdasd', 3.5, '2022-01-02 07:37:37', '2022-01-02 07:37:37'),
(12, 33, 1, 'ewewewewewewewewewewewew', 3.4, '2022-01-02 07:39:14', '2022-01-02 07:39:14'),
(13, 33, 1, 'asfawfasf', 3.8, '2022-01-02 07:40:05', '2022-01-02 07:40:05'),
(14, 34, 4, 'sadasd', 2.6, '2022-01-02 11:09:30', '2022-01-02 11:09:30'),
(15, 34, 4, 'asdasdasd', 3.6, '2022-01-02 11:10:52', '2022-01-02 11:10:52'),
(16, 34, 4, 'adwdwd', 4.8, '2022-01-02 11:11:10', '2022-01-02 11:11:10'),
(17, 37, 4, 'New Review', 3.4, '2022-01-02 11:14:51', '2022-01-02 11:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home` tinyint(1) NOT NULL DEFAULT 0,
  `is_nav` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `is_home`, `is_nav`, `created_at`, `updated_at`, `photo`) VALUES
(4, 'গল্পগ্রন্থ', 'গল্পগ্রন্থ', 1, 1, '2021-12-19 05:32:50', '2021-12-27 04:10:32', 'categories/1720293610174713.png'),
(5, 'সংকলন', 'সংকলন', 1, 1, '2021-12-19 05:50:24', '2021-12-27 04:10:22', 'categories/1720293599090728.png'),
(6, 'উপন্যাস', 'উপন্যাস', 1, 1, '2021-12-19 05:53:40', '2021-12-27 04:09:50', 'categories/1720293565912362.png'),
(7, 'প্রবন্ধ', 'প্রবন্ধ', 1, 1, '2021-12-20 04:05:21', '2021-12-27 04:09:44', 'categories/1720293559357108.png'),
(8, 'কবিতা', 'কবিতা', 1, 1, '2021-12-20 04:05:47', '2021-12-27 04:09:36', 'categories/1720293551308844.png'),
(13, 'সমকালীন উপন্যাস', 'সমকালীন উপন্যাস', 0, 0, '2021-12-28 04:22:39', '2021-12-28 04:22:39', 'categories/1720384968940779.png'),
(14, 'অনুবাদ গল্প', 'অনুবাদ গল্প', 0, 0, '2021-12-28 04:23:27', '2021-12-28 04:23:27', 'categories/1720385019699482.png'),
(15, 'রোমান্টিক উপন্যাস', 'রোমান্টিক উপন্যাস', 0, 0, '2021-12-28 04:23:57', '2021-12-28 04:23:57', 'categories/1720385051192415.png'),
(16, 'শিশু-কিশোর উপন্যাস', 'শিশু-কিশোর উপন্যাস', 0, 0, '2021-12-28 04:25:10', '2021-12-28 04:25:10', 'categories/1720385126959020.png'),
(17, 'বঙ্গবন্ধু শেখ মুজিবুর রহমান', 'বঙ্গবন্ধু শেখ মুজিবুর রহমান', 0, 0, '2021-12-28 04:25:47', '2021-12-28 04:25:47', 'categories/1720385166187934.png'),
(18, 'বিবিধ বিষয়ক প্রবন্ধ', 'বিবিধ বিষয়ক প্রবন্ধ', 0, 0, '2021-12-28 04:26:30', '2021-12-28 04:26:30', 'categories/1720385211140013.png');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pabx` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bcash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_attributes`
--

CREATE TABLE `feature_attributes` (
  `feature_attribute_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `feature_attributes`
--

INSERT INTO `feature_attributes` (`feature_attribute_id`, `name`, `created_at`, `updated_at`) VALUES
(6, 'Country', '2021-12-20 06:00:13', '2021-12-27 04:48:18'),
(7, 'Number of Pages', '2021-12-20 06:00:21', '2021-12-27 04:48:11'),
(8, 'Edition', '2021-12-20 06:00:27', '2021-12-20 06:00:27'),
(9, 'Language', '2021-12-20 06:00:36', '2021-12-20 06:00:36');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_12_19_085627_create_categories_table', 2),
(5, '2021_12_20_105349_create_feature_attributes_table', 3),
(6, '2021_12_21_050110_create_publications_table', 4),
(7, '2021_12_21_091229_create_authors_table', 5),
(8, '2021_12_21_104428_create_books_table', 6),
(9, '2021_12_21_110417_create_book_authors_table', 7),
(10, '2021_12_21_110644_create_book_feature_attributes_table', 8),
(12, '2021_12_22_092522_create_book_categories_table', 9),
(14, '2021_12_22_095347_create_book_feature_attributes_table', 10),
(15, '2021_12_24_165732_create_sliders_table', 11),
(16, '2021_12_24_180753_create_social_media_table', 11),
(17, '2021_12_24_190416_create_contacts_table', 11),
(18, '2021_12_27_095400_add_photo_to_categories_table', 12),
(21, '2014_10_12_000000_create_users_table', 13),
(24, '2022_01_02_112859_create_book_reviews_table', 14),
(25, '2022_01_02_143449_create_whislists_table', 15),
(27, '2022_01_03_152811_create_order_statuses_table', 16),
(28, '2022_01_03_161741_create_payments_table', 17),
(29, '2022_01_03_162102_create_orders_table', 18),
(30, '2022_01_03_164907_create_order_books_table', 18),
(31, '2022_01_04_120717_create_addresses_table', 19),
(32, '2022_01_04_120848_create_user_addresses_table', 19),
(33, '2022_01_04_160014_add_district_to_orders_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_status_id` bigint(20) UNSIGNED NOT NULL,
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` double NOT NULL,
  `subtotal` double NOT NULL,
  `delivery_fee` double NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `inside_dhaka_city` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `payment_id`, `user_id`, `order_status_id`, `id`, `total`, `subtotal`, `delivery_fee`, `name`, `mobile`, `division`, `address`, `inside_dhaka_city`, `created_at`, `updated_at`, `district`) VALUES
(1, 1, 3, 3, '#1234', 1250, 1200, 50, 'teswt', '01684554', 'dhaka', 'asdasdasd', 1, NULL, NULL, NULL),
(2, 1, 1, 1, '2', 1560, 1500, 60, 'asdsa', 'dsd', 'sdasd', 'sdasd', 0, '2022-01-01 10:01:41', NULL, NULL),
(3, 1, 9, 4, '334', 2000, 1860, 140, 'asdasd', 'asdasd', 'asdasd', 'asdasd', 1, NULL, NULL, NULL),
(4, 1, 1, 3, 'sad', 1600, 1560, 40, 'asdasd', 'asfasf', 'safas', 'sdas', 0, '2022-01-04 10:01:41', NULL, NULL),
(5, 1, 9, 1, '31254', 1140, 1080, 60, 'test', '12545434343', 'dhaka', 'test address', 0, '2022-01-04 10:01:41', '2022-01-04 10:01:41', 'dkhaka'),
(6, 1, 9, 1, '1', 1140, 1080, 60, 'test', '12545434343', 'dhaka', 'test address', 0, '2022-01-04 10:02:26', '2022-01-04 10:02:26', 'dkhaka'),
(7, 1, 9, 1, '1', 1140, 1080, 60, 'test', '12545454545', 'dhaka', 'test address', 0, '2022-01-04 10:17:34', '2022-01-04 10:17:34', 'dkhaka'),
(8, 1, 9, 1, '1', 1140, 1080, 60, 'test', '12545445454', 'dhaka', 'test address', 0, '2022-01-04 10:20:23', '2022-01-04 10:20:23', 'dkhaka'),
(9, 1, 9, 1, '1', 1140, 1080, 60, 'test', '23434343434', 'dhaka', 'test address', 0, '2022-01-04 10:20:45', '2022-01-04 10:20:45', 'dkhaka'),
(10, 1, 9, 1, '1', 1140, 1080, 60, 'test', '32432423423', 'dhaka', 'test address', 0, '2022-01-04 10:21:45', '2022-01-04 10:21:45', 'dkhaka'),
(11, 1, 9, 1, '1', 1140, 1080, 60, 'test', '12545434343', 'dhaka', 'test address', 0, '2022-01-04 10:22:09', '2022-01-04 10:22:09', 'dkhaka'),
(12, 1, 9, 1, '1', 240, 180, 60, 'test', '12545412365', 'dhaka', 'test address', 0, '2022-01-04 10:23:19', '2022-01-04 10:23:19', 'dkhaka'),
(13, 1, 12, 1, '1', 240, 180, 60, 'test', '12545455551', 'dhaka', 'test address', 0, '2022-01-04 10:26:17', '2022-01-04 10:26:17', 'dkhaka'),
(14, 1, 12, 4, '1', 960, 900, 60, 'sad', '11111111111', 'asdasd', 'asdad', 0, '2022-01-06 10:33:37', '2022-01-06 10:33:37', 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `order_books`
--

CREATE TABLE `order_books` (
  `order_book_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_books`
--

INSERT INTO `order_books` (`order_book_id`, `order_id`, `book_id`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(1, 2, 34, 2, 1000, NULL, NULL),
(2, 1, 37, 3, 1500, NULL, NULL),
(3, 3, 33, 5, 1000, NULL, NULL),
(4, 4, 37, 3, 410, NULL, NULL),
(5, 4, 33, 2, 150, NULL, NULL),
(6, 1, 34, 3, 520, NULL, NULL),
(7, 7, 34, 3, 540, '2022-01-04 10:17:34', '2022-01-04 10:17:34'),
(8, 7, 37, 2, 360, '2022-01-04 10:17:34', '2022-01-04 10:17:34'),
(9, 7, 33, 1, 180, '2022-01-04 10:17:34', '2022-01-04 10:17:34'),
(10, 8, 34, 3, 540, '2022-01-04 10:20:23', '2022-01-04 10:20:23'),
(11, 8, 37, 2, 360, '2022-01-04 10:20:23', '2022-01-04 10:20:23'),
(12, 8, 33, 1, 180, '2022-01-04 10:20:23', '2022-01-04 10:20:23'),
(13, 9, 34, 3, 540, '2022-01-04 10:20:45', '2022-01-04 10:20:45'),
(14, 9, 37, 2, 360, '2022-01-04 10:20:45', '2022-01-04 10:20:45'),
(15, 9, 33, 1, 180, '2022-01-04 10:20:45', '2022-01-04 10:20:45'),
(16, 10, 34, 3, 540, '2022-01-04 10:21:45', '2022-01-04 10:21:45'),
(17, 10, 37, 2, 360, '2022-01-04 10:21:45', '2022-01-04 10:21:45'),
(18, 10, 33, 1, 180, '2022-01-04 10:21:45', '2022-01-04 10:21:45'),
(19, 11, 34, 3, 540, '2022-01-04 10:22:09', '2022-01-04 10:22:09'),
(20, 11, 37, 2, 360, '2022-01-04 10:22:09', '2022-01-04 10:22:09'),
(21, 11, 33, 1, 180, '2022-01-04 10:22:10', '2022-01-04 10:22:10'),
(22, 12, 34, 1, 180, '2022-01-04 10:23:19', '2022-01-04 10:23:19'),
(23, 13, 37, 1, 180, '2022-01-04 10:26:17', '2022-01-04 10:26:17'),
(24, 14, 37, 5, 900, '2022-01-06 10:33:37', '2022-01-06 10:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_statuses`
--

CREATE TABLE `order_statuses` (
  `order_status_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_statuses`
--

INSERT INTO `order_statuses` (`order_status_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Preparing', NULL, NULL),
(2, 'Delivering', NULL, NULL),
(3, 'Completed', NULL, NULL),
(4, 'Cancelled', NULL, NULL);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_method`, `payment_status`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 'cash on delivery', 'paid', '5451321451', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `publication_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publications`
--

INSERT INTO `publications` (`publication_id`, `name`, `description`, `photo`, `created_at`, `updated_at`) VALUES
(11, 'বিশ্বসাহিত্য কেন্দ্র', 'বিশ্বসাহিত্য কেন্দ্র', 'publications/1720383560921651.jpg', '2021-12-21 02:50:54', '2021-12-28 04:00:16'),
(12, 'ভোরের কাগজ প্রকাশন', 'ভোরের কাগজ প্রকাশন', 'publications/1720383476681104.png', '2021-12-26 01:48:10', '2021-12-28 03:58:56'),
(13, 'বেঙ্গল পাবলিকেশন্‌স', 'বেঙ্গল পাবলিকেশন্‌স', 'publications/1720385356974906.png', '2021-12-28 04:28:49', '2021-12-28 04:28:49'),
(14, 'বাংলাপ্রকাশ', 'বাংলাপ্রকাশ', 'publications/1720385497265385.png', '2021-12-28 04:31:03', '2021-12-28 04:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precedence` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `description`, `image`, `precedence`, `created_at`, `updated_at`) VALUES
(7, 'slider 1', 'slider 1', 'sliders/1720384351429461.png', 1, '2021-12-28 04:12:51', '2021-12-28 04:13:00'),
(8, 'slider 2', 'slider 2', 'sliders/1720384418314344.png', 2, '2021-12-28 04:13:55', '2021-12-28 04:13:55'),
(9, 'slider 3', 'slider 3', 'sliders/1720384445591170.png', 3, '2021-12-28 04:14:21', '2021-12-28 04:14:21'),
(10, 'slider 4', 'slider 4', 'sliders/1720384474133448.png', 4, '2021-12-28 04:14:48', '2021-12-28 04:14:48');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `name`, `logo`, `url`, `created_at`, `updated_at`) VALUES
(1, 'whatsapp', 'social_medias/1720386576598323.jpg', 'https://web.whatsapp.com/', '2021-12-26 00:12:42', '2021-12-28 04:48:12'),
(2, 'Facebook', 'social_medias/1720386886503303.png', 'https://www.facebook.com/', '2021-12-28 04:53:07', '2021-12-28 04:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alternative_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `phone`, `otp_code`, `alternative_phone`, `sex`, `date_of_birth`, `image`, `address`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@email.com', NULL, '$2y$10$gzXD6S/zEhSaTAvc5PIPjeVwHSw4C89oyEu9Q04Q5E1jwoHCng2Wu', NULL, NULL, '416273', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2021-12-30 04:28:36'),
(2, NULL, NULL, NULL, NULL, NULL, 'asdas', 'asdasd', NULL, NULL, NULL, NULL, NULL, 0, '2021-12-30 04:05:37', '2021-12-30 04:05:37'),
(3, NULL, NULL, NULL, NULL, NULL, '12', 'asdasdasd', NULL, NULL, NULL, NULL, NULL, 0, '2021-12-30 04:06:10', '2021-12-30 04:06:54'),
(4, NULL, NULL, NULL, NULL, NULL, '01671165460', NULL, NULL, NULL, NULL, 'customer/avatar/1720909785826548.png', NULL, 0, '2021-12-30 04:07:25', '2022-01-04 04:45:15'),
(9, 'Ismail Hossain', 'testant9@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-01-03 06:56:36', '2022-01-03 06:56:36'),
(10, NULL, NULL, NULL, NULL, NULL, 'ismail@gmail.com', '298946', NULL, NULL, NULL, NULL, NULL, 0, '2022-01-04 04:40:13', '2022-01-04 04:41:43'),
(11, NULL, NULL, NULL, NULL, NULL, 'sdsa@gemai.lcom', '545087', NULL, NULL, NULL, NULL, NULL, 0, '2022-01-04 04:41:17', '2022-01-04 04:41:17'),
(12, 'Antopolis Dev', 'antopolis.dev@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '2022-01-07 12:07:10', '2022-01-07 12:07:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `user_address_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`user_address_id`, `user_id`, `address_id`, `is_default`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 1, NULL, NULL),
(2, 9, 2, 0, NULL, NULL),
(5, 1, 5, 1, NULL, '2022-01-06 13:00:38'),
(17, 12, 17, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `whislists`
--

CREATE TABLE `whislists` (
  `whislist_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `whislists`
--

INSERT INTO `whislists` (`whislist_id`, `book_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 33, 3, NULL, NULL),
(6, 34, 4, '2022-01-02 09:42:09', '2022-01-02 09:42:09'),
(14, 37, 4, '2022-01-02 11:18:14', '2022-01-02 11:18:14'),
(15, 34, 9, '2022-01-03 07:18:02', '2022-01-03 07:18:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `books_publication_id_foreign` (`publication_id`);

--
-- Indexes for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD PRIMARY KEY (`book_author_id`),
  ADD KEY `book_authors_author_id_foreign` (`author_id`),
  ADD KEY `book_authors_book_id_foreign` (`book_id`);

--
-- Indexes for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD PRIMARY KEY (`book_category_id`),
  ADD KEY `book_categories_category_id_foreign` (`category_id`),
  ADD KEY `book_categories_book_id_foreign` (`book_id`);

--
-- Indexes for table `book_feature_attributes`
--
ALTER TABLE `book_feature_attributes`
  ADD PRIMARY KEY (`book_feature_attribute_id`),
  ADD KEY `book_feature_attributes_feature_attribute_id_foreign` (`feature_attribute_id`),
  ADD KEY `book_feature_attributes_book_id_foreign` (`book_id`);

--
-- Indexes for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD PRIMARY KEY (`book_review_id`),
  ADD KEY `book_reviews_book_id_foreign` (`book_id`),
  ADD KEY `book_reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `feature_attributes`
--
ALTER TABLE `feature_attributes`
  ADD PRIMARY KEY (`feature_attribute_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_payment_id_foreign` (`payment_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_order_status_id_foreign` (`order_status_id`);

--
-- Indexes for table `order_books`
--
ALTER TABLE `order_books`
  ADD PRIMARY KEY (`order_book_id`),
  ADD KEY `order_books_order_id_foreign` (`order_id`),
  ADD KEY `order_books_book_id_foreign` (`book_id`);

--
-- Indexes for table `order_statuses`
--
ALTER TABLE `order_statuses`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`publication_id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_alternative_phone_unique` (`alternative_phone`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`user_address_id`),
  ADD KEY `user_addresses_user_id_foreign` (`user_id`),
  ADD KEY `user_addresses_address_id_foreign` (`address_id`);

--
-- Indexes for table `whislists`
--
ALTER TABLE `whislists`
  ADD PRIMARY KEY (`whislist_id`),
  ADD KEY `whislists_book_id_foreign` (`book_id`),
  ADD KEY `whislists_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `address_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `book_authors`
--
ALTER TABLE `book_authors`
  MODIFY `book_author_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `book_categories`
--
ALTER TABLE `book_categories`
  MODIFY `book_category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `book_feature_attributes`
--
ALTER TABLE `book_feature_attributes`
  MODIFY `book_feature_attribute_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `book_reviews`
--
ALTER TABLE `book_reviews`
  MODIFY `book_review_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_attributes`
--
ALTER TABLE `feature_attributes`
  MODIFY `feature_attribute_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_books`
--
ALTER TABLE `order_books`
  MODIFY `order_book_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `order_statuses`
--
ALTER TABLE `order_statuses`
  MODIFY `order_status_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `publication_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `user_address_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `whislists`
--
ALTER TABLE `whislists`
  MODIFY `whislist_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_publication_id_foreign` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`publication_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_authors`
--
ALTER TABLE `book_authors`
  ADD CONSTRAINT `book_authors_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_authors_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_categories`
--
ALTER TABLE `book_categories`
  ADD CONSTRAINT `book_categories_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_feature_attributes`
--
ALTER TABLE `book_feature_attributes`
  ADD CONSTRAINT `book_feature_attributes_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_feature_attributes_feature_attribute_id_foreign` FOREIGN KEY (`feature_attribute_id`) REFERENCES `feature_attributes` (`feature_attribute_id`) ON DELETE CASCADE;

--
-- Constraints for table `book_reviews`
--
ALTER TABLE `book_reviews`
  ADD CONSTRAINT `book_reviews_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_order_status_id_foreign` FOREIGN KEY (`order_status_id`) REFERENCES `order_statuses` (`order_status_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_books`
--
ALTER TABLE `order_books`
  ADD CONSTRAINT `order_books_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_books_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD CONSTRAINT `user_addresses_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`address_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `whislists`
--
ALTER TABLE `whislists`
  ADD CONSTRAINT `whislists_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `whislists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

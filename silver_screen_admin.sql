-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2024 at 03:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `silver_screen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `flag_admin` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `flag_admin`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 1),
(2, 'root', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_movie_id` int(11) DEFAULT NULL,
  `comment_user_id` int(11) DEFAULT NULL,
  `comment_username` varchar(255) DEFAULT NULL,
  `comment_avatar` varchar(255) DEFAULT NULL,
  `comment_text` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment_movie_id`, `comment_user_id`, `comment_username`, `comment_avatar`, `comment_text`) VALUES
(1, 5, 1, 'admin', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', 'awesome'),
(2, 4, 1, 'admin', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', 'test comment'),
(3, 4, 1, 'admin', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', 'please upload mission impossible'),
(4, 6, 1, 'admin', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', 'this is comment'),
(5, 5, 1, 'admin', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', 'this is comment'),
(6, 7, 1, 'admin', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', 'this is comment'),
(7, 9, 1, 'admin', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', 'herr mero comment'),
(8, 3, 7, 'rikesh', '6560494ad2b91_Screenshot 2023-05-13 154456.png', 'qwertyu'),
(9, 1, 1, 'admin', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', 'Aewsome');

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(255) DEFAULT NULL,
  `movie_upload_name` varchar(255) DEFAULT NULL,
  `movie_upload_image` varchar(255) DEFAULT NULL,
  `movie_description` longtext DEFAULT NULL,
  `movie_genre` varchar(255) DEFAULT NULL,
  `movie_subscription` varchar(255) DEFAULT NULL,
  `release_date` varchar(255) DEFAULT NULL,
  `movie_language` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `movie_name`, `movie_upload_name`, `movie_upload_image`, `movie_description`, `movie_genre`, `movie_subscription`, `release_date`, `movie_language`) VALUES
(1, 'movie_test', '651d7112c4aa8_242468465_594261368247553_2322973193556881581_n.mp4', '651d7112c4946_272999124_3180732085582625_6391622957893453487_n.jpg', 'This is descri[tion', 'Action', 'free', '2023', 'nepali'),
(2, 'Carla Brock', '651d7724e4377_2022-09-26_20-20-10.mp4', '651d7724e427a_280752917_688300048897747_4471061614589813199_n.jpg', 'Consequat Expedita ', 'Drama', 'free', '27-Apr-2011', 'Qui nostrum ipsum vo'),
(3, 'Dawn Mann', '651d77417f398_335888522_1158628708134306_5783167234078438848_n (1).mp4', '651d77417f1e4_313018198_577233477537424_1416717656470396202_n.jpg', 'Inventore ad tempora', 'Comedy', 'free', '04-May-2017', 'Dolorum maxime rerum'),
(4, 'Noah Shannon', '651d775a63afc_349016056_813979160084075_2209021640985995234_n.mp4', '651d775a639ea_319560288_6327084213971570_8892882654511116947_n.jpg', 'Voluptate cumque vel', 'Action', 'free', '17-May-1986', 'Officia quia anim eu'),
(5, 'Damon Battle', '651d7772ce0e2_vlc-record-2023-03-13-21h32m59s-Timid Tabby -Tom & Jerry SuperCartoons.mp4-.mp4', '651d7772ce00c_344349355_625429062440856_7061349186950783311_n.jpg', 'Qui irure minima ali', 'Adventure', 'free', '21-Jul-1973', 'Quod reiciendis esse'),
(6, 'Amery Berry', '651d8913be1dd_331411521_164324416475745_5915473970060853601_n.mp4', '651d8913be106_337880594_810880610469519_803996174794976070_n.jpg', 'Deleniti corporis la', 'Drama', 'free', '06-Aug-2021', 'Nesciunt pariatur '),
(7, 'test movie 123', '651e342deb0d8_319226934_521584639905418_5340707859004247823_n.mp4', '651e342deb012_324925924_1446227429117311_3271049359093216385_n.jpg', 'this is description of id 6', 'Action', 'premium', '2023', 'newari'),
(9, 'Movie test 123', '6560055407472_332418708_792904275525931_5201284926891529333_n.mp4', '65600554068f0_323334678_1485812545277031_1622538820601876999_n.jpg', 'This is based on romantic movie', 'Comedy', 'free', '2023', 'Hindi'),
(10, 'Mission Impossible', '656d9ef4ef8c7_329417712_725898178883636_4716835437640179956_n.mp4', '656d9ef4ef403_gerbera_flowers_bouquet_5k-5120x2880-1221704523.jpg', 'Mission impossibe 2023 Action movie', 'Action', 'free', '2023', 'Nepali'),
(11, 'Fire in the hole', '6592d006ccbd7_fire (1).mp4', '6592d006cc930_415300959_655928733416148_2496075666876702320_n.jpg', 'Fire in the hole', 'Sci-Fi', 'free', '2024', 'Nepali');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `review_id` int(11) NOT NULL,
  `review_movie_id` int(11) DEFAULT NULL,
  `review_user_id` int(11) DEFAULT NULL,
  `review_score` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`review_id`, `review_movie_id`, `review_user_id`, `review_score`) VALUES
(1, 6, 1, 4),
(2, 5, 1, 5),
(3, 7, 1, 2),
(5, 3, 7, 3),
(6, 1, 1, 4),
(7, 1, 8, 3),
(8, 6, 8, 5),
(9, 10, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone_no` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `flag_admin` varchar(255) DEFAULT NULL,
  `flag_premium` varchar(255) DEFAULT NULL,
  `premium_transaction` varchar(255) DEFAULT NULL,
  `expire_premium` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `phone_no`, `avatar`, `flag_admin`, `flag_premium`, `premium_transaction`, `expire_premium`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin@gmail.com', '9876543210', '651d5953ccd96_324017406_469004508758904_5932528951960013059_n.jpg', '1', 'premium', 'qwerty', '2029-10-04'),
(2, 'pugyqypy', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'vymizymuq@mailinator.com', '9841327003', '651d5f7723d8f_336238300_742341984160201_1183180336652973478_n.jpg', '0', 'free', '123456', '2023-10-04'),
(3, 'root', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'tst_ghj@gmail.com', '963147', '651e37aabbf23_325576302_1556763874805044_283565963488937669_n.jpg', '0', 'premium', 'lol123', '2025-01-01'),
(6, 'lol', '9cdfb439c7876e703e307864c9167a15', 'lol@q.q', '9632581470', '655ff628549d0_82chhm.jpg', '0', 'free', NULL, '2023-11-24'),
(7, 'rikesh', '202cb962ac59075b964b07152d234b70', '123@gmail.com', '9861447785', '6560494ad2b91_Screenshot 2023-05-13 154456.png', '0', 'free', NULL, '2023-11-24'),
(8, 'sushan', '5f4dcc3b5aa765d61d8327deb882cf99', 'sushan@gmail.com', '986520023', '656d9a6174b75_52109756.jpeg', '0', 'premium', 'jsnr62sf6', '2025-01-01'),
(9, 'hacker12345', 'c420398165584809b17e1d9a5ce460c9', 'hacker@gmail.com', '9874102563', '6592ce9a97f8c_purepng.com-settings-iconsymbolsiconsapple-iosiosios-8-iconsios-8-721522596115dq1ho.png', '0', 'free', '123456789', '2024-01-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_movie_id` (`comment_movie_id`),
  ADD KEY `comment_user_id` (`comment_user_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_movie_id` (`review_movie_id`),
  ADD KEY `review_user_id` (`review_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`comment_movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`comment_user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`review_movie_id`) REFERENCES `movies` (`movie_id`),
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`review_user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

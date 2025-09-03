-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2025 at 09:34 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `email_sender`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_pop_mail`
--

CREATE TABLE `additional_pop_mail` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `pop_id` int(10) NOT NULL DEFAULT 0,
  `gmail_address` varchar(100) NOT NULL,
  `gmail_password` varchar(250) NOT NULL,
  `gmail_host` varchar(250) DEFAULT NULL,
  `last_read` timestamp NOT NULL DEFAULT current_timestamp(),
  `daily_limit` int(10) NOT NULL DEFAULT 50,
  `last_sent_date` date DEFAULT NULL,
  `sent_today` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `additional_pop_mail`
--

INSERT INTO `additional_pop_mail` (`id`, `user_id`, `pop_id`, `gmail_address`, `gmail_password`, `gmail_host`, `last_read`, `daily_limit`, `last_sent_date`, `sent_today`) VALUES
(4, 3, 4, 'codezenshagor@gmail.com', 'kalf qhgy gysy icmq', '', '2025-09-02 09:35:18', 10, '2025-09-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `additional_smtp_mail`
--

CREATE TABLE `additional_smtp_mail` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `pop_id` int(10) NOT NULL,
  `smtp_id` int(10) NOT NULL,
  `server_type` varchar(20) NOT NULL DEFAULT 'manual',
  `server_id` int(10) DEFAULT NULL,
  `imap_host` varchar(250) DEFAULT NULL,
  `smtp_host` varchar(250) NOT NULL,
  `smtp_user_name` varchar(250) NOT NULL,
  `smtp_password` varchar(250) NOT NULL,
  `daily_limit` int(10) NOT NULL DEFAULT 100,
  `monthly_limit` int(10) NOT NULL DEFAULT 3000,
  `last_read` timestamp NOT NULL DEFAULT current_timestamp(),
  `sent_today` int(10) NOT NULL DEFAULT 0,
  `last_sent_date` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pop_mail`
--

CREATE TABLE `pop_mail` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'pop',
  `gmail_address` varchar(100) NOT NULL,
  `gmail_password` varchar(250) NOT NULL,
  `gmail_host` varchar(250) NOT NULL,
  `last_read` timestamp NOT NULL DEFAULT current_timestamp(),
  `daily_limit` int(10) NOT NULL DEFAULT 50,
  `last_sent_date` date DEFAULT NULL,
  `sent_today` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pop_mail`
--

INSERT INTO `pop_mail` (`id`, `user_id`, `type`, `gmail_address`, `gmail_password`, `gmail_host`, `last_read`, `daily_limit`, `last_sent_date`, `sent_today`) VALUES
(4, 3, 'inbox', 'binarybrainaic@gmail.com', 'aquz luzz dmhf wfqt', 'imap.gmail.com', '2025-09-02 10:19:31', 100, '2025-09-03', 0);

-- --------------------------------------------------------

--
-- Table structure for table `rcv_mail`
--

CREATE TABLE `rcv_mail` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `pop_id` int(10) NOT NULL,
  `read_mail` varchar(250) NOT NULL,
  `read_type` varchar(10) NOT NULL,
  `rcv_mail` varchar(250) NOT NULL,
  `mail_name` varchar(250) DEFAULT NULL,
  `mail_subject` varchar(250) DEFAULT NULL,
  `mail_body` longtext NOT NULL,
  `rcv_time` varchar(50) NOT NULL,
  `follow_up` int(10) NOT NULL DEFAULT 1,
  `last_follow_up_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `message_id` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply_mail`
--

CREATE TABLE `reply_mail` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `pop_id` int(10) NOT NULL,
  `smtp_id` int(10) NOT NULL,
  `read_mail` varchar(250) NOT NULL,
  `reply_from` varchar(250) NOT NULL,
  `subject` varchar(250) DEFAULT NULL,
  `body` longtext NOT NULL,
  `reply_send` int(5) NOT NULL DEFAULT 0,
  `reply_number` int(10) NOT NULL,
  `add_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `send_mail`
--

CREATE TABLE `send_mail` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `pop_id` int(10) DEFAULT NULL,
  `smtp_id` int(10) DEFAULT NULL,
  `send_from` varchar(250) NOT NULL,
  `reply_mail` varchar(250) NOT NULL,
  `to_mail` varchar(250) NOT NULL,
  `send_subject` varchar(250) NOT NULL,
  `send_body` longtext NOT NULL,
  `send_attachment` longtext DEFAULT NULL,
  `send_type` varchar(15) NOT NULL DEFAULT 'follow-up',
  `send_serial` int(10) NOT NULL,
  `send_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `servers`
--

CREATE TABLE `servers` (
  `id` int(11) UNSIGNED NOT NULL,
  `server_name` varchar(255) NOT NULL,
  `type` enum('cPanel','CyberPanel') NOT NULL,
  `host` varchar(255) NOT NULL,
  `api_port` int(11) NOT NULL,
  `api_user` varchar(100) NOT NULL,
  `api_token` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `mail_server` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servers`
--

INSERT INTO `servers` (`id`, `server_name`, `type`, `host`, `api_port`, `api_user`, `api_token`, `created_at`, `mail_server`) VALUES
(8, 'My cPanel Host', 'cPanel', 'shagor.top', 2083, 'shagorto', 'BZB2200PIB4CIL9BNDFEJK4YZU5W7FWT', '2025-08-25 11:59:21', ' mail.shagor.top'),
(11, 'my cpanel 2', 'cPanel', 'zksoft.top', 2083, 'zksoftt1', 'GQMVGCOQXC6L70SBX1MH6ZCX14LOPU0S', '2025-09-02 15:56:26', 'mail.zksoft.top');

-- --------------------------------------------------------

--
-- Table structure for table `server_domains`
--

CREATE TABLE `server_domains` (
  `id` int(11) UNSIGNED NOT NULL,
  `server_id` int(11) UNSIGNED NOT NULL,
  `domain_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `server_domains`
--

INSERT INTO `server_domains` (`id`, `server_id`, `domain_name`, `created_at`) VALUES
(1, 8, 'shagor.top', '2025-08-25 11:59:21'),
(4, 11, 'zksoft.top', '2025-09-02 15:56:26'),
(5, 11, 'global71.top', '2025-09-02 15:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `smtp_mail`
--

CREATE TABLE `smtp_mail` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `pop_id` int(10) NOT NULL,
  `server_type` varchar(20) NOT NULL DEFAULT 'manual',
  `server_id` int(10) DEFAULT NULL,
  `imap_host` varchar(250) DEFAULT NULL,
  `smtp_host` varchar(250) NOT NULL,
  `smtp_user_name` varchar(250) NOT NULL,
  `smtp_password` varchar(250) NOT NULL,
  `daily_limit` int(10) NOT NULL DEFAULT 100,
  `monthly_limit` int(10) NOT NULL DEFAULT 3000,
  `last_read` timestamp NOT NULL DEFAULT current_timestamp(),
  `sent_today` int(10) NOT NULL DEFAULT 0,
  `last_sent_date` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `smtp_mail`
--

INSERT INTO `smtp_mail` (`id`, `user_id`, `pop_id`, `server_type`, `server_id`, `imap_host`, `smtp_host`, `smtp_user_name`, `smtp_password`, `daily_limit`, `monthly_limit`, `last_read`, `sent_today`, `last_sent_date`) VALUES
(16, 3, 4, 'auto', NULL, 'mail.zksoft.top', 'mail.zksoft.top', 'Birds@zksoft.top', '90faf6ecfb186d4d', 100, 500, '2025-09-02 15:59:51', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `pop_id` int(10) DEFAULT NULL,
  `type` varchar(10) NOT NULL,
  `serial` int(10) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `body` longtext NOT NULL,
  `attachment` longtext DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `user_id`, `pop_id`, `type`, `serial`, `subject`, `body`, `attachment`, `created_at`, `updated_at`) VALUES
(4, 3, NULL, 'follow_up', 1, '-', '<p>test test</p>', '[\"uploads\\/file_68b6c134482d60.87333918.jpg\"]', '2025-09-02 10:04:36', '2025-09-02 10:04:36'),
(6, 3, NULL, 'follow_up', 2, '-', '<p>test follow 2</p>', '[\"uploads\\/file_68b6f06a49d5b7.24701976.jpg\",\"uploads\\/file_68b6f06a49fd62.79322772.jpg\"]', '2025-09-02 13:26:02', '2025-09-02 13:26:02'),
(7, 3, NULL, 'follow_up', 3, '-', '<p>test follow 3</p>', '[\"uploads\\/file_68b6f07e22bea4.42568870.jpg\"]', '2025-09-02 13:26:22', '2025-09-02 13:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `nid_card` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `role`, `password`, `address`, `birthday`, `nid_card`, `created_at`) VALUES
(1, ' Ali', 'test78ss', 'binarybrainaic@gmail.com', 'users', '$2y$10$WGdwP0aZ9iV2opHqkU5z8eDhPM9xtI/7Lmo1qN66LMiDujn24NY0q', 'Saghatta', '0000-00-00', '', '2025-08-25 09:17:16'),
(3, 'Md Shagor Ali', 'birds12', 'admin@gmail.com', 'admin', '$2y$10$N1b0Og7gBI4yowa4fsifVeFiu/dYRU8bdQ4qRRQZCYDU6ZUdmnyia', '', '0000-00-00', '', '2025-08-26 11:42:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_pop_mail`
--
ALTER TABLE `additional_pop_mail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `additional_smtp_mail`
--
ALTER TABLE `additional_smtp_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pop_mail`
--
ALTER TABLE `pop_mail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `rcv_mail`
--
ALTER TABLE `rcv_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply_mail`
--
ALTER TABLE `reply_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `send_mail`
--
ALTER TABLE `send_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servers`
--
ALTER TABLE `servers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `server_domains`
--
ALTER TABLE `server_domains`
  ADD PRIMARY KEY (`id`),
  ADD KEY `server_id` (`server_id`);

--
-- Indexes for table `smtp_mail`
--
ALTER TABLE `smtp_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_pop_mail`
--
ALTER TABLE `additional_pop_mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `additional_smtp_mail`
--
ALTER TABLE `additional_smtp_mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pop_mail`
--
ALTER TABLE `pop_mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rcv_mail`
--
ALTER TABLE `rcv_mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reply_mail`
--
ALTER TABLE `reply_mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `send_mail`
--
ALTER TABLE `send_mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `servers`
--
ALTER TABLE `servers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `server_domains`
--
ALTER TABLE `server_domains`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `smtp_mail`
--
ALTER TABLE `smtp_mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `server_domains`
--
ALTER TABLE `server_domains`
  ADD CONSTRAINT `server_domains_ibfk_1` FOREIGN KEY (`server_id`) REFERENCES `servers` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

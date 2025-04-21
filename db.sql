-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2025 at 01:33 PM
-- Server version: 8.0.41-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `sn` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`sn`, `name`, `email`, `password`) VALUES
(1, 'super admin', 'super@super.com', 'admin'),
(2, 'admin', 'admin@admin.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `sn` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`sn`, `name`, `email`, `phone`, `subject`, `message`, `created_at`) VALUES
(1, 'admin', 'admin@admin.com', '9800000000', 'test subject', 'this is a test message and this is the first contact test message this is a long message just for message and this is the test message is the long messsage thank you.', '2024-11-02 18:37:15'),
(2, 'test test', 'test@test.com', '9811111111', 'tsest subject ', 'message is this is a messagemessage is this is a messagemessage is this is a messagemessage is this is a messagemessage is this is a messagemessage is this is a messagemessage is this is a message.', '2024-11-02 18:48:25'),
(3, 'admin1', 'shakyasahaj10@gmail.com', '9803621141', 'adf ', 'adsveve', '2024-11-02 18:59:26'),
(4, 'test', 'tesst@grr.la', '9803621141', 'adf ', 'dadve', '2024-11-02 19:02:11'),
(5, 'Test name', 'admin@admin.com', '9803621141', 'adf ', 'adveve', '2024-11-02 19:02:29'),
(6, 'Test name', 'admin@admin.com', '9803621141', 'aveve ', 'beaevaesd', '2024-11-02 19:04:21'),
(7, 'test', 'tesst@grr.la', '9800000000', 'adf ', 'dlakjlvnelnv', '2024-11-02 19:10:05'),
(8, 'test', 'tesst@grr.la', '9800000000', 'adf ', 'dlakjlvnelnv', '2024-11-02 19:10:05'),
(9, 'Test name', 'shakyasahaj10@gmail.com', '9803621141', 'aveve ', 'vevsdfe', '2024-11-02 19:11:53'),
(10, 'Test name', 'shakyasahaj10@gmail.com', '9803621141', 'aveve ', 'vevsdfe', '2024-11-02 19:11:53'),
(11, 'test', 'tesst@grr.la', '9800000000', 'aveve ', 'flkmkef \r\n', '2024-11-02 19:12:57'),
(12, 'test', 'tesst@grr.la', '9800000000', 'aveve ', 'flkmkef \r\n', '2024-11-02 19:12:57'),
(13, 'yt', 'shakyasahaj10@yahoo.com', '9803621141', 'daveveadv ', 'laskdn adlkalk alksndfoien', '2024-11-02 19:17:29'),
(14, 'yt', 'shakyasahaj10@yahoo.com', '9803621141', 'daveveadv ', 'laskdn adlkalk alksndfoien', '2024-11-02 19:17:29'),
(15, 'test', 'superadmin@gmail.com', '9800000000', 'aveve ', 'lvke vlke vve', '2024-11-02 19:18:27'),
(17, 'just now', 'admin@admin.com', '9800000000', 'adf ', 'saDSSSS', '2024-11-06 17:13:40'),
(18, 'test4', 'admin@admin.com', '9800000000', 'adf ', 'cc\r\n\r\n\r\n\r\n', '2024-11-06 17:20:22'),
(19, 'User', 'tesst@grr.la', '9803621141', 'vvvvvvvvv ', 'vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', '2024-11-07 16:40:38'),
(20, 'hello', 'admin@admin.com', '9803621141', 'feee ', 'hello', '2024-11-10 01:51:32'),
(21, 'admin', 'admin@admin.com', '9800000000', 'this is a long test subject jist ror tesiting purpose and tis is just a eest adn hello wto chhihd this is the test ', 'hi', '2025-01-19 07:15:19'),
(22, 'aa', 'admin@admin.com', '9800000000', 'aa', 'aa', '2025-01-19 12:48:34');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `sn` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `created/edited_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`sn`, `title`, `description`, `image`, `created/edited_by`) VALUES
(21, 'BCA 4th Semester examination', 'Dear students,\r\nGood morning!\r\n\r\nThe practical examination and Viva of BCA 4th Semester will be held as per the following schedule:\r\n\r\n2081- 10-17 (tomorrow) :  Scripting Language @ 7:00 am\r\n\r\nSWOYAMBHU INTERNATIONAL COLLEGE', '../images/logo.png', 'admin'),
(22, 'BCA 3th Semester Examination', 'Dear students,\r\nGood morning!\r\n\r\nThe practical examination and Viva of BCA 4th Semester will be held as per the following schedule:\r\n\r\n2081- 10-17 (tomorrow) :  Scripting Language @ 7:00 am\r\n\r\nSWOYAMBHU INTERNATIONAL COLLEGE', '../images/logo.png', 'admin'),
(23, 'BCA 1st Semester result published', 'Dear students,\r\nGood morning!\r\n\r\nThe practical examination and Viva of BCA 4th Semester will be held as per the following schedule:\r\n\r\n2081- 10-17 (tomorrow) :  Scripting Language @ 7:00 am\r\n\r\nSWOYAMBHU INTERNATIONAL COLLEGE', '../images/logo.png', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `sn` int NOT NULL,
  `room_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`sn`, `room_no`) VALUES
(11, '402'),
(10, '403');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `sn` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `time` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `image` varchar(255) NOT NULL,
  `created/edited_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`sn`, `title`, `start_date`, `end_date`, `time`, `image`, `created/edited_by`) VALUES
(1, 'BCA 4th semester exam routine(2024)', '2024-11-08', '2024-11-15', '7am - 10am', '../images/examcenter.jpg', ''),
(2, 'BBM 6th semester exam routine(2024)', '2024-11-20', '2024-11-29', '1pm - 4pm', '../images/routine.jpg', ''),
(3, 'new', '2024-11-08', '2024-11-29', '7am - 10am', '../images/1356866.png', 'admin'),
(4, 'dsfsdf', '2024-11-12', '2024-11-15', '', '../images/1356866.png', 'admin'),
(5, 'test schedules', '2024-11-14', '2024-11-15', '1pm - 3pm', '../images/1356866.png', 'admin'),
(6, 'exam', '2024-11-07', '2024-11-14', '1pm - 3pm', '../images/1356866.png', 'admin'),
(7, 'tt', '2024-11-20', '2024-12-07', '1pm - 3pm', '../images/1356866.png', 'admin'),
(8, 'gg', '2024-11-13', '2024-11-23', '1pm - 3pm', '../images/1356866.png', 'admin'),
(10, 'df', '2024-11-15', '2024-11-21', '1pm - 3pm', '../images/1356866.png', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `seat_plan`
--

CREATE TABLE `seat_plan` (
  `sn` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `roll_no` int NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `bench_no` varchar(50) NOT NULL,
  `side` varchar(10) NOT NULL,
  `room_sn` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `seat_plan`
--

INSERT INTO `seat_plan` (`sn`, `name`, `semester`, `roll_no`, `faculty`, `bench_no`, `side`, `room_sn`) VALUES
(1, 'Uma Walker', '1', 200123, 'BCA', '1(L)', 'L', 11),
(2, 'Charlie Miller', '1', 300105, 'BBM', '2(L)', 'L', 11),
(3, 'Jack White', '1', 200112, 'BCA', '3(L)', 'L', 11),
(4, 'John Smith', '1', 300101, 'BBM', '4(L)', 'L', 11),
(5, 'Olivia Martinez', '1', 300117, 'BBM', '5(L)', 'L', 11),
(6, 'Quinn Clark', '1', 200119, 'BCA', '6(L)', 'L', 11),
(7, 'Yara Hernandez', '1', 200127, 'BCA', '7(L)', 'L', 11),
(8, 'David Wilson', '1', 300106, 'BBM', '8(L)', 'L', 11),
(9, 'Oscar Wright', '1', 200129, 'BCA', '1(L)', 'L', 11),
(10, 'Zane King', '1', 300128, 'BBM', '2(L)', 'L', 11),
(11, 'Charlie Miller', '1', 200105, 'BCA', '3(L)', 'L', 11),
(12, 'Olivia Martinez', '1', 200117, 'BCA', '4(L)', 'L', 11),
(13, 'Karen Harris', '1', 200113, 'BCA', '5(L)', 'L', 11),
(14, 'Alice Brown', '1', 200103, 'BCA', '6(L)', 'L', 11),
(15, 'Alice Brown', '1', 300103, 'BBM', '7(L)', 'L', 11),
(16, 'Frank Taylor', '1', 200108, 'BCA', '1(L)', 'R', 11),
(17, 'Victor Hall', '1', 300124, 'BBM', '2(L)', 'R', 11),
(18, 'Bella Lopez', '1', 300130, 'BBM', '3(L)', 'R', 11),
(19, 'Noah Garcia', '1', 200116, 'BCA', '4(L)', 'R', 11),
(20, 'Quinn Clark', '1', 300119, 'BBM', '5(L)', 'R', 11),
(21, 'Xander Young', '1', 300126, 'BBM', '6(L)', 'R', 11),
(22, 'Emily Moore', '1', 200107, 'BCA', '7(L)', 'R', 11),
(23, 'Tina Lee', '1', 200122, 'BCA', '8(L)', 'R', 11),
(24, 'Grace Anderson', '1', 200109, 'BCA', '1(L)', 'R', 11),
(25, 'Rachel Rodriguez', '1', 200120, 'BCA', '2(L)', 'R', 11),
(26, 'Karen Harris', '1', 300113, 'BBM', '3(L)', 'R', 11),
(27, 'John Smith', '1', 200101, 'BCA', '4(L)', 'R', 11),
(28, 'Emily Moore', '1', 300107, 'BBM', '5(L)', 'R', 11),
(29, 'Oscar Wright', '1', 300129, 'BBM', '6(L)', 'R', 11),
(30, 'Bella Lopez', '1', 200130, 'BCA', '7(L)', 'R', 11),
(31, 'Victor Hall', '1', 200124, 'BCA', '1(R)', 'L', 10),
(32, 'Rachel Rodriguez', '1', 300120, 'BBM', '2(R)', 'L', 10),
(33, 'Wendy Allen', '1', 200125, 'BCA', '3(R)', 'L', 10),
(34, 'Frank Taylor', '1', 300108, 'BBM', '4(R)', 'L', 10),
(35, 'Bob Davis', '1', 200104, 'BCA', '5(R)', 'L', 10),
(36, 'Liam Martin', '1', 200114, 'BCA', '6(R)', 'L', 10),
(37, 'Steve Lewis', '1', 300121, 'BBM', '7(R)', 'L', 10),
(38, 'Xander Young', '1', 200126, 'BCA', '8(R)', 'L', 10),
(39, 'Paul Robinson', '1', 300118, 'BBM', '1(R)', 'L', 10),
(40, 'David Wilson', '1', 200106, 'BCA', '2(R)', 'L', 10),
(41, 'Hannah Thomas', '1', 300110, 'BBM', '3(R)', 'L', 10),
(42, 'Mia Thompson', '1', 200115, 'BCA', '4(R)', 'L', 10),
(43, 'Uma Walker', '1', 300123, 'BBM', '5(R)', 'L', 10),
(44, 'Zane King', '1', 200128, 'BCA', '6(R)', 'L', 10),
(45, 'Wendy Allen', '1', 300125, 'BBM', '7(R)', 'L', 10),
(46, 'Jack White', '1', 300112, 'BBM', '1(R)', 'R', 10),
(47, 'Tina Lee', '1', 300122, 'BBM', '2(R)', 'R', 10),
(48, 'Grace Anderson', '1', 300109, 'BBM', '3(R)', 'R', 10),
(49, 'Yara Hernandez', '1', 300127, 'BBM', '4(R)', 'R', 10),
(50, 'Liam Martin', '1', 300114, 'BBM', '5(R)', 'R', 10),
(51, 'Hannah Thomas', '1', 200110, 'BCA', '6(R)', 'R', 10),
(52, 'Ian Jackson', '1', 200111, 'BCA', '7(R)', 'R', 10),
(53, 'Paul Robinson', '1', 200118, 'BCA', '8(R)', 'R', 10),
(54, 'Mia Thompson', '1', 300115, 'BBM', '1(R)', 'R', 10),
(55, 'Jane Johnson', '1', 200102, 'BCA', '2(R)', 'R', 10),
(56, 'Noah Garcia', '1', 300116, 'BBM', '3(R)', 'R', 10),
(57, 'Jane Johnson', '1', 300102, 'BBM', '4(R)', 'R', 10),
(58, 'Ian Jackson', '1', 300111, 'BBM', '5(R)', 'R', 10),
(59, 'Bob Davis', '1', 300104, 'BBM', '6(R)', 'R', 10),
(60, 'Steve Lewis', '1', 200121, 'BCA', '7(R)', 'R', 10);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `sn` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `faculty` varchar(40) NOT NULL,
  `roll_no` int NOT NULL,
  `semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sn`, `name`, `faculty`, `roll_no`, `semester`) VALUES
(448, 'John Smith', 'BCA', 200101, '1'),
(449, 'Jane Johnson', 'BCA', 200102, '1'),
(450, 'Alice Brown', 'BCA', 200103, '1'),
(451, 'Bob Davis', 'BCA', 200104, '1'),
(452, 'Charlie Miller', 'BCA', 200105, '1'),
(453, 'David Wilson', 'BCA', 200106, '1'),
(454, 'Emily Moore', 'BCA', 200107, '1'),
(455, 'Frank Taylor', 'BCA', 200108, '1'),
(456, 'Grace Anderson', 'BCA', 200109, '1'),
(457, 'Hannah Thomas', 'BCA', 200110, '1'),
(458, 'Ian Jackson', 'BCA', 200111, '1'),
(459, 'Jack White', 'BCA', 200112, '1'),
(460, 'Karen Harris', 'BCA', 200113, '1'),
(461, 'Liam Martin', 'BCA', 200114, '1'),
(462, 'Mia Thompson', 'BCA', 200115, '1'),
(463, 'Noah Garcia', 'BCA', 200116, '1'),
(464, 'Olivia Martinez', 'BCA', 200117, '1'),
(465, 'Paul Robinson', 'BCA', 200118, '1'),
(466, 'Quinn Clark', 'BCA', 200119, '1'),
(467, 'Rachel Rodriguez', 'BCA', 200120, '1'),
(468, 'Steve Lewis', 'BCA', 200121, '1'),
(469, 'Tina Lee', 'BCA', 200122, '1'),
(470, 'Uma Walker', 'BCA', 200123, '1'),
(471, 'Victor Hall', 'BCA', 200124, '1'),
(472, 'Wendy Allen', 'BCA', 200125, '1'),
(473, 'Xander Young', 'BCA', 200126, '1'),
(474, 'Yara Hernandez', 'BCA', 200127, '1'),
(475, 'Zane King', 'BCA', 200128, '1'),
(476, 'Oscar Wright', 'BCA', 200129, '1'),
(477, 'Bella Lopez', 'BCA', 200130, '1'),
(478, 'John Smith', 'BBM', 300101, '1'),
(479, 'Jane Johnson', 'BBM', 300102, '1'),
(480, 'Alice Brown', 'BBM', 300103, '1'),
(481, 'Bob Davis', 'BBM', 300104, '1'),
(482, 'Charlie Miller', 'BBM', 300105, '1'),
(483, 'David Wilson', 'BBM', 300106, '1'),
(484, 'Emily Moore', 'BBM', 300107, '1'),
(485, 'Frank Taylor', 'BBM', 300108, '1'),
(486, 'Grace Anderson', 'BBM', 300109, '1'),
(487, 'Hannah Thomas', 'BBM', 300110, '1'),
(488, 'Ian Jackson', 'BBM', 300111, '1'),
(489, 'Jack White', 'BBM', 300112, '1'),
(490, 'Karen Harris', 'BBM', 300113, '1'),
(491, 'Liam Martin', 'BBM', 300114, '1'),
(492, 'Mia Thompson', 'BBM', 300115, '1'),
(493, 'Noah Garcia', 'BBM', 300116, '1'),
(494, 'Olivia Martinez', 'BBM', 300117, '1'),
(495, 'Paul Robinson', 'BBM', 300118, '1'),
(496, 'Quinn Clark', 'BBM', 300119, '1'),
(497, 'Rachel Rodriguez', 'BBM', 300120, '1'),
(498, 'Steve Lewis', 'BBM', 300121, '1'),
(499, 'Tina Lee', 'BBM', 300122, '1'),
(500, 'Uma Walker', 'BBM', 300123, '1'),
(501, 'Victor Hall', 'BBM', 300124, '1'),
(502, 'Wendy Allen', 'BBM', 300125, '1'),
(503, 'Xander Young', 'BBM', 300126, '1'),
(504, 'Yara Hernandez', 'BBM', 300127, '1'),
(505, 'Zane King', 'BBM', 300128, '1'),
(506, 'Oscar Wright', 'BBM', 300129, '1'),
(507, 'Bella Lopez', 'BBM', 300130, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `sn` int NOT NULL,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`sn`, `username`, `email`, `password`) VALUES
(10, 'aayush', 'aayush123@gmail.com', '1111111111');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `room_no` (`room_no`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `seat_plan`
--
ALTER TABLE `seat_plan`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `roll_no` (`roll_no`),
  ADD KEY `fk_room_sn` (`room_sn`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `unique_roll_no` (`roll_no`),
  ADD UNIQUE KEY `roll_no` (`roll_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`sn`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `sn` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `sn` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `sn` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `sn` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `sn` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `seat_plan`
--
ALTER TABLE `seat_plan`
  MODIFY `sn` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `sn` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=508;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `sn` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seat_plan`
--
ALTER TABLE `seat_plan`
  ADD CONSTRAINT `fk_room_sn` FOREIGN KEY (`room_sn`) REFERENCES `rooms` (`sn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_students_roll_no` FOREIGN KEY (`roll_no`) REFERENCES `students` (`roll_no`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

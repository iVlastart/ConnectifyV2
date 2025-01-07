-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2025 at 06:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectifydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_ID` int(11) NOT NULL,
  `orgComment_ID` int(11) NOT NULL DEFAULT 0,
  `Post_ID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Content` varchar(100) NOT NULL,
  `CommentDate` date NOT NULL DEFAULT current_timestamp(),
  `isReply` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `orgComment_ID`, `Post_ID`, `ID`, `Content`, `CommentDate`, `isReply`) VALUES
(1, 0, 1, 1, '1st comment', '2024-12-29', 0),
(4, 0, 1, 1, 'Report me', '2024-12-29', 0),
(5, 0, 2, 1, 'Reply', '2024-12-29', 0),
(6, 0, 3, 3, 'Test', '2024-12-30', 0),
(7, 0, 3, 1, 'I have to test something', '2024-12-30', 0),
(8, 0, 1, 1, 'This ain\'t a reply hopefully', '2024-12-30', 0),
(9, 0, 1, 1, 'No replies?', '2024-12-30', 0),
(10, 9, 1, 1, 'Yes replies', '2024-12-30', 1),
(11, 1, 1, 1, 'I reply', '2024-12-30', 1),
(13, 8, 1, 3, 'But this is a reply', '2024-12-30', 1),
(14, 1, 1, 3, 'Another reply from a different account', '2024-12-30', 1),
(15, 4, 1, 1, 'Ok', '2024-12-30', 1),
(21, 19, 6, 1, 'Ok', '2024-12-30', 1),
(25, 22, 6, 1, 'Ok', '2025-01-03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `isblocked`
--

CREATE TABLE `isblocked` (
  `Blocker` varchar(25) NOT NULL,
  `Blocking` varchar(25) NOT NULL,
  `isBlocked` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `isfollowed`
--

CREATE TABLE `isfollowed` (
  `Follower` varchar(25) NOT NULL,
  `Following` varchar(25) NOT NULL,
  `isFollowed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `isliked`
--

CREATE TABLE `isliked` (
  `Username` varchar(25) NOT NULL,
  `Post_ID` int(11) NOT NULL,
  `isLiked` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `isliked`
--

INSERT INTO `isliked` (`Username`, `Post_ID`, `isLiked`) VALUES
('as', 2, 1),
('Connectify', 6, 1),
('Connectify', 1, 1),
('Connectify', 9, 1),
('Connectify', 2, 1),
('Connectify', 11, 1),
('as', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `issaved`
--

CREATE TABLE `issaved` (
  `Saver` varchar(25) NOT NULL,
  `Post_ID` int(11) NOT NULL,
  `isSaved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issaved`
--

INSERT INTO `issaved` (`Saver`, `Post_ID`, `isSaved`) VALUES
('AccountToDelete', 1, 1),
('Connectify', 11, 1),
('Connectify', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `Post_ID` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `Content` varchar(100) DEFAULT NULL,
  `url` varchar(300) DEFAULT NULL,
  `hasMedia` tinyint(1) NOT NULL DEFAULT 0,
  `hasText` tinyint(1) NOT NULL DEFAULT 0,
  `PostDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`Post_ID`, `ID`, `Content`, `url`, `hasMedia`, `hasText`, `PostDate`) VALUES
(1, 1, '1st post', NULL, 0, 1, '2024-12-21'),
(2, 1, 'Awesome!', 'https://cdn.devdojo.com/pines/videos/coast.mp4', 1, 1, '2024-12-21'),
(3, 3, 'New account new post', '', 0, 1, '2024-12-21'),
(6, 1, 'Stop reading my posts', NULL, 0, 1, '2024-12-22'),
(11, 9, 'Merry Rizzmas', NULL, 0, 1, '2024-12-24');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `Post_ID` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`Post_ID`, `Username`) VALUES
(11, 'SkibidiToilet');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Joined` date NOT NULL DEFAULT current_timestamp(),
  `Pfp` varchar(50) DEFAULT NULL,
  `Bio` varchar(40) NOT NULL,
  `Suspended` tinyint(1) NOT NULL DEFAULT 0,
  `isVerified` tinyint(1) NOT NULL DEFAULT 0,
  `Followers` int(11) NOT NULL DEFAULT 0,
  `Following` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `Joined`, `Pfp`, `Bio`, `Suspended`, `isVerified`, `Followers`, `Following`) VALUES
(1, 'Connectify', '$2y$10$9IJUh1Itc8x7e3WYerDiZ.InoTBCNwJF.Q.ARl4lNph5Sb4tOyvMW', '2024-12-20', '', 'Hello, World!', 0, 1, 103, 17),
(3, 'as', '$2y$10$pBlbsuBIyMXav2n48Hmruu7WXMswWQsYXOuRuyAyVXKYpyXcgddP2', '2024-12-20', NULL, 'sa', 0, 0, 1, 1),
(5, 'user', '$2y$10$zf1vHt2E8NT3ZiKv7cUvDeETru9NpuAQKOT55rpm6wJd4yGd49yzu', '2024-12-23', NULL, '', 0, 0, 0, 0),
(9, 'SkibidiToilet', '$2y$10$T5kI3Qj53DnUoTXjAKVxDOzrx6IL7CeLdznDjntrsx0BrFBDULHSC', '2024-12-25', NULL, 'Skibidi dop dop dop yes yes yes', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`Post_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `Post_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

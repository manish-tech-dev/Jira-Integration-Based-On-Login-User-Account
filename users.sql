-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 11:16 AM
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
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--


--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password`, `remember_token`) VALUES
('Aditya', 'aditya123@mailinator.com', NULL, '$2y$10$5sHi1oq.0angd72HMXTIM.WrZiah1C91U6xEN2Md5iDQ6EV9j./PW', NULL),
('Manish Admin', 'admmanish688@gmail.com', NULL, '$2y$10$opq6s1a5MtszfoXy2ZNDxuzTWHyMeheKLEDlN1TPMLr1uJpLjm5ne', NULL),
('Hemant', 'ibansalbro@gmail.com', NULL, '$2y$10$7/yyu.7SzGtvvgiYb4sFPeF./yn.H4CotoZllCgG2cztqkP.QUw72', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

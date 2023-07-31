-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 01, 2023 at 01:16 AM
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
-- Database: `SlutProjekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `Accounts`
--

CREATE TABLE `Accounts` (
  `AccountID` int(11) NOT NULL,
  `UserID` varchar(32) NOT NULL,
  `Balance` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Accounts`
--

INSERT INTO `Accounts` (`AccountID`, `UserID`, `Balance`) VALUES
(1, 'jakob', 2231.73),
(2, 'jakob', 1965.96),
(3, 'test', 500),
(5, 'Jakob', 385.84),
(6, 'test', 499);

-- --------------------------------------------------------

--
-- Table structure for table `AllStocks`
--

CREATE TABLE `AllStocks` (
  `StocksID` int(11) NOT NULL,
  `StockName` varchar(28) NOT NULL,
  `Short` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `AllStocks`
--

INSERT INTO `AllStocks` (`StocksID`, `StockName`, `Short`) VALUES
(1, 'Cola', 'KO'),
(2, 'Amazon', 'AMZN'),
(3, 'Apple', 'AAPL');

-- --------------------------------------------------------

--
-- Table structure for table `Stock`
--

CREATE TABLE `Stock` (
  `StocksID` int(11) NOT NULL,
  `AccountID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Stock`
--

INSERT INTO `Stock` (`StocksID`, `AccountID`, `Amount`) VALUES
(1, 1, 45),
(1, 2, 1),
(1, 5, 2),
(2, 1, 95),
(2, 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserID` varchar(32) NOT NULL,
  `Password` varchar(42) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `Password`) VALUES
('Jakob', '5e52fee47e6b070565f74372468cdc699de89107'),
('pas1', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab '),
('test', 'e3431a8e0adbf96fd140103dc6f63a3f8fa343ab');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Accounts`
--
ALTER TABLE `Accounts`
  ADD PRIMARY KEY (`AccountID`,`UserID`),
  ADD UNIQUE KEY `AccountID` (`AccountID`);

--
-- Indexes for table `AllStocks`
--
ALTER TABLE `AllStocks`
  ADD UNIQUE KEY `StocksID` (`StocksID`);

--
-- Indexes for table `Stock`
--
ALTER TABLE `Stock`
  ADD PRIMARY KEY (`StocksID`,`AccountID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Accounts`
--
ALTER TABLE `Accounts`
  ADD CONSTRAINT `Accounts_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`);

--
-- Constraints for table `Stock`
--
ALTER TABLE `Stock`
  ADD CONSTRAINT `Stock_ibfk_1` FOREIGN KEY (`StocksID`) REFERENCES `AllStocks` (`StocksID`),
  ADD CONSTRAINT `Stock_ibfk_2` FOREIGN KEY (`AccountID`) REFERENCES `Accounts` (`AccountID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

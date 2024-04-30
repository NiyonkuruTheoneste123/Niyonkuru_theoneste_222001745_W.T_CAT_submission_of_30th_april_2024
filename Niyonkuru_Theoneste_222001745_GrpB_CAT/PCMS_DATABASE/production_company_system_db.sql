-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 10:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `production_company_system_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustID` int(11) NOT NULL,
  `CFname` varchar(255) DEFAULT NULL,
  `CLname` varchar(255) DEFAULT NULL,
  `CEmail` varchar(255) DEFAULT NULL,
  `Cphone` varchar(20) DEFAULT NULL,
  `Amountpaid` decimal(10,2) DEFAULT NULL,
  `ProID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustID`, `CFname`, `CLname`, `CEmail`, `Cphone`, `Amountpaid`, `ProID`) VALUES
(4, 'dodai', 'eric', 'doda@gmail.com', '287879897', 1234.00, 1),
(5, 'rukundo', 'karori', 'karori12@gmail.com', '0786762195', 12344.00, 3),
(6, 'dodai', 'eric', 'doda@gmail.com', '0786762195', 12334.00, 1),
(7, 'dodai', 'eric', 'doda@gmail.com', '0786762195', 10000.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `EmpID` int(11) NOT NULL,
  `Fname` varchar(255) DEFAULT NULL,
  `Lname` varchar(255) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Contact` varchar(20) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `contract` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EmpID`, `Fname`, `Lname`, `DOB`, `Email`, `Contact`, `Department`, `Salary`, `contract`) VALUES
(1, 'Niyonkuru', 'noble', '1961-02-01', '250@gmail.com', '786762195', 'production', 300000.00, '2000'),
(2, 'anne', 'marie', '2024-04-03', 'annemarie1@gmail.com', '89887', 'finance', 2000.00, '123'),
(3, 'rukundo', 'nehemia', '2024-04-10', 'nehemia@gmail.com', '0721345980', 'production', 2000.00, '2000'),
(4, 'ingabire', 'angela', '2024-04-09', 'angela12@gmail.com', '0981234567', 'Finance', 2000.00, 'part time'),
(5, 'vianny', 'xxx', '2024-04-02', 'karangwa@gmail.com', '0721345980', 'production', 210120.00, 'final');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `FinID` int(11) NOT NULL,
  `Fin_names` varchar(255) NOT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `asset_value` decimal(10,2) DEFAULT NULL,
  `salary_amount` decimal(10,2) DEFAULT NULL,
  `amount_per_year` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `finance`
--

INSERT INTO `finance` (`FinID`, `Fin_names`, `branch_name`, `asset_value`, `salary_amount`, `amount_per_year`) VALUES
(1, 'builidings', 'HUYE', 12200.00, 1222222.00, 5000000.00),
(2, 'supply', NULL, 99999999.99, 230000.00, 123000.00),
(3, 'advertise', NULL, 34000400.00, 3330023.00, 99999999.00),
(4, ' lease', NULL, 2100000.00, 12000.00, 11222.00),
(5, 'sales', NULL, 210000.00, 1222.00, 3212123.00);

-- --------------------------------------------------------

--
-- Table structure for table `market`
--

CREATE TABLE `market` (
  `MarkID` int(11) NOT NULL,
  `Mprovince` varchar(255) DEFAULT NULL,
  `Mdistrict` varchar(255) DEFAULT NULL,
  `Msector` varchar(255) DEFAULT NULL,
  `supplydate` date DEFAULT NULL,
  `EmpID` int(11) DEFAULT NULL,
  `ProID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `market`
--

INSERT INTO `market` (`MarkID`, `Mprovince`, `Mdistrict`, `Msector`, `supplydate`, `EmpID`, `ProID`) VALUES
(1, 'north', 'kamonyi', 'rukoma', '2024-04-10', 2, 2),
(2, 'south', 'kmny', 'rukom', '2024-04-27', 1, 1),
(3, 'east', 'rubavu', 'gisenyi', '2024-05-01', 5, 5),
(4, 'West', 'rusizi', 'Gisenyi', '2024-04-09', 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProID` int(11) NOT NULL,
  `Pname` varchar(255) DEFAULT NULL,
  `Amount` int(11) DEFAULT NULL,
  `Price` decimal(10,2) DEFAULT NULL,
  `Mnfdate` date DEFAULT NULL,
  `Expdate` date DEFAULT NULL,
  `RmID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProID`, `Pname`, `Amount`, `Price`, `Mnfdate`, `Expdate`, `RmID`) VALUES
(1, 'soja', 400, 1000.00, '2023-11-16', '2024-04-26', 2),
(2, 'maize flour', 400, 1000.00, '2024-04-02', '2024-04-28', 1),
(3, 'tofu', 400000, 1233000.00, '2024-04-03', '2024-04-18', 2),
(4, 'sosoma', 12000, 2000.00, '2024-04-04', '2024-05-11', 2),
(5, 'mixed flour', 9000, 1200.00, '2024-04-09', '2024-05-03', 4),
(6, 'soja', 2300003, 1200.00, '2024-04-18', '2024-05-11', 3);

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

CREATE TABLE `property` (
  `PropID` int(11) NOT NULL,
  `EmpID` int(11) DEFAULT NULL,
  `Pname` varchar(255) DEFAULT NULL,
  `Province` varchar(255) DEFAULT NULL,
  `District` varchar(255) DEFAULT NULL,
  `Sector` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`PropID`, `EmpID`, `Pname`, `Province`, `District`, `Sector`) VALUES
(1, 1, 'stocking house', 'west', 'rusizi', '0'),
(2, 2, 'eeeeeeee', 'east', 'ggggg', '0'),
(3, 2, 'sewing machine', 'rwada', 'kinyarwanda', '0'),
(4, 5, 'car', 'EAST', 'nygtr', 'kmb');

-- --------------------------------------------------------

--
-- Table structure for table `raw_material`
--

CREATE TABLE `raw_material` (
  `RmID` int(11) NOT NULL,
  `Rtype` varchar(255) DEFAULT NULL,
  `Ramount` decimal(10,2) DEFAULT NULL,
  `stored_date` date DEFAULT NULL,
  `unstore_date` date DEFAULT NULL,
  `SupID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `raw_material`
--

INSERT INTO `raw_material` (`RmID`, `Rtype`, `Ramount`, `stored_date`, `unstore_date`, `SupID`) VALUES
(1, 'beas', 1222220.00, '2023-07-04', '0000-00-00', 3),
(2, 'soja', 2000010.00, '2024-04-02', '0000-00-00', 2),
(3, 'sorgum', 1200000.00, '2024-04-02', '0000-00-00', 2),
(4, 'beans', 877990.00, '2024-04-03', '0000-00-00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupID` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `Lname` varchar(255) DEFAULT NULL,
  `Province` varchar(255) DEFAULT NULL,
  `District` varchar(255) DEFAULT NULL,
  `sector` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupID`, `fname`, `Lname`, `Province`, `District`, `sector`, `phone`, `email`, `amount_paid`) VALUES
(1, 'Niyonkuru', 'Theonetse', 'EAST', 'nayagatare', 'kamebe', '0786762195', 'niyo250@gmail.com', 12334.00),
(2, 'ingabire', 'angela', 'west', 'karong', 'rubenger', '78989898', 'angela12@gmail.com', 123.00),
(3, 'dodai', 'eric', 'west', 'karong', 'rubenger', '287879897', 'eric12@gmail.com', 12000.00),
(4, 'dodai', 'eric', 'EAST', 'nyagatare', 'rubenger', '0786762195', 'doda@gmail.com', 30000.00),
(5, 'Iradukunda', 'aline', 'sourth', 'kamonyi', 'rubenger', '98767654', 'aline@gmail.com', 321000.00),
(6, 'rukundo', 'nehemia', 'kigali', 'nyarugenge', 'nyamirammbo', '0720000000', 'nehemia@gmail.com', 5400004.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Names` varchar(244) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(20) NOT NULL,
  `Gender` varchar(12) NOT NULL,
  `Username` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Role` varchar(255) DEFAULT NULL,
  `activation_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Names`, `Email`, `Phone`, `Gender`, `Username`, `Password`, `Role`, `activation_code`) VALUES
(1, 'adidas karori', 'karori12@gmail.com', '+250786762195', 'Male', 'urhuye', '$2y$10$xZqb/ywytteAq9cqNc5Z1u24PUhZucztVh9nIzy8m2.qmhGoS7U2W', 'Employee', '00'),
(3, 'Maniraguha Eric', 'eric12@gmail.com', '0780000000', 'Male', 'urhuye', '$2y$10$KL.dbuLDjkm.JwCyjifgZu.g9WU5ROsbnFrECIFl5W0A1VQ0f63jm', 'Supplier', '0012'),
(4, 'noble man', 'man203@gmail.com', '0788888880', 'Male', 'hgfds', '$2y$10$QuA/1NZXo1I2.cerEy4ux.HHTo7b.JB6KGMzyfRGFmEuSV57c9Dje', 'Customer', 'bb'),
(5, 'vianny xxx', 'karangwa@gmail.com', '+250786762195', 'Male', 'uuu', '$2y$10$XQOASxchDL3XgyvixqZVAOfTj49XoE2ZwvJZm.xm7b4ixozd40K4i', 'other', '0909'),
(6, 'rukundo nehemia', 'nehemia@gmail.com', '0720000000', 'Female', 'kanye', '$2y$10$aDzYY0m7ZjuAUgUHEXC7LO2J8vJQOWw902qURuWDIuak9pzd5iN/m', 'Finance', 'bb'),
(7, 'mtunzi rikeb', 'mtunzi203@gmail.com', '07267000000', 'Male', 'cooo', '$2y$10$BVs.wkBrOr9HuqgjvluLi.68KKmeGxyD.SE.weKh10LISrNDSZlaW', 'Supplier', '00'),
(8, 'Niyonkuru Theonetse', 'niyoth250@gmail.com', '+250786762195', 'Male', 'urhuye', '$2y$10$KBcO48sJjuNs6rrBwXQEhuDFi.EGfYKF/x/lrJPAedICNWoxIEdBm', 'Employee', '7777'),
(9, 'ingabire angela', 'angela12@gmail.com', '078989898', 'Female', '1ange', '$2y$10$UcW5B9yPmZ2Fc5GFsAm5u.SKb0LfwY8bgM53n7a3Hv0Z45AY41mU6', 'customer', '2222'),
(10, 'rukundo', 'Lazia', '072134566', 'Female', 'hgfds', '$2y$10$hfpxeFaQdV3ooF3SqmHTfOy9oX65/a7tNTPpkgqRXtW15z9xhmijm', 'Finance', '000'),
(11, 'rukundo Lazia', 'lazia12@gmail.com', '07213456', 'Male', 'hgfds', '$2y$10$ZSgAEgdgb0i76X.xDkPc1.uW8BM/iUxnnLTVHxG7rYRyW/nibQ8fS', 'Finance', '000'),
(12, 'kamana luka', 'luka@gmail.com', '0721345690', 'Male', 'resort', '$2y$10$nn8fyq5ytV9joqxI2hXySOlS6Xu0uOtS5NrLZ0/QOvk6.AFwO1enW', 'Finance', '000'),
(13, 'dodai eric', 'eric12@gmail.com', '0287879897', 'Male', 'uuuu', '$2y$10$wc810d5JFTWnKNzMLQOe8.u1wbQ9DQYEPDQ11fERK4NJ35nTQNkC2', 'Finance', '67896'),
(14, 'dodai eric', 'eric12@gmail.com', '0287879897', 'Male', 'uuuu', '$2y$10$xScE04ZckSigJlSlT5L8rOnZGkCDlwh5ARpALsUR1sMMR6X2.LGGm', 'Finance', '67896'),
(15, 'dodai eric', 'doda@gmail.com', '0287879897', 'Male', 'uuuu', '$2y$10$kzLwmUxWHBZySSowmITPZuIXwc4PY9v.uBmKJb044F3g4TCVhs07a', 'Finance', '67896'),
(16, 'kamanyana marie', 'marie@gmail.com', '78989898', 'Female', 'mn', '$2y$10$MPTaznXC1u0yWr7aKWo8reEB70F6e5f3WO.BXJDvxA9a6F88IbOYm', 'cleaner', 'bb'),
(17, 'mukamana chantal', 'chantal@gmail.com', '000000000', 'Female', 'chant', '$2y$10$UC9FviNH1BVI0TInBLYlQu1rKvbscUXlmvIudNwJntNTbSxtRDEYW', 'Finance', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustID`),
  ADD KEY `ProID` (`ProID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`EmpID`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`FinID`);

--
-- Indexes for table `market`
--
ALTER TABLE `market`
  ADD PRIMARY KEY (`MarkID`),
  ADD KEY `EmpID` (`EmpID`),
  ADD KEY `ProID` (`ProID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProID`),
  ADD KEY `RmID` (`RmID`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`PropID`);

--
-- Indexes for table `raw_material`
--
ALTER TABLE `raw_material`
  ADD PRIMARY KEY (`RmID`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CustID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `EmpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `FinID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `market`
--
ALTER TABLE `market`
  MODIFY `MarkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `PropID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `raw_material`
--
ALTER TABLE `raw_material`
  MODIFY `RmID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `SupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`ProID`) REFERENCES `product` (`ProID`);

--
-- Constraints for table `market`
--
ALTER TABLE `market`
  ADD CONSTRAINT `market_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `employee` (`EmpID`),
  ADD CONSTRAINT `market_ibfk_2` FOREIGN KEY (`ProID`) REFERENCES `product` (`ProID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`RmID`) REFERENCES `raw_material` (`RmID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

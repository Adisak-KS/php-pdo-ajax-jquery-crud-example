-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 04:38 PM
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
-- Database: `crud_example`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productCode` int(11) NOT NULL,
  `productName` varchar(70) NOT NULL,
  `buyPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productCode`, `productName`, `buyPrice`) VALUES
(3, '1952 Alpine Renault 1300', 150.00),
(4, '1996 Moto Guzzi 1100i', 68.99),
(5, '2003 Harley-Davidson Eagle Drag Bike', 91.02),
(6, '1972 Alfa Romeo GTA', 85.68),
(7, '1962 LanciaA Delta 16V', 103.42),
(8, '1968 Ford Mustang', 95.34),
(9, '2001 Ferrari Enzo', 95.59),
(10, '1958 Setra Bus1', 77.90),
(11, '2002 Suzuki XREO', 66.27),
(12, '1969 Corvair Monza', 89.14),
(13, '1968 Dodge Charger', 75.16),
(14, '1969 Ford Falcon', 83.05),
(15, '1970 Plymouth Hemi Cuda', 31.92),
(16, '1957 Chevy Pickup', 55.70),
(17, '1969 Dodge Charger', 58.73),
(18, '1940 Ford Pickup Truck', 58.33),
(19, '1993 Mazda RX-7', 83.51),
(20, '1937 Lincoln Berline', 60.62),
(21, '1936 Mercedes-Benz 500K Special Roadster1', 24.26),
(22, '1965 Aston Martin DB5', 65.96),
(23, '1980s Black Hawk Helicopter', 77.27),
(24, '1917 Grand Touring Sedan', 86.70),
(25, '1948 Porsche 356-A Roadster', 53.90),
(26, '1995 Honda Civic', 93.89),
(27, '1998 Chrysler Plymouth Prowler', 101.51),
(28, '1911 Ford Town Car', 33.30),
(29, '1964 Mercedes Tour Bus', 74.86),
(30, '1932 Model A Ford J-Coupe', 58.48),
(31, '1926 Ford Fire Engine', 24.92),
(32, 'P-51-D Mustang', 49.00),
(33, '1936 Harley Davidson El Knucklehead', 24.23),
(34, '1928 Mercedes-Benz SSK', 72.56),
(35, '1999 Indy 500 Monte Carlo SS', 56.76),
(36, '1913 Ford Model T Speedster', 60.78),
(37, '1934 Ford V8 Coupe', 34.35),
(38, '1999 Yamaha Speed Boat', 51.61),
(39, '18th Century Vintage Horse Carriage', 60.74),
(40, '1903 Ford Model A', 68.30),
(41, '1992 Ferrari 360 Spider red', 77.90),
(42, '1985 Toyota Supra', 57.01),
(43, 'Collectable Wooden Train', 67.56),
(44, '1969 Dodge Super Bee', 49.05),
(45, '1917 Maxwell Touring Car', 57.54),
(46, '1976 Ford Gran Torino', 73.49),
(47, '1948 Porsche Type 356 Roadster', 62.16),
(48, '1957 Vespa GS150', 32.95),
(49, '1941 Chevrolet Special Deluxe Cabriolet', 64.58),
(50, '1970 Triumph Spitfire', 91.92),
(51, '1932 Alfa Romeo 8C2300 Spider Sport', 43.26),
(52, '1904 Buick Runabout', 52.66),
(53, '1940s Ford truck', 84.76),
(54, '1939 Cadillac Limousine', 23.14),
(55, '1957 Corvette Convertible', 69.93),
(56, '1957 Ford Thunderbird', 34.21),
(57, '1970 Chevy Chevelle SS 454', 49.24),
(58, '1970 Dodge Coronet', 32.37),
(59, '1997 BMW R 1100 S', 60.86),
(60, '1966 Shelby Cobra 427 S/C', 29.18),
(61, '1928 British Royal Navy Airplane', 66.74),
(62, '1939 Chevrolet Deluxe Coupe', 22.57),
(63, '1960 BSA Gold Star DBD34', 37.32),
(64, '18th century schooner', 82.34),
(65, '1938 Cadillac V-16 Presidential Limousine', 20.61),
(66, '1962 Volkswagen Microbus', 61.34),
(67, '1982 Ducati 900 Monster', 47.10),
(68, '1949 Jaguar XK 120', 47.25),
(69, '1958 Chevy Corvette Limited Edition', 15.91),
(70, '1900s Vintage Bi-Plane', 34.25),
(71, '1952 Citroen-15CV', 72.82),
(72, '1982 Lamborghini Diablo', 16.24),
(73, '1912 Ford Model T Delivery Wagon', 46.91),
(74, '1969 Chevrolet Camaro Z28', 50.51),
(75, '1971 Alpine Renault 1600s', 38.58),
(76, '1937 Horch 930V Limousine', 26.30),
(77, '2002 Chevy Corvette', 62.11),
(78, '1940 Ford Delivery Sedan', 48.64),
(79, '1956 Porsche 356A Coupe', 98.30),
(80, 'Corsair F4U ( Bird Cage)', 29.34),
(81, '1936 Mercedes Benz 500k Roadster', 21.75),
(82, '1992 Porsche Cayenne Turbo Silver', 69.78),
(83, '1936 Chrysler Airflow', 57.46),
(84, '1900s Vintage Tri-Plane', 36.23),
(85, '1961 Chevrolet Impala', 32.33),
(86, '1980’s GM Manhattan Express', 53.93),
(87, '1997 BMW F650 ST', 66.92),
(88, '1982 Ducati 996 R', 24.14),
(89, '1954 Greyhound Scenicruiser', 25.98),
(90, '1950\'s Chicago Surface Lines Streetcar', 26.72),
(91, '1996 Peterbilt 379 Stake Bed with Outrigger', 33.61),
(92, '1928 Ford Phaeton Deluxe', 33.02),
(93, '1974 Ducati 350 Mk3 Desmo', 56.13),
(94, '1930 Buick Marquette Phaeton', 27.06),
(95, 'Diamond T620 Semi-Skirted Tanker', 68.29),
(96, '1962 City of Detroit Streetcar', 37.49),
(97, '2002 Yamaha YZR M1', 34.17),
(98, 'The Schooner Bluenose', 34.00),
(99, 'American Airlines: B767-300', 51.15),
(100, 'The Mayflower', 43.30),
(101, 'HMS Bounty', 39.83),
(102, 'America West Airlines B757-200', 68.80),
(103, 'The USS Constitution Ship', 33.97),
(104, '1982 Camaro Z28', 46.53),
(105, 'ATA: B757-300', 59.33),
(106, 'F/A 18 Hornet 1/72', 54.40),
(107, 'The Titanic', 51.09),
(108, 'The Queen Mary', 53.63),
(109, 'American Airlines: MD-11S', 36.27),
(110, 'Boeing X-32A JSF', 32.77),
(111, 'Pont Yacht', 33.30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `productCode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

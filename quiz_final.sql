-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 07:42 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `options_master`
--

CREATE TABLE `options_master` (
  `option_id` int(11) NOT NULL,
  `option_name` text NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options_master`
--

INSERT INTO `options_master` (`option_id`, `option_name`, `question_id`) VALUES
(1, '5cm', 1),
(2, '4cm', 1),
(3, '3cm', 1),
(4, '6cm', 1),
(5, '15 cm', 2),
(6, '25 cm', 2),
(7, '35 cm', 2),
(8, '42 cm', 2),
(9, '123', 3),
(10, '127', 3),
(11, '235', 3),
(12, '305', 3),
(13, '1677', 4),
(14, '1683', 4),
(15, '2523', 4),
(16, '3363', 4),
(17, '26 minutes and 18 seconds', 5),
(18, '42 minutes and 36 seconds', 5),
(19, '45 minutes', 5),
(20, '46 minutes and 12 seconds', 5),
(21, '3/2b³', 6),
(22, '3/4b³', 6),
(23, '1/2b³', 6),
(24, '2b³', 6),
(25, 'x > 6', 7),
(26, 'x < 5', 7),
(27, 'x < 7', 7),
(28, 'x > 2', 7),
(29, 'a² - c² + 2ab cos A', 8),
(30, 'a³ + c³ - 3ab cos A', 8),
(31, 'a² + c² - 2ac cos B', 8),
(32, 'a² - c² 4bc cos A', 8),
(33, '$117,500', 9),
(34, '$124,500', 9),
(35, '$112,500', 9),
(36, '$122,500', 9),
(37, '38.36 cm²', 10),
(38, '42.36 cm²', 10),
(39, '25 cm²', 10),
(40, '24.35 cm²', 10),
(41, 'expression', 11),
(42, 'equation', 11),
(43, 'sentence', 11),
(44, 'inequation', 11),
(45, 'right', 12),
(46, 'acute', 12),
(47, 'obtuse', 12),
(48, 'supplementary', 12),
(49, '3975', 13),
(50, '1875', 13),
(51, '1585', 13),
(52, '3185', 13),
(53, '175', 14),
(54, '150', 14),
(55, '166', 14),
(56, '180', 14),
(57, '{2, 4, 5}', 15),
(58, '{2, 4}', 15),
(59, '{1, 2, 3, 4, 5}', 15),
(60, '{1, 3, 5}', 15),
(61, 'mid point', 16),
(62, 'upper class boundaries', 16),
(63, 'class limits', 16),
(64, 'frequency distribution', 16),
(65, 'real, equal', 17),
(66, 'real, unequal', 17),
(67, 'imaginary', 17),
(68, 'irrational', 17),
(69, 'subset', 18),
(70, 'domain of relation', 18),
(71, 'range of relation', 18),
(72, 'complement of a set', 18),
(73, 'polynomials', 19),
(74, 'odd numbers', 19),
(75, 'even numbers', 19),
(76, 'surds', 19),
(77, 'triangle', 20),
(78, 'rectangle', 20),
(79, 'hexagon', 20),
(80, 'circle', 20);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_master`
--

CREATE TABLE `quiz_master` (
  `quiz_id` int(11) NOT NULL,
  `quiz_name` text NOT NULL,
  `no_of_questions` bigint(20) NOT NULL,
  `each_marks` bigint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quiz_master`
--

INSERT INTO `quiz_master` (`quiz_id`, `quiz_name`, `no_of_questions`, `each_marks`) VALUES
(1, 'Maths', 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `q_and_a_master`
--

CREATE TABLE `q_and_a_master` (
  `question_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `option_id` int(11) NOT NULL COMMENT 'Answer',
  `suggestion` text NOT NULL COMMENT 'This will display on Suggestion (If Wrong Answer.)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `q_and_a_master`
--

INSERT INTO `q_and_a_master` (`question_id`, `question`, `quiz_id`, `option_id`, `suggestion`) VALUES
(1, 'Lengths of sides of triangle are x cm,(x + 1) cm and (x + 2) cm, value of x when triangle is right angled is', 1, 3, '(x+2)² = x² + (x+1)²\r\n? x² + 4x + 4 = x² + x² + 2x + 1\r\n? x² + 4x + 4 = 2x² + 2x + 1\r\n? 2x² - x² + 2x - 4x + 1 - 4 = 0\r\n? x² - 2x - 3 = 0\r\n? x² - 3x + x - 3  = 0\r\n? x(x-3) + 1(x-3) = 0\r\n? (x - 3)(x + 1) = 0\r\n? x = 3,  (-1 is not possible)\r\n\r\nSo x = 3.'),
(2, 'The greatest possible length which can be used to measure exactly the lengths 7 m, 3 m 85 cm, 12 m 95 cm is:', 1, 7, 'Required length = H.C.F. of 700 cm, 385 cm and 1295 cm = 35 cm.'),
(3, 'The greatest number which on dividing 1657 and 2037 leaves remainders 6 and 5 respectively, is:', 1, 10, 'H.C.F. of 1651 and 2032 = 127.'),
(4, 'What is the least number which when divided by 5, 6, 7 and 8 leaves a remainder 3, but when divided by 9 leaves no remainder?', 1, 14, 'LCM of 5, 6, 7 and 8 = 840\r\nHence the number can be written in the form (840k + 3) which is divisible by 9\r\nIf k = 1, number = (840 × 1) + 3 = 843 which is not divisible by 9\r\nIf k = 2, number = (840 × 2) + 3 = 1683 which is divisible by 9\r\nHence, 1683 is the least number which when divided by 5, 6, 7 and 8 leaves a remainder 3, but when divided by 9 leaves no remainder'),
(5, 'A, B and C start at the same time in the same direction to run around a circular stadium. A completes a round in 252 seconds, B in 308 seconds and c in 198 seconds, all starting at the same point. After what time will they again at the starting point?', 1, 20, 'A complete his round in 252 seconds.\r\n\r\nB completes his round in 308 seconds.\r\n\r\nC completes his round in 198 seconds.\r\n\r\nThey will agian at starting together after,\r\n\r\nLCM of 252, 308 and 198.\r\n\r\n252 = 2 *2 *3*3*7\r\n\r\n308 = 2 *2*7*11\r\n\r\n198 = 2 *3*3*11\r\n\r\nRequired LCM = 2*2*3*3*7*11 = 2772 seconds = 46 minutes 12 seconds.'),
(6, 'By simplifying following 2b4 x 8b7 / 16b5 x 2b³, answer will be', 1, 23, '2b4 x 8b7 / 16b5 x 2b³ = 1/2b³'),
(7, 'By solving inequality 6x - 7 > 5, answer will be', 1, 28, '6x - 7 > 5 = x > 2'),
(8, 'For Cosine Rule of any triangle ABC, b² is equal to', 1, 31, 'a² + c² - 2ac cos B'),
(9, 'If Ana sells her house at loss of 10% on cost and paid $125000 for it then its selling price is', 1, 35, '$112,500'),
(10, 'If a = 9.7 cm, angle B = 64° and c = 8.8 cm then area of ? ABC is', 1, 37, '38.36 cm²'),
(11, '3x + 2y -3 is an algebraic', 1, 41, 'expression'),
(12, 'If a, b and c are sides of a triangle and if a² + b² = c² then triangle is', 1, 45, 'right'),
(13, 'Annual income of a person is $530,000 and exempted amount is $280,000. income tax payable at rate of 0.75% would be', 1, 50, '1875'),
(14, 'An Airplane carries 500 passengers, 45% are men, 20% are children. number of women in airplane is', 1, 53, '175'),
(15, 'If U={1, 2, 3, 4, 5} and A={2, 4} then A\' should be', 1, 60, '{1, 3, 5}'),
(16, 'In a cumulative frequency polygon, frequencies are plotted against', 1, 62, 'upper class boundaries'),
(17, 'Roots of equation 9x² - 9x + 1 = 0 are', 1, 65, 'real, equal'),
(18, 'Set consisting of all first elements of each ordered pair in relation is called', 1, 70, 'domain of relation'),
(19, 'In algebric fractions, numerators and denominators are', 1, 73, 'polynomials'),
(20, 'Locus of a point in a plane equidistant from a fixed point is known as', 1, 80, 'circle');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_id` int(11) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_id`, `username`, `password`, `is_admin`) VALUES
(1, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz_mapper`
--

CREATE TABLE `user_quiz_mapper` (
  `mapper_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `options_master`
--
ALTER TABLE `options_master`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `quiz_master`
--
ALTER TABLE `quiz_master`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `q_and_a_master`
--
ALTER TABLE `q_and_a_master`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_quiz_mapper`
--
ALTER TABLE `user_quiz_mapper`
  ADD PRIMARY KEY (`mapper_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `options_master`
--
ALTER TABLE `options_master`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `quiz_master`
--
ALTER TABLE `quiz_master`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `q_and_a_master`
--
ALTER TABLE `q_and_a_master`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_quiz_mapper`
--
ALTER TABLE `user_quiz_mapper`
  MODIFY `mapper_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `options_master`
--
ALTER TABLE `options_master`
  ADD CONSTRAINT `options_master_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `q_and_a_master` (`question_id`);

--
-- Constraints for table `q_and_a_master`
--
ALTER TABLE `q_and_a_master`
  ADD CONSTRAINT `q_and_a_master_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz_master` (`quiz_id`);

--
-- Constraints for table `user_quiz_mapper`
--
ALTER TABLE `user_quiz_mapper`
  ADD CONSTRAINT `user_quiz_mapper_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz_master` (`quiz_id`),
  ADD CONSTRAINT `user_quiz_mapper_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

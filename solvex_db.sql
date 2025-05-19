-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 18, 2025 at 03:07 PM
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
-- Database: `solvex_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `EOI`
--

CREATE TABLE `EOI` (
  `EOInumber` int(11) NOT NULL,
  `job_ref` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` enum('male','female','other','') NOT NULL,
  `street` varchar(50) NOT NULL,
  `suburb` varchar(50) NOT NULL,
  `state` enum('vic','nsw','qld','nt','wa','sa','tas','act') NOT NULL,
  `postcode` char(4) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `skill_tableau` varchar(1) DEFAULT NULL,
  `skill_google` varchar(1) DEFAULT NULL,
  `skill_python` varchar(1) DEFAULT NULL,
  `skill_r` varchar(1) DEFAULT NULL,
  `skill_sql` varchar(1) DEFAULT NULL,
  `skill_relational` varchar(1) DEFAULT NULL,
  `other` varchar(1) DEFAULT NULL,
  `other_skills` varchar(100) DEFAULT NULL,
  `Status` enum('New','Current','Final','') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `job_id` int(11) NOT NULL,
  `job_ref` varchar(10) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `preferred` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`job_id`, `job_ref`, `title`, `salary`, `location`, `mode`, `description`, `responsibilities`, `requirements`, `preferred`, `image_path`) VALUES
(1, '00125', 'Network Administrator', '$195,000+', '57 ValeTech Avenue, 3rd Floor, Nova Park Business District, Riverton, CA 90231, Victoria', 'Hybrid', 'Solvex is seeking a dedicated Network Administrator to manage and maintain our networks, ensuring high availability and security.', '<ul><li>Monitor and optimize networks</li><li>Configure firewalls, switches</li><li>Support internal teams</li></ul>', '<ol><li>Strong knowledge of TCP/IP, DNS, DHCP</li><li>Degree in IT</li></ol>', '<ul><li>2+ years of experience</li><li>CCNA Certification</li></ul>', 'images/network_icon.png'),
(2, '00130', 'Data Analyst', '$225,000+', '57 ValeTech Avenue, 3rd Floor, Nova Park Business District, Riverton, CA 90231, Victoria', 'Remote/Hybrid', 'Solvex is hiring a Data Analyst to translate data into insights and help drive business decisions.', '<ul><li>Analyze user data</li><li>Create reports and dashboards</li><li>Collaborate across teams</li></ul>', '<ol><li>Strong analytical skills</li><li>Degree in Data Science or Statistics</li></ol>', '<ul><li>Experience with Python or SQL</li><li>Power BI knowledge</li></ul>', 'images/analyst_icon.png'),
(3, '00135', 'Cybersecurity Specialist', '$300,000+', '57 ValeTech Avenue, 3rd Floor, Nova Park Business District, Riverton, CA 90231, Victoria', 'On-site', 'Solvex needs a Cybersecurity Specialist to secure our digital systems and handle incident responses.', '<ul><li>Monitor for security threats</li><li>Apply patches and audits</li><li>Develop security policies</li></ul>', '<ol><li>Understanding of firewalls, antivirus</li><li>Degree in Cybersecurity</li></ol>', '<ul><li>2+ years of experience</li><li>CISSP or CEH certification</li></ul>', 'images/cyber_icon.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `EOI`
--
ALTER TABLE `EOI`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`job_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `EOI`
--
ALTER TABLE `EOI`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

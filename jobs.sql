-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `job_id` INT AUTO_INCREMENT PRIMARY KEY,
  `job_ref` VARCHAR(10),
  `title` VARCHAR(100),
  `salary` VARCHAR(50),
  `location` VARCHAR(255),
  `mode` VARCHAR(50),
  `description` TEXT,
  `responsibilities` TEXT,
  `requirements` TEXT,
  `preferred` TEXT,
  `image_path` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Insert data into table `jobs`

INSERT INTO `jobs` (`job_ref`, `title`, `salary`, `location`, `mode`, `description`, `responsibilities`, `requirements`, `preferred`, `image_path`) VALUES
('00125', 'Network Administrator', '$195,000+', '57 ValeTech Avenue, 3rd Floor, Nova Park Business District, Riverton, CA 90231, Victoria', 'Hybrid',
'Solvex is seeking a dedicated Network Administrator to manage and maintain our networks, ensuring high availability and security.',
'<ul><li>Monitor and optimize networks</li><li>Configure firewalls, switches</li><li>Support internal teams</li></ul>',
'<ol><li>Strong knowledge of TCP/IP, DNS, DHCP</li><li>Degree in IT</li></ol>',
'<ul><li>2+ years of experience</li><li>CCNA Certification</li></ul>',
'images/network_icon.png'),

('00130', 'Data Analyst', '$225,000+', '57 ValeTech Avenue, 3rd Floor, Nova Park Business District, Riverton, CA 90231, Victoria', 'Remote/Hybrid',
'Solvex is hiring a Data Analyst to translate data into insights and help drive business decisions.',
'<ul><li>Analyze user data</li><li>Create reports and dashboards</li><li>Collaborate across teams</li></ul>',
'<ol><li>Strong analytical skills</li><li>Degree in Data Science or Statistics</li></ol>',
'<ul><li>Experience with Python or SQL</li><li>Power BI knowledge</li></ul>',
'images/analyst_icon.png'),

('00135', 'Cybersecurity Specialist', '$300,000+', '57 ValeTech Avenue, 3rd Floor, Nova Park Business District, Riverton, CA 90231, Victoria', 'On-site',
'Solvex needs a Cybersecurity Specialist to secure our digital systems and handle incident responses.',
'<ul><li>Monitor for security threats</li><li>Apply patches and audits</li><li>Develop security policies</li></ul>',
'<ol><li>Understanding of firewalls, antivirus</li><li>Degree in Cybersecurity</li></ol>',
'<ul><li>2+ years of experience</li><li>CISSP or CEH certification</li></ul>',
'images/cyber_icon.png');

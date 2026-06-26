
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Database: `bbdms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'kajal', 9021905168, 'kt31102004@gmail.com', 'Test@123', '2024-01-01 04:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblblooddonars`
--
CREATE TABLE `tblblooddonars` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `Gender` varchar(20) DEFAULT NULL,
  `Age` int(11) DEFAULT NULL,
  `Weight` varchar(10) DEFAULT NULL,   -- ✅ NEW COLUMN ADDED
  `BloodGroup` varchar(20) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)   -- ✅ Primary key bhi fix kiya
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


















-------CREATE TABLE `tblblooddonars` (
 ------------ `id` int(11) NOT NULL,
-----------------  `FullName` varchar(100) DEFAULT NULL,
 ------------ `MobileNumber` char(11) DEFAULT NULL,
-------------`EmailId` varchar(100) DEFAULT NULL,
  ---`Gender` varchar(20) DEFAULT NULL,
  ---`Age` int(11) DEFAULT NULL,
  ----`BloodGroup` varchar(20) DEFAULT NULL,
  ---`Address` varchar(255) DEFAULT NULL,
  ------`Message` mediumtext DEFAULT NULL,
  ------`PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  --------`status` int(1) DEFAULT NULL,
 -------- `Password` varchar(250) DEFAULT NULL
---------) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblblooddonars`
--

INSERT INTO `tblblooddonars` (`id`, `FullName`, `MobileNumber`, `EmailId`, `Gender`, `Age`, `BloodGroup`, `Address`, `Message`, `PostingDate`, `status`, `Password`) VALUES
(1, 'kajal tiwari', '9021905168', 'kajaljtiwari@gmail.com', 'female', 20, 'O+', 'at rohna', 'hii.. i will help you guys in any time', '2024-01-02 12:43:41', 1, 'oct2004'),
(2, 'janvi jadhav', '9021905168', 'jj822004@gmail.com', 'female', 20, 'A+', 'at murtizapur', 'hii i will help you', '2024-01-03 06:09:08', 1, 'feb2004'),
(3, 'Gauravi naitam', '9021905168', 'gn9604@gmail.com', 'female', 20, 'B+', 'at paras', 'hiii i can help you', '2024-01-03 01:50:58', 1, 'june2004'),
(4, 'gaytri marke', '9021905168', 'ggm@gmail.com', 'female', 20, 'O+', 'at wadegao', 'hellow', '2024-01-04 01:22:52', 1, 'gm2004'),
(5, 'kirti shukla', '9021905168', 'daiwikshukla@gmail.com', 'female', 20, 'A+', 'salasar malakapur', 'hii', '2024-01-05 17:31:08', 1, '@paru125');
-- --------------------------------------------------------

--
-- Table structure for table `tblbloodgroup`
--

CREATE TABLE `tblbloodgroup` (
  `id` int(11) NOT NULL,
  `BloodGroup` varchar(20) DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbloodgroup`
--

INSERT INTO `tblbloodgroup` (`id`, `BloodGroup`, `PostingDate`) VALUES
(1, 'A-', '2024-01-01 20:33:50'),
(2, 'AB-', '2024-01-01 20:33:50'),
(3, 'O-', '2024-01-01 20:33:50'),
(4, 'O+', '2024-01-01 20:33:50'),
(5, 'A+', '2024-01-01 20:33:50'),
(6, 'B+', '2024-01-01 20:33:50');
(7, 'AB+', '2024-01-01 20:33:50');
(8, 'B-', '2024-01-01 20:33:50'),

-- --------------------------------------------------------

--
---Table structure for table `tblbloodcomponent`
--

CREATE TABLE `tblbloodcomponent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bloodcomponent` varchar(50) NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);

-- Dumping data for table `tblbloodgroup`
--

INSERT INTO `tblbloodcomponent` (`bloodcomponent`) VALUES
('Whole Blood'),
('Plasma'),
('Platelets'),
('Red Blood Cells');



-- --------------------------------------------------------

--



-- Table structure for table `tblbloodrequirer`
--

CREATE TABLE `tblbloodrequirer` (
  `ID` int(10) NOT NULL,
  `BloodDonarID` int(10) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `EmailId` varchar(250) DEFAULT NULL,
  `ContactNumber` bigint(10) DEFAULT NULL,
  `BloodRequirefor` varchar(250) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `ApplyDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbloodrequirer`
--

INSERT INTO `tblbloodrequirer` (`ID`, `BloodDonarID`, `name`, `EmailId`, `ContactNumber`, `BloodRequirefor`, `Message`, `ApplyDate`) VALUES
(1, 1, 'khushi khirade', 'kk@gmail.com', 7894561236, 'Father', 'Please help', '2024-01-06 11:57:24'),
(2, 2, 'payal kulkarni', 'payu@gmail.com', 5896231478, 'Others', 'Please help', '2024-01-06 11:58:48'),
(3, 3, 'Hitesh tiwari ', 'tiwari@gmail.com', 1236547896, 'Wife', 'help us', '2024-01-07 12:02:12'),
(4, 4, 'Rahul Singh', 'rahk@gmail.com', 2536251425, 'Mother', 'Please help me', '2024-01-08 01:51:52'),
(5, 5, 'Anuj Kumar', 'ak@gmail.com', 8525232102, 'Others', 'Need blood on urgent basis', '2024-01-08 01:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'Test Demo test demo																									', 'test@test.com', '8585233222');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(2, 'Why Become Donor', 'donor', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat</span>'),
(3, 'About Us ', 'aboutus', '<div style=\"text-align: justify;\"><span style=\"font-size: 1em; color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif;\">Welcome to the blood bank donor management system.</span></div>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblblooddonars`
--
ALTER TABLE `tblblooddonars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bgroup` (`BloodGroup`);

--
-- Indexes for table `tblbloodgroup`
---ALTER TABLE `tblbloodgroup`
 --- ADD PRIMARY KEY (`id`),
  ---ADD KEY `BloodGroup` (`BloodGroup`),
  --ADD KEY `BloodGroup_2` (`BloodGroup`); --








--
-- Indexes for table `tblbloodrequirer`
--
ALTER TABLE `tblbloodrequirer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `donorid` (`BloodDonarID`);

--
-- Indexes for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblblooddonars`
--
ALTER TABLE `tblblooddonars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tblbloodgroup`
--
ALTER TABLE `tblbloodgroup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblbloodrequirer`
--
ALTER TABLE `tblbloodrequirer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

---my
SELECT BloodGroup, COUNT(*) as total_units
FROM tblblooddonars
GROUP BY BloodGroup


CREATE TABLE tblbloodcomponents (
    id INT(11) NOT NULL AUTO_INCREMENT,
    BloodGroup VARCHAR(5) NOT NULL,
    ComponentType VARCHAR(50) NOT NULL,
    Quantity INT(11) NOT NULL DEFAULT 0,
    ExpiryDate DATE NOT NULL,
    CreatedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    UpdatedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
  CREATE TABLE notices (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
CREATE TABLE feedback (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(100),
    email VARCHAR(100),
    message TEXT,
    rating INT(11),
    submitted_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);
CREATE TABLE faq (
    id INT(11) NOT NULL AUTO_INCREMENT,
    question VARCHAR(255),
    answer TEXT,
    PRIMARY KEY (id)
);
CREATE TABLE blood_stock (
    id INT(11) NOT NULL AUTO_INCREMENT,
    BloodGroup VARCHAR(5),
    UnitsAvailable INT(11),
    PRIMARY KEY (id)
);

CREATE TABLE tblrecipientslist (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    FullName VARCHAR(100) NOT NULL,
    Gender ENUM('Male', 'Female', 'Other') NOT NULL,
    Age INT(11) NOT NULL,
    Contact VARCHAR(15) DEFAULT NULL,
    Address TEXT DEFAULT NULL,
    BloodType VARCHAR(5) NOT NULL,
    ComponentTaken VARCHAR(50) NOT NULL,
    BagType ENUM('Single', 'Double', 'Triple') NOT NULL,
    Quantity VARCHAR(50) DEFAULT NULL,
    CreatedAt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID)
);

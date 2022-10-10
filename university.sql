-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2022 at 10:30 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `nom`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant`
--

CREATE TABLE `enseignant` (
  `matricule` int(11) NOT NULL,
  `qualifications` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `matricule` int(11) NOT NULL,
  `filiereID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`matricule`, `filiereID`) VALUES
(37, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `abbrevation` varchar(5) NOT NULL,
  `designation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `liste_inscription`
--

CREATE TABLE `liste_inscription` (
  `cin` int(11) NOT NULL,
  `nomprenom` varchar(40) NOT NULL,
  `role` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `liste_inscription`
--

INSERT INTO `liste_inscription` (`cin`, `nomprenom`, `role`) VALUES
(11112333, 'Things The Thing', 3),
(12312312, 'QSDQSDQS', 1),
(12345679, 'Mahdi Abdelkebir', 2);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `matricule` int(11) NOT NULL,
  `CIN` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  `adresse` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `dateNaissance` date NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT current_timestamp(),
  `isActive` tinyint(1) NOT NULL DEFAULT 0,
  `role` int(11) NOT NULL,
  `activationCode` varchar(100) NOT NULL,
  `activationExpiry` datetime NOT NULL DEFAULT current_timestamp(),
  `departmentID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`matricule`, `CIN`, `nom`, `prenom`, `sexe`, `email`, `adresse`, `password`, `dateNaissance`, `dateInscription`, `isActive`, `role`, `activationCode`, `activationExpiry`, `departmentID`) VALUES
(1, 1111, 'Website', 'Admin', 1, 'admin@gmail.com', 'adrrr', 'azeaze', '2022-09-01', '2022-09-30 20:06:49', 1, 0, '', '2022-10-01 00:49:39', 1),
(37, 12345679, 'QSD', 'QD', 1, 'gamezrookie@gmail.com', 'QDSQ', 'Bt7N55D5', '2022-10-04', '2022-10-09 20:24:52', 1, 3, 'ce4f758186bd20f68f6ec9f1508355d5', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `website_config`
--

CREATE TABLE `website_config` (
  `inscription` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website_config`
--

INSERT INTO `website_config` (`inscription`) VALUES
(1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`matricule`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`matricule`),
  ADD KEY `filiereConstraint` (`filiereID`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liste_inscription`
--
ALTER TABLE `liste_inscription`
  ADD PRIMARY KEY (`cin`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`matricule`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `CIN` (`CIN`),
  ADD KEY `depConstraint` (`departmentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liste_inscription`
--
ALTER TABLE `liste_inscription`
  MODIFY `cin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12345680;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `matricule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enseignant`
--
ALTER TABLE `enseignant`
  ADD CONSTRAINT `cc` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `filiereConstraint` FOREIGN KEY (`filiereID`) REFERENCES `filiere` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `matConstraint` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`) ON UPDATE CASCADE;

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `depConstraint` FOREIGN KEY (`departmentID`) REFERENCES `department` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

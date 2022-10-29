-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 08:25 PM
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
-- Table structure for table `affecter`
--

CREATE TABLE `affecter` (
  `id` int(11) NOT NULL,
  `matiereId` int(11) NOT NULL,
  `salleNom` varchar(20) NOT NULL,
  `sceanceNum` int(11) NOT NULL,
  `jourNum` int(11) NOT NULL,
  `groupId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `anne`
--

CREATE TABLE `anne` (
  `anne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `parcoursNom` varchar(20) NOT NULL,
  `sessionNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `nom`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'c'),
(4, 'd');

-- --------------------------------------------------------

--
-- Table structure for table `enseignant_matiere`
--

CREATE TABLE `enseignant_matiere` (
  `matricule` int(11) NOT NULL,
  `matiereID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `matricule` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`matricule`, `groupId`) VALUES
(8, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `classeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jour`
--

CREATE TABLE `jour` (
  `numero` int(11) NOT NULL,
  `nom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `liste_inscription`
--

CREATE TABLE `liste_inscription` (
  `cin` int(11) NOT NULL,
  `nomprenom` varchar(40) NOT NULL,
  `role` int(10) NOT NULL,
  `departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `liste_inscription`
--

INSERT INTO `liste_inscription` (`cin`, `nomprenom`, `role`, `departmentID`) VALUES
(12222222, 'AAA AA', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `coefficient_mat` decimal(5,3) NOT NULL,
  `credit_mat` decimal(5,3) NOT NULL,
  `heursCours` decimal(3,2) NOT NULL,
  `heursTP` decimal(3,2) NOT NULL,
  `uniteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parcours`
--

CREATE TABLE `parcours` (
  `nom` varchar(20) NOT NULL,
  `sessionNumero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `planetude`
--

CREATE TABLE `planetude` (
  `id` int(11) NOT NULL,
  `parcoursID` int(11) NOT NULL,
  `dateDebut` datetime NOT NULL DEFAULT current_timestamp(),
  `dateFin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sceance`
--

CREATE TABLE `sceance` (
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `semestre`
--

CREATE TABLE `semestre` (
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `numero` int(11) NOT NULL,
  `anne` int(11) NOT NULL,
  `semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unites`
--

CREATE TABLE `unites` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `type` varchar(25) NOT NULL,
  `planEtudeId` int(11) NOT NULL,
  `semestreNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `matricule` int(11) NOT NULL,
  `cin` int(8) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `sexe` tinyint(1) NOT NULL,
  `dateNaissance` date NOT NULL,
  `adresse` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `departmentID` int(11) NOT NULL,
  `dateInscription` datetime NOT NULL DEFAULT current_timestamp(),
  `isConfirmed` tinyint(1) NOT NULL DEFAULT 0,
  `isActive` tinyint(1) NOT NULL DEFAULT 0,
  `activationCode` varchar(100) NOT NULL,
  `activationExpiry` datetime NOT NULL DEFAULT current_timestamp(),
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`matricule`, `cin`, `nom`, `prenom`, `sexe`, `dateNaissance`, `adresse`, `email`, `password`, `departmentID`, `dateInscription`, `isConfirmed`, `isActive`, `activationCode`, `activationExpiry`, `role`) VALUES
(1, 0, 'Mahdi', 'Abdelkebir', 1, '2022-10-12', '', 'admin@gmail.com', 'azeaze', 1, '2022-10-16 19:28:46', 1, 1, '', '2022-10-16 19:28:46', 0),
(8, 12222222, 'aa', 'aa', 1, '2022-10-20', 'aa', 'gamezrookie@gmail.com', '', 1, '2022-10-29 18:40:01', 0, 0, 'acbde2a0780dbeb748c9ff915fa9a0af', '2022-10-29 18:40:01', 4);

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
(1),
(1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affecter`
--
ALTER TABLE `affecter`
  ADD KEY `matiereConstrain` (`matiereId`),
  ADD KEY `salleConstraint` (`salleNom`),
  ADD KEY `sceanceConstraint` (`sceanceNum`),
  ADD KEY `jourConstraint` (`jourNum`),
  ADD KEY `affecter_groupConstraint` (`groupId`);

--
-- Indexes for table `anne`
--
ALTER TABLE `anne`
  ADD PRIMARY KEY (`anne`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentConstraint` (`departmentID`),
  ADD KEY `parcoursConstraint` (`parcoursNom`),
  ADD KEY `sessionConstrain` (`sessionNum`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enseignant_matiere`
--
ALTER TABLE `enseignant_matiere`
  ADD KEY `em_matiereConstraint` (`matiereID`),
  ADD KEY `em_matriculeConstraint` (`matricule`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`matricule`),
  ADD KEY `groupeConstraint` (`groupId`);

--
-- Indexes for table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classeConstraint` (`classeId`);

--
-- Indexes for table `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `liste_inscription`
--
ALTER TABLE `liste_inscription`
  ADD PRIMARY KEY (`cin`),
  ADD KEY `role` (`role`),
  ADD KEY `inscription_depC` (`departmentID`);

--
-- Indexes for table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uniteConstraint` (`uniteID`);

--
-- Indexes for table `parcours`
--
ALTER TABLE `parcours`
  ADD PRIMARY KEY (`nom`),
  ADD KEY `sessionConstraint` (`sessionNumero`);

--
-- Indexes for table `planetude`
--
ALTER TABLE `planetude`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`nom`);

--
-- Indexes for table `sceance`
--
ALTER TABLE `sceance`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`numero`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `anneConstraint` (`anne`),
  ADD KEY `semestreConstraint` (`semestre`);

--
-- Indexes for table `unites`
--
ALTER TABLE `unites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `planEtudeConstraint` (`planEtudeId`),
  ADD KEY `semestreConstraint2` (`semestreNum`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`matricule`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `depConstraint` (`departmentID`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `matricule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affecter`
--
ALTER TABLE `affecter`
  ADD CONSTRAINT `affecter_groupConstraint` FOREIGN KEY (`groupId`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `jourConstraint` FOREIGN KEY (`jourNum`) REFERENCES `jour` (`numero`),
  ADD CONSTRAINT `matiereConstrain` FOREIGN KEY (`matiereId`) REFERENCES `matiere` (`id`),
  ADD CONSTRAINT `salleConstraint` FOREIGN KEY (`salleNom`) REFERENCES `salle` (`nom`),
  ADD CONSTRAINT `sceanceConstraint` FOREIGN KEY (`sceanceNum`) REFERENCES `sceance` (`numero`);

--
-- Constraints for table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `departmentConstraint` FOREIGN KEY (`departmentID`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `parcoursConstraint` FOREIGN KEY (`parcoursNom`) REFERENCES `parcours` (`nom`),
  ADD CONSTRAINT `sessionConstrain` FOREIGN KEY (`sessionNum`) REFERENCES `session` (`numero`);

--
-- Constraints for table `enseignant_matiere`
--
ALTER TABLE `enseignant_matiere`
  ADD CONSTRAINT `em_matiereConstraint` FOREIGN KEY (`matiereID`) REFERENCES `matiere` (`id`),
  ADD CONSTRAINT `em_matriculeConstraint` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`);

--
-- Constraints for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `groupeConstraint` FOREIGN KEY (`groupId`) REFERENCES `groupe` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `matriculeConstraint` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`) ON DELETE CASCADE;

--
-- Constraints for table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `classeConstraint` FOREIGN KEY (`classeId`) REFERENCES `classe` (`id`);

--
-- Constraints for table `liste_inscription`
--
ALTER TABLE `liste_inscription`
  ADD CONSTRAINT `inscription_depC` FOREIGN KEY (`departmentID`) REFERENCES `department` (`id`);

--
-- Constraints for table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `uniteConstraint` FOREIGN KEY (`uniteID`) REFERENCES `unites` (`id`);

--
-- Constraints for table `parcours`
--
ALTER TABLE `parcours`
  ADD CONSTRAINT `sessionConstraint` FOREIGN KEY (`sessionNumero`) REFERENCES `session` (`numero`);

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `anneConstraint` FOREIGN KEY (`anne`) REFERENCES `anne` (`anne`),
  ADD CONSTRAINT `semestreConstraint` FOREIGN KEY (`semestre`) REFERENCES `semestre` (`numero`);

--
-- Constraints for table `unites`
--
ALTER TABLE `unites`
  ADD CONSTRAINT `planEtudeConstraint` FOREIGN KEY (`planEtudeId`) REFERENCES `planetude` (`id`),
  ADD CONSTRAINT `semestreConstraint2` FOREIGN KEY (`semestreNum`) REFERENCES `semestre` (`numero`);

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `depConstraint` FOREIGN KEY (`departmentID`) REFERENCES `department` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

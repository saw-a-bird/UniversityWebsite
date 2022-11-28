-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2022 at 10:54 AM
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
  `groupId` int(11) NOT NULL,
  `enseignantMatricule` int(11) NOT NULL,
  `semestreNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `affecter`
--

INSERT INTO `affecter` (`id`, `matiereId`, `salleNom`, `sceanceNum`, `jourNum`, `groupId`, `enseignantMatricule`, `semestreNum`) VALUES
(1, 5, 'C1100', 1, 1, 30, 14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `parcoursID` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `anne` int(11) NOT NULL,
  `planEtudeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`id`, `parcoursID`, `numero`, `anne`, `planEtudeID`) VALUES
(6, 8, 1, 2022, 2),
(12, 7, 123, 2003, 1),
(13, 8, 1, 2003, 2);

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
  `matiereId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enseignant_matiere`
--

INSERT INTO `enseignant_matiere` (`matricule`, `matiereId`) VALUES
(14, 3);

-- --------------------------------------------------------

--
-- Table structure for table `etudiant_group`
--

CREATE TABLE `etudiant_group` (
  `matricule` int(11) NOT NULL,
  `groupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudiant_group`
--

INSERT INTO `etudiant_group` (`matricule`, `groupID`) VALUES
(11, 5),
(12, 5),
(11, 30),
(12, 30),
(16, 31);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `classeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`id`, `numero`, `classeId`) VALUES
(5, 1, 6),
(30, 1, 12),
(31, 2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `liste_inscription`
--

CREATE TABLE `liste_inscription` (
  `id` int(11) NOT NULL,
  `cin` int(11) NOT NULL,
  `nomprenom` varchar(40) NOT NULL,
  `role` int(10) NOT NULL,
  `departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `liste_inscription`
--

INSERT INTO `liste_inscription` (`id`, `cin`, `nomprenom`, `role`, `departmentID`) VALUES
(2, 12312312, 'Saifour Safsafy', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `coefficient_mat` decimal(5,3) NOT NULL,
  `credit_mat` decimal(5,3) NOT NULL,
  `heursCours` decimal(3,2) NOT NULL,
  `heursTP` decimal(3,2) NOT NULL,
  `uniteID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `matiere`
--

INSERT INTO `matiere` (`id`, `nom`, `coefficient_mat`, `credit_mat`, `heursCours`, `heursTP`, `uniteID`) VALUES
(3, 'Mathématique Appliqu', '1.000', '2.000', '2.00', '1.00', 3),
(4, 'Atelier Mathématique', '1.000', '2.000', '0.00', '1.00', 3),
(5, 'Algorithmique et pro', '2.000', '5.000', '0.00', '1.00', 4),
(6, 'Atelier Programmatio', '1.000', '2.000', '2.00', '3.00', 4),
(11, 'DDD', '0.250', '0.000', '0.00', '0.00', 3),
(12, 'Test', '2.000', '0.500', '0.50', '1.50', 4);

-- --------------------------------------------------------

--
-- Table structure for table `parcours`
--

CREATE TABLE `parcours` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `filiere` varchar(100) NOT NULL,
  `departmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parcours`
--

INSERT INTO `parcours` (`id`, `nom`, `filiere`, `departmentID`) VALUES
(6, 'TI', 'Technologies de l\'informatique ', 1),
(7, 'DSI2', 'Développement des Systèmes d\'Information ', 1),
(8, 'RSI2', 'Réseaux et systèmes informatiques', 1),
(9, 'MDW2', 'Multimédia et Développement Web', 1),
(10, 'DSI3', 'Développement des Systèmes d\'Information ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `planetude`
--

CREATE TABLE `planetude` (
  `id` int(11) NOT NULL,
  `parcoursID` int(11) DEFAULT NULL,
  `dateDebut` date NOT NULL DEFAULT current_timestamp(),
  `dateFin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `planetude`
--

INSERT INTO `planetude` (`id`, `parcoursID`, `dateDebut`, `dateFin`) VALUES
(1, 7, '2022-09-17', '2022-10-29'),
(2, 8, '2022-10-13', '2022-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`nom`) VALUES
('C1100');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `numero` int(11) NOT NULL,
  `anne` int(11) NOT NULL,
  `semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`numero`, `anne`, `semestre`) VALUES
(1, 2003, 1),
(2, 2022, 1),
(3, 2002, 2),
(4, 2020, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unite`
--

CREATE TABLE `unite` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `type` varchar(25) NOT NULL,
  `planEtudeId` int(11) NOT NULL,
  `semestreNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unite`
--

INSERT INTO `unite` (`id`, `nom`, `type`, `planEtudeId`, `semestreNum`) VALUES
(3, 'Mathématique appliqu', 'Fondamentale', 1, 1),
(4, 'Algorithmique et  Pr', 'Fondamentale', 1, 1);

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
  `role` int(11) NOT NULL,
  `isBanned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`matricule`, `cin`, `nom`, `prenom`, `sexe`, `dateNaissance`, `adresse`, `email`, `password`, `departmentID`, `dateInscription`, `isConfirmed`, `isActive`, `activationCode`, `activationExpiry`, `role`, `isBanned`) VALUES
(1, 0, 'Mahdi', 'Abdelkebir', 1, '2022-10-12', '', 'admin@gmail.com', 'azeaze', 1, '2022-10-16 19:28:46', 1, 1, '', '2022-10-16 19:28:46', 0, 0),
(10, 41122222, 'Abdelkebir', 'Mahdi', 1, '2022-10-26', 'hammam so', 'gamezrookie@gmail.com', 'azeaze', 1, '2022-10-31 10:36:38', 0, 1, '9b29e06b01290654971e16a941e79724', '0000-00-00 00:00:00', 1, 0),
(11, 41111116, 'Abdelkebir', 'Mahdi', 1, '2022-10-26', 'hammam so', 'etd1@gmail.com', 'azeaze', 1, '2022-10-31 10:36:38', 0, 1, '9b29e06b01290654971e16a941e79724', '0000-00-00 00:00:00', 4, 0),
(12, 41111117, 'Abdelkebir', 'Mahdi', 1, '2022-10-26', 'hammam so', 'etd2@gmail.com', 'azeaze', 1, '2022-10-31 10:36:38', 0, 1, '9b29e06b01290654971e16a941e79724', '0000-00-00 00:00:00', 4, 0),
(13, 41122222, 'adm', 'info', 1, '2022-10-26', 'hammam so', 'adm1@gmail.com', 'azeaze', 1, '2022-10-31 10:36:38', 0, 1, '9b29e06b01290654971e16a941e79724', '0000-00-00 00:00:00', 2, 0),
(14, 41122222, 'ens', 'ens1', 1, '2022-10-26', 'hammam so', 'ens1@gmail.com', 'azezae', 1, '2022-10-31 10:36:38', 0, 1, '9b29e06b01290654971e16a941e79724', '0000-00-00 00:00:00', 3, 0),
(16, 12312312, 'aaa', 'aa', 1, '2022-11-16', 'aa', 'mahdyabdelkbr@gmail.com', 'XKwexQPo', 1, '2022-11-21 09:40:04', 0, 1, 'ea58f8a7062a858139b0513f4e9ed21d', '0000-00-00 00:00:00', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `website_config`
--

CREATE TABLE `website_config` (
  `inscription` tinyint(1) NOT NULL DEFAULT 1,
  `sessionNumero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website_config`
--

INSERT INTO `website_config` (`inscription`, `sessionNumero`) VALUES
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affecter`
--
ALTER TABLE `affecter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matiereConstrain` (`matiereId`),
  ADD KEY `salleConstraint` (`salleNom`),
  ADD KEY `affecter_groupConstraint` (`groupId`),
  ADD KEY `matriculeEnsConstraint_affecter` (`enseignantMatricule`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `session1Constraint_classe` (`anne`),
  ADD KEY `constraint_classe_planetude` (`parcoursID`),
  ADD KEY `constraint_parcours_planEtd` (`planEtudeID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enseignant_matiere`
--
ALTER TABLE `enseignant_matiere`
  ADD KEY `em_matiereConstraint` (`matiereId`),
  ADD KEY `em_matriculeConstraint` (`matricule`);

--
-- Indexes for table `etudiant_group`
--
ALTER TABLE `etudiant_group`
  ADD KEY `groupConstraint_eg` (`groupID`),
  ADD KEY `matriculeConstraint_eg` (`matricule`);

--
-- Indexes for table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `classeConstraint` (`classeId`);

--
-- Indexes for table `liste_inscription`
--
ALTER TABLE `liste_inscription`
  ADD PRIMARY KEY (`id`),
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentConstraint_parcours` (`departmentID`);

--
-- Indexes for table `planetude`
--
ALTER TABLE `planetude`
  ADD PRIMARY KEY (`id`),
  ADD KEY `constraint_planetude_parcours` (`parcoursID`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`nom`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`numero`),
  ADD KEY `anneConstraint` (`anne`),
  ADD KEY `semestreConstraint` (`semestre`);

--
-- Indexes for table `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semestreConstraint2` (`semestreNum`),
  ADD KEY `planEtudeConstraint` (`planEtudeId`);

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
-- AUTO_INCREMENT for table `affecter`
--
ALTER TABLE `affecter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `liste_inscription`
--
ALTER TABLE `liste_inscription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `parcours`
--
ALTER TABLE `parcours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `planetude`
--
ALTER TABLE `planetude`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unite`
--
ALTER TABLE `unite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `matricule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affecter`
--
ALTER TABLE `affecter`
  ADD CONSTRAINT `affecter_groupConstraint` FOREIGN KEY (`groupId`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `matiereConstrain` FOREIGN KEY (`matiereId`) REFERENCES `matiere` (`id`),
  ADD CONSTRAINT `matriculeEnsConstraint_affecter` FOREIGN KEY (`enseignantMatricule`) REFERENCES `utilisateur` (`matricule`),
  ADD CONSTRAINT `salleConstraint` FOREIGN KEY (`salleNom`) REFERENCES `salle` (`nom`);

--
-- Constraints for table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `constraint_parcours_planEtd` FOREIGN KEY (`planEtudeID`) REFERENCES `planetude` (`id`),
  ADD CONSTRAINT `parcoursConstraint_classe` FOREIGN KEY (`parcoursID`) REFERENCES `parcours` (`id`);

--
-- Constraints for table `enseignant_matiere`
--
ALTER TABLE `enseignant_matiere`
  ADD CONSTRAINT `em_matiereConstraint` FOREIGN KEY (`matiereId`) REFERENCES `matiere` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `em_matriculeConstraint` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`) ON DELETE CASCADE;

--
-- Constraints for table `etudiant_group`
--
ALTER TABLE `etudiant_group`
  ADD CONSTRAINT `groupConstraint_eg` FOREIGN KEY (`groupID`) REFERENCES `groupe` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `matriculeConstraint_eg` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`) ON DELETE CASCADE;

--
-- Constraints for table `groupe`
--
ALTER TABLE `groupe`
  ADD CONSTRAINT `classeConstraint` FOREIGN KEY (`classeId`) REFERENCES `classe` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `liste_inscription`
--
ALTER TABLE `liste_inscription`
  ADD CONSTRAINT `inscription_depC` FOREIGN KEY (`departmentID`) REFERENCES `department` (`id`);

--
-- Constraints for table `matiere`
--
ALTER TABLE `matiere`
  ADD CONSTRAINT `uniteConstraint` FOREIGN KEY (`uniteID`) REFERENCES `unite` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parcours`
--
ALTER TABLE `parcours`
  ADD CONSTRAINT `departmentConstraint_parcours` FOREIGN KEY (`departmentID`) REFERENCES `department` (`id`);

--
-- Constraints for table `planetude`
--
ALTER TABLE `planetude`
  ADD CONSTRAINT `constraint_planetude_parcours` FOREIGN KEY (`parcoursID`) REFERENCES `parcours` (`id`);

--
-- Constraints for table `unite`
--
ALTER TABLE `unite`
  ADD CONSTRAINT `planEtudeConstraint` FOREIGN KEY (`planEtudeId`) REFERENCES `planetude` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `depConstraint` FOREIGN KEY (`departmentID`) REFERENCES `department` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

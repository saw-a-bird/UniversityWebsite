-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2022 at 01:42 AM
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
  `matriculeEnseignant` int(11) NOT NULL
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
  `parcoursID` int(11) NOT NULL,
  `sessionN1` int(11) NOT NULL,
  `sessionN2` int(11) NOT NULL
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
-- Table structure for table `etudiant_group`
--

CREATE TABLE `etudiant_group` (
  `matricule` int(11) NOT NULL,
  `groupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(12222222, 'AAA AA', 2, 1);

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
  `id` int(11) NOT NULL,
  `parcoursNom` varchar(20) NOT NULL,
  `departmentID` int(11) NOT NULL
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
(9, 12222222, 'aa', 'aaa', 1, '2022-10-05', 'aaa', 'gamezrookie@gmail.com', '9eZw5FdN', 1, '2022-10-29 22:03:08', 0, 1, '84ccf5c425e95dc213df94cb91ea02b8', '0000-00-00 00:00:00', 2);

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
  ADD KEY `affecter_groupConstraint` (`groupId`),
  ADD KEY `matriculeEnsConstraint_affecter` (`matriculeEnseignant`);

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
  ADD KEY `session1Constraint_classe` (`sessionN1`),
  ADD KEY `session2Constraint_classe` (`sessionN2`),
  ADD KEY `parcoursConstraint_classe` (`parcoursID`);

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
-- Indexes for table `etudiant_group`
--
ALTER TABLE `etudiant_group`
  ADD KEY `matriculeConstraint_eg` (`matricule`),
  ADD KEY `groupConstraint_eg` (`groupID`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentConstraint_parcours` (`departmentID`);

--
-- Indexes for table `planetude`
--
ALTER TABLE `planetude`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parcoursConstraint_planEtude` (`parcoursID`);

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
-- AUTO_INCREMENT for table `parcours`
--
ALTER TABLE `parcours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `matricule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `matriculeEnsConstraint_affecter` FOREIGN KEY (`matriculeEnseignant`) REFERENCES `utilisateur` (`matricule`),
  ADD CONSTRAINT `salleConstraint` FOREIGN KEY (`salleNom`) REFERENCES `salle` (`nom`),
  ADD CONSTRAINT `sceanceConstraint` FOREIGN KEY (`sceanceNum`) REFERENCES `sceance` (`numero`);

--
-- Constraints for table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `parcoursConstraint_classe` FOREIGN KEY (`parcoursID`) REFERENCES `parcours` (`id`),
  ADD CONSTRAINT `session1Constraint_classe` FOREIGN KEY (`sessionN1`) REFERENCES `session` (`numero`),
  ADD CONSTRAINT `session2Constraint_classe` FOREIGN KEY (`sessionN2`) REFERENCES `session` (`numero`);

--
-- Constraints for table `enseignant_matiere`
--
ALTER TABLE `enseignant_matiere`
  ADD CONSTRAINT `em_matiereConstraint` FOREIGN KEY (`matiereID`) REFERENCES `matiere` (`id`),
  ADD CONSTRAINT `em_matriculeConstraint` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`);

--
-- Constraints for table `etudiant_group`
--
ALTER TABLE `etudiant_group`
  ADD CONSTRAINT `groupConstraint_eg` FOREIGN KEY (`groupID`) REFERENCES `groupe` (`id`),
  ADD CONSTRAINT `matriculeConstraint_eg` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`);

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
  ADD CONSTRAINT `departmentConstraint_parcours` FOREIGN KEY (`departmentID`) REFERENCES `department` (`id`);

--
-- Constraints for table `planetude`
--
ALTER TABLE `planetude`
  ADD CONSTRAINT `parcoursConstraint_planEtude` FOREIGN KEY (`parcoursID`) REFERENCES `parcours` (`id`);

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

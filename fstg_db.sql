-- phpMyAdmin SQL
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2025 at 11:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.13
--
-- Auteur : Mohammed Belefqih

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ---------------------------------------------------------------------------------

--
-- Database:  `fstg_db`
-- 

DROP DATABASE IF EXISTS fstg_db;
CREATE DATABASE IF NOT EXISTS fstg_db;

USE fstg_db;

-- ----------------------------------------------------------------------------------

--
-- Table structure for `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `prenom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `genre` enum('female','male') DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `email` varchar(150) NOT NULL UNIQUE,
  `password` varchar(200) DEFAULT NULL,
  `CNE` varchar(20) DEFAULT NULL UNIQUE,
  `CIN` varchar(20) NOT NULL UNIQUE,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `id_dep` int(11) NOT NULL,
  `id_filiere` int(11) DEFAULT NULL,        -- la filière de l'étudiant
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `prenom`, `nom`, `genre`, `dateNaissance`, `email`, `password`, `CNE`, `CIN`, `phone`, `created_at`, `id_filiere`, `id_role`, `id_dep`) VALUES
-- Chef of the department
(1, 'Soulaimane', 'KALOUN', 'male', '1990-09-01', 'so.kaloun@uca.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12345', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 1, 1),

-- Coordinators
(2, 'Sara', 'QASSIMI', 'female', '1990-09-01', 'sara.qassimi@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12346', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 2, 1),
(3, 'Yassine', 'SADQI', 'male', '1990-09-01', 'y.sadqi@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12347', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 2, 1),
(4, 'Nawal', 'BOURQUIA', 'female', '1990-09-01', 'nawalbourquia@yahoo.fr', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12348', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 2, 1),
(5, 'Abdessamad', 'EL BOUSHAKI', 'male', '1990-09-01', 'a.elboushaki@uca.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12349', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 2, 1),
(6, 'Omar', 'BENCHAREF', 'male', '1990-09-01', 'o.bencharef@uca.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12350', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 2, 1),

-- Professors
(7, 'Mohammed', 'AIT HEMAD', 'male', '1990-09-01', 'ait.hemad.m@hotmail.com', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12351', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 3, 1),
(8, 'Rajaa', 'HANBALI', 'female', '1990-09-01', 'r.hanbali@uca.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12352', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 3, 1),
(9, 'Aziz', 'DAROUICHI', 'male', '1990-09-01', 'az.darouichi@uca.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12353', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 3, 1),

-- Students of IRISI 1
(10, 'Mohammed', 'BELEFQIH', 'male', '1990-09-01', 'm.belefqih5955@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141623', 'X12354', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(11, 'Mossaab', 'SADKI', 'male', '1990-09-01', 'm.sadki9752@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141624', 'X12355', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(12, 'Hamza', 'OUTZMOURTE', 'male', '1990-09-01', 'h.outzmourte1206@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141625', 'X12356', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(13, 'Anas', 'HALLOUMI', 'male', '1990-09-01', 'a.halloumi9030@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141626', 'X12357', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(14, 'Mohammed', 'EL OMRI', 'male', '1990-09-01', 'm.elomri0337@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141627', 'X12358', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(15, 'Mohammed', 'ALLALI', 'male', '1990-09-01', 'm.allali1846@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141628', 'X12359', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(16, 'Noura', 'LAMZARA', 'female', '1990-09-01', 'n.lamzara2439@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141629', 'X12360', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),

-- Students of IRISI 2
(17, 'Karim', 'TAZI', 'male', '1990-09-01', 'k.tazi1995@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141630', 'X12361', '+212 622 222 222', '2025-04-29 15:04:10', 2, 4, 1),
(18, 'Salma', 'ALAOUI', 'female', '1990-09-01', 's.alaoui2187@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141631', 'X12362', '+212 622 222 222', '2025-04-29 15:04:10', 2, 4, 1),
(19, 'Omar', 'BERRADA', 'male', '1990-09-01', 'o.berrada3265@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141632', 'X12363', '+212 622 222 222', '2025-04-29 15:04:10', 2, 4, 1),
(20, 'Mehdi', 'LAHLOU', 'male', '1990-09-01', 'm.lahlou4432@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141633', 'X12364', '+212 622 222 222', '2025-04-29 15:04:10', 2, 4, 1),

-- Students of IRISI 3
(21, 'Fatima', 'ZOUITEN', 'female', '1990-09-01', 'f.zouiten7725@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141634', 'X12365', '+212 622 222 222', '2025-04-29 15:04:10', 3, 4, 1),
(22, 'Youssef', 'FASSI', 'male', '1990-09-01', 'y.fassi8814@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141635', 'X12366', '+212 622 222 222', '2025-04-29 15:04:10', 3, 4, 1),
(23, 'Hajar', 'CHRAIBI', 'female', '1990-09-01', 'h.chraibi9936@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141636', 'X12367', '+212 622 222 222', '2025-04-29 15:04:10', 3, 4, 1),
(24, 'Amine', 'BENNIS', 'male', '1990-09-01', 'a.bennis1047@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141637', 'X12368', '+212 622 222 222', '2025-04-29 15:04:10', 3, 4, 1),

-- Students of SIT 1
(25, 'El Hamal', 'Nouhaila', 'female', '1990-09-01', 'n.elhamal4829@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141638', 'X12369', '+212 622 222 222', '2025-04-29 15:04:10', 4, 4, 1),
(26, 'El Idrissi', 'Mohammed', 'male', '1990-09-01', 'm.elidrissi6618@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141639', 'X12370', '+212 622 222 222', '2025-04-29 15:04:10', 4, 4, 1),
(27, 'Yasmine', 'BENJELLOUN', 'female', '1990-09-01', 'y.benjelloun2024@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141640', 'X12371', '+212 622 222 222', '2025-04-29 15:04:10', 4, 4, 1),
(28, 'Nadia', 'SENHAJI', 'female', '1990-09-01', 'n.senhaji2158@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141641', 'X12372', '+212 622 222 222', '2025-04-29 15:04:10', 4, 4, 1),

-- Students of SIT 2
(29, 'Imane', 'CHAKIR', 'female', '1990-09-01', 'i.chakir2241@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141642', 'X12373', '+212 622 222 222', '2025-04-29 15:04:10', 5, 4, 1),
(30, 'Hassan', 'MANSOURI', 'male', '1990-09-01', 'h.mansouri3352@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141643', 'X12374', '+212 622 222 222', '2025-04-29 15:04:10', 5, 4, 1),
(31, 'Saida', 'TAHIRI', 'female', '1990-09-01', 's.tahiri4463@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141644', 'X12375', '+212 622 222 222', '2025-04-29 15:04:10', 5, 4, 1),
(32, 'Khalid', 'RAMI', 'male', '1990-09-01', 'k.rami5574@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141645', 'X12376', '+212 622 222 222', '2025-04-29 15:04:10', 5, 4, 1),

-- Students of SIT 3
(33, 'Leila', 'KARIMI', 'female', '1990-09-01', 'l.karimi6685@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141646', 'X12377', '+212 622 222 222', '2025-04-29 15:04:10', 6, 4, 1),
(34, 'Ahmed', 'DAOUDI', 'male', '1990-09-01', 'a.daoudi7796@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141647', 'X12378', '+212 622 222 222', '2025-04-29 15:04:10', 6, 4, 1),
(35, 'Samira', 'LAAMRI', 'female', '1990-09-01', 's.laamri8807@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141648', 'X12379', '+212 622 222 222', '2025-04-29 15:04:10', 6, 4, 1),
(36, 'Younes', 'IDRISSI', 'male', '1990-09-01', 'y.idrissi9918@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', 'P141649', 'X12380', '+212 622 222 222', '2025-04-29 15:04:10', 6, 4, 1);

-- ---------------------------------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `expiry` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------------------------------

--
-- Table structure for `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nom`) VALUES
(1, 'Chef de département'),
(2, 'Coordinateur'),
(3, 'Professeur'),
(4, 'Étudiant');

-- ---------------------------------------------------------------------------------

--
-- Table structure for `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id`, `nom`) VALUES
(1, 'Informatique'),
(2, 'Mathématiques'),
(3, 'Physique appliquée'),
(4, 'Génie Civil');

-- ---------------------------------------------------------------------------------

--
-- Table structure for `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `nom` varchar(30) NOT NULL,
  `nom_complet` varchar(200) NOT NULL,
  `id_type` int(11) DEFAULT NULL,      -- le type de la filière (cycle d'ingénieur, licence, master, ...)
  `niveau` int(11) NOT NULL,            -- Niveau est l'année d'étude (soit 1er année soit 2ème année ...)
  `id_coordinator` int(11) NOT NULL,    -- le coordinateur qui s'occupe de la filière
  `id_dep` int(11) NOT NULL,            -- le département qui contient la filière
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`, `nom_complet`, `id_type`, `niveau`, `id_coordinator`, `id_dep`) VALUES
(1, 'IRISI1', 'Ingénierie en Réseaux Informatique et Systèmes d''Information', 1, 1, 2, 1),
(2, 'IRISI2', 'Ingénierie en Réseaux Informatique et Systèmes d''Information', 1, 2, 2, 1),
(3, 'IRISI3', 'Ingénierie en Réseaux Informatique et Systèmes d''Information', 1, 3, 2, 1),
(4, 'SIT1', 'Sécurité IT', 1, 1, 3, 1),
(5, 'SIT2', 'Sécurité IT', 1, 2, 3, 1),
(6, 'SIT3', 'Sécurité IT', 1, 3, 3, 1),
(7, 'SIR', 'Systèmes Informatiques Répartis', 2, 1, 4, 1),
(8, 'Cybersécurité', 'Cybersécurité', 2, 1, 5, 1),
(9, 'IAII1', 'Intelligence Artificielle et Ingénierie Informatique', 3, 1, 6, 1),
(10, 'IAII2', 'Intelligence Artificielle et Ingénierie Informatique', 3, 2, 6, 1);

-- ---------------------------------------------------------------------------------

--
-- Table structure for `filiere_type`
--

CREATE TABLE `filiere_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiere_type`
--

INSERT INTO `filiere_type` (`id`, `nom`) VALUES
(1, 'Cycle d''ingénieur'),
(2, 'Licence'),
(3, 'Master'),
(4, 'DEUST'),
(5, 'Doctorat');

-- ---------------------------------------------------------------------------------

--
-- Table structure for `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `nom` varchar(100) NOT NULL,
  `semestre` enum('1','2') NOT NULL,
  `id_filiere` int(11) NOT NULL,    -- the filière (program) that contains the module
  `id_teacher` int(11) DEFAULT NULL,    -- the professor who teaches the module
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `nom`, `semestre`, `id_filiere`, `id_teacher`) VALUES
-- Modules of IRISI 1
(1, 'Programmation Orienté Objet Java', 1, 1, 4),
(2, 'Réseaux et Standardisation', 1, 1, 3),
(3, 'Génie Logiciel et UML', 2, 1, 9),
(4, 'Développement Web Back End', 2, 1, 9),

-- Modules of IRISI 2
(5, 'Programmation Mobile', 1, 2, 2),
(6, 'Machine Learning', 1, 2, 6),
(7, 'DevOps', 2, 2, 5),
(8, 'Programmation Concurrentielle', 2, 2, 7),

-- Modules of IRISI 3
(9, 'Deep Learning', 1, 3, 6),
(10, 'Big Data', 1, 3, 8),
(11, 'NLP et Web Analytics', 1, 3, 2),
(12, 'Sécurité des Applications', 1, 3, 3),

-- Modules of SIT 1
(13, 'Systèmes d''Exploitation', 1, 4, 7),
(14, 'Systèmes d''Information', 1, 4, 8),
(15, 'Fondamentaux de la sécurité informatique et cyberdroit', 2, 4, 3),
(16, 'Réseaux et Protocoles', 2, 4, 5),

-- Modules of SIT 2
(17, 'Cryptographie', 1, 5, 5),
(18, 'Programmation Java et Sécurité', 1, 5, 4),
(19, 'Cloud Computing', 2, 5, 9),
(20, 'Tests de sécurité', 2, 5, 7),

-- Modules of SIT 3
(21, 'Sécurité du cloud', 1, 6, 4),
(22, 'Sécurité des systèmes de paiement', 1, 6, 7),
(23, 'Gouvernance de la sécurité', 1, 6, 3),
(24, 'Gestion des incidents cyber', 1, 6, 8);

-- ---------------------------------------------------------------------------------

--
-- Table structure for `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `value` decimal(10,0) DEFAULT NULL, -- example: 12.5
  `valideProf` tinyint(1) NOT NULL DEFAULT 0,
  `valideCoord` tinyint(1) NOT NULL DEFAULT 0,
  `id_module` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `cne_etudiant` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `value`, `valideProf`, `valideCoord`, `id_module`, `id_teacher`, `cne_etudiant`) VALUES
(1, 12, 1, 1, 2, 4, 'C12345678'),
(2, 10, 1, 1, 2, 4, 'C12345679'),
(3, 14, 1, 1, 2, 4, 'C12345611'),
(4, 12, 1, 1, 2, 4, 'C12345617'),
(5, 12, 1, 1, 2, 4, 'C12345618'),
(6, 12, 1, 1, 2, 4, 'C12345619'),
(7, 12, 1, 1, 2, 4, 'C12345620'),
(8, 12, 1, 1, 2, 4, 'C12345621'),
(9, 12, 1, 1, 2, 4, 'C12345622'),
(10, 12, 1, 1, 7, 4, 'C12345623'),
(11, 12, 1, 1, 7, 4, 'C12345624'),
(12, 12, 1, 1, 7, 4, 'C12345678'),
(13, 10, 1, 1, 7, 4, 'C12345679'),
(14, 14, 1, 1, 7, 4, 'C12345611'),
(15, 12, 1, 1, 7, 4, 'C12345617'),
(16, 12, 1, 1, 7, 4, 'C12345618'),
(17, 12, 1, 1, 7, 4, 'C12345619'),
(18, 12, 1, 1, 7, 4, 'C12345620'),
(19, 12, 1, 1, 7, 4, 'C12345621'),
(20, 12, 1, 1, 7, 4, 'C12345622'),
(21, 12, 1, 1, 7, 4, 'C12345623'),
(22, 12, 1, 1, 7, 4, 'C12345624'),
(23, 12, 1, 1, 3, 4, 'C12345678'),
(24, 10, 1, 1, 3, 4, 'C12345679'),
(25, 14, 1, 1, 3, 4, 'C12345611'),
(26, 12, 1, 1, 3, 4, 'C12345617'),
(27, 12, 1, 1, 3, 4, 'C12345618'),
(28, 12, 1, 1, 3, 4, 'C12345619'),
(29, 12, 1, 1, 3, 4, 'C12345620'),
(30, 12, 1, 1, 3, 4, 'C12345621'),
(31, 12, 1, 1, 3, 4, 'C12345622'),
(32, 12, 1, 1, 3, 4, 'C12345623'),
(33, 12, 1, 1, 3, 4, 'C12345624');

-- ---------------------------------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `id_module` int(11) NOT NULL,
  `id_sender` int(11) DEFAULT NULL,
  `id_receiver` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
    `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
    `date` date NOT NULL,
    `start_time` time NOT NULL,
    `end_time` time NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `id_module` int(11) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---------------------------------------------------------------------------------

--
-- Table structure for table `attachment`
--

CREATE TABLE `attachment` (
     `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
     `title` varchar(255) NOT NULL,
     `type` enum('Cours','TD','TP') NOT NULL,
     `filename` varchar(255) NOT NULL,
     `filepath` varchar(255) NOT NULL,
     `upload_date` timestamp NOT NULL DEFAULT current_timestamp(),
     `id_module` int(11) NOT NULL,
     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachment`
--

INSERT INTO `attachment` (`id`, `title`, `type`, `filename`, `filepath`, `upload_date`, `id_module`) VALUES
(1, 'Cours de PHP avancée', 'Cours', 'PHP_Notes_For_Professionals.pdf', '/uploads/PHP_Notes_For_Professionals.pdf', '2025-04-29 15:04:10', 4);

-- ---------------------------------------------------------------------------------

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
    ADD CONSTRAINT `user_tokens_fk` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--

ALTER TABLE `user`
    ADD CONSTRAINT `user_fk1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    ADD CONSTRAINT `user_fk2` FOREIGN KEY (`id_dep`) REFERENCES `departement` (`id`) ON UPDATE CASCADE,
    ADD CONSTRAINT `user_fk3` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `filiere`
--

ALTER TABLE `filiere`
    ADD CONSTRAINT `filiere_fk1` FOREIGN KEY (`id_type`) REFERENCES `filiere_type` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    ADD CONSTRAINT `filiere_fk2` FOREIGN KEY (`id_coordinator`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `filiere_fk3` FOREIGN KEY (`id_dep`) REFERENCES `departement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `module`
--

ALTER TABLE `module`
    ADD CONSTRAINT `module_fk1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `module_fk2` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `note`
--

ALTER TABLE `note`
    ADD CONSTRAINT `note_fk1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `note_fk2` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--                                                                                            --
-- Constraints for table `notification`
--

ALTER TABLE `notification`
    ADD CONSTRAINT `notification_fk1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `notification_fk2` FOREIGN KEY (`id_sender`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
    ADD CONSTRAINT `notification_fk3` FOREIGN KEY (`id_receiver`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `timetable`
    ADD CONSTRAINT `timetable_fk` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `attachment`
    ADD CONSTRAINT `attachment_fk` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
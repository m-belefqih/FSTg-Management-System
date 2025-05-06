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
  `phone` varchar(20) DEFAULT NULL UNIQUE,
  `created_at` datetime NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_dep` int(11) NOT NULL,
  `id_filiere` int(11) DEFAULT NULL,        -- la filière de l'étudiant
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `prenom`, `nom`, `genre`, `dateNaissance`, `email`, `password`, `CNE`, `CIN`, `phone`, `created_at`, `id_filiere`, `id_role`, `id_dep`) VALUES
(1, 'Kaloun', 'Soulaimane', 'male', NULL, 'so.kaloun@uca.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12345', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 1, 1),
(2, 'Sara', 'QASSIMI', 'female', NULL, 'sara.qassimi@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12346', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 2, 1),
(3, 'Yassine', 'SADQI', 'male', NULL, 'y.sadqi@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12347', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 2, 1),
(4, 'Aziz', 'DAROUICHI', 'male', NULL, 'az.darouichi@uca.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12348', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 3, 1),
(5, 'Mohammed', 'AIT HEMAD', 'male', NULL, 'ait.hemad.m@hotmail.com', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12349', '+212 622 222 222', '2025-04-29 15:04:10', NULL, 3, 1),
(6, 'Mohammed', 'BELEFQIH', 'male', NULL, 'm.belefqih5955@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12350', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(7, 'Mossaab', 'SADKI', 'male', NULL, 'm.sadki9752@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12351', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(8, 'Hamza', 'OUTZMOURTE', 'male', NULL, 'h.outzmourte1206@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12352', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(9, 'Anas', 'HALLOUMI', 'male', NULL, 'a.halloumi9030@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12353', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(10, 'Mohammed', 'EL OMRI', 'male', NULL, 'm.elomri0337@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12354', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(11, 'Mohammed', 'ALLALI', 'male', NULL, 'm.allali1846@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12355', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(12, 'Noura', 'LAMZARA', 'female', NULL, 'n.lamzara2439@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12356', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(13, 'Sayouba', 'OUEDRAOGO', 'male', NULL, 's.ouedraogo0058@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12357', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(14, 'Abdelilah', 'ERRAGUIBI', 'male', NULL, 'a.erraguibi3361@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12359', '+212 622 222 222', '2025-04-29 15:04:10', 1, 4, 1),
(15, 'El Hamal', 'Nouhaila', 'female', NULL, 'n.elhamal4829@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12360', '+212 622 222 222', '2025-04-29 15:04:10', 4, 4, 1),
(16, 'El Idrissi', 'Mohammed', 'male', NULL, 'm.elidrissi6618@uca.ac.ma', '$2y$10$euawtk.BqadFyqrldmYkXef1mkfLljcF5fMeRRPUuY.if2xNKvPhy', NULL, 'X12361', '+212 622 222 222', '2025-04-29 15:04:10', 4, 4, 1);

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
  `type` varchar(100) NOT NULL,         -- Exemple : 'Licence', 'Master', 'Cycle d’ingénieur'
  `niveau` int(11) NOT NULL,            -- Niveau est l'année d'étude (soit 1er année soit 2ème année ...)
  `id_coordinator` int(11) NOT NULL,    -- le coordinateur qui s'occupe de la filière
  `id_dep` int(11) NOT NULL,            -- le département qui contient la filière
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`, `nom_complet`, `type`, `niveau`, `id_coordinator`, `id_dep`) VALUES
(1, 'IRISI', 'Ingénierie en Réseaux Informatique et Systèmes Information', 'Cycle ingénieur', 1, 2, 1),
(2, 'IRISI', 'Ingénierie en Réseaux Informatique et Systèmes Information', 'Cycle ingénieur', 2, 2, 1),
(3, 'IRISI', 'Ingénierie en Réseaux Informatique et Systèmes Information', 'Cycle ingénieur', 3, 2, 1),
(4, 'SIT', 'Sécurité IT', 'Cycle ingénieur', 1, 3, 1),
(5, 'SIT', 'Sécurité IT', 'Cycle ingénieur', 2, 3, 1),
(6, 'SIT', 'Sécurité IT', 'Cycle ingénieur', 3, 3, 1);

-- ---------------------------------------------------------------------------------

--
-- Table structure for `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
  `nom` varchar(100) NOT NULL,
  `semestre` enum('1','2') NOT NULL,
  `id_filiere` int(11) NOT NULL,    -- la filière qui contient le module
  `id_teacher` int(11) NOT NULL,    -- le professeur qui enseigne le module
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `nom`, `semestre`, `id_filiere`, `id_teacher`) VALUES
(1, 'Génie Logiciel et UML', 2, 1, 4),
(2, 'Développement Web Back End', 2, 5, 4),
(3, 'Bases de Données', 1, 1, 4),
(4, 'Réseaux et Protocoles', 1, 1, 4),
(5, 'Administration Systèmes et Réseaux', 2, 1, 4),
(6, 'Fondamentaux de la sécurité informatique et cyberdroit', 2, 4, 4),
(7, 'Cryptographie', 2, 4, 5);

-- ---------------------------------------------------------------------------------

--
-- Table structure for `note`
--

CREATE TABLE `note` (
 `id` int(11) NOT NULL AUTO_INCREMENT UNIQUE,
 `value` decimal(10,0) DEFAULT NULL, -- example : 12.5
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
    ADD CONSTRAINT `user_fk1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON UPDATE CASCADE,
    ADD CONSTRAINT `user_fk2` FOREIGN KEY (`id_dep`) REFERENCES `departement` (`id`) ON UPDATE CASCADE,
    ADD CONSTRAINT `user_fk3` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id`) ON UPDATE CASCADE;

--                                                                                            --
-- Constraints for table `filiere`
--

ALTER TABLE `filiere`
    ADD CONSTRAINT `filiere_fk1` FOREIGN KEY (`id_coordinator`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `filiere_fk2` FOREIGN KEY (`id_dep`) REFERENCES `departement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--                                                                                            --
-- Constraints for table `module`
--

ALTER TABLE `module`
    ADD CONSTRAINT `module_fk1` FOREIGN KEY (`id_filiere`) REFERENCES `filiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `module_fk2` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--                                                                                            --
-- Constraints for table `note`
--

ALTER TABLE `note`
    ADD CONSTRAINT `note_fk1` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`) ON UPDATE CASCADE,
    ADD CONSTRAINT `note_fk2` FOREIGN KEY (`id_teacher`) REFERENCES `user` (`id`) ON UPDATE CASCADE;
COMMIT;
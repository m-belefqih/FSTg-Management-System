-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2025 at 11:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.13
--
-- Author : Mohammed BELEFQIH

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fstg_db`
--

CREATE DATABASE IF NOT EXISTS fstg_db;

USE fstg_db;

-- --------------------------------------------------------

--
-- Table structure for table `affectationmoduleprof`
--

CREATE TABLE `affectationmoduleprof` (
  `id` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `id_module` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `affectationmoduleprof`
--

INSERT INTO `affectationmoduleprof` (`id`, `id_teacher`, `id_module`) VALUES
(50, 36, 24),
(51, 24, 25);

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `professor_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` enum('course','td','correction') NOT NULL,
  `filename` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `professor_id`, `module_id`, `title`, `type`, `filename`, `filepath`, `upload_date`) VALUES
(10, 36, 24, 'Chapitre1', 'td', 'Rapport mini projet theorie de langage.pdf', 'C:/xampp/htdocs/ENSAHify/uploads/Rapport mini projet theorie de langage.pdf', '2024-06-14 14:03:10');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id`, `name`) VALUES
(1, 'GCEE'),
(2, 'DMI');

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `nom_complet` varchar(200) NOT NULL,
  `id_dep` int(11) NOT NULL,
  `level` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id`, `name`, `nom_complet`, `id_dep`, `level`) VALUES
(1, 'GI', 'Génie Informatique', 2, 1),
(2, 'GI', 'Génie Informatique', 2, 2),
(3, 'GI', 'Génie Informatique', 2, 3),
(4, 'CP', 'Classes Préparatoires', 2, 1),
(5, 'CP', 'Classes Préparatoires', 2, 2),
(7, 'GC', 'Génie Civil', 1, 1),
(8, 'GC', 'Génie Civil', 1, 2),
(9, 'GC', 'Génie Civil', 1, 3),
(10, 'GEE', 'Génie Eau et Environnement', 1, 1),
(11, 'GEE', 'Génie Eau et Environnement', 1, 2),
(12, 'GEE', 'Génie Eau et Environnement', 1, 3),
(13, 'TDIA', 'Transformation Digital', 2, 1),
(14, 'TDIA', 'Transformation Digital', 2, 2),
(15, 'TDIA', 'Transformation Digital', 2, 3),
(16, 'ID', 'Ingenieurie des données', 2, 1),
(17, 'ID', 'Ingenieurie des données', 2, 2),
(18, 'ID', 'Ingenieurie des données', 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nom_filiere` varchar(20) NOT NULL,
  `niveau` int(11) NOT NULL,
  `semestre` enum('1','2') NOT NULL,
  `id_dep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `name`, `nom_filiere`, `niveau`, `semestre`, `id_dep`) VALUES
(22, 'Architecture Logicielle et UML', 'GI', 1, '2', 2),
(23, 'Web1 : Technologies de Web et PHP5', 'TDIA', 1, '2', 2),
(24, 'Programmation Orientée Objet C++', 'GI', 1, '2', 2),
(25, 'Théorie des langages et compilation', 'GI', 1, '2', 2),
(28, 'Mathématiques de l\'ingénieur', 'GC', 1, '1', 1),
(29, 'Programmation événementielle et Initiations aux bases de données', 'GC', 1, '1', 1),
(30, 'Mécanique des Fluides et des Solides', 'GC', 1, '1', 1),
(31, 'Matériaux de construction', 'GC', 1, '1', 1),
(32, 'Urbanisme, Topographie', 'GC', 1, '1', 1),
(33, 'Probabilité Statistiques et Recherche Opérationnelle', 'GC', 1, '2', 1),
(34, 'Comptabilité général et analytique', 'GC', 1, '2', 1),
(35, 'Théorie des langages et compilation', 'TDIA', 1, '1', 2),
(36, 'Structure de données et Algorithmique avancée', 'TDIA', 1, '1', 2),
(39, 'Systèmes d’Information et Bases de Données Relationnelles', 'TDIA', 1, '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `cne` varchar(20) NOT NULL,
  `id_module` int(11) NOT NULL,
  `value` decimal(10,0) DEFAULT NULL,
  `valideProf` tinyint(1) NOT NULL DEFAULT 0,
  `valideCoord` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `id_teacher`, `cne`, `id_module`, `value`, `valideProf`, `valideCoord`) VALUES
(269, 36, 'C12345678', 24, 12, 1, 1),
(270, 36, 'C12345679', 24, 10, 1, 1),
(271, 36, 'C12345611', 24, 14, 1, 1),
(275, 36, 'C12345617', 24, 12, 1, 1),
(276, 36, 'C12345618', 24, 12, 1, 1),
(277, 36, 'C12345619', 24, 12, 1, 1),
(278, 36, 'C12345620', 24, 12, 1, 1),
(279, 36, 'C12345621', 24, 12, 1, 1),
(280, 36, 'C12345622', 24, 12, 1, 1),
(281, 36, 'C12345623', 24, 12, 1, 1),
(282, 36, 'C12345624', 24, 12, 1, 1),
(294, 28, 'C12345678', 22, 12, 1, 1),
(295, 36, 'C12345679', 22, 10, 1, 1),
(296, 36, 'C12345611', 22, 14, 1, 1),
(297, 36, 'C12345617', 22, 12, 1, 1),
(298, 36, 'C12345618', 22, 12, 1, 1),
(299, 36, 'C12345619', 22, 12, 1, 1),
(300, 36, 'C12345620', 22, 12, 1, 1),
(301, 36, 'C12345621', 22, 12, 1, 1),
(302, 36, 'C12345622', 22, 12, 1, 1),
(303, 36, 'C12345623', 22, 12, 1, 1),
(304, 36, 'C12345624', 22, 12, 1, 1),
(305, 36, 'C12345678', 25, 12, 1, 1),
(306, 36, 'C12345679', 25, 10, 1, 1),
(307, 36, 'C12345611', 25, 14, 1, 1),
(308, 36, 'C12345617', 25, 12, 1, 1),
(309, 36, 'C12345618', 25, 12, 1, 1),
(310, 36, 'C12345619', 25, 12, 1, 1),
(311, 36, 'C12345620', 25, 12, 1, 1),
(312, 36, 'C12345621', 25, 12, 1, 1),
(313, 36, 'C12345622', 25, 12, 1, 1),
(314, 36, 'C12345623', 25, 12, 1, 1),
(315, 36, 'C12345624', 25, 12, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `sender` varchar(50) NOT NULL,
  `user_id` varchar(30) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('unread','read') DEFAULT 'unread'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Head of Departement'),
(2, 'Coordinator'),
(3, 'Professor'),
(4, 'Student');

-- --------------------------------------------------------

--
-- Table structure for table `timetable_events`
--

CREATE TABLE `timetable_events` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `level` int(11) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `semestre` enum('1','2') NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable_events`
--

INSERT INTO `timetable_events` (`id`, `teacher_id`, `section`, `level`, `subject`, `semestre`, `date`, `start_time`, `end_time`, `created_at`) VALUES
(36, 0, 'GI', 1, 'Architecture Logicielle et UML', '2', '2024-06-11', '08:30:00', '10:00:00', '2024-06-14 13:57:17'),
(37, 36, 'GI', 1, 'Programmation Orientée Objet C++', '2', '2024-06-12', '10:30:00', '00:30:00', '2024-06-14 13:58:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `prénom` varchar(100) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `genre` enum('female','male') DEFAULT NULL,
  `dateNaissance` date DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `niveau` varchar(10) DEFAULT NULL,
  `CNE` varchar(20) DEFAULT NULL,
  `CNI` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` int(5) NOT NULL,
  `nom_filiere` varchar(20) DEFAULT NULL,
  `id_dep` int(11) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `prénom`, `nom`, `genre`, `dateNaissance`, `email`, `niveau`, `CNE`, `CNI`, `password`, `role`, `nom_filiere`, `id_dep`, `phone`, `created_at`) VALUES
(24, 'Dadi', 'El Wardani', 'male', NULL, 'elwardani.dadi@uae.ac.ma', NULL, NULL, 'X12345', 'fc5e038d38a57032085441e7fe7010b0', 1, 'GI', 2, NULL, '2024-06-11 12:14:22'),
(26, 'Abdelkalek', 'BAHRI', 'male', NULL, 'abahri@uae.ac.ma', NULL, NULL, 'X12345', 'fc5e038d38a57032085441e7fe7010b0', 3, NULL, 2, '', '2024-06-11 14:29:07'),
(28, 'Ahmed', 'Boujraf', 'male', NULL, 'a.boujraf@uae.ac.ma', NULL, NULL, 'X12345', 'fc5e038d38a57032085441e7fe7010b0', 3, NULL, 2, NULL, '2024-06-11 14:29:07'),
(29, 'Mohamed', 'CHERRADI', 'male', NULL, 'm.cherradi@uae.ac.ma', NULL, NULL, 'X12345', 'fc5e038d38a57032085441e7fe7010b0', 3, NULL, 2, NULL, '2024-06-11 14:29:07'),
(30, 'Anass', 'ELHADDADI', 'male', NULL, 'a.elhaddadi@uae.ac.ma', NULL, NULL, 'X12345', 'fc5e038d38a57032085441e7fe7010b0', 2, NULL, 2, NULL, '2024-06-11 14:29:07'),
(31, 'Faiz', 'Oussama', 'male', NULL, 'faizouss123@gmail.com', '1', 'C12345678', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(32, 'Ilyass', 'Ouladdahman', 'male', NULL, 'i.ouladdahman@uae.ac.ma', '1', 'C12345679', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:50:22'),
(33, 'Dadi', 'El Wardani', 'male', NULL, 'elwardani.dadi@uae.ac.ma', NULL, NULL, 'X12345', 'de6838252f95d3b9e803b28df33b4baa', 2, 'GI', 2, NULL, '2024-06-11 12:14:22'),
(34, 'BADI', 'Imad', 'male', NULL, 'i.badi@uae.ac.ma', NULL, NULL, 'X12345', '82a128f7f888823aefd5024b45220ff8', 3, NULL, 2, '', '2024-06-11 19:33:13'),
(35, 'Anouar', 'Ragragui', 'male', NULL, 'a.ragragui@uae.ac.ma', NULL, NULL, 'U12345', 'fc5e038d38a57032085441e7fe7010b0', 3, NULL, 2, NULL, '2024-06-12 16:22:08'),
(36, 'Nabil', 'Kennouf', 'male', NULL, 'n.kennouf@uae.ac.ma', NULL, NULL, 'G1234', 'fc5e038d38a57032085441e7fe7010b0', 3, NULL, 2, NULL, '2024-06-12 16:25:00'),
(37, 'Zakaria', 'Nwiser', 'male', NULL, 'z.nwiser@gmail.com', '1', 'C12345611', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(38, 'Karim', 'Boussouf', 'male', NULL, 'k.boussouf@gmail.com', '1', 'C12345617', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(39, 'Rania', 'El Khatib', 'female', NULL, 'r.elkhatib@gmail.com', '1', 'C12345618', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(40, 'Ali', 'Moudden', 'male', NULL, 'a.moudden@gmail.com', '1', 'C12345619', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(41, 'Leila', 'Nassiri', 'female', NULL, 'l.nassiri@gmail.com', '1', 'C12345620', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(42, 'Jamal', 'Rami', 'male', NULL, 'j.rami@gmail.com', '1', 'C12345621', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(43, 'Hiba', 'Lamrani', 'female', NULL, 'h.lamrani@gmail.com', '1', 'C12345622', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(44, 'Omar', 'Bousfiha', 'male', NULL, 'o.bousfiha@gmail.com', '1', 'C12345623', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(45, 'Samira', 'Farah', 'female', NULL, 's.farah@gmail.com', '1', 'C12345624', '', 'fc5e038d38a57032085441e7fe7010b0', 4, 'GI', 2, NULL, '2024-06-11 17:43:00'),
(46, 'Mohamed', 'Oulhadj', 'male', NULL, 'm.oulhadj@uae.ac.ma', NULL, NULL, 'X12345', 'fc5e038d38a57032085441e7fe7010b0', 3, NULL, 2, NULL, '2024-06-11 14:29:07'),
(48, 'Oussama', 'FAIZ', 'male', '1970-01-01', 'o.faiz@uae.ac.ma', NULL, NULL, 'C12345', '868031028d3aaa580a176b6146f3eb5a', 3, NULL, 2, '', '2024-06-12 18:49:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affectationmoduleprof`
--
ALTER TABLE `affectationmoduleprof`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `id_module` (`id_module`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `professor_id` (`professor_id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_filiere` (`id_dep`),
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_level` (`level`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_module` (`id_dep`),
  ADD KEY `FK_f` (`nom_filiere`),
  ADD KEY `FK_niveau` (`niveau`),
  ADD KEY `idx_name` (`name`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cne` (`cne`,`id_module`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `id_module` (`id_module`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetable_events`
--
ALTER TABLE `timetable_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_levels` (`level`),
  ADD KEY `FK_nomfil` (`section`),
  ADD KEY `FK_moduNiv` (`subject`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Dep` (`id_dep`),
  ADD KEY `FK_filiereeee` (`nom_filiere`);

--
-- Indexes for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affectationmoduleprof`
--
ALTER TABLE `affectationmoduleprof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=316;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `timetable_events`
--
ALTER TABLE `timetable_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affectationmoduleprof`
--
ALTER TABLE `affectationmoduleprof`
  ADD CONSTRAINT `affectationmoduleprof_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `affectationmoduleprof_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`);

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_1` FOREIGN KEY (`professor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `attachments_ibfk_2` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`);

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `FK_filiere` FOREIGN KEY (`id_dep`) REFERENCES `departement` (`id`);

--
-- Constraints for table `module`
--
ALTER TABLE `module`
  ADD CONSTRAINT `FK_f` FOREIGN KEY (`nom_filiere`) REFERENCES `filiere` (`name`),
  ADD CONSTRAINT `FK_module` FOREIGN KEY (`id_dep`) REFERENCES `departement` (`id`),
  ADD CONSTRAINT `FK_niveau` FOREIGN KEY (`niveau`) REFERENCES `filiere` (`level`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `notes_ibfk_2` FOREIGN KEY (`id_module`) REFERENCES `module` (`id`);

--
-- Constraints for table `timetable_events`
--
ALTER TABLE `timetable_events`
  ADD CONSTRAINT `FK_levels` FOREIGN KEY (`level`) REFERENCES `filiere` (`level`),
  ADD CONSTRAINT `FK_nomfil` FOREIGN KEY (`section`) REFERENCES `filiere` (`name`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_Dep` FOREIGN KEY (`id_dep`) REFERENCES `departement` (`id`),
  ADD CONSTRAINT `FK_filiereeee` FOREIGN KEY (`nom_filiere`) REFERENCES `filiere` (`name`);

--
-- Constraints for table `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

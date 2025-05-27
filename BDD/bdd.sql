
DROP database IF EXISTS  fatfitness_db;
CREATE database fatfitness_db;
USE fatfitness_db;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL
) ;

INSERT INTO `admin` (`idAdmin`, `nom`, `prenom`, `role`, `email`, `mdp`, `tel`) VALUES
(1, 'Ghotu', 'Mac Daniel', 'Super Admin', 'admin@fatfitness.com', '000', '0123456789'),
(2, 'Smith', 'John', 'Manager', 'john.smith@fatfitness.com', '1234', '0678945612');


CREATE TABLE `boutique` (
  `id_article` int(11) NOT NULL,
  `nom_article` varchar(30) NOT NULL,
  `description_article` varchar(100) NOT NULL,
  `prix_article` decimal(10,2) NOT NULL,
  `image_article` varchar(200) NOT NULL
) ;


INSERT INTO `boutique` (`id_article`, `nom_article`, `description_article`, `prix_article`, `image_article`) VALUES
(1, 'T-shirt Sport', 'T-shirt de sport respirant', 25.99, 'uploads/tshirt.jpeg'),
(2, 'Gants Musculation', 'Gants pour haltérophilie', 19.99, 'uploads/gants.jpeg'),
(3, 'Bouteille Eau', 'Bouteille deau réutilisable', 12.50, 'uploads/bouteille.jpeg');


CREATE TABLE `coach` (
  `Id_coach` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Specialite` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telephone` varchar(15) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL DEFAULT '1234'
) ;


INSERT INTO `coach` (`Id_coach`, `Nom`, `Prenom`, `Specialite`, `Email`, `Telephone`, `MotDePasse`) VALUES
(4, 'Dupont', 'Jean', 'Musculation', 'jean.dupont@example.com', '0600000000', 'mdp123'),
(5, 'Martin', 'Sophie', 'Yoga', 'sophie.martin@example.com', '0612345678', 'yoga456'),
(7, 'Dan', 'Marco', 'Yoga', 'dan@gmail.com', '1234', '$2y$10$0rBXwy4180f8H8UnTbqVWuj9yug3mzn3D1TVMse5y67NmPuDGuUK6'),
(9, 'aaa', 'aaa', 'aaa', 'aaa@gmail.com', '000', '$2y$10$JAxiQoBECAW3.4Q6hL6wb.W5w1v4PnZMrsDySruvX/9iKBEc4ZumK');*$
*

CREATE TABLE `coachprogramme` (
  `id` int(11) NOT NULL,
  `idcoach` int(11) NOT NULL,
  `idProgramme` int(11) NOT NULL,
  `date_affectation` date DEFAULT curdate()
) ;


INSERT INTO `coachprogramme` (`id`, `idcoach`, `idProgramme`, `date_affectation`) VALUES
(1, 4, 1, '2025-04-15'),
(2, 5, 2, '2025-04-10'),
(3, 9, 3, '2025-04-12');


CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `id_client` int(11) NOT NULL
) ;


INSERT INTO `panier` (`id`, `id_produit`, `id_client`) VALUES(1, 2, 7),
(2, 1, 9);


CREATE TABLE `programme` (
  `id_programme` int(11) NOT NULL,
  `nom_programme` varchar(50) NOT NULL,
  `rythme` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `duree` time DEFAULT NULL,
  `categorie` enum('lourd','moyen','simple') NOT NULL,
  `salle_id` int(11) DEFAULT NULL,
  `coach_id` int(11) DEFAULT NULL
) ;


INSERT INTO `programme` (`id_programme`, `nom_programme`, `rythme`, `description`, `duree`, `categorie`, `salle_id`, `coach_id`) VALUES
(1, 'Full Body', 'Quotidien', 'Programme pour tout le corps', '01:00:00', 'moyen', 1, 7),
(2, 'Yoga Débutant', 'Hebdomadaire', 'Initiation au yoga', '00:45:00', 'simple', NULL, NULL),
(3, 'HIIT Intensif', 'Quotidien', 'Entraînement cardio intense', '00:30:00', 'lourd', NULL, NULL),
(4, 'Natation', 'Hebdomadaire', 'Apprends a nager sans  étant principalement chez toi ', '00:40:00', 'simple', 2, NULL);


CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `date_reservation` date NOT NULL,
  `programme_id` int(11) DEFAULT NULL,
  `sportif_id` int(11) DEFAULT NULL
) ;


INSERT INTO `reservations` (`id`, `date_reservation`, `programme_id`, `sportif_id`) VALUES
(2, '2025-05-12', 1, 7),
(3, '2025-05-14', 3, 7),
(4, '2025-05-14', 1, 9);


CREATE TABLE `salles` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `chaine` varchar(255) NOT NULL,
  `horaire_debut` time DEFAULT NULL,
  `horaire_fin` time DEFAULT NULL
) ;


INSERT INTO `salles` (`id`, `nom`, `adresse`, `ville`, `chaine`, `horaire_debut`, `horaire_fin`) VALUES
(1, 'Basic-Fit Centre', '10 Rue de la République', 'Paris', 'Basic-Fit', '09:00:00', '00:00:00'),
(2, 'Fitness Park Montreuil', '5 Avenue du Général', 'Montreuil', 'Fitness Park', '09:00:00', '00:00:00');


CREATE TABLE `sportif` (
  `Id_sportif` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `MotDePasse` varchar(255) NOT NULL,
  `Age` int(3) NOT NULL,
  `Sexe` enum('Homme','Femme') NOT NULL,
  `Taille` decimal(5,2) NOT NULL,
  `Poids` decimal(5,2) NOT NULL,
  `Objectif` text NOT NULL
) ;


INSERT INTO `sportif` (`Id_sportif`, `Nom`, `Prenom`, `Email`, `Telephone`, `MotDePasse`, `Age`, `Sexe`, `Taille`, `Poids`, `Objectif`) VALUES
(6, 'ngd', 'djen', 'djen@gmail.com', '', '$2y$10$r3GjpYzUzpKEtYhVCrZ4Pe7k.pW.0/8uy5xYpXnTNZxXs8IYjJWsC', 22, '', 1.77, 54.00, 'rien'),
(7, 'bbb', 'bbb', 'bbb@gmail.com', '', '$2y$10$Bjd.9feCn6se3ctvuioGVeBwm3EZBtDjIGqpRCT6mq91bHXqqeti.', 21, '', 1.74, 90.00, 'bbb'),
(8, 'SINHOU', 'Reuben', 'magreub6@gmail.com', '', '$2y$10$V5je0PRDCLs7GcXjtIhlF.K/Swv1ar7BJZwPzCwdMwarJ/EAULbwS', 18, '', 1.74, 60.00, 'Musculation'),
(9, 'SINHOU', 'Reuben', 'reubenmag6@gmail.com', '', '$2y$10$pTm3MolFAX6euQYIyuAEg.hBvWBmNc05P1cIXHgJkdR1VZk7rCamC', 18, '', 1.74, 60.00, 'Musculation');


ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `boutique`
  ADD PRIMARY KEY (`id_article`);


ALTER TABLE `coach`
  ADD PRIMARY KEY (`Id_coach`),
  ADD UNIQUE KEY `Email` (`Email`);


ALTER TABLE `coachprogramme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idcoach` (`idcoach`),
  ADD KEY `idProgramme` (`idProgramme`);


ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produit` (`id_produit`),
  ADD KEY `fk_client` (`id_client`);


ALTER TABLE `programme`
  ADD PRIMARY KEY (`id_programme`),
  ADD KEY `fk_salle` (`salle_id`),
  ADD KEY `fk_coach` (`coach_id`);


ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_programme` (`programme_id`),
  ADD KEY `fk_sportif` (`sportif_id`);


ALTER TABLE `salles`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `sportif`
  ADD PRIMARY KEY (`Id_sportif`),
  ADD UNIQUE KEY `Email` (`Email`);


ALTER TABLE `admin`
  MODIFY `idAdmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `boutique`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `coach`
  MODIFY `Id_coach` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


ALTER TABLE `coachprogramme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `programme`
  MODIFY `id_programme` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;


ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `salles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;


ALTER TABLE `sportif`
  MODIFY `Id_sportif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;


ALTER TABLE `coachprogramme`
  ADD CONSTRAINT `coachprogramme_ibfk_1` FOREIGN KEY (`idcoach`) REFERENCES `coach` (`Id_coach`),
  ADD CONSTRAINT `coachprogramme_ibfk_2` FOREIGN KEY (`idProgramme`) REFERENCES `programme` (`id_programme`);


ALTER TABLE `panier`
  ADD CONSTRAINT `fk_client` FOREIGN KEY (`id_client`) REFERENCES `sportif` (`Id_sportif`),
  ADD CONSTRAINT `fk_produit` FOREIGN KEY (`id_produit`) REFERENCES `boutique` (`id_article`);


ALTER TABLE `programme`
  ADD CONSTRAINT `fk_coach` FOREIGN KEY (`coach_id`) REFERENCES `coach` (`Id_coach`),
  ADD CONSTRAINT `fk_salle` FOREIGN KEY (`salle_id`) REFERENCES `salles` (`id`);


ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_programme` FOREIGN KEY (`programme_id`) REFERENCES `programme` (`id_programme`),
  ADD CONSTRAINT `fk_sportif` FOREIGN KEY (`sportif_id`) REFERENCES `sportif` (`Id_sportif`);
COMMIT;

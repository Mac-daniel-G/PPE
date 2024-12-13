-- Supprimer et recréer la base de données si elle existe
DROP DATABASE IF EXISTS fatfitness_db;
CREATE DATABASE fatfitness_db;
USE fatfitness_db;

-- Table Coach
CREATE TABLE Coach (
    Id_Coach INT AUTO_INCREMENT NOT NULL,
    Nom VARCHAR(50),
    Prenom VARCHAR(50),
    Specialite VARCHAR(50),
    Email VARCHAR(50) UNIQUE,
    Telephone VARCHAR(15),
    PRIMARY KEY(Id_Coach)
);

-- Table Sportif
CREATE TABLE Sportif (
    Id_Sportif INT AUTO_INCREMENT NOT NULL,
    Nom VARCHAR(50),
    Prenom VARCHAR(50),
    Age INT,
    Sexe ENUM('H', 'F'),
    Taille DECIMAL(5,2),
    Poids DECIMAL(5,2),
    Objectif VARCHAR(50),
    Id_Coach INT DEFAULT NULL,
    PRIMARY KEY(Id_Sportif),
    FOREIGN KEY(Id_Coach) REFERENCES Coach(Id_Coach)
);

-- Table Programme
CREATE TABLE programme (
    id_programme INT AUTO_INCREMENT NOT NULL,
    nom_programme VARCHAR(50) NOT NULL,
    rythme VARCHAR(50) NOT NULL,
    description TEXT,
    duree TIME,
    categorie ENUM('lourd', 'moyen', 'simple') NOT NULL,
    PRIMARY KEY (id_programme)
);


-- Table Salle
CREATE TABLE salles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    adresse VARCHAR(255) NOT NULL,
    ville VARCHAR(255) NOT NULL,
    chaine VARCHAR(255) NOT NULL, -- Exemple : Basic-Fit, Fitness Park
    disponibilites TEXT NOT NULL -- JSON : {"lundi": ["10:00", "11:00"], ...}
);

-- Table Utilisateur
CREATE TABLE Utilisateur (
    Id_Utilisateur INT AUTO_INCREMENT NOT NULL,
    Nom VARCHAR(50),
    Prenom VARCHAR(50),
    Email VARCHAR(50) UNIQUE,
    Mot_de_passe VARCHAR(255),
    Telephone VARCHAR(15),
    Adresse TEXT,
    Role ENUM('Sportif', 'Coach', 'Admin'),
    Photo VARCHAR(255), -- URL ou chemin de l'image
    PRIMARY KEY(Id_Utilisateur)
);

-- Table Disponibilites des Salles (relationnelle)
CREATE TABLE Disponibilites_Salles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_salle INT NOT NULL,
    jour ENUM('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'),
    horaire_debut TIME NOT NULL,
    horaire_fin TIME NOT NULL,
    FOREIGN KEY (id_salle) REFERENCES salles(id)
);

-- Table Réservations
CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    salle_id INT NOT NULL,
    client_nom VARCHAR(255) NOT NULL,
    client_email VARCHAR(255) NOT NULL,
    horaire VARCHAR(50) NOT NULL,
    date_reservation DATE NOT NULL,
    FOREIGN KEY (salle_id) REFERENCES salles(id)
);

-- Table Association Sportif-Salle
CREATE TABLE Sportif_Salle (
    Id_Sportif INT,
    Id_Salle INT,
    Date_Reservation DATETIME,
    PRIMARY KEY(Id_Sportif, Id_Salle),
    FOREIGN KEY(Id_Sportif) REFERENCES Sportif(Id_Sportif),
    FOREIGN KEY(Id_Salle) REFERENCES salles(id)
);

-- Table Association Coach-Programme
CREATE TABLE Coach_Programme (
    Id_Coach INT,
    Id_Programme INT,
    PRIMARY KEY(Id_Coach, Id_Programme),
    FOREIGN KEY(Id_Coach) REFERENCES Coach(Id_Coach),
    FOREIGN KEY(Id_Programme) REFERENCES Programme(Id_Programme)
);

-- Table Association Sportif-Programme
CREATE TABLE Sportif_Programme (
    Id_Sportif INT,
    Id_Programme INT,
    Date_Inscription DATE,
    PRIMARY KEY(Id_Sportif, Id_Programme),
    FOREIGN KEY(Id_Sportif) REFERENCES Sportif(Id_Sportif),
    FOREIGN KEY(Id_Programme) REFERENCES Programme(Id_Programme)
);

-- Table user_programmes pour suivre les programmes des utilisateurs
CREATE TABLE user_programmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    programme_id INT NOT NULL,
    date_debut DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Utilisateur(Id_Utilisateur),
    FOREIGN KEY (programme_id) REFERENCES Programme(Id_Programme)
) ENGINE=InnoDB;


-- Exemples de données pour les tests
INSERT INTO Coach (Nom, Prenom, Specialite, Email, Telephone) 
VALUES ('Dupont', 'Jean', 'Musculation', 'jean.dupont@example.com', '0600000000');

INSERT INTO Sportif (Nom, Prenom, Age, Sexe, Taille, Poids, Objectif, Id_Coach) 
VALUES ('Martin', 'Luc', 25, 'H', 1.80, 75, 'Perte de poids', 1);

INSERT INTO salles (nom, adresse, ville, chaine, disponibilites) 
VALUES ('Basic-Fit Gare', '12 Rue de la Gare', 'Paris', 'Basic-Fit', '{"lundi": ["08:00", "18:00"], "mardi": ["08:00", "18:00"]}');

INSERT INTO programme (nom_programme, rythme, description, duree, categorie)
VALUES ('Programme Intense', 'Quotidien', 'Programme pour les experts', '01:30:00', 'lourd');

CREATE DATABASE voyage;
USE voyage;

CREATE TABLE client (
    id_client INT(11) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    adress TEXT,
    date_naissance DATE
);

CREATE TABLE activite (
    id_activite INT(11) AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    titre VARCHAR(150) NOT NULL,
    prix DECIMAL(10,2),
    date_debut DATE,
    date_fin DATE,
    place_disponible INT(11)
);

CREATE TABLE reservation (
    id_reservation INT(11) AUTO_INCREMENT PRIMARY KEY,
    id_client INT(11),
    id_activite INT(11) NOT NULL,
    date_reservation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('en attente', 'confirmer', 'annuler') DEFAULT 'en attente',
    FOREIGN KEY (id_client) REFERENCES client(id_client),
    FOREIGN KEY (id_activite) REFERENCES activite(id_activite)
);

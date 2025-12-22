CREATE DATABASE assadV2_db;
USE assadV2_db;

CREATE TABLE utilisateurs (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    email VARCHAR(150),
    role ENUM('admin','visiteur','guide') DEFAULT 'visiteur',
    statut ENUM('actif','inactif') DEFAULT 'actif',
    motpasse_hash VARCHAR(255),
    pays VARCHAR(100)
);

CREATE TABLE visitesguidees (
    id_visite INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(50),
    dateheure DATETIME DEFAULT CURRENT_TIMESTAMP,
    langue VARCHAR(50),
    capacite_max INT,
    statut ENUM('active','annulee','complete') DEFAULT 'active',
    duree INT,
    prix FLOAT CHECK (prix >= 0),
    id_utilisateur INT,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

CREATE TABLE etapesvisite (
    id_etape INT AUTO_INCREMENT PRIMARY KEY,
    titreetape VARCHAR(50),
    descriptionetape TEXT,
    ordreetape INT,
    id_visite INT,
    FOREIGN KEY (id_visite) REFERENCES visitesguidees(id_visite)
);

CREATE TABLE reservations (
    id_reservation INT AUTO_INCREMENT PRIMARY KEY,
    id_visite INT,
    id_utilisateur INT,
    nb_personnes INT,
    date_reservation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur),
    FOREIGN KEY (id_visite) REFERENCES visitesguidees(id_visite)
);


CREATE TABLE habitats (
    id_habitat INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    type_climat VARCHAR(50),
    description TEXT,
    zone_zoo VARCHAR(50)
);

CREATE TABLE animaux (
    id_animal INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    espece VARCHAR(50),
    alimentation VARCHAR(50),
    image VARCHAR(100),
    pays_origine VARCHAR(50),
    description TEXT,
    id_habitat INT,
    FOREIGN KEY (id_habitat) REFERENCES habitats(id_habitat)
);

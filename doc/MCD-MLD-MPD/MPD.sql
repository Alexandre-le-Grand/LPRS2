/*
----------LPRS----------
    ? User
        .id
        *email
        *nom
        *prenom
        *mdp
    .
    ? Etudiant
        .id
        *annee
        *cv
        *poste_entreprise
        *ref_utilisateur
    .
    ? Alumni
        .id
        *entreprise
        *poste
        *ref_etudiant
    .
    ? Entreprise
        .id
        *poste
        *fiche
        *ref_utilisateur
    .
    ? Professeur
        .id
        *discipline
        *formation
        *ref_utilisateur
    .
    ? Evenement
        .id
        *titre
        *date
        *lieu
        *description
        *ref_professeur
        *nombre_places
        *type
        *ref_entreprise
    .
    ? LinkEtudiantEvenement
        *ref_etudiant
        *ref_evenement
    .
    ? Offre
        .id
        *titre
        *description
        *type
        *etat
        *date
        *ref_entreprise
    .
    ? LinkEtudiantOffre
        *ref_etudiant
        *ref_offre
        *date
        *statut
    .
    ? Poste
        .id
        *titre
        *contenu
        *date_heure
        *ref_utilisateur
    .
    ? Reponse
        .id
        *contenu
        *date_heure_reponse
        *ref_reponse
----------LPRS---------->
*/--

-- * BDD setup
    -- . Création de la base de données
        CREATE DATABASE IF NOT EXISTS lprs;
    
    -- . Utilisation de la base de données lprs
        USE lprs;

    -- . Définir le moteur de stockage InnoDB par défaut
        SET default_storage_engine = InnoDB;

    -- .
-- * Ajout des tables
    -- . Table User
        CREATE TABLE `User` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            email VARCHAR(255) NOT NULL UNIQUE,
            nom VARCHAR(255) NOT NULL,
            prenom VARCHAR(255) NOT NULL,
            mdp VARCHAR(1000) NOT NULL
        ) ENGINE=InnoDB;

    -- . Table Etudiant
        CREATE TABLE `Etudiant` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            annee VARCHAR(255) NOT NULL,
            cv LONGTEXT,
            poste_entreprise VARCHAR(255),
            ref_utilisateur INT
        ) ENGINE=InnoDB;

    -- . Table Alumni
        CREATE TABLE `Alumni` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            entreprise VARCHAR(255) NOT NULL,
            poste VARCHAR(255) NOT NULL,
            ref_etudiant INT
        ) ENGINE=InnoDB;

    -- . Table Entreprise
        CREATE TABLE `Entreprise` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            poste VARCHAR(255) NOT NULL,
            fiche LONGTEXT,
            ref_utilisateur INT
        ) ENGINE=InnoDB;

    -- . Table Professeur
        CREATE TABLE `Professeur` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            discipline VARCHAR(255) NOT NULL,
            formation VARCHAR(255) NOT NULL,
            ref_utilisateur INT
        ) ENGINE=InnoDB;

    -- . Table Evenement
        CREATE TABLE `Evenement` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            titre VARCHAR(255) NOT NULL,
            date DATE NOT NULL,
            lieu VARCHAR(255) NOT NULL,
            description LONGTEXT,
            ref_professeur INT,
            nombre_places INT(3) NOT NULL,
            type VARCHAR(255) NOT NULL,
            ref_entreprise INT
        ) ENGINE=InnoDB;

    -- . Table LinkEtudiantEvenement
        CREATE TABLE `LinkEtudiantEvenement` (
            ref_etudiant INT,
            ref_evenement INT
        ) ENGINE=InnoDB;

    -- . Table Offre
        CREATE TABLE `Offre` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            titre VARCHAR(255) NOT NULL,
            description LONGTEXT,
            type VARCHAR(255) NOT NULL,
            etat VARCHAR(255) NOT NULL,
            date DATE NOT NULL,
            ref_entreprise INT
        ) ENGINE=InnoDB;

    -- . Table LinkEtudiantOffre
        CREATE TABLE `LinkEtudiantOffre` (
            ref_etudiant INT,
            ref_offre INT,
            date DATE NOT NULL,
            statut VARCHAR(255) NOT NULL
        ) ENGINE=InnoDB;

    -- . Table Poste
        CREATE TABLE `Poste` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            titre VARCHAR(255) NOT NULL,
            contenu LONGTEXT,
            date_heure DATETIME(6) NOT NULL,
            ref_utilisateur INT
        ) ENGINE=InnoDB;

    -- . Table Reponse
        CREATE TABLE `Reponse` (
            id INT PRIMARY KEY AUTO_INCREMENT,
            contenu LONGTEXT NOT NULL,
            date_heure_reponse DATETIME(6) NOT NULL,
            ref_reponse INT
        ) ENGINE=InnoDB;

    -- .
-- *Ajout des contraintes de clé étrangère
    -- . Table Etudiant
        ALTER TABLE `Etudiant` ADD FOREIGN KEY (ref_utilisateur) 
        REFERENCES User(id);

    -- . Table Alumni
        ALTER TABLE `Alumni` ADD FOREIGN KEY (ref_etudiant) 
        REFERENCES Etudiant(id);

    -- . Table Entreprise
        ALTER TABLE `Entreprise` ADD FOREIGN KEY (ref_utilisateur) 
        REFERENCES User(id);

    -- . Table Professeur
        ALTER TABLE `Professeur` ADD FOREIGN KEY (ref_utilisateur) 
        REFERENCES User(id);

    -- . Table Evenement
        ALTER TABLE `Evenement` ADD FOREIGN KEY (ref_professeur) 
        REFERENCES Professeur(id);
        ALTER TABLE `Evenement` ADD FOREIGN KEY (ref_entreprise) 
        REFERENCES Entreprise(id);

    -- . Table LinkEtudiantEvenement
        ALTER TABLE `LinkEtudiantEvenement` ADD FOREIGN KEY (ref_etudiant) 
        REFERENCES Etudiant(id);
        ALTER TABLE `LinkEtudiantEvenement` ADD FOREIGN KEY (ref_evenement) 
        REFERENCES Evenement(id);

    -- . Table Offre
        ALTER TABLE `Offre` ADD FOREIGN KEY (ref_entreprise) 
        REFERENCES Entreprise(id);

    -- . Table LinkEtudiantOffre
        ALTER TABLE `LinkEtudiantOffre` ADD FOREIGN KEY (ref_etudiant) 
        REFERENCES Etudiant(id);
        ALTER TABLE `LinkEtudiantOffre` ADD FOREIGN KEY (ref_offre) 
        REFERENCES Offre(id);

    -- . Table Poste
        ALTER TABLE `Poste` ADD FOREIGN KEY (ref_utilisateur) 
        REFERENCES User(id);

    -- . Table Reponse
        ALTER TABLE `Reponse` ADD FOREIGN KEY (ref_reponse) 
        REFERENCES Poste(id);
    
    -- .

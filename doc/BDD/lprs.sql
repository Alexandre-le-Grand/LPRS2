-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 16 sep. 2024 à 14:35
-- Version du serveur : 5.7.36
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `lprs`
--

-- --------------------------------------------------------

--
-- Structure de la table `alumni`
--

CREATE TABLE `alumni` (
  `id_alumni` int(11) NOT NULL,
  `promo` varchar(50) NOT NULL,
  `cv` text NOT NULL,
  `entreprise` varchar(50) NOT NULL,
  `poste` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `canditature`
--

CREATE TABLE `canditature` (
  `id_candidature` int(11) NOT NULL,
  `lettre_motivation` text NOT NULL,
  `date_postulation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `poste_entreprise` varchar(100) NOT NULL,
  `fiche_entreprise` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id_etudiant` int(11) NOT NULL,
  `annee_promo` date NOT NULL,
  `cv` varchar(100) NOT NULL,
  `poste_entreprise` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `lieu` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `nb_place` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id_offre` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `type_offre` varchar(50) NOT NULL,
  `etat_offre` varchar(50) NOT NULL,
  `date_publication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `participation`
--

CREATE TABLE `participation` (
  `id_participation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id_poste` int(11) NOT NULL,
  `titre` int(11) NOT NULL,
  `contenu` int(11) NOT NULL,
  `date_heure` datetime(6) NOT NULL,
  `canal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE `professeur` (
  `id_preofesseur` int(11) NOT NULL,
  `discipline` varchar(50) NOT NULL,
  `formation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `id_reponse` int(11) NOT NULL,
  `contenu` varchar(50) NOT NULL,
  `date_heure` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id_alumni`);

--
-- Index pour la table `canditature`
--
ALTER TABLE `canditature`
  ADD PRIMARY KEY (`id_candidature`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id_etudiant`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id_offre`);

--
-- Index pour la table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id_participation`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id_poste`);

--
-- Index pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id_preofesseur`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`id_reponse`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id_alumni` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `canditature`
--
ALTER TABLE `canditature`
  MODIFY `id_candidature` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id_etudiant` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id_offre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `participation`
--
ALTER TABLE `participation`
  MODIFY `id_participation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `id_preofesseur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `reponse`
--
ALTER TABLE `reponse`
  MODIFY `id_reponse` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

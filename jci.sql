-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 20 avr. 2024 à 06:46
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jci`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date`) VALUES
(1, 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', '2024-04-20 04:26:20');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `name`, `statut`, `date`) VALUES
(1, 'Membre', 1, '2024-04-12 20:05:34'),
(2, 'Postulant', 1, '2024-04-12 20:05:40');

-- --------------------------------------------------------

--
-- Structure de la table `comitedirecteurlocal`
--

CREATE TABLE `comitedirecteurlocal` (
  `id` int(11) NOT NULL,
  `id_membre` varchar(255) NOT NULL,
  `poste` text NOT NULL,
  `service` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comitedirecteurnationale`
--

CREATE TABLE `comitedirecteurnationale` (
  `id` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `poste` text NOT NULL,
  `service` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `institutionnationale`
--

CREATE TABLE `institutionnationale` (
  `id` int(11) NOT NULL,
  `id_membre` varchar(255) NOT NULL,
  `entite` text NOT NULL,
  `poste` text NOT NULL,
  `service` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`id`, `name`, `statut`, `date`) VALUES
(1, 'Sécrétariat permanent', 1, '2024-04-12 18:23:31'),
(2, 'Administrateur', 1, '2024-04-12 18:25:26'),
(3, 'Auditeur', 1, '2024-04-12 18:25:46'),
(4, 'Cabinet du président', 1, '2024-04-12 18:25:46'),
(5, 'Institut de formation JCI Bénin', 1, '2024-04-12 18:26:16'),
(6, 'Fondation JCI Bénin', 1, '2024-04-12 18:26:16'),
(7, 'Direction Nationale de communication et des relations publiques', 1, '2024-04-12 18:26:41'),
(8, 'Directions des manifestations officielles', 1, '2024-04-12 18:26:41');

-- --------------------------------------------------------

--
-- Structure de la table `type_membre`
--

CREATE TABLE `type_membre` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `statut` int(11) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_membre`
--

INSERT INTO `type_membre` (`id`, `name`, `statut`, `date`) VALUES
(1, 'Membre Actif', 1, '2024-04-12 20:21:22'),
(2, 'Membre d\'honneur', 1, '2024-04-12 20:21:28'),
(3, 'Membre Sénior', 1, '2024-04-12 20:21:32'),
(4, 'Membre Ambassadeur', 1, '2024-04-12 20:21:38'),
(5, 'Membre Sénateur', 1, '2024-04-12 20:21:42'),
(6, 'Pas encore membre', 1, '2024-04-18 12:53:27');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `type_membre` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `sexe` varchar(255) NOT NULL,
  `zone` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `region` varchar(255) NOT NULL,
  `organi_locale` varchar(255) NOT NULL,
  `organi_univers` varchar(255) NOT NULL,
  `organi_econo` varchar(255) NOT NULL,
  `mentor` varchar(255) NOT NULL,
  `situa_matri` varchar(255) NOT NULL,
  `profil` text NOT NULL,
  `statut` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comitedirecteurlocal`
--
ALTER TABLE `comitedirecteurlocal`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comitedirecteurnationale`
--
ALTER TABLE `comitedirecteurnationale`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `institutionnationale`
--
ALTER TABLE `institutionnationale`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_membre`
--
ALTER TABLE `type_membre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comitedirecteurlocal`
--
ALTER TABLE `comitedirecteurlocal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `comitedirecteurnationale`
--
ALTER TABLE `comitedirecteurnationale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `institutionnationale`
--
ALTER TABLE `institutionnationale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `type_membre`
--
ALTER TABLE `type_membre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

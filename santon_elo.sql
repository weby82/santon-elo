-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 02 Mars 2017 à 12:08
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `santon_elo`
--

-- --------------------------------------------------------

--
-- Structure de la table `actualite`
--

CREATE TABLE `actualite` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `date_event_start` date NOT NULL,
  `date_event_end` date NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(255) NOT NULL,
  `date_publication` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `guestbook`
--

CREATE TABLE `guestbook` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `santon`
--

CREATE TABLE `santon` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `stock` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `santon`
--

INSERT INTO `santon` (`id`, `nom`, `description`, `categorie`, `prix`, `photo`, `stock`) VALUES
(1, 'Mouton', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.', 'Nativité', '12', './assets/img/santons/nativite/mouton.jpg', 'OUI'),
(2, 'Vache', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.', 'Nativité', '12', './assets/img/santons/nativite/vache.jpg', ''),
(3, 'Vierge', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.', 'Nativité', '12', './assets/img/santons/nativite/santon3.jpg', 'OUI'),
(4, 'Ange', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.', 'Nativité', '12', './assets/img/santons/nativite/ange.jpg', 'OUI');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `actualite`
--
ALTER TABLE `actualite`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `guestbook`
--
ALTER TABLE `guestbook`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `santon`
--
ALTER TABLE `santon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `actualite`
--
ALTER TABLE `actualite`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `guestbook`
--
ALTER TABLE `guestbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `santon`
--
ALTER TABLE `santon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
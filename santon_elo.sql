-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 13 Mars 2017 à 11:48
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
CREATE DATABASE IF NOT EXISTS `santon_elo` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `santon_elo`;

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

--
-- Contenu de la table `actualite`
--

INSERT INTO `actualite` (`id`, `titre`, `contenu`, `photo`, `date`) VALUES
(1, 'Titre de l''article 1', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'http://lorempixel.com/150/150/abstract/6/', '2017-03-13'),
(2, 'Titre de l''article 2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'http://lorempixel.com/150/150/abstract/7/', '2017-03-08'),
(3, 'Titre de l''article 3', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\n                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\n                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\n                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\n                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\n                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'http://lorempixel.com/150/150/abstract/4/', '2017-03-03');

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
  `stock` varchar(10) NOT NULL,
  `date_ajout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `santon`
--

INSERT INTO `santon` (`id`, `nom`, `description`, `categorie`, `prix`, `photo`, `stock`, `date_ajout`) VALUES
(1, 'Mouton', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.', 'nativite', '12', './assets/img/santons/nativite/mouton.jpg', 'OUI', '2017-03-03 00:00:00'),
(2, 'Vache', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.', 'nativite', '12', './assets/img/santons/nativite/vache.jpg', 'NON', '2017-03-03 09:21:00'),
(3, 'Vierge', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.', 'nativite', '12', './assets/img/santons/nativite/santon3.jpg', 'OUI', '2017-03-05 11:13:00'),
(4, 'Ange', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae, eligendi fugiat necessitatibus illo deleniti, dignissimos voluptates nam incidunt est impedit animi eum vel consectetur non nulla provident sunt, architecto deserunt.', 'nativite', '12', './assets/img/santons/nativite/ange.jpg', 'OUI', '2017-03-05 15:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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

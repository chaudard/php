-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mar 14 Mars 2017 à 23:52
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `minichat`
--

CREATE TABLE `minichat` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `minichat`
--

INSERT INTO `minichat` (`id`, `pseudo`, `message`, `date`) VALUES
(1, 'Sslicey', 'Yo !', '2017-03-14 17:00:00'),
(2, 'Salut     ', 'La forme ?\r\n', '2017-03-15 00:33:41'),
(3, 'Salut     ', 'La forme ?\r\n', '2017-03-15 00:36:55'),
(4, 'Salut     ', 'La forme ?\r\n', '2017-03-15 00:38:05'),
(5, 'Salut     ', 'La forme ?\r\n', '2017-03-15 00:39:50'),
(6, 'Sslicey', 'Yo Dissident !', '2017-03-15 00:42:19'),
(7, 'Sslicey', 'ça pète sa mère non ?\r\n', '2017-03-15 00:42:34'),
(8, 'Sslicey', 'Tiens pour toi qui liras ces quelques lignes : J\'suis pas content TV c\'t\'une bonne chaine YT, et pour les infos sur les voleurs de banque j\'aime bien la revue de presse de Jovanovic !', '2017-03-15 00:43:44'),
(9, 'Sslicey', 'Yo Dissident !\r\n', '2017-03-15 00:49:59'),
(10, 'Sslicey', 'La forme ? ça bosse dur le PHP ?', '2017-03-15 00:50:13'),
(11, 'Sslicey', 'J\'me demande si t\'es pas Op pour un projet de site..', '2017-03-15 00:50:33'),
(12, 'Sslicey', 'M\'enfin bref tu lis ces lignes mais t\'en as rien à péter tu reverras jamais mon pseudo xD', '2017-03-15 00:50:58');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `minichat`
--
ALTER TABLE `minichat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `minichat`
--
ALTER TABLE `minichat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

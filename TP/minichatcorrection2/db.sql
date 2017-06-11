-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  localhost:8889
-- Généré le :  Mer 15 Mars 2017 à 11:11
-- Version du serveur :  5.6.33
-- Version de PHP :  5.6.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `mini_chat`
--

CREATE TABLE `mini_chat` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date_message` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `mini_chat`
--

INSERT INTO `mini_chat` (`id`, `pseudo`, `message`, `date_message`) VALUES
(160, 'Romutech', 'Hello world !', '2017-03-15 11:10:54'),
(161, 'Michonne', 'Hi guys :)', '2017-03-15 11:11:37');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `mini_chat`
--
ALTER TABLE `mini_chat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `mini_chat`
--
ALTER TABLE `mini_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;
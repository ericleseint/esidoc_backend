-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  db
-- Généré le :  Jeu 13 Avril 2017 à 09:11
-- Version du serveur :  5.5.54
-- Version de PHP :  5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `esidoc_backend`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id_article` int(10) NOT NULL,
  `RNE` char(8) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` longtext NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `date_publication` date NOT NULL,
  `id_image` int(10) NOT NULL,
  `html_text` tinyint(1) NOT NULL,
  `statut_publication` enum('','USER','ADMIN') NOT NULL,
  `tag_admin` varchar(255) NOT NULL,
  `date_insertion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_modification` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table des articles';

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`id_article`, `RNE`, `titre`, `contenu`, `date_debut`, `date_fin`, `date_publication`, `id_image`, `html_text`, `statut_publication`, `tag_admin`, `date_insertion`, `date_modification`) VALUES
(1, '0870022B', 'Le p\'tit Libé', 'Le quotidien <strong><em>Libération</em></strong> lance un mensuel pour les enfants.<br /><br />A lire en ligne sur<a target=\"_blank\" href=\"http://www.liberation.fr/apps/2015/10/ptit-libe/\"> <cite class=\"_Rm\">www.<b>liberation</b>.fr/apps/2015/10/<b>ptit</b>-<b>libe</b>/</cite></a> ou sur papier au CDI.<br />', '2015-11-25', '0000-00-00', '2015-11-12', 150, 0, '', 'petitlibe', '2017-04-13 08:54:14', '0000-00-00 00:00:00'),
(2, '0870022B', 'Vainqueurs du Prix Passerelle(s)', '<strong>Le prix Passerelle(s) est terminé.<br /><br /></strong><strong>Côté romans,</strong> les gagnants sont <strong><em>Le garçon qui ne voulait plus de frère</em> de Sophie Rigal-Goulard </strong>(niveau CM2/6e) et <strong><em>Un hiver en enfer</em> de Jo Witek</strong> (niveau 3e/2de).<br /><br /><strong>Côté spectacles</strong>, ce sont les mises en scène de<strong><em> Caprices ? C\'est fini ! </em></strong>(CM2/6e) et <strong><em>Un hiver en enfer</em></strong> (3e/2de) qui ont gagné.<br /><br />Pour en savoir plus :<a href=\"http://blogs.crdp-limousin.fr/87-prix-passerelles/\" target=\"_blank\"> http://blogs.crdp-limousin.fr/87-prix-passerelles/</a>', NULL, NULL, '2017-01-23', 14, 0, '', 'vainqueurpasserelle', '2017-04-13 08:58:06', '0000-00-00 00:00:00');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

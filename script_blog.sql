-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 21 jan. 2023 à 21:20
-- Version du serveur :  5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(256) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `auteur` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `auteur` (`auteur`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `text`, `auteur`) VALUES
(1, 'Les langages de programmation populaires', 'Il existe de nombreux langages de programmation populaires, chacun ayant ses propres caractéristiques et ses propres utilisations. Parmi les plus populaires, on peut citer:\r\n\r\nPython: langage de programmation très utilisé pour la data science et l\'apprentissage automatique\r\nJava: langage de programmation populaire pour la création d\'applications pour ordinateurs et mobiles\r\nJavaScript: langage de programmation populaire pour la création de sites web dynamiques', 'amine'),
(3, 'La programmation orientée obje', 'La programmation orientée objet (POO) est un style de programmation qui utilise des objets pour structurer les programmes. Les objets sont des instances de classes, qui définissent les propriétés et les méthodes des objets. La POO permet de créer des programmes plus structurés et plus faciles à maintenir.', 'hani'),
(4, 'Introduction à la programmation', 'La programmation est l\'ensemble des techniques et des méthodes qui permettent de créer des programmes informatiques. Ces programmes peuvent être utilisés pour automatiser des tâches, pour créer des applications, pour analyser des données, etc. Il existe de nombreux langages de programmation, chacun ayant ses propres caractéristiques et ses propres utilisations.', 'amine'),
(5, 'Les bases de la programmation', 'Pour commencer à programmer, il est important de comprendre les bases de la programmation. Ces bases comprennent des concepts tels que les variables, les boucles, les conditions, les fonctions et les objets. Une fois que ces concepts sont maîtrisés, il est possible de commencer à créer des programmes simples, tels que des calculatrices ou des jeux.', 'amine'),
(6, 'Les outils de développement pour les programmeurs', 'Il existe de nombreux outils de développement pour les programmeurs, tels que des éditeurs de code, des débogueurs, des gestionnaires de versions, des outils de test, etc. Ces outils aident les programmeurs à écrire, à tester et à déployer leurs programmes plus efficacement. Il est important de choisir les bons outils en fonction des besoins de son projet.', 'hani'),
(7, 'Introduction à l\'Internet des objets (IoT)', 'L\'Internet des objets (IoT) est un concept qui décrit l\'interconnexion de dispositifs physiques et virtuels à travers un réseau, généralement Internet. Les objets connectés sont dotés de capteurs et d\'actuateurs qui permettent de les connecter à Internet et de les contrôler à distance. Les applications de l\'IoT sont nombreuses, allant de la domotique à la santé en passant par l\'agriculture.', 'hani'),
(8, 'Les technologies de l\'IoT', 'Il existe de nombreuses technologies qui permettent de connecter des objets à Internet. Les technologies les plus courantes sont:\r\n\r\nLe Wi-Fi, qui permet de connecter des objets à un réseau local ou à Internet.\r\nLe Bluetooth, qui permet de connecter des objets à des appareils mobiles et à des ordinateurs.\r\nLes réseaux de l\'Internet des objets (LPWAN) tels que LoRaWAN ou Sigfox, qui permettent de connecter des objets à longue distance avec des besoins en énergie réduit.', 'hani'),
(9, 'Les défis de l\'IoT', 'L\'IoT soulève de nombreux défis, notamment en matière de sécurité et de confidentialité. Les objets connectés peuvent être la cible d\'attaques informatiques, comme le piratage, qui peut entraîner des conséquences graves pour les utilisateurs. Il est donc important de prendre en compte les risques liés à la sécurité lors de la conception et de la mise en place d\'une infrastructure IoT. La gestion de la vie privée est également un enjeu important à prendre en compte avec la collecte de données et leur utilisation.', 'hani');

-- --------------------------------------------------------

--
-- Structure de la table `usager`
--

DROP TABLE IF EXISTS `usager`;
CREATE TABLE IF NOT EXISTS `usager` (
  `username` varchar(40) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `usager`
--

INSERT INTO `usager` (`username`, `password`) VALUES
('amine', '$2y$10$D.IpZhMCep5qP3N4EmsYMeuqkXfui1oz87sd3k0T7HgjZEweM5hpu'),
('hani', '$2y$10$cJT1xlIxlWXLFTAYMdTzKe4WTdMWZnhAo5s03GTTUgapHbH8YBY2S');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

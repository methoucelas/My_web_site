-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 19 déc. 2025 à 11:35
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cerfop`
--

-- --------------------------------------------------------

--
-- Structure de la table `about_us`
--

CREATE TABLE `about_us` (
  `id_about_us` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `details` text DEFAULT NULL,
  `date_insertion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `about_us`
--

INSERT INTO `about_us` (`id_about_us`, `title`, `details`, `date_insertion`) VALUES
(2, 'AbeLab', '<p>&nbsp; AbeLab is a leading capacity development and consultancy center dedicated to empoweri professionals and organizations across Africa. Based in Nairobi, Kenya, we deliver&nbsp;&nbsp;<span style=\"color:#2ecc71\">practical solutions that help individuals enhance their careers and enabl&nbsp;institutions to strengthen their performance and impact.</span><br />\r\nOur areas of expertise include Socio-economic Research, Spatial Technologies,&nbsp;</p>\r\n\r\n<p>&nbsp;Climate Change &amp; Environmental Sustainability, Gender Equality &amp; Social Inclusion,&nbsp;<br />\r\n&nbsp;Data Management &amp; Statistics, Project Cycle Management, Enterprise Development,&nbsp;Governance, Organizational Development, and Personal Productivity.</p>\r\n', '2025-12-08 15:46:13');

-- --------------------------------------------------------

--
-- Structure de la table `attendace_course_mode`
--

CREATE TABLE `attendace_course_mode` (
  `id_attendance` int(11) NOT NULL,
  `nom_attendance` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `attendace_course_mode`
--

INSERT INTO `attendace_course_mode` (`id_attendance`, `nom_attendance`) VALUES
(1, 'En ligne'),
(2, 'Presentiel');

-- --------------------------------------------------------

--
-- Structure de la table `carousels`
--

CREATE TABLE `carousels` (
  `IdCarousel` int(11) NOT NULL,
  `Image` varchar(250) NOT NULL,
  `Description` text NOT NULL,
  `Detail` text NOT NULL,
  `IsActive` tinyint(1) NOT NULL,
  `Title` varchar(200) NOT NULL,
  `IdProductType` int(11) DEFAULT NULL,
  `date_insertion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `carousels`
--

INSERT INTO `carousels` (`IdCarousel`, `Image`, `Description`, `Detail`, `IsActive`, `Title`, `IdProductType`, `date_insertion`) VALUES
(9, '202512190828556944feb75053e.jpg', '<p>Formation en D&eacute;veloppement Web</p>\r\n', 'Apprenez à créer des sites web modernes', 1, 'Développement Web', NULL, '2025-12-18 10:00:00'),
(10, '202512190828246944fe9891388.jpg', '<p>Formation en Marketing Digital</p>\r\n', 'Maîtrisez les outils du marketing digital', 1, 'Marketing Digital', NULL, '2025-12-18 10:00:00'),
(11, '202512190827586944fe7e49d93.jpg', '<p>Formation en Design Graphique</p>\r\n', 'Créez des designs percutants', 1, 'Design Graphique', NULL, '2025-12-18 10:00:00'),
(12, '202512190827366944fe6862c5e.jpg', '<p>Formation en Gestion de Projet</p>\r\n', 'Devenez un expert en gestion de projet', 1, 'Gestion de Projet', NULL, '2025-12-18 10:00:00'),
(13, '202512190826526944fe3c2e397.jpg', '<p>Formation en Data Science</p>\r\n', 'Analysez les données pour prendre de meilleures décisions', 1, 'Data Science', NULL, '2025-12-18 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id_categorie` int(11) NOT NULL,
  `nom_categories` varchar(200) NOT NULL,
  `Image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categories`, `Image`) VALUES
(2, 'Gestion de Projet', '2025121017224169399e5134979.png'),
(3, 'Développement Web', '2025121017212769399e070b99f.png'),
(4, 'Design Graphique', '2025121017215069399e1e74f8b.png'),
(5, 'Cybersécurité', '2025121017233769399e89f2ff6.jpg'),
(6, 'Informatique', '2025121900121169448a4bd47ee.jpg'),
(7, 'Marketing', '2025121900124569448a6ddf395.png'),
(9, 'Gestion', '2025121900115569448a3b3c9ef.jpg'),
(10, 'Langues', '2025121900113969448a2ba9021.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `contact_us`
--

CREATE TABLE `contact_us` (
  `IdContact` int(11) NOT NULL,
  `FullName` varchar(250) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `Subject` varchar(250) NOT NULL,
  `Message` text NOT NULL,
  `PhoneNumber` varchar(12) NOT NULL,
  `Date_creation` datetime NOT NULL DEFAULT current_timestamp(),
  `Location` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact_us`
--

INSERT INTO `contact_us` (`IdContact`, `FullName`, `Email`, `Subject`, `Message`, `PhoneNumber`, `Date_creation`, `Location`) VALUES
(9, 'Jean Dupont', 'jean@email.com', 'Demande d\'information', 'Je voudrais en savoir plus sur les formations', '0612345678', '2025-12-18 10:00:00', 'Paris'),
(10, 'Marie Martin', 'marie@email.com', 'Problème d\'inscription', 'Je n\'arrive pas à m\'inscrire en ligne', '0623456789', '2025-12-18 10:00:00', 'Lyon'),
(11, 'Pierre Durand', 'pierre@email.com', 'Demande de brochure', 'Pouvez-vous m\'envoyer votre brochure ?', '0634567890', '2025-12-18 10:00:00', 'Marseille'),
(12, 'Sophie Bernard', 'sophie@email.com', 'Question sur les financements', 'Quels sont les financements possibles ?', '0645678901', '2025-12-18 10:00:00', 'Toulouse'),
(13, 'Luc Petit', 'luc@email.com', 'Demande de rendez-vous', 'Je souhaite prendre rendez-vous', '0656789012', '2025-12-18 10:00:00', 'Bordeaux'),
(15, 'DUSHIME PAUL', 'G@GMAIL.COM', '3IFOE nnnnnnnnnnnnnnnnnnnn', 'njhhiu', '9497823', '2025-12-19 11:28:42', '');

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `id_course` int(11) NOT NULL,
  `nom_course` varchar(100) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `date_insertion` datetime NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id_course`, `nom_course`, `id_categorie`, `id_teacher`, `date_insertion`, `description`) VALUES
(3, 'francais', 2, 1, '2025-12-08 21:26:24', '<h1 style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Ce cours est con&ccedil;u pour perfectionner les comp&eacute;tences et les connaissances des participants en mati&egrave;re de Microsoft Excel. Il leur permettra d&#39;acqu&eacute;rir les comp&eacute;tences essentielles pour optimiser leur productivit&eacute;, am&eacute;liorer la pr&eacute;cision de leurs donn&eacute;es et prendre des d&eacute;cisions &eacute;clair&eacute;es gr&acirc;ce aux fonctionnalit&eacute;s avanc&eacute;es d&#39;Excel.</span></span></span></span></h1>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Les participants acquerront une compr&eacute;hension approfondie des fonctions et techniques Excel de niveau interm&eacute;diaire. Ils apprendront &agrave; g&eacute;rer et manipuler efficacement des donn&eacute;es, &agrave; effectuer des calculs complexes et &agrave; cr&eacute;er des feuilles de calcul de qualit&eacute; professionnelle.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Ce cours est con&ccedil;u pour les personnes ayant une connaissance de base d&#39;Excel et souhaitant am&eacute;liorer leurs comp&eacute;tences en analyse de donn&eacute;es, en cr&eacute;ation de formules et en visualisation de donn&eacute;es.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Dur&eacute;e du cours :&nbsp;</strong></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Formation en ligne : 7</strong>&nbsp;jours</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Formation en salle :</strong>&nbsp;5 jours</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Plan de cours</strong></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 1 : Formules et fonctions avanc&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n <li>R&eacute;vision des fonctions et formules de base d&#39;Excel</li>\r\n  <li>Utilisation des fonctions logiques (SI, ET, OU)</li>\r\n    <li>Utilisation des fonctions de recherche (RECHERCHEV, RECHERCHEH, INDEX, EQUIV)</li>\r\n  <li>Application des fonctions de texte (GAUCHE, DROITE, MILIEU, CONCATENER)</li>\r\n    <li>Introduction aux formules matricielles</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 2 : Analyse et manipulation des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n    <li>Tri et filtrage des donn&eacute;es</li>\r\n <li>Utilisation de techniques avanc&eacute;es de validation des donn&eacute;es</li>\r\n <li>Application de la mise en forme conditionnelle</li>\r\n <li>Utilisation des tableaux de donn&eacute;es et analyse de sc&eacute;narios</li>\r\n  <li>Introduction aux tableaux crois&eacute;s dynamiques et aux graphiques crois&eacute;s dynamiques</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 3&nbsp;: Utilisation des fonctions avanc&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n   <li>Utilisation des fonctions de date et d&#39;heure</li>\r\n   <li>Utilisation des fonctions statistiques (MOYENNE, NOMBRE, MAX, MIN)</li>\r\n <li>Effectuer des calculs math&eacute;matiques (SOMMEPROD, ARRONDI, ABS)</li>\r\n   <li>Utilisation des fonctions financi&egrave;res (VAN, TRI, PMT)</li>\r\n   <li>Personnalisation et cr&eacute;ation de fonctions d&eacute;finies par l&#39;utilisateur (UDF)</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 4 : Visualisation et pr&eacute;sentation des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n <li>Cr&eacute;ation de graphiques et de diagrammes dynamiques</li>\r\n  <li>Personnalisation des &eacute;l&eacute;ments du graphique et des options de mise en forme</li>\r\n   <li>Cr&eacute;ation de tableaux de bord interactifs</li>\r\n    <li>Utilisation des segments et des chronologies</li>\r\n   <li>G&eacute;n&eacute;rer des rapports &agrave; l&#39;aide de techniques de visualisation des donn&eacute;es</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 5 : Techniques avanc&eacute;es de gestion des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n    <li>Travailler avec des tableaux et des r&eacute;f&eacute;rences structur&eacute;es</li>\r\n    <li>Utilisation de la validation des donn&eacute;es et de la logique conditionnelle</li>\r\n    <li>Techniques de filtrage avanc&eacute;es</li>\r\n <li>Consolidation et liaison des donn&eacute;es</li>\r\n    <li>Automatisation des t&acirc;ches avec des macros</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Remarque&nbsp;: Ce document pr&eacute;sente la structure g&eacute;n&eacute;rale d&rsquo;une formation de 5&nbsp;jours sur Excel de niveau interm&eacute;diaire. Le contenu, les activit&eacute;s et la dur&eacute;e de chaque session peuvent &ecirc;tre adapt&eacute;s en fonction du public cible, des objectifs p&eacute;dagogiques et du temps disponible.</span></span></span></span></p>\r\n'),
(4, 'Java', 6, 1, '2025-12-08 21:27:38', '<h1 style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Ce cours est con&ccedil;u pour perfectionner les comp&eacute;tences et les connaissances des participants en mati&egrave;re de Microsoft Excel. Il leur permettra d&#39;acqu&eacute;rir les comp&eacute;tences essentielles pour optimiser leur productivit&eacute;, am&eacute;liorer la pr&eacute;cision de leurs donn&eacute;es et prendre des d&eacute;cisions &eacute;clair&eacute;es gr&acirc;ce aux fonctionnalit&eacute;s avanc&eacute;es d&#39;Excel.</span></span></span></span></h1>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Les participants acquerront une compr&eacute;hension approfondie des fonctions et techniques Excel de niveau interm&eacute;diaire. Ils apprendront &agrave; g&eacute;rer et manipuler efficacement des donn&eacute;es, &agrave; effectuer des calculs complexes et &agrave; cr&eacute;er des feuilles de calcul de qualit&eacute; professionnelle.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Ce cours est con&ccedil;u pour les personnes ayant une connaissance de base d&#39;Excel et souhaitant am&eacute;liorer leurs comp&eacute;tences en analyse de donn&eacute;es, en cr&eacute;ation de formules et en visualisation de donn&eacute;es.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Dur&eacute;e du cours :&nbsp;</strong></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Formation en ligne : 7</strong>&nbsp;jours</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Formation en salle :</strong>&nbsp;5 jours</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Plan de cours</strong></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 1 : Formules et fonctions avanc&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n <li>R&eacute;vision des fonctions et formules de base d&#39;Excel</li>\r\n  <li>Utilisation des fonctions logiques (SI, ET, OU)</li>\r\n    <li>Utilisation des fonctions de recherche (RECHERCHEV, RECHERCHEH, INDEX, EQUIV)</li>\r\n  <li>Application des fonctions de texte (GAUCHE, DROITE, MILIEU, CONCATENER)</li>\r\n    <li>Introduction aux formules matricielles</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 2 : Analyse et manipulation des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n    <li>Tri et filtrage des donn&eacute;es</li>\r\n <li>Utilisation de techniques avanc&eacute;es de validation des donn&eacute;es</li>\r\n <li>Application de la mise en forme conditionnelle</li>\r\n <li>Utilisation des tableaux de donn&eacute;es et analyse de sc&eacute;narios</li>\r\n  <li>Introduction aux tableaux crois&eacute;s dynamiques et aux graphiques crois&eacute;s dynamiques</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 3&nbsp;: Utilisation des fonctions avanc&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n   <li>Utilisation des fonctions de date et d&#39;heure</li>\r\n   <li>Utilisation des fonctions statistiques (MOYENNE, NOMBRE, MAX, MIN)</li>\r\n <li>Effectuer des calculs math&eacute;matiques (SOMMEPROD, ARRONDI, ABS)</li>\r\n   <li>Utilisation des fonctions financi&egrave;res (VAN, TRI, PMT)</li>\r\n   <li>Personnalisation et cr&eacute;ation de fonctions d&eacute;finies par l&#39;utilisateur (UDF)</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 4 : Visualisation et pr&eacute;sentation des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n <li>Cr&eacute;ation de graphiques et de diagrammes dynamiques</li>\r\n  <li>Personnalisation des &eacute;l&eacute;ments du graphique et des options de mise en forme</li>\r\n   <li>Cr&eacute;ation de tableaux de bord interactifs</li>\r\n    <li>Utilisation des segments et des chronologies</li>\r\n   <li>G&eacute;n&eacute;rer des rapports &agrave; l&#39;aide de techniques de visualisation des donn&eacute;es</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 5 : Techniques avanc&eacute;es de gestion des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n    <li>Travailler avec des tableaux et des r&eacute;f&eacute;rences structur&eacute;es</li>\r\n    <li>Utilisation de la validation des donn&eacute;es et de la logique conditionnelle</li>\r\n    <li>Techniques de filtrage avanc&eacute;es</li>\r\n <li>Consolidation et liaison des donn&eacute;es</li>\r\n    <li>Automatisation des t&acirc;ches avec des macros</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Remarque&nbsp;: Ce document pr&eacute;sente la structure g&eacute;n&eacute;rale d&rsquo;une formation de 5&nbsp;jours sur Excel de niveau interm&eacute;diaire. Le contenu, les activit&eacute;s et la dur&eacute;e de chaque session peuvent &ecirc;tre adapt&eacute;s en fonction du public cible, des objectifs p&eacute;dagogiques et du temps disponible.</span></span></span></span></p>\r\n'),
(5, 'Ergonomies', 3, 1, '2025-12-09 08:57:04', '<h1 style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Ce cours est con&ccedil;u pour perfectionner les comp&eacute;tences et les connaissances des participants en mati&egrave;re de Microsoft Excel. Il leur permettra d&#39;acqu&eacute;rir les comp&eacute;tences essentielles pour optimiser leur productivit&eacute;, am&eacute;liorer la pr&eacute;cision de leurs donn&eacute;es et prendre des d&eacute;cisions &eacute;clair&eacute;es gr&acirc;ce aux fonctionnalit&eacute;s avanc&eacute;es d&#39;Excel.</span></span></span></span></h1>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Les participants acquerront une compr&eacute;hension approfondie des fonctions et techniques Excel de niveau interm&eacute;diaire. Ils apprendront &agrave; g&eacute;rer et manipuler efficacement des donn&eacute;es, &agrave; effectuer des calculs complexes et &agrave; cr&eacute;er des feuilles de calcul de qualit&eacute; professionnelle.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Ce cours est con&ccedil;u pour les personnes ayant une connaissance de base d&#39;Excel et souhaitant am&eacute;liorer leurs comp&eacute;tences en analyse de donn&eacute;es, en cr&eacute;ation de formules et en visualisation de donn&eacute;es.</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Dur&eacute;e du cours :&nbsp;</strong></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Formation en ligne : 7</strong>&nbsp;jours</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Formation en salle :</strong>&nbsp;5 jours</span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Plan de cours</strong></span></span></span></span></p>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 1 : Formules et fonctions avanc&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n   <li>R&eacute;vision des fonctions et formules de base d&#39;Excel</li>\r\n  <li>Utilisation des fonctions logiques (SI, ET, OU)</li>\r\n    <li>Utilisation des fonctions de recherche (RECHERCHEV, RECHERCHEH, INDEX, EQUIV)</li>\r\n  <li>Application des fonctions de texte (GAUCHE, DROITE, MILIEU, CONCATENER)</li>\r\n    <li>Introduction aux formules matricielles</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 2 : Analyse et manipulation des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n    <li>Tri et filtrage des donn&eacute;es</li>\r\n <li>Utilisation de techniques avanc&eacute;es de validation des donn&eacute;es</li>\r\n <li>Application de la mise en forme conditionnelle</li>\r\n <li>Utilisation des tableaux de donn&eacute;es et analyse de sc&eacute;narios</li>\r\n  <li>Introduction aux tableaux crois&eacute;s dynamiques et aux graphiques crois&eacute;s dynamiques</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 3&nbsp;: Utilisation des fonctions avanc&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n   <li>Utilisation des fonctions de date et d&#39;heure</li>\r\n   <li>Utilisation des fonctions statistiques (MOYENNE, NOMBRE, MAX, MIN)</li>\r\n <li>Effectuer des calculs math&eacute;matiques (SOMMEPROD, ARRONDI, ABS)</li>\r\n   <li>Utilisation des fonctions financi&egrave;res (VAN, TRI, PMT)</li>\r\n   <li>Personnalisation et cr&eacute;ation de fonctions d&eacute;finies par l&#39;utilisateur (UDF)</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 4 : Visualisation et pr&eacute;sentation des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n <li>Cr&eacute;ation de graphiques et de diagrammes dynamiques</li>\r\n  <li>Personnalisation des &eacute;l&eacute;ments du graphique et des options de mise en forme</li>\r\n   <li>Cr&eacute;ation de tableaux de bord interactifs</li>\r\n    <li>Utilisation des segments et des chronologies</li>\r\n   <li>G&eacute;n&eacute;rer des rapports &agrave; l&#39;aide de techniques de visualisation des donn&eacute;es</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\"><strong>Module 5 : Techniques avanc&eacute;es de gestion des donn&eacute;es</strong></span></span></span></span></p>\r\n\r\n<ul>\r\n    <li>Travailler avec des tableaux et des r&eacute;f&eacute;rences structur&eacute;es</li>\r\n    <li>Utilisation de la validation des donn&eacute;es et de la logique conditionnelle</li>\r\n    <li>Techniques de filtrage avanc&eacute;es</li>\r\n <li>Consolidation et liaison des donn&eacute;es</li>\r\n    <li>Automatisation des t&acirc;ches avec des macros</li>\r\n</ul>\r\n\r\n<p style=\"text-align:start\"><span style=\"font-size:14px\"><span style=\"font-family:Nunito,Arial,Helvetica,sans-serif\"><span style=\"color:#2b2b2b\"><span style=\"background-color:#ffffff\">Remarque&nbsp;: Ce document pr&eacute;sente la structure g&eacute;n&eacute;rale d&rsquo;une formation de 5&nbsp;jours sur Excel de niveau interm&eacute;diaire. Le contenu, les activit&eacute;s et la dur&eacute;e de chaque session peuvent &ecirc;tre adapt&eacute;s en fonction du public cible, des objectifs p&eacute;dagogiques et du temps disponible.</span></span></span></span></p>\r\n'),
(6, 'Langage c', 6, 1, '2025-12-09 18:53:13', '<p>nnnnnnnnnnnnnnnnnnnnnnn nnnnnnnnnnnnnnnnnnnnnnnnnn&nbsp; Ce cours est con&ccedil;u pour perfectionner les comp&eacute;tences et les connaissances des participants en mati&egrave;re de Microsoft Excel. Il leur permettra d&#39;acqu&eacute;rir les comp&eacute;tences essentielles pour optimiser leur productivit&eacute;, am&eacute;liorer lannnnnnnnnnnnn</p>\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `lieu` varchar(255) NOT NULL,
  `mois` varchar(20) NOT NULL,
  `annee` int(11) DEFAULT 2025,
  `est_en_ligne` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsActive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `events`
--

INSERT INTO `events` (`id`, `titre`, `date_debut`, `date_fin`, `lieu`, `mois`, `annee`, `est_en_ligne`, `description`, `image`, `created_at`, `IsActive`) VALUES
(3, 'Déc Formation aux techniques du développement et de la gestion de projets.', '2025-12-08', '2025-12-13', 'wekwk', 'DECEMBER', 2025, 0, '<p style=\"margin-left:40px\">ISHENGERO RY&#39;ABADVENTISTE B&#39;UMUSI Kivoga, kuwa&hellip;. /11/2024<br />\r\nW&rsquo;INDWI MU BURUNDI<br />\r\nMISIYONI Y&#39;UBUMANUKO BUSHIRA UBURENGERO BW&#39;UBURUNDI<br />\r\nINTARA MVUGABUTUMWA YA LYCEE MARANATHA YO MU KIVOGA<br />\r\nUMUGWI W&#39;ABAVUGISHA UBUTUMWA IBITABO<br />\r\nBO MURI LYCEE MARANATHA YO MU KIVOGA<br />\r\nImvo. Gusaba Ubufasha Ku bagize ishengero rya&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.<br />\r\nBene Data dusangiye urugendo rwo kuja mw&rsquo;ijuru, turabaramukije tubipfuriza amahoro y&#39;Umwami wacu Yesu Kristo<br />\r\nngo abane namwe.<br />\r\nTwebwe abagize umurwi w&#39;abavugisha ubutumwa ibitabu bo muri Lyc&eacute;e Maranatha yo mu Kivoga, ntitwasigaye inyuma<br />\r\nmu gikorwa co kugarura abazimiye bataramenya ukuri. Kubw&#39;ivyo, turi n&#39;iteka ryo kubamenyesha ko dufise igikorane<br />\r\nc&#39;ivugabutumwa kizobera kw&#39;ishengero rya MAGEYO, mu Ntara Mvugabutumwa ya ISARE, Commune MUBIMBI, Intara ya<br />\r\nBUJUMBURA, kikaba kizomara indwi zibiri, kuva Igenekerezo rya 11/4/2025 gushika kurya 26/4/2025.<br />\r\nKandi kubw&#39;ubuntu bw&#39;Imana, n&#39;ubufasha n&#39;amasengesho y&#39;amashengero n&#39;abakunzi b&#39;igikorwa c&#39;lmana, kuva mu<br />\r\nmwaka wa 2011 turamaze gukora amavugabutumwa arenga cumi (10) mu ntara zitandukanye z&#39;igihugu. Hamwe muho<br />\r\ntwabashije gukorera ni nka:<br />\r\n-Muyinga-Kobero: 67 barabatijwe kuri 187 bihaye Imana ,<br />\r\n-Rumonge-Bugarama: 44 barabatijwe kuri 90 bihaye Imana,<br />\r\n-Gitega-Kibimba: 21 barabatijwe kuri 104 bihaye Imana,<br />\r\n-Bururi-Mugamba: 9 barabatijwe kuri 34 bihaye Imana,<br />\r\n-Mwaro-Kayokwe :23 barabatijwe kuri 111 bihaye Imana,<br />\r\nN&#39;ahandi tutiriwe tuvuga. Kandi henshi muri ivyo bibanza twasize twubatse amashengero<br />\r\nMu ntumbero rero yo kubandanya twagura igikorwa n&#39;uyu mwaka wa 2025. Intererano zanyu n&#39;amasengesho<br />\r\nbirakenewe cane. Murazi neza ko turi abanyeshure, nta buryo dufise, duhanze amaso mwebwe, nimudutume natwe<br />\r\nturagenda.<br />\r\nTurangije tubashimira ku rukundo n&#39;ububangutsi muzobikorana. Ubuntu n&#39;amahoro biva ku Mana Data wa twese<br />\r\nn&#39;Umucunguzi wacu Yesu Kristo bibane namwe Murakoze. Some Daniyeli 12:3<br />\r\nM.N: Twifuza ko ubufasha bwanyu bwo dushikira imbere y&#39;igenekerezo rya 25/02/2025.<br />\r\nBiciye mu minwe ya: Biko9f</p>\r\n\r\n<p>&nbsp;</p>\r\n', '1765214492_6937091c06b50.jpg', '2025-12-08 17:21:32', 1),
(5, 'sdhie', '2025-12-12', '2025-12-27', 'ketjiowe', 'DECEMBER', 2025, 0, '<p>ISHENGERO RY&#39;ABADVENTISTE B&#39;UMUSI Kivoga, kuwa&hellip;. /11/2024<br />\r\nW&rsquo;INDWI MU BURUNDI<br />\r\nMISIYONI Y&#39;UBUMANUKO BUSHIRA UBURENGERO BW&#39;UBURUNDI<br />\r\nINTARA MVUGABUTUMWA YA LYCEE MARANATHA YO MU KIVOGA<br />\r\nUMUGWI W&#39;ABAVUGISHA UBUTUMWA IBITABO<br />\r\nBO MURI LYCEE MARANATHA YO MU KIVOGA<br />\r\nImvo. Gusaba Ubufasha Ku bagize ishengero rya&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;&hellip;.<br />\r\nBene Data dusangiye urugendo rwo kuja mw&rsquo;ijuru, turabaramukije tubipfuriza amahoro y&#39;Umwami wacu Yesu Kristo<br />\r\nngo abane namwe.<br />\r\nTwebwe abagize umurwi w&#39;abavugisha ubutumwa ibitabu bo muri Lyc&eacute;e Maranatha yo mu Kivoga, ntitwasigaye inyuma<br />\r\nmu gikorwa co kugarura abazimiye bataramenya ukuri. Kubw&#39;ivyo, turi n&#39;iteka ryo kubamenyesha ko dufise igikorane<br />\r\nc&#39;ivugabutumwa kizobera kw&#39;ishengero rya MAGEYO, mu Ntara Mvugabutumwa ya ISARE, Commune MUBIMBI, Intara ya<br />\r\nBUJUMBURA, kikaba kizomara indwi zibiri, kuva Igenekerezo rya 11/4/2025 gushika kurya 26/4/2025.<br />\r\nKandi kubw&#39;ubuntu bw&#39;Imana, n&#39;ubufasha n&#39;amasengesho y&#39;amashengero n&#39;abakunzi b&#39;igikorwa c&#39;lmana, kuva mu<br />\r\nmwaka wa 2011 turamaze gukora amavugabutumwa arenga cumi (10) mu ntara zitandukanye z&#39;igihugu. Hamwe muho<br />\r\ntwabashije gukorera ni nka:<br />\r\n-Muyinga-Kobero: 67 barabatijwe kuri 187 bihaye Imana ,<br />\r\n-Rumonge-Bugarama: 44 barabatijwe kuri 90 bihaye Imana,<br />\r\n-Gitega-Kibimba: 21 barabatijwe kuri 104 bihaye Imana,<br />\r\n-Bururi-Mugamba: 9 barabatijwe kuri 34 bihaye Imana,<br />\r\n-Mwaro-Kayokwe :23 barabatijwe kuri 111 bihaye Imana,<br />\r\nN&#39;ahandi tutiriwe tuvuga. Kandi henshi muri ivyo bibanza twasize twubatse amashengero<br />\r\nMu ntumbero rero yo kubandanya twagura igikorwa n&#39;uyu mwaka wa 2025. Intererano zanyu n&#39;amasengesho<br />\r\nbirakenewe cane. Murazi neza ko turi abanyeshure, nta buryo dufise, duhanze amaso mwebwe, nimudutume natwe<br />\r\nturagenda.<br />\r\nTurangije tubashimira ku rukundo n&#39;ububangutsi muzobikorana. Ubuntu n&#39;amahoro biva ku Mana Data wa twese<br />\r\nn&#39;Umucunguzi wacu Yesu Kristo bibane namwe Murakoze. Some Daniyeli 12:3<br />\r\nM.N: Twifuza ko ubufasha bwanyu bwo dushikira imbere y&#39;igenekerezo rya 25/02/2025.<br />\r\nBiciye mu minwe ya: Biko</p>\r\n', '1765220107_69371f0b65b7b.jpg', '2025-12-08 18:55:07', 0),
(6, 'Conférence Tech 2025', '2025-01-15', '2025-01-16', 'Paris Expo', 'Janvier', 2025, 0, 'Conférence sur les nouvelles technologies', 'tech2025.jpg', '2025-12-18 08:00:00', 1),
(7, 'Workshop Design', '2025-02-20', '2025-02-21', 'Lyon Convention', 'Février', 2025, 1, 'Atelier de design créatif', 'design-workshop.jpg', '2025-12-18 08:00:00', 1),
(8, 'Salon de l\'Emploi', '2025-03-10', '2025-03-12', 'Marseille', 'Mars', 2025, 0, 'Rencontre entre entreprises et chercheurs d\'emploi', 'emploi2025.jpg', '2025-12-18 08:00:00', 1),
(9, 'Formation Marketing', '2025-04-05', '2025-04-07', 'Toulouse', 'Avril', 2025, 1, 'Formation intensive en marketing', 'marketing-formation.jpg', '2025-12-18 08:00:00', 1),
(10, 'Journée Portes Ouvertes', '2025-05-15', '2025-05-15', 'CERFOP Paris', 'Mai', 2025, 0, 'Découvrez nos formations', 'jpo2025.jpg', '2025-12-18 08:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `gallery`
--

CREATE TABLE `gallery` (
  `IdGallery` int(11) NOT NULL,
  `TypeMedia` enum('image','video','link') NOT NULL,
  `Media` varchar(255) NOT NULL,
  `Description` text DEFAULT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `gallery`
--

INSERT INTO `gallery` (`IdGallery`, `TypeMedia`, `Media`, `Description`, `Created_at`) VALUES
(4, 'video', '6397c499938aa3b6cb6b280e902a30b6.mp4', 'KJ', '2025-12-16 17:49:37'),
(5, 'image', 'a6c3c0634ae11483b9bfb9e57dcd0495.jpg', 'dsjiiiiiiii', '2025-12-16 17:51:54'),
(6, 'link', 'https://youtu.be/7umPAcyVg1U?si=RYmnAAUrlCv_5g_F', 'aaaaaaaaaaaaaaaaaaaaa', '2025-12-16 18:08:46');

-- --------------------------------------------------------

--
-- Structure de la table `groups`
--

CREATE TABLE `groups` (
  `idGroup` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `groups`
--

INSERT INTO `groups` (`idGroup`, `group_name`, `permission`) VALUES
(1, 'Admin', 'a:28:{i:0;s:13:\"createAgences\";i:1;s:13:\"updateAgences\";i:2;s:11:\"viewAgences\";i:3;s:13:\"deleteAgences\";i:4;s:16:\"createAssurances\";i:5;s:14:\"viewAssurances\";i:6;s:22:\"createAssurances_types\";i:7;s:20:\"viewAssurances_types\";i:8;s:15:\"createCarousels\";i:9;s:13:\"viewCarousels\";i:10;s:13:\"createContact\";i:11;s:11:\"viewContact\";i:12;s:12:\"createEvents\";i:13;s:10:\"viewEvents\";i:14;s:9:\"createFAQ\";i:15;s:7:\"viewFAQ\";i:16;s:12:\"createGroups\";i:17;s:10:\"viewGroups\";i:18;s:12:\"viewSettings\";i:19;s:10:\"createTeam\";i:20;s:8:\"viewTeam\";i:21;s:15:\"createTeam_type\";i:22;s:13:\"viewTeam_type\";i:23;s:17:\"createTestimonies\";i:24;s:15:\"viewTestimonies\";i:25;s:11:\"createUsers\";i:26;s:9:\"viewUsers\";i:27;s:13:\"viewDashboard\";}');

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `id_inscription` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_timetable_course` int(11) NOT NULL,
  `id_attendance` int(11) NOT NULL,
  `id_mode_payement` int(11) NOT NULL,
  `id_student` int(11) NOT NULL,
  `your_country` varchar(200) NOT NULL,
  `invoice_type` enum('individual','company') NOT NULL DEFAULT 'individual',
  `status_payement` enum('pending','paid','failed') NOT NULL DEFAULT 'pending',
  `email_confirmed` tinyint(1) NOT NULL DEFAULT 0,
  `email_confirmation_token` varchar(255) DEFAULT NULL,
  `email_confirmed_at` datetime DEFAULT NULL,
  `token_expired_at` datetime DEFAULT NULL,
  `status_started_course` tinyint(1) NOT NULL DEFAULT 0,
  `status_ended_course` tinyint(1) NOT NULL DEFAULT 0,
  `date_insertion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id_inscription`, `id_course`, `id_timetable_course`, `id_attendance`, `id_mode_payement`, `id_student`, `your_country`, `invoice_type`, `status_payement`, `email_confirmed`, `email_confirmation_token`, `email_confirmed_at`, `token_expired_at`, `status_started_course`, `status_ended_course`, `date_insertion`) VALUES
(10, 6, 2, 1, 5, 5, 'RDC', 'company', 'pending', 0, NULL, NULL, NULL, 0, 0, '2025-12-10 18:36:30'),
(11, 6, 2, 2, 5, 6, 'Tanzanie', 'company', 'pending', 0, NULL, NULL, NULL, 0, 0, '2025-12-11 09:18:46'),
(12, 6, 2, 2, 1, 7, 'RDC', 'company', 'pending', 0, NULL, NULL, NULL, 0, 0, '2025-12-11 09:27:16'),
(13, 6, 1, 2, 3, 8, 'Burundi', 'company', 'pending', 0, NULL, NULL, NULL, 0, 0, '2025-12-17 09:23:23'),
(27, 4, 7, 1, 4, 11, 'Burundi', 'individual', 'pending', 1, NULL, '2025-12-19 08:54:24', NULL, 0, 0, '2025-12-19 08:53:07'),
(28, 6, 1, 2, 4, 11, 'Rwanda', 'individual', 'pending', 0, '464a33137bcbf14268f3c64d5bcd5142a2e6e779d4bb8d5505522bccfe52b6e1', NULL, '2025-12-20 09:27:41', 0, 0, '2025-12-19 09:27:41');

-- --------------------------------------------------------

--
-- Structure de la table `join_us`
--

CREATE TABLE `join_us` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `join_us`
--

INSERT INTO `join_us` (`id`, `titre`, `description`, `created_at`) VALUES
(1, 'Upcoming Training Courses/Workshops', '<div class=\"col-lg-8 ps-lg-5\">\r\n<p>AbeLab is a leading capacity development and consultancy center based in Nairobi, Kenya, dedicated to empowering professionals and organizations across Africa. We provide practical solutions that help individuals enhance their careers and enable institutions to strengthen their performance and impact.</p>\r\n\r\n<p>Our areas of expertise include Socio-economic Research, Spatial Technologies, Climate Change &amp; Environmental Sustainability, Gender Equality &amp; Social Inclusion, Data Management &amp; Statistics, Project Cycle Management, Enterprise Development, Governance, Organizational Development, and Personal Productivity.</p>\r\n\r\n<h4>Why Join?</h4>\r\n\r\n<ul>\r\n   <li>Gain practical, job-relevant skills</li>\r\n    <li>Learn from expert instructors in an interactive, hands-on setting</li>\r\n  <li>Access comprehensive training materials and real-life case studies</li>\r\n <li>Network with professionals from across Africa</li>\r\n  <li>Receive an internationally recognized Certificate of Completion</li>\r\n</ul>\r\n\r\n<h4>Key Information</h4>\r\n\r\n<ul>\r\n   <li><strong>Group Discounts:</strong> Available for organizations registering 3+ participants.</li>\r\n <li><strong>Language:</strong> English.</li>\r\n    <li><strong>Certification:</strong> Provided upon completion.</li>\r\n</ul>\r\n\r\n<h4>Registration</h4>\r\n\r\n<p><strong>Burundi:</strong> <a href=\"https://perk-gafrica.com/training-in-kigali-rwanda/\" target=\"_blank\"> Training in&nbsp;</a>bujumbura<br />\r\n<strong>Burundi:</strong> <a href=\"https://perk-gafrica.com/registration/\" target=\"_blank\"> Registration Page </a></p>\r\n\r\n<h4>For inquiries</h4>\r\n\r\n<p><strong>Phone:</strong> +254 712 028 449<br />\r\n<strong>Email:</strong> <a href=\"mailto:training@perk-gafrica.com\">training@abelab.com</a></p>\r\n</div>\r\n', '2025-12-08 16:36:28');

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE `menu` (
  `IdMenu` int(11) NOT NULL,
  `Menu` varchar(50) NOT NULL,
  `HasCreate` tinyint(1) NOT NULL,
  `HasRead` tinyint(1) NOT NULL,
  `HasUpdate` tinyint(1) NOT NULL,
  `HasDelete` tinyint(1) NOT NULL,
  `Code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mission`
--

CREATE TABLE `mission` (
  `id_mission` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mission`
--

INSERT INTO `mission` (`id_mission`, `content`, `date_creation`) VALUES
(1, 'zskjdhfiweui', '2025-12-16 14:25:55'),
(2, 'Former des professionnels compétents et innovants', '2025-12-18 10:00:00'),
(3, 'Développer les compétences pour l\'emploi de demain', '2025-12-18 10:00:00'),
(4, 'Promouvoir l\'excellence académique', '2025-12-18 10:00:00'),
(5, 'Faciliter l\'insertion professionnelle', '2025-12-18 10:00:00'),
(6, 'Contribuer au développement économique', '2025-12-18 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `mode_payement`
--

CREATE TABLE `mode_payement` (
  `id_mode_payement` int(11) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `mode_payement`
--

INSERT INTO `mode_payement` (`id_mode_payement`, `description`) VALUES
(1, 'Bancobu Inoti'),
(3, 'Lumicash'),
(4, 'EcoCash'),
(5, 'Carte Bancaire');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE `newsletter` (
  `id_newsletter` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_inscription` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `email`, `date_inscription`) VALUES
(2, 'paul@gmail.com', '2025-12-08 15:41:13'),
(4, 'dushimepaul51@gmail.com', '2025-12-08 15:44:10'),
(6, 'manager@ub.com', '2025-12-10 12:43:19');

-- --------------------------------------------------------

--
-- Structure de la table `news_media`
--

CREATE TABLE `news_media` (
  `id_news_media` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `date_insertion` datetime NOT NULL DEFAULT current_timestamp(),
  `details` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `news_media`
--

INSERT INTO `news_media` (`id_news_media`, `title`, `image`, `date_insertion`, `details`) VALUES
(2, 'Magebu Construction Site: Our Professional Team in Action', '202512162013236941af539a8a7.jpg', '2025-11-11 09:33:07', '<p style=\"margin-left:0px; margin-right:0px\">At the&nbsp;<strong>Magebu Construction Site</strong>, our team of skilled professionals is dedicated to delivering high-quality infrastructure with precision and expertise. From project planning to execution, we ensure that every stage of construction meets the highest industry standards.</p>\r\n\r\n<h4 style=\"margin-left:0px; margin-right:0px\"><strong>Key Highlights:</strong></h4>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">✅&nbsp;<strong>Expert Workforce:</strong>&nbsp;Engineers, architects, and skilled laborers collaborating efficiently.<br />\r\n✅&nbsp;<strong>Advanced Equipment:</strong>&nbsp;Utilizing modern construction technology for efficiency and safety.</p>\r\n\r\n<p style=\"margin-left:0px; margin-right:0px\">&nbsp;</p>\r\n\r\n<p><br />\r\nCREATE TABLE `news_media` (<br />\r\n&nbsp; `id_news_media` int(11) NOT NULL,<br />\r\n&nbsp; `title` varchar(200) NOT NULL,<br />\r\n&nbsp; `image` varchar(200) NOT NULL,<br />\r\n&nbsp; `date_insertion` datetime NOT NULL DEFAULT current_timestamp(),<br />\r\n&nbsp; `details` text NOT NULL<br />\r\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;</p>\r\n\r\n<p>--<br />\r\n-- D&eacute;chargement des donn&eacute;es de la table `news_media`<br />\r\n--</p>\r\n\r\n<p>INSERT INTO `news_media` (`id_news_media`, `title`, `image`, `date_insertion`, `details`) VALUES<br />\r\n(2, &#39;Magebu Construction Site: Our Professional Team in Action&#39;, &#39;202511110844016912e9411c391.jpg&#39;, &#39;2025-11-11 09:33:07&#39;, &#39;&lt;p data-start=\\&quot;268\\&quot; data-end=\\&quot;542\\&quot; style=\\&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: \\&quot;Segoe UI\\&quot;, Tahoma, Geneva, Verdana, sans-serif; color: rgb(51, 51, 51); font-size: medium;\\&quot;&gt;At the &lt;strong data-start=\\&quot;275\\&quot; data-end=\\&quot;303\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;Magebu Construction Site&lt;/strong&gt;, our team of skilled professionals is dedicated to delivering high-quality infrastructure with precision and expertise. From project planning to execution, we ensure that every stage of construction meets the highest industry standards.&lt;/p&gt;&lt;h4 data-start=\\&quot;544\\&quot; data-end=\\&quot;573\\&quot; style=\\&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: \\&quot;Segoe UI\\&quot;, Tahoma, Geneva, Verdana, sans-serif; color: rgb(51, 51, 51); font-size: medium;\\&quot;&gt;&lt;strong data-start=\\&quot;549\\&quot; data-end=\\&quot;571\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;Key Highlights:&lt;/strong&gt;&lt;/h4&gt;&lt;p data-start=\\&quot;574\\&quot; data-end=\\&quot;971\\&quot; style=\\&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: \\&quot;Segoe UI\\&quot;, Tahoma, Geneva, Verdana, sans-serif; color: rgb(51, 51, 51); font-size: medium;\\&quot;&gt;✅ &lt;strong data-start=\\&quot;576\\&quot; data-end=\\&quot;597\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;Expert Workforce:&lt;/strong&gt; Engineers, architects, and skilled laborers collaborating efficiently.&lt;br data-start=\\&quot;668\\&quot; data-end=\\&quot;671\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;✅ &lt;strong data-start=\\&quot;673\\&quot; data-end=\\&quot;696\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;Advanced Equipment:&lt;/strong&gt; Utilizing modern construction technology for efficiency and safety.&lt;/p&gt;&#39;),<br />\r\n(3, &#39;Roundtable with Magebu Project Team&#39;, &#39;202511110843446912e93090348.jpg&#39;, &#39;2025-11-11 09:43:44&#39;, &#39;&lt;p&gt;&lt;span style=\\&quot;color: rgb(51, 51, 51); font-family: &amp;quot;Segoe UI&amp;quot;, Tahoma, Geneva, Verdana, sans-serif; font-size: medium;\\&quot;&gt;As part of the development of the Magebu construction site, a roundtable discussion was held with the various partners involved. The objective of this meeting was to strengthen collaboration, assess the progress of the work, and define the next steps of the project.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&#39;);</p>\r\n\r\n<p>--<br />\r\n-- Index pour les tables d&eacute;charg&eacute;es<br />\r\n--</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(3, 'Roundtable with Magebu Project Team', '202512162013096941af453ad85.jpg', '2025-11-11 09:43:44', '<p><span style=\"color:#333333; font-family:&quot;Segoe UI&quot;,Tahoma,Geneva,Verdana,sans-serif; font-size:medium\">As part of the development of the Magebu construction site, a roundtable discussion was held with the various partners involved. The objective of this meeting was to strengthen collaboration, assess the progress of the work, and define the next steps of the project.</span></p>\r\n\r\n<p>ckeditor</p>\r\n\r\n<p><br />\r\nCREATE TABLE `news_media` (<br />\r\n&nbsp; `id_news_media` int(11) NOT NULL,<br />\r\n&nbsp; `title` varchar(200) NOT NULL,<br />\r\n&nbsp; `image` varchar(200) NOT NULL,<br />\r\n&nbsp; `date_insertion` datetime NOT NULL DEFAULT current_timestamp(),<br />\r\n&nbsp; `details` text NOT NULL<br />\r\n) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;</p>\r\n\r\n<p>--<br />\r\n-- D&eacute;chargement des donn&eacute;es de la table `news_media`<br />\r\n--</p>\r\n\r\n<p>INSERT INTO `news_media` (`id_news_media`, `title`, `image`, `date_insertion`, `details`) VALUES<br />\r\n(2, &#39;Magebu Construction Site: Our Professional Team in Action&#39;, &#39;202511110844016912e9411c391.jpg&#39;, &#39;2025-11-11 09:33:07&#39;, &#39;&lt;p data-start=\\&quot;268\\&quot; data-end=\\&quot;542\\&quot; style=\\&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: \\&quot;Segoe UI\\&quot;, Tahoma, Geneva, Verdana, sans-serif; color: rgb(51, 51, 51); font-size: medium;\\&quot;&gt;At the &lt;strong data-start=\\&quot;275\\&quot; data-end=\\&quot;303\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;Magebu Construction Site&lt;/strong&gt;, our team of skilled professionals is dedicated to delivering high-quality infrastructure with precision and expertise. From project planning to execution, we ensure that every stage of construction meets the highest industry standards.&lt;/p&gt;&lt;h4 data-start=\\&quot;544\\&quot; data-end=\\&quot;573\\&quot; style=\\&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: \\&quot;Segoe UI\\&quot;, Tahoma, Geneva, Verdana, sans-serif; color: rgb(51, 51, 51); font-size: medium;\\&quot;&gt;&lt;strong data-start=\\&quot;549\\&quot; data-end=\\&quot;571\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;Key Highlights:&lt;/strong&gt;&lt;/h4&gt;&lt;p data-start=\\&quot;574\\&quot; data-end=\\&quot;971\\&quot; style=\\&quot;margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: \\&quot;Segoe UI\\&quot;, Tahoma, Geneva, Verdana, sans-serif; color: rgb(51, 51, 51); font-size: medium;\\&quot;&gt;✅ &lt;strong data-start=\\&quot;576\\&quot; data-end=\\&quot;597\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;Expert Workforce:&lt;/strong&gt; Engineers, architects, and skilled laborers collaborating efficiently.&lt;br data-start=\\&quot;668\\&quot; data-end=\\&quot;671\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;✅ &lt;strong data-start=\\&quot;673\\&quot; data-end=\\&quot;696\\&quot; style=\\&quot;margin: 0px; padding: 0px;\\&quot;&gt;Advanced Equipment:&lt;/strong&gt; Utilizing modern construction technology for efficiency and safety.&lt;/p&gt;&#39;),<br />\r\n(3, &#39;Roundtable with Magebu Project Team&#39;, &#39;202511110843446912e93090348.jpg&#39;, &#39;2025-11-11 09:43:44&#39;, &#39;&lt;p&gt;&lt;span style=\\&quot;color: rgb(51, 51, 51); font-family: &amp;quot;Segoe UI&amp;quot;, Tahoma, Geneva, Verdana, sans-serif; font-size: medium;\\&quot;&gt;As part of the development of the Magebu construction site, a roundtable discussion was held with the various partners involved. The objective of this meeting was to strengthen collaboration, assess the progress of the work, and define the next steps of the project.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&#39;);</p>\r\n\r\n<p>--<br />\r\n-- Index pour les tables d&eacute;charg&eacute;es<br />\r\n--</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(4, 'Nouvelle Formation Data Science', 'data-science-news.jpg', '2025-12-18 10:00:00', 'Lancement de notre nouvelle formation en Data Science'),
(5, 'Partenariat avec Microsoft', 'microsoft-partnership.jpg', '2025-12-18 10:00:00', 'Nouveau partenariat stratégique avec Microsoft'),
(6, 'Réussite des Étudiants', 'success-students.jpg', '2025-12-18 10:00:00', '95% de nos étudiants trouvent un emploi dans les 6 mois'),
(7, 'Ouverture Nouveau Campus', 'new-campus.jpg', '2025-12-18 10:00:00', 'Ouverture de notre nouveau campus à Lyon'),
(8, 'Innovation Pédagogique', 'innovation.jpg', '2025-12-18 10:00:00', 'Adoption de nouvelles méthodes pédagogiques innovantes');

-- --------------------------------------------------------

--
-- Structure de la table `partener`
--

CREATE TABLE `partener` (
  `id_partner` int(11) NOT NULL,
  `description` text NOT NULL,
  `logo` text DEFAULT NULL,
  `link` varchar(200) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `partener`
--

INSERT INTO `partener` (`id_partner`, `description`, `logo`, `link`, `status`) VALUES
(2, 'hgy', '202512081106126936a3143455a.jpg', 'https://upload.wikimedia.org/wikipedia/commons/0/08/Cisco_logo_blue_2016.svg\" alt=\"Logo partenaire certification', 1),
(3, 'Partenaire Académique', 'partner1.png', 'https://universite.fr', 1),
(4, 'Partenaire Entreprise', 'partner2.png', 'https://entreprise.com', 1),
(5, 'Partenaire Technologique', 'partner3.png', 'https://techcompany.com', 1),
(6, 'Partenaire Institutionnel', 'partner4.png', 'https://institution.fr', 1),
(7, 'Partenaire International', 'partner5.png', 'https://international.org', 1);

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `IdSetting` int(11) NOT NULL,
  `KeyValue` varchar(250) NOT NULL,
  `TitlePage` varchar(200) DEFAULT NULL,
  `Value` text DEFAULT NULL,
  `IsFile` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`IdSetting`, `KeyValue`, `TitlePage`, `Value`, `IsFile`) VALUES
(2, 'site_name', 'Nom du site', 'AbelaB Formation', 0),
(3, 'site_logo', 'Logo du site', '202512102012516939c633775d7.png', 1),
(4, 'site_favicon', 'Favicon du site', '202512101906456939b6b5d5d23.jpg', 1),
(5, 'site_email', 'Email contact', 'contact@abelab.com', 0),
(6, 'site_phone', 'Téléphone contact', '+257 68 86 39 45', 0),
(7, 'site_address', 'Adresse du siège', 'Bujumbura, Burundi', 0),
(8, 'site_country', 'Pays du site', 'Burundi', 0),
(9, 'maintenance_mode', 'Mode maintenance', '0', 0),
(10, 'timezone', 'Fuseau horaire', 'Africa/Bujumbura', 0),
(11, 'currency', 'Devise', 'BIF', 0),
(12, 'language', 'Langue par défaut', 'fr', 0),
(13, 'payment_paypal', 'PayPal activé', '1', 0),
(14, 'payment_stripe', 'Stripe activé', '1', 0),
(15, 'payment_bank_transfer', 'Virement bancaire activé', '1', 0),
(16, 'default_invoice_type', 'Type de facturation par défaut', 'Entreprise', 0),
(17, 'default_attendance_mode', 'Mode de présence par défaut', 'En ligne', 0),
(18, 'error_course_not_found', 'Erreur Cours', 'Le cours que vous essayez d\'accéder n\'existe pas.', 0),
(19, 'error_already_registered', 'Erreur Inscription', 'Vous êtes déjà inscrit dans ce cours.', 0),
(20, 'error_payment_failed', 'Erreur Paiement', 'Le paiement n\'a pas pu être effectué. Veuillez réessayer.', 0),
(21, 'error_form_incomplete', 'Erreur Formulaire', 'Tous les champs obligatoires doivent être remplis.', 0),
(22, 'error_server', 'Erreur Serveur', 'Une erreur interne est survenue, contactez l\'administrateur.', 0),
(24, 'site_description', 'description dans le footer', 'créativité est au cœur de l\'innovation. AbeLab est votre laboratoire de formation dédié aux technologies.', 0);

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id_student` int(11) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id_student`, `fullname`, `email`, `phone`, `address`) VALUES
(5, 'Dushime kagabo', 'gg@gmail.com', '68863945', 'buja'),
(6, 'CIZA ', 'ciz@gmail.com', '68863945', 'buja'),
(7, 'CIZA ', 'ggoo@gmail.com', '68863945', 'buja'),
(8, 'Charif kagabo', 'charif@gmail.com', '68863945', 'RUZIBA'),
(11, 'DUSHIME PAUL', 'dushimepaul51@gmail.com', '68863945', 'RUZIBA'),
(12, 'Odo Herve', 'odoelve1@gmail.com', '68993490', 'kajaga'),
(13, 'Jean Dupont', 'jean@email.com', '0612345678', '10 Rue de Paris, 75001 Paris'),
(14, 'Marie Martin', 'marie@email.com', '0623456789', '20 Avenue Lyon, 69000 Lyon'),
(15, 'Pierre Durand', 'pierre@email.com', '0634567890', '30 Boulevard Marseille, 13000 Marseille'),
(16, 'Sophie Bernard', 'sophie@email.com', '0645678901', '40 Rue Toulouse, 31000 Toulouse'),
(17, 'Luc Petit', 'luc@email.com', '0656789012', '50 Avenue Bordeaux, 33000 Bordeaux');

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

CREATE TABLE `teachers` (
  `id_teacher` int(11) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `specialite` varchar(200) NOT NULL,
  `experience` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_insertion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `teachers`
--

INSERT INTO `teachers` (`id_teacher`, `nom`, `prenom`, `email`, `phone`, `specialite`, `experience`, `status`, `date_insertion`) VALUES
(1, 'Martin', 'Paul', 'paul.martin@cerfop.fr', '0612345678', 'Développement Web', 10, 0, '2025-12-18 10:00:00'),
(2, 'Dubois', 'Julie', 'julie.dubois@cerfop.fr', '0623456789', 'Marketing Digital', 8, 0, '2025-12-18 10:00:00'),
(3, 'Leroy', 'Thomas', 'thomas.leroy@cerfop.fr', '0634567890', 'Design UX/UI', 7, 0, '2025-12-18 10:00:00'),
(4, 'Moreau', 'Sarah', 'sarah.moreau@cerfop.fr', '0645678901', 'Gestion de Projet', 12, 1, '2025-12-18 10:00:00'),
(5, 'Simon', 'David', 'david.simon@cerfop.fr', '0656789012', 'Data Science', 9, 1, '2025-12-18 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `testimonies`
--

CREATE TABLE `testimonies` (
  `IdTestimony` int(11) NOT NULL,
  `Testifier` varchar(250) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rating` tinyint(4) DEFAULT NULL,
  `Image` varchar(250) DEFAULT NULL,
  `Poste` varchar(250) DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `Details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `testimonies`
--

INSERT INTO `testimonies` (`IdTestimony`, `Testifier`, `email`, `rating`, `Image`, `Poste`, `status`, `Details`, `created_at`) VALUES
(1, 'Dushime Paul', 'paul@email.com', 5, '202512081540046936e34406eed.jpg', 'Étudiant', 'pending', 'Très bon service, je recommande.', '2025-12-18 09:51:03'),
(2, 'ciza bien', 'dushimeyesupaulin@gmail.com', 2, '202512181151556943dccbb43ba.png', 'teacher', 'pending', 'z\\lk', '2025-12-18 10:51:56'),
(3, 'paul dushime', 'paul@gmail.com', 0, '202512181328146943f35e27aa4.jpg', 'nnnk', 'pending', 'kjk', '2025-12-18 12:28:14'),
(4, 'yahoo', 'massabo@gmail.com', 4, '202512181329046943f390e90bc.jpg', 'jgg', 'pending', 'kjkjh', '2025-12-18 12:29:04'),
(5, 'ciza bien', 'dushimeyesupaulin@gmail.com', 3, '2025121817063069442686f2779.png', 'teacher', 'pending', 'lldklskdla', '2025-12-18 16:06:30'),
(6, 'Jean Dupont', 'jean@email.com', 5, 'jean.jpg', 'Développeur Web', 'approved', 'Formation excellente, je recommande !', '2025-12-18 08:00:00'),
(7, 'Marie Martin', 'marie@email.com', 4, 'marie.jpg', 'Marketing Manager', 'approved', 'Contenu très pratique et utile', '2025-12-18 08:00:00'),
(8, 'Pierre Durand', 'pierre@email.com', 5, 'pierre.jpg', 'Designer UX', 'approved', 'Les formateurs sont experts dans leur domaine', '2025-12-18 08:00:00'),
(9, 'Sophie Bernard', 'sophie@email.com', 4, 'sophie.jpg', 'Chef de Projet', 'pending', 'Bonne formation pour débutants', '2025-12-18 08:00:00'),
(10, 'Luc Petit', 'luc@email.com', 5, 'luc.jpg', 'Data Analyst', 'approved', 'J\'ai trouvé un emploi rapidement après la formation', '2025-12-18 08:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `timetable`
--

CREATE TABLE `timetable` (
  `id_timetable` int(11) NOT NULL,
  `date_debut` datetime NOT NULL,
  `date_defin` datetime NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_teacher` int(11) NOT NULL,
  `date_insertion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `timetable`
--

INSERT INTO `timetable` (`id_timetable`, `date_debut`, `date_defin`, `time`, `id_teacher`, `date_insertion`) VALUES
(1, '2025-12-09 00:00:00', '2025-12-13 00:00:00', '2025-12-09 21:05:28', 1, '2025-12-09 22:05:28'),
(2, '2025-12-16 00:00:00', '2025-12-20 00:00:00', '2025-12-09 21:05:51', 1, '2025-12-09 22:05:51'),
(3, '2025-01-15 09:00:00', '2025-03-15 17:00:00', '2025-12-18 08:00:00', 1, '2025-12-18 10:00:00'),
(4, '2025-02-01 09:00:00', '2025-04-01 17:00:00', '2025-12-18 08:00:00', 2, '2025-12-18 10:00:00'),
(5, '2025-03-01 09:00:00', '2025-05-01 17:00:00', '2025-12-18 08:00:00', 3, '2025-12-18 10:00:00'),
(6, '2025-04-01 09:00:00', '2025-06-01 17:00:00', '2025-12-18 08:00:00', 4, '2025-12-18 10:00:00'),
(7, '2025-05-01 09:00:00', '2025-07-01 17:00:00', '2025-12-18 08:00:00', 5, '2025-12-18 10:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `timetable_courses`
--

CREATE TABLE `timetable_courses` (
  `id_timetable_course` int(11) NOT NULL,
  `id_course` int(11) NOT NULL,
  `id_timetable` int(11) NOT NULL,
  `date_insertion` datetime NOT NULL,
  `localisation` varchar(200) NOT NULL,
  `price` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `timetable_courses`
--

INSERT INTO `timetable_courses` (`id_timetable_course`, `id_course`, `id_timetable`, `date_insertion`, `localisation`, `price`) VALUES
(1, 6, 2, '2025-12-09 22:06:25', 'Bujumbura', '1300'),
(2, 6, 2, '2025-12-09 22:09:21', 'Musenyi', '50'),
(3, 4, 2, '2025-12-18 18:09:30', 'Bujumbura', '400'),
(4, 1, 1, '2025-12-18 10:00:00', 'Paris Campus', '2500€'),
(5, 2, 2, '2025-12-18 10:00:00', 'En ligne', '1800€'),
(6, 3, 3, '2025-12-18 10:00:00', 'Lyon Campus', '2200€'),
(7, 4, 4, '2025-12-18 10:00:00', 'Toulouse Campus', '2000€'),
(8, 5, 5, '2025-12-18 10:00:00', 'En ligne', '1500€');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `telephone` varchar(100) NOT NULL,
  `idGroup` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `dateinsertion` datetime NOT NULL DEFAULT current_timestamp(),
  `status_user` int(11) NOT NULL DEFAULT 1 COMMENT '1:actif;2:suspendus:3:sortis'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `firstName`, `lastName`, `username`, `email`, `telephone`, `idGroup`, `image`, `dateinsertion`, `status_user`) VALUES
(1, 'admina', 'admina', 'admina', 'admina@gmail.com', '3678e465789', 1, 'image1.jpg', '2024-06-07 16:51:06', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idGroup` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(500) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user_group`
--

INSERT INTO `user_group` (`id`, `idUser`, `idGroup`, `username`, `password`, `isActive`) VALUES
(1, 1, 1, 'admina', '$2y$10$c1EA9yRrjV8UQpyVYfpQHe5qyd9yuVxkhpHDSbX7TvYMpinjyAM0a', 1);

-- --------------------------------------------------------

--
-- Structure de la table `vision`
--

CREATE TABLE `vision` (
  `id_vision` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `vision`
--

INSERT INTO `vision` (`id_vision`, `content`, `date_creation`) VALUES
(1, 'xkjvnighaiuth43ty394', '2025-12-16 14:26:20');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id_about_us`);

--
-- Index pour la table `attendace_course_mode`
--
ALTER TABLE `attendace_course_mode`
  ADD PRIMARY KEY (`id_attendance`);

--
-- Index pour la table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`IdCarousel`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`IdContact`);

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`);

--
-- Index pour la table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`IdGallery`);

--
-- Index pour la table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`idGroup`);

--
-- Index pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`id_inscription`),
  ADD KEY `fk_inscription_course` (`id_course`),
  ADD KEY `fk_inscription_timetable` (`id_timetable_course`),
  ADD KEY `fk_inscription_attendance` (`id_attendance`),
  ADD KEY `fk_inscription_payment_mode` (`id_mode_payement`),
  ADD KEY `fk_inscription_student` (`id_student`);

--
-- Index pour la table `join_us`
--
ALTER TABLE `join_us`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`IdMenu`);

--
-- Index pour la table `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id_mission`);

--
-- Index pour la table `mode_payement`
--
ALTER TABLE `mode_payement`
  ADD PRIMARY KEY (`id_mode_payement`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id_newsletter`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `news_media`
--
ALTER TABLE `news_media`
  ADD PRIMARY KEY (`id_news_media`);

--
-- Index pour la table `partener`
--
ALTER TABLE `partener`
  ADD PRIMARY KEY (`id_partner`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`IdSetting`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`);

--
-- Index pour la table `testimonies`
--
ALTER TABLE `testimonies`
  ADD PRIMARY KEY (`IdTestimony`);

--
-- Index pour la table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id_timetable`);

--
-- Index pour la table `timetable_courses`
--
ALTER TABLE `timetable_courses`
  ADD PRIMARY KEY (`id_timetable_course`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vision`
--
ALTER TABLE `vision`
  ADD PRIMARY KEY (`id_vision`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id_about_us` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `attendace_course_mode`
--
ALTER TABLE `attendace_course_mode`
  MODIFY `id_attendance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `IdCarousel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `IdContact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `IdGallery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `groups`
--
ALTER TABLE `groups`
  MODIFY `idGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `id_inscription` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `join_us`
--
ALTER TABLE `join_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
  MODIFY `IdMenu` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `mission`
--
ALTER TABLE `mission`
  MODIFY `id_mission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `mode_payement`
--
ALTER TABLE `mode_payement`
  MODIFY `id_mode_payement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id_newsletter` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `news_media`
--
ALTER TABLE `news_media`
  MODIFY `id_news_media` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `partener`
--
ALTER TABLE `partener`
  MODIFY `id_partner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `IdSetting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `testimonies`
--
ALTER TABLE `testimonies`
  MODIFY `IdTestimony` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id_timetable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `timetable_courses`
--
ALTER TABLE `timetable_courses`
  MODIFY `id_timetable_course` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `vision`
--
ALTER TABLE `vision`
  MODIFY `id_vision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `fk_inscription_attendance` FOREIGN KEY (`id_attendance`) REFERENCES `attendace_course_mode` (`id_attendance`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscription_course` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscription_payment_mode` FOREIGN KEY (`id_mode_payement`) REFERENCES `mode_payement` (`id_mode_payement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscription_student` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscription_timetable` FOREIGN KEY (`id_timetable_course`) REFERENCES `timetable_courses` (`id_timetable_course`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

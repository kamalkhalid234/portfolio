-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 21 avr. 2025 à 03:14
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
-- Base de données : `portfolieur_kamal`
--

-- --------------------------------------------------------

--
-- Structure de la table `about`
--

CREATE TABLE `about` (
  `idaboute` int(11) NOT NULL,
  `nom` varchar(250) NOT NULL,
  `prenom` varchar(250) NOT NULL,
  `dateNaissance` date NOT NULL,
  `Age` int(11) NOT NULL,
  `telephone` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `degree` varchar(250) NOT NULL,
  `Freelance` varchar(250) NOT NULL,
  `Website` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `titre` text NOT NULL,
  `texteAboute` text NOT NULL,
  `texetContact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `about`
--

INSERT INTO `about` (`idaboute`, `nom`, `prenom`, `dateNaissance`, `Age`, `telephone`, `email`, `degree`, `Freelance`, `Website`, `image`, `city`, `titre`, `texteAboute`, `texetContact`) VALUES
(1, 'kamal', 'khalid', '2004-09-06', 19, '0689062738', '1-kamalkhalid234l@gmail.com', '1-devloppe', 'nom', 'https://www.tutorialrepublic.com/', 'kamal.jpeg', '1-maroc : youssoufia espaniol : valenic', 'devloppeur bon niveu 1', '1-iahlCIVYLX XKVGN8CGKEWICVHZ', '1-If anyone has any recommendations or is aware of any internship opportunities in those fields, I would greatly appreciate it if you could kindly let me know. Thank you in advance for your time and consideration.');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `idContact` int(11) NOT NULL,
  `nameContact` varchar(250) NOT NULL,
  `emailContact` varchar(250) NOT NULL,
  `subjectContact` text NOT NULL,
  `messageContact` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`idContact`, `nameContact`, `emailContact`, `subjectContact`, `messageContact`) VALUES
(1, 'kamal', 'khalid', 'probleme de develoepe', 'probleme de developrobleme de developrobleme de developrobleme de developrobleme de developrobleme de develo'),
(5, 'KHALID KAMAL', 'kamalkhalid234l@gmail.com', 'probeleme', 'Si tu veux, je peux aussi t’ajouter un champ de recherche pour filtrer les messages, ou une pagination. Tu veux');

-- --------------------------------------------------------

--
-- Structure de la table `education`
--

CREATE TABLE `education` (
  `idEducation` int(11) NOT NULL,
  `nomEducation` varchar(250) NOT NULL,
  `datedebu` date NOT NULL,
  `datetermine` date NOT NULL,
  `titreEducation` text NOT NULL,
  `texteEducation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `education`
--

INSERT INTO `education` (`idEducation`, `nomEducation`, `datedebu`, `datetermine`, `titreEducation`, `texteEducation`) VALUES
(7, 'developpeur', '2025-04-01', '2025-04-12', 'estudir espaniol', '2-Participated in the development of an inter-company communication system to create an application that allows users to reserve meals in the canteen (available on PlayStore under the name \"Azaf\").'),
(10, 'devele', '2025-04-01', '2025-04-16', 'jaka', '2-Participated in the development of an inter-company communication system to create an application that allows users to reserve meals in the canteen (available on PlayStore under the name \"Azaf\").'),
(11, 'designe', '2020-09-09', '2022-08-08', 'jakaj', '2-Participated in the development of an inter-company communication system to create an application that allows users to reserve meals in the canteen (available on PlayStore under the name \"Azaf\").');

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

CREATE TABLE `experience` (
  `idExperience` int(11) NOT NULL,
  `nomExperience` varchar(250) NOT NULL,
  `dateDepart` date NOT NULL,
  `dateTermine` date NOT NULL,
  `titreExperience` text NOT NULL,
  `texteExperience` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`idExperience`, `nomExperience`, `dateDepart`, `dateTermine`, `titreExperience`, `texteExperience`) VALUES
(1, 'Mobile developer', '2020-04-01', '2022-04-23', 'ICOZ S.A.R.L in Casablanca, Morocco-2', '2-Participated in the development of an inter-company communication system to create an application that allows users to reserve meals in the canteen (available on PlayStore under the name \"Azaf\").'),
(3, 'programation', '2025-04-01', '2025-04-25', 'casablanca\r\n', 'http://localhost/FORMATION_HALID/test_3/'),
(4, 'multimidia', '2025-04-01', '2025-04-30', 'tanga', '2-Participated in the development of an inter-company communication system to create an application that allows users to reserve meals in the canteen (available on PlayStore under the name \"Azaf\").');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `idLogin` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`idLogin`, `username`, `password`) VALUES
(1, 'aa', 'aa');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `idProjects` int(11) NOT NULL,
  `nomProjects` varchar(200) NOT NULL,
  `imageProjects` varchar(200) NOT NULL,
  `lienProjects` varchar(400) NOT NULL,
  `typeProjects` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`idProjects`, `nomProjects`, `imageProjects`, `lienProjects`, `typeProjects`) VALUES
(2, 'jemlaaa', 'portfolio-1.jpg', 'https://play.google.com/store/apps/details?id=com.top.jemla', 'web'),
(11, 'profile', '7.png', 'https://play.google.com/store/apps/details?id=com.top.jemla', 'app'),
(12, 'site', 'portfolio-2.jpg', 'https://codehim.com/', 'web'),
(13, 'qot', 'portfolio-3.jpg', 'https://codehim.com/', 'app'),
(14, 'profile', 'portfolio-5.jpg', 'https://codehim.com/', 'app'),
(15, 'profile', 'portfolio-6.jpg', 'https://play.google.com/store/apps/details?id=com.top.jemla', 'web'),
(16, 'textee', 'portfolio-9.jpg', 'https://codehim.com/', 'app');

-- --------------------------------------------------------

--
-- Structure de la table `reseau_sociau`
--

CREATE TABLE `reseau_sociau` (
  `idReseau` int(11) NOT NULL,
  `githubReseau` varchar(300) NOT NULL,
  `linkdinReseau` varchar(300) NOT NULL,
  `twiterReseau` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reseau_sociau`
--

INSERT INTO `reseau_sociau` (`idReseau`, `githubReseau`, `linkdinReseau`, `twiterReseau`) VALUES
(2, 'https://chatgpt.com/c/680575fa-7864-8008-abf7-fe7a8c3da28a', 'https://chatgpt.com/c/680575fa-7864-8008-abf7-fe7a8c3da28a', 'https://chatgpt.com/c/680575fa-7864-8008-abf7-fe7a8c3da28a');

-- --------------------------------------------------------

--
-- Structure de la table `skills`
--

CREATE TABLE `skills` (
  `idSkills` int(11) NOT NULL,
  `texteSkills` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `skills`
--

INSERT INTO `skills` (`idSkills`, `texteSkills`) VALUES
(1, 'Le footer utilise une couleur sombre avec un texte blanc. Si vous n\'avez pas encore inclus Font Awesome pour les icônes, vous pouvez le faire en ajoutant ce lien dans votre');

-- --------------------------------------------------------

--
-- Structure de la table `skills_degre`
--

CREATE TABLE `skills_degre` (
  `idSkillsDegre` int(11) NOT NULL,
  `nomSkillsDegre` varchar(250) NOT NULL,
  `degreSkillsDegre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `skills_degre`
--

INSERT INTO `skills_degre` (`idSkillsDegre`, `nomSkillsDegre`, `degreSkillsDegre`) VALUES
(9, 'HTML', 60),
(10, 'PHP', 60),
(11, 'CSS', 50),
(12, 'C', 40),
(13, 'SQL', 70),
(14, 'javascript', 55);

-- --------------------------------------------------------

--
-- Structure de la table `testimonials`
--

CREATE TABLE `testimonials` (
  `idTestimonials` int(11) NOT NULL,
  `nomTestimonials` varchar(250) NOT NULL,
  `titreTestimonials` varchar(250) NOT NULL,
  `texteTestimonials` text NOT NULL,
  `imageTestimonials` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `testimonials`
--

INSERT INTO `testimonials` (`idTestimonials`, `nomTestimonials`, `titreTestimonials`, `texteTestimonials`, `imageTestimonials`) VALUES
(8, 'kama', 'mecanique', 'Chaque matin est une nouvelle chance de recommencer. Le soleil se lève doucement, illuminant le ciel de couleurs chaudes et apaisantes. ', 'kamal.jpeg'),
(13, 'kamal', 'mecanique', 'aa', 'testimonials-2.jpg'),
(14, 'oussam', 'mecanique', 'aa', 'testimonials-3.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`idaboute`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idContact`);

--
-- Index pour la table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`idEducation`);

--
-- Index pour la table `experience`
--
ALTER TABLE `experience`
  ADD PRIMARY KEY (`idExperience`);

--
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`idLogin`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`idProjects`);

--
-- Index pour la table `reseau_sociau`
--
ALTER TABLE `reseau_sociau`
  ADD PRIMARY KEY (`idReseau`);

--
-- Index pour la table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`idSkills`);

--
-- Index pour la table `skills_degre`
--
ALTER TABLE `skills_degre`
  ADD PRIMARY KEY (`idSkillsDegre`);

--
-- Index pour la table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`idTestimonials`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `about`
--
ALTER TABLE `about`
  MODIFY `idaboute` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idContact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `education`
--
ALTER TABLE `education`
  MODIFY `idEducation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `experience`
--
ALTER TABLE `experience`
  MODIFY `idExperience` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `idProjects` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `reseau_sociau`
--
ALTER TABLE `reseau_sociau`
  MODIFY `idReseau` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `skills`
--
ALTER TABLE `skills`
  MODIFY `idSkills` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `skills_degre`
--
ALTER TABLE `skills_degre`
  MODIFY `idSkillsDegre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `idTestimonials` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

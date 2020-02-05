-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 14 Avril 2016 à 01:40
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tp1_loicndjoyi`
--

-- --------------------------------------------------------

--
-- Structure de la table `acces`
--

CREATE TABLE IF NOT EXISTS `acces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `acces`
--

INSERT INTO `acces` (`id`, `nom`) VALUES
(1, 'admin'),
(2, 'membre');

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Image` varchar(255) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `films`
--

INSERT INTO `films` (`Id`, `Nom`, `Description`, `Image`) VALUES
(3, 'Dragon Ball Z : Fukkatsu no F', 'Deux soldats, Sorbet et Tagoma, de l''armée de Freezer, l''ancien tyran ayant été vaincu par Son Goku sur Namek, sont partis à la recherche des sept Dragon Ball afin de le ressusciter. Une fois ressuscité, Freezer a alors pour objectif de se venger de Son Goku. Il est informé par Sorbet que Goku a gagné en puissance et a réussi à vaincre Boo. Freezer décide de s''entraîner et dit qu''en seulement quatre mois, il pourra le surpasser…', 'dbz_fnf.jpg'),
(4, 'Sword of the Stranger', 'Le récit se déroule dans le Japon de l''époque Sengoku, en pleine période de guerres civiles. Un temple se fait attaquer. un jeune orphelin, Kotarō, s''échappe, et le moine Shoan lui conseille de se rendre au temple de Mangaku, dans le pays de Shirato, retrouver l''abbé Zekkai. Il lui donne une pierre précieuse pour l''aider.', 'sword_of_the_stranger.jpg'),
(5, 'Apocalypse du pari - Kaiji ', 'Japon, 1995. Après avoir fini l''enseignement secondaire, Itō Kaiji déménage à Tōkyō pour trouver un emploi stable mais n''y parvient pas à cause de son caractère atypique et de la première récession que connait le Japon depuis la fin de la Seconde Guerre mondiale. Déprimé, il végète dans son appartement, avec un quotidien fait de petits délits, de tabac et d''alcool. Kaiji ne cesse de penser à sa situation financière, ce qui le pousse aux larmes à de nombreuses reprises.\r\nKaiji vit dans cet état d''esprit pendant deux ans, jusqu''au jour où un inconnu nommé Endō vient lui réclamer une dette astronomique endossée par Kaiji. Celui-ci laisse le choix à Kaiji : soit il travaille dix ans afin de rembourser la dette, soit il embarque à bord du casino flottant Espoir (en français dans le texte) dans l''espoir de toucher un pactole en l''espace d''une seule nuit…', 'kaiji.jpg'),
(6, 'Le gendarme et les gendarmettes', 'Dans ses locaux flambant neufs, la brigade de Saint-Tropez, ayant fait l''acquisition d''un ordinateur si puissant qu''il répond à toutes les questions, est chargée d''accueillir, de prendre soin et de former un contingent de quatre jeunes femmes en uniforme. Un spécialiste de l''espionnage informatique enlève, l''une après l''autre, les nouvelles recrues. L''existence de la brigade étant mise en danger par ces enlèvements dont la raison semble inexplicable, nos gendarmes déploieront au péril de leur vie, des trésors d''ingéniosité pour retrouver ces femmes dont ils avaient la garde.', 'le-gendarme-et-les-gendarmettes-affiche.jpg'),
(7, 'Minority Report', 'En 2054, la ville de Washington a réussi à éradiquer la criminalité. Grâce aux visions du futur fournies par trois individus exceptionnels doués de précognition (appelés précogs), les agents de Précrime peuvent arrêter les criminels juste avant qu’ils n''aient commis leurs méfaits. Mais un jour, le chef de l''unité John Anderton reçoit des précogs une vision le concernant : dans moins de 36 heures, il aura assassiné un homme qu’il ne connaît pas encore et pour une raison qu’il ignore. Choqué, il prend alors la fuite, poursuivi par ses propres coéquipiers qui ont pour mission de l’arrêter conformément au système...', 'minority_report.jpg'),
(8, 'Inception', 'Le « rêve partagé » est une nouvelle technologie, développée à l''origine par les États-Unis pour permettre à ses soldats de s''entraîner « en rêve ». Détournée de cet usage, elle permet à des extracteurs hors-la-loi de prélever des informations dans le subconscient de certaines personnes, pour le compte d''autres personnes qui les payent. C''est le métier de Dominic Cobb, qui se heurte à la résistance de Saito alors qu''il tente d''extraire des informations de son subconscient. Au lieu de lui en tenir rancune, Saito lui propose de l''innocenter d''un crime qu''il n''a pas commis et qui l''a éloigné de sa famille en échange de l''« inception », qui est, à l''inverse de l''extraction, le fait d''implanter une idée dans un subconscient dans le but qu''elle se développe et finisse par caractériser l''implanté. Cobb forme alors une nouvelle équipe pour tenter l''inception sur Fisher, héritier d''une multinationale que Saito veut voir dissoute.', 'inception.jpg'),
(9, 'Usual Suspects', 'Sur le pont d''un cargo dans la baie de San Pedro, en Californie, un homme blessé du nom de Keaton discute avec une silhouette portant gants, chapeau, briquet en or et grand pardessus, qu''il nomme Keyser. Après une brève conversation, Keyser pointe une arme en direction de Keaton et tire, avant de mettre le feu au navire. Le lendemain, l''agent fédéral Jack Baer (Giancarlo Esposito) et l''agent spécial des douanes Dave Kujan (Chazz Palminteri) arrivent à San Pedro pour enquêter sur le massacre qui a eu lieu à bord du cargo. Il n''y a que deux survivants : un petit escroc infirme appelé Verbal Kint (Kevin Spacey), et un Hongrois gravement brûlé et de fait hospitalisé.\r\nBaer interroge le Hongrois, qui affirme que Keyser Söze, un génie du crime turc à la réputation presque mythique, était dans le port et y a tué « beaucoup de gens ». Le blessé décrit Keyser Söze à l''aide d''un traducteur et d''un dessinateur de la police, qui en dresse un portrait-robot. Pendant ce temps, Kint (surnommé « Verbal ») témoigne longuement sur les faits en échange d''une promesse d''immunité. Après avoir fait sa déposition auprès du juge d''instruction et en attendant de répondre d''une accusation mineure de détention d''armes, Verbal est placé dans le bureau du sergent Rabin (Dan Hedaya), où l''agent spécial Kujan lui demande de raconter à nouveau son histoire. Celle-ci commence six semaines plus tôt.', 'the_usual_suspect.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(40) NOT NULL,
  `Contenu` text NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`Id`, `Nom`, `Contenu`) VALUES
(1, 'Accueil', '<h1>Bienvenue sur notre site</h1>'),
(2, 'Gestion utilisateurs', '<h1>Gestion des utilisateurs</h1>'),
(3, 'Ajout utilisateur', '<h1>Ajouter un nouvel utilisateur</h1>'),
(4, 'Ajout film', '<h1>Ajouter un nouveau film</h1>'),
(5, 'Connexion', '<h2 class="form-signin-heading">Zone membre</h2>');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(40) NOT NULL,
  `Mot_de_Passe` varchar(255) NOT NULL,
  `dateNaissance` date DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `NoTelephone` char(14) DEFAULT NULL,
  `Courriel` varchar(100) DEFAULT NULL,
  `id_acces` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `id_acces` (`id_acces`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`Id`, `Nom`, `Mot_de_Passe`, `dateNaissance`, `Adresse`, `NoTelephone`, `Courriel`, `id_acces`) VALUES
(1, 'loic', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1991-02-02', '3413 Avenue Maricourt #6', '418-266-3333', 'kk47@cegepgarneau.ca', 1),
(2, 'Jean-Claude', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1997-01-01', '1660 Boul. Entente', '418-688-8310', 'jcTshi@cegepgarneau.ca', 2),
(3, 'garneau', '5cec175b165e3d5e62c9e13ce848ef6feac81bff', '2016-01-01', '1860 Boul. Entente', '418-266-8310', 'garneau_user@cegepgarneau.ca', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

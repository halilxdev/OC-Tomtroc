-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `OC_tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `cover_image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('available','unavailable') NOT NULL DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `cover_image`, `description`, `status`, `created_at`, `created_by`) VALUES
(2, 'Personne ne doit savoir', 'Claire McGowan', 'https://m.media-amazon.com/images/I/91xTfsaXoqL._SL1500_.jpg', 'Alison organise une réunion d\'anciens camarades d\'Oxford pour fêter une amitié longue d\'un quart de siècle. Entre-temps, elle s\'est mariée avec Mike, avocat d\'affaires, dont elle a eu deux enfants. Elle vit dans la maison de ses rêves dans le Kent. Elle a réussi sa vie, et elle a bien l\'intention d\'en faire la démonstration lors de ces retrouvailles.\r\n\r\nMais la fête vire au drame lorsque Karen, la meilleure amie d\'Alison, fait irruption dans la maison, en état de choc. Elle affirme que le mari d\'Alison l\'a violée. Mike jure qu\'il est innocent. À qui se fier ? Ce douloureux épisode fait resurgir les plus sombres souvenirs de leurs années de fac. Et certains sont prêts à tuer pour que ces souvenirs restent des secrets bien gardés.', 'available', '2025-07-03 21:23:22', 2),
(3, 'I Have No Mouth & I Must Scream', 'Harlan Ellison', 'https://m.media-amazon.com/images/I/A1TFWwAc-8L._SL1500_.jpg', 'In a post-apocalyptic world, four men and one woman are all that remain of the human race, brought to near extinction by an artificial intelligence. Programmed to wage war on behalf of its creators, the AI became self-aware and turned against humanity. The five survivors are prisoners, kept alive and subjected to brutal torture by the hateful and sadistic machine in an endless cycle of violence.\r\n \r\nThis story and six more groundbreaking and inventive tales that probe the depths of mortal experience prove why Grand Master of Science Fiction Harlan Ellison has earned the many accolades to his credit and remains one of the most original voices in American literature.', 'available', '2025-07-03 21:33:53', 3),
(4, 'L\'île des égarés', 'JF Leger', 'https://m.media-amazon.com/images/I/71hK1MoxwxL._SL1500_.jpg', 'Entrez dans l\'œil du cyclone... là où les secrets sont aussi profonds que l’océan.\r\n\r\nSur une île isolée où chaque tempête semble réveiller les démons cachés, une série de cambriolages bouleverse le quotidien d’une communauté déjà fragile. Mais ces intrusions ne sont que le début… Et si, derrière les portes verrouillées, les vraies réponses n’étaient pas celles que vous attendez ?\r\n\r\nL’Île des Égarés est un voyage captivant entre mystères, tensions psychologiques, et révélations troublantes.\r\n\r\nOserez-vous percer les mystères de l’île ?\r\n\r\nLorsque Jonathan, jeune commandant de police, débarque sur cette île balayée par les tempêtes, il croit avoir décroché une promotion. Mais il découvre rapidement que cette communauté renfermée cache bien plus qu’un simple quotidien tranquille.', 'available', '2025-07-03 21:34:29', 2),
(6, 'Solo Leveling', 'DUBU', 'https://m.media-amazon.com/images/I/81J5Lw5JZ1L._SL1500_.jpg', 'Lorsque d\'étranges portails sont apparus aux quatre coins du monde, l\'humanité a dû trouver une parade pour ne pas finir massacrée par les griffes des monstres des monstres qui en sortent. Dans le même temps, certaines personnes ont développé des capacités permettant de les chasser. Ces combattants intrépides n\'hésitent pas à foncer au coeur des donjons pour combattre les créatures qu\'ils abritent.', 'unavailable', '2025-07-06 09:55:21', 4),
(7, 'Toutes ses fautes', 'Andrea Mara', 'https://m.media-amazon.com/images/I/71IVwqHzc-L._SL1500_.jpg', 'Quand elle se présente au 14 Tudor Grove, à Dublin, Marissa Irvine ignore tout du gouffre qui va s’ouvrir sous ses pieds. Alors qu’elle s’apprête à récupérer son fils Milo, venu jouer pour la première fois chez un copain d’école, la femme qui lui ouvre la porte n’est pas la mère qu’elle connaît. Ce n’est pas non plus la nounou. Et Milo n’est pas chez elle. La nouvelle de la disparition du petit garçon se répand peu à peu au sein de cette paisible banlieue et des rumeurs commencent à circuler. Car dans cette communauté pleine de secrets, les gens sont prêts à tout pour sauver les apparences…\r\n\r\nNée en Irlande, Andrea Mara a rencontré un succès critique et public immédiat. Lauréat du prix NetGalley du meilleur thriller 2024, finaliste du prix du roman policier irlandais de l’année et du prix du festival de Gujan-Mestras, Toutes ses fautes a déjà conquis plus de 700 000 lecteurs en Grande-Bretagne.', 'unavailable', '2025-07-06 09:56:25', 5),
(8, 'L\'art de Clair Obscur: Expedition 33', 'XXX', 'https://m.media-amazon.com/images/I/81Cxgs9+GuL._SL1500_.jpg', 'Livre', 'available', '2025-07-07 11:35:36', 3),
(9, 'Mon vrai nom est Elisabeth', 'Adèle Yon', 'https://m.media-amazon.com/images/I/61RnP4BLsiL._SL1171_.jpg', 'Une chercheuse craignant de devenir folle mène une enquête pour tenter de rompre le silence qui entoure la maladie de son arrière-grand-mère Elisabeth, dite Betsy, diagnostiquée schizophrène dans les années 1950. La narratrice ne dispose, sur cette femme morte avant sa naissance, que de quelques légendes familiales dont les récits fluctuent. Une vieille dame coquette qui aimait nager, bonnet de bain en caoutchouc et saut façon grenouille, dans la piscine de la propriété de vacances. Une grand-mère avec une cavité de chaque côté du front qui accusait son petit-fils de la regarder nue à travers les murs. Une maison qui prend feu. Des grossesses non désirées. C\'est à peu près tout. Les enfants d\'Elisabeth ne parlent jamais de leur mère entre eux et ils n\'en parlent pas à leurs enfants qui n\'en parlent pas à leurs petits-enfants. \"C\'était un nom qu\'on ne prononçait pas. Maman, c\'était un non-sujet. Tu peux enregistrer ça. Maman, c\'était un non-sujet.\'', 'unavailable', '2025-07-09 05:59:02', 4),
(10, 'Les heures fragiles', 'Virginie Grimaldi ', 'https://m.media-amazon.com/images/I/711d0GRU3LL._SL1500_.jpg', 'Diane a toujours eu des rêves simples. Un mari, deux enfants, un métier qui lui plaît, c\'est plus que ce qu\'elle osait espérer. Le jour où Seb la quitte, son monde vacille. Absorbée par sa peine, elle ne voit pas que le drame se joue ailleurs. Tout près d\'elle, dans cette chambre qui fait face à la sienne, les rires de sa fille s\'épuisent. Lou a seize ans, le mal de grandir, et son premier chagrin d\'amour lui arrache plus que des larmes. Quand Diane comprend, elle est prête à tout pour l\'aider. Y compris à retourner vers un passé qu\'elle avait fui. Ensemble, mère et fille marchent sur un fil. Sous leurs pas, le torrent de la vie gronde et emporte avec lui les heures fragiles.', 'available', '2025-07-09 06:00:30', 3),
(12, 'À retardement', 'Franck Thilliez', 'https://m.media-amazon.com/images/I/71955nC8AlL._SL1190_.jpg', 'Quand on bascule dans la folie, il est souvent trop tard !\r\nUnité pour malades difficiles de Chambly. Un nouveau patient est accueilli. Délirant, sans papiers, inapte à la garde à vue, celui-ci a poussé sans raison un passager sur les rails et prétend \" fuir des vers \".\r\nSeine-Saint-Denis, à cinquante kilomètres de là. Sharko et son équipe découvrent le corps d\'un quinquagénaire sauvagement assassiné près de son lit. Chez lui, aucune empreinte digitale ni trace d\'ADN, pas même les siennes.\r\nQui sont ces deux hommes ? Quelles sont leurs histoires ?', 'available', '2025-07-09 06:01:41', 4),
(13, 'Construis ton patrimoine même en partant de zéro !', 'Jérémy DOYEN', 'https://m.media-amazon.com/images/I/71xCUQatygL._SL1500_.jpg', 'Les emprunts courts, c’est toujours mieux > Faux\r\nLe pacs assure un héritage pour mon partenaire en cas de décès > Faux\r\nIl faut vite acheter sa résidence principale > Faux\r\nPour assurer l’avenir de mon enfant, le mieux est d’ouvrir un livret A > Faux\r\nÀ chaque étape de la vie, nous devons faire des choix financiers, souvent sans y voir clair.\r\nRésultat : épargne qui dort, erreurs coûteuses, projets retardés...\r\n', 'available', '2025-07-09 06:02:28', 2),
(14, 'Le Grimoire des Rituels de Protection', 'Jeanne Moncet', 'https://m.media-amazon.com/images/I/71wCfKYLugL._SL1500_.jpg', 'Découvrez les secrets de la magie et des rituels de protection !\r\nEt si vous aviez le pouvoir de repousser les forces invisibles qui troublent votre paix, de protéger vos proches des énergies négatives et de transformer votre vie grâce à des rituels de sorcellerie ancestraux ?\r\n\r\n« Le Grimoire des Rituels de Protection » est votre réponse ! Ce grimoire, conçu pour les sorcières modernes, est un guide essentiel pour tous ceux qui souhaitent maîtriser l\'art de la protection spirituelle.\r\n\r\nCe que vous allez découvrir dans ce grimoire de sorcière\r\nDans ce guide complet, vous apprendrez comment utiliser la magie blanche et les rituels de protection pour créer une barrière énergétique puissante autour de vous et de vos proches. Chaque page est une porte ouverte sur des siècles de sagesse ésotérique, soigneusement compilée pour vous offrir des outils concrets et efficaces contre les forces négatives.', 'unavailable', '2025-07-09 06:03:06', 5),
(15, 'Gouvernance perverse', 'Marion Saint Michel', 'https://m.media-amazon.com/images/I/61SJU1lda3L._SL1500_.jpg', 'Ce livre s’adresse aux personnes qui, n’étant ni psychologues ni politologues, s’interrogent sur les intentions de nos dirigeants. Il se propose d’analyser la crise du Covid et la gouvernance qui s’est ensuivie, sous l’angle de la perversion. Son objectif est de donner au lecteur les éléments pour comprendre comment il est manipulé, à travers les « narratifs », l’ingénierie sociale et l’instrumentalisation des émotions. Parce que comprendre, c’est commencer à se libérer.', 'unavailable', '2025-07-09 06:03:51', 4),
(16, 'NOUS LES MENTEURS', 'E. Lockhart', 'https://m.media-amazon.com/images/I/61-YwarmV2L._SL1070_.jpg', 'Bienvenue dans la famille Sinclair. Tous sont beaux, riches, sportifs, intelligents. Aucun n\'a droit à l\'échec. Ils passent leurs étés sur une île privée au large du cap Cod. Cadence est l\'aînée des petits-enfants. Voici son histoire et celle des \"Menteurs\", quatre adolescents à l\'amitié indéfectible.', 'available', '2025-07-09 06:05:53', 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `content` varchar(200) NOT NULL,
  `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('seen','unseen') NOT NULL DEFAULT 'unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `from_user`, `to_user`, `content`, `sent_at`, `status`) VALUES
(1, 3, 1, 'Hello 👋', '2025-07-17 11:24:20', 'unseen'),
(2, 1, 3, 'Hey !', '2025-07-17 11:27:31', 'unseen');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'https://www.shutterstock.com/image-vector/default-avatar-profile-icon-social-600nw-1906669723.jpg',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `created_at`, `email`, `profile_picture`, `password`) VALUES
(1, 'halil', '2025-07-02 18:33:20', 'halilxvb@outlook.fr', 'https://pbs.twimg.com/profile_images/1924115918751141888/xNcKBLQq_400x400.jpg', '$2y$10$NiE/ZNYiM8drDVWKBfYRzO5.KIqMov/8lZsantLwEQg/4vDNeO8NO'),
(2, 'monkey d. ryry', '2025-07-03 18:33:20', 'jean-luc@hotmail.com', 'https://pbs.twimg.com/profile_images/1917282428596391936/OUHxN2F8_400x400.jpg', '$2y$10$RHVTaZPLUVDja5USJyJYfOiemF4GrH2MxO6RcwNEu8Vxkodefk4Cq'),
(3, 'gabby', '2025-07-04 18:33:20', 'gabrieldu03@laposte.net', 'https://pbs.twimg.com/profile_images/1937275966365069312/AKjq8kv9_400x400.jpg', '$2y$10$RHVTaZPLUVDja5USJyJYfOiemF4GrH2MxO6RcwNEu8Vxkodefk4Cq'),
(4, 'eldiablo', '2025-07-09 05:50:49', 'eldiablo@gmail.com', 'https://pbs.twimg.com/profile_images/1927098796904792064/pwilvBQx_400x400.jpg', '$2y$10$RHVTaZPLUVDja5USJyJYfOiemF4GrH2MxO6RcwNEu8Vxkodefk4Cq'),
(5, 'paramount', '2025-07-09 05:50:49', 'param@skyrock.fr', 'https://www.shutterstock.com/image-vector/default-avatar-profile-icon-social-600nw-1906669723.jpg', '$2y$10$RHVTaZPLUVDja5USJyJYfOiemF4GrH2MxO6RcwNEu8Vxkodefk4Cq'),
(6, 'hjello', '2025-07-14 18:10:32', 'zuihefzeufhfz@gmail.com', 'https://www.shutterstock.com/image-vector/default-avatar-profile-icon-social-600nw-1906669723.jpg', '$2y$10$q49QSbrj9GsYqEbDtQrTO.v0fJEVyteRQZNqvFQcqTQ/ndYLV2UAi');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_createdby` (`created_by`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_from` (`from_user`),
  ADD KEY `messages_to` (`to_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_createdby` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_from` FOREIGN KEY (`from_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `messages_to` FOREIGN KEY (`to_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

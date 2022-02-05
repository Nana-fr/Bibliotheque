-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 05 fév. 2022 à 17:16
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `library_php`
--
CREATE DATABASE IF NOT EXISTS `library_php` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `library_php`;

-- --------------------------------------------------------

--
-- Structure de la table `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `writerId` int(10) UNSIGNED DEFAULT NULL,
  `plot` text NOT NULL,
  `languageId` int(10) UNSIGNED DEFAULT NULL,
  `publication_date` varchar(20) NOT NULL,
  `categoryId` int(10) UNSIGNED DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `availability` varchar(6) NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `book`
--

INSERT INTO `book` (`id`, `title`, `writerId`, `plot`, `languageId`, `publication_date`, `categoryId`, `stock`, `quantity`, `availability`, `cover`) VALUES
(1, 'Les misérables', 1, 'Le destin de Jean Valjean, forçat échappé du bagne, est bouleversé par sa rencontre avec Fantine. \r\nMourante et sans le sou, celle-ci lui demande de prendre soin de Cosette, sa fille confiée aux Thénardier. \r\nCe couple d’aubergistes, malhonnête et sans scrupules, exploitent la fillette jusqu’à ce que Jean Valjean \r\ntienne sa promesse et l’adopte. Cosette devient alors sa raison de vivre. Mais son passé le rattrape et \r\nl’inspecteur Javert le traque…', 2, '1862', 1, 1, 2, 'middle', 'les_miserables.jpg'),
(2, 'Romeo and Juliet', 2, 'An age-old vendetta between two powerful families erupts into bloodshed.', 1, '1597', 2, 1, 1, 'full', 'romeo_juliet.jpg'),
(3, 'Pride and Prejudice', 3, 'When Charles Bingley, a rich single man, moves to the Netherfield estate, \r\n        the neighborhood residents are thrilled, especially Mrs. Bennet, who hopes to marry one of her five daughters \r\n        to him. When the Bennet daughters meet him at a local ball, they are impressed by his outgoing \r\n        personality and friendly disposition. They are less impressed, however, by Bingley\'s friend \r\n        Fitzwilliam Darcy, a landowning aristocrat who is too proud to speak to any of the locals and whom \r\n        Elizabeth Bennet overhears refusing to dance with her.', 1, '1813-01-28', 1, 1, 1, 'full', 'pride_prejudice.jpg'),
(4, 'Frankenstein', 10, 'An English explorer, Robert Walton, is on an expedition to the North Pole. \r\n        In letters to his sister Margaret Saville, he keeps his family informed of his situation and tells \r\n        about the difficult conditions on the ship. One day, when the ship is completely surrounded by ice, \r\n        a man in bad condition is taken aboard: Victor Frankenstein. As soon as his health allows it, he tells \r\n        Walton the story of his life.', 1, '1818-01-01', 1, 0, 1, 'out', 'frankenstein.jpg'),
(5, 'Le comte de Monte-Cristo', 5, '1815. Louis XVIII rétabli sur le trône se heurte à une opposition\r\n         dont l\'Empereur, relégué à l\'île d\'Elbe, songe déjà à profiter. Dans Marseille livrée à la \r\n         discorde civile, le moment est propice aux règlements de comptes politiques ou privés. \r\n         C\'est ainsi que le marin Edmond Dantès, à la veille de son mariage, se retrouve, sans savoir \r\n         pourquoi, arrêté et conduit au château d\'If... ', 2, '1844-46', 1, 1, 1, 'full', 'le_comte_de_mc.jpg'),
(6, 'Wuthering Heights', 6, 'In 1801, Mr Lockwood, the new tenant at Thrushcross Grange in Yorkshire, \r\n        pays a visit to his landlord, Heathcliff, at his remote moorland farmhouse, Wuthering Heights. \r\n        There he meets a reserved young woman (later identified as Cathy Linton); Joseph, a cantankerous servant; \r\n        and Hareton, an uneducated young man who speaks like a servant. Everyone is sullen and inhospitable. \r\n        Snowed in for the night, Lockwood reads the diary of the former inhabitant of his room, Catherine Earnshaw, \r\n        and has a nightmare in which a ghostly Catherine begs to enter through the window. Woken by Lockwood\'s fearful \r\n        yells, Heathcliff is troubled. Lockwood later returns to Thrushcross Grange in heavy snow, falls ill from \r\n        the cold and becomes bedridden. While he recovers, Lockwood\'s housekeeper Ellen \'Nelly\' Dean tells him the \r\n        story of the strange family. ', 1, '1847-12', 1, 1, 1, 'full', 'wuthering_heights.jpg'),
(7, '红楼梦', 4, '《红楼梦》故事主线为贾宝玉、林黛玉及薛宝钗三人的爱情与婚姻悲剧，以及贾宝玉亲戚贾府、史家、薛家、\r\n        王家等四大家族的兴衰。', 3, '1791', 1, 1, 1, 'full', 'hongloumeng.jpg'),
(8, 'Les fleurs du mal', 9, 'Avec Les Fleurs du Mal commence la poésie moderne : le lyrisme subjectif \r\n        s\'efface devant cette « impersonnalité volontaire » que Baudelaire a lui-même postulée ; la nature et \r\n        ses retours cycliques cèdent la place au décor urbain et à ses changements marqués par l\'Histoire, et \r\n        il arrive que le poète accède au beau par l\'expérience de la laideur. Quant au mal affiché dès le titre \r\n        du recueil, s\'il nous apporte la preuve que l\'art ici se dénoue de la morale, il n\'en préserve pas moins \r\n        la profonde spiritualité des poèmes. D\'où la stupeur que Baudelaire put ressentir quand le Tribunal de la \r\n        Seine condamna la première édition de 1857 pour « outrage à la morale publique et aux bonnes moeurs » et \r\n        l\'obligea à retrancher six pièces du volume - donc à remettre en cause la structure du recueil qu\'il avait \r\n        si précisément concertée. En 1861, la seconde édition fut augmentée de trente-cinq pièces, puis Baudelaire \r\n        continua d\'écrire pour son livre d\'autres poèmes encore. Mais après la censure, c\'est la mort qui vint \r\n        l\'empêcher de donner aux Fleurs du Mal la forme définitive qu\'il souhaitait - et que nous ne connaîtrons \r\n        jamais.', 2, '1857-08-23', 3, 0, 1, 'out', 'les_fleurs_du_mal.jpg'),
(9, '三国演义', 11, '故事背景由公元184年東漢末年黃巾之亂開始，至公元280年西晉統一，共96年歷史，以儒家政治道德观念為\r\n        核心主旨，同时揉合千百年来广大民众心理，表现对昏君贼臣大乱天下的痛恨，对明君良臣清平世界的渴慕。', 3, '14th century', 1, 1, 1, 'full', 'sanguoyanyi.jpg'),
(10, '西游记', 7, '全书主要描写了孙悟空出世及大闹天宫后，遇见了唐僧、猪八戒、沙僧和白龙马，西行取经，一路上历经艰险、\r\n        妖怪魔法高强，经历了九九八十一难，终于到达西天见到如来佛祖，最终五圣成真的故事。该小说以“唐僧取经”这一历史事件为蓝本，\r\n        通过作者的艺术加工，深刻地描绘了明代社会现实。', 3, '1592', 1, 2, 3, 'middle', 'xiyouji.jpg'),
(11, '水浒传', 8, '故事描寫了一百零八將各自不同的故事，從他們一個個被逼上梁山、逐漸壯大、起義造反到最後接受招安的\r\n        全過程。', 3, '14th century', 1, 2, 2, 'full', 'shui_hu_zhuan.jpg'),
(12, 'Ruy Blas', 1, 'L\'action se déroule dans l\'Espagne de la fin du XVIIe siècle, sur plusieurs mois. \r\n        Le héros de ce drame romantique, Ruy Blas, déploie son intelligence et son éloquence, autant pour dénoncer \r\n        et humilier une oligarchie accapareuse des biens de l\'État que pour se montrer digne d\'aimer la reine \r\n        d\'Espagne. Mais cette voix du peuple, éprise de justice, éclairée par l\'amour, est prisonnière d\'une livrée \r\n        de valet et d\'un maître attaché à perdre la réputation de la Reine en lui donnant « son laquais pour amant ».', 2, '1838-11-08', 2, 1, 1, 'full', 'ruy_blas.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `borrowing`
--

CREATE TABLE `borrowing` (
  `id` int(11) NOT NULL,
  `book_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `borrowing_date` date NOT NULL,
  `returning_date` date DEFAULT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `borrowing`
--

INSERT INTO `borrowing` (`id`, `book_id`, `user_id`, `borrowing_date`, `returning_date`, `due_date`) VALUES
(2, 4, 1, '2022-01-03', '2022-02-03', '2022-01-17'),
(8, 4, 1, '2022-02-03', '2022-02-03', '2022-02-17'),
(9, 1, 1, '2022-02-03', '2022-02-03', '2022-02-17'),
(10, 1, 1, '2022-02-03', '2022-02-03', '2022-02-17'),
(11, 4, 1, '2022-02-03', '2022-02-03', '2022-02-17'),
(12, 8, 1, '2022-02-03', NULL, '2022-02-17'),
(17, 4, 1, '2022-02-03', NULL, '2022-02-17'),
(18, 1, 2, '2022-02-03', '2022-02-03', '2022-02-17'),
(19, 1, 1, '2022-02-03', '2022-02-03', '2022-02-17'),
(20, 1, 1, '2022-02-03', NULL, '2022-02-17'),
(21, 10, 1, '2022-02-03', NULL, '2022-02-17');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Roman'),
(2, 'Pièce de théâtre'),
(3, 'Poésie');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220131152049', '2022-01-31 16:21:03', 61),
('DoctrineMigrations\\Version20220131153245', '2022-01-31 16:33:06', 102),
('DoctrineMigrations\\Version20220202142347', '2022-02-02 15:24:05', 62),
('DoctrineMigrations\\Version20220202144608', '2022-02-02 15:46:15', 43),
('DoctrineMigrations\\Version20220202145930', '2022-02-02 15:59:46', 117),
('DoctrineMigrations\\Version20220202160859', '2022-02-02 17:09:10', 69),
('DoctrineMigrations\\Version20220203104051', '2022-02-03 13:31:32', 258);

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE `language` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `language`
--

INSERT INTO `language` (`id`, `name`) VALUES
(1, 'English'),
(2, 'Français'),
(3, '中文');

-- --------------------------------------------------------

--
-- Structure de la table `nationality`
--

CREATE TABLE `nationality` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `nationality`
--

INSERT INTO `nationality` (`id`, `name`) VALUES
(1, 'Anglais'),
(2, 'Français'),
(3, 'Chinois');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `street` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` int(11) NOT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `firstname`, `lastname`, `email`, `card_number`, `street`, `city`, `postal_code`, `phone_number`, `registration_date`) VALUES
(1, '123456', '[\"ROLE_USER\"]', '123', 'John', 'Doe', NULL, 123456, '23 Avenue jean Jaurès', 'Sotteville lès Rouen', 76300, '0605040302', '2022-02-02'),
(2, '762761', '[\"ROLE_USER\"]', '$2y$13$xqbRYrsVnYp4uxka7Qb4wexqFHpj5srF3NaDDZz5AOSH1GSjxP0oC', 'Jane', 'Doe', 'jane.doe@gmail.com', 762761, '76 Rue du Renard', 'Rouen', 76000, '0102030405', '2022-02-03'),
(3, 'admin', '[\"ROLE_ADMIN\"]', '$2y$13$VUVILFqqUN.6mrFGxckxLOf0u1qMZYTafAt.cGGsziRClCBkga1t2', 'Amine', 'Hadmine', NULL, NULL, '108 Rue saint Lô', 'Rouen', 76000, '0606060606', NULL),
(5, '319449', '[\"ROLE_USER\"]', '$2y$10$5Dloax2TwpgZQDEN3VB/f.Wiz1o0RvZmi1OO3n7Lebv.uYItc/jQW', 'Usman', 'Youzeur', 'iamuser@user.com', 319449, '13 rue Lehman', 'Mont Saint Aignan', 76451, '0607080900', '2022-02-05');

-- --------------------------------------------------------

--
-- Structure de la table `writer`
--

CREATE TABLE `writer` (
  `id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `nationalityId` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `writer`
--

INSERT INTO `writer` (`id`, `firstname`, `lastname`, `nationalityId`) VALUES
(1, 'Victor', 'HUGO', 2),
(2, 'William', 'SHAKESPEARE', 1),
(3, 'Jane', 'AUSTEN', 1),
(4, 'Xueqin', 'CAO', 3),
(5, 'Alexandre', 'DUMAS', 2),
(6, 'Emily', 'BRONTË', 1),
(7, 'Cheng\'en', 'WU', 3),
(8, 'Nai\'an', 'SHI', 3),
(9, 'Charles', 'BAUDELAIRE', 2),
(10, 'Mary', 'SHELLEY', 1),
(11, 'Guanzhong', 'LUO', 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_writerId` (`writerId`),
  ADD KEY `FK_languageId` (`languageId`),
  ADD KEY `FK_categoryId` (`categoryId`);

--
-- Index pour la table `borrowing`
--
ALTER TABLE `borrowing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_226E589716A2B381` (`book_id`),
  ADD KEY `IDX_226E5897A76ED395` (`user_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `nationality`
--
ALTER TABLE `nationality`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- Index pour la table `writer`
--
ALTER TABLE `writer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_nationalityId` (`nationalityId`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `borrowing`
--
ALTER TABLE `borrowing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `nationality`
--
ALTER TABLE `nationality`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `writer`
--
ALTER TABLE `writer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `FK_categoryId` FOREIGN KEY (`categoryId`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_languageId` FOREIGN KEY (`languageId`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `FK_writerId` FOREIGN KEY (`writerId`) REFERENCES `writer` (`id`);

--
-- Contraintes pour la table `borrowing`
--
ALTER TABLE `borrowing`
  ADD CONSTRAINT `FK_226E589716A2B381` FOREIGN KEY (`book_id`) REFERENCES `book` (`id`),
  ADD CONSTRAINT `FK_226E5897A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `writer`
--
ALTER TABLE `writer`
  ADD CONSTRAINT `FK_nationalityId` FOREIGN KEY (`nationalityId`) REFERENCES `nationality` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

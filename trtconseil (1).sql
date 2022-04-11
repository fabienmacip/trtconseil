-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 11 avr. 2022 à 15:28
-- Version du serveur : 10.4.20-MariaDB
-- Version de PHP : 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `trtconseil`
--

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

CREATE TABLE `annonce` (
  `id` int(11) NOT NULL,
  `intitule` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poste` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `validation` tinyint(1) NOT NULL,
  `recruteur_id` int(11) NOT NULL,
  `consultant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `annonce`
--

INSERT INTO `annonce` (`id`, `intitule`, `poste`, `ville`, `description`, `date`, `validation`, `recruteur_id`, `consultant_id`) VALUES
(41, 'aaaaaaaaaaa', 'aaaaaaaa', 'ALLEMAGNA', 'aaaaaaaaaaaaaaaa', '1993-12-30 21:37:29', 1, 69, 161),
(42, 'Necessitatibus nobis praesentium accusamus et cumque quod.', 'Liftier', 'Lecomte-sur-Mer', 'Sed velit voluptatum et ullam. Eum omnis est neque quibusdam repellat. Et dolor excepturi labore harum ea aliquid. Quis expedita in sunt eius praesentium consequatur eius. Iure magni sed fuga dolores fugiat qui. Aut iusto possimus aspernatur dolore dicta ', '1983-07-07 10:38:00', 1, 54, 164),
(43, 'Soluta at explicabo dolores dignissimos dolor non deserunt dicta.', 'Technicien agricole', 'Perrot', 'Totam et aspernatur et nesciunt non doloribus sed. Excepturi sint et molestiae voluptatibus sequi. Ea et eum quo voluptatem distinctio. Libero fugiat hic velit impedit enim rem ipsa. Distinctio aperiam velit omnis sed rem. Voluptatem sed est labore et qui', '1987-08-14 19:53:01', 1, 55, 167),
(44, 'Nemo voluptatem est doloremque ea possimus doloribus.', 'Relieur-doreur', 'Moreau', 'Est vero dolores iste rerum doloribus. Nobis et laboriosam voluptas autem. Et repellendus earum neque enim quis repellendus et pariatur. Quos aspernatur sit error nam. Est animi est officia. Ea accusantium ipsam officia ut ipsum alias velit. Blanditiis ne', '1970-09-02 10:27:29', 1, 56, 170),
(45, 'Autem eum voluptatem rerum labore rerum.', 'Opérateur du son', 'Andre', 'Maiores beatae quia voluptate cumque voluptatum. Aut voluptatem perferendis et laborum incidunt. Nostrum quia a eligendi. Doloremque eos debitis quod dolores et. Exercitationem cupiditate harum est dolorum rem. Est nesciunt aut animi debitis laudantium si', '1986-01-30 05:18:10', 1, 57, 173),
(46, 'Eum et maiores aperiam animi.', 'Parfumeur', 'Hoareau', 'Iusto rem consectetur sed est quae qui alias. Porro ut rerum possimus deleniti deleniti qui. Fuga necessitatibus ratione eos qui. Eaque fugiat necessitatibus vel assumenda officia. Ab magni omnis odio. Ipsa eveniet enim doloremque. Et nam quibusdam ipsam ', '1993-01-05 02:33:12', 1, 58, 176),
(47, 'Chef de projet', 'Chef projet web', 'St-Thibéry', 'Projets du groupe ARCADE.', '1986-04-13 12:27:36', 1, 59, 179),
(49, 'TEST 34', 'Eleveur de volailles', 'Brunetdan', 'La marée.\r\nLe fleuve.\r\nLes étangs.', '2019-04-25 18:44:55', 1, 61, 185),
(50, 'Magni ut molestiae reiciendis quasi velit voluptatem.', 'Médiateur judiciaire', 'Charpentier', 'Non qui tempore dignissimos molestiae nobis. Aliquid et dolorem aliquid ea eius sunt omnis. Tempore dolor vero accusantium commodi soluta ab qui facere. Maiores atque laudantium odio quam. Commodi quae qui impedit veniam voluptatem deleniti autem. Sequi a', '2009-05-05 16:11:33', 1, 62, 188),
(51, 'Repellendus nihil culpa et corporis perspiciatis minus voluptas.', 'Coffreur-ferrailleur', 'LefortVille', 'Et fugiat qui odio iste. Voluptatum sint nihil magnam inventore officia. Soluta quis aut voluptas cumque at omnis vel. Maiores nihil est natus reiciendis et maiores. Dolore quo voluptas minus. Laborum alias culpa saepe est quo magnam harum. Aspernatur cor', '2011-04-14 20:43:16', 0, 63, 191),
(52, 'Laudantium harum deleniti tenetur quidem labore.', 'Armurier spectacle', 'Dos Santos', 'Rerum ullam fuga error qui quia et. Illo et quos et corporis fugiat culpa. Beatae eum aut voluptas voluptas quia fuga. Et similique praesentium distinctio sed. Vero molestiae enim perferendis nam. Vitae placeat expedita nihil ut repellendus delectus quis.', '2020-10-29 15:51:00', 0, 64, 194),
(53, 'Modi vero natus illo in est debitis nobis.', 'Toréro', 'Carondan', 'Deserunt voluptates velit id ut voluptatem quasi nisi quidem. Sapiente inventore rem non et. Quas qui accusantium ducimus aut eos eius. Velit consequatur impedit quidem officiis consequuntur. Adipisci quasi eos rerum neque vel. Quia neque autem facere et.', '1978-12-18 16:43:27', 0, 65, 197),
(54, 'Voluptatum doloribus ex natus quo ullam pariatur.', 'Traducteur d\'édition', 'Peltier', 'Vel aut aut sit sit tempora repellat rerum. Dolores dignissimos repellendus molestiae qui laboriosam. A quia veniam nesciunt. Dolore magnam aut consectetur et iste id vel placeat. Libero fugiat vitae quia. Eius aut dolore reiciendis eveniet et molestias i', '2003-01-30 14:03:04', 0, 66, 200),
(55, 'Aut ducimus quo et ad voluptatem aperiam.', 'Technicien bovin', 'Marie-sur-Coulon', 'Quis provident veritatis animi repellat in pariatur autem. Eligendi repellat numquam nam omnis nemo ipsum iure. Quaerat in error quo assumenda. Doloribus in distinctio voluptatibus itaque. Quam nesciunt culpa optio sit praesentium et. Et rerum vero a simi', '2009-02-24 16:27:27', 1, 67, 203),
(56, 'BLa', 'bli', 'NISSAN', 'aa mlkjmlkj Cabinet dentaire...', '2022-04-07 18:53:21', 0, 71, NULL),
(57, 'COMPTABLE', 'Compta', 'POILHES', 'la compta c\'est cool', '2022-04-07 19:47:57', 1, 71, NULL),
(58, 'TECHNICIEN Automobile', 'Norauto', 'Colombiers', 'réparations en tous genres', '2022-04-07 20:40:15', 0, 71, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `candidat`
--

CREATE TABLE `candidat` (
  `id` int(11) NOT NULL,
  `cv` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `consultant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `candidat`
--

INSERT INTO `candidat` (`id`, `cv`, `user_id`, `consultant_id`) VALUES
(46, NULL, 162, NULL),
(47, '-624b37c1d5f1f.pdf', 165, NULL),
(48, '-624b3804794b1.pdf', 168, NULL),
(49, NULL, 171, NULL),
(50, '-624b37b59f2ca.pdf', 174, NULL),
(51, NULL, 177, NULL),
(52, NULL, 180, NULL),
(53, NULL, 183, NULL),
(54, NULL, 186, NULL),
(55, NULL, 189, NULL),
(56, NULL, 192, NULL),
(57, NULL, 195, NULL),
(58, NULL, 198, NULL),
(59, NULL, 201, NULL),
(60, NULL, 204, NULL),
(61, '-62514f1192e71.pdf', 207, NULL),
(62, NULL, 211, NULL),
(63, NULL, 212, NULL),
(64, NULL, 213, NULL),
(65, NULL, 215, NULL),
(66, NULL, 216, NULL),
(67, NULL, 217, NULL),
(70, NULL, 226, NULL),
(71, '-624f4749ae873.pdf', 231, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `candidature`
--

CREATE TABLE `candidature` (
  `id` int(11) NOT NULL,
  `annonce_id` int(11) NOT NULL,
  `candidat_id` int(11) NOT NULL,
  `consultant_approval_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `candidature`
--

INSERT INTO `candidature` (`id`, `annonce_id`, `candidat_id`, `consultant_approval_id`) VALUES
(59, 41, 46, NULL),
(60, 42, 47, NULL),
(61, 43, 48, NULL),
(62, 44, 49, NULL),
(63, 45, 50, NULL),
(64, 46, 51, NULL),
(65, 47, 52, NULL),
(67, 49, 54, NULL),
(68, 50, 55, NULL),
(69, 51, 56, NULL),
(70, 52, 57, NULL),
(71, 53, 58, NULL),
(72, 54, 59, NULL),
(73, 55, 60, NULL),
(74, 43, 61, NULL),
(75, 47, 61, NULL),
(76, 47, 61, NULL),
(77, 41, 61, NULL),
(78, 47, 61, NULL),
(79, 54, 61, NULL),
(85, 54, 61, NULL),
(86, 54, 61, NULL),
(87, 54, 61, NULL),
(88, 49, 61, NULL),
(89, 53, 61, NULL),
(91, 54, 61, NULL),
(92, 54, 61, NULL),
(93, 54, 61, NULL),
(102, 50, 61, NULL),
(103, 50, 61, NULL),
(104, 50, 61, NULL),
(105, 50, 61, NULL),
(106, 50, 61, NULL),
(107, 41, 61, NULL),
(108, 41, 61, NULL),
(109, 41, 61, NULL),
(110, 41, 61, NULL),
(111, 49, 61, NULL),
(112, 49, 61, NULL),
(113, 55, 61, NULL),
(114, 55, 61, NULL),
(115, 55, 61, NULL),
(116, 50, 61, NULL),
(117, 50, 61, NULL),
(118, 52, 61, NULL),
(119, 52, 61, NULL),
(120, 52, 61, NULL),
(121, 52, 61, NULL),
(122, 54, 61, NULL),
(123, 54, 61, NULL),
(124, 51, 61, NULL),
(125, 45, 61, NULL),
(126, 45, 61, NULL),
(127, 45, 61, NULL),
(128, 45, 61, NULL),
(129, 50, 61, NULL),
(130, 53, 61, NULL),
(132, 52, 61, NULL),
(133, 43, 61, NULL),
(134, 50, 61, NULL),
(135, 50, 61, NULL),
(136, 49, 61, NULL),
(137, 51, 61, NULL),
(138, 50, 61, NULL),
(139, 49, 61, NULL),
(140, 49, 61, NULL),
(141, 51, 61, NULL),
(142, 44, 61, NULL),
(143, 52, 61, NULL),
(144, 53, 61, NULL),
(145, 49, 61, NULL),
(146, 50, 61, NULL),
(147, 49, 61, NULL),
(148, 52, 61, NULL),
(149, 49, 61, NULL),
(150, 45, 61, NULL),
(151, 55, 61, NULL),
(152, 43, 61, NULL),
(153, 54, 61, NULL),
(154, 52, 61, NULL),
(155, 47, 61, NULL),
(156, 50, 61, NULL),
(157, 47, 61, NULL),
(158, 50, 71, NULL),
(159, 47, 71, NULL),
(160, 51, 71, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recruteur`
--

CREATE TABLE `recruteur` (
  `id` int(11) NOT NULL,
  `entreprise_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_code_postal` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `consultant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recruteur`
--

INSERT INTO `recruteur` (`id`, `entreprise_nom`, `entreprise_adresse`, `entreprise_code_postal`, `entreprise_ville`, `user_id`, `consultant_id`) VALUES
(53, 'Martin', '2, boulevard Richard Alexandre67563 Raymond', '66097', 'Ribeiroboeufe', 163, NULL),
(54, 'Nguyen', '603, rue Charles Nguyen\n45 087 Poulain', '91434', 'Lefevre-la-Forêt', 166, NULL),
(55, 'Pichon SA', '71, rue Élise Marty\n83 570 Carlier', '27 13', 'Barbe-sur-Mer', 169, NULL),
(56, 'Fouquet Menard SAS', '68, place de Berger\n17 499 Moulinboeuf', '28 56', 'Masse', 172, NULL),
(57, 'Lopez', '869, avenue Lebon\n41761 Barthelemy', '50414', 'Guyotboeuf', 175, NULL),
(58, 'Pierre SA', '38, impasse de Dumont\n91959 Techer', '18 95', 'PonsBourg', 178, NULL),
(59, 'Delorme', '59, avenue Daniel Maillard\n27648 Thomas-sur-Nicolas', '98 08', 'Levequeboeuf', 181, NULL),
(60, 'Delmas Loiseau S.A.', '824, impasse Hugues Hubert\n05 273 Bernier', '20600', 'Colin', 184, NULL),
(61, 'Bruneau', '39, boulevard Gilles Dupre\n04 383 Guillet', '14647', 'Valentin-les-Bains', 187, NULL),
(62, 'Pires', 'chemin de Chauveau07 762 BarthelemyVille', '67 52', 'LeducBourge', 190, NULL),
(63, 'Marion et Fils', '8, impasse de Navarro\n83 786 Hoarauboeuf', '04 27', 'Delannoy', 193, NULL),
(64, 'Gros Renaud S.A.R.L.', '12, rue Marguerite Guilbert\n71 063 Pires', '11864', 'ValentinBourg', 196, NULL),
(65, 'Leconte Lefebvre SAS', '84, impasse Baudry\n75 741 Devaux', '60835', 'Carre', 199, NULL),
(66, 'Collet', '580, avenue Collin\n89 101 Hernandez', '43 39', 'Gilles', 202, NULL),
(67, 'Godard et Fils', '212, impasse Pottier\n75524 Adam', '31 76', 'Germain', 205, NULL),
(68, NULL, NULL, NULL, NULL, 210, NULL),
(69, NULL, NULL, NULL, NULL, 218, NULL),
(70, NULL, NULL, NULL, NULL, 224, NULL),
(71, 'ARCADEs', 'Rue de la ZAC', '34550', 'St-Thibéry', 232, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`, `nom`, `prenom`, `role`) VALUES
(161, 'dada@gmail.com', '[\"ROLE_CONSULTANT\"]', '$2y$13$jhXOdQrUzigbmB6PDiyTNeBkNxttTDO1y./QB83MULfTxBP6DV1le', 'Colas', 'Marc', 'consultant'),
(162, 'candidat_@gmail.com', '[\"ROLE_CANDIDAT_TOVALID\"]', 'mlkjmlkj', 'Bruneaux', 'Josephef', 'candidat_tovalid'),
(163, 'fabien.macip+163@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', '$2y$13$n7q0SOBjGXiWmSGGMPfdju9Htbt0y.mt7tPtGp1yKD9yHpWPfXx.6', 'Pasquiere', 'Aimé', 'recruteur_tovalid'),
(164, 'margaud.dumont@bigot.fr', '[\"ROLE_CONSULTANT\"]', '42y^\\&A-f@d?6}R8[', 'Bouvete', 'Charles', 'consultant'),
(165, 'delattre.claudine@voila.fr', '[\"ROLE_CANDIDAT_TOVALID\"]', '!ySgp9T\"F&@8x&C3&TT*', 'Mendes', 'Odette', 'candidat_tovalid'),
(166, 'fabien.macip+166@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', 'l`[gvx4s', 'Hebert', 'Susan', 'recruteur_tovalid'),
(167, 'didier.madeleine@laposte.net', '[\"ROLE_CONSULTANT\"]', 'hrdiID?Ve4=<iaAuyK#s', 'Delorme', 'Aurore', 'consultant'),
(168, 'suzanne61@yahoo.fr', '[\"ROLE_CANDIDAT\"]', '$2y$13$qxDbbpO7zq6pddmjxQta5.8u2YbWFQJPTSLYxFJNz1GdBnCqpKOYC', 'Techer', 'Adrien', 'candidat'),
(169, 'fabien.macip+169@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', '9$u3lM%.V[>WggN:zmo', 'Guillet', 'Colette', 'recruteur_tovalid'),
(170, 'elodie.salmon@huet.com', '[\"ROLE_CONSULTANT\"]', 'mmmWLNoNR&>`>w_C', 'Boulay', 'Aimé', 'consultant'),
(171, 'morel.gabriel@chartier.net', '[\"ROLE_CANDIDAT\"]', 'rW38,F49', 'Didier', 'Océane', 'candidat'),
(172, 'fabien.macip+172@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', '$2y$13$186egEsc8R3w2SUDlkncJ.YmIynN3KkUn5ElS4b8CKc7ifd3bQgyW', 'Rochere', 'Stéphanie', 'recruteur_tovalid'),
(173, 'capucine25@riou.com', '[\"ROLE_CONSULTANT\"]', '$2y$13$YxLmMJlVhPddzVVPTN8iLOiPHFjQUVLt8GdKvF1nmnpJTsMvgyrGG', 'Gonzalez', 'Louise', 'consultant'),
(174, 'alexandre.michel@lacombe.fr', '[\"ROLE_CANDIDAT\"]', '/x^lL^BcT<l9', 'Denis', 'Lucas', 'candidat'),
(175, 'fabien.macip+175@gmail.com', '[\"ROLE_RECRUTEUR\"]', 'k$|/YT\\+', 'Guillot', 'Arnaude', 'recruteur'),
(176, 'morel.thibaut@ferrand.com', '[\"ROLE_CONSULTANT\"]', 'J)uK)X@V', 'Samson', 'Richard', 'consultant'),
(177, 'ipetitjean@bazin.net', '[\"ROLE_CANDIDAT\"]', 'o[O0[n/]9P^s', 'Germain', 'Théophile', 'candidat'),
(178, 'fabien.macip+58@gmail.com', '[\"ROLE_RECRUTEUR\"]', '\'lwcxH{:#', 'Boutin', 'Joseph', 'recruteur'),
(179, 'jhernandez@orange.fr', '[\"ROLE_CONSULTANT\"]', '$]U9z1G|', 'Foucher', 'Émile', 'consultant'),
(180, 'maggie.renaud@labbe.com', '[\"ROLE_CANDIDAT\"]', 'BDo65\\8rLqK%b1mrT$', 'Le Roux', 'Sabine', 'candidat'),
(181, 'fabien.macip+59@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', '1_G!#}?{(Rc]t', 'Bernier', 'Margaud', 'recruteur_tovalid'),
(182, 'remy.dacosta@orange.fr', '[\"ROLE_CONSULTANT\"]', '$2y$13$zPps3GdFTH58k7W0pqhsvOUzuY9Ao2A2ZqnXtuxrSYpbGjQvIujPO', 'Fouquete', 'Luce', 'consultant'),
(183, 'allain.denis@chevalier.fr', '[\"ROLE_CANDIDAT\"]', '(w(g^|F', 'Breton', 'Jacqueline', 'candidat'),
(184, 'fabien.macip+60@gmail.com', '[\"ROLE_RECRUTEUR\"]', '#m&_swhu', 'Aubert', 'Antoinette', 'recruteur'),
(185, 'pires.nicolas@laposte.net', '[\"ROLE_CONSULTANT\"]', 'A|3;8a', 'Joly', 'Laurent', 'consultant'),
(186, 'wleroy@orange.fr', '[\"ROLE_CANDIDAT\"]', 'Hbw+L{jWyr?M1BK6C?T', 'Collin', 'Frédérique', 'candidat'),
(187, 'fabien.macip+61@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', '~:6YdeG!Ui=&U\'@p!', 'Lopez', 'Antoinette', 'recruteur_tovalid'),
(188, 'lorraine24@yahoo.fr', '[\"ROLE_CONSULTANT\"]', 'FL_t=<TO]s-me%V(', 'Maillot', 'Édith', 'consultant'),
(189, 'denise.pruvost@noos.fr', '[\"ROLE_CANDIDAT\"]', '(yy=m!u%rtr', 'Turpin', 'Paulette', 'candidat'),
(190, 'fabien.macip+62@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', '^%g3^7ffff', 'De Oliveira', 'Élodie', 'recruteur_tovalid'),
(191, 'dpoirier@free.fr', '[\"ROLE_CONSULTANT\"]', '~o#`=1F$A&_\"NY$_', 'Maurice', 'Édouard', 'consultant'),
(192, 'valerie.dufour@hotmail.fr', '[\"ROLE_CANDIDAT\"]', 'Qv#w)4`lk\"', 'Marques', 'Noémi', 'candidat'),
(193, 'fabien.macip+63@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', 'tttttttt3654', 'Martins', 'Éléonore', 'recruteur_tovalid'),
(194, 'eugene.leroy@sfr.fr', '[\"ROLE_CONSULTANT\"]', '/228o)-=c3d*MQ', 'Pereira', 'Adrienne', 'consultant'),
(195, 'rmorvan@wanadoo.fr', '[\"ROLE_CANDIDAT\"]', '1p(#44~sI6\\0>\\)`pdb', 'Gregoire', 'Nicolas', 'candidat'),
(196, 'fabien.macip+64@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', 'ZUxS03To^+G[H_v6}', 'Hamel', 'Adrienne', 'recruteur_tovalid'),
(197, 'vgoncalves@hotmail.fr', '[\"ROLE_CONSULTANT\"]', '#78aKd|c', 'Rey', 'Éric', 'consultant'),
(198, 'robert.girard@sfr.fr', '[\"ROLE_CANDIDAT\"]', '>_ZHwX%Pt', 'Picard', 'Marcel', 'candidat'),
(199, 'fabien.macip+65@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', '/g71qc:T', 'Charles', 'Sébastien', 'recruteur_tovalid'),
(200, 'fmary@martin.org', '[\"ROLE_CONSULTANT\"]', 'E5EsLGRB', 'Allard', 'Olivier', 'consultant'),
(201, 'aubry.pierre@rey.fr', '[\"ROLE_CANDIDAT\"]', ',)&`kAut]8s2{G6\'h-', 'Herve', 'Anaïs', 'candidat'),
(202, 'fabien.macip+66@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', '9d]D7|XxNzRnMN\\hmO', 'Maillard', 'Mathilde', 'recruteur_tovalid'),
(203, 'theodore.allain@courtois.fr', '[\"ROLE_CONSULTANT\"]', 'Q\'R$0E*^X0_@vYY', 'Boyer', 'Renée', 'consultant'),
(204, 'gabrielle.brunel@delmas.com', '[\"ROLE_CANDIDAT_TOVALID\"]', 'jjjjjjjj', 'Gilbert', 'Françoise', 'candidat_tovalid'),
(205, 'fabien.macip+67@gmail.com', '[\"ROLE_RECRUTEUR_TOVALID\"]', 'f@76<cnJ>.tR&y~pc', 'Robert', 'Agathe', 'recruteur_tovalid'),
(206, 'fatabien@gmail.com', '[\"ROLE_CONSULTANT\"]', '$2y$13$9PpIXRHR2Zw4nC4JF8jNAOnpPZDW6fqdgj9Tt/wwsalNFlzEn5FGG', 'Macipe', 'Fabien', 'consultant'),
(207, 'fatabius@gmail.com', '[\"ROLE_CANDIDAT_TOVALID\"]', '$2y$13$pCtBcBDO5Lw164jbkzLVoOpgqFZBf4Kz.1r2D6d.5OJGYiitDjp0K', 'MACIP', 'Fabricet', 'candidat_tovalid'),
(208, 'emilien@gmail.com', '[\"ROLE_CONSULTANT\"]', 'tttttttt', 'FERRAZ', 'Emilio', 'consultant'),
(209, 'ju@ju.ju', '[\"ROLE_CONSULTANT\"]', 'mlkjmlkjmlkj', 'TESTs', 'Julien', 'consultant'),
(210, 'lui@lui.fr', '[\"ROLE_RECRUTEUR\"]', '$2y$13$UNIrQBqB3tuIWE.Cg3zgT.VKqu9XocvXJ9eZka7kYUYlbxfrxpiQ2', 'DURAND', 'Marcel', 'recruteur'),
(211, 'jj@jj.jjj', '[\"ROLE_CANDIDAT_TOVALID\"]', '$2y$13$7Ya1up8K1q.n4OlUCA4P8ePTjrPYDlcrQhNa5JZSH8Oo6Ao9vJSkq', 'DJOUL', 'Lucille', 'candidat_tovalid'),
(212, 'b@b.fr', '[\"ROLE_CANDIDAT_TOVALID\"]', '$2y$13$PYHKoIJFRAAH5rWVrNewZ.XGj6BN/x01l6ajrq9PqvY3nTdnQF3Qa', 'MOUNIPI', 'Juliettes', 'candidat_tovalid'),
(213, 'i@i.i', '[\"ROLE_CANDIDAT_TOVALID\"]', '$2y$13$1ghrFWMEk9.FOZTS5g36e.L35.u3PMty5FCPDs3.Hbu6LEPt8tP3u', 'ILOT', 'Francine', 'candidat_tovalid'),
(214, 'lu@lu.lu', '[\"ROLE_CONSULTANT\"]', '$2y$13$FDxZCpUMrURs7/GmliOd4OLc6SyKHssumP8eHkUHSKyL4NJODJSNG', 'LULU', 'Jacquot', 'consultant'),
(215, 'a@a.aaa', '[\"ROLE_CANDIDAT\"]', '$2y$13$RmcUYvkXUC9AyNRjz2txP.qAq4uEHI1//2KIlEonRSWnBWCnc2QA.', 'MIMI', 'lulu', 'candidat'),
(216, 'candidat23@gmail.com', '[\"ROLE_CANDIDAT\"]', '$2y$13$mUbm4HnZ5tsgN.EiDoVaKesE4IZeaZR5KMY6kBZQu9Y8GwdEA6tXW', 'CANDIDE', 'Antoine', 'candidat'),
(217, 'candidat2@gmail.com', '[\"ROLE_CANDIDAT_TOVALID\"]', '$2y$13$62jmh9rUMxvij3ctoKyFB.CrRKY5LNNtt2bIeUYVQlq3CX9uwVIbO', 'RECRUTEUR', 'Lionel', 'candidat_tovalid'),
(218, 'recruteur23@gmail.com', '[\"ROLE_RECRUTEUR\"]', '$2y$13$UvLBF4LaQ0as1YEidQs8IuDUR9SPYz21/L18UqjpacmQ774kmE5s.', 'RECRUTEUR', 'Ulysse', 'recruteur'),
(219, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$rybrCDj9avi9NOYQt3UuxuiZK6e.7OJXVtDkn2BGD7BQOnAThMwOa', 'ADMIN', 'Luludde', 'admin'),
(221, 'admin2@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$71i0V7yfCObr45mzFFQosO.a6/OiyKwOCpPQwo2a45inllIEIQLNu', 'RURIe', 'Hector', 'admin'),
(224, 'recruteur2@gmail.com', '[\"ROLE_RECRUTEUR\"]', '$2y$13$Mu6/3Hn.eZK0t75WX7b0Cude8cbJ3pFwM6TeiYBNIVGR7kubPYFw2', 'MMM', 'aaa', 'recruteur'),
(225, 'consultant@gmail.com', '[\"ROLE_CONSULTANT\"]', '$2y$13$FWGyWN1B3zC.1z3JiqC7X.2B6cN5ZTwC0SFaeJakd0mqv4kV6.Mku', 'ALI', 'Baba', 'consultant'),
(226, 'candidat4@gmail.com', '[\"ROLE_CANDIDAT\"]', '$2y$13$aGRmxHKMneqYC2IrOiqst.F34awqBEmi4ZCr0fkYk3OMeQCkB2NtC', 'BBB', 'iii', 'candidat'),
(228, 'admin5@gmail.com', '[\"ROLE_ADMIN_TOVALID\"]', '$2y$13$KZtFcSahkKwIWoc9bZjqLuIz5cegkFb1D7bNnA9/trmk9Na2WKZva', 'mlkj', 'mlkj', 'admin_tovalid'),
(229, 'fabien.macip2@gmail.com', '[\"ROLE_ADMIN_TOVALID\"]', 'mlkjmlkj', 'TEST', 'Lulu', 'admin'),
(230, 'admin30@gmail.com', '[\"ROLE_ADMIN_TOVALID\"]', '$2y$13$e/.BroPJJbJohLQhgiDA4e8pVwtdK9n5KzWEMwGanCymFtOH1IVuW', 'HADAD', 'Jackie', 'admin'),
(231, 'candidat@gmail.com', '[\"ROLE_CANDIDAT\"]', 'mlkjmlkj', 'PONS', 'Lucienb', 'candidat'),
(232, 'recruteur@gmail.com', '[\"ROLE_RECRUTEUR\"]', 'mlkjmlkj', 'ULISE', 'John', 'recruteur'),
(233, 'admin_@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$576q94vUnolqm6b6nYcATObalHjyiTbn1DFhtAXJ9In.CuYQxYbTe', 'RURU', 'ANtoine', 'admin'),
(234, 'admin__@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$VR4FU67JudgBrU2zHjc8jeinv0By1EJpoScleskzHYEtOOHZFqepC', 'DURAND', 'Lionel', 'admin'),
(235, 'didi@gmail.com', '[\"ROLE_CONSULTANT\"]', '$2y$13$UwrlCOham8RCci5cOhFo8.5quCee4Vh/tfrovFvFteFJI1qLc3XW6', 'JUJU', 'Lili', 'consultant'),
(236, 'consul@gmail.com', '[\"ROLE_CONSULTANT\"]', '$2y$13$Ct7tSpcMNOFzdnry80qc/e9JMBWFGeY0gmN0fC6jYm5ztV/T5qLXO', 'RU', 'Lie', 'consultant');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F65593E5BB0859F1` (`recruteur_id`),
  ADD KEY `IDX_F65593E544F779A2` (`consultant_id`);

--
-- Index pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6AB5B471A76ED395` (`user_id`),
  ADD KEY `IDX_6AB5B47144F779A2` (`consultant_id`);

--
-- Index pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E33BD3B88805AB2F` (`annonce_id`),
  ADD KEY `IDX_E33BD3B88D0EB82` (`candidat_id`),
  ADD KEY `IDX_E33BD3B8CC233509` (`consultant_approval_id`);

--
-- Index pour la table `recruteur`
--
ALTER TABLE `recruteur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2BD3678CA76ED395` (`user_id`),
  ADD KEY `IDX_2BD3678C44F779A2` (`consultant_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annonce`
--
ALTER TABLE `annonce`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `candidat`
--
ALTER TABLE `candidat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `candidature`
--
ALTER TABLE `candidature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;

--
-- AUTO_INCREMENT pour la table `recruteur`
--
ALTER TABLE `recruteur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `annonce`
--
ALTER TABLE `annonce`
  ADD CONSTRAINT `FK_F65593E544F779A2` FOREIGN KEY (`consultant_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_F65593E5BB0859F1` FOREIGN KEY (`recruteur_id`) REFERENCES `recruteur` (`id`);

--
-- Contraintes pour la table `candidat`
--
ALTER TABLE `candidat`
  ADD CONSTRAINT `FK_6AB5B47144F779A2` FOREIGN KEY (`consultant_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_6AB5B471A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `candidature`
--
ALTER TABLE `candidature`
  ADD CONSTRAINT `FK_E33BD3B88805AB2F` FOREIGN KEY (`annonce_id`) REFERENCES `annonce` (`id`),
  ADD CONSTRAINT `FK_E33BD3B88D0EB82` FOREIGN KEY (`candidat_id`) REFERENCES `candidat` (`id`),
  ADD CONSTRAINT `FK_E33BD3B8CC233509` FOREIGN KEY (`consultant_approval_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `recruteur`
--
ALTER TABLE `recruteur`
  ADD CONSTRAINT `FK_2BD3678C44F779A2` FOREIGN KEY (`consultant_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_2BD3678CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

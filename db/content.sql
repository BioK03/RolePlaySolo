-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 13 Mars 2015 à 17:56
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

use `roleplaysolo`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `roleplaysolo`
--

-- --------------------------------------------------------

--
-- Contenu de la table `serie`
--

INSERT INTO `t_serie` (`ser_idSerie`, `ser_intitule`, `ser_image`) VALUES
(1, 'Défis Fantastiques', 'images/logo_serie/logo_df.jpg'),
(2, 'Loup Solitaire', 'images/logo_serie/logo_ls.jpg'),
(3, 'Quête du Graal', 'images/logo_serie/logo_qg.jpg'),
(4, 'Sorcellerie!', 'images/logo_serie/logo_sor.jpg');

-- --------------------------------------------------------

-- --------------------------------------------------------


--
-- Contenu de la table `produit`
--

INSERT INTO `t_produit` (`prod_idProduit`, `prod_nom`, `prod_editeur`, `prod_auteur`, `prod_numero`, `prod_isbn`, `prod_prix`, `prod_description`, `prod_image`, `prod_quantite`, `prod_numSerie`) VALUES
(1, 'Le Sorcier de la Montagne de Feu', 'Gallimard / Folio Junior', 'Ian Livingstone - Steve Jackson', 1, '2 07 033252 7', 1, 'C''est au plus profond des labyrinthes de l''inquiétante Montagne de Feu, que se cache un redoutable sorcier, gardien d''immenses trésors... Si toutefois on en croit la rumeur, car de nombreux aventuriers ont pénétré dans les grottes de  la Montagne, et nul n''en est jamais revenu. Vous avez décidé, à votre tour, de tenter l''aventure. Mais êtes-vous bien conscient des périls qui vous guettent?', 'images/couvertures/df1.jpg',5, 1),
(2, 'Le Labyrinthe de la Mort', 'Gallimard / Folio Junior', 'Ian Livingstone', 6, '2 07 033272 1', 1, 'Conçu par l''esprit diabolique du Baron Sukumvit, le labyrinthe de la mort est truffé de pièges mortels et peuplé de monstres assoiffés de sang. D''innombrables aventuriers ont tenté avant vous de relever le défi de l''épreuve des champions. Ils ont franchi l''entrée du labyrinthe et n''ont plus plus jamais reparu. Et VOUS, oserez-vous y entrer ? Vous serez l''un des six combattants sélectionnés cette année pour affronter les périls du labyrinthe. Un seul d''entre vous gagnera peut-être, et les autres succomberont.\r\nQui sera cet éventuel vainqueur ?', 'images/couvertures/df6.jpg',25, 1),
(3, 'Le Manoir de l''Enfer', 'Gallimard / Folio Junior', 'Steve Jackson', 10, '2 07 033286 1', 1, 'Vous avez fait la plus grande erreur de votre vie en vous réfugiant dans le manoir de l''enfer. La terrible tempête qui fait rage au-dehors ne représente qu''un bien faible danger, comparée aux terrifiantes aventures qui vous attendent à l''intérieur de cette demeure maléfique .\r\nQui peut dire combien de voyageurs malchanceux, cherchant comme vous un abri, ont péri dans les murs du manoir du compte de Brume ? Sachez que la nuit qui commence s''inscrira pour toujours parmi les plus effroyables souvenirs de votre existence...Si toutefois vous vivez assez longtemps pour en garder mémoire.', 'images/couvertures/df10.jpg',8, 1),
(4, 'La Créature Venue du Chaos', 'Gallimard / Folio Junior', 'Steve Jackson', 24, '2 07 033415 5', 1, 'Vous ne savez pas où vous êtes-vous ignorez même qui vous êtes.Cette créature primitive à qui un instinct rudimentaire tient lieu d''intelligence, c''est VOUS. Peut-être, au cours de l''aventure, parviendrez-vous a controler votre tempérament bestial, à en apprendre davantage sur votre propre compte et, plus tard, a découvrir quel destin vous est réservé. Le succès pourtant ne vous est pas assuré, car la Créature venue du chaos peut succomber, elle aussi, aux innombrables pièges tendus par les monstres qui infestent le défilé de la Dent-du-troll...\r\n', 'images/couvertures/df24.jpg',14, 1),
(5, 'La Tour de la Destruction', 'Gallimard / Folio Junior', 'Keith Martin', 45, '2 07 056788 5', 1, 'Alors que vous menez une expédition, le calme glacé de l''hiver qui règne sur les régions polaires que vous habitez est troublé par un phénomène terrifiant. D''où vient-il, ce déluge de feu qui s''abat sur votre village, détruisant tout sur son passage ? Qui commande à ces forces surnaturelles? Comment les arrêter ? Celui qui doit répondre à ces questions, c''est VOUS. Et vous apprendrez ainsi que la sphère de feu dissimule un danger plus grand encore - un danger qui menace tout Allansia !', 'images/couvertures/df45.jpg',18, 1),
(6, 'La Traversée Infernale', 'Gallimard / Folio Junior', 'Joe Dever', 2, '2 07 033291 8', 2, 'Les maîtres des ténèbres ont envahi par surprise le royaume du Sommerlund. Holmgard, la capitale, est assiégée par une puissante armée ennemie. Seul le glaive de Sommer saura libérer la ville.Et c''est VOUS, LOUP SOLITAIRE, qui devrez aller le chercher au royaume de Durenor... C''est un long et périlleux voyage qui vous attend sur mer et sur terre.\r\nLoup solitaire : une série de cinq livres dont VOUS êtes le héros. Cinq aventures qui peuvent être jouées séparément, ou comme les cinq épisodes d''une grande épopée.', 'images/couvertures/ls2.jpg',15, 2),
(7, 'Le Crépuscule des Maitres', 'Gallimard / Folio Junior', 'Joe Dever', 12, '2 07 033570 1', 2, 'Vous êtes Loup Solitaire, seul et dernier maître kaï du Sommerlund .Vous avez remporté, sur le seuil même de la Porte d''Ombre, un combat contre Vonotar le Traître qui vous a mis en possession de l''ultime Pierre de Nyxator. Vous avez ainsi achevé la Quête du Magnakaï, atteignant le rang de Grand Maître Kaï. Détruire le Seigneur des Ténèbres Gnaag de Mozgôar... Tel est l''objet de votre prochaine et dernière mission. Une mission qui vous conduira sur les mers, où se livrent de féroces batailles navales contre les cuirassés Drakarims bardés de fer et hérissés de catapultes.', 'images/couvertures/ls12.jpg',32, 2),
(8, 'Les Druides de Cener', 'Gallimard / Folio Junior', 'Joe Dever', 13, '2 07 033608 5 ', 2, 'Vous êtes Loup Solitaire, seul et premier grand maître kaï du Sommerlund, vous avez restauré le monastère kaï dans sa splendeur d''antan et les recrues du second ordre kaï, que vous avez fondé, semblent fort prometteuses. Quand aux sept pierres de la sagesse de Nyxator, elles  sont bien à l''abri dans une crypte du monastère. Les anciens mages cependant sont  inquiets : n''a-t-on pas découvert une secte de cénériens à moins de deux kilomètres du monastère Kaï ? Et l''on sait que les druides de Cener ont cultivés dans leurs laboratoires un virus de la peste...', 'images/couvertures/ls13.jpg',3, 2),
(9, 'Le Tyran du Désert', 'Gallimard / Folio Junior', 'Joe Dever', 5, '2 07 033330 2', 2, 'Vous êtes Loup Solitaire, un seigneur de la guerre dont la réputation n''est plus à faire. Aussi, grande est votre surprise, lorsque le roi du Sommerlund -votre suzerain- vous confie une mission d''ordre diplomatique. Vous devez en effet vous rendre à Barrakeesh, capitale de la Vassagonie, afin d''y négocier un traité de paix. Une mission qui risque cependant d''être plus mouvementée que prévu...Et qui, si vous la menez a bien, vous permettra d''atteindre le rang envié de Maître kaï.', 'images/couvertures/ls5.jpg', 12, 2),
(10, 'L'' Antre des Dragons', 'Gallimard / Folio Junior', 'J. H. Brennan', 2, '2 07 033314 0', 4, 'Un énorme dragon sanguinaire écume le Royaume d''Avalon, suscitant la terreur et semant la ruine sur son passage. Les courageux chevaliers de la Table Ronde sont impuissant face aux pouvoirs du monstre dont la rage destructrice menace, à Camelot même, la cour du roi Arthur. Vous seul êtes capable de libérer le peuple de cette calamité. Et vous devrez partir à la recherche du cruel reptile, qu''il vous faudra affronter au coeur même de son antre infernal. Mais savez-vous que jusqu''à aujourd''hui personne n''est revenu vivant de l''Antre des Dragons?', 'images/couvertures/qg2.jpg', 68, 3),
(11, 'Au Royaume de l''Epouvante', 'Gallimard / Folio Junior', 'J. H. Brennan', 5, '2 07 033349 3', 4, 'La révolte gronde à Avalon : Excalibur, la légendaire épée du roi Arthur, a disparu. Excalibur, le symbole du pouvoir royal. Vous seul pouvez la retrouver. Car il n''est pas d''autre héros qui oserait affronter les terribles dangers du royaume de l''Epouvante, combattre les borfax, déjouer les pièges de la ville de Scroghollow en proie à la féroce jalousie des deux rois Blagwort et Blogwort. Heureusement, Merlin est là pour vous aider... mais le grand mage a lui-même fort à faire en ces périodes troublées. Vite, ne tardez pas à vous mettre à la recherche d''Excalibur, la destinée d''Arthur est aujourd''hui entre vos mains !', 'images/couvertures/qg5.jpg', 12, 3),
(12, 'Le Temps de la Malédiction', 'Gallimard / Folio Junior', 'J. H. Brennan', 6, '2 07 033363 9', 4, 'La Malédiction règne à Camelot ! L''or rouille et le soleil même semble rongé de moisissures, les vêtements pourrissent et tombent en lambeaux. Le roi Arthur et ses chevaliers impuissants restent claquemurés dans les salles humides de ce qui fut autrefois le fier château de Camelot. Le royaume est plongé dans le chaos et seul un héros d''un courage, d''une force, d''une intelligence, d''une chance et d''une beauté presque inconcevables peut le sauver d''un sort aussi funeste, en découvrant qui - ou quoi - est responsable du désastre qui s''est abattu, telle une avalanche, sur Avalon. En d''autres termes, on a cruellement besoin de VOUS.', 'images/couvertures/qg6.jpg', 56, 3);

-- --------------------------------------------------------

-- --------------------------------------------------------


--
-- Contenu de la table `client`
--
/* raw password is 'john' */
insert into t_client values
(1, 'JohnDoe', 'johndoe@gmail.com', '15 bd Latarget', '69100', 'Villeurbanne', 'L2nNR5hIcinaJkKR+j4baYaZjcHS0c3WX2gjYF6Tmgl1Bs+C9Qbr+69X8eQwXDvw0vp73PrcSeT0bGEW5+T2hA==', 'YcM=A$nsYzkyeDVjEUa7W9K', 'ROLE_USER');
/* raw password is 'jane' */
insert into t_client values
(2, 'JaneDoe', 'janedoe@hotmail.fr', '18 rue de Bruxelles', '69100', 'Villeurbanne', 'EfakNLxyhHy2hVJlxDmVNl1pmgjUZl99gtQ+V3mxSeD8IjeZJ8abnFIpw9QNahwAlEaXBiQUBLXKWRzOmSr8HQ==', 'dhMTBkzwDKxnD;4KNs,4ENy', 'ROLE_USER');


--
-- Contenu de la table `commentaire`
--

insert into t_commentaire values
(1, 'Great! Keep up the good work.', 1, 1);
insert into t_commentaire values
(2, "Thank you, I'll try my best.", 1, 2);

--
-- Contenu de la table `panier`
--
insert into t_panier values
(1, 1, 4, 2);
insert into t_panier values
(2, 1, 8, 1);
insert into t_panier values
(3, 2, 3, 5);
insert into t_panier values
(4, 2, 2, 1);

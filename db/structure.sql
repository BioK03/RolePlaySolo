-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 13 Mars 2015 à 15:53
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


drop table if exists t_panier;
drop table if exists t_commentaire;
drop table if exists t_produit;
drop table if exists t_serie;
drop table if exists t_client;



-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

CREATE TABLE IF NOT EXISTS `t_serie` (
`ser_idSerie` int(11) NOT NULL primary key auto_increment,
  `ser_intitule` varchar(50) NOT NULL,
  `ser_image` varchar(50) NOT NULL
) engine=innodb character set utf8 collate utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `t_produit` (
`prod_idProduit` int(40) NOT NULL primary key auto_increment,
  `prod_nom` varchar(120) NOT NULL,
  `prod_editeur` varchar(100) NOT NULL,
  `prod_auteur` varchar(50) NOT NULL,
  `prod_numero` int(3) NOT NULL,
  `prod_isbn` varchar(25) NOT NULL,
  `prod_prix` float NOT NULL,
  `prod_description` varchar(1100) NOT NULL,
  `prod_image` varchar(50) NOT NULL,
  `prod_quantite` int(5) NOT NULL,
  `prod_numSerie` int(11) NOT NULL,
  constraint fk_numS_serie foreign key(prod_numSerie) references t_serie(ser_idSerie)
) engine=innodb character set utf8 collate utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--
create table t_client (
    cli_idClient integer not null primary key auto_increment,
	cli_pseudo varchar(50) not null,
    cli_name varchar(50) not null,
	cli_address varchar(150) not null,
	cli_cp varchar(5) not null,
	cli_city varchar(50) not null,
    cli_password varchar(88) not null,
    cli_salt varchar(23) not null,
    cli_role varchar(50) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;


-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

create table t_commentaire (
    com_idCommentaire integer not null primary key auto_increment,
    com_content varchar(500) not null,
    com_idProduit integer not null,
	com_idClient integer not null,
    constraint fk_com_prod foreign key(com_idProduit) references t_produit(prod_idProduit),
	constraint fk_com_user foreign key(com_idClient) references t_client(cli_idClient)
) engine=innodb character set utf8 collate utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE IF NOT EXISTS `t_panier` (
  `pan_idPanier` int(11) NOT NULL primary key auto_increment,
  `pan_idClient` integer NOT NULL,
  `pan_idProduit` int(40) NOT NULL,
  `pan_quantite` int(3) NOT NULL,
  constraint fk_pan_cli foreign key(pan_idClient) references t_client(cli_idClient),
  constraint fk_pan_prod foreign key(pan_idProduit) references t_produit(prod_idProduit)
) engine=innodb character set utf8 collate utf8_unicode_ci;




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

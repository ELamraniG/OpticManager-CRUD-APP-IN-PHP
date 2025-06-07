
CREATE DATABASE IF NOT EXISTS `optirent`;
USE `optirent`;


CREATE TABLE `categorie` (
  `idc` varchar(50) NOT NULL,
  `titrec` varchar(255) NOT NULL,
  PRIMARY KEY (`idc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `fournisseur` (
  `idf` varchar(50) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `typedeproduit` varchar(255) NOT NULL,
  `conditiondepaiement` varchar(255) DEFAULT NULL,
  `conditiondelivraison` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  PRIMARY KEY (`idf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `produit` (
  `idproduit` int(11) NOT NULL AUTO_INCREMENT,
  `idc` varchar(50) NOT NULL,
  `idf` varchar(50) NOT NULL,
  `nomproduit` varchar(255) NOT NULL,
  `marque` varchar(100) NOT NULL,
  `notes` text DEFAULT NULL,
  `prixdachat` decimal(10,2) NOT NULL,
  `tvaappliquee` decimal(5,2) DEFAULT NULL,
  `prixdevente` decimal(10,2) NOT NULL,
  `qteenstock` int(11) DEFAULT 0,
  `seuildalerte` int(11) DEFAULT 5,
  PRIMARY KEY (`idproduit`),
  KEY `fk_produit_categorie` (`idc`),
  KEY `fk_produit_fournisseur` (`idf`),
  CONSTRAINT `fk_produit_categorie` FOREIGN KEY (`idc`) REFERENCES `categorie` (`idc`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_produit_fournisseur` FOREIGN KEY (`idf`) REFERENCES `fournisseur` (`idf`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `cabinet` (
  `idcabinet` varchar(50) NOT NULL,
  `nomcabinet` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `siteweb` varchar(255) DEFAULT NULL,
  `responsable` varchar(255) NOT NULL,
  `specialite` varchar(255) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `codepostal` varchar(10) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idcabinet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `client` (
  `idl` varchar(50) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateNaissance` date NOT NULL,
  `ordonnances` text DEFAULT NULL,
  `historiqueAchats` text DEFAULT NULL,
  PRIMARY KEY (`idl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `rendezvous` (
  `idrendezvous` int(11) NOT NULL AUTO_INCREMENT,
  `daterendezvous` date NOT NULL,
  `heurerendezvous` time NOT NULL,
  `idclient` varchar(50) NOT NULL,
  `idcabinet` varchar(50) NOT NULL,
  `notes` text DEFAULT NULL,
  `niveaudecredibilite` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idrendezvous`),
  KEY `fk_rdv_client` (`idclient`),
  KEY `fk_rdv_cabinet` (`idcabinet`),
  CONSTRAINT `fk_rdv_client` FOREIGN KEY (`idclient`) REFERENCES `client` (`idl`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rdv_cabinet` FOREIGN KEY (`idcabinet`) REFERENCES `cabinet` (`idcabinet`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `commande` (
  `idcommande` int(11) NOT NULL AUTO_INCREMENT,
  `datecommande` date NOT NULL,
  `idclient` varchar(50) NOT NULL,
  `idproduit` int(11) NOT NULL,
  `statut` varchar(100) DEFAULT 'En attente',
  PRIMARY KEY (`idcommande`),
  KEY `fk_commande_client` (`idclient`),
  KEY `fk_commande_produit` (`idproduit`),
  CONSTRAINT `fk_commande_client` FOREIGN KEY (`idclient`) REFERENCES `client` (`idl`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_commande_produit` FOREIGN KEY (`idproduit`) REFERENCES `produit` (`idproduit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



USE `optirent`;


CREATE TABLE `commandes_fournisseur` (
  `idcommande` int(11) NOT NULL AUTO_INCREMENT,
  `idfournisseur` varchar(50) NOT NULL,
  `datecommande` date NOT NULL,
  `statut` varchar(100) DEFAULT 'en_attente',
  PRIMARY KEY (`idcommande`),
  KEY `fk_commande_fournisseur` (`idfournisseur`),
  CONSTRAINT `fk_commande_fournisseur` FOREIGN KEY (`idfournisseur`) REFERENCES `fournisseur` (`idf`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `patients` (
  `idpatient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `datenaissance` date NOT NULL,
  `sexe` varchar(100) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `adresse` text DEFAULT NULL,
  `datecreation` date DEFAULT NULL,
  PRIMARY KEY (`idpatient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `consultations` (
  `idconsultation` int(11) NOT NULL AUTO_INCREMENT,
  `idpatient` int(11) NOT NULL,
  `dateconsultation` date NOT NULL,
  `motif` text NOT NULL,
  `observations` text DEFAULT NULL,
  `prescriptionpdf` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idconsultation`),
  KEY `fk_consultation_patient` (`idpatient`),
  CONSTRAINT `fk_consultation_patient` FOREIGN KEY (`idpatient`) REFERENCES `patients` (`idpatient`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `ordonnances` (
  `idordonnance` int(11) NOT NULL AUTO_INCREMENT,
  `idconsultation` int(11) NOT NULL,
  `oeil` varchar(100) NOT NULL,
  `sphere` float DEFAULT NULL,
  `cylindre` float DEFAULT NULL,
  `axe` int(11) DEFAULT NULL,
  `addition` float DEFAULT NULL,
  `typecorrection` varchar(100) NOT NULL,
  PRIMARY KEY (`idordonnance`),
  KEY `fk_ordonnance_consultation` (`idconsultation`),
  CONSTRAINT `fk_ordonnance_consultation` FOREIGN KEY (`idconsultation`) REFERENCES `consultations` (`idconsultation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `ventes` (
  `id_vente` int(11) NOT NULL AUTO_INCREMENT,
  `idpatient` int(11) NOT NULL,
  `datevente` datetime NOT NULL,
  `montanttotal` decimal(10,2) NOT NULL,
  `modepaiement` varchar(100) NOT NULL,
  `statutpaiement` varchar(100) DEFAULT 'en_attente',
  PRIMARY KEY (`id_vente`),
  KEY `fk_vente_patient` (`idpatient`),
  CONSTRAINT `fk_vente_patient` FOREIGN KEY (`idpatient`) REFERENCES `patients` (`idpatient`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `vente_details` (
  `iddetail` int(11) NOT NULL AUTO_INCREMENT,
  `idvente` int(11) NOT NULL,
  `idproduit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prixunitaire` decimal(10,2) NOT NULL,
  PRIMARY KEY (`iddetail`),
  KEY `fk_detail_vente` (`idvente`),
  KEY `fk_detail_produit` (`idproduit`),
  CONSTRAINT `fk_detail_vente` FOREIGN KEY (`idvente`) REFERENCES `ventes` (`id_vente`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_detail_produit` FOREIGN KEY (`idproduit`) REFERENCES `produit` (`idproduit`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE `utilisateurs` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nomutilisateur` varchar(100) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `nomcomplet` varchar(150) NOT NULL,
  `actif` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`idutilisateur`),
  UNIQUE KEY `unique_nomutilisateur` (`nomutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `utilisateurs` (`nomutilisateur`, `motdepasse`, `role`, `nomcomplet`, `actif`) VALUES
('admin', MD5('admin'), 'admin', 'Administrateur Principal', 1),
('opticien1', MD5('opticien123'), 'opticien', 'Dr. Jean Dubois', 1),
('assistant1', MD5('assistant123'), 'assistant', 'Marie Dupont', 1);


USE `optirent`;
ALTER TABLE `rendezvous` DROP FOREIGN KEY `fk_rdv_client`;
ALTER TABLE `commande` DROP FOREIGN KEY `fk_commande_client`;
ALTER TABLE `client` DROP PRIMARY KEY;
ALTER TABLE `client` MODIFY `idl` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY;
ALTER TABLE `rendezvous` MODIFY `idclient` int(11) NOT NULL;
ALTER TABLE `commande` MODIFY `idclient` int(11) NOT NULL;
ALTER TABLE `rendezvous` ADD CONSTRAINT `fk_rdv_client` 
    FOREIGN KEY (`idclient`) REFERENCES `client` (`idl`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `commande` ADD CONSTRAINT `fk_commande_client` 
    FOREIGN KEY (`idclient`) REFERENCES `client` (`idl`) ON DELETE CASCADE ON UPDATE CASCADE;

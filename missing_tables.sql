-- =============================================
-- MISSING TABLES FOR OPTIRENT PROJECT
-- SQL queries to create the remaining tables
-- =============================================

USE `optirent`;

-- =============================================
-- TABLE: commandes_fournisseur
-- =============================================
CREATE TABLE `commandes_fournisseur` (
  `idcommande` int(11) NOT NULL AUTO_INCREMENT,
  `idfournisseur` varchar(50) NOT NULL,
  `datecommande` date NOT NULL,
  `statut` varchar(100) DEFAULT 'en_attente',
  PRIMARY KEY (`idcommande`),
  KEY `fk_commande_fournisseur` (`idfournisseur`),
  CONSTRAINT `fk_commande_fournisseur` FOREIGN KEY (`idfournisseur`) REFERENCES `fournisseur` (`idf`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sample data for commandes_fournisseur
INSERT INTO `commandes_fournisseur` (`idfournisseur`, `datecommande`, `statut`) VALUES
('FOU001', '2024-06-01', 'livree'),
('FOU002', '2024-06-03', 'en_attente'),
('FOU001', '2024-06-05', 'annulee');

-- =============================================
-- TABLE: patients
-- =============================================
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

-- Sample data for patients
INSERT INTO `patients` (`nom`, `prenom`, `datenaissance`, `sexe`, `telephone`, `email`, `adresse`, `datecreation`) VALUES
('Durand', 'Sophie', '1992-05-12', 'Femme', '+33123456789', 'sophie.durand@email.com', '123 Rue de la Santé, Paris', '2024-06-01'),
('Moreau', 'Laurent', '1985-09-23', 'Homme', '+33987654321', 'laurent.moreau@email.com', '456 Avenue des Roses, Lyon', '2024-06-02'),
('Leroy', 'Camille', '1978-12-08', 'Femme', '+33456789123', 'camille.leroy@email.com', '789 Boulevard Central, Marseille', '2024-06-03');

-- =============================================
-- TABLE: consultations
-- =============================================
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

-- Sample data for consultations
INSERT INTO `consultations` (`idpatient`, `dateconsultation`, `motif`, `observations`, `prescriptionpdf`) VALUES
(1, '2024-06-10', 'Contrôle de vue annuel', 'Vision stable, légère myopie', 'prescription_001.pdf'),
(2, '2024-06-12', 'Fatigue oculaire', 'Presbytie naissante détectée', 'prescription_002.pdf'),
(3, '2024-06-15', 'Renouvellement lunettes', 'Prescription inchangée', NULL);

-- =============================================
-- TABLE: ordonnances
-- =============================================
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

-- Sample data for ordonnances
INSERT INTO `ordonnances` (`idconsultation`, `oeil`, `sphere`, `cylindre`, `axe`, `addition`, `typecorrection`) VALUES
(1, 'Droit', -2.5, -0.5, 90, NULL, 'verre'),
(1, 'Gauche', -2.25, -0.75, 85, NULL, 'verre'),
(2, 'Droit', 0.5, 0, 0, 1.5, 'verre'),
(2, 'Gauche', 0.75, 0, 0, 1.5, 'verre'),
(3, 'Droit', -1.5, 0, 0, NULL, 'lentille'),
(3, 'Gauche', -1.75, 0, 0, NULL, 'lentille');

-- =============================================
-- TABLE: ventes
-- =============================================
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

-- Sample data for ventes
INSERT INTO `ventes` (`idpatient`, `datevente`, `montanttotal`, `modepaiement`, `statutpaiement`) VALUES
(1, '2024-06-10 14:30:00', 189.99, 'carte', 'paye'),
(2, '2024-06-12 16:15:00', 245.50, 'mutuelle', 'en_attente'),
(3, '2024-06-15 10:45:00', 79.99, 'especes', 'paye');

-- =============================================
-- TABLE: vente_details
-- =============================================
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

-- Sample data for vente_details
INSERT INTO `vente_details` (`idvente`, `idproduit`, `quantite`, `prixunitaire`) VALUES
(1, 1, 1, 89.99),
(1, 3, 2, 29.99),
(2, 2, 1, 149.99),
(2, 1, 1, 89.99),
(3, 3, 1, 29.99);

-- =============================================
-- TABLE: utilisateurs
-- =============================================
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

-- Sample data for utilisateurs
INSERT INTO `utilisateurs` (`nomutilisateur`, `motdepasse`, `role`, `nomcomplet`, `actif`) VALUES
('admin', MD5('admin123'), 'admin', 'Administrateur Principal', 1),
('opticien1', MD5('opticien123'), 'opticien', 'Dr. Jean Dubois', 1),
('assistant1', MD5('assistant123'), 'assistant', 'Marie Dupont', 1);

-- =============================================
-- ADDITIONAL VIEWS FOR THE NEW TABLES
-- =============================================

-- View for complete sales information
CREATE VIEW `vue_ventes_completes` AS
SELECT 
    v.id_vente,
    v.datevente,
    CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet,
    v.montanttotal,
    v.modepaiement,
    v.statutpaiement,
    GROUP_CONCAT(CONCAT(pr.nomproduit, ' (', vd.quantite, ')') SEPARATOR ', ') as produits
FROM ventes v
JOIN patients p ON v.idpatient = p.idpatient
LEFT JOIN vente_details vd ON v.id_vente = vd.idvente
LEFT JOIN produit pr ON vd.idproduit = pr.idproduit
GROUP BY v.id_vente;

-- View for complete consultations
CREATE VIEW `vue_consultations_completes` AS
SELECT 
    c.idconsultation,
    c.dateconsultation,
    CONCAT(p.nom, ' ', p.prenom) as patient_nom_complet,
    c.motif,
    c.observations,
    c.prescriptionpdf
FROM consultations c
JOIN patients p ON c.idpatient = p.idpatient;

-- View for complete supplier orders
CREATE VIEW `vue_commandes_fournisseur_completes` AS
SELECT 
    cf.idcommande,
    cf.datecommande,
    f.nom as fournisseur_nom,
    cf.statut
FROM commandes_fournisseur cf
JOIN fournisseur f ON cf.idfournisseur = f.idf;

-- =============================================
-- INDEXES FOR PERFORMANCE
-- =============================================
CREATE INDEX idx_patients_nom ON patients(nom, prenom);
CREATE INDEX idx_consultations_date ON consultations(dateconsultation);
CREATE INDEX idx_ventes_date ON ventes(datevente);
CREATE INDEX idx_ordonnances_oeil ON ordonnances(oeil);
CREATE INDEX idx_commandes_fournisseur_date ON commandes_fournisseur(datecommande);

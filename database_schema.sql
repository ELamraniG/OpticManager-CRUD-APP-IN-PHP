-- =============================================
-- OPTIRENT Database Schema
-- Generated from PHP application analysis
-- =============================================

-- Create the database
CREATE DATABASE IF NOT EXISTS `optirent` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `optirent`;

-- =============================================
-- TABLE: categorie
-- =============================================
CREATE TABLE `categorie` (
  `idc` varchar(50) NOT NULL,
  `titrec` varchar(255) NOT NULL,
  PRIMARY KEY (`idc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Sample data for categorie
INSERT INTO `categorie` (`idc`, `titrec`) VALUES
('CAT001', 'Lunettes de vue'),
('CAT002', 'Lunettes de soleil'),
('CAT003', 'Lentilles de contact'),
('CAT004', 'Accessoires optiques'),
('CAT005', 'Produits d\'entretien');

-- =============================================
-- TABLE: fournisseur
-- =============================================
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

-- Sample data for fournisseur
INSERT INTO `fournisseur` (`idf`, `nom`, `contact`, `tel`, `email`, `adresse`, `ville`, `pays`, `typedeproduit`, `conditiondepaiement`, `conditiondelivraison`, `notes`) VALUES
('FOU001', 'Optique France', 'Jean Dupont', '+33123456789', 'contact@optiquefrance.fr', '123 Rue de la Paix', 'Paris', 'France', 'Lunettes', '30 jours', 'Livraison 48h', 'Fournisseur principal'),
('FOU002', 'Vision Plus', 'Marie Martin', '+33987654321', 'info@visionplus.fr', '456 Avenue des Champs', 'Lyon', 'France', 'Lentilles', '15 jours', 'Livraison express', 'Spécialiste lentilles');

-- =============================================
-- TABLE: produit
-- =============================================
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

-- Sample data for produit
INSERT INTO `produit` (`idc`, `idf`, `nomproduit`, `marque`, `notes`, `prixdachat`, `tvaappliquee`, `prixdevente`, `qteenstock`, `seuildalerte`) VALUES
('CAT001', 'FOU001', 'Lunettes de vue classiques', 'RayBan', 'Modèle populaire', 45.00, 20.00, 89.99, 50, 10),
('CAT002', 'FOU001', 'Lunettes de soleil sport', 'Oakley', 'Protection UV maximale', 75.00, 20.00, 149.99, 25, 5),
('CAT003', 'FOU002', 'Lentilles mensuelles', 'Acuvue', 'Confort toute la journée', 15.00, 20.00, 29.99, 100, 20);

-- =============================================
-- TABLE: cabinet
-- =============================================
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

-- Sample data for cabinet
INSERT INTO `cabinet` (`idcabinet`, `nomcabinet`, `adresse`, `telephone`, `email`, `siteweb`, `responsable`, `specialite`, `ville`, `pays`, `codepostal`, `logo`) VALUES
('CAB001', 'Cabinet Vision Centre', '123 Boulevard de la Santé', '+33145678901', 'contact@visioncentre.fr', 'www.visioncentre.fr', 'Dr. Pierre Dubois', 'Ophtalmologie générale', 'Paris', 'France', '75001', 'logo_vision.png'),
('CAB002', 'Clinique des Yeux', '456 Rue de la Médecine', '+33234567890', 'info@cliniqueyeux.fr', 'www.cliniqueyeux.fr', 'Dr. Sophie Bernard', 'Chirurgie oculaire', 'Marseille', 'France', '13001', 'logo_clinique.png');

-- =============================================
-- TABLE: client
-- =============================================
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

-- Sample data for client
INSERT INTO `client` (`idl`, `nom`, `prenom`, `adresse`, `telephone`, `email`, `dateNaissance`, `ordonnances`, `historiqueAchats`) VALUES
('CLI001', 'Dupont', 'Jean', '123 Rue de la République', '+33123456789', 'jean.dupont@email.com', '1985-06-15', 'Myopie -2.5, Astigmatisme', 'Lunettes achetées en 2022'),
('CLI002', 'Martin', 'Marie', '456 Avenue des Fleurs', '+33987654321', 'marie.martin@email.com', '1990-03-22', 'Presbytie +1.5', 'Lentilles et lunettes de soleil'),
('CLI003', 'Bernard', 'Pierre', '789 Place du Marché', '+33456789123', 'pierre.bernard@email.com', '1978-11-08', 'Hypermétropie +3.0', 'Client fidèle depuis 2019');

-- =============================================
-- TABLE: rendezvous
-- =============================================
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

-- Sample data for rendezvous
INSERT INTO `rendezvous` (`daterendezvous`, `heurerendezvous`, `idclient`, `idcabinet`, `notes`, `niveaudecredibilite`) VALUES
('2024-06-10', '09:30:00', 'CLI001', 'CAB001', 'Contrôle annuel', 'Élevé'),
('2024-06-12', '14:15:00', 'CLI002', 'CAB002', 'Consultation spécialisée', 'Moyen'),
('2024-06-15', '11:00:00', 'CLI003', 'CAB001', 'Suivi post-opératoire', 'Élevé');

-- =============================================
-- TABLE: commande
-- =============================================
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

-- Sample data for commande
INSERT INTO `commande` (`datecommande`, `idclient`, `idproduit`, `statut`) VALUES
('2024-06-01', 'CLI001', 1, 'Livré'),
('2024-06-03', 'CLI002', 3, 'En cours'),
('2024-06-05', 'CLI003', 2, 'En attente');

-- =============================================
-- ADDITIONAL USEFUL QUERIES
-- =============================================

-- View to get product details with category and supplier names
CREATE VIEW `vue_produits_complets` AS
SELECT 
    p.idproduit,
    p.nomproduit,
    p.marque,
    c.titrec as categorie,
    f.nom as fournisseur,
    p.prixdachat,
    p.tvaappliquee,
    p.prixdevente,
    p.qteenstock,
    p.seuildalerte,
    p.notes
FROM produit p
JOIN categorie c ON p.idc = c.idc
JOIN fournisseur f ON p.idf = f.idf;

-- View to get appointment details with client and cabinet names
CREATE VIEW `vue_rendezvous_complets` AS
SELECT 
    r.idrendezvous,
    r.daterendezvous,
    r.heurerendezvous,
    CONCAT(cl.nom, ' ', cl.prenom) as client_nom_complet,
    cb.nomcabinet,
    cb.responsable,
    r.notes,
    r.niveaudecredibilite
FROM rendezvous r
JOIN client cl ON r.idclient = cl.idl
JOIN cabinet cb ON r.idcabinet = cb.idcabinet;

-- View to get order details with client and product names
CREATE VIEW `vue_commandes_completes` AS
SELECT 
    c.idcommande,
    c.datecommande,
    CONCAT(cl.nom, ' ', cl.prenom) as client_nom_complet,
    p.nomproduit,
    p.marque,
    p.prixdevente,
    c.statut
FROM commande c
JOIN client cl ON c.idclient = cl.idl
JOIN produit p ON c.idproduit = p.idproduit;

-- =============================================
-- INDEXES FOR PERFORMANCE
-- =============================================

-- Additional indexes for better performance
CREATE INDEX idx_produit_nom ON produit(nomproduit);
CREATE INDEX idx_client_nom ON client(nom, prenom);
CREATE INDEX idx_rdv_date ON rendezvous(daterendezvous);
CREATE INDEX idx_commande_date ON commande(datecommande);
CREATE INDEX idx_commande_statut ON commande(statut);

-- =============================================
-- STOCK ALERT FUNCTION
-- =============================================

-- Query to check products with low stock
-- SELECT * FROM produit WHERE qteenstock <= seuildalerte;




-- =============================================
-- BACKUP AND MAINTENANCE QUERIES
-- =============================================

-- Query to backup data
-- mysqldump -u root -p optirent > optirent_backup.sql

-- Query to check database size
-- SELECT 
--     table_name AS "Table",
--     ROUND(((data_length + index_length) / 1024 / 1024), 2) AS "Size (MB)"
-- FROM information_schema.tables 
-- WHERE table_schema = "optirent"
-- ORDER BY (data_length + index_length) DESC;

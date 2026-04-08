-- Insert data for OptiRent database
-- Adapted to match the existing schema structure

USE `optirent`;

-- Insert data into fournisseur table
INSERT INTO `fournisseur` (`idf`, `nom`, `contact`, `tel`, `email`, `adresse`, `ville`, `pays`, `typedeproduit`, `conditiondepaiement`, `conditiondelivraison`, `notes`) VALUES
('F001', 'VisionPlus Distribution', 'Service Commercial', '0145237890', 'contact@visionplus.fr', '12 Rue des Lunetiers', 'Paris', 'France', 'Montures et accessoires', '30 jours net', 'Livraison gratuite > 500€', 'Fournisseur principal montures'),
('F002', 'OptiLens Pro', 'Département Ventes', '0478561234', 'service@optilenspro.com', '88 Avenue de l\'Optique', 'Lyon', 'France', 'Verres correcteurs', '45 jours fin de mois', 'Franco domicile', 'Spécialiste verres progressifs'),
('F003', 'LunetTech Solutions', 'Support Client', '0491112233', 'support@lunettech.fr', '5 Boulevard de la Vue', 'Marseille', 'France', 'Lentilles de contact', 'Paiement comptant', 'Express 24h', 'Lentilles spécialisées'),
('F004', 'SolaireTech', 'Commercial', '0142334455', 'vente@solairetech.fr', '25 Rue du Soleil', 'Nice', 'France', 'Lunettes solaires', '30 jours net', 'Livraison standard', 'Spécialiste solaires haut de gamme'),
('F005', 'AccessOpt', 'Service Client', '0156778899', 'info@accessopt.fr', '15 Avenue des Accessoires', 'Toulouse', 'France', 'Accessoires optiques', '15 jours net', 'Colissimo', 'Accessoires et produits d\'entretien');

-- Insert data into categorie table
INSERT INTO `categorie` (`idc`, `titrec`) VALUES
('CAT001', 'Montures'),
('CAT002', 'Verres Correcteurs'),
('CAT003', 'Lentilles de contact'),
('CAT004', 'Accessoires'),
('CAT005', 'Solaires'),
('CAT006', 'Verres progressifs'),
('CAT007', 'Montures enfant'),
('CAT008', 'Produits d\'entretien');

-- Insert data into cabinet table
INSERT INTO `cabinet` (`idcabinet`, `nomcabinet`, `adresse`, `telephone`, `email`, `siteweb`, `responsable`, `specialite`, `ville`, `pays`, `codepostal`, `logo`) VALUES
('CAB001', 'Cabinet OptiVision Paris', '45 Avenue des Champs-Élysées', '0142567890', 'contact@optivision-paris.fr', 'www.optivision-paris.fr', 'Dr. Marie Dubois', 'Optométrie générale', 'Paris', 'France', '75008', 'logo_optivision.png'),
('CAB002', 'Centre Visuel Lyon', '12 Place Bellecour', '0478123456', 'info@centrevisuel-lyon.fr', 'www.centrevisuel-lyon.fr', 'Dr. Pierre Martin', 'Ophtalmologie', 'Lyon', 'France', '69002', 'logo_centrevisuel.png'),
('CAB003', 'Clinique de la Vue Marseille', '88 La Canebière', '0491456789', 'accueil@cliniqueVue-marseille.fr', 'www.cliniquevue-marseille.fr', 'Dr. Sophie Leclerc', 'Chirurgie réfractive', 'Marseille', 'France', '13001', 'logo_clinique.png');

-- Insert data into client table
INSERT INTO `client` (`nom`, `prenom`, `adresse`, `telephone`, `email`, `dateNaissance`, `ordonnances`, `historiqueAchats`) VALUES
('Dupont', 'Jean', '123 Rue de la Paix, Paris', '0123456789', 'jean.dupont@email.fr', '1980-05-15', 'OD: -2.25 (-0.50) 180°, OG: -2.00 (-0.75) 10°', 'Lunettes achetées 2023-03-15'),
('Martin', 'Sophie', '45 Avenue Victor Hugo, Lyon', '0678901234', 'sophie.martin@email.fr', '1975-11-22', 'OD: +1.50, OG: +1.75', 'Lentilles achetées 2023-06-10'),
('Leclerc', 'Pierre', '78 Boulevard de la Liberté, Marseille', '0987654321', 'pierre.leclerc@email.fr', '1992-08-30', 'OD: -1.00, OG: -1.25', 'Lunettes solaires 2023-07-20'),
('Dubois', 'Marie', '12 Rue des Fleurs, Toulouse', '0456789123', 'marie.dubois@email.fr', '1988-03-12', 'Progressifs +2.00 Add +1.75', 'Verres progressifs 2023-04-05'),
('Moreau', 'Paul', '33 Place du Marché, Nice', '0789123456', 'paul.moreau@email.fr', '1965-12-08', 'OD: +3.25, OG: +3.00', 'Monture titanium 2023-05-18');

-- Insert data into patients table
INSERT INTO `patients` (`nom`, `prenom`, `datenaissance`, `sexe`, `telephone`, `email`, `adresse`, `datecreation`) VALUES
('Durand', 'Julien', '1985-07-14', 'Masculin', '0123456789', 'julien.durand@email.fr', '56 Rue de Rivoli, Paris', '2023-01-15'),
('Bernard', 'Claire', '1990-03-25', 'Féminin', '0234567890', 'claire.bernard@email.fr', '78 Cours Lafayette, Lyon', '2023-02-20'),
('Petit', 'Michel', '1978-11-02', 'Masculin', '0345678901', 'michel.petit@email.fr', '23 Rue Saint-Ferréol, Marseille', '2023-03-10'),
('Robert', 'Anne', '1982-09-18', 'Féminin', '0456789012', 'anne.robert@email.fr', '15 Allée Jean Jaurès, Toulouse', '2023-04-05'),
('Richard', 'François', '1970-06-30', 'Masculin', '0567890123', 'francois.richard@email.fr', '41 Promenade des Anglais, Nice', '2023-05-12');

-- Insert data into produit table
INSERT INTO `produit` (`idc`, `idf`, `nomproduit`, `marque`, `notes`, `prixdachat`, `tvaappliquee`, `prixdevente`, `qteenstock`, `seuildalerte`) VALUES
('CAT001', 'F001', 'Monture Classic', 'Ray-Ban', 'Monture classique unisexe', 45.00, 20.00, 89.90, 25, 5),
('CAT001', 'F001', 'Monture Sport', 'Oakley', 'Monture sportive légère', 65.00, 20.00, 129.90, 15, 3),
('CAT002', 'F002', 'Verre unifocal CR39', 'Essilor', 'Verre organique standard', 12.50, 20.00, 35.00, 100, 20),
('CAT002', 'F002', 'Verre progressif', 'Varilux', 'Verre progressif haut de gamme', 85.00, 20.00, 189.90, 30, 8),
('CAT003', 'F003', 'Lentilles journalières', 'Acuvue', 'Boîte 30 lentilles', 18.00, 20.00, 39.90, 50, 10),
('CAT003', 'F003', 'Lentilles mensuelles', 'Biofinity', 'Boîte 6 lentilles', 22.00, 20.00, 49.90, 40, 8),
('CAT004', 'F005', 'Étui rigide', 'Generic', 'Étui de protection', 2.50, 20.00, 8.90, 80, 15),
('CAT004', 'F005', 'Spray nettoyant', 'OptiFresh', 'Spray 50ml', 3.20, 20.00, 12.90, 60, 12),
('CAT005', 'F004', 'Lunettes solaires', 'Ray-Ban', 'Aviator classic', 75.00, 20.00, 159.90, 20, 5),
('CAT005', 'F004', 'Lunettes solaires sport', 'Oakley', 'Modèle sport polarisé', 95.00, 20.00, 199.90, 12, 3),

-- Products with LOW STOCK for testing stock alerts
('CAT001', 'F001', 'Monture Vintage', 'Persol', 'Monture rétro en acétate', 55.00, 20.00, 119.90, 0, 5),
('CAT001', 'F001', 'Monture Titanium', 'Lindberg', 'Monture ultra-légère', 120.00, 20.00, 249.90, 1, 8),
('CAT002', 'F002', 'Verre anti-reflet', 'Crizal', 'Traitement anti-reflet premium', 35.00, 20.00, 79.90, 2, 10),
('CAT003', 'F003', 'Lentilles toriques', 'Acuvue Oasys', 'Correction astigmatisme', 28.00, 20.00, 59.90, 0, 6),
('CAT004', 'F005', 'Chaînette lunettes', 'Fashion', 'Accessoire chaînette dorée', 5.00, 20.00, 15.90, 3, 12),
('CAT005', 'F004', 'Lunettes solaires enfant', 'Ray-Ban Junior', 'Protection UV pour enfants', 40.00, 20.00, 89.90, 1, 4),
('CAT002', 'F002', 'Verre photochromique', 'Transitions', 'Verre adaptatif lumière', 65.00, 20.00, 149.90, 4, 15),
('CAT001', 'F001', 'Monture flexible', 'Flexon', 'Monture à mémoire de forme', 75.00, 20.00, 159.90, 0, 7),
('CAT003', 'F003', 'Lentilles couleur', 'FreshLook', 'Lentilles cosmétiques', 25.00, 20.00, 54.90, 2, 9),
('CAT004', 'F005', 'Solution lentilles', 'OptiFree', 'Solution multifonctions 360ml', 8.50, 20.00, 18.90, 1, 10);

-- Insert data into consultations table
INSERT INTO `consultations` (`idpatient`, `dateconsultation`, `motif`, `observations`, `prescriptionpdf`) VALUES
(1, '2023-06-15', 'Contrôle de routine', 'Vision stable, légère progression myopie OG', 'prescription_001.pdf'),
(2, '2023-07-20', 'Fatigue visuelle', 'Asthénopie liée au travail sur écran', 'prescription_002.pdf'),
(3, '2023-08-10', 'Renouvellement ordonnance', 'Presbytie débutante, ajout correction VP', 'prescription_003.pdf'),
(4, '2023-09-05', 'Contrôle post-chirurgie', 'Évolution favorable après chirurgie cataracte', 'prescription_004.pdf'),
(5, '2023-09-22', 'Première consultation', 'Myopie forte bilatérale', 'prescription_005.pdf');

-- Insert data into ordonnances table
INSERT INTO `ordonnances` (`idconsultation`, `oeil`, `sphere`, `cylindre`, `axe`, `addition`, `typecorrection`) VALUES
(1, 'OD', -2.25, -0.50, 180, NULL, 'Distance'),
(1, 'OG', -2.50, -0.75, 10, NULL, 'Distance'),
(2, 'OD', -1.00, NULL, NULL, NULL, 'Distance'),
(2, 'OG', -1.25, NULL, NULL, NULL, 'Distance'),
(3, 'OD', +0.75, NULL, NULL, 1.75, 'Progressif'),
(3, 'OG', +1.00, NULL, NULL, 1.75, 'Progressif'),
(4, 'OD', +2.50, NULL, NULL, NULL, 'Distance'),
(4, 'OG', +2.25, NULL, NULL, NULL, 'Distance'),
(5, 'OD', -4.50, -1.00, 90, NULL, 'Distance'),
(5, 'OG', -4.75, -1.25, 85, NULL, 'Distance');

-- Insert data into ventes table
INSERT INTO `ventes` (`idpatient`, `datevente`, `montanttotal`, `modepaiement`, `statutpaiement`) VALUES
(1, '2023-06-20 14:30:00', 289.80, 'Carte bancaire', 'payé'),
(2, '2023-07-25 10:15:00', 159.90, 'Espèces', 'payé'),
(3, '2023-08-15 16:45:00', 449.70, 'Chèque', 'payé'),
(4, '2023-09-10 11:20:00', 89.90, 'Carte bancaire', 'payé'),
(5, '2023-09-28 15:30:00', 359.80, 'Virement', 'en_attente');

-- Insert data into vente_details table
INSERT INTO `vente_details` (`idvente`, `idproduit`, `quantite`, `prixunitaire`) VALUES
(1, 1, 1, 89.90),
(1, 4, 2, 189.90),
(1, 8, 1, 12.90),
(2, 9, 1, 159.90),
(3, 2, 1, 129.90),
(3, 4, 1, 189.90),
(3, 1, 1, 89.90),
(3, 7, 2, 8.90),
(4, 1, 1, 89.90),
(5, 10, 1, 199.90),
(5, 4, 1, 189.90);

-- Insert data into rendezvous table
INSERT INTO `rendezvous` (`daterendezvous`, `heurerendezvous`, `idclient`, `idcabinet`, `notes`, `niveaudecredibilite`) VALUES
('2023-12-15', '09:00:00', 1, 'CAB001', 'Contrôle annuel', 'Élevé'),
('2023-12-16', '14:30:00', 2, 'CAB002', 'Renouvellement lentilles', 'Moyen'),
('2023-12-18', '10:15:00', 3, 'CAB001', 'Problème vision nocturne', 'Élevé'),
('2023-12-20', '16:00:00', 4, 'CAB003', 'Consultation presbytie', 'Élevé'),
('2023-12-22', '11:30:00', 5, 'CAB002', 'Fatigue oculaire', 'Moyen');

-- Insert data into commande table
INSERT INTO `commande` (`datecommande`, `idclient`, `idproduit`, `statut`) VALUES
('2023-11-15', 1, 1, 'En cours'),
('2023-11-18', 2, 5, 'Livrée'),
('2023-11-20', 3, 9, 'En attente'),
('2023-11-22', 4, 4, 'En cours'),
('2023-11-25', 5, 2, 'En attente');

-- Insert data into commandes_fournisseur table
INSERT INTO `commandes_fournisseur` (`idfournisseur`, `datecommande`, `statut`) VALUES
('F001', '2023-11-01', 'livrée'),
('F002', '2023-11-05', 'en_cours'),
('F003', '2023-11-10', 'en_attente'),
('F004', '2023-11-12', 'livrée'),
('F005', '2023-11-15', 'en_cours');

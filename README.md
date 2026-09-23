# OpticManager

Application web en **PHP** pour la gestion d'un cabinet d'optique.

Le projet permet de gérer les principales opérations du cabinet depuis une seule interface : clients, patients, produits, ventes, consultations, rendez-vous, stock et utilisateurs.

## Fonctionnalités

* gestion des clients et des patients
* gestion des produits, catégories et fournisseurs
* gestion des commandes fournisseurs
* gestion des ventes et détails des ventes
* consultations et ordonnances
* gestion des rendez-vous
* suivi et gestion du stock
* gestion des utilisateurs
* dashboard avec statistiques
* recherche globale
* notifications et alertes liées au stock

## Technologies utilisées

* PHP
* MySQL
* Bootstrap
* HTML / CSS
* JavaScript

## Structure du projet

Les différentes fonctionnalités sont séparées dans plusieurs dossiers comme :

* `Client`
* `Patients`
* `Produit`
* `Fournisseur`
* `Commande`
* `Ventes`
* `Consultations`
* `Ordonnances`
* `Rendezvous`
* `Stock`
* `Dashboard`
* `Utilisateurs`

La connexion à la base de données se trouve dans `connexion.php`.

## Installation

1. Cloner le projet.

```bash
git clone https://github.com/ELamraniG/OpticManager-PHP-.git
```

2. Importer les fichiers SQL dans MySQL :

```text
les table.sql
les table_continue1.sql
lestable_continue2.sql
```

3. Modifier `connexion.php` si les paramètres MySQL sont différents de ceux utilisés par défaut.

4. Placer le projet dans votre serveur local PHP, par exemple XAMPP, WAMP ou MAMP.

5. Ouvrir :

```text
index-main.php
```

## Base de données

Le projet utilise une base MySQL contenant notamment les tables pour :

* clients
* patients
* produits
* fournisseurs
* commandes
* ventes
* consultations
* ordonnances
* rendez-vous
* utilisateurs

## À propos

Ce projet a été réalisé comme projet de gestion CRUD en PHP afin de pratiquer la gestion d'une base de données MySQL, les formulaires, les opérations CRUD et l'organisation d'une application web avec plusieurs modules.

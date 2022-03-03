# Projet annonces php - version demo
Projet de formation: un site de petites annonces autour de la vente d'instruments de musique électronique.  

## Fonctionnalités
- Creer un compte, se connecter et se deconnecter
- Consulter la liste des annonces, filtrer par utilisateur ou catégorie
- Consulter une annonce, contacter le vendeur
- Mettre ou enlever une annonce de liste des favoris, consulter la liste des favoris
- Publier une annonce
- Afficher la liste de ses annonces, éditer ou supprimer une annonce
- Uploader des images, ajouter des catégories personnalisées

## Technologies
Le projet est principalement écrit en **Php** et communique avec une base de donnée **SQL**. 
L'ajout dynamique de catégorie se fait en **Javascript**.  


## Scripts externe
### gin2021_DatabaseManager
La **création et l'import de la base de données** se fait de manière **automatique** via une classe php sur lequel je travaille en amont, **gin2021_DatabaseManager** (*voir le readme dans le dossier gin2021_DatabaseManager*)

### securize_form.php
La **validation des données** de formulaire est gérée par les fonctions de ce script, appelées dans les controllers.


## Installation
*decrire/mettre des liens vers l'installation de php et l'activation de js ?*


## Configuration
Pour communiquer avec la base de donnée, le script necessite de modifier **2 fichiers** de configuration: 
- **config.php** à la racine du projet
- **conf.json** dans le dossier **lib/gin2021_DatabaseManager/**

### config.php
Veuillez éditer ce fichier avec vos informations:

    'hostname' => *nom de l'hote*,
    'username' => *nom d'utilisateur*,
    'password' => *mot de passe*,

Exemple:
```
<?php
$CON_INFOS = [
    'hostname' => 'localhost',
    'basename' => 'projet_offers',
    'username' => 'root',
    'password' => 'root',
];
```

### lib/gin2021_DatabaseManager/conf.json
Pour la création et l'import automatique de la base de donnée sql, veuillez éditer le fichier lib/gin2021_DatabaseManager/conf.json avec vos informations:

    "HOST": "nom de l'hote",
    "USER": "nom d'utilisateur",
    "PASSWORD": "mot de passe"  

**Ne pas toucher aux valeurs "NAME", "TABLENAME" et "IMPORT_FILENAME" !**

Exemple:
```
{
    "HOST": "localhost",
    "NAME": "projet_offers",
    "USER": "root",
    "PASSWORD": "root",
    "TABLENAME": "",
    "IMPORT_FILENAME": "projet_offers.sql"
}
```

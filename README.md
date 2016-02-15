BlogLPDW
========

A Symfony project created on February 12, 2016, 7:59 pm.

ATTENTION: PROJET TOUJOURS EN COURS DE FINALISATION

## Features
- [x] Routes symfont en annotations
- [x] Gestion des articles (Affichage, création, modification, suppression)
- [x] Gestion des catégories (Affichage, création, recherche)
- [x] Gestion des tags (Affichage, création)
- [x] Gestion des commentaires (Affichage et création) En tant qu'anonyme
- [x] Zone administation pour créer/modifier
- [x] Validation des données formulaires

## TODO
-  Amélioration de l'affichage
-  Suppression des Catégories/Tags
-  Recherche par tags


## Installation

Mettre le dépot à la racine de votre dossier /www

Allez dans la console à la racine de votre site web.

Installer les dépendances:
```bash
$php composer.phar install
```

Créer le fichier parameters.yml afin de relier l'application avec votre base de données.

Créer les différentes tables de votre base avec la commande:
```bash
$php bin/console doctrine:schema:update --force
```

Ajouter des données de base:
```bash
$php bin/console doctrine:fixtures:load
```

Activer le CSS/JS avec la commande:
Ajouter des données de base:
```bash
$php bin/console assets:install
$php bin/console assetic:dump
```

## Accès à l'application:
```bash
/localhost/nomdevotresite/web/app_dev.php/article
```

## Accès à l'admin:
```bash
/localhost/nomdevotresite/web/app_dev.php/admin
```
3 utilisateurs de base: 
```bash
username: Rémi motsdepasse: Rémi
username: Axel motsdepasse: Axel
username: Batman motsdepasse: Batman
```


## ENJOY !
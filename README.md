# PPIL
Projet PPIL (2024)

Lien du tableur d'avancement : https://docs.google.com/spreadsheets/d/e/2PACX-1vQ2s11AOOj6RuF34TRKODeUEUTKE1gvqbiSkommPsaWRo8dP-lFadrnvUNFX0_vRqsyT5d_IUUiFNNI/pubhtml?gid=0&single=true

Lien du site web : https://main-bvxea6i-xgg3h545lxem4.fr-3.platformsh.site


Guides d'installations :
  - Installer Php
  - Installer Symfony
  - Installer composer
  - Installer un système de gestion de bases de données
  - Cloner le git
  - Modifier votre DB_URL dans .env : 
      ```DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"``` pour sqlite

  - Commandes à la racine du projet :
    ```composer install```
    ```symfony console doctrine:database:create```
    ```rm -rf migrations/*```
    ```symfony console doctrine:schema:drop --force```
    ```symfony console make:migration```
    ```symfony console doctrine:migrations:migrate```

  - Pour vérifier que ça marche :
    ```symfony check:requirements```
  - Pour sqlite :
     ```sqlite3 var/data.db```
    ```.tables``` devrait afficher les tables de la BDD
  - Lancer le server :
    ```symfony server:start```

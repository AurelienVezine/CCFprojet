# CCFProjet - Gestion de Zoo
Ce système de gestion de zoo pour son propriétaire propose une interface pour les visiteurs ainsi qu'une interface d'administration.
## Pour les visiteurs
### Ils pourront :
    - Voir la liste complète des animaux du zoo
    - Voir les différents habitats présent dans le zoo
    - Voir les différents service proposer par le zoo
    - Voir les différents horaires des services
    - Contacter le zoo pour toute question qui sera envoyée au zoo
    - Laisser des avis sur la page d'accueil (soumis à validation avant affichage)
### Aperçu visiteur Ecran large:
![capture acceuil site en large.](assets/imageGit/acceuillg.png)
![capture acceuil avis site en large.](assets/imageGit/avislg.png)

### Aperçu visiteur Ecran mobile:
![capture acceuil site sur mobile.](assets/imageGit/acceuilsm.png)
![capture acceuil site sur mobile.](assets/imageGit/avissm.png)

## Pour l'administration
### Elle permet au personnels de :
    - Gérer une liste d'utilisateurs (employés et vétérinaires) ayant accès à cette interface
    - Gérer les services, les animaux, les habitats et les races du zoo
    - Créer des comptes pour les utilisateurs, qui reçoivent un e-mail avec leur identifiant
    - Visualiser un graphique des animaux les plus populaires du zoo
    - Valider les avis laissés par les visiteurs avant leur publication
### Aperçu administration Ecran large:
![capture acceuil admin en large.](assets/imageGit/adminlg.png)
### Aperçu admin Ecran mobile:
![capture acceuil admin sur mobile.](assets/imageGit/adminsm.png)
![capture acceuil navAdmin sur mobile.](assets/imageGit/adminnavsm.png)
# Technologies Utilisées
    - PHP 8.3
    - Symfony 7
    - MySQL
    - MySQL Workbench
    - Composer
    - Git
    - Mailpit
# Prérequis
    - PHP 8.3
    - Symfony 7
    - MySQL
    - MySQL Workbench
    - Composer
    - Git
    - Mailpit
# Installation
## Clonez le répertoire sur votre machine locale :
    git clone https://github.com/AurelienVezine/CCFprojet.git
## Naviguez jusqu'au dossier du projet :
    cd CCFProjet
## Installez les dépendances avec Composer :
    composer install

## Créer un fichier .env.local et copier ce si pour votre base de donnée et les e-email:
    # In all environments, the following files are loaded if they exist,
    # the latter taking precedence over the former:
    #
    #  * .env                contains default values for the environment variables needed by the app
    #  * .env.local          uncommitted file with local overrides
    #  * .env.$APP_ENV       committed environment-specific defaults
    #  * .env.$APP_ENV.local uncommitted environment-specific overrides
    #
    # Real environment variables win over .env files.
    #
    # DO NOT DEFINE PRODUCTION SECRETS IN THIS FILE NOR IN ANY OTHER COMMITTED FILES.
    # https://symfony.com/doc/current/configuration/secrets.html
    #
    # Run "composer dump-env prod" to compile .env files for production use (requires symfony/flex >=1.2).
    # https://symfony.com/doc/current/best_practices.html#use-environment-variables-for-infrastructure-configuration

    ###> symfony/framework-bundle ###
    APP_ENV=dev
    APP_SECRET=f203a0f32ce5e0a159ee2b933db6c7a8
    ###< symfony/framework-bundle ###

    ###> doctrine/doctrine-bundle ###
    # Format described at https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url
    # IMPORTANT: You MUST configure your server version, either here or in config/packages/doctrine.yaml
    #
    # DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
    DATABASE_URL="mysql://root:root@127.0.0.1:3306/ccfprojet?serverVersion=8.0.32&charset=utf8mb4"
    # DATABASE_URL="mysql://app:!ChangeMe!@127.0.0.1:3306/app?serverVersion=10.11.2-MariaDB&charset=utf8mb4"
    # DATABASE_URL="postgresql://app:!ChangeMe!@127.0.0.1:5432/app?serverVersion=16&charset=utf8"
    ###< doctrine/doctrine-bundle ###

    ###> symfony/messenger ###
    # Choose one of the transports below
    # MESSENGER_TRANSPORT_DSN=amqp://guest:guest@localhost:5672/%2f/messages
    # MESSENGER_TRANSPORT_DSN=redis://localhost:6379/messages
    MESSENGER_TRANSPORT_DSN=doctrine://default?auto_setup=0
    ###< symfony/messenger ###

    ###> symfony/mailer ###
    MAILER_DSN=smtp://localhost:1025
    ###< symfony/mailer ###

    ###> doctrine/mongodb-odm-bundle ###
    MONGODB_URL=mongodb://localhost:27017
    MONGODB_DB=mongodb
    ###< doctrine/mongodb-odm-bundle ###
    
## Installation Mailpit pour Windows: 
- https://mailpit.axllent.org/docs/install/
### Penser pour windows de mettre le mailpit.exe dans le dossier .bin pour pouvoir effectuer la commande bin/mailpit et demarrer le services:
    bin/mailpit
### Pour lancer mailpit dans l'onglet le port par default est:
- http://localhost:8025/
## Créez une nouvelle base de données MySQL via MySQL Workbench et importez le fichier de base de données fourni.
Modifiez le fichier .env.local pour y ajouter vos informations de connexion à la base de données si besoin sinon garder celles deja inscrite a la creation du fichier .env.local plus haut.
### Intallation MySQL Workbench: 
- https://www.mysql.com/products/workbench/
### Creation de la base de données:
    php bin/console doctrine:database:create
cela va vous créer votre base de donner avec comme identifiant root et mp root (vous pouvez les modifier au choix)
### Importation de la base de donner:
- Dans Mysql Workbench vous allez dans votre localhost:
![capture acceuil admin en large.](assets/imageGit/localhost.png)
- Ensuite vous allez dans data Import/Restore:
![capture acceuil admin en large.](assets/imageGit/dataimport.png)
- Vous suivez les carré rouge de Haut en bas, le carré blue c'est juste si le schemas n'est pas créer vous pouvez en creer un 'ccfprojet':
- Premier carré c'est le chemin jusqu'au "fichierBDD.sql" fournie dans le dossier quand vous faite votre Git clone
- Deuxieme carré rouge c'est le schémas que la commande 'doctrine:database:create' vous a créer la dans l'exemple cest ccfprojet
- Troisième carré rouge c'est pour lancer l'importation
![capture acceuil admin en large.](assets/imageGit/startimport.png)
- Une fois l'importation terminer cela doit resembler dans votre ongler schemas à sa:
![capture acceuil admin en large.](assets/imageGit/finalbdd.png)
- Voila tout est bon pour la base de données
### Installation MongoDb
- https://www.mongodb.com/try/download/community
- En cas de probleme pour votre php.ini je vous un mis un dossier zip don Doc/... php_mongodb.dll vous devez le copier/coller dans votre dossier PHP dans ext, puis dans le 
  fichier php.ini vous devez allez créer la ligne extension=mongodb juste en dessou de celle de Mysql
# Si vous rencontrez un probleme pour le bundles je vous donne la commande a taper une fois les modification au dossier et fichier php:
    composer require doctrine/mongodb-odm-bundle  
### Creation de la base de données Mongodb:
    php bin/console doctrine:mongodb:schema:create
cela va vous créer votre base de donner MongoDB avec comme collection "Zoo".
### Importation du document.json:
Dans le dossier Doc/... vous trouverais le fichier mongodb.zoo.json vous devais l'importer dans votre collection "Zoo" qui a etait créer au paravent 

# Utilisation
Une fois l'installation terminée, vous pouvez lancer l'application avec l'un des serveurs locaux :
## Méthode n°1 : Serveur Symfony intégré :
    symfony server:start
## Méthode n°2 : Serveur PHP :
    php -S localhost:8000 -t public
Après avoir lancé l'application, vous pouvez y accéder via http://localhost:8000 (ou le port que vous avez choisi).
Vous pouvez également accéder à la version déployée en ligne à l'adresse suivante : https://arcadia.myprojet.fr/.
## Pour la connection a la partie Administration 
    - arcadia@mail.com
    - Arcadia89,
(Notez que chaque nouvel utilisateur doit obtenir son mot de passe auprès du directeur du zoo, car celui-ci n'est pas envoyé par email.)
    


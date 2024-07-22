CCFProjet - Gestion de Zoo
Ce système de gestion de zoo pour son propriétaire propose une interface pour les visiteurs ainsi qu'une interface d'administration.
Pour les visiteurs
Ils pourront :
Voir la liste complète des animaux du zoo
Voir les différents habitats présent dans le zoo
Voir les différents service proposer par le zoo
Voir les différents horaires des services
Contacter le zoo pour toute question qui sera envoyée au zoo
Laisser des avis sur la page d'accueil (soumis à validation avant affichage)
Pour l'administration
Elle permet au propriétaire de :
Gérer une liste d'utilisateurs (employés et vétérinaires) ayant accès à cette interface
Gérer les services, les animaux, les habitats et les races du zoo
Créer des comptes pour les utilisateurs, qui reçoivent un e-mail avec leur identifiant
Visualiser un graphique des animaux les plus populaires du zoo
Valider les avis laissés par les visiteurs avant leur publication
Technologies Utilisées
PHP 8.3
Symfony 7
MySQL
Composer
Git
Prérequis
PHP 8.3
Symfony 7
MySQL
Composer
Git
Installation
Clonez le répertoire sur votre machine locale :
    git clone https://github.com/AurelienVezine/CCFprojet.git
Naviguez jusqu'au dossier du projet :
    cd CCFProjet
Installez les dépendances avec Composer :
    composer install
Créez une nouvelle base de données MySQL via PhpMyAdmin ou MySQL Workbench et importez le fichier de base de données fourni.
Modifiez le fichier .env pour y ajouter vos informations de connexion à la base de données.
Utilisation
Une fois l'installation terminée, vous pouvez lancer l'application avec l'un des serveurs locaux :
Méthode n°1 : Serveur Symfony intégré :
    symfony server:start
Méthode n°2 : Serveur PHP :
    php -S localhost:8000 -t public
Après avoir lancé l'application, vous pouvez y accéder via http://localhost:8000 (ou le port que vous avez choisi).
Vous pouvez également accéder à la version déployée en ligne à l'adresse suivante : https://arcadia.myprojet.fr/.
(Notez que chaque nouvel utilisateur doit obtenir son mot de passe auprès du directeur du zoo, car celui-ci n'est pas envoyé par email.)
    


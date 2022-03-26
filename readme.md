.env
Penser à changer la variable d'environnement de APP_ENV=dev à APP_ENV=prod
DATABASE_URL="mysql://root:@127.0.0.1:3306/trtconseil?serverVersion=5.7&charset=utf8mb4"


# Commandes utilisés
symfony new --full trtconseil
php bin/console make:entity
php bin/console make:user
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:schema:update --force

Pour mise à jour d'une entité
php bin/console make:entity puis retaper le nom de cette entité

Pour mise à jour de la BDD
php bin/console doctrine:schema:update

# Configuration des routes
config/routes.yaml

# Création des controllers
php bin/console make:controller
-> HomeController
-> ArbreController

# Modification des controllers
## src/Controller/HomeController et src/Controller/ArbreController
On supprime la route par défaut (celle qui est commentée)  
On modifie la fonction INDEX
On ajoute le use App\Entity\Arbre

## ArbreController : CRUD

# On s'occupe des VUES
Création de templates/arbre/edit.html.twig
Modification de templates/arbre/index.html.twig
et tous les autres fichiers dans templates/

# Ajout de Helpers
templates/helpers/Form/_group.html.twig

# Création des formulaires
## Pour l'ARBRE
php bin/console make:form
ArbreType
Arbre

Puis modification du fichier
src/Form/ArbreType.php

## Création du formulaire d'inscription et de connexion à l'application
php bin/console make:registration-form
yes - no - no - homepage

## Création du formulaire d'authentification
php bin/console make:auth

Puis on modifie 
config/packages/security.yaml
On ajoute ces 2 lignes à access_control:
- { path: ^/(login|register), roles: IS_AUTHENTICATED_ANONYMOUSLY}
- { path: ^/, roles: IS_AUTHENTICATED_FULLY}

# Lancement de l'application
symfony serve
localhost:8000


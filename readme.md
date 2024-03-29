# Lancement de l'application
symfony serve
localhost:8000
# UTILS
> Liste des routes  
php bin/console debug:router  
> Liste des routes et controllers  
php bin/console debug:router --env=prod --show-controllers  

## Requirements
/**
* @Route("/exemple/{user}", requirements={"user": "utilisateur|administrateur"})
*/

requirements={"id"="\d+"}

### Route-Link : génération d'URL
#### TWIG 
<a href="{{ path('app_blog_post', {'_locale': 'fr', 'id': 1, '_format': 'html'}) }}">Voir le message</a>

#### CONTROLLER 
use Symfony\Component\HttpFoundation\RedirectResponse;


`$route = $this->generateUrl('app_blog_post', [
            '_locale' => 'fr', 
            'id' => 1,
            '_format' => 'html',
        ]);`

return new RedirectResponse($route)

#### RedirectToRoute
public function anotherPage(): RedirectResponse
{
    return $this->redirectToRoute('app_basic_home');
}

#### SERVICE
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

``$route = $this->generate('app_blog_post', [
            '_locale' => 'fr', 
            'id' => 1,
            '_format' => 'html',
        ]);`

#### Page 404
// Si l'id n'appartient pas au tableau messages, une HttpException est levée
        if (!isset($messages[$id])) {
            throw $this->createNotFoundException(sprintf('Le message d\'id %s n\'existe pas', $id));
        }


# Paramétrage accès BDD

.env
Penser à changer la variable d'environnement de APP_ENV=dev à APP_ENV=prod
DATABASE_URL="mysql://root:@127.0.0.1:3306/trtconseil?serverVersion=5.7&charset=utf8mb4"


# Commandes utilisés
symfony new --full trtconseil

php bin/console doctrine:database:create

php bin/console make:entity
php bin/console make:user

php bin/console make:migration
php bin/console doctrine:migrations:migrate
### MAJ BDD
php bin/console doctrine:schema:update --force

Pour mise à jour d'une entité
php bin/console make:entity puis retaper le nom de cette entité

Pour mise à jour de la BDD
php bin/console doctrine:schema:update

# Configuration des routes
config/routes.yaml ou composer require annotations

Voir la liste des routes
php bin/console debug:router

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
- { path: ^/(login|register), roles: IS_AUTHENTICATED_ANONYMOUSLY} // Déprécié ? remplacer par IS_AUTHENTICATED ou IS_AUTHENTICATED_FULLY ou PUBLIC_ACCESS ?
- { path: ^/, roles: IS_AUTHENTICATED_FULLY}

# Interface d'amdministration
composer require easycorp/easyadmin-bundle  
php bin/console make:admin:dashboard  
php bin/console make:admin:crud  


# FIXTURES - Intallation du FAKER (fausses données pour tests)

composer require orm-fixtures --dev  
php bin/console make:fixtures  
php bin/console doctrine:fixtures:load

## Bibliothèque de fixtures
composer require fzaninotto/faker --dev  
Infos ici :  
> https://github.com/fzaninotto/Faker  

# Installation du MAILER
> composer require symfony/mailer  
Sendgrid  
&A_20&V_20  
Créer une clé API sur SendGrid  
> composer require symfony/sendgrid-mailer  


# Configuration SENDMAIL depuis LocalHost
> sendmail.ini 
SMTP=smtp.gmail.com  
smtp_port=587  
> php.ini 
sendmail_from = VotreGmailId@gmail.com  
sendmail_path = "\"C:\xampp\sendmail\sendmail.exe\" -t"  

smtp_server=smtp.gmail.com  
smtp_port=587  
error_logfile=error.log  
debug_logfile=debug.log  
auth_username=VotreGmailId@gmail.com  
auth_password=Votre-MotDePasse-Gmail  
force_sender=VotreGmailId@gmail.com(optionnel)  

# Configuration de la sécurité
> composer req annotations  
> use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;  
> * @IsGranted("ROLE_ADMIN")  

# BUILD
> symfony check:requirements  
> Créer un fichier .env.local  
Une seule ligne : les infos de connexion à la BDD distante  

### Sur la console du serveur
> php bin/console doctrine:database:create  --if-not-exists
> composer install --no-dev --optimize-autoloader

#### .env.local
APP_ENV=prod
APP_DEBUG=0

> php bin/console cache:clear

On peut aussi regrouper ces 3 dernières instructions :  
APP_ENV=prod APP_DEBUG=0 php bin/console cache:clear


## Sur Heroku
Voir  
https://www.youtube.com/watch?v=yCPiX7_fy30


> heroku login  
> heroku create trtconseilprod  
> heroku open  

> heroku config:set APP_ENV=prod  (si ce n'est pas déjà fait dans le fichier .env ou .env.local)

> git push heroku master ( ou ici, main)

Ajouter un fichier procfile sur Heroku

Si besoin de vider le cache :  
> heroku run php bin/console cache:clear

### APACHE
> composer req apache-pack  
Pour le retirer  
> composer rem apache-pack  

### DataBase

> heroku addons:create heroku-postgresql:hobby-dev  
Created postgresql-silhouetted-03147 as DATABASE_URL  
Use heroku addons:docs heroku-postgresql to view documentation  








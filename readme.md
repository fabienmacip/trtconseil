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
php bin/console make:entity
php bin/console make:user
php bin/console doctrine:database:create
php bin/console make:migration
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
- { path: ^/(login|register), roles: IS_AUTHENTICATED_ANONYMOUSLY}
- { path: ^/, roles: IS_AUTHENTICATED_FULLY}

# Interface d'amdministration
composer require easycorp/easyadmin-bundle  
php bin/console make:admin:dashboard  
php bin/console make:admin:crud  


# Intallation du FAKER (fausses données pour tests)
composer require fzaninotto/faker --dev  
Infos ici :  
> https://github.com/fzaninotto/Faker  


php bin/console doctrine:fixtures:load



-------------------------------------------------------

### Ancien formulaire CONSULTANT
<form action="" method="post">
    <input type="text" name="username" placeholder="username" />
    <input type="password" name="password" placeholder="password" />
    <input type="text" name="nom" placeholder="nom" />
    <input type="text" name="prenom" placeholder="prenom" />
    <input type="text" name="roles" placeholder="roles" value="[]"/>
    <input type="text" name="role" placeholder="role" value="consultant"/>
    <button type="submit">Enregister</button>
</form>

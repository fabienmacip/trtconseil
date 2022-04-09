<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recruteur;
use App\Entity\User;
use App\Entity\Annonce;
use App\Entity\Candidature;
use App\Form\RecruteurType;
use App\Form\UserType;

use Symfony\Component\Form\Extension\Core\Type\FormType;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/* use App\Form\UserType;
use App\Entity\User; */


class RecruteurController extends AbstractController
{
    /**
     * READ
     * 
     * @Route("/recruteur/{id}", name="app_recruteur", requirements={"id"="\d+"})
     * @IsGranted("ROLE_RECRUTEUR")
     */
    public function index(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $recruteur = $em->getRepository(Recruteur::class)->findOneBy(['id'=>$id]);

        return $this->render('recruteur/index.html.twig', [
            'recruteur' => $recruteur,
        ]);
    }

   
    /**
     * UPDATE role (recruteur_tovalid / recruteur)
     * 
     * @Route("/recruteur/valider/{id}", name="recruteur_valider", requirements={"id"="\d+"})
     * @Route("/recruteur/bloquer/{id}", name="recruteur_bloquer", requirements={"id"="\d+"})
     * @IsGranted("ROLE_CONSULTANT")
     */
    public function role(Recruteur $recruteur = null, Request $request): Response
    {
            $em = $this->getDoctrine()->getManager();
            //$user = new User();
            //$user = $em->getRepository(User::class)->findOneBy(['id'=>$recruteur->getUser()->getId()]);
            
            $role = '';

            if($request->attributes->get('_route') === 'recruteur_bloquer')
            {
              $role = 'recruteur_tovalid';
              $roles = ['ROLE_RECRUTEUR_TOVALID'];
            }
            
            if($request->attributes->get('_route') === 'recruteur_valider')
            {
                $role = 'recruteur';
                $roles = ['ROLE_RECRUTEUR'];
            }

            if($role !== '') {
                $recruteur->getUser()->setRole($role);
                $recruteur->getUser()->setRoles($roles);
                $em->persist($recruteur);
                $em->flush();
            }

            return $this->redirectToRoute('recruteurs');

        } // FIN function VALIDER ou BLOQUER





    /**
     * CREATE or UPDATE
     * 
     * @Route("/recruteur/update/{id}/{back}", name="recruteur_update", requirements={"id"="\d+"})
     * @Route("/recruteur/create/", name="recruteur_create")
     * @IsGranted("ROLE_RECRUTEUR")
     */
    public function edit(Recruteur $recruteur = null, User $user = null, UserPasswordHasherInterface $userPasswordHasher,  $back='recruteurs', Request $request): Response
    {

        $em = $this->getDoctrine()->getManager();

        // Savoir si on est en MODIFICATION (edit) ou AJOUT d'un recruteur
        $editMode = true;

        if(!$recruteur) {
            $recruteur = new Recruteur();
            $editMode = false;
        }
        
        if(!$user) {
            $user = $em->getRepository(User::class)->findOneBy(['id'=>$recruteur->getUser()->getId()]);
            $editMode = false;
        } 
        
        if($request->request->get('formUser')) {
            $user->setNom($request->request->get('formUser')['nom']);
            $user->setPrenom($request->request->get('formUser')['prenom']);
            $user->setUsername($request->request->get('formUser')['username']);
            $user->setPassword($request->request->get('formUser')['password']);
            $user->setRole($request->request->get('formUser')['role']);
            
        }
        
        $recruteur->setUser($user);

        // Champs du formulaire, partie USER
        $formUser = $this->createForm(UserType::class, $user);
        /* var_dump($formUser); */
        
        $formUser = $this->get('form.factory')->createNamedBuilder('formUser',UserType::class, $user)
        /* $formUser = $this->formFactory->createNamed('formUser', UserType::class, $user) */
        /* $formUser = $this->createFormBuilder($user) */
                    /* ->add('nom')
                    ->add('prenom')
                    ->add('username')
                    ->add('password')
                    ->add('role') */
                    ->getForm();
                    
        
                
        // Champs du formulaire RECRUTEUR
         //$form = $this->createForm(RecruteurType::class, $recruteur); 
         $form = $this->createFormBuilder($recruteur)
                    ->add('entreprise_nom')
                    ->add('entreprise_adresse')
                    ->add('entreprise_code_postal')
                    ->add('entreprise_ville')
                    //->add('user')
                    ->getForm();

        $form->handleRequest($request);
        $formUser->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {


            $em->persist($recruteur);
            $em->flush();

            return $this->redirectToRoute($back);
            //return $this->render('recruteur', ['id' => $recruteur->getId()]);
        }

        if($formUser->isSubmitted() && $formUser->isValid()) {
            //var_dump("valide user");

                // SET ROLES []
                if($user->getRole() === 'recruteur') {
                    $user->setRoles(['ROLE_RECRUTEUR']);
                } else {
                    $user->setRoles(['ROLE_RECRUTEUR_TOVALID']);
                } // Fin SET ROLES []

                // encodage du password
                $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $formUser->get('password')->getData()
                    )
                );


                $em->persist($user);
                $em->flush();
    
                return $this->redirectToRoute($back);
                //return $this->render('recruteur', ['id' => $recruteur->getId()]);
            } else if (!$formUser->isSubmitted()) {
                var_dump("pas soumis");
            }
    


        return $this->render('recruteur/create.html.twig',[
            'formRecruteur' => $form->createView(),
            'formUser' => $formUser->createView(),
            'editMode' => $editMode,
            'back' => $back
        ]);



    } // FIN function create


    /**
     * DELETE
     * 
     * @Route("/recruteur_remove/{id}", name="recruteur_remove")
     * @IsGranted("ROLE_CONSULTANT")
     */
    public function remove(int $id): Response
    {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // 1. On récupère le recruteur (User) concerné
        $recruteur = $em->getRepository(Recruteur::class)->findBy(['id' => $id])[0];

        // 2. On récupère toutes les annonces du recruteur
        $annonces = $em->getRepository(Annonce::class)->findBy(['recruteur' => $recruteur]);
        
        for($i = 0 ; $i < count($annonces) ; $i++) {
                    
            // 3. On récupère toutes les candidatures à ces annonces
            $candidatures = $em->getRepository(Candidature::class)->findBy(['annonce' => $annonces[$i]]);
            for($j = 0 ; $j < count($candidatures) ; $j++) {
                $em->remove($candidatures[$j]);
                $em->flush();
            }
            $candidatures = array();

            $em->remove($annonces[$i]);
            $em->flush();
        } // FIN du for i



        // 4. Suppression du recruteur
        $em->remove($recruteur);
        $em->flush();
        $em->remove($recruteur->getUser());
        $em->flush();

        return $this->redirectToRoute('recruteurs');
        
    }


}

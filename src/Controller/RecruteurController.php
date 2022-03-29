<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recruteur;
use App\Entity\User;

class RecruteurController extends AbstractController
{
    /**
     * READ
     * 
     * @Route("/recruteur/{id}", name="app_recruteur", requirements={"id"="\d+"})
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
     */
    public function role(Recruteur $recruteur = null, Request $request): Response
    {
            $em = $this->getDoctrine()->getManager();
            $user = new User();
            $user = $em->getRepository(User::class)->findOneBy(['id'=>$recruteur->getUser()->getId()]);
            
            if($request->attributes->get('_route') === 'recruteur_bloquer')
            {
                $user->setRole('recruteur_tovalid');
            }
            
            if($request->attributes->get('_route') === 'recruteur_valider')
            {
                $user->setRole('recruteur');
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('recruteurs');

        } // FIN function VALIDER ou BLOQUER





    /**
     * CREATE or UPDATE
     * 
     * @Route("/recruteur/update/{id}", name="recruteur_update", requirements={"id"="\d+"})
     * @Route("/recruteur/create/", name="recruteur_create")
     */
    public function edit(Recruteur $recruteur = null, Request $request): Response
    {

        // Savoir si on est en MODIFICATION (edit) ou AJOUT d'un recruteur
        $editMode = true;

        if(!$recruteur) {
            $recruteur = new Recruteur();
            $editMode = false;
        }

        //$form = $this->createForm(UserType::class, $recruteur);
        $form = $this->createFormBuilder($recruteur)
                    ->add('nom')
                    ->add('prenom')
                    ->add('username')
                    ->add('password')
                    ->add('role')
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Si le recruteur n'existe pas encore, on met une date de création.
            /* if(!$recruteur->getId()){
                $recruteur->setCreatedAt(new \DateTime());
            } */

            $em = $this->getDoctrine()->getManager();
            $em->persist($recruteur);
            $em->flush();

            return $this->redirectToRoute('recruteurs');
            //return $this->render('recruteur', ['id' => $recruteur->getId()]);
        }

        return $this->render('recruteur/create.html.twig',[
            'formRecruteur' => $form->createView(),
            'editMode' => $editMode
        ]);



    } // FIN function create


    /**
     * DELETE
     * 
     * @Route("/recruteur_remove/{id}", name="recruteur_remove")
     */
    public function remove(int $id): Response
    {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère le recruteur (User) concerné
        $recruteur = $em->getRepository(Recruteur::class)->findBy(['id' => $id])[0];

        // Suppression de l'arbre
        $em->remove($recruteur);
        $em->flush();

        return $this->redirectToRoute('recruteurs');
        
    }


}

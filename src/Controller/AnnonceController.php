<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextAreaType;
use App\Entity\Annonce;
use App\Entity\Candidature;
use App\Entity\Candidat;
use App\Entity\Recruteur;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
class AnnonceController extends AbstractController
{
    /**
     * READ
     * 
     * @Route("/annonce/{id}", name="app_annonce", requirements={"id"="\d+"})
     * @IsGranted("ROLE_CANDIDAT")
     */
    public function index(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository(Annonce::class)->findOneBy(['id'=>$id]);

/*         $recruteur = $em->getRepository(Recruteur::class)->find($annonce->getRecruteur()->getId()); */

        $candidatures = $em->getRepository(Candidature::class)->findBy(['annonce' => $annonce]);

        /* Ajout d'un candidat fictif pour pouvoir tester le bouton POSTULER A UNE ANNONCE */
        $candidatFictif = $em->getRepository(Candidat::class)->find('37');
//        $candidatFictif = $candidats[0];

        return $this->render('annonce/index.html.twig', [
            'annonce' => $annonce,
            /* 'recruteur' => $recruteur, */
            'candidatures' => $candidatures,
            'candidat' => $candidatFictif,
        ]);
    }

   
    /**
     * UPDATE validation (0/1) 0 = A valider // 1 = Validée
     * 
     * @Route("/annonce/valider/{id}", name="annonce_valider", requirements={"id"="\d+"})
     * @Route("/annonce/bloquer/{id}", name="annonce_bloquer", requirements={"id"="\d+"})
     * @IsGranted("ROLE_RECRUTEUR")
     */
    public function role(Annonce $annonce = null, Request $request): Response
    {
            $em = $this->getDoctrine()->getManager();
            
            $validation = 0;

            if($request->attributes->get('_route') === 'annonce_bloquer')
            {
              $validation = 0;
            }
            
            if($request->attributes->get('_route') === 'annonce_valider')
            {
                $validation = 1;
            }

            if($validation !== '') {
                $annonce->setValidation($validation);
                $em->persist($annonce);
                $em->flush();
            }

            return $this->redirectToRoute('annonces');

        } // FIN function VALIDER ou BLOQUER





    /**
     * CREATE or UPDATE
     * 
     * @Route("/annonce/update/{id}", name="annonce_update", requirements={"id"="\d+"})
     * @Route("/annonce/create/{recruteur}", name="annonce_create", requirements={"recruteur"="\d+"})
     * @IsGranted("ROLE_RECRUTEUR")
     */
    public function edit(Annonce $annonce = null, Request $request, int $recruteur = 0): Response
    {
        
        $em = $this->getDoctrine()->getManager();

        // Savoir si on est en MODIFICATION (edit) ou AJOUT d'un annonce
        $editMode = true;

        if(!$annonce || $request->attributes->get("_route") === "annonce_create") {
            $annonce = new Annonce();

            // *******************************************************************
            // TROUVER LE RECRUTEUR qui est connecté !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
            // *******************************************************************
            $recruteurObjet = $em->getRepository(Recruteur::class)->find($recruteur);
            $annonce->setRecruteur($recruteurObjet);
            
            $editMode = false;
        } 

        //$form = $this->createForm(UserType::class, $annonce);
        $form = $this->createFormBuilder($annonce)
                    ->add('intitule')
                    ->add('poste')
                    ->add('ville')
                    ->add('description')
                    ->getForm();

                    /* , TextareaType::class, [
                        'attr' => array('cols' => '5', 'rows' => '5')]                     */

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Si l'annonce n'existe pas encore, on met une date de création.
             if(!$annonce->getId()){
                $annonce->setDate(new \DateTime());
                $annonce->setValidation(false);
            } 

            $em->persist($annonce);
            $em->flush();

            //unset($annonce);
            //unset($recruteurObjet);

            return $this->redirectToRoute('annonces');
            //return $this->render('annonce', ['id' => $recruteur->getId()]);
        }

        return $this->render('annonce/create.html.twig',[
            'formAnnonce' => $form->createView(),
            'editMode' => $editMode
        ]);



    } // FIN function create


    /**
     * DELETE
     * 
     * @Route("/annonce_remove/{id}", name="annonce_remove")
     * @IsGranted("ROLE_RECRUTEUR")
     */
    public function remove(int $id): Response
    {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère le annonce (User) concerné
        $annonce = $em->getRepository(Annonce::class)->findBy(['id' => $id])[0];

        // 1. Suppression de toutes les candidatures à cette annonce
        $candidatures = $em->getRepository(Candidature::class)->findBy(['annonce' => $annonce]);

        for($i = 0 ; $i < count($candidatures) ; $i++) {
            $em->remove($candidatures[$i]);
            $em->flush();
        }

        // 2. Suppression de l'annonce
        $em->remove($annonce);
        $em->flush();

        return $this->redirectToRoute('annonces');
        
    }

}

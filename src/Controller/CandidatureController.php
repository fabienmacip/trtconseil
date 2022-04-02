<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Candidature;
use App\Entity\Candidat;
use App\Entity\Annonce;
use App\Form\CandidatureType;

class CandidatureController extends AbstractController
{
    /**
     * @Route("/candidature", name="app_candidature")
     */
    public function index(): Response
    {
        return $this->render('candidature/index.html.twig', [
            'controller_name' => 'CandidatureController',
        ]);
    }

    /**
     * CREATE or UPDATE
     * 
     * @Route("/candidature/create/{annonce}/{candidat}", name="candidature_create", requirements={"annonce"="\d+","candidat"="\d+"})
     */
    public function createOnly(Request $request, int $annonce, int $candidat): Response
    {

        $candidature = new Candidature();
        
        $em = $this->getDoctrine()->getManager();
            
        $annonceObjet = $em->getRepository(Annonce::class)->find($annonce);
        
        // *******************************************************************
        // TROUVER LE CANDIDAT qui est connecté !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // *******************************************************************
        $candidatObjet = $em->getRepository(Candidat::class)->find($candidat);

   /*      $validation = 0; */

/*         if($request->attributes->get('_route') === 'annonce_bloquer')
        {
          $validation = 0;
        }
        
        if($request->attributes->get('_route') === 'annonce_valider')
        {
            $validation = 1;
        } */

        /* if($validation !== '') { */
            $candidature->setAnnonce($annonceObjet);
            $candidature->setCandidat($candidatObjet);
            $em->persist($candidature);
            $em->flush();
        /* } */

        return $this->redirectToRoute('annonces');
        /* /all.html.twig',[
            'annonce' => $annonceObjet,
            'candidat' => $candidatObjet
        ]); */

    } // FIN function create


}

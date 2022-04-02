<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Candidat;


class CandidatController extends AbstractController
{
    /**
     * READ
     * 
     * @Route("/candidat/{id}", name="app_candidat", requirements={"id"="\d+"})
     * @Route("/candidat/{id}/{annonce}", name="app_candidat_annonce", requirements={"id"="\d+"})
     */
    public function index(int $id, int $annonce = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository(Candidat::class)->findOneBy(['id'=>$id]);

        return $this->render('candidat/index.html.twig', [
            'candidat' => $candidat,
            'annonce' => $annonce
        ]);
    }

   
    /**
     * UPDATE role (candidat_tovalid / candidat)
     * 
     * @Route("/candidat/valider/{id}", name="candidat_valider", requirements={"id"="\d+"})
     * @Route("/candidat/bloquer/{id}", name="candidat_bloquer", requirements={"id"="\d+"})
     */
    public function role(Candidat $candidat = null, Request $request): Response
    {
            $em = $this->getDoctrine()->getManager();
            
            $role = '';

            if($request->attributes->get('_route') === 'candidat_bloquer')
            {
              $role = 'candidat_tovalid';
            }
            
            if($request->attributes->get('_route') === 'candidat_valider')
            {
                $role = 'candidat';
            }

            if($role !== '') {
                $candidat->getUser()->setRole($role);
                $em->persist($candidat);
                $em->flush();
            }

            return $this->redirectToRoute('candidats');

        } // FIN function VALIDER ou BLOQUER


    /**
     * CREATE or UPDATE
     * 
     * @Route("/candidat/update/{id}", name="candidat_update", requirements={"id"="\d+"})
     * @Route("/candidat/create/", name="candidat_create")
     */
    public function edit(Candidat $candidat = null, Request $request): Response
    {
            return $this->redirectToRoute('candidats');
    } // FIN function create ou update



    /**
     * DELETE
     * 
     * @Route("/candidat_remove/{id}", name="candidat_remove")
     */
    public function remove(int $id): Response
    {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère le candidat (User) concerné
        $candidat = $em->getRepository(Candidat::class)->findBy(['id' => $id])[0];

        // Suppression de l'arbre
        $em->remove($candidat);
        $em->flush();
        $em->remove($candidat->getUser());
        $em->flush();

        return $this->redirectToRoute('candidats');
        
    }


}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Recruteur;
use App\Entity\Candidat;
use App\Entity\Annonce;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     * @Route("/", name="racine")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/admins", name="admins")
     */
    public function allAdmins(): Response
    {
        // On récupère l'Entity Manager de Symfony
        //---$this->doctrine;
        $em = $this->getDoctrine()->getManager();
        //$consultants = $em->getRepository(User::class)->findAll();
        $admins = $em->getRepository(User::class)->findBy(['role' => 'admin']);

        return $this->render('admin/all.html.twig', [
            'admins' => $admins,
        ]);
    }


    /**
     * @Route("/consultants", name="consultants")
     */
    public function allConsultants(): Response
    {
        // On récupère l'Entity Manager de Symfony
        //---$this->doctrine;
        $em = $this->getDoctrine()->getManager();
        //$consultants = $em->getRepository(User::class)->findAll();
        $consultants = $em->getRepository(User::class)->findBy(['role' => 'consultant']);

        return $this->render('consultant/all.html.twig', [
            'consultants' => $consultants,
        ]);
    }


    /**
     * @Route("/recruteurs", name="recruteurs")
     */
    public function allRecruteurs(): Response
    {
        // On récupère l'Entity Manager de Symfony
        //---$this->doctrine;
        $em = $this->getDoctrine()->getManager();
        
        $liste = $em->getRepository(Recruteur::class)->findAll();

        return $this->render('recruteur/all.html.twig', [
            'recruteurs' => $liste
        ]); 
    }

    /**
     * @Route("/candidats", name="candidats")
     */
    public function allCandidats(): Response
    {
        // On récupère l'Entity Manager de Symfony
        //---$this->doctrine;
        $em = $this->getDoctrine()->getManager();
        
        $liste = $em->getRepository(Candidat::class)->findAll();

        return $this->render('candidat/all.html.twig', [
            'candidats' => $liste
        ]); 
    }


    /**
     * @Route("/annonces", name="annonces")
     */
    public function allAnnonces(): Response
    {


        // On récupère l'Entity Manager de Symfony
        //---$this->doctrine;
        $em = $this->getDoctrine()->getManager();
        $resultatMail = isset($_SESSION["resultat_mail"])? $_SESSION["resultat_mail"] : "";
        $liste = $em->getRepository(Annonce::class)->findAll();

        return $this->render('annonce/all.html.twig', [
            'annonces' => $liste,
            'mailok' => $resultatMail
        ]); 
    }



} // FIN de la classe



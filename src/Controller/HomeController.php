<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Recruteur;
use App\Entity\Candidat;
use App\Entity\Annonce;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

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
     * @IsGranted("ROLE_ADMIN")
     */
    public function allAdmins(): Response
    {
        // On récupère l'Entity Manager de Symfony
        //---$this->doctrine;
        $em = $this->getDoctrine()->getManager();
        //$consultants = $em->getRepository(User::class)->findAll();
        $adminsValidated = $em->getRepository(User::class)->findBy(['role' => 'admin']);
        $adminsLocked = $em->getRepository(User::class)->findBy(['role' => 'admin_tovalid']);

        return $this->render('admin/all.html.twig', [
            'admins' => $adminsValidated,
            'admins_locked' => $adminsLocked
        ]);
    }


    /**
     * @Route("/consultants", name="consultants")
     * @IsGranted("ROLE_CONSULTANT")
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
     * @IsGranted("ROLE_CONSULTANT")
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
     * @IsGranted("ROLE_CANDIDAT")
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
     * @IsGranted("ROLE_CANDIDAT")
     */
    public function allAnnonces(): Response
    {


        // On récupère l'Entity Manager de Symfony
        //---$this->doctrine;
        $em = $this->getDoctrine()->getManager();
        $resultatMail = isset($_SESSION["resultat_mail"])? $_SESSION["resultat_mail"] : "";
        
        // Si le USER est RECRUTEUR, on n'affiche que SES annonces
         if($this->getUser()->getRole() === 'recruteur'){
             
            $recruteur = $em->getRepository(Recruteur::class)->findOneBy(['user'=>$this->getUser()->getId()]);
            $liste = $em->getRepository(Annonce::class)->findBy(['recruteur'=>$recruteur->getId()]);
        } else {
            $liste = $em->getRepository(Annonce::class)->findAll();
        }
        



        return $this->render('annonce/all.html.twig', [
            'annonces' => $liste,
            'mailok' => $resultatMail
        ]); 
    }



} // FIN de la classe



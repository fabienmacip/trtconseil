<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Recruteur;
use App\Entity\Candidat;
use App\Entity\Candidature;
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
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($this->getUser());
        
        if($user->getRole() === 'admin' || $user->getRole() === 'admin_tovalid'){
            return $this->render('admin/index.html.twig', [
                'admin' => $user,
                'back' => 'home'
            ]);
        } else if ($user->getRole() === 'consultant' || $user->getRole() === 'consultant_tovalid'){
            return $this->render('consultant/index.html.twig', [
                'consultant' => $user,
                'back' => 'home'
            ]);
        } else if ($user->getRole() === 'recruteur' || $user->getRole() === 'recruteur_tovalid'){
            $recruteur = $em->getRepository(Recruteur::class)->findBy(['user' => $user])[0];
            return $this->render('recruteur/index.html.twig', [
                'recruteur' => $recruteur,
                'back' => 'home'
            ]);
        } else if ($user->getRole() === 'candidat' || $user->getRole() === 'candidat_tovalid'){
            $candidat = $em->getRepository(Candidat::class)->findBy(['user' => $user])[0];
            return $this->render('candidat/index.html.twig', [
                'candidat' => $candidat,
                'back' => 'home'
            ]);
        } else {
            return $this->render('home/index.html.twig', [
                'controller_name' => 'HomeController',
                'user' => $user
            ]);

        }

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
        // Si le USER est CANDIDAT, on n'affiche que les annonces VALIDES et on indique celles où il a déjà postulé
        $recruteurId = 0;
        $candidatId = 0;
        $dejaPostule = [];
         if($this->getUser()->getRole() === 'recruteur'){
             
            $recruteur = $em->getRepository(Recruteur::class)->findOneBy(['user'=>$this->getUser()->getId()]);
            $recruteurId = $recruteur->getId();
            $liste = $em->getRepository(Annonce::class)->findBy(['recruteur'=>$recruteur->getId()]);
            
        } elseif($this->getUser()->getRole() === 'candidat'){
            $liste = $em->getRepository(Annonce::class)->findBy(['validation' => '1']);
            $candidat = $em->getRepository(Candidat::class)->findOneBy(['user'=>$this->getUser()->getId()]);
            $candidatId = $candidat->getId();
            $dejaPostuleObjects = $em->getRepository(Candidature::class)->findBy(['candidat' => $candidat]);
            
            for ($dj = 0 ; $dj < count($dejaPostuleObjects) ; $dj++) {
                array_push($dejaPostule,$dejaPostuleObjects[$dj]->getAnnonce()->getId());
            }

            //$dejaPostule = $dejaPostuleArray[0]->getAnnonce()->getId();

        } else{
            $liste = $em->getRepository(Annonce::class)->findAll();
        }
        



        return $this->render('annonce/all.html.twig', [
            'annonces' => $liste,
            'mailok' => $resultatMail,
            'id_recruteur' => $recruteurId,
            'id_candidat' => $candidatId,
            'deja_postule' => $dejaPostule
        ]); 
    }



} // FIN de la classe



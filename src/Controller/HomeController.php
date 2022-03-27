<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
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

} // FIN de la classe


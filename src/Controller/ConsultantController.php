<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultantController extends AbstractController
{
    /**
     * @Route("/consultant", name="app_consultant")
     */
    public function index(): Response
    {
        return $this->render('consultant/index.html.twig', [
            'controller_name' => 'ConsultantController',
        ]);
    }

    /**
     * @Route("/consultants", name="app_consultants")
     */
    public function allConsultants(): Response
    {
        $consultants = [
            [
                'nom' => 'DURAND',
                'prenom' => 'Julien'
            ],
            [
                'nom' => 'FUSTINO',
                'prenom' => 'Marc'
            ],
        ];

        return $this->render('consultant/all.html.twig', [
            'consultants' => $consultants,
        ]);
    }

}

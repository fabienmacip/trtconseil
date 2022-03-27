<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultantController extends AbstractController
{
    /**
     * @Route("/consultant/{id}", name="app_consultant")
     */
    public function index(int $id): Response
    {
        if($id == 1) {
            $consultant = (object) [
                'username'=>"fatabien@gmail.com",
                'nom'=>'Macip',
                'prenom'=>'Fabien',
                'id'=>38
            ];
        }
        else {
            $consultant = (object) [
                'username'=>"tartanpion@yahoo.fr",
                'nom'=>'DE TARASCON',
                'prenom'=>'Tartarin',
                'id'=>154
            ];
        }


        return $this->render('consultant/index.html.twig', [
            'consultant' => $consultant,
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

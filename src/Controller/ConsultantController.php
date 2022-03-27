<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConsultantController extends AbstractController
{
    /**
     * @Route("/consultant/{id}", name="app_consultant", requirements={"id"="\d+"})
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
     * CREATE
     * 
     * @Route("/consultant/create/", name="consultant_create")
     * @Route("/consultant/update/{id}", name="consultant_update", requirements={"id"="\d+"})
     */
    public function edit(User $consultant = null, Request $request): Response
    {

                // Si la requête contient des données, donc ok pour création
                /*         if($request->request->count() > 0) {
                            $consultant = new User();
                            $consultant->setNom($request->request->get('nom'))
                                        ->setPrenom($request->request->get('prenom'))
                                        ->setUsername($request->request->get('username'))
                                        ->setPassword($request->request->get('password'))   
                                        ->setRole($request->request->get('role'))
                                        ->setRoles([]);
                            //setCreatedAd(new \DateTime());

                            $em = $this->getDoctrine()->getManager();

                            $em->persist($consultant);
                            $em->flush();

                            return $this->redirectToRoute('consultants');
                        }
                */
        
        // Savoir si on est en MODIFICATION (edit) ou AJOUT d'un consultant
        $editMode = true;

        if(!$consultant) {
            $consultant = new User();
            $editMode = false;
        }

        $form = $this->createFormBuilder($consultant)
                    ->add('nom')
                    ->add('prenom')
                    ->add('username')
                    ->add('password')
                    ->add('role')
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Si le consultant n'existe pas encore, on met une date de création.
            /* if(!$consultant->getId()){
                $consultant->setCreatedAt(new \DateTime());
            } */

            $em = $this->getDoctrine()->getManager();
            $em->persist($consultant);
            $em->flush();

            return $this->redirectToRoute('consultants');
            //return $this->render('consultant', ['id' => $consultant->getId()]);
        }

        return $this->render('consultant/create.html.twig',[
            'formConsultant' => $form->createView(),
            'editMode' => $editMode
        ]);



    } // FIN function create






    /**
     * DELETE
     * 
     * @Route("/consultant_remove/{id}", name="consultant_remove")
     */
    public function remove(int $id): Response
    {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère le consultant (User) concerné
        $consultant = $em->getRepository(User::class)->findBy(['id' => $id])[0];

        // Suppression de l'arbre
        $em->remove($consultant);
        $em->flush();

        return $this->redirectToRoute('consultants');
        
    }


} // FIN de la classe


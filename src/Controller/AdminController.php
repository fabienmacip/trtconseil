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

class AdminController extends AbstractController
{
    /**
     * READ
     * 
     * @Route("/admin/{id}", name="app_admin", requirements={"id"="\d+"})
     */
    public function index(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository(User::class)->findOneBy(['id'=>$id]);

        return $this->render('admin/index.html.twig', [
            'admin' => $admin,
        ]);
    }




    /**
     * CREATE or UPDATE
     * 
     * @Route("/admin/create/", name="admin_create")
     * @Route("/admin/update/{id}", name="admin_update", requirements={"id"="\d+"})
     */
    public function edit(User $admin = null, Request $request): Response
    {

        // Savoir si on est en MODIFICATION (edit) ou AJOUT d'un consultant
        $editMode = true;

        if(!$admin) {
            $admin = new User();
            $editMode = false;
        }

        //$form = $this->createForm(UserType::class, $admin);
        $form = $this->createFormBuilder($admin)
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
            $em->persist($admin);
            $em->flush();

            return $this->redirectToRoute('admins');
            
        }

        return $this->render('admin/create.html.twig',[
            'formAdmin' => $form->createView(),
            'editMode' => $editMode
        ]);



    } // FIN function create


    /**
     * DELETE
     * 
     * @Route("/admin_remove/{id}", name="admin_remove")
     */
    public function remove(int $id): Response
    {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère le consultant (User) concerné
        $admin = $em->getRepository(User::class)->findBy(['id' => $id])[0];

        // Suppression de l'arbre
        $em->remove($admin);
        $em->flush();

        return $this->redirectToRoute('admins');
        
    }


} // FIN de la classe


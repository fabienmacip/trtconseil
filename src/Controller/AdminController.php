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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends AbstractController
{
    /**
     * READ
     * 
     * @Route("/admin/{id}", name="app_admin", requirements={"id"="\d+"})
     * @IsGranted("ROLE_ADMIN")
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
     * UPDATE role (admin_tovalid / admin)
     * 
     * @Route("/admin/valider/{id}", name="admin_valider", requirements={"id"="\d+"})
     * @Route("/admin/bloquer/{id}", name="admin_bloquer", requirements={"id"="\d+"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function role(User $admin = null, Request $request): Response
    {
            $em = $this->getDoctrine()->getManager();
            
            $role = '';

            if($request->attributes->get('_route') === 'admin_bloquer')
            {
              $role = 'admin_tovalid';
              $roles = ['ROLE_ADMIN_TOVALID'];
            }
            
            if($request->attributes->get('_route') === 'admin_valider')
            {
                $role = 'admin';
                $roles = ['ROLE_ADMIN'];
            }

            if($role !== '') {
                $admin->setRole($role);
                $admin->setRoles($roles);
                $em->persist($admin);
                $em->flush();
            }

            return $this->redirectToRoute('admins');

        } // FIN function VALIDER ou BLOQUER



    /**
     * CREATE or UPDATE
     * 
     * @Route("/admin/create/", name="admin_create")
     * @Route("/admin/update/{id}/{back}", name="admin_update", requirements={"id"="\d+"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(User $admin = null, Request $request, $back = 'admins'): Response
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

            return $this->redirectToRoute($back);
            
        }

        return $this->render('admin/create.html.twig',[
            'formAdmin' => $form->createView(),
            'editMode' => $editMode,
            'back' => $back
        ]);



    } // FIN function create


    /**
     * DELETE
     * 
     * @Route("/admin_remove/{id}", name="admin_remove")
     * @IsGranted("ROLE_ADMIN")
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


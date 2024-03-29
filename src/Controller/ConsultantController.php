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
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ConsultantController extends AbstractController
{
    /**
     * READ
     * 
     * @Route("/consultant/{id}", name="app_consultant", requirements={"id"="\d+"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(int $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $consultant = $em->getRepository(User::class)->findOneBy(['id'=>$id, 'role'=>'consultant']);

        return $this->render('consultant/index.html.twig', [
            'consultant' => $consultant,
        ]);
    }




    /**
     * CREATE or UPDATE
     * 
     * @Route("/consultant/create/", name="consultant_create")
     * @Route("/consultant/update/{id}/{back}", name="consultant_update", requirements={"id"="\d+"})
     * @IsGranted("ROLE_CONSULTANT")
     */
    public function edit(User $consultant = null, UserPasswordHasherInterface $userPasswordHasher, $back = 'consultants', Request $request): Response
    {

        // Savoir si on est en MODIFICATION (edit) ou AJOUT d'un consultant
        $editMode = true;

        if(!$consultant) {
            $consultant = new User();
            $editMode = false;
            $consultant->setRoles(['ROLE_CONSULTANT']);
        }

        //$form = $this->createForm(UserType::class, $consultant);
        $form = $this->createFormBuilder($consultant)
                    ->add('nom')
                    ->add('prenom')
                    ->add('username')
                    ->add('password')
/*                     ->add('password_confirm') */
                    ->add('role')
                    ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Si le consultant n'existe pas encore, on met une date de création.
            /* if(!$consultant->getId()){
                $consultant->setCreatedAt(new \DateTime());
            } */

            // SET ROLES []
            if($consultant->getRole() === 'consultant') {
                $consultant->setRoles(['ROLE_CONSULTANT']);
            } else {
                $consultant->setRoles(['ROLE_CONSULTANT_TOVALID']);
            } // Fin SET ROLES []
            // encodage du password
            $consultant->setPassword(
                $userPasswordHasher->hashPassword(
                        $consultant,
                        $form->get('password')->getData()
                    )
                );
    
/*                 $consultant->setPasswordConfirm(
                    $userPasswordHasher->hashPassword(
                            $consultant,
                            $form->get('password_confirm')->getData()
                        )
                    ); */
            // FIN de l'encodage du PASSWORD    


            $em = $this->getDoctrine()->getManager();
            $em->persist($consultant);
            $em->flush();

            return $this->redirectToRoute($back);
            //return $this->render('consultant', ['id' => $consultant->getId()]);
        }

        return $this->render('consultant/create.html.twig',[
            'formConsultant' => $form->createView(),
            'editMode' => $editMode,
            'back' => $back
        ]);



    } // FIN function create


    /**
     * DELETE
     * 
     * @Route("/consultant_remove/{id}", name="consultant_remove")
     * @IsGranted("ROLE_ADMIN")
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


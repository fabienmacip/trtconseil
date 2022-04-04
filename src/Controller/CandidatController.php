<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Candidat;
use App\Entity\User;
use App\Form\CandidatType;
use App\Form\UserType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

use Symfony\Component\HttpFoundation\File\UploadedFile;


class CandidatController extends AbstractController
{
    /**
     * READ
     * 
     * @Route("/candidat/{id}", name="app_candidat", requirements={"id"="\d+"})
     * @Route("/candidat/{id}/{annonce}", name="app_candidat_annonce", requirements={"id"="\d+"})
     */
    public function index(int $id, int $annonce = null): Response
    {
        $em = $this->getDoctrine()->getManager();
        $candidat = $em->getRepository(Candidat::class)->findOneBy(['id'=>$id]);

        return $this->render('candidat/index.html.twig', [
            'candidat' => $candidat,
            'annonce' => $annonce
        ]);
    }

   
    /**
     * UPDATE role (candidat_tovalid / candidat)
     * 
     * @Route("/candidat/valider/{id}", name="candidat_valider", requirements={"id"="\d+"})
     * @Route("/candidat/bloquer/{id}", name="candidat_bloquer", requirements={"id"="\d+"})
     */
    public function role(Candidat $candidat = null, Request $request): Response
    {
            $em = $this->getDoctrine()->getManager();
            
            $role = '';

            if($request->attributes->get('_route') === 'candidat_bloquer')
            {
              $role = 'candidat_tovalid';
            }
            
            if($request->attributes->get('_route') === 'candidat_valider')
            {
                $role = 'candidat';
            }

            if($role !== '') {
                $candidat->getUser()->setRole($role);
                $em->persist($candidat);
                $em->flush();
            }

            return $this->redirectToRoute('candidats');

        } // FIN function VALIDER ou BLOQUER


    /**
     * EDIT (UPDATE)
     * 
     * @Route("/candidat/update/{id}", name="candidat_update", requirements={"id"="\d+"})
     * @Route("/candidat/create/", name="candidat_create")
     */
    public function edit(Candidat $candidat = null, User $user = null, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();

        // Savoir si on est en MODIFICATION (edit) ou AJOUT d'un candidat
        $editMode = true;

        if(!$candidat) {
            $candidat = new Candidat();
            $editMode = false;
        }
        
        if(!$user) {
            $user = $em->getRepository(User::class)->findOneBy(['id'=>$candidat->getUser()->getId()]);
            $editMode = false;
        } 
        
        if($request->request->get('formUser')) {
            $user->setNom($request->request->get('formUser')['nom']);
            $user->setPrenom($request->request->get('formUser')['prenom']);
            $user->setUsername($request->request->get('formUser')['username']);
            $user->setPassword($request->request->get('formUser')['password']);
            $user->setRole($request->request->get('formUser')['role']);
            
        }
        
        $candidat->setUser($user);
        
        // Concaténation du chemin de téléchargement configuré avec le nom de fichier stocké et création d'une nouvelle classe File.
        if($candidat->getCv() !== null){
            
            $candidat->setCv(
                /* new File($this->getParameter('cv_directory').'/'.$candidat->getCv()) */
                ($candidat->getCv())
            );
        }
        

        // Champs du formulaire, partie USER
        $formUser = $this->createForm(UserType::class, $user);
        /* var_dump($formUser); */
        
        $formUser = $this->get('form.factory')->createNamedBuilder('formUser',UserType::class, $user)
                        ->getForm();
                    
        
                
        // Champs du formulaire CANDIDAT (CV uniquement)
         $form = $this->createFormBuilder($candidat)
                    ->add('cv', FileType::class, array('data_class' => null))
                    ->getForm();

        $form->handleRequest($request);
        $formUser->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Traitement du fichier PDF du CV
            
            // Récupération des données du formulaire
            $file = $form['cv']->getData();

            if($file && $file->guessExtension() === 'pdf'){

                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                //$safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $safeFilename = "";
                $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

                // Move the file to the directory where CV are stored
                try {
                $file->move(
                    $this->getParameter('cv_directory'),
                    $newFilename
                );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'cvFilename' property to store the PDF file name
                // instead of its contents
                $candidat->setCv($newFilename);

                $em->persist($candidat);
                $em->flush();
            } // FIN du IF($file)


            return $this->redirectToRoute('candidats');
            //return $this->render('candidat', ['id' => $candidat->getId()]);
        } // FIN du IF formulaire CV validé

        if($formUser->isSubmitted() && $formUser->isValid()) {
            var_dump("valide user");
                $em->persist($user);
                $em->flush();
    
                return $this->redirectToRoute('candidats');
                //return $this->render('candidat', ['id' => $candidat->getId()]);
            } else if (!$formUser->isSubmitted()) {
                var_dump("pas soumis");
            }
    


        return $this->render('candidat/create.html.twig',[
            'formCandidat' => $form->createView(),
            'formUser' => $formUser->createView(),
            'editMode' => $editMode
        ]);


    } // FIN function EDIT



    /**
     * DELETE
     * 
     * @Route("/candidat_remove/{id}", name="candidat_remove")
     */
    public function remove(int $id): Response
    {
        // Entity manager de Symfony
        $em = $this->getDoctrine()->getManager();
        // On récupère le candidat (User) concerné
        $candidat = $em->getRepository(Candidat::class)->findBy(['id' => $id])[0];

        // Suppression de l'arbre
        $em->remove($candidat);
        $em->flush();
        $em->remove($candidat->getUser());
        $em->flush();

        return $this->redirectToRoute('candidats');
        
    }


}

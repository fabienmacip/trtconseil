<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Candidature;
use App\Entity\Candidat;
use App\Entity\Annonce;
use App\Form\CandidatureType;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class CandidatureController extends AbstractController
{
    /**
     * @Route("/candidature", name="app_candidature")
     */
    public function index(): Response
    {
        return $this->render('candidature/index.html.twig', [
            'controller_name' => 'CandidatureController',
        ]);
    }

    /**
     * CREATE or UPDATE
     * 
     * @Route("/candidature/create/{annonce}/{candidat}", name="candidature_create", requirements={"annonce"="\d+","candidat"="\d+"})
     */
    public function createOnly(Request $request, int $annonce, int $candidat): Response
    {

        $candidature = new Candidature();
        
        $em = $this->getDoctrine()->getManager();
            
        $annonceObjet = $em->getRepository(Annonce::class)->find($annonce);
        
        // *******************************************************************
        // TROUVER LE CANDIDAT qui est connecté !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        // *******************************************************************
        $candidatObjet = $em->getRepository(Candidat::class)->find($candidat);

        $candidature->setAnnonce($annonceObjet);
        $candidature->setCandidat($candidatObjet);
        $em->persist($candidature);
        $em->flush();

        // ************* MAIL *********************
        $mailRecruteur = $annonceObjet->getRecruteur()->getUser()->getUsername();
        $nom = $candidatObjet->getUser()->getNom();
        $prenom = $candidatObjet->getUser()->getPrenom();

        $mailEnvoye = mail($mailRecruteur, $nom, $prenom);
        if($mailEnvoye) {
            $resultat_mail = 'Mail envoyé OK';
        }else
        {
            $resultat_mail = 'Mail non envoyé - Erreur';
        }
        $_SESSION["resultat_mail"] = $resultat_mail;
        // ************* MAIL - FIN *********************


        return $this->redirectToRoute('annonces');

    } // FIN function create

    public function mail($mailRecruteur = 'fabien.macip@gmail.com', $nom = 'MACIP', $prenom = 'Fabien', MailerInterface $mailer)
    {
        /* ini_set("SMTP", "smtp.sendgrid.net");
        ini_set('smtp_port','587'); */
        $email = (new Email())
            ->from('fabien.macip@gmail.com')
            ->to($mailRecruteur)
            ->subject('Candidature à une annonce')
            ->text('Votre annonce a un nouveau candidat, il s\'agit de '.$nom.' '.$prenom.'.')
            ->html('<p>This is the HTML version</p>')
        ;
        $mailer->send($email);
        return true;

        //return $this->redirectToRoute('annonces');
/*         return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);  */
    } // FIN function mail

}

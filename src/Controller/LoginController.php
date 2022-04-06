<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
        
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): Response
    {
        //session_start();
        session_destroy();
        return $this->redirectToRoute('login'); 
        //return  new RedirectResponse($this->urlGenerator->generate('login'));
        //return $this->redirectToRoute('app_login');
        //return $this->render('security/login.html.twig', ['last_username' => '', 'error' => '']);

        //throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

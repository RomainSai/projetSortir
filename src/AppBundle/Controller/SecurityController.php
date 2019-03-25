<?php
/**
 * Created by PhpStorm.
 * User: rsaillou2018
 * Date: 20/03/2019
 * Time: 15:04
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils){
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('participant/login.html.twig', ['error'=>$error, 'lastUsername'=>$lastUsername]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction(){

    }
}
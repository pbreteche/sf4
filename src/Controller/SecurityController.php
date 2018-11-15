<?php
/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 15/11/18
 * Time: 11:49
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route("/login")
     */
    public function login(AuthenticationUtils $auth)
    {
        return $this->render('Security/login.html.twig', [
            'error' => $auth->getLastAuthenticationError(),
            'username' => $auth->getLastUsername(),
        ]);
    }

    /**
     * @Route("/login_check")
     * @throws \Exception
     */
    public function check()
    {
        throw new \Exception('Cette méthode ne doit pas être appelée, la route doit être interceptée par le composant «Security»');
    }

    /**
     * @Route("/logout")
     * @throws \Exception
     */
    public function logout()
    {
        throw new \Exception('Cette méthode ne doit pas être appelée, la route doit être interceptée par le composant «Security»');
    }
}
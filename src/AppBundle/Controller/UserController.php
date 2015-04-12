<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\User;

class UserController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function loginCheckAction()
    {
        // this action will not be executed,
        // as the route is handled by the Security system
    }

/**
 * @Route("/register", name="register")
 */
public function registerAction()
{
    $user = new User();
    $user->setName('Fulano');
    $user->setEmail('fulano@email.com');
    $user->setPassword('123');

    $em = $this->getDoctrine()->getManager();
    $em->persist($user);
    $em->flush();

    return $this->redirectToRoute('login');
}
}

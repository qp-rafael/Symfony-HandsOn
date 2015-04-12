<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CheckoutController extends Controller
{
    /**
     * @Route("/checkout", name="checkout")
     */
    public function indexAction(Request $request)
    {
        $session = $request->getSession();
        $cart = $session->get('cart');
        if (!$cart || $cart->count() == 0) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('checkout/index.html.twig');
    }

    /**
     * @Route("/success", name="success")
     */
    public function successAction(Request $request){
        $session = $request->getSession();
        $cart = $session->get('cart');
        if (!$cart || $cart->count() == 0) {
            return $this->redirectToRoute('homepage');
        }

        $user = $this->getUser();

        $message = \Swift_Message::newInstance()
            ->setSubject('Merci Commerce: Pedido realizado com sucesso!')
            ->setFrom('atendimento@merci.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'checkout/email.txt.twig',
                    array('user' => $user, 'cart' => $cart)
                ));

        $this->get('mailer')->send($message);

        $session->remove('cart');

        return $this->render('checkout/success.html.twig');

    }
}

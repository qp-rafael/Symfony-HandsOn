<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CheckoutController extends Controller
{
    /**
     * @Route("/checkout", name="checkout")
     */
    public function indexAction()
    {
        return $this->render('checkout/index.html.twig');
    }
}

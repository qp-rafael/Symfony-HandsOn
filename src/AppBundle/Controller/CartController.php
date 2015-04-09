<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class CartController extends Controller
{
    /**
     * @Route("/cart", name="cart")
     */
    public function indexAction()
    {
        return $this->render('cart/index.html.twig');
    }
}

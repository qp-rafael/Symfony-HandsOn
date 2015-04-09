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

    /**
     * @Route("/cart/add/{id}", name="cart_add", requirements={"id": "\d+"})
     */
    public function addAction($id)
    {
        return $this->render('cart/index.html.twig');
    }

    /**
     * @Route("/cart/delete/{id}", name="cart_delete", requirements={"id": "\d+"})
     */
    public function deleteAction($id)
    {
        return $this->render('cart/index.html.twig');
    }

    /**
     * @Route("/cart/update", name="cart_update")
     */
    public function updateAction()
    {
        return $this->render('cart/index.html.twig');
    }
}

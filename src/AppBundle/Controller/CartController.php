<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Cart;

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
public function addAction(Request $request, $id)
{
    $product = $this->getDoctrine()
        ->getRepository('AppBundle:Product')
        ->findOneById($id);

    if (!$product) {
        $this->addFlash('notice', 'Produto não existe');
        return $this->redirectToRoute('cart');
    }

    $session = $request->getSession();
    $cart = $session->get('cart', new Cart());
    $cart->add($product);
    $session->set('cart', $cart);

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

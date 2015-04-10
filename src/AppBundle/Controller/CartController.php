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
    public function indexAction(Request $request)
    {
        $content = 'cart/index.html.twig';

        $session = $request->getSession();
        $cart = $session->get('cart');
        if (!$cart || $cart->count() == 0) {
            $content = 'cart/empty.html.twig';
        }

        return $this->render($content);
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
            return $this->redirectAndNotify('Produto não existe!');
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
    public function deleteAction(Request $request, $id)
    {
        $session = $request->getSession();
        $cart = $session->get('cart');
        if ($cart && $cart->count() > 0) {
            $id = (int) $id;
            $cart->delete($id);
            $session->set('cart', $cart);
        }

        return $this->redirectAndNotify('Produto removido!');
    }

    /**
     * @Route("/cart/update", name="cart_update")
     */
    public function updateAction(Request $request)
    {
        $id = (int) $request->query->get('id');
        $quantity = $request->query->get('quantity');

        if (!$id || !$quantity) {
            return $this->redirectAndNotify('Não foi possivel atualizar o carrinho');
        }

        $session = $request->getSession();
        $cart = $session->get('cart');
        if ($cart && $cart->count() > 0) {
            $cart->update($id, $quantity);
            $session->set('cart', $cart);
        }

        return $this->redirectAndNotify('Produto atualizado!');
    }

    private function redirectAndNotify($message=null)
    {
        if ($message) {
            $this->addFlash('notice', $message);
        }

        return $this->redirectToRoute('cart');
    }
}

<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findAll();

        if (empty($products)) {
            throw $this->createNotFoundException('No products avaiable');
        }

        return $this->render('default/index.html.twig',
            array('products' => $products)
        );
    }

/**
 * @Route("/product/{id}", name="product", requirements={"id": "\d+"})
 */
public function productAction($id)
{
    $product = $this->getDoctrine()
        ->getRepository('AppBundle:Product')
        ->findOneById($id);

    if (!$product) {
        throw $this->createNotFoundException('No product found with id: ' . $id);
    }

    return $this->render('default/product.html.twig',
        array('product' => $product)
    );
}
}

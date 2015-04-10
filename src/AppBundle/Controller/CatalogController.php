<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class CatalogController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('catalog/index.html.twig');
    }

    /**
     * @Route("/product", name="product")
     */
    public function productAction()
    {
        return $this->render('catalog/product.html.twig');
    }
}

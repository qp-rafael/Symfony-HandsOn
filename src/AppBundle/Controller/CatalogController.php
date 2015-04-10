<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class CatalogController extends Controller
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

        return $this->render('catalog/index.html.twig',
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

        return $this->render('catalog/product.html.twig',
            array('product' => $product)
        );
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $find = $request->query->get('find');

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery('
                SELECT p
                FROM AppBundle:Product p
                WHERE p.name LIKE :find
            ')->setParameter('find', '%'.$find.'%');

        $products = $query->getResult();

        if (!$products) {
            $this->addFlash('notice',
                'Nenhum resultado encontrado para pesquisa: '.$find);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle:Default:index.html.twig',
            array('products' => $products, 'find' => $find)
        );
    }
}

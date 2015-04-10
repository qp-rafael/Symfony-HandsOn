<?php

namespace AppBundle\Tests\Entity;

use AppBundle\Entity\Cart;

class CartTest extends \PHPUnit_Framework_TestCase
{
    public function testCartQuantity()
    {
        $product = $this->getMockBuilder('AppBundle\Entity\Product')
            ->setMethods(array('getId'))
            ->getMock();
        $product->method('getId')->willReturn(1);
        $product->setPrice(10);

        $cart = new Cart();
        $cart->add($product);

        $this->assertEquals(1, $cart->getQuantity());
        $this->assertEquals(10, $cart->getTotal());
    }
}

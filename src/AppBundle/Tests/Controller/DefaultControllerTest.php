<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isSuccessful(),
            'Not path to "/". Someone must be notified?');
    }

    public function testProduct()
    {
        $client = static::createClient();

        $client->request('GET', '/product');

        $this->assertTrue($client->getResponse()->isSuccessful(),
            'No path to "/product". Someone must be notified?');
    }
}

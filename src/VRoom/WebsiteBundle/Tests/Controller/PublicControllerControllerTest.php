<?php

namespace VRoom\WebsiteBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicControllerControllerTest extends WebTestCase
{
    public function testHome()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');
    }

    public function testUser()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/user');
    }

}

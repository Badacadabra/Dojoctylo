<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LearnControllerTest extends WebTestCase
{
    public function testAdvice()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/apprendre/conseils');
    }

    public function testTutorials()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/apprendre/tutoriels');
    }

    public function testErgonomics()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/apprendre/ergonomie');
    }

}

<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FightControllerTest extends WebTestCase
{
    public function testTest()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/affronter/test');
    }

    public function testChallenge()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/affronter/defi');
    }

    public function testTournament()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/affronter/tournoi');
    }

}

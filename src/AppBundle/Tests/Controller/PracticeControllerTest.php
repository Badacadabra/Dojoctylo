<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PracticeControllerTest extends WebTestCase
{
    public function testBasics()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/bases');
    }

    public function testDigrams()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/digrammes');
    }

    public function testTrigrams()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/trigrammes');
    }

    public function testWords()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/mots');
    }

    public function testSentences()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/phrases');
    }

    public function testNumbers()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/nombres');
    }

    public function testTexts()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/textes');
    }

    public function testCode()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/code');
    }

    public function testCustom()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/pratiquer/sur-mesure');
    }

}

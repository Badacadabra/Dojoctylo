<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FightController extends Controller
{
    /**
     * @Route("/affronter/test", name="fight_test")
     */
    public function testAction()
    {
        return $this->render(':fight:test.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/affronter/defi", name="fight_challenge")
     */
    public function challengeAction()
    {
        return $this->render(':fight:challenge.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/affronter/tournoi", name="fight_tournament")
     */
    public function tournamentAction()
    {
        return $this->render(':fight:tournament.html.twig', array(
            // ...
        ));
    }
}

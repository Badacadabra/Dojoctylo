<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LearnController extends Controller
{
    /**
     * @Route("/apprendre/conseils", name="advice")
     */
    public function adviceAction()
    {
        return $this->render(':learn:advice.html.twig');
    }

    /**
     * @Route("/apprendre/tutoriels", name="tutorials")
     */
    public function tutorialsAction()
    {
        return $this->render(':learn:tutorials.html.twig');
    }

    /**
     * @Route("/apprendre/ergonomie", name="ergonomics")
     */
    public function ergonomicsAction()
    {
        return $this->render(':learn:ergonomics.html.twig');
    }
}

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
     * @Route("/apprendre/tutoriels/{id}", name="show_tutorial")
     */
    public function showTutorialAction($id)
    {
        switch ($id) {
            case 1:
                return $this->render(':learn:tutorial-1.html.twig');
                break;
            case 2:
                return $this->render(':learn:tutorial-2.html.twig');
                break;
            case 3:
                return $this->render(':learn:tutorial-3.html.twig');
                break;
            default:
                return $this->render(':learn:tutorials.html.twig');
        }
    }

    /**
     * @Route("/apprendre/ergonomie", name="ergonomics")
     */
    public function ergonomicsAction()
    {
        return $this->render(':learn:ergonomics.html.twig');
    }
}

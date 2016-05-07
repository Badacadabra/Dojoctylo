<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render(':main:index.html.twig');
    }

    /**
     * @Route("/apprendre", name="learn")
     */
    public function learnAction()
    {
        return $this->render(':main:learn.html.twig');
    }

    /**
     * @Route("/pratiquer", name="practice")
     */
    public function practiceAction()
    {
        return $this->render(':main:practice.html.twig');
    }

    /**
     * @Route("/affronter", name="fight")
     */
    public function fightAction()
    {
        return $this->render(':main:fight.html.twig');
    }

    /**
     * @Route("/mentions-legales", name="legal_notice")
     */
    public function legalNoticeAction()
    {
        return $this->render(':main:legal_notice.html.twig');
    }

    /**
     * @Route("/faq", name="faq")
     */
    public function faqAction()
    {
        return $this->render(':main:faq.html.twig');
    }

    /**
     * @Route("/sitemap", name="sitemap")
     */
    public function sitemapAction()
    {
        return $this->render(':main:sitemap.html.twig');
    }
}

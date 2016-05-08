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
     * @Route("/authentification", name="auth")
     */
    public function authAction()
    {
        return $this->render(':main:auth.html.twig');
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
     * @Route("/recompenses", name="trophies")
     */
    public function trophiesAction()
    {
        return $this->render(':main:trophies.html.twig');
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
     * @Route("/plan-du-site", name="sitemap")
     */
    public function sitemapAction()
    {
        return $this->render(':main:sitemap.html.twig');
    }

    /**
     * @Route("/classement", name="ranking")
     */
    public function rankingAction()
    {
        return $this->render(':main:ranking.html.twig');
    }

    /**
     * @Route("/profil/{username}", name="profile")
     */
    public function profileAction($username)
    {
        return $this->render(':main:profile.html.twig', array(
            'username' => $username 
        ));
    }
}

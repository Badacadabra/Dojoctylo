<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class PracticeController extends Controller
{
    /**
     * @Route("/pratiquer/bases", name="practice_basics")
     */
    public function basicsAction()
    {
        return $this->render(':practice:basics.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/digrammes", name="practice_digrams")
     */
    public function digramsAction()
    {
        return $this->render(':practice:digrams.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/trigrammes", name="practice_trigrams")
     */
    public function trigramsAction()
    {
        return $this->render(':practice:trigrams.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/mots", name="practice_words")
     */
    public function wordsAction()
    {
        return $this->render(':practice:words.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/phrases", name="practice_sentences")
     */
    public function sentencesAction()
    {
        return $this->render(':practice:sentences.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/nombres", name="practice_numbers")
     */
    public function numbersAction()
    {
        return $this->render(':practice:numbers.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/textes", name="practice_texts")
     */
    public function textsAction()
    {
        return $this->render(':practice:texts.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/code", name="practice_code")
     */
    public function codeAction()
    {
        return $this->render(':practice:code.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/sur-mesure", name="practice_custom")
     */
    public function customAction()
    {
        return $this->render(':practice:custom.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/pratiquer/sur-mesure/ajouter", name="add_practice_custom")
     */
    public function addCustomAction()
    {

    }

    /**
     * @Route("/pratiquer/sur-mesure/supprimer", name="remove_practice_custom")
     */
    public function removeCustomAction()
    {

    }

    /**
     * @Route("/pratiquer/sur-mesure/gerer", name="manage_practice_custom")
     */
    public function manageCustomAction()
    {
        return $this->render(':practice:manage_custom.html.twig', array(
            // ...
        ));
    }
}

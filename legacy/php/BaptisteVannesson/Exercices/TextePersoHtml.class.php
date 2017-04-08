<?php
namespace BaptisteVannesson\Exercices;

class TextePersoHtml
{
    public static function afficherListe($textesPerso)
    {
        $template = "ui/templates/gestionExercices.tpl.php";

        ob_start();
            require_once($template);
            $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
    
    public static function chargerFormulaire($idExercice, $infosExercice, $contenuExercice, $difficulteExercice)
    {
        $template = "ui/templates/modifExercice.tpl.php";

        ob_start();
            require_once($template);
            $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}

<?php
namespace BaptisteVannesson\Exercices;

class ExerciceHtml
{
    public static function chargerInterface($page, $mode, $pseudo=null)
    {
        if ($page == "pratiquer" && $mode == "custom") {
            $template = "ui/templates/exercicePerso.tpl.php";
        } else if ($page == "pratiquer" && $mode != "custom") {
            $template = "ui/templates/exercice.tpl.php";
        } else if ($page == "affronter" && $mode == "solo") {
            $template = "ui/templates/exercice.tpl.php";
        } else if($page == "affronter" && ($mode == "prive" || $mode == "public")) {
            $template = "ui/templates/competition.tpl.php";
        } else {
            $template = "ui/templates/exercice.tpl.php";
        }
        
        ob_start();
            require_once($template);
            $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }

    public static function chargerScript($page, $mode)
    {
        if ($page == "pratiquer" && $mode == "custom") {
            $script = file_get_contents("fragments/scripts/exercicePerso.frg.html");
        } else if ($page == "pratiquer" && $mode != "custom") {
            $script = file_get_contents("fragments/scripts/exercice.frg.html");
        } else if ($page == "affronter" && $mode == "solo") {
            $script = file_get_contents("fragments/scripts/test.frg.html");
        } else {
            $script = file_get_contents("fragments/scripts/competition.frg.html");
        }
        return $script;
    }
}

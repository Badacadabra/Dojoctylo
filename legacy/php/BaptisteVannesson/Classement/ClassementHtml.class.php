<?php
namespace BaptisteVannesson\Classement;

class ClassementHtml
{
    public static function chargerTemplate($classementVitesse, $classementActivite)
    {
        $template = "ui/templates/classement.tpl.php";

        ob_start();
            require_once($template);
            $html = ob_get_contents();
        ob_end_clean();

        return $html;
    }
}

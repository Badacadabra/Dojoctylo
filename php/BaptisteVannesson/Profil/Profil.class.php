<?php
namespace BaptisteVannesson\Profil;

class Profil
{
    public static function requeteGravatar($auth)
    {
        $email = trim($auth->getMail());
        $email = strtolower($email);
        $hash = md5($email);
        $url = "http://www.gravatar.com/avatar/" . $hash . "?s=100";
        return $url;
    }

    public static function lireVitesse($scores)
    {
        for ($i = 0; $i < 10; $i++) {
            if (isset($scores[$i])) {
                $vitesse[] = $scores[$i]->getVitesse();
            } else {
                $vitesse[] = 0;
            }
        }
        return $vitesse;
    }

    public static function lirePrecision($scores)
    {
        for ($i = 0; $i < 10; $i++) {
            if (isset($scores[$i])) {
                $precision[] = $scores[$i]->getPrecision();
            } else {
                $precision[] = 0;
            }
        }
        return $precision;
    }
}

<?php
namespace BaptisteVannesson\Utils\Chiffrement;

class ChiffrementMdp
{
    public static function chiffrer($mdp)
    {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        return $hash;
    }

    public static function mdpValide($mdp, $hash)
    {
        if(password_verify($mdp, $hash)) {
            return true;
        } else {
            return false;
        }
    }

    /* public static function testOptimalCost($mdp)
    {
        $timeTarget = 0.05; // 50 millisecondes

        $cost = 8;
        do {
            $cost++;
            $start = microtime(true);
            password_hash($mdp, PASSWORD_DEFAULT, ["cost" => $cost]);
            $end = microtime(true);
        } while (($end - $start) < $timeTarget);

        echo "Valeur de 'cost' la plus appropriée : " . $cost . "\n";
    } */
}

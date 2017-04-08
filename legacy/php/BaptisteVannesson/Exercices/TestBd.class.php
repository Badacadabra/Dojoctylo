<?php
namespace BaptisteVannesson\Exercices;

use BaptisteVannesson\Utils\Bd\ConnexionBd;

class TestBd
{
    public static function enregistrer(Test $test)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'INSERT INTO Test (scoreVitesse, scorePrecision, date, id_membre) VALUES (:scoreVitesse, :scorePrecision, CURDATE(), :id_membre)';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':scoreVitesse', $test->getVitesse());
        $stmt->bindValue(':scorePrecision', $test->getPrecision());
        $stmt->bindValue(':id_membre', $test->getIdMembre());
        $stmt->execute();
    }
}

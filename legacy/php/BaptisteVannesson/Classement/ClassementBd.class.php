<?php
namespace BaptisteVannesson\Classement;

use BaptisteVannesson\Utils\Bd\ConnexionBd;

class ClassementBd
{
    public static function classementVitesse($reqDate)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT M.id, M.pseudo, MAX(T.scoreVitesse) AS records
                        FROM Test AS T INNER JOIN Membre AS M ON T.id_membre = M.id' . $reqDate . 'GROUP BY M.id ORDER BY records DESC LIMIT 100';
        $stmt = $connexion->query($requete);
        $membresRapides = array();
        while(($data = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $membresRapides[] = array('id' => $data['id'], 'pseudo' => $data['pseudo'], 'scoreVitesse' => $data['records']);
        }
        return $membresRapides;
    }

    public static function classementActivite($reqDate)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT M.id, M.pseudo, COUNT(M.pseudo) AS nbTests
                        FROM Test AS T INNER JOIN Membre AS M ON T.id_membre = M.id' . $reqDate  . 'GROUP BY M.id ORDER BY nbTests DESC LIMIT 100';
        $stmt = $connexion->query($requete);
        $membresActifs = array();
        while(($data = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $membresActifs[] = array('id' => $data['id'], 'pseudo' => $data['pseudo'], 'nbTests' => $data['nbTests']);
        }
        return $membresActifs;
    }
}

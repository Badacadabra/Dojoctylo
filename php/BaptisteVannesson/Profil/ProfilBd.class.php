<?php
namespace BaptisteVannesson\Profil;

use BaptisteVannesson\Utils\Bd\ConnexionBd;
use BaptisteVannesson\Exercices\Test;
use BaptisteVannesson\Recompenses\Recompense;

class ProfilBd
{
    public static function modifierInfos($auth)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'UPDATE Membre SET pseudo = :pseudo,
                                      mail = :mail,
                                      motDePasse = :motDePasse,
                                      description = :description
                                  WHERE id = :id';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':pseudo', $auth->getPseudo());
        $stmt->bindValue(':mail', $auth->getMail());
        $stmt->bindValue(':motDePasse', $auth->getMotDePasse());
        $stmt->bindValue(':description', $auth->getDescription());
        $stmt->bindValue(':id', $auth->getId());
        $stmt->execute();
    }

    public static function pseudoExistant($pseudo)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT pseudo FROM Membre WHERE pseudo = :pseudo';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':pseudo', $pseudo);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!isset($data) || empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    public static function mailExistant($mail)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT mail FROM Membre WHERE mail = :mail';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!isset($data) || empty($data)) {
            return false;
        } else {
            return true;
        }
    }

    public static function nombreTests($auth)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT COUNT(*) AS nbTests FROM Test WHERE id_membre = :id_membre';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id_membre', $auth->getId());
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (isset($data) && !empty($data)) {
            return $data['nbTests'];
        }
    }
    
    public static function meilleurScore($auth)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT MAX(scoreVitesse) AS meilleurScore FROM Test WHERE id_membre = :id_membre';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id_membre', $auth->getId());
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (isset($data) && !empty($data)) {
            return $data['meilleurScore'];
        }
    }

    public static function derniersScores($auth)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT * FROM Test WHERE id_membre = :id_membre ORDER BY id DESC LIMIT 10';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id_membre', $auth->getId());
        $stmt->execute();
        $scores = array();
        while (($data = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $scores[] = new Test(
                $data['id'],
                $data['scoreVitesse'],
                $data['scorePrecision'],
                $data['date'],
                $data['id_membre']
            );
        }
        return $scores;
    }

    public static function listeRecompenses($auth)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT * FROM Recompense AS R INNER JOIN Obtention AS O ON R.id = O.id_recompense WHERE id_membre = :id_membre';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id_membre', $auth->getId());
        $stmt->execute();
        $recompenses = array();
        while (($data = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $recompenses[] = new Recompense(
                $data['id'],
                $data['categorie'],
                $data['nom'],
                $data['description'],
                $data['urlImage']
            );
        }
        return $recompenses;
    }
}

<?php
namespace BaptisteVannesson\Recompenses;

use BaptisteVannesson\Utils\Bd\ConnexionBd;

class RecompenseBd
{
    public static function attributionRecompense($idMembre, $idRecompense)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'INSERT INTO Obtention VALUES (:id_membre, :id_recompense, NOW())';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id_membre', $idMembre);
        $stmt->bindValue(':id_recompense', $idRecompense);
        $stmt->execute();
    }
    
    public static function recompenseAttribuee($idMembre, $idRecompense)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT * FROM Obtention WHERE id_membre = :id_membre AND id_recompense = :id_recompense';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id_membre', $idMembre);
        $stmt->bindValue(':id_recompense', $idRecompense);
        $stmt->execute();
        $data = $stmt->fetch();
        if (isset($data) && !empty($data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public static function infosRecompense($id)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'SELECT * FROM Recompense WHERE id = :id';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        while (($data = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $recompense = new Recompense(
                $data['id'],
                $data['categorie'],
                $data['nom'],
                $data['description'],
                $data['urlImage']
            );
        }
        return $recompense;
    }
}

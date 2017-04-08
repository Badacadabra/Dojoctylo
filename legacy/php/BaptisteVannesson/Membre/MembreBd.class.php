<?php
namespace BaptisteVannesson\Membre;

use BaptisteVannesson\Utils\Bd\ConnexionBd;

class MembreBd
{
    public static function listeMembres()
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'SELECT * FROM Membre';
        $stmt = $connexion->query($requete);
        $membres = array();
        while(($data = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $membres[] = new Membre(
                $data['id'],
                $data['pseudo'],
                $data['mail'],
                $data['motDePasse'],
                $data['description'],
                $data['dateInscription'],
                $data['nbConnexions'],
                $data['tempsEntrainement'],
                $data['nbFilleuls']
            );
        }
        return $membres;
    }

    public static function infosMembre($id)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'SELECT * FROM Membre WHERE id = :id';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (isset($data) && !empty($data)) {
            $membre = new Membre(
                $data['id'],
                $data['pseudo'],
                $data['mail'],
                $data['motDePasse'],
                $data['description'],
                $data['dateInscription'],
                $data['nbConnexions'],
                $data['tempsEntrainement'],
                $data['nbFilleuls']
            );
            return $membre;
        }
    }
    
    public static function setTempsEntrainement($tempsEntrainement, $id)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'UPDATE Membre SET tempsEntrainement = :tempsEntrainement WHERE id = :id';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':tempsEntrainement', $tempsEntrainement);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}

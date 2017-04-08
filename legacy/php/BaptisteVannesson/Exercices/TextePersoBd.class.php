<?php
namespace BaptisteVannesson\Exercices;

use BaptisteVannesson\Utils\Bd\ConnexionBd;

class TextePersoBd
{
    public static function enregistrer(TextePerso $textePerso, $idMembre)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete = 'INSERT INTO Texte_perso (infos, contenu, difficulte, id_membre)
                                VALUES (:infos, :contenu, :difficulte, :id_membre)';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':infos', $textePerso->getInfos());
        $stmt->bindValue(':contenu', $textePerso->getContenu());
        $stmt->bindValue(':difficulte', $textePerso->getDifficulte());
        $stmt->bindValue(':id_membre', $idMembre);
        $stmt->execute();
    }
    
    public static function lireListeTextes()
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'SELECT * FROM Texte_perso';
        $stmt = $connexion->query($requete);
        $textesPerso = array();
        while(($data = $stmt->fetch(\PDO::FETCH_ASSOC)) !== false) {
            $textesPerso[] = new TextePerso(
                $data['id'],
                $data['infos'],
                $data['contenu'],
                $data['difficulte']
            );
        }
        return $textesPerso;
    }
    
    public static function lireTexte($id)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'SELECT * FROM Texte_perso WHERE id = :id';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (isset($data) && !empty($data)) {
            $textePerso = new TextePerso(
                $data['id'],
                $data['infos'],
                $data['contenu'],
                $data['difficulte']
            );
            return $textePerso;
        }
    }
    
    public static function modifier($textePerso)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'UPDATE Texte_perso SET infos = :infos,
                                             contenu = :contenu,
                                             difficulte = :difficulte
                                          WHERE id = :id';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':infos', $textePerso->getInfos());
        $stmt->bindValue(':contenu', $textePerso->getContenu());
        $stmt->bindValue(':difficulte', $textePerso->getDifficulte());
        $stmt->bindValue(':id', $textePerso->getId());
        $stmt->execute();
    }
    
    public static function supprimer($id)
    {
        $connexion = ConnexionBd::getInstance()->getConnexion();
        $requete   = 'DELETE FROM Texte_perso WHERE id = :id';
        $stmt = $connexion->prepare($requete);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }
}

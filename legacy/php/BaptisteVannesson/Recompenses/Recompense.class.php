<?php
namespace BaptisteVannesson\Recompenses;

class Recompense
{
    private $id;
    private $categorie;
    private $nom;
    private $description;
    private $urlImage;
    
    // Débutant
    const ID_BAMBOU = 1;
    const ID_BONSAI = 2;
    const ID_BOLVIDE = 3;
    const ID_SOUPEMISO = 4;
    const ID_SUSHI = 5;
    // Entraînement
    const ID_NUNCHAKU = 6;
    const ID_SHURIKEN = 7;
    const ID_TANTO = 8;
    const ID_SAI = 9;
    const ID_KATANA = 10;
    // Vitesse
    const ID_KARATEKA = 11;
    const ID_ESPION = 12;
    const ID_GUERRIER = 13;
    const ID_ASSASSIN = 14;
    const ID_LEGENDE = 15;
    // Compétition
    const ID_DEFENSE = 16;
    const ID_DUEL = 17;
    const ID_MELEE = 18;
    const ID_PLUIEDESHURIKENS = 19;
    const ID_REVOLUTION = 20;
    // Prestige
    const ID_NINJAVOLANT = 21;
    const ID_RESEAUNINJA = 22;
    const ID_SUPERSTAR = 23;
    const ID_SHAMAN = 24;
    const ID_MAITREDRAGON = 25;

    public function __construct($id, $categorie, $nom, $description, $urlImage)
    {
        $this->id = $id;
        $this->categorie = $categorie;
        $this->nom = $nom;
        $this->description = $description;
        $this->urlImage = $urlImage;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getUrlImage()
    {
        return $this->urlImage;
    }

    public function setUrlImage($urlImage)
    {
        $this->urlImage = $urlImage;
    }
}

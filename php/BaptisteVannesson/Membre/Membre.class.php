<?php
namespace BaptisteVannesson\Membre;

class Membre
{
    private $id;
    private $pseudo;
    private $mail;
    private $motDePasse;
    private $description;
    private $dateInscription;
    private $nbConnexions;
    private $tempsEntrainement;
    private $nbFilleuls;

    public function __construct($id,
                                $pseudo,
                                $mail,
                                $motDePasse,
                                $description,
                                $dateInscription,
                                $nbConnexions,
                                $tempsEntrainement,
                                $nbFilleuls
    ) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->motDePasse = $motDePasse;
        $this->description = $description;
        $this->dateInscription = $dateInscription;
        $this->nbConnexions = $nbConnexions;
        $this->tempsEntrainement = $tempsEntrainement;
        $this->nbFilleuls = $nbFilleuls;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    public function getNbConnexions()
    {
        return $this->nbConnexions;
    }

    public function setNbConnexions($nbConnexions)
    {
        $this->nbConnexions = $nbConnexions;
    }

    public function getTempsEntrainement()
    {
        return $this->tempsEntrainement;
    }

    public function setTempsEntrainement($tempsEntrainement)
    {
        $this->tempsEntrainement = $tempsEntrainement;
    }

    public function getNbFilleuls()
    {
        return $this->nbFilleuls;
    }

    public function setNbFilleuls($nbFilleuls)
    {
        $this->nbFilleuls = $nbFilleuls;
    }
}

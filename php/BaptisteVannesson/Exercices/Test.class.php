<?php
namespace BaptisteVannesson\Exercices;

class Test
{
    private $id;
    private $vitesse;
    private $precision;
    private $date;
    private $idMembre;

    public function __construct($id, $vitesse, $precision, $date, $idMembre)
    {
        $this->id = $id;
        $this->vitesse = $vitesse;
        $this->precision = $precision;
        $this->date = $date;
        $this->idMembre = $idMembre;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getVitesse()
    {
        return $this->vitesse;
    }

    public function setVitesse($vitesse)
    {
        $this->vitesse = $vitesse;
    }

    public function getPrecision()
    {
        return $this->precision;
    }

    public function setPrecision($precision)
    {
        $this->precision = $precision;
    }
    
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getIdMembre()
    {
        return $this->idMembre;
    }

    public function setIdMembre($idMembre)
    {
        $this->idMembre = $idMembre;
    }
}

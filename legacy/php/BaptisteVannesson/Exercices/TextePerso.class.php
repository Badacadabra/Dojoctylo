<?php
namespace BaptisteVannesson\Exercices;

class TextePerso
{
    private $id;
    private $infos;
    private $contenu;
    private $difficulte;
    
    public function __construct($id, $infos, $contenu, $difficulte)
    {
        $this->id = $id;
        $this->infos = $infos;
        $this->contenu = $contenu;
        $this->difficulte = $difficulte;
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getInfos()
    {
        return $this->infos;
    }

    public function setInfos($infos)
    {
        $this->infos = $infos;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function getDifficulte()
    {
        return $this->difficulte;
    }

    public function setDifficulte($difficulte)
    {
        $this->difficulte = $difficulte;
    }
}

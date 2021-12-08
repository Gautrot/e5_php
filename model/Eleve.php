<?php

class Eleve extends Utilisateur
{
    private $idEleve, $ref_classe, $idUtil;

// constructeur

    public function __construct(array $donnees)
    {
        parent::__construct($donnees);
        $this->hydrate($donnees);
    }

//Fonction Hydrate

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }

    /**
     * @return mixed
     */
    public function getIdEleve()
    {
        return $this->idEleve;
    }

    /**
     * @param mixed $idEleve
     */
    public function setIdEleve($idEleve): void
    {
        $this->idEleve = $idEleve;
    }

    /**
     * @return mixed
     */
    public function getRefClasse()
    {
        return $this->ref_classe;
    }

    /**
     * @param mixed $ref_classe
     */
    public function setRefClasse($ref_classe): void
    {
        $this->ref_classe = $ref_classe;
    }

    /**
     * @return mixed
     */
    public function getIdUtil()
    {
        return $this->idUtil;
    }

    /**
     * @param mixed $idUtil
     */
    public function setIdUtil($idUtil): void
    {
        $this->idUtil = $idUtil;
    }
}
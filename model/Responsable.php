<?php

class Responsable extends Parents
{
    private $idResponsable, $idParent, $idEleve;

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
    public function getIdResponsable()
    {
        return $this->idResponsable;
    }

    /**
     * @param mixed $idResponsable
     */
    public function setIdResponsable($idResponsable): void
    {
        $this->idResponsable = $idResponsable;
    }

    /**
     * @return mixed
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * @param mixed $idParent
     */
    public function setIdParent($idParent): void
    {
        $this->idParent = $idParent;
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
}
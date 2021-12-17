<?php

class InscriptionEvent extends Evenement
{
    private $idInscription, $idEleve, $idParent, $idProf, $idEvent;

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
    public function getIdInscription()
    {
        return $this->idInscription;
    }

    /**
     * @param mixed $idInscription
     */
    public function setIdInscription($idInscription): void
    {
        $this->idInscription = $idInscription;
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
    public function getIdProf()
    {
        return $this->idProf;
    }

    /**
     * @param mixed $idProf
     */
    public function setIdProf($idProf): void
    {
        $this->idProf = $idProf;
    }

    /**
     * @return mixed
     */
    public function getIdEvent()
    {
        return $this->idEvent;
    }

    /**
     * @param mixed $idEvent
     */
    public function setIdEvent($idEvent): void
    {
        $this->idEvent = $idEvent;
    }

}
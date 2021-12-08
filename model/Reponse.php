<?php

class Reponse extends Discussion
{
    private $idReponse, $reponse, $dateCreation, $idDiscussion, $idCreateurEleve, $idCreateurProf;

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
    public function getIdReponse()
    {
        return $this->idReponse;
    }

    /**
     * @param mixed $idReponse
     */
    public function setIdReponse($idReponse): void
    {
        $this->idReponse = $idReponse;
    }

    /**
     * @return mixed
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * @param mixed $reponse
     */
    public function setReponse($reponse): void
    {
        $this->reponse = $reponse;
    }

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation): void
    {
        $this->dateCreation = $dateCreation;
    }

    /**
     * @return mixed
     */
    public function getIdDiscussion()
    {
        return $this->idDiscussion;
    }

    /**
     * @param mixed $idDiscussion
     */
    public function setIdDiscussion($idDiscussion): void
    {
        $this->idDiscussion = $idDiscussion;
    }

    /**
     * @return mixed
     */
    public function getIdCreateurEleve()
    {
        return $this->idCreateurEleve;
    }

    /**
     * @param mixed $idCreateurEleve
     */
    public function setIdCreateurEleve($idCreateurEleve): void
    {
        $this->idCreateurEleve = $idCreateurEleve;
    }

    /**
     * @return mixed
     */
    public function getIdCreateurProf()
    {
        return $this->idCreateurProf;
    }

    /**
     * @param mixed $idCreateurProf
     */
    public function setIdCreateurProf($idCreateurProf): void
    {
        $this->idCreateurProf = $idCreateurProf;
    }
}
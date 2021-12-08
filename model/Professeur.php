<?php

class Professeur extends Utilisateur
{
    private $idProf, $matiere, $idUtil;

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
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * @param mixed $matiere
     */
    public function setMatiere($matiere): void
    {
        $this->matiere = $matiere;
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
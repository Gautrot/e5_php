<?php

class Evenement
{
    private $idEvent, $titre, $description, $type = 'Interne', $date, $horaire, $dateCreation, $validEvent = 0, $idCreateurEleve, $idCreateurParent, $idCreateurProf;

// constructeur

    public function __construct(array $donnees)
    {
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

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getHoraire()
    {
        return $this->horaire;
    }

    /**
     * @param mixed $horaire
     */
    public function setHoraire($horaire): void
    {
        $this->horaire = $horaire;
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
     * @return int
     */
    public function getValidEvent(): int
    {
        return $this->validEvent;
    }

    /**
     * @param int $validEvent
     */
    public function setValidEvent(int $validEvent): void
    {
        $this->validEvent = $validEvent;
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
    public function getIdCreateurParent()
    {
        return $this->idCreateurParent;
    }

    /**
     * @param mixed $idCreateurParent
     */
    public function setIdCreateurParent($idCreateurParent): void
    {
        $this->idCreateurParent = $idCreateurParent;
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
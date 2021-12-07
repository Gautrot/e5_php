<?php

class Rdv
{
    private $idRdv, $objet, $message, $date, $horaire, $dateCreation, $idCreateurParent, $idCreateurProf, $idInviteParent, $idInviteProf;

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
    public function getIdRdv()
    {
        return $this->idRdv;
    }

    /**
     * @param mixed $idRdv
     */
    public function setIdRdv($idRdv): void
    {
        $this->idRdv = $idRdv;
    }

    /**
     * @return mixed
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * @param mixed $objet
     */
    public function setObjet($objet): void
    {
        $this->objet = $objet;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
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

    /**
     * @return mixed
     */
    public function getIdInviteParent()
    {
        return $this->idInviteParent;
    }

    /**
     * @param mixed $idInviteParent
     */
    public function setIdInviteParent($idInviteParent): void
    {
        $this->idInviteParent = $idInviteParent;
    }

    /**
     * @return mixed
     */
    public function getIdInviteProf()
    {
        return $this->idInviteProf;
    }

    /**
     * @param mixed $idInviteProf
     */
    public function setIdInviteProf($idInviteProf): void
    {
        $this->idInviteProf = $idInviteProf;
    }
}
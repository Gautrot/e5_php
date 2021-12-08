<?php

class Discussion
{
    private $idDiscussion, $titre, $description, $dateCreation, $idCreateurEleve, $idCreateurProf, $idCreateurParent, $idInviteEleve, $idInviteProf, $idInviteParent;

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
    public function getIdInviteEleve()
    {
        return $this->idInviteEleve;
    }

    /**
     * @param mixed $idInviteEleve
     */
    public function setIdInviteEleve($idInviteEleve): void
    {
        $this->idInviteEleve = $idInviteEleve;
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
}

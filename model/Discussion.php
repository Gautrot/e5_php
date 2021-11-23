<?php

class Discussion
{
    private $idDiscussion, $titre, $description, $dateCreation, $idCreateurEleve, $idCreateurProf, $idInviteEleve, $idInviteProf;

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

// LISTE DES GETTERS

    public function getIdDiscussion()
    {
        return $this->idDiscussion;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function getIdCreateurEleve()
    {
        return $this->idCreateurEleve;
    }

    public function getIdCreateurProf()
    {
        return $this->idCreateurProf;
    }

    public function getIdInviteEleve()
    {
        return $this->idInviteEleve;
    }

    public function getIdInviteProf()
    {
        return $this->idInviteProf;
    }

// LISTE DES SETTERS

    public function setIdDiscussion($idDiscussion)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idDiscussion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idDiscussion;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idDiscussion = $idDiscussion;
        }
    }

    public function setTitre($titre)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($titre)) {
            $this->titre = $titre;
        }
    }

    public function setDescription($description)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($description)) {
            $this->description = $description;
        }
    }

    public function setDateCreation($dateCreation)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($dateCreation)) {
            $this->dateCreation = $dateCreation;
        }
    }

    public function setIdCreateurEleve($idCreateurEleve)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idDiscussion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idCreateurEleve;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idCreateurEleve = $idCreateurEleve;
        }
    }

    public function setIdCreateurProf($idCreateurProf)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idDiscussion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idCreateurProf;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idCreateurProf = $idCreateurProf;
        }
    }

    public function setIdInviteEleve($idInviteEleve)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idDiscussion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idInviteEleve;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idInviteEleve = $idInviteEleve;
        }
    }

    public function setIdInviteProf($idInviteProf)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idDiscussion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idInviteProf;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idInviteProf = $idInviteProf;
        }
    }
}
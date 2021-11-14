<?php

class Discussion
{
    private $idDiscussion, $idCreateur, $idInvite, $titre, $description, $dateCreation;

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

    public function getIdCreateur()
    {
        return $this->idCreateur;
    }

    public function getIdInvite()
    {
        return $this->idInvite;
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

    public function setIdCreateur($idCreateur)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idDiscussion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idCreateur;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idCreateur = $idCreateur;
        }
    }

    public function setIdInvite($idInvite)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idDiscussion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idInvite;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idInvite = $idInvite;
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
}
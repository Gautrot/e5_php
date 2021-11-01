<?php

class Evenement
{
    private $idEvent, $idCreateur, $nom, $description, $organisateur, $type = 'Interne', $date, $horaire, $dateCreation, $validEvent = 0;

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

    public function getIdEvent()
    {
        return $this->idEvent;
    }

    public function getIdCreateur()
    {
        return $this->idCreateur;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getOrganisateur()
    {
        return $this->organisateur;
    }


    public function getType()
    {
        return $this->type;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getHoraire()
    {
        return $this->horaire;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function getValidEvent()
    {
        return $this->validEvent;
    }

// LISTE DES SETTERS

    public function setIdEvent($idEvent)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idEvent donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idEvent;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idEvent = $idEvent;
        }
    }

    public function setIdCreateur($idCreateur)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idEvent donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idCreateur;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idCreateur = $idCreateur;
        }
    }

    public function setNom($nom)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($nom)) {
            $this->nom = $nom;
        }
    }

    public function setDescription($description)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($description)) {
            $this->description = $description;
        }
    }

    public function setOrganisateur($organisateur)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($organisateur)) {
            $this->organisateur = $organisateur;
        }
    }

    public function setType($type)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($type)) {
            $this->type = $type;
        }
    }

    public function setDate($date)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($date)) {
            $this->date = $date;
        }
    }

    public function setHoraire($horaire)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($horaire)) {
            $this->horaire = $horaire;
        }
    }

    public function setDateCreation($dateCreation)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($dateCreation)) {
            $this->dateCreation = $dateCreation;
        }
    }

    public function setValidEvent($validEvent)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $valid = (int)$validEvent;

        // On vérifie ensuite si ce nombre est bien positif.
        if ($valid >= 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->validEvent = $validEvent;
        }
    }
}
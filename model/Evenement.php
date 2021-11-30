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

// LISTE DES GETTERS

    public function getIdEvent()
    {
        return $this->idEvent;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
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

    public function getIdCreateurEleve()
    {
        return $this->idCreateurEleve;
    }

    public function getIdCreateurParent()
    {
        return $this->idCreateurParent;
    }

    public function getIdCreateurProf()
    {
        return $this->idCreateurProf;
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

    public function setIdCreateurEleve($idCreateurEleve)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idEvent donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idCreateurEleve;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idCreateurEleve = $idCreateurEleve;
        }
    }

    public function setIdCreateurParent($idCreateurParent)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idEvent donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idCreateurParent;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idCreateurParent = $idCreateurParent;
        }
    }

    public function setIdCreateurProf($idCreateurProf)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idEvent donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idCreateurProf;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idCreateurProf = $idCreateurProf;
        }
    }
}
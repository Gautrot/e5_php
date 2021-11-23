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

// LISTE DES GETTERS

    public function getIdRdv()
    {
        return $this->idRdv;
    }

    public function getObjet()
    {
        return $this->objet;
    }

    public function getMessage()
    {
        return $this->message;
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

    public function getIdCreateurParent()
    {
        return $this->idCreateurParent;
    }

    public function getIdCreateurProf()
    {
        return $this->idCreateurProf;
    }

    public function getIdInviteParent()
    {
        return $this->idInviteParent;
    }

    public function getIdInviteProf()
    {
        return $this->idInviteProf;
    }


// LISTE DES SETTERS

    public function setIdRdv($idRdv)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idEvent donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idRdv;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idRdv = $idRdv;
        }
    }

    public function setObjet($objet)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($objet)) {
            $this->objet = $objet;
        }
    }

    public function setMessage($message)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($message)) {
            $this->message = $message;
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

    public function setIdInviteParent($idInviteParent)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idEvent donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idInviteParent;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idInviteParent = $idInviteParent;
        }
    }

    public function setIdInviteProf($idInviteProf)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la $idEvent donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idInviteProf;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idInviteProf = $idInviteProf;
        }
    }


}

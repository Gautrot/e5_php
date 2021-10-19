<?php

class Administrateur extends Utilisateur
{
    private $idAdmin, $statut = 4, $validation = 1;

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

// LISTE DES GETTERS

    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getValidation()
    {
        return $this->validation;
    }

// LISTE DES SETTERS

    public function setIdAdmin($idAdmin)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idAdmin;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idAdmin = $idAdmin;
        }
    }

    public function setStatut($statut)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($statut)) {
            $this->statut = $statut;
        }
    }

    public function setValidation($validation)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($validation)) {
            $this->validation = $validation;
        }
    }
}
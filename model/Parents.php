<?php

class Parents extends Utilisateur
{
    private $idParent, $statut = 2, $metier, $idEleve;

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

    public function getIdParent()
    {
        return $this->idParent;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getMetier()
    {
        return $this->metier;
    }

    public function getIdEleve()
    {
        return $this->idEleve;
    }

// LISTE DES SETTERS

    public function setIdParent($idParent)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idParent;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idParent = $idParent;
        }
    }

    public function setStatut($statut)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($statut)) {
            $this->statut = $statut;
        }
    }

    public function setMetier($metier)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($metier)) {
            $this->metier = $metier;
        }
    }

    public function setIdEleve($idEleve)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idEleve;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idEleve = $idEleve;
        }
    }
}
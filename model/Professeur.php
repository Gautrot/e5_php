<?php

class Professeur extends Utilisateur
{
    private $idProf, $statut = 3, $matiere, $idUtil;

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

    public function getIdProf()
    {
        return $this->idProf;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getMatiere()
    {
        return $this->matiere;
    }

    public function getIdUtil()
    {
        return $this->idUtil;
    }

// LISTE DES SETTERS

    public function setIdProf($idProf)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idProf;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idProf = $idProf;
        }
    }

    public function setStatut($statut)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($statut)) {
            $this->statut = $statut;
        }
    }

    public function setMatiere($matiere)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($matiere)) {
            $this->matiere = $matiere;
        }
    }

    public function setIdUtil($idUtil)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idUtil;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($id > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idUtil = $idUtil;
        }
    }
}
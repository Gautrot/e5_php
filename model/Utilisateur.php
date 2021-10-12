<?php

class Utilisateur
{
    private $idUtilisateur, $statut = 0, $validUtilisateur = 0, $nom, $prenom, $dateNaissance, $adresse, $telephone, $mail, $login, $mdp;

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

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function getValidUtilisateur()
    {
        return $this->validUtilisateur;
    }

// LISTE DES SETTERS

    public function setIdUtilisateur($idUtilisateur)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $id = (int)$idUtilisateur;

        // On vérifie ensuite si ce nombre est bien strictement positif.
        if ($idUtilisateur > 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->idUtilisateur = $idUtilisateur;
        }
    }

    public function setNom($nom)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($nom)) {
            $this->nom = $nom;
        }
    }

    public function setPrenom($prenom)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($prenom)) {
            $this->prenom = $prenom;
        }
    }

    public function setDateNaissance($dateNaissance)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($dateNaissance)) {
            $this->dateNaissance = $dateNaissance;
        }
    }

    public function setAdresse($adresse)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($adresse)) {
            $this->adresse = $adresse;
        }
    }

    public function setTelephone($telephone)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($telephone)) {
            $this->telephone = $telephone;
        }
    }

    public function setMail($mail)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($mail)) {
            $this->mail = $mail;
        }
    }

    public function setLogin($login)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($login)) {
            $this->login = $login;
        }
    }

    public function setMdp($mdp)
    {
        // On vérifie qu'il s'agit bien d'une chaîne de caractères.
        if (is_string($mdp)) {
            $this->mdp = $mdp;
        }
    }

    public function setStatut($statut)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $stat = (int)$statut;

        // On vérifie ensuite si ce nombre est bien positif.
        if ($stat >= 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->statut = $statut;
        }
    }

    public function setValidUtilisateur($validUtilisateur)
    {
        // On convertit l'argument en nombre entier.
        // Si c'en était déjà un, rien ne changera.
        // Sinon, la conversion donnera le nombre 0 (à quelques exceptions près, mais rien d'important ici).
        $valid = (int)$validUtilisateur;

        // On vérifie ensuite si ce nombre est bien positif.
        if ($valid >= 0) {
            // Si c'est le cas, c'est tout bon, on assigne la valeur à l'attribut correspondant.
            $this->validUtilisateur = $validUtilisateur;
        }

        return $this->validUtilisateur;
    }
}
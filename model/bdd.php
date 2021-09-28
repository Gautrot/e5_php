<?php

class bdd
{
// déclaration des attributs
    public $bdd;

// constructeur
    public function __construct()
    {
        // gestion d'exception pour la connexion à la base de données
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=projet_lprs_sgs;charset=utf8', 'root', '');
        } // si il attrape une exception
        catch (PDOException $e) {
            // affiche un message
            echo "Connection failed : " . $e->getMessage();
        }

    }

    public function getBase()
    {
        return $this->bdd;
    }

// méthode récupérer les requêtes SQL de la base de données
    public function query($sql, $data = array())
    {
        $req = $this->bdd->prepare($sql);
        $req->execute($data);
        return $req->fetchall();
    }

}
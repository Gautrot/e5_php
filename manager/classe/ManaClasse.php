<?php
require_once __DIR__ . '/../Manager.php';

// création de la classe ManaClasse
class ManaClasse
{
    // Méthode de liste d'utilisateurs

    public function listeClasse()
    {
        // On appelle la base de données
        $bdd = (new BDD)->getBase();
        $req = $bdd->query('SELECT * FROM classe ORDER BY nom DESC');
        // Il retourne tous les évènements dans la table
        return $req->fetchAll();
    }
}
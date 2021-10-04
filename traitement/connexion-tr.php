<?php
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

try {
//instanciation de l'objet client
    $a = new Utilisateur([
        "login" => $_POST['login'],
        "mdp" => $_POST['mdp']
    ]);

//instanciation du manager
    $man = new Manager();
//appel
    $man->connexion($a);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}

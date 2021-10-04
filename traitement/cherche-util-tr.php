<?php
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

try {
//instanciation de l'objet client
    $user = new Utilisateur([
        "idUtilisateur" => $_POST['idUtilisateur']
    ]);

//instanciation du manager
    $man = new Manager();
//appel
    $man->chercheUtil($user);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}

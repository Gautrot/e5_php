<?php
require_once '../../../model/Utilisateur.php';

try {
# Instancie la classe Utilisateur
    $user = new Utilisateur([
        'idUtilisateur' => $_POST['idUtilisateur']
    ]);
# Instancie la classe Manager
    $man = new Manager();
# Lance la méthode chercheUtil
    $show = $man->chercheUtil($user);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}

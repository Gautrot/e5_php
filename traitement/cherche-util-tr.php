<?php
require_once '../../model/Utilisateur.php';
require_once '../../manager/Manager.php';

try {
# Instancie la classe Utilisateur
    $user = new Utilisateur([
        'idUtilisateur' => $_SESSION['user']['idUtilisateur']
    ]);
# Instancie la classe Manager
    $man = new Manager();
# Lance la méthode chercheUtilModif
    $edit = $man->chercheUtilModif($user);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}
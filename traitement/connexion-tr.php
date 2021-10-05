<?php
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

try {
# Instancie la classe Utilisateur
    $user = new Utilisateur([
        "login" => $_POST['login'],
        "mdp" => $_POST['mdp']
    ]);
# Instancie la classe Manager
    $manager = new Manager();
# Lance la méthode connexion
    $manager->connexion($user);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}

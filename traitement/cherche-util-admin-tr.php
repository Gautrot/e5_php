<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/e5_php/';
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

try {
# Instancie la classe Utilisateur
    $user = new Utilisateur([
        'idUtilisateur' => $_GET['idUtilisateur']
    ]);
# Instancie la classe Manager
    $man = new Manager();
# Lance la méthode chercheUtil
    $show = $man->chercheUtilAdmin($user);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}
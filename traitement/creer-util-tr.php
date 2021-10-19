<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/e5_php/';
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

try {
# Instancie la classe Utilisateur
    $user = new Utilisateur([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['dateNaissance'],
        'adresse' => $_POST['adresse'],
        'telephone' => $_POST['telephone'],
        'mail' => $_POST['mail'],
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp'],
        'statut' => $_POST['statut'],
        'validUtilisateur' => '0'
    ]);
# Instancie la classe Manager
    $manager = new Manager();
# Lance la méthode creerUtil
    $manager->creerUtil($user);
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: ../template/themes/template/table-util");
}

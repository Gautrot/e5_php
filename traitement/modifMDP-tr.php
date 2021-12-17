<?php
require_once '../model/Utilisateur.php';
require_once '../manager/MDP/ManaMDP.php';
require_once '../manager/Manager.php';

try {
# Instancie la classe Manager
    $manager = new ManaMDP();
# Instancie la classe Utilisateur
    $MDP_Modif = new Utilisateur([
        'mail' => $_POST['mail'],
        'mdp' => $_POST['mdp']
    ]);
# Lance la méthode modifMDP
    $manager->modifMDP($MDP_Modif);
    header("Location: /e5_php/template/themes/template/index");
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: /e5_php/template/themes/template/ModifMDP.php");
}
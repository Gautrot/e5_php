<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Eleve.php';
require_once '../../manager/Manager.php';
require_once '../../manager/eleve/ManaEleve.php';

try {
# Instancie la classe Eleve
    $eleve = new Eleve([
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp']
    ]);
# Instancie la classe ManaEleve
    $manager = new ManaEleve();
# Lance la méthode connexionEleve
    $manager->connexionEleve($eleve);
    header('Location: /e5_php/index.php');
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/index.php');
}

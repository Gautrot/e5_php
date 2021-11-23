<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Professeur.php';
require_once '../../manager/Manager.php';
require_once '../../manager/prof/ManaProf.php';

try {
# Instancie la classe Professeur
    $prof = new Professeur([
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp']
    ]);
# Instancie la classe ManaProf
    $manager = new ManaProf();
# Lance la méthode connexionProf
    $manager->connexionProf($prof);
    header('Location: /e5_php/template/themes/template/index');
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/index');
}

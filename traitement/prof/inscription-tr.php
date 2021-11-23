<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Professeur.php';
require_once '../../manager/Manager.php';
require_once '../../manager/prof/ManaProf.php';

try {
# Instancie la classe Professeur
    $prof = new Professeur([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['dateNaissance'],
        'adresse' => $_POST['adresse'],
        'telephone' => $_POST['telephone'],
        'mail' => $_POST['mail'],
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp'],
        'matiere' => $_POST['matiere']
    ]);

# Instancie la classe ManaProf
    $manager = new ManaProf();
# Lance la méthode inscrProf
    $manager->inscrProf($prof);
    header('Location: /e5_php/template/themes/template/index');
} catch (Exception $e) {
    $_SESSION['erreur'] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/inscr-prof');
}
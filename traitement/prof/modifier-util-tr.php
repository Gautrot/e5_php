<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Professeur.php';
require_once '../../manager/prof/ManaProf.php';
require_once '../../manager/Manager.php';

try {
# Instancie la classe Manager
    $manager = new ManaProf();
# Instancie la classe Eleve
    $prof = new Professeur([
        'idUtilisateur' => $_POST['idUtilisateur'],
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['dateNaissance'],
        'adresse' => $_POST['adresse'],
        'telephone' => $_POST['telephone'],
        'mail' => $_POST['mail'],
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp']
    ]);
# Lance la méthode modifEleve
    $manager->modifProf($prof);
    header("Location: /e5_php/index");
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: /e5_php/view/modif-util");
}

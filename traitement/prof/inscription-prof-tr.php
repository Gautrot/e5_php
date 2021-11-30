<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Professeur.php';
require_once '../../manager/prof/ManaProf.php';
require_once '../../manager/Manager.php';

try {
// instanciation de l'objet professeur
    $prof = new Professeur([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['dateNaissance'],
        'adresse' => $_POST['adresse'],
        'telephone' => $_POST['telephone'],
        'mail' => $_POST['mail'],
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp'],
        'matiere' => $_POST['matiere'],
        //'idEleve' => $_POST['idEleve']
    ]);
    //  var_dump($prof);
// instanciation du manager
    $manager = new ManaProf();
    $manager->inscrProf($prof);
    header('Location: /e5_php/template/themes/template/index.php');

} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/inscr-prof.php');
}

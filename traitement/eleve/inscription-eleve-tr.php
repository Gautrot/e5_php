<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Eleve.php';
require_once '../../manager/Manager.php';

try {
// instanciation de l'objet eleve
    $eleve = new Eleve([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['dateNaissance'],
        'adresse' => $_POST['adresse'],
        'telephone' => $_POST['telephone'],
        'mail' => $_POST['mail'],
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp'],
        'statut' => 1,
        'classe' => $_POST['classe']
    ]);

// instanciation du manager
    $manager = new Manager();
    $manager->inscriptionEleve($eleve);

} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}

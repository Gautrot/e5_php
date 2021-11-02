<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Parents.php';
require_once '../../manager/parent/ManaParent.php';

try {
// instanciation de l'objet parent
    $parent = new Parents([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['dateNaissance'],
        'adresse' => $_POST['adresse'],
        'telephone' => $_POST['telephone'],
        'mail' => $_POST['mail'],
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp'],
        'statut' => 2,
        'metier' => $_POST['parent']
    ]);

// instanciation du manager
    $manager = new Manager();
    $manager->inscriptionParent($parent);

} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}

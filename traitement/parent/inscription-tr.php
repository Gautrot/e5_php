<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Parents.php';
require_once '../../manager/Manager.php';
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
        'metier' => $_POST['metier'],
        'idEleve' => $_POST['idEleve']
    ]);
// instanciation du manager
    $manager = new ManaParent();
    $manager->inscrParent($parent);
    header('Location: /e5_php/template/themes/template/index.php');
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/inscr-parent.php');
}

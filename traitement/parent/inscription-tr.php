<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Parents.php';
require_once '../../manager/Manager.php';
require_once '../../manager/parent/ManaParent.php';

try {
# Instancie la classe Parents
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

# Instancie la classe ManaParent
    $manager = new ManaParent();
# Lance la méthode inscrParent
    $manager->inscrParent($parent);
    header('Location: /e5_php/index.php');
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/view/parent/inscr-parent.php');
}

<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Parents.php';
require_once '../../manager/parent/ManaParent.php';
require_once '../../manager/Manager.php';

try {
# Instancie la classe ManaParent
    $manager = new ManaParent();
# Instancie la classe Parents
    $parent = new Parents([
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
# Lance la méthode modifParent
    $manager->modifParent($parent);
    header("Location: /e5_php/index");
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: /e5_php/view/modif-util");
}

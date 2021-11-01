<?php

require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

try {
# Instancie la classe Manager
    $manager = new Manager();
var_dump($_POST['nom']);
# Instancie la classe Utilisateur
    $user = new Utilisateur([
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
# Lance la méthode creerUtil
    $manager->modifUtil($user);

} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: ../template/themes/template/modif-util");
}

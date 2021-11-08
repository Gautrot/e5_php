<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Administrateur.php';
require_once '../../manager/admin/ManaAdmin.php';
require_once '../../manager/Manager.php';

try {
# Instancie la classe Manager
    $manager = new ManaAdmin();
# Instancie la classe Administrateur
    $admin = new Administrateur([
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
# Lance la méthode modifAdmin
    $manager->modifAdmin($admin);
    header("Location: /e5_php/template/themes/template/index");
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: /e5_php/template/themes/template/modif-util");
}

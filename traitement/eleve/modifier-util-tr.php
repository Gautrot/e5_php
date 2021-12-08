<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Eleve.php';
require_once '../../manager/eleve/ManaEleve.php';
require_once '../../manager/Manager.php';

try {
# Instancie la classe ManaEleve
    $manager = new ManaEleve();
# Instancie la classe Eleve
    $eleve = new Eleve([
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
    $manager->modifEleve($eleve);
    header("Location: /e5_php/index");
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: /e5_php/view/modif-util");
}

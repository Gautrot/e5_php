<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Eleve.php';
require_once '../../manager/eleve/ManaEleve.php';

try {
# Instancie la classe Eleve
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

# Instancie la classe ManaEleve
    $manager = new ManaEleve();
# Lance la méthode inscriptionEleve
    $manager->inscriptionEleve($eleve);
    header('Location: /e5_php/template/themes/template/index');
} catch (Exception $e) {
    $_SESSION['erreur'] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/inscr-eleve');
}
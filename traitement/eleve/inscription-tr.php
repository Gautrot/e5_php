<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Eleve.php';
require_once '../../manager/Manager.php';
require_once '../../manager/eleve/ManaEleve.php';

try {
# Instancie la classe Eleve
    $eleve = new Eleve([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['dateNaissance'],
        'adresse' => $_POST['adresse'] . ' ' . $_POST['codePostal'] . ' ' . $_POST['ville'],
        'telephone' => $_POST['telephone'],
        'mail' => $_POST['mail'],
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp'],
        'confirm' => $_POST['confirm'],
        'classe' => $_POST['id_classe']
    ]);

# Instancie la classe ManaEleve
    $manager = new ManaEleve();
# Lance la méthode inscrEleve
    $manager->inscrEleve($eleve);
    header('Location: /e5_php/index');
} catch (Exception $e) {
    $_SESSION['erreur'] = $e->getMessage();
    header('Location: /e5_php/view/eleve/inscr-eleve');
}

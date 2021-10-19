<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/e5_php/';
require_once '../model/Utilisateur.php';
require_once '../model/Eleve.php';
require_once '../model/Administrateur.php';
require_once '../model/Professeur.php';
require_once '../model/Parents.php';
require_once '../manager/Manager.php';

try {
# Instancie la classe Utilisateur
    $user = new Utilisateur([
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'dateNaissance' => $_POST['dateNaissance'],
        'adresse' => $_POST['adresse'],
        'telephone' => $_POST['telephone'],
        'mail' => $_POST['mail'],
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp'],
        'statut' => $_POST['statut'],
        'validUtilisateur' => '0'
    ]);

    var_dump($user);

    switch ($_POST['statut']) {
        case '1':
            # Instancie la classe Eleve
            $eleve = new Eleve([
                'classe' => $_POST['classe']
            ]);
            break;
        case '2':
            # Instancie la classe Parents
            $parent = new Parents([
                'metier' => $_POST['metier'],
                'idEleve' => $_POST['idEleve']
            ]);
            break;
        case '3':
            # Instancie la classe Professeur

            $prof = new Professeur([
                'matiere' => $_POST['matiere'],
                'validation' => $_POST['validation']
            ]);
            break;
        case '4':
            # Instancie la classe Administrateur

            $admin = new Administrateur([
                'validation' => $_POST['validation']
            ]);
            break;
        default:
            break;
    }
# Instancie la classe Manager
    $manager = new Manager();
# Lance la méthode creerUtil
    $manager->creerUtil($user);
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: ../template/themes/template/table-util");
}

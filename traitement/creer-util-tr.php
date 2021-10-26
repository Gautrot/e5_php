<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/e5_php/';
require_once '../model/Utilisateur.php';
require_once '../model/Eleve.php';
require_once '../model/Administrateur.php';
require_once '../model/Professeur.php';
require_once '../model/Parents.php';
require_once '../manager/Manager.php';

try {
# Instancie la classe Manager
    $manager = new Manager();

    $statut = $_POST['statut'];
    switch ($statut) {
        case '1':
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
                'statut' => $_POST['statut'],
                'classe' => $_POST['classe']
            ]);
            # Lance la méthode creerEleve
            $manager->creerEleve($eleve);
            break;
        case '2':
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
                'statut' => $_POST['statut'],
                'metier' => $_POST['metier'],
                'idEleve' => $_POST['idEleve']
            ]);
            # Lance la méthode creerParent
            $manager->creerParent($parent);
            break;
        case '3':
            # Instancie la classe Professeur
            $prof = new Professeur([
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'dateNaissance' => $_POST['dateNaissance'],
                'adresse' => $_POST['adresse'],
                'telephone' => $_POST['telephone'],
                'mail' => $_POST['mail'],
                'login' => $_POST['login'],
                'mdp' => $_POST['mdp'],
                'statut' => $_POST['statut'],
                'matiere' => $_POST['matiere'],
                'validation' => $_POST['validation']
            ]);
            # Lance la méthode creerProf
            $manager->creerProf($prof);
            break;
        case '4':
            # Instancie la classe Administrateur
            $admin = new Administrateur([
                'nom' => $_POST['nom'],
                'prenom' => $_POST['prenom'],
                'dateNaissance' => $_POST['dateNaissance'],
                'adresse' => $_POST['adresse'],
                'telephone' => $_POST['telephone'],
                'mail' => $_POST['mail'],
                'login' => $_POST['login'],
                'mdp' => $_POST['mdp'],
                'statut' => $_POST['statut'],
                'validUtilisateur' => 1,
                'validation' => $_POST['validation']
            ]);
            # Lance la méthode creerAdmin
            $manager->creerAdmin($admin);
            break;
        default:
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
                'statut' => $_POST['statut']
            ]);
            # Lance la méthode creerUtil
            $manager->creerUtil($user);
            break;
    }
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: ../template/themes/template/table-util");
}

<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Eleve.php';
require_once '../../model/Administrateur.php';
require_once '../../model/Professeur.php';
require_once '../../model/Parents.php';
require_once '../../manager/Manager.php';
require_once '../../manager/admin/ManaAdmin.php';

try {
# Instancie la classe ManaAdmin
    $manager = new ManaAdmin();
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
                'matiere' => $_POST['matiere'],
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
            ]);
            # Lance la méthode creerUtil
            $manager->creerUtil($user);
            break;
    }
    header('Location: /e5_php/view/admin/table-util.php');
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/view/admin/table-util.php');
}

<?php
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

try {
    # Instancie la classe Utilisateur
    $user = new Utilisateur([
        'idUtilisateur' => $_POST['idUtilisateur']
    ]);
    # Instancie la classe Manager
    $manager = new Manager();
    #Lance la méthode validUtil
    $manager->validUtil($user);
} catch (Exception $e) {
    # Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header("Location: ../view/admin/table-util.php");
}

<?php
require_once '../../model/Evenement.php';
require_once '../../manager/Manager.php';

try {
    if ($_SESSION['user']['statut'] === '1') {
        # Instancie la classe Evenement
        $event = new Evenement([
            'idCreateur' => $_SESSION['user']['idUtilisateur'],
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'organisateur' => $_POST['organisateur'],
            'type' => 'Interne',
            'date' => $_POST['date'],
            'horaire' => $_POST['horaire'],
            'validEvent' => 0
        ]);
    } else {
        # Instancie la classe Evenement
        $event = new Evenement([
            'idCreateur' => $_SESSION['user']['idUtilisateur'],
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'organisateur' => $_POST['organisateur'],
            'type' => $_POST['type'],
            'date' => $_POST['date'],
            'horaire' => $_POST['horaire'],
            'validEvent' => 1
        ]);
    }
    # Instancie la classe Manager
    $manager = new Manager();
    # Lance la méthode creerEvenement
    $manager->creerEvenement($event);
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
}

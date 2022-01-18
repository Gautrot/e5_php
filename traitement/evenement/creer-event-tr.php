<?php
require_once '../../model/Evenement.php';
require_once '../../manager/Manager.php';
require_once '../../manager/evenement/ManaEvent.php';

try {
    if ($_SESSION['user']['statut'] === '1') {
        # Instancie la classe Evenement
        $event = new Evenement([
            'titre' => $_POST['titre'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
            'horaire' => $_POST['horaire']
        ]);
    } else {
        # Instancie la classe Evenement
        $event = new Evenement([
            'titre' => $_POST['titre'],
            'description' => $_POST['description'],
            'type' => $_POST['type'],
            'date' => $_POST['date'],
            'horaire' => $_POST['horaire']
        ]);
    }
    # Instancie la classe ManaEvent
    $manager = new ManaEvent();
    # Lance la méthode creerEvenement
    $manager->creerEvenement($event);
    header('Location: /e5_php/view/evenement/evenements.php');
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/view/evenement/creer-evenement.php');
}

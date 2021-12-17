<?php
require_once '../../model/Pee.php';
require_once '../../manager/Manager.php';
require_once '../../manager/pee/Manapee.php';

try {
    if ($_SESSION['user']['statut'] === '3'){
        # Instancie la classe Evenement
        $pee = new Pee([
            $id_projet = $_POST['id_projet'],
            'nom' => $_POST['nom']
        ]);
    }
    # Instancie la classe ManaEvent
    $manager = new Manapee();
    # Lance la méthode creerEvenement
    $manager->supprPee($pee);
    header('Location: /e5_php/template/themes/template/pee');
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/template/themes/template/suppr-pee.php');
}

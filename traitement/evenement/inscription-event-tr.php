<?php
require_once '../../model/Evenement.php';
require_once '../../model/InscriptionEvent.php';
require_once '../../manager/Manager.php';
require_once '../../manager/evenement/ManaEvent.php';

try {
# Instancie la classe InscriptionEvent
    $event = new InscriptionEvent([
        //'idUtil' => $_SESSION['user']['idUtilisateur'],
        'idEvent' => $_POST['inscription']
    ]);

# Instancie la classe ManaEvent
    $manager = new ManaEvent();
# Lance la méthode inscrEvenement
    $manager->inscrEvenement($event);
    header('Location: /e5_php/template/themes/template/evenements');
} catch (Exception $e) {
    $_SESSION['erreur'] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/evenements');
}

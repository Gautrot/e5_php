<?php
require_once '../../model/Evenement.php';
require_once '../../manager/evenement/ManaEvent.php';

try {
# Instancie la classe Evenement
    $event = new Evenement([
        'idEvent' => $_POST['annulation']
    ]);
# Instancie la classe ManaEvent
    $man = new ManaEvent();
# Lance la méthode annuleEvenement
    $annul = $man->annuleEvenement($event);
    header('Location: /e5_php/view/evenement/evenement-no.php?idEvent=' . $_POST['annulation']);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/view/evenement/evenement-no.php?idEvent=' . $_POST['annulation']);
}
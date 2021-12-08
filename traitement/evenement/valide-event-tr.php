<?php
require_once '../../model/Evenement.php';
require_once '../../manager/evenement/ManaEvent.php';

try {
# Instancie la classe Evenement
    $event = new Evenement([
        'idEvent' => $_POST['validation']
    ]);
# Instancie la classe ManaEvent
    $man = new ManaEvent();
# Lance la méthode valideEvenement
    $annul = $man->valideEvenement($event);
    header('Location: /e5_php/view/evenement/evenement-no?idEvent=' . $_POST['validation']);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/view/evenement/evenement-no?idEvent=' . $_POST['validation']);
}
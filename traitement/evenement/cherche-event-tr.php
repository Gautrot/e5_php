<?php
require_once '../../../model/Evenement.php';

try {
# Instancie la classe Evenement
    $event = new Evenement([
        'idEvent' => $_POST['idEvent']
    ]);
# Instancie la classe ManaEvent
    $man = new ManaEvent();
# Lance la méthode chercheEvenement
    $show = $man->chercheEvenement($event);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}
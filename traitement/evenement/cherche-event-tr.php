<?php
require_once '../../model/Evenement.php';
require_once '../../manager/Manager.php';

try {
# Instancie la classe Utilisateur
    $event = new Evenement([
        'idEvent' => $_GET['idEvent']
    ]);
# Instancie la classe Manager
    $man = new Manager();
# Lance la méthode chercheUtil
    $edit = $man->chercheEvenement($event);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}
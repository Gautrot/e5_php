<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/e5_php/';
require_once $root . 'model/Utilisateur.php';
require_once $root . 'manager/Manager.php';

#Instancie la classe Utilisateur
$user = new Utilisateur([
    'mail' => $_POST['mail']
]);
# Instancie la classe Manager
$manager = new Manager();
# Lance la méthode deconnexion
$manager->deconnexion($user);

<?php
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

#Instancie la classe Utilisateur
$user = new Utilisateur([
    'mail' => $_POST['mail']
]);
# Instancie la classe Manager
$manager = new Manager();
# Lance la méthode deconnexion
$manager->deconnexion($user);
?>

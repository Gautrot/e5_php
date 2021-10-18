<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/e5_php/';
require_once $root . 'model/Utilisateur.php';
require_once $root . 'manager/Manager.php';

# Instancie la classe Utilisateur
$user = new Utilisateur([
    'idUtilisateur' => $_POST['show']['idUtilisateur']
]);
# Instancie la classe Manager
$man = new Manager();
# Lance la méthode retourUtil
$show = $man->retourUtil($user);

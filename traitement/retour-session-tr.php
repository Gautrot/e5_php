<?php
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

# Instancie la classe Utilisateur
$user = new Utilisateur([
    'idUtilisateur' => $_POST['show']['idUtilisateur']
]);
# Instancie la classe Manager
$man = new Manager();
# Lance la méthode retourUtil
$show = $man->retourUtil($user);
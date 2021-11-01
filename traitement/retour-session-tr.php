<?php

require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';

# Instancie la classe Utilisateur
$edit = new Utilisateur([
    'idUtilisateur' => $_POST['edit']['idUtilisateur']
]);
# Instancie la classe Manager
$man = new Manager();
# Lance la méthode retourUtil
$edit = $man->retourUtilEdit();

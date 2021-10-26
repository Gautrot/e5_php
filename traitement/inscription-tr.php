<?php
$root = $_SERVER['DOCUMENT_ROOT'] . '/e5_php/';
require_once '../model/Utilisateur.php';
require_once '../manager/Manager.php';
try {

//instanciation de l'objet utilisateur
  $user = new Utilisateur(array(
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'dateNaissance' => $_POST['dateNaissance'],
    'adresse' => $_POST['adresse'],
    'telephone' => $_POST['telephone'],
    'mail' => $_POST['mail'],
    'login' => $_POST['login'],
    'mdp' => $_POST['mdp'],
    'statut' => 0
  ));

//instanciation du manager
  $manager = new manager();
  $manager->inscription($user);


} catch (Exception $e) {

$_SESSION["erreur"] = $e->getMessage();
}

 ?>

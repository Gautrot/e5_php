<?php

require_once '../model/model.php';
require_once '../model/bdd.php';
require_once '../manager/manager.php';

try {

//instanciation de l'objet client
  $a = new client(array(
    "login" => $_POST['login'],
    "mdp" =>  $_POST['mdp']
  ));

//instanciation du manager
  $man = new manager();
//appel
  $man->connexion($a);


} catch (Exception $e) {

$_SESSION["erreur"] = $e->getMessage();
}

?>

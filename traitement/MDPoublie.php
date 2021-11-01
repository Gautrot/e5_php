<?php


//On appelle la classe manager
require_once('../manager/Manager.php');
$manager = new Manager();
$mail = $_POST["mail"];
$manager->MDPoublie($mail);

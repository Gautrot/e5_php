<?php
//On appelle la classe manager
require_once($_SERVER['DOCUMENT_ROOT']."/e5_php/manager/Manager.php");
$manager = new Manager();
$mail = $_POST["mail"];
$manager->MDPoublie($mail);

?>

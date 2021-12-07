<?php
require_once '../../../model/Rdv.php';

try {
# Instancie la classe Rdv
    $rdv = new Rdv($_GET);
# Instancie la classe ManaRdv
    $man = new ManaRdv();
# Lance la méthode chercheRdv
    $show = $man->chercheRdv($rdv);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/rdv.php');
}

?>

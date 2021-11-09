<?php
require_once '../../../model/Discussion.php';

try {
# Instancie la classe Discussion
    $discus = new Discussion([
        'idDiscussion' => $_POST['idDiscussion']
    ]);
# Instancie la classe ManaDiscus
    $man = new ManaDiscus();
# Lance la méthode chercheDiscussion
    $show = $man->chercheDiscussion($discus);
    var_dump($discus);
    die;
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}
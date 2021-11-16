<?php
require_once '../../../model/Discussion.php';

try {
# Instancie la classe Discussion
    $discus = new Discussion($_GET);
# Instancie la classe ManaDiscus
    $man = new ManaDiscus();
# Lance la méthode chercheDiscussion
    $show = $man->chercheDiscussion($discus);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/discussions');
}
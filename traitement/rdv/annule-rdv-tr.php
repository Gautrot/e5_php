<?php
require_once '../../model/Rdv.php';
require_once '../../manager/rdv/ManaRdv.php';

try {
# Instancie la classe rdv
    $rdv = new Rdv([
        'idRdv' => $_POST['annulation']
    ]);
# Instancie la classe ManaRdv
    $man = new ManaRdv();
# Lance la méthode annuleRdv
    $annulation = $man->annuleRdv($rdv);
    header('Location: /e5_php/view/rdv/rdv-no?idRdv=' . $_POST['annulation']);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/view/rdv/rdv-no?idRdv=' . $_POST['annulation']);
}

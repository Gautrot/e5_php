<?php
require_once '../../../model/Utilisateur.php';
require_once '../../../model/Administrateur.php';
require_once '../../../manager/Manager.php';
require_once '../../../manager/admin/ManaAdmin.php';

try {
# Instancie la classe Utilisateur
    $user = new Utilisateur([
        'idUtilisateur' => $_POST['idUtilisateur']
    ]);
# Instancie la classe ManaAdmin
    $man = new ManaAdmin();
# Lance la méthode chercheUtil
    $show = $man->chercheUtil($user);
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}

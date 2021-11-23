<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Administrateur.php';
require_once '../../manager/Manager.php';
require_once '../../manager/admin/ManaAdmin.php';

try {
# Instancie la classe Administrateur
    $admin = new Administrateur([
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp']
    ]);
# Instancie la classe ManaAdmin
    $manager = new ManaAdmin();
# Lance la méthode connexionAdmin
    $manager->connexionAdmin($admin);
    header('Location: /e5_php/template/themes/template/index');
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/template/themes/template/index');
}

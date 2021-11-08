<?php
require_once '../../model/Utilisateur.php';
require_once '../../manager/Manager.php';
require_once '../../manager/admin/ManaAdmin.php';

try {
# Instancie la classe Utilisateur
    $user = new Utilisateur([
        'idUtilisateur' => $_POST['idUtilisateur']
    ]);
# Instancie la classe ManaAdmin
    $manager = new ManaAdmin();
# Lance la méthode desactiverUtil
    $manager->desactiverUtil($user);
    header('Location: /e5_php/template/themes/template/table-util');
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/template/themes/template/table-util');
}

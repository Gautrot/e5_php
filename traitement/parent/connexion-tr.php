<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Parents.php';
require_once '../../manager/Manager.php';
require_once '../../manager/parent/ManaParent.php';

try {
# Instancie la classe Parents
    $parent = new Parents([
        'login' => $_POST['login'],
        'mdp' => $_POST['mdp']
    ]);
# Instancie la classe ManaParent
    $manager = new ManaParent();
# Lance la méthode connexionParent
    $manager->connexionParent($parent);
    header('Location: /e5_php/index');
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
    header('Location: /e5_php/index');
}

<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Pee.php';
require_once '../../manager/Manager.php';
require_once '../../manager/pee/ManaPee.php';

try {
    if ($_SESSION['user']['statut'] === '3') {
        # Instancie la classe Pee
        $pee = new Pee([
            'id_projet' => $_POST['id_projet']
        ]);
        # Instancie la classe ManaPee
        $manager = new ManaPee();
        # Lance la méthode supprPee
        $manager->supprPee($pee);
        header('Location: /e5_php/view/pee/pee.php');
    }
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/view/pee/suppr-pee.php');
}

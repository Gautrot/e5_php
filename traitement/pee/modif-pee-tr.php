<?php
require_once '../../model/Pee.php';
require_once '../../manager/Manager.php';
require_once '../../manager/pee/ManaPee.php';

try {
    if ($_SESSION['user']['statut'] === '3'){
        # Instancie la classe Pee
        $pee = new Pee([
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'date' => $_POST['date'],
            'ref_classe' => $_POST['ref_classe']
        ]);
        var_dump($pee);
    }
    # Instancie la classe ManaPee
    $manager = new ManaPee();
    var_dump($manager);
    die();
    # Lance la méthode modifPee
    $manager->modifPee($pee);

    header('Location: /e5_php/view/pee/pee');
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/view/pee/modif_pee');
}

<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Discussion.php';
require_once '../../manager/Manager.php';
require_once '../../manager/discussion/ManaDiscus.php';

try {
    # Instancie la classe Discussion
    $discus = new Discussion([
        'titre' => $_POST['titre'],
        'description' => $_POST['description']
    ]);
    # Instancie la classe ManaDiscus
    $manager = new ManaDiscus();
    # Lance la méthode creerDiscussion
    $manager->creerDiscussion($discus);
    header('Location: /e5_php/view/discussion/discussions');
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/view/discussion/creer-discussion');
}

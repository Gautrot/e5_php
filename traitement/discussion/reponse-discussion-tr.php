<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Discussion.php';
require_once '../../model/Reponse.php';
require_once '../../manager/Manager.php';
require_once '../../manager/discussion/ManaDiscus.php';

try {
    # Instancie la classe Discussion
    $reponse = new Reponse([
        'idDiscussion' => $_POST['idDiscussion'],
        'reponse' => $_POST['reponse']
    ]);
    # Instancie la classe ManaDiscus
    $manager = new ManaDiscus();
    # Lance la méthode reponseDiscussion
    $manager->reponseDiscussion($reponse);
    header('Location: /e5_php/view/discussion/discussion-no.php?idDiscussion=' . $_POST['idDiscussion']);
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/view/discussion/discussions.php');
}

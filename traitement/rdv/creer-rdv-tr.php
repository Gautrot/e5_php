<?php
require_once '../../model/Rdv.php';
require_once '../../manager/Manager.php';
require_once '../../manager/rdv/ManaRdv.php';

try {
    if ($_SESSION['user']['statut'] === '2') {
        # Instancie la classe Evenement
        $rdv = new Rdv([
          'objet' => $_POST['objet'],
          'message' => $_POST['message'],
          'date' => $_POST['date'],
          'horaire' => $_POST['horaire'],
          'idInviteProf' => $_POST['idInviteProf']
          //'validRdv' => 0,
        ]);
    } else if ($_SESSION['user']['statut'] === '3'){
        # Instancie la classe Evenement
        $rdv = new Rdv([
          'objet' => $_POST['objet'],
          'message' => $_POST['message'],
          'date' => $_POST['date'],
          'horaire' => $_POST['horaire'],
          'idInviteParent' => $_POST['idInviteParent']
          //'validRdv' => 0,
        ]);
    }
    # Instancie la classe ManaEvent
    $manager = new ManaRdv();
    # Lance la méthode creerEvenement
    $manager->creerRdv($rdv);
    header('Location: /e5_php/template/themes/template/rdv');
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/template/themes/template/creer-rdv');
}

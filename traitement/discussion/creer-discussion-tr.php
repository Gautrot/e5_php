<?php
require_once '../../model/Utilisateur.php';
require_once '../../model/Discussion.php';
require_once '../../manager/Manager.php';
require_once '../../manager/discussion/ManaDiscus.php';

try {
    // Cherche le nom de l'utilisateur qui a créé la discussion pour l'archivage.
    $user = new Utilisateur([
        'idUtilisateur' => $_SESSION['user']['idUtilisateur']
    ]);
    var_dump($user);
    $bdd = (new BDD)->getBase();
    $req = $bdd->prepare('SELECT nom, idUtilisateur FROM utilisateur WHERE idUtilisateur = :idUtilisateur');
    $req->execute([
        'idUtilisateur' => $user->getIdUtilisateur()
    ]);
    $res = $req->fetch();
    $archive = $res['nom'] . ' : ' . $_POST['description'];
    # Instancie la classe Discussion
    $discus = new Discussion([
        'idCreateur' => $_SESSION['user']['idUtilisateur'],
        'idInvite' => $_POST['idInvite'],
        'titre' => $_POST['titre'],
        'description' => $_POST['description'],
        'archive' => $archive,
    ]);
    # Instancie la classe ManaDiscus
    $manager = new ManaDiscus();
    # Lance la méthode creerDiscussion
    $manager->creerDiscussion($discus);
    header('Location: /e5_php/template/themes/template/discussions');
} catch (Exception $e) {
# Affiche un message d'erreur
    $_SESSION['erreur'] = 'Erreur : ' . $e->getMessage();
    header('Location: /e5_php/template/themes/template/creer-discussion');
}

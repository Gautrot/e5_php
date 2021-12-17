<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../include/head.php' ?>
    <title>Évènements</title>
</head>

<body>
<?php
// Manager
include_once '../../manager/Manager.php';
// Preloader
include_once '../../include/modal/preloader.php';
// Header
include_once '../../include/header.php';
// Liste des évènements
include_once '../../manager/evenement/ManaEvent.php';
$liste = new ManaEvent();
$res = $liste->listeEvenement();
// Modal Inscription
include_once '../../include/modal/inscription.php';
// Modal Mot de passe oublié
include_once '../../include/modal/mdp.php';
// Modal Login
include_once '../../include/modal/login.php';
include_once '../../include/modal/connectionEleve.php';
include_once '../../include/modal/connectionParent.php';
include_once '../../include/modal/connectionProf.php';
include_once '../../include/modal/connectionAdmin.php';
?>

<!-- about -->
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary">
                            Evènements
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Les évènements sur le site.</p>
            </div>
        </div>
    </div>
</section>
<!-- /about -->

<!-- creer event -->
<?php if ($_SESSION['user']['validUtilisateur'] === '1') {
    if ($_SESSION['user']['statut'] === '3' || $_SESSION['user']['statut'] === '1') { ?>
        <section class="section-sm bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <form method="POST" action="/e5_php/view/evenement/creer-evenement">
                                <button type="submit" class="btn btn-primary">Créer un évènement</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }
} ?>

<!-- courses -->
<section class="section">
    <div class="container">
        <div class="row">
            <!-- event -->
            <?php if (empty($res)) { ?>
                <div class="col-lg-4 col-sm-6 mb-5">
                    Il n'y a aucun évènement pour le moment.
                </div>
            <?php } else {
                foreach ($res as $event) { ?>
                    <div class="col-lg-4 col-sm-6 mb-5">
                        <div class="card border-0 rounded-0 hover-shadow">
                            <div class="card-img position-relative">
                                <a href="/e5_php/view/evenement/evenement-no?idEvent=<?= $event['idEvent']; ?>">
                                    <img class="card-img-top rounded-0" src="/e5_php/style/images/events/event-1.jpg"
                                         alt="<?= $event['titre']; ?>">
                                </a>
                                <div class="card-date">
                                    <span><?= substr($event['date'], 8, 2); ?></span><br>
                                    <?= substr($event['date'], 5, 2) . '/' . substr($event['date'], 0, 4) ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="card-body">
                                    <a href="/e5_php/view/evenement/evenement-no?idEvent=<?= $event['idEvent']; ?>">
                                        <h4 class="card-title"><?= $event['titre']; ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</section>
<!-- /courses -->

<?php
// Footer
include_once '../../include/footer.php';
// Script
include_once '../../include/script.php';
?>

</body>
</html>

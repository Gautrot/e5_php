<?php
include_once '../../../manager/evenement/ManaEvent.php';
// Traitement "cherche-event-tr"
require_once '../../../traitement/evenement/cherche-event-tr.php';
// Traitement de liste d'évènement
$liste = new ManaEvent();
try {
    $res = $liste->listeEvenement();
} catch (Exception $e) {
    $_SESSION["erreur"] = $e->getMessage();
}
setlocale(LC_TIME, 'fr_FR.UTF-8', 'fra');
// Date d'annulation : retire 1 jour de la date de l'évènement
$annul = date_create($show['date'] . $show['horaire']);
date_sub($annul, date_interval_create_from_date_string('1 day'));
$annul = date_format($annul, 'Y-m-d H:i:s');
// Prends la date et l'heure actuelle
$today = date('Y-m-d H:i:s');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Évènement - <?= $show['nom']; ?></title>
</head>

<body>
<!-- preloader start -->
<?php include_once '../../../include/modal/preloader.php' ?>
<!-- preloader end -->

<!-- header -->
<?php include_once '../../../include/header.php' ?>
<!-- /header -->

<!-- Modal Inscription-->
<?php include_once '../../../include/modal/inscription.php' ?>

<!-- Modal MotsDePasse-->
<?php include_once '../../../include/modal/mdp.php' ?>

<!-- Modal Login-->
<?php include_once '../../../include/modal/login.php' ?>

<!-- about -->
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary"
                                                    href="evenements">Évènement</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted"><?= $show['nom']; ?></li>
                </ul>
                <p class="text-lighten"></p>
            </div>
        </div>
    </div>
</section>
<!-- /about -->

<!-- event single -->
<section class="section-sm">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title"><?= $show['nom']; ?></h2>
            </div>
            <!-- event image -->
            <div class="col-12 mb-4">
                <img src="images/events/event-single.jpg" alt="event thumb" class="img-fluid w-100">
            </div>
        </div>
        <!-- event info -->
        <div class="row align-items-center mb-5">
            <div class="<?php if ($_SESSION['user']['statut'] === '1' || $_SESSION['user']['statut'] === '3') {
                if ($annul > $today && $show['validEvent'] !== '0') { ?> col-lg-6 <?php }
            } else { ?> col-lg-9 <?php } ?>">
                <ul class="list-inline">
                    <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
                        <div class="d-flex align-items-center">
                            <i class="ti-calendar text-primary icon-md mr-2"></i>
                            <div class="text-left">
                                <h6 class="mb-0">DATE</h6>
                                <p class="mb-0"><?= strftime("%e %B %Y", strtotime($show['date'])); ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
                        <div class="d-flex align-items-center">
                            <i class="ti-time text-primary icon-md mr-2"></i>
                            <div class="text-left">
                                <h6 class="mb-0">HORAIRE</h6>
                                <p class="mb-0"><?= strftime("%H:%M", strtotime($show['horaire'])); ?></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <?php if ($show['validEvent'] !== '0' ||  $_SESSION['user']['statut'] !== '4') { ?>
                <div class="col-lg-3 text-lg-right text-left">
                    <button href="#" class="btn btn-primary">S'inscrire</button>
                </div>
            <?php } else { ?>
                <div class="col-lg-3 text-lg-right text-left">
                    <button class="btn btn-dark" disabled>Annulé</button>
                </div>
            <?php }
            if ($_SESSION['user']['statut'] === '1' || $_SESSION['user']['statut'] === '3') {
                if ($annul > $today && $show['validEvent'] !== '0') { ?>
                    <div class="col-lg-3 text-lg-right text-left">
                        <form method="post" action="/e5_php/traitement/evenement/annule-event-tr">
                            <button type="submit" name="annulation" value="<?= $show['idEvent']; ?>"
                                    class="btn btn-danger">Annuler l'évènement
                            </button>
                        </form>
                    </div>
                <?php }
            } ?>
            <!-- border -->
            <div class="col-12 mt-4 order-4">
                <div class="border-bottom border-primary"></div>
            </div>
        </div>
        <!-- event details -->
        <div class="row">
            <div class="col-12 mb-50">
                <h3>A propos</h3>
                <p><?= $show['description']; ?></p>
            </div>
        </div>
        <!-- event speakers -->
        <div class="row">
            <div class="col-12">
                <h3 class="mb-4">Organisateur</h3>
            </div>
            <!-- speakers -->
            <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                <div class="media">
                    <img class="mr-3 img-fluid" src="images/event-speakers/speaker-1.jpg" alt="speaker">
                    <div class="media-body">
                        <h4 class="mt-0"><?= $show['organisateur']; ?></h4>
                        Organisateur
                    </div>
                </div>
            </div>
            <!-- border -->
            <div class="col-12 mt-4 order-4">
                <div class="border-bottom border-primary"></div>
            </div>
        </div>
    </div>
</section>
<!-- /event single -->

<!-- more event -->
<section class="section pt-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="section-title">Plus d'évènements</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- event -->
            <?php if (empty($res)) { ?>
                <div class="col-lg-4 col-sm-6 mb-5">
                    Il n'y a pas d'évènements pour le moment.
                </div>
            <?php } else {
                foreach ($res as $event) {
                    if (isset($event) && $event['idEvent'] !== $show['idEvent']) { ?>
                        <div class="col-lg-4 col-sm-6 mb-5">
                            <div class="card border-0 rounded-0 hover-shadow">
                                <div class="card-img position-relative">
                                    <a href="evenement-no?idEvent=<?= $event['idEvent']; ?>">
                                        <img class="card-img-top rounded-0" src="images/events/event-1.jpg"
                                             alt="<?= $event['nom']; ?>">
                                    </a>
                                    <div class="card-date">
                                        <span><?= substr($event['date'], 8, 2); ?></span><br>
                                        <?= substr($event['date'], 5, 2) . '/' . substr($event['date'], 0, 4) ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="evenement-no?idEvent=<?= $event['idEvent']; ?>">
                                        <h4 class="card-title"><?= $event['nom']; ?></h4>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } else {
                        if (sizeof($res) === 1) { ?>
                            <div class="col-lg-4 col-sm-6 mb-5">
                                Il n'y a pas de nouveaux évènements pour le moment.
                            </div>
                        <?php }
                        break;
                    }
                }
            } ?>
        </div>
    </div>
</section>
<!-- /more event -->

<!-- footer -->
<?php include_once '../../../include/footer.php' ?>
<!-- /footer -->

<!-- script -->
<?php include_once '../../../include/script.php' ?>

</body>
</html>

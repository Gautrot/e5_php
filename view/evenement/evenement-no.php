<?php
include_once '../../manager/evenement/ManaEvent.php';
// Traitement "cherche-event-tr"
require_once '../../traitement/evenement/cherche-event-tr.php';
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
    <?php include_once '../../include/head.php' ?>
    <title>Évènement - <?= $show['titre']; ?></title>
</head>

<body>
<?php
// Manager
include_once '../../manager/Manager.php';
// Preloader
include_once '../../include/modal/preloader.php';
// Header
include_once '../../include/header.php';
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
<section class="page-title-section overlay" data-background="images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item"><a class="h2 text-primary font-secondary"
                                                    href="/e5_php/view/evenement/evenements.php">Évènement</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted"><?= $show['titre']; ?></li>
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
                <h2 class="section-title"><?= $show['titre']; ?></h2>
            </div>
            <!-- event image -->
            <div class="col-12 mb-4">
                <img src="/e5_php/style/images/events/event-single.jpg" alt="event thumb" class="img-fluid w-100">
            </div>
        </div>
        <!-- event info -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-9">
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
            <?= $annul > $today; ?>
            <?php if ($_SESSION['user']['statut'] !== '4' || $annul < $today) {
                if ($show['validEvent'] !== '0') {
                    if (!isset($show['idInscription']) || $_SESSION['user']['idUtilisateur'] !== $show['idUtil']) { ?>
                        <div class="col-lg-3 text-lg-right text-left">
                            <form method="post" action="/e5_php/traitement/evenement/inscription-event-tr.php">
                                <button type="submit" class="btn btn-primary" name="inscription"
                                        value="<?= $show['idEvent']; ?>">S'inscrire
                                </button>
                            </form>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-3 text-lg-right text-left">
                            <button class="btn btn-dark" disabled>Inscrit.e</button>
                        </div>
                    <?php }
                } else { ?>
                    <div class="col-lg-3 text-lg-right text-left">
                        <button class="btn btn-dark" disabled>Invalide</button>
                    </div>
                <?php }
            } ?>
        </div>
        <div class="row align-items-center mb-5">
            <?php if (isset($show['idCreateurEleve']) && $_SESSION['user']['idUtilisateur'] === $show['idUtil'] || isset($show['idCreateurProf']) && $_SESSION['user']['idUtilisateur'] === $show['idUtil']) {
                if ($annul > $today && $show['validEvent'] !== '0') { ?>
                    <div class="col-lg-3 text-left">
                        <form method="post" action="/e5_php/traitement/evenement/annule-event-tr.php">
                            <button type="submit" name="annulation" value="<?= $show['idEvent']; ?>"
                                    class="btn btn-danger">Annuler l'évènement
                            </button>
                        </form>
                    </div>
                <?php } else if ($_SESSION['user']['statut'] === '3' && $show['validEvent'] === '0') { ?>
                    <div class="col-lg-3 text-left">
                        <form method="post" action="/e5_php/traitement/evenement/valide-event-tr.php">
                            <button type="submit" name="validation" value="<?= $show['idEvent']; ?>"
                                    class="btn btn-success">Valider l'évènement
                            </button>
                        </form>
                    </div>
                <?php } ?>
                <div class="col-lg-3 text-left">
                    <form method="post" action="/e5_php/traitement/evenement/ajout-organisateur-event-tr.php">
                        <button type="submit" name="ajoutOrganisateur" value="<?= $show['idEvent']; ?>"
                                class="btn btn-success">+ Organisateur
                        </button>
                    </form>
                </div>
            <?php } ?>
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
                <h3 class="mb-4">Organisateur.trice.s</h3>
            </div>
            <!-- speakers -->
            <?php if (isset($show['idCreateurEleve'])) { ?>
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="media">
                        <img class="mr-3 img-fluid" src="/e5_php/style/images/event-speakers/speaker-1.jpg" alt="speaker">
                        <div class="media-body">
                            <h4 class="mt-0"><?= $show['idCreateurEleve']; ?></h4>
                            Etudiant
                        </div>
                    </div>
                </div>
            <?php }
            if (isset($show['idCreateurParent'])) { ?>
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="media">
                        <img class="mr-3 img-fluid" src="/e5_php/style/images/event-speakers/speaker-1.jpg" alt="speaker">
                        <div class="media-body">
                            <h4 class="mt-0"><?= $show['idCreateurParent']; ?></h4>
                            Parent
                        </div>
                    </div>
                </div>
            <?php }
            if (isset($show['idCreateurProf'])) { ?>
                <div class="col-lg-3 col-sm-6 mb-4 mb-lg-0">
                    <div class="media">
                        <img class="mr-3 img-fluid" src="/e5_php/style/images/event-speakers/speaker-1.jpg" alt="speaker">
                        <div class="media-body">
                            <h4 class="mt-0"><?= $show['idCreateurProf']; ?></h4>
                            Professeur
                        </div>
                    </div>
                </div>
            <?php } ?>
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
                                    <a href="/e5_php/view/evenement/evenement-no.php?idEvent=<?= $event['idEvent']; ?>">
                                        <img class="card-img-top rounded-0" src="/e5_php/style/images/events/event-1.jpg"
                                             alt="<?= $event['titre']; ?>">
                                    </a>
                                    <div class="card-date">
                                        <span><?= substr($event['date'], 8, 2); ?></span><br>
                                        <?= substr($event['date'], 5, 2) . '/' . substr($event['date'], 0, 4) ?>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <a href="/e5_php/view/evenement/evenement-no.php?idEvent=<?= $event['idEvent']; ?>">
                                        <h4 class="card-title"><?= $event['titre']; ?></h4>
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

<?php
// Footer
include_once '../../include/footer.php';
// Script
include_once '../../include/script.php';
?>

</body>
</html>

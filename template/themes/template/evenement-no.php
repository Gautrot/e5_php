<?php
require_once '../../../manager/Manager.php';

$liste = new Manager();
$res = $liste->listeEvenement();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Évènements</title>
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
                                                    href="evenement">Évènement</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted"><?php echo $_SESSION['event']['nom']; ?></li>
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
                <h2 class="section-title"><?php echo $_SESSION['event']['nom']; ?></h2>
            </div>
            <!-- event image -->
            <div class="col-12 mb-4">
                <img src="images/events/event-single.jpg" alt="event thumb" class="img-fluid w-100">
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
                                <p class="mb-0"><?php echo $_SESSION['event']['date']; ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-inline-item mr-xl-5 mr-4 mb-3 mb-lg-0">
                        <div class="d-flex align-items-center">
                            <i class="ti-time text-primary icon-md mr-2"></i>
                            <div class="text-left">
                                <h6 class="mb-0">HORAIRE</h6>
                                <p class="mb-0"><?php echo $_SESSION['event']['horaire']; ?></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-lg-3 text-lg-right text-left">
                <a href="#" class="btn btn-primary">Apply now</a>
            </div>
            <!-- border -->
            <div class="col-12 mt-4 order-4">
                <div class="border-bottom border-primary"></div>
            </div>
        </div>
        <!-- event details -->
        <div class="row">
            <div class="col-12 mb-50">
                <h3>A propos</h3>
                <p><?php echo $_SESSION['event']['description']; ?></p>
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
                        <h4 class="mt-0"><?php echo $_SESSION['event']['organisateur']; ?></h4>
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
            <?php for ($i = 0; $i < 3; $i++) {
                if (isset($res[$i]['idEvent']) || $res[$i]['idEvent'] !== $_SESSION['event']['idEvent']) { ?>
                    <div class="col-lg-4 col-sm-6 mb-5">
                        <div class="card border-0 rounded-0 hover-shadow">
                            <div class="card-img position-relative">
                                <img class="card-img-top rounded-0" src="images/events/event-1.jpg" alt="event thumb">
                                <div class="card-date">
                                    <span><?php echo substr($res[$i]['date'], 8, 2); ?></span><br>
                                    <?php echo substr($res[$i]['date'], 5, 2) . '/' . substr($res[$i]['date'], 0, 4) ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="/e5_php/traitement/evenement/cherche-event-tr?idEvent=<?php echo $res[$i]['idEvent']; ?>">
                                    <h4 class="card-title"><?php echo $res[$i]['nom']; ?></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php
                    if (sizeof($res) < 3) {
                        break;
                    }
                } else { ?>
                    <div class="col-lg-4 col-sm-6 mb-5">
                        Il n'y a pas d'évènements pour le moment.
                    </div>
                    <?php break;
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

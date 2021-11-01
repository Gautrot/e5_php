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
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="@@page-link">
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

<section class="section-sm bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <form method="POST" action="creer-evenement">
                        <button type="submit" class="btn btn-primary">Créer un évènement</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- courses -->
<section class="section">
    <div class="container">
        <div class="row">
            <!-- event -->
            <?php foreach ($res as $event) { ?>
                <div class="col-lg-4 col-sm-6 mb-5">
                    <div class="card border-0 rounded-0 hover-shadow">
                        <div class="card-img position-relative">
                            <img class="card-img-top rounded-0" src="images/events/event-1.jpg" alt="event thumb">
                            <div class="card-date">
                                <span><?php echo substr($event['date'], 8, 2); ?></span><br>
                                <?php echo substr($event['date'], 5, 2) ?>/<?php echo substr($event['date'], 0, 4) ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="/e5_php/traitement/evenement/cherche-event-tr?idEvent=<?php echo $event['idEvent']; ?>">
                                <h4 class="card-title"><?php echo $event['nom']; ?></h4>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- /courses -->

<!-- footer -->
<?php include_once '../../../include/footer.php' ?>
<!-- /footer -->

<!-- script -->
<?php include_once '../../../include/script.php' ?>

</body>
</html>

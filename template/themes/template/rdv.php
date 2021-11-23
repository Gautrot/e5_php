<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Prendre un rendez-vous</title>
</head>

<body>
<?php
// Preloader
include_once '../../../include/modal/preloader.php';
// Header
include_once '../../../include/header.php';
// Liste de rendez-vous
include_once '../../../manager/rdv/ManaRdv.php';
$liste = new ManaRdv();
$res = $liste->listeRdv();
// Modal Inscription
include_once '../../../include/modal/inscription.php';
// Modal Mot de passe oublié
include_once '../../../include/modal/mdp.php';
// Modal Login
include_once '../../../include/modal/login.php';
include_once '../../../include/modal/connectionEleve.php';
include_once '../../../include/modal/connectionParent.php';
include_once '../../../include/modal/connectionProf.php';
include_once '../../../include/modal/connectionAdmin.php';
?>

<!-- about -->
<section class="page-title-section overlay">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="@@page-link">
                            Rendez-vous
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Prendre un rendez-vous sur le site.</p>
            </div>
        </div>
    </div>
</section>
<!-- /about -->

<!-- creer un rdv -->
<?php if ($_SESSION['user']['statut'] === '2' || $_SESSION['user']['statut'] === '3') { ?>
        <section class="section-sm bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <form method="POST" action="creer-rdv.php">
                                <button type="submit" class="btn btn-primary">Prendre un rendez-vous</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>


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
                foreach ($res as $rdv) { ?>
                    <div class="col-lg-4 col-sm-6 mb-5">
                        <div class="card border-0 rounded-0 hover-shadow">
                            <div class="card-img position-relative">
                                <img class="card-img-top rounded-0" src="images/events/event-1.jpg" alt="event thumb">
                                <div class="card-date">
                                    <span><?php echo substr($rdv['date'], 8, 2); ?></span><br>
                                    <?php echo substr($rdv['date'], 5, 2) . '/' . substr($rdv['date'], 0, 4) ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="evenement-no">
                                    <button class="btn btn-lg btn-white" type="submit"
                                            value="<?php echo $rdv['idRdv']; ?>"
                                            name="idRdv"><?php echo $rdv['objet']; ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
        </div>
    </div>
</section>

<?php
// Footer
include_once '../../../include/footer.php';
// Script
include_once '../../../include/script.php';
?>

</body>
</html>

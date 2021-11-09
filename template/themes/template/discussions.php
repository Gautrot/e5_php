<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Discussion</title>
</head>

<body>
<!-- preloader start -->
<?php include_once '../../../include/modal/preloader.php' ?>
<!-- preloader end -->

<!-- header -->
<?php
include_once '../../../include/header.php';
include_once '../../../manager/discussion/ManaDiscus.php';
$liste = new ManaDiscus();
$res = $liste->listeDiscussion();
?>
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
                            Discussions
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Discutez sur le site.</p>
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
                            <form method="POST" action="creer-discussion">
                                <button type="submit" class="btn btn-primary">Discutez avec une personne</button>
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
                    Il n'y a aucune discussion pour le moment.
                </div>
            <?php } else {
                foreach ($res as $discus) { ?>
                    <div class="col-lg-4 col-sm-6 mb-5">
                        <div class="card border-0 rounded-0 hover-shadow">
                            <div class="card-img position-relative">
                                <img class="card-img-top rounded-0" src="images/events/event-1.jpg" alt="event thumb">
                                <div class="card-date">
                                    <span><?php echo substr($discus['dateCreation'], 8, 2); ?></span><br>
                                    <?php echo substr($discus['dateCreation'], 5, 2) . '/' . substr($discus['dateCreation'], 0, 4) ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <form method="post" action="discussion-no">
                                    <button class="btn btn-lg btn-white" type="submit"
                                            value="<?php echo $discus['idDiscussion']; ?>"
                                            name="idEvent"><?php echo $discus['titre']; ?></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
            } ?>
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

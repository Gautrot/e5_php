<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../include/head.php' ?>
    <title>Discussion</title>
</head>

<body>
<?php
// Manager
include_once '../../manager/Manager.php';
// Preloader
include_once '../../include/modal/preloader.php';
// Header
include_once '../../include/header.php';
// Liste de discussions
include_once '../../manager/discussion/ManaDiscus.php';
$liste = new ManaDiscus();
$res = $liste->listeDiscussion();
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
    if ($_SESSION['user']['statut'] === '3' || $_SESSION['user']['statut'] === '1' || $_SESSION['user']['statut'] === '2') { ?>
        <section class="section-sm bg-primary">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="text-center">
                            <form method="POST" action="creer-discussion.php">
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
                                <a href="/e5_php/view/discussion/discussion-no.php?idDiscussion=<?= $discus['idDiscussion']; ?>">
                                    <img class="card-img-top rounded-0" src="/e5_php/style/images/events/event-1.jpg"
                                         alt="<?= $discus['titre']; ?>">
                                </a>
                                <div class="card-date">
                                    <span><?= substr($discus['dateCreation'], 8, 2); ?></span><br>
                                    <?= substr($discus['dateCreation'], 5, 2) . '/' . substr($discus['dateCreation'], 0, 4) ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="/e5_php/view/discussion/discussion-no.php?idDiscussion=<?= $discus['idDiscussion']; ?>">
                                    <h4 class="card-title"><?= $discus['titre']; ?></h4>
                                </a>
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
<?php include_once '../../include/footer.php' ?>
<!-- /footer -->

<!-- script -->
<?php include_once '../../include/script.php' ?>

</body>
</html>

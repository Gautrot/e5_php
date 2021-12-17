<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Creer un projet éducatif de l’établissement</title>
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
                            Projets éducatifs de l’établissemen
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Creer un projet éducatif sur le site.</p>
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
                <div class="col-4">
                    <div class="text-center">
                        <form method="POST" action="creer-pee.php">
                            <button type="submit" class="btn btn-primary">Creer un projet éducatif</button>
                        </form>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center">
                        <form method="POST" action="modif_pee.php">
                            <button type="submit" class="btn btn-primary">Modifier un projet éducatif</button>
                        </form>
                    </div>
                </div>
                <div class="col-4">
                    <div class="text-center">
                        <form method="POST" action="suppr-pee.php">
                            <button type="submit" class="btn btn-primary">Supprimer un projet éducatif</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php
// Footer
include_once '../../../include/footer.php';
// Script
include_once '../../../include/script.php';
?>

</body>
</html>

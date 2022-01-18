<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../include/head.php' ?>
    <title>Créer un évènement</title>
</head>

<body>
<?php
// Manager
include_once '../../manager/Manager.php';
// Preloader
include_once '../../include/modal/preloader.php';
// Header
include_once '../../include/header.php';
// ManaDiscus
include_once '../../manager/discussion/ManaDiscus.php';
$liste = new Manager();
$res = $liste->listeUtil();
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
                            Créer un évènement
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Vous pouvez créer un évènement ci-dessous pour l'établissement.</p>
            </div>
        </div>
    </div>
</section>
<!-- /about -->

<!-- table -->
<section id="eventInterne" class="section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="modal-body">
                    <div class="login">
                        <form method="POST" action="/e5_php/traitement/evenement/creer-event-tr.php" style="width:100%">
                            <div class="form-group">
                                <label for="titre">Nom de l'évènement</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="titre" name="titre"
                                       maxlength="100" required placeholder="ex : Sortie à un musée">
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control form-control-sm mb-3" id="description"
                                          name="description" required></textarea>
                            </div>
                            <?php if ($_SESSION['user']['statut'] === '3' || $_SESSION['user']['statut'] === '4') { ?>
                                <div class="form-group">
                                    <div class="mb-3">Type d'évènement</div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="type" type="radio" id="interne"
                                               value="Interne" checked>
                                        <label class="form-check-label" for="interne">Interne</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" name="type" type="radio" id="externe"
                                               value="Externe">
                                        <label class="form-check-label" for="externe">Externe</label>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="date">Date de l'évènement</label>
                                <input type="date" class="form-control form-control-sm mb-3" id="date" name="date"
                                       required>
                            </div>
                            <div class="form-group">
                                <label for="horaire">Heure de l'évènement</label>
                                <input type="time" class="form-control form-control-sm mb-3" id="horaire" name="horaire"
                                       required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                Créer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /table -->

<?php
// Footer
include_once '../../include/footer.php';
// Script
include_once '../../include/script.php';
?>

</body>
</html>

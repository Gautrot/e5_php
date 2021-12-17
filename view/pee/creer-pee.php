<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../include/head.php' ?>
    <title>Creer un projet éducatif</title>
</head>

<body>
<?php
// Manager
include_once '../../manager/Manager.php';
// Preloader
include_once '../../include/modal/preloader.php';
// Header
include_once '../../include/header.php';
// ManaPee
include_once '../../manager/pee/ManaPee.php';
$liste = new ManaPee();
$res = $liste->listeClasse();
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
                            Creer un projet éducatif sur le site.
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Vous pouvez creer un projet éducatif sur le site..</p>
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
                        <form method="POST" action="/e5_php/traitement/pee/creer-pee-tr.php"
                              style="width:100%">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="nom" name="nom"
                                       maxlength="100" required placeholder="ex : Vente de gateau.">
                            </div>
                            <?php if ($_SESSION['user']['statut'] === '3') { ?>
                                <div class="form-group">
                                    <label for="ref_classe">Entrer la classe concernée par le projet éducatif :</label>
                                    <select class="form-control" name="ref_classe" id="ref_classe">
                                        <option value="">- SELECTIONNER -</option>
                                        <?php foreach ($res as $pee) { ?>
                                            <option value="<?= $pee['id_classe'] ?>"><?= $pee['nom'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="description">Description du projet éducatif:</label>
                                <textarea type="text" class="form-control form-control-sm mb-3" id="description"
                                          name="description" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="date">Date du projet éducatif:</label>
                                <input type="date" class="form-control form-control-sm mb-3" id="date"
                                       name="date" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
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

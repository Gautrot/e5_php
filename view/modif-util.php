<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <?php include_once '../include/head.php' ?>
    <title>Modifier</title>
</head>

<body>
<?php
// Manager
include_once '../manager/Manager.php';
// Preloader
include_once '../include/modal/preloader.php';
// Header
include_once '../include/header.php';
// Modal Inscription
include_once '../include/modal/inscription.php';
// Modal Mot de passe oublié
include_once '../include/modal/mdp.php';
// Modal Login
include_once '../include/modal/login.php';
include_once '../include/modal/connectionEleve.php';
include_once '../include/modal/connectionParent.php';
include_once '../include/modal/connectionProf.php';
include_once '../include/modal/connectionAdmin.php';
// Traitement "cherche-util-tr"
require_once '../traitement/cherche-util-tr.php'
?>

<!-- page title -->
<section class="page-title-section overlay" data-background="/e5_php/style/images/backgrounds/page-title.jpg">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <ul class="list-inline custom-breadcrumb">
                    <li class="list-inline-item">
                        <a class="h2 text-primary font-secondary" href="profil">Profil</a></li>
                    <li class="list-inline-item text-white h3 font-secondary nasted">Modification</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- /page title -->

<!-- teacher details -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-5">
                <h3>Modification de <?= $show['nom']; ?></h3>
            <div class="col-12">
                <form method="POST" action="<?php switch ($_SESSION['user']['statut']) {
                    case '1':
                        ?>/e5_php/traitement/eleve/modifier-util-tr<?php break;
                    case '2':
                        ?>/e5_php/traitement/parent/modifier-util-tr<?php break;
                    case '3':
                        ?>/e5_php/traitement/prof/modifier-util-tr<?php break;
                    default: ?>/e5_php/traitement/admin/modifier-util-tr<?php break;
                } ?>" style="width:100%">
                    <div class="form-group">
                        <label for="idUtilisateur" hidden>ID</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="idUtilisateur"
                               name="idUtilisateur" value="<?= $show['idUtilisateur']; ?>" hidden>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="nom" name="nom" required
                               maxlength="40" value="<?= $show['nom']; ?>">
                        <small>Avant : <?= $show['nom']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="prenom" name="prenom" required
                               maxlength="40" value="<?= $show['prenom']; ?>">
                        <small>Avant : <?= $show['prenom']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="dateNaissance">Né.e le</label>
                        <input type="date" class="form-control form-control-sm mb-3" id="dateNaissance"
                               name="dateNaissance" required value="<?= $show['dateNaissance']; ?>">
                        <small>Avant : <?= $show['dateNaissance']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="telephone">Numéro de Téléphone</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="telephone" name="telephone"
                               required maxlength="10" value="<?= $show['telephone']; ?>">
                        <small>Avant : <?= $show['telephone']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="adresse" name="adresse"
                               required value="<?= $show['adresse']; ?>">
                        <small>Avant : <?= $show['adresse']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="mail">Adresse Mél</label>
                        <input type="email" class="form-control form-control-sm mb-3" id="mail" name="mail"
                               required value="<?= $show['mail']; ?>">
                        <small>Avant : <?= $show['mail']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control form-control-sm mb-3" id="login" name="login" required
                               maxlength="40" value="<?= $show['login']; ?>">
                        <small>Avant : <?= $show['login']; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="mdp">Mot de passe</label>
                        <input type="password" class="form-control form-control-sm mb-3" id="mdp" name="mdp"
                               required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Modifier
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- /teacher details -->

<section class="section-sm bg-primary">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <form method="POST" action="index">
                        <button type="submit" class="btn btn-primary">
                            Retour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Footer
include_once '../include/footer.php';
// Script
include_once '../include/script.php';
?>

</body>
</html>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../include/head.php' ?>
    <title>Créer une discussion</title>
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
                            Créer une discussion
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Vous pouvez créer une discussion avec une personne de l'établissement.</p>
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
                        <form method="POST" action="/e5_php/traitement/discussion/creer-discussion-tr"
                              style="width:100%">
                            <div class="form-group">
                                <label for="titre">Titre</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="titre" name="titre"
                                       maxlength="100" required placeholder="ex : J'ai une question.">
                            </div>
                            <div class="form-group">
                                <label for="idInvite">Inviter qui ?</label>
                                <select class="form-control idInvite" name="idInvite" id="idInvite">
                                    <optgroup label="Etudiants">
                                        <?php foreach ($res as $invite) {
                                            if ($invite['statut'] == '1' && $invite['idUtilisateur'] != $_SESSION['user']['idUtilisateur']) { ?>
                                                <option value="<?= $invite['idUtilisateur'] ?>"><?= $invite['nom'] ?></option>
                                            <?php }
                                        } ?>
                                    </optgroup>
                                    <optgroup label="Professeurs">
                                        <?php foreach ($res as $invite) {
                                            if ($invite['statut'] == '3' && $invite['idUtilisateur'] != $_SESSION['user']['idUtilisateur']) { ?>
                                                <option value="<?= $invite['idUtilisateur'] ?>"><?= $invite['nom'] ?></option>
                                            <?php }
                                        } ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control form-control-sm mb-3" id="description"
                                          name="description" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Créer</button>
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

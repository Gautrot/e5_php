<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once '../../../include/head.php' ?>
    <title>Prendre rendez-vous</title>
</head>

<body>
<?php
// Preloader
include_once '../../../include/modal/preloader.php';
// Header
include_once '../../../include/header.php';
// ManaRdv
include_once '../../../manager/rdv/ManaRdv.php';
$liste = new Manager();
$res = $liste->listeUtil();
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
                            Prendre rendez-vous
                        </a>
                    </li>
                    <li class="list-inline-item text-white h3 font-secondary @@nasted"></li>
                </ul>
                <p class="text-lighten">Vous pouvez prendre un rendez-vous avec un professeur/parent.</p>
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
                        <form method="POST" action="/e5_php/traitement/rdv/creer-rdv-tr.php"
                              style="width:100%">
                            <div class="form-group">
                                <label for="objet">Objet</label>
                                <input type="text" class="form-control form-control-sm mb-3" id="objet" name="objet"
                                       maxlength="100" required placeholder="ex : Rendez-vous pour l'orientation.">
                            </div>

                            <div class="form-group">
                                <label for="idPriseRDV">Prendre rendez-vous avec :</label>
                                <select class="form-control" name="idPriseRDV" id="idPriseRDV">
                                  <option value="">- SELECTIONNER -</option>
                                    <optgroup label="Parents">
                                        <?php foreach ($res as $rdv) {
                                            if ($rdv['statut'] == '2' && $rdv['idUtilisateur'] != $_SESSION['user']['idUtilisateur']) { ?>
                                                <option value="<?= $rdv['idUtilisateur'] ?>"><?= $rdv['nom'] ?></option>
                                            <?php }
                                        } ?>
                                    </optgroup>
                                    <optgroup label="Professeurs">
                                        <?php foreach ($res as $rdv) {
                                            if ($rdv['statut'] == '3' && $rdv['idUtilisateur'] != $_SESSION['user']['idUtilisateur']) { ?>
                                                <option value="<?= $rdv['idUtilisateur'] ?>"><?= $rdv['nom'] ?></option>
                                            <?php }
                                        } ?>
                                    </optgroup>

<!--                              --><?php //if ($_SESSION['user']['statut'] === '2') {
//                              $bdd = (new BDD)->getBase();
//                              $req = $bdd->query("SELECT nom, prenom, idUtilisateur FROM utilisateur WHERE statut = '3'");
//                              $res = $req->fetchall(); } ?>
<!---->
<!--                              --><?php //if ($_SESSION['user']['statut'] === '3') {
//                              $bdd = (new BDD)->getBase();
//                              $req = $bdd->query("SELECT nom, prenom, idUtilisateur FROM utilisateur WHERE statut = '2'");
//                              $res = $req->fetchall(); } ?>
<!---->
<!--                              --><?php
//                              foreach ($res as $value) { ?>
<!--                                <option value="--><?php //echo $value['idUtilisateur']?><!--">--><?php //echo $value['nom'] , $value['prenom']?><!--</option>-->
<!--                            --><?php //} ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea type="text" class="form-control form-control-sm mb-3" id="message"
                                          name="message" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="date">Date du rendez-vous</label>
                                <input type="date" class="form-control form-control-sm mb-3" id="date" name="date"
                                       required>
                            </div>

                            <div class="form-group">
                                <label for="horaire">Heure du rendez-vous</label>
                                <input type="time" class="form-control form-control-sm mb-3" id="horaire" name="horaire"
                                       required>
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
include_once '../../../include/footer.php';
// Script
include_once '../../../include/script.php';
?>

</body>
</html>
